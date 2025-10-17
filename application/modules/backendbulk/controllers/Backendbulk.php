<?php defined('BASEPATH') or exit('No direct script access allowed');

class Backendbulk extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("M_Backendbulk");
        $this->load->library("Date");
    }

    public function index()
    {
        $data["js"] = array(
            base_url() . 'asset/backend/js/list-bulk.js'
        );
        $data['js_cdn'] = [
            '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>',
        ];
        $data['list'] = $this->M_Backendbulk->get_all();
        $data['content'] = 'v_admin';
        $this->load->view('backend/template_front1', $data);
    }
    
    public function supplier()
    {
        $data["js"] = array(
            base_url() . 'asset/backend/js/list-bulk.js'
        );
        $data['js_cdn'] = [
            '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>',
        ];
        $data['list'] = $this->M_Backendbulk->get_all();
        $data['content'] = 'v_admin_supplier';
        $this->load->view('backend/template_front1', $data);
    }
    
    public function items()
    {
        $data["js"] = array(
            base_url() . 'asset/backend/js/list-bulk.js'
        );
        $data['js_cdn'] = [
            '<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>',
        ];
        $data['list'] = $this->M_Backendbulk->get_all_item();
        $data['content'] = 'v_admin_item';
        $this->load->view('backend/template_front1', $data);
    }

    public function array_multidimensional_search($value, $array)
    {
        $return = [];
        foreach ($array as $key => $data) {
            if($value == $data){
                array_push($return, $key);
            }
        }

        return $return;
    }
    
    public function create($type)
    {
        $data["js"] = array(
            "/modules/backendbulk/js/add_sourcing.js",
            base_url() . '/asset/js/string.js',
            base_url() . "asset/js/slick/slick.min.js",
            "https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"
        );
        
        $data["css"] = array(
            "https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
            );
        $session = $this->session->all_userdata();
        $sessionadmin = array_key_exists("admin", $session) ? $session["admin"] : null;
        $data['session'] = $type;
        $data['session'] = $sessionadmin;
        $data['content'] = 'add_sourcing';

        //$this->form_validation->set_rules('village', 'Alamat Kelurahan/Desa', 'required');
        $this->form_validation->set_rules('village_id', 'Alamat Kelurahan/Desa', 'required');
        //$this->form_validation->set_rules('zipcode', 'Kode Pos', 'required');
        $this->form_validation->set_rules('address', 'Detail Alamat', 'required');
        $this->form_validation->set_rules('contact_id', 'Kontak', 'required');
        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('text_rfq', 'Keterangan Permintaan', 'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('backend/template_front1', $data);
        }else{

            
            
            $this->load->model('address/address_model');
            $this->load->model('contact/contact_model');

            $address = $this->address_model->getAddressByVillageId($this->input->post('village_id'));

            $sourcing['nama_rfq'] = $this->input->post('type') == 'supplier' ? generate_sourcing_name('SCM') : generate_sourcing_name('INQ');
            $sourcing['member_id'] = $sessionadmin['id'];
            $sourcing['address'] = $this->input->post('address');
            $sourcing['province'] = $address->province;
            $sourcing['district'] = $address->district;
            $sourcing['city'] = $address->regency;
            $sourcing['village'] = $address->village;
            $sourcing['village_id'] = $this->input->post('village_id');
            $sourcing['zipcode'] = $this->input->post('zipcode');

            // ['id' => $this->input->post('contact_id')]
            $contactModel = new Contact_model();

            $contactModel->where('id', $this->input->post('contact_id'))->get()->single();
            $contactModel->company();

            $sourcing['name'] = $contactModel->name;
            $sourcing['phone'] = $contactModel->telephone;
            $sourcing['company'] = $contactModel->company['name'];
            $sourcing['company_id'] = $contactModel->company['id'];
            $sourcing['status'] = 0;
            $sourcing['updated_by'] = $sessionadmin['id'];
            $sourcing['created_at'] = time();
            $sourcing['text_rfq'] = $this->input->post('text_rfq');
            $sourcing['updated_at'] = date('Y-m-d H:i:s');
            $sourcing['type'] = $type;
            $sourcing['contact_id'] = $contactModel->id;
            $sourcing['inc_ppn'] = $this->input->post('inc_ppn') ?? 0 ;
            $sourcing['inc_ongkir'] = $this->input->post('inc_ongkir') ?? 0;

            $this->db->insert('sourcing', $sourcing);
            
            $sourcing_id = $this->db->insert_id();


            $sourcingItems = [];

            
            $qty = $this->input->post('qty');
            $uom = $this->input->post('uom');
            $prices = $this->input->post('price');
            $productIds = $this->input->post('id_items');
            $items = $this->input->post('items');
            $notes = $this->input->post('notes');
           
            foreach ($items as $key => $value) {
                if(!empty($value)){
                    $sourcingItems[] = [
                        'sourcing_id' => $sourcing_id,
                        'items' => $value,
                        'product_id' => $productIds[$key],
                        'price' => $prices[$key] == "" ? 0 : $prices[$key],
                        'qty' => $qty[$key],
                        'uom' => $uom[$key],
                        'notes' => $notes[$key],
                        'created_by' => $sessionadmin['id'],
                        'created_at' => time(),
                        'updated_at' => time(),
                        'updated_by' => $sessionadmin['id'],
                    ];
                }

            }

            foreach ($sourcingItems as $key => $value) {
                $this->db->insert('sourcing_item', $value);
                $id = $this->db->insert_id();
                $sourcingItems[$key]['id'] = $id;
            }

            $source_item_supplier = $this->input->post('source_id');
            $qty_supplier = $this->input->post('qty_supplier');
            $price_supplier = $this->input->post('price_supplier');
            $source_product_id = $this->input->post('source_item_id');
            
            if(!empty($source_product_id)){
            $sourcing_item_source = [];
            
            foreach ($sourcingItems as $key => $value) {
                
                $search = $this->array_multidimensional_search($value['product_id'], $source_product_id);
                
                if(!empty($search)){
                    foreach ($search as $valueKey) {
                        $data = [
                            'sourcing_item_supplier' => $source_item_supplier[$valueKey],
                            'sourcing_item' => $value['id'],
                            'qty' => $qty_supplier[$valueKey],
                            'price' => $price_supplier[$valueKey],
                        ];
                        array_push($sourcing_item_source, $data);
                    }
                   
                }
                
            }

            $this->db->insert_batch('sourcing_item_source',$sourcing_item_source);

            }
            
            $files = $this->input->post('files');
            $this->M_Backendbulk->save_file($files, $sourcing_id);
            
           return redirect(base_url('/backendbulk/'.($type == 'buyer' ? '' : 'supplier')));
        }

        
    }


    public function detail($id_prospek = null)
    {
        $data["js"] = array(
            base_url() . 'asset/backend/js/list-bulk.js',
            "https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"
        );
        
        $data["css"] = array(
            "https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
            );
            
        $data['detail'] = $this->M_Backendbulk->get_detail($id_prospek);
        $data['file'] = $this->M_Backendbulk->get_file($id_prospek);
        $data['items'] = $this->M_Backendbulk->get_item($id_prospek);
        $data['item_source'] = $this->M_Backendbulk->get_item_source($id_prospek);
        
        $data['content'] = $data['detail']->type == 'buyer' ? 'detail_admin':'detail_admin_sourcing';
        $this->M_Backendbulk->view_prospek($id_prospek);
        $this->load->view('backend/template_front1', $data);
    }
    
    public function add_files($sourcing_id){
        $files = $this->input->post('files');
        $this->M_Backendbulk->save_file($files, $sourcing_id);
        return redirect(base_url('/backendbulk/detail/'.$sourcing_id));
    }

    // public function get_new()
    // {
    //     $data = $this->M_Backendbulk->get_new($this->input->post('last_id'));
    //     $list = array();
    //     $last = $this->input->post('last_id');

    //     if ($data->num_rows() > 0) {
    //         $last = $data->row()->id;
    //         foreach ($data->result() as $key => $item) {
    //             $list[] = array(
    //                 "0" => $item->id,
    //                 "1" => '<a href="' . site_url('backendbulk/detail/' . $item->id) . '" style="color:#fff;">' . $item->name . ' <span class="label label-success" style="font-weight:bold">new</span>',
    //                 "2" => $item->created_at,
    //                 "3" => $item->company,
    //                 "4" => $item->province,
    //                 "5" => $item->phone,
    //                 "6" => $item->status == 0 ? 'Belum Diproses' : 'Sudah Dikirim'
    //             );
    //         }
    //     }

    //     echo json_encode(array(
    //         'number' => $data->num_rows(),
    //         'list' => $list,
    //         'last' => $last
    //     ));
    // }

    // public function send_quote($id_prospek)
    // {
    //     $config['upload_path']          = './public/filequotation';
    //     $config['allowed_types']        = 'pdf|xls|xlsx';
    //     $config['max_size']             = 25000;
    //     $config['encrypt_name']         = true;
    //     $config['file_ext_tolower']     = true;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('offer')) {
    //         $error = array('error' => $this->upload->display_errors());
    //         $this->session->set_flashdata('error', $error);
    //         echo $this->upload->display_errors();
    //     } else {
    //         $data = $this->upload->data();
    //         $this->M_Backendbulk->save_quote($id_prospek, $data['file_name'], $this->input->post('admin_note'));
    //     }

    //     redirect('backendbulk/detail/' . $id_prospek);
    // }

    public function send_item($id_prospek)
    {
        $session = $this->session->all_userdata();
        $sessionadmin = array_key_exists("admin", $session) ? $session["admin"] : '';
        $admin_id = $sessionadmin["id"];
        $date = date('Y-m-d H:i:s');
        $inc_ppn = isset($_POST['inc_ppn']) ? 1 : 0;
        $inc_ongkir = isset($_POST['inc_ongkir']) ? 1 : 0;
        $nameItems = $this->input->post('name-item[]');
        $priceItems = $this->input->post('price-item[]');
        $priceItemsInt = str_replace('.', '', $priceItems);
        $qtyItems = $this->input->post('qty-item[]');
        $uomItems = $this->input->post('uom-item[]');
        $notes = $this->input->post('notes[]');
        $sourcingNotes = $this->input->post('sourcing_notes');
        $internalNotes = $this->input->post('internal_notes');
        
        if($nameItems != null){
            $this->db->trans_start();
            foreach ($nameItems as $key => $listItem) {
                $items = array(
                    'items' => $listItem,
                    'price' => $priceItemsInt[$key],
                    'qty' => $qtyItems[$key],
                    'uom' => $uomItems[$key],
                    'notes' => $notes[$key],
                    'sourcing_id' => $id_prospek,
                    'created_at' => $date,
                    'created_by' => $admin_id,
                );
                $this->M_Backendbulk->saveItem($items);
                $id_item = $this->db->insert_id();
                $log = array(
                    'sourcing_item_id' => $id_item,
                    'price' => $priceItemsInt[$key],
                    'created_at' => $date,
                    'created_by' => $admin_id,
                );
                $this->M_Backendbulk->saveItemLog($log);
            }
            
            

            if ($this->input->post('isi_note_admin') == null || '') {
                $commentLog = array(
                    'sourcing_id' => $id_prospek,
                    'admin_note' => $this->input->post('admin_note'),
                    'created_at' => $date,
                    'updated_by' => $admin_id,
                );
                $this->M_Backendbulk->insertCommentLog($commentLog);
            } else {
                $commentLog = array(
                    'sourcing_id' => $id_prospek,
                    'admin_note' => $this->input->post('admin_note'),
                    'updated_at' => $date,
                    'updated_by' => $admin_id,
                );
                $this->M_Backendbulk->saveCommentLog($commentLog, $this->input->post('comment_id'));
            };
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() == TRUE) {
                $this->session->set_flashdata('message-success', 'Berhasil');
            };
        }
        
        $include = array(
                "inc_ppn" => $inc_ppn,
                "inc_ongkir" => $inc_ongkir,
                'admin_note' => $this->input->post('admin_note'),
                'sourcing_notes' => $sourcingNotes,
                'internal_notes' => $internalNotes,
                'updated_at' => $date,
                'viewed' => 2,
                'status' => 1,
            );
            
        $this->M_Backendbulk->updateSourcing($id_prospek, $include);
        redirect('backendbulk/detail/' . $id_prospek);
    }
    
    public function send_nego($id_prospek)
    {
        $session = $this->session->all_userdata();
        $sessionadmin = array_key_exists("admin", $session) ? $session["admin"] : '';
        $admin_id = $sessionadmin["id"];
        $list_id = $this->input->post('list_id[]');
        $priceStatus = $this->input->post('price-status[]');
        $priceAwal = $this->input->post('price-awal[]');
        $priceAwalInt = str_replace('.', '', $priceAwal);
        $priceNego = $this->input->post('price-nego[]');
        $priceNegoInt = str_replace('.', '', $priceNego);
        $priceItems = $this->input->post('price-nego-admin[]');
        $priceItemsInt = str_replace('.', '', $priceItems);
        $date = date('Y-m-d H:i:s');
        $qty = $this->input->post('qty[]');
        $qtyInt = str_replace('.', '', $qty);
        $uom = $this->input->post('uom[]');
        $notes = $this->input->post('notes[]');
        
        //var_dump($priceItems);
       
        $this->db->trans_start();
        foreach ($list_id as $key => $listId) {
            //if ($priceAwal[$key] != $priceNego[$key]) {
                if ($priceAwal[$key] != $priceItems[$key]) {  // Masukkan ke price log
                    $log = array(
                        'sourcing_item_id' => $listId,
                        'price' => $priceItemsInt[$key],
                        'created_at' => $date,
                        'created_by' => $admin_id,
                    );
                    $this->M_Backendbulk->saveItemLog($log);
                };
                
                
                /*if ($priceNego[$key] == $priceItems[$key]) { // Status selesai/deal
                    $source = array(
                        'price' => $priceItemsInt[$key],
                        'price_nego' => $priceNegoInt[$key],
                        'updated_at' => $date,
                        'updated_by' => $admin_id,
                        'status' => 2,
                    );
                } else if ($priceAwal[$key] == $priceItems[$key]) { // Status ditolak
                    $source = array(
                        'price' => $priceItemsInt[$key],
                        'price_nego' => $priceNegoInt[$key],
                        'updated_at' => $date,
                        'updated_by' => $admin_id,
                        'status' => 3,
                    );
                } else {  */                                          // Status negosiasi
                    $source = array(
                        'price' => $priceItemsInt[$key] == 0 ? $priceAwalInt[$key] : $priceItemsInt[$key],
                        'price_nego' =>  $priceStatus[$key] == 0 || $priceStatus[$key] == 2 ? null : $priceNegoInt[$key],
                        'updated_at' => $date,
                        'updated_by' => $admin_id,
                        'status' => $priceStatus[$key],
                        'qty' => $qtyInt[$key],
                        'uom' => $uom[$key],
                        'notes' => $notes[$key]
                    );
                //};
               
                $this->M_Backendbulk->updateItem($source, $listId);
            //}
        };
        
        $this->M_Backendbulk->save_item_supplier($list_id);
        $include = array(
            'viewed' => 2,
            'status' => 1,
            'updated_at' => $date,
            'updated_by' => $admin_id,
        );
        $this->M_Backendbulk->updateSourcing($id_prospek, $include);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            $this->session->set_flashdata('message-success', 'Berhasil');
        };
        redirect('backendbulk/detail/' . $id_prospek);
    }
    
    public function rfqDone($id_prospek)
    {
        $date = date('Y-m-d H:i:s');
        $this->db->trans_start();
        $include = array(
            'updated_at' => $date,
            'viewed' => 2,
            'status' => 3,
        );
        $this->M_Backendbulk->updateSourcing($id_prospek, $include);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            $this->session->set_flashdata('message-success', 'Berhasil');
        };
        redirect('backendbulk/detail/' . $id_prospek);
    }
    
    function ambil_data(){

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $this->db->where('type','buyer');
        $total = $this->db->count_all_results("sourcing");
        
        
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        
        $this->db->limit($length,$start);
        
        if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('sourcing.id', $_REQUEST['order'][0]['dir']);
		endif;
		
		if($_REQUEST['order'][0]['column'] == '2'):
			$this->db->order_by('name_member', $_REQUEST['order'][0]['dir']);
		endif;
		
		if($_REQUEST['order'][0]['column'] == '1'):
			$this->db->order_by('nama_rfq', $_REQUEST['order'][0]['dir']);
		endif;
		
		if($_REQUEST['order'][0]['column'] == '4'):
			$this->db->order_by('created_at', $_REQUEST['order'][0]['dir']);
		endif;
		
		if($_REQUEST['order'][0]['column'] == '3'):
			$this->db->order_by('sourcing.company', $_REQUEST['order'][0]['dir']);
		endif;
		
		
		if($search != ""){
            $this->db->or_like("sourcing.name", $search);
            $this->db->or_like('sourcing.company', $search);
            $this->db->or_like('sourcing.nama_rfq', $search);
        }
		
		$this->db->select('*, sourcing.id AS id, sourcing.status as status, sourcing.name as name_member');
        $this->db->where('sourcing.type', 'buyer');
        $this->db->join('member', 'sourcing.member_id = member.id', 'left');
        $query = $this->db->get('sourcing');    
        
        //echo $query->num_rows();
        
        //echo $this->db->last_query();
        
        if($search!=""){
            $this->db->or_like("sourcing.name", $search);
            $this->db->or_like('sourcing.company', $search);
            $this->db->or_like('sourcing.nama_rfq', $search);
            $this->db->where('sourcing.type','buyer');

        }
        
        $this->db->select('*, sourcing.id AS id, sourcing.status as status, sourcing.name as name_member');
        $this->db->join('member', 'sourcing.member_id = member.id','left');
        $jum = $this->db->get('sourcing');
        $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();

        foreach ($query->result() as $item) {
       
            $output['data'][]=array(
                '<a class="text-primary" href="'.site_url('backendbulk/detail/' . $item->id).'">'.$item->id.'</a>',
                '<a class="text-primary" href="'.site_url('member/bulkPdf/' . $item->id).'"target="_blank">'.$item->nama_rfq.'</a>',
                '<a class="text-primary" href="'.site_url('backendbulk/detail/' . $item->id).'">'.$item->name_member. ($item->viewed == '0' ? '<span class="label label-success" style="font-weight:bold">new</span>' : '').'</a>',
                $item->company,
                '<span class="text-muted">'.date("d M y", $item->created_at).'</span>',
                '<span class="text-muted">'.$item->province.'</span>',
                '<span class="text-muted">'.$item->phone.'</span>',
                ucfirst($item->type),
                $item->status == 0 ? 'Belum di Proses' : ($item->status == 1 ? 'Sudah Kirim' : ($item->status == 2 ? 'Nego' : 'Selesai'))
            );
        
        }

        echo json_encode($output);

    }
    
    function ambil_data_supplier(){

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $this->db->where('type','supplier');
        $total=$this->db->count_all_results("sourcing");
        
        
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        if($search!=""){
            $this->db->or_like("sourcing.name",$search);
            $this->db->or_like("sourcing.company",$search);
            $this->db->or_like("sourcing.nama_rfq",$search);
        }
        $this->db->limit($length,$start);
        if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('sourcing.id',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '2'):
			$this->db->order_by('sourcing.name',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '1'):
			$this->db->order_by('nama_rfq',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '4'):
			$this->db->order_by('created_at',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '3'):
			$this->db->order_by('sourcing.company',$_REQUEST['order'][0]['dir']);
		endif;
		$this->db->select('*, sourcing.id AS id, sourcing.status as status, sourcing.name as name_member');
        $this->db->join('member', 'sourcing.member_id = member.id', 'left');
        $this->db->where('sourcing.type','supplier');
        $query=$this->db->get('sourcing');
        if($search!=""){
       
        $this->db->or_like("sourcing.name",$search);
        $this->db->or_like("sourcing.company",$search);
        $this->db->or_like("sourcing.nama_rfq",$search);
        $this->db->where('type','supplier');
        
        $jum=$this->db->get('sourcing');
        $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }

        foreach ($query->result() as $item) {
       
            $output['data'][]=array(
                '<a class="text-primary" href="'.site_url('backendbulk/detail/' . $item->id).'">'.$item->id.'</a>',
                '<a class="text-primary" href="'.site_url('member/bulkPdf/' . $item->id).'"target="_blank">'.$item->nama_rfq.'</a>',
                '<a class="text-primary" href="'.site_url('backendbulk/detail/' . $item->id).'">'.$item->name_member. ($item->viewed == '0' ? '<span class="label label-success" style="font-weight:bold">new</span>' : '').'</a>',
                $item->company,
                '<span class="text-muted">'.date("d M y", $item->created_at).'</span>',
                '<span class="text-muted">'.$item->province.'</span>',
                '<span class="text-muted">'.$item->phone.'</span>',
                ucfirst($item->type),
                $item->status == 0 ? 'Belum di Proses' : ($item->status == 1 ? 'Sudah Kirim' : ($item->status == 2 ? 'Nego' : 'Selesai'))
            );
        
        }

        echo json_encode($output);

    }
    
    function ambil_data_item(){

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $this->db->where('s.type','buyer')
            ->join('sourcing s','si.sourcing_id = s.id');
        $total=$this->db->count_all_results("sourcing_item si");
        
        
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        
        if($search!=""){
            $this->db->or_like("s.company",$search);
            $this->db->or_like("s.province",$search);
            $this->db->or_like("si.items",$search);
        }
        
        $this->db->limit($length,$start);
        if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('s.id',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '2'):
			$this->db->order_by('nama_rfq',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '1'):
			$this->db->order_by('company',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '4'):
			$this->db->order_by('province',$_REQUEST['order'][0]['dir']);
		endif;
		if($_REQUEST['order'][0]['column'] == '3'):
			$this->db->order_by('items',$_REQUEST['order'][0]['dir']);
		endif;
		
		$this->db->select('*, s.id as id, si.uom as uom, si.qty as qty, COUNT(DISTINCT(sis.id)) as status');
        $this->db->where('s.type','buyer')
            ->join('sourcing s','si.sourcing_id = s.id')
            ->join('sourcing_item_source sis','sis.sourcing_item = si.id','left')
            ->group_by('si.id');
        $query=$this->db->get('sourcing_item si');
        if($search!=""){
       
        $this->db->or_like("s.company",$search);
        $this->db->or_like("s.province",$search);
        $this->db->or_like("si.items",$search);
       
        $this->db->where('s.type','buyer')
            ->join('sourcing s','si.sourcing_id = s.id');
        $jum=$this->db->get('sourcing_item si');
        $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }

        foreach ($query->result() as $item) {
       
            $output['data'][]=array(
                '<a class="text-primary" href="'.site_url('backendbulk/detail/' . $item->id).'">'.$item->id.'</a>',
                $item->company,
                $item->nama_rfq,
                $item->items,
                $item->province,
                $item->qty,
                $item->uom,
                $item->status
            );
        
        }

        echo json_encode($output);

    }
    
}