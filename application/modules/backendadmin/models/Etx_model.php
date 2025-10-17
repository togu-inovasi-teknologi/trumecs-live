<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class etx_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getmenutable()
    {
        $query = $this->db->get("backend_menu");
        return $query->result_array();
    }

    public function getruletable()
    {
        $query = $this->db->get("backend_rule");
        return $query->result_array();
    }

    public function getmenu($id)
    {
        $this->db->where("id",$id);
        $query = $this->db->get("backend_menu");
        $query1 = $query->result_array();
        $returnquery = $query1[0];
        return $returnquery;
    }

    public function inputmenu($set)
    {
        $this->db->set($set)->insert("backend_menu");
    }
    public function updatemenu($where,$set)
    {
        $this->db->where($where)->set($set)->update("backend_menu");
    }
     public function hapusmenu($where)
    {
        $this->db->where($where)->delete("backend_menu");
    }

    public function getSubMenu($id)
    {
        $this->db->where("prn",$id);    
        $query = $this->db->get("backend_menu");
        return  $query->result_array();
    }

    public function getrule($id)
    {
        $this->db->where("id",$id);
        $query = $this->db->get("backend_rule");
        $query1 = $query->result_array();
        $returnquery = $query1[0];
        return $returnquery;
    }

    public function inputrule($set)
    {
        $this->db->set($set)->insert("backend_rule");
    }
    public function updaterule($where,$set)
    {
        $this->db->where($where)->set($set)->update("backend_rule");
    }
     public function hapusrule($where)
    {
        $this->db->where($where)->delete("backend_rule");
    }

}