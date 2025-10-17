<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GetJson extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("company/company_model");
        $this->load->model("member/member_model");
        // $this->load->model("contact/contact_model");
        // $this->load->model("store_model");
        // $this->load->model("product/product_model");
        // $this->load->model("category/category_model");
        // $this->load->model("c/c_model");
    }

   


    public function getJsonAllCategoryOnly()
    {
        $this->load->model("product/product_model");
        $data = $this->product_model->allcategorionly();

        echo json_encode($data);
    }

    public function getJsonBrand()
    {

        $this->load->model("product/product_model");
        $data = $this->product_model->allBrandOnly();

        echo json_encode($data);
    }

    public function getCompany()
    {
        $keyword = $_GET['keyword'];
        
        $data = $this->db->from('companies')
                         ->select('*')
                         ->like('name', '%'. $keyword. '%')
                         ->get()->result();

        
        echo json_encode($data);
    }

    public function sourcing_detail()
    {
        $sourcingId = $_POST['id'];

        $this->load->model("member/sourcing_model");

        $model = new Sourcing_model();
        $model->select(['*'])->where(['id' => $sourcingId])->get()->single()->with(['contact', 'company', 'items']);

        echo json_encode($model);

    }

    public function getDatatableMember()
    {
        $data = $this->member_model->make_datatables();

        $response = $data;

        $output = [
            "draw" =>  $_POST["draw"],  
            "recordsTotal" =>  $this->member_model->get_all_data(),  
            "recordsFiltered" => $this->member_model->get_filtered_data(),  
            "data"  => $response,
        ];

        
        echo json_encode($output);
    }

    public function getAddressByVillage()
    {
        $village_id = $this->uri->segment(3);
        $data = $this->db->select('v.*, d.*, r.*, p.*, v.name as village, d.name as district, r.name as regency, p.name as province')
                         ->from('villages v')
                         ->join('districts d', 'd.id = v.district_id')
                         ->join('regencies r', 'r.id = d.regency_id')
                         ->join('provinces p', 'p.id = r.province_id')
                         ->where('v.id', $village_id)
                         ->get()->row();

        echo json_encode($data);                 
    }

    public function getContactTable()
    {
        $this->load->model('contact/contact_model');
        $data = $this->contact_model->make_datatables();
        $response = $data;

        $output = [
            "draw" =>  $_POST["draw"],  
            "recordsTotal" =>  $this->contact_model->get_all_data(),  
            "recordsFiltered" => $this->contact_model->get_filtered_data(),  
            "data"  => $response,
        ];

        
        echo json_encode($output);
    }

    public function sourcing_items_supplier()
    {
        $this->load->model('member/sourcing_item_model');
        $data = $this->sourcing_item_model->make_datatables();
        $output = [
            "draw" =>  $_POST["draw"],  
            "recordsTotal" =>  $this->sourcing_item_model->get_all_data(),  
            "recordsFiltered" => $this->sourcing_item_model->get_filtered_data(),  
            "data"  => $data,
        ];

        
        echo json_encode($output);
    }

    public function sourcings()
    {

        $this->load->model('member/sourcing_model');
        $data = $this->sourcing_model->make_datatables();
        $response = [];

        

        foreach ($data as $key => $value) {
            $model = new Sourcing_model();
            $model->where(['id' => $value['id']])->get()->single()->with(['items']);

            $value['items'] = $model->items;

            array_push($response, $value);
        }

        $output = [
            "draw" =>  $_POST["draw"],  
            "recordsTotal" =>  $this->sourcing_model->get_all_data(),  
            "recordsFiltered" => $this->sourcing_model->get_filtered_data(),  
            "data"  => $response,
        ];

        
        echo json_encode($output);
    }

    public function getCompanyDatatable()
    {
        
        $data = $this->company_model->make_datatables();

        $response = $data;
        
        // foreach ($data as $key => $value) {

        //     $result = array(); 
        //     $result[] = $value['name'];
        //     $result[] = $value['email'];
        //     $result[] = $value['industry'];
        //     $result[] = $value['ownership'] == 0 ? 'Perorangan' : 'Perusahaan';
        //     $result[] = '<button class="btn btn-select btnnew btn-address-datatable" data-dismiss="modal" aria-label="Close" data-company='.json_encode($value).' data-id="'.$value['id'].'">Pilih</button>';
        //     $response[] = $result;
        // }

        $output = [
            "draw" =>  $_POST["draw"],  
            "recordsTotal" =>  $this->company_model->get_all_data(),  
            "recordsFiltered" => $this->company_model->get_filtered_data(),  
            "data"  => $response,
        ];

        
        echo json_encode($output);
    }

    public function getItems()
    {
        $keyword = $_GET['keyword'];

        $data = $this->db->from('product p')
                         ->select('p.tittle, cat.name as category, brand.name as brand , p.id as product_id')
                         ->join('categori brand', 'brand.id = p.brand', 'left')
                         ->join('categori cat', 'cat.id = p.component', 'left')
                         ->like('p.tittle', '%'. $keyword. '%')
                         //->limit(10)
                         ->get()->result();

        
        echo json_encode($data);
    }

    public function getContacts()
    {
        $keyword = $_GET['keyword'];
        
        $json = $this->db->select('c.*, c.id as id, c.name as contact_name, co.name as company, c.telephone as telephone, co.telephone as company_phone')
                         ->from('contacts c')
                         ->group_by('co.id')
                         ->join('companies co', 'co.id = c.company_id')
                         ->like('c.name', '%'. $keyword. '%')
                         ->or_like('co.name', '%'. $keyword. '%')
                         ->get()->result();

        echo json_encode($json);
    }

    private function search_village($keyword)
    {
        $this->db->reset_query();
        return $this->db->from('villages v')
                        ->select("v.id, v.name, d.name as d_name, r.name as r_name, p.name as p_name")
                        ->join('districts d', 'd.id = v.district_id')
                        ->join('regencies r', 'r.id = d.regency_id')
                        ->join('provinces p', 'p.id = r.province_id')
                        ->or_like('v.name', $keyword)
                        ->or_like('d.name', $keyword)
                        ->or_like('r.name', $keyword)
                        ->or_like('p.name', $keyword)
                        ->limit(50)
                        ->get()->result();
    }


    public function getJsonAddressByVillage()
    {
        $keyword = $this->input->get('keyword');
        $villages = $this->search_village($keyword);

        $data = [];

        foreach ($villages as $key => $village) {
            
           // $district = $this->getDistrict($village->district_id);
          
            //$regency = $this->getRegency($district->regency_id);
            //$province = $this->getProvincy($regency->province_id);
            $prov = $village->p_name;
            $vil = $village->name .= ' > '. $village->d_name . ' > ' . $village->r_name . ' > ' .  $prov;

            array_push($data, ['label' => str_ireplace($keyword, strtoupper("<b>$keyword</b>"), $vil), 'value' => $village->id]);
        }

        echo json_encode($data);
    }

    public function getRegency($id)
    {
        return $this->db->get_where("regencies", ['id' => $id])->row();
    }
    public function getDistrict($id)
    {
        
        return $this->db->get_where("districts", ['id' => $id])->row();
    }
    public function getProvincy($id)
    {
        return $this->db->get_where("provinces", ['id' => $id])->row();
    }

    


}