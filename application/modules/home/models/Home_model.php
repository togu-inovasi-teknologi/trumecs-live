<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function gethome($name)
    {
        $query = $this->db->where("name", $name)->get('home');
        return $query->result_array();
    }
    public function getsetting($name)
    {
        $query = $this->db->where("name", $name)->get('setting');
        $return = $query->result_array();
        return (count($return) > 0) ? $return[0] : NULL;
    }
    
    public function getvcard($name) {
        $this->db->where('url', $name);
        return $this->db->get('vcard');
    }

    public function hitvcard($name) {
        $this->db->set('vcard_id', $name);
        $this->db->set('hit_time', time());
        $this->db->insert('vcard_hit');

        $this->db->set('total_hit', 'total_hit + 1', false);
        $this->db->where('id', $name);
        $this->db->update('vcard');
    }
}
