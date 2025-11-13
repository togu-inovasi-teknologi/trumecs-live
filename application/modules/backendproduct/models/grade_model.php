<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade_model extends CI_Model
{

    private $table = 'grade';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getgrade()
    {
        return $this->db->get('grade')->result();
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
        $this->db->from($this->table);

        $i = 0;
        // Search functionality
        if ($search) {
            foreach (['grade', 'type'] as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }
                if (count(['grade', 'type']) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }

        // Order functionality
        if ($order) {
            $this->db->order_by($this->get_order_column($order['column']), $order['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }

    // Map column index to actual column name
    private function get_order_column($column_index)
    {
        $columns = [
            0 => 'id',
            1 => 'grade',
            2 => 'type'
        ];
        return $columns[$column_index] ?? 'id';
    }

    // Get grade by ID
    public function get_grade_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
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
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Add new grade
    public function insert_grade($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
