<?php
defined('BASEPATH') or exit('No direct script access allowed');

class grade_model extends CI_Model
{

    private $table = 'grade';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getgrade($where = [])
    {
        return $this->db->where($where)
            ->get('grade')->result();
    }

    public function get_parent_grades()
    {
        return $this->db->where('prn', 0)
            ->order_by('grade', 'ASC')
            ->get('grade')
            ->result();
    }

    // Get child grades by parent ID
    public function get_child_grades($parent_id)
    {
        return $this->db->where('prn', $parent_id)
            ->order_by('grade', 'ASC')
            ->get('grade')
            ->result();
    }

    public function get_all_grades_with_parent()
    {
        $this->db->select('g.*, p.grade as parent_grade');
        $this->db->from('grade g');
        $this->db->join('grade p', 'g.prn = p.id', 'left');
        $this->db->order_by('g.prn', 'ASC');
        $this->db->order_by('g.grade', 'ASC');
        return $this->db->get()->result();
    }

    public function get_grades_by_categori($category_id)
    {
        return $this->db->select('g.*')
            ->from('category_grade cg')
            ->join('grade g', 'cg.grade_id = g.id')
            ->where('cg.category_id', $category_id)
            ->get()
            ->result();
    }

    // Get all grades for DataTables
    public function get_datatables($start, $length, $search, $order)
    {
        $this->_get_datatables_query($search, $order);

        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        return $this->db->get()->result();
    }

    // Count filtered records
    public function count_filtered($search)
    {
        $this->_get_datatables_query($search, null);
        return $this->db->get()->num_rows();
    }

    // Count total records
    public function count_all()
    {
        return $this->db->get($this->table)->num_rows();
    }

    // Build query for DataTables
    private function _get_datatables_query($search, $order)
    {
        $this->db->select('g.*, p.grade as parent_name');
        $this->db->from('grade g');
        $this->db->join('grade p', 'g.prn = p.id', 'left');

        $i = 0;
        // Search functionality
        if ($search) {
            foreach (['g.grade', 'g.type', 'p.grade'] as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }
                if (count(['g.grade', 'g.type', 'p.grade']) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }

        // Order functionality
        if ($order) {
            $order_columns = [
                0 => 'g.id',
                1 => 'g.grade',
                2 => 'p.grade',
                3 => 'g.type'
            ];
            $this->db->order_by($order_columns[$order['column']] ?? 'g.id', $order['dir']);
        } else {
            $this->db->order_by('g.id', 'DESC');
        }
    }

    // Map column index to actual column name
    public function get_grade_by_id($id)
    {
        return $this->db->select('g.*, p.grade as parent_name')
            ->from('grade g')
            ->join('grade p', 'g.prn = p.id', 'left')
            ->where('g.id', $id)
            ->get()
            ->row();
    }


    // Update grade
    public function update_grade($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete grade
    public function delete_grade($id)
    {
        // Check if this grade has child grades
        $child_count = $this->db->where('prn', $id)->get($this->table)->num_rows();

        if ($child_count > 0) {
            // Option 1: Delete all child grades first
            $this->db->where('prn', $id)->delete($this->table);
        }

        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Add new grade
    public function insert_grade($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function has_children($id)
    {
        return $this->db->where('prn', $id)->get($this->table)->num_rows() > 0;
    }

    public function get_hierarchical_grades($category_id = null)
    {
        // Get all grades
        $this->db->select('g.*');

        if ($category_id != null) {
            $this->db->join("category_grade cg", "cg.grade_id = g.id")
                ->where("cg.category_id", $category_id);
        }

        $grades = $this->db->order_by('g.grade', 'ASC')
            ->get('grade g')
            ->result();

        // Convert to array for easier manipulation
        $grades_array = [];
        foreach ($grades as $grade) {
            $grades_array[] = (array)$grade;
        }

        // Build hierarchical tree
        $tree = [];
        $children = [];

        // Group by parent
        foreach ($grades_array as $grade) {
            $children[$grade['prn']][] = $grade;
        }

        // Build HTML options recursively
        $options = $this->build_grade_options($children, 0, 0);

        return $options;
    }

    private function build_grade_options($children, $parent_id, $level, $selected_id = null)
    {
        $html = '';

        if (!isset($children[$parent_id])) {
            return $html;
        }

        foreach ($children[$parent_id] as $grade) {
            $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $level);
            $prefix = ($level > 0) ? '└─ ' : '';

            $selected = ($selected_id == $grade['id']) ? 'selected' : '';

            $html .= '<option value="' . $grade['id'] . '" ' . $selected . '>';
            $html .= $indent . $prefix . $grade['grade'];
            $html .= '</option>';

            // Recursively add children
            $html .= $this->build_grade_options($children, $grade['id'], $level + 1, $selected_id);
        }

        return $html;
    }

    // Get all grades as flat array with parent info
    public function get_flat_grades_with_parent($category_id = null)
    {
        $this->db->select('g.*, p.grade as parent_name');
        $this->db->from('grade g');
        $this->db->join('grade p', 'g.prn = p.id', 'left');

        if ($category_id != null) {
            $this->db->join("category_grade cg", "cg.grade_id = g.id")
                ->where("cg.category_id", $category_id);
        }

        $this->db->order_by('CASE WHEN g.prn = 0 THEN 0 ELSE 1 END', 'ASC');
        $this->db->order_by('g.grade', 'ASC');

        return $this->db->get()->result();
    }
}
