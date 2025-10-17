<?php

class Order_item_model extends CI_Model
{

    public $table = 'order_detail';
    public $select = '*';

    private $query;

    function __construct(array $data = [])
    {
        if(!empty($data))
            $this->_set($data);

        $this->_initSelect();    
        parent::__construct();
    }

    private function _initSelect()
    {
        $this->db->reset_query();
        
        $this->query = $this->db->select($this->select)->from($this->table);
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

    public function single()
    {
        $data = $this->query->row_array();
        $data['billing_address_detail'] = $data['billing_address'];
        $data['billing_address_detail'] = $data['shipping_address'];
        $this->_set($data);
        return $this;
    }

    public function sumDppSellingPrice()
    {
        $sum = $this->price * $this->quantity;
        return $sum;
    }

    public function calculateppn(){
        $ppnSatuan = $this->price * ppn_value();
        $ppnTotal = $ppnSatuan * $this->quantity;
        return $ppnTotal;
    }
    public function result()
    {
        $this->query = $this->query->result();
        $obj = [];

        foreach ($this->query as $key => $value) {
           $item = new Order_item_model((array) $value);
           $item->item_supplier();
           $obj[] = $item;
        }
        return $obj;
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

    public function product()
    {
        $this->load->model('product/product_model');
        $product = new Product_model();
        $product->where(['id' => $this->id_product])->get()->single();
        $this->_set(['product' => $product]);
        return $product;
    }

    public function item_supplier()
    {
        $this->db->reset_query();
        $order = $this->db->get_where('order', ['id' => $this->id_order])->row();
     
        $this->db->reset_query();
        
        $this->load->model('member/sourcing_item_model');

        $sourcing_item = new Sourcing_item_model();
        $sourcing_item->select(['*', 'SUM(price * qty) as total_price']);
        $sourcing_item->where(['sourcing_id' => $order->sourcing_buyer, 'product_id' => $this->id_product]);
        $sourcing_item->group_by('id');
        
        
        $item = $sourcing_item->get()->single()->with(['item_source']);
     
        $this->_set(['item_supplier' => $item]);
       
        return $sourcing_item;
    }

    public function sum_presentation()
    {
        $hasil = (($this->item_supplier->calculateGrossProfit() - $this->item_supplier->calculateppn() + $this->item_supplier->calculateppn()) / $this->item_supplier->total_price ) * 100;
        return round($hasil);
    }
}