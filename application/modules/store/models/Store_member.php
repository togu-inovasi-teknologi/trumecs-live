<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_member extends CI_Model
{
    public $id, $member_id, $store_id,$permission, $created_at, $created_by;
    public $member;
    public $store;
    
    function __construct($storeMember = [])
    {
        if (!empty($storeMember)) {
            $this->_get($storeMember);
        }
        
        parent::__construct();
    }

    private function _set($data = [])
    {

        if (array_key_exists('id', $data))
            $this->id = (int) $data['id'];
        if (array_key_exists('member_id', $data))
            $this->member_id = $data['member_id'];
        if (array_key_exists('store_id', $data))
            $this->store_id = $data['store_id'];
        if (array_key_exists('permission', $data))
            $this->permission = $data['permission'];
        if (array_key_exists('created_at', $data))
            $this->created_at = $data['created_at'];
        if (array_key_exists('created_by', $data))
            $this->created_by = $data['created_by'];

        if(array_key_exists('store', $data))
            $this->store = $data['store'];
        if(array_key_exists('member', $data))
            $this->member = $data['member'];
        
    }

    private function _get($where)
    {
        $data = $this->db->get_where('store_member', $where)->row_array();
        if ($data != null) {
            $member = $this->db->get_where('member', ['id' => $data['member_id']])->row_array();
            $data['member'] = $member;

            $store = $this->db->get_where('store', ['id' => $data['store_id']])->row_array();
            $data['store'] = $store;

            $this->_set($data);
        }

        // $this->countAllProduct = $this->db->select('count(id) as count')->from("product")->where('store_id', $this->id)->get()->row()->count;

    }

    private function _getOriginalAttribute()
    {
        $data = [
            'member_id' => $this->member_id,
            'store_id' => $this->store_id,
            'permission' => $this->permission,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ];

        if($this->id != null){
            array_push($data, ['id' => $this->id]);
        }
    }

    public function insertIfNotExist()
    {
        if($this->id != null){
            return $this->id;
        }else{
            $this->db->insert('store_member', $this->_getOriginalAttribute());
            $this->id = $this->insert_id();
            return $this->id;
        }
    }

}