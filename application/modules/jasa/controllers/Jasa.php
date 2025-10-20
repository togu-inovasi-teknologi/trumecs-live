<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("home/home_model");
        $this->load->language("home");
        $this->load->model("article/article_model");
        $this->load->model("general/general_model");
        $this->load->model("c/c_model");
        $this->load->model("promo/promo_model");
        $this->load->language("partnership");
        $this->load->language("form");
    }

    public function index()
    {
        $data["datasearch"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datasearchor_like"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datawhere"] = array(
            'year' => '',
            'promo' => '',
            'cucigudang' => ''
        );
        $data["getcategory"] = $this->general_model->getcategori("0");
        $data["listpromo"] = $this->promo_model->getall();
        $data["newartikel"] = $this->article_model->getnewartikel();
        $data["getbrand"] = $this->general_model->getbrand();
        $data["slide"] = $this->home_model->gethome("slide");
        $data["headbottomslide"] = $this->home_model->gethome("headbottomslide");
        $data["headrightslide"] = $this->home_model->gethome("headrightslide");
        $data["headleftslide"] = $this->home_model->gethome("headleftslide");
        $data["infolinkhome"] = $this->home_model->getsetting("infolinkhome");
        $data["promobig"] = $this->home_model->gethome("promobig");
        $data["promo"] = $this->home_model->gethome("promo");
        $data["cucigudang"] = $this->home_model->gethome("cucigudang");
        $data["new"] = $this->home_model->gethome("new");
        $data["listproduct"] = $this->c_model->fetch_product(10, 0, $data['datasearch'], $data['datasearchor_like'], $data['datawhere'], true);

        $data["css"] = array(base_url() . 'asset/css/cari_page.css',);

        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/jasa_landing';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/desktop/landpage.css', base_url() . 'asset/css/template.css');
        } else {
            $data['content'] = 'mobile/jasa_landing';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/mobile/landpage.css', "/modules/jasa/css/mobile/jasa.css", base_url() . 'asset/css/template.css');
        }
        $this->load->view('front/template_front', $data);
    }
    public function page()
    {
        $data["getbrand"] = $this->general_model->getbrand();
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_jasa';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/desktop/landpage.css', base_url() . 'asset/css/template.css');
        } else {
            $data['content'] = 'mobile/view_jasa';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/mobile/landpage.css', "/modules/jasa/css/mobile/jasa.css", base_url() . 'asset/css/template.css');
        }
        $this->load->view('front/template_front', $data);
    }
}
