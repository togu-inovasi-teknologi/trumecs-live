<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("category/category_model");
        $this->load->model("general/general_model");
        $this->load->language("home");
    }

    public function index($mainCategoriesId = null)
    {
        $ids = explode(',', get_cookie('items'));

        if (!empty($ids) && $ids[0] != '') {
            $data['items'] = $this->db->select('*')->from('product')->where_in('id', $ids)->get()->result_array();
        } else {
            $data['items'] = [];
        }
        $categories = $this->general_model->getcategori(['parent' => 0, 'id' => $mainCategoriesId]);
        $data['subCategories'] = $this->general_model->getcategori(['parent' => $mainCategoriesId]);
        $data['brand'] = $this->general_model->getbrand($mainCategoriesId);
        $data['categories'] = $categories[0];

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/main';
            $data["js"] = ["/modules/category/js/desktop/main-datatable.js", base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/input_tag.js", base_url() . 'asset/js/drag_file.js', "/modules/tab/js/tabs.js", base_url() . 'asset/js/slick/slick.min.js',"https://cdn.datatables.net/v/dt/dt-2.1.5/datatables.min.js"];
            $data["css"] = ["/modules/category/css/desktop/main.css", base_url() . 'asset/css/table_compare.css', base_url() . 'asset/css/input_tag.css', base_url() . 'asset/css/algolia_autocomplete.css', base_url() . 'asset/css/drag_file.css', base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css',"https://cdn.datatables.net/v/dt/dt-2.1.5/datatables.min.css"];
        } else {
            $data['content'] = 'mobile/main';
            $data["js"] = ["/modules/category/js/mobile/main-datatable.js", base_url() . "asset/js/validator/validator.js", base_url() . "asset/js/input_tag.js", base_url() . 'asset/js/drag_file.js', "/modules/tab/js/tabs.js", base_url() . 'asset/js/slick/slick.min.js',"https://cdn.datatables.net/v/dt/dt-2.1.5/datatables.min.js"];
            $data["css"] = ["/modules/category/css/mobile/main.css", base_url() . 'asset/css/table_compare.css', base_url() . 'asset/css/input_tag.css', base_url() . 'asset/css/algolia_autocomplete.css', base_url() . 'asset/css/drag_file.css', base_url() . 'asset/js/slick/slick.scss', base_url() . 'asset/css/cari_page.css',"https://cdn.datatables.net/v/dt/dt-2.1.5/datatables.min.css"];
        }

        $this->load->view('front/template_front1', $data);
    }


    public function get_brands()
    {
        $keyword = $this->input->post('keyword');
        $categoryModel = $this->category_model->brands_search($keyword);

        echo json_encode($categoryModel);
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

    public function deleteRfqSession()
    {
        unset($_COOKIE['items']);
        setcookie("items", "", time() - 3600);
        redirect('/');
    }
}