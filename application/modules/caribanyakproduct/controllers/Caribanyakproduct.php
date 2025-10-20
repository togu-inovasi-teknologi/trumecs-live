<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Caribanyakproduct extends MX_Controller
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model("c_model");
	}


	public function index()
	{
		$data["breadcrumb"] =  array();
		if (!$this->agent->is_mobile()) {
			$verticalpromo = $this->c_model->getsetting('prmvkl');
			$horisontalpromo = $this->c_model->getsetting('prmhtl');
			$data["promo_inseach_ver"] = $this->c_model->getpromo($verticalpromo[0]['value']);
			$data["promo_inseach_hor"] = $this->c_model->getpromo($horisontalpromo[0]['value']);
		}
		$data["seotitle"] = "Cari banyak produk- Trumecs.com";
		$data["seokeywords"] = "cari banyak sparepart ";
		$data["seodescription"] = "Bingung kan kalo kamu di suruh cari banyak sparepart sekaligus dalam satu waktu, coba deh cari sparepart di trumecs.com, pasti gampang!";

		$data["css"] = array(base_url() . 'asset/css/caribanyaksparepart.css',);
		$data["js"] = array(base_url() . "asset/js/number/jquery.number.min.js", base_url() . 'asset/js/cari.js', base_url() . 'asset/js/caribanyakproduk.js');
		$data['content'] = 'view_c';
		//echo "string";
		$this->load->view('front/template_front', $data);
	}


	public function getsearchingmoreproduct()
	{
		$data = $this->input->post("data");
		$limit =  ($this->input->post("limit") > 0) ? abs($this->input->post("limit")) : abs($this->input->post("limit"));;
		$variable = array();
		$col = "";
		$name = "";
		$i = 0;
		foreach ($data as $key => $value) {
			if ($i % 2 == 0) {
				$col = ($value["value"]);
			} else {
				$name = ($value["value"]);
				$aa = array($col => $name);
				array_push($variable, $aa);
			}
			$i++;
		}
		/*echo "<pre>";
		var_dump($variable);
		echo "</pre>";*/
		#var_dump($variable);

		$data["hasil"] = $this->c_model->getproductcaribanyak($variable, $limit);
		/*echo "<pre>";
		var_dump($hasil);
		echo "</pre>";*/

		$this->load->view('_hasilajax', $data);
	}
}
