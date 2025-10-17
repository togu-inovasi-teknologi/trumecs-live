<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function getadmin($data)
    {
        $query = $this->db
                ->select("*,admin.name as nameadmin,backend_rule.name as level, admin.id AS id")
                ->where($data)
                ->from("admin")
                ->join("backend_rule","admin.privileges=backend_rule.id")->get();
        return $query->result_array();
    }
     /*public function get_orderhistory($limit, $start,$where)
    {
        $this->db->where($where)
                ->limit($limit, $start)
                ->order_by("id","DESC");
        $query = $this->db->get("order");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = (array) $row;
            }
            return $data;
        }
        return false;
    }

    public function get_orderhistoryall($where)
    {
        $this->db->where($where)
                ->order_by("id","DESC");
        $query = $this->db->get("order");
        return $query->result_array();

    }

    public function record_countorder($data)
    {
        $query = $this->db->where($data)
                ->from("order");
        return $query->get()->num_rows();
    }


    public function getorderdetail($value)
    {
        $query = $this->db->where($data)
                ->from("order");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getclaim($value)
    {
        $query = $this->db->where($value)
                ->from("complaint");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insertcomplaint($data){
        $this->db->insert("complaint",$data);
    }

    public function getcomplaintwarranty($value)
    {
        $query = $this->db->where($value)
                ->from("complaintwarranty");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insertcomplaintwarranty($data){
        $this->db->insert("complaintwarranty",$data);
    }

    public function insertconfirmation($data)
    {
        $this->db->insert("confirmation",$data);
    }*/

    public function insert($data)
    {
        $this->db->insert("admin",$data);
    }
    
    public function edit_admin($id,$data)
    {
        $this->db->where($id)
                ->update("admin",$data);
    }
    public function update($where,$update)
    {
        $this->db->where($where)
                ->set($update)
                ->update("admin");
    }
    public function delete()
    {
        # code...
    }

    public function activation($data)
    {
        $query1 = $this->db->where($data)
                ->from("admin");
        $query1 = $this->db->get();
        $query1->result_array();
        if (count($query1)==NULL) {
            return false;
        }else{
            $this->db->where($data)
                ->set('status','active')
                ->set('level','silver')
                ->update("admin");
            return true;
        }
    }

    /*public function recordhistory($where)
    {
        $query = $this->db->where($where)->from("order");
        return $query->get()->num_rows();
    }
    public function fecthistory($limit, $start,$where)
    {
        $this->db->limit($limit, $start)->where($where)->order_by("id","DESC");
        $query = $this->db->get("order");
        return $query->result_array();

    }

    public function getcartorderdetail($data)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.id_order = order.id');
        $this->db->where($data);

        $order = $this->db->get();
        return $order->result_array();
    }

    public function inserttestimonial($data){
        $this->db->insert("testimonial",$data);
    }
    public function gettestimonial()
    {
        $this->db->from('testimonial');
        $this->db->where("moderate","sudah");
        $this->db->order_by("id","DESC");

        $testimoni = $this->db->get();
        return $testimoni->result_array();
    }*/
}
