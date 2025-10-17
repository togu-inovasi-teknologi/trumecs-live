<?php
defined('BASEPATH') or exit('No direct script access allowed');

class etx_model extends CI_Model
{

    public $table = 'order';
    public $select = '*';

    private $query;

    public $configRulesBuyer = [
        [
            'field' => 'status',
            'rules' => 'required',
            'errors' => [
                'required' => 'Status Harus diisi.'
            ],
            
        ],
        [
            'field' => 'sourcing_buyer',
            'rules' => 'required',
            'errors' => [
                'required' => 'Data Buyer Harus diisi.'
            ],
            'error_prefix' => '<div class="alert alert-danger" role="alert">',
            'error_suffix' => '</div>'
            
        ],
        
        
    ];

    function __construct(array $data = [])
    {
        if(!empty($data))
            $this->_set($data);

        $this->_initSelect();    
        parent::__construct();
    }

    private function _initSelect()
    {
        $this->db->reset_query();
        
        $this->query = $this->db->select($this->select)->from($this->table);
    }

    public function select(array $array)
    {
        $this->select = join(',', $array);
        $this->_initSelect();
        return $this;
    }

    public function _set($data)
    {
        $data = (array)$data;

        
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function get()
    {
        $this->query = $this->query->get();
        return $this;
    }

    public function with(array $with = [])
    {
        foreach ($with as $key => $value) {
            $this->$value();
        }

        return $this;
    }

    public function where(array $where)
    {
        $this->query = $this->query->where($where);
        return $this;
    }

    public function single()
    {
        $data = $this->query->row_array();
        $data['billing_address_detail'] = $data['billing_address'];
        $data['billing_address_detail'] = $data['shipping_address'];
        $this->_set($data);
        return $this;
    }

    public function supplier()
    {
        $ids = [];
        foreach ($this->buyer->items as $key => $value) {
            array_push($ids, $value->id);
        }


        $ids_str = implode(', ', $ids);

        $this->load->model('member/sourcing_item_source_model');

        $sourcing_item_source = new Sourcing_item_source_model();
        $sourcing_item_source->select(['*', 'sourcing_item as item_id']);
        $sourcing_item_source->where(['item_id IN ('.$ids_str.')']);
        $item_supplier = $sourcing_item_source->result();
       
        
        $this->_set(['supplier' => $item_supplier]);
        return $sourcing_item_source;
    }

    public function buyer()
    {
        $this->load->model('member/sourcing_model');

        $sourcingModel = new Sourcing_model(['table' => 'sourcing s']);


        $query_total_buying_price = 'SUM(sis.price * sis.qty)';
        $query_total_selling_price = 'SUM(si.price * sis.qty)';
        $query_ppn_in = 'SUM(sis.price * 0.11 * sis.qty)';
        $query_ppn_out = 'SUM(si.price * 0.11 * sis.qty)';
        $query_gross_profit = '('. $query_total_selling_price .' + '. $query_ppn_out .') - ('. $query_total_buying_price .' + '. $query_ppn_in .')';

        $query_persentation = '(('. $query_gross_profit .' - '. $query_ppn_in .' + '. $query_ppn_out .') / '. $query_total_selling_price .' ) * 100';

        $sourcingModel->select([
            's.*','s.address as sourcing_address',
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

        $sourcingModel->where(['s.id' => $this->sourcing_buyer]);

        $data = $sourcingModel->get()->with(['items']);

        $this->_set(['buyer' => $data]);

        return $sourcingModel;

    }

    public function items()
    {
        $this->load->model('backendorder/order_item_model');
        $order_item = new Order_item_model(['table' => 'order_detail od']);
        $order_item->select(['od.*', 'p.tittle', 'p.partnumber']);
        $order_item->join([
            [
                'table' => 'product p',
                'on' => 'p.id = od.id_product'
            ]
        ]);
        $items = $order_item->where(['od.id_order' => $this->id])->get()->result();
       
        $this->_set(['items' => $items]);
        return $order_item;
    }


    public function record_count($datawhere)
    {

        $this->db->where($datawhere);
        $query = $this->db
            ->from("order");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start, $datawhere)
    {
        $this->db->reset_query();
        $this->db->where($datawhere);
        $this->db->limit($limit, $start)
            ->order_by("id", "DESC");
        $query = $this->db->get("order");
        return  $query->result_array();
    }

    public function getorder($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("order");
        $returnorder = $query1->result_array();
       
        $whereid = $returnorder[0]["id"];
        $whereidmember = $returnorder[0]["idmember"];

        if (empty($returnorder)) {
            $this->session->set_flashdata('message', 'Pesanan tidak ada di database');
            redirect(base_url() . "backendorder/?status=all");
            exit();
        }

        $whereorder = array('id_order' => $whereid);
        $this->db->where($whereorder);
        $listdetail = $this->db->get("order_detail");
        $returnlistdetail["listdetail"] = $listdetail->result_array();
        $returnall = array_merge($returnorder[0], $returnlistdetail);

        $returndetailmember["detailmember"] = [];
        // var_dump($returnorder);
        // die;
        if($whereidmember > 0){
            $wheremember = array('id' => $whereidmember);
            $this->db->where($wheremember);
            $detailmember = $this->db->get("member");
            $remove0 = $detailmember->result_array();
    
            
           
            $returndetailmember["detailmember"] = $remove0[0];
    
        }else{
            $returndetailmember["detailmember"]['id'] = null;
            $returndetailmember["detailmember"]['name'] = '-';
            $returndetailmember["detailmember"]['email'] = '-';
            $returndetailmember["detailmember"]['phone'] = '-';
        }

        $returnall = array_merge($returnall, $returndetailmember);

        return $returnall;
    }

    public function updateorder($where, $set)
    {
        $this->db->where($where)->set($set)->update("order");
    }

    public function hapusorder($where)
    {
        $this->db->where($where)->delete("order");
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

    public function check_referral($idorder)
    {
        $order = $this->getorder($idorder);


        if ($order['referral_code'] != '') {  

            $referalPresentase = 0;


            if($order['referal_persentase'] != null){
                $referalPresentase = $order['referal_persentase'];
            }else{
                $cashback = $this->db->get_where('setting', ['name' => 'referal'])->row_array();
                $referalPresentase = $cashback['value'];
            }


            $this->db->where('referral_code', $order['referral_code']);
            $check = $this->db->get('referral_code');

            if ($check->num_rows() > 0) {
                $point = $order['payment_total'] * $referalPresentase / 100;

                $member = $this->db->get_where('member', ['id' => $order['idmember']])->row_array();

                $memberPoint = ($member['point'] ?? 0) + $point;

            
                $this->db->set('point', $memberPoint, false);
                $this->db->where('id', $order['idmember']);
                $this->db->update('member');


                $this->db->set('referal_amount', $point, false);
                $this->db->where('id', $order['id']);
                $this->db->update('order');

            
                $data_mutasi = array(
                    'mutation_type' => 1,
                    'user_id' => $order['idmember'],
                    'amount' => $point,
                    'description' => "",
                    'reference' => 'referral',
                    'reference_id' => $idorder['id'],
                    'status' => 'success',
                    'user_reference' => 'agent',
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                );
                $this->db->insert('coin_mutation', $data_mutasi);


            }


            
        }

            
    }



    public function check_cashback($whereOrder)
    {
        $order = $this->getorder($whereOrder);

        $cashback_presentase = $marketing['cashback_persentase'] ?? 0;


        if($cashback_presentase == 0){
            $cashback = $this->db->get_where('setting', ['name' => 'cashback'])->row_array();
            $cashback_presentase = $cashback['value'];
        }


        $point = $order['payment_total'] * $cashback_presentase / 100;
        
        
        $this->db->set('cashback_amount', $point, false);
        $this->db->where('id', $order['id']);
        $this->db->update('order');
    }

   

    public function check_marketing($whereOrder)
    {
        $order = $this->getorder($whereOrder);

       

        if ($order['marketing_id'] != null) {  

            $marketing = $this->get_marketing($order['marketing_id']);

            $marketingPersentase = $marketing['marketing_persentase'] ?? 0;


            if($marketingPersentase == 0){
                $marketing = $this->db->get_where('setting', ['name' => 'marketing_fee'])->row_array();
                $marketingPersentase = $marketing['value'];
            }


            $point = $order['payment_total'] * $marketingPersentase / 100;

            $marketing = $this->db->get_where('admin', ['id' => $order['marketing_id']])->row_array();

            $marketingPoint = ($marketing['point'] ?? 0) + $point;
            
            
            $this->db->set('point', $point, false);
            $this->db->where('id', $order['marketing_id']);
            $this->db->update('admin');


            $this->db->set('marketing_amount', $point, false);
            $this->db->where('id', $order['id']);
            $this->db->update('order');

        
            $data_mutasi = array(
                'mutation_type' => 1,
                'user_id' => $order['marketing_id'],
                'amount' => $point,
                'description' => "",
                'reference' => 'referral',
                'reference_id' => $order['id'],
                'status' => 'success',
                'user_reference' => 'marketing',
                'created_at' => strtotime(date('Y-m-d H:i:s')),
            );
            $this->db->insert('coin_mutation', $data_mutasi);

            
        }
    }

     public function get_agent($referal_code)
     {
        return $this->db->select("*")
                        ->from('referral_code rc')
                        ->join('member m', 'm.id = rc.user_id')
                        ->join('order o', 'o.referral_code = rc.referral_code')
                        ->where('rc.referral_code', $referal_code)
                        ->get()
                        ->row_array();
     }
     public function get_marketing($marketing_id)
     {
        return $this->db->select("a.*")
                        ->from('admin a')
                        ->join('order o', 'o.marketing_id = a.id')
                        ->where('a.id', $marketing_id)
                        ->get()
                        ->row_array();
     }


    public function getShippingCost()
    {
        if($this->shipping_cost > 0)
        {
            return $this->shipping_cost * ppn_value();
        }else{
            return;
        }
    }
    public function pphMarketing()
    {
        return 0.025 * $this->marketing_amount;;
    }

    public function pphCashback()
    {
        return 0.025 * $this->cashback_amount;
    }

    public function pphReferral()
    {
        if($this->referral_code == "" || $this->referral_code == null){
            return 0;
        }else{

            return 0.025 * $this->referal_amount;
        }
    }

    public function costPajak()
    {
        $keluaran = $this->buyer->ppn_out;
        $masukan = $this->buyer->ppn_in;
        
        $costPajak = $keluaran - $masukan;
        return $costPajak;
    }

    public function netProfit()
    {
        $costPajak = $this->costPajak();
        $pphMarketing = $this->pphMarketing();
        $pphCashback = $this->pphCashback();
        $pphReferral = $this->pphReferral();

        $netProfit =  $this->buyer->total_gross_profit - $costPajak - $pphMarketing - $pphCashback - $pphReferral - $this->marketing_amount - $this->cashback_amount - ($this->referral_code == "" || $this->referral_code == null ? 0 : $this->referal_amount);
        return $netProfit;
    }
}