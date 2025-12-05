<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General extends MX_Controller
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model("general_model");
	}
	public function index()
	{
		# code...
	}
	public function getmerekall($value = null, $source = "back")
	{
		$checked = array();

		if ($source == "back") {
			foreach ($this->general_model->getbrand($value) as $key) {
				$checked[] = $key['id'];
			}

			foreach ($this->general_model->getbrand() as $key) {
				echo '<div class="checkbox-inline"><label><input name="merk[]" type="checkbox" ' . (in_array($key["id"], $checked) ? 'checked="checked"' : "") . ' value="' . $key["id"] . '" />' . $key["name"] . '</label></div>';
			}
		} else {
			$other = "";
			$value = $value == "all" ? null : $value;
			echo '<option value="">-- Semua Merek --</option>';
			foreach ($this->general_model->getbrand($value) as $key) {
				if ($key["name"] != "Other") {
					echo '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
				} else {
					$other = '<option value="' . $key["id"] . '">' . strtoupper($key["name"]) . '</option>';
				}
			}
			echo $other;
		}
	}

	public function getattributeall($value = null, $source = "back")
	{
		$checked = array();

		if ($source == "back") {
			foreach ($this->general_model->getattribute($value) as $key) {
				$checked[] = $key['id'];
			}

			foreach ($this->general_model->getattribute() as $key) {
				echo '<div class="checkbox-inline"><label><input name="attribute[]" type="checkbox" ' . (in_array($key["id"], $checked) ? 'checked="checked"' : "") . ' value="' . $key["id"] . '" />' . $key["name"] . '</label></div>';
			}
		} else {
			$other = "";
			$value = $value == "all" ? null : $value;
			echo '<option value="">-- Semua Merek --</option>';
			foreach ($this->general_model->getbrand($value) as $key) {
				if ($key["name"] != "Other") {
					echo '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
				} else {
					$other = '<option value="' . $key["id"] . '">' . strtoupper($key["name"]) . '</option>';
				}
			}
			echo $other;
		}
	}

	public function gettype($value)
	{
		echo '<option value="">-- Semua Tipe --</option>';
		foreach ($this->general_model->getcategori($value) as $key) {
			echo '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
		}
	}

	public function getcomponentall($source = null)
	{
		$other = '';
		$condition = array(
			'parent' => '0',
			'is_brand' => '0'
		);
		echo '<option value="0">-- Semua Komponen --</option>';
		foreach ($this->general_model->getcategori($condition) as $key) {
			if ($key["name"] != "Other") {
				echo '<option value="' . ($source == "back" ? $key["name"] : $key["id"]) . '">' . $key["name"] . '</option>';
			} else {
				$other = '<option value="' . ($source == "back" ? $key["name"] : $key["id"]) . '">' . $key["name"] . '</option>';
			}
		}
		echo $other;
	}

	public function getgradeall($value = null, $source = "back")
	{
		$checked = array();

		if ($source == "back") {
			foreach ($this->general_model->getgrade($value) as $key) {
				$checked[] = $key['id'];
			}

			foreach ($this->general_model->getgrade() as $key) {
				echo '<div class="checkbox-inline"><label><input name="grade[]" type="checkbox" ' . (in_array($key["id"], $checked) ? 'checked="checked"' : "") . ' value="' . $key["id"] . '" />' . $key["grade"] . '</label></div>';
			}
		} else {
			echo '<option value="">-- Semua Grade --</option>';


			foreach ($this->general_model->getgrade($value) as $key) {
				echo '<option value="' . $key["id"] . '">' . $key["grade"] . "</option>";
			}
		}
	}

	public function getsubkategori($id)
	{
		$condition = array(
			'parent' => $id,
			'is_brand' => '0'
		);
		echo '<option value="0">-- Semua Sub Kategori --</option>';
		foreach ($this->general_model->getcategori($condition) as $key) {
			$condition2 = array(
				'parent' => $key["id"],
				'is_brand' => '0'
			);
			echo '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
			foreach ($this->general_model->getcategori($condition2) as $keys) {
				echo '<option value="' . $keys["id"] . '">' . $key["name"] . ' > ' . $keys["name"] . '</option>';
			}
		}
	}

	public function getareaall()
	{
		echo '<option value="0">-- Seluruh Indonesia --</option>';
		foreach ($this->general_model->getarea() as $key) {
			echo '<option value="' . $key["id"] . '">' . $key["send_from"] . '</option>';
		}
	}

	public function getcomponentall_form($idcomponent = null)
	{
		// Validasi input
		if (empty($idcomponent)) {
			echo '<option value="0">-- Parameter tidak valid --</option>';
			return;
		}

		if (!is_numeric($idcomponent)) {
			$category = $this->general_model->getcategoribyname($idcomponent);

			// Validasi hasil query
			if (empty($category) || !isset($category[0]['id'])) {
				echo '<option value="0">-- Kategori tidak ditemukan --</option>';
				return;
			}

			$idcomponent = $category[0]['id'];
		}

		echo '<option value="0">-- Semua Komponen --</option>';

		$parentCategories = $this->general_model->getparentcategori($idcomponent);

		// Validasi parent categories
		if (empty($parentCategories)) {
			echo '<option value="0">-- Tidak ada komponen tersedia --</option>';
			return;
		}

		$other = '';

		foreach ($parentCategories as $key) {
			if ($key["name"] != "Other") {
				echo '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
			} else {
				$other = '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
			}

			$condition = array(
				'parent' => $key["id"],
				'is_brand' => '0'
			);

			$subCategories = $this->general_model->getcategori($condition);

			if (!empty($subCategories)) {
				foreach ($subCategories as $keys) {
					echo '<option value="' . $keys["id"] . '">' . $key["name"] . ' > ' . $keys["name"] . '</option>';

					$conditions = array(
						'parent' => $keys["id"],
						'is_brand' => '0'
					);

					$subSubCategories = $this->general_model->getcategori($conditions);

					if (!empty($subSubCategories)) {
						foreach ($subSubCategories as $keyss) {
							echo '<option value="' . $keyss["id"] . '">' . $key["name"] . ' > ' . $keys["name"] . ' > ' . $keyss["name"] . '</option>';
						}
					}
				}
			}
		}

		if ($other) {
			echo $other;
		}
	}

	public function getgradeform($value = null)
	{
		// Validasi input
		if (empty($value)) {
			echo '<option value="">-- Parameter tidak valid --</option>';
			return;
		}

		if (!is_numeric($value)) {
			$result = $this->general_model->getcategoribyname($value);

			if (empty($result) || !isset($result[0]['id'])) {
				echo '<option value="">-- Kategori tidak ditemukan --</option>';
				return;
			}

			$value = $result[0]['id'];
		}

		echo '<option value="">-- Silahkan pilih grade --</option>';

		$grades = $this->general_model->getgrade($value);

		if (!empty($grades)) {
			foreach ($grades as $key) {
				echo '<option value="' . $key["id"] . '">' . $key["grade"] . '</option>';
			}
		} else {
			echo '<option value="">-- Tidak ada grade tersedia --</option>';
		}
	}

	public function getbrandform($value = null)
	{
		// Validasi input
		if (empty($value)) {
			echo '<option value="">-- Parameter tidak valid --</option>';
			return;
		}

		if (!is_numeric($value)) {
			$result = $this->general_model->getcategoribyname($value);

			if (empty($result) || !isset($result[0]['id'])) {
				echo '<option value="">-- Kategori tidak ditemukan --</option>';
				return;
			}

			$value = $result[0]['id'];
		}

		echo '<option value="">-- Silahkan pilih merk --</option>';

		$brands = $this->general_model->getbrand($value);

		if (!empty($brands)) {
			foreach ($brands as $key) {
				echo '<option value="' . $key["id"] . '">' . $key["name"] . '</option>';
			}
		} else {
			echo '<option value="">-- Tidak ada merk tersedia --</option>';
		}
	}

	public function getattributeform($value = null)
	{
		// Validasi input
		if (empty($value)) {
			echo '<div class="alert alert-warning">Parameter tidak valid</div>';
			return;
		}

		if (!is_numeric($value)) {
			$result = $this->general_model->getcategoribyname($value);

			if (empty($result) || !isset($result[0]['id'])) {
				echo '<div class="alert alert-warning">Kategori tidak ditemukan</div>';
				return;
			}

			$value = $result[0]['id'];
		}

		$attributes = $this->general_model->getattribute($value);

		if (!empty($attributes)) {
			foreach ($attributes as $key) {
				echo '<div class="row mb-2 align-items-end">';
				echo '<div class="col-md-5"><label class="form-label small text-muted">Nama Atribut</label><input type="text" class="form-control" jq-model="atribut" placeholder="Contoh: Warna, Ukuran, Material" name="attribute[]" value="' . htmlspecialchars($key['name']) . '"></div>';
				echo '<div class="col-md-5 p-a-0"><label class="form-label small text-muted">Nilai Atribut</label><input type="text" class="form-control" jq-model="value" placeholder="Contoh: Merah, 10x20cm, Plastik" name="value[]" value=""></div>';
				echo '<div class="col-md-2"><button type="button" class="btn btn-outline-danger del-att w-100">
															<i class="fas fa-times"></i>
														</button></div>';
				echo '</div>';
			}
		} else {
			echo '<div class="alert alert-info">Tidak ada atribut tersedia untuk kategori ini</div>';
		}
	}

	public function getcity()
	{
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$selected = "";
		if ($array_search == true) {
			$selected = "selected";
		}
		echo '<option value="">-Pilih kota-</option>';
		foreach ($this->general_model->getjabodetabek() as $key) {
			$str_ = ($key["name"] != $session["member"]["shipping_city"]) ? "" : $selected;
			echo '<option value="' . $key["name"] . '" ' . $str_ . '>' . $key["name"] . '</option>';
		}
	}

	public function getwilayahprovince()
	{
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$selected = "";
		if ($array_search == true) {
			$selected = "selected";
		}
		echo '<option value="">-Pilih Provinsi-</option>';
		foreach ($this->general_model->getwilayahprovince() as $key) {
			echo '<option value="' . $key["id"] . '" >' . $key["name"] . '</option>';
		}
	}
	public function getwilayahprovince_json()
	{
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$array = $this->general_model->getwilayahprovince();
		echo json_encode($array);
	}

	public function getwilayahrigences_json()
	{
		$where = array('province_id' => $this->input->get("id"));
		$array = $this->general_model->getwilayahrigences($where);
		echo json_encode($array);
	}
	public function getwilayahrigences()
	{
		$where = array('province_id' => $this->input->get("id"));
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$selected = "";
		if ($array_search == true) {
			$selected = "selected";
		}
		echo '<option value="">-Pilih Kabupaten-</option>';
		foreach ($this->general_model->getwilayahrigences($where) as $key) {
			echo '<option value="' . $key["id"] . '" >' . $key["name"] . '</option>';
		}
	}

	public function getwilayahdistricts_json()
	{
		$where = array('regency_id' => $this->input->get("id"));
		$array = $this->general_model->getwilayahdistricts($where);
		echo json_encode($array);
	}

	public function getwilayahvillages_json()
	{
		$where = array('district_id' => $this->input->get("id"));
		$array = $this->general_model->getwilayahvillages($where);
		echo json_encode($array);
	}

	public function getwilayahdistricts()
	{
		$where = array('regency_id' => $this->input->get("id"));
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$selected = "";
		if ($array_search == true) {
			$selected = "selected";
		}
		echo '<option value="">-Pilih Kecamatan-</option>';
		foreach ($this->general_model->getwilayahdistricts($where) as $key) {
			echo '<option value="' . $key["id"] . '" >' . $key["name"] . '</option>';
		}
	}

	public function getwilayahdistricts_jne()
	{
		$where = array('regency_id' => $this->input->get("id"), "kode_jne !=" => '');
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$selected = "";
		if ($array_search == true) {
			$selected = "selected";
		}
		echo '<option value="">-Pilih Kecamatan-</option>';
		foreach ($this->general_model->getwilayahdistricts($where) as $key) {
			echo '<option value="' . $key["id"] . '" >' . $key["name"] . '</option>';
		}
	}

	public function getwilayahvillages()
	{
		$where = array('district_id' => $this->input->get("id"));
		$session = $this->session->all_userdata();
		$array_search = array_key_exists("member", $session);
		$selected = "";
		if ($array_search == true) {
			$selected = "selected";
		}
		echo '<option value="">-Pilih Desa-</option>';
		foreach ($this->general_model->getwilayahvillages($where) as $key) {
			echo '<option value="' . $key["id"] . '" >' . $key["name"] . '</option>';
		}
	}

	public function getservice_jne()
	{
		set_time_limit(3600);
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
			$totalweight = $key["weight"] * $key["qty"];
			$totalw = $totalw + $totalweight;
		}
		$totalw;
		$weight = $totalw;

		$where = array('id' => $this->input->get("id"));
		$session = $this->session->all_userdata();
		$JNEcode = $this->general_model->getkodejne($where);
		if (count($JNEcode) == 0) {
			echo '<div class="alert alert-info ">Maaf, Kami tidak dapat menjangkau alamat Anda.</div>';
			exit;
		}

		$usernameJNE = "TRISINDO";
		$Api_keyJNE = "a90637a262308591aca3b48130e6d9d1";
		$fromJNE = "BKI10000";
		$thruJNE = $JNEcode[0]["kode_jne"]; //"JOG10000";//$JNEcode;
		$weightJNE = $weight;
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.jne.co.id:8889/tracing/trisindo/price/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 120,
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
			echo "Koneksi internet Anda tidak setabil<br>" . $err;
		} else {
			echo NULL;
			//echo $response;
			//echo '<option value="">--Pilih Service--</option>';
			$data = json_decode($response, TRUE);
			#var_dump($data["price"]);
			$str_option = "";
			if (count($data) == 0) {
				echo '<div class="alert alert-info ">Maaf, Kami tidak dapat menjangkau alamat Anda.</div>';
				exit;
			}
			foreach ($data["price"] as $key) {
				$str_hari =  ($key["etd_from"] != null and $key["etd_thru"] != null) ? '(' . $key["etd_from"] . '-' . $key["etd_thru"] . ' hari)' : '';
				$str_option .= '<option value="' . $key["service_code"] . '">' . $key["service_display"] . ' Rp.' . number_format($key["price"]) . ' ' . $str_hari . '</option>';
				$str_destination = ucwords(strtolower($key["destination_name"]));
			}
			echo '<div class="alert alert-info ">Service JNE<sup>*</sup><select class="form-control" name="shipping_choice" required >
					<option value="">--Pilih Service--</option>' . $str_option . '</select><small>Melalui cabang JNE ' . $str_destination . '</small><br><button type="submit" class="btn btn-orange proccessshow">Gunakan Pengiriman JNE</button>
				</div>';
		}
		/*$where = array('id_regency' => $this->input->get("id"));
		$session= $this->session->all_userdata(); 
        $JNEcode = $this->general_model->getkodejne($where)
		echo '<option value="">-Pilih Service-</option>';*/
		/*foreach ($this->general_model->getwilayahdistricts($where) as $key) {
			echo '<option value="'.$key["id"].'" >'.$key["name"].'</option>';
		}*/
	}
	public function getservice_trumecsdelivery()
	{
		set_time_limit(3600);
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
			$totalweight = $key["weight"] * $key["qty"];
			$totalw = $totalw + $totalweight;
		}
		$totalw;
		$weight = $totalw;

		$where = array('id' => $this->input->get("id"));
		$session = $this->session->all_userdata();
		$JNEcode = $this->general_model->getkodejne($where);
		if (count($JNEcode) == 0) {
			echo '<div class="alert alert-warning ">Maaf, Kami tidak dapat menjangkau alamat Anda.<br>
        			*Gunakan pengiriman luar JABODETABEK dengan <a class="forange" href="' . base_url() . 'cart/shipping_jne">Pengiriman JNE</a>
        		</div>';
			exit;
		}
		$idkab_jabodetabek = array(
			'3171',
			'3172',
			'3173',
			'3174',
			'3175', //jakarta
			'3201',
			'3216',
			'3271',
			'3275',
			'3276', //jawabarat
			'3603',
			'3671',
			'3674' //banten
		);
		$idkab = $this->input->get("id_kab");
		if (!in_array($idkab, $idkab_jabodetabek)) {
			echo '<div class="alert alert-warning ">Maaf, Kami tidak dapat menjangkau alamat Anda.<br>Untuk sementara Trumecs Delivery hanya menjangkau wilayah JABODETABEK.<br>*Gunakan pengiriman luar JABODETABEK dengan <a class="forange" href="' . base_url() . 'cart/shipping_jne">Pengiriman JNE</a></div>';
			exit;
		}

		$usernameJNE = "TRISINDO";
		$Api_keyJNE = "a90637a262308591aca3b48130e6d9d1";
		$fromJNE = "BKI10000";
		$thruJNE = $JNEcode[0]["kode_jne"]; //"JOG10000";//$JNEcode;
		$weightJNE = $weight;
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.jne.co.id:8889/tracing/trisindo/price/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 120,
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
			echo "Koneksi internet Anda tidak setabil<br>" . $err;
		} else {
			echo NULL;
			//echo $response;
			//echo '<option value="">--Pilih Service--</option>';
			$data = json_decode($response, TRUE);
			#var_dump($data["price"]);
			$str_option = "";
			if (count($data) == 0) {
				echo '<div class="alert alert-warning ">Maaf, Kami tidak dapat menjangkau alamat Anda.
        		<br>*Gunakan pengiriman luar JABODETABEK dengan <a class="forange" href="' . base_url() . 'cart/shipping_jne">Pengiriman JNE</a>
        	</div>';
				exit;
			}
			foreach ($data["price"] as $key) {
				if ($key["etd_from"] != NULL) {
					$str_hari =  ($key["etd_from"] != null and $key["etd_thru"] != null) ? '(' . $key["etd_from"] . '-' . $key["etd_thru"] . ' hari)' : '';
					$str_option .= '<option value="' . $key["service_code"] . '">' . $key["service_display"] . ' Rp.' . number_format($key["price"]) . ' ' . $str_hari . '</option>';
					$str_destination = ucwords(strtolower($key["destination_name"]));
				}
			}
			echo '<div class="alert alert-warning ">Service TRUMECS DELIVERY<sup>*</sup><select class="form-control" name="shipping_choice" required>
					<option value="">--Pilih Service--</option>' . $str_option . '</select><small></small><br><button type="submit" class="btn btn-orange proccessshow">Lanjut Keproses Berikutnya</button>
				</div>';
		}
		/*$where = array('id_regency' => $this->input->get("id"));
		$session= $this->session->all_userdata(); 
        $JNEcode = $this->general_model->getkodejne($where)
		echo '<option value="">-Pilih Service-</option>';*/
		/*foreach ($this->general_model->getwilayahdistricts($where) as $key) {
			echo '<option value="'.$key["id"].'" >'.$key["name"].'</option>';
		}*/
	}

	public function uploadfilecanvas()
	{
		// Result object
		$r = new stdClass();

		// Maximum file size
		$maxsize = 5; //Mb
		// File size control


		// If the file is an image
		if (preg_match('/image/i', $_FILES['filegambar']['type'])) {
			//chmod("public/tmp/", 0777);
			$filename = 'public/tmp/' . uniqid() . '.jpg';
		} else {

			$r->error = "Error: Only image files";
		}

		// Supporting image file types
		$types = array('image/png', 'image/gif', 'image/jpeg');
		// File type control
		if (in_array($_FILES['filegambar']['type'], $types)) {
			// Create an unique file name    
			// Uploaded file source
			$source = file_get_contents($_FILES["filegambar"]["tmp_name"]);
			// Image resize


			$this->imageresize($source, $filename);
		} else {
			// If the file is not an image
			$r->error = "Error: this is not an image file";
			return false;
		}

		// File path
		$path = str_replace('uploader.php', '', $_SERVER['SCRIPT_NAME']);

		// Result data
		$r->filename = $filename;
		$r->path = $path;
		$r->img = '<img src="' . $r->path . $r->filename . '" alt="image" />';

		// Return to JSON
		ob_start();
		echo json_encode($r);
		ob_flush();
		// Image resize function with php + gd2 lib


	}


	function imageresize($source, $destination, $width = 0, $height = 0, $crop = false, $quality = 100)
	{
		$quality = $quality ? $quality : 100;
		$image = imagecreatefromstring($source);
		if ($image) {
			// Get dimensions
			$w = imagesx($image);
			$h = imagesy($image);
			//die(json_encode(array('width' => $w, 'height' => $h)));
			if (($width && $w > $width) || ($height && $h > $height)) {
				$ratio = $w / $h;
				if (($ratio >= 1 || $height == 0) && $width && !$crop) {
					$new_height = $width / $ratio;
					$new_width = $width;
				} elseif ($crop && $ratio <= ($width / $height)) {
					$new_height = $width / $ratio;
					$new_width = $width;
				} else {
					$new_width = $height * $ratio;
					$new_height = $height;
				}
			} else {
				$new_width = $w;
				$new_height = $h;
			}
			$x_mid = $new_width * .5;  //horizontal middle
			$y_mid = $new_height * .5; //vertical middle
			// Resample
			error_log('height: ' . $new_height . ' - width: ' . $new_width);
			$new = imagecreatetruecolor(floor($new_width), floor($new_height));
			$x = 0;
			if ($new_width > $new_height) {
				//$new_height = $new_height *8;
			} else {
				//$x = -$new_width * 7;
				//$new_width = $new_width *8;
			}
			imagecopyresampled($new, $image, 0, 0, $x, 0, $new_width, $new_height, $w, $h);
			// Crop
			if ($crop) {
				$crop = imagecreatetruecolor($width ? $width : $new_width, $height ? $height : $new_height);
				imagecopyresampled($crop, $new, 0, 0, ($x_mid - ($width * .5)), 0, $width, $height, $width, $height);
				//($y_mid - ($height * .5))
			}
			// Output
			// Enable interlancing [for progressive JPEG]
			imageinterlace($crop ? $crop : $new, true);

			$dext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
			if ($dext == '') {
				$dext = $ext;
				$destination .= '.' . $ext;
			}
			fopen($destination, "w");
			switch ($dext) {
				case 'jpeg':
				case 'jpg':
					imagejpeg($crop ? $crop : $new, $destination, $quality);
					break;
				case 'png':
					$pngQuality = ($quality - 100) / 11.111111;
					$pngQuality = round(abs($pngQuality));
					imagepng($crop ? $crop : $new, $destination, $pngQuality);
					break;
				case 'gif':
					imagegif($crop ? $crop : $new, $destination);
					break;
			}
			@imagedestroy($image);
			@imagedestroy($new);
			if ($crop != false) {
				@imagedestroy($crop);
			}
		}
	}
	public function addsession($key, $val)
	{
		echo $key . $val;
		$this->session->set_userdata($key, $val);
	}
}
