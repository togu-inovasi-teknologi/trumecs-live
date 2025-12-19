<?php
defined('BASEPATH') or exit('No direct script access allowed');

class etx_product extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function getnamecategori($value)
    {
        $this->db->where("id", $value)
            ->select("name")
            ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getidcategori($value)
    {
        $this->db->where("name", $value)
            ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function updatecategory($where, $set)
    {
        $this->db->where($where)->set($set)->update("categori");
    }
    public function addcategory($set)
    {
        $this->db->set($set)->insert("categori");
    }
    public function deletecategory($where)
    {
        $this->db->where($where)->delete("categori");
    }

    public function record_count($datasearch, $datasearchor_like, $datawhere)
    {


        if (!empty($datawhere["brand"])) {
            $this->db->where('brand', $datawhere["brand"]);
        }
        if (!empty($datawhere["type"])) {
            $this->db->where('type', $datawhere["type"]);
        }
        if (!empty($datawhere["component"])) {
            $this->db->where("component", $datawhere["component"]);
        }
        if (!empty($datawhere["year"])) {
            $this->db->where("year", $datawhere["year"]);
        }
        if (!empty($datawhere["promo"])) {
            $this->db->where("promo", $datawhere["promo"]);
        }
        if (!empty($datawhere["status"])) {
            $this->db->where("status", $datawhere["status"]);
        }

        if (!empty($datasearch["minp"]) and !empty($datasearch["maxp"]) and ($datasearch["minp"] != "")) {
            $minp = ($datasearch["minp"] == "0") ? 1 : $datasearch["minp"];
            $this->db->where("price BETWEEN " . $minp . " AND " . $datasearch["maxp"]);
        }



        if (!empty($datasearchor_like["tittle"])) {
            $this->db->like("tittle", $datasearchor_like["tittle"]);
            $this->db->or_like("partnumber", $datasearchor_like["partnumber"]);
            $this->db->or_like("physicnumber", $datasearchor_like["physicnumber"]);
        }

        $query = $this->db
            ->from("product");
        return $query->get()->num_rows();
    }
    public function fetch_product($limit, $start, $datasearch, $datasearchor_like, $datawhere, $iduser = null)
    {

        if ($iduser != null) {
            $this->db->where('created_by', $iduser);
        }

        if (!empty($datawhere["brand"])) {
            $this->db->where('brand', $datawhere["brand"]);
        }
        if (!empty($datawhere["type"])) {
            $this->db->where('type', $datawhere["type"]);
        }
        if (!empty($datawhere["component"])) {
            $this->db->where("component", $datawhere["component"]);
        }
        if (!empty($datawhere["year"])) {
            $this->db->where("year", $datawhere["year"]);
        }
        if (!empty($datawhere["promo"])) {
            $this->db->where("promo", $datawhere["promo"]);
        }
        if (!empty($datawhere["status"])) {
            $this->db->where("status", $datawhere["status"]);
        }

        if (!empty($datasearch["minp"]) and !empty($datasearch["maxp"]) and ($datasearch["minp"] != "")) {
            $minp = ($datasearch["minp"] == "0") ? 1 : $datasearch["minp"];
            $this->db->where("price BETWEEN " . $minp . " AND " . $datasearch["maxp"] . "");
        }

        if (!empty($datasearchor_like["tittle"])) {
            $this->db->like("tittle", $datasearchor_like["tittle"]);
            $this->db->or_like("partnumber", $datasearchor_like["partnumber"]);
            $this->db->or_like("physicnumber", $datasearchor_like["physicnumber"]);
        }


        $this->db->limit($limit, $start)
            ->order_by("id", "DESC");
        $query = $this->db->get("product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = (array) $row;
            }
            return  $data;
        }
        return false;
    }

    public function getproduct($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("product");
        $returnproduct = $query1->result_array();

        $whereid = $where["id"];
        $whereproduct = array('product' => $whereid);
        $this->db->where($whereproduct);
        $galery = $this->db->get("galery");
        $returngalery["galery"] = $galery->result_array();

        $whereid = $where["id"];
        $whereproduct = array('product_id' => $whereid);
        $this->db->where($whereproduct);
        $this->db->join('attribute', 'product_attribute.attribute_id = attribute.id');
        $attribute = $this->db->get("product_attribute");
        $returnattribute["attribute"] = $attribute->result_array();

        $returnall = array_merge($returnproduct[0], $returngalery, $returnattribute);


        return $returnall;
    }
    public function addproduct($data)
    {
        $this->db->set($data)->insert("product");
    }
    public function editproduct($data, $where)
    {
        $this->db->where($where)->set($data)->update("product");
    }
    public function updateproduct($data, $where)
    {
        $this->db->where($where)->set($data)->update("product");
    }

    public function addgalery($data)
    {
        $this->db->set($data)->insert("galery");
    }
    public function hapusgalery($where)
    {
        $this->db->where($where)->delete("galery");
    }

    public function addattribute($data, $id_product)
    {
        $attribute = array();
        if (!empty($data["attribute"])) {
            foreach ($data["attribute"] as $key => $item) {
                if ($data['value'][$key] != ""):
                    $this->db->where('name', $item);
                    $attr = $this->db->get('attribute');

                    if ($attr->num_rows() > 0) {
                        $id_attribute = $attr->row(0)->id;
                    } else {
                        $this->db->insert('attribute', array('name' => $item));
                        $id_attribute = $this->db->insert_id();
                    }
                    $attribute[] = array(
                        'product_id' => $id_product['product_id'],
                        'attribute_id' => $id_attribute,
                        'value' => $data['value'][$key]
                    );
                endif;
            }
            $this->db->where($id_product)->delete("product_attribute");
            $this->db->insert_batch("product_attribute", $attribute);
        }
    }

    public function setcategorygrade($list, $id_category)
    {
        $this->db->where('category_id', $id_category)->delete('category_grade');

        foreach ($list as $key => $item) {
            $this->db->set(array(
                'category_id' => $id_category,
                'grade_id' => $item,
                'created_at' => '',
                'created_by' => ''
            ))->insert("category_grade");
        }
    }
    public function setcategorybrand($list, $id_category)
    {

        $this->db->where('category_id', $id_category)->delete('category_brand');

        foreach ($list as $key => $item) {
            $this->db->set(array(
                'category_id' => $id_category,
                'brand_id' => $item,
                'created_at' => '',
                'created_by' => ''
            ))->insert("category_brand");
        }
    }


    public function setcategoryattribute($list, $id_category)
    {

        $this->db->where('category_id', $id_category)->delete('category_attribute');

        foreach ($list as $key => $item) {
            $this->db->set(array(
                'category_id' => $id_category,
                'attribute_id' => $item
            ))->insert("category_attribute");
        }
    }

    public function getattribute()
    {
        return $this->db->get('attribute')->result();
    }

    public function hapus($where)
    {
        $this->db->where($where)->delete("product");
    }
}
