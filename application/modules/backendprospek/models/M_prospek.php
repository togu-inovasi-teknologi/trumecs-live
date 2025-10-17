<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Prospek extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    
    public function get_all($id_sales = null) {
        if($id_sales != null):
            $this->db->where('id_sales', $id_sales);
        endif;
        $this->db->select('*, admin.name as sales_name, prospek_kontak.name as name, mailbox.id as id, mailbox.email as email');
        $this->db->join('admin','mailbox.id_sales = admin.id','left');
        $this->db->join('prospek_kontak','mailbox.id = prospek_kontak.id_prospek','left');
        $this->db->group_by('mailbox.id');
        $this->db->order_by('mailbox.id', 'desc');
        return $this->db->get('mailbox');
    }
    
    public function get_detail($id_prospek, $id_sales = null) {
        if($id_sales != null):
            $this->db->where('id_sales', $id_sales);
        endif;
        $this->db->where('id', $id_prospek);
        return $this->db->get('mailbox');
    }
    
    public function get_sales() {
        $this->db->where('privileges', '9');    
        return $this->db->get('admin');
    }
    
    public function get_visit($id_prospek) {
        $this->db->where('id_prospek', $id_prospek)
                ->order_by('id', 'desc');
        return $this->db->get('prospek_visit');
    }
    
    public function set_visit(){
        $admin = $this->session->userdata('admin');
        $this->db->set('id_prospek', $this->input->post('id_prospek'));
        $this->db->set('id_sales', $admin['id']);
        $this->db->set('keterangan', $this->input->post('keterangan'));
        $this->db->set('lampiran', $this->input->post('lampiran'));
        $this->db->set('is_close', $this->input->post('is_close'));
        $this->db->set('visit_date', date('Y-m-d H:i:s'));
        $this->db->insert('prospek_visit');
        
        $id_visit = $this->db->insert_id();
        
        $data = array(
            'type' => 'visit',
            'date' => date('Y-m-d H:i:s'),
            'id_referensi' => $id_visit,
            'id_prospek' => $this->input->post('id_prospek'),
            'title' => 'Visit oleh sales',
            'description' => $this->input->post('keterangan'),
            'id_user' => $admin['id'],
        );
        
        $this->add_history($data);
    }
    
    public function set_prospek($data) {
        
        $this->db->set('company_email', $this->input->post('email'));
        $this->db->set('img_compare', array_key_exists("img_compare", $data) ? $data["img_compare"] : null);
        $this->db->set('method', $this->input->post('method') ? $this->input->post('method') : '0');
        $this->db->set('company', $this->input->post('company'));
        $this->db->set('category', $this->input->post('category') == null ? '' : $this->input->post('category'));
        $this->db->set('company_phone', $this->input->post('company_phone'));
        $this->db->set('company_address', $this->input->post('company_address') == null ? '' : $this->input->post('company_address'));
        $this->db->set('company_id_district', $this->input->post('district') == null ? '0' : $this->input->post('district'));
        $this->db->set('additional_information', $this->input->post('additional_information') == null ? '' : $this->input->post('additional_information'));
        $this->db->insert('mailbox');
        
        $id_prospek = $this->db->insert_id();
        
        foreach($this->cart->contents() as $key):
            $this->db->set('id_product', $key["id"]);
            $this->db->set('id_mailbox', $id_prospek);
            $this->db->set('qty', $key['qty']);
            $this->db->insert('item_penawaran');
        endforeach;
        
        $session = $this->session->all_userdata();
        $sessionmember= array_key_exists("member", $session) ? $session["member"] : array('id'=>0);
        
        $this->db->set('id_prospek', $id_prospek);
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('position', $this->input->post('position') == null ? '' : $this->input->post('position'));
        $this->db->set('phone', $this->input->post('phone') == null ? '' : $this->input->post('phone'));
        $this->db->set('email', $this->input->post('email') == null ? '' : $this->input->post('email'));
        $this->db->insert('prospek_kontak');
        
        $this->db->set('id_prospek', $id_prospek);
        $this->db->set('date', date("Y-m-d H:i:s"));
        $this->db->set('type', $data['type']);
        $this->db->set('title', $data['title']);
        $this->db->set('description', $data['description']);
        $this->db->set('id_user', $sessionmember['id']);
        $this->db->insert('prospek_history');
        
        return $id_prospek;
    }
    
    public function set_tender($data) {
        
        $session = $this->session->all_userdata();
        $sessionmember= $session["member"];
        
        $this->db->set('company', $data['company']);
        $this->db->set('company_field', $data['company_field']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('name', $data['name']);
        $this->db->set('due_date', $data['due_date']);
        $this->db->set('email', $data['email']);
        $this->db->set('product', $data['product']);
        $this->db->set('id_user', $sessionmember['id']);
        $this->db->insert('tender');
        
        $id_tender = $this->db->insert_id();
        
        return $id_tender;
    }
    
    public function assign($id_prospek, $data) {
        return $this->db->where('id', $id_prospek)
                        ->update('mailbox', $data);
    }
    
    public function update_prospek($id_prospek, $data) {
        return $this->db->where('id', $id_prospek)
                        ->update('mailbox', $data);
    }
    
    public function get_prospek_kontak($id_prospek) {
        return $this->db->where('id_prospek', $id_prospek)
                        ->get('prospek_kontak');
    }
    
    public function delete_kontak($id_prospek, $id_kontak) {
        $admin = $this->session->userdata('admin');
        
        $data = $this->db->where('id', $id_kontak)->get('prospek_kontak')->result_array();
        
        $data = array(
            'type' => 'delete_kontak',
            'date' => date('Y-m-d H:i:s'),
            'id_referensi' => $id_kontak,
            'id_prospek' => $id_prospek,
            'title' => 'Menghapus kontak',
            'description' => "Nama: $data[name] \n Phone: $data[phone] \n Posisi: $data[position] \n Keterangan: \n $data[additional_information]",
            'id_user' => $admin['id'],
        );
        
        $this->add_history($data);
        
        $this->db->where('id', $id_kontak)
                        ->delete('prospek_kontak');
    }
    
    public function add_kontak($data) {
        $this->db->insert('prospek_kontak', $data);
        
        $id_referensi = $this->db->insert_id();
        
        $admin = $this->session->userdata('admin');
        
        $data = array(
            'type' => 'add_kontak',
            'date' => date('Y-m-d H:i:s'),
            'id_referensi' => $id_referensi,
            'id_prospek' => $data['id_prospek'],
            'title' => 'Menambahkan kontak baru',
            'description' => "Nama: $data[name] \n Phone: $data[phone] \n Posisi: $data[position] \n Keterangan: \n $data[additional_information]",
            'id_user' => $admin['id'],
        );
        
        $this->add_history($data);
    }
    
    public function get_detail_kontak($id_kontak) {
        return $this->db->where('id', $id_kontak)
                        ->get('prospek_kontak');
    }
    
    public function update_kontak($id_kontak, $data) {
        return $this->db->where('id', $id_kontak)
                        ->update('prospek_kontak', $data);
    }
    
    public function get_history($id_prospek) {
        return $this->db->where('prospek_history.id_prospek', $id_prospek)
                        ->join('prospek_visit', 'prospek_visit.id = prospek_history.id_referensi AND prospek_history.type = "visit"', 'left')
                        ->join('admin', 'admin.id = prospek_history.id_user', 'left')
                        ->order_by('prospek_history.id', 'desc')
                        ->get('prospek_history');
    }
    
    public function add_history($data) {
        return $this->db->insert('prospek_history', $data);
    }
    
    public function get_provinsi() {
        return $this->db->get('provinces');
    }
    
    public function get_regency($id_province) {
        return $this->db->where('province_id', $id_province)->get('regencies');
    }
    
    public function get_district($id_regency) {
        return $this->db->where('regency_id', $id_regency)->get('districts');
    }

    public function get_village($id_district) {
        return $this->db->where('district_id', $id_district)->get('villages');
    }
    
    public function get_location($id_district) {
        $this->db->select('districts.name as district, regencies.name as regency, provinces.name as province');
        $this->db->join('regencies', 'regencies.id = districts.regency_id');
        $this->db->join('provinces', 'provinces.id = regencies.province_id');
        $location = $this->db->where('districts.id', $id_district)->get('districts');
        return $location->row()->district.', '.$location->row()->regency.', '.$location->row()->province;
    }
    
    public function view_prospek($id_prospek) {
        $admin = $this->session->userdata('admin');
        
        $cek = $this->db->where('id', $id_prospek)->where('viewed', '0')->get('mailbox');
        
        if($cek->num_rows() > 0) {
            $data = array(
                'type' => 'view_prospek',
                'date' => date('Y-m-d H:i:s'),
                'id_referensi' => '',
                'id_prospek' => $id_prospek,
                'title' => 'Prospek sudah dilihat',
                'description' => "Prospek pertama kali dilihat oleh ".$admin['nameadmin'],
                'id_user' => $admin['id'],
            );
            
            $this->add_history($data);

            return $this->db->where('id', $id_prospek)->set('viewed', '1')->update('mailbox');
        }
    }
    
    public function get_new($last_id) {
        $this->db->where('viewed', '0');
        $this->db->where('mailbox.id >', $last_id);
        return $this->get_all();
    }
    
    public function search($query) {
        $this->db->like('tittle', $query);
        return $this->db->get('product');
    }
    
    public function save_quote($id_prospek, $file) {
        $this->db->set('file', $file);
        $this->db->where('id_prospek', $id_prospek);
        $this->db->where('type', 'buy');
        $this->db->update('prospek_history');
    }
    
}