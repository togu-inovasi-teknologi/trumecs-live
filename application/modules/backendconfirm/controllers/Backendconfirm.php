<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendconfirm extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
    }
    public function index()
    {
        $status = $this->input->get("status");
        $idorder = $this->input->get("idorder");
        $data["datawhere"] = array();
        if ($status != "all") {
            $data["datawhere"] = array("status" => $status);
        }
        if (!empty($idorder)) {
            $data["datawhere"] = array_merge($data["datawhere"], array("idorder" => $idorder));
        }

        //$config["per_page"] = $this->etx_model->record_count($data["datawhere"]);
        $config["per_page"] = 10;

        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page, $data["datawhere"]);

        //$data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        $data['content'] = 'list_order';
        $this->load->view('backend/template_front1', $data);
    }


    function ambil_data()
    {
        $status = $this->input->post("status");
        $idorder = $this->input->get("idorder");
        $data["datawhere"] = array();
        if ($status != "all") {
            $data["datawhere"] = array("status" => $status);
        }
        if (!empty($idorder)) {
            $data["datawhere"] = array_merge($data["datawhere"], array("id" => $idorder));
        }
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $this->db->where($data["datawhere"]);
        $total = $this->db->count_all_results("confirmation");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->where("(
							idorder LIKE '%$search%' 
							OR date LIKE '%$search%'
							OR bank LIKE '%$search%'
                        )", '', false);
        }
        $this->db->where($data["datawhere"]);
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0') :
            $this->db->order_by('idorder', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '1') :
            $this->db->order_by('date', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '2') :
            $this->db->order_by('bank', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '3') :
            $this->db->order_by('status', $_REQUEST['order'][0]['dir']);
        endif;
        $query = $this->db->get('confirmation');
        if ($search != "") {
            $this->db->where("(
							idorder LIKE '%$search%' 
							OR date LIKE '%$search%'
							OR bank LIKE '%$search%'
                            
                        )", '', false);
            $jum = $this->db->get('confirmation');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        foreach ($query->result_array() as $confirmation) {


            $s = $confirmation["status"] != "rejected" ? $confirmation["status"] != "new" ? "success" : "warning" : "danger";

            $output['data'][] = array(

                '<a class="fbold f14 forange" href="' . base_url() . 'backendconfirm/detail/' . $confirmation["idorder"] . '">' . $confirmation["idorder"] . '</a><br><small><a class="fblack" href="' . base_url() . 'backendmember/detail/' . $confirmation["idmember"] . '">Lihat Pemesan</a></small>',

                '<span class="fbold f14 black">' . $confirmation['date'] . '</span><br><small class="fbold f12 black">' . $confirmation['datetranfer'] . '</small>',

                '<span class="fbold f14 black">' . $confirmation["bank"] . '</span><br><small class="fbold f12 black">' . $confirmation["norek"] . '</small>',

                '<span  class="fbold f14 black label label-' . $s . '">' . $confirmation["status"] . '</span><br>'
            );
        }

        echo json_encode($output);
    }


    public function detail($id)
    {
        $where = array("idorder" => $id);
        $data["detailconfirm"] = $this->etx_model->getconfirm($where);
        if (empty($data["detailconfirm"])) {
            $this->session->set_flashdata('message', 'Pesanan tidak ada di database');
        }

        $data["detailconfirm"]['order']['listdetail'];
        $data['content'] = 'detail';
        $this->load->view('backend/template_front1', $data);
    }

    public function updateconfirm()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('iduniq', 'Iduniq', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Sistem mengalami kendala saat update');
            redirect(base_url() . "backendconfirm/?status=all");
            exit();
        }
        $where = array('id' => $this->input->post('id'));
        $set = array();
        if (!empty($this->input->post("comment"))) {
            $set = array_merge($set, array('comment' => $this->input->post("comment")));
        }
        if (!empty($this->input->post("status"))) {
            $set = array_merge($set, array('status' => $this->input->post("status")));
            $dataemail["name"] = $this->input->post("membername");
            $dataemail["status"] = $this->input->post("status");
            $dataemail["order_id"] = $this->input->post("iduniq");

            $from = "no-reply@trumecs.com";
            $password = "no-reply#trumecs#123abc";

            if ($this->input->post("status") == "approved") {
                $setpaid = array('status' => "paid");
                $whereiduniq = array('iduniq' => $this->input->post("iduniq"));
                $tonextadmin = "robeth.lobunta@gmail.com";
                $subject = "Segera Proses Order #" . $dataemail["order_id"];
                $message = 'Dear Admin,<br>Mohon di cek admin trumecs, permintaan baru untuk memproses id order ' . $dataemail["order_id"] . '.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
                $this->sentemailnotiftoadmin($message, $subject, "4");
                #$emailstatus = $this->emailer->sent($from,$password,$tonextadmin,$subject,$message);
                $this->etx_model->updateorder($whereiduniq, $setpaid);
            }
            $to = $this->input->post('email');
            $subject = "Status Konfirmasi Pembayaran";
            $message = $this->load->view('email_confirmation', $dataemail, true);
            $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);

            $this->session->set_flashdata('message', 'Konfirmasi telah di ' . $this->input->post("status"));
        }
        $this->etx_model->update($where, $set);
        redirect(base_url() . 'backendconfirm/detail/' . $this->input->post("iduniq"));
    }

    public function hapus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $where = array('id' => $this->input->get("id"));
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Produk telah dihapus');
        if (isset($last_page)) {
            redirect($last_page);
        } else {
            redirect(base_url() . 'backendproduct/list');
        }
    }

    private function sentemailnotiftoadmin($pesan, $judul, $kebagian)
    {
        $data = $this->etx_model->get_admin(array('admin.privileges' => $kebagian));
        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        foreach ($data as $key) {
            $tonextadmin = $key["email"];
            $subject = $judul . " - " . date("dmY:His");
            $message = $pesan;
            $emailstatus = $this->emailer->sent($from, $password, $tonextadmin, $subject, $message);
        }
    }

    public function withdrawal()
    {
        $this->load->library('Date');
        $status = $this->input->get("status");
        $idorder = $this->input->get("id");
        $data["datawhere"] = array();
        if ($status != "all") {
            $data["datawhere"] = array("status" => $status);
        }
        if (!empty($idorder)) {
            $data["datawhere"] = array_merge($data["datawhere"], array("id" => $idorder));
        }

        //$config["per_page"] = $this->etx_model->record_count($data["datawhere"]);
        $config["per_page"] = 10;

        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_withdraw($config["per_page"], $page, $data["datawhere"]);

        //$data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        $data['content'] = 'list_withdraw';
        $this->load->view('backend/template_front1', $data);
    }

    function ambil_data_withdraw()
    {
        $status = $this->input->post("status");
        $idorder = $this->input->get("name");
        $data["datawhere"] = array();
        if ($status != "all") {
            $data["datawhere"] = array("status" => $status);
        }
        if (!empty($idorder)) {
            $data["datawhere"] = array_merge($data["datawhere"], array("id" => $idorder));
        }
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $this->db->where($data["datawhere"]);
        $total = $this->db->count_all_results("coin_withdrawal");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->where("(
							name LIKE '%$search%' 
							OR date LIKE '%$search%'
							OR bank_holder LIKE '%$search%'
                        )", '', false);
        }
        $this->db->where($data["datawhere"]);
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0') :
            $this->db->order_by('id', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '1') :
            $this->db->order_by('amount', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '2') :
            $this->db->order_by('name', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '3') :
            $this->db->order_by('status', $_REQUEST['order'][0]['dir']);
        endif;
        $query = $this->db->get('confirmation');
        if ($search != "") {
            $this->db->where("(
							id LIKE '%$search%' 
							OR date LIKE '%$search%'
							OR bank_holder LIKE '%$search%'
                            
                        )", '', false);
            $jum = $this->db->get('coin_mutation');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        foreach ($query->result_array() as $confirmation) {


            $s = $confirmation["status"] != "failed" ? $confirmation["status"] != "waiting" ? "success" : "warning" : "danger";

            $output['data'][] = array(

                '<a class="fbold f14 forange" href="' . base_url() . 'backendconfirm/detail_withdraw/' . $confirmation["id"] . '">' . $confirmation["id"] . '</a><br><small><a class="fblack" href="' . base_url() . 'backendmember/detail/' . $confirmation["user_id"] . '">Lihat Pemesan</a></small>',

                '<span class="fbold f14 black">' . $confirmation['created_at'] . '</span><br><small class="fbold f12 black">' . $confirmation['created_at'] . '</small>',

                '<span class="fbold f14 black">' . $confirmation["bank_name"] . '</span><br><small class="fbold f12 black">' . $confirmation["bank_account"] . '</small>',

                '<span  class="fbold f14 black label label-' . $s . '">' . $confirmation["status"] . '</span><br>'
            );
        }

        echo json_encode($output);
    }

    public function detail_withdraw($id)
    {
        $where = array("id" => $id);
        $data["detail"] = $this->etx_model->get_withdraw($where);
        if (empty($data["detail"])) {
            $this->session->set_flashdata('message', 'Penarikan tidak ada di database');
        }

        //$data["detail"]['order']['listdetail'];
        $data['content'] = 'detail_withdraw';
        $this->load->view('backend/template_front1', $data);
    }

    public function update_withdraw()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $id = $this->input->post("id");
        $where = array("id" => $id);
        $detail = $this->etx_model->get_withdraw($where);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Sistem mengalami kendala saat update');
            redirect(base_url() . "backendconfirm/withdrawal?status=all");
            exit();
        }
        $config['upload_path'] = './export/trucoin/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->db->trans_start();
        if (!$this->upload->do_upload("file")) {
            $this->session->set_flashdata('message', 'Gagal mengupload foto bukti' . $this->upload->display_errors());
            redirect(base_url() . 'backendconfirm/detail_withdraw/' . $id);
            exit();
        } else {
            $data = $this->upload->data();
            $set = array();
            $setpaid = [];
            $setpaid = array_merge($setpaid, array('file_transfer' => $data["file_name"]));
            $where = array('id' => $id);
            if (!empty($this->input->post("description"))) {
                $setpaid = array_merge($setpaid, array('description' => $this->input->post("description")));
            }
            if (!empty($this->input->post("status"))) {
                $set = array_merge($set, array('status' => $this->input->post("status")));
                $dataemail["name"] = $this->input->post("membername");
                $dataemail["status"] = $this->input->post("status");
                $dataemail["id"] = $id;

                $from = "no-reply@trumecs.com";
                $password = "no-reply#trumecs#123abc";

                if ($this->input->post("status") == "success") {
                    $setpaid = array_merge($setpaid, array('status' => "success"));
                    $whereiduniq = array('id' => $id);
                    $tonextadmin = "bimo@togu.co.id";
                    $subject = "Segera Proses Order #" . $dataemail["id"];
                    $message = 'Dear Admin,<br>Mohon di cek admin trumecs, permintaan baru untuk memproses id order ' . $dataemail["id"] . '.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
                    $this->sentemailnotiftoadmin($message, $subject, "4");
                    #$emailstatus = $this->emailer->sent($from,$password,$tonextadmin,$subject,$message);
                    $whereiduniq = array('reference_id' => $detail['withdrawal']['id'], 'reference' => 'withdraw');
                    $this->etx_model->update_mutation($whereiduniq, $setpaid);
                    $whereidmember = array('id' => $detail['detailmember']['id']);
                    $setsaldo = array('point' => $detail['detailmember']['point'] - $detail["withdrawal"]['total']);
                    $this->etx_model->update_member($whereidmember, $setsaldo);
                }
                $to = $this->input->post('email');
                $subject = "Status Penarikan Saldo";
                $message = $this->load->view('email_confirmation', $dataemail, true);
                $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);

                $this->session->set_flashdata('message', 'Konfirmasi telah di ' . $this->input->post("status"));
            }
        }
        $this->etx_model->update_withdraw($where, $set);
        $this->db->trans_complete();
        redirect(base_url() . 'backendconfirm/detail_withdraw/' . $id);
    }
}