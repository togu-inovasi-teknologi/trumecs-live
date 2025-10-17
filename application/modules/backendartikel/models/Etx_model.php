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
            ->from("artikel");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start,$datawhere) {
        $this->db->where($datawhere);    
        $this->db->limit($limit, $start)
            ->order_by("id","DESC");
        $query = $this->db->get("artikel");
        return  $query->result_array();
    }

    public function getdetail($id)
    {
        $this->db->where("id",$id);
        $query1 = $this->db->get("artikel");
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
    public function update($where,$set)
    {
        $this->db->where($where)->set($set)->update("artikel");
    }

    public function input($set)
    {
        $this->db->set($set)->insert("artikel");
    }
    
    public function hapus($where)
    {
        $this->db->set('display', 0);
        $this->db->where($where)->update("artikel");
    }
    
     public function show($where)
    {
        $this->db->set('display', 1);
        $this->db->where($where)->update("artikel");
    }
    
    public function migrate() {
        $query = $this->db->get("artikel");
        foreach($query->result() as $key=>$value) {
            $data = array();
            $date = $value->date;
            if($value->date == null || $value->date == ""){
                $date = "01/01/2022";
            }
            $epoch = strtotime($date);
            $data = array(
                    'created_at' => $epoch,
                    'updated_at' => $epoch,
                    'created_by' => 1,
                );
            $this->db->set($data);
            $this->db->where('id', $value->id);
            $this->db->update('artikel');
        }
    }

}