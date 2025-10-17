<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_banner_model extends CI_Model
{
    public $id, $source, $index, $store_id, $is_mobile, $link;


    function __construct($data = [])
    {
        if (!empty($data)) {
            $this->_get($data);
        }
        $this->load->model('category/Category_model');
        parent::__construct();
    }


    private function _set($data = [])
    {

        if (array_key_exists('id', $data))
            $this->id = (int) $data['id'];
        if (array_key_exists('source', $data))
            $this->source = $data['source'];
        if (array_key_exists('index', $data))
            $this->index = $data['index'];
        if (array_key_exists('store_id', $data))
            $this->store_id = $data['store_id'];
        if (array_key_exists('is_mobile', $data))
            $this->is_mobile = $data['is_mobile'];
        if (array_key_exists('link', $data))
            $this->link = $data['link'];
    }



    private function _get($data)
    {
        $data = $this->db->get_where('store_banner', $data)->row_array();
        $this->_set($data);
    }

    public function get($data)
    {
        $this->db->reset_query();
        $data = $this->db->get_where('store_banner', $data)->row_array();
        return $data;
    }
}
