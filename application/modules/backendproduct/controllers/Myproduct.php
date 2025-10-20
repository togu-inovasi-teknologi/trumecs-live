<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myproduct extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_product");
        $session = $this->session->all_userdata();
        $this->sessionmember = array_key_exists("admin", $session) ? $session["admin"] : array('id' => 0);
    }
    public function index()
    {
        $this->securitylog->cekadmin();
        redirect(base_url() . "backendproduct/myproduct/listall");
    }
    public function listall()
    {

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
        $data["listproduct"] = $this->etx_product->fetch_product($config["per_page"], $page, $data["datasearch"], $data["datasearchor_like"], $data["datawhere"], $this->sessionmember['id']);

        $data["js"] = array(base_url() . 'asset/backend/js/list.product.js');
        $data['content'] = 'list_product';
        $this->load->view('backend/template_front', $data);
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

        $session = $this->session->all_userdata();
        $sessionmember = array_key_exists("admin", $session) ? $session["admin"] : array('id' => 0);

        $this->db->where('created_by', $this->sessionmember["id"]);

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
                '<a href="' . base_url() . 'backendproduct/myproduct/productstatus?id=' . $product["id"] . '&status=' . $s . '" class="label label-' . $l . '" alt="show"><i class="fa fa-' . $i . '"></i></a>',
                $product['tittle'] . '<br>' . '<small>' . $product['partnumber'] . '</small>',
                'Rp.' . number_format($product['price']) . '/' . $product['unit'] . '<br>' . '<small>' .
                    'Rp.' . number_format($product['price_promo']) . '/' . $product['unit'] . '</small>',
                '<span class="label label-default">' . ($this->namectgr($product['brand'])) . '</span>' . '<br>' . '<small>' . ($this->namectgr($product['type'])) . '</small>',
                '<span class="label label-' . $k . '">' . $product["stock"] . '</span>',
                '<span class="label label-' . $w . '">' . $product["warranty"] . '</span>',
                '<a class="label label-warning" href="' . base_url() . 'backendproduct/myproduct/form?id=' . $product["id"] . '"><i class="fa fa-edit"></i></a>',
                '<a class="label label-primary" href="' . base_url() . 'backendproduct/myproduct/galery?id=' . $product["id"] . '"><i class="fa fa-file-image-o"></i></a>',
                '<a class="label click label-danger" onclick="hapus(' . $product["id"] . ',\'' . $product["tittle"] . '\')"
                    url="' . base_url() . 'backendproduct/myproduct/hapus?id=' . $product["id"] . '"><i class="fa fa-trash"></i></a>'

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
            redirect(base_url() . 'backendproduct/myproduct/listall');
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
                redirect(base_url() . "backendproduct/myproduct/form");
                exit();
            }
        }

        $data["js"] = array(base_url() . 'asset/backend/js/form.product.js');
        $this->load->view('backend/template_front', $data);
    }

    public function addgalery()
    {

        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendproduct/myproduct/galery?id=" . $id);
            exit();
        }
        $config['upload_path'] = './public/image/galery/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = microtime() . ".jpg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (! $this->upload->do_upload("filegalery")) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di tambah, coba ulangi lagi' . $this->upload->display_errors());
            redirect(base_url() . "backendproduct/myproduct/galery?id=" . $id);
            exit();
        } else {
            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddgalery = array('img' => $namenewfile, 'product' => $id);
            $this->etx_product->addgalery($dataaddgalery);
            $this->watermarkoverlay($namenewfile, "galery");
            $this->session->set_flashdata('message', 'Gambar galeri di tambah');
            redirect(base_url() . "backendproduct/myproduct/galery?id=" . $id);
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
            'created_by' => $this->sessionmember["id"]
        );
        $config['upload_path'] = './public/image/product/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = microtime() . ".jpg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5000';
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
            redirect(base_url() . "backendproduct/myproduct/form");
            exit();
        } else {

            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddimg = array('img' => $namenewfile);
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->watermarkoverlay($namenewfile, "product");
            //var_dump($alldatainput);exit();
            $this->etx_product->addproduct($alldatainput);
            $this->session->set_flashdata('message', 'Produk di tambah, Silahkan tambah galery produk baru');
            redirect(base_url() . "backendproduct/myproduct/listall");
            exit();
        }
        redirect(base_url() . 'backendproduct/myproduct');
    }

    public function updateproduct()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendproduct/myproduct/form");
            exit();
        }
        $where = array('id' => $this->input->post('id'));
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

        if (empty($_FILES['fileimg']['name'])) {
            $dataaddimg = array('img' => $this->input->post('imgold'));
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->etx_product->updateproduct($alldatainput, $where);
            $this->session->set_flashdata('message', 'Produk diedit , tanpa mengubah gambar');
            redirect(base_url() . "backendproduct/myproduct/listall");
            exit();
        } else {
            $config['upload_path'] = './public/image/product/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['file_name'] = microtime() . ".jpg";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '5000';
            $config['max_width']  = '3000';
            $config['max_height']  = '3000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload("fileimg")) {
                $this->session->set_flashdata('message', 'Gambar tidak bisa di upload' . $this->upload->display_errors());
                //$this->session->set_flashdata('backingdata', $datainput);
                redirect(base_url() . "backendproduct/myproduct/form?id=" . $this->input->post('id'));
                exit();
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                //var_dump($alldatainput);exit();
                $this->etx_product->updateproduct($alldatainput, $where);
                $this->watermarkoverlay($namenewfile, "product");
                unlink("./public/image/product/" . $this->input->post('imgold'));
                $this->session->set_flashdata('message', 'Produk diedit');
                redirect(base_url() . "backendproduct/myproduct/listall");
                exit();
            }
        }

        redirect(base_url() . 'backendproduct/myproduct');
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
            redirect(base_url() . 'backendproduct/myproduct/listall');
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
            redirect(base_url() . 'backendproduct/myproduct/listall');
        }
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
                ->where('product.created_by', $this->sessionmember['id'])
                ->get("product")->result_array();
            $file_name = "Produk_trumecs" . date("Y_m_d") . ".xls";
        } else {
            $data = $this->db
                ->select('product.id,product.partnumber_trumecs,product.partnumber,product.physicnumber,product.tittle as nama_produk,product.jenisproduct,c1.name as brand,c2.name as type,product.component,product.quality,product.stock,product.moq,product.price as harga,product.price_promo as harga_promo,product.warranty,product.warrantyvendor,product.packagin,product.weight,product.sx as dimensi_panjang,product.sy as dimensi_tinggi,product.sz as dimensi_lebar,product.livetime,product.made as buatan_negara,product.availability_at as tersedia_di,product.estimated_delivery as waktu_pengiriman,product.estimated_deliveryindent  as waktu_pengiriman_jika_inden')
                ->join('categori c1', 'c1.id = product.brand', "left")
                ->join('categori c2', 'c2.id = product.type', "left")
                ->where('product.created_by', $this->sessionmember['id'])
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
}
