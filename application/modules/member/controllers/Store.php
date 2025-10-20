<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("member_model");
        $this->load->model('store/store_model', 'store_view');
        $this->load->model('store/store_style_model', 'store_style');
        $this->load->model('store/store_description_model', 'store_desc');
        $this->load->model("member/member_store_model", 'store_model');
        $this->load->model("product/product_model");
        $this->load->model("category/category_model");
        $this->load->model("c/c_model");
        $this->load->library('encryption');
    }
    public function index()
    {

        $this->securitylog->cekloginmember();
        redirect(base_url() . "member/store/store");
    }
    public function session_member()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('member.id' => $sessionmember["id"]);
        $member = $this->member_model->getmember($where);
        return $member;
    }
    public function session_store()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $store = array('store_member.member_id' => $sessionmember["id"]);
        return $store;
    }

    public function status()
    {
        $this->load->model('company/company_model');

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["member"] = $this->session_member();
        $data['company'] = $this->company_model->get_my_company();
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store_status";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store_status";
        }

        $this->load->view('front/template_front', $data);
    }

    public function verification()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["member"] = $this->session_member();
        $data["js"] = array("/modules/member/js/store/verification.js");

        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_status_verification.php";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_status_verification.php";
        }



        $this->load->view('front/template_front', $data);
    }

    public function verification_store()
    {

        if ($_POST['jenis_usaha'] == "1") {

            $principal['name'] = $_POST['name'];
        } else {

            $principal['company'] = $_POST['name'];
        }

        $companies['name'] = $_POST['name'];
        $companies['website'] = $_POST['website'];
        $companies['industry'] = $_POST['industry'];
        $companies['ownership'] = $_POST['jenis_usaha'] == "1" ? "perorangan" : "company";
        $companies['telephone'] = $_POST['telephone'];
        $companies['email'] = $_POST['email'];
        $companies['description'] = $_POST['additional_info'];
        $companies['npwp'] = $_POST['npwp'];
        $companies['billing_country'] = $_POST['billing_country'];
        $companies['billing_province'] = $_POST['billing_province'];
        $companies['billing_regency'] = $_POST['billing_regency'];
        $companies['billing_district'] = $_POST['billing_district'];
        $companies['billing_village'] = $_POST['billing_village'];
        $companies['billing_code'] = $_POST['billing_code'];
        $companies['shipping_country'] = $_POST['shipping_country'];
        $companies['shipping_province'] = $_POST['shipping_province'];
        $companies['shipping_regency'] = $_POST['shipping_regency'];
        $companies['shipping_district'] = $_POST['shipping_district'];
        $companies['shipping_village'] = $_POST['shipping_village'];
        $companies['shipping_code'] = $_POST['shipping_code'];
        $companies['created_by'] = $this->session_member()[0]['id'];
        $companies['status'] = 0;
        $companies['created_at'] = time();

        $this->load->model('company/company_model');
        $this->load->model('principal/m_principal');
        $id = $this->company_model->save($companies);

        $principal['company_id'] = $id;
        $principal['product'] = $_POST['products'];
        $principal['brand'] = $_POST['brands'];
        $principal['email'] = $_POST['email'];
        $principal['phone'] = $_POST['telephone'];
        $principal['additional_info'] = $_POST['additional_info'];
        $principal['country'] = $_POST['countries'];
        $principal['create_at'] = time();

        $this->m_principal->save($principal);


        $this->session->set_flashdata('success', 'Data verifikasi telah di kirim!');

        redirect(base_url('member/store/verification_send'));
    }

    public function verification_send()
    {

        // var_dump($this->session->flashdata());
        // die;

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["member"] = $this->session_member();
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_verification_send";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_verification_send";
        }
        $this->load->view('front/template_front', $data);
    }

    public function store()
    {
        $this->db->reset_query();
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $data["stores"] = new Store_model(['domain' => $data["store"][0]['domain']]);
        $data["products"] = $this->store_model->getProduct($data["store"][0]['id']);
        $data["provinces"] = $this->member_model->getprovinces();
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data["distjs"] = array(
            base_url() . 'asset/backend/dist/js/tinymce/tinymce.min.js',
        );
        $data["css"] = array(base_url() . "asset/css/member_page.css", base_url() . 'asset/backend/dist/js/tinymce/skins/lightgray/skin.min.css',);
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/store/store.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store";
        }
        $this->load->view('front/template_front', $data);
    }

    public function store_register()
    {
        $data["member"] = $this->session_member();
        $this->form_validation->set_rules('name', 'Name Toko', 'required');
        $this->form_validation->set_rules('domain', 'Domain', 'required');
        $this->form_validation->set_rules('npwp', 'NPWP', 'required');
        $this->form_validation->set_rules('company_phone', 'Telepon', 'required');
        $this->form_validation->set_rules('company_email', 'Email', 'required|valid_email');
        if ($this->form_validation->run($this) == FALSE) {
            $this->session->set_flashdata('message-failed', 'Data Anda tidak lengkap, Silahkan ulangi pengisian form dengan benar.' . validation_errors()); //
            redirect(base_url() . 'member/formBuatToko');
        } else {
            $config['upload_path'] = './public/image/store/logo/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '5000';
            $config['max_width']  = '3000';
            $config['max_height']  = '3000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("logo")) {
                $this->session->set_flashdata('message', 'Gagal mengupload logo' . $this->upload->display_errors());
                redirect(base_url() . "member/formBuatToko");
                exit();
            } else {
                $logo = $this->upload->data();
                $data["dataall"] = array(
                    // 'member_id' => $this->input->post('id_member'),
                    'name' => $this->input->post('name'),
                    'domain' => $this->input->post('domain'),
                    'npwp' => $this->input->post('npwp'),
                    'email' => $this->input->post('company_email'),
                    'phone' => $this->input->post('company_phone'),
                    'description_id' => $this->input->post('description_store'),
                    'mailing_pic' => $this->input->post('pic'),
                    'mailing_position' => $this->input->post('position'),
                    'mailing_phone' => $this->input->post('phone_pic'),
                    'mailing_country' => $this->input->post('country'),
                    'mailing_province' => $this->input->post('province'),
                    'mailing_city' => $this->input->post('city'),
                    'mailing_address' => $this->input->post('address'),
                    'mailing_zipcode' => $this->input->post('zipcode'),
                    'logo' => $logo["file_name"],
                    'created_at' => date("d-m-Y"),
                    'created_by' => $this->input->post('id_member'),
                );
                $this->member_model->insertstore($data["dataall"]);
                $store_id = $this->db->insert_id();
                $storeMember = [
                    'member_id' => $this->input->post('id_member'),
                    'store_id' => $store_id,
                    'permission' => $this->input->post("position"),
                    'created_at' => time(),
                    'created_by' => $this->input->post('id_member'),
                ];
                $this->db->insert("store_member", $storeMember);
                $storeStyle = [
                    'store_id' => $store_id,
                    'color_nav' => '#000000',
                    'color_nav_text' => '#ffffff',
                    'color_bg' => '#ffffff',
                    'color_text_name' => '#ffffff',
                    'color_text_name_category' => '#fa8420',
                    'color_text_name_product' => '#fa8420',
                    'color_text_title' => '#000000',
                    'color_text_content' => '#000000',
                    'color_card_description' => '#ffffff',
                    'color_card_title' => '#000000',
                    'color_card_content' => '#000000',
                    'direction_card' => 1,
                    'direction_text_title_description' => 'center',
                    'color_button' => '#000000',
                    'color_card_product' => '#fa8420',
                    'color_text_card_product' => '#ffffff',
                ];
                $this->db->insert("store_style", $storeStyle);
                $this->session->set_flashdata('message', 'Toko Berhasil dibuat');
                redirect(base_url() . 'member/store/store');
            }
        }
    }
    public function update_store()
    {
        $this->securitylog->cekloginmember();
        $this->form_validation->set_rules('name', 'Name Toko', 'required');
        $this->form_validation->set_rules('domain', 'Domain', 'required');
        $this->form_validation->set_rules('npwp', 'NPWP', 'required');
        $this->form_validation->set_rules('company_phone', 'Telepon', 'required');
        $this->form_validation->set_rules('company_email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message-failed', 'Anda tidak mengisi form dengan benar' . validation_errors());
            redirect(base_url() . 'member');
            exit();
        }
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $datastore = array(
            'name' => $this->input->post('name'),
            'domain' => $this->input->post('domain'),
            'npwp' => $this->input->post('npwp'),
            'email' => $this->input->post('company_email'),
            'phone' => $this->input->post('company_phone'),
            'description_id' => $this->input->post('description_store'),
            'mailing_pic' => $this->input->post('pic'),
            'mailing_position' => $this->input->post('position'),
            'mailing_phone' => $this->input->post('phone_pic'),
            'mailing_country' => $this->input->post('country'),
            'mailing_province' => $this->input->post('province'),
            'mailing_city' => $this->input->post('city'),
            'mailing_address' => $this->input->post('address'),
            'mailing_zipcode' => $this->input->post('zipcode'),
            'created_at' => date("d-m-Y"),
        );
        $this->store_model->update($where, $datastore);
        $this->session->set_flashdata('message-success', 'Terimakasih, telah mengisi data profil bisnis Anda');
        redirect(base_url() . 'member/store/store');
        exit();
    }
    public function edit_template()
    {
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);

        $dataTemplate = array(
            'template' => $this->input->post('template'),
            'template_produk' => $this->input->post('template_produk'),
        );
        $this->store_model->update($where, $dataTemplate);
        $this->session->set_flashdata('message-success', 'Perubahan template berhasil di update');
        redirect(base_url() . 'member/store/store');
        exit();
    }
    public function edit_warna_store()
    {
        $colorNav = $this->input->post('colorNav');
        $colorNavText = $this->input->post('colorNavText');
        $colorTextName = $this->input->post('colorTextName');
        $colorBg = $this->input->post('colorBg');
        $colorTextTitle = $this->input->post('colorTextTitle');
        $colorTextContent = $this->input->post('colorTextContent');
        $colorTextNameCategory = $this->input->post('colorTextNameCategory');
        $colorTextNameProduct = $this->input->post('colorTextNameProduct');
        $colorCardDescription = $this->input->post('colorCardDescription');
        $colorButton = $this->input->post('colorButton');
        $directionCard = $this->input->post('directionCard');
        $directionTextTitleDescription = $this->input->post('directionTextTitleDescription');
        $colorCardTitle = $this->input->post('colorCardTitle');
        $colorCardContent = $this->input->post('colorCardContent');
        $colorCardProduct = $this->input->post('colorCardProduct');
        $colorTextCardProduct = $this->input->post('colorTextCardProduct');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $dataWarna = array(
            'color_nav' => $colorNav,
            'color_nav_text' => $colorNavText,
            'color_text_name' => $colorTextName,
            'color_bg' => $colorBg,
            'color_text_title' => $colorTextTitle,
            'color_text_content' => $colorTextContent,
            'color_text_name_category' => $colorTextNameCategory,
            'color_text_name_product' => $colorTextNameProduct,
            'color_card_description' => $colorCardDescription,
            'color_card_title' => $colorCardTitle,
            'color_card_content' => $colorCardContent,
            'color_button' => $colorButton,
            'direction_card' => $directionCard,
            'direction_text_title_description' => $directionTextTitleDescription,
            'color_card_product' => $colorCardProduct,
            'color_text_card_product' => $colorTextCardProduct,
        );
        $this->store_style->update($where['id'], $dataWarna);
        $this->session->set_flashdata('message-success', 'Perubahan warna berhasil di update');
        redirect(base_url() . 'member/store/store');
        exit();
    }
    public function store_product()
    {
        $this->db->reset_query();
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $idStore = $this->store_model->checkstore($data["member"][0]['id']);
        $data["product"] = $this->store_model->getProduct($idStore[0]['id']);
        $data["css"] = array(base_url() . "asset/datatables/dataTables.bootstrap.css", base_url() . "asset/datatables/jquery.dataTables.min.css", base_url() . "asset/css/member_page.css", "/modules/member/css/store.css");
        $data["js"] = array(base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/store/store.js", "/modules/member/js/store/product.js");
        $data['store'] = $this->store_model->checkstore($data['member'][0]['id']);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store_product";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store_product";
        }
        $this->load->view('front/template_front', $data);
    }

    public function getProductStore()
    {
        $fetch_data = $this->store_model->make_datatables();
        $response = [];
        foreach ($fetch_data as $key => $value) {
            if ($this->agent->is_mobile()) {
                $result = array();
                $result[] = '<img src="' . base_url() . 'public/image/product/' . $value['img'] . '" alt="' . $value['tittle'] . '" class="icon-a-40 m-r-1">';
                $result[] = $value['tittle'];
                $result[] = '<p class="m-a-0 label label-' . $value['status'] . '">' . $value['status'] . '</p>';
                $result[] = 'Rp ' . number_format($value['price'], 0, ",", ".") . " / " . $value['unit'];
                $result[] = 'Stock : ' . $value['stock'];
                $result[] = $value['id'];
                $response[] = $result;
            } else {
                $result = array();
                $result[] = $key + 1;
                $result[] = '<img src="' . base_url() . 'public/image/product/' . $value['img'] . '" alt="' . $value['tittle'] . '" class="icon-a-40 m-r-1">' . $value['tittle'];
                $result[] = 'Rp ' . number_format($value['price'], 0, ',', '.');
                $result[] = $value['unit'];
                $result[] = $value['stock'];
                $result[] = '<p class="m-a-0 label label-' . $value['status'] . '">' . $value['status'] . '</p>';
                $result[] = '<div class="d-flex-sa align-items-center vertical-align-middle"><button class="btn btn-edit-product" data-toggle="modal" data-target="#edit-product-' . $value["id"] . '"><i class="fa fa-edit"></i></button><button class="btn btn-delete-product" data-toggle="modal" data-target="#delete-product-' . $value["id"] . '"><i class="fa fa-trash"></i></button></div>';
                // $result[] = '<input type="checkbox" class="checkbox checkbox-quotation" name="quotation[]" value="'.$value['id'].'">';
                $response[] = $result;
            }
        }
        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $this->store_model->get_all_data(),
            "recordsFiltered" => $this->store_model->get_filtered_data(),
            "data"  => $response
        ];
        echo json_encode($output);
    }

    public function store_addproduct()
    {
        $data["member"] = $this->session_member();
        $datastore = $this->session_store();
        $this->securitylog->cekloginmember();

        $category = $this->category_model->treeBack();

        $data['category'] = $category;
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/store.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/store/store.js", "/modules/member/js/store/addproduct.js", base_url() . "asset/backend/js/form.product.js");
        $data['store'] = $this->store_model->getstore($datastore);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store_addproduct";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store_addproduct";
        }
        $this->load->view('front/template_front', $data);
    }


    public function getBrands()
    {
        $category_id = $this->input->post('category_id');
        $categoryModel = new Category_model(['id' => $category_id]);
        echo json_encode($categoryModel->brands);
    }



    public function store_addproduct_jasa()
    {
        $data["member"] = $this->session_member();
        $datastore = $this->session_store();
        $this->securitylog->cekloginmember();
        $category = $this->category_model->treeBack();
        $data['category'] = $category;
        $data["css"] = array(base_url() . "asset/datatables/dataTables.bootstrap.css", base_url() . "asset/datatables/jquery.dataTables.min.css", base_url() . "asset/css/member_page.css", "/modules/member/css/store.css");
        $data["js"] = array(base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/store/store.js", base_url() . "asset/backend/js/form.product.js");
        $data['store'] = $this->store_model->getstore($datastore);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store_addproduct";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store_addproduct_jasa";
        }
        $this->load->view('front/template_front', $data);
    }
    public function store_addproduct_barang()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $datastore = $this->session_store();
        $category = $this->category_model->treeBack();
        $data['category'] = $category;
        $data["css"] = array(base_url() . "asset/css/member_page.css", "/modules/member/css/store.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", "/modules/member/js/store/addproduct.js", base_url() . "asset/js/member_page.js", "/modules/member/js/store/store.js", base_url() . "asset/backend/js/form.product.js");
        $data['store'] = $this->store_model->getstore($datastore);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store_addproduct";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store_addproduct_barang";
        }
        $this->load->view('front/template_front', $data);
    }
    public function store_addproduct_rental()
    {
        $data["member"] = $this->session_member();
        $datastore = $this->session_store();
        $this->securitylog->cekloginmember();
        $data['category'] = $this->c_model->get_category();
        $data["css"] = array(base_url() . "asset/datatables/dataTables.bootstrap.css", base_url() . "asset/datatables/jquery.dataTables.min.css", base_url() . "asset/css/member_page.css", "/modules/member/css/store.css");
        $data["js"] = array(base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "/modules/member/js/store/store.js", base_url() . "asset/backend/js/form.product.js");
        $data['store'] = $this->store_model->getstore($datastore);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_store_addproduct";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_store_addproduct_rental";
        }
        $this->load->view('front/template_front', $data);
    }
    public function setting()
    {
        $data["member"] = $this->session_member();
        $data["store"] = $this->store_model->checkstore($data['member'][0]['id']);
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["provinces"] = $this->member_model->getprovinces();
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "desktop/store/_settingstore";
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "modules/member/js/store/store.js");
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "mobile/store/_settingstore";
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js", "modules/member/js/store/mobile/store.js");
        }
        $data["seotitle"] = "Member Area Trumecs";
        $this->load->view('front/template_front', $data);
    }
    public function saldo()
    {
        $datastore = $this->session_store();
        $data['store'] = $this->store_model->getstore($datastore);
        $data["member"] = $this->session_member();
        $this->securitylog->cekloginmember();
        $data["css"] = array(base_url() . "asset/css/member_page.css");
        $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/member_page.js");

        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];

        $where = array('user_id' => $sessionmember["id"]);

        $data['kode'] = $this->member_model->get_kode($sessionmember["id"]);
        $data['mutation'] = $this->member_model->get_mutation_list($where);
        if (!$this->agent->is_mobile()) {
            $data['content'] = '/desktop/view_member';
            $data["contentmember"] = "/desktop/store/_listreferralstore";
        } else {
            $data['content'] = '/mobile/view_member';
            $data["contentmember"] = "/mobile/store/_listreferralstore";
        }
        $this->load->view('front/template_front', $data);
    }
    public function upload_produk()
    {
        $path = 'public/produk/barang/';
        $filename = md5(RAND(1, 9999) . $_FILES['file']['name']) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $uploadfile = $path . $filename;
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        echo json_encode(array(
            'name' => $filename,
            'path' => $uploadfile
        ));
    }
    public function upload_jasa()
    {
        $path = 'public/produk/jasa/';
        $filename = md5(RAND(1, 9999) . $_FILES['file']['name']) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $uploadfile = $path . $filename;
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        echo json_encode(array(
            'name' => $filename,
            'path' => $uploadfile
        ));
    }
    public function upload_jasa_test()
    {
        $datainsert = array(
            "tipe" => $this->input->post("tipe_jasa"),
            "tittle" => $this->input->post("nama_jasa"),
            "description" => $this->input->post("description_jasa"),
            "price" => $this->input->post("harga_jasa"),
            "livetime" => $this->input->post("minimum_jasa"),
            "status" => "show",
        );
        $this->store_model->insert_product($datainsert);
        $this->session->set_flashdata('message', 'Jasa telah di tambah');
        redirect(base_url() . "member/store/store_product");
        exit();
    }

    public function upload_barang()
    {
        $member = $this->session_member();
        $id = $member[0]['id'];
        $idStore = $this->store_model->checkstore($id);
        $gambarProduct = [];
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['name'] as $key => $value) {
                $_FILES['file']['name']     = $_FILES['images']['name'][$key];
                $_FILES['file']['type']     = $_FILES['images']['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
                $_FILES['file']['error']    = $_FILES['images']['error'][$key];
                $_FILES['file']['size']     = $_FILES['images']['size'][$key];
                $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $newFileName = $idStore[0]['id'] . '_' . time()  . uniqid() . '.' . $fileExt;
                $config['upload_path']   = 'public/image/product/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = '5000';
                $config['file_name']     = $newFileName;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $gambarProduct['totalFiles'][] = $filename;
                } else {
                    $this->upload->display_errors();
                }
            }
        }
        var_dump($gambarProduct);
        $jenis = $this->input->post('jenis_barang');
        $harga = $this->input->post("harga_barang");
        $hargaInt = str_replace('.', '', $harga);
        $categori = $this->store_model->checkCategori($jenis);
        $parent = $categori[0]['parent'];
        $categoriParent = $this->store_model->checkCategori($parent);
        $datainsert = array(
            "status" => "show",
            "tittle" => $this->input->post("nama_barang"),
            "jenisproduct" => $parent != 0 ? $categoriParent[0]['name'] : $categori[0]['name'],
            "brand" => $this->input->post("merek_barang"),
            "description" => $this->input->post("description_barang"),
            "quality" => $this->input->post("kondisi_barang"),
            "unit" => $this->input->post("satuan_barang"),
            "price" => $hargaInt,
            "moq" => $this->input->post("minimum_pembelian_barang"),
            "stock" => $this->input->post("stock_barang"),
            "img" => $gambarProduct["totalFiles"][0],
            "store_id" => $idStore[0]['id'],
        );
        $this->db->trans_start();
        $this->store_model->insert_product($datainsert);
        $idProduct = $this->db->insert_id();
        foreach ($gambarProduct["totalFiles"] as $value) {
            $galeryProduct = array(
                "product" => $idProduct,
                "img" => $value
            );
            $this->store_model->insertGaleryProduct($galeryProduct);
        };
        $attributes = $this->input->post('attributes[]');
        $idAttribute = $this->input->post('id_attributes[]');
        if (isset($idAttribute)) {
            foreach ($idAttribute as $key => $id) {
                $oldAttribute = array(
                    'product_id' => $idProduct,
                    'attribute_id' => $id,
                    'value' => $attributes[$key]
                );
                $this->store_model->insertAttributeProduct($oldAttribute);
            };
        };
        $nameAttribute = $this->input->post('nama_attribute_barang[]');
        $valueAttribute = $this->input->post('nama_value_barang[]');
        $dataattribute = array(
            'attribute' => $nameAttribute,
            'value' => $valueAttribute
        );
        $this->store_model->addattribute_barang($dataattribute, array('product_id' => $idProduct));
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Barang telah di tambah');
        redirect(base_url() . "member/store/store_product");
        exit();
    }

    public function addproduct_barang()
    {
        $unit = ($this->input->post('unit') != "") ? $this->input->post('unit') : "1 Pc";
        $dimention_array = explode("x", $this->input->post('dimention'));
        if (count($dimention_array) != 3) {
            $dimention_array[0] = "0";
            $dimention_array[1] = "0";
            $dimention_array[2] = "0";
        }
        $datainput = array(
            'tittle' => preg_replace('/[.,\/]/', "", $this->input->post('tittle')),
            'partnumber' => empty($this->input->post('partnumber')) ? "" : $this->input->post('partnumber'),
            'physicnumber' => empty($this->input->post('physicnumber')) ? "" : $this->input->post('physicnumber'),
            'partnumber_trumecs' => empty($this->input->post('partnumber_trumecs')) ? "" : $this->input->post('partnumber_trumecs'),
            'price' => empty($this->input->post('price')) ? "" : str_replace(".", "", $this->input->post('price')),
            'price_promo' => empty($this->input->post('price_promo')) ? "" : str_replace(".", "", $this->input->post('price_promo')),
            'promo_cbd_price' => empty($this->input->post('promo_cbd_price')) ? "" : str_replace(".", "", $this->input->post('promo_cbd_price')),
            'promo_volume' => empty($this->input->post('promo_volume')) ? "" : str_replace(".", "", $this->input->post('promo_volume')),
            'promo_volume_price' => empty($this->input->post('promo_volume_price')) ? "" : str_replace(".", "", $this->input->post('promo_volume_price')),
            'promo_referral_price' => empty($this->input->post('promo_referral_price')) ? "" : str_replace(".", "", $this->input->post('promo_referral_price')),
            'brand' => empty($this->input->post('brand')) ? "" : $this->input->post('brand'),
            'type' => empty($this->input->post('type')) ? "" : $this->input->post('type'),
            'component' => empty($this->input->post('component')) ? "" : $this->input->post('component'),
            'quality' => empty($this->input->post('quality')) ? "" : $this->input->post('quality'),
            'warranty' => empty($this->input->post('warranty')) ? "" : $this->input->post('warranty'),
            'warrantyvendor' => empty($this->input->post('warranty_vendor')) ? "" : $this->input->post('warranty_vendor'),
            'livetime' => empty($this->input->post('livetime')) ? "" : $this->input->post('livetime'),
            'stock' => str_replace(",", "", $this->input->post('stock')),
            'moq' => str_replace(",", "", $this->input->post('moq')),
            'weight' => empty($this->input->post('weight')) ? "" : $this->input->post('weight'),
            'sx' => $dimention_array[0], //$this->input->post('sx'),
            'sy' => $dimention_array[1], //$this->input->post('sy'),
            'sz' => $dimention_array[2],      /*  
                'px'=>$this->input->post('px'),
                'py'=>$this->input->post('py'),
                'pz'=>$this->input->post('pz'),*/
            'packagin' => empty($this->input->post('packagin')) ? "" : $this->input->post('packagin'),
            ##'img'=>$this->input->post('namefile'),
            'unit' => $unit,
            'ppn' => "10",
            'youtube' => $this->input->post('youtube'),
            'jenisproduct' => $this->input->post('jenisproduct'),
            'link_tokped' => $this->input->post('link_tokped'),
            'link_bukalapak' => $this->input->post('link_bukalapak'),
            'link_shopee' => $this->input->post('link_shopee'),
            'link_blibli' => $this->input->post('link_blibli'),
            'availability_at' => empty($this->input->post('availability_at')) ? "INDONESIA" : $this->input->post('availability_at'),
            'estimated_delivery' => empty($this->input->post('estimated_delivery')) ? "3" : $this->input->post('estimated_delivery'),
            'estimated_deliveryindent' => empty($this->input->post('estimated_deliveryindent')) ? "7" : $this->input->post('estimated_deliveryindent'),
            'description' => empty($this->input->post('description')) ? "" : nl2br($this->input->post('description')),
            'area' => empty($this->input->post('area')) ? "0" : $this->input->post('area'),

        );
        $dataattribute = array(
            'attribute' => $this->input->post('attribute'),
            'value' => $this->input->post('value')
        );
        $config['upload_path'] = './public/image/product/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = microtime() . ".jpg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("fileimg")) {
            $this->session->set_flashdata('message', 'Gambar tidak bisa di upload' . $this->upload->display_errors());
            $this->session->set_flashdata('backingdata', $datainput);
            /*echo "<script>
                            alert('Gambar tidak bisa di upload ');
                            window.history.back();
                        </script>";*/
            redirect(base_url() . "backendproduct/form");
            exit();
        } else {
            $data = $this->upload->data();
            $namenewfile = $data["file_name"];
            $dataaddimg = array('img' => $namenewfile);
            $alldatainput = array_merge($datainput, $dataaddimg);
            $this->watermarkoverlay($namenewfile, "product");
            $this->etx_product->addproduct($alldatainput);
            $this->etx_product->addattribute($dataattribute, array('product_id' => $this->db->insert_id()));
            $this->session->set_flashdata('message-success', 'Produk di tambah, Silahkan tambah galery produk baru');
            redirect(base_url() . "backendproduct/listall");
            exit();
        }
        redirect(base_url() . 'member/store/_store_product');
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
    public function upload_logo_store()
    {
        $logoBefore = $this->input->post('logoBefore');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));
        $config['upload_path'] = './public/image/store/logo/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $config['file_name'] = $where['id'] . '-logo-' . $key;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("logo")) {
            $this->session->set_flashdata('message-failed', 'Gagal mengupload logo' . $this->upload->display_errors());
            redirect(base_url() . "member/store");
            exit();
        } else {
            $data = $this->upload->data();
            $logo = array(
                'logo' => $data["file_name"],
            );
            $this->db->trans_start();
            unlink(FCPATH . 'public/image/store/logo/' . $logoBefore);
            $this->store_model->update($where, $logo);
            $this->db->trans_complete();
            $this->session->set_flashdata('message-success', 'Logo berhasil diunggah');
            redirect(base_url() . "member/store");
        }
    }

    public function tambah_description()
    {
        $title = $this->input->post('title');
        $icon = $this->input->post('icon');
        $is_image = $this->input->post('is_image');
        $content = $this->input->post('content');
        $index = $this->input->post('index');
        $title_direction = $this->input->post('title_direction');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataDesc['title'] = $title;
        $dataDesc['content'] = $content;
        $dataDesc['index'] = $index;
        $dataDesc['icon'] = $icon;
        $dataDesc['is_image'] = $is_image;
        $dataDesc['title_direction'] = $title_direction;
        $dataDesc['store_id'] = $store[0]['id'];

        $config['upload_path'] = './public/image/store/desc/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG|webp';
        $config['max_size'] = '5000';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!empty($_FILES['image_desc']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-' . $index . '-image-description-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("image_desc")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload image' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataDesc['image'] = $data['file_name'];
            }
        }
        $this->db->trans_start();
        $this->store_desc->insert_desc($dataDesc);
        $this->session->set_flashdata('message-success', 'Deskripsi berhasil ditambahkan');
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }

    public function edit_description($id)
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $nameImage = $this->input->post('nameImage');
        $icon = $this->input->post('icon');
        $is_image = $this->input->post('is_image');
        $index = $this->input->post('index');
        $title_direction = $this->input->post('title_direction');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataDesc['title'] = $title;
        $dataDesc['content'] = $content;
        $dataDesc['index'] = $index;
        $dataDesc['icon'] = $icon;
        $dataDesc['is_image'] = $is_image;
        $dataDesc['title_direction'] = $title_direction;


        $config['upload_path'] = './public/image/store/desc/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG|webp';
        $config['max_size'] = '5000';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!empty($_FILES['image_desc']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-' . $index . '-image-description-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("image_desc")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload image' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $imageExist = $this->store_desc->image_desc_exists($nameImage);
                if ($data["file_name"] != null && $imageExist > 0) {
                    unlink(FCPATH . 'public/image/store/desc/' . $nameImage);
                }
                $data = $this->upload->data();
                $dataDesc['image'] = $data['file_name'];
            }
        }
        $this->db->trans_start();
        $this->store_desc->edit_desc($id, $dataDesc);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Deskripsi berhasil diedit');
        redirect(base_url() . "member/store/store");
    }

    public function toggleSwitchImage()
    {
        $id = $this->input->post('id');
        $is_image = $this->input->post('is_image');
        $data = [
            'is_image' => $is_image,
        ];
        $this->db->trans_start();
        $this->store_desc->edit_desc($id, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message-error', 'Terjadi kesalahan saat mengubah data');
        } else {
            $this->session->set_flashdata('message-success', 'Deskripsi berhasil diedit');
        }

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    public function toggleSwitchImageDirection()
    {
        $id = $this->input->post('id');
        $direction_image = $this->input->post('direction_image');
        $data = [
            'direction_image' => $direction_image,
        ];
        $this->db->trans_start();
        $this->store_desc->edit_desc($id, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message-failed', 'Terjadi kesalahan saat mengubah data');
        } else {
            $this->session->set_flashdata('message-success', 'Deskripsi berhasil diedit');
        }

        echo json_encode(['success' => $this->db->trans_status()]);
    }
    public function toggleSwitchImageDirectionCover()
    {
        $id = $this->input->post('id');
        $direction_title_image = $this->input->post('direction_title_image');
        $data = [
            'direction_title_image' => $direction_title_image,
        ];
        $this->db->trans_start();
        $this->store_view->edit_store($id, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message-failed', 'Terjadi kesalahan saat mengubah data');
        } else {
            $this->session->set_flashdata('message-success', 'Deskripsi berhasil diedit');
        }

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    public function delete_description($id)
    {
        $this->db->trans_start();
        $this->store_desc->delete_desc($id);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Deskripsi berhasil didelete');
        redirect(base_url() . "member/store/store");
    }

    public function update_title_cover()
    {
        $title = $this->input->post('title_cover');
        $colorTitle = $this->input->post('colorTitleCover');
        $content = $this->input->post('title_content');
        $colorContent = $this->input->post('colorContentCover');
        $col_left = $this->input->post('value_col_left');
        $col_right = $this->input->post('value_col_right');
        $direction_title_image = $this->input->post('direction_title_image');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));
        $config['upload_path'] = './public/image/store/coverimage/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';
        $this->load->library('upload', $config);
        $this->db->trans_start();
        if (!empty($_FILES['titleImage']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-title-image-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("titleImage")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload image desktop' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $dataImage = $this->upload->data();
                $dataUpdate['title_image'] = $dataImage["file_name"];
            }
        }

        if (!empty($_FILES['titleImageMobile']['name'])) {
            $configMobile['upload_path'] = './public/image/store/coverimage/mobile/';
            $configMobile['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
            $configMobile['max_size'] = '5000';
            $configMobile['max_width']  = '5000';
            $configMobile['max_height']  = '5000';
            $configMobile['file_name'] = $store[0]['id'] . '-title-image-mobile-' . $key;
            $this->upload->initialize($configMobile);
            if (!$this->upload->do_upload("titleImageMobile")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload image mobile' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $dataImageMobile = $this->upload->data();
                $dataUpdate['title_image_mobile'] = $dataImageMobile["file_name"];
            }
        }
        $dataUpdate['title_cover'] = $title;
        $dataUpdate['color_title_cover'] = $colorTitle;
        $dataUpdate['title_content'] = $content;
        $dataUpdate['color_title_content'] = $colorContent;
        $dataUpdate['col_left'] = $col_left;
        $dataUpdate['col_right'] = $col_right;
        $dataUpdate['direction_title_image'] = $direction_title_image;

        $this->store_model->update($where, $dataUpdate);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Deskripsi Cover Berhasil Diubah');
        redirect(base_url() . "member/store/store");
    }

    public function upload_cover_store()
    {
        $nameCover = $this->input->post('nameCover');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));
        $config['upload_path'] = './public/image/store/cover/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '1460';
        $config['max_height']  = '420';
        $config['file_name'] = $store[0]['id'] . '-cover-desktop-' . $key;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("cover")) {
            $this->session->set_flashdata('message-failed', 'Gagal mengupload Cover' . $this->upload->display_errors());
            redirect(base_url() . "member/store/store");
            exit();
        } else {
            $data = $this->upload->data();
            $cover = array(
                'cover' => $data["file_name"],
            );
            $coverExist = $this->store_model->cover_exists($nameCover);
            $this->db->trans_start();
            if ($coverExist > 0) {
                unlink(FCPATH . 'public/image/store/cover/' . $nameCover);
                $this->store_model->update($where, $cover);
                $this->session->set_flashdata('message-success', 'Cover berhasil diupdate');
            } else {
                $this->store_model->update($where, $cover);
                $this->session->set_flashdata('message-success', 'Cover berhasil diunggah');
            }
            $this->db->trans_complete();
            redirect(base_url() . "member/store/store");
        }
    }
    public function upload_cover_store_mobile()
    {
        $nameCover = $this->input->post('nameCover');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));
        $config['upload_path'] = './public/image/store/cover/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '410';
        $config['max_height']  = '270';
        $config['file_name'] = $store[0]['id'] . '-cover-mobile-' . $key;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("cover")) {
            $this->session->set_flashdata('message-failed', 'Gagal mengupload Cover' . $this->upload->display_errors());
            redirect(base_url() . "member/store/store");
            exit();
        } else {
            $data = $this->upload->data();
            $cover = array(
                'cover_mobile' => $data["file_name"],
            );
            $coverExist = $this->store_model->cover_mobile_exists($nameCover);
            $this->db->trans_start();
            if ($coverExist > 0) {
                unlink(FCPATH . 'public/image/store/cover/' . $nameCover);
                $this->store_model->update($where, $cover);
                $this->session->set_flashdata('message-success', 'Cover berhasil diupdate');
            } else {
                $this->store_model->update($where, $cover);
                $this->session->set_flashdata('message-success', 'Cover berhasil diunggah');
            }
            $this->db->trans_complete();
            redirect(base_url() . "member/store/store");
        }
    }
    public function delete_cover()
    {
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        unlink(FCPATH . 'public/image/store/cover/' . $store[0]['cover']);
        $cover = array(
            'cover' => null,
        );
        $this->db->trans_start();
        $this->store_model->update($where, $cover);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Cover berhasil dihapus');
        redirect(base_url() . "member/store/store");
    }
    public function delete_cover_mobile()
    {
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        unlink(FCPATH . 'public/image/store/cover/' . $store[0]['cover_mobile']);
        $cover = array(
            'cover_mobile' => null,
        );
        $this->db->trans_start();
        $this->store_model->update($where, $cover);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Cover berhasil dihapus');
        redirect(base_url() . "member/store/store");
    }

    public function upload_banner_utama()
    {
        $namaBanner = $this->input->post('nameBannerUtama');
        $idBanner = $this->input->post('idBanner');
        $link = $this->input->post('link');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataUpdate['index'] = 0;
        $dataUpdate['store_id'] = $store[0]['id'];
        $dataUpdate['is_mobile'] = 0;
        $dataUpdate['link'] = $link;

        $config['upload_path'] = './public/image/store/banner/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '1190';
        $config['max_height']  = '420';
        $this->load->library('upload', $config);
        if (!empty($_FILES['bannerUtama']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-banner-utama-desktop-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("bannerUtama")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload banner' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataUpdate['source'] = $data['file_name'];
                $bannerExist = $this->store_view->banner_exists($namaBanner);
                if ($bannerExist > 0) {
                    unlink(FCPATH . 'public/image/store/banner/' . $namaBanner);
                }
            }
        }
        $this->db->trans_start();
        if ($idBanner == '') {
            $this->store_view->insert_banner($dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner Utama berhasil diunggah');
        } else {
            $this->store_view->update_banner($idBanner, 0, 0, $dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner Utama berhasil diupdate');
        }
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }
    public function upload_banner_utama_mobile()
    {
        $namaBanner = $this->input->post('nameBannerUtama');
        $idBanner = $this->input->post('idBanner');
        $link = $this->input->post('link');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataUpdate['index'] = 0;
        $dataUpdate['store_id'] = $store[0]['id'];
        $dataUpdate['is_mobile'] = 1;
        $dataUpdate['link'] = $link;

        $config['upload_path'] = './public/image/store/banner/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '380';
        $config['max_height']  = '220';
        $config['file_name'] = $store[0]['id'] . '-banner-utama-mobile-' . $key;
        $this->load->library('upload', $config);
        if (!empty($_FILES['bannerUtama']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-banner-utama-desktop-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("bannerUtama")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload banner' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataUpdate['source'] = $data['file_name'];
                $bannerExist = $this->store_view->banner_exists($namaBanner);
                if ($bannerExist > 0) {
                    unlink(FCPATH . 'public/image/store/banner/' . $namaBanner);
                }
            }
        }
        $this->db->trans_start();
        if ($idBanner == '') {
            $this->store_view->insert_banner($dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner Utama Mobile berhasil diunggah');
        } else {
            $this->store_view->update_banner($idBanner, 0, 1, $dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner Utama Mobile berhasil diupdate');
        }
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }
    public function upload_banner_1()
    {
        $namaBanner = $this->input->post('nameBanner1');
        $idBanner = $this->input->post('idBanner');
        $link = $this->input->post('link');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataUpdate['index'] = 1;
        $dataUpdate['store_id'] = $store[0]['id'];
        $dataUpdate['is_mobile'] = 0;
        $dataUpdate['link'] = $link;

        $config['upload_path'] = './public/image/store/banner/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '1190';
        $config['max_height']  = '220';
        $this->load->library('upload', $config);
        if (!empty($_FILES['banner1']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-banner-1-desktop-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("banner1")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload banner' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataUpdate['source'] = $data['file_name'];
                $bannerExist = $this->store_view->banner_exists($namaBanner);
                if ($bannerExist > 0) {
                    unlink(FCPATH . 'public/image/store/banner/' . $namaBanner);
                }
            }
        }
        $this->db->trans_start();
        if ($idBanner == '') {
            $this->store_view->insert_banner($dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 1 berhasil diunggah');
        } else {
            $this->store_view->update_banner($idBanner, 1, 0, $dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 1 berhasil diupdate');
        }
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }

    public function upload_banner_1_mobile()
    {
        $namaBanner = $this->input->post('nameBanner1');
        $idBanner = $this->input->post('idBanner');
        $link = $this->input->post('link');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataUpdate['index'] = 1;
        $dataUpdate['store_id'] = $store[0]['id'];
        $dataUpdate['is_mobile'] = 1;
        $dataUpdate['link'] = $link;

        $config['upload_path'] = './public/image/store/banner/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '380';
        $config['max_height']  = '120';

        $this->load->library('upload', $config);
        if (!empty($_FILES['banner1']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-banner-1-mobile-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("banner1")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload banner' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataUpdate['source'] = $data['file_name'];
                $bannerExist = $this->store_view->banner_exists($namaBanner);
                if ($bannerExist > 0) {
                    unlink(FCPATH . 'public/image/store/banner/' . $namaBanner);
                }
            }
        }
        $this->db->trans_start();
        if ($idBanner == '') {
            $this->store_view->insert_banner($dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 1 Mobile berhasil diunggah');
        } else {
            $this->store_view->update_banner($idBanner, 1, 1, $dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 1 Mobile berhasil diupdate');
        }
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }

    public function upload_banner_2()
    {
        $namaBanner = $this->input->post('nameBanner2');
        $idBanner = $this->input->post('idBanner');
        $link = $this->input->post('link');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataUpdate['index'] = 2;
        $dataUpdate['store_id'] = $store[0]['id'];
        $dataUpdate['is_mobile'] = 0;
        $dataUpdate['link'] = $link;

        $config['upload_path'] = './public/image/store/banner/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '1190';
        $config['max_height']  = '220';

        $this->load->library('upload', $config);
        if (!empty($_FILES['banner2']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-banner-2-desktop-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("banner2")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload banner' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataUpdate['source'] = $data['file_name'];
                $bannerExist = $this->store_view->banner_exists($namaBanner);
                if ($bannerExist > 0) {
                    unlink(FCPATH . 'public/image/store/banner/' . $namaBanner);
                }
            }
        }
        $this->db->trans_start();
        if ($idBanner == '') {
            $this->store_view->insert_banner($dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 2 berhasil diunggah');
        } else {
            $this->store_view->update_banner($idBanner, 2, 0, $dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 2 berhasil diupdate');
        }
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }
    public function upload_banner_2_mobile()
    {
        $namaBanner = $this->input->post('nameBanner2');
        $idBanner = $this->input->post('idBanner');
        $link = $this->input->post('link');
        $data["member"] = $this->session_member();
        $store = $this->store_model->checkstore($data['member'][0]['id']);
        $where = array('id' => $store[0]['id']);
        $key = bin2hex($this->encryption->create_key(20));

        $dataUpdate['index'] = 2;
        $dataUpdate['store_id'] = $store[0]['id'];
        $dataUpdate['is_mobile'] = 1;
        $dataUpdate['link'] = $link;

        $config['upload_path'] = './public/image/store/banner/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['max_size'] = '5000';
        $config['max_width']  = '380';
        $config['max_height']  = '120';

        $this->load->library('upload', $config);
        if (!empty($_FILES['banner2']['name'])) {
            $config['file_name'] = $store[0]['id'] . '-banner-2-mobile-' . $key;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("banner2")) {
                $this->session->set_flashdata('message-failed', 'Gagal mengupload banner' . $this->upload->display_errors());
                redirect(base_url() . "member/store/store");
                exit();
            } else {
                $data = $this->upload->data();
                $dataUpdate['source'] = $data['file_name'];
                $bannerExist = $this->store_view->banner_exists($namaBanner);
                if ($bannerExist > 0) {
                    unlink(FCPATH . 'public/image/store/banner/' . $namaBanner);
                }
            }
        }
        $this->db->trans_start();
        if ($idBanner == '') {
            $this->store_view->insert_banner($dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 2 Mobile berhasil diunggah');
        } else {
            $this->store_view->update_banner($idBanner, 2, 1, $dataUpdate);
            $this->session->set_flashdata('message-success', 'Banner 2 Mobile berhasil diupdate');
        }
        $this->db->trans_complete();
        redirect(base_url() . "member/store/store");
    }

    public function delete_banner($id)
    {
        $this->load->model("store/Store_banner_model", 'banner');
        $source = $this->banner->get(['id' => $id]);
        $sourceName = $source['source'];
        unlink(FCPATH . 'public/image/store/banner/' . $sourceName);
        $this->db->trans_start();
        $this->store_view->delete_banner($sourceName);
        $this->db->trans_complete();
        $this->session->set_flashdata('message-success', 'Banner berhasil dihapus');
        redirect(base_url() . "member/store/store");
    }

    public function get_product_attribute()
    {
        $jenisBarang = $this->input->post('category_id');

        $attibutes = $this->db->select('*')
            ->from('category_attribute ca')
            ->join('attribute a', 'a.id = ca.attribute_id')
            ->where('ca.category_id', $jenisBarang)
            ->get()->result_array();


        echo json_encode($attibutes);
    }
    public function get_product_grade()
    {
        $jenisBarang = $this->input->post('category_id');

        $attibutes = $this->db->select('*')
            ->from('category_grade cg')
            ->join('grade g', 'g.id = cg.grade_id')
            ->where('cg.category_id', $jenisBarang)
            ->get()->result_array();


        echo json_encode($attibutes);
    }

    public function editProduct()
    {
        $where = $this->input->post('id_product');
        $price = $this->input->post('priceProduct');
        $priceInt = str_replace('.', '', $price);
        $dataEdit = array(
            'tittle' => $this->input->post('nameProduct'),
            'price' => $priceInt,
            'stock' => $this->input->post('stockProduct'),
            'status' => $this->input->post('statusProduct'),
        );
        $edit = $this->store_model->editProduct($where, $dataEdit);
        if ($edit >= 0) {
            $this->session->set_flashdata('message-success', 'Edit Produk Berhasil');
            redirect(base_url() . 'member/store/store_product');
        } else {
            $this->session->set_flashdata('message-failed', 'Edit Produk Gagal');
            redirect(base_url() . 'member/store/store_product');
        }
    }
    public function deleteProduct()
    {
        $where = $this->input->post('id_product');
        $delete = $this->store_model->deleteProduct($where);
        if ($delete >= 0) {
            $this->session->set_flashdata('message-success', 'Hapus Produk Berhasil');
            redirect(base_url() . 'member/store/store_product');
        } else {
            $this->session->set_flashdata('message-failed', 'Hapus Produk Gagal');
            redirect(base_url() . 'member/store/store_product');
        }
    }
}
