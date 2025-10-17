<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usr_bck extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function gettestimonial($data)
    {
        $this->db
                ->select("*")
                ->where($data)
                ->from("testimonial");
        $query = $this->db->get();
        return $query->result_array();
    }


    public function update($data,$where){
        $this->db->where($where)->update("testimonial",$data);
    }

    public function insert($data)
    {
        $this->db->insert("testimonial",$data);
    }

}