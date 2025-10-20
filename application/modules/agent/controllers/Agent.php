<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("m_agent");
        $this->load->language("partnership");
        $this->load->language("form");
    }

    function index()
    {
        $data["seotitle"] = "Jual Sparepart  - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = "Sparepart di jual dengan harga murah ";

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'index';
        } else {
            $data['content'] = 'index_mobile';
        }

        $this->load->view('front/template_front', $data);
    }

    function form()
    {
        $session = $this->session->all_userdata();
        $sessionmember = array_key_exists("member", $session) ? $session["member"] : array(
            "name" => "",
            "phone" => "",
            "email" => "",
            "Company" => "",
            "provice" => "",
            "city" => "",
            "districts" => "",
            "address" => "",
        );
        $data['user_data'] = array(
            'nama' => $sessionmember["name"],
            'phone' => $sessionmember["phone"],
            'email' => $sessionmember["email"],
            'company' => $sessionmember["Company"],
            'provinsi' => $sessionmember["provice"],
            'kota' => $sessionmember["city"],
            'kecamatan' => $sessionmember["districts"],
            'alamat' => $sessionmember["address"],
        );
        $data["seotitle"] = "Jual Sparepart  - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = "Sparepart di jual dengan harga murah ";

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/slick/slick.min.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'form';
        } else {
            $data['content'] = 'form_mobile';
        }

        $this->load->view('front/template_front', $data);
    }

    function save()
    {
        $data['nama'] = $this->input->post('nama');
        $data['handphone'] = $this->input->post('handphone');
        $data['email'] = $this->input->post('email');
        $data['domisili'] = $this->input->post('domisili');
        $data['jobdesc'] = $this->input->post('jobdesc');
        $data['scope'] = implode(",", $this->input->post('scope'));
        $data['area'] = $this->input->post('area');
        $data['product'] = implode(",", $this->input->post('product'));
        $data['active_date'] = strtotime($this->input->post('active_date'));
        $data['status'] = $this->input->post('status');
        $data['is_read'] = 0;
        $data['create_at'] = strtotime(date('Y-m-d H:i:s'));
        $data['is_approved'] = 0;
        $data['approved_at'] = 0;
        $data['keterangan'] = "";

        $response = $this->input->post("g-recaptcha-response");
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $content = array(
            'secret' => '6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y',
            'response' => $this->input->post("g-recaptcha-response")
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen(http_build_query($content)) . "\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",
                'content' => http_build_query($content)
            )
        );

        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        if ($captcha_success->success == false) {
            $this->session->set_flashdata('form_error', '<div class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> <strong>Error!</strong> Silahkan isi captcha terlebih dahulu</div>');
            redirect('agent/form');
        } else if ($captcha_success->success == true) {
            $email_content = $data;
            $message = $this->load->view('email/agent', $email_content, true);
            $this->send_email("Trumecs.com - Terimakasih telah mendaftar sebagai agen kami", $data['email'], $message);

            $this->m_agent->save($data);
            redirect('agent/success');
        }
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

    public function success()
    {
        $data['content'] = 'success';
        $this->load->view('front/template_front', $data);
    }
}
