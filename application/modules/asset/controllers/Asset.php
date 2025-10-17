<?php
#defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function _remap($param) {
        $this->index($param);
    }
	public function index()
	{/*
		if (is_numeric(($this->input->get("id")))){
			$id=$this->input->get("id");
		}else{
			redirect(base_url());
		}

		$name= $this->input->get("nama");

		$name = str_replace(' ', '-', $name); // Replaces all spaces with hyphens.
   		$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name); // Removes special chars.
   		$name= preg_replace('/-+/', '-', strtolower($name)); // Replaces multiple hyphens with single one.*/
   		echo "none";
		//redirect(base_url()."product/".$id."/".$name);
	}

}