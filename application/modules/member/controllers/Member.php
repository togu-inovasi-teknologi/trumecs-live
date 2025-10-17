
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Google\Client as GoogleClient;
use Google\Service\Oauth2;

class Member extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("member/member_model");
        $this->load->model("sourcing_model");
        $this->load->model("sourcing_item_model");
        $this->load->model("sourcing_file_model");
        $this->load->model("order/order_model");
        $this->load->model("order/order_item_model");
        $this->load->model("member_store_model", "store_model");
        $this->load->model("c/c_model");
        $this->load->model("backendprospek/M_Prospek");
        $this->load->model("bulk/m_bulk");
        $this->load->helper("download");
        $this->load->language("form");
        $this->load->language("note");
        $this->load->language("button");
        $this->load->language("modal");
        $this->load->language("partnership");
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->load->language('member/member');
        $session = $this->session->all_userdata();

        if (!isset($session['member'])) {
            redirect('/member/login');
        }
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["provinces"] = $this->member_model->getprovinces();
        $data["member"] = $this->member_model->getmember(['member.id' => $sessionmember['id']]);
        $this->securitylog->cekloginmember();
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", "modules/member/js/member/member.js", base_url() . "asset/js/member_page.js");
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        if (!$this->agent->is_mobile()) {
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", "modules/member/js/member/member.js", base_url() . "asset/js/member_page.js");
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "desktop/member/_akunpembeli";
        } else {
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", "modules/member/js/member/mobile/member.js", base_url() . "asset/js/member_page.js");
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "mobile/member/_akunpembeli";
        }
        $data["seotitle"] = "Member Area Trumecs";
        $this->load->view('front/template_front1', $data);
    }

    public function session_store()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $store = array('store.member_id' => $sessionmember["id"]);
        return $store;
    }

    public function session_member()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('member.id' => $sessionmember["id"]);
        $member = $this->member_model->getmember($where);
        return $member;
    }

    private function getcategory($id)
    {
        $unserialize = unserialize(CATEGORY_ALL);
        $id_array =  array_search($id, array_column(unserialize(CATEGORY_ALL), 'id')); //array_search($id, CATEGORY_ALL);
        return ($unserialize[$id_array]["name"]);
    }

    public function login()
    {
        $this->load->language('signin');
        $this->load->language('form');
        $ses = $this->session->all_userdata();
        if (array_key_exists("member", $ses)) {
            if ($ses['member']['id'] != null) {
                redirect(base_url() . "member");
            }
        }
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/member/login.js");
        if ($this->agent->is_mobile()) {
            $data['content'] = 'login_page_v2_mobile';
        } else {
            $data['content'] = 'login_page_v2';
        }
        $data["seotitle"] =  $this->lang->line("seo_title_signin", FALSE) . " - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk, promo sparepart,login";
        $data["seodescription"] = $this->lang->line("seo_description_signin", FALSE);
        $this->load->view('front/template_front1', $data);
    }

    public function login_google()
    {
        $client = new GoogleClient();
        $clientGoogle = $this->config->load('google');
        $client->setApplicationName($clientGoogle['application_name']);
        $client->setClientId($clientGoogle['client_id']);
        $client->setClientSecret($clientGoogle['client_secret']);
        $client->setRedirectUri($clientGoogle['redirect_uri']);
        $client->addScope($clientGoogle['scopes']);
        if ($code = $this->input->get('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($code);
            $client->setAccessToken($token);
            $oauth = new Oauth2($client);
            $user_info = $oauth->userinfo->get();
            $whereIdGoogle = array('member.id_google' => $user_info['id']);
            $member["datauser"] = $this->member_model->getmember($whereIdGoogle);
            $infoMember = $member["datauser"][0];
            $infoMember['Loginmember'] = "TRUE";
            if ($this->member_model->alreadyRegister("id_google", $user_info['id'])) {
                $this->session->set_userdata('member', $infoMember);
            } else {
                $datejoin = date("d-m-Y");
                $dateupdate = date("Y-m-d H:i:s");
                $data['id_google'] = $user_info->id;
                $data['name'] = $user_info->name;
                $data['email'] = $user_info->email;
                $data['avatar'] = (isset($user_info['picture'])) ? $user_info['picture'] : '';
                $data['datejoin'] = $datejoin;
                $data['updated_at'] = $dateupdate;
                $data['status'] = "active";
                $data['level'] = "silver";
                $data['point'] = 0;
                $this->member_model->insertGoogle($data);
            }
            redirect(base_url() . 'member');;
        } else {
            $url = $client->createAuthUrl();
            header('Location:' . filter_var($url, FILTER_SANITIZE_URL));
        }
    }

    public function logout()
    {
        //$this->session->sess_destroy();
        $this->session->unset_userdata("member");
        $this->session->unset_userdata("access_token");
        $this->session->unset_userdata("Loginmember");
        $this->session->unset_userdata('_tracker');
        redirect(base_url() . "member/login");
    }

    public function formreset()
    {
        $this->load->language('signin');
        $this->load->language('form');
        $data["seotitle"] =  $this->lang->line("seo_title_reset", FALSE) . " - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk, promo sparepart,login";
        $data["seodescription"] = $this->lang->line("seo_description_teset", FALSE);
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data['content'] = 'form_reset_page';
        $this->load->view('front/template_front1', $data);
    }

    public function resetpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Anda tidak memasukkan email dengan benar');
            redirect(base_url() . 'member/formreset');
            exit();
        }
        $email = $this->input->post('email');
        $dataemail['md5'] = substr(uniqid(), 0, 5);
        //cek email available
        $where = array(
            'email' => $email
        );
        $available = $this->member_model->getmember($where);
        if (count($available) > 0) {
            $from = "no-reply@trumecs.com";
            $password = "no-reply#trumecs#123abc";
            $to = $email;
            $subject = "Reset Password";
            $message = $this->load->view('email/email-to-resetpassword', $dataemail, true);
            $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
            if ($emailstatus = true) {
                $where = array(
                    'email' => $email
                );
                $update = array(
                    'password' => md5($dataemail['md5'])
                );
                $this->member_model->update($where, $update);
                $this->session->set_flashdata('message-success', 'Password default telah dikirim ke email Anda.(' . $email . ')<br>Segera ubah password Anda setelah masuk menggunakan password default.');
                redirect(base_url() . 'member/notification');
            }
        } else {
            $this->session->set_flashdata('message-failed', 'Email yang Anda masukkan belum terdaftar! <a class="btn btn-orange">Daftar sekarang</a>');
            redirect(base_url() . 'member/formreset');
        }
    }

    public function checkmember()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Email/Password yang anda masukkan salah.');
            redirect(base_url() . 'member/login');
        } else {
            $last_page = $this->input->post('last_page');
            $must_page = base_url() . "cart/shipping";
            $data = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
            );
            $data["datauser"] = $this->member_model->getmember($data);
            if (empty($data["datauser"])) {
                $this->session->set_flashdata('message-failed', 'Email/Password yang anda masukkan salah.');
                redirect('member/login');
            } else {
                $Loginmember = array("Loginmember" => 'TRUE');
                $data = array_merge($data["datauser"]["0"], $Loginmember);
                $this->session->set_userdata("member", $data);
                if ($last_page == $must_page) {
                    redirect(base_url() . "cart/shipping");
                } else {
                    redirect(base_url() . "member/login");
                }
            }
        }
    }

    public function checkmember_assync()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Email/Password yang anda masukkan salah.'
            ));
        } else {
            $last_page = $this->input->post('last_page');
            $must_page = base_url() . "cart/shipping";
            $data = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
            );
            $data["datauser"] = $this->member_model->getmember($data);
            if (empty($data["datauser"])) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Email/Password yang anda masukkan salah.'
                ));
            } else {
                $Loginmember = array("Loginmember" => 'TRUE');
                $data = array_merge($data["datauser"]["0"], $Loginmember);
                $this->session->set_userdata("member", $data);
                if ($last_page == $must_page) {
                    redirect(base_url() . "cart/shipping");
                } else {
                    redirect(base_url() . "member/");
                }
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Selamat datang kembali ' . $data['name']
                ));
            }
        }
    }

    public function sentresetpwd()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');

        $email = $this->input->post('email');
        $dataemail['md5'] = substr(uniqid(), 0, 5);

        //cek email available
        $where = array(
            'email' => $email
        );
        $available = $this->member_model->getmember($where);
        if (count($available) > 0) {
            $from = "no-reply@trumecs.com";
            $password = "no-reply#trumecs#123abc";
            $to = $this->input->post('email');
            $subject = "Reset Password";
            $message = $this->load->view('email/email-to-resetpassword', $dataemail, true);
            $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
            if ($emailstatus = true) {
                $where = array(
                    'email' => $email
                );
                $update = array(
                    'password' => md5($dataemail['md5'])
                );
                $this->member_model->update($where, $update);
                $this->session->set_flashdata('message-success', 'Password default telah dikirim ke email Anda.(' . $this->input->post('email') . ')<br>Segera ubah password Anda setelah masuk menggunakan password default.');
                redirect(base_url() . 'notification');
            }
        } else {
            $this->session->set_flashdata('message-failed', 'Email yang Anda masukkan belum terdaftar! <a class="btn btn-orange">Daftar sekarang</a>');
            redirect(base_url() . 'notification');
        }
    }

    public function daftar()
    {
        redirect(base_url() . 'member/signup');
    }

    public function signup()
    {
        $ses = $this->session->all_userdata();
        if (array_key_exists("member", $ses)) {
            redirect(base_url() . "member");
        }
        $this->load->language('signup');
        $this->load->language('form');
        $data["seotitle"] =  $this->lang->line("seo_title_signup", FALSE) . " - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk, promo sparepart,login";
        $data["seodescription"] = $this->lang->line("seo_description_signup", FALSE);
        $data["provinces"] = $this->member_model->getprovinces();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", "/modules/member/js/member/member.js");
        $data['content'] = 'signup_page';
        $this->load->view('front/template_front1', $data);
    }

    public function indata()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run($this) == FALSE) {
            $this->session->set_flashdata('message-failed', 'Data Anda tidak lengkap, Silahkan ulangi pengisian form dengan benar.'); //.validation_errors()
            redirect(base_url() . 'member/login');
        } else {
            $email = $this->input->post('email');
            $data["datauser"] = array(
                'email' => $email
            );
            $data["datauser"] = $this->member_model->getmember($data["datauser"]);
            if (count($data["datauser"]) > 0) {
                $this->session->set_flashdata('message-failed', 'Email Anda sudah terdaftar');
                redirect(base_url() . 'member/login');
                exit();
            }
            $captcha = $this->input->post('g-recaptcha-response');
            if (isset($captcha)) {
                $captcha =  $captcha;
            }
            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            $response = json_decode($verify, true);
            if ($response['success'] != '1') {
                $this->session->set_flashdata('message-failed', 'Anda terdeteksi sebagai robot');
                redirect(base_url() . 'member/login');
            } else {
                $md5email = md5($email);
                $data["dataall"] = array(
                    'id_google' => 0,
                    'name' => $this->input->post('name'),
                    'email' => $email,
                    'password' => md5($this->input->post('password')),
                    'status' => 'active',
                    'level' => 'silver',
                    'point' => '0',
                    'datejoin' => date("d-m-Y"),
                    'md5' => md5($email),
                    'kodeverifybyphone' => substr(md5($email), 4, 8)
                );
                $dataemail['md5'] = $md5email;
                //sent email to new member
                $from = "no-reply@trumecs.com";
                $password = "no-reply#trumecs#123abc";
                $to = $email;
                $subject = "Aktifasi Member";
                $message = $this->load->view('email/email-to-new-account', $dataemail, true);

                $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
                if ($emailstatus = true) {

                    $this->member_model->set($data["dataall"]);
                    $this->member_model->insert($data["dataall"]);

                    $xxx["forverifybyphone"] = array('phone' => $this->input->post('phone'), 'email' => $this->input->post('email'), 'md5' => md5($this->input->post('email')), 'kodeverifybyphone' => substr(md5($this->input->post('email')), 4, 8));

                    $flashdata = $xxx;
                    $loginData = array(
                        'email' => $email,
                        'password' => $this->input->post('password'),
                    );
                    $this->session->set_userdata($flashdata);
                    $this->checkmember($loginData);
                } else {
                    $this->session->set_flashdata('message-failed', 'Email yang anda masukkan tidak benar');
                    redirect(base_url() . 'member/login');
                }
            }
        }
    }

    public function notification()
    {
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data['content'] = 'form_reset_page';
        $this->load->view('front/template_front1', $data);
    }

    public function regex($value)
    {
        return preg_replace('/[^\p{L}\p{N}\s]/u', '', $value);
    }

    public function emailtest()
    {
        $message = $this->load->view('email/email-to-level-up', "", TRUE);

        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.lobunta.com';
        //$config['smtp_crypto']='ssl';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'no-reply@trumecs.com';
        $config['smtp_pass'] = 'no-reply#trumecs#123abc';
        $config['charset'] = 'iso-8859-1';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['validate'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('no-reply@trumecs.com', 'Trumecs');
        $to = $this->input->post('email');
        $this->email->subject('Random ' . mt_rand(1, 15));
        $this->email->message($message);
        $this->email->send();
    }

    public function activation()
    {
        $value = $this->uri->segment(3);
        $data = array('md5' => $value);
        $activation = $this->member_model->activation($data);
        if ($activation == true) {
            $this->session->set_flashdata('message-success', 'Akun Anda telah aktif, Silahkan masuk menggunakan Email dan Password Anda.');
            redirect(base_url() . 'member/login');
            exit();
        } else {
            $this->session->set_flashdata('message-failed', 'Anda tidak memiliki kode aktifasi, Silahkan Daftar');
            redirect(base_url() . 'member/sigup');
            exit();
        }
    }

    public function setting()
    {
        $this->load->language('member/member');
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["provinces"] = $this->member_model->getprovinces();
        $data["member"] = $this->session_member();
        $data['content'] = '/mobile/view_member';
        $data["contentmember"] = "mobile/member/_settingakunpembeli";
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", "modules/member/js/member/mobile/member.js");
        $data["seotitle"] = "Member Area Trumecs";
        $this->load->view('front/template_front1', $data);
    }

    public function updatemember()
    {
        $this->securitylog->cekloginmember();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('date', 'Date', 'required|is_natural');
        $this->form_validation->set_rules('month', 'Month', 'required|is_natural');
        $this->form_validation->set_rules('year', 'Year', 'required|is_natural');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('position', 'Jabatan', 'required');
        $this->form_validation->set_rules('company', 'Company', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('province', 'Province', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('districts', 'Districts', 'required');
        $this->form_validation->set_rules('village', 'Village', 'required');
        $this->form_validation->set_rules('rt_rw', 'Rt_rw', 'required');
        $this->form_validation->set_rules('kodepos', 'Kodepos', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Anda tidak mengisi form dengan benar' . validation_errors());
            redirect(base_url() . 'member');
            exit();
        }
        $date = date("Y-m-d H:i:s");
        $datamember = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'date' => $this->input->post('date'),
            'month' => $this->input->post('month'),
            'year' => $this->input->post('year'),
            'phone' => $this->input->post('phone'),
            'Company' => $this->input->post('company'),
            'position' => $this->input->post('position'),
            'company_email' => $this->input->post('company_email'),
            'company_phone' => $this->input->post('company_phone'),
            'company_field' => '',
            'address' => $this->input->post('address'),
            'provice' => $this->input->post('province'),
            'city' => $this->input->post('city'),
            'districts' => $this->input->post('districts'),
            'kodepos' => $this->input->post('kodepos'),
            'village' => $this->input->post('village'),
            'rt_rw' => $this->input->post('rt_rw'),
            'shipping_idprovince' => $this->input->post('province'),
            'shipping_province' => '',
            'shipping_idcity' => $this->input->post('city'),
            'shipping_city' => '',
            'shipping_iddistricts' => $this->input->post('districts'),
            'shipping_idvillage' => $this->input->post('village'),
            'shipping_address' => $this->input->post('address'),
            'shipping_kodepos' => $this->input->post('kodepos'),
            'shipping_method' => '',
            'updated_at' => $date,
        );
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('member.id' => $sessionmember["id"]);
        $this->db->trans_start();
        $this->member_model->update($where, $datamember);
        $this->session->unset_userdata("member");
        $this->session->unset_userdata("Loginmember");
        $Loginmember = array("Loginmember" => 'TRUE');
        $newdata = $this->member_model->getmember($where);
        $data = array_merge($newdata[0], $Loginmember);
        $this->session->set_userdata("member", $data);
        $this->session->set_flashdata('message-success', 'Terimakasih, telah mengisi data profil Anda');
        $this->db->trans_complete();
        redirect(base_url() . 'member');
        exit();
    }

    public function updatepassword()
    {
        $this->securitylog->cekloginmember();
        $this->form_validation->set_rules('passwordold', 'Password Lama', 'required');
        $this->form_validation->set_rules('passwordnew', 'Password Baru', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Password tidak diisi' . validation_errors());
            redirect(base_url() . 'member');
            exit();
        }
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $sessionpassword = $session["password"];
        $passwordold = $this->input->post(md5("passwordold"));
        if ($passwordold !== $sessionpassword) {
            $this->session->set_flashdata('message-failed', 'Password Lama Salah' . validation_errors());
            redirect(base_url() . 'member');
            exit();
        } else {
            $passwordnew = ($this->input->post('passwordnew') != "") ? md5($this->input->post('passwordnew')) : $this->input->post('passwordold');
            $datapassword = array(
                'password' => $passwordnew,
            );
            $where = array('member.id' => $sessionmember["id"]);
            $this->db->trans_start();
            $this->member_model->update($where, $datapassword);
            $this->db->trans_complete();
            $this->session->set_flashdata('message-success', 'Terimakasih, Password telah diperbaharui');
            redirect(base_url() . 'member');
            exit();
        }
    }

    public function upload_foto_member()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('member.id' => $sessionmember["id"]);
        $config['upload_path'] = './public/image/member/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("images")) {
            $this->session->set_flashdata('message-failed', 'Gagal mengupload foto' . $this->upload->display_errors());
            redirect(base_url() . "member");
            exit();
        } else {
            $data = $this->upload->data();
            var_dump($data);
            $foto = array(
                'avatar' => $data["file_name"],
            );
            $this->db->trans_start();
            $this->member_model->update($where, $foto);
            $this->db->trans_complete();
            $this->session->set_flashdata('message-success', 'Foto berhasil diunggah');
            if ($this->agent->is_mobile()) {
                redirect(base_url() . "member/setting");
            } else {
                redirect(base_url() . "member");
            }
        }
    }

    public function history()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/member/orderHistory.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view_member';
            $data["contentmember"] = "desktop/member/_histroypesanan";
        } else {
            $data['content'] = 'mobile/view_member';
            $data["contentmember"] = "mobile/member/_histroypesanan";
        }
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $this->load->view('front/template_front1', $data);
    }

    public function history_order($value = '')
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_historypesanandetail";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_historypesanandetail";
        }
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"], "iduniq" => $value);

        $data["datadetail"] = $this->member_model->getcartorderdetail($where);
        if (count($data["datadetail"]) == 0) {
            $this->session->set_flashdata('message-failed', 'Anda tidak memiliki pesanan dengan ID Order <strong>' . $value . '</strong><br><br><a href="' . base_url() . 'member/history" class="btn btn-orange">lihat riwayat pesanan</a>');
            redirect(base_url() . 'member/notification');
            exit();
        }
        $this->load->view('front/template_front1', $data);
    }

    public function invoice($value = '')
    {
        //set_time_limit(120);
        $this->securitylog->cekloginmember();
        $data["content"] = "contentblankview";
        $data["contentblankview"] = "member/_invoice";
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"], "iduniq" => $value);

        $data["datadetail"] = $this->member_model->getinvoice($where);
        if (count($data["datadetail"]) == 0) {
            $this->session->set_flashdata('message-failed', 'Anda tidak memiliki pesanan dengan ID Order <strong>' . $value . '</strong><br><br><a href="' . base_url() . 'member/history" class="btn btn-orange">lihat riwayat pesanan</a>');
            redirect(base_url() . 'member/notification');
            exit();
        }

        #$html = $this->load->view('front/_blankview', $data);
        $html = $this->load->view('front/_blankview', $data, true);
        #$html = "halo";
        $this->load->helper("file");
        $this->load->library("pdf");
        $this->pdf->create($html, "bukti pembelian trumecs.com - " . $value);
    }

    public function confirmation_list()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $where = array('idmember' => $sessionmember["id"]);
        $data["list"] = $this->member_model->getconfirmation($where);
        if (!$this->agent->is_mobile()) {
            $data["css"] = array(base_url() . "asset/css/member_page.css", "modules/member/css/member.css");
            $data["js"] = array(base_url() . "asset/js/member_page.js", "/modules/member/js/member/member.js");
            $data['content'] = 'desktop/view_member';
            $data["contentmember"] = "desktop/member/_confirmation_list";
        } else {
            $data["css"] = array(base_url() . "asset/css/member_page.css", "modules/member/css/member.css");
            $data["js"] = array(base_url() . "asset/js/member_page.js", "/modules/member/js/member/mobile/member.js");
            $data['content'] = 'mobile/view_member';
            $data["contentmember"] = "mobile/member/_confirmation_list";
        }
        $this->load->view('front/template_front1', $data);
    }

    public function confirmation_edit($value = '')
    {
        $id = $this->uri->segment(3);
        $this->securitylog->cekloginmember();
        $data["css"] = array(
            base_url() . "asset/css/member_page.css",
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css",
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"
        );
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js",
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/js/member_page.js",
            base_url() . "asset/js/member/confirmation.js",
            base_url() . "asset/js/member/datepick.js"
        );
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_confirmation";
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"], "status" => "unpaid");
        $data["listorder"] = $this->member_model->getorderdetailv_2($where);

        $where = array('idmember' => $sessionmember["id"], "status" => "new", "id" => $id);
        $data["data"] = $this->member_model->getconfirmation($where)[0];
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_confirmation_edit";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_confirmation_edit";
        }

        $this->load->view('front/template_front1', $data);
    }

    public function confirmation()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(
            base_url() . "asset/css/member_page.css",
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css",
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"
        );
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js",
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/js/member_page.js",
            base_url() . "asset/js/member/confirmation.js",
            base_url() . "asset/js/member/datepick.js"
        );
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view_member';
            $data["contentmember"] = "desktop/member/_confirmation";
        } else {
            $data['content'] = 'mobile/view_member';
            $data["contentmember"] = "mobile/member/_confirmation";
        }
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"], "status" => "unpaid");

        #$data["listorder"]= $this->member_model->get_orderhistoryall($where);
        $data["listorder"] = $this->member_model->getorderdetailv_2($where);
        $this->load->view('front/template_front1', $data);
    }

    public function confirmationwait()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $idmember = !empty($ses["member"]["id"]) ? $ses["member"]["id"] : "";

        $idorder = $this->input->post("idorder");

        $this->form_validation->set_rules('idorder', 'Idorder', 'required');
        $this->form_validation->set_rules('money', 'Money', 'required|is_natural|max_length[15]');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('norek', 'Norek', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required|max_length[10]');
        $this->form_validation->set_rules('bank', 'Bank', 'required');

        $method = $this->input->post("method");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Lengkapi data yang bertanda <strong>*</strong>');
            redirect(base_url() . "member/confirmation");
            exit();
        } else {
        }
        $newname = time() . "-" . $idorder;
        $config['upload_path'] = './public/image/member/confirmation';
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['max_size'] = '1000';
        $config['file_name'] = $newname;
        //load the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        if (!$this->upload->do_upload('fileconfirmation')) {
            $this->session->set_flashdata('message-failed', 'Terjadi kesalah saat mengunggah file, pastikan file berextensi .JPG atau .PDF<br>dengan ukuran file maksimal 1Mb');
            redirect(base_url() . "member/confirmation");
            exit();
        } else {
            $datafile = $this->upload->data();
            $money = $this->input->post("money");
            $name = $this->input->post("name");
            $bank = $this->input->post("bank");
            $norek = $this->input->post("norek");
            $datetranfer = $this->input->post("date");
            $data = array(
                'idorder' => $idorder,
                'idmember' => $idmember,
                'img' => $newname . $datafile["file_ext"],
                "date" => date("d/m/Y H:i"),
                "money" => $money,
                "name" => $name,
                "bank" => $bank,
                "norek" => $norek,
                "datetranfer" => $datetranfer,
                "status" => "new"
            );
            $this->member_model->insertconfirmation($data);
            $pesan = 'Dear Admin,<br>Mohon di cek admin trumecs, ada member yang mengirim konfirmasi pembayaran pada id order #' . $idorder . '.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
            $this->sentemailnotiftoadmin($pesan, "1");
            $this->sentemailnotiftoadmin($pesan, "3");
            $this->session->set_flashdata('message-success', 'Konfirmasi berhasil, kami akan segera mereview dan memproses Id Pemesanan: ' . $idorder);
            redirect(base_url() . "member/confirmation_list");
            exit();
        }
    }

    public function confirmationupdate()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $idmember = !empty($ses["member"]["id"]) ? $ses["member"]["id"] : "";

        $idorder = $this->input->post("idorder");
        $id = $this->input->post("id");

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('idorder', 'Idorder', 'required');
        $this->form_validation->set_rules('money', 'Money', 'required|is_natural|max_length[15]');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('norek', 'Norek', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required|max_length[10]');
        $this->form_validation->set_rules('bank', 'Bank', 'required');

        $method = $this->input->post("method");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Lengkapi data yang bertanda <strong>*</strong>');
            redirect(base_url() . "member/confirmation_edit" . $id);
            exit();
        } else {
        }
        $img_new = $this->input->post("img_new");
        if ($img_new == "") {
            $money = $this->input->post("money");
            $name = $this->input->post("name");
            $bank = $this->input->post("bank");
            $norek = $this->input->post("norek");
            $datetranfer = $this->input->post("date");
            $data = array(
                'idorder' => $idorder,
                'idmember' => $idmember,
                'img' => $this->input->post("img_old"),
                "date" => date("d/m/Y H:i"),
                "money" => $money,
                "name" => $name,
                "bank" => $bank,
                "norek" => $norek,
                "datetranfer" => $datetranfer,
                "status" => "new"
            );
            $where = array('id' => $id);
            $this->member_model->updateconfirmation($where, $data);
            $pesan = 'Dear Admin,<br>Mohon di cek admin trumecs, ada member yang mengupdate konfirmasi pembayaran pada id order #' . $idorder . '.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
            $this->sentemailnotiftoadmin($pesan, "1");
            $this->sentemailnotiftoadmin($pesan, "3");
            $this->session->set_flashdata('message-success', 'Konfirmasi berhasil, kami akan segera mereview dan memproses Id Pemesanan: ' . $idorder);
            redirect(base_url() . "member/confirmation_list");
            exit();
        }

        $newname = time() . "-" . $idorder;
        $config['upload_path'] = './public/image/member/confirmation';
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['max_size'] = '1000';
        $config['file_name'] = $newname;
        //load the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        if (!$this->upload->do_upload('fileconfirmation')) {
            $this->session->set_flashdata('message-failed', 'Terjadi kesalah saat mengunggah file, pastikan file berextensi .JPG atau .PDF<br>dengan ukuran file maksimal 1Mb');
            redirect(base_url() . "member/confirmation_edit" . $id);
            exit();
        } else {
            $datafile = $this->upload->data();
            $money = $this->input->post("money");
            $name = $this->input->post("name");
            $bank = $this->input->post("bank");
            $norek = $this->input->post("norek");
            $datetranfer = $this->input->post("date");
            $data = array(
                'idorder' => $idorder,
                'idmember' => $idmember,
                'img' => $newname . $datafile["file_ext"],
                "date" => date("d/m/Y H:i"),
                "money" => $money,
                "name" => $name,
                "bank" => $bank,
                "norek" => $norek,
                "datetranfer" => $datetranfer,
                "status" => "new"
            );
            $where = array('id' => $id);
            $this->member_model->updateconfirmation($where, $data);
            $pesan = 'Dear Admin,<br>Mohon di cek admin trumecs, ada member yang mengupdate konfirmasi pembayaran pada id order #' . $idorder . '.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
            $this->sentemailnotiftoadmin($pesan, "1");
            $this->sentemailnotiftoadmin($pesan, "3");
            $this->session->set_flashdata('message-success', 'Konfirmasi berhasil, kami akan segera mereview dan memproses Id Pemesanan: ' . $idorder);
            redirect(base_url() . "member/confirmation_list");
            exit();
        }
    }

    public function claim()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            base_url() . "asset/js/member_page.js",
            base_url() . "asset/js/member/claimreturn.js"
        );
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_listcomplaint";
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"]);

        $data["listcomplaint"] = $this->member_model->getclaim($where);
        $this->load->view('front/template_front1', $data);
    }

    public function formreturn()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(
            base_url() . "asset/css/member_page.css",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"
        );
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js",
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            base_url() . "asset/js/member_page.js",
            base_url() . "asset/js/member/datepick.js",
            base_url() . "asset/js/member/claimreturn.js"
        );
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_formreturn";
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"], "status !=" => "unpaid");

        $data["listorder"] = $this->member_model->get_orderhistoryall($where);
        $this->load->view('front/template_front1', $data);
    }

    public function formgetproduct()
    {
        $this->securitylog->cekloginmember();
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $idorder = $this->input->get("order");
        $data = $this->member_model->getcartorderdetail(array('idmember' => $sessionmember["id"], 'iduniq' => $idorder));
        $str_option = "";
        foreach ($data as $key) {
            //echo $key['name_product'];
            $str_option .= '
                <div class="col-lg-12 nopl">
                <div class="checkbox col-lg-7 nopl">
                <label>
                <input type="checkbox" class="checkbox_' . $key["id"] . '" target="' . $key["id"] . '" name="product[]" value="' . $key["id"] . '"> ' . $key["name_product"] . '
                </label>
                <input class="form-control btn-default "  name="partnumbertrumecs_' . $key["id"] . '" placeholder="Part Number Trumecs" required>
                </div>
                    <a class="btn btn-secondary changequantity" met="plus"  target="' . $key["id"] . '">+</a>
                    <a class="btn btn-secondary disabled " quantity="' . $key["quantity"] . '"  id="product_' . $key["id"] . '" ' . $key["quantity"] . ' >0</a>
                    <a class="btn btn-secondary changequantity" met="min"  target="' . $key["id"] . '">-</a>
                <div class="hidden-xl-down">
                <input name="name_' . $key["id"] . '"  value="' . $key["name_product"] . '" >
                <input name="partnumber_' . $key["id"] . '"  value="' . $key["partnumber_product"] . '">
                <input class="inputvalue_' . $key["id"] . '" name="value_' . $key["id"] . '"  value="1">
                </div>
                </div>

                ';
        }
        echo $str_option;
        echo '
        <script type="text/javascript">
        $("input[type=checkbox] ").click(function() {
            var target = $(this).attr("target");
            var chek= $(this ).prop( "checked");
            if (chek==true) {
                $("#product_"+target).text("1");
                $(".inputvalue_"+target).val("1");
            }else{
                $("#product_"+target).text("0");
                $(".inputvalue_"+target).val("0");
            }

        });
          $(".changequantity").click(function() {
                    var met = $(this).attr("met"),
                        target = $(this).attr("target");
                    var gettarget = $("#product_"+target).text();
                    var quantity = $("#product_"+target).attr("quantity");
                    var chek= $(".checkbox_"+target).prop( "checked");
                    if (chek==true) {
                        if (met=="plus") {  
                            if (quantity>parseInt(gettarget)) {
                                var now =(parseInt(gettarget)+1);
                                $("#product_"+target).text(now);
                                $(".inputvalue_"+target).val(now);
                            }              
                        } else if (met=="min"){
                            if (0<parseInt(gettarget)) {
                                var now =(parseInt(gettarget)-1);
                                $("#product_"+target).text(now);
                                $(".inputvalue_"+target).val(now);
                            }
                        };
                    }
                  });
        </script>
                ';
    }

    public function sentclaimreturn()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $idmember = !empty($ses["member"]["id"]) ? $ses["member"]["id"] : "";
        $this->form_validation->set_rules('idorder', 'Idorder', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        //$this->form_validation->set_rules('product', 'Product', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required|max_length[10]');
        //$this->form_validation->set_rules('statement', 'Statement', 'required');
        $this->form_validation->set_rules('pic_evidence', 'Pic_evidence', 'required');
        //$this->form_validation->set_rules('pic_evidencechras', 'Pic_evidencechras', 'required');
        $this->form_validation->set_rules('agre', 'Agre', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Lengkapi data yang bertanda <strong>*</strong>' . validation_errors());
            redirect(base_url() . "member/formreturn");
            exit();
        } else {

            $idorder = $this->input->post("idorder");
            $description = $this->input->post("description");
            $statement = $this->input->post("statement");
            $product = $this->input->post("product");
            $i = 0;
            $str_statement = "<ul>";
            foreach ($statement as $statement) {
                $str_statement .= "<li>" . $statement . "</li>";
                $i++;
            }
            $str_statement .= "</ul>";
            $p = 0;
            $str_product = "<ul>";
            foreach ($product as $product) {
                $name = $this->input->post("name_" . $product);
                $partnumber = $this->input->post("partnumber_" . $product);
                $partnumbertrumecs = $this->input->post("partnumbertrumecs_" . $product);
                $value = $this->input->post("value_" . $product);
                $str_product .= "<li>" . $name . "[" . $partnumber . "]<br>
                                    Part Number Trumecs : " . $partnumbertrumecs . "<br>
                                Jumlah :" . $value . "</li>";
                $p++;
            }
            $str_product .= "</ul>";

            $pic_evidencechras = $this->input->post("pic_evidencechras");
            $x = 0;
            $str_pic_evidencechras = "";
            foreach ($pic_evidencechras as $pic_evidencechras) {
                $filepic_evidencechras = "public/tmp/" . $pic_evidencechras;
                $newfilepic_evidencechras = "public/image/complaint/return/" . $pic_evidencechras;
                if (copy($filepic_evidencechras, $newfilepic_evidencechras)) {
                    unlink($filepic_evidencechras);
                    $str_pic_evidencechras = $str_pic_evidencechras . $pic_evidencechras . ",";
                }
                $x++;
            }

            $pic_evidence = $this->input->post("pic_evidence");
            $date = $this->input->post("date");

            $file = "public/tmp/" . $pic_evidence;
            $newfile = "public/image/complaint/return/" . $pic_evidence;
            if (copy($file, $newfile)) {
                unlink($file);
                $data = array(
                    'idorder' => $idorder,
                    'idmember' => $idmember,
                    'description' => nl2br($description),
                    'statement' => $str_statement,
                    'product' => $str_product,
                    'pic_evidence' => $pic_evidence,
                    'pic_evidencechras' => $str_pic_evidencechras,
                    "date" => $date,
                    'datecomplaint' => date("d/m/Y"),
                    "status" => "waiting respon"
                );
                $this->member_model->insertcomplaint($data);
                $pesan = 'Dear Admin,<br>Mohon di cek admin trumecs, ada member yang mengirim permohonan return barang.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
                $this->sentemailnotiftoadmin($pesan, "1");
                $this->session->set_flashdata('message-success', 'Data komplain terkirim, Kami akan segera memproses komplain yang Anda ajukan.');
                redirect(base_url() . "member/claim");
                exit();
            } else {
                $this->session->set_flashdata('message-failed', 'Sistem mengalami gangguan saat memproses data yang Anda kirim.');
                redirect(base_url() . "member/formreturn");
                exit();
            }
        }
    }

    public function warranty()
    {
        $this->securitylog->cekloginmember();
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            base_url() . "asset/js/member_page.js",
            base_url() . "asset/js/member/claimreturn.js"
        );
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_listcomplaintwarranty";
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"]);

        $data["list"] = $this->member_model->getcomplaintwarranty($where);
        $this->load->view('front/template_front1', $data);
    }

    public function formwarranty()
    {
        $this->securitylog->cekloginmember();
        $this->securitylog->cekloginmember();
        $data["css"] = array(
            base_url() . "asset/css/member_page.css",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"
        );
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js",
            base_url() . "asset/js/number/jquery.number.min.js",
            base_url() . "asset/backend/dist/js/canvas/zepto.min.js",
            base_url() . "asset/backend/dist/js/canvas/binaryajax.js",
            base_url() . "asset/backend/dist/js/canvas/exif.js",
            base_url() . "asset/backend/dist/js/canvas/canvasResize.js",
            base_url() . "asset/js/member_page.js",
            base_url() . "asset/js/member/datepick.js",
            base_url() . "asset/js/member/claimwarranty.js"
        );
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_formwarranty";

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('idmember' => $sessionmember["id"], "status !=" => "unpaid");

        $data["listorder"] = $this->member_model->get_orderhistoryall($where);
        $this->load->view('front/template_front1', $data);
    }

    public function formgetproductwarranty()
    {
        $this->securitylog->cekloginmember();
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $idorder = $this->input->get("order");
        $data = $this->member_model->getcartorderdetail(array('iduniq' => $idorder, 'idmember' => $sessionmember["id"]));
        $str_option = "";
        foreach ($data as $key) {
            if ($key['warranty'] != NULL) {
                # code...

                //echo $key['name_product'];
                $str_option .= '
                <div class="row">
                <div class="checkbox col-lg-7 nopl ">
                <label>
                <input type="checkbox" class="checkbox_' . $key["id"] . '" target="' . $key["id"] . '" name="product[]" value="' . $key["id"] . '"> ' . $key["name_product"] . '
                </label>
                <input name="partnumbertrumecs_' . $key["id"] . '" class="form-control btn-default " placeholder="Part Number Trumecs" required>
                </div>
                    <a class="btn btn-secondary changequantity" met="plus"  target="' . $key["id"] . '">+</a>
                    <a class="btn btn-secondary disabled " quantity="' . $key["quantity"] . '"  id="product_' . $key["id"] . '" ' . $key["quantity"] . ' >0</a>
                    <a class="btn btn-secondary changequantity" met="min"  target="' . $key["id"] . '">-</a>
                    

                <div class="hidden-xs-up">
                <input name="name_' . $key["id"] . '"  value="' . $key["name_product"] . '" >
                <input name="partnumber_' . $key["id"] . '"  value="' . $key["partnumber_product"] . '">
                <input class="inputvalue_' . $key["id"] . '" name="value_' . $key["id"] . '"  value="1">
                </div>
                </div>
                ';
            }
        }
        if ($str_option != "") {
            echo $str_option;
        } else {
            echo "Tidak ada produk yang bergaransi di Id Order :" . $idorder;
        }


        echo '
        <script type="text/javascript">
        $("input[type=checkbox] ").click(function() {
            var target = $(this).attr("target");
            var chek= $(this ).prop( "checked");
            if (chek==true) {
                $("#product_"+target).text("1");
                $(".inputvalue_"+target).val("1");
            }else{
                $("#product_"+target).text("0");
                $(".inputvalue_"+target).val("0");
            }

        });
          $(".changequantity").click(function() {
                    var met = $(this).attr("met"),
                        target = $(this).attr("target");
                    var gettarget = $("#product_"+target).text();
                    var quantity = $("#product_"+target).attr("quantity");
                    var chek= $(".checkbox_"+target).prop( "checked");
                    if (chek==true) {
                        if (met=="plus") {  
                            if (quantity>parseInt(gettarget)) {
                                var now =(parseInt(gettarget)+1);
                                $("#product_"+target).text(now);
                                $(".inputvalue_"+target).val(now);
                            }              
                        } else if (met=="min"){
                            if (0<parseInt(gettarget)) {
                                var now =(parseInt(gettarget)-1);
                                $("#product_"+target).text(now);
                                $(".inputvalue_"+target).val(now);
                            }
                        }
                    };
                  });
        </script>
        ';
    }

    public function sentclaimwarranty()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $idmember = !empty($ses["member"]["id"]) ? $ses["member"]["id"] : "";

        $this->form_validation->set_rules('idorder', 'Idorder', 'required');
        #$this->form_validation->set_rules('product', 'Product', 'required');
        #$this->form_validation->set_rules('quantity', 'Quantity', 'required');
        #$this->form_validation->set_rules('partnumber', 'Partnumber', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('pic_evidence', 'Pic_evidence', 'required');
        #$this->form_validation->set_rules('pic_evidencechras', 'Pic_evidencechras', 'required');
        $this->form_validation->set_rules('agre', 'Agre', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Lengkapi data yang bertanda <strong>*</strong>' . validation_errors());
            redirect(base_url() . "member/formwarranty");
            exit();
        } else {

            $idorder = $this->input->post("idorder");
            $description = $this->input->post("description");
            $product = $this->input->post("product");
            $i = 0;

            $p = 0;
            $str_product = "<ul>";
            foreach ($product as $product) {
                $name = $this->input->post("name_" . $product);
                $partnumber = $this->input->post("partnumber_" . $product);
                $partnumbertrumecs = $this->input->post("partnumbertrumecs_" . $product);
                $value = $this->input->post("value_" . $product);
                $str_product .= "<li>" . $name . "[" . $partnumber . "]<br>
                                    Part Number Trumecs : " . $partnumbertrumecs . "<br>
                                Jumlah :" . $value . "</li>";
                $p++;
            }
            $str_product .= "</ul>";

            $pic_evidencechras = $this->input->post("pic_evidencechras");
            $x = 0;
            $str_pic_evidencechras = "";
            foreach ($pic_evidencechras as $pic_evidencechras) {
                $filepic_evidencechras = "public/tmp/" . $pic_evidencechras;
                $newfilepic_evidencechras = "public/image/complaint/warranty/" . $pic_evidencechras;
                if (copy($filepic_evidencechras, $newfilepic_evidencechras)) {
                    unlink($filepic_evidencechras);
                    $str_pic_evidencechras = $str_pic_evidencechras . $pic_evidencechras . ",";
                }
                $x++;
            }

            $pic_evidence = $this->input->post("pic_evidence");
            $date = $this->input->post("date");

            $file = "public/tmp/" . $pic_evidence;
            $newfile = "public/image/complaint/warranty/" . $pic_evidence;
            if (copy($file, $newfile)) {
                unlink($file);
                $data = array(
                    'idorder' => $idorder,
                    'idmember' => $idmember,
                    'description' => nl2br($description),
                    'product' => $str_product,
                    'pic_evidence' => $pic_evidence,
                    'pic_evidencechras' => $str_pic_evidencechras,
                    'datecomplaint' => date("d/m/Y"),
                    "status" => "waiting respon"
                );
                $this->member_model->insertcomplaintwarranty($data);
                $pesan = 'Dear Admin,<br>Mohon di cek admin trumecs, ada member yang mengirim permohonan claim garansi.<br>' . '<a  target="_blank" href="' . base_url() . 'backendcomplaintwarranty/?status=all">Lihat sekarang</a>';
                $this->sentemailnotiftoadmin($pesan, "1");
                $this->session->set_flashdata('message-success', 'Data klaim garansi terkirim, Kami akan segera memproses klaim yang Anda ajukan.');
                redirect(base_url() . "member/warranty");
                exit();
            } else {
                $this->session->set_flashdata('message-failed', 'Sistem mengalami gangguan saat memproses data yang Anda kirim.');
                redirect(base_url() . "member/formwarranty");
                exit();
            }
        }
    }

    public function testimonial()
    {
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view_testimonial';
        } else {
            $data['content'] = 'mobile/view_testimonial';
        }
        $data["testimonial"] = $this->member_model->gettestimonial();
        $this->load->view('front/template_front1', $data);
    }

    public function testimoniallist()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $sessionmember = $ses["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");
        $data['content'] = 'view_member';
        if (!$this->agent->is_mobile()) {
            $data["contentmember"] = "desktop/member/_testimonial_list";
            $data['content'] = 'desktop/view_member';
        } else {
            $data["contentmember"] = "mobile/member/_testimonial_list";
            $data['content'] = 'mobile/view_member';
        }
        $data["testimonial"] = $this->member_model->gettestimonial($ses["member"]["id"]);
        $this->load->view('front/template_front1', $data);
    }

    public function testimonialform()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $sessionmember = $ses["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");
        $data['content'] = 'view_member';
        if (!$this->agent->is_mobile()) {
            $data["contentmember"] = "desktop/member/_testimonialform";
            $data['content'] = 'desktop/view_member';
        } else {
            $data["contentmember"] = "mobile/member/_testimonialform";
            $data['content'] = 'mobile/view_member';
        }
        $data["testimonial"] = $this->member_model->gettestimonial($ses["member"]["id"]);
        $this->load->view('front/template_front1', $data);
    }

    public function senttestimonial()
    {
        $this->securitylog->cekloginmember();
        $ses = $this->session->all_userdata();
        $name = !empty($ses["member"]["name"]) ? $ses["member"]["name"] : "anonimous";
        $email = !empty($ses["member"]["email"]) ? $ses["member"]["email"] : "anonimous";

        $this->form_validation->set_rules('testimonial', 'Testimonial', 'required');
        $this->form_validation->set_rules('options', 'Options', 'required');
        $this->form_validation->set_rules('agre', 'Agre', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Maaf Testimonial Anda tidak terkirim, silahkan ulangi.' . validation_errors());
            redirect(base_url() . "member/testimonialform");
            exit();
        } else {
            $newname = time();
            $config['upload_path'] = './public/image/member/testimonial';
            $config['allowed_types'] = 'jpg|png|pdf|mp4|m4v|jpeg';
            $config['max_size'] = '10000';
            $config['file_name'] = $newname;
            //load the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            if (!$this->upload->do_upload('fileconfirmation')) {
                $this->session->set_flashdata('message-failed', 'Terjadi kesalah saat mengunggah file, pastikan file berextensi .JPG atau .PDF<br>dengan ukuran file maksimal 1Mb');
                redirect(base_url() . "member/testimonialform");
                exit();
            } else {
                $datafile = $this->upload->data();
                $datatestimonial = array(
                    'name' => $name,
                    'email' => $email,
                    'content' => nl2br(strip_tags($this->input->post("testimonial"))),
                    'emote' => $this->input->post("options"),
                    'moderate' => "belum",
                    'date' => date("H:s d/m/Y"),
                    'id_member' => $ses["member"]["id"],
                    'file' => $newname . $datafile["file_ext"],
                    'type' => $datafile["file_ext"]
                );
                $this->member_model->inserttestimonial($datatestimonial);
                $this->session->set_flashdata('message-success', 'Terimakasih telah meluangkan waktu untuk memberi penilaian berupa testimonial kepada kami.');
                $pesan = 'Dear Admin,<br>Mohon di cek admin trumecs, ada member yang mengirim testimonial baru.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
                $this->sentemailnotiftoadmin($pesan, "1");
                redirect(base_url() . "member/testimonialform");
                exit();
            }
        }
    }

    private function sentemailnotiftoadmin($pesan, $kebagian)
    {
        $data = $this->member_model->get_admin(array('admin.privileges' => $kebagian));
        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        foreach ($data as $key) {
            $tonextadmin = $key["email"];
            $subject = "Notifikasi Untuk Admin " . date("dmY:His");
            $message = $pesan;
            $emailstatus = $this->emailer->sent($from, $password, $tonextadmin, $subject, $message);
        }
    }

    public function verifybyphone()
    {
        $ses = $this->session->all_userdata();
        if (empty($ses["forverifybyphone"])) {
            //redirect(base_url()."member");
        }
        $ccc["forverifybyphone"] = array('phone' => $ses["forverifybyphone"]["phone"], 'email' => $ses["forverifybyphone"]["email"], 'kodeverifybyphone' => substr(md5($ses["forverifybyphone"]["phone"]), 4, 8));
        //$ccc["forverifybyphone"] = array('phone'=>"081284163426",'email'=>"robeth.lobunta@gmail.com",'kodeverifybyphone'=>substr(md5($ses["forverifybyphone"]["phone"]), 4,8));
        $flashdata = $ccc;
        $this->session->set_userdata($flashdata);
        $data["verifybysms"] = $ccc["forverifybyphone"];
        $data['content'] = 'verifybyphoneform';
        $data["js"] = array(base_url() . "asset/js/verifybyphoneform.js");
        $this->load->view('front/template_front1', $data);
    }

    public function sentsms()
    {
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        if ($this->form_validation->run() == FALSE) {
            $isireturn = '<div class="alert ">Nomor tidak ada<br> <a href="#" class="forange"  id="show-number-verify">Ubah nomor</a></div>';
            echo $isireturn;
        } else {
            $ses = $this->session->all_userdata();
            $where = array('email' => $ses["forverifybyphone"]["email"], 'md5' => md5($ses["forverifybyphone"]["email"]));

            $nohp =  $this->input->post("phone"); //"081284163426";//$_POST['nohp'];
            $kode = substr(md5($nohp), 4, 6); //isikan sesuai dengan keinginan anda, tapi jangan masukkan huruf. hanya digit angka.

            $set = array('phone' => $nohp, 'kodeverifybyphone' => $kode);

            $ccc["forverifybyphone"] = array(
                'phone' => $nohp,
                $ses["forverifybyphone"]["email"],
                'md5' => md5($ses["forverifybyphone"]["email"]),
                'email' => $ses["forverifybyphone"]["email"],
                'md5' => md5($ses["forverifybyphone"]["email"])
            );
            $flashdata = $ccc;
            $this->session->set_userdata($flashdata);
            $this->member_model->update($where, $set);
            $countsmsverifi = $this->member_model->getsetting("countsmsverifi");
            if ($countsmsverifi > 0) {



                // Script Kirim SMS Api Zenziva
                $userkey = "y9hpqc"; // userkey lihat di zenziva
                $passkey = "trumecs193746825585"; // set passkey di zenziva
                $message = "Silahkan masukkan kode " . $kode . " pada kolom verifikasi untuk melengkapi registrasi Anda. trumecs.com";

                $url = "https://reguler.zenziva.net/apps/smsapi.php";
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey=' . $userkey . '&passkey=' . $passkey . '&nohp=' . $nohp . '&pesan=' . urlencode($message));
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                $results = curl_exec($curlHandle);
                curl_close($curlHandle);

                $this->member_model->updatesetting(array('name' => "countsmsverifi"), array('value' => $countsmsverifi - 1));

                $isireturn = '<div class="alert ">Masukkan kode verifikasi<div class="input-group"> <input id="cd_xxx" type="text" phoneto="' . $nohp . '" name="code" class="form-control" placeholder=""> <span class="input-group-btn"> <button class="btn btn-orange cd_xxx_pts" type="button">Verifikasi</button> </span> </div><br><br><a href="#"  id="sent-again" class="forange" number="' . $nohp . '">Kirim ulang kode</a><br><a href="#" class="forange"  id="show-number-verify">Ubah nomor</a></div>';
            } else {
                $isireturn = '<div class="alert ">Maaf, sistem kami sedang sibuk untuk verifikasi melalui SMS.<br>Silahkan verifikasi akun Anda melalui email.<br><br><small>*jika tidak menerima email verifikasi, periksa email verifikasi di folder spam/junk</small></div>';
            }
            echo $isireturn;
            //redirect(base_url());
        }
    }

    public function checkveryfibyphone()
    {
        $ses = $this->session->all_userdata();
        if (empty($ses["forverifybyphone"])) {
            //redirect(base_url()."member");
        }
        $nohp = $ses["forverifybyphone"]["phone"];
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        if ($this->form_validation->run() == FALSE) {
            $isireturn = '<div class="alert "><div class="alert alert-danger">Masukkan kode verifikasi.</div><div class="input-group"> <input id="cd_xxx"  phoneto="' . $nohp . '" name="code"  type="text" class="form-control" placeholder=""> <span class="input-group-btn"> <button class="btn btn-orange cd_xxx_pts" type="button">Verifikasi</button> </span> </div><br><br><a href="#"  id="sent-again" class="forange" number="' . $nohp . '">Kirim ulang kode</a><br><a href="#" class="forange"  id="show-number-verify">Ubah nomor</a></div>';
            echo $isireturn;
            exit;
        } else {
            $nohp =  $this->input->post("phone");
            $kode =  $this->input->post("code");
            $where = array('phone' => $nohp, 'kodeverifybyphone' => $kode);
            $cekverifikasi = $this->member_model->activation($where);
            if ($cekverifikasi == true) {
                $isireturn = '<div class="alert alert-warning">Selamat!!!<br> Verifikasi berhasil, silahkan <a class="forange" href="' . base_url() . '">login</a>.</div>';
            } else {
                $isireturn = '<div class="alert "><div class="alert alert-danger">Kode verifikasi salah.</div>Masukkan kode verifikasi<div class="input-group"> <input id="cd_xxx" type="text" class="form-control" placeholder=""> <span class="input-group-btn"> <button class="btn btn-orange cd_xxx_pts" type="button">Verifikasi</button> </span> </div><br><br><a href="#"  id="sent-again" class="forange" number="' . $nohp . '">Kirim ulang kode</a><br><a href="#" class="forange"  id="show-number-verify">Ubah nomor</a></div>';
            }
            echo $isireturn;
            //redirect(base_url());
        }
    }

    public function penawaran()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(
            base_url() . "asset/js/validator/validator.js",
            base_url() . "asset/js/member_page.js"
        );

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $data['penawaran'] = $this->member_model->get_penawaran($sessionmember["id"]);

        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_listpenawaran";
        $this->load->view('front/template_front1', $data);
    }

    public function meeting()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $data['meeting'] = $this->member_model->get_meeting($sessionmember["id"]);

        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_listmeeting";
        $this->load->view('front/template_front1', $data);
    }

    public function tender()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $data['tender'] = $this->member_model->get_tender($sessionmember["id"]);
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_listtender";
        $this->load->view('front/template_front1', $data);
    }

    public function get_detail_penawaran()
    {
        $id = $this->input->post('id_rfq');
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $data['penawaran'] = $this->member_model->get_penawaran_by_id($id, $sessionmember["id"]);
        $data['item_penawaran'] = $this->member_model->get_item_penawaran($id, $sessionmember["id"]);
        echo $this->load->view('modal/modal_penawaran', $data, true);
    }

    public function saldo()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/member_page.js", base_url() . "asset/js/trumecs.effect.js", "/modules/member/js/member/member.js", "/modules/member/js/member/referral.js");
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $where = $sessionmember["id"];

        $data['kode'] = $this->member_model->get_kode($sessionmember["id"]);
        $data['mutation'] = $this->member_model->get_mutation_list($where);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_listreferral";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_listreferral";
        }
        $this->load->view('front/template_front1', $data);
    }
    public function saldoHistory()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/member.css");
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $where = $sessionmember["id"];

        $data['kode'] = $this->member_model->get_kode($sessionmember["id"]);
        $data['mutation'] = $this->member_model->get_mutation_list($where);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_listreferral_history";
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/member_page.js", base_url() . "asset/js/trumecs.effect.js",  "/modules/member/js/member/saldoHistory.js");
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_listreferral_history";
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", base_url() . "asset/js/trumecs.effect.js",  "/modules/member/js/member/saldoHistory.js");
        }
        $this->load->view('front/template_front1', $data);
    }

    public function getSaldoHistory()
    {
        $this->load->library('Date');
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = $sessionmember["id"];
        $data = $this->member_model->get_mutation_list($where);
        $count = count($data);
        $response = [];
        foreach ($data as $i => $value) {
            if (!$this->agent->is_mobile()) {
                $result = [];
                $result[] = $i + 1;
                $result[] = $value['mutation_type'] == 2 ? 'Kredit' : 'Debit';
                $result[] = $this->date->format_panjang_waktu(date('Y-m-d H:i:s', $value['created_at']));
                $result[] = '<p class="label label-' . $value["status"] . '">' . $value["status"] . '</p>';
                if ($value['mutation_type'] == 2) {
                    $result[] = '<p class="fred">- ' . number_format($value["amount_mutation"], 0, ",", ".") . '</p>';
                } else {
                    $result[] = '<p class="fgreen">+ ' . number_format($value["amount_mutation"], 0, ",", ".") . '</p>';
                };
                if ($value["file_transfer"] != null) {
                    $result[] = '<div class="d-flex flex-column gap-1">
                <button type="button" class="btn btnnew f12" data-toggle="modal" data-target="#detailSaldoHistory-' . $value["cm_id"] . '"><span class="fa fa-eye"></span> Detail</button>
                <a href="' . base_url("export/trucoin/" . $value["file_transfer"]) . '" class="btn btnnewgreen f12" download><span class="fa fa-download"> Bukti Transfer</span></a>
                </div>';
                } else {
                    $result[] = '<div class="d-flex flex-column">
                <button type="button" class="btn btnnew f12" data-toggle="modal" data-target="#detailSaldoHistory-' . $value["cm_id"] . '"><span class="fa fa-eye"></span> Detail</button>
                </div>';
                }
                $response[] = $result;
            } else {
                $result = [];
                $result[] = $value['cm_id'];
                $result['type'] = $value['mutation_type'] == 2 ? 'Kredit' : 'Debit';
                $result['date'] = $this->date->format_panjang_waktu(date('Y-m-d H:i:s', $value['created_at']));
                $result['status'] = '<p class="label label-' . $value["status"] . '">' . $value["status"] . '</p>';
                if ($value['mutation_type'] == 2) {
                    $result['total'] = '<p class="fred f16">- ' . number_format($value["amount_mutation"], 0, ",", ".") . '</p>';
                } else {
                    $result['total'] = '<p class="fgreen f16">+ ' . number_format($value["amount_mutation"], 0, ",", ".") . '</p>';
                };

                if ($value["status"] == "success") {
                    if ($value["file_transfer"] != null) {
                        $result['button'] = '<a href="' . base_url("export/trucoin/" . $value["file_transfer"]) . '" class="btn btnnewgreen f10" download><span class="fa fa-download"> Bukti Transfer</span></a>';
                    } else {
                        $result['button'] = '';
                    }
                } else {
                    $result['button'] = '';
                };
                $result['name'] = '<div class="d-flex-sb align-items-center"><p>Nama :</p><p class="fbold">' . $value['bank_holder'] . '</p></div>';
                $result['bank'] = '<div class="d-flex-sb align-items-center"><p>Bank :</p><p class="fbold">' . $value['bank_name'] . '</p></div>';
                $result['amount_wd'] = '<div class="d-flex-sb align-items-center"><p>Jumlah Penarikan :</p><p class="fbold">' . $value['amount_wd'] . '</p></div>';
                $result['transferFee'] = '<div class="d-flex-sb align-items-center"><p>Biaya Transaksi :</p><p class="fbold">' . $value['transfer_fee'] . '</p></div>';
                $result['totalAll'] = '<div class="d-flex-sb align-items-center"><p>Total :</p><p class="fbold">' . $value['amount_mutation'] . '</p></div>';
                $result['category'] = $value['reference'];
                $response[] = $result;
            };
        }
        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data"  => $response
        ];
        echo json_encode($output);
    }

    public function withdrawal()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/member/referral.js", base_url() . "asset/js/trumecs.effect.js");
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data['referral'] = $this->member_model->get_tender($sessionmember["id"]);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_formwithdrawal";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_formwithdrawal";
        }
        $this->load->view('front/template_front1', $data);
    }

    public function setwithdraw()
    {
        $this->securitylog->cekloginmember();
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $pointmember = $sessionmember["point"];
        $pointInt = str_replace('.', '', $this->input->post('amount'));
        $this->form_validation->set_rules('amount', 'Jumlah', 'required');
        $this->form_validation->set_rules('bank_name', 'Bank tujuan', 'required');
        $this->form_validation->set_rules('bank_holder', 'Pemilik rekening', 'required');
        $this->form_validation->set_rules('bank_account', 'Nomor rekening', 'required');
        $this->db->trans_start();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'ada yang salah');
            redirect(base_url() . 'member/withdrawal');
            exit();
        } else {
            $transfer_fee = $this->input->post('bank_name') == 'Mandiri' ? 0 : 6500;
            $data = array(
                'amount' => $pointInt,
                'user_id' => $sessionmember['id'],
                'bank_name' => $this->input->post('bank_name'),
                'bank_account' => $this->input->post('bank_account'),
                'bank_holder' => $this->input->post('bank_holder'),
                'transfer_fee' => $transfer_fee,
                'total' => $pointInt + $transfer_fee,
                'status' => 'waiting',
                'created_at' => strtotime(date('Y-m-d H:i:s')),
            );
            $total = $transfer_fee + $pointInt;
            if ($pointmember < $total) {
                $this->session->set_flashdata('message-failed', 'Pengajuan Ditolak karena saldo tidak cukup');
                redirect('member/saldo');
            } else {
                $this->member_model->set_withdrawal($data);
                $data_mutasi = array(
                    'mutation_type' => 2,
                    'user_id' => $sessionmember['id'],
                    'amount' => $data['total'],
                    'description' => "",
                    'reference' => 'withdraw',
                    'reference_id' => $this->db->insert_id(),
                    'status' => 'waiting',
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                );
                $this->member_model->set_mutation($data_mutasi);
                $this->session->set_flashdata('message-success', 'Pengajuan penarikan TRU Koin berhasil disimpan.');
                redirect('member/saldo');
            }
        }
        $this->db->trans_complete();
    }

    public function withdrawal_detail($id)
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $data['detail'] = $this->member_model->get_tender($sessionmember["id"]);
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_detailwithdraw";
        $this->load->view('front/template_front1', $data);
    }

    public function referral_detail($id)
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $data['referral'] = $this->member_model->get_tender($sessionmember["id"]);
        $data['content'] = 'view_member';
        $data["contentmember"] = "member/_detailreferral";
        $this->load->view('front/template_front1', $data);
    }

    public function bulk()
    {
        $this->securitylog->cekloginmember();
        $this->load->language("member/bulk");
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/member_page.js", base_url() . "asset/js/trumecs.effect.js", "/modules/member/js/member/bulk.js",);
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data['sessionmember'] = $sessionmember;
        $data['provinsi'] = $this->M_Prospek->get_provinsi();
        $data['regency'] = $this->M_Prospek->get_regency($sessionmember["provice"]);
        $data['district'] = $this->M_Prospek->get_district($sessionmember["city"]);
        $data['village'] = $this->M_Prospek->get_village($sessionmember["districts"]);
        $data['user_data'] = array(
            'nama' => $sessionmember["name"],
            'posisi' => "",
            'phone' => $sessionmember["phone"],
            'email' => $sessionmember["email"],
            'company' => $sessionmember["Company"],
            'provinsi' => $sessionmember["provice"],
            'kota' => $sessionmember["city"],
            'kecamatan' => $sessionmember["districts"],
            'kelurahan' => $sessionmember["village"],
            'alamat' => $sessionmember["address"],
            'office_phone' => "",
            'office_email' => "",
        );
        $data['list'] = $this->member_model->get_bulk($sessionmember["id"]);

        $actual_link = base_url('member/bulk');
        $config["base_url"] = $actual_link;
        $config["total_rows"] = $this->m_bulk->record_count($sessionmember["id"]);
        $config["per_page"] =  5;
        $config["uri_segment"] = 2;
        $config["prev_tag_close"] = '</div>';
        $config["cur_tag_close"] = '</div>';
        $config["next_tag_open"] = '<div class="btn m-l-1 p-a-0">';
        $config["next_tag_close"] = '</div>';
        $config["num_tag_open"] = '<div class="btn p-a-0" style="margin-left:2px;margin-right:2px;">';
        $config["num_tag_close"] = '</div>';
        $config["cur_tag_open"] = '<div class="btn btn-disable btnnewwhite">';
        $config['attributes'] = array('class' => 'btn btnnew link pagination-article');
        $config["prev_tag_open"] = '<div class="btn m-r-1 p-a-0">';
        $config["next_tag_open"] = '<div class="btn m-l-1 p-a-0">';
        $config["num_tag_open"] = '<div class="btn p-a-0" style="margin-left:2px;margin-right:2px;">';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['query_string_segment'] = 'per_page';
        $config['enable_query_strings'] = true;
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data["page"] = $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data['list'] = $this->member_model->get_bulk($sessionmember["id"], $config["per_page"], $page);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_bulk";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_bulk";
        }
        $this->load->view('front/template_front1', $data);
    }
    public function bulkJson()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data['sessionmember'] = $sessionmember;
        $data['list'] = $this->member_model->get_bulkjson($sessionmember["id"]);
        $json_data["data"] = $data["list"];
        echo json_encode($json_data);
    }
    public function bulk_history()
    {
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/member.css");
        $data["js"] = array(base_url() . "asset/js/trumecs.effect.js", "/modules/member/js/member/bulkHistory.js",);
        $data["member"] = $this->session_member();
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data['sessionmember'] = $sessionmember;
        $data['provinsi'] = $this->M_Prospek->get_provinsi();
        $data['regency'] = $this->M_Prospek->get_regency($sessionmember["provice"]);
        $data['district'] = $this->M_Prospek->get_district($sessionmember["city"]);
        $data['village'] = $this->M_Prospek->get_village($sessionmember["districts"]);
        $data['list'] = $this->member_model->get_bulk($sessionmember["id"]);
        $data['listall'] = $this->member_model->get_bulk_all($sessionmember["id"]);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/member/_bulk_history";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/member/_bulk_history";
        }
        $this->load->view('front/template_front1', $data);
    }

    function bulk_save()
    {
        $this->load->model("cart/cart_model");
        $session = $this->session->all_userdata();
        $sessionmember = array_key_exists("member", $session) ? $session["member"] : '';
        $data['member_id'] = $sessionmember["id"];
        $data['name'] = $this->input->post('alamat_name') ? $this->input->post('alamat_name') : $sessionmember["name"];
        $data['phone'] = $this->input->post('alamat_phone') ? $this->input->post('alamat_phone') : $sessionmember["phone"];
        $data['company'] = $this->input->post('alamat_company') ? $this->input->post('alamat_company') : $sessionmember["Company"];
        $data['address'] = $this->input->post('alamat_address') ? $this->input->post('alamat_address') : $sessionmember["address"];
        $data['province'] = $this->input->post('alamat_province') ? $this->input->post('alamat_province') : $sessionmember["nm_provinces"];
        $data['city'] = $this->input->post('alamat_city') ? $this->input->post('alamat_city') : $sessionmember["nm_regencies"];
        $data['district'] = $this->input->post('alamat_districts') ? $this->input->post('alamat_districts') : $sessionmember["nm_districts"];
        $data['village'] = $this->input->post('alamat_village') ? $this->input->post('alamat_village') : $sessionmember["nm_villages"];
        $data['zipcode'] = $this->input->post('alamat_kodepos') ? $this->input->post('alamat_kodepos') : $sessionmember["kodepos"];
        $data['note'] = $this->input->post('bulk_note') ? $this->input->post('bulk_note') : '';
        $data['created_at'] = time();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['status_member'] = "";
        $data['status_admin'] = "belum_proses";
        $files = $this->input->post('files');
        $data["text_rfq"] = $this->input->post('text_rfq');
        $date = date('Y-m-d H:i:s');

        //$email_content = $data;
        //$message = $this->load->view('email/principal', $email_content, true);
        //$this->send_email("Trumecs.com - Terimakasih telah mendaftar sebagai principal kami", $data['email'], $message);
        $this->db->trans_start();
        $id = $this->m_bulk->save($data);


        if ($files != null) {
            $this->m_bulk->save_file($files, $id);
        }
        $log = array(
            'sourcing_id' => $id,
            'member_note' => $data['note'],
            'created_by' => $data['member_id'],
            'created_at' => $date,
        );
        $this->m_bulk->saveCommentLog($log);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'RFQ sudah dikirim harap sabar menunggu konfirmasi dari admin.');
        redirect('member/bulk');
    }
    public function bulkPdf($id_list)
    {
        $data['list'] = $this->member_model->get_bulk_item($id_list);

        $data["css"] = array("/modules/member/css/member.css");
        $data["content"] = "/desktop/member/_bulk_pdf";
        $html = $this->load->view('front/_blankview', $data);
        // $this->load->helper("file");
        // $this->load->library("pdf");
        // $this->pdf->create($html, "bukti pembelian trumecs.com - ");
    }
    public function bulkRfq($id_list)
    {
        $data['list'] = $this->member_model->get_bulk_item($id_list);

        $data["css"] = array("/modules/member/css/member.css");
        $data["content"] = "/desktop/member/_bulk_rfq";
        $html = $this->load->view('front/_blankview', $data);
        // $this->load->helper("file");
        // $this->load->library("pdf");
        // $this->pdf->create($html, "bukti pembelian trumecs.com - ");
    }
    public function saveItem()
    {
        $session = $this->session->all_userdata();
        $sessionmember = array_key_exists("member", $session) ? $session["member"] : '';
        $data['member_id'] = $sessionmember["id"];
        $date = date('Y-m-d H:i:s');
        $sourcing_id = $this->input->post('sourcing_id');
        $note = $this->input->post('member_note');
        $source = array(
            'note' => $note,
            'status_member' => "nego",
            'status_admin' => "nego",
            'updated_at' => $date,
            'updated_by' => $data['member_id'],
            'viewed' => 0
        );

        $this->db->trans_start();
        $this->m_bulk->update($source, $sourcing_id);
        $logComment = array(
            'sourcing_id' => $sourcing_id,
            'member_note' => $note,
            'created_by' => $data['member_id'],
            'created_at' => $date,
        );
        $this->m_bulk->saveCommentLog($logComment);
        $priceFix = $this->input->post('price[]');
        $priceFixInt = str_replace('.', '', $priceFix);
        $price = $this->input->post('price_nego[]');
        $priceInt = str_replace('.', '', $price);
        $item_id = $this->input->post('item_id[]');
        $itemQty = $this->input->post('qty_nego[]');
        $itemQtyFirst = $this->input->post('qty_nego_first[]');
        foreach ($item_id as $key => $itemId) {
            if ($priceFix[$key] == $price[$key]) {
                $item = array(
                    'price_nego' => $priceFixInt[$key],
                    'qty' => ($itemQtyFirst[$key] != $itemQty[$key]) ? $itemQty[$key] : $itemQtyFirst[$key],
                    'updated_by' => $data['member_id'],
                    'updated_at' => $date,
                    'status_member' => "setuju",
                    'status_admin' => "setuju",
                );
            } else {
                $item = array(
                    'price_nego' => $priceInt[$key],
                    'qty' => ($itemQtyFirst[$key] != $itemQty[$key]) ? $itemQty[$key] : $itemQtyFirst[$key],
                    'updated_by' => $data['member_id'],
                    'updated_at' => $date,
                    'status_member' => $priceInt[$key] ? "nego" : "menunggu",
                    'status_admin' => $priceInt[$key] ? "menunggu" : "tidak_ada_action",
                );
            };
            $logItem = array(
                'price_nego' => $priceInt[$key],
                'qty' => ($itemQtyFirst[$key] != $itemQty[$key]) ? $itemQty[$key] : $itemQtyFirst[$key],
                'updated_by' => $data['member_id'],
                'updated_at' => $date,
            );
            $this->m_bulk->updateListItemLog($logItem, $itemId);
            $this->m_bulk->updateListItem($item, $itemId);
        };
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Harga sudah dikirim harap sabar menunggu konfirmasi dari admin.');
        redirect('member/bulk');
    }
    public function saveViewed()
    {
        $id = $this->input->post('id[]');
        $this->db->trans_start();
        $source = array(
            'viewed' => 1
        );
        $this->m_bulk->update($source, $id);
        $this->db->trans_complete();
        redirect('member/bulk');
    }
    public function autocomplete_wilayah()
    {
        $term = $this->input->get('term');
        $data = $this->member_model->get_wilayah_autocomplete($term);
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'label' => $row['name_v'] . ' > ' . $row['name_d'] . ' > ' . $row['name_r'] . ' > ' . $row['name_p']
            ];
        }
        echo json_encode($result);
    }

    public function buat_toko()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["provinces"] = $this->member_model->getprovinces();
        $data["member"] = $this->session_member();
        $this->securitylog->cekloginmember();
        $data["js"] = array("modules/member/js/member/member.js", base_url() . "asset/js/member_page.js");
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "desktop/member/_buat_toko";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "mobile/member/_buat_toko";
        }
        $this->load->view('front/template_front1', $data);
    }

    public function formBuatToko()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["provinces"] = $this->member_model->getprovinces();
        $data["member"] = $this->session_member();
        $this->securitylog->cekloginmember();
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", "modules/member/js/member/member.js", base_url() . "asset/js/member_page.js");
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "desktop/member/_form_buat_toko";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "mobile/member/_form_buat_toko";
        }
        $this->load->view('front/template_front1', $data);
    }

    public function getBulk()
    {
        $session = $this->session->all_userdata();
        $memberId = $session["member"]['id'];
        $sourcing_model = new Sourcing_model(['member_id' => $memberId]);
        $sources = $sourcing_model->make_datatables();
        $response = [];
        foreach ($sources as $key => $value) {
            $result = [];
            $result[] = '<a class="fbold href="#" data-toggle="modal" data-target="#listRfq-' . $value['id'] . '">' . $value['nama_rfq'] . '</a>';
            if ($value['status_member'] == null) {
            } else if ($value['status_member'] == "menunggu") {
                $statusLabel = "warning";
            } else if ($value['status_member'] == "nego") {
                $statusLabel = "info";
            } else {
                $statusLabel = "success";
            };
            $result[] = '<p class="m-a-0 label label-' . $statusLabel . '">' . $value["status_member"] . '</p>';
            $result[] = '<a class="btn btn-success f12 fbold" href="' . base_url() . '/member/bulkPdf/' . $value['id'] . '" target="_blank"><i class="fa fa-download"> Penawaran</i></a>';
            $result[] = 'Rp ' . number_format($value["total_price"], 0, ',', '.');
            $result[] = $value["total_item"];
            $result[] = $value["total_item_qty"];
            $response[] = $result;
        }
        $output = [
            "draw" => $_POST["draw"],
            "recordsTotal" =>  $this->sourcing_model->get_all_data(),
            "recordsFiltered" => $this->sourcing_model->get_filtered_data(),
            "data"  => $response
        ];
        echo json_encode($output);
    }

    public function _badeStatus($status)
    {
        if (strtolower($status) == 'waiting_po') {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-dark">' . $this->lang->line($status, FALSE) . '</span>';
        } else if (strtolower($status) == 'waiting_invoice') {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-primary">' . $this->lang->line($status, FALSE) . '</span>';
        } else if (strtolower($status) == 'waiting_payment') {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-danger">' . $this->lang->line($status, FALSE) . '</span>';
        } else if (strtolower($status) == 'waiting_delivery') {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-warning">' . $this->lang->line($status, FALSE) . '</span>';
        } else if (strtolower($status) == 'delivery') {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-info">' . $this->lang->line($status, FALSE) . '</span>';
        } else if (strtolower($status) == 'complete') {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-success">' . $this->lang->line($status, FALSE) . '</span>';
        } else {
            return '<span style="padding: 0px 5px 0px 5px" class="radius-lg bg-info">' . $status . '</span>';
        }
    }

    public function getSourcing()
    {
        $this->load->language("member/bulk");

        $session = $this->session->all_userdata();
        $memberId = $session["member"]['id'];

        $order_model = new Order_model(['idmember' => $memberId]);

        $sources = $order_model->make_datatables();


        $response = [];

        foreach ($sources as $value) {

            $result = array();
            $result[] = '<a href="' . base_url() . 'member/orders/detail/' . $value['id'] . '">' . $value['iduniq'] . '</a>';
            $date = date_create($value['time']);
            $result[] = date_format($date, 'd-M-Y');
            $result[] = $this->_badeStatus($value['status']);
            $result[] = $value['total_item'];
            $result[] = 'Rp ' . number_format($value['payment_total'], 0, ",", ".");
            if ($value['status'] == 'waiting_po') {
                $result[] = '<button class="btn bg-tru-primary btn-sm order-number-label" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#modal-upload-po"> <i class="fa fa-fw fa-upload"></i> Unggah PO</button>';
            } else {
                $result[] = '<a href="' . base_url() . 'member/orders/detail/' . $value['id'] . '" class="btn bg-tru-primary btn-sm text-white"> <i class="fa fa-fw fa-eye"></i> Lihat Detail</a>';
            }
            $response[] = $result;
        }

        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $order_model->get_all_data(),
            "recordsFiltered" => $order_model->get_filtered_data(),
            "data"  => $response
        ];

        echo json_encode($output);
    }
    public function getSourcingComplete()
    {
        $this->load->language("member/bulk");

        $session = $this->session->all_userdata();
        $memberId = $session["member"]['id'];

        $order_model = new Order_model(['idmember' => $memberId]);

        $sources = $order_model->make_datatablesComplete();


        $response = [];

        foreach ($sources as $value) {

            $result = array();
            $result[] = '<a href="' . base_url() . 'member/orders/detail/' . $value['id'] . '">' . $value['iduniq'] . '</a>';
            $date = date_create($value['time']);
            $result[] = date_format($date, 'd-M-Y');
            $result[] = $this->_badeStatus($value['status']);
            if ($value['status'] == 'waiting_po') {
                $result[] = '<button class="btn bg-tru-primary btn-sm order-number-label" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#modal-upload-po"> <i class="fa fa-fw fa-upload"></i> Unggah PO</button>';
            } else {
                $result[] = '<a href="' . base_url() . 'member/orders/detail/' . $value['id'] . '" class="btn bg-tru-primary btn-sm text-white"> <i class="fa fa-fw fa-eye"></i> Lihat Detail</a>';
            }
            $response[] = $result;
        }

        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $order_model->get_all_data(),
            "recordsFiltered" => $order_model->get_filtered_data(),
            "data"  => $response
        ];

        echo json_encode($output);
    }
    public function getOrderItem()
    {
        $sources = $this->order_item_model->make_datatables();


        $response = [];

        foreach ($sources as $value) {

            $result = array();
            $result[] = $value['name_product'];
            $result[] = $value['quantity'];
            $result[] = 'Rp ' . number_format($value['price'], 0, ",", ".");
            $response[] = $result;
        }

        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $this->order_item_model->get_all_data(),
            "recordsFiltered" => $this->order_item_model->get_filtered_data(),
            "data"  => $response
        ];

        echo json_encode($output);
    }


    public function po()
    {
        $dir = 'order';

        if (do_upload_file('file_po', $dir)) {

            $order['id'] = $this->input->post('order_id');
            $order['file_po'] = $this->upload->data('file_name');
            $order['status'] = 'waiting_invoice';


            $orderModel = new Order_model($order);

            $orderModel->db_set();

            if ($orderModel->save($order) > 0) {
                redirect('/member/confirmation_list');
            } else {
                $this->session->set_flashdata('error_uploaded_po', 'failed uploaded file');
                redirect('/member/confirmation_list');
            }
        } else {
            $this->session->set_flashdata('error_uploaded_po', $this->upload->display_errors());
            redirect('/member/confirmation_list');
        }
    }
}
