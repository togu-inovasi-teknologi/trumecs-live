<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_backendagent extends MX_Controller {
    function __construct()
    {
        parent::__construct();
    }
    
    public function get_all() {
        return $this->db->get('agent');
    }

    public function get($id) {
        $this->db->where('id', $id)->set('is_read', '1')->update('agent');
        $this->db->where('id', $id);
        return $this->db->get('agent');
    }
    
    public function save($data) {
        
        if($data['id'] != null) {
            $this->db->update('agent', $data, array('id' => $data['id']));
        } else {
            $this->db->insert('agent', $data);
        }
        
        return true;
    }

    public function get_new($last_id) {
        $this->db->where('is_read', '0');
        $this->db->where('id >', $last_id);
        return $this->get_all();
    }
	
}