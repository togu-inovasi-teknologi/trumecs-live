<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends MX_Controller
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model("promo_model");
		$this->load->language("promo");
	}
	function _remap($param)
	{
		if (($param == "pertamina")) {
			$this->pertamina();
		} else if (($param == "dokumen")) {
			$this->dokumen();
		} else if (($param == "bazaar")) {
			$this->bazaar();
		} else {
			$this->index($param);
		}
	}


	public function index($url)
	{


		if (($url == NULL or $url == "index")) {
			if (!$this->agent->is_mobile()) {
				$data['content'] = '/desktop/view_index';
			} else {
				$data['content'] = '/mobile/view_index';
			}
			$data["listpromo"] = $this->promo_model->getall();
			$data["seotitle"] = $this->lang->line("seo_title_promo") . " - Trumecs.com";
			$data["seokeywords"] = "jual sparepart truk, promo sparepart,promo";
			$data["seodescription"] = $this->lang->line("seo_description_promo");
			$data["datalist"] = $this->promo_model->getpromo(0);
			$data["listproduct"] = $data["datalist"]["product"];
		} else {
			$data["datalist"] = $this->promo_model->getpromo($this->uri->segment(2));
			$data["breadcrumb"] =  array($data["datalist"]["promo"][0]["name"]);
			$data["listproduct"] = $data["datalist"]["product"];
			if ($this->agent->is_mobile()) {
				$data['content'] = '/mobile/view_c_mobile';
			} else {
				$data['content'] = '/desktop/view_c';
			}

			if (empty($data["datalist"])) {
				redirect(base_url() . "promo");
			}

			$file_exists = "public/image/promo/" . $data["datalist"]["promo"][0]["img"];
			if (!file_exists($file_exists)) {
				$file_exists = "public/image/logonew.png";
			}
			$data["seotitle"] = "Daftar promo Sparepart Truk " . $data["datalist"]["promo"][0]["name"] . " - Trumecs.com";
			$data["seokeywords"] = "jual sparepart truk, promo sparepart,promo";
			$data["seodescription"] = "dapatkan promo sparepart truk di trumecs yang di jamin harganya sangat murah, coba deh cek di trumecs.com pasti promonya di bawah harga pasar.";
			$data["seoimage"] = $file_exists;
		}
		$data["css"] = array(base_url() . 'asset/css/cari_page.css',);
		$data["js"] = array(base_url() . "asset/js/number/jquery.number.min.js", base_url() . 'asset/js/cari.js', "/modules/promo/js/promo.js");
		$data['category'] = $this->promo_model->get_category();
		//echo "string";
		$this->load->view('front/template_front', $data);
	}

	public function pertamina()
	{
		$this->load->model("product/m_polling");
		$data['participant'] = array(
			'session_id' => session_id(),
			//'email' => $post['email'],
			//'phone' => $post['phone'],
			//'feedback' => $post['feedback'],
			'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
			'ga' => $this->input->cookie('_ga'),
			'id_polling' => 7,
			'created' => time()
		);
		//$data['id_polling'] = 1;
		//$data['answer'] = $post['answer'];
		if ($this->m_polling->check_session($data)) {
			$this->m_polling->saveanswer($data);
		}

		if (!$this->agent->is_mobile()) {
			$data['content'] = '/desktop/promo_pertamina';
		} else {
			$data['content'] = '/mobile/promo_pertamina';
		}
		$data["seotitle"] = "Promo Pelumas Pertamina - Trumecs.com";
		$data["seodescription"] = "Promo THR Instan Rp 1.000.000 pelumas Pertamina bagi pelanggan baru Trumecs.com";

		$data["js"] = array("/modules/promo/js/promo.js");
		$this->load->view('front/template_front', $data);
	}

	public function dokumen()
	{
		$this->load->model("product/m_polling");

		$num = $this->db->get('quotation');
		$num = $num->num_rows();

		$data = $this->input->post();
		$data['number'] = ($num - 6) . "/PQL/TMP/" . date("d") . "/2024";
		$this->promo_model->add_sph($data);
		$this->load->view('sph', array('data' => $data));
		$html = $this->load->view('sph', null, true);
		$this->load->helper("file");
		$this->load->library("pdf");
		$this->pdf->create($html, "SPH Promo Trumecs " . $data['number']);
	}

	public function bazaar()
	{
		$this->load->model("product/m_polling");

		$num = $this->db->get('quotation');
		$num = $num->num_rows();

		$data = $this->input->post();
		$data['number'] = ($num - 6) . "/BAZ/TMP/" . date("d") . "/2025";
		$this->promo_model->add_sph($data);
		/*$this->load->view('sph', array('data' => $data));
	    $html = $this->load->view('sph', null, true);
	    $this->load->helper("file");
        $this->load->library("pdf");
        $this->pdf->create($html, "SPH Promo Trumecs ".$data['number']);*/
		$this->load->helper('download');
		force_download('public/filequotation/TRUMECSBAZAAR25.pdf', NULL);
	}
}
