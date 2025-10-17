<?php

class Member_model_query extends CI_Model
{
    var $table = "member";  
    var $order_column = array('m.id','m.name', 'm.email', 'm.phone','v.name as village_name', 'v.id as village_id', 'kodepos', 'address'); 
    var $select_column = array('m.id','m.name', 'm.email', 'm.phone','v.name as village_name', 'v.id as village_id', 'kodepos', 'address'); 
    var $search_column = array('m.id','m.name', 'm.email', 'm.phone'); 

    public $query;

    function __construct(array $data = [])
    {
        parent::__construct();

        if(!empty($data))
            $this->_set($data);


        $this->db->reset_query();    
        $this->query = $this->db->select('*')->from($this->table);

    }


    private function _set(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function where($column, $value)
    {
        $this->query = $this->query->where($column, $value);
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
        if($data == null)
        {
            $this->db->reset_query();
            $fields = $this->db->list_fields($this->table);

            $data = [];

            foreach ($fields as $key => $value) {
                $data[$value] = null;
            }   
        }

        $this->_set($data);
        return $this;
    }

    


}