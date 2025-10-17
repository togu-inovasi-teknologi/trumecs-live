<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_backendmekanik extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getGrade()
    {
        $this->db->reset_query();
        $this->db->select('g.*');
        $this->db->where('g.type', 1);
        $this->db->from('grade g');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRegencies()
    {
        $this->db->reset_query();
        $this->db->select('*');
        $this->db->from('regencies');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getProvincesRegencies()
    {
        $this->db->reset_query();
        $this->db->select('p.id as id_province, p.name as name_province, r.id as id_regency, r.name as name_regency');
        $this->db->join('regencies r', 'p.id = r.province_id', 'left');
        $this->db->from('provinces p');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getServiceCoverage($id = null)
    {
        $this->db->reset_query();
        $this->db->select('sc.* , r.id as id_regencies, r.name as name_regencies, p.id as province, p.name as name_province');
        $this->db->join('regencies r', 'sc.regency_id = r.id', 'left');
        $this->db->join('provinces p', 'sc.regency_id = p.id', 'left');
        $this->db->where('sc.product_id', $id);
        $this->db->from('service_coverage sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getOrganization($query)
    {
        $this->db->reset_query();
        $this->db->like('organization_name', $query);
        $this->db->limit(10);
        $query = $this->db->get('expert_organization');
        return $query->result_array();
    }

    public function getExpertExperience($id)
    {
        $this->db->reset_query();
        $this->db->select('ee.*, eo.organization_name as nama_perusahaan, eo.id as id_perusahaan');
        $this->db->join('expert_organization eo', 'eo.id = ee.organization_id');
        $this->db->where('ee.product_id', $id);
        $query = $this->db->get('expert_experience ee');
        return $query->result_array();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function update($table, $data, $column, $id)
    {
        $this->db->where($column, $id);
        $this->db->update($table, $data);
    }
    public function delete($table, $column, $id)
    {
        $this->db->where($column, $id);
        $this->db->delete($table);
    }

    public function getAllData()
    {
        $this->db->reset_query();
        $this->db->select('provinces.id AS province_id, provinces.name AS province_name, regencies.id AS regency_id, regencies.name AS regency_name');
        $this->db->from('provinces');
        $this->db->join('regencies', 'regencies.province_id = provinces.id', 'left');
        $query = $this->db->get();
        $result = $query->result();
        $groupedData = [];
        foreach ($result as $row) {
            $groupedData[$row->province_id]['province_name'] = $row->province_name;
            $groupedData[$row->province_id]['regencies'][] = [
                'id' => $row->regency_id,
                'name' => $row->regency_name,
            ];
        }
        return $groupedData;
    }

    public function getProvincesAndRegencies($term = null)
    {
        $this->db->reset_query();
        $this->db->select('p.id as id_province, p.name as name_province, r.id as id_regency, r.name as name_regency');
        $this->db->join('regencies r', 'r.province_id = p.id', 'left');
        $this->db->from('provinces p');

        if ($term) {
            $this->db->group_start();
            $this->db->like('p.name', $term);
            $this->db->or_like('r.name', $term);
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRegenciesJson($term = null)
    {
        $this->db->reset_query();
        $this->db->select('*');
        $this->db->from('regencies');
        if ($term) {
            $this->db->group_start();
            $this->db->like('name', $term);
            $this->db->group_end();
        }
        $query  = $this->db->get();
        return $query->result_array();
    }
}