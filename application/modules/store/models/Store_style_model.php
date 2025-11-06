<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_style_model extends CI_Model
{
    public $id, $color_text_content, $color_text_title, $store_id, $color_nav, $color_nav_text, $color_bg, $color_text_name_category, $color_card_description, $color_card_title, $color_card_content, $color_text_name_product, $direction_card, $direction_text_title_description, $color_button, $color_card_product, $color_text_card_product;


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
        if (array_key_exists('color_text_content', $data))
            $this->color_text_content = $data['color_text_content'];
        if (array_key_exists('color_text_title', $data))
            $this->color_text_title = $data['color_text_title'];
        if (array_key_exists('store_id', $data))
            $this->store_id = $data['store_id'];
        if (array_key_exists('color_nav', $data))
            $this->color_nav = $data['color_nav'];
        if (array_key_exists('color_nav_text', $data))
            $this->color_nav_text = $data['color_nav_text'];
        if (array_key_exists('color_text_name_category', $data))
            $this->color_text_name_category = $data['color_text_name_category'];
        if (array_key_exists('color_text_name_product', $data))
            $this->color_text_name_product = $data['color_text_name_product'];
        if (array_key_exists('color_bg', $data))
            $this->color_bg = $data['color_bg'];
        if (array_key_exists('color_card_description', $data))
            $this->color_card_description = $data['color_card_description'];
        if (array_key_exists('color_card_title', $data))
            $this->color_card_title = $data['color_card_title'];
        if (array_key_exists('color_card_content', $data))
            $this->color_card_content = $data['color_card_content'];
        if (array_key_exists('direction_card', $data))
            $this->direction_card = $data['direction_card'];
        if (array_key_exists('direction_text_title_description', $data))
            $this->direction_text_title_description = $data['direction_text_title_description'];
        if (array_key_exists('color_button', $data))
            $this->color_button = $data['color_button'];
        if (array_key_exists('color_card_product', $data))
            $this->color_card_product = $data['color_card_product'];
        if (array_key_exists('color_text_card_product', $data))
            $this->color_text_card_product = $data['color_text_card_product'];
    }



    private function _get($data)
    {
        $data = $this->db->get_where('store_style', $data)->row_array();
        $this->_set($data);
    }

    public function update($whereStore, $update)
    {
        $this->db->where([
            'store_id' => $whereStore,
        ])
            ->set($update)
            ->update("store_style");
    }
}
