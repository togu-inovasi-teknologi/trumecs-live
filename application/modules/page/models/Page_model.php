<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getpage($url)
    {
        if (is_numeric($url)) {
           $query = $this->db->where("id",$url)->get('page');
        } else {
           $query = $this->db->where("url",$url)->get('page');
        }
        $return = $query->result_array();
        if (count($query->result_array())==0) {
            $query = $this->db->where("url","tentang-trumecs")->get('page');
            $return = $query->result_array();
        }
        return $return;
    }
}