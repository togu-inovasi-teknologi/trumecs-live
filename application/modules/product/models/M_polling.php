<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_polling extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    public function getpolling($id){
        $this->db->where('id', $id);
        $result = $this->db->get('polling');
    
        
        return $result;
    }
    
    public function getoptions($id) {
        $this->db->where('id_polling', $id);
        $result = $this->db->get('polling_options');
        
        return $result;
    }
    
    public function check_session($data) {
        $this->db->where('session_id', $data['participant']['session_id']);
        $result = $this->db->get('polling_participant');
        
        if($result->num_rows() > 0){
            return false;
        } else {
            return true;
        }
    }
    
    public function saveanswer($data) 
    {
        $this->db->insert('polling_participant', $data['participant']);
        $id_participant = $this->db->insert_id();
        
        if(array_key_exists('answer', $data)){
            foreach($data['answer'] as $item){
                $this->db->set('id_polling', $data['id_polling']);
                $this->db->set('id_participant', $id_participant);
                $this->db->set('id_options', $item);
                $this->db->insert('polling_answer');
            }
            
        }
        
        $this->db->set('view', 'view + 1', false);
        $this->db->where('id', $data['participant']['id_polling']);
        $this->db->update('polling');
        
    }
    
    
}