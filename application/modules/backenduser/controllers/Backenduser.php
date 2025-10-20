<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backenduser extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("usr_bck");
    }
    public function index()
    {
        $data['content'] = 'view_dashboard';
        $this->load->view('backend/template_front', $data);
    }


    function ambil_data()
    {
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total = $this->db->count_all_results("admin");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->like("name", $search);
        }
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0'):
            $this->db->order_by('name', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '1'):
            $this->db->order_by('privileges', $_REQUEST['order'][0]['dir']);
        endif;
        $query = $this->db->limit(20, 0)->get('admin');
        if ($search != "") {
            $this->db->like("name", $search);
            $jum = $this->db->limit(20, 0)->get('admin');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        foreach ($query->result_array() as $user) {


            $output['data'][] = array(

                '<a class="fbold f14 forange" href="' . base_url() . 'backenduser/ddtttaaaiiill?id=' . $user["id"] . '">' . $user["name"] . '</a><br>',
                '<span>' . $user["privileges"] . '</span>',
                '<a class="btn btn-sm btn-danger" href="' . base_url() . 'backenduser/haspuuuuuussssssadminnnnn?id=' . $user["id"] . '"><i class="fa fa-trash"></i></a>'

            );
        }

        echo json_encode($output);
    }


    public function me()
    {
        $data['content'] = 'me';
        $this->load->view('backend/template_front', $data);
    }
    public function listall()
    {
        $data["listfilter"] = $this->usr_bck->get_admin(array());
        $data['content'] = 'listall';
        $this->load->view('backend/template_front', $data);
    }
    public function ddtttaaaiiill()
    {
        $where = array('admin.id' => $this->input->get("id"));
        $data["detail"] = $this->usr_bck->getdetail($where);
        if (empty($data["detail"])) {
            redirect(base_url() . 'backenduser/listall');
        }
        $data["previlage"] = $this->usr_bck->getprevilage();
        $data['content'] = 'detail';
        $this->load->view('backend/template_front', $data);
    }
    public function updateadminddtttaaaiiill()
    {
        $where = array('id' => $this->input->post("id"));
        $set = array(
            'name' => $this->input->post("name"),
            'email' => $this->input->post("email"),
            'privileges' => $this->input->post("levelprevilage"),
            'password' => ($this->input->post("password") != "") ? md5($this->input->post("password")) : $this->input->post("passwordold"),

        );

        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $this->input->post("email");
        $subject = "Aktifitas Admin";
        $message = "User admin TruMecs anda baru-baru ini telah berubah, jika anda tidak merubahnya maka laporkan aktifitas ini ke pihak Administrator";

        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
        if ($emailstatus = true) {
            $this->session->set_flashdata('message', 'Data user sudah di ganti, Aktifitas ini akan di informasikan ke email');
            $this->usr_bck->update($set, $where);
            redirect(base_url() . 'backenduser/listall');
        } else {
            $this->session->set_flashdata('message', 'Email yang anda masukkan tidak benar, Sehingga sistem tidak merubah data');
            redirect(base_url() . 'backenduser/listall');
        }
    }
    public function inputadminnnnnnnnxaxaxa()
    {
        $set = array(
            'name' => $this->input->post("name"),
            'email' => $this->input->post("email"),
            'privileges' => $this->input->post("levelprevilage"),
            'password' => md5($this->input->post("password")),

        );

        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $this->input->post("email");
        $subject = "Admin Trumecs";
        $message = "Anda telah menjadi admin pada trumecs.com, harap simpan sandi anda dengan baik. url login sebagai admin : www.trumecs.com/backend/admin";

        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
        if ($emailstatus = true) {
            $this->session->set_flashdata('message', 'Data user sudah ditambah, Aktifitas ini akan di informasikan ke email');
            $this->usr_bck->insert($set);
            redirect(base_url() . 'backenduser/listall');
        } else {
            $this->session->set_flashdata('message', 'Email yang anda masukkan tidak benar, Sehingga sistem tidak merubah data');
            redirect(base_url() . 'backenduser/listall');
        }
    }
    public function formaddddadaaaaa()
    {
        $data["previlage"] = $this->usr_bck->getprevilage();
        $data['content'] = 'formadd';
        $this->load->view('backend/template_front', $data);
    }
    public function updateadmin()
    {
        $where = array('id' => $this->input->post("id"));
        $set = array(
            'name' => $this->input->post("name"),
            'email' => $this->input->post("email"),
            'password' => ($this->input->post("password") != "") ? md5($this->input->post("password")) : $this->input->post("passwordold"),

        );

        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $this->input->post("email");
        $subject = "Aktifitas Admin";
        $message = "User admin TruMecs anda baru-baru ini telah berubah, jika anda tidak merubahnya maka laporkan aktifitas ini ke pihak Administrator";

        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
        if ($emailstatus = true) {
            $this->session->set_flashdata('message', 'Data user sudah di ganti, Aktifitas ini akan di informasikan ke email Anda');
            $this->usr_bck->update($set, $where);
            redirect(base_url() . 'backend/logout');
        } else {
            $this->session->set_flashdata('message', 'Email yang anda masukkan tidak benar, Sehingga sistem tidak merubah data Anda');
            redirect(base_url() . 'backenduser/me');
        }
    }
    public function haspuuuuuussssssadminnnnn()
    {
        $where = array('admin.id' => $this->input->get("id"));
        $data["detail"] = $this->usr_bck->getdetail($where);
        $detail = $data["detail"];
        $email = $detail[0]["email"];
        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $email;
        $subject = "Aktifitas Admin";
        $message = "user admin trumecs anda sudah dinonaktifkan oleh Administrator";
        $set = array('privileges' => "");
        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
        $this->session->set_flashdata('message', 'Data user sudah di hapus, Aktifitas ini akan di informasikan ke email');
        $this->usr_bck->update($set, $where);
        redirect(base_url() . 'backenduser/listall');
    }
}
