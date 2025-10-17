<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_principal extends MX_Controller {
    function __construct()
    {
        parent::__construct();
    }
    
    public function save($data) {
        $this->db->insert('principal', $data);
        return true;
    }
	
}