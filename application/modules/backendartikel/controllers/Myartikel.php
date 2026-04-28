<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myartikel extends MX_Controller
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

        $data["js"] = array(base_url() . 'asset/backend/js/list.order.js');
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/list';
        } else {
            $data['content'] = 'mobile/list';
        }
        $this->load->view('backend/template_front', $data);
    }

    // function ambil_data()
    // {

    //     $draw = $_REQUEST['draw'];
    //     $length = $_REQUEST['length'];
    //     $start = $_REQUEST['start'];
    //     $search = $_REQUEST['search']["value"];
    //     $total = $this->db->count_all_results("artikel");
    //     $output = array();
    //     $output['draw'] = $draw;
    //     $output['recordsTotal'] = $output['recordsFiltered'] = $total;
    //     $output['data'] = array();
    //     if ($search != "") {
    //         $this->db->like("title", $search);
    //     }
    //     $this->db->limit($length, $start);
    //     if ($_REQUEST['order'][0]['column'] == '0'):
    //         $this->db->order_by('title', $_REQUEST['order'][0]['dir']);
    //     endif;

    //     $query = $this->db->get('artikel');
    //     if ($search != "") {
    //         $this->db->like("title", $search);
    //         $jum = $this->db->get('artikel');
    //         $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
    //     }

    //     foreach ($query->result_array() as $artikel) {


    //         $output['data'][] = array(

    //             '<a class="fbold f14 forange" href="' . base_url() . 'backendartikel/myartikel/form?id=' . $artikel["id"] . '">' . $artikel["title"] . '</a>',

    //             '<a class="btn btn-sm btn-warning" href="' . base_url() . 'backendartikel/myartikel/form?id=' . $artikel["id"] . '"><i class="bi bi-pencil"></i></a>',

    //             $artikel['display'] == 1 ? '<a class="btn btn-sm btn-danger" href="' . base_url() . 'backendartikel/myartikel/hapus?id=' . $artikel["id"] . '"><i class="bi bi-trash"></i></a>' : '<a class="btn btn-sm btn-success" href="' . base_url() . 'backendartikel/myartikel/show?id=' . $artikel["id"] . '"><i class="bi bi-check"></i></a>'
    //         );
    //     }

    //     echo json_encode($output);
    // }

    function ambil_data()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $this->db->where('created_by', $this->sessionmember["id"]);
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

        $this->db->where('a1.id', $this->sessionmember["id"]);
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

    function ambil_data_dashboard()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $this->db->where('created_by', $this->sessionmember["id"]);
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

        $this->db->where('a1.id', $this->sessionmember["id"]);
        $query = $this->db->get('artikel');
        if ($search != "") {

            $this->db->like("title", $search);

            $jum = $this->db->get('artikel');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }
        foreach ($query->result_array() as $artikel) {
            $output['data'][] = array(
                '<a class="text-primary text-decoration-none fw-medium" href="' . base_url() . 'backendartikel/form?id=' . $artikel["id"] . '">' . htmlspecialchars($artikel["title"]) . '</a>',
                '<span class="fbold f14">' . $artikel["view"] . '</span>'
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
                redirect(base_url() . 'backendpage/myartikel/?status=all');
            }
        }
        $data['content'] = 'form';
        $data['id'] = $id;
        $data["css"] = array(
            base_url() . 'asset/backend/dist/js/tinymce/skins/lightgray/skin.min.css',
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"
        );
        $data["js"] = array(
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js",
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            base_url() . "asset/js/member/datepick.js",
            base_url() . 'asset/backend/dist/js/tinymce/tinymce.min.js',
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
            redirect(base_url() . 'backendartikel/myartikel/form');
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
                    'created_by' => $this->sessionmember["id"],
                    'img' => ($this->input->post("txtfilegambar"))
                );
                $this->session->set_flashdata('message', 'Artikel baru telah ditambah');
                $this->etx_model->input($set);
                redirect(base_url() . "backendartikel/myartikel/?status=all");
                exit();
            } else {
                $this->session->set_flashdata('message', 'Sistem mengalami gangguan saat memproses data yang Anda inputkan.');
                redirect(base_url() . "backendartikel/myartikel/form");
                exit();
            }
        }
        redirect(base_url() . 'backendartikel/myartikel/?status=all');
    }

    public function update()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' . validation_errors());
            redirect(base_url() . 'backendartikel/myartikel/form?id=' . $id);
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
                        'discription_seo' => ($this->input->post("discription_seo")),
                        'img' => ($this->input->post("txtfilegambar"))
                    );
                    $this->session->set_flashdata('message', 'Artikel telah di update');
                    $this->etx_model->update(array('id' => $id, 'created_by' => $this->sessionmember['id']), $set);
                    redirect(base_url() . 'backendartikel/myartikel/?status=all');
                    exit();
                } else {
                    $this->session->set_flashdata('message', 'Sistem mengalami gangguan saat memproses data yang Anda inputkan.');
                    redirect(base_url() . "backendartikel/myartikel/form?id=" . $id);
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
                    'img' => ($this->input->post("txtfilegambarold"))
                );
                $this->session->set_flashdata('message', 'Artikel telah di update');
                $this->etx_model->update(array('id' => $id, 'created_by' => $this->sessionmember['id']), $set);

                redirect(base_url() . 'backendartikel/myartikel/?status=all');
                exit();
            }
        }
        redirect(base_url() . 'backendartikel/myartikel/?status=all');
    }

    public function hapus()
    {
        $where = array('id' => $this->input->get("id"), 'created_by' => $this->sessionmember['id']);
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Artikel telah disembunyikan');
        redirect(base_url() . 'backendartikel/myartikel/?status=all');
    }

    public function show()
    {
        $where = array('id' => $this->input->get("id"), 'created_by' => $this->sessionmember['id']);
        $this->etx_model->show($where);
        $this->session->set_flashdata('message', 'Artikel telah ditampilkan');
        redirect(base_url() . 'backendartikel/myartikel/?status=all');
    }
}
