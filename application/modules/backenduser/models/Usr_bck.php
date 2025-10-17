<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usr_bck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function getdetail($data)
    {
        $this->db
                ->select("*,admin.id as idadmin,admin.name as nameadmin,backend_rule.name as level,backend_rule.id as idlevel")
                ->where($data)
                ->where('admin.privileges !=""', null, false)
                ->from("admin")
                ->join("backend_rule","admin.privileges=backend_rule.id");
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_admin($where)
    {
        $this->db
                ->select("*,admin.id as idadmin,admin.name as nameadmin,backend_rule.name as level")
                ->where($where)
                ->from("admin")
                ->join("backend_rule","admin.privileges=backend_rule.id");
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getprevilage()
    {
        $this->db->select("backend_rule.id as idlevel,backend_rule.name as namelevel")
                ->from("backend_rule");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function record_admin()
    {
        $query = $this->db->get("admin");
        return $query->result_array();
    }

    public function update($data,$where){
        $this->db->where($where)->update("admin",$data);
    }

    public function insert($data)
    {
        $this->db->insert("admin",$data);
    }

}