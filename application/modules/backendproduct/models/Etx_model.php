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
            ->from("delivery_area");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start,$datawhere) {
        $this->db->where($datawhere);    
        $this->db->limit($limit, $start)
            ->order_by("id","DESC");
        $query = $this->db->get("delivery_area");
        return  $query->result_array();
    }

    public function getdetail($id)
    {
        $this->db->where("id", $id);
        $query1 = $this->db->get("delivery_area");
        $queryconfirm=$query1->result_array();
        $returnall = $queryconfirm[0];
        return $returnall;
    }

    public function update($where,$set)
    {
        $this->db->where($where)->set($set)->update("delivery_area");
    }

    public function input($set)
    {
        $this->db->set($set)->insert("delivery_area");
    }
     public function hapus($where)
    {
        $this->db->where($where)->delete("delivery_area");
    }
    
    
    

}