<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sharing extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->language("home");
        $this->load->model("category/category_model");
        $this->load->model("sharing/Sharing_model");
        $this->load->model("general/general_model");
        $this->load->model("c/c_model");
        
    }

    public function index()
    {
        $compareId = $this->uri->segment(2);

        $dataCompare = $this->db->select('*')->from('compare_item')->where('compare_id', $compareId)->get()->result();
        var_dump($dataCompare);
        die;

        $product = $this->db->get_where('product', ['id' => $dataCompare->item_id])->result_array();



        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/sharing_view';
            
        } else {
            $data['content'] = 'mobile/landing';
            
        }
        $this->load->view('front/template/index', $data);
    }
    

    
}