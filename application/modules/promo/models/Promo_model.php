<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getpromo($value)
    {
        $promo = $this->db->where("url", $value)->from("promo")->get();
        $getpromo = $promo->result_array();
        if (count($getpromo) > 0) {
            $product_ids = $getpromo[0]["product"];
            $promo_type = $getpromo[0]["type"];

            $getselect = $this->fetch_product($product_ids, $promo_type);

            $arrayall = array_merge(array('product' => $getselect), array('promo' => $getpromo));
            return $arrayall;
        }
        return array();
    }

    public function getpromodetail($value)
    {
        $promo = $this->db->where("url", $value)->from("promo")->get();
        $getpromo = $promo->result_array();
        if (count($getpromo) > 0) {
            $product_ids = $getpromo[0]["product"];
            $promo_type = $getpromo[0]["type"];

            $getselect = $this->fetch_product($product_ids, $promo_type);

            $arrayall = array_merge(array('product' => $getselect), array('promo' => $getpromo));
            $this->db->where("url", $value)->set("view", $getpromo[0]['view'] + 1)->update('promo');
            return $arrayall;
        }
        return array();
    }

    public function getpromoproduct()
    {
        $this->db->where('start_date <=', time());
        $this->db->where('end_date >=', time());
        $promo = $this->db->from("promo")->order_by("id", "DESC")->get();
        $promo_list = $promo->result_array();

        foreach ($promo_list as $key => $value) {
            $promo_type = $value['type'];
            $getselect = $this->fetch_product($value['product'], $promo_type);
            $promo_list[$key]['products'] = $getselect;
        }
        return $promo_list;
    }

    public function getall()
    {
        $this->db->where('start_date <=', time());
        $this->db->where('end_date >=', time());
        $promo = $this->db->from("promo")->order_by("id", "DESC")->get();
        $promo_list = $promo->result_array();

        foreach ($promo_list as $key => $value) {
            $this->db->limit(($this->agent->is_mobile() ? 2 : 4));

            // Pastikan type tidak kosong
            $promo_type = !empty($value['type']) ? $value['type'] : 'promo';

            $getselect = $this->fetch_product($value['product'], $promo_type);
            shuffle($getselect);

            $promo_list[$key]['products'] = $getselect;
            $promo_list[$key]['promo_type'] = $promo_type; // Simpan type juga di level promo
        }
        return $promo_list;
    }

    public function fetch_product($product_ids, $promo_type = '')
    {
        if (empty($product_ids)) {
            return array();
        }

        $ids = explode(",", $product_ids);
        $ids = array_filter($ids);

        if (empty($ids)) {
            return array();
        }

        $this->db->where_in("id", $ids);
        $query = $this->db->get("product");
        $products = $query->result_array();

        // Pastikan $promo_type tidak kosong
        $type_to_set = !empty($promo_type) ? $promo_type : 'promo';

        // Tambahkan type ke setiap produk
        foreach ($products as &$product) {
            $product['type'] = $type_to_set;
        }

        // Urutkan produk berdasarkan urutan ID
        $sorted = array();
        foreach ($ids as $id) {
            foreach ($products as $prod) {
                if ($prod['id'] == $id) {
                    $sorted[] = $prod;
                    break;
                }
            }
        }

        return $sorted;
    }

    public function get_category()
    {
        $this->db->where('parent', '0');
        $data = $this->db->get('categori');
        return $data;
    }

    public function get_query($string)
    {
        $string = explode(" ", $string);

        $this->db->select('id');
        foreach ($string as $item) :
            $this->db->or_like("name", $item, "both");
        endforeach;

        $data = $this->db->get('categori');

        $children = [];
        foreach ($data->result() as $item) :
            $sub_children = $this->get_sub_category($item->id);
            $children = array_merge($children, $sub_children);
        endforeach;

        return $children;
    }

    public function add_sph($data)
    {
        $this->db->set('name', $data['name']);
        $this->db->set('company', $data['company']);
        $this->db->set('companyex', $data['number']);
        $this->db->set('address', $data['location']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('date', date("Y-m-d H:i:s"));
        $this->db->set('email', session_id());
        $this->db->set('messageconntent', $data['type']);
        $this->db->insert('quotation');
    }
}
