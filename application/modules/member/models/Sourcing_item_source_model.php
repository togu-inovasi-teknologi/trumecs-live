<?php

class Sourcing_item_source_model extends CI_Model
{
    var $table = "sourcing_item_source";  
    var $order_column = array('sourcing_item_supplier', 'sourcing_item', 'qty', 'price');
    var $select_column = array('sourcing_item_supplier', 'sourcing_item', 'qty', 'price');  
    
    var $where = [];

    protected $query;

    function __construct(array $data = [])
    {
        
        parent::__construct();
    

        if(!empty($data)){
            $this->_set($data);
        }

        $this->_initSelect();
    }

    public function query()
    {
        return $this->query;
    }

    public function _set(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
    private function _initSelect()
    {
        $this->db->reset_query();
        
        $this->query = $this->db->select($this->select_column)->from($this->table);
    }

    public function join(array $array){
        foreach ($array as $key => $value) {
            if(array_key_exists('keyword', $value)){
                $this->query->join($value['table'], $value['on'], $value['keyword']);
            }else{
                $this->query->join($value['table'], $value['on']);
            }
        }
        
    }

    public function select(array $array)
    {
        $this->select_column =  join(',', $array);
        $this->_initSelect();
        return $this;
    }

    public function sum($column)
    {
        $this->db->select_sum($column);
        return $this;
    }

    public function group_by($column)
    {
        $this->db->group_by($column);
        return $this;
    }

    public function get()
    {
        $this->query = $this->query->get();
        return $this;
    }

    public function result()
    {
        
        $results = $this->db->get()->result();

        $this->load->model('member/sourcing_item_source_model');

        $return = [];

        foreach ($results as $key => $value) {
            $item = new Sourcing_item_source_model((array) $value);
            $item->sourcing();
            $item->selling_item();
            $return[] = $item;
        }
       
        return $return;
    }

    public function single()
    {
        $data = $this->query->row_array();
        $this->_set($data);
        return $this;
    }

    public function where(array $where)
    {
        $this->query = $this->query->where($where);
        return $this;
    }

    public function selling_item()
    {
        $this->load->model('member/sourcing_item_model');

        $selling_item = new Sourcing_item_model();
        $selling_item->select(['*', 'SUM(price * qty) as total_price']);
        $selling_item->where(['id' => $this->item_id]);
        $data = $selling_item->get()->single();
       
        $this->_set(['selling_item' => $data]);

        return $selling_item;
    }

    public function sellingTotalPrice()
    {
        return $this->selling_item->price * $this->qty;
    }

    public function sellingPPn(){
        $ppnSatuan = $this->selling_item->price * ppn_value();
        $ppnTotal = $ppnSatuan * $this->qty;
        return $ppnTotal;
    }

    public function sellingPriceWithPPn(){
        $includePPn = ($this->selling_item->price * $this->qty) + $this->sellingPPn();
        return $includePPn;
    }

    public function calculateppn(){
        $ppnSatuan = $this->price * ppn_value();
        $ppnTotal = $ppnSatuan * $this->qty;
        return $ppnTotal;
    }

    public function includeppn(){
        $includePPn = ($this->price * $this->qty) + $this->calculateppn();
        return $includePPn;
    }

    public function calculateGrossProfit()
    {
        $gross = $this->sellingPriceWithPPn() - $this->sourcing_item->includeppn();
        return round($gross);
    }

    public function getPersentation()
    {
        $hasil = (($this->calculateGrossProfit() - $this->calculateppn() + $this->sellingPPn()) / $this->sellingTotalPrice() ) * 100;
        return round($hasil);
    }

    public function sourcing()
    {
        $this->load->model('member/sourcing_item_model');

        $sourcing_item = new Sourcing_item_model();
        $sourcing_item->select(['*', 'SUM(price * qty) as total_price']);
        $sourcing_item->where(['id' => $this->sourcing_item_supplier]);
       
        $item = $sourcing_item->get()->single()->with(['sourcing']);
       
        $this->_set(['sourcing_item' => $item]);

        return $sourcing_item;
    }
}