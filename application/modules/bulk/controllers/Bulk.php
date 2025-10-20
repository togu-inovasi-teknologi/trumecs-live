<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulk extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("m_bulk");
        $this->load->language("partnership");
        $this->load->language("form");
        $this->load->language("rfq_lang");
        $this->load->helper("download");
        $this->load->model("backendprospek/M_Prospek");
    }

    function index()
    {


        $ids = explode(',', get_cookie('items'));

        $data['items'] = $this->db->select('*')->from('product')->where_in('id', $ids)->get()->result_array();


        $this->lang->load(array('rfq'));
        $session = $this->session->all_userdata();
        $sessionmember = array_key_exists("member", $session) ? $session["member"] : array(
            "name" => "",
            "phone" => "",
            "position" => "",
            "company_email" => "",
            "company_phone" => "",
            "email" => "",
            "Company" => "",
            "provice" => "",
            "city" => "",
            "districts" => "",
            "address" => "",
        );
        $data['provinsi'] = $this->M_Prospek->get_provinsi();
        $data['regency'] = $this->M_Prospek->get_regency($sessionmember["provice"]);
        $data['district'] = $this->M_Prospek->get_district($sessionmember["city"]);
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
        $data["css"] = array(base_url() . 'asset/css/input_tag.css', base_url() . "asset/css/page_detail.css", "/modules/bulk/css/bulk.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/slick/slick.min.js", "/modules/bulk/js/bulk.js",  base_url() . "asset/js/prospek.js",);

        // if(isset($this->input->post('')))

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/form_v3';
        } else {
            $data['content'] = 'mobile/form_v3';
        }
        $this->load->view('front/template_front', $data);
    }

    function toBulk()
    {
        $ids = $this->input->post('items');

        $cookie = [
            'name' => 'items',
            'value' => implode(',', $ids),
            "expire" => '7200',
        ];
        set_cookie($cookie);
        redirect('bulk');
    }

    public function bulk_redirect()
    {
        $ids = $this->input->post('items');

        $items = $this->db->select('*')->from('product')->where_in('id', $ids)->get()->result();

        var_dump($items);
    }

    public function getAutocompleteProduct()
    {
        $this->load->model("c/c_model");

        $keyword = $this->input->post('keyword');
        /*
        $data = $this->db->select("p.*, p.id as id")
            ->from('product p')
            ->join('categori cat', 'cat.id = p.component')
            ->join('category_brand cb', 'cb.category_id = cat.id')
            ->join('categori b', 'b.id = cb.brand_id')
            ->like('p.tittle', $keyword)
            ->or_like('cat.name', $keyword)
            ->or_like('b.name', $keyword)
            ->order_by('p.tittle', 'ASC')
            ->limit(10)
            ->group_by("id")
            ->get()->result_array();
        */

        $data["datasearch"] = array(
            'tittle' => $keyword,
            'partnumber' => $keyword,
            'physicnumber' => $keyword,
            'minp' => 0,
            'maxp' => 999999999999999
        );

        $data["datasearchor_like"] = array(
            'tittle' => $keyword,
            'partnumber' => $keyword,
            'physicnumber' => $keyword
        );

        $data["datawhere"] = array(
            'year' => NULL,
            'promo' => NULL,
            'cucigudang' => NULL,
            'brand' => NULL,
            'component' => NULL,
            'component_type' => NULL,
            'tipe' => NULL,
            'quality' => NULL,
        );

        $data = $this->c_model->fetch_product(10, 0, $data["datasearch"], $data["datasearchor_like"], $data["datawhere"]);

        echo json_encode($data);
    }

    public function fetchAddress()
    {
        $data = $this->m_bulk->make_datatables();

        $response = [];

        foreach ($data as $value) {

            $result = array();
            $result[] = $value['village'];
            $result[] = $value['district'];
            $result[] = $value['regencies'];
            $result[] = $value['province'];
            $result[] = '<button class="btn btnnew btn-address-datatable" data-dismiss="modal" aria-label="Close" data-id="' . $value['id'] . '">Pilih</button>';
            $response[] = $result;
        }

        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $this->m_bulk->get_all_data(),
            "recordsFiltered" => $this->m_bulk->get_filtered_data(),
            "data"  => $response
        ];

        echo json_encode($output);
    }
    public function getAddressDetail()
    {
        $data = $this->m_bulk->getAddressDetailFromVillage($this->input->post('village_id'));


        echo json_encode($data);
    }

    function upload()
    {
        $path = 'public/tmp/';
        $filename = md5(RAND(1, 9999) . $_FILES['file']['name']) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $uploadfile = $path . $filename;
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        echo json_encode(array(
            'name' => $filename,
            'path' => $uploadfile
        ));
    }
    public function download_format()
    {
        force_download('export/rfq/format-rfq.xlsx', NULL);
    }
    function remove()
    {
        $path = 'public/tmp/';
        $filename = $this->input->post('filename');
        unlink($path . $filename);
    }

    function save()
    {
        $this->load->model("cart/cart_model");
        $session = $this->session->all_userdata();
        $sessionmember = array_key_exists("member", $session) ? $session["member"] : '';
        $data['member_id'] = $sessionmember["id"];
        $data['name'] = $this->input->post('alamat_name') ? $this->input->post('alamat_name') : $sessionmember["name"];
        $data['phone'] = $this->input->post('alamat_phone') ? $this->input->post('alamat_phone') : $sessionmember["phone"];
        $data['company'] = $this->input->post('alamat_company') ? $this->input->post('alamat_company') : $sessionmember["Company"];
        $data['address'] = $this->input->post('shipping_address') ? $this->input->post('shipping_address') : $sessionmember["address"];
        $data['province'] = $this->input->post('shipping_province') ? $this->cart_model->getnamewilayah(array('id' => $this->input->post('shipping_province')), "provinces") : $this->cart_model->getnamewilayah(array('id' => $sessionmember["provice"]), "provinces");
        $data['city'] = $this->input->post('shipping_city') ? $this->cart_model->getnamewilayah(array('id' => $this->input->post('shipping_city')), "regencies") : $this->cart_model->getnamewilayah(array('id' => $sessionmember["city"]), "regencies");
        $data['district'] = $this->input->post('shipping_districts') ? $this->cart_model->getnamewilayah(array('id' => $this->input->post('shipping_districts')), "districts") : $this->cart_model->getnamewilayah(array('id' => $sessionmember["districts"]), "districts");
        $data['village'] = $this->input->post('shipping_village') ? $this->cart_model->getnamewilayah(array('id' => $this->input->post('shipping_village')), "villages") : $this->cart_model->getnamewilayah(array('id' => $sessionmember["village"]), "villages");
        $data['zipcode'] = $this->input->post('shipping_kodepos') ? $this->input->post('shipping_kodepos') : $sessionmember["kodepos"];
        $data['note'] = $this->input->post('bulk_note') ? $this->input->post('bulk_note') : '';
        $data['created_at'] = time();
        $files = $this->input->post('files');


        //$email_content = $data;
        //$message = $this->load->view('email/principal', $email_content, true);
        //$this->send_email("Trumecs.com - Terimakasih telah mendaftar sebagai principal kami", $data['email'], $message);

        $this->m_bulk->save($data);
        $this->m_bulk->save_file($files, $this->db->insert_id());
        redirect('bulk/success');
    }

    public function bulk_save()
    {

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

            delete_cookie('items');


            $ids = $this->input->post('items');

            $cookie = [
                'name' => 'items',
                'value' => implode(',', $ids),
                "expire" => '7200',
            ];
            set_cookie($cookie);


            redirect('bulk');
        } else {

            $source['address'] = $this->input->post('company_address');

            $text_rfq = $this->input->post('text_rfq');


            $nama = $this->input->post('name');
            $no_telp = $this->input->post('phone');

            $source['name'] = $nama;
            $source['phone'] = $no_telp;
            $source['email'] = $this->input->post('email');
            $source['province'] = $this->input->post('province');
            $source['district'] = $this->input->post("regency");
            $source['city'] = $this->input->post("district");
            // $source['village'] = $addressDetail['village']; 
            $source['company'] = $this->input->post('company');
            $source['company_phone'] = $this->input->post('company_phone');
            $source['company_email'] = $this->input->post('company_email');
            $source['method'] = $this->input->post('method');
            $source['created_at'] = time();
            $source['text_rfq'] = $text_rfq;

            $files = $this->input->post('files');

            $this->m_bulk->save($source);

            $source_id = $this->db->insert_id();

            if (!empty($files)) {
                $this->m_bulk->save_file($files, $source_id);
            }

            $sourcing_items = [];

            foreach ($this->input->post('item_names') as $key => $value) {
                $data = [
                    'sourcing_id' => $source_id,
                    'items' => $value,
                    'price' => 0,
                    'price_nego' => 0,
                    'qty' => $this->input->post('qty')[$key],
                    'created_at' => Date('Y-m-d H:i:s'),
                    'updated_at' => Date('Y-m-d H:i:s'),
                ];
                array_push($sourcing_items, $data);
            }

            $this->m_bulk->save_items($sourcing_items);

            delete_cookie('items');

            redirect('bulk/success');
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
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/success';
        } else {
            $data['content'] = 'mobile/success';
        }
        $this->load->view('front/template_front', $data);
    }

    public function login()
    {
        $this->load->model('member/member_model');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Email/Password yang anda masukkan salah.'
            ));
        } else {
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
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Selamat datang kembali ' . $data['name']
                ));
            }
        }
    }



    public function signup()
    {
        $this->load->model('member/member_model');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Telpon', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data Anda tidak lengkap, Silahkan ulangi pengisian form dengan benar.'
            ));
        } else {
            $data["datauser"] = array(
                'email' => $this->input->post('email')
            );
            $data["datauser"] = $this->member_model->getmember($data["datauser"]);

            if (count($data["datauser"]) > 0) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Email Anda sudah terdaftar'
                ));
            }

            $captcha = $this->input->post('g-recaptcha-response');
            if (isset($captcha)) {
                $captcha =  $captcha;
            }
            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            $response = json_decode($verify, true);
            /* if($response['success'] != '1'){
                $this->session->set_flashdata('message', 'Anda terdeteksi sebagai robot');
                redirect(base_url().'member/signup');
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Anda terdeteksi sebagai robot'
                ));
            }else{ */
            $md5email = md5($this->input->post('email'));
            $data["dataall"] = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'phone' => $this->input->post('phone'),
                'address' => '',
                'position' => '',
                'provice' => '',
                'company' => '',
                'company_email' => '',
                'company_phone' => '',
                'company_field' => '',
                'status' => 'unactive',
                'point' => '0',
                'datejoin' => date("d-m-Y"),
                'md5' => md5($this->input->post('email')),
                'kodeverifybyphone' => substr(md5($this->input->post('email')), 4, 8)
            );
            $dataemail['md5'] = $md5email;
            //sent email to new member
            //$from="no-reply@trumecs.com";$password="no-reply#trumecs#123abc";
            //$to=$this->input->post('email');
            //$subject="Aktifasi Member";
            //$message= $this->load->view('email/email-to-new-account',$dataemail,true);

            //$emailstatus = $this->emailer->sent($from,$password,$to,$subject,$message);
            //if ($emailstatus=true) {
            $this->member_model->insert($data["dataall"]);
            //$xxx["forverifybyphone"]=array('phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'),'md5'=>md5($this->input->post('email')),'kodeverifybyphone'=>substr(md5($this->input->post('email')), 4,8));

            //$flashdata=$xxx;
            //$this->session->set_userdata($flashdata);
            $this->session->set_flashdata('message', 'Segera aktifasi Akun Anda, melalui email yang Anda daftarkan (' . $this->input->post('email') . '). <br><small>periksa juga email aktifasi di folder Spam/Junk dan tandai email bukan spam.</small><br><br>');
            //redirect(base_url().'member/notification');


            $data = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
            );
            $data["datauser"] = $this->member_model->getmember($data);
            $Loginmember = array("Loginmember" => 'TRUE');
            $data = array_merge($data["datauser"]["0"], $Loginmember);
            $this->session->set_userdata("member", $data);

            echo json_encode(array(
                'status' => 'success',
                'message' => 'Anda berhasil mendaftar'
            ));
            //}else{
            //$this->session->set_flashdata('message', 'Email yang anda masukkan tidak benar');
            //redirect(base_url().'member/signup');
            /* echo json_encode(array(
                        'status' => 'error',
                        'message' => 'Email yang anda masukkan tidak benar'
                    )); */
            //}
            //}
        }
    }


    public function submit()
    {
        var_dump($_POST);
        die;
    }
}
