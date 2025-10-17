<?php

class Backendcontact extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->library("Date");
    }

    public function index()
    {
        $session = $this->session->all_userdata();
        $sessionadmin = array_key_exists("admin", $session) ? $session["admin"] : '';
        $data['session'] = $sessionadmin;
        $data['content'] = 'index';

        $data['css'] = [
            base_url('asset/css/bootstrap.4-alpha.css'),
        ];

        $data['js'] = [
            '/modules/backendcontact/js/contact.js'
        ];

        $this->load->view('backend/template_front1', $data);
    }

    public function delete()
    {
        // $id = $_GET['id'];
        
        $this->db->delete('contacts', ['id' => $id]);
        redirect(base_url() . 'backendcontact');
    }

    public function create()
    {
        $data['js'] = [
            '/modules/backendcontact/js/backend-contact.js',
            base_url() . '/asset/js/string.js',
        ];

        $session = $this->session->all_userdata();
        $sessionadmin = array_key_exists("admin", $session) ? $session["admin"] : '';
        $admin_id = $sessionadmin["id"];

        $data['content'] = 'add_contact';

        $this->form_validation->set_rules('company_name', 'Nama Perusahaan/Perorangan', 'required');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
        //$this->form_validation->set_rules('email', 'Alamat Email', 'required');
        //$this->form_validation->set_rules('npwp', 'Nomor NPWP', 'required');
        //$this->form_validation->set_rules('billing_country', 'Negara Penagihan', 'required');
        //$this->form_validation->set_rules('billing_village', 'Kelurahan/Desa', 'required');
        //$this->form_validation->set_rules('billing_code', 'Kode Pos Penagihan', 'required');
        //$this->form_validation->set_rules('billing_country', 'Negara Penagihan', 'required');
        //$this->form_validation->set_rules('shipping_country', 'Negara Pengiriman', 'required');
        //$this->form_validation->set_rules('shipping_village', 'Keluarahan/Desa Pengiriman', 'required');
        //$this->form_validation->set_rules('shipping_code', 'Kode Pos Pengiriman', 'required');
        $this->form_validation->set_rules('contact_name', 'Nama Kontak', 'required');
        $this->form_validation->set_rules('contact_phone', 'Nomor Telepon Kontak', 'required');
        //$this->form_validation->set_rules('contact_email', 'Email Kontak', 'required');
        //$this->form_validation->set_rules('contact_country', 'Negara Kontak', 'required');
        //$this->form_validation->set_rules('village_contact', 'Alamat Keluarahan/Desa Kontak', 'required');
        //$this->form_validation->set_rules('contact_code', 'Kode Pos Alamat Kontak', 'required');
        //$this->form_validation->set_rules('billing_village_id', 'Alamat Penagihan', 'required');
        //$this->form_validation->set_rules('shipping_village_id', 'Alamat Pengiriman', 'required');
        //$this->form_validation->set_rules('village_contact_id', 'Alamat Kontak', 'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('backend/template_front1', $data);
        }else{

            if(!empty($this->input->post('company_id')))
            {
                $company_id = $this->input->post('company_id');
            }else{

                $company['name'] = $this->input->post('company_name');
                $company['telephone'] = $this->input->post('phone');
                $company['email'] = $this->input->post('email');
                $company['ownership'] = $this->input->post('type');
                $company['website'] = $this->input->post('website');
                $company['industry'] = $this->input->post('industry');
                $company['npwp'] = $this->input->post('npwp');
                $company['billing_country'] = $this->input->post('billing_country');
                $company['billing_province'] = $this->input->post('billing_country');
                $company['billing_regency'] = $this->input->post('billing_country');
                $company['billing_district'] = $this->input->post('billing_country');
                $company['billing_village'] = $this->input->post('billing_country');
                $company['billing_code'] = $this->input->post('billing_country');

                $billing = $this->db->select('v.name as village, d.name as district, r.name as regency, p.name as province')
                                ->from('villages v')
                                ->where('v.id', $this->input->post('billing_village_id'))
                                ->join('districts d', 'd.id = v.district_id')
                                ->join('regencies r', 'r.id = d.regency_id')
                                ->join('provinces p', 'p.id = r.province_id')
                                ->get()->row();

                $shipping = $this->db->select('v.name as village, d.name as district, r.name as regency, p.name as province')
                                ->from('villages v')
                                ->where('v.id', $this->input->post('shipping_village_id'))
                                ->join('districts d', 'd.id = v.district_id')
                                ->join('regencies r', 'r.id = d.regency_id')
                                ->join('provinces p', 'p.id = r.province_id')
                                ->get()->row();
                                
                if(isset($billing)){
                    $company['billing_province'] = $billing->province;
                    $company['billing_regency'] = $billing->regency;
                    $company['billing_district'] = $billing->district;
                    $company['billing_village'] = $billing->village;
                    $company['billing_village_id'] = $this->input->post('billing_village_id');
                    $company['billing_code'] = $this->input->post('billing_code'); 
                }

                if(isset($shipping)){
                    $company['shipping_province'] = $shipping->province;
                    $company['shipping_regency'] = $shipping->regency;
                    $company['shipping_province'] = $shipping->province;
                    $company['shipping_district'] = $shipping->district;
                    $company['shipping_village'] = $shipping->village;
                    $company['shipping_village_id'] = $this->input->post('shipping_village_id');
                    $company['shipping_code'] = $this->input->post('shipping_code');
                }

                
                $company['created_by'] = $admin_id;
                
                $this->db->insert("companies", $company);
                $company_id = $this->db->insert_id();
            }


            $contact = $this->db->select('v.name as village, d.name as district, r.name as regency, p.name as province')
                                ->from('villages v')
                                ->where('v.id', $this->input->post('village_contact_id'))
                                ->join('districts d', 'd.id = v.district_id')
                                ->join('regencies r', 'r.id = d.regency_id')
                                ->join('provinces p', 'p.id = r.province_id')
                                ->get()->row();

            
            $datacontact['company_id'] = $company_id;
            $datacontact['member_id'] = $this->input->post('member_id');
            $datacontact['name'] = $this->input->post('contact_name');
            $datacontact['telephone'] = $this->input->post('contact_phone');
            $datacontact['email'] = $this->input->post('contact_email');
            $datacontact['dapartment'] = $this->input->post('dapartment');
            $datacontact['position'] = $this->input->post('position');
            $datacontact['country'] = $this->input->post('contact_country');
            
            if(isset($contact)){
                $datacontact['province'] = $contact->province;
                $datacontact['regency'] = $contact->regency;
                $datacontact['district'] = $contact->district;
                $datacontact['village'] = $contact->village;
                $datacontact['postal_code'] = $this->input->post('contact_code');
                $datacontact['address'] = $this->input->post('address');
                $datacontact['notes'] = $this->input->post('description');
            }
            
            $this->db->insert('contacts', $datacontact);

            redirect('/backendcontact');
        }

        
    }

}