<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("m_principal");
        $this->load->model("general/general_model");
        $this->load->model("member/member_model");
        $this->load->language("partnership");
        $this->load->language("form");
    }

    function index()
    {
        $data["seotitle"] = $this->lang->line('seo_title_principal');
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = "Sparepart di jual dengan harga murah ";

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'index';
        } else {
            $data['content'] = 'index_mobile';
        }

        $this->load->view('front/template_front1', $data);
    }

    public function partnership()
    {
        $data["seotitle"] = $this->lang->line('seo_title_partnership');
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = $this->lang->line('seo_description_partnership');

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'partnership';
        } else {
            $data['content'] = 'partnership_mobile';
        }

        $this->load->view('front/template_front1', $data);
    }

    function form()
    {
        $session = $this->session->all_userdata();
        $data["getbrand"] = $this->general_model->getbrand(null, true);
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
            'posisi' => "",
            'phone' => $sessionmember["phone"],
            'email' => $sessionmember["email"],
            'company' => $sessionmember["Company"],
            'provinsi' => $sessionmember["provice"],
            'kota' => $sessionmember["city"],
            'kecamatan' => $sessionmember["districts"],
            'alamat' => $sessionmember["address"],
            'office_phone' => "",
            'office_email' => "",
        );
        $data["seotitle"] = $this->lang->line('seo_title_principal');
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = $this->lang->line('seo_description_principal');

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css", "/modules/principal/css/principal.css");
        $data["js"] = array(base_url() . "asset/js/slick/slick.min.js", "/modules/principal/js/principal.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/form';
        } else {
            $data['content'] = 'mobile/form_mobile';
        }

        $this->load->view('front/template_front1', $data);
    }

    function save()
    {
        $data['name'] = $this->input->post('name');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['company'] = $this->input->post('company');
        $data['product'] = $this->input->post('product');
        $data['brand'] = $this->input->post('brand');
        $data['country'] = $this->input->post('country');
        $data['additional_info'] = $this->input->post('additional_info');
        $data['is_read'] = 0;
        $data['create_at'] = strtotime(date('Y-m-d H:i:s'));
        $data['keterangan'] = "";

        /* $response = $this->input->post("g-recaptcha-response");
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        
        $content = array(
            'secret' => '6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y',
            'response' => $this->input->post("g-recaptcha-response")
        );
        
        $options = array(
            'http' => array (
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen(http_build_query($content))."\r\n".
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
        } else if ($captcha_success->success == true) { */
        $email_content = $data;
        $message = $this->load->view('email/principal', $email_content, true);
        $this->send_email("Trumecs.com - Terimakasih telah mendaftar sebagai principal kami", $data['email'], $message);

        $this->m_principal->save($data);
        redirect('principal/success');
        /* } */
    }

    function save_email()
    {

       
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-error', 'Anda tidak memasukkan email dengan benar');
            redirect(base_url() . 'principal/form');
            exit();
        }
        $data['email'] = $this->input->post('email');
        $data['is_read'] = 0;
        $data['create_at'] = strtotime(date('Y-m-d H:i:s'));
        $this->m_principal->save($data);
        $this->session->set_flashdata('message', 'Terimakasih sudah mengisi untuk menjadi Principal kami.');

       
        redirect('principal/form');
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
        $this->load->view('front/template_front1', $data);
    }

    public function register()
    {
        $data["seotitle"] = $this->lang->line('seo_title_partnership');
        $data["seokeywords"] = "jual sparepart truk,sparepart truk";
        $data["seodescription"] = $this->lang->line('seo_description_partnership');

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/form_register';
        } else {
            $data['content'] = 'mobile/form_mobile_register';
        }

        $this->load->view('front/template_front1', $data);
    }

    public function principal_register()
    {

        $session = $this->session->all_userdata();

        if($session != null && isset($session['member']) &&  $session['member'] != null){
            redirect('member');
        }


        $companyName = $this->input->post('company_name');
        $email = $this->input->post('email');

        $captcha = $this->input->post('g-recaptcha-response');
        if(empty($captcha))
        {
            $this->session->set_flashdata('message', 'Invalid Captcha!!');
            redirect('principal/form#campign-seller');
        }
        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $response = json_decode($verify, true);

        if($response['success'] != '1'){
            $this->session->set_flashdata('message', 'Captcha Error!!');
            redirect('principal/form#campign-seller');
        }

        $data['Company'] = $companyName;
        $data['email'] = $email;
        $data['expired_verification'] = strtotime("". date("Y-m-d H:i:s") ." +1 day");

        $member = $this->db->get_where('member', ['email' => $email])->row_array();

        if($member != null){

            $this->session->set_flashdata('message', 'Anda Sudah Terdaftar, Silahkan Login!');
            redirect('principal/form#campign-seller');
        }

        $this->db->insert("member", $data);
        $data['id'] = $this->db->insert_id();

        if($data['id'] > 0){
            $data['verification_link'] =  base_url() . 'principal/verification/' . $data['id'];
        
            $from = "no-reply@trumecs.com";
            $password = "no-reply#trumecs#123abc";
            $to = $email;
            $subject = "Aktifasi Pendaftaran Principal";
            $message = $this->load->view('email/principal_verification', $data, true);

            $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);

            $member = $this->member_model->getmember(['member.id' => $data['id']]);

            $cookie['name'] = 'principal_form';
            $cookie['path'] = '/principal/dataequipment';
            $cookie['value'] = json_encode($member[0]);
            $cookie['expire'] = time() - 3600;

            set_cookie($cookie);

            redirect('principal/register_success');
        }else{
            $this->session->set_flashdata('message', 'Failed Registration Principal');
            redirect('principal/form#campign-seller');
        }

        
    }


    public function register_mail_send()
    {
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'principal/desktop/mail_send_success';
        } else {
            $data['content'] = 'principal/mobile/mail_send_success';
        }
        
        $this->load->view('front/_template_success', $data);
        
    }

    public function verification($id)
    {
        $member = $this->member_model->getmember(['member.id' => $id]);


        if($member == null){
            redirect('404_override');
        }
     
        if(strtolower($member[0]['status']) == 'active'){
            redirect('principal/form');
        }

        $expiredVerfication = strtotime(date("Y-m-d H:i:s", $member[0]['expired_verification']));
        $dateNow = strtotime("now");
        if($dateNow < $expiredVerfication){
            $data['verification_at'] = strtotime("now");
            $data['status'] = 'active';
            
            $this->db->where('id', $id);
            $updated = $this->db->update('member', $data);
           
            
            $this->load->helper('cookie');

            $cookie['name'] = 'principal_form';
            $cookie['path'] = '/principal/dataequipment';
            $cookie['value'] = json_encode($member[0]);
            $cookie['expire'] = time() - 3600;



            set_cookie($cookie);

            redirect('principal/dataequipment');


        }else{
            redirect('/404_override');
        }
        

    }

    public function dataequipment()
    {

        if(!isset($_COOKIE['principal_form'])){
            redirect('/');
        }

        if(empty($_COOKIE['principal_form'])){
            redirect('/');
        }

        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'No HP/WA', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('company', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('company_email', 'Email Perusahaan', 'required');
        $this->form_validation->set_rules('company_phone', 'No Telepon Perusahaan', 'required');
        $this->form_validation->set_rules('brand', 'Brand', 'required');
        $this->form_validation->set_rules('product', 'Product', 'required');
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha', 'required');

       

        if ($this->form_validation->run() == FALSE)
        {
            $data['member'] = json_decode($_COOKIE['principal_form']);
        
            $data["seotitle"] = $this->lang->line('seo_title_principal');
            $data["seokeywords"] = "jual sparepart truk,sparepart truk";
            $data["seodescription"] = $this->lang->line('seo_description_principal');
    
            $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css", "/modules/principal/css/principal.css");
            $data["js"] = array(base_url() . "asset/js/slick/slick.min.js", "/modules/principal/js/principal_form_complete.js");
            $data['user_data'] = [];
            if (!$this->agent->is_mobile()) {
                $data['content'] = '/desktop/principal_form_complete';
            } else {
                $data['content'] = 'mobile/principal_form_complete';
            }

            $this->load->view('front/template_front1', $data);
        }
        else
        {
            $id = $this->input->post("id");
            $member['name'] = $this->input->post('name');
            $member['email'] = $this->input->post('email');
            $member['phone'] = $this->input->post('phone');
            $member['password'] = md5($this->input->post('password'));
            $member['Company'] = $this->input->post('company');
            $member['company_email'] = $this->input->post('company_email');
            $member['company_phone'] = $this->input->post('company_phone');
            $this->db->where('id', $id);
            if($this->db->update('member', $member)){
                $principal['company'] = $this->input->post('company');
                $principal['name'] = $this->input->post('name');
                $principal['product'] = $this->input->post('product');
                $principal['brand'] = $this->input->post('brand');
                $principal['email'] = $this->input->post('email');
                $principal['phone'] = $this->input->post('phone');
                $principal['create_at'] = time();
                $principal['country'] = $this->input->post('country');
               
                $this->db->insert('principal', $principal);

                $Loginmember = array("Loginmember" => 'TRUE');

                $member = $this->member_model->getmember(['member.id' => $id]);
                $data = array_merge($member[0], $Loginmember);
                $this->session->set_userdata("member", $data);

                unset($_COOKIE['principal_form']);
                
                $cookie['name'] = 'principal_form';
                $cookie['value'] = '';
                $cookie['expire'] = 0;

                set_cookie($cookie);

                redirect('member');
                

            }else{
                $this->session->set_flashdata('failed_updating_member', '<div class="alert alert-danger" role="alert">Gagal Pendaftaran Principal, Coba Lagi</div>');
                $this->form_validation->run(false);
                redirect('principal/dataequipment');
            }
        }
    }
}