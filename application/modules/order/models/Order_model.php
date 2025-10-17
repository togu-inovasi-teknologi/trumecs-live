<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    var $table = "order";
    var $order_column = array('o.id', 'iduniq', 'time', 'status', 'count(od.id) as total_item', 'payment_total');
    var $select_column = array('o.id', 'iduniq', 'time', 'status', 'count(od.id) as total_item', 'payment_total');
    var $search_column = array('o.id', 'iduniq', 'time', 'status', 'total_item', 'payment_total');

    public $id, $iduniq, $time, $expired, $session, $idmember, $status, $billing_name, $billing_company, $billing_address, $billing_province, $billing_city, $billing_kodepos, $billing_phone, $shipping_name, $shipping_company, $shipping_address, $shipping_city, $shipping_province, $shipping_kodepos, $shipping_phone, $shipping_cost, $shipping_description, $shipping_resi, $comment, $ppn, $payment_cut, $payment_total, $point, $referral_code, $file_po, $file_invoice, $file_payment, $file_receive, $total_price, $total_item, $file_delivery;

    function __construct($data = [])
    {

        if (!empty($data))
            $this->_set($data);
        parent::__construct();
    }

    public function db_set()
    {

        if ($this->iduniq != null)
            $this->db->set('iduniq', $this->iduniq);
        if ($this->time != null)
            $this->db->set('time', $this->time);
        if ($this->expired != null)
            $this->db->set('expired', $this->expired);
        if ($this->session != null)
            $this->db->set('session', $this->session);
        if ($this->idmember != null)
            $this->db->set('idmember', $this->idmember);
        if ($this->status != null)
            $this->db->set('status', $this->status);
        if ($this->billing_name != null)
            $this->db->set('billing_name', $this->billing_name);
        if ($this->billing_company != null)
            $this->db->set('billing_company', $this->billing_company);
        if ($this->billing_address != null)
            $this->db->set('billing_address', $this->billing_address);
        if ($this->billing_province != null)
            $this->db->set('billing_province', $this->billing_province);
        if ($this->billing_city != null)
            $this->db->set('billing_city', $this->billing_city);
        if ($this->billing_kodepos != null)
            $this->db->set('billing_kodepos', $this->billing_kodepos);
        if ($this->billing_phone != null)
            $this->db->set('billing_phone', $this->billing_phone);
        if ($this->shipping_name != null)
            $this->db->set('shipping_name', $this->shipping_name);
        if ($this->shipping_company != null)
            $this->db->set('shipping_company', $this->shipping_company);
        if ($this->shipping_address != null)
            $this->db->set('shipping_address', $this->shipping_address);
        if ($this->shipping_city != null)
            $this->db->set('shipping_city', $this->shipping_city);
        if ($this->shipping_province != null)
            $this->db->set('shipping_province', $this->shipping_province);
        if ($this->shipping_kodepos != null)
            $this->db->set('shipping_kodepos', $this->shipping_kodepos);
        if ($this->shipping_phone != null)
            $this->db->set('shipping_phone', $this->shipping_phone);
        if ($this->shipping_cost != null)
            $this->db->set('shipping_cost', $this->shipping_cost);
        if ($this->shipping_description != null)
            $this->db->set('shipping_description', $this->shipping_description);
        if ($this->shipping_resi != null)
            $this->db->set('shipping_resi', $this->shipping_resi);
        if ($this->comment != null)
            $this->db->set('comment', $this->comment);
        if ($this->ppn != null)
            $this->db->set('ppn', $this->ppn);
        if ($this->payment_cut != null)
            $this->db->set('payment_cut', $this->payment_cut);
        if ($this->payment_total != null)
            $this->db->set('payment_total', $this->payment_total);
        if ($this->point != null)
            $this->db->set('point', $this->point);
        if ($this->referral_code != null)
            $this->db->set('referral_code', $this->referral_code);
        if ($this->file_po != null)
            $this->db->set('file_po', $this->file_po);
        if ($this->file_invoice != null)
            $this->db->set('file_invoice', $this->file_invoice);
        if ($this->file_payment != null)
            $this->db->set('file_payment', $this->file_payment);
        if ($this->file_receive != null)
            $this->db->set('file_receive', $this->file_receive);
        if ($this->file_delivery != null)
            $this->db->set('file_delivery', $this->file_delivery);

        if ($this->id != null) {
            $this->db->where('o.id', $this->id);
        }
    }

    private function _set($data)
    {

        $data = (array)$data;

        if (array_key_exists('id', $data))
            $this->id = $data['id'];
        if (array_key_exists('iduniq', $data))
            $this->iduniq = $data['iduniq'];
        if (array_key_exists('time', $data))
            $this->time = $data['time'];
        if (array_key_exists('expired', $data))
            $this->expired = $data['expired'];
        if (array_key_exists('session', $data))
            $this->session = $data['session'];
        if (array_key_exists('idmember', $data))
            $this->idmember = $data['idmember'];
        if (array_key_exists('status', $data))
            $this->status = $data['status'];
        if (array_key_exists('billing_name', $data))
            $this->billing_name = $data['billing_name'];
        if (array_key_exists('billing_company', $data))
            $this->billing_company = $data['billing_company'];
        if (array_key_exists('billing_address', $data))
            $this->billing_address = $data['billing_address'];
        if (array_key_exists('billing_province', $data))
            $this->billing_province = $data['billing_province'];
        if (array_key_exists('billing_city', $data))
            $this->billing_city = $data['billing_city'];
        if (array_key_exists('billing_kodepos', $data))
            $this->billing_kodepos = $data['billing_kodepos'];
        if (array_key_exists('billing_phone', $data))
            $this->billing_phone = $data['billing_phone'];
        if (array_key_exists('shipping_name', $data))
            $this->shipping_name = $data['shipping_name'];
        if (array_key_exists('shipping_company', $data))
            $this->shipping_company = $data['shipping_company'];
        if (array_key_exists('shipping_address', $data))
            $this->shipping_address = $data['shipping_address'];
        if (array_key_exists('shipping_city', $data))
            $this->shipping_city = $data['shipping_city'];
        if (array_key_exists('shipping_province', $data))
            $this->shipping_province = $data['shipping_province'];
        if (array_key_exists('shipping_kodepos', $data))
            $this->shipping_kodepos = $data['shipping_kodepos'];
        if (array_key_exists('shipping_phone', $data))
            $this->shipping_phone = $data['shipping_phone'];
        if (array_key_exists('shipping_cost', $data))
            $this->shipping_cost = $data['shipping_cost'];
        if (array_key_exists('shipping_description', $data))
            $this->shipping_description = $data['shipping_description'];
        if (array_key_exists('shipping_resi', $data))
            $this->shipping_resi = $data['shipping_resi'];
        if (array_key_exists('comment', $data))
            $this->comment = $data['comment'];
        if (array_key_exists('ppn', $data))
            $this->ppn = $data['ppn'];
        if (array_key_exists('payment_cut', $data))
            $this->payment_cut = $data['payment_cut'];
        if (array_key_exists('payment_total', $data))
            $this->payment_total = $data['payment_total'];
        if (array_key_exists('point', $data))
            $this->point = $data['point'];
        if (array_key_exists('referral_code', $data))
            $this->referral_code = $data['referral_code'];
        if (array_key_exists('file_po', $data))
            $this->file_po = $data['file_po'];
        if (array_key_exists('file_invoice', $data))
            $this->file_invoice = $data['file_invoice'];
        if (array_key_exists('file_payment', $data))
            $this->file_payment = $data['file_payment'];
        if (array_key_exists('file_delivery', $data))
            $this->file_delivery = $data['file_delivery'];
        if (array_key_exists('file_receive', $data))
            $this->file_receive = $data['file_receive'];
        if (array_key_exists('total_item', $data))
            $this->total_item = $data['total_item'];
        if (array_key_exists('total_price', $data))
            $this->total_price = $data['total_price'];
    }

    public function get()
    {
        $this->db->select('o.*, count(od.id) as total_item, sum(od.price) total_price');
        $this->db->from($this->table . ' o');
        $this->db->join('order_detail od', 'od.id_order = o.id');
        $this->db->group_by('o.id');
        $data = $this->db->get()->row_array();
        $this->_set($data);
    }

    private function _query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table . ' o');
        $this->db->join('order_detail od', 'od.id_order = o.id');
        $this->db->where('o.idmember', $this->idmember);
        if ($this->uri->segment(1) == 'member' && $this->uri->segment(2) == 'history') {
            $this->db->where('status', 'complete');
        }
        $this->db->order_by('o.id', 'desc');
        if (!empty($_POST["search"]["value"])) {
            $this->db->group_start();
            foreach ($this->search_column as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST["search"]["value"]);
                } else if ($key == 4) {
                    $this->db->having($value, $_POST["search"]["value"], 'both');
                } else {
                    $this->db->or_like($value, $_POST["search"]["value"], 'both');
                }
            }
            $this->db->group_end();
        }

        $this->db->group_by('o.id');

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }


    public function make_datatables()
    {
        $this->_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_filtered_data()
    {
        $this->_query();
        return $this->db->get()->num_rows();
    }
    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('idmember', $this->idmember);
        return $this->db->count_all_results();
    }
    public function update($data)
    {
        $this->db->update($this->table, $data);
    }

    public function save($data)
    {

        if ($this->id != null) {

            return $this->db->update($this->table . ' o');
        } else {
            return $this->db->insert($this->table);
        }
    }
}
