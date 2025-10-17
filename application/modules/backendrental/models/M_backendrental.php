<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_backendrental extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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

    public function getBrandJson($term = null)
    {
        $this->db->reset_query();
        $this->db->select('*');
        $this->db->where(['parent' => 0, 'is_brand' => 1]);
        $this->db->from('categori');
        if ($term) {
            $this->db->group_start();
            $this->db->like('name', $term);
            $this->db->group_end();
        }
        $query  = $this->db->get();
        return $query->result_array();
    }

    public function getAttribute($query)
    {
        $this->db->reset_query();
        $this->db->like('name', $query);
        $this->db->limit(10);
        $query = $this->db->get('attribute');
        return $query->result_array();
    }
}