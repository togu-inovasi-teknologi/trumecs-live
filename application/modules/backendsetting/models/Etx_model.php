<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class etx_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    public function record_count($datawhere) {
            
        $this->db->where($datawhere); 
        $query = $this->db
            ->from("page");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start,$datawhere) {
        $this->db->where($datawhere);    
        $this->db->limit($limit, $start)
            ->order_by("id","DESC");
        $query = $this->db->get("page");
        return  $query->result_array();
    }

    public function getdetail($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("page");
        $queryconfirm=$query1->result_array();
        $returnall = $queryconfirm[0];
        return $returnall;
    }
    private function getdetailorder($idorder)
    {
        $ttdetail = $this->db->where("id_order", $idorder)->get("order_detail");
        $alldetaillist = $ttdetail->result_array();
        return  $alldetaillist;
        var_dump($alldetaillist["listpesanan"]);
    }


    public function getmenu($name)
    {
        $this->db->where("name",$name);    
        $query = $this->db->get("setting");
        return  $query->result_array();
    }

    public function getparentcategory()
    {
        $this->db->where("parent","prn");    
        $query = $this->db->get("categori");
        return  $query->result_array();
    }

    public function gettable($table)
    {
        $query = $this->db->get($table);
        return  $query->result_array();
    }
    public function gettablewhere($table,$where)
    {
        $query = $this->db->where($where)->get($table);
        return  $query->result_array();
    }

    public function input($set)
    {
        $this->db->set($set)->insert("setting");
    }
    public function update($where,$set)
    {
        $this->db->where($where)->set($set)->update("setting");
    }
     public function hapus($where)
    {
        $this->db->where($where)->delete("setting");
    }

    public function updatetable($where,$set,$table)
    {
        $this->db->where($where)->set($set)->update($table);
    }

    public function getwilayah()
    {
        $query = $this->db->get("jne_wilayah");
        return  $query->result_array();
    }



}