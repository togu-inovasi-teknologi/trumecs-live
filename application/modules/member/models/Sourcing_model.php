<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sourcing_model extends CI_Model
{
    var $table = "sourcing";
    var $order_column = array('s.id', 's.id as id', 'nama_rfq', 's.created_at', 'DATE_FORMAT(FROM_UNIXTIME(s.created_at), "%e %b %Y") AS "date"', 'v.id as village_id', 'v.name as village_name', 'd.id as district_id', 'd.name as district_name', 'r.id as regency_id', 'r.name as regency_name', 'p.id province_id', 'p.name as province_name', 'c.id as contact_id', 'c.name as contact_name', 'c.telephone as contact_phone', 'c.email as contact_email', 'co.id as company_id', 'co.name as company_id', 'co.name as company_name', 'co.email as company_email', 'co.telephone as company_phone', 'co.billing_village as company_village', 'co.billing_district as company_district', 'co.billing_regency as company_regency', 'co.billing_province as company_province', 'SUM(si.price) as total_sourcing');
    var $select_column = array('s.*', 's.id as id', 'sum(si.price) as total_price', 's.created_at', 'DATE_FORMAT(FROM_UNIXTIME(s.created_at), "%e %b %Y") AS "date"', 'v.id as village_id', 'v.name as village_name', 'd.id as district_id', 'd.name as district_name', 'r.id as regency_id', 'r.name as regency_name', 'p.id province_id', 'p.name as province_name', 'c.id as contact_id', 'c.name as contact_name', 'c.telephone as contact_phone', 'c.email as contact_email', 'co.id as company_id', 'co.name as company_id', 'co.name as company_name', 'co.email as company_email', 'co.telephone as company_phone', 'co.billing_village as company_village', 'co.billing_district as company_district', 'co.billing_regency as company_regency', 'co.billing_province as company_province', 'SUM(si.price) as total_sourcing');
    var $search_column = array('s.id', 's.id as id', 'total_price', 's.created_at', 'DATE_FORMAT(FROM_UNIXTIME(s.created_at), "%e %b %Y") AS "date"', 'v.id as village_id', 'v.name as village_name', 'd.id as district_id', 'd.name as district_name', 'r.id as regency_id', 'r.name as regency_name', 'p.id province_id', 'p.name as province_name', 'c.id as contact_id', 'c.name as contact_name', 'c.telephone as contact_phone', 'c.email as contact_email', 'co.id as company_id', 'co.name as company_id', 'co.name as company_name', 'co.email as company_email', 'co.telephone as company_phone', 'co.billing_village as company_village', 'co.billing_district as company_district', 'co.billing_regency as company_regency', 'co.billing_province as company_province', 'SUM(si.price) as total_sourcing');

    public $id, $address, $province, $district, $city, $village, $zipcode, $note, $name, $phone, $company, $status, $updated_by, $offer, $admin_note, $created_at, $viewed, $text_rfq, $inc_ppn, $inc_ongkir, $nama_rfq, $updated_at;

    protected $query;

    private $select = '*';

    function __construct($data = [])
    {

        if (!empty($data))
            $this->_set($data);

        parent::__construct();
        $this->_initSelect();
    }

    private function _initSelect()
    {
        $this->db->reset_query();
        $this->query = $this->db->select($this->select)->from($this->table);
    }

    public function join(array $array)
    {

        foreach ($array as $key => $value) {
            if (array_key_exists('keyword', $value)) {
                $this->query->join($value['table'], $value['on'], $value['keyword']);
            } else {
                $this->query->join($value['table'], $value['on']);
            }
        }
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
        $this->single();
        return $this;
    }

    public function getId()
    {

        $this->query = $this->query->where('id', $this->id);
        $this->get();
        $this->single();
        return $this;
    }

    public function items()
    {

        $this->load->model('member/sourcing_item_model');

        $sourcing_item = new Sourcing_item_model(['table' => 'sourcing_item si']);

        $query_total_buying_price = 'SUM(sis.price * sis.qty)';
        $query_total_selling_price = 'SUM(si.price * sis.qty)';
        $query_ppn_in = 'SUM(sis.price * 0.11 * sis.qty)';
        $query_ppn_out = 'SUM(si.price * 0.11 * sis.qty)';
        $query_gross_profit = '(' . $query_total_selling_price . ' + ' . $query_ppn_out . ') - (' . $query_total_buying_price . ' + ' . $query_ppn_in . ')';

        $query_persentation = '((' . $query_gross_profit . ' - ' . $query_ppn_in . ' + ' . $query_ppn_out . ') / ' . $query_total_selling_price . ' ) * 100';

        $sourcing_item->select([
            'si.*',
            $query_total_buying_price . ' as total_buying_price',
            $query_total_selling_price . ' as total_price',
            $query_ppn_in . ' as ppn_in',
            $query_ppn_out . ' as ppn_out',
            $query_gross_profit . ' as total_gross_profit',
            $query_persentation . ' as total_persentation',
        ]);
        $sourcing_item->join([
            [
                'table' => 'sourcing_item_source sis',
                'on' => 'si.id = sis.sourcing_item',
            ]
        ]);
        $sourcing_item->where(['sourcing_id' => $this->id]);
        $sourcing_item->group_by('si.id');


        $items = $sourcing_item->get()->result();

        $this->_set(['items' => $items]);
        return $sourcing_item;
    }





    public function contact()
    {

        $this->load->model('contact/contact_model');

        $contactModel = new Contact_model();

        $data['contact'] = $contactModel->where('id', $this->contact_id)->get()->single()->with(['member']);

        $this->_set($data);
        return $this;
    }

    public function address()
    {

        $this->load->model('address/address_model');

        $address = new Address_model(['table' => 'villages']);
        $data = $address->where('id', $this->village_id)->get()->single();

        $this->_set(['address' => $data]);

        return $this;
    }


    public function with(array $with = [])
    {
        $this->with = $with;
        if ($this->id) {

            foreach ($with as $key => $value) {

                $this->$value();
            }
        }

        return $this;
    }

    public function company()
    {
        $this->load->model('company/company_model');
        $companyModel = new Company_model();

        $data = $companyModel->where(['id' => $this->company_id])->get()->single()->with(['address']);

        // die;
        $this->_set(['company' => $data]);
        return $this;
    }


    public function single()
    {

        $data = $this->query->row_array();

        $data['address_detail'] = $data['address'];

        $this->_set($data);
        return $this;
    }

    public function result()
    {

        var_dump($this->query->get_compiled_select());
        $results = $this->query->get()->result();
        die;
        $return = [];

        foreach ($results as $key => $value) {
            $this->load->model('member/sourcing_model');
            $model = new Sourcing_model($value);

            foreach ($this->with as $key => $value) {
                $model->$value();
            }
            array_push($return, $model);
        }

        return $return;
    }

    public function where(array $where)
    {

        $this->query = $this->query->where($where);
        return $this;
    }
    public function whereIn($column, array $where)
    {
        $this->query = $this->query->where_in($column, $where);

        return $this;
    }

    public function _get($data)
    {
        $data = $this->db->get_where($this->table, $data)->result_array();
        $this->_set($data);
    }

    private function _query()
    {

        $session = $this->session->all_userdata();


        $this->db->reset_query();

        $this->db->select($this->select_column);
        $this->db->from($this->table . ' s');
        $this->db->join('sourcing_item si', 'si.sourcing_id = s.id');

        if (array_key_exists('member', $session)) {
            $this->db->where('s.member_id', $session['member']['id']);
        }


        $this->db->where('s.status', 3);

        if ($_POST['type']) {
            $this->db->where('s.type', $_POST['type']);
        } else {
            $this->db->where('s.type', 'buyer');
        }


        // $this->db->where('si.status', 2);
        $this->db->join('villages v', 'v.id = s.village_id', 'LEFT');
        $this->db->join('districts d', 'd.id = v.district_id', 'LEFT');
        $this->db->join('regencies r', 'r.id = d.regency_id', 'LEFT');
        $this->db->join('provinces p', 'p.id = r.province_id', 'LEFT');
        $this->db->join('contacts c', 'c.id = s.contact_id', 'LEFT');
        $this->db->join('companies co', 'co.id = c.company_id', 'LEFT');

        $this->db->group_by('s.id');


        if (!empty($_POST["search"]["value"])) {
            $this->db->group_start();
            foreach ($this->search_column as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($value, $_POST["search"]["value"], 'both');
                }
            }
            $this->db->group_end();
        }

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
        if (!empty($this->where)) {
            $this->db->where($this->where);
        }
        return $this->db->count_all_results();
    }
    public function update($data)
    {
        $this->db->update($this->table, $data);
    }
}
