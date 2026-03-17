<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testnuxt extends MX_Controller
{


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    public function index()
    {
        // Data untuk dikirim ke view
        $data = [
            'nuxt_url' => 'http://localhost:3000',
            'current_page' => 'test',
            'ci3_base_url' => base_url()
        ];
        $data['content'] = 'index';
        // Load view sederhana
        $this->load->view('front/template_front', $data);
    }

    public function dashboard()
    {
        $data = [
            'nuxt_url' => 'http://localhost:3000/dashboard',
            'current_page' => 'dashboard',
            'ci3_base_url' => base_url()
        ];
        $data['content'] = 'index';

        $this->load->view('front/template_front', $data);
    }

    public function profile()
    {
        $data = [
            'nuxt_url' => 'http://localhost:3000/profile',
            'current_page' => 'profile',
            'ci3_base_url' => base_url()
        ];
        $data['content'] = 'index';

        $this->load->view('front/template_front', $data);
    }
}
