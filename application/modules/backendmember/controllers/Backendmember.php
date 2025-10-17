<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backendmember extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
    }
	public function index()
	{

        $status= $this->input->get("status");
        $name= $this->input->post("name");
        $data["datawhere"]= array();
        if ($status!="all") {
            $data["datawhere"]= array("status"=>$status);
        }
    
        //$config["per_page"] = $this->etx_model->record_count($data["datawhere"]);
         $config["per_page"] = 10;
        
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;            
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page,$data["datawhere"]);

        $data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        $data['content'] = 'list';
        $this->load->view('backend/template_front1', $data);
    }

     function ambil_data(){
		$status= $this->input->post("status");
		$name= $this->input->post("name");
        $data["datawhere"]= array();
        if ($status!="all") {
            $data["datawhere"]= array("status"=>$status);
        }
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $this->db->where($data["datawhere"]);  
        $total=$this->db->count_all_results("member");
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        if($search!=""){
            $this->db->where("(
							name LIKE '%$search%' 
							OR email LIKE '%$search%'
							OR level LIKE '%$search%'
                        )",'', false);
        }
        $this->db->where($data["datawhere"]);  
        $this->db->limit($length,$start);
         if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('name',$_REQUEST['order'][0]['dir']);
		elseif($_REQUEST['order'][0]['column'] == '1'):
			$this->db->order_by('status',$_REQUEST['order'][0]['dir']);
		elseif($_REQUEST['order'][0]['column'] == '2'):
			$this->db->order_by('level',$_REQUEST['order'][0]['dir']);
		endif;
        $query=$this->db->get('member');
        if($search!=""){
            $this->db->where("(
							name LIKE '%$search%' 
							OR email LIKE '%$search%'
							OR level LIKE '%$search%'
                            
                        )",'', false);
            $jum=$this->db->get('member');
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

        foreach ($query->result_array() as $member) {

                    
            //$s = $confirmation["status"]!="rejected" ? $confirmation["status"]!="new" ? "success" : "warning" : "danger";
            $s = $member["status"]=="active" ? "success" : "danger";
            $k = $member["level"]!="silver" ?  $member["level"]=="platinum" ?  "warning" : "default" : "default" ;

            $output['data'][]=array(

              

            '<a class="fbold f14 forange" href="'.base_url().'backendmember/detail/'.$member["id"].'">'.$member["name"].'</a><br><small><span class="fblack">'.$member["email"].'</span></small>',

            '<span  class="fbold f14 black label label-'.$s.'">'.$member["status"].'</span><br>',

            '<span  class="fbold f14 black label label-'.$k.'">'.$member["level"].'</span><br>'
             );
        
        }

        echo json_encode($output);


    }


    public function detail($id)
    {
        $where= array("id"=>$id);
        $data["detail"]= $this->etx_model->getdetail($where);
        if (empty($data["detail"])) {
            $this->session->set_flashdata('message', 'Pesanan tidak ada di database');
        }
        $data['content'] = 'detail';
        #var_dump($data["detailconfirm"]);
        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css' );
        $data["js"] = array(base_url().'/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',base_url().'/asset/backend/js/detail.member.js');
        $this->load->view('backend/template_front1', $data);
    }

    public function updateactivation()
    {
        $id= $this->input->get("id");
        $status= $this->input->get("status");
        $this->session->set_flashdata('message', 'Data Member telah berubah');
        $this->etx_model->update(array('id' =>$id), array('status' =>$status));
        redirect(base_url().'backendmember/detail/'.$id);
    }

    public function hapus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $where = array('id' => $this->input->get("id") );
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Member telah dihapus');
        redirect(base_url().'backendmember/?status=all');
    }
    public function updatemember()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('password_old', 'Password_old', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $id= $this->input->post("id");
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', 'Sistem mengalami kendala saat update');
            redirect(base_url()."backendmember/?status=all");          
            exit();
        }
        $where = array('id' => $id );
        $password = ($this->input->post("password")!="") ? md5($this->input->post("password")) : $this->input->post("password_old");
        $set = array(
            'name' => $this->input->post("name"),
            'Company' => ($this->input->post("Company")!="")?$this->input->post("Company"):'',
            'email' => $this->input->post("email"),
            'phone' => $this->input->post("phone"),
            'provice' => ($this->input->post("province")!="") ? $this->input->post("province"): "",
            'city' => ($this->input->post("city")!="") ? $this->input->post("city"):"",
            'districts' =>( $this->input->post("districts")!="")  ? $this->input->post("districts"):"",
            'village' => ($this->input->post("village")!="") ? $this->input->post("village"):"",
            'rt_rw' => ($this->input->post("rt_rw")!="") ? $this->input->post("rt_rw"):'',
            'kodepos' => ($this->input->post("kodepos")!='') ? $this->input->post("kodepos"):'',
            'address' => ($this->input->post("address")!="") ? $this->input->post("address"):"",
            'shipping_idprovince' => ($this->input->post("shipping_idprovince")!='')  ? $this->input->post("shipping_idprovince"):'',
            'shipping_idcity' => ($this->input->post("shipping_idcity")!='') ?  $this->input->post("shipping_idcity"):'',
            'shipping_iddistricts' => ($this->input->post("shipping_iddistricts")!='') ?  $this->input->post("shipping_iddistricts"):'',
            'shipping_idvillage' => ($this->input->post("shipping_idvillage")!='') ?  $this->input->post("shipping_idvillage"):'',
            'shipping_kodepos' => ($this->input->post("shipping_kodepos")!='') ?  $this->input->post("shipping_kodepos"):'',
            'shipping_address' => ($this->input->post("shipping_address")!='')  ? $this->input->post("shipping_address"):'',
            'password' => $password
             );
        #var_dump($set);
        $this->etx_model->update($where,$set);
        redirect(base_url()."backendmember/detail/".$id);          
        exit();
    }

    public function get_members() {
        $item = $this->etx_model->search($this->input->get('q'));
        $data = array();
        foreach($item->result() as $key=>$items):
            $data[$key]['text'] = $items->name." - ".$items->Company;
            foreach($items as $keys=>$itemss):
                $data[$key][$keys] = $itemss;
            endforeach;
        endforeach;
        echo json_encode($data);
    }

}
