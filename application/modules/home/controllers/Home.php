<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("home_model");
        $this->load->language("home");
        $this->load->model("article/article_model");
        $this->load->model("general/general_model");
        $this->load->model("member/member_model");
        $this->load->model("store/store_model");
        $this->load->model("store/store_member");
        $this->load->model("category/category_model");
        $this->load->model("product/product_model");
        $this->load->model("c/c_model");
        $this->load->model("promo/promo_model");
        $this->load->language("partnership");
        $this->load->language("form");
    }

    public function index()
    {


        //$multi = $this->googleapi->write('ARTICLE', 'A2:B2', ["Truk Mercedes Benz bersistem Auto Pilot akan hadir di tahun 2020","Mercedes Benz sudah resmi menguji truk Mercedes Benz baru mereka yang dilengkapi dengan sistem autonomous seperti pada mobil konsep F105. Pengujian dilakukan di jalan tol Jerman yang terkenal, Autobahn. Rutenya adalah Denkendorf sampai bandara Stuttgart, lalu kembali lagi ke tempat semula. begitulah lansiran dari autonetmagz."]);

        //$multi = $this->googleapi->read('ARTICLE', 'A2:F2');

        $ids = explode(',', get_cookie('items'));

        if (!empty($ids) && $ids[0] != '') {
            $data['items'] = $this->db->select('*')->from('product')->where_in('id', $ids)->get()->result_array();
        } else {
            $data['items'] = [];
        }



        $data["datasearch"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datasearchor_like"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datawhere"] = array(
            'year' => '',
            'promo' => '',
            'cucigudang' => ''
        );
        $data["getcategory"] = $this->general_model->getcategori(["parent" => 0, "is_brand" => 0]);

        $data["listpromo"] = $this->promo_model->getall();
        $data["newartikel"] = $this->article_model->getnewartikel();
        $data["getbrand"] = $this->general_model->getbrand(null, true);


        $data["slide"] = $this->home_model->gethome("slide");
        $data["headbottomslide"] = $this->home_model->gethome("headbottomslide");
        $data["headrightslide"] = $this->home_model->gethome("headrightslide");
        $data["headleftslide"] = $this->home_model->gethome("headleftslide");
        $data["infolinkhome"] = $this->home_model->getsetting("infolinkhome");
        $data["promobig"] = $this->home_model->gethome("promobig");
        $data["promo"] = $this->home_model->gethome("promo");
        $data["cucigudang"] = $this->home_model->gethome("cucigudang");
        $data["new"] = $this->home_model->gethome("new");
        $data["listproduct"] = $this->c_model->fetch_product(6, 0, $data['datasearch'], $data['datasearchor_like'], $data['datawhere'], true);
        $data['newArrival'] = $this->c_model->newArrival();
        $data["css"] = array(base_url() . 'asset/css/cari_page.css',);

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/landing';
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/input_tag.js", base_url() . 'asset/js/drag_file.js', "/modules/tab/js/tabs.js", base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js", "/modules/home/js/home_datatable.js", "/modules/bulk/js/bulk.js");
            $data["css"] = array(base_url() . 'asset/css/input_tag.css', base_url() . 'asset/css/algolia_autocomplete.css', base_url() . 'asset/css/drag_file.css', base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', base_url() . 'asset/css/table_compare.css', '/modules/home/css/desktop/landpage.css', "/modules/member/css/member.css");
        } else {
            $data['content'] = 'mobile/landing';
            $data["js"] = array(base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/input_tag.js", base_url() . 'asset/js/drag_file.js', "/modules/tab/js/tabs.js", base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js", "/modules/home/js/mobile/home_datatable.js", "/modules/bulk/js/mobile/bulk.js");
            $data["css"] = array(base_url() . 'asset/css/input_tag.css', base_url() . 'asset/css/algolia_autocomplete.css', base_url() . 'asset/css/drag_file.css', base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', base_url() . 'asset/css/table_compare.css', '/modules/home/css/mobile/landpage.css', "/modules/member/css/member.css");
        }

        $this->load->view('front/template_front', $data);
    }

    public function shareComparasion()
    {

        $items = [];
        $emails = $_POST['emails'];

        $users = [];


        foreach ($emails as $key => $value) {
            array_push($users, ['email' => $value]);
        }


        $compare_id = $this->general_model->initCompare();
        $this->member_model->insertUserSharing($users, $compare_id);

        foreach ($_POST['items'] as $key => $value) {
            array_push($items, ['compare_id' => $compare_id, 'item_id' => $value['id']]);
        }

        $this->general_model->insert_item_share($items);

        //sent email to new member
        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $emails;
        $subject = "Trumecs Item Comparasion";

        $sharing_uri = base_url() . 'sharing/' . $compare_id;

        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $sharing_uri);
        if ($emailstatus = true) {
            echo json_encode(['status' => true, 'message' => 'success', 'uri' => $sharing_uri]);
        } else {
            echo json_encode(['status' => false, 'message' => 'failed']);
        }
    }

    public function getProductByCategories()
    {
        $this->db->reset_query();

        $this->load->model("product/product_datatable_model");

        $productDatatableModel = new Product_datatable_model();

        $fetch_data = $productDatatableModel->make_datatables();


        $response = [];

        foreach ($fetch_data as $value) {

            $result = $this->_getDisplayDatatable($value);
            $response[] = $result;
        }

        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $productDatatableModel->get_all_data(),
            "recordsFiltered" => $productDatatableModel->get_filtered_data(),
            "data"  => $response
        ];

        echo json_encode($output);
    }

    private function _getDisplayDatatable($product)
    {

        $ids = [];

        if (isset($_COOKIE['items'])) {
            $ids = explode(',', $_COOKIE['items']);
        }

        $result = array();
        if ($this->agent->is_mobile()) {
            $result = array();
            $result[] = '<a class="td-wrapper f16" style="color:#000;font-family:\'Lato\'" href="' . base_url() . 'product/' . $product["id"] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($product["tittle"]))) . '">' . $product['name'] . ' ' . (str_ireplace($product['name'], "", $product['tittle'])) . '</a><small style="font-family:\'Lato\'">' . $product["nama_kategori"] . '</small>';
            $result[] = '<div class="text-right" style="width:100%">
                            <span class="f16 fbold" style="line-height:18px;display:block;color:#000;font-family:\'Lato\'">Rp ' . number_format($product["price"], 0, ",", ".") . '</span>
                            <div class="clearfix"></div>
                            <small style="display:block;;font-family:\'Lato\'">per ' .  $product["unit"] . '</small>
                        </div>';
            /* if (in_array($product['id'], $ids)) {
                            $result[] = '<span class="f14">'.'<input type="checkbox" class="checkbox checkbox-compare d-inline-block m-a-0" checked name="compare[]" value="' . $product['id'] . '">'.'</span>';
                        } else {
                            $result[] = '<input type="checkbox" class="checkbox checkbox-compare d-inline-block m-a-0" name="compare[]" value="' . $product['id'] . '" />';
                        } */
        } else {
            $result = array();
            $result[] = $product['id'];
            $result[] = '<a style="color:#000" class="text-link td-wrapper" title="' . $product['tittle'] . '" href="' . base_url() . 'product/' . $product["id"] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($product["tittle"]))) . '">' . $product['tittle'] . '</a>';
            $result[] = '<span class="td-wrapper">' . $product['name'] . '</span>';
            $result[] = '<span class="td-wrapper">' . $product['nama_kategori'] . '</span>';
            $result[] = '<span class="td-price">' . 'Rp ' . number_format($product["price"], 0, ",", ".") . '</span>';
            if (in_array($product['id'], $ids)) {
                $result[] = '<span class="f14">' . '<input type="checkbox" class="checkbox checkbox-compare d-inline-block m-a-0" checked name="compare[]" value="' . $product['id'] . '">' . '</span>';
            } else {
                $result[] = '<input type="checkbox" class="checkbox checkbox-compare d-inline-block m-a-0" name="compare[]" value="' . $product['id'] . '">';
            }
        }

        return $result;
    }

    public function deleteRfqSession()
    {
        unset($_COOKIE['items']);
        setcookie("items", "", time() - 3600);
        // redirect('/');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function productCompare()
    {
        $id = $this->input->post('product_id');

        $data = $this->product_model->getproduct($id);

        $attribute = $this->product_model->getattribute($data[0]['id']);

        $data[0]['attributes'] = $attribute;

        $acceptExtenstion = ['jpg', 'jpeg', 'png'];

        $explode = explode('.', $data[0]["img"]);

        $extension = end($explode);

        $imgUrl = "https://www.trumecs.com/timthumb?src=" . "https://www.trumecs.com/public/image/product/" . (in_array($extension, $acceptExtenstion) ? $data[0]["img"] : "../noimage.png");

        $response = [
            '' => '<img src=' . $imgUrl . ' class="img-rounded" style="width: 50px; height: 50px;object-fit: cover">',
            'id' => $data[0]['id'] ?? '-',
            'Nama' => $data[0]['tittle'] ?? '-',
            'Grade' => $data[0]['grade'] ?? '-',
            'Brand' => $data[0]['brand'] ?? '-',
            'Unit' => $data[0]['unit'] ?? '-',
            'PPN' => $data[0]['ppn'] == 0 ? 'include' : 'exclude',
            'Price' => "Rp " . number_format($data[0]['price'], 0, ',', '.'),
        ];

        echo json_encode($response);
    }

    public function homeproduct()
    {

        //$multi = $this->googleapi->write('ARTICLE', 'A2:B2', ["Truk Mercedes Benz bersistem Auto Pilot akan hadir di tahun 2020","Mercedes Benz sudah resmi menguji truk Mercedes Benz baru mereka yang dilengkapi dengan sistem autonomous seperti pada mobil konsep F105. Pengujian dilakukan di jalan tol Jerman yang terkenal, Autobahn. Rutenya adalah Denkendorf sampai bandara Stuttgart, lalu kembali lagi ke tempat semula. begitulah lansiran dari autonetmagz."]);


        //$multi = $this->googleapi->read('ARTICLE', 'A2:F2');


        $data["datasearch"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datasearchor_like"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datawhere"] = array(
            'year' => '',
            'promo' => '',
            'cucigudang' => ''
        );
        $data["getcategory"] = $this->general_model->getcategori("0");
        $data["newartikel"] = $this->article_model->getnewartikel();
        $data["getbrand"] = $this->general_model->getbrand();
        $data["getBrandCategory"] = $this->general_model->getBrandCategory();
        $data["slide"] = $this->home_model->gethome("slide");
        $data["headbottomslide"] = $this->home_model->gethome("headbottomslide");
        $data["headrightslide"] = $this->home_model->gethome("headrightslide");
        $data["headleftslide"] = $this->home_model->gethome("headleftslide");
        $data["infolinkhome"] = $this->home_model->getsetting("infolinkhome");
        $data["promobig"] = $this->home_model->gethome("promobig");
        $data["promo"] = $this->home_model->gethome("promo");
        $data["cucigudang"] = $this->home_model->gethome("cucigudang");
        $data["new"] = $this->home_model->gethome("new");
        $data["listproduct"] = $this->c_model->fetch_product(10, 0, $data['datasearch'], $data['datasearchor_like'], $data['datawhere'], true);

        $data["css"] = array(base_url() . 'asset/css/cari_page.css',);

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view-home';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', "/modules/home/css/desktop/view-home.css");
        } else {
            $data['content'] = 'mobile/view-home';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css', "/modules/home/css/mobile/view-home.css");
        }

        $this->load->view('front/template_front', $data);
    }

    public function used()
    {
        $this->load->model("c/c_model");

        $data["datasearch"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datasearchor_like"] = array(
            'tittle' => '',
            'partnumber' => '',
            'physicnumber' => ''
        );
        $data["datawhere"] = array(
            'year' => '',
            'quality' => '3',
            'promo' => '',
            'cucigudang' => ''
        );

        $data["slide"] = $this->home_model->gethome("slideused");
        $data["headbottomslide"] = $this->home_model->gethome("headbottomslideused");
        $data["headrightslide"] = $this->home_model->gethome("headrightslideused");
        $data["headleftslide"] = $this->home_model->gethome("headleftslideused");
        $data["infolinkhome"] = $this->home_model->getsetting("infolinkhome");
        $data["promobig"] = $this->home_model->gethome("promobigused");
        $data["promo"] = $this->home_model->gethome("promoused");
        $data["cucigudang"] = $this->home_model->gethome("cucigudang");
        $data["new"] = $this->home_model->gethome("newused");
        $data["listproduct"] = $this->c_model->fetch_product(6, 0, $data['datasearch'], $data['datasearchor_like'], $data['datawhere'], true);

        $data["css"] = array(base_url() . 'asset/css/cari_page.css',);

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'view_used';
        } else {
            $data['content'] = 'view_used_mobile';
            $data["js"] = array(base_url() . 'asset/js/slick/slick.min.js', "/modules/home/js/homemobile.js", base_url() . "asset/js/trumecs.effect.js");
            $data["css"] = array(base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css');
        }

        $this->load->view('front/template_front', $data);
    }

    public function landingpage()
    {
        $this->load->view('landpage');
    }

    public function notfound404()
    {
        $data['content'] = 'notfound404';
        $this->load->view('front/template_front', $data);
    }

    public function sendwa()
    {
        $company = $this->input->post('company');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $needs = $this->input->post('needs');
        $message = "Hi Trumecs, saya dari $company. Perusahaan saya membutuhkan $needs. Tolong hubungi saya melalui $phone atau $email";

        redirect('https://api.whatsapp.com/send/?phone=6285176912338&type=phone_number&app_absent=0&text=' . $message);
        /* http://api.whatsapp.com/send/?phone=087777000966&text&type=phone_number&app_absent=0 */
    }

    public function introduction()
    {
        /* $this->load->model("product/m_polling");
	    $data['participant'] = array(
                'session_id' => session_id(),
                'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
                'ga' => $this->input->cookie('_ga'),
                'id_polling' => 8,
                'created' => time()
            );
        if($this->m_polling->check_session($data)){
            $this->m_polling->saveanswer($data);
        } */

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/introduction';
        } else {
            $data['content'] = 'mobile/introduction';
        }
        $this->load->view('front/template_front', $data);
    }

    public function vcard($name)
    {
        $vcard = $this->home_model->getvcard($name);
        $this->home_model->hitvcard($vcard->row()->id);
        $data["vcard"] = $vcard;
        if ($name == "trumecs-contact") {
            $this->load->view('vcard-trumecs', $data);
        } else {
            $this->load->view('vcard', $data);
        }
    }
}
