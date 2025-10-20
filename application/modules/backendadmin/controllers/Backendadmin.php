<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendadmin extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
    }
    public function index() {}


    public function rule()
    {
        $id = $this->input->get("id");
        if ($id) {
            //$data["detail"] = $this->etx_model->getrule($this->input->get("id"));
            $data["detail"] = $this->etx_model->getrule($id);
            if (empty($data["detail"])) {

                redirect(base_url() . 'backendadmin/rule');
            }
        }

        $data["js"] = array(base_url() . 'asset/backend/js/rule.backendadmin.js');
        $data["rule"] = $this->etx_model->getruletable();
        $data["menu"] = $this->etx_model->getmenutable();
        $data['content'] = 'rule';
        $data['id'] = $id;
        $this->load->view('backend/template_front', $data);
    }
    public function addrule()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url() . 'backendadmin/rule');
        } else {

            $menu = $this->input->post("menu");
            $str_menu = "";
            foreach ($menu as $key) {
                $str_menu .= $key . ",";
            }
            $set = array(
                'description' => $this->input->post("description"),
                'name' => $this->input->post("name"),
                'menu' => $str_menu,
            );
            $this->session->set_flashdata('message', 'Rule baru telah ditambah');
            $this->etx_model->inputrule($set);
        }
        redirect(base_url() . 'backendadmin/rule');
    }

    public function editrule()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url() . 'backendadmin/rule');
        } else {

            $menu = $this->input->post("menu");
            $str_menu = "";
            foreach ($menu as $key) {
                $str_menu .= $key . ",";
                $sub = $this->etx_model->getSubMenu($key);
                foreach ($sub as $item):
                    $str_menu .= $item['id'] . ",";
                endforeach;
            }
            $set = array(
                'description' => $this->input->post("description"),
                'name' => $this->input->post("name"),
                'menu' => $str_menu,
            );
            $this->session->set_flashdata('message', 'Rule baru telah diedit');
            $this->etx_model->updaterule(array('id' => $this->input->post("id")), $set);
        }
        redirect(base_url() . 'backendadmin/rule');
    }
    public function hapusrule()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->hapusrule($where);
        $this->session->set_flashdata('message', 'Rule telah dihapus');
        redirect(base_url() . 'backendadmin/rule');
    }

    public function menuurl()
    {
        $id = $this->input->get("id");
        if ($id) {
            $data["detail"] = $this->etx_model->getmenu($id);
            if (empty($data["detail"])) {
                redirect(base_url() . 'backendadmin/menuurl');
            }
        }
        $data["js"] = array(base_url() . 'asset/backend/js/rule.backendadmin.js');

        $data["menu"] = $this->etx_model->getmenutable();
        $data['content'] = 'menuurl';
        $data['id'] = $id;
        $this->load->view('backend/template_front', $data);
    }


    public function addmenu()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('prn', 'Prn', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url() . 'backendadmin/menuurl');
        } else {
            $set = array(
                'icon' => $this->input->post("icon"),
                'name' => $this->input->post("name"),
                'prn' => $this->input->post("prn"),
                'url' => $this->input->post("url")
            );
            $this->session->set_flashdata('message', 'Menu baru telah ditambah');
            $this->etx_model->inputmenu($set);
        }
        redirect(base_url() . 'backendadmin/menuurl');
    }

    public function editmenu($value = '')
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('prn', 'Prn', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url() . 'backendadmin/menuurl');
        } else {
            $set = array(
                'icon' => $this->input->post("icon"),
                'name' => $this->input->post("name"),
                'prn' => $this->input->post("prn"),
                'url' => $this->input->post("url")
            );
            $where = array('id' => $this->input->post("id"));
            $this->session->set_flashdata('message', 'Menu telah berubah');
            $this->etx_model->updatemenu($where, $set);
        }
        redirect(base_url() . 'backendadmin/menuurl');
    }

    public function hapusmenu()
    {
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->hapusmenu($where);
        $this->session->set_flashdata('message', 'Menu telah dihapus');
        redirect(base_url() . 'backendadmin/menuurl');
    }
}
