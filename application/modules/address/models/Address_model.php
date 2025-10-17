<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address_model extends CI_Model
{

    public $villages = 'villages';
    public $districts = 'districts';
    public $regencies = 'regencies';
    public $province = 'province';

    protected $table;

    protected $query;

    function __construct(array $data = [])
    {
        parent::__construct();

        $this->table = $this->villages;

        $this->_set($data);
        $this->db->reset_query();
        $this->query = $this->db->select('*')->from($this->table);
    }

    public function _set(array $data = [])
    {
        foreach ($data as $key => $value) {
           $this->$key = $value;
        }
    }

    public function get()
    {
        
        $this->query = $this->query->get();
        return $this;
    }

    public function where($column, $value)
    {
        $this->query = $this->query->where($column, $value);
        return $this;
    }   

    private function _parent()
    {
        switch ($this->table) {
            case 'villages':
               
                $this->load->model('address/address_model');
                $address = new Address_model(['table' => 'districts']);
                $data['district'] = $address->where('id', property_exists($this, 'district_id') ? $this->district_id : 0)->get()->single();
                $this->_set($data);
                return $this;
                break;
            case 'districts':
                $this->load->model('address/address_model');
                $address = new Address_model(['table' => 'regencies']);
                $data['regency'] = $address->where('id', property_exists($this, 'regency_id') ? $this->regency_id : 0)->get()->single();
                
                $this->_set($data);
                return $this;
                break;
            case 'regencies':
                $this->load->model('address/address_model');
                $address = new Address_model(['table' => 'provinces']);
                $data['province'] = $address->where('id', property_exists($this, 'province_id') ? $this->province_id : 0)->get()->single();
                
                $this->_set($data);
                return $this;
                break;
            default:
                # code...
                break;
        }
    }

    public function single()
    {
       
        $data = $this->query->row_array();

        if($data == null)
        {
            $this->db->reset_query();
            $fields = $this->db->list_fields($this->table);
            foreach ($fields as $value) {
                $this->$value = null;
            }
        }

        
        
        
        if($data != null)
        {
            $this->_set($data);
            
            $this->_parent();
        }
        
       
        return $this;
    }

    public function first()
    {
        $data = $this->query->result_array()[0];
        $this->_set($data);
        return $this;
    }




    public function getAddressByVillageId($villageId)
    {
        return $this->db->select('v.*, r.*, d.*, p.*, v.name as village, d.name as district, r.name as regency, p.name as province')
                        ->from($this->villages . ' v')
                        ->join('districts d', 'd.id = v.district_id')
                        ->join('regencies r', 'r.id = d.regency_id')
                        ->join('provinces p', 'p.id = r.province_id')
                        ->where('v.id', $villageId)
                        ->get()->row();
    }

}