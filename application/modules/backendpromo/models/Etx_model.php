<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class etx_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    public function record_count() {
            
        $query = $this->db->get("promo");
        return $query->result_array();
    }

      public function fetch_product($limit, $start,$datawhere) {
        $this->db->where($datawhere);    
        $this->db->limit($limit, $start)
            ->order_by("id","DESC");
        $query = $this->db->get("promo");
        return  $query->result_array();
    }

    public function getdetail($id)
    {
        $this->db->where("id", $id);
        $query1 = $this->db->get("promo");
        $queryconfirm=$query1->result_array();
        $returnall = $queryconfirm[0];
        return $returnall;
    }
    public function getallproduct()
    {
        $this->db->where("status","show");    
        $this->db->order_by("id","DESC");
        $query = $this->db->get("product");
        return  $query->result_array();
    }
    private function getdetailorder($idorder)
    {
        $ttdetail = $this->db->where("id_order", $idorder)->get("order_detail");
        $alldetaillist = $ttdetail->result_array();
        return  $alldetaillist;
        var_dump($alldetaillist["listpesanan"]);
    }
    public function update($where,$set)
    {
        $this->db->where($where)->set($set)->update("promo");
    }

    public function input($set)
    {
        $this->db->set($set)->insert("promo");
    }
     public function hapus($where)
    {
        $this->db->where($where)->delete("promo");
    }

    public function gethome($name)
    {
        $query = $this->db->where("name",$name)->get('home');
        return $query->result_array();
        
    }
    public function hapushalamadepan($where)
    {
        $this->db->where($where)->delete("home");
    }
    
    public function inputhalamadepan($set)
    {
        $this->db->set($set)->insert("home");
    }

    public function updatehalamadepan($set, $id)
    {
        $this->db->set($set)->where('id', $id)->update("home");
    }

}