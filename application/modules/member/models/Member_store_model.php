<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_store_model extends CI_Model
{

    var $table = "product";
    var $select_column = array('p.id', 'p.tittle', 'price', 'unit', 'stock', 'status', 'img');
    var $order_column = array('p.id', 'p.tittle', 'price', 'unit', 'stock', 'status');

    var $store_id = [];

    function __construct()
    {
        if (isset($_POST['store_id'])) {
            $this->store_id = $_POST['store_id'];
        }
        parent::__construct();
    }

    public function _set($data)
    {
        $data = (array)$data;
    }

    public function _get($data)
    {
        $data = $this->db->get_where($this->table, $data)->result_array();
    }

    private function _query()
    {

        $this->db->select($this->select_column);
        $this->db->from($this->table . ' p');
        $this->db->order_by('p.id', 'desc');
        $this->db->join('grade g', 'g.id = p.quality', 'left');

        if (!empty($this->store_id)) {
            $this->db->where('p.store_id', $this->store_id);
        }


        if (!empty($_POST["search"]["value"])) {
            if (!empty($this->store_id)) {
                $this->db->group_start();
            }
            foreach ($this->select_column as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($value, $_POST["search"]["value"]);
                }
            }
            if (!empty($this->store_id)) {
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
        $this->db->from($this->table . ' p');
        if (!empty($this->store_id)) {
            $this->db->where('p.store_id', $this->store_id);
        }
        return $this->db->count_all_results();
    }
    public function getProduct($id)
    {
        $query = $this->db->select('*');
        $query = $this->db->from("product");
        $query = $this->db->where('store_id', $id);
        $query = $this->db->get();
        $product = $query->result_array();
        $galery = $this->db->where('product', $id);
        $galery = $this->db->from("galery");
        $galery = $this->db->get();
        $returngalery["galery"] = $galery->result_array();
        $all = array_merge($product, $returngalery);
        return $product;
    }

    public function checkstore($id)
    {
        $this->db->reset_query();

        $this->db->select('store.*,store_member.*, store.id as id, provinces.name as nama_province, regencies.name as nama_city');
        $this->db->from("store");
        $this->db->join('store_member', 'store_member.store_id = store.id');
        $this->db->join("provinces", "provinces.id=store.mailing_province", 'left');
        $this->db->join("regencies", "regencies.id=store.mailing_city", 'left');
        $this->db->where('store_member.member_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }
        $store = $query->result_array();
        return $store;
    }
    public function checkCategori($id)
    {
        $this->db->select('*');
        $this->db->from("categori");
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }
        $store = $query->result_array();
        return $store;
    }

    public function getstore($id)
    {
        $this->db->select('store.*, provinces.name as nama_province, regencies.name as nama_city');
        $this->db->from("store");
        $this->db->join('store_member', 'store_member.store_id = store.id');
        $this->db->join("provinces", "provinces.id=store.mailing_province", 'left');
        $this->db->join("regencies", "regencies.id=store.mailing_city", 'left');
        $this->db->where($id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }
        $store = $query->result_array();
        return $store;
    }

    public function insertstore($data)
    {
        $this->db->insert("store", $data);
    }

    public function edit_store($id, $data)
    {
        $this->db->where($id)
            ->update("store", $data);
    }

    public function insert_product($data)
    {
        $this->db->insert("product", $data);
    }
    public function insertGaleryProduct($data)
    {
        $this->db->insert("galery", $data);
    }
    public function insertAttributeProduct($data)
    {
        $this->db->insert("product_attribute", $data);
    }

    public function addattribute_barang($data, $id_product)
    {
        $attribute = [];
        if (!empty($data["attribute"])) {
            foreach ($data["attribute"] as $key => $item) {
                if ($data['value'][$key] != "") :
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

    public function editProduct($id, $data)
    {
        $this->db->where('id', $id)
            ->update("product", $data);
    }
    public function update($where, $update)
    {
        $this->db->where($where)
            ->set($update)
            ->update("store");
    }
    public function deleteProduct($where)
    {
        $this->db->where('id', $where)
            ->delete('product');
    }

    function cover_exists($value)
    {
        $this->db->where('cover', $value);
        $query = $this->db->get('store');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function cover_mobile_exists($value)
    {
        $this->db->where('cover_mobile', $value);
        $query = $this->db->get('store');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
