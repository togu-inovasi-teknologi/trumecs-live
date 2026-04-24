<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendartikel extends MX_Controller
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
    public function index()
    {

        //$status= $this->input->get("status");
        $data["datawhere"] = array();

        $config["per_page"] = 10;
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page, $data["datawhere"]);
        //$this->etx_model->migrate();
        //$data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/list';
        } else {
            $data['content'] = 'mobile/list';
        }
        $this->load->view('backend/template_front', $data);
    }

    function ambil_data()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total = $this->db->count_all_results("artikel");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->like("title", $search);
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0'):
            $this->db->order_by('title', $_REQUEST['order'][0]['dir']);
        endif;
        if ($_REQUEST['order'][0]['column'] == '1'):
            $this->db->order_by('created_at', $_REQUEST['order'][0]['dir']);
        endif;
        if ($_REQUEST['order'][0]['column'] == '2'):
            $this->db->order_by('updated_at', $_REQUEST['order'][0]['dir']);
        endif;
        if ($_REQUEST['order'][0]['column'] == '3'):
            $this->db->order_by('view', $_REQUEST['order'][0]['dir']);
        endif;
        if ($_REQUEST['order'][0]['column'] == '4'):
            $this->db->order_by('creator', $_REQUEST['order'][0]['dir']);
        endif;
        $this->db->select('artikel.*, a1.name AS creator, a2.name AS editor');
        $this->db->join('admin a1', 'a1.id = artikel.created_by');
        $this->db->join('admin a2', 'a2.id = artikel.updated_by', 'left');
        $query = $this->db->get('artikel');
        if ($search != "") {

            $this->db->like("title", $search);

            $jum = $this->db->get('artikel');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }
        foreach ($query->result_array() as $artikel) {
            $output['data'][] = array(
                '<a class="text-primary text-decoration-none fw-medium" href="' . base_url() . 'backendartikel/form?id=' . $artikel["id"] . '">' . htmlspecialchars($artikel["title"]) . '</a>',
                '<div class="text-muted small">' . date("d M Y", $artikel["created_at"]) . '</div>',
                '<div class="text-muted small">' . ($artikel["updated_at"] == 0 ? '<span class="text-muted">-</span>' : date("d M Y", $artikel["updated_at"])) . '</div>',
                '<div class="text-end fw-medium">' . number_format($artikel["view"]) . '</div>',
                '<div class="small">' . htmlspecialchars($artikel["creator"]) . '</div>',

                // Untuk toggle display - Versi dengan badge dan icon
                $artikel['display'] == 1
                    ? '
       <a class="btn btn-sm btn-outline-danger ms-2" 
          href="' . base_url() . 'backendartikel/hide?id=' . $artikel["id"] . '"
          title="Sembunyikan Artikel">
          <i class="bi bi-eye-slash"></i>
       </a>'
                    : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle">
          <i class="bi bi-eye-slash-fill me-1"></i>Tersembunyi
       </span>
       <a class="btn btn-sm btn-outline-success ms-2" 
          href="' . base_url() . 'backendartikel/show?id=' . $artikel["id"] . '"
          title="Tampilkan Artikel">
          <i class="bi bi-eye"></i>
       </a>',

                // Action buttons - tombol edit dan hapus
                '<div class="btn-group btn-group-sm" role="group">
    <a class="btn btn-outline-warning" 
       href="' . base_url() . 'backendartikel/form?id=' . $artikel["id"] . '"
       title="Edit Artikel">
       <i class="bi bi-pencil"></i>
    </a>
    <a class="btn btn-outline-danger" 
       href="' . base_url() . 'backendartikel/hapus?id=' . $artikel["id"] . '"
       onclick="return confirm(\'Apakah anda yakin ingin menghapus artikel ' . addslashes($artikel["title"]) . '?\')"
       title="Hapus Artikel">
       <i class="bi bi-trash"></i>
    </a>
</div>'
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
                $this->session->set_flashdata('message', 'Pesanan tidak ada di database');
                redirect(base_url() . 'backendpage/?status=all');
            }
        }
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/form';
        } else {
            $data['content'] = 'mobile/form';
        }
        $data['id'] = $id;
        $data["css"] = array(
            base_url() . 'asset/backend/dist/js/tinymce/skins/lightgray/skin.min.css',
        );
        $data["distjs"] = array(
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            base_url() . 'asset/backend/dist/js/tinymce/tinymce.min.js',
            base_url() . 'asset/backend/dist/js/tinymce/tinymce.min.js',
        );
        $data["js"] = array(
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . 'asset/backend/js/form.pageandarticle.js'
        );
        $this->load->view('backend/template_front', $data);
    }

    public function input()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('txtfilegambar', 'Txtfilegambar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendartikel/form');
        } else {
            $file = "public/tmp/" . ($this->input->post("txtfilegambar"));
            $newfile = "public/image/artikel/" . ($this->input->post("txtfilegambar"));
            if (copy($file, $newfile)) {
                unlink($file);
                $set = array(
                    'title' => $this->input->post("title"),
                    'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("title")),
                    'value' => ($this->input->post("content")),
                    'date' => date('m/d/Y', time()),
                    'tag' => ($this->input->post("tag")),
                    'seo_key' => ($this->input->post("seo_key")),
                    'discription_seo' => ($this->input->post("discription_seo")),
                    'img' => ($this->input->post("txtfilegambar")),
                    'view' => 0,
                    'created_by' => $this->sessionmember["id"],
                    'display' => $this->input->post("save") == "reguler" ? 1 : 0,
                    'created_at' => time()
                );
                $this->session->set_flashdata('message', 'Artikel baru telah ditambah');
                $this->etx_model->input($set);
                redirect(base_url() . "backendartikel/?status=all");
                exit();
            } else {
                $this->session->set_flashdata('message', 'Sistem mengalami gangguan saat memproses data yang Anda inputkan.');
                redirect(base_url() . "backendartikel/form");
                exit();
            }
        }
        redirect(base_url() . 'backendartikel/?status=all');
    }

    public function update()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendartikel/form?id=' . $id);
        } else {
            if (!empty($this->input->post("asknew"))) {
                $file = "public/tmp/" . ($this->input->post("txtfilegambar"));
                $newfile = "public/image/artikel/" . ($this->input->post("txtfilegambar"));
                if (copy($file, $newfile)) {
                    unlink($file);
                    $set = array(
                        'title' => $this->input->post("title"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("title")),
                        'value' => ($this->input->post("content")),
                        'tag' => ($this->input->post("tag")),
                        'seo_key' => ($this->input->post("seo_key")),
                        'display' => $this->input->post("save") == "reguler" ? 1 : 0,
                        'discription_seo' => ($this->input->post("discription_seo")),
                        'img' => ($this->input->post("txtfilegambar"))
                    );
                    $this->session->set_flashdata('message', 'Artikel telah di update');
                    $this->etx_model->update(array('id' => $id), $set);
                    redirect(base_url() . 'backendartikel/?status=all');
                    exit();
                } else {
                    $this->session->set_flashdata('message', 'Sistem mengalami gangguan saat memproses data yang Anda inputkan.');
                    redirect(base_url() . "backendartikel/form?id=" . $id);
                    exit();
                }
            } else {
                $set = array(
                    'title' => $this->input->post("title"),
                    'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("title")),
                    'value' => ($this->input->post("content")),
                    'tag' => ($this->input->post("tag")),
                    'seo_key' => ($this->input->post("seo_key")),
                    'discription_seo' => ($this->input->post("discription_seo")),
                    'img' => ($this->input->post("txtfilegambarold")),
                    'display' => $this->input->post("save") == "reguler" ? 1 : 0,
                    'updated_by' => $this->sessionmember["id"],
                    'updated_at' => time()
                );
                $this->session->set_flashdata('message', 'Artikel telah di update');
                $this->etx_model->update(array('id' => $id), $set);

                redirect(base_url() . 'backendartikel/?status=all');
                exit();
            }
        }
        redirect(base_url() . 'backendartikel/?status=all');
    }

    public function hapus()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Page telah dihapus');
        redirect(base_url() . 'backendartikel/?status=all');
    }

    public function show()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->show($where);
        $this->session->set_flashdata('message', 'Page telah ditampikan');
        redirect(base_url() . 'backendartikel/?status=all');
    }

    public function tinymceimg()
    {
        $accepted_origins = array("http://localhost", "https://www.trumecs.com", "https://trumecs.com");

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = "public/image/artikel";

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("HTTP/1.1 403 Origin Denied");
                return;
            }
        }

        // Don't attempt to process the upload on an OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }

        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Determine the base URL
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
            $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => '/' . $filetowrite));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }
}
