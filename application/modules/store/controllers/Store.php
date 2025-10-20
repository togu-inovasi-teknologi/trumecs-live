<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends MX_Controller
{
    public $storeName;
    public $storeModel;
    public $domain;

    public function __construct()
    {
        parent::__construct();

        // var_dump($this->router->routes);
        // die;

        // $route[':any/products'] = 'store/products';

        $this->load->model("Store_model");

        if ($this->uri->segment(1) != 'timthumb') {
            $this->domain = $this->uri->segment(1);
            $this->storeModel = new Store_model(['domain' => $this->domain]);

            if ($this->storeModel->id == null) {
                redirect(base_url());
            }
        }
    }

    public function index()
    {
        if ($this->uri->segment(1) == 'trumecs-bazaar') {
            $this->load->model("product/m_polling");
            $data['participant'] = array(
                'session_id' => session_id(),
                //'email' => $post['email'],
                //'phone' => $post['phone'],
                //'feedback' => $post['feedback'],
                'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
                'ga' => $this->input->cookie('_ga'),
                'id_polling' => 9,
                'created' => time()
            );
            //$data['id_polling'] = 1;
            //$data['answer'] = $post['answer'];
            if ($this->m_polling->check_session($data)) {
                $this->m_polling->saveanswer($data);
            }
        }
        $this->storeModel->productCategories();
        $data["css"] = array("/modules/store/css/store-view.css");
        $data["js"] = array("/modules/store/js/store-view.js");
        $data['tabs'] = [
            '<a class="nav-link font-weight-bold active" href="' . base_url($this->domain) . '">Informasi</a>',
            '<a class="nav-link font-weight-bold" href="' . base_url($this->domain . '/products') . '">Produk</a>',
        ];
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view_store';
            $data['tabContent'] = 'desktop/view_store_information';
            $data['navbar'] = 'desktop/navbar_store';
        } else {
            $data['navbar'] = 'mobile/navbar_store';
            $data['content'] = 'mobile/view_store';
            $data['tabContent'] = 'mobile/view_store_information';
        }
        $this->load->view('front/template_front', $data);
    }


    public function products()
    {

        // $url = current_url();

        // if($this->input->get('category') != null){
        //     $url .= '?category=' . $this->input->get('category') . '&';
        // }else{
        //     $url .= '?';
        // }


        // if(($this->input->get('order') && !empty($this->input->get('order')))){

        //     if($this->input->get('order') == 'new_desc'){

        //         $url .= 'product_new=desc';

        //     }else if($this->input->get('order') == 'price_asc'){
        //         $url .='price=asc';
        //     }else if($this->input->get('order') == 'price_desc'){
        //         $url .= 'price=desc';
        //     }


        // }else if($this->input->get('product_new') && !empty($this->input->get('product_new'))){
        //     $url .= 'product_new=' . $this->input->get('product_new');
        // }else if($this->input->get('price') && !empty($this->input->get('price'))){
        //     $url .= 'price=' . $this->input->get('price');
        // }

        //    redirect($url);


        $this->load->model('category/Category_model');

        $this->storeModel->productCategories(null);

        $categoryName = $this->input->get('category');

        if ($this->input->get('price') != null) {
            $this->storeModel->orderPrice = $this->input->get('price');
        } else if ($this->input->get('new') != null) {
            $this->storeModel->orderId = $this->input->get('new');
        }



        if ($categoryName != null) {
            $this->storeModel->category = new Category_model(['name' => $categoryName]);
        }

        $this->storeModel->offset = $this->input->get('per_page') ?? 0;
        $this->storeModel->page = ($this->input->get('per_page') ?? $this->storeModel->perPage) / $this->storeModel->perPage;



        $this->storeModel->products();

        $data["css"] = array("/modules/store/css/store-view.css");
        // $data["js"] = array("/modules/store/js/store-products.js");

        $data['tabs'] = [
            '<a class="nav-link font-weight-bold" href="' . base_url($this->domain) . '">Informasi</a>',
            '<a class="nav-link font-weight-bold active" href="' . base_url($this->domain . '/products') . '">Produk</a>',

        ];

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/view_store';
            $data['tabContent'] = 'desktop/view_store_product';
        } else {
            $data['content'] = 'mobile/view_store';
            $data['tabContent'] = 'mobile/view_store_product';
        }



        // $data['order_price'] =  isset($_GET['category']) ? isset($_GET['price']) && $_GET['price'] == 'asc' ? '&price=desc' :'&price=asc' : '?price=asc';
        $data['order_price'] = (isset($_GET['category']) ? '&' : '?') . (isset($_GET['price']) && $_GET['price'] == 'asc' ? 'price=desc' : 'price=asc');
        $data['order_new'] = (isset($_GET['category']) ? '&' : '?') . (isset($_GET['new']) && $_GET['new'] == 'asc' ? 'new=desc' : 'new=asc');;

        $data['current_url'] = current_url() . (isset($_GET['category']) ? '?category=' . $_GET['category'] : '');

        $this->load->view('front/template_front', $data);
    }
    public function getProducts()
    {

        // $this->storeModel->fetchInfo();

        $categoriId = $_GET['category_id'];


        if ($categoriId != 0) {
            $this->storeModel->category = new Category_model(['id' => $categoriId, 'store_id' => $this->storeModel->id]);
        }

        if (isset($_GET['new'])) {
            $this->storeModel->orderId = $_GET['new'];
        } else if (isset($_GET['price'])) {
            $this->storeModel->orderPrice = $_GET['price'];
        }

        $this->storeModel->page = $_GET['page'];
        $this->storeModel->products();

        // $categories = $this->db->select('*')->from('categori')->where('id', $categoriId)->where('parent', '0')->get()->result_array();

        // $categori->products(10);

        echo json_encode($this->storeModel->products);
    }

    public function getProductByStore()
    {
        $this->db->reset_query();


        $fetch_data = $this->storeModel->make_datatables();
        $response = [];

        foreach ($fetch_data as $value) {

            $result = $this->_getDisplayDatatable($value);
            $response[] = $result;
        }

        $output = [
            "draw" =>  $_POST["draw"],
            "recordsTotal" =>  $this->storeModel->get_all_data(),
            "recordsFiltered" => $this->storeModel->get_filtered_data(),
            "data"  => $response
        ];

        echo json_encode($output);
    }

    private function _getDisplayDatatable($product)
    {

        // $result = array();
        // if ($this->agent->is_mobile()) {
        //     $result[] = '<img class="img-rounded" style="width: 50px;height: 50px;" src="http://trumecs.com/timthumb?src=http://trumecs.com/public/image/product/' . $product["img"] . '">';
        //     $result[] = '<div>
        //                     <span class="f12 text-muted">' . $product['name'] . '</span>
        //                     <div><a href="' . base_url() . 'product/' . $product["id"] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($product["tittle"]))) . '">' . $product['tittle'] . '</a></div>
        //                     <span class="fbold forange">Rp ' . number_format($product["price"], 0, ",", ".") . '</span>
        //                 </div>';
        //     $result[] = '<input type="checkbox" class="checkbox checkbox-compare" name="compare[]" value="' . $product['id'] . '">';
        // } else {
        $result = array();
        $result[] = $product['id'];
        // $result[] = '<a class="text-link" href="' . base_url() . 'product/' . $product["id"] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($product["tittle"]))) . '">' . $product['tittle'] . '</a>';
        // $result[] = $product['name'];
        // $result[] = $product['grade'];
        // $result[] = 'Rp ' . number_format($product["price"], 0, ",", ".");
        // if (in_array($product['id'], $ids)) {
        //     $result[] = '<input type="checkbox" class="checkbox checkbox-compare d-inline-block" checked name="compare[]" value="' . $product['id'] . '">';
        // } else {
        //     $result[] = '<input type="checkbox" class="checkbox checkbox-compare d-inline-block" name="compare[]" value="' . $product['id'] . '">';
        // }
        // }

        return $result;
    }
}
