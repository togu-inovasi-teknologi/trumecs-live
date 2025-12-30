<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendprincipal extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("m_backendprincipal");
    }

    function index()
    {
        $data["seotitle"] = "Jual Sparepart  - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = "Sparepart di jual dengan harga murah ";

        $data["list"] = $this->m_backendprincipal->get_all();

        $data["js"] = array(
            base_url() . 'asset/backend/js/list-principal.js'
        );
        $data['js_cdn'] = '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>';
        $data['css_cdn'] = '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"></script>';

        $data['content'] = 'index';

        $this->load->view('backend/template_front', $data);
    }

    function detail($id)
    {
        $data["seotitle"] = "Jual Sparepart  - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = "Sparepart di jual dengan harga murah ";

        $data["detail"] = $this->m_backendprincipal->get($id);

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");

        $data['content'] = 'detail';

        $this->load->view('backend/template_front', $data);
    }

    function save($id = null)
    {
        $detail = $this->m_backendprincipal->get($id);

        $data['name'] = $this->input->post('name');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['company'] = $this->input->post('company');
        $data['country'] = $this->input->post('country');
        $data['product'] = $this->input->post('product');
        $data['brand'] = $this->input->post('brand');
        $data['additional_info'] = $this->input->post('additional_info');
        $data['is_read'] = 0;
        $data['create_at'] = $detail->row()->create_at;
        $data['keterangan'] = $this->input->post('keterangan');
        $data['id'] = $id;

        /* if ($captcha_success->success == false) {
            $this->session->set_flashdata('form_error', '<div class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> <strong>Error!</strong> Silahkan isi captcha terlebih dahulu</div>');
            redirect('agent/form');
        } else if ($captcha_success->success == true) { */
        /* $email_content = $data;
            $message = $this->load->view('email/tender', $email_content, true);
            $this->send_email("Berpartner dengan Trumecs adalah keputusan tepat", $data['email'], $message); */

        $this->session->set_flashdata('form_error', '<div class="alert alert-success"><span class="bi bi-check-circle"></span> <strong>Sukses!</strong> Perubahan berhasil dilakukan</div>');
        $this->m_backendprincipal->save($data);
        redirect('backendprincipal/detail/' . $id);
        /* } */
    }

    private function send_email($subject, $receiver, $message)
    {
        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $receiver;
        $subject = $subject;
        $message = $message;
        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
    }

    public function get_new()
    {
        $data = $this->m_backendprincipal->get_new($this->input->post('last_id'));
        $list = array();
        $last = $this->input->post('last_id');

        if ($data->num_rows() > 0) {

            foreach ($data->result() as $key => $item) {
                $last = $data->row()->id;
                $list[] = array(
                    "0" => $item->id,
                    "1" => '<a href="' . site_url('backendprincipal/detail/' . $item->id) . '" style="color:#fff;">' . $item->name . ' <span class="label label-success" style="font-weight:bold">new</span>',
                    "2" => $item->phone,
                    "3" => $item->email,
                    "4" => $item->company,
                    "5" => $item->product,
                    "6" => $item->country
                );
            }
        }

        echo json_encode(array(
            'number' => $data->num_rows(),
            'list' => $list,
            'last' => $last
        ));
    }
}
