<?php
defined('BASEPATH') or exit('No direct script access allowed');

class etx_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function record_count($datawhere)
    {

        $this->db->where($datawhere);
        $query = $this->db
            ->from("confirmation");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start, $datawhere)
    {
        $this->db->where($datawhere);
        $this->db->limit($limit, $start)
            ->order_by("id", "DESC");
        $query = $this->db->get("confirmation");
        return  $query->result_array();
    }

    public function getconfirm($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("confirmation");
        $queryconfirm = $query1->result_array();
        $returnconfirm["confirmation"] = $queryconfirm[0];

        $whereiduniq = array('iduniq' => $where["idorder"]);
        $returnall = array();

        $this->db->where($whereiduniq);
        $query2 = $this->db->get("order");
        $returnorder = $query2->result_array();
        if (empty($returnorder)) {
            $this->session->set_flashdata('message', 'ID Order ' . $where["idorder"] . " tidak ada.<br>
                Mungkin Pesanan telah di hapus.
                ");
            redirect('backendconfirm/?status=all');
            exit();
        }
        $whereid = $returnorder[0]["id"];
        $whereidmember = $returnorder[0]["idmember"];

        $whereorder = array('id_order' => $whereid);
        $this->db->where($whereorder);
        $listdetail = $this->db->get("order_detail");
        $returnlistdetail["listdetail"] = $listdetail->result_array();
        $returnallorder["order"] = array_merge($returnorder[0], $returnlistdetail);

        $wheremember = array('id' => $whereidmember);
        $this->db->where($wheremember);
        $detailmember = $this->db->get("member");
        $remove0 = $detailmember->result_array();
        $returndetailmember["detailmember"] = $remove0[0];
        $returnconfirm = array_merge($returnconfirm, $returndetailmember);

        $returnall = array_merge($returnconfirm, $returnallorder);
        return $returnall;
    }

    public function update($where, $set)
    {
        $this->db->where($where)->set($set)->update("confirmation");
    }

    public function updateorder($where, $set)
    {
        $this->db->where($where)->set($set)->update("order");
    }

    public function hapusorder($where)
    {
        $this->db->where($where)->delete("confirmation");
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

    public function record_count_withdraw($datawhere)
    {

        $this->db->where($datawhere);
        $query = $this->db
            ->from("coin_withdrawal");
        return $query->get()->num_rows();
    }

    public function fetch_withdraw($limit, $start, $datawhere)
    {
        $this->db->where($datawhere);
        $this->db->limit($limit, $start)
            ->order_by("id", "DESC");
        $query = $this->db->get("coin_withdrawal");
        return  $query->result_array();
    }

    public function update_withdraw($where, $set)
    {
        $this->db->where($where)->set($set)->update("coin_withdrawal");
    }

    public function update_mutation($where, $set)
    {
        $this->db->where($where)->set($set)->update("coin_mutation");
    }

    public function update_member($where, $set)
    {
        $this->db->where($where)->set($set)->update("member");
    }

    public function get_withdraw($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("coin_withdrawal");
        $querywithdraw = $query1->result_array();
        $returnconfirm["withdrawal"] = $querywithdraw[0];

        $whereid = $returnconfirm["withdrawal"]["id"];
        $whereidmember = $returnconfirm["withdrawal"]["user_id"];

        $wheremember = array('id' => $whereidmember);
        $this->db->where($wheremember);
        $detailmember = $this->db->get("member");
        $remove0 = $detailmember->result_array();
        $returndetailmember["detailmember"] = $remove0[0];
        $returnall = array_merge($returnconfirm, $returndetailmember);

        return $returnall;
    }
}