<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("member/member_model");
        $this->load->model("member/store_model");
        $this->load->model("order/order_model");
        $this->load->model("order/order_item_model");
        $this->load->model("backendorder/etx_model");
        $this->load->language("member/bulk");
        $this->load->language("member/order");
    }

    public function session_member()
    {
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $where = array('member.id' => $sessionmember["id"]);
        $member = $this->member_model->getmember($where);
        return $member;
    }

    public function index()
    {
        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "modules/member/css/member.css", base_url() . "asset/datatables/dataTables.bootstrap.css", base_url() . "asset/datatables/jquery.dataTables.min.css");
        $data["js"] = array(base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/member_page.js", "/modules/member/js/member/member.js");
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $where = array('idmember' => $sessionmember["id"]);
        $data["list"] = $this->member_model->getconfirmation($where);
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'member/desktop/view_member';
            $data["contentmember"] = "member/desktop/member/_confirmation_list";
        } else {
            $data['content'] = 'member/mobile/view_member';
            $data["contentmember"] = "member/mobile/member/_confirmation_list";
        }
        $this->load->view('front/template_front', $data);
    }

    public function detail($id)
    {

        $orderModel = new Order_model(['id' => $id]);
        $orderModel->db_set();
        $orderModel->get();

        $data['order'] = $orderModel;

        $this->securitylog->cekloginmember();
        $data["member"] = $this->session_member();
        $data['store'] = $this->store_model->getstore(['member_id' => $this->session_member()[0]['id']]);
        $data["css"] = array(base_url() . "asset/css/member_page.css", "modules/member/css/member.css", base_url() . "asset/datatables/dataTables.bootstrap.css", base_url() . "asset/datatables/jquery.dataTables.min.css");
        $data["js"] = array(base_url() . "asset/datatables/jquery.dataTables.min.js", base_url() . "asset/datatables/dataTables.bootstrap.min.js", base_url() . "asset/js/member_page.js", "/modules/member/js/member/member.js");
        $session = $this->session->all_userdata();
        $sessionmember = $session["member"];
        $data["store"] = $this->store_model->checkstore($sessionmember["id"]);
        $where = array('idmember' => $sessionmember["id"]);
        $data["list"] = $this->member_model->getconfirmation($where);
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'member/desktop/view_member';
            $data["contentmember"] = "desktop/order_detail";
        } else {
            $data['content'] = 'member/mobile/view_member';
            $data["contentmember"] = "mobile/order_detail";
        }
        $this->load->view('front/template_front', $data);
    }


    public function upload_payment_file()
    {
        $dir = 'order';
        $orderid = $this->input->post('order_id');
        if (do_upload_file('file_payment', $dir)) {

            $order['id'] = $orderid;
            $order['file_payment'] = $this->upload->data('file_name');
            $order['status'] = 'waiting_delivery';


            $orderModel = new Order_model($order);

            $orderModel->db_set();

            if ($orderModel->save($order) > 0) {
                redirect('/member/orders/detail/' . $orderid);
            } else {
                $this->session->set_flashdata('error_uploaded_po', 'failed uploaded file');
                redirect('/member/orders/detail/' . $orderid);
            }
        } else {
            $this->session->set_flashdata('error_uploaded_po', $this->upload->display_errors());
            redirect('/member/orders/detail/' . $orderid);
        }
    }

    public function po()
    {
        $dir = 'order';

        if (do_upload_file('file_po', $dir)) {

            $order['id'] = $this->input->post('order_id');
            $order['file_po'] = $this->upload->data('file_name');
            $order['status'] = 'waiting_invoice';


            $orderModel = new Order_model($order);

            $orderModel->db_set();

            if ($orderModel->save($order) > 0) {
                redirect('/member/orders/detail/' . $order['id']);
            } else {
                $this->session->set_flashdata('error_uploaded_po', 'failed uploaded file');
                redirect('/member/orders/detail/' . $order['id']);
            }
        } else {
            $this->session->set_flashdata('error_uploaded_po', $this->upload->display_errors());
            redirect('/member/orders/detail/' . $order['id']);
        }
    }

    public function receive()
    {
        $order_id = $this->input->post('order_id');

        if (do_upload_file('file_receive', 'order')) {


            $order['id'] = $this->input->post('order_id');
            $order['file_receive'] = $this->upload->data('file_name');
            $order['status'] = 'complete';



            $orderModel = new Order_model($order);

            $orderModel->db_set();

            if ($orderModel->save($order) > 0) {
                $this->etx_model->check_referral(['id' => $order_id]);
                $this->etx_model->check_cashback(['id' => $order_id]);
                $this->etx_model->check_marketing(['id' => $order_id]);
                redirect('/member/orders/detail/' . $order_id);
            } else {
                $this->session->set_flashdata('error_uploaded_po', 'failed uploaded file');
                redirect('/member/orders/detail/' . $order_id);
            }
        } else {
            $this->session->set_flashdata('error_uploaded_po', $this->upload->display_errors());
            redirect('/member/orders/detail/' . $order_id);
        }
    }
}
