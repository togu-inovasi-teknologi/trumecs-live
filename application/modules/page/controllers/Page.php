<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("page_model");
        $this->load->model("general/general_model");
    }

    function _remap($param,$url) {
        $this->index($param);
    }
	public function index($url)
	{
	    $this->lang->load(array('tentang'));
		$_url = ($url==NULL OR $url=="index") ? "41": $url ;
		$data["data_page"]=$this->page_model->getpage($_url);
        $data["getbrand"] = $this->general_model->getbrand(null, true);
		$data["css"] = array(base_url().'asset/css/view_page.css',base_url().'asset/css/page_detail.css', "/modules/principal/css/principal.css");
		if ($this->agent->is_mobile()) {
 			$data['content'] = $_url == "41" ? 'view_page_mobile' : 'view_page_other';
 		} else {
 			$data['navbar'] = 'navbar_page';
 			$data['content'] = $_url == "41" ? 'view_page' : 'view_page_other';
 		}
		$data_page=$data["data_page"][0]["content"];
		$content = '';
		if (isset($matches[1])) {
 		    $content = trim(strip_tags($matches[1]));
 		}

		$data["seotitle"]=$data["data_page"][0]["title"]." - Trumecs.com";
		$data["seokeywords"] = "trumecs";
		$data["seodescription"] =$content;

		$this->load->view('front/template_front1', $data);
	}
}
