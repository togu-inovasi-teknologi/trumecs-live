<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getcucigudang($value)
    {
        $cucigudang = $this->db->where("url",$value)->from("cucigudang")->get();
        $getproduct = $cucigudang->result_array();
        if (count($getproduct)>0) {
            $product = $getproduct[0]["product"];
            $array_product = explode(",", $product);
            $select = $this->db->select("");
            $i=0;$asb="";
            foreach ($array_product as $key => $v) {
                    /*!empty($key)?
                    $this->db->or_like_in("tittle",$key) : "";*/
                    $asb .= " OR id='".$v."'";
                }
                $getselect = $select->where("( id = '' ".$asb.")")->from("product")->get()->result_array();
                $arrayall = array_merge(array('product' => $getselect),array('cucigudang' => $getproduct));
                return $arrayall;
            }

    }
    public function getall()
    {
        $cucigudang = $this->db->from("cucigudang")->order_by("id","DESC")->get();
        return $cucigudang->result_array();
    }
}