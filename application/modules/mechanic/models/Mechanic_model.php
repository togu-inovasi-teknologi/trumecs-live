<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mechanic_model extends CI_Model
{
    public $table = 'product';
    public $select = '*';

    private $query;

    function __construct(array $data = [])
    {
        if (!empty($data))
            $this->_set($data);

        $this->_initSelect();
        parent::__construct();
    }

    private function _initSelect()
    {
        $this->db->reset_query();

        $this->query = $this->db->select($this->select)->from($this->table);
    }

    public function select(array $array)
    {
        $this->select = join(',', $array);
        $this->_initSelect();
        return $this;
    }

    public function _set($data)
    {
        $data = (array)$data;


        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function get()
    {
        $this->query = $this->query->get();
        return $this;
    }

    public function with(array $with = [])
    {
        foreach ($with as $key => $value) {
            $this->$value();
        }

        return $this;
    }

    public function where(array $where)
    {
        $this->query = $this->query->where($where);
        return $this;
    }
    public function getMechanic($id)
    {
        $this->db->reset_query();
        $this->db->select('p.*, c.name as nama_kategori, g.grade as nama_grade, r.name as nama_domisili, GROUP_CONCAT(DISTINCT re.name) as cakupan_area,GROUP_CONCAT(DISTINCT pro.name) as cakupan_area_province, GROUP_CONCAT(DISTINCT d.name) as nama_keahlian');
        $this->db->join('grade g', 'g.id = p.quality', 'left');
        $this->db->join('categori c', 'c.id = p.component', 'left');
        $this->db->join('regencies r', 'r.id = p.area', 'left');
        $this->db->join('service_coverage sc', 'sc.product_id = p.id', 'left');
        $this->db->join('regencies re', 're.id = sc.regency_id', "left");
        $this->db->join('provinces pro', 'pro.id = sc.regency_id', "left");
        $this->db->join('product_tag pt', 'pt.product_id = p.id', 'left');
        $this->db->join('categori d', 'pt.tag_id = d.id', 'left');
        $this->db->where('p.id', $id);
        $this->db->group_by('p.id');
        $query = $this->db->get('product p');
        $return = $query->result_array();
        return $return;
    }

    public function getProductVariants($id)
    {
        $this->db->reset_query();
        $this->db->select('pv.*');
        $this->db->where('pv.product_id', $id);
        $query = $this->db->get('product_variant pv');
        return $query->result_array();
    }

    public function getExpertExperience($id)
    {
        $this->db->reset_query();
        $this->db->select('ee.*, MIN(ee.year_start) AS start_year,
            MAX(ee.year_end) AS end_year,
            MAX(ee.year_end) - MIN(ee.year_start) AS year_exp,
            eo.organization_name AS nama_organisasi,
            GROUP_CONCAT(ee.position SEPARATOR "|") AS positions,
            GROUP_CONCAT(ee.description SEPARATOR "|") AS descriptions');
        $this->db->join('expert_organization eo', 'eo.id = ee.organization_id', 'inner');
        $this->db->where('ee.product_id', $id);
        $this->db->group_by('eo.organization_name, ee.product_id');
        $query = $this->db->get('expert_experience ee');
        return $query->result_array();
    }
    public function getServiceExpertise($id)
    {
        $this->db->reset_query();
        $this->db->select('se.*');
        $this->db->where('se.product_id', $id);
        $query = $this->db->get('service_expertise se');
        return $query->result_array();
    }
    public function getProductFile($id)
    {
        $this->db->reset_query();
        $this->db->select('pf.*');
        $this->db->where('pf.product_id', $id);
        $query = $this->db->get('product_file pf');
        return $query->result_array();
    }
    public function getGalleryExpert($value)
    {
        $query = $this->db->where("product", $value)->get('galery');
        return $query->result_array();
    }

    public function getAttributeExpert($value)
    {
        $this->db->join('attribute', 'product_attribute.attribute_id = attribute.id');
        $query = $this->db->where("product_id", $value)->get('product_attribute');
        return $query->result_array();
    }

    public function allCategoriesExpert()
    {
        $this->db->from("categori");
        $this->db->select("*");
        $this->db->where(['etc' => 1, 'parent' => 0]);
        return $this->db->get()->result_array();
    }
    public function allSubCategoriesExpert($where)
    {
        $this->db->from("categori");
        $this->db->select("*");
        $this->db->where(['etc' => 1, 'parent' => $where]);
        return $this->db->get()->result_array();
    }
}