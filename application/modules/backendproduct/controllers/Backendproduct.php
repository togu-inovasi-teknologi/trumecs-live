<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendproduct extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_product");
        $this->load->model("backendproduct/grade_model");
        $this->load->model("backendproduct/attribute_model");
        $this->load->model("backendproduct/categori_model");
        $this->load->model("product/product_model");
    }
    public function index()
    {
        $this->securitylog->cekadmin();
        redirect(base_url() . "backendproduct/listall");
    }
    public function listall()
    {
        //$multi = $this->googleapi->write('ARTICLE', 'A2:B2', ["Truk Mercedes Benz bersistem Auto Pilot akan hadir di tahun 2020","Mercedes Benz sudah resmi menguji truk Mercedes Benz baru mereka yang dilengkapi dengan sistem autonomous seperti pada mobil konsep F105. Pengujian dilakukan di jalan tol Jerman yang terkenal, Autobahn. Rutenya adalah Denkendorf sampai bandara Stuttgart, lalu kembali lagi ke tempat semula. begitulah lansiran dari autonetmagz."]);

        // $multi = $this->spreadsheetapi->readAll('Product-List');
        // var_dump($multi);
        // die;
        $this->securitylog->cekadmin();

        $name = $this->input->get("nama");
        $brand = $this->input->get("merek");
        $type = $this->input->get("tipe");
        $component = $this->input->get("komponent");
        $data["idcomponent"] = "";
        $data["idtype"] = "";
        $data["idbrand"] = "";
        $data["querysearch"] = $name;
        $data["datasearch"] = array(
            'tittle' => $name,
            'partnumber' => $name,
            'physicnumber' => $name
        );
        $data["datasearchor_like"] = array(
            'tittle' => $name,
            'partnumber' => $name,
            'physicnumber' => $name
        );

        $data["datawhere"] = array();
        if ($brand != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('brand' => $brand));
        }
        if ($type != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('type' => $type));
        }
        if ($component != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('component' => $component));
        }
        if ($this->input->get("minp") != "") {
            $_isnull = ($this->input->get("minp") != "0") ? $this->input->get("minp")  : 1;
            $data["datasearch"] = array_merge($data["datasearch"], array('minp' => str_replace(",", "", (!empty($this->input->get("minp"))) ? $_isnull : 1)));
        }
        if ($this->input->get("maxp") != "") {
            $data["datasearch"] = array_merge($data["datasearch"], array('maxp' => str_replace(",", "", (!empty($this->input->get("maxp"))) ? $this->input->get("maxp") : 1000000000)));
        }
        $status_valid = $this->input->get("status");
        if ($status_valid != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('status' => $status_valid));
        }

        $config["per_page"] = 10;
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listproduct"] = $this->etx_product->fetch_product($config["per_page"], $page, $data["datasearch"], $data["datasearchor_like"], $data["datawhere"]);

        $data["js"] = array(base_url() . 'asset/backend/js/list.product.js');
        $data['content'] = 'list_product';
        $this->load->view('backend/template_front', $data);
    }

    public function syncProductFromSheetToDB()
    {

        $result = $this->spreadsheetapi->syncProductsFromSheetToDB('Product-list');

        if ($result['success']) {
            $this->session->set_flashdata(
                'success',
                'Berhasil Sync '
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Gagal sync: '
            );
        }

        // redirect('backendproduct/listall');
    }

    function ambil_data()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total = $this->db->count_all_results("product");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->where("(
							tittle LIKE '%$search%' 
							OR partnumber LIKE '%$search%' 
							OR price LIKE '%$search%' 
							OR price_promo LIKE '%$search%' 
                          
                        )", '', false);
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '1'):
            $this->db->order_by('tittle', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '2'):
            $this->db->order_by('price', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '3'):
            $this->db->order_by('brand', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '4'):
            $this->db->order_by('stock', $_REQUEST['order'][0]['dir']);
        endif;

        $query = $this->db->get('product');
        if ($search != "") {
            $this->db->where("(
							tittle LIKE '%$search%' 
							OR partnumber LIKE '%$search%' 
							OR price LIKE '%$search%' 
							OR price_promo LIKE '%$search%' 
                          
                        )", '', false);
            $jum = $this->db->get('product');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        foreach ($query->result_array() as $product) {
            $s = $product["status"] == "show" ? "draf" : "show";
            $l = $product["status"] == "show" ? "success" : "danger";
            $i = $product["status"] == "show" ? "check" : "ban";
            $k = $product["stock"] <= 3 ? "danger" : "success";
            $w = $product["warranty"] != 0 or $product["warranty"] != "" ? "danger" : "success";

            $output['data'][] = array(
                '<a href="' . base_url() . 'backendproduct/productstatus?id=' . $product["id"] . '&status=' . $s . '" class="label label-' . $l . '" alt="show"><i class="fa fa-' . $i . '"></i></a>',
                $product['tittle'] . '<br>' . '<small>' . $product['partnumber'] . '</small>',
                'Rp.' . number_format($product['price']) . '/' . $product['unit'] . '<br>' . '<small>' .
                    'Rp.' . number_format($product['price_promo']) . '/' . $product['unit'] . '</small>',
                '<span class="label label-default">' . ($this->namectgr($product['brand'])) . '</span>' . '<br>' . '<small>' . ($this->namectgr($product['type'])) . '</small>',
                '<span class="label label-' . $k . '">' . $product["stock"] . '</span>',
                '<span class="label label-' . $w . '">' . $product["warranty"] . '</span>',
                '<a class="label label-warning" href="' . base_url() . 'backendproduct/form?id=' . $product["id"] . '"><i class="fa fa-edit"></i></a>',
                '<a class="label label-primary" href="' . base_url() . 'backendproduct/galery?id=' . $product["id"] . '"><i class="fa fa-file-image-o"></i></a>',
                '<a class="label click label-danger" onclick="hapus(' . $product["id"] . ',\'' . $product["tittle"] . '\')"
                    url="' . base_url() . 'backendproduct/hapus?id=' . $product["id"] . '"><i class="fa fa-trash"></i></a>'

            );
        }

        echo json_encode($output);
    }


    public function namectgr($id)
    {
        $namectgr = "";
        $ctgr = unserialize(CATEGORY_ALL);
        foreach ($ctgr as $key) {
            if ($key["id"] == $id) {
                $namectgr = $key["name"];
            }
        }
        return $namectgr;
    }




    public function productstatus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $data = array('status' => $this->input->get("status"));
        $where = array('id' => $this->input->get("id"));
        $this->etx_product->editproduct($data, $where);
        $this->session->set_flashdata('message', 'Produk telah diedit');
        if (isset($last_page)) {
            redirect($last_page);
        } else {
            redirect(base_url() . 'backendproduct/listall');
        }
    }
    public function galery()
    {
        $id = $this->input->get("id");
        $data["product"] = $this->etx_product->getproduct(array('id' => $id));
        $data['content'] = 'galery';
        $data['js'] = array(base_url() . 'asset/backend/js/backendproductgalery.js');;
        $this->load->view('backend/template_front', $data);
    }

    public function form()
    {
        $data['content'] = 'form';
        if ($this->input->get("id") != "") {
            $data["backingdata"] = $this->etx_product->getproduct(array('id' => $this->input->get("id")));
            if (empty($data["backingdata"])) {
                $this->session->set_flashdata('message', 'Tidak ada produk dengan id ' . $this->input->get("id"));
                redirect(base_url() . "backendproduct/form");
                exit();
            }
        }

        $data["js"] = array('/modules/backendproduct/js/form.product.js');
        $data["css"] = array('/modules/backendproduct/css/form.css');
        $this->load->view('backend/template_front', $data);
    }

    public function addgalery()
    {

        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendproduct/galery?id=" . $id);
            exit();
        }
        $config['upload_path'] = './public/image/galery/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = microtime() . ".jpg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (! $this->upload->do_upload("filegalery")) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di tambah, coba ulangi lagi' . $this->upload->display_errors());
            redirect(base_url() . "backendproduct/galery?id=" . $id);
            exit();
        } else {
            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddgalery = array('img' => $namenewfile, 'product' => $id);
            $this->etx_product->addgalery($dataaddgalery);
            $this->watermarkoverlay($namenewfile, "galery");
            $this->session->set_flashdata('message', 'Gambar galeri di tambah');
            redirect(base_url() . "backendproduct/galery?id=" . $id);
            exit();
        }
    }

    public function addproduct()
    {
        $unit = ($this->input->post('unit') != "") ? $this->input->post('unit') : "1 Pc";
        $dimention_array = explode("x", $this->input->post('dimention'));
        if (count($dimention_array) != 3) {
            $dimention_array[0] = "0";
            $dimention_array[1] = "0";
            $dimention_array[2] = "0";
        }
        $datainput = array(
            'tittle' => preg_replace('/[.,\/]/', "", $this->input->post('tittle')),
            'partnumber' => empty($this->input->post('partnumber')) ? "" : $this->input->post('partnumber'),
            'physicnumber' => empty($this->input->post('physicnumber')) ? "" : $this->input->post('physicnumber'),
            'partnumber_trumecs' => empty($this->input->post('partnumber_trumecs')) ? "" : $this->input->post('partnumber_trumecs'),
            'price' => empty($this->input->post('price')) ? "" : str_replace(".", "", $this->input->post('price')),
            'price_promo' => empty($this->input->post('price_promo')) ? "" : str_replace(".", "", $this->input->post('price_promo')),
            'promo_cbd_price' => empty($this->input->post('promo_cbd_price')) ? "" : str_replace(".", "", $this->input->post('promo_cbd_price')),
            'promo_volume' => empty($this->input->post('promo_volume')) ? "" : str_replace(".", "", $this->input->post('promo_volume')),
            'promo_volume_price' => empty($this->input->post('promo_volume_price')) ? "" : str_replace(".", "", $this->input->post('promo_volume_price')),
            'promo_referral_price' => empty($this->input->post('promo_referral_price')) ? "" : str_replace(".", "", $this->input->post('promo_referral_price')),
            'brand' => empty($this->input->post('brand')) ? "" : $this->input->post('brand'),
            'type' => empty($this->input->post('type')) ? "" : $this->input->post('type'),
            'component' => empty($this->input->post('component')) ? "" : $this->input->post('component'),
            'quality' => empty($this->input->post('quality')) ? "" : $this->input->post('quality'),
            'warranty' => empty($this->input->post('warranty')) ? "" : $this->input->post('warranty'),
            'warrantyvendor' => empty($this->input->post('warranty_vendor')) ? "" : $this->input->post('warranty_vendor'),
            'livetime' => empty($this->input->post('livetime')) ? "" : $this->input->post('livetime'),
            'stock' => str_replace(",", "", $this->input->post('stock')),
            'moq' => str_replace(",", "", $this->input->post('moq')),
            'weight' => empty($this->input->post('weight')) ? "" : $this->input->post('weight'),
            'sx' => $dimention_array[0], //$this->input->post('sx'),
            'sy' => $dimention_array[1], //$this->input->post('sy'),
            'sz' => $dimention_array[2],      /*  
                'px'=>$this->input->post('px'),
                'py'=>$this->input->post('py'),
                'pz'=>$this->input->post('pz'),*/
            'packagin' => empty($this->input->post('packagin')) ? "" : $this->input->post('packagin'),
            ##'img'=>$this->input->post('namefile'),
            'unit' => $unit,
            'ppn' => "10",
            'youtube' => $this->input->post('youtube'),
            'jenisproduct' => $this->input->post('jenisproduct'),
            'link_tokped' => $this->input->post('link_tokped'),
            'link_bukalapak' => $this->input->post('link_bukalapak'),
            'link_shopee' => $this->input->post('link_shopee'),
            'link_blibli' => $this->input->post('link_blibli'),
            'availability_at' => empty($this->input->post('availability_at')) ? "INDONESIA" : $this->input->post('availability_at'),
            'estimated_delivery' => empty($this->input->post('estimated_delivery')) ? "3" : $this->input->post('estimated_delivery'),
            'estimated_deliveryindent' => empty($this->input->post('estimated_deliveryindent')) ? "7" : $this->input->post('estimated_deliveryindent'),
            'description' => empty($this->input->post('description')) ? "" : nl2br($this->input->post('description')),
            'area' => empty($this->input->post('area')) ? "0" : $this->input->post('area'),

        );
        $dataattribute = array(
            'attribute' => $this->input->post('attribute'),
            'value' => $this->input->post('value')
        );
        $config['upload_path'] = './public/image/product/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = microtime() . ".jpg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        #var_dump($datainput);exit();
        if (! $this->upload->do_upload("fileimg")) {
            $this->session->set_flashdata('message', 'Gambar tidak bisa di upload' . $this->upload->display_errors());
            $this->session->set_flashdata('backingdata', $datainput);
            /*echo "<script>
                            alert('Gambar tidak bisa di upload ');
                            window.history.back();
                        </script>";*/
            redirect(base_url() . "backendproduct/form");
            exit();
        } else {

            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddimg = array('img' => $namenewfile);
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->watermarkoverlay($namenewfile, "product");
            //var_dump($alldatainput);exit();
            $this->etx_product->addproduct($alldatainput);
            $this->etx_product->addattribute($dataattribute, array('product_id' => $this->db->insert_id()));
            $this->session->set_flashdata('message', 'Produk di tambah, Silahkan tambah galery produk baru');
            redirect(base_url() . "backendproduct/listall");
            exit();
        }
        redirect(base_url() . 'backendproduct');
    }

    public function updateproduct()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendproduct/form");
            exit();
        }
        $where = array('id' => $this->input->post('id'));
        $where2 = array('product_id' => $this->input->post('id'));
        $unit = ($this->input->post('unit') != "") ? $this->input->post('unit') : "1 Pc";
        $dimention_array = explode("x", $this->input->post('dimention'));
        if (count($dimention_array) != 3) {
            $dimention_array[0] = "0";
            $dimention_array[1] = "0";
            $dimention_array[2] = "0";
        }
        $datainput = array(
            'tittle' => preg_replace('/[.,\/]/', "", $this->input->post('tittle')),
            'partnumber' => empty($this->input->post('partnumber')) ? "" : $this->input->post('partnumber'),
            'physicnumber' => empty($this->input->post('physicnumber')) ? "" : $this->input->post('physicnumber'),
            'partnumber_trumecs' => empty($this->input->post('partnumber_trumecs')) ? "" : $this->input->post('partnumber_trumecs'),
            'price' => empty($this->input->post('price')) ? "" : str_replace(".", "", $this->input->post('price')),
            'price_promo' => empty($this->input->post('price_promo')) ? "" : str_replace(".", "", $this->input->post('price_promo')),
            'promo_cbd_price' => empty($this->input->post('promo_cbd_price')) ? "" : $this->input->post('promo_cbd_price'),
            'promo_volume' => empty($this->input->post('promo_volume')) ? "" : str_replace(".", "", $this->input->post('promo_volume')),
            'promo_volume_price' => empty($this->input->post('promo_volume_price')) ? "" : $this->input->post('promo_volume_price'),
            'promo_referral_price' => empty($this->input->post('promo_referral_price')) ? "" : $this->input->post('promo_referral_price'),
            'quality' => empty($this->input->post('quality')) ? "" : $this->input->post('quality'),
            'warranty' => empty($this->input->post('warranty')) ? "" : $this->input->post('warranty'),
            'warrantyvendor' => empty($this->input->post('warranty_vendor')) ? "" : $this->input->post('warranty_vendor'),
            'livetime' => empty($this->input->post('livetime')) ? "" : $this->input->post('livetime'),
            'stock' => str_replace(",", "", $this->input->post('stock')),
            'moq' => str_replace(",", "", $this->input->post('moq')),
            'weight' => empty($this->input->post('weight')) ? "" : $this->input->post('weight'),
            'sx' => $dimention_array[0], //$this->input->post('sx'),
            'sy' => $dimention_array[1], //$this->input->post('sy'),
            'sz' => $dimention_array[2],/*  
                'px'=>$this->input->post('px'),
                'py'=>$this->input->post('py'),
                'pz'=>$this->input->post('pz'),*/
            'brand' => empty($this->input->post('brand')) ? "" : $this->input->post('brand'),
            'area' => empty($this->input->post('area')) ? "0" : $this->input->post('area'),
            'brand_unit' => empty($this->input->post('brand_unit')) ? "" : $this->input->post('brand_unit'),
            'type' => empty($this->input->post('type')) ? "" : $this->input->post('type'),
            'component' => empty($this->input->post('component')) ? "" : $this->input->post('component'),
            'packagin' => empty($this->input->post('packagin')) ? "" : $this->input->post('packagin'),
            #'img'=>$this->input->post('namefile'),
            'unit' => $unit,
            'ppn' => "10",
            'youtube' => $this->input->post('youtube'),
            'link_tokped' => $this->input->post('link_tokped'),
            'link_bukalapak' => $this->input->post('link_bukalapak'),
            'link_shopee' => $this->input->post('link_shopee'),
            'link_blibli' => $this->input->post('link_blibli'),
            'jenisproduct' => $this->input->post('jenisproduct'),
            'availability_at' => empty($this->input->post('availability_at')) ? "INDONESIA" : $this->input->post('availability_at'),
            'estimated_delivery' => empty($this->input->post('estimated_delivery')) ? "3" : $this->input->post('estimated_delivery'),
            'estimated_deliveryindent' => empty($this->input->post('estimated_deliveryindent')) ? "7" : $this->input->post('estimated_deliveryindent'),
            'description' => empty($this->input->post('description')) ? "" : nl2br($this->input->post('description'))
        );
        $dataattribute = array(
            'attribute' => $this->input->post('attribute[]'),
            'value' => $this->input->post('value[]')
        );

        var_dump($dataattribute);

        if (empty($_FILES['fileimg']['name'])) {
            $dataaddimg = array('img' => $this->input->post('imgold'));
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->etx_product->updateproduct($alldatainput, $where);
            $this->etx_product->addattribute($dataattribute, $where2);
            $this->session->set_flashdata('message', 'Produk diedit , tanpa mengubah gambar');
            redirect(base_url() . "backendproduct/listall");
            exit();
        } else {
            $config['upload_path'] = './public/image/product/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".jpg";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '1000';
            $config['max_width']  = '3000';
            $config['max_height']  = '3000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileimg")) {
                $this->session->set_flashdata('message', 'Gambar tidak bisa di upload' . $this->upload->display_errors());
                //$this->session->set_flashdata('backingdata', $datainput);
                redirect(base_url() . "backendproduct/form?id=" . $this->input->post('id'));
                exit();
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                //var_dump($alldatainput);exit();
                $this->etx_product->updateproduct($alldatainput, $where);
                $this->etx_product->addattribute($dataattribute, $where2);
                $this->watermarkoverlay($namenewfile, "product");
                unlink("./public/image/product/" . $this->input->post('imgold'));
                $this->session->set_flashdata('message', 'Produk diedit');
                redirect(base_url() . "backendproduct/listall");
                exit();
            }
        }

        redirect(base_url() . 'backendproduct');
    }

    public function hapus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $where = array('id' => $this->input->get("id"));
        $this->etx_product->hapus($where);
        $this->session->set_flashdata('message', 'Produk telah dihapus');
        if (isset($last_page)) {
            redirect($last_page);
        } else {
            redirect(base_url() . 'backendproduct/listall');
        }
    }
    public function hapusgalery()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $where = array('id' => $this->input->get("id"));
        unlink("./public/image/galery/" . $this->input->get("im"));
        $this->etx_product->hapusgalery($where);
        $this->session->set_flashdata('message', 'Gambar telah di hapus');
        if (isset($last_page)) {
            redirect($last_page);
        } else {
            redirect(base_url() . 'backendproduct/listall');
        }
    }

    public function categori()
    {
        $data['content'] = 'category';
        $data['js'] = array('/modules/backendproduct/js/category.product.js');
        $data['grades'] = $this->grade_model->getgrade();
        $data['attributes'] = $this->etx_product->getattribute();
        $this->load->view('backend/template_front', $data);
    }


    public function hapuscategory()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_product->deletecategory($where);
        $this->session->set_flashdata('message', 'kategori telah di hapus');
        redirect(base_url() . 'backendproduct/categori');
    }
    public function updatecategory()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('parent', 'Parent', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendproduct/categori");
            exit();
        }
        $where = array('id' => $this->input->post("id"));
        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9]\-/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('parent')
        );

        if (empty($_FILES['fileupload']['name'])) {
            $dataaddimg = array('img' => (($this->input->post('imgold')) == "") ? '' : $this->input->post('imgold'));
            $this->session->set_flashdata('message', 'Kategori di tambah, tanpa mengubah gambar');
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->etx_product->updatecategory($where, $alldatainput);
            $this->etx_product->setcategorygrade($this->input->post('grade[]'), $id);
            $this->etx_product->setcategorybrand($this->input->post('merk[]'), $id);
            $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $id);
            redirect(base_url() . "backendproduct/categori");
            exit();
        } else {
            if (empty($_FILES['fileupload']['name'])) {
                $alldatainput = array_merge($datainput);
                $this->etx_product->updatecategory($where, $datainput);
                $this->etx_product->setcategorygrade($this->input->post('grade[]'), $id);
                $this->etx_product->setcategorybrand($this->input->post('merk[]'), $id);
                $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $id);
                $this->session->set_flashdata('message', 'Kategori di tambah, tanpa gambar');
                redirect(base_url() . "backendproduct/categori");
                exit();
            } else {
                $config['upload_path'] = './public/image/icon/upload/';
                $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
                $config['file_name'] = microtime() . ".jpg";
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = '1000';
                $config['max_width']  = '1000';
                $config['max_height']  = '1000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (! $this->upload->do_upload("fileupload")) {
                    $this->session->set_flashdata('message', 'Gambar tidak bisa di upload ' . $this->upload->display_errors());
                    redirect(base_url() . "backendproduct/categori");
                    exit();
                } else {
                    $data = $this->upload->data();
                    $namenewfile = $data["file_name"];
                    $dataaddimg = array('img' => $namenewfile);
                    $alldatainput = array_merge($datainput, $dataaddimg);
                    $this->etx_product->updatecategory($where, $alldatainput);
                    $this->etx_product->setcategorygrade($this->input->post('grade[]'), $id);
                    $this->etx_product->setcategorybrand($this->input->post('merk[]'), $id);
                    $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $id);
                    $this->session->set_flashdata('message', 'Kategori di tambah');
                    redirect(base_url() . "backendproduct/categori");
                    exit();
                }
            }
        }

        redirect(base_url() . 'backendproduct/categori');
    }

    public function watermarkoverlay($nameimage, $folder)
    {
        $this->load->library('image_lib');
        $config['image_library']    = 'NetPBM';
        $config['source_image']     = './public/image/' . $folder . '/' . $nameimage;
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = './public/image/watermarking.png'; //the overlay image
        $config['wm_opacity']       = 80;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';

        $this->image_lib->initialize($config);

        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }

    public function download_exel_product($status = NULL)
    {
        $this->load->library("excel");
        $this->excel->setActiveSheetIndex(0);
        if ($status == NULL) {
            $data = $this->db
                ->select('product.id,product.partnumber_trumecs,product.partnumber,product.physicnumber,product.tittle as nama_produk,product.jenisproduct,c1.name as brand,c2.name as type,product.component,product.quality,product.stock,product.moq,product.price as harga,product.price_promo as harga_promo,product.warranty,product.warrantyvendor,product.packagin,product.weight,product.sx as dimensi_panjang,product.sy as dimensi_tinggi,product.sz as dimensi_lebar,product.livetime,product.made as buatan_negara,product.availability_at as tersedia_di,product.estimated_delivery as waktu_pengiriman,product.estimated_deliveryindent  as waktu_pengiriman_jika_inden,product.status')
                ->join('categori c1', 'c1.id = product.brand', "left")
                ->join('categori c2', 'c2.id = product.type', "left")
                ->get("product")->result_array();
            $file_name = "Produk_trumecs" . date("Y_m_d") . ".xls";
        } else {
            $data = $this->db
                ->select('product.id,product.partnumber_trumecs,product.partnumber,product.physicnumber,product.tittle as nama_produk,product.jenisproduct,c1.name as brand,c2.name as type,product.component,product.quality,product.stock,product.moq,product.price as harga,product.price_promo as harga_promo,product.warranty,product.warrantyvendor,product.packagin,product.weight,product.sx as dimensi_panjang,product.sy as dimensi_tinggi,product.sz as dimensi_lebar,product.livetime,product.made as buatan_negara,product.availability_at as tersedia_di,product.estimated_delivery as waktu_pengiriman,product.estimated_deliveryindent  as waktu_pengiriman_jika_inden')
                ->join('categori c1', 'c1.id = product.brand', "left")
                ->join('categori c2', 'c2.id = product.type', "left")
                ->where("status", $status)->join('categori', 'product.brand=categori.id')->get("product")->result_array();
            $file_name = "Produk_trumecs_" . $status . '_' . date("Y_m_d") . ".xls";
        }
        $this->excel->stream($file_name, $data);
    }

    public function category_brand_type_component()
    {
        $this->load->library("excel");
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('kategori');
        $data = $this->db
            ->select('id,name')->get("categori")->result_array();
        $file_name = "kategori_trumecs" . date("Y_m_d") . ".xls";
        $this->excel->stream($file_name, $data);
    }

    public function gradeAjaxList()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $order = $this->input->post('order')[0];

        $list = $this->grade_model->get_datatables($start, $length, $search, $order);
        $data = array();
        $no = $start;

        foreach ($list as $grade) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $grade->grade;
            $row[] = $grade->type == 0 ? 'Produk' : 'Mekanik';
            $row[] = '
            <button type="button" class="btn btn-warning btn-sm edit" data-id="' . $grade->id . '" data-grade="' . $grade->grade . '" data-type="' . $grade->type . '">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $grade->id . '" data-name="' . $grade->grade . '">
                <i class="fas fa-trash"></i>
            </button>
        ';

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->grade_model->count_all(),
            "recordsFiltered" => $this->grade_model->count_filtered($search),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function gradeAjaxAdd()
    {

        $data = array(
            'grade' => $this->input->post('grade'),
            'type' => $this->input->post('type')
        );

        $insert = $this->grade_model->insert_grade($data);

        if ($insert) {
            echo json_encode(array("status" => true, "message" => "Grade added successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to add grade"));
        }
    }

    public function gradeAjaxUpdate()
    {

        $id = $this->input->post('id');
        $data = array(
            'grade' => $this->input->post('grade'),
            'type' => $this->input->post('type')
        );
        $update = $this->grade_model->update_grade($id, $data);

        if ($update) {
            echo json_encode(array("status" => true, "message" => "Grade updated successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to update grade"));
        }
    }

    // Delete grade
    public function gradeAjaxDelete()
    {
        $id = $this->input->post('id');
        $delete = $this->grade_model->delete_grade($id);

        if ($delete) {
            echo json_encode(array("status" => true, "message" => "Grade deleted successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to delete grade"));
        }
    }

    public function attributeAjaxList()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $order = $this->input->post('order')[0];

        $list = $this->attribute_model->get_datatables($start, $length, $search, $order);
        $data = array();
        $no = $start;

        foreach ($list as $attribute) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $attribute->name;
            $row[] = '
            <button type="button" class="btn btn-warning btn-sm edit" data-id="' . $attribute->id . '" data-attribute="' . $attribute->name . '">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $attribute->id . '" data-name="' . $attribute->name . '">
                <i class="fas fa-trash"></i>
            </button>
        ';

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->attribute_model->count_all(),
            "recordsFiltered" => $this->attribute_model->count_filtered($search),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function attributeAjaxAdd()
    {

        $data = array(
            'name' => $this->input->post('name'),
        );

        $insert = $this->attribute_model->insert_attribute($data);

        if ($insert) {
            echo json_encode(array("status" => true, "message" => "attribute added successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to add attribute"));
        }
    }

    public function attributeAjaxUpdate()
    {

        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
        );

        $update = $this->attribute_model->update_attribute($id, $data);

        if ($update) {
            echo json_encode(array("status" => true, "message" => "attribute updated successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to update attribute"));
        }
    }

    // Delete attribute
    public function attributeAjaxDelete()
    {
        $id = $this->input->post('id');
        $delete = $this->attribute_model->delete_attribute($id);

        if ($delete) {
            echo json_encode(array("status" => true, "message" => "attribute deleted successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to delete attribute"));
        }
    }

    public function categoriAjaxList($type = null)
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $order = $this->input->post('order')[0];

        // Jika type dari parameter, override POST
        if ($type) {
            $_POST['type'] = $type;
        }

        $type = $this->input->post('type');

        if ($type) {
            $list = $this->categori_model->get_datatables_by_type($start, $length, $search, $order, $type);
            $recordsFiltered = $this->categori_model->count_filtered_by_type($search, $type);
        } else {
            $list = $this->categori_model->get_datatables($start, $length, $search, $order);
            $recordsFiltered = $this->categori_model->count_filtered($search);
        }



        $data = array();
        $no = $start;

        foreach ($list as $categori) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ($categori->img != null)
                ? '<img src="' . base_url() . '/public/upload/categori/' . $categori->img . '" class="img-thumbnail" style="max-height: 50px;">'
                :  '<img src="' . base_url() . '/public/image/noimage.png' . '" class="img-thumbnail" style="max-height: 50px;">';
            $row[] = $this->categori_model->get_parent_info($categori->id);
            if ($type == 'brand') {
                $action =  '
    <button type="button" class="btn btn-warning btn-sm edit-brand" 
            data-id="' . $categori->id . '" 
            data-name="' . $categori->name . '"
            data-image="' . $categori->img . '">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" class="btn btn-danger btn-sm delete-brand" 
            data-id="' . $categori->id . '"
            data-name="' . $categori->name . '">
        <i class="fa fa-trash"></i>
    </button>
';
            } elseif (($type == "main_category" || $type == "main_category_jasa") && $categori->parent == 0) {
                $action = '
        <button type="button" class="btn btn-warning btn-sm edit-categori" data-id="' . $categori->id . '" data-categori="' . $categori->name . '">
            <i class="fa fa-edit"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm delete-categori" data-id="' . $categori->id . '" data-name="' . $categori->name . '">
            <i class="fa fa-trash"></i>
        </button>
    ';
            } else {
                $category_type = $this->categori_model->get_category_type_info($categori->id);
                if ($category_type == 'sub_category') {
                    // Ini benar-benar sub category (level 1)
                    $action = '
                    <button type="button" class="btn btn-warning btn-sm edit-subcategori" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '"
                            data-parent="' . $categori->parent . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-subcategori" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                } elseif ($category_type == 'subsub_category') {
                    $action = '
                    <button type="button" class="btn btn-warning btn-sm edit-subsubcategori" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '"
                            data-parent="' . $categori->parent . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-subsubcategori" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                } elseif ($category_type == 'sub_category_jasa') {
                    $action = '
                    <button type="button" class="btn btn-warning btn-sm edit-subcategori-jasa" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '"
                            data-parent="' . $categori->parent . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-subcategori-jasa" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                } elseif ($category_type == 'subsub_category_jasa') {
                    $action = '
                    <button type="button" class="btn btn-warning btn-sm edit-subsubcategori-jasa" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '"
                            data-parent="' . $categori->parent . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-subsubcategori-jasa" 
                            data-id="' . $categori->id . '" 
                            data-name="' . $categori->name . '">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                }
            }
            $row[] = $action;

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->categori_model->count_all(),
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function categoriAjaxAdd()
    {
        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9]\-/", "", str_replace(" ", "-", $this->input->post('name'))),
            'etc' => $this->input->post('etc'),
            'parent' => 0,
            'parent_brand' => 0
        );

        if (empty($_FILES['fileupload']['name'])) {
            $alldatainput = array_merge($datainput);
            $addcategory = $this->categori_model->insert_categori($datainput);
            $idcategory = $this->db->insert_id();
            $this->etx_product->setcategorygrade($this->input->post('grade[]'), $idcategory);
            $this->etx_product->setcategorybrand($this->input->post('merk[]'), $idcategory);
            $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $idcategory);
            if ($addcategory) {
                echo json_encode(array("status" => true, "message" => "Categori Added successfully without pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to add Categori"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";

            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileupload")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload pic"));
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $addcategory = $this->categori_model->insert_categori($alldatainput);
                $idcategory = $this->db->insert_id();
                $this->etx_product->setcategorygrade($this->input->post('grade[]'), $idcategory);
                $this->etx_product->setcategorybrand($this->input->post('merk[]'), $idcategory);
                $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $idcategory);
                if ($addcategory) {
                    echo json_encode(array("status" => true, "message" => "Categori Added successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to add Categori"));
                }
            }
        }
    }

    public function categoriAjaxUpdate()
    {

        $id = $this->input->post('id');
        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9]\-/", "", str_replace(" ", "-", $this->input->post('name'))),
            'etc' => $this->input->post('etc'),
        );
        if (empty($_FILES['fileuploadEdit']['name'])) {
            $dataaddimg = array('img' => (($this->input->post('edit_image_category_value')) == "") ? '' : $this->input->post('edit_image_category_value'));
            $alldatainput = array_merge($datainput, $dataaddimg);
            $updatecategori = $this->categori_model->update_categori($id, $alldatainput);
            $this->etx_product->setcategorygrade($this->input->post('grade[]'), $id);
            $this->etx_product->setcategorybrand($this->input->post('merk[]'), $id);
            $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $id);
            if ($updatecategori) {
                echo json_encode(array("status" => true, "message" => "Categori Updated successfully without uploaded new pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to update Categori"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".jpg";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileuploadEdit")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload pic"));
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $updatecategori = $this->categori_model->update_categori($id, $alldatainput);
                $this->etx_product->setcategorygrade($this->input->post('grade[]'), $id);
                $this->etx_product->setcategorybrand($this->input->post('merk[]'), $id);
                $this->etx_product->setcategoryattribute($this->input->post('attribute[]'), $id);
                if ($updatecategori) {
                    echo json_encode(array("status" => true, "message" => "Categori Updated successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to update Categori"));
                }
            }
        }
    }

    public function categoriAjaxDelete()
    {
        $id = $this->input->post('id');
        $delete = $this->categori_model->delete_categori($id);

        if ($delete) {
            echo json_encode(array("status" => true, "message" => "Categori deleted successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to delete Categori"));
        }
    }

    public function getMainCategories()
    {
        $main_categories = $this->categori_model->get_main_categories();

        $categories = array();
        foreach ($main_categories as $category) {
            $categories[] = array(
                'id' => $category->id,
                'name' => $category->name
            );
        }

        echo json_encode(array("status" => true, "data" => $categories));
    }

    public function getCategoryById($id)
    {

        // Pastikan ID valid
        if (empty($id) || !is_numeric($id)) {
            $response = array(
                "status" => false,
                "message" => "Invalid category ID: " . $id
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        $category = $this->categori_model->get_categori_by_id($id);

        if ($category) {
            // Get related grades
            $category->grades = $this->grade_model->get_grades_by_categori($id);

            $category->brands = $this->categori_model->get_brand_by_categori($id);

            $category->attributes = $this->attribute_model->get_attribute_by_categori($id);
            $response = array(
                "status" => true,
                "data" => $category
            );
        } else {
            $response =  array(
                "status" => false,
                "message" => "Category not found"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function getGrades()
    {
        $grades = $this->grade_model->getgrade();

        $main_grade = array();
        foreach ($grades as $grade) {
            $main_grade[] = array(
                'id' => $grade->id,
                'grade' => $grade->grade,
                'type' => $grade->type == 0 ? "product" : "mekanik"
            );
        }

        echo json_encode(array("status" => true, "data" => $main_grade));
    }

    public function getBrands()
    {
        $brands = $this->categori_model->get_brands();

        $main_brands = array();
        foreach ($brands as $brand) {
            $main_brands[] = array(
                'id' => $brand->id,
                'name' => $brand->name
            );
        }

        echo json_encode(array("status" => true, "data" => $main_brands));
    }

    public function getAttributes()
    {
        $attributes = $this->attribute_model->getattribute();

        $main_attributes = array();
        foreach ($attributes as $attribute) {
            $main_attributes[] = array(
                'id' => $attribute->id,
                'name' => $attribute->name,
            );
        }

        echo json_encode(array("status" => true, "data" => $main_attributes));
    }

    public function getSubCategories($parent_id)
    {
        $sub_categories = $this->categori_model->get_sub_categories($parent_id);

        $categories = array();
        foreach ($sub_categories as $category) {
            $categories[] = array(
                'id' => $category->id,
                'name' => $category->name
            );
        }

        echo json_encode(array("status" => true, "data" => $categories));
    }

    public function getMainCategoriesJasa()
    {
        $main_categories = $this->categori_model->get_main_categories_jasa();

        $categories = array();
        foreach ($main_categories as $category) {
            $categories[] = array(
                'id' => $category->id,
                'name' => $category->name
            );
        }

        echo json_encode(array("status" => true, "data" => $categories));
    }

    public function getSubCategoriesJasa($parent_id)
    {
        $sub_categories = $this->categori_model->get_sub_categories_jasa($parent_id);

        $categories = array();
        foreach ($sub_categories as $category) {
            $categories[] = array(
                'id' => $category->id,
                'name' => $category->name
            );
        }

        echo json_encode(array("status" => true, "data" => $categories));
    }

    public function addSubCategoriAjax()
    {
        // Validasi
        $this->form_validation->set_rules('mainCategoriId', 'Main Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriId'),
            'parent_brand' => 0,
            'etc' => 0,
            'is_brand' => 0,
            'is_tag' => 0,
        );

        if (empty($_FILES['fileuploadSub']['name'])) {
            $alldatainput = array_merge($datainput);
            $addcategory = $this->categori_model->insert_categori($datainput);
            if ($addcategory) {
                echo json_encode(array("status" => true, "message" => "Sub Categori Added successfully without pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to add Sub Categori"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileuploadSub")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload pic"));
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $addcategory = $this->categori_model->insert_categori($alldatainput);
                if ($addcategory) {
                    echo json_encode(array("status" => true, "message" => "Sub Categori Added successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to add Sub Categori"));
                }
            }
        }
    }

    public function updateSubCategoriAjax()
    {
        $this->form_validation->set_rules('edit_subcategori_id', 'Sub Category ID', 'required');
        $this->form_validation->set_rules('mainCategoriEditId', 'Main Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $id = $this->input->post('edit_subcategori_id');

        $existing = $this->categori_model->get_categori_by_id($id);
        if (!$existing) {
            echo json_encode(array("status" => false, "message" => "Sub Category not found"));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriEditId'),
        );

        if (empty($_FILES['fileuploadSubEdit']['name'])) {
            // Update tanpa gambar baru
            $updatecategory = $this->categori_model->update_categori($id, $datainput);
            if ($updatecategory) {
                echo json_encode(array("status" => true, "message" => "Sub Categori updated successfully without new pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to update Sub Categori"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("fileuploadSubEdit")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload image: " . $this->upload->display_errors()));
                return;
            } else {
                $data = $this->upload->data();
                $datainput['img'] = $data["file_name"];

                // Hapus file lama jika ada
                if (!empty($existing->img)) {
                    $old_file = './public/upload/categori/' . $existing->img;
                    if (file_exists($old_file)) {
                        @unlink($old_file);
                    }
                }

                $updatecategory = $this->categori_model->update_categori($id, $datainput);
                if ($updatecategory) {
                    echo json_encode(array("status" => true, "message" => "Sub Categori updated successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to update Sub Categori"));
                }
            }
        }
    }

    public function updateSubCategoriJasaAjax()
    {
        $this->form_validation->set_rules('edit_subcategori_jasa_id', 'Sub Category ID', 'required');
        $this->form_validation->set_rules('mainCategoriJasaEditId', 'Main Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $id = $this->input->post('edit_subcategori_jasa_id');

        // Cek apakah sub kategori ada
        $existing = $this->categori_model->get_categori_by_id($id);
        if (!$existing) {
            echo json_encode(array("status" => false, "message" => "Sub Category not found"));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriJasaEditId'),
        );

        if (empty($_FILES['fileuploadSubJasaEdit']['name'])) {
            // Update tanpa gambar baru
            $updatecategory = $this->categori_model->update_categori($id, $datainput);
            if ($updatecategory) {
                echo json_encode(array("status" => true, "message" => "Sub Categori Jasa updated successfully without new pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to update Sub Categori Jasa"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("fileuploadSubJasaEdit")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload image: " . $this->upload->display_errors()));
                return;
            } else {
                $data = $this->upload->data();
                $datainput['img'] = $data["file_name"];

                // Hapus file lama jika ada
                if (!empty($existing->img)) {
                    $old_file = './public/upload/categori/' . $existing->img;
                    if (file_exists($old_file)) {
                        @unlink($old_file);
                    }
                }

                $updatecategory = $this->categori_model->update_categori($id, $datainput);
                if ($updatecategory) {
                    echo json_encode(array("status" => true, "message" => "Sub Categori Jasa updated successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to update Sub Categori Jasa"));
                }
            }
        }
    }

    public function addSubSubCategoriAjax()
    {
        // Validasi
        $this->form_validation->set_rules('mainCategoriSubSubId', 'Main Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriSubSubId'),
            'parent_brand' => 0,
            'etc' => 0,
            'is_brand' => 0,
            'is_tag' => 0,
        );

        if (empty($_FILES['fileuploadSubSub']['name'])) {
            $alldatainput = array_merge($datainput);
            $addcategory = $this->categori_model->insert_categori($datainput);
            if ($addcategory) {
                echo json_encode(array("status" => true, "message" => "Sub Sub Categori Added successfully without pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to add Sub Sub Categori"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileuploadSubSub")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload pic"));
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $addcategory = $this->categori_model->insert_categori($alldatainput);
                if ($addcategory) {
                    echo json_encode(array("status" => true, "message" => "Sub Categori Added successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to add Sub Categori"));
                }
            }
        }
    }

    public function getSubSubCategoryById($id)
    {
        $category = $this->categori_model->get_categori_by_id($id);

        if ($category) {
            // Get parent category (sub category)
            $parentCategory = $this->categori_model->get_categori_by_id($category->parent);

            // Get grandparent category (main category) - parent dari sub category
            $grandparentCategory = null;
            if ($parentCategory) {
                $grandparentCategory = $this->categori_model->get_categori_by_id($parentCategory->parent);
            }

            $data = array(
                'id' => $category->id,
                'name' => $category->name,
                'img' => $category->img,
                'parent_id' => $category->parent,
                'parent_name' => $parentCategory ? $parentCategory->name : '',
                'grandparent_id' => $grandparentCategory ? $grandparentCategory->id : '',
                'grandparent_name' => $grandparentCategory ? $grandparentCategory->name : ''
            );

            echo json_encode(array("status" => true, "data" => $data));
        } else {
            echo json_encode(array("status" => false, "message" => "Category not found"));
        }
    }

    // Method untuk update sub sub category
    public function editSubSubCategoriAjax()
    {
        // Validasi
        $this->form_validation->set_rules('edit_subsubcategori_id', 'ID', 'required');
        $this->form_validation->set_rules('mainCategoriSubSubEditId', 'Sub Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $id = $this->input->post('edit_subsubcategori_id');

        // Periksa apakah kategori ada
        $existing = $this->categori_model->get_categori_by_id($id);
        if (!$existing) {
            echo json_encode(array("status" => false, "message" => "Sub Sub Category not found"));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriSubSubEditId'),
        );

        // Handle file upload jika ada
        if (!empty($_FILES['fileuploadSubSubEdit']['name'])) {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = time() . '_' . rand(1000, 9999) . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $config['overwrite'] = false;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("fileuploadSubSubEdit")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload image: " . $this->upload->display_errors()));
                return;
            } else {
                $data = $this->upload->data();
                $datainput['img'] = $data["file_name"];

                // Hapus file lama jika ada
                if ($existing->img && file_exists('./public/upload/categori/' . $existing->img)) {
                    unlink('./public/upload/categori/' . $existing->img);
                }
            }
        } else {
            // Jika tidak upload file baru, tetap gunakan gambar lama
            if ($this->input->post('edit_image_subsubcategory_value')) {
                $datainput['img'] = $this->input->post('edit_image_subsubcategory_value');
            }
        }

        // Update kategori
        $updatecategory = $this->categori_model->update_categori($id, $datainput);
        if ($updatecategory) {
            echo json_encode(array("status" => true, "message" => "Sub Sub Category updated successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to update Sub Sub Category"));
        }
    }

    // Method untuk mendapatkan sub categories berdasarkan main category (untuk edit)
    public function getSubCategoriesForEdit($mainCategoryId)
    {
        $subCategories = $this->categori_model->get_sub_categories($mainCategoryId);

        if ($subCategories) {
            echo json_encode(array("status" => true, "data" => $subCategories));
        } else {
            echo json_encode(array("status" => false, "message" => "No sub categories found"));
        }
    }

    public function addSubSubCategoriJasaAjax()
    {
        // Validasi
        $this->form_validation->set_rules('mainCategoriSubSubJasaId', 'Main Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriSubSubJasaId'),
            'parent_brand' => 0,
            'etc' => 1,
            'is_brand' => 0,
            'is_tag' => 0,
        );

        if (empty($_FILES['fileuploadSubSubJasa']['name'])) {
            $alldatainput = array_merge($datainput);
            $addcategory = $this->categori_model->insert_categori($datainput);
            if ($addcategory) {
                echo json_encode(array("status" => true, "message" => "Sub Sub Categori Jasa Added successfully without pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to add Sub Sub Categori Jasa"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileuploadSubSubJasa")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload pic"));
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $addcategory = $this->categori_model->insert_categori($alldatainput);
                if ($addcategory) {
                    echo json_encode(array("status" => true, "message" => "Sub Sub Categori Jasa Added successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to add Sub Sub Categori Jasa"));
                }
            }
        }
    }

    public function editSubSubCategoriJasaAjax()
    {
        // Validasi
        $this->form_validation->set_rules('edit_subsubcategori_jasa_id', 'ID', 'required');
        $this->form_validation->set_rules('mainCategoriSubSubJasaEditId', 'Sub Category', 'required');
        $this->form_validation->set_rules('name', 'Sub Sub Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("status" => false, "message" => validation_errors()));
            return;
        }

        $id = $this->input->post('edit_subsubcategori_jasa_id');

        // Periksa apakah kategori ada
        $existing = $this->categori_model->get_categori_by_id($id);
        if (!$existing) {
            echo json_encode(array("status" => false, "message" => "Sub Sub Category Jasa not found"));
            return;
        }

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriSubSubJasaEditId'),
        );

        // Handle file upload jika ada
        if (!empty($_FILES['fileuploadSubSubJasaEdit']['name'])) {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = time() . '_' . rand(1000, 9999) . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $config['overwrite'] = false;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("fileuploadSubSubJasaEdit")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload image: " . $this->upload->display_errors()));
                return;
            } else {
                $data = $this->upload->data();
                $datainput['img'] = $data["file_name"];

                // Hapus file lama jika ada
                if ($existing->img && file_exists('./public/upload/categori/' . $existing->img)) {
                    unlink('./public/upload/categori/' . $existing->img);
                }
            }
        } else {
            // Jika tidak upload file baru, tetap gunakan gambar lama
            if ($this->input->post('edit_image_subsubcategory_jasa_value')) {
                $datainput['img'] = $this->input->post('edit_image_subsubcategory_jasa_value');
            }
        }

        // Update kategori
        $updatecategory = $this->categori_model->update_categori($id, $datainput);
        if ($updatecategory) {
            echo json_encode(array("status" => true, "message" => "Sub Sub Category Jasa updated successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to update Sub Sub Category Jasa"));
        }
    }

    // Method untuk mendapatkan sub categories berdasarkan main category (untuk edit)
    public function getSubCategoriesJasaForEdit($mainCategoryId)
    {
        $subCategories = $this->categori_model->get_sub_categories($mainCategoryId);

        if ($subCategories) {
            echo json_encode(array("status" => true, "data" => $subCategories));
        } else {
            echo json_encode(array("status" => false, "message" => "No sub categories found"));
        }
    }

    // Method khusus untuk masing-masing type
    public function mainCategoriesAjaxList()
    {
        $this->categoriAjaxList('main_category');
    }

    public function mainCategoriesJasaAjaxList()
    {
        $this->categoriAjaxList('main_category_jasa');
    }

    public function subCategoriesJasaAjaxAdd()
    {

        $datainput = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9\-]/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => $this->input->post('mainCategoriJasaId'),
            'parent_brand' => 0,
            'etc' => 1,
            'is_brand' => 0,
            'is_tag' => 0,
        );

        if (empty($_FILES['fileuploadSubJasa']['name'])) {
            $alldatainput = array_merge($datainput);
            $addcategory = $this->categori_model->insert_categori($datainput);
            if ($addcategory) {
                echo json_encode(array("status" => true, "message" => "Sub Categori Jasa Added successfully without pic"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to add Sub Categori Jasa"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileuploadSubJasa")) {
                echo json_encode(array("status" => false, "message" => "Failed to upload pic"));
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $addcategory = $this->categori_model->insert_categori($alldatainput);
                if ($addcategory) {
                    echo json_encode(array("status" => true, "message" => "Sub Categori Jasa Added successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to add Sub Categori Jasa"));
                }
            }
        }
    }

    public function brandsAjaxList()
    {
        $this->categoriAjaxList('brand');
    }

    public function brandAjaxAdd()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9]\-/", "", str_replace(" ", "-", $this->input->post('name'))),
            'parent' => 0,
            'parent_brand' => 0,
            'etc' => 0,
            'is_brand' => 1,
        );
        if (empty($_FILES['logoBrand']['name'])) {
            $insertNopic = $this->categori_model->insert_categori($data);
            if ($insertNopic) {
                echo json_encode(array("status" => true, "message" => "Brand added successfully without Picture"));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to add Brand"));
            }
        } else {
            $config['upload_path'] = './public/upload/categori';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".png";
            $config['max_size'] = '1000';
            $config['max_width']  = '1000';
            $config['max_height']  = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("logoBrand")) {
                $this->session->set_flashdata('message', 'Gambar tidak bisa di upload ' . $this->upload->display_errors());
                redirect(base_url() . "backendproduct/categori");
                exit();
            } else {
                $dataImage = $this->upload->data();
                $namenewfile = $dataImage["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($data, $dataaddimg);
                $insertWithpic = $this->categori_model->insert_categori($alldatainput);
                if ($insertWithpic) {
                    echo json_encode(array("status" => true, "message" => "Brand added successfully"));
                } else {
                    echo json_encode(array("status" => false, "message" => "Failed to add Brand"));
                }
            }
        }
    }

    public function brandAjaxUpdate()
    {
        // Validasi input
        $this->form_validation->set_rules('id', 'ID', 'required|numeric');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                "status" => false,
                "message" => validation_errors()
            ));
            return;
        }

        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'url' => preg_replace("/[^a-zA-Z0-9]\-/", "", str_replace(" ", "-", $this->input->post('name'))),
        );

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['logoBrand']['name'])) {
            // Konfigurasi upload
            $config['upload_path'] = './public/upload/categori/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = time() . '_' . rand(1000, 9999) . '.png';
            $config['max_size'] = 1024; // 1MB
            $config['max_width'] = 1000;
            $config['max_height'] = 1000;
            $config['overwrite'] = false;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('logoBrand')) {
                echo json_encode(array(
                    "status" => false,
                    "message" => 'Upload gagal: ' . $this->upload->display_errors()
                ));
                return;
            } else {
                // Hapus file lama jika ada
                $old_image = $this->categori_model->get_image_path($id);
                if ($old_image && file_exists('./public/upload/categori/' . $old_image)) {
                    unlink('./public/upload/categori/' . $old_image);
                }

                $upload_data = $this->upload->data();
                $data['img'] = $upload_data['file_name'];
            }
        }

        // Update data
        $update = $this->categori_model->update_categori($id, $data);

        if ($update) {
            echo json_encode(array(
                "status" => true,
                "message" => "Brand updated successfully"
            ));
        } else {
            echo json_encode(array(
                "status" => false,
                "message" => "Failed to update brand"
            ));
        }
    }

    public function brandAjaxDelete()
    {
        $id = $this->input->post('id');
        $delete = $this->categori_model->delete_categori($id);

        if ($delete) {
            echo json_encode(array("status" => true, "message" => "Brand deleted successfully"));
        } else {
            echo json_encode(array("status" => false, "message" => "Failed to delete Brand"));
        }
    }

    public function modelsAjaxList()
    {
        $this->categoriAjaxList('model');
    }
}
