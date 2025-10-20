<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("M_Prospek");
        $this->load->library("Date");
    }

    public function index()
    {
        $data["js"] = array(
            base_url() . 'asset/backend/js/list-prospek.js'
        );
        $data['js_cdn'] = '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>';
        $data['css_cdn'] = '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"></script>';
        $data['list'] = $this->M_Prospek->get_all();
        $data['content'] = 'v_admin';
        $this->load->view('backend/template_front', $data);
    }

    public function detail($id_prospek = null)
    {
        $data["js"] = array(
            base_url() . 'asset/backend/js/detail-prospek.js'
        );
        $data['detail'] = $this->M_Prospek->get_detail($id_prospek);
        $data['sales'] = $this->M_Prospek->get_sales();
        $data['history'] = $this->M_Prospek->get_history($id_prospek);
        $data['kontak'] = $this->M_Prospek->get_prospek_kontak($id_prospek);
        $data['content'] = 'detail_admin';
        $this->M_Prospek->view_prospek($id_prospek);
        $this->load->view('backend/template_front', $data);
    }

    public function assign($id_prospek)
    {
        if ($this->input->post()):
            $data['id_sales'] = $this->input->post('id_sales');
            $this->M_Prospek->assign($id_prospek, $data);
            $this->session->set_flashdata('status', 'success');
            redirect('backendprospek/admin/detail/' . $id_prospek);
        else:
            redirect();
        endif;
    }

    public function set_company_info($id_prospek)
    {
        if ($this->input->post()) {
            $data['company'] = $this->input->post('company');
            $data['company_phone'] = $this->input->post('company_phone');
            $data['company_email'] = $this->input->post('company_email');
            $data['company_address'] = $this->input->post('company_address');
            $data['category'] = $this->input->post('category');
            $data['status'] = $this->input->post('status');
            $data['valid'] = $this->input->post('valid');
            $data['additional_information'] = $this->input->post('additional_information');
            $this->M_Prospek->update_prospek($id_prospek, $data);
            redirect('backendprospek/admin/detail/' . $id_prospek);
        } else {
            redirect($this->index());
        }
    }

    public function delete_kontak($id_prospek, $id_kontak)
    {
        $this->M_Prospek->delete_kontak($id_prospek, $id_kontak);
        redirect('backendprospek/admin/detail/' . $id_prospek);
    }

    public function add_kontak($id_prospek)
    {
        if ($this->input->post()) {
            $data['id_prospek'] = $id_prospek;
            $data['name'] = $this->input->post('name');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['position'] = $this->input->post('position');
            $data['additional_information'] = $this->input->post('additional_information');
            $this->M_Prospek->add_kontak($data);
            redirect('backendprospek/admin/detail/' . $id_prospek);
        } else {
            redirect('backendprospek/admin/detail/' . $id_prospek);
        }
    }

    public function get_detail_kontak()
    {
        if ($this->input->is_ajax_request()) {
            $kontak = $this->M_Prospek->get_detail_kontak($this->input->post('id_kontak'));
            echo json_encode(array(
                'result' => 'success',
                'id_kontak' => $kontak->row()->id,
                'name' => $kontak->row()->name,
                'phone' => $kontak->row()->phone,
                'email' => $kontak->row()->email,
                'position' => $kontak->row()->position,
                'additional_information' => $kontak->row()->additional_information,
            ));
        } else {
            echo json_encode(array('result' => 'error'));
        }
    }

    public function update_kontak($id_prospek)
    {
        if ($this->input->post()) {
            $data['id_prospek'] = $id_prospek;
            $id_kontak = $this->input->post('id_kontak');
            $data['name'] = $this->input->post('name');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['position'] = $this->input->post('position');
            $data['additional_information'] = $this->input->post('additional_information');
            $this->M_Prospek->update_kontak($id_kontak, $data);
            redirect('backendprospek/admin/detail/' . $id_prospek);
        } else {
            redirect('backendprospek/admin/detail/' . $id_prospek);
        }
    }

    public function add()
    {
        $data['content'] = 'add_prospek';
        $this->load->view('backend/template_front', $data);
    }

    public function add_prospek()
    {
        if ($this->input->post()) {
            $data['company'] = $this->input->post('company');
            $data['company_phone'] = $this->input->post('company_phone');
            $data['company_email'] = $this->input->post('company_email');
            $data['company_address'] = $this->input->post('company_address');
            $data['category'] = $this->input->post('category');
            $data['status'] = 1;
            $data['valid'] = 0;
            $data['name'] = $this->input->post('name');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['position'] = $this->input->post('position');
            $data['additional_information'] = $this->input->post('additional_information');
            $data['type'] = 'new';
            $data['title'] = 'Prospek Baru';
            $data['description'] = 'Prospek ini baru saja ditambahkan oleh admin secara manual';
            $id_prospek = $this->M_Prospek->set_prospek($data);
            redirect('backendprospek/admin/detail/' . $id_prospek);
        } else {
            redirect();
        }
    }

    public function get_new()
    {
        $data = $this->M_Prospek->get_new($this->input->post('last_id'));
        $list = array();
        $last = $this->input->post('last_id');

        if ($data->num_rows() > 0) {
            $last = $data->row()->id;
            foreach ($data->result() as $key => $item) {
                $list[] = array(
                    "0" => $item->id,
                    "1" => '<a href="' . site_url('backendprospek/admin/detail/' . $item->id) . '" style="color:#fff;">' . $item->company . ' <span class="label label-success" style="font-weight:bold">new</span>',
                    "2" => $item->name,
                    "3" => $item->phone,
                    "4" => $item->sales_name,
                    "5" => $item->valid == 0 ? 'Belum Diperiksa' : ($item->valid == 1 ? 'Valid' : 'Tidak Valid'),
                    "6" => $item->status == 0 ? 'Belum Dihubungi' : 'Sudah Dihubungi'
                );
            }
        }

        echo json_encode(array(
            'number' => $data->num_rows(),
            'list' => $list,
            'last' => $last
        ));
    }

    public function send_quote($id_prospek)
    {
        $config['upload_path']          = './public/filequotation';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 25000;
        $config['encrypt_name']         = true;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload('quote')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error);
        } else {
            $data = $this->upload->data();
            $this->M_Prospek->save_quote($id_prospek, $data['file_name']);
        }

        redirect('backendprospek/admin/detail/' . $id_prospek);
    }
}
