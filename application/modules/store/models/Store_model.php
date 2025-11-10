<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_model extends CI_Model
{
    public $id, $name, $domain, $npwp, $email, $phone, $mailing_address, $mailing_pic, $mailing_position, $mailing_phone, $mailing_city, $mailing_province, $mailing_zipcode, $mailing_country, $description_id, $created_at, $created_by, $verified, $description_en, $description_zh, $logo, $cover, $template, $template_produk, $cover_mobile, $title_cover, $title_cover_mobile, $color_title_cover, $color_title_cover_mobile, $title_content, $title_content_mobile, $color_title_content, $color_title_content_mobile, $title_image, $title_image_mobile, $col_left, $col_right, $direction_title_image, $direction_title_image_mobile;
    public $countAllProduct = 0;
    public $all_products = [];
    public $categories = [];
    public $banners = [];
    public $styles = [];
    public $descriptions = [];



    // products
    public $orderPrice;
    public $orderId;
    public $page = 1;
    public $perPage = 16;
    public $offset = 0;
    public $totalPage = 1;
    public $products;
    public $category;
    public $new_arrival;


    // paginate
    public $paginations;



    function __construct($store = [])
    {
        if (!empty($store)) {
            $this->_get($store);
        }
        $this->load->model('category/Category_model');
        $this->load->model('product/Product_model');
        $this->load->model('store/Store_banner_model');
        $this->load->model('store/Store_style_model');
        $this->load->model('store/Store_description_model');
        parent::__construct();
    }


    private function _set($data = [])
    {

        if (array_key_exists('id', $data))
            $this->id = (int) $data['id'];
        if (array_key_exists('name', $data))
            $this->name = $data['name'];
        if (array_key_exists('domain', $data))
            $this->domain = $data['domain'];
        if (array_key_exists('npwp', $data))
            $this->npwp = $data['npwp'];
        if (array_key_exists('email', $data))
            $this->email = $data['email'];
        if (array_key_exists('phone', $data))
            $this->phone = $data['phone'];
        if (array_key_exists('mailing_address', $data))
            $this->mailing_address = $data['mailing_address'];
        if (array_key_exists('mailing_pic', $data))
            $this->mailing_pic = $data['mailing_pic'];
        if (array_key_exists('mailing_position', $data))
            $this->mailing_position = $data['mailing_position'];
        if (array_key_exists('mailing_phone', $data))
            $this->mailing_phone = $data['mailing_phone'];
        if (array_key_exists('mailing_city', $data))
            $this->mailing_city = (int) $data['mailing_city'];
        if (array_key_exists('mailing_province', $data))
            $this->mailing_province = (int) $data['mailing_province'];
        if (array_key_exists('mailing_zipcode', $data))
            $this->mailing_zipcode = $data['mailing_zipcode'];
        if (array_key_exists('mailing_country', $data))
            $this->mailing_country = (int) $data['mailing_country'];
        if (array_key_exists('description_id', $data))
            $this->description_id = $data['description_id'];
        if (array_key_exists('created_at', $data))
            $this->created_at = (int) $data['created_at'];
        if (array_key_exists('created_by', $data))
            $this->created_by = (int) $data['created_by'];
        if (array_key_exists('verified', $data))
            $this->verified = (int) $data['verified'];
        if (array_key_exists('description_en', $data))
            $this->description_en = $data['description_en'];
        if (array_key_exists('description_zh', $data))
            $this->description_zh = $data['description_zh'];
        if (array_key_exists('logo', $data))
            $this->logo = $data['logo'];
        if (array_key_exists('cover', $data))
            $this->cover = $data['cover'];
        if (array_key_exists('cover_mobile', $data))
            $this->cover_mobile = $data['cover_mobile'];
        if (array_key_exists('template', $data))
            $this->template = $data['template'];
        if (array_key_exists('template_produk', $data))
            $this->template_produk = $data['template_produk'];
        if (array_key_exists('title_cover', $data))
            $this->title_cover = $data['title_cover'];
        if (array_key_exists('title_cover_mobile', $data))
            $this->title_cover_mobile = $data['title_cover_mobile'];
        if (array_key_exists('title_content', $data))
            $this->title_content = $data['title_content'];
        if (array_key_exists('title_content_mobile', $data))
            $this->title_content_mobile = $data['title_content_mobile'];
        if (array_key_exists('color_title_cover', $data))
            $this->color_title_cover = $data['color_title_cover'];
        if (array_key_exists('color_title_cover_mobile', $data))
            $this->color_title_cover_mobile = $data['color_title_cover_mobile'];
        if (array_key_exists('color_title_content', $data))
            $this->color_title_content = $data['color_title_content'];
        if (array_key_exists('color_title_content_mobile', $data))
            $this->color_title_content_mobile = $data['color_title_content_mobile'];
        if (array_key_exists('title_image', $data))
            $this->title_image = $data['title_image'];
        if (array_key_exists('title_image_mobile', $data))
            $this->title_image_mobile = $data['title_image_mobile'];
        if (array_key_exists('col_left', $data))
            $this->col_left = $data['col_left'];
        if (array_key_exists('col_right', $data))
            $this->col_right = $data['col_right'];
        if (array_key_exists('direction_title_image', $data))
            $this->direction_title_image = $data['direction_title_image'];
        if (array_key_exists('direction_title_image_mobile', $data))
            $this->direction_title_image_mobile = $data['direction_title_image_mobile'];

        if (array_key_exists('category', $data))
            $this->category = $data['category'];
        if (array_key_exists('countAllProduct', $data))
            $this->countAllProduct = $data['countAllProduct'];

        if (array_key_exists('banners', $data)) {
            foreach ($data['banners'] as $key => $value) {
                $this->banners[] = $value;
            }
        }
        if (array_key_exists('styles', $data)) {
            foreach ($data['styles'] as $key => $value) {
                $this->styles[] = $value;
            }
        }

        if (array_key_exists('descriptions', $data)) {
            foreach ($data['descriptions'] as $key => $value) {
                $this->descriptions[] = $value;
            }
        }
    }

    private function _query()
    {

        $this->db->select('*');
        $this->db->from('product');


        if (!empty($this->where)) {

            $this->db->where_in('component', $this->where);
        }

        if (!empty($_POST["search"]["value"])) {
            if (!empty($this->where)) {
                $this->db->group_start();
            }
            foreach ($this->select_column as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($value, $_POST["search"]["value"]);
                }
            }
            if (!empty($this->where)) {
                $this->db->group_end();
            }
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }


    public function make_datatables()
    {
        $this->_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_filtered_data()
    {
        $this->_query();
        return $this->db->get()->num_rows();
    }
    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        if (!empty($this->where)) {
            $this->db->where($this->where);
        }
        return $this->db->count_all_results();
    }

    public function _getOriginalAttribute()
    {

        $data = [
            'name' => $this->name,
            'domain' => $this->domain,
            'npwp' => $this->npwp,
            'email' => $this->email,
            'phone' => $this->phone,
            'mailing_address' => $this->mailing_address,
            'mailing_pic' => $this->mailing_pic,
            'mailing_position' => $this->mailing_position,
            'mailing_phone' => $this->mailing_phone,
            'mailing_city' => $this->mailing_city,
            'mailing_province' => $this->mailing_province,
            'mailing_zipcode' => $this->mailing_zipcode,
            'mailing_country' => $this->mailing_country,
            'description_id' => $this->description_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'verified' => $this->verified,
            'description_en' => $this->description_en,
            'description_zh' => $this->description_zh,
            'logo' => $this->logo,
            'cover' => $this->cover,
            'cover_mobile' => $this->cover_mobile,
            'template' => $this->template,
            'title_cover' => $this->title_cover,
            'title_content' => $this->title_content,
            'title_image' => $this->title_image,
            'title_image_mobile' => $this->title_image_mobile,
            'col_left' => $this->col_left,
            'col_right' => $this->col_right,
            'direction_title_image' => $this->direction_title_image,
        ];

        if ($this->id != null) {
            array_push($data, ['id' => $this->id]);
        }
    }

    private function _get($where)
    {
        $data = $this->db->get_where('store', $where)->row_array();
        if ($data != null) {
            $data['countAllProduct'] = $this->db->select('count(id) as count')->from("product")->where('store_id', $data['id'])->get()->row()->count;


            $banners = $this->db->select('*')->from('store_banner')->where('store_id', $data['id'])->get()->result();
            $bannersData = [];
            foreach ($banners as $key => $value) {
                $bannersData[] = new Store_banner_model(['id' => $value->id]);
            };
            $styles = $this->db->select('*')->from('store_style')->where('store_id', $data['id'])->get()->result();
            $stylesData = [];
            foreach ($styles as $key => $value) {
                $stylesData[] = new Store_style_model(['id' => $value->id]);
            };

            $descriptions = $this->db->select('*')->from('store_description')->where('store_id', $data['id'])->order_by('index', 'ASC')->get()->result();
            $descriptionsData = [];
            foreach ($descriptions as $key => $value) {
                $descriptionsData[] = new Store_description_model(['id' => $value->id]);
            };
            $data['banners'] = $bannersData;
            $data['descriptions'] = $descriptionsData;
            $data['styles'] = $stylesData;
            $this->_set($data);
        }

        // $this->countAllProduct = $this->db->select('count(id) as count')->from("product")->where('store_id', $this->id)->get()->row()->count;

    }

    public function insertIfNotExist()
    {
        if ($this->id != null) {
            return $this->id;
        } else {
            $this->db->insert('store', $this->_getOriginalAttribute());
            $this->id = $this->db->insert_id();
            return $this->id;
        }
    }


    public function new_arrival()
    {

        $this->new_arrival = $this->db->select('*')
            ->from('product p')
            ->where('p.store_id =', $this->id)
            ->order_by('p.id', 'desc')
            ->limit(10)
            ->get()->result_array();
    }

    public function productCategories($limit = null)
    {
        $categories = $this->db->select('*')->from('categori')->where(['parent' => '0'])->get()->result_array();

        foreach ($categories as $key => $value) {

            $categori = new Category_model($value);
            $categori->storeId = $this->id;
            $categori->products($limit);
            array_push($this->categories, $categori);
        }
    }


    public function products()
    {

        if ($this->category == null) {
            $this->db->select('*');
            $this->db->from('product');
            $this->db->where('store_id', $this->id);

            if ($this->orderPrice != null) {
                $this->db->order_by('price', $this->orderPrice);
            } else if ($this->orderId != null) {
                $this->db->order_by('id', $this->orderId);
            }

            $this->db->limit(16);
            $this->db->offset($this->offset);
            $result = $this->db->get();

            $this->products = $result->result_array();
        } else {

            $category = new Category_model(['id' => $this->category->id]);
            $category->storeId = $this->id;

            if ($this->orderPrice != null) {
                $category->orderPrice = $this->orderPrice;
            } else if ($this->orderId != null) {
                $category->orderId = $this->orderId;
            }

            $category->products(16, $this->offset);


            $this->products = $category->products;

            $this->countAllProduct = $category->total;
        }



        $this->_paginate();
    }

    public function countAllProduct()
    {
        $this->db->where('store_id', $this->id);
        $this->db->from('product');
        return $this->db->count_all_results();
    }


    public function _paginate()
    {


        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $actual_link = preg_replace("/&per_page\=[0-9]+/", "", $actual_link);
        $config['base_url'] = $actual_link;
        $config['total_rows'] = $this->countAllProduct;
        $config['per_page'] = $this->perPage;
        $config["uri_segment"] = $_GET['per_page'] ?? 16;
        $config["cur_tag_open"] = '<div class="btn btnnewwhite btn-disable">';
        $config["cur_tag_close"] = '</div>';
        $config["first_tag_open"] = '<div class="pull-left">';
        $config["first_tag_close"] = '</div>';
        $config["last_tag_open"] = '<div class="pull-right">';
        $config["last_tag_close"] = '</div>';
        $config['attributes'] = array('class' => 'btn btnnew link search-pagination');
        $config['enable_query_strings'] = true;
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);
        $this->paginations = $this->pagination->create_links();
    }

    public function insert_banner($data)
    {
        $this->db->insert("store_banner", $data);
    }
    public function update_banner($id, $index, $isMobile, $update)
    {
        $this->db->where([
            'id' => $id,
            'index' => $index,
            'is_mobile' => $isMobile
        ])
            ->set($update)
            ->update("store_banner");
    }


    function banner_exists($value)
    {
        $this->db->where('source', $value);
        $query = $this->db->get('store_banner');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_banner($source)
    {
        $this->db->delete('store_banner', array('source' => $source));
    }

    public function edit_store($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('store', $data);
    }
}
