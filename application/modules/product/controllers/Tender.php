<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tender extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("product_model");
        $this->load->language("tender");
        $this->load->language("form");
    }

    public function index()
    {

        $data["seotitle"] = $this->lang->line('seo_title_tender', FALSE) . " - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = $this->lang->line('seo_description_tender', FALSE);

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'tender';
        } else {
            $data['content'] = 'tender_mobile';
        }

        $this->load->view('front/template_front1', $data);
    }
}
