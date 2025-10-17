<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getpromo($value)
    {
        $promo = $this->db->where("url", $value)->from("promo")->get();
        $getproduct = $promo->result_array();
        if (count($getproduct) > 0) {
            $product = $getproduct[0]["product"];
            $getselect = $this->fetch_product($product);
            $arrayall = array_merge(array('product' => $getselect), array('promo' => $getproduct));
            return $arrayall;
        }
    }

    public function getpromoproduct()
    {
        $this->db->where('start_date <=', time());
        $this->db->where('end_date >=', time());
        $promo = $this->db->from("promo")->order_by("id", "DESC")->get();
        $promo_list = $promo->result_array();
        foreach ($promo_list as $key => $value) {
            $getselect = $this->fetch_product($value['product']);
            $promo_list[$key]['products'] = $getselect;
        }
        return $promo_list;
    }

    function fetch_product($product)
    {
        $array_product = explode(",", $product);
        $select = $this->db->select("");
        $i = 0;
        $asb = "";
        foreach ($array_product as $key => $v) {
            $asb .= " OR id='" . $v . "'";
        }
        $getselect = $select->where("( id = '' " . $asb . ")")->from("product")->get()->result_array();
        return $getselect;
    }

    public function getall()
    {
        $this->db->where('start_date <=', time());
        $this->db->where('end_date >=', time());
        $promo = $this->db->from("promo")->order_by("id", "DESC")->get();
        $promo_list = $promo->result_array();
        foreach ($promo_list as $key => $value) {
            $this->db->limit(($this->agent->is_mobile() ? 2 : 4));
            $getselect = $this->fetch_product($value['product']);
            $promo_list[$key]['products'] = $getselect;
        }
        return $promo_list;
    }
    public function get_category()
    {
        $this->db->where('parent', '0');
        $data = $this->db->get('categori');

        return $data;
    }

    public function get_query($string)
    {
        $string = explode(" ", $string);

        $this->db->select('id');
        foreach ($string as $item) :
            $this->db->or_like("name", $item, "both");
        endforeach;

        $data = $this->db->get('categori');

        $children = [];
        foreach ($data->result() as $item) :
            $sub_children = $this->get_sub_category($item->id);
            $children = array_merge($children, $sub_children);
        endforeach;

        return $children;
    }
    
    public function add_sph($data){
        $this->db->set('name', $data['name']);
        $this->db->set('company', $data['company']);
        $this->db->set('companyex', $data['number']);
        $this->db->set('address', $data['location']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('date', date("Y-m-d H:i:s"));
        $this->db->set('email', session_id());
        $this->db->set('messageconntent', $data['type']);
        $this->db->insert('quotation');
        
        
    }
}