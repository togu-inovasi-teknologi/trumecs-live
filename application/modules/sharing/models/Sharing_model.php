<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sharing_model extends CI_Model
{

    public $id, $crated_at;

    function __construct()
    {
        parent::__construct();
    }


    public function items()
    {
        $this->db->select('product');
        $this->db->from('product p');
        $this->db->join('categori c', 'p.component = c.id', 'left');
        $this->db->join('categori b', 'b.id = p.brand', 'left');
        $this->db->join('grade g', 'g.id = p.quality', 'left');
        $this->db->join('compare_item ci', 'ci.item_id = p.id');
        $this->db->join('sharing_compare sc', 'sc.id = ci.compare_id');
        $this->db->where('ci.id', $id);
        return $this->db->get()->result_array();
    }


}