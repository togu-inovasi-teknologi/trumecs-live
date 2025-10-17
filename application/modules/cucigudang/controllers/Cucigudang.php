<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cucigudang extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("c_model");
    }
    function _remap($param) {
        $this->index($param);
    }

    
	public function index($url)
	{
			
		
		if (($url==NULL OR $url=="index")) {
			$data['content'] = 'view_index';
			$data["listcucigudang"]= $this->c_model->getall();

			$data["seotitle"]="Daftar Cuci Gudang Sparepart - Trumecs.com";
			$data["seokeywords"] = "jual sparepart truk, cucigudang sparepart,cucigudang";
			$data["seodescription"] = "dapatkan cucigudang sparepart truk di trumecs yang di jamin harganya sangat murah, coba deh cek di trumecs.com pasti cucigudangnya di bawah harga pasar.";
			
		}else{
			$data["datalist"]=$this->c_model->getcucigudang($this->uri->segment(2));
			$data["breadcrumb"]=  array( $data["datalist"]["cucigudang"][0]["name"]);
			$data["listproduct"]= $data["datalist"]["product"];
			$data['content'] = 'view_c';
			if (empty($data["datalist"])) {
				redirect(base_url()."cucigudang");
			}

			$file_exists = "public/image/cucigudang/".$data["datalist"]["cucigudang"][0]["img"];
	        if (!file_exists($file_exists)) {
	            $file_exists ="public/image/logonew.png";
	        }
			$data["seotitle"]="Daftar cucigudang Sparepart Truk ".$data["datalist"]["cucigudang"][0]["name"]." - Trumecs.com";
			$data["seokeywords"] = "jual sparepart truk, cucigudang sparepart,cucigudang";
			$data["seodescription"] = "dapatkan cucigudang sparepart truk di trumecs yang di jamin harganya sangat murah, coba deh cek di trumecs.com pasti cucigudangnya di bawah harga pasar.";
			$data["seoimage"] = $file_exists;
		}
		$data["css"] = array(base_url().'asset/css/cari_page.css',);
		$data["js"] = array(base_url()."asset/js/number/jquery.number.min.js",base_url().'asset/js/cari.js');
		//echo "string";
		$this->load->view('front/template_front1', $data);
	}

	

	
}
