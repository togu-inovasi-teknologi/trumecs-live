<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public $id, $name, $url, $parent, $etc, $img, $name_en, $url_en, $name_ch, $url_ch, $is_brand;
    public $storeId;
    public $products = [];
    public $total = 0;


    public $topParent;
    public $brands = [];


    // products
    public $orderPrice;
    public $orderId;

    public function __construct($categoryWhere = [])
    {

        if (!empty($categoryWhere)) {
            $category = $this->db->get_where('categori', $categoryWhere)->row_array();

            $this->_set($category);
        }
        parent::__construct();
    }

    private function _set($data = [])
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];

            $this->_topParent($data['id']);
            $this->_brands($data['id']);
        }

        if (array_key_exists('name', $data))
            $this->name = $data['name'];
        if (array_key_exists('url', $data))
            $this->url = $data['url'];
        if (array_key_exists('parent', $data))
            $this->parent = $data['parent'];
        if (array_key_exists('etc', $data))
            $this->etc = $data['etc'];
        if (array_key_exists('img', $data))
            $this->img = $data['img'];
        if (array_key_exists('name_en', $data))
            $this->name_en = $data['name_en'];
        if (array_key_exists('url_en', $data))
            $this->url_en = $data['url_en'];
        if (array_key_exists('name_ch', $data))
            $this->name_ch = $data['name_ch'];
        if (array_key_exists('url_ch', $data))
            $this->url_ch = $data['url_ch'];
        if (array_key_exists('is_brand', $data))
            $this->is_brand = $data['is_brand'];
        if (array_key_exists('store_id', $data))
            $this->storeId = $data['store_id'];
    }

    public function _brands()
    {
        $this->brands = $this->db->select("*")
            ->from('category_brand cb')
            ->join('categori c', 'c.id = cb.category_id')
            ->join('categori b', 'b.id = cb.brand_id')
            ->where('cb.category_id', $this->topParent->id)
            ->get()
            ->result();
    }


    public function getProductsInCategoryTree($category_id, $limit = null, $offset = 0)
    {
        $categoryIds = $this->getAllCategoryIdsInTree($category_id);
        if (empty($categoryIds)) {
            return array(); // Kembalikan array kosong jika tidak ada kategori dalam tree.
        }

        $this->db->select('p.*, g.grade as grade, b.name as brand, c.name as nama_kategori, r.name as nama_domisili, GROUP_CONCAT(DISTINCT d.name) as nama_keahlian, GROUP_CONCAT(DISTINCT pv.name ) as nama_kontrak, GROUP_CONCAT(DISTINCT re.name) as cakupan_area,GROUP_CONCAT(DISTINCT pro.name) as cakupan_area_province');
        $this->db->from('product p');
        $this->db->join('categori c', 'p.component = c.id');
        $this->db->join('categori b', 'b.id = p.brand', "left");
        $this->db->join('grade g', 'g.id = p.quality', "left");
        $this->db->join('regencies r', 'r.id = p.area', 'left');
        $this->db->join('product_tag pt', 'pt.product_id = p.id', 'left');
        $this->db->join('product_variant pv', 'p.id = pv.product_id', "left");
        $this->db->join('categori d', 'pt.tag_id = d.id', 'left');
        $this->db->join('service_coverage sc', 'sc.product_id = p.id', 'left');
        $this->db->join('regencies re', 're.id = sc.regency_id', "left");
        $this->db->join('provinces pro', 'pro.id = sc.regency_id', "left");


        if ($this->storeId != null) {
            $this->db->where('store_id', $this->storeId);
        }


        $this->db->where_in('c.id', $categoryIds);

        if ($limit != null) {
            $this->db->limit($limit);
            $this->db->offset($offset);
        }

        if ($this->orderPrice != null) {
            $this->db->order_by('price', $this->orderPrice);
        } else if ($this->orderId != null) {
            $this->db->order_by('id', $this->orderId);
        }
        $this->db->group_by('p.id');
        $query = $this->db->get();

        $this->_paginate($categoryIds);

        return $query->result_array();
    }

    private function _paginate($categoryIds = [])
    {
        if (empty($categoryIds)) {
            $this->total = 0;
        } else {
            $this->db->select('p.*');
            $this->db->from('product p');
            $this->db->join('categori c', 'p.component = c.id');

            if ($this->storeId != null) {
                $this->db->where('store_id', $this->storeId);
            }
            $this->db->where_in('c.id', $categoryIds);


            $this->total = count($this->db->get()->result());
        }
    }

    public function getAllCategoryIdsInTree($category_id)
    {
        $categoryIds = array();
        $categoryIds[] = $category_id; // Tambahkan kategori saat ini ke daftar

        $this->getCategoryChildren($category_id);

        // Ambil semua anak kategori secara rekursif
        $childCategoryIds = $this->getCategoryChildren($category_id);

        return array_merge($categoryIds, $childCategoryIds);
    }

    function getCategoryChildren($category_id)
    {
        $childIds = array();
        $query = $this->db->select('id')->from('categori')->where('parent', $category_id)->get();
        foreach ($query->result() as $row) {
            $childIds[] = $row->id;
            $childIds = array_merge($childIds, $this->getCategoryChildren($row->id));
        }
        return $childIds;
    }

    public function products($limit = null, $offset = 0)
    {
        $this->products = $this->getProductsInCategoryTree($this->id, $limit, $offset);
    }

    public function _getTopCategoryParent($id)
    {
        return $this->db->get_where('categori', ['id' => $id])->row();
    }

    public function _topParent($categoryId)
    {
        $category = $this->_getCategoryDetails($categoryId);

        // Jika kategori memiliki parent_id, cari kategori paling atas secara rekursif
        if ($category->parent != 0) {
            return $this->_topParent($category->parent);
        } else {
            $this->topParent = $category;
        }
    }

    public function _getCategoryDetails($categoryId)
    {
        return $this->db->get_where('categori', ['id' => $categoryId])->row();
    }

    // private function _checkTopParentHasBrand($parent)
    // {
    //     $data = $this->db->get_where('categori', ['id' => $parent])->row();

    //     if($data->is_brand = 0){

    //     }else{
    //         return true;
    //     }

    // }



    public function treeBack()
    {
        $allCategories = $this->db->select('*')
            ->from('categori')
            ->where('is_brand', 0)
            ->order_by('id', 'ASC')
            ->order_by('parent', 'ASC')
            ->get()
            ->result();
        foreach ($allCategories as $key => $value) {
            $this->_topParent($value->id);
            if ($this->topParent->is_brand == 1) {
                unset($allCategories[$key]);
            } else {
                $this->formatTreeBack($value, $value->name, $value);
            }
        }

        foreach ($allCategories as $key => $value) {
            $grade[$key] = $value->name;
        }

        array_multisort($grade, SORT_ASC, $allCategories);

        return $allCategories;
    }

    private function formatTreeBack($category, $name, $categoriBack)
    {
        if ($category->parent > 0) {
            $parent = $this->db->get_where('categori', ['id' => $category->parent, 'is_brand' => 0])->row();

            // $name = $name . ' > ' . $parent->name;
            if ($parent != null) {
                $categoriBack->name = $parent->name . ' > ' . $categoriBack->name;

                $this->formatTreeBack($parent, $name, $categoriBack);
            };
        }
    }

    public function brands_search($keyword)
    {
        return $this->db->select('*')
            ->from('categori')
            ->like('name', $keyword)
            ->where('is_brand', 1)
            ->get()->result_array();
    }
}