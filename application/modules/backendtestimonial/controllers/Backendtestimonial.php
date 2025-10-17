<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backendtestimonial extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("usr_bck");

    }
	public function index()
	{
		$data['content'] = 'listall';
        $data["listfilter"]= $this->usr_bck->gettestimonial(array('id !=' => ""  ));
        $data["js"]= array(base_url().'asset/backend/js/backendtestimonial.js' );
		$this->load->view('backend/template_front1', $data);
	}
	

    public function update()
    {
        $where = array('id' => $this->input->get("id"));
        $set = array(
            'moderate' =>$this->input->get("status") 
         );

        $this->usr_bck->update($set,$where);
        redirect(base_url().'backendtestimonial');
    }


    public function updatetesti()
    {
        $where = array('id' => $this->input->post("id"));
        $set = array(
            'name' =>$this->input->post("name") ,
            'email' =>$this->input->post("email"),
            'date' =>$this->input->post("date"),
            'emote' =>$this->input->post("emote"),
            'content' =>nl2br($this->input->post("content"))
         );

        $this->usr_bck->update($set,$where);
        redirect(base_url().'backendtestimonial');
    }
    public function addtesti()
    {
        $set = array(
            'name' =>$this->input->post("name") ,
            'email' =>$this->input->post("email"),
            'date' =>$this->input->post("date"),
            'emote' =>$this->input->post("emote"),
            'moderate' =>"belum",
            'content' =>nl2br($this->input->post("content"))
         );

        $this->usr_bck->insert($set);
        redirect(base_url().'backendtestimonial');
    }
    
    public function hapustesti()
    {
        redirect(base_url().'backendtestimonial');
    }
}
