<?php
defined('BASEPATH') or exit('No direct script access allowed');

class general_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getsetting($name)
    {
        $query = $this->db->where("name", $name)->get('setting');
        return $query->result_array();
    }

    public function initCompare()
    {
        $this->db->insert('sharing_compare', ['created_at' => time()]);
        return $this->db->insert_id();
    }
    public function insert_item_share($items)
    {
        $this->db->insert_batch('compare_item', $items);
    }

    public function getBrandCategory()
    {
        $this->db->select('
        a.*,b.img as img_category
        ');
        $this->db->from('category_brand as a');
        $this->db->join('categori as b', 'a.brand_id = b.id');
        $this->db->limit(4);
        // $this->db->where('a.category_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getcategori($where = [])
    {
        $this->db->reset_query();
        $data = $this->db->select('*')->from('categori')->where($where)->get()->result_array();

        return $data;
    }

    public function getparentcategori($id)
    {
        $query = $this->db->where("id", $id)->get('categori');
        return $query->result_array();
    }

    public function getcategoribyname($name)
    {
        $query = $this->db->where("name", $name)->get('categori');
        return $query->result_array();
    }

    public function getbrand($category_id = null, $empty = false)
    {
        // VALIDASI category_id - pastikan numeric atau null
        if ($category_id !== null && $category_id !== "undefined" && is_numeric($category_id)) {
            $this->db
                ->join("category_brand cb", "cb.brand_id = c.id AND cb.category_id = " . $this->db->escape($category_id), false)
                ->join("categori c2", "c2.id = cb.brand_id");
        } elseif ($category_id === "undefined") {
            // Jika "undefined", anggap sebagai null
            $category_id = null;
        }

        if ($empty == true) {
            $this->db->join('product p', 'p.brand = c.id AND p.status = "show"')
                ->select("COUNT(p.id) as jumlah, c.*", false)
                ->order_by('jumlah', 'desc')
                ->where('name !=', 'other')
                ->limit(20)
                ->group_by('c.id');
        }

        $query = $this->db
            ->where('c.parent', "0")
            ->order_by('c.name', 'ASC')
            ->get('categori c');

        return $query->result_array();
    }

    public function getattribute($category_id = null)
    {
        if ($category_id != null) {
            $this->db
                ->join("category_attribute ca", "ca.attribute_id = c.id AND ca.category_id = " . $category_id, false)
                ->join("categori c2", "c2.id = ca.category_id");
        }

        $query = $this->db
            ->select('*, c.name AS name, c.id As id')
            ->order_by('c.name', 'ASC')
            ->get('attribute c');
        return $query->result_array();
    }

    public function getgrade($category_id = null)
    {
        if ($category_id != null) {
            $this->db->where("cg.category_id", $category_id)
                ->join("category_grade cg", "cg.grade_id = g.id");
        }

        $query = $this->db->order_by('g.grade', 'ASC')
            ->get('grade g');
        return $query->result_array();
    }

    public function getjabodetabek()
    {
        $query = $this->db->get('city_shipping');
        return $query->result_array();
    }

    public function getwilayahprovince()
    {
        $query = $this->db->get('provinces');
        return $query->result_array();
    }
    public function getwilayahrigences($where)
    {
        $query = $this->db->where($where)->get('regencies');
        return $query->result_array();
    }
    public function getwilayahdistricts($where)
    {
        $query = $this->db->where($where)->get('districts');
        return $query->result_array();
    }
    public function getwilayahvillages($where)
    {
        $query = $this->db->where($where)->get('villages');
        return $query->result_array();
    }

    public function getkodejne($where)
    {
        $query = $this->db->select("kode_jne")->where($where)->get('districts');
        return $query->result_array();
    }
    public function getarea()
    {
        $query = $this->db->get('delivery_area');
        return $query->result_array();
    }
}
