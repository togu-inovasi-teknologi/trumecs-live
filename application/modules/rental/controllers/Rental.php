<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rental extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("home/home_model");
        $this->load->language("home");
        $this->load->model("article/article_model");
        $this->load->model("general/general_model", "M_general");
        $this->load->model("category/Category_model", 'Category_model');
        $this->load->model("rental/Rental_model", 'Rental_model');
        $this->load->model("product/Product_model", 'Product_model');
        $this->load->model("c/c_model");
        $this->load->language("partnership");
        $this->load->language("form");
    }

    public function index()
    {
        // $data["datasearch"] = array(
        //     'tittle' => '',
        //     'partnumber' => '',
        //     'physicnumber' => ''
        // );
        // $data["datasearchor_like"] = array(
        //     'tittle' => '',
        //     'partnumber' => '',
        //     'physicnumber' => ''
        // );
        // $data["datawhere"] = array(
        //     'year' => '',
        //     'promo' => '',
        //     'cucigudang' => ''
        // );
        // $data["getbrand"] = $this->general_model->getbrand();
        // $data["new"] = $this->home_model->gethome("new");
        // $data["listproduct"] = $this->c_model->fetch_product(10, 0, $data['datasearch'], $data['datasearchor_like'], $data['datawhere'], true);
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 2]);
        $idKategori = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idKategori, "etc" => 2]);
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/rental-landing';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/rental/css/desktop/rental.css');
        } else {
            $data['content'] = 'mobile/rental-landing';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/mobile/rental.css', "/modules/rental/css/mobile/rental.css");
        }
        $this->load->view('front/template_front1', $data);
    }

    public function list($url)
    {
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 2]);
        $idParent = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idParent, "etc" => 2]);
        $idSub = $this->M_general->getcategori(["url" => $url, "etc" => 2]);
        $idSubKategori = $idSub[0]['id'];
        $data['rental'] = $this->Rental_model->getRental($idSubKategori);
        $data["relatedarticle"] = $this->article_model->getsameartikel(trim($idSub[0]['name']));
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view-rental';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/rental/css/desktop/rental.css');
        } else {
            $data['content'] = 'mobile/view-rental';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/mobile/rental.css', "/modules/rental/css/mobile/rental.css");
        }
        $this->load->view('front/template_front1', $data);
    }

    public function detail($id)
    {

        $data["galeryimg"] = $this->Product_model->getgalery($id);
        $rental_detail = $this->Rental_model->getRentalDetail($id);
        $kategori = $rental_detail[0]['jenisproduct'];
        $idSub = $this->M_general->getcategori(["url" => $kategori, "etc" => 2]);
        $idSubKategori = $idSub[0]['id'];
        $data['rental'] = $this->Rental_model->getRental($idSubKategori);
        $attributes = [];

        foreach ($rental_detail as $rd) {
            $attributes[] = [
                'name' => $rd['nama_attribute'],
                'value' => $rd['nilai_attribute'],
            ];
        }
        $data['rental_detail'] = $rental_detail;
        $data['attribute'] = $attributes;
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/detail-rental';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/rental/css/desktop/rental.css');
        } else {
            $data['content'] = 'mobile/detail-rental';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/mobile/rental.css', "/modules/rental/css/mobile/rental.css");
        }
        $this->load->view('front/template_front1', $data);
    }

    public function page()
    {

        $data["getbrand"] = $this->general_model->getbrand();

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/rental_landing';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/rental/css/desktop/rental.css');
        } else {
            $data['content'] = 'mobile/rental_landing';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/rental/js/rental.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', '/modules/home/css/mobile/rental.css', "/modules/rental/css/mobile/rental.css");
        }
        $this->load->view('front/template_front1', $data);
    }
}