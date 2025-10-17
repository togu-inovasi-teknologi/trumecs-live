<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitemap_model extends CI_Model
{
    
    function __construct(){
        parent::__construct();
    }

    public function getpage()
    {
        $query = $this->db->from('page')->get();
        return $query->result_array();
    }
    public function getproduct()
    {
        $query = $this->db->from('product')->order_by("id","DESC")->get();
        return $query->result_array();
    }
    public function getartikel()
    {
        $query = $this->db->from('artikel')->order_by("id","DESC")->get();
        return $query->result_array();
    }
    public function getpromo()
    {
        $query = $this->db->from('promo')->order_by("id","DESC")->get();
        return $query->result_array();
    }
}