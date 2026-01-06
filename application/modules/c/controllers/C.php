<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C extends MX_Controller
{

	private $stringtitle = "";
	private $str_keyword = "";
	private $data = array();
	private	$name = "";
	private	$brand = "";
	private	$quality = "";
	private	$type = "";
	private	$component = "";
	private	$subcat = "";
	private	$year = "";
	private	$promo = "";
	private	$cucigudang = "";
	private	$namebrand = "";
	private	$nametype = "";
	private	$namecomponent = "";
	private	$categori;
	private	$array_url;

	function __construct()
	{
		// Call the Model constructor

		parent::__construct();
		$this->load->model("c_model");
		$this->load->language("search");
	}
	function _remap($param)
	{

		$this->init($param);
	}

	function check_type()
	{
		$this->array_url = $this->uri->segment_array();
	}

	function set_copy()
	{
		for ($i = 1; $i < count($this->array_url) + 1; $i++) {
			if ($i == 1) {
				$this->name = $this->input->get("nama");
				$this->data["tittle_content"] = $this->name;
				$this->data["querysearch"] = $this->name;
			} else {
				$categori = $this->c_model->getidcategori($this->array_url[$i]);
				if (count($categori) > 0) {
					if ($categori[0]["parent"] == "0" && $categori[0]["is_brand"] == 1) {
						$this->brand = $categori[0]["id"];
						$this->data["idbrand"] = $this->brand;
					}
					if ($categori[0]["parent"] >= 1 && $categori[0]["is_brand"] == 0) {
						// Ini adalah sub kategori atau sub-sub kategori
						$this->type = $categori[0]["id"];
						$this->data["idsub"] = $this->type; // Simpan ID sub kategori

						// Cek apakah ini sub kategori langsung dari parent
						if ($this->c_model->is_direct_subcategory($categori[0]["id"], $this->component)) {
							$this->subcat = $categori[0]["id"];
						}
					}
					if ($categori[0]["parent"] == "0" && $categori[0]["is_brand"] == 0) {
						$this->component = $categori[0]["id"];
						$this->component_type = "component";
						$this->data["idcomponent"] = $this->component;
					}
					if ($categori[0]["parent"] == "top") {
						$this->component = $categori[0]["id"];
						$this->component_type = "part";
						$this->data["idcomponent"] = $this->component;
					}
					$this->data["tittle_content"] = $categori[0]["name"];
					$this->data["description_content"] = $categori[0]["name"];
				}
			}
			if ($i == count($this->array_url)) {
				$name = $this->input->get("nama");
				$this->quality = $this->input->get("quality");
				$this->data["tittle_content"] = $this->name;
				$this->data["querysearch"] = $this->name;
			}
		}

		$this->year = $this->input->get("tahun");
		$this->type = $this->input->get("tipe");
		$this->promo = $this->input->get("promo");
		$this->cucigudang = $this->input->get("cucigudang");

		// Ambil sub kategori dari parameter GET jika ada
		if ($this->input->get("sub_kategori")) {
			$this->subcat = $this->input->get("sub_kategori");
			$this->data["idsub"] = $this->subcat;
		}
	}

	function set_ad()
	{
		if (!$this->agent->is_mobile()) {
			$verticalpromo = $this->c_model->getsetting('prmvkl');

			$this->data["promo_inseach_ver"] = $this->c_model->getpromo($verticalpromo[0]['value']);
		}
		$horisontalpromo = $this->c_model->getsetting('prmhtl');
		$this->data["promo_inseach_hor"] = $this->c_model->getpromo($horisontalpromo[0]['value']);
	}

	public function init()
	{
		// var_dump($this->uri->segment(1));
		// die;

		$this->data["idcomponent"] = "";
		$this->data["idsub"] = "";
		$this->data["idtype"] = "";
		$this->data["idbrand"] = "";
		$this->data["idquality"] = "";
		$this->data['category'] = $this->c_model->get_category();

		if ($this->uri->segment(1) == "c" || $this->uri->segment(1) == "cari") {


			$this->check_type(); /* Pencarian all */

			$this->set_copy();

			$this->set_ad();

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

			$ses = $this->session->all_userdata();
			$idmember = !empty($ses["member"]["idmember"]) ? $ses["member"]["idmember"] : "";

			$this->data["datasearch"] = array(
				'tittle' => $this->name,
				'partnumber' => $this->name,
				'physicnumber' => $this->name
			);

			$this->data["datasearchor_like"] = array(
				'tittle' => $this->name,
				'partnumber' => $this->name,
				'physicnumber' => $this->name
			);

			$this->data["datawhere"] = array(
				'year' => $this->year,
				'promo' => $this->promo,
				'cucigudang' => $this->cucigudang,
			);

			//echo "asd" . $this->component . "svb";

			if ($this->brand != "") {
				$this->data["datawhere"] = array_merge($this->data["datawhere"], array('brand' => $this->brand));
			}



			if ($this->component != "") {
				$this->data["datawhere"] = array_merge(
					$this->data["datawhere"],
					array(
						'component' => $this->component,
						'component_type' => $this->component_type
					)
				);
			}

			// Tambahkan sub kategori jika ada
			if ($this->subcat != "") {
				$this->data["datawhere"] = array_merge(
					$this->data["datawhere"],
					array('sub_category' => $this->subcat)
				);
			}

			if ($this->type != "") {
				$this->data["datawhere"] = array_merge(
					$this->data["datawhere"],
					array('tipe' => $this->type)
				);
			}

			if ($this->quality != "") {
				$this->data["datawhere"] = array_merge(
					$this->data["datawhere"],
					array('quality' => $this->quality)
				);
			}

			if ($this->input->get("minp") != "") {
				$_isnull = ($this->input->get("minp") != "0") ? $this->input->get("minp")  : 1;
				$this->data["datasearch"] = array_merge($this->data["datasearch"], array('minp' => str_replace(",", "", (!empty($this->input->get("minp"))) ? $_isnull : 1)));
			}
			if ($this->input->get("maxp") != "") {
				$this->data["datasearch"] = array_merge($this->data["datasearch"], array('maxp' => str_replace(",", "", (!empty($this->input->get("maxp"))) ? $this->input->get("maxp") : 1000000000)));
			}




			$namebrand = $this->c_model->getnamecategori($this->brand);
			$this->namebrand = empty($namebrand) ? "" : $namebrand[0]["name"];
			//echo $this->namebrand;

			$nametype = $this->c_model->getnamecategori($this->type);
			$this->nametype = empty($nametype) ? "" : $nametype[0]["name"];

			$namecomponent = $this->c_model->getnamecategori($this->component);
			$this->namecomponent = empty($namecomponent) ? "" : $namecomponent[0]["name"];

			$namequality = $this->c_model->getnamequality($this->quality);
			$this->namequality = empty($namequality) ? "" : $namequality[0]["grade"];

			$slestype = !empty($this->nametype) ? "/" : "";

			$sleskomponen = !empty($this->namecomponent) ? "/" : "";

			$this->data["dataurl"] = array(
				'brand' => (empty($this->namebrand)) ? '' : '<a itemprop="item" class="forange" class="forange" href="' . base_url() . 'c/' . str_replace(" ", "-", $this->namebrand) . '"><span class="serif" itemprop="name">' . $this->namebrand . '</span></a>',
				'type' => (empty($this->nametype)) ? '' : '<a itemprop="item" class="forange" href="' . base_url() . 'c/' . str_replace(" ", "-", $this->namebrand) . $slestype . str_replace(" ", "-", $this->nametype) . '"><span class="serif" itemprop="name">' . $this->nametype . '</span></a>',
				'component' => (empty($this->namecomponent)) ? '' : '<a itemprop="item" class="forange" href="' . base_url() . 'c/' . str_replace(" ", "-", $this->namebrand) . $slestype . str_replace(" ", "-", $this->nametype) . $sleskomponen . str_replace(" ", "-", $this->namecomponent) . '"><span class="serif" itemprop="name">' . $this->namecomponent . '</span></a>',
				'tittle' => $this->name
			);

			$this->data["breadcrumb"] =  array($this->namebrand, $this->nametype, $this->namecomponent);


			/* if($this->array_url[2]=='all') {
				$this->_search_all();
			} else { */
			$this->_search_component();
			/* }; */


			$this->data["links"] = $this->pagination->create_links();
		} elseif ($this->uri->segment(2) == "") {

			redirect(base_url());
		}



		$this->stringtitle = "Daftar harga ";
		$this->stringtitle .= ($this->namecomponent != "") ? $this->namecomponent . " " : "";
		$this->stringtitle .= ($this->nametype != "") ? $this->nametype . " " : "";
		$this->stringtitle .= ($this->namebrand != "") ? $this->namebrand . " " : "";
		$this->stringtitle .= ($this->namequality != "") ? $this->namequality . " " : "";


		$this->stringtitle .= ($this->name != "") ? $this->name . " " : "";


		$this->str_keyword = ($this->namebrand != "") ? ", " . $this->namebrand : "";
		$this->str_keyword .= ($this->nametype != "") ? ", " . $this->nametype : "";
		$this->str_keyword .= ($this->namecomponent != "") ? ", " . $this->namecomponent : "";


		$this->view();
	}

	private function _search_component()
	{
		$config = array();
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$search_perpage = strpos($actual_link, "&per_page");
		$search_perpage = strpos($actual_link, "?per_page");
		$actual_link = preg_replace("/&per_page\=[0-9]+/", "", $actual_link); //substr($actual_link, 0,($search_perpage!=0) ? $search_perpage : strlen($actual_link) );

		$config["base_url"] = $actual_link; //base_url() . "cari?nama=".$name."&merek=".$brand."&tipe=".$type."&komponen=".$component."&tahun=".$year."&promo=".$promo."";
		$config["total_rows"] = $this->c_model->record_count($this->data["datasearch"], $this->data["datasearchor_like"], $this->data["datawhere"]);
		$config["per_page"] =  24;
		$config["uri_segment"] = $this->input->get("per_page");
		$config["cur_tag_open"] = '<div class="btn btnnewwhite btn-disable">';
		$config["cur_tag_close"] = '</div>';
		$config["first_tag_open"] = '<div class="pull-left">';
		$config["first_tag_close"] = '</div>';
		$config["last_tag_open"] = '<div class="pull-right">';
		$config["last_tag_close"] = '</div>';
		$config['attributes'] = array('class' => 'btn btnnew link search-pagination');
		$config['enable_query_strings'] = true;
		$config['page_query_string'] = true;

		$this->pagination->initialize($config);
		$page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;

		$this->data["listproduct"] = $this->c_model->fetch_product($config["per_page"], $page, $this->data["datasearch"], $this->data["datasearchor_like"], $this->data["datawhere"]);

		$newarray = array();

		if (!empty($this->data["listproduct"])) {
			foreach ($this->data["listproduct"] as $key) {
				if ($key["status"] == "show") {
					$newarray[] = array(
						'id' => $key["id"],
						'tittle' => $key["tittle"],
						'partnumber' => $key["partnumber"],
						'quality' => $key["quality"],
						'stock' => $key["stock"],
						'moq' => $key["moq"],
						'promo' => $key["promo"],
						// 'tipe' => $key["tipe"],
						'unit' => $key["unit"],
						'price' => $key["price"],
						'price_promo' => $key["price_promo"],
						'price_bigsale' => $key["price_bigsale"],
						'img' => $key["img"]
					);
				}
				$this->data["listproduct"] = $newarray;
			}
		}
		$this->data['view_product'] = "_listproduct";
	}

	private function _search_all()
	{
		$this->data["listproduct"] = $this->c_model->fetch_product_by_cat(4, 0, $this->data["datasearch"], $this->data["datasearchor_like"], $this->data["datawhere"]);
		$this->data['view_product'] = "_listproduct_all";
	}

	public function view()
	{
		$this->data["quality"] = $this->quality;
		$this->data["seotitle"] = "Jual " . $this->stringtitle . " - Trumecs.com";
		$this->data["seokeywords"] = "jual sparepart truk, daftar sparepart " . $this->str_keyword;
		$this->data["seodescription"] = "Berikut adalah daftar sparepart truk" . $this->stringtitle . " terlengkap. Trumecs jual sparepart" . $this->stringtitle . " sangat murah";

		$this->data["css"] = array(base_url() . 'asset/css/cari_page.css');
		$this->data["js"] = array(base_url() . "asset/js/number/jquery.number.min.js", base_url() . 'asset/js/cari.js');
		$this->data['content'] = 'view_c';

		$this->load->view('front/template_front', $this->data);
	}
}
