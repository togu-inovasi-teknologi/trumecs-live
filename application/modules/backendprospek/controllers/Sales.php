<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("M_Prospek");
    }
    
    public function index() {
        /*$data["datawhere"]= array();
        $config["per_page"] = 10;
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page,$data["datawhere"]);
        $data["js"] = array(base_url().'asset/backend/js/list.order.js' );*/
        $data['list'] = $this->M_Prospek->get_all();
        $data['content'] = 'v_sales';
        $this->load->view('backend/template_front1', $data);
    }
    
    public function detail($id_prospek = null) {
        $data['data'] = $this->M_Prospek->get_detail($id_prospek);
        $data['visit'] = $this->M_Prospek->get_visit($id_prospek);
        $data['content'] = 'detail_sales';
        $this->load->view('backend/template_front1', $data);
    }
    
    public function set_visit() {
        if($this->input->post()):
            $this->M_Prospek->set_visit();
            $this->session->set_flashdata('status', 'success');
            redirect('backendprospek/sales/detail/'.$this->input->post('id_prospek'));
        else:
            redirect();
        endif;
    }
    
}