<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cari extends MX_Controller
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model("cari_model");
	}
	function _remap($param)
	{
		$this->index($param);
	}
	public function index()
	{

		if (is_numeric(($this->input->get("merek")))) {
			$getnamecategoribrand = $this->cari_model->getnamecategori(($this->input->get("merek")));
			$brand = $getnamecategoribrand[0]["url"] . "/"; //preg_replace("/[^0-9a-zA-Z]+/", "-", $getnamecategoribrand[0]["url"])."/";
		} else {
			$brand = (empty($this->input->get("merek"))) ? "" : $this->input->get("merek") . "/";
		}
		if (!empty($this->input->get("tipe"))) {

			$type = $this->input->get("tipe");
		} else {
			$type = "";
		}
		/* if (is_numeric(($this->input->get("tipe")))){
			$getnamecategoritype = $this->cari_model->getnamecategori(($this->input->get("tipe")));
			$type = $getnamecategoritype[0]["url"]."/";//preg_replace("/[^0-9a-zA-Z]+/", "-", $getnamecategoritype[0]["url"])."/";
		}else{
			$type= (empty($this->input->get("tipe"))) ? "":$this->input->get("tipe")."/";
		} */
		if (is_numeric(($this->input->get("komponen"))) && $this->input->get("komponen") != 0) {
			$getnamecategoricomponent = $this->cari_model->getnamecategori(($this->input->get("komponen")));
			$component = $getnamecategoricomponent[0]["url"] . "/"; //preg_replace("/[^0-9a-zA-Z]+/","-", $getnamecategoricomponent[0]["url"])."/";
		} else if ($this->input->get("komponen") == 0) {
			$component = 'all/';
		} else {
			$component = (empty($this->input->get("komponen"))) ? "all/" : $this->input->get("komponen") . "/";
		}
		if (is_numeric(($this->input->get("sub_kategori"))) && $this->input->get("sub_kategori") != 0) {
			$getnamecategoricomponent = $this->cari_model->getnamecategori(($this->input->get("sub_kategori")));
			$subcat = $getnamecategoricomponent[0]["url"] . "/";
		} else {
			$subcat = (empty($this->input->get("sub_kategori"))) ? "" : $this->input->get("sub_kategori") . "/";
		}



		$name = "query?q=on&nama=" . $this->input->get("nama") . "&tipe=" . $type;
		$year = $this->input->get("tahun");
		$promo = $this->input->get("promo");


		$getview = $this->input->get("view");
		$session_data = $this->session->all_userdata();
		if (array_key_exists("layout", $session_data)) {
		} else {
			$view['view'] = "list";
			$this->session->set_userdata("layout", $view);
		}
		if ($getview == "box") {
			$view['view'] = "box";
			$this->session->set_userdata("layout", $view);
			redirect($_SERVER['HTTP_REFERER']);
		} else if ($getview == "list") {
			$view['view'] = "list";
			$this->session->set_userdata("layout", $view);
			redirect($_SERVER['HTTP_REFERER']);
		}


		redirect(base_url() . "c/" . $component . $subcat . $brand . $name);
	}

	public function all($query)
	{
	}
}
