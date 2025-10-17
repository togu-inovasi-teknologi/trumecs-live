<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_item_model extends CI_Model
{
    var $table = "order_detail";  
    var $order_column = array('name_product', 'price', 'quantity');
    var $select_column = array('name_product', 'price', 'quantity');  
    
    var $where = [];
   

    function __construct()
    {
        if(isset($_POST['where'])){
            $this->where = $_POST['where'];
        }
        parent::__construct();
    }

    private function _query(){
        
        $this->db->select($this->select_column);
        $this->db->from($this->table);

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
            $this->db->order_by('id', 'DESC');  
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
        $this->db->from($this->table);  
        if(!empty($this->where)){
            $this->db->where($this->where);
        }
        return $this->db->count_all_results();  
        
    }  

}