<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_datatable_model extends CI_Model
{
    var $table = "product";
    var $select_column = array('p.id', 'tittle', 'b.name', 'grade', 'price', 'p.img', 'c.name as nama_kategori', 'p.unit');
    var $where_column = ['component' => 'p.component', 'subcategory' => 'c.id', 'brand' => 'p.brand'];
    var $order_column = array('p.id', 'tittle', 'b.name', 'grade', 'price', 'p.img', 'c.name');

    var $where = [];

    function __construct()
    {
        if (isset($_POST['where'])) {
            $this->where = $_POST['where'];
            $this->where = $this->getAllCategoryIdsInTree($this->where['component']);
        }
        parent::__construct();
    }

    private function _query()
    {

        $this->db->select($this->select_column);
        $this->db->from($this->table . ' p');
        $this->db->join('categori c', 'p.component = c.id', 'left');
        $this->db->join('categori b', 'b.id = p.brand', 'left');
        $this->db->join('grade g', 'g.id = p.quality', 'left');

        if (!empty($this->where)) {

            $this->db->where_in('component', $this->where);
        }
        
        if (count($_POST['where']) > 1) {
            $this->db->group_start();
            foreach ($_POST['where'] as $key => $value) {
                if ($key != 'component') {
                    $this->db->where($this->where_column[$key], $value);
                }
            }
            $this->db->group_end();
        }

        $this->db->where('p.status','show');

        if (!empty($_POST["search"]["value"])) {
            if (!empty($this->where)) {
                $this->db->group_start();
            }
            foreach ($this->order_column as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($value, $_POST["search"]["value"]);
                }
            }
            if (!empty($this->where)) {
                $this->db->group_end();
            }
        }

        if (isset($_POST["order"])) {
            if($_POST["order"][0]['column']!=0){
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('RAND()');
            }
        } else { 
            $this->db->order_by('RAND()');
        }
    }


    public function make_datatables()
    {
        $this->_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_filtered_data()
    {
        $this->_query();
        return $this->db->get()->num_rows();
    }
    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        if (!empty($this->where)) {
            $this->db->where($this->where);
        }
        return $this->db->count_all_results();
    }

    public function getAllCategoryIdsInTree($category_id)
    {
        $categoryIds = array();
        $categoryIds[] = $category_id; // Tambahkan kategori saat ini ke daftar

        $this->getCategoryChildren($category_id);

        // Ambil semua anak kategori secara rekursif
        $childCategoryIds = $this->getCategoryChildren($category_id);

        return array_merge($categoryIds, $childCategoryIds);
    }

    function getCategoryChildren($category_id)
    {
        $childIds = array();
        $query = $this->db->select('id')->from('categori')->where('parent', $category_id)->get();

        foreach ($query->result() as $row) {
            $childIds[] = $row->id;
            $childIds = array_merge($childIds, $this->getCategoryChildren($row->id));
        }
        return $childIds;
    }
}
