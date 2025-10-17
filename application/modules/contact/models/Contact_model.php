<?php

class Contact_model extends MX_Controller
{
    var $table = "contacts";  
    var $order_column = array('ct.id', 'ct.member_id', 'ct.name as text', 'ct.name as name', 'ct.telephone', 'ct.email', 'ct.position', 'ct.dapartment', 'co.name as company', 'co.telephone as company_phone', 'co.id as company_id');  
    var $selecontacts_column = array('ct.id', 'ct.member_id', 'ct.name as text', 'ct.name as name', 'ct.telephone', 'ct.email', 'ct.position', 'ct.dapartment', 'co.name as company', 'co.telephone as company_phone', 'co.id as company_id');  
    var $search_column = array('ct.id', 'ct.member_id', 'ct.name as text', 'ct.name as name', 'ct.telephone', 'ct.email', 'ct.position', 'ct.dapartment', 'co.name as company', 'co.telephone as company_phone', 'co.id as company_id');  

    var $query;
    
    function __construct(array $data = [])
    {
        parent::__construct();
        if(!empty($data))
        {
            $this->_set($data);
        }
        $this->db->reset_query();
        $this->query = $this->db->select('*')->from($this->table);
        
    }

    

    private function _query(){
        $this->db->reset_query();
        $this->query = $this->db->select($this->selecontacts_column)->from($this->table . ' ct');
        $this->query->join('companies co', 'co.id = ct.company_id');
        if(!empty($_POST["search"]["value"]))  
        {  
            $this->query->group_start();
            foreach ($this->search_column as $key => $value) {
               if($key == 0){
                    $this->query->like($value, $_POST["search"]["value"]);  
                }else if($key == 2 || $key == 3 || $key == 8 || $key == 9 || $key == 10){
                    $explode = explode('as', $value);
                    $this->query->like($explode[0], $_POST["search"]["value"]);  
                }else{
                    $this->query->or_like($value, $_POST["search"]["value"]);  
               }
            }
            $this->query->group_end();
            
        }  

        $this->query->group_by('ct.id');
        
        if(isset($_POST["order"])){  
            $this->query->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }else {  
            $this->query->order_by('id', 'DESC');  
        }  

        
    }

    public function _set($data)
    {
        
        if($data != null){
            foreach ($data as $key => $value) {
                $this->$key = $value;
            };
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

    public function single()
    {
        $data = $this->query->row_array();
        $this->_set($data);
        
        return $this;
    }

    public function with(array $with)
    {
        foreach ($with as $key => $value) {
            $this->$value();
        }
        return $this;
    }

    public function member()
    {
       if(property_exists($this, 'member_id')){
            $this->load->model('member/member_model_query');

            $member = new Member_model_query();

            $data['member'] = $member->where('id', $this->member_id)->get()->single();
            if($data['member'] != null)
            {
                $this->_set($data);
            }
       }
        return $this;
    }


    // public function with(array $tables)
    // {
        // foreach ($tables as $key => $value) {
        //     $this->query
        // }
    // }


    public function company()
    {
        $company = $this->db->select('*')->from('companies')->where('id', $this->company_id)->get()->row_array();
        $this->_set(['company' => $company]);
        return $this;
    }


    public function make_datatables(){  
        $this->_query();  
        if($_POST["length"] != -1)  
        {  
            $this->query->limit($_POST['length'], $_POST['start']);  
        }  
        return $this->query->get()->result_array();  
   } 

   public function get_filtered_data(){  
        $this->_query();  
        return $this->query->get()->num_rows();  
    }       
    public function get_all_data()  
    {  
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();
    }  

}