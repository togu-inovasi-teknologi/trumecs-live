<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mypromo extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
        $session = $this->session->all_userdata();
        $this->sessionmember = array_key_exists("admin", $session) ? $session["admin"] : array('id' => 0);
    }

    public function index() {}

    public function listpromo()
    {

        $data["datawhere"] = ['created_by' => $this->sessionmember["id"]];
        $config["per_page"] = 10;
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page, $data["datawhere"]);
        // var_dump($data['listfilter']);
        // die;
        $data["js"] = array(base_url() . 'asset/backend/js/list.order.js');
        $data['content'] = 'list';
        $this->load->view('backend/template_front', $data);
    }

    function ambil_data()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total = $this->db->count_all_results("promo");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->like("name", $search);
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0'):
            $this->db->order_by('id', 'DESC');
        endif;
        $this->db->where([
            'created_by' => $this->sessionmember['id']
        ]);
        $query = $this->db->get('promo');
        if ($search != "") {
            $this->db->like("name", $search);
            $jum = $this->db->get('promo');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        foreach ($query->result_array() as $promo) {
            $explode = explode(",", $promo["product"]);

            $output['data'][] = array(

                '<a class="fbold f14 forange" href="' . base_url() . 'backendpromo/form?id=' . $promo["id"] . '">' . $promo["name"] . '</a><br>',
                '<span class="fbold f14">' . $promo["type"] . '</span>',

                '<span>' . count($explode) . '</span>',
                '<a class="btn btn-sm btn-primary" href="' . base_url() . 'backendpromo/formPromoProduct?id=' . $promo["id"] . '"><i class="bi bi-file-earmark"></i></a> <a class="btn btn-sm btn-warning" href="' . base_url() . 'backendpromo/form?id=' . $promo["id"] . '"><i class="bi bi-pencil"></i></a>
                <a class="btn btn-sm btn-danger" href="' . base_url() . 'backendpromo/hapuspromo?id=' . $promo["id"] . '"><i class="bi bi-trash"></i></a>'
            );
        }
        echo json_encode($output);
    }

    function list_data_product()
    {
        $id = $_REQUEST['id-promo'];
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];

        // Ambil detail promo untuk mendapatkan list product ID yang sudah dalam promo
        if (!empty($id)) {
            $detail = $this->etx_model->getdetail($id);

            // Kolom product berisi "1982,2232,123" di explode jadi array
            $expolde = explode(",", $detail["product"]);
            // Bersihkan array dari nilai kosong
            $expolde = array_filter($expolde);
        } else {
            $expolde = array();
        }

        // Cek apakah ada produk dalam promo
        if (empty($expolde)) {
            // Jika tidak ada produk, return data kosong
            $output = array();
            $output['draw'] = $draw;
            $output['recordsTotal'] = 0;
            $output['recordsFiltered'] = 0;
            $output['data'] = array();
            echo json_encode($output);
            exit;
        }

        // Query untuk mengambil produk yang ID-nya ADA di dalam $expolde
        $this->db->where_in("id", $expolde);
        $this->db->where("status", 'show');

        // Hitung total semua produk (yang ada di promo)
        $total = $this->db->count_all_results('product', false);

        // Apply search jika ada (cari di tittle atau partnumber)
        if ($search != "") {
            $this->db->group_start();
            $this->db->like("tittle", $search);
            $this->db->or_like("partnumber", $search);
            $this->db->group_end();
        }

        // Hitung total filtered (untuk pencarian)
        $query_filtered = clone $this->db;
        $recordsFiltered = $query_filtered->count_all_results();

        // Apply limit dan order untuk pagination
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0') {
            $this->db->order_by('tittle', $_REQUEST['order'][0]['dir']);
        }

        // Eksekusi query untuk mengambil data produk
        $query = $this->db->get();

        // Siapkan output
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $total;
        $output['recordsFiltered'] = $recordsFiltered;
        $output['data'] = array();

        foreach ($query->result_array() as $product) {
            $output['data'][] = array(
                '<a class="fw-bold forange" href="' . base_url() . 'backendproduct/form?id=' . $product["id"] . '">' . htmlspecialchars($product["tittle"]) . '</a><br><small class="text-muted">' . htmlspecialchars($product["partnumber"]) . '</small>',
                'Rp ' . htmlspecialchars(number_format($product["price"], 0, ',', '.')),
            );
        }

        echo json_encode($output);
    }

    function ambil_data_product()
    {
        $id = $_REQUEST['id-promo'];
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];

        if (!empty($id)) {
            $detail = $this->etx_model->getdetail($id);
            $expolde = explode(",", $detail["product"]);
            $expolde = array_filter($expolde);
        } else {
            $expolde = array();
        }

        // ========== HITUNG TOTAL (tanpa search) ==========
        $this->db->from('product');
        $this->db->where([
            "status" => "show",
            "created_by" => $this->sessionmember['id']
        ]);
        if (!empty($expolde)) {
            $this->db->where_not_in("id", $expolde);
        }
        $total = $this->db->count_all_results();

        // ========== HITUNG TOTAL FILTERED (dengan search) ==========
        $this->db->from('product');
        $this->db->where([
            "status" => "show",
            "created_by" => $this->sessionmember['id']
        ]);
        if (!empty($expolde)) {
            $this->db->where_not_in("id", $expolde);
        }
        if ($search != "") {
            $this->db->group_start();
            $this->db->like("tittle", $search);
            $this->db->or_like("partnumber", $search);
            $this->db->group_end();
        }
        $recordsFiltered = $this->db->count_all_results();

        // ========== AMBIL DATA ==========
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where([
            "status" => "show",
            "created_by" => $this->sessionmember['id']
        ]);
        if (!empty($expolde)) {
            $this->db->where_not_in("id", $expolde);
        }
        if ($search != "") {
            $this->db->group_start();
            $this->db->like("tittle", $search);
            $this->db->or_like("partnumber", $search);
            $this->db->group_end();
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0') {
            $this->db->order_by('tittle', $_REQUEST['order'][0]['dir']);
        }
        $query = $this->db->get();

        // ========== OUTPUT ==========
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = (int)$total;
        $output['recordsFiltered'] = (int)$recordsFiltered;
        $output['data'] = array();

        foreach ($query->result_array() as $promo) {
            $output['data'][] = array(
                '<form action="' . base_url('backendpromo/addproductpromo') . '" method="POST">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="product" value="' . $detail["product"] . '">
            <input type="hidden" name="newproduct" value="' . $promo["id"] . '">
            <button type="submit" class="btn btn-success btn-sm rounded-3">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </form>',
                '<a class="fw-bold forange" href="' . base_url() . 'backendproduct/form?id=' . $promo["id"] . '">' . htmlspecialchars($promo["tittle"]) . '</a><br><small class="text-muted">' . htmlspecialchars($promo["partnumber"]) . '</small>',
                'Rp ' . htmlspecialchars(number_format($promo["price"], 0, ',', '.')),
            );
        }

        echo json_encode($output);
    }

    function hapus_data_product()
    {
        $id = $_REQUEST['id-promo'];
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];

        // Ambil detail promo untuk mendapatkan list product ID yang sudah dalam promo
        if (!empty($id)) {
            $detail = $this->etx_model->getdetail($id);

            // Kolom product berisi "1982,2232,123" di explode jadi array
            $expolde = explode(",", $detail["product"]);
            // Bersihkan array dari nilai kosong
            $expolde = array_filter($expolde);
        } else {
            $expolde = array();
        }

        // Cek apakah ada produk dalam promo
        if (empty($expolde)) {
            // Jika tidak ada produk, return data kosong
            $output = array();
            $output['draw'] = $draw;
            $output['recordsTotal'] = 0;
            $output['recordsFiltered'] = 0;
            $output['data'] = array();
            echo json_encode($output);
            exit;
        }

        // Query untuk mengambil produk yang ID-nya ADA di dalam $expolde
        $this->db->where_in("id", $expolde);
        $this->db->where("status", 'show');

        // Hitung total semua produk (yang ada di promo)
        $total = $this->db->count_all_results('product', false);

        // Apply search jika ada (cari di tittle atau partnumber)
        if ($search != "") {
            $this->db->group_start();
            $this->db->like("tittle", $search);
            $this->db->or_like("partnumber", $search);
            $this->db->group_end();
        }

        // Hitung total filtered (untuk pencarian)
        $query_filtered = clone $this->db;
        $recordsFiltered = $query_filtered->count_all_results();

        // Apply limit dan order untuk pagination
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0') {
            $this->db->order_by('tittle', $_REQUEST['order'][0]['dir']);
        }

        // Eksekusi query untuk mengambil data produk
        $query = $this->db->get();

        // Siapkan output
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $total;
        $output['recordsFiltered'] = $recordsFiltered;
        $output['data'] = array();

        foreach ($query->result_array() as $product) {
            // Produk pasti ada di promo karena sudah difilter where_in
            $output['data'][] = array(
                '<form action="' . base_url('backendpromo/hapusproductpromo') . '" method="POST">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="product" value="' . $detail["product"] . '">
            <input type="hidden" name="newproduct" value="' . $product["id"] . '">
            <button type="submit" class="btn btn-sm btn-danger rounded-3">
                <i class="bi bi-dash-circle"></i> Hapus
            </button>
        </form>',
                '<a class="fw-bold forange" href="' . base_url() . 'backendproduct/form?id=' . $product["id"] . '">' . htmlspecialchars($product["tittle"]) . '</a><br><small class="text-muted">' . htmlspecialchars($product["partnumber"]) . '</small>',
                'Rp ' . htmlspecialchars(number_format($product["price"], 0, ',', '.')),
            );
        }

        echo json_encode($output);
    }


    public function form()
    {
        $id = $this->input->get("id");
        if ($id) {
            $data["detail"] = $this->etx_model->getdetail($id);
            if (empty($data["detail"])) {
                $this->session->set_flashdata('message', 'Promo tidak ada di database');
                redirect(base_url() . 'backendpromo/listpromo');
            }
        }

        $data["product"] = $this->etx_model->getallproduct();
        $data['content'] = 'formPromo';
        $data['id'] = $id;
        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css');
        $data["js"] = array(
            base_url() . '/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            "/modules/backendpromo/js/form.promo.js"
        );
        $this->load->view('backend/template_front', $data);
    }

    public function formPromoProduct()
    {
        $id = $this->input->get("id");
        if ($id) {
            $data["detail"] = $this->etx_model->getdetail($id);
            if (empty($data["detail"])) {
                $this->session->set_flashdata('message', 'Promo tidak ada di database');
                redirect(base_url() . 'backendpromo/listpromo');
            }
        }

        $data["product"] = $this->etx_model->getallproduct();
        $data['content'] = 'formPromoProduct';
        $data['id'] = $id;
        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css');
        $data["js"] = array(
            base_url() . '/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            "/modules/backendpromo/js/form.promo.js"
        );
        $this->load->view('backend/template_front', $data);
    }

    public function input()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('type', 'Tipe Promo', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal berakhir', 'required');
        $this->form_validation->set_rules('txtfilegambar', 'Txtfilegambar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendpromo/form');
        } else {
            $file = "public/tmp/" . ($this->input->post("txtfilegambar"));
            $newfile = "public/image/promo/" . ($this->input->post("txtfilegambar"));
            if (copy($file, $newfile)) {
                unlink($file);
                $set = array(
                    'name' => $this->input->post("name"),
                    'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("name")),
                    'product' => $this->input->post("product"),
                    'start_date' => strtotime($this->input->post("start_date")),
                    'end_date' => strtotime($this->input->post("end_date")),
                    'price' => $this->input->post("price") ?? null,
                    'type' => $this->input->post("type"),
                    'created_by' => $this->sessionmember["id"],
                    'img' => ($this->input->post("txtfilegambar")),
                    'description' => htmlentities($this->input->post("description"))
                );
                $this->session->set_flashdata('message', 'Promo baru telah ditambah');
                $this->etx_model->input($set);
                redirect(base_url() . "backendpromo/listpromo");
                exit();
            } else {
                $this->session->set_flashdata('message', 'Sistem mengalami gangguan saat memproses data yang Anda inputkan.');
                redirect(base_url() . "backendpromo/form");
                exit();
            }
        }
        redirect(base_url() . 'backendpromo/listpromo');
    }

    public function update()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal berakhir', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendpromo/form?id=' . $id);
        } else {
            if (!empty($this->input->post("asknew"))) {
                $file = "public/tmp/" . ($this->input->post("txtfilegambar"));
                $newfile = "public/image/promo/" . ($this->input->post("txtfilegambar"));
                if (copy($file, $newfile)) {
                    unlink($file);

                    $set = array(
                        'name' => $this->input->post("name"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("name")),
                        'product' => $this->input->post("product"),
                        'start_date' => strtotime($this->input->post("start_date")),
                        'end_date' => strtotime($this->input->post("end_date")),
                        'img' => ($this->input->post("txtfilegambar")),
                        'price' => $this->input->post("price") ?? null,
                        'type' => $this->input->post("type"),
                        'created_by' => $this->sessionmember["id"],
                        'description' => htmlentities($this->input->post("description"))
                    );

                    $this->session->set_flashdata('message', 'Promo baru telah diupdate');

                    $this->etx_model->update(array('id' => $id), $set);
                    //redirect(base_url().'backendpromo/form?id='.$id);
                } else {
                    $set = array(
                        'name' => $this->input->post("name"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("name")),
                        'start_date' => strtotime($this->input->post("start_date")),
                        'end_date' => strtotime($this->input->post("end_date")),
                        'product' => $this->input->post("product"),
                        'img' => ($this->input->post("txtfilegambarold")),
                        'price' => $this->input->post("price") ?? null,
                        'type' => $this->input->post("type"),
                        'created_by' => $this->sessionmember["id"],
                        'description' => htmlentities($this->input->post("description"))
                    );

                    $this->session->set_flashdata('message', 'Promo baru telah diupdate');
                    $this->etx_model->update(array('id' => $id), $set);
                    //redirect(base_url().'backendpromo/form?id='.$id);

                }
            } else {
                $set = array(
                    'name' => $this->input->post("name"),
                    'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("name")),
                    'start_date' => strtotime($this->input->post("start_date")),
                    'end_date' => strtotime($this->input->post("end_date")),
                    'product' => $this->input->post("product"),
                    'img' => ($this->input->post("txtfilegambarold")),
                    'description' => htmlentities($this->input->post("description"))
                );

                $this->session->set_flashdata('message', 'Promo baru telah diupdate');
                $this->etx_model->update(array('id' => $id), $set);
            }
            redirect(base_url() . 'backendpromo/listpromo');
        }
    }

    public function addproductpromo()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('newproduct', 'Newroduct', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendpromo/formPromoProduct?id=' . $id);
        } else {
            $set = array('product' => (!empty($this->input->post("product"))) ? $this->input->post("product") . "," . $this->input->post("newproduct") : $this->input->post("newproduct"));
            $this->session->set_flashdata('message', 'Menambahkan Produk pada Promo Berhasil');
            $this->etx_model->update(array('id' => $id), $set);
            redirect(base_url() . 'backendpromo/formPromoProduct?id=' . $id);
        }
    }

    public function hapusproductpromo()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('newproduct', 'Newroduct', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendpromo/formPromoProduct?id=' . $id);
        } else {
            $product = explode(',', $this->input->post("product"));
            $key = array_search($this->input->post("newproduct"), $product);
            unset($product[$key]);
            $set = array('product' => implode(',', $product));
            $this->session->set_flashdata('message', 'Menghapus Produk pada Promo Berhasil');
            $this->etx_model->update(array('id' => $id), $set);
            redirect(base_url() . 'backendpromo/formPromoProduct?id=' . $id);
        }
    }

    public function hapuspromo()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Promo telah dihapus');
        redirect(base_url() . 'backendpromo/listpromo');
    }

    public function halamandepan()
    {
        $data["slide"] = $this->etx_model->gethome("slide");
        $data["headbottomslide"] = $this->etx_model->gethome("headbottomslide");
        $data["headrightslide"] = $this->etx_model->gethome("headrightslide");
        $data["headleftslide"] = $this->etx_model->gethome("headleftslide");
        $data["promobig"] = $this->etx_model->gethome("promobig");
        $data["promo"] = $this->etx_model->gethome("promo");
        $data["new"] = $this->etx_model->gethome("new");
        $data['content'] = 'halamandepan';
        $data["js"] = array(
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            base_url() . 'asset/backend/js/setting.halamandepan.js'
        );
        $this->load->view('backend/template_front', $data);
    }

    public function usedpage()
    {
        $data["slide"] = $this->etx_model->gethome("slideused");
        $data["headbottomslide"] = $this->etx_model->gethome("headbottomslideused");
        $data["headrightslide"] = $this->etx_model->gethome("headrightslideused");
        $data["headleftslide"] = $this->etx_model->gethome("headleftslideused");
        $data["promobig"] = $this->etx_model->gethome("promobigused");
        $data["promo"] = $this->etx_model->gethome("promoused");
        $data["new"] = $this->etx_model->gethome("newused");
        $data['content'] = 'usedpage';
        $data["js"] = array(
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            base_url() . 'asset/backend/js/setting.halamandepan.js'
        );
        $this->load->view('backend/template_front', $data);
    }

    public function hapusimghalamadepan()
    {
        $where = array('id' => $this->input->get("id"));
        unlink('./public/image/page/home/' . $this->input->get("img"));
        $this->etx_model->hapushalamadepan($where);
        $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        redirect(base_url() . 'backendpromo/halamandepan');
    }

    public function hapusimgusedpage()
    {
        $where = array('id' => $this->input->get("id"));
        unlink('./public/image/page/home/' . $this->input->get("img"));
        $this->etx_model->hapushalamadepan($where);
        $this->session->set_flashdata('message', 'halaman used di perbarui.');
        redirect(base_url() . 'backendpromo/usedpage');
    }

    public function inputhalamadepan()
    {
        $textimg = $this->input->post("textimg");
        $file = "public/tmp/" . $textimg;
        $newfile = "public/image/page/home/" . $textimg;
        if (copy($file, $newfile)) {
            unlink($file);
            $set = array('name' => $this->input->post("name"), 'img' => $textimg, 'link' => $this->input->post("link"));
            $this->etx_model->inputhalamadepan($set);
            $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        }
        redirect(base_url() . 'backendpromo/halamandepan');
    }

    public function edithalamadepan()
    {
        $textimg = $this->input->post("textimg");
        $file = "public/tmp/" . $textimg;
        $newfile = "public/image/page/home/" . $textimg;
        if (file_exists($newfile)) {
            $set = array('name' => $this->input->post("name"), 'img' => $textimg, 'link' => $this->input->post("link"), 'title' => $this->input->post("title"));
            $this->etx_model->updatehalamadepan($set, $this->input->post('id'));
            $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        } else {
            if (copy($file, $newfile)) {
                unlink($file);
                $set = array('name' => $this->input->post("name"), 'img' => $textimg, 'link' => $this->input->post("link"), 'title' => $this->input->post("title"));
                $this->etx_model->updatehalamadepan($set, $this->input->post('id'));
                $this->session->set_flashdata('message', 'halaman depan di perbarui.');
            }
        }

        redirect(base_url() . 'backendpromo/halamandepan');
    }

    public function inputusedpage()
    {
        $textimg = $this->input->post("textimg");
        $file = "public/tmp/" . $textimg;
        $newfile = "public/image/page/home/" . $textimg;
        if (copy($file, $newfile)) {
            unlink($file);
            $set = array('name' => $this->input->post("name"), 'img' => $textimg, 'link' => $this->input->post("link"));
            $this->etx_model->inputhalamadepan($set);
            $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        }
        redirect(base_url() . 'backendpromo/usedpage');
    }
}
