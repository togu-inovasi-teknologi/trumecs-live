<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getproduct($url)
    {
        $this->db->select('product.*,grade.grade as grade, categori.name as brand, store.name as store_name, store.domain as store_domain, store.logo as store_logo, delivery_area.send_from, delivery_area.description AS area_description, product.brand as brand_id');
        $this->db->join('delivery_area', 'product.area = delivery_area.id', 'left');
        $this->db->join('store', 'store.id = product.store_id', 'left');
        $this->db->join('grade', 'grade.id = product.quality', 'left');
        $this->db->join('categori', 'categori.id = product.brand', 'left');
        if (is_numeric($url)) {
            $query = $this->db->where("product.id", $url)->get('product');
        } else {
            $query = $this->db->where("product.id", $url)->get('product');
        }
        $return = $query->result_array();
        if (count($query->result_array()) == 0) {
            $this->db->select('product.*,grade.grade as grade, categori.name as brand, store.name as store_name, store.domain as store_domain, store.logo as store_logo, delivery_area.send_from, delivery_area.description AS area_description');
            $this->db->join('delivery_area', 'product.area = delivery_area.id', 'left');
            $this->db->join('store', 'store.id = product.store_id', 'left');
            $this->db->join('grade', 'grade.id = product.quality', 'left');
            $this->db->join('categori', 'categori.id = product.brand', 'left');
            $query = $this->db->where("product.id", "12")->get('product');
            $return = $query->result_array();
        }

        $attribute = $this->db->select('*')
            ->from('product_attribute pa')
            ->join('attribute a', 'a.id = pa.attribute_id')
            ->join('product p', 'p.id = pa.product_id')
            ->where('pa.product_id', $return[0]['id'])
            ->get()
            ->result_array();

        $return[0]['attribute'] = $attribute;

        return $return;
    }
    public function getgalery($value)
    {
        $query = $this->db->where("product", $value)->get('galery');
        return $query->result_array();
    }

    public function getattribute($value)
    {
        $this->db->join('attribute', 'product_attribute.attribute_id = attribute.id');
        $query = $this->db->where("product_id", $value)->get('product_attribute');
        return $query->result_array();
    }



    public function getsameproduct($value, $id,  $limit = 10, $brand_id = null)
    {
        $this->db->limit($limit)
            ->from("product");

        if ($brand_id == null):
            $array = array();
            $asb = '';
            $akhir = count($value) - 1;


            foreach ($value as $key => $v) {
                /*!empty($key)?
            $this->db->or_like_in("tittle",$key) : "";*/
                $ses = $this->db->escape_str(preg_replace("/[^A-Za-z0-9 ]/", '', $v));
                $asb .= " or tittle LIKE '%" . $ses . "%'";
            }

            $string_query = "";
            $sql_query = "";
            foreach ($value as $q) {
                $q = $this->db->escape_str(preg_replace("/[^A-Za-z0-9 ]/", '', $q));
                if ($q != '') {
                    $string_query .= ", " . $q . "";
                    $sql_query .= "+ MATCH(`tittle`, `description`) AGAINST('" . $q . "*' IN BOOLEAN MODE) ";
                }
            }

            $this->db->select("*, product.id AS id, product.img AS img, SUM(MATCH(`tittle`, `description`) AGAINST('" . implode(" ", $this->db->escape_str(preg_replace("/[^A-Za-z0-9 ]/", ' ', $value))) . "') " . $sql_query . ")  AS score");
            $this->db->order_by("score", "DESC");
            $this->db->where("( product.id = '' " . $asb . ") AND status='show'");
        else:
            $this->db->select("product.*, categori.name AS brand_name, grade.grade AS grade_name");
            $this->db->where("brand", $brand_id);
            $this->db->where("status", "show");
            $this->db->order_by("product.id", RAND());
        endif;

        $this->db->join('grade', 'grade.id = product.quality', 'left');
        $this->db->join('categori', 'categori.id = product.brand', 'left');
        $this->db->group_by('product.id');
        $this->db->where_not_in("product.id", $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdiscussion($id_product)
    {
        $this->db->from("discussion");
        $this->db->select("*, discussion.id AS id");
        $this->db->join('member', 'member.id = discussion.member_id');
        $this->db->where('product_id', $id_product);
        $this->db->where('is_removed', '0');
        $this->db->where('parent_id', '0');
        $this->db->order_by('discussion.id', 'desc');
        $query = $this->db->get()->result_array();

        foreach ($query as $key => $item) :
            $this->db->from("discussion");
            $this->db->select("*, COUNT(discussion.id) AS reply_count", false);
            $this->db->join('member', 'member.id = discussion.member_id');
            $this->db->where('parent_id', $item['id']);
            $this->db->where('is_removed', '0');
            $this->db->order_by('discussion.id', 'asc');
            $this->db->group_by('parent_id');
            $query_reply = $this->db->get()->result_array();

            if (count($query_reply) > 0) {
                $query[$key]['reply'] = $query_reply;
            }
        endforeach;

        return $query;
    }
}
