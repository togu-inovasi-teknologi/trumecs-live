<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("backend_model");

    }
	public function index()
	{
        $this->securitylog->cekadmin();
		$data['content'] = 'view_dashboard';
		$this->load->view('backend/template_front1', $data);
	}

    public function login()
    {
        $ses=$this->session->all_userdata();
        if (array_key_exists("admin", $ses)){
        }
        
        $this->load->view('login_page');
    }
    public function logout()
    {
        $this->session->unset_userdata("admin");
        $this->session->unset_userdata("Loginadmin");
        $this->session->unset_userdata('_tracker');
        redirect(base_url()."backend/login");
    }

    public function cek()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required'); 
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Email/Password yang anda masukkan salah.');
            redirect(base_url().'backend/login');
        }
        else
        {
            $data=array(
                    'email'=>$this->input->post('email'),
                    'password'=>md5($this->input->post('password')));
            $data["datauser"]=$this->backend_model->getadmin($data);
            if (empty($data["datauser"])) {
                $this->session->set_flashdata('message', 'Email/Password yang anda masukkan salah.');
                //echo "Salah";
            } else {
                $loginmember = array("Loginadmin"=>'TRUE');
                //echo "mane";
                $data = $data["datauser"]["0"] + $loginmember;
                $this->session->set_userdata("admin", "asdasdasd");
                $this->session->set_userdata("admin",$data);
                redirect(base_url()."backend/index");
            }           
        }
    }



}
