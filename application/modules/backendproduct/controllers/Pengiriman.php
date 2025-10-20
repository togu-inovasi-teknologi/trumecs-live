<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
    }
    public function index()
    {
        $this->securitylog->cekadmin();
        redirect(base_url() . "backendproduct/pengiriman/listall");
    }

    public function listall()
    {
        $data["js"] = array(base_url() . 'asset/backend/js/list.pengiriman.js');
        $data['content'] = 'pengiriman';
        $this->load->view('backend/template_front', $data);
    }

    public function ambil_data()
    {
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total = $this->db->count_all_results("delivery_area");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->like("send_form", $search);
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0'):
            $this->db->order_by('send_from', $_REQUEST['order'][0]['dir']);
        endif;
        $query = $this->db->get('delivery_area');
        if ($search != "") {
            $this->db->like("send_form", $search);
            $jum = $this->db->get('delivery_area');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        foreach ($query->result_array() as $page) {


            $output['data'][] = array(

                '<a class="fbold f14 forange" href="' . base_url() . 'backendprodcut/form?id=' . $page["id"] . '">' . $page["send_from"] . '</a>',

                $page["description"],

                '<a class="btn btn-sm btn-warning" href="' . base_url() . 'backendproduct/pengiriman/form?id=' . $page["id"] . '"><i class="fa fa-edit"></i></a>',

                '<a class="btn btn-sm btn-danger" href="' . base_url() . 'backendproduct/pengiriman/hapus?id=' . $page["id"] . '"><i class="fa fa-trash"></i></a>'
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

        $data['content'] = 'form_pengiriman';
        $data["css"] = array(base_url() . 'asset/backend/dist/js/tinymce/skins/lightgray/skin.min.css');
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
        $data['id'] = $id;
        $this->load->view('backend/template_front', $data);
    }

    public function input()
    {
        $this->form_validation->set_rules('send_from', 'Asal pengiriman', 'required');
        $this->form_validation->set_rules('description', 'Keterangan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url() . 'backendproduct/pengiriman/form');
        } else {
            $set = array(
                'send_from' => $this->input->post("send_from"),
                'description' => ($this->input->post("description"))
            );
            $this->session->set_flashdata('message', 'Asal pengiriman baru telah ditambah');
            $this->etx_model->input($set);
        }
        redirect(base_url() . 'backendproduct/pengiriman/listall');
    }

    public function update()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('send_from', 'Asal pengiriman', 'required');
        $this->form_validation->set_rules('description', 'Keterangan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url() . 'backendproduct/pengiriman/form?id=' . $id);
        } else {
            $set = array(
                'send_from' => $this->input->post("send_from"),
                'description' => ($this->input->post("description"))
            );
            $this->session->set_flashdata('message', 'Asal pengiriman telah diupdate');
            $this->etx_model->update(array('id' => $id), $set);
        }
        redirect(base_url() . 'backendproduct/pengiriman/listall');
    }

    public function hapus()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Asal pengiriman telah dihapus');
        redirect(base_url() . 'backendproduct/pengiriman/listall');
    }
}
