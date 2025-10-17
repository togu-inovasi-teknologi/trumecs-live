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
            ->from("complaint");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start,$datawhere) {
        $this->db->where($datawhere);    
        $this->db->limit($limit, $start)
            ->order_by("id","DESC");
        $query = $this->db->get("complaint");
        return  $query->result_array();
    }

    public function getdetail($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("complaint");
        $queryconfirm=$query1->result_array();
        $returnconfirm["complaint"] = $queryconfirm[0];
        $whereidmember = $queryconfirm[0]["idmember"];
        $returnall = array();
        $wheremember = array('id' => $whereidmember);
        $this->db->where($wheremember);
        $detailmember = $this->db->get("member");
        $remove0 =$detailmember->result_array();
        $returndetailmember["detailmember"] = $remove0[0];
        $returnall = array_merge($returnconfirm,$returndetailmember);
        return $returnall;
    }

    public function update($where,$set)
    {
        $this->db->where($where)->set($set)->update("complaint");
    }
    
     public function hapus($where)
    {
        $this->db->where($where)->delete("complaint");
    }

}