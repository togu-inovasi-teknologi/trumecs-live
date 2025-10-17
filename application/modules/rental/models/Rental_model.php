<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rental_model extends CI_Model
{

    function __construct()
    {

        $this->load->model('category/Category_model');
        parent::__construct();
    }


    private function _set($data = []) {}



    private function _get($data)
    {
        // $data = $this->db->get_where('store_banner', $data)->row_array();
        // $this->_set($data);
    }

    public function categories()
    {
        return $this->db->select('c.*')->from('categori c')->join('product p', 'p.component = c.id')->where('p.is_rent', 1)->group_by('c.id')->get()->result_array();
    }

    public function getRental($id)
    {
        $this->db->reset_query();
        $this->db->select('p.*, b.name as nama_brand, r.name as lokasi');
        $this->db->join('categori b', 'b.id = p.brand', "left");
        $this->db->join('regencies r', 'r.id = p.area', 'left');
        $this->db->where('p.component', $id);
        $query = $this->db->get('product p');
        $return = $query->result_array();
        return $return;
    }
    public function getRentalDetail($id)
    {
        $this->db->reset_query();
        $this->db->select('p.*, b.name as nama_brand, r.name as lokasi, a.name as nama_attribute, pa.value as nilai_attribute, c.name as nama_category');
        $this->db->join('categori b', 'b.id = p.brand', "left");
        $this->db->join('categori c', 'c.id = p.component', "left");
        $this->db->join('regencies r', 'r.id = p.area', 'left');
        $this->db->join('product_attribute pa', 'pa.product_id = p.id', 'left');
        $this->db->join('attribute a', 'a.id= pa.attribute_id', 'left');
        $this->db->where('p.id', $id);
        $query = $this->db->get('product p');
        $return = $query->result_array();
        return $return;
    }
    public function getGalleryExpert($value)
    {
        $query = $this->db->where("product", $value)->get('galery');
        return $query->result_array();
    }

    public function getProductAttribute($value)
    {
        $this->db->reset_query();
        $this->db->select('pa.*, a.name as nama_attribute, a.id as id_attribute');
        $this->db->join('attribute a', 'a.id = pa.attribute_id', 'left');
        $this->db->where("product_id", $value);
        $query = $this->db->get('product_attribute pa');
        return $query->result_array();
    }
}