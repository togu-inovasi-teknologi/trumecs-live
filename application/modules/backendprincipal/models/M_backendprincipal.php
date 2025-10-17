<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_backendprincipal extends MX_Controller {
    function __construct()
    {
        parent::__construct();
    }
    
    public function get_all() {
        return $this->db->get('principal');
    }

    public function get($id) {
        $this->db->where('id', $id)->set('is_read', '1')->update('principal');
        $this->db->where('id', $id);
        return $this->db->get('principal');
    }
    
    public function save($data) {
        
        if($data['id'] != null) {
            $this->db->update('principal', $data, array('id' => $data['id']));
        } else {
            $this->db->insert('principal', $data);
        }
        
        return true;
    }

    public function get_new($last_id) {
        $this->db->where('is_read', '0');
        $this->db->where('id >', $last_id);
        return $this->get_all();
    }
	
}