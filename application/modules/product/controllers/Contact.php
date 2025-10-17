<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("product_model");
    }

    function _remap($param)
    {
        $this->index($param);
    }
    public function index($url = null)
    {

        //$data["data_product"]=$this->product_model->getproduct($url);
        /* if (empty($data["data_product"])) {
            redirect(base_url());
        } */

        /* $productgalery=$data["data_product"][0]["id"];
        $data["galeryimg"]= $this->product_model->getgalery($productgalery);

        $namebrand=$this->getcategory($data["data_product"][0]["brand"]);
        $nametype=$this->getcategory($data["data_product"][0]["type"]);
        $namecomponent=$this->getcategory($data["data_product"][0]["component"]);

        $stringtitle = $data["data_product"][0]["tittle"];
        $stringtitle.= ($namebrand!="") ? " Merek ".$namebrand : "" ;
        $stringtitle.= ($nametype!="") ? " Type ".$nametype : "" ;
        $stringtitle.= ($namecomponent!="") ? " Komponen ".$namecomponent : "" ; */


        /* $str_keyword = $data["data_product"][0]["tittle"];
        $str_keyword.= ($namebrand!="") ? ", ".$namebrand : "" ;
        $str_keyword.= ($nametype!="") ? ", ".$nametype : "" ;
        $str_keyword.= ($namecomponent!="") ? ", ".$namecomponent : "" ;

        $seo_desunit=($data["data_product"][0]["unit"]!="") ? " per ".strtolower($data["data_product"][0]["unit"]) : '';
        $seo_desstok=($data["data_product"][0]["stock"]!=0) ? ", tersedia ".$data["data_product"][0]["stock"]." stok barang" : '';

        $file_exists = "public/image/product/".$data["data_product"][0]["img"];
        if (!file_exists($file_exists)) {
            $file_exists ="public/image/logonew.png";
        } */


        $data["seotitle"] = "Konsultasi Sparepart & Mekanikal - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk, pelumas, alat berat";
        /* $data["seodescription"] = "Sparepart ".strtolower($stringtitle)." di jual dengan harga murah Rp.".number_format($data["data_product"][0]["price"]).$seo_desunit.$seo_desstok."."; */
        $data["seodescription"] = "Konsultasi sparepart dan alat mekanikal terpercaya di Indonesia.";
        /* $data["seoimage"] = $file_exists; */
        $data["seoimage"] = "public/image/logonew.png";


        /* $data["breadcrumb"]=  array($namebrand ,$nametype,$namecomponent ); */
        $data["breadcrumb"] =  array();

        /* $data["namecategori"] = array(
            'brand' => $namebrand ,
            "type"=>$nametype,
            "component"=>$namecomponent
            );
        $arrayname= explode(" ", $data["data_product"][0]["tittle"]);
        $data["sameproduct"]=$this->product_model->getsameproduct($arrayname,$productgalery); */

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'contact';
        } else {
            $data['content'] = 'contact_mobile';
        }


        //echo "string";
        $this->load->view('front/template_front1', $data);
    }
    private function getcategory($id)
    {
        $CATEGORY_ALL = unserialize(CATEGORY_ALL);
        $id_array =  array_search($id, array_column($CATEGORY_ALL, 'id')); //array_search($id, CATEGORY_ALL);
        return ($CATEGORY_ALL[$id_array]["name"]);
    }
}
