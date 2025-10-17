<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mechanic extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("general/General_model", 'M_general');
        $this->load->model("mechanic/Mechanic_model", 'Mechanic_model');
        $this->load->model("category/Category_model", 'Category_model');
    }

    public function index()
    {
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 1]);
        $idKategori = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idKategori, "etc" => 1]);
        $data['mechanic'] = $this->Category_model->getProductsInCategoryTree($idKategori);
        $data["css"] = array("/modules/mechanic/css/mechanic.css");
        $data["js"] = array("/modules/mechanic/js/mechanic.js");
        $data["seotitle"] = $this->lang->line('seo_title', FALSE) . "Tru Expert: Solusi kebutuhan tenaga ahli mekanikal, driver & operator " .' | Trumecs';
        $data["seokeywords"] = "TruEx, Expert, Tenaga Ahli, Mekanik, Driver, Operator";
        $data["seodescription"] = sprintf($this->lang->line('seo_description', FALSE), "Tru Expert: Solusi kebutuhan tenaga ahli mekanikal. Mekanik alat berat, driver & operator alat berat");
        //$data["seoimage"] = $file_exists;
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/page-mechanic';
        } else {
            $data['content'] = 'mobile/page-mechanic';
        }
        $this->load->view('front/template_front1', $data);
    }


    public function detail($id)
    {
        $data['mechanic'] = $this->Mechanic_model->getMechanic($id);
        $data['mechanic_variant'] = $this->Mechanic_model->getProductVariants($id);
        $dataMechanicExp = $this->Mechanic_model->getExpertExperience($id);
        foreach ($dataMechanicExp as &$exp) {
            $exp['positions'] = explode('|', $exp['positions']);
            $exp['descriptions'] = explode('|', $exp['descriptions']);
        }
        $data['mechanic_exp'] = $dataMechanicExp;
        $data['mechanic_service_expertise'] = $this->Mechanic_model->getServiceExpertise($id);
        $data['mechanic_file'] = $this->Mechanic_model->getProductFile($id);
        $data['mechanic_gallery'] = $this->Mechanic_model->getGalleryExpert($id);
        $data["css"] = array("/modules/mechanic/css/mechanic.css");
        $data["js"] = array("/modules/mechanic/js/mechanic.js");
        
        $length = array();
        $names = explode(' ', $data['mechanic'][0]['tittle']);
        foreach($names as $key => $value):
            $replacement = str_repeat('*', strlen($value) - 2);
            $names[$key] = substr_replace($value, $replacement, 1, -1);
        endforeach;
        $name = implode(' ', $names);
        
        $data["seotitle"] = $this->lang->line('seo_title', FALSE) . $data['mechanic'][0]['nama_kategori'] . ' ' . $data['mechanic'][0]['nama_grade'] . ': ' .$name .' | TruExpert';
        $data["seokeywords"] = "TruEx, Expert, Tenaga Ahli, Mekanik, Driver, Operator";
        $mvs = "";
        foreach($data['mechanic_variant'] as $key=>$mv){
            if($key == 0){
                $mvs .= $mv['name'];
            } else {
                $mvs .= ', '.$mv['name'];
            }
        }
        $data["seodescription"] = $this->lang->line('seo_description', FALSE) . $data['mechanic'][0]['nama_kategori'] . ' ' . $data['mechanic'][0]['nama_grade'] . ': ' .$name.". Domisili: " .$data['mechanic'][0]['nama_domisili'] .'. Periode: '. $mvs ;
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/detail-mechanic';
        } else {
            $data['content'] = 'mobile/detail-mechanic';
        }
        $this->load->view('front/template_front1', $data);
    }
}