<?php

class Company_model extends MX_Controller
{
    var $table = "companies";  
    var $order_column = array('c.id','c.name', 'c.website', 'c.industry', 'c.telephone', 'c.email', 'c.npwp', 'c.billing_country', 'c.billing_village', 'c.billing_village_id', 'c.shipping_country', 'c.shipping_village_id', 'c.shipping_village', 'c.billing_code', 'shipping_code', 'c.billing_province', 'c.billing_regency', 'c.billing_district', 'CASE c.ownership WHEN 0 THEN "personal" ELSE "perusahaan" END AS ownership');  
    var $select_column = array('c.id','c.name', 'c.website', 'c.industry', 'c.telephone', 'c.email', 'c.npwp', 'c.billing_country', 'c.billing_village', 'c.billing_village_id', 'c.shipping_country', 'c.shipping_village_id', 'c.shipping_village', 'c.billing_code', 'shipping_code', 'c.billing_province', 'c.billing_regency', 'c.billing_district', 'CASE c.ownership WHEN 0 THEN "personal" ELSE "perusahaan" END AS ownership');  
    var $search_column = array('c.id','c.name', 'c.website', 'c.industry', 'c.telephone', 'c.email', 'c.npwp', 'c.billing_country', 'c.billing_village', 'c.billing_village_id', 'c.shipping_country', 'c.shipping_village_id', 'c.shipping_village', 'c.billing_code', 'shipping_code', 'c.billing_province', 'c.billing_regency', 'c.billing_district', 'CASE c.ownership WHEN 0 THEN "personal" ELSE "perusahaan" END AS ownership');  
    
    var $query;
    var $select = '*';

    function __construct($data = [])
    {
        if(!empty($data))
            $this->_set($data);
        parent::__construct();

        $this->_initSelect();
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

    public function get()
    {
        $this->query = $this->query->get();
        return $this;
    }

    public function single()
    {
        $data = $this->query->row_array();
        
        if($data != null){
            $this->_set($data);
        }else{
            $this->db->reset_query();
            $fields = $this->db->list_fields($this->table);
            foreach ($fields as $value) {
                
                $this->$value = null;
            }
            
            
        }
        
        return $this;
    }

    public function where(array $where)
    {
        $this->query = $this->query->where($where);
        return $this;
    }

    public function with(array $with)
    {
        foreach ($with as $key => $value) {
            $this->$value();
        }
        return $this;
    }

    public function address()
    {
        $this->load->model('address/address_model');

        $address = new Address_model(['table' => 'villages']);
        
        if($this->billing_village_id != null)
        {
            $data['address'] = property_exists($this, 'billing_village_id') ? $address->where('id',$this->billing_village_id)->get()->single() : null;
        
            if($data['address'] != null)
            {
                $this->_set($data);
            }
        }
        return $this;
    }

    private function _query(){

        

        $this->select_column = array_merge($this->select_column, [
            'bv.name as village', 
            'bv.id as village_id',
            'bd.name as district', 
            'bd.id as district_id',
            'rb.name as regency',
            'rb.id as regency_id',
            'pb.name as province_name',
            'pb.id as province_id',
        ]);

        
       
        $this->db->select($this->select_column, FALSE);
        $this->db->from($this->table . ' c');
        $this->db->join('villages bv', 'bv.id = c.billing_village_id');
        $this->db->join('districts bd', 'bd.id = bv.district_id');
        $this->db->join('regencies rb', 'rb.id = bd.regency_id');
        $this->db->join('provinces pb', 'pb.id = rb.province_id');
        // $this->db->join('villages bv', 'bv.name = c.billing_village');
        // $this->db->join('villages bv', 'bv.name = c.billing_village');
        // $this->db->join('villages bv', 'bv.name = c.billing_village');

        if(!empty($_POST["search"]["value"]))  
        {  
            $this->db->group_start();
            foreach ($this->search_column as $key => $value) {
               if($key == 0){
                    $this->db->like($value, $_POST["search"]["value"]);  
                }else{
                    $this->db->or_like($value, $_POST["search"]["value"]);  
               }
            }
            $this->db->group_end();
            
        }  

        $this->db->group_by('c.id');
        
        if(isset($_POST["order"])){  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }else {  
            $this->db->order_by('id', 'DESC');  
        }  

        
    }


    public function make_datatables(){  
        $this->db->reset_query();
        $this->_query();  
        if($_POST["length"] != -1)  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result_array();  
   } 

   public function get_filtered_data(){  
        $this->_query();  
        return $this->db->get()->num_rows();  
    }       
    public function get_all_data()  
    {  
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();
    }  
    
    public function update(){
        $this->db->update($this->table, $data);
    }


    public function save($data)
    {
        $this->db->insert('companies', $data);
        return $this->db->insert_id();
    }

    public function get_my_company()
    {
        $id = $this->session->userdata('member')['id'];
        return $this->db->get_where('companies', ['created_by' => $id])->row();
    }

    public function _set($data)
    {
       
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
        
    }

}