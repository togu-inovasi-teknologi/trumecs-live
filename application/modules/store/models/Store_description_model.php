<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_description_model extends CI_Model
{
    public $id, $title, $content, $store_id, $index, $image, $icon, $is_image, $direction_image, $title_direction;


    function __construct($data = [])
    {
        if (!empty($data)) {
            $this->_get($data);
        }
        parent::__construct();
    }


    private function _set($data = [])
    {

        if (array_key_exists('id', $data))
            $this->id = (int) $data['id'];
        if (array_key_exists('title', $data))
            $this->title = $data['title'];
        if (array_key_exists('content', $data))
            $this->content = $data['content'];
        if (array_key_exists('store_id', $data))
            $this->store_id = $data['store_id'];
        if (array_key_exists('index', $data))
            $this->index = $data['index'];
        if (array_key_exists('image', $data))
            $this->image = $data['image'];
        if (array_key_exists('icon', $data))
            $this->icon = $data['icon'];
        if (array_key_exists('is_image', $data))
            $this->is_image = $data['is_image'];
        if (array_key_exists('direction_image', $data))
            $this->direction_image = $data['direction_image'];
        if (array_key_exists('title_direction', $data))
            $this->title_direction = $data['title_direction'];
    }



    private function _get($data)
    {
        $data = $this->db->get_where('store_description', $data)->row_array();
        $this->_set($data);
    }

    public function insert_desc($data)
    {
        $this->db->insert('store_description', $data);
    }

    public function edit_desc($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('store_description', $data);
    }

    public function delete_desc($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('store_description');
    }
    function image_desc_exists($value)
    {
        $this->db->where('image', $value);
        $query = $this->db->get('store_description');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
