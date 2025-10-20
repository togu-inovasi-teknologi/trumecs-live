<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("cart_model");
		$this->load->model("backendprospek/M_Prospek");
		$this->load->library("member_return");
		$this->load->language("cart");
	}

	public function index()
	{
		$this->load->language("form");

		$data["seotitle"] =  $this->lang->line("seo_title_cart", FALSE) . " - Trumecs.com";
		$data["seokeywords"] = "jual sparepart truk, promo sparepart,login";
		$data["seodescription"] = $this->lang->line("seo_description_cart", FALSE);

		$session = $this->session->all_userdata();
		$sessionmember = array_key_exists("member", $session) ? $session["member"] : array(
			"name" => "",
			"phone" => "",
			"position" => "",
			"company_email" => "",
			"company_phone" => "",
			"email" => "",
			"Company" => "",
			"provice" => "",
			"city" => "",
			"districts" => "",
			"address" => "",
		);
		$data['provinsi'] = $this->M_Prospek->get_provinsi();
		$data['regency'] = $this->M_Prospek->get_regency($sessionmember["provice"]);
		$data['district'] = $this->M_Prospek->get_district($sessionmember["city"]);
		$data["css"] = array(base_url() . "asset/css/cart_page.css");
		$data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/cart_page.js", base_url() . "asset/js/prospek.js",);
		$data['content'] = 'cart_page';
		$data['user_data'] = array(
			'nama' => $sessionmember["name"],
			'posisi' => "",
			'phone' => $sessionmember["phone"],
			'email' => $sessionmember["email"],
			'position' => $sessionmember["position"],
			'company_email' => $sessionmember["company_email"],
			'company_phone' => $sessionmember["company_phone"],
			'company' => $sessionmember["Company"],
			'provinsi' => $sessionmember["provice"],
			'kota' => $sessionmember["city"],
			'kecamatan' => $sessionmember["districts"],
			'alamat' => $sessionmember["address"],
		);
		$this->load->view('front/template_front', $data);
	}


	public function addproduct()
	{
		$type = $this->input->post('source_type');
		$this->form_validation->set_rules('idproduct', 'Idproduct', 'required');
		$this->form_validation->set_rules('value', 'Value', 'required');
		if ($this->form_validation->run() == FALSE) {
			redirect(base_url());
		} else {
			$data["product"] = $this->cart_model->getproduct($this->input->post('idproduct'));
			foreach ($data["product"] as $product) {
				$harga = ($product["price"]);
				if ($product["price_promo"] != "0") {
					$harga = $product["price_promo"];
				}
				if ($this->input->post('method') == 'cbd') {
					$harga = $harga - ($product['promo_cbd_price'] * $product['price'] / 100);
				}
				if ($this->input->post('value') >= $product['promo_volume']) {
					$harga = $harga - ($product['promo_volume_price'] * $product['price'] / 100);
				}
				if ($this->session->userdata('referral_code') != '') {
					$harga = $harga - ($product['promo_referral_price'] * $product['price'] / 100);
				}
			}

			$array_true = array();
			for ($moq = $product["moq"]; $moq <= $product["stock"]; $moq += $product["moq"]) {
				array_push($array_true, $moq);
			}

			if (in_array($this->input->post('value'), $array_true)) {
				//$this->cart_model->insertorderdetail($data["orderdetail"]);					
				$this->session->set_flashdata('message', 'Pesanan ditambah.');
				$data = array(
					'id'      => $this->input->post('idproduct'),
					'qty'     => $this->input->post('value'),
					'method'     => $this->input->post('method'),
					'price'   => $harga,
					'name'    => preg_replace("/[^a-zA-Z0-9]/", " ", $product["tittle"]),
					'moq'    => $product["moq"],
					'stock'    => $product["stock"],
					'partnumber_product'    => $product["partnumber"],
					'px'    => $product["px"],
					'py'    => $product["py"],
					'pz'    => $product["pz"],
					'sx'    => $product["sx"],
					'sy'    => $product["sy"],
					'sz'    => $product["sz"],
					'weight'    => $product["weight"],
					'warranty'    => $product["warranty"],
					'unit'    => $product["unit"],
					'ppn'    => $product["ppn"],
					'estimated_delivery'    => $product["estimated_delivery"]
				);
				$this->cart->insert($data);
				if ($type == 'json') {
					$this->session->set_flashdata('message', $data['name'] . ' berhasil ditambahkan ke keranjang.');
					redirect(base_url('product/' . $data['id'] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($data["name"])))));
				} else {
					redirect(base_url() . "cart");
				}
			} else {
				$this->session->set_flashdata('message', 'Pesanan tidak ditambah.');
				redirect(base_url() . "cart");
			}
		}
	}

	public function update()
	{
		$this->form_validation->set_rules('rowid', 'Rowid', 'required');
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('qty', 'Qty', 'required');
		if ($this->form_validation->run() == FALSE) {
		} else {
			$data["product"] = $this->cart_model->getproduct($this->input->post('id'));
			foreach ($data["product"] as $product) {
				$harga = ($product["price"]);
				if ($product["price_promo"] != "0") {
					$harga = $product["price_promo"];
				}
				if ($this->input->post('method') == 'cbd') {
					$harga = $harga - ($product['promo_cbd_price'] * $product['price'] / 100);
				}
				if ($this->input->post('qty') >= $product['promo_volume']) {
					$harga = $harga - ($product['promo_volume_price'] * $product['price'] / 100);
				}
				if ($this->session->userdata('referral_code') != '') {
					$harga = $harga - ($product['promo_referral_price'] * $product['price'] / 100);
				}
			}

			$update = array(
				'rowid' => $this->input->post('rowid'),
				'id' => $this->input->post('id'),
				'method' => $this->input->post('method'),
				'qty'   => $this->input->post('qty'),
				'price' => $harga
			);

			$this->cart->update($update);
			$this->session->set_flashdata('message', 'Keranjang diperbarui.');
		}
	}

	public function shipping()
	{

		/*if (count($this->cart->contents())==0) {
			redirect(base_url()."cart");
		}*/
		//$this->securitylog->cekloginmember();

		$session = $this->session->all_userdata();
		//var_dump($session);
		//$sessionmember= $session["member"];
		$arraynone = array('shipping_method' => "", 'shipping_province' => "", "shipping_city" => "");
		/*if (in_array("", array_diff_assoc($sessionmember, $arraynone))){
		 	$this->session->set_flashdata('message', 'Anda harus melengkapi Akun untuk berbelanja di trumecs.com');
		 	redirect(base_url()."member/setting");
		}*/
		$province = "-";
		$city = "-";
		$shipping_cost = "0";
		$address = "-";
		$kodepos = "-";

		$data["datauser"] = array(
			'shipping_name' =>  "",
			'shipping_company' =>  "",
			'shipping_idprovince' => $city,
			'shipping_city' => $city,
			'shipping_idcity' => $city,
			'shipping_iddistrict' => $city,
			'shipping_idvillage' => $city,
			'shipping_address' => $address,
			'shipping_kodepos' => $kodepos,
			'shipping_phone' => $this->input->post("phone"),
			'shipping_cost' => $shipping_cost,
			'shipping_description' => "pickup"
		);
		//$this->model_shipping->update($data["datauser"],$chart);
		if (array_key_exists('member', $session)) {
			$sessionmember = $session["member"];
			if ($sessionmember['id'] != "") {
				$data["address_shipping"] = $this->member_return->address_shipping();
				$this->session->set_userdata("datashipping", $data["address_shipping"]);
			} else {
				$data["address_shipping"] = $data["datauser"];
			}
		} else {
			$data["address_shipping"] = $data["datauser"];
			$this->session->set_userdata("datashipping", $data["datauser"]);

			$sessionmember = array_key_exists("member", $session) ? $session["member"] : array(
				"id" => "",
				"name" => "",
				"phone" => "",
				"position" => "",
				"company_email" => "",
				"company_phone" => "",
				"email" => "",
				"Company" => "",
				"provice" => "",
				"city" => "",
				"districts" => "",
				"address" => "",
			);

			$sessionmember = array_merge($sessionmember, $data["datauser"]);

			$this->session->set_userdata("member", $sessionmember);
		}

		$data["provinces"] = $this->cart_model->getprovinces();
		$data["css"] = array(base_url() . "asset/css/cart_page.css");
		$data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/cart_page.js");
		$data['content'] = 'shipping_page_new';
		//echo "string";
		$this->load->view('front/template_front', $data);
	}

	public function setshipping()
	{
		/*if (count($this->cart->contents())==0) {
			redirect(base_url()."cart");
		}*/
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('method', 'Method', 'required');
		$method = $this->input->post("method");
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Lengkapi data yang bertanda <sup>*</sup>.');
			redirect(base_url() . "shipping");
		} else {
			$ses = $this->session->all_userdata();
			$bname = !empty($ses["member"]["name"]) ? $ses["member"]["name"] : "";
			$bcompany = !empty($ses["member"]["Company"]) ? $ses["member"]["Company"] : "";
			$bprovice = !empty($ses["member"]["provice"]) ? $ses["member"]["provice"] : "";
			$bcity = !empty($ses["member"]["city"]) ? $ses["member"]["city"] : "";
			$baddress = !empty($ses["member"]["address"]) ? $ses["member"]["address"] : "";
			$bkodepos = !empty($ses["member"]["kodepos"]) ? $ses["member"]["kodepos"] : "";
			$bphone = !empty($ses["member"]["phone"]) ? $ses["member"]["phone"] : "";

			$data["databilling"] = array(
				'billing_name' =>  $bname,
				'billing_company' =>  $bcompany,
				'billing_province' => $this->getnamewilayah($bprovice, "provinces"),
				'billing_city' => $this->getnamewilayah($bcity, "regencies"),
				'billing_address' => $baddress,
				'billing_kodepos' => $bkodepos,
				'billing_phone' => $bphone
			);
			$chart = array(
				"session" => $this->session->userdata('session_id')
			);
			//$this->model_shipping->update($data["databilling"],$chart);
			$this->session->set_userdata("databilling", $data["databilling"]);
			$this->session->set_userdata("datashipping");
			if ($method == "pickup") {
				//echo "Sukses tanpa pengiriman";
				$province = "-";
				$city = "-";
				$shipping_cost = 0;
				$address = "-";
				$kodepos = "-";

				$data["datauser"] = array(
					'shipping_name' =>  $this->input->post("name"),
					'shipping_company' =>  $this->input->post("company"),
					'shipping_idprovince' => $city,
					'shipping_city' => $city,
					'shipping_idcity' => $city,
					'shipping_iddistrict' => $city,
					'shipping_idvillage' => $city,
					'shipping_address' => $address,
					'shipping_kodepos' => $kodepos,
					'shipping_phone' => $this->input->post("phone"),
					'shipping_cost' => $shipping_cost,
					'shipping_description' => "pickup"
				);
				//$this->model_shipping->update($data["datauser"],$chart);
				$this->session->set_userdata("datashipping", $data["datauser"]);
				redirect(base_url() . "cart/billing");
			} else {
				$this->form_validation->set_rules('shipping_city', 'Shipping_city', 'required');
				$this->form_validation->set_rules('shipping_address', 'Shipping_address', 'required');
				$this->form_validation->set_rules('shipping_kodepos', 'Shipping_kodepos', 'required');

				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('message', 'Lengkapi data yang bertanda <sup>*</sup>.');
					redirect(base_url() . "shipping");
				} else {
					$province = $this->input->post("shipping_province");
					$city = $this->input->post("shipping_city");
					$district = $this->input->post("shipping_districts");
					$village = $this->input->post("shipping_village");
					$address = $this->input->post("shipping_address");
					$kodepos = $this->input->post("shipping_kodepos");
					$jne_choice = $this->input->post("shipping_choice");
					$idmember = !empty($ses["member"]["idmember"]) ? $ses["member"]["idmember"] : "";
					$nm_province = $this->getnamewilayah($province, "provinces");
					$nm_regencie = $this->getnamewilayah($city, "regencies");
					$nm_district = $this->getnamewilayah($district, "districts");
					$nm_villages = $this->getnamewilayah($village, "villages");
					$data["datauser"] = array(
						'shipping_name' =>  $this->input->post("name"),
						'shipping_company' =>  $this->input->post("company"),
						'shipping_idprovince' => $province,
						'shipping_idcity' => $city,
						'shipping_iddistricts' => $district,
						'shipping_idvillage' => $village,
						'shipping_city' => $this->getnamewilayah($city, "regencies"),
						'shipping_province' => $this->getnamewilayah($province, "provinces"),
						'shipping_address' => $address . ", " . $nm_villages . ", " . $nm_district . ", " . $nm_regencie . ", " . $nm_province,
						'shipping_kodepos' => $kodepos,
						'shipping_phone' => $this->input->post("phone"),
						//'shipping_cost'=>$this->getcost_jne($district,$jne_choice),
						'shipping_cost' => 0,
						'shipping_description' => "Trumecs Delivery"
					);
					if ($this->input->post("address_shipping") == "new") {
						$saveto = array(
							'id_member' => $ses["member"]["id"],
							'id_province' => $province,
							'id_regencies' => $city,
							'id_districts' => $district,
							'id_villages' => $this->input->post("shipping_village"),
							'nm_wilayah' => $nm_villages . ", " . $nm_district . ", " . $nm_regencie . ", " . $nm_province,
							'address' => $address,
							'kode_pos' => $kodepos,
							'jne_kode' => $this->db->get("districts", array('id' => $district))->result_array()[0]["kode_jne"],
							'tipe' => 'jne',
							'jarak' => ''
						);
						$yangpernahada = $this->member_return->address_shipping();
						foreach ($yangpernahada as $key) {
							if ($key["id_villages"] == $village and $key["address"] == $address) {
								$this->session->set_userdata("datashipping", $data["datauser"]);
								redirect(base_url() . "cart/billing");
								exit();
							}
						}
						$this->cart_model->savenewaddress($saveto);
					}
					#var_dump($data["datauser"]);
					//$this->model_shipping->update($data["datauser"],$chart);
					$this->session->set_userdata("datashipping", $data["datauser"]);
					redirect(base_url() . "cart/billing");
				}
			}
		}
	}

	private function getcost_trumecs()
	{
		$delivery_per_kg = $this->cart_model->getsetting("delivery_per_kg");
		$free_for = $this->cart_model->getsetting("delivery_free_limit");

		$listchart = (array) $this->cart->contents();
		$total = 0;
		$totalweight = 0;
		$totalw = 0;
		$quantity = 0;
		$totalpdimensi = 0;
		foreach ($this->cart->contents() as $key) {
			$totalweight = str_replace(',', '.', $key["weight"]) * $key["qty"];
			$totalw = $totalw + $totalweight;
		}
		if ($free_for > $total) {
			$_cost = $totalw * $delivery_per_kg;
		} else {
			$_cost = 0;
		}
		return $_cost;
	}

	private function getcost($destination, $courier, $serviceselected)
	{
		$curl = curl_init();
		$session = $this->session->all_userdata();

		$this->load->model("web/chart/model_chart");
		$ses = $this->session->all_userdata();
		$idmember = !empty($ses["member"]["idmember"]) ? $ses["member"]["idmember"] : "";
		$chart = array(
			"session" => $this->session->userdata('session_id'),
			"idmember" => $idmember
		);
		$data["listchart"] = $this->model_chart->getchart($chart);

		$totalw = 0;
		foreach ($data["listchart"] as $key) {
			$totalweight = str_replace(',', '.', $key["weight"]) * $key["quantity"];
			$totalw = $totalw + $totalweight;
		}
		$totalw;

		$weight = $totalw;

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://rajaongkir.com/api/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",   ////////// origin=54 adalah BEKASI
			CURLOPT_POSTFIELDS => "origin=54&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: 84b63309ca063808214a22d7906f2265"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			//echo $response;
			//echo '<option value="">--Pilih Service--</option>';
			$data = json_decode($response, TRUE);
			$cost = array();
			for ($i = 0; $i < count($data["rajaongkir"]["results"]); $i++) {

				$cost = $data["rajaongkir"]["results"][$i]["costs"];
				//$namecourier=$data["rajaongkir"]["results"]["name"];
				foreach ($cost as $key) {
					foreach ($key["cost"] as $value) {
					}
					if ($serviceselected == $key["service"]) {
						return $cost = array(
							"value" => $value["value"],
							"description" => $courier . " " . $key["service"] . " " . $value["etd"] . " hari"
						);
						break;
					}
				}
			}
		}
	}

	public function billing()
	{
		$session = $this->session->all_userdata();
		$datashipping = (array) $session["datashipping"];
		$data["datashipping"] = $datashipping;
		if ($datashipping["shipping_name"] == "" or ($datashipping["shipping_company"]) == "" or ($datashipping["shipping_address"]) == "" or isset($datashipping["shipping_city"]) == ""  or ($datashipping["shipping_kodepos"]) == "" or ($datashipping["shipping_phone"]) == "" or isset($datashipping["shipping_cost"]) == "" or ($datashipping["shipping_description"]) == "") {
			$this->session->set_flashdata('message', 'Data pengiriman barang Anda belum lengkap <a href="' . base_url() . 'cart/shipping" class="link btn-orange">Lengkapi sekarang</a>');
			//redirect(base_url()."cart/notification");
			//exit();
		}

		$session = $this->session->all_userdata();
		$sessionmember = $session["member"];
		$arraynone = array('shipping_method' => "", 'shipping_province' => "", "shipping_city" => "");
		/* if (in_array("", array_diff_assoc($sessionmember, $arraynone))){
		 	$this->session->set_flashdata('message', 'Anda harus melengkapi Akun untuk berbelanja di trumecs.com');
		 	redirect(base_url()."member/setting");
		 }*/

		if (count($this->cart->contents()) == 0) {
			redirect(base_url() . "cart");
		}
		$this->securitylog->cekloginmember();
		$data["css"] = array(base_url() . "asset/css/cart_page.css");
		$data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/cart_page.js");
		$data['content'] = 'billing_page';
		//echo "string";
		$this->load->view('front/template_front', $data);
	}
	public function chekout()
	{

		if (count($this->cart->contents()) == 0) {
			redirect(base_url() . "cart");
		}
		$ses = $this->session->all_userdata();
		$idmember = !empty($ses["member"]["id"]) ? $ses["member"]["id"] : "";
		$emailmember = !empty($ses["member"]["email"]) ? $ses["member"]["email"] : "";
		$order_id =  $idmember . mt_rand(000, 999);
		$id_insert = 0;

		$databilling = (array) $ses["databilling"];
		$datashipping = (array) $ses["datashipping"];
		$chart = $this->cart->contents();
		$listchart = $this->cart->contents();

		if (empty($chart)) {
			$this->session->set_flashdata('message', 'Sistem mendeteksi kesalahan untuk mendapatkan Keranjang Belanja Anda <a class="link btn-orange">Lihat Riwayat Belanja</a>');
			redirect(base_url() . "notification");
			exit();
		} else {
			$order_id = $order_id;
			$datenow = date("d-m-Y");
			/// make expired date
			$date = date_create($datenow);
			date_add($date, date_interval_create_from_date_string('1 days'));
			$expireddate = date_format($date, 'd-m-Y');
			$referral_code = $this->session->userdata('referral_code');
			$data = array(
				'iduniq' => $order_id,
				'status' => "unpaid",
				'time' => $datenow,
				'expired' => $expireddate,
				'idmember' => $idmember,
				'billing_name' 		=>  $databilling["billing_name"],
				'billing_company'	=>  $databilling["billing_company"],
				'billing_province'  => $databilling["billing_province"],
				'billing_city' 		=> $databilling["billing_city"],
				'billing_address' 	=> $databilling["billing_address"],
				'billing_kodepos' 	=> $databilling["billing_kodepos"],
				'billing_phone'		=> $databilling["billing_phone"],

				'shipping_name' =>  $datashipping["shipping_name"],
				'shipping_company' => $datashipping["shipping_company"],
				'shipping_city' => $datashipping["shipping_city"],
				'shipping_address' => $datashipping["shipping_address"],
				'shipping_kodepos' => $datashipping["shipping_kodepos"],
				'shipping_phone' => $datashipping["shipping_phone"],
				'shipping_cost' => $datashipping["shipping_cost"],
				'shipping_description' => $datashipping["shipping_description"],
				'referral_code' => $referral_code != '' ? $referral_code['code'] : ''
			);
			$id_insert = $this->cart_model->insertordercekout($data);
		}

		$totalprice = 0;
		$qty = 0;


		foreach ($this->cart->contents() as $listchart) {
			$price = $listchart["price"] * $listchart["qty"];
			$qty = $qty + $listchart["qty"];
			$idproduct = $listchart["id"];
			$nameproduct = ucwords($listchart["name"]);
			$totalprice = $totalprice + $price;
			//var_dump($chart);	
			$dataitem = array(
				'id_order'	=> $id_insert,
				'id_product' => $idproduct,
				'price' 	=> $listchart["price"],
				'quantity' 	=> $listchart["qty"],
				'name_product' 			=> $nameproduct,
				'partnumber_product'    => $listchart["partnumber_product"],
				'px'    => $listchart["px"],
				'py'    => $listchart["py"],
				'pz'    => $listchart["pz"],
				'sx'    => $listchart["sx"],
				'sy'    => $listchart["sy"],
				'sz'    => $listchart["sz"],
				'weight'    => $listchart["weight"],
				'warranty'    => $listchart["warranty"],
				'unit'    => $listchart["unit"]
			);
			$this->cart_model->insertorderdetailcekout($dataitem);
		}
		if ($totalprice > $this->cart_model->getsetting("delivery_free_limit")) {
			$whereupdate_whenmore10juta = array('iduniq' => $order_id);
			$dataupdate_whenmore10juta = array('shipping_cost' => 0);
			$this->cart_model->updateorder($dataupdate_whenmore10juta, $whereupdate_whenmore10juta);
			$datashipping["shipping_cost"] = 0;
		}
		$ppn = (11 / 100) * $totalprice;
		$totalprice = $totalprice + $datashipping["shipping_cost"];
		$whereupdate = array('iduniq' => $order_id);
		$dataupdate = array('ppn' => $ppn);
		$this->cart_model->updateorder($dataupdate, $whereupdate);

		try {
			$this->cart->destroy();
			$this->session->set_flashdata('message', '
				<strong class="f22 fbold">Terimakasih</strong><br>
				Pesanan Anda telah kami terima dengan Id Order : <strong>' . $order_id . '</strong> <br>
				<!--Segera melakukan pembayaran sebesar <strong>Rp. ' . number_format($totalprice) . '</strong> <br>
				Sebelum tanggal ' . $expireddate . '.<br>-->
				Setelah pesanan anda dikonfirmasi, anda dapat melakukan pembayaran ke :<br>
				'
				. $this->cart_model->getsetting("inforekening") .
				'<br><br>
				Setelah melakukan pembayaran, Anda harus melakukan <a href="' . base_url() . 'member/confirmation" class="link btn btn-orange">Konfirmasi Pembayaran</a><br><br>
				<small>*Tidak mendapatkan email? cek email masuk Trumecs.com di folder Spam/Junk</small>
				');
			$dataemail['order_id'] = $order_id;
			$dataemail['totalprice'] = $totalprice;
			$dataemail['expireddate'] = $expireddate;
			$dataemail["infobank"] = $this->cart_model->getsetting("inforekening");

			//sent email to new member
			$from = "no-reply@trumecs.com";
			$password = "no-reply#trumecs#123abc";
			$to = $emailmember;
			$subject = "Informasi Pembayaran - ID ORDER #" . $order_id;
			$message = $this->load->view('email/email-to-new-order', $dataemail, true);

			$emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
			if ($emailstatus = true) {
				redirect(base_url() . 'cart/notification');
			} else {
				$this->session->set_flashdata('message', 'Email yang anda masukkan tidak benar');
			}
			$pesan = "Dear Admin, Ada Pesanan baru dengan ID ORDER #" . $order_id;
			$this->sentemailnotiftoadmin($pesan, '1');
			$this->sentemailnotiftoadmin($pesan, '8');
			redirect(base_url() . "cart/notification");
		} catch (Exception $e) {
			echo $e->getMessage();
			$this->session->set_flashdata('message', 'Sistem kami mendeteksi kesalahan dalam proses pembayaran Anda, ID Order : <strong>' . $order_id . '</strong> <br><a class="link btn-orange">Lihat Riwayat Belanja</a> untuk melanjutkan pembayaran');
			redirect(base_url() . "cart/notification");
		}
	}

	public function notification()
	{
		$data['content'] = 'notification';
		$this->load->view('front/template_front', $data);
	}

	public function shipping_jne()
	{
		/*if (count($this->cart->contents())==0) {
			redirect(base_url()."cart");
		}*/
		$data["address_shipping"] = $this->member_return->address_shipping();
		$data['js'] = array(base_url() . 'asset/js/maps_jne.js');
		$data["provinces"] = $this->cart_model->getprovinces();
		$data['content'] = 'shipping_jne';
		$this->load->view('front/template_front', $data);
	}

	public function setshipping_jne()
	{
		/*if (count($this->cart->contents())==0) {
			redirect(base_url()."cart");
		}*/
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('method', 'Method', 'required');
		$method = $this->input->post("method");
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Lengkapi data yang bertanda <sup>*</sup>.');
			redirect(base_url() . "cart/setshipping_jne");
		} else {
			$ses = $this->session->all_userdata();
			$bname = !empty($ses["member"]["name"]) ? $ses["member"]["name"] : "";
			$bcompany = !empty($ses["member"]["Company"]) ? $ses["member"]["Company"] : "";
			$bprovice = !empty($ses["member"]["provice"]) ? $ses["member"]["provice"] : "";
			$bcity = !empty($ses["member"]["city"]) ? $ses["member"]["city"] : "";
			$baddress = !empty($ses["member"]["address"]) ? $ses["member"]["address"] : "";
			$bkodepos = !empty($ses["member"]["kodepos"]) ? $ses["member"]["kodepos"] : "";
			$bphone = !empty($ses["member"]["phone"]) ? $ses["member"]["phone"] : "";

			$data["databilling"] = array(
				'billing_name' =>  $bname,
				'billing_company' =>  $bcompany,
				'billing_province' => $this->getnamewilayah($bprovice, "provinces"),
				'billing_city' => $this->getnamewilayah($bcity, "regencies"),
				'billing_address' => $baddress,
				'billing_kodepos' => $bkodepos,
				'billing_phone' => $bphone
			);
			$chart = array(
				"session" => $this->session->userdata('session_id')
			);
			//$this->model_shipping->update($data["databilling"],$chart);
			$this->session->set_userdata("databilling", $data["databilling"]);
			$this->session->set_userdata("datashipping");
			if ($method == "pickup") {
				//echo "Sukses tanpa pengiriman";
				$province = "-";
				$city = "-";
				$shipping_cost = "0";
				$address = "-";
				$kodepos = "-";

				$data["datauser"] = array(
					'shipping_name' =>  $this->input->post("name"),
					'shipping_company' =>  $this->input->post("company"),
					'shipping_idprovince' => $city,
					'shipping_city' => $city,
					'shipping_idcity' => $city,
					'shipping_iddistrict' => $city,
					'shipping_idvillage' => $city,
					'shipping_address' => $address,
					'shipping_kodepos' => $kodepos,
					'shipping_phone' => $this->input->post("phone"),
					'shipping_cost' => $shipping_cost,
					'shipping_description' => "pickup"
				);
				//$this->model_shipping->update($data["datauser"],$chart);
				$this->session->set_userdata("datashipping", $data["datauser"]);
				redirect(base_url() . "cart/billing");
			} else {
				//echo "Menggunakan pengiriman ".$method;
				$this->form_validation->set_rules('shipping_city', 'Shipping_city', 'required');
				$this->form_validation->set_rules('shipping_address', 'Shipping_address', 'required');
				$this->form_validation->set_rules('shipping_kodepos', 'Shipping_kodepos', 'required');
				$this->form_validation->set_rules('shipping_choice', 'Shipping_choice', 'required');
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('message', 'Lengkapi data yang bertanda <sup>*</sup>.');
					redirect(base_url() . "cart/setshipping_jne");
				} else {
					$province = $this->input->post("shipping_province");
					$city = $this->input->post("shipping_city");
					$district = $this->input->post("shipping_districts");
					$village = $this->input->post("shipping_village");
					$address = $this->input->post("shipping_address");
					$kodepos = $this->input->post("shipping_kodepos");
					$jne_choice = $this->input->post("shipping_choice");
					$idmember = !empty($ses["member"]["idmember"]) ? $ses["member"]["idmember"] : "";
					$nm_province = $this->getnamewilayah($province, "provinces");
					$nm_regencie = $this->getnamewilayah($city, "regencies");
					$nm_district = $this->getnamewilayah($district, "districts");
					$nm_villages = $this->getnamewilayah($village, "villages");
					$data["datauser"] = array(
						'shipping_name' =>  $this->input->post("name"),
						'shipping_company' =>  $this->input->post("company"),
						'shipping_idprovince' => $province,
						'shipping_idcity' => $city,
						'shipping_iddistricts' => $district,
						'shipping_idvillage' => $village,
						'shipping_city' => $this->getnamewilayah($city, "regencies"),
						'shipping_province' => $this->getnamewilayah($province, "provinces"),
						'shipping_address' => $address . ", " . $nm_villages . ", " . $nm_district . ", " . $nm_regencie . ", " . $nm_province,
						'shipping_kodepos' => $kodepos,
						'shipping_phone' => $this->input->post("phone"),
						'shipping_cost' => $this->getcost_jne($district, $jne_choice),
						'shipping_description' => strtoupper($method) . " - " . $jne_choice
					);

					$this->session->set_userdata("datashipping", $data["datauser"]);
					if ($this->input->post("address_shipping") == "new") {
						$saveto = array(
							'id_member' => $ses["member"]["id"],
							'id_province' => $province,
							'id_regencies' => $city,
							'id_districts' => $district,
							'id_villages' => $this->input->post("shipping_village"),
							'nm_wilayah' => $nm_villages . ", " . $nm_district . ", " . $nm_regencie . ", " . $nm_province,
							'address' => $address,
							'kode_pos' => $kodepos,
							'jne_kode' => $this->db->get("districts", array('id' => $district))->result_array()[0]["kode_jne"],
							'tipe' => 'jne',
							'jarak' => ''
						);
						$yangpernahada = $this->member_return->address_shipping();
						foreach ($yangpernahada as $key) {
							if ($key["id_villages"] == $village and $key["address"] == $address) {
								$this->session->set_userdata("datashipping", $data["datauser"]);
								redirect(base_url() . "cart/billing");
								exit();
							}
						}
						$this->cart_model->savenewaddress($saveto);
					}
					#var_dump($data["datauser"]);
					//$this->model_shipping->update($data["datauser"],$chart);
					//redirect(base_url()."cart/billing");
				}
			}
		}
	}

	public function deladdress_shipping()
	{
		$ses = $this->session->all_userdata();
		$id = $this->input->post("id");
		$where = array('id' => $id, "id_member" => $ses["member"]["id"]);
		$del = $this->cart_model->deleteaddress($where);
		if (!$del) {
			echo '<a class="label label-danger "> Tidak bisa di hapus</a>';
		} else {
		}
	}


	private function getcost_jne($district, $jne_choice)
	{
		$curl = curl_init();
		$session = $this->session->all_userdata();

		$ses = $this->session->all_userdata();
		$idmember = !empty($ses["member"]["idmember"]) ? $ses["member"]["idmember"] : "";
		$chart = array(
			"session" => $this->session->userdata('session_id'),
			"idmember" => $idmember
		);
		$data["listchart"] = $this->cart->contents();

		$totalw = 0;
		foreach ($data["listchart"] as $key) {
			$totalweight = str_replace(',', '.', $key["weight"]) * $key["qty"];
			$totalw = $totalw + $totalweight;
		}
		$totalw;
		$weight = $totalw;
		$where = array('id' => $district);
		$session = $this->session->all_userdata();
		$JNEcode = $this->cart_model->getkodejne($where);
		if (count($JNEcode) == 0) {
			redirect('cart/shipping');
			exit;
		}
		$usernameJNE = "TRISINDO";
		$Api_keyJNE = "a90637a262308591aca3b48130e6d9d1";
		$fromJNE = "BKI10000";
		$thruJNE = $JNEcode; //"JOG10000";//$JNEcode;
		$weightJNE = $weight;
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.jne.co.id:8889/tracing/trisindo/price/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",   ////////// origin=54 adalah BEKASI
			CURLOPT_POSTFIELDS => "username=" . $usernameJNE . "&api_key=" . $Api_keyJNE . "&weight=" . $weightJNE . "&from=" . $fromJNE . "&thru=" . $thruJNE,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: " . md5($Api_keyJNE)
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			redirect('cart/shipping');
			exit;
		} else {
			$data = json_decode($response, TRUE);
			$str_option = "";
			if (count($data) == 0) {
				redirect('cart/shipping');
				exit;
			}
			foreach ($data["price"] as $key) {
				if ($key["service_code"] == $jne_choice) {
					return $key["price"];
				}
			}
		}
	}

	public function shipping_gojek()
	{
		if (count($this->cart->contents()) == 0) {
			redirect(base_url() . "cart");
		}
		$data["address_shipping"] = $this->member_return->address_shipping();
		$data['css'] = array(base_url() . 'asset/css/maps.css');
		$data['js'] = array(base_url() . 'asset/js/maps.js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC8ONfaDzQ8waIyOdgj4TkzEt_ltcO8N2c&libraries=places&callback=initAutocomplete');
		$data['content'] = 'shipping_gojek';
		$this->load->view('front/template_front', $data);
	}

	public function cost_delivery_ojek()
	{
		$string_jarak = (strpos('.', $this->input->post('jarak'))) ? str_replace(".", '', $this->input->post('jarak')) : $this->input->post('jarak');
		$jarak = $string_jarak; //floatval(str_replace(",",".",str_replace('.', '', $this->input->post('jarak')))); 
		$distance = (float)$jarak;
		$id = $this->input->post('chooseojek');
		$duration = $this->input->post('estimasi');
		$alamat = $this->input->post('loc_google');
		$tarif = $this->cart_model->get_tarif_ojek($id);
		#$web_setting = $this->model_chart->get_web_setting();

		/*if($distance > $web_setting->row()->max_kirim_km){
            $data['distance'] = $distance;
            $response = $this->load->view('web/chart/over_distance', $data, TRUE);
            $response = array('status' => '400', 'message' => $response);
            print_r(json_encode($response));
        }else{*/
		//hitung berat produk semua
		$total_berat = 0;
		foreach ($this->cart->contents() as $items) {
			$items['weight'] * $items['qty'];
			$total_berat += $items['weight'] * $items['qty'];
		}
		//$no =1;
		foreach ($tarif->result() as $dt_tarif) {
			//hitung cost
			if ($distance <= $dt_tarif->min_km) {
				$cost = $dt_tarif->tarif_dasar;
			} else {
				(float)$distance_diff = $distance - (float)$dt_tarif->min_km;
				$cost = $distance_diff * $dt_tarif->per_km + $dt_tarif->tarif_dasar;
			}

			//hitung kurir yang cocok
			if ($total_berat <= $dt_tarif->max_berat) {
				$ordering[] = $dt_tarif->id_ojek_online;
			}
			$distance  = (strlen($distance) >= 5) ? str_replace(".", '', $distance) : $distance;
			$total_berat = (strlen($total_berat) >= 4) ? str_replace(".", '', $total_berat) : $total_berat;
			$deliver_cost[] = array(
				'kurir' => $dt_tarif->nama_kurir,
				'tarif' => floor($cost),
				'distance' => $distance,
				'max_kilometer' => $dt_tarif->max_km,
				'total_berat' => $total_berat,
				'max_berat' => $dt_tarif->max_berat,
				'id_tarif' => $dt_tarif->id_ojek_online,
				'alamat' => $alamat,
				'detail_address' => $this->input->post('detail_address')
			);
			//$no++;
		}
		$data['delivery_cost'] = $deliver_cost;
		/*$filerempty = array_values( array_filter($ordering));
            $data['ordering'] = $filerempty;*/
		#print_r(json_encode(array('status' => '200', 'message' => $data)));
		$response = $this->load->view('list_cost_ojek', $data, TRUE);
		$response = array('status' => '200', 'message' => $response);
		if ($dt_tarif->max_km <= $distance or $total_berat >= $dt_tarif->max_berat) {
			$this->session->set_userdata("costshipping_by_deliveryonline", array('sipra' => "false"));
		} else {
			$this->session->set_userdata("costshipping_by_deliveryonline", array('sipra' => "true", 'kurir' => $dt_tarif->nama_kurir, 'tarif' => floor($cost), 'alamat' => $alamat, 'jarak' => $distance));
		}
		print_r(json_encode($response));
		/*}*/
	}

	public function setsippingbygojek()
	{
		foreach ($_POST as $key => $value) {
			$data[$key] = $this->input->post($key);
		}
		#var_dump($data);
		if (count($this->cart->contents()) == 0) {
			redirect(base_url() . "cart");
		}
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$method = $this->input->post("method");

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Lengkapi data yang bertanda <sup>*</sup>.');
			redirect(base_url() . "shipping");
		} else {
			$ses = $this->session->all_userdata();

			$costshipping_by_deliveryonline = $ses["costshipping_by_deliveryonline"];
			if ($costshipping_by_deliveryonline["sipra"] == "false") {
				redirect(base_url() . 'cart/shipping_gojek');
				exit();
			}



			$bname = !empty($ses["member"]["name"]) ? $ses["member"]["name"] : "";
			$bcompany = !empty($ses["member"]["Company"]) ? $ses["member"]["Company"] : "";
			$bprovice = !empty($ses["member"]["provice"]) ? $ses["member"]["provice"] : "";
			$bcity = !empty($ses["member"]["city"]) ? $ses["member"]["city"] : "";
			$baddress = !empty($ses["member"]["address"]) ? $ses["member"]["address"] : "";
			$bkodepos = !empty($ses["member"]["kodepos"]) ? $ses["member"]["kodepos"] : "";
			$bphone = !empty($ses["member"]["phone"]) ? $ses["member"]["phone"] : "";

			$data["databilling"] = array(
				'billing_name' =>  $bname,
				'billing_company' =>  $bcompany,
				'billing_province' => $this->getnamewilayah($bprovice, "provinces"),
				'billing_city' => $this->getnamewilayah($bcity, "regencies"),
				'billing_address' => $baddress,
				'billing_kodepos' => $bkodepos,
				'billing_phone' => $bphone
			);
			$chart = array(
				"session" => $this->session->userdata('session_id')
			);
			//$this->model_shipping->update($data["databilling"],$chart);
			$this->session->set_userdata("databilling", $data["databilling"]);
			$this->session->set_userdata("datashipping");
			//echo "Sukses dengan Gojek";


			$province = "-";
			$city = "-";
			$shipping_cost = (string) $costshipping_by_deliveryonline["tarif"];
			$address = $costshipping_by_deliveryonline["alamat"] . " - " . $this->input->post("detailaddress");
			$kodepos = "-";

			$data["datauser"] = array(
				'shipping_name' =>  $this->input->post("name"),
				'shipping_company' =>  $this->input->post("company"),
				'shipping_city' => $city,
				'shipping_address' => $address,
				'shipping_kodepos' => $kodepos,
				'shipping_phone' => $this->input->post("phone"),
				'shipping_cost' => $shipping_cost,
				'shipping_description' => (string) $costshipping_by_deliveryonline["kurir"]
			);
			//$this->model_shipping->update($data["datauser"],$chart);
			$this->session->set_userdata("datashipping", $data["datauser"]);

			if ($this->input->post("address_shipping") == "new") {
				$saveto = array(
					'id_member' => $ses["member"]["id"],
					'address' => $costshipping_by_deliveryonline["alamat"],
					'detail_address' => $this->input->post("detailaddress"),
					'tipe' => strtolower(str_replace('-', '', $costshipping_by_deliveryonline["kurir"])),
					'jarak' => $costshipping_by_deliveryonline["jarak"]
				);
				$yangpernahada = $this->member_return->address_shipping();
				foreach ($yangpernahada as $key) {
					if ($key["address"] == $costshipping_by_deliveryonline["alamat"]) {
						redirect(base_url() . "cart/billing");
						exit();
					}
				}
				$this->cart_model->savenewaddress($saveto);
			}
			redirect(base_url() . "cart/billing");
		}
	}
	public function shipping_gobox()
	{
		if (count($this->cart->contents()) == 0) {
			redirect(base_url() . "cart");
		}
		$data['css'] = array(base_url() . '/asset/css/maps.css');
		$data['js'] = array(base_url() . 'asset/js/maps.js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC8ONfaDzQ8waIyOdgj4TkzEt_ltcO8N2c&libraries=places&callback=initAutocomplete');

		$data["address_shipping"] = $this->member_return->address_shipping();
		$data['content'] = 'shipping_gobox';
		$this->load->view('front/template_front', $data);
	}
	private function getnamewilayah($id, $table)
	{
		$whareid = array('id' => $id);
		$kembali = $this->cart_model->getnamewilayah($whareid, $table);
		return $kembali;
	}
	private function sentemailnotiftoadmin($pesan, $kebagian)
	{
		$data = $this->member_model->get_admin(array('admin.privileges' => $kebagian));
		$from = "no-reply@trumecs.com";
		$password = "no-reply#trumecs#123abc";
		foreach ($data as $key) {
			$tonextadmin = $key["email"];
			$subject = "Pesanan Baru " . date("dmY:His");
			$message = $pesan;
			$emailstatus = $this->emailer->sent($from, $password, $tonextadmin, $subject, $message);
		}
	}

	public function check_referral_code()
	{
		$referral_code = $this->input->post('referral_code');
		$check = $this->cart_model->check_referral_code($referral_code);
		if ($check->num_rows() == 1) {
			$this->session->set_userdata('referral_code', array(
				'code' => $referral_code,
			));
			echo 'true';
		} else {
			echo 'false';
		}
	}
}
