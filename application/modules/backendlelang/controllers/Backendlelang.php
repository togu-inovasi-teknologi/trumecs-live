<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendlelang extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_lelang");
        $session = $this->session->all_userdata();
        $this->sessionmember = array_key_exists("admin", $session) ? $session["admin"] : array('id' => 0);
    }
    public function index()
    {
        $this->securitylog->cekadmin();
        redirect(base_url() . "backendlelang/listall");
    }
    public function listall()
    {

        $this->securitylog->cekadmin();

        $name = $this->input->get("nama");
        $category = $this->input->get("category");
        $jenis_penawaran = $this->input->get("jenis_penawaran");
        $data["idtype"] = "";
        $data["idbrand"] = "";
        $data["querysearch"] = $name;

        $data["datasearch"] = array(
            'judul' => $name,
            'penyelenggara' => $name,
            'uraian' => $name
        );

        $data["datasearchor_like"] = array(
            'judul' => $name,
            'penyelenggara' => $name,
            'uraian' => $name
        );

        $data["datawhere"] = array();
        if ($category != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('category' => $category));
        }
        if ($jenis_penawaran != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('jenis_penawaran' => $jenis_penawaran));
        }

        $status_valid = $this->input->get("status");
        if ($status_valid != "") {
            $data["datawhere"] = array_merge($data["datawhere"], array('status' => $status_valid));
        }

        $config["per_page"] = 10;
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listlelang"] = $this->etx_lelang->fetch_lelang($config["per_page"], $page, $data["datasearch"], $data["datasearchor_like"], $data["datawhere"]);

        $data["js"] = array(base_url() . 'asset/backend/js/list.lelang.js');
        $data['content'] = 'list_lelang';
        $this->load->view('backend/template_front', $data);
    }

    function ambil_data()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total = $this->db->count_all_results("lelang");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->where("(
							judul LIKE '%$search%' 
							OR uraian LIKE '%$search%' 
                        )", '', false);
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '1'):
            $this->db->order_by('judul', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '2'):
            $this->db->order_by('nilai', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '3'):
            $this->db->order_by('penyelanggara', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '4'):
            $this->db->order_by('status', $_REQUEST['order'][0]['dir']);
        endif;

        $query = $this->db->get('lelang');
        if ($search != "") {
            $this->db->where("(
							judul LIKE '%$search%' 
							OR uraian LIKE '%$search%' 
                        )", '', false);
            $jum = $this->db->get('lelang');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        foreach ($query->result_array() as $product) {
            $s = $product["status"] == "show" ? "draf" : "show";
            $l = $product["status"] == "show" ? "success" : "danger";
            $i = $product["status"] == "show" ? "check" : "ban";

            $output['data'][] = array(
                '<a href="' . base_url() . 'backendlelang/lelangstatus?id=' . $product["id"] . '&status=' . $s . '" class="label label-' . $l . '" alt="show"><i class="fa fa-' . $i . '"></i></a>',
                $product['judul'],
                'Rp.' . number_format($product['nilai']),
                '<span class="label label-default">' . ($this->namectgr($product['category'])) . '</span>',
                '<span class="label label-default">' . ($product['jenis_penawaran']) . '</span>',
                '<a class="label label-warning" href="' . base_url() . 'backendlelang/form?id=' . $product["id"] . '"><i class="bi bi-pencil"></i></a>',
                '<a class="label label-primary" href="' . base_url() . 'backendlelang/galery?id=' . $product["id"] . '"><i class="bi bi-image"></i></a>',
                '<a class="label click label-danger" onclick="hapus(' . $product["id"] . ',\'' . $product["judul"] . '\')"
                    url="' . base_url() . 'backendlelang/hapus?id=' . $product["id"] . '"><i class="bi bi-trash"></i></a>'

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

    public function lelangstatus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $data = array('status' => $this->input->get("status"));
        $where = array('id' => $this->input->get("id"));
        $this->etx_lelang->editlelang($data, $where);
        $this->session->set_flashdata('message', 'Produk telah diedit');
        if (isset($last_page)) {
            redirect($last_page);
        } else {
            redirect(base_url() . 'backendlelang/listall');
        }
    }
    public function galery()
    {
        $id = $this->input->get("id");
        $data["lelang"] = $this->etx_lelang->getlelang(array('id' => $id));
        $data['content'] = 'galery';
        $data['js'] = array(base_url() . 'asset/backend/js/backendlelanggalery.js');;
        $this->load->view('backend/template_front', $data);
    }

    public function form()
    {
        $data['content'] = 'form';
        if ($this->input->get("id") != "") {
            $data["backingdata"] = $this->etx_lelang->getlelang(array('id' => $this->input->get("id")));
            if (empty($data["backingdata"])) {
                $this->session->set_flashdata('message', 'Tidak ada produk dengan id ' . $this->input->get("id"));
                redirect(base_url() . "backendlelang/form");
                exit();
            }
        }

        $data["js"] = array(base_url() . 'asset/backend/js/form.lelang.js');
        $this->load->view('backend/template_front', $data);
    }

    public function addgalery()
    {

        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendlelang/galery?id=" . $id);
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
            redirect(base_url() . "backendlelang/galery?id=" . $id);
            exit();
        } else {
            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddgalery = array('img' => $namenewfile, 'lelang' => $id);
            $this->etx_lelang->addgalery($dataaddgalery);
            $this->watermarkoverlay($namenewfile, "galery");
            $this->session->set_flashdata('message', 'Gambar galeri di tambah');
            redirect(base_url() . "backendlelang/galery?id=" . $id);
            exit();
        }
    }

    public function addlelang()
    {
        echo $this->input->post('batas_penawaran');
        $unit = ($this->input->post('unit') != "") ? $this->input->post('unit') : "1 Pc";
        $dimention_array = explode("x", $this->input->post('dimention'));
        if (count($dimention_array) != 3) {
            $dimention_array[0] = "0";
            $dimention_array[1] = "0";
            $dimention_array[2] = "0";
        }
        $datainput = array(
            'judul' => preg_replace('/[.,\/]/', "", $this->input->post('judul')),
            'nilai' => empty($this->input->post('nilai')) ? "" : $this->input->post('nilai'),
            'jenis_penawaran' => empty($this->input->post('jenis_penawaran')) ? "" : $this->input->post('jenis_penawaran'),
            'jaminan' => empty($this->input->post('jaminan')) ? "" : str_replace(".", "", $this->input->post('jaminan')),
            'batas_jaminan' => empty($this->input->post('batas_jaminan')) ? "" : strtotime($this->input->post('batas_jaminan')),
            'batas_penawaran' => empty($this->input->post('batas_penawaran')) ? "" : strtotime($this->input->post('batas_penawaran')),
            'penyelenggara' => empty($this->input->post('penyelenggara')) ? "" : $this->input->post('penyelenggara'),
            'uraian' => empty($this->input->post('uraian')) ? "" : nl2br($this->input->post('uraian')),
            'info_penjual' => empty($this->input->post('info_penjual')) ? "" : nl2br($this->input->post('info_penjual')),
            'info_penyelenggara' => empty($this->input->post('info_penyelenggara')) ? "" : nl2br($this->input->post('info_penyelenggara')),
            'category' => empty($this->input->post('category')) ? "" : $this->input->post('category'),
            'created_by' => $this->sessionmember['id'],
            'created_at' => time(),
            'view' => 0,
        );

        $config['upload_path'] = './public/image/lelang/';
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
            $this->session->set_flashdata('backingdata', $datainput);
            //redirect(base_url()."backendlelang/form");          
            exit();
        } else {
            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddimg = array('img' => $namenewfile);
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->watermarkoverlay($namenewfile, "lelang");
            $this->etx_lelang->addlelang($alldatainput);
            $this->session->set_flashdata('message', 'Produk di tambah, Silahkan tambah galery produk baru');
            //redirect(base_url()."backendlelang/listall");          
            exit();
        }
        //redirect(base_url().'backendlelang');
    }

    public function updatelelang()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagi');
            redirect(base_url() . "backendlelang/form");
            exit();
        }
        echo strtotime($this->input->post('batas_penawaran'));
        $where = array('id' => $this->input->post('id'));
        $unit = ($this->input->post('unit') != "") ? $this->input->post('unit') : "1 Pc";
        $dimention_array = explode("x", $this->input->post('dimention'));
        if (count($dimention_array) != 3) {
            $dimention_array[0] = "0";
            $dimention_array[1] = "0";
            $dimention_array[2] = "0";
        }
        $datainput = array(
            'judul' => preg_replace('/[.,\/]/', "", $this->input->post('judul')),
            'nilai' => empty($this->input->post('nilai')) ? "" : $this->input->post('nilai'),
            'jenis_penawaran' => empty($this->input->post('jenis_penawaran')) ? "" : $this->input->post('jenis_penawaran'),
            'jaminan' => empty($this->input->post('jaminan')) ? "" : str_replace(".", "", $this->input->post('jaminan')),
            'batas_jaminan' => empty($this->input->post('batas_jaminan')) ? "" : strtotime($this->input->post('batas_jaminan')),
            'batas_penawaran' => empty($this->input->post('batas_penawaran')) ? "" : strtotime($this->input->post('batas_penawaran')),
            'penyelenggara' => empty($this->input->post('penyelenggara')) ? "" : $this->input->post('penyelenggara'),
            'uraian' => empty($this->input->post('uraian')) ? "" : nl2br($this->input->post('uraian')),
            'info_penjual' => empty($this->input->post('info_penjual')) ? "" : nl2br($this->input->post('info_penjual')),
            'info_penyelenggara' => empty($this->input->post('info_penyelenggara')) ? "" : nl2br($this->input->post('info_penyelenggara')),
            'category' => empty($this->input->post('category')) ? "" : $this->input->post('category')
        );

        if (empty($_FILES['fileimg']['name'])) {
            $dataaddimg = array('img' => $this->input->post('imgold'));
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->etx_lelang->updatelelang($alldatainput, $where);
            $this->session->set_flashdata('message', 'Produk diedit , tanpa mengubah gambar');
            //redirect(base_url()."backendlelang/listall"); 
            exit();
        } else {
            $config['upload_path'] = './public/image/lelang/';
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
                //redirect(base_url()."backendlelang/form?id=".$this->input->post('id'));          
                exit();
            } else {
                $data = $this->upload->data();
                $namenewfile = $data["file_name"];
                $dataaddimg = array('img' => $namenewfile);
                $alldatainput = array_merge($datainput, $dataaddimg);
                $this->etx_lelang->updatelelang($alldatainput, $where);
                $this->watermarkoverlay($namenewfile, "lelang");
                unlink("./public/image/lelang/" . $this->input->post('imgold'));
                $this->session->set_flashdata('message', 'Lelang diedit');
                //redirect(base_url()."backendlelang/listall");          
                exit();
            }
        }

        //redirect(base_url().'backendlelang');
    }

    public function hapus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $where = array('id' => $this->input->get("id"));
        $this->etx_lelang->hapus($where);
        $this->session->set_flashdata('message', 'Lelang telah dihapus');
        if (isset($last_page)) {
            redirect($last_page);
        } else {
            redirect(base_url() . 'backendlelang/listall');
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
            redirect(base_url() . 'backendlelang/listall');
        }
    }

    public function categori()
    {
        $data['content'] = 'category';
        $data['js'] = array(base_url() . 'asset/backend/js/categor.product.js');
        $this->load->view('backend/template_front', $data);
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
}
