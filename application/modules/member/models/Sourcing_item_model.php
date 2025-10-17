<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sourcing_item_model extends CI_Model
{
    var $table = "sourcing_item";  
    var $order_column = array('si.id','si.items', 'si.price', 'si.status', 'si.qty', 's.company', 'si.product_id', 'si.uom', 's.created_at', 's.province');
    var $select_column = array('si.id','si.items', 'si.price', 'si.status', 'si.qty', 's.company', 'si.product_id', 'si.uom', 's.created_at', 's.province');  
    
    var $where = [];

    protected $query;
   

    function __construct(array $data = [])
    {
        
        parent::__construct();
        
        if(isset($_POST['where'])){
            $this->where = $_POST['where'];
        }

        if(!empty($data)){
            $this->_set($data);
        }

       // $this->_initSelect();
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

    public function calculateppn(){
        $ppnSatuan = $this->price * ppn_value();
        $ppnTotal = $ppnSatuan * $this->qty;
        return $ppnTotal;
    }

    public function includeppn(){
        $includePPn = $this->total_price + $this->calculateppn();
        return $includePPn;
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
        $results = $this->query->result();
        $this->load->model('member/sourcing_item_model');
        
        $return = [];
        
        foreach ($results as $key => $value) {
            $item = new Sourcing_item_model((array) $value);
            $item->item_source();
            
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

    public function with(array $with = [])
    {
        foreach ($with as $key => $value) {
            $this->$value();
        }

        return $this;
    }

    public function item_source()
    {
        $this->load->model('member/sourcing_item_source_model');
        
        $item_source = new Sourcing_item_source_model(['table' => 'sourcing_item_source sis']);

        $query_total_buying_price = 'SUM(sis.price * sis.qty)';
        $query_total_selling_price = 'SUM(si.price * sis.qty)';
        $query_ppn_in = 'SUM(sis.price * 0.11 * sis.qty)';
        $query_ppn_out = 'SUM(si.price * 0.11 * sis.qty)';
        $query_gross_profit = '('. $query_total_selling_price .' + '. $query_ppn_out .') - ('. $query_total_buying_price .' + '. $query_ppn_in .')';

        $query_persentation = '(('. $query_gross_profit .' - '. $query_ppn_in .' + '. $query_ppn_out .') / '. $query_total_selling_price .' ) * 100';

        $item_source->select([
            'sis.*', 
            'sis.sourcing_item as item_id',
            $query_total_buying_price . ' as total_buying_price',
            $query_total_selling_price . ' as total_price',
            $query_ppn_in . ' as ppn_in',
            $query_ppn_out . ' as ppn_out',
            $query_gross_profit . ' as total_gross_profit',
            $query_persentation . ' as total_persentation',
        ]);

       
        $item_source->join([
            [
                'table' => 'sourcing_item si',
                'on' => 'si.id = sis.sourcing_item'
            ]
        ]);
        $item_source->where(['sis.sourcing_item' => $this->id]);
        $item_source->group_by('sis.id');
       
        $source = $item_source->result();
       
                
        $this->_set(['source' => $source]);
        

        return $item_source;

    }

    public function calculateGrossProfit()
    {
        $gross = 0;
        foreach ($this->source as $key => $value) {
            
            $gross += $value->sourcing_item->includeppn();
        }

        $gross = $this->includeppn() - $gross;
        return round($gross);
    }

    public function sourcing()
    {
        $this->load->model('member/sourcing_model');
        
        $sourcing = new Sourcing_model();
        
        $sourcingData = $sourcing->where(['id' => $this->sourcing_id])->get()->single()->with(['company', 'contact']);
        
        
        $this->_set(['source' => $sourcingData]);

        return $sourcing;

    }

    private function _query(){
        $this->db->reset_query();
       
        $this->db->select($this->select_column);
        $this->db->from($this->table . ' si');
        $this->db->join('sourcing s', 's.id = si.sourcing_id');

        if(!empty($this->where)){
            
            $this->db->where($this->where);
        }

        if(!empty($_POST["search"]["value"]))  
        {  
            if(!empty($this->where)){
                $this->db->group_start();
            }
            foreach ($this->select_column as $key => $value) {
               if($key == 0){
                    $this->db->like($value, $_POST["search"]["value"]);  
                }else{
                   $this->db->or_like($value, $_POST["search"]["value"]);  
               }
            }
            if(!empty($this->where)){
                $this->db->group_end();
            }
            
        }  
        
        if(isset($_POST["order"])){  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }else {  
            $this->db->order_by('si.id', 'DESC');  
        }  

        
    }


    public function make_datatables(){  
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
        $this->db->from($this->table . ' si');  
        $this->db->join('sourcing s', 's.id = si.sourcing_id');  
        if(!empty($this->where)){
            $this->db->where($this->where);
        }
        return $this->db->count_all_results();  
        
    }  

}