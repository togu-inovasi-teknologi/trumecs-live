<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sourcing_file_model extends CI_Model
{
    var $table = "sourcing_files";  
    // var $order_column = array('s.id','nama_rfq', 's.created_at');  
    // var $select_column = array('s.*', 'sum(si.price) as total_price', 's.created_at');  
    // var $search_column = array('s.id', 'total_price', 's.created_at');  
    
   

    function __construct()
    {
        parent::__construct();
    }

//     private function _query(){

//         $session = $this->session->all_userdata();

//         $subQuery = $this->db->select('SUM(price) as total_price')
//                     ->from('sourcing_item')
//                     ->group_by('id')
//                     ->get_compiled_select();
                    
//         $this->db->select($this->select_column);
//         $this->db->from($this->table . ' s');
//         $this->db->join('sourcing_item si', 'si.sourcing_id = s.id');
//         $this->db->where('s.member_id', $session['member']['id']);
//         $this->db->where('s.status', 3);
//         $this->db->where('si.status', 2);
//         $this->db->group_by('s.id');


//         if(!empty($_POST["search"]["value"]))  
//         {  
//             $this->db->group_start();
//             foreach ($this->search_column as $key => $value) {
//                if($key == 0){
//                     $this->db->like($value, $_POST["search"]["value"]);  
//                 }else{
//                     $this->db->or_like($value, $_POST["search"]["value"], 'both');  
//                }
//             }
//             $this->db->group_end();
            
//         }  
        
//         if(isset($_POST["order"])){  
//             $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
//         }else {  
//             $this->db->order_by('id', 'DESC');  
//         }  

        
//     }


//     public function make_datatables(){  
//         $this->_query();  
//         if($_POST["length"] != -1)  
//         {  
//              $this->db->limit($_POST['length'], $_POST['start']);  
//         }  
//         $query = $this->db->get();  
//         return $query->result_array();  
//    } 

//    public function get_filtered_data(){  
//         $this->_query();  
//         return $this->db->get()->num_rows();  
//     }       
//     public function get_all_data()  
//     {  
//         $this->db->select("*");  
//         $this->db->from($this->table);  
//         if(!empty($this->where)){
//             $this->db->where($this->where);
//         }
//         return $this->db->count_all_results();  
        
//     }  


    public function save($data){
        $this->db->insert($this->table, $data);
    }

}