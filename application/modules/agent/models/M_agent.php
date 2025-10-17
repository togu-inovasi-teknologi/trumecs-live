<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_agent extends MX_Controller {
    function __construct()
    {
        parent::__construct();
    }
    
    public function save($data) {
        $this->db->insert('agent', $data);
        return true;
    }
	
}