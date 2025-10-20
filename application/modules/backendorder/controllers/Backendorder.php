<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendorder extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
        $this->load->model("order/order_model");
        $this->load->language("member/order");
        $this->load->language("member/bulk");
        $this->load->language("address");
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
            $data["datawhere"] = array_merge($data["datawhere"], array("iduniq" => $idorder));
        }

        //$config["per_page"] = $this->etx_model->record_count($data["datawhere"]);
        $config["per_page"] =  10;

        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page, $data["datawhere"]);

        //$data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        $data['content'] = 'list_order';
        $this->load->view('backend/template_front', $data);
    }
    // public function set_delivery($iduniq)
    // {
    //     $order = $this->db->get_where('order', ['iduniq' => $iduniq])->row_array();

    //     $data['order'] = $order;
    //     $data['content'] = 'confirm_pengiriman';
    //     $data['js'] = ['modules/backendorder/js/shipping_set.js'];
    //     $this->load->view('backend/template_front', $data);

    // }

    public function save_delivery()
    {

        $resi = $this->input->post("shipping_resi");
        $iduniq = $this->input->post('unique');

        if (empty($resi) && $_FILES['file_delivery']['error'] == 4) {

            $this->session->set_flashdata('error_save_delivery_data', 'Masukan Resi Pengiriman Atau Bukti Dokument Pengiriman');

            redirect('backendorder/set_delivery/' . $iduniq);
        } else {
            if (do_upload_file('file_delivery', 'order')) {
                $data['status'] = 'delivery';
                $data['file_delivery'] = $this->upload->data('file_name');
                $data['shipping_resi'] = $this->input->post("shipping_resi");
                $data['id'] = $this->input->post("order_id");


                $orderModel = new Order_model($data);

                $orderModel->db_set();


                if ($orderModel->save($data) > 0) {
                    redirect('backendorder/detail/' . $iduniq);
                } else {
                    $this->session->set_flashdata('error_save_delivery_data', 'failed uploaded file');
                    redirect('backendorder/detail/' . $iduniq);
                }
            } else {
                $this->session->set_flashdata('error_save_delivery_data', $this->upload->display_errors());
                redirect('backendorder/detail/' . $iduniq);
            }
        }
    }

    public function get_city()
    {
        $province_name = $this->input->post("province_name");
        $province = $this->db->get_where('provinces', ['name' => $province_name])->row_array();

        $city = $this->db->get_where('regencies', ['province_id' => $province['id']])->result_array();

        echo json_encode($city);
    }

    function ambil_data()
    {
        $this->db->reset_query();
        $status = $this->input->post("status");
        $idorder = $this->input->get("idorder");
        $data["datawhere"] = array();
        if ($status != "all") {
            $data["datawhere"] = array("status" => $status);
        }
        if (!empty($idorder)) {
            $data["datawhere"] = array_merge($data["datawhere"], array("iduniq" => $idorder));
        }
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $this->db->where($data["datawhere"]);
        $total = $this->db->count_all_results("order");
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $this->db->where("(
                            iduniq LIKE '%$search%' 
                            OR billing_name LIKE '%$search%' 
                            OR time LIKE '%$search%'
							OR expired LIKE '%$search%'
							OR shipping_description LIKE '%$search%'
							OR shipping_city LIKE '%$search%'
                        )", '', false);
        }
        $this->db->where($data["datawhere"]);
        $this->db->limit($length, $start);
        if ($_REQUEST['order'][0]['column'] == '0') :
            $this->db->order_by('iduniq', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '1') :
            $this->db->order_by('time', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '2') :
            $this->db->order_by('shipping_description', $_REQUEST['order'][0]['dir']);
        elseif ($_REQUEST['order'][0]['column'] == '3') :
            $this->db->order_by('status', $_REQUEST['order'][0]['dir']);
        endif;
        $query = $this->db->get('order');
        if ($search != "") {
            $this->db->where("(
                            iduniq LIKE '%$search%' 
                            OR billing_name LIKE '%$search%' 
                            OR time LIKE '%$search%'
							OR expired LIKE '%$search%'
							OR shipping_description LIKE '%$search%'
							OR shipping_city LIKE '%$search%'
                        )", '', false);
            $jum = $this->db->get('order');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        foreach ($query->result_array() as $order) {

            $ori = $order["time"];
            $orichange = date("Ymd");
            $oriexpired = $order["time"];
            $oriexpiredchange = date("Ymd", strtotime($oriexpired));
            $if  = ($orichange - $oriexpiredchange >= 7) ? "danger" : "default";
            $s =   $order["status"] != "unpaid" ? $order['status'] == 'waiting_po' ? "primary" : $order['status'] == 'waiting_invoice' ? "info" : $order['status'] == 'delivery' ? "warning" : "success" : "danger";

            $output['data'][] = array(



                '<a class="fbold f14 forange" href="' . base_url() . 'backendorder/detail/' . $order["iduniq"] . '">' . $order["iduniq"] . '</a><br><small><a class="fblack" href="' . base_url() . 'backendmember/detail/' . $order["idmember"] . '">' . $order["billing_name"] . '</small>',

                '<span class="fbold f14 black">' . $order['time'] . '</span>' . '<br>' . '<small class="fbold f12 black label label-' . $if . '">' . $order["expired"] . '</small>',

                '<span class="fbold f14 black">' . $order["shipping_description"] . '</span><br>
                    <small class="fbold f12 black">' . $order["shipping_city"] . '</small>',

                '<span  class="fbold f14 black label label-' . $s . '">' . $this->lang->line(strtolower($order["status"]), FALSE) . '</span><br>'
            );
        }

        echo json_encode($output);
    }

    public function print($uniqid)
    {
        $where = array("iduniq" => $uniqid);

        $model = new etx_model();
        $model->where(['iduniq' => $uniqid])->get()->single()->with(['items', 'buyer', 'supplier']);
        $data["detail"] = $model;

        $data['css'] = [
            "/modules/backendorder/css/detail.css",
            base_url() . "asset/css/select2.min.css",
        ];
        $data['js'] = [
            "/modules/member/js/member/member.js",
            "/modules/backendorder/js/detail.js",
            // base_url() . "asset/js/select2.min.js",
            // base_url() . "asset/backend/js/create-order.js",
        ];

        $data['content'] = 'detail/print';
        $this->load->view('backend/template_front', $data);
    }


    public function detail($uniqid)
    {
        $where = array("iduniq" => $uniqid);

        $model = new etx_model();
        $model->where(['iduniq' => $uniqid])->get()->single()->with(['items', 'buyer', 'supplier']);
        $data["detail"] = $model;

        $data['css'] = [
            "/modules/backendorder/css/detail.css",
            base_url() . "asset/css/select2.min.css",
        ];
        $data['js'] = [
            "/modules/member/js/member/member.js",
            "/modules/backendorder/js/detail.js",
            // base_url() . "asset/js/select2.min.js",
            // base_url() . "asset/backend/js/create-order.js",
        ];
        $data['referal'] = $this->db->get_where('setting', ['name' => 'referal'])->row_array();
        $data['cashback'] = $this->db->get_where('setting', ['name' => 'cashback'])->row_array();
        $data['agent'] = $this->etx_model->get_agent($model->referral_code);
        $data['marketing'] = $this->etx_model->get_marketing($model->marketing_id);
        $data['marketing_setting'] = $this->db->get_where('setting', ['name' => 'marketing_fee'])->row_array();

        if (empty($data["detail"])) {
            $this->session->set_flashdata('message', 'Pesanan tidak ada di database');
            redirect(base_url() . "backendorder/?status=all");
            exit();
        }

        $data['content'] = 'detail';
        $this->load->view('backend/template_front', $data);
    }

    public function sourcing_order() {}

    public function create()
    {
        $this->db->reset_query();
        $sourcing_id = $this->uri->segment(3);
        $sourcingModel = null;

        if ($sourcing_id != null) {

            $this->load->model('member/sourcing_model');

            $sourcingModel = new Sourcing_model(['table' => 'sourcing s']);


            $query_total_buying_price = 'SUM(sis.price * sis.qty)';
            $query_total_selling_price = 'SUM(si.price * sis.qty)';
            $query_ppn_in = 'SUM(sis.price * 0.11 * sis.qty)';
            $query_ppn_out = 'SUM(si.price * 0.11 * sis.qty)';
            $query_gross_profit = '(' . $query_total_selling_price . ' + ' . $query_ppn_out . ') - (' . $query_total_buying_price . ' + ' . $query_ppn_in . ')';

            $query_persentation = '((' . $query_gross_profit . ' - ' . $query_ppn_in . ' + ' . $query_ppn_out . ') / ' . $query_total_selling_price . ' ) * 100';

            $sourcingModel->select([
                's.*',
                's.address as sourcing_address',
                'SUM(sis.qty) as total_quantity',
                $query_total_buying_price . ' as total_buying_price',
                $query_total_selling_price . ' as total_price',
                $query_ppn_in . ' as ppn_in',
                $query_ppn_out . ' as ppn_out',
                $query_gross_profit . ' as total_gross_profit',
                $query_persentation . ' as total_persentation',
            ]);
            $sourcingModel->join([
                [
                    'table' => 'sourcing_item si',
                    'on' => 'si.sourcing_id = s.id',
                ],
                [
                    'table' => 'sourcing_item_source sis',
                    'on' => 'sis.sourcing_item = si.id',
                ],
            ]);
            $sourcingModel->where(['s.id' => $sourcing_id]);



            $sourcingModel->get()->with(['items', 'address', 'contact', 'company']);
        }

        $this->load->model('backendprospek/M_Prospek');
        $data["css"] = array(
            base_url() . "asset/css/bootstrap.4-alpha.css",
            base_url() . "asset/css/page_detail.css",
            base_url() . "asset/js/slick/slick.css",
            base_url() . "asset/css/select2.min.css",
            base_url() . "asset/js/slick/slick-theme.css",
            '/modules/backendorder/css/create.css',
        );
        $data["js"] = array(
            base_url() . "asset/js/jquery.elevateZoom.js",
            base_url() . "asset/backend/js/create-order.js",
            base_url() . "asset/js/select2.min.js",
            // base_url() . "asset/js/slick/slick.min.js",
            '/modules/backendorder/js/create.js',
        );

        $this->db->reset_query();
        $data['sourcing'] = $sourcingModel;
        $data['provinsi'] = $this->M_Prospek->get_provinsi();


        $this->db->reset_query();

        $data['referal'] = $this->db->get_where('setting', ['name' => 'referal'])->row();
        $data['cashback'] = $this->db->get_where('setting', ['name' => 'cashback'])->row();
        $data['marketing_fee'] = $this->db->get_where('setting', ['name' => 'marketing_fee'])->row();
        $session = $this->session->all_userdata();
        $sessionadmin = array_key_exists("admin", $session) ? $session["admin"] : '';

        $data['admin'] = $sessionadmin;
        if ($sourcingModel != null) {
            if ($sourcingModel->type == 'buyer') {
                $this->form_validation->set_rules($this->etx_model->configRulesBuyer);
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

                foreach ($sourcingModel->items as $key => $value) {

                    $this->form_validation->set_rules('id_produk[' . $key . ']', 'Produk', 'required');
                    $this->form_validation->set_rules('weight[' . $key . ']', 'Berat Produk', 'required', [
                        'required' => 'Berat Produk Harus Diisi.'
                    ]);
                }
            }
        }


        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'form_order';
            $this->load->view('backend/template_front', $data);
        } else {

            //    "backendorder/store
            $order['iduniq'] = generate_orderId();
            $order['time'] = date('d-m-Y');
            $order['status'] = $this->input->post('status');

            if ($sourcingModel->type == 'buyer') {

                $order['billing_name'] = $sourcingModel->name;
                $order['billing_company'] = $sourcingModel->company->name;
                $order['billing_address'] = $sourcingModel->company->billing_address;
                $order['billing_province'] = $sourcingModel->company->billing_province;
                $order['billing_city'] = $sourcingModel->company->billing_regency;
                $order['billing_village'] = $sourcingModel->company->billing_village;
                $order['billing_village_id'] = $sourcingModel->company->billing_village_id;
                $order['billing_kodepos'] = $sourcingModel->company->billing_code;
                $order['shipping_name'] = $sourcingModel->name;
                $order['shipping_company'] = $sourcingModel->company->name;
                $order['shipping_address'] = $sourcingModel->address_detail;
                $order['shipping_province'] = $sourcingModel->province;
                $order['shipping_city'] = $sourcingModel->city;
                $order['shipping_village'] = $sourcingModel->village;
                $order['shipping_village_id'] = $sourcingModel->village_id;
                $order['shipping_kodepos'] = $sourcingModel->zipcode;
                $order['shipping_cost'] = $sourcingModel->inc_ongkir > 0 ? 0 : $this->input->post('shipping_cost');
                $order['shipping_description'] = $this->input->post('shipping_description');
                $order['shipping_resi'] = $this->input->post('shipping_resi');
                $order['comment'] = $this->input->post('comment');
                $order['ppn'] = 0;

                $order['payment_total'] = $this->input->post('total');
                $order['sourcing_buyer'] = $this->input->post('sourcing_buyer');



                $items = $this->input->post('id_produk');
                $product_names = $this->input->post('product_names');
                $weight = $this->input->post('weight');
                $qty = $this->input->post('qty');
                $price = $this->input->post('harga');
                $warranty = $this->input->post('warranty');

                $gross = 0;

                foreach ($sourcingModel->items as $key => $item) {
                    $gross += $item->calculateGrossProfit();
                }

                $order['referral_code'] = $this->input->post('referral_code');
                $order['referal_amount'] = ((int) $this->input->post('referal_persentase') / 100) * $gross;
                $order['referal_persentase'] = $this->input->post('referal_persentase');

                $order['cashback_to_buyer'] = $this->input->post('cashback_to_buyer');
                $order['cashback_persentase'] = $this->input->post('cashback_persentase');
                $order['cashback_amount'] = ((int) $this->input->post('cashback_persentase') / 100) * $gross;

                $order['marketing_amount'] = ((int) $this->input->post('marketing_persentase') / 100) * $gross;
                $order['marketing_id'] = $this->input->post('marketing_id');
                $order['marketing_persentase'] = $this->input->post('marketing_persentase');


                $order['file_po'] = do_upload_file_return_file_name('file_po', 'order');
                $order['file_invoice'] = do_upload_file_return_file_name('file_invoice', 'order');
                $order['file_payment'] = do_upload_file_return_file_name('file_payment', 'order');
                $order['file_delivery'] = do_upload_file_return_file_name('file_delivery', 'order');
                $order['file_receive'] = do_upload_file_return_file_name('file_receive', 'order');


                $this->db->insert('order', $order);
                $id_order = $this->db->insert_id();

                $produk = [];

                foreach ($sourcingModel->items as $key => $item) {
                    $this->load->model('backendproduct/Etx_product');
                    $product = $this->Etx_product->getproduct(array('id' => $item->product_id));
                    $produk[] = array(
                        'id_order' => $id_order,
                        'id_product' => $item->product_id,
                        'quantity' => $qty[$key],
                        'price' => $price[$key],
                        'weight' => $weight[$key],
                        'unit' => $product['unit'],
                        'warranty' => $warranty[$key],
                        'name_product' => $product['tittle'],
                        'partnumber_product' => $product['partnumber'],
                        'sx' => $product['sx'],
                        'sy' => $product['sy'],
                        'sz' => $product['sz'],
                        'px' => $product['px'],
                        'py' => $product['py'],
                        'pz' => $product['pz']
                    );
                }

                // echo json_encode($produk);
                // die;

                $this->db->insert_batch('order_detail', $produk);
                return redirect('backendorder/detail/' . $order['iduniq']);
            }
        }
    }



    public function updateorder()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('iduniq', 'Iduniq', 'required');
        $id = $this->input->post("id");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Sistem mengalami kendala saat update');
            redirect(base_url() . "backendorder/?status=all");
            exit();
        }
        $where = array('id' => $this->input->post('id'));
        $set = array();
        if (!empty($this->input->post("shipping_cost"))) {
            $set = array_merge($set, array('shipping_cost' => $this->input->post("shipping_cost")));
        }
        if (!empty($this->input->post("comment"))) {
            $set = array_merge($set, array('comment' => $this->input->post("comment")));
        }
        if (!empty($this->input->post("status"))) {
            $set = array_merge($set, array('status' => $this->input->post("status")));
            $statusorder = array("paid", "process", "delivery", "complete");
            $sttts = $this->input->post("status");
            $idorder = $this->input->post('iduniq');
            if ($sttts == "delivery") {
                $pesan = 'Dear bagian Delivery,<br>Mohon di cek admin trumecs, permintaan baru untuk pengiriman id order ' . $idorder . '.<br>' . '<a target="_blank" href="' . base_url() . 'backendadmin">Lihat sekarang</a>';
                $subject = "Permintaan baru pengiriman #" . $idorder;
                $this->sentemailnotiftoadmin($pesan, $subject, "5");
            }
            if ($sttts == "complete") {
                $from = "no-reply@trumecs.com";
                $password = "no-reply#trumecs#123abc";
                $dataemail["name"] = $this->input->post('nama');
                $dataemail["order_id"] = $idorder;
                $to = $this->input->post('email');
                $subject = "Pesanan selesai #" . $idorder;
                $message = $this->load->view('email/email-order-complete', $dataemail, true);
                $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);

                $this->etx_model->check_referral($where);
            }
        }
        $this->etx_model->updateorder($where, $set);
        redirect(base_url() . 'backendorder/detail/' . $this->input->post("iduniq"));
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

    public function store()
    {

        $province_id = $this->input->post("province");
        $city_id = $this->input->post("regency");

        $province = $this->db->get_where('provinces', ['id' => $province_id])->row_array();
        $regency = $this->db->get_where('regencies', ['id' => $city_id])->row_array();

        $email = $this->input->post('email');
        $name = $this->input->post('member_name');
        $memberId = $this->input->post('idmember');


        if ($memberId < 1) {
            $this->db->insert('member', ['name' => $name, 'email' => $email]);
            $memberId = $this->db->insert_id();
        }


        $data['iduniq'] = $this->input->post('iduniq');
        $data['time'] = date("Y-m-d");
        $data['expired'] = date("Y-m-d");
        $data['idmember'] = $memberId;
        $data['status'] = 'waiting_po';
        $data['billing_name'] = $this->input->post('billing_name');
        $data['billing_company'] = $this->input->post('billing_company');
        $data['billing_address'] = $this->input->post('billing_address');
        $data['billing_province'] = $province['name'];
        $data['billing_city'] = $regency['name'];
        $data['billing_village_id'] = $this->input->post('billing_village_id');
        $data['billing_village'] = $this->input->post('billing_village');
        $data['billing_kodepos'] = $this->input->post('billing_kodepos');
        $data['billing_phone'] = $this->input->post('billing_phone');
        $data['shipping_name'] = $this->input->post('shipping_name');
        $data['shipping_company'] = $this->input->post('shipping_company');
        $data['shipping_address'] = $this->input->post('shipping_address');
        $data['shipping_province'] = $this->input->post('shipping_province');
        $data['shipping_city'] = $this->input->post('shipping_city');
        $data['shipping_village_id'] = $this->input->post('shipping_village_id');
        $data['shipping_village'] = $this->input->post('shipping_village');
        $data['shipping_kodepos'] = $this->input->post('shipping_kodepos');
        $data['shipping_phone'] = $this->input->post('shipping_phone');
        $data['shipping_cost'] = $this->input->post('shipping_cost');
        $data['shipping_description'] = $this->input->post('shipping_description');
        $data['shipping_resi'] = $this->input->post('shipping_resi');
        $data['comment'] = $this->input->post('comment');
        $data['payment_total'] = 12312312;
        $data['point'] = 0;
        $this->db->insert('order', $data);

        $id_order = $this->db->insert_id();

        $item = $this->input->post('id_produk[]');
        $harga = $this->input->post('harga[]');
        $qty = $this->input->post('qty[]');
        $produk = array();
        $this->load->model('backendproduct/Etx_product');
        foreach ($item as $key => $items) {
            $product = $this->Etx_product->getproduct(array('id' => $items));
            $produk[] = array(
                'id_order' => $id_order,
                'id_product' => $items,
                'quantity' => $qty[$key],
                'price' => $harga[$key],
                'weight' => $product['weight'],
                'unit' => $product['unit'],
                'warranty' => $product['warranty'],
                'name_product' => $product['tittle'],
                'partnumber_product' => $product['partnumber'],
                'sx' => $product['sx'],
                'sy' => $product['sy'],
                'sz' => $product['sz'],
                'px' => $product['px'],
                'py' => $product['py'],
                'pz' => $product['pz']
            );
        }
        $this->db->insert_batch('order_detail', $produk);
        redirect('/backendorder/detail/' . $data['iduniq']);
    }

    public function update_status()
    {
        $data['status'] = 'waiting_payment';
        $id = $this->input->post('order_id');

        $this->db->update('order', $data, ['id' => $id]);

        // $this->session->set_flashdata('status_upldate', )

        redirect('/backendorder/detail/' . $this->input->post('order_number'));
    }

    public function set_referal($iduniq)
    {

        $data['referral_code'] = $this->input->post('referal_code');
        $data['referal_persentase'] = $this->input->post('referal_persentase');
        $data['cashback_persentase'] = $this->input->post('cashback_presentase');
        $data['cashback_to_buyer'] = isset($_POST['cashback_to_buyer']) ? 1 : 0;

        $this->db->where('iduniq', $iduniq);
        $this->db->update('order', $data);

        // $this->etx_model->check_referral(['iduniq' => $iduniq]);

        // var_dump($data);
        // die;

        redirect('/backendorder/detail/' . $iduniq);
    }
    public function set_marketing($iduniq)
    {

        $data['marketing_id'] = $this->input->post('marketing_id');
        $data['marketing_persentase'] = $this->input->post('marketing_persentase');

        $this->db->where('iduniq', $iduniq);
        $this->db->update('order', $data);


        redirect('/backendorder/detail/' . $iduniq);
    }

    public function receive()
    {
        $order_id = $this->input->post('order_id');

        $dataOrder = $this->etx_model->getorder(['id' => $order_id]);

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
                redirect('/backendorder/detail/' . $dataOrder['iduniq']);
            } else {
                $this->session->set_flashdata('error_uploaded_po', 'failed uploaded file');
                redirect('/backendorder/detail/' . $dataOrder['iduniq']);
            }
        } else {
            $this->session->set_flashdata('error_uploaded_po', $this->upload->display_errors());
            redirect('/backendorder/detail/' . $dataOrder['iduniq']);
        }
    }
}
