<?php  
/**
* 
*/
class Cari_model extends CI_Model
{
	
	function __construct(){
        parent::__construct();
    }
	public function getnamecategori($value){
        $this->db->where("id", $value)
                ->select("url")
                ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_text_category ($name) {
        $this->db->like("name", $name)
                ->select("name, parent, id")
                ->from("categori");
        return $query = $this->db->get();
    }
}