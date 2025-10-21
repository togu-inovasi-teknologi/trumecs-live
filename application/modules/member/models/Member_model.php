<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
    var $table = "member";
    var $order_column = array('m.id', 'm.name', 'm.email', 'm.phone', 'v.name as village_name', 'v.id as village_id', 'kodepos', 'address');
    var $select_column = array('m.id', 'm.name', 'm.email', 'm.phone', 'v.name as village_name', 'v.id as village_id', 'kodepos', 'address');
    var $search_column = array('m.id', 'm.name', 'm.email', 'm.phone');

    function __construct()
    {
        parent::__construct();
    }

    private function _query()
    {

        $this->db->select($this->select_column);
        $this->db->from($this->table . ' m');
        $this->db->join('villages v', 'v.id = m.village', 'LEFT');

        if (!empty($_POST["search"]["value"])) {
            $this->db->group_start();
            foreach ($this->search_column as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($value, $_POST["search"]["value"]);
                }
            }
            $this->db->group_end();
        }

        // $this->db->group_by('m.id');

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }


    public function make_datatables()
    {
        $this->db->reset_query();
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
        return $this->db->count_all_results();
    }


    public function getmember($data)
    {
        $this->db->reset_query();

        $this->db
            ->select("member.*, provinces.name as nm_provinces, regencies.name as nm_regencies, districts.name as nm_districts, villages.name as nm_villages")
            ->where($data)
            ->from("member")
            ->join("provinces", "provinces.id=member.provice", 'left')
            ->join("regencies", "regencies.id=member.city", 'left')
            ->join("districts", "districts.id=member.districts", 'left')
            ->join("villages", "villages.id=member.village", 'left');
        $query = $this->db->get();
        $member = $query->result_array();
        return $member;
    }
    public function getmemberjson()
    {
        $this->db
            ->select("member.*, provinces.name as nm_provinces, regencies.name as nm_regencies, districts.name as nm_districts, villages.name as nm_villages")
            ->from("member")
            ->join("provinces", "provinces.id=member.provice", 'left')
            ->join("regencies", "regencies.id=member.city", 'left')
            ->join("districts", "districts.id=member.districts", 'left')
            ->join("villages", "villages.id=member.village", 'left');

        $query = $this->db->get();
        $member = $query->result_array();
        return $member;
    }
    function alreadyRegister($nameColomn, $id)
    {
        $this->db->where($nameColomn, $id);
        $query = $this->db->get('member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertGoogle($data)
    {
        // Cek duplikat email dulu
        $this->db->where('email', $data['email']);
        $existing = $this->db->get('member')->row();

        if ($existing) {
            // Update existing user dengan google ID
            $this->db->where('id', $existing->id);
            $this->db->update('member', array('id_google' => $data['id_google']));
            return $existing->id;
        } else {
            // Insert baru
            $this->db->insert('member', $data);
            return $this->db->insert_id();
        }
    }

    public function insert($data)
    {
        // Cek duplikat berdasarkan EMAIL saja (bukan semua field)
        $this->db->where('email', $data['email']);
        $existing = $this->db->get('member')->row();

        if ($existing) {
            return $existing->id;
        } else {
            $this->db->insert("member", $data);
            return $this->db->insert_id();
        }
    }

    // Tambahkan method untuk cek by email saja
    public function get_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('member')->row();
    }

    public function get_by_google_id($google_id)
    {
        $this->db->where('id_google', $google_id);
        return $this->db->get('member')->row();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('member')->row();
    }

    public function edit_member($id, $data)
    {
        $this->db->where($id)
            ->update("member", $data);
    }
    public function update($where, $update)
    {
        $this->db->reset_query();
        $this->db->where($where)
            ->set($update)
            ->update("member");
    }


    public function insertUserSharing($members, $compareId)
    {
        foreach ($members as $key => $value) {
            $user = $this->db->get_where('member', ['email' => $value['email']])->row();
            if ($user == null) {
                $this->db->insert('member', $value);
                $user_id = $this->db->insert_id();
                $this->db->insert('sharing_compare_user', ['compare_id' => $compareId, 'user_id' => $user_id]);
            } else {
                $this->db->insert('sharing_compare_user', ['compare_id' => $compareId, 'user_id' => $user->id]);
            }
        }
    }


    public function get_orderhistory($limit, $start, $where)
    {
        $this->db->where($where)
            ->limit($limit, $start)
            ->order_by("id", "DESC");
        $query = $this->db->get("order");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = (array) $row;
            }
            return $data;
        }
        return false;
    }

    public function get_orderhistoryall($where)
    {
        $this->db->where($where)
            ->order_by("id", "DESC");
        $query = $this->db->get("order");
        return $query->result_array();
    }

    public function record_countorder($data)
    {
        $query = $this->db->where($data)
            ->from("order");
        return $query->get()->num_rows();
    }



    public function getorderdetail($value)
    {
        $query = $this->db->where($value)
            ->from("order");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getclaim($value)
    {
        $query = $this->db->where($value)
            ->from("complaint");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insertcomplaint($data)
    {
        $this->db->insert("complaint", $data);
    }

    public function getcomplaintwarranty($value)
    {
        $query = $this->db->where($value)
            ->from("complaintwarranty");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insertcomplaintwarranty($data)
    {
        $this->db->insert("complaintwarranty", $data);
    }


    public function insertstore($data)
    {
        $this->db->insert("store", $data);
    }

    public function insertconfirmation($data)
    {
        $this->db->insert("confirmation", $data);
    }

    public function getconfirmation($where)
    {
        $query = $this->db->where($where)->order_by("id", "DESC")->get("confirmation");
        return $query->result_array();
    }
    public function updateconfirmation($where, $update)
    {
        $this->db->where($where)->set($update)->update("confirmation");
    }

    public function delete()
    {
        # code...
    }

    public function activation($data)
    {
        $query1 = $this->db->where($data)
            ->from("member");
        $query1 = $this->db->get();
        $query1->result_array();
        if (count($query1) == NULL) {
            return false;
        } else {
            $this->db->where($data)
                ->set('status', 'active')
                ->set('level', 'silver')
                ->update("member");
            return true;
        }
    }

    public function recordhistory($where)
    {
        $query = $this->db->where($where)->from("order");
        return $query->get()->num_rows();
    }
    public function fecthistory($limit, $start, $where)
    {
        $this->db->limit($limit, $start)->where($where)->order_by("id", "DESC");
        $query = $this->db->get("order");
        return $query->result_array();
    }

    public function getcartorderdetail($data)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.id_order = order.id');
        $this->db->where($data);

        $order = $this->db->get();
        return $order->result_array();
    }

    public function getinvoice($data)
    {
        $array_merge = array();
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where($data);
        $order = $this->db->get();
        $returnorder = $order->result_array();
        if ($returnorder[0]["status"] == "unpaid") {
            redirect(base_url() . 'member/history_order/' . $returnorder[0]["id"]);
        }
        $getlist["listdetailorder"] = $this->listorderbyidorder(array('id_order' => $returnorder[0]["id"]));
        $arrayName = array_merge($returnorder[0], $getlist);
        return $arrayName;
    }

    public function getorderdetailv_2($data)
    {
        $array_merge = array();
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where($data);
        $order = $this->db->get();
        $returnorder = $order->result_array();
        $ar_phus = array();
        $i = 0;
        foreach ($returnorder as $key => $val) {
            $shippingcost = $returnorder[$i]["shipping_cost"];
            $getlist["listdetailorder"] = $this->listorderbyidorder(array('id_order' => $returnorder[$i]["id"]));
            $priceperorder = 0;
            foreach ($getlist["listdetailorder"]  as $kt) {
                $priceperproduct = $kt["price"] * $kt["quantity"];
                $$priceperorder = $priceperorder + $priceperproduct;
            }
            $bayar["totalbayar"] = $priceperproduct + $shippingcost;
            $masukinpertaman = array_merge($returnorder[$i], $bayar);
            $arrayName = array_merge($masukinpertaman, $getlist);
            array_push($ar_phus, $arrayName);
            $i++;
        }
        return $ar_phus;
    }

    private function listorderbyidorder($data)
    {
        $this->db->select('*');
        $this->db->from('order_detail');
        $this->db->where($data);
        $order = $this->db->get();
        $returnorder = $order->result_array();
        return $returnorder;
    }

    public function inserttestimonial($data)
    {
        $this->db->insert("testimonial", $data);
    }
    public function gettestimonial($id = null)
    {
        $this->db->from('testimonial');
        if ($id != null) {
            $this->db->where("id_member", $id);
        } else {
            $this->db->where("moderate", "sudah");
        }

        $this->db->order_by("id", "DESC");
        $testimoni = $this->db->get();
        return $testimoni->result_array();
    }

    public function get_admin($where)
    {
        $this->db
            ->select("name,email")
            ->where($where)
            ->from("admin");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getsetting($name)
    {
        $this->db->select("value")->where("name", $name)
            ->from("setting");
        $query = $this->db->get();
        $array = $query->result_array();
        return $array["0"]["value"];
    }
    public function updatesetting($where, $set)
    {
        $this->db->where($where)->update("setting", $set);
    }

    public function getprovinces()
    {
        $order = $this->db->get("provinces");
        return $order->result_array();
    }

    public function get_tender($iduser)
    {
        $this->db->where('id_user', $iduser);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tender');
        return $result;
    }

    public function get_penawaran($iduser)
    {
        $this->db->select('*, mailbox.id AS id');
        $this->db->where('id_user', $iduser);
        $this->db->order_by('mailbox.id', 'DESC');
        $this->db->group_by('mailbox.id');
        $this->db->join('prospek_history', 'prospek_history.id_prospek = mailbox.id AND type = "buy"');
        $this->db->join('prospek_kontak', 'prospek_kontak.id_prospek = mailbox.id');
        $result = $this->db->get('mailbox');
        return $result;
    }

    public function get_meeting($iduser)
    {
        $this->db->where('id_user', $iduser);
        $this->db->order_by('mailbox.id', 'DESC');
        $this->db->join('prospek_history', 'prospek_history.id_prospek = mailbox.id AND type = "appointment"');
        $this->db->join('prospek_kontak', 'prospek_kontak.id_prospek = mailbox.id');
        $result = $this->db->get('mailbox');
        return $result;
    }

    public function get_penawaran_by_id($id_rfq, $id_user)
    {
        $this->db->select('*,districts.name AS district_name, regencies.name AS regency_name, provinces.name AS province_name, prospek_kontak.name AS pic_name ', false);
        $this->db->where('id_user', $id_user);
        $this->db->where('mailbox.id', $id_rfq);
        $this->db->order_by('mailbox.id', 'DESC');
        $this->db->group_by('mailbox.id');
        $this->db->join('prospek_history', 'prospek_history.id_prospek = mailbox.id AND type = "buy"');
        $this->db->join('prospek_kontak', 'prospek_kontak.id_prospek = mailbox.id');
        $this->db->join('districts', 'mailbox.company_id_district = districts.id');
        $this->db->join('regencies', 'districts.regency_id = regencies.id');
        $this->db->join('provinces', 'regencies.province_id = provinces.id');
        $result = $this->db->get('mailbox');
        return $result;
    }

    public function get_item_penawaran($id_rfq, $id_user)
    {
        //$this->db->where('id_user', $id_user);
        $this->db->where('mailbox.id', $id_rfq);
        $this->db->join('item_penawaran', 'item_penawaran.id_mailbox = mailbox.id');
        $this->db->join('product', 'item_penawaran.id_product = product.id');
        $result = $this->db->get('mailbox');
        return $result;
    }

    public function set_withdrawal($data)
    {
        $this->db->insert('coin_withdrawal', $data);
    }

    public function set_mutation($data)
    {
        $this->db->insert('coin_mutation', $data);
    }

    public function get_mutation_list($where)
    {
        $this->db->select("*, cm.amount as amount_mutation, cw.amount as amount_wd, cm.id as cm_id");
        $this->db->from("coin_mutation as cm");
        $this->db->where("cm.user_id", $where);
        $this->db->order_by('cm.id', 'desc');
        $this->db->join("coin_withdrawal as cw", "cw.id = cm.reference_id");
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_withdrawal_detail($where)
    {
        $this->db->where($where);
        $result = $this->db->get('coin_withdrawal');
        return $result;
    }

    public function get_kode($iduser)
    {
        $this->db->where('user_id', $iduser);
        $kode = $this->db->get('referral_code');

        $this->db->where('id', $iduser);
        $member = $this->db->get('member');

        if ($kode->num_rows() > 0) {
            return $kode->row()->referral_code;
        } else {
            $code = 'TRU' . (strtoupper(substr($member->row()->name, 0, 4))) . RAND(111, 999);
            $data = array(
                'user_id' => $iduser,
                'referral_code' => $code,
                'created_at' => strtotime(date('Y-m-d H:i:s'))
            );
            $this->db->insert('referral_code', $data);
            return $code;
        }
    }

    public function get_bulk($iduser)
    {

        $this->db->select('s.*, s.id as id');
        $this->db->from('sourcing s');
        $this->db->join('contacts c', 'c.id = contact_id');
        $this->db->join('member m', 'm.id = c.member_id');
        $this->db->where('s.member_id', $iduser);
        $this->db->or_where('c.member_id', $iduser);

        $this->db->order_by('s.updated_at', 'DESC');
        $this->db->order_by('s.id', 'DESC');
        $this->db->group_by('s.id');
        $result = $this->db->get();
        $results = [];
        foreach ($result->result_array() as $key => $value) {
            $this->db->where('sourcing_id', $value['id']);
            $files = $this->db->get('sourcing_files');
            $results[$key] = $value;
            $results[$key]['files'] = $files->result_array();
            $this->db->where('sourcing_id', $value['id']);
            $items = $this->db->get('sourcing_item');
            $results[$key]['items'] = $items->result_array();
        }
        return $results;
    }
    public function get_bulk_item($iduser)
    {
        $this->db->reset_query();
        $this->db->where('id', $iduser);
        $result = $this->db->get('sourcing');
        $results = [];
        foreach ($result->result_array() as $key => $value) {
            $results[$key] = $value;
            $this->db->where('sourcing_id', $value['id']);
            $items = $this->db->get('sourcing_item');
            $results[$key]['items'] = $items->result_array();
        }
        return $results;
    }

    public function get_wilayah_autocomplete($term)
    {
        $this->db->select('v.name as name_v, d.name as name_d, r.name as name_r, p.name as name_p');
        $this->db->from('villages as v');
        $this->db->join('districts as d', 'd.id = v.district_id');
        $this->db->join('regencies as r', 'r.id = d.regency_id');
        $this->db->join('provinces as p', 'p.id = r.province_id');
        $this->db->like('v.name', $term);
        $this->db->or_like('d.name', $term);
        $this->db->or_like('r.name', $term);
        $this->db->or_like('p.name', $term);
        $this->db->limit(10);
        $this->db->order_by('v.name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function set($data)
    {
        $this->db->set($data);
    }
}
