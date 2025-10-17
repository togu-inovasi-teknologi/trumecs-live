<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backendcomplaint extends MX_Controller {
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
        $idorder= $this->input->get("idorder");
        $data["datawhere"]= array();
        if ($status!="all") {
            $data["datawhere"]= array("status"=>$status);
            if ($status=="unrespon") {
                $data["datawhere"]= array("status"=>"waiting respon");
            }
        }
        if (!empty($idorder)) {
            $data["datawhere"]= array_merge($data["datawhere"],array("idorder"=>$idorder));
        }
        
        $config["per_page"] =  10;
        
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;        
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page,$data["datawhere"]);

        $data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        $data['content'] = 'list_order';
        $this->load->view('backend/template_front1', $data);
    }

    function ambil_data(){
		$status= $this->input->post("status");
		$idorder= $this->input->get("idorder");
        $data["datawhere"]= array();
        if ($status!="all") {
            $data["datawhere"]= array("status"=>$status);
			if ($status=="unrespon") {
                $data["datawhere"]= array("status"=>"waiting respon");
            }
        }
        if (!empty($idorder)) {
            $data["datawhere"]= array_merge($data["datawhere"],array("id"=>$idorder));
        }
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $this->db->where($data["datawhere"]);  
        $total=$this->db->count_all_results("complaint");
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        if($search!=""){
            $this->db->where("(
                            idorder LIKE '%$search%' 
                            OR datecomplaint LIKE '%$search%'
                        )",'', false);
        }
        $this->db->where($data["datawhere"]);  
        $this->db->limit($length,$start);
        if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('idorder',$_REQUEST['order'][0]['dir']);
		elseif($_REQUEST['order'][0]['column'] == '1'):
			$this->db->order_by('datecomplaint',$_REQUEST['order'][0]['dir']);
		elseif($_REQUEST['order'][0]['column'] == '2'):
			$this->db->order_by('status',$_REQUEST['order'][0]['dir']);
		endif;
        $query=$this->db->get('complaint');
        if($search!=""){
            $this->db->where("(
                            idorder LIKE '%$search%' 
                            OR datecomplaint LIKE '%$search%'
                        )",'', false);
            $jum=$this->db->get('complaint');
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }

        foreach ($query->result_array() as $complaint) {
       
            $s = $complaint["status"]!="waiting respon" ? "success" : "danger";

            $output['data'][]=array(

            '<a class="fbold f14 forange" href="'.base_url().'backendcomplaint/detail/'.$complaint["id"].'">'.$complaint["idorder"].'</a><br>
                    <small><a class="fblack" href="'.base_url().'backendmember/detail/'.$complaint["idmember"].'">lihat pemesan</a></small>',

            '<span  class="fbold f14 black">'.$complaint["datecomplaint"].'</span><br><small class="fbold f12 black">'.$complaint["date"].'</small>',

            '<span  class="fbold f14 black label label-'.$s.'">'.$complaint["status"].'</span><br>'
                );
        
        }

        echo json_encode($output);


    }


    public function detail($id)
    {
        $where= array("id"=>$id);
        $data["detailconfirm"]= $this->etx_model->getdetail($where);
        if (empty($data["detailconfirm"])) {
            $this->session->set_flashdata('message', 'Pesanan tidak ada di database');
        }
        $data['content'] = 'detail';
        #var_dump($data["detailconfirm"]);
        $this->load->view('backend/template_front1', $data);
    }

    public function updatecomplain()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('iduniq', 'Iduniq', 'required');
        $id= $this->input->post("id");
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', 'Sistem mengalami kendala saat update');
            redirect(base_url()."backendconfirm/?status=all");          
            exit();
        }
        $where=array('id' => $this->input->post('id'));
        $set = array();
        if (!empty($this->input->post("comment"))) {
            $set = array_merge($set,array('commentadmin' => nl2br($this->input->post("comment")) ));
            $set = array_merge($set,array('status' => "respon" ));
            $dataemail["name"]=$this->input->post("membername");
            $dataemail["order_id"]=$this->input->post("iduniq");
            $dataemail["comment"]=nl2br($this->input->post("comment"));

            $from="no-reply@trumecs.com";$password="no-reply#trumecs#123abc";
            $to=$this->input->post('email');
            $subject="Status Komplain Return #".$dataemail["order_id"];
            $message= $this->load->view('email',$dataemail,true);                
            $emailstatus = $this->emailer->sent($from,$password,$to,$subject,$message);
            $this->session->set_flashdata('message', 'Klaim telah di respon');
            $this->etx_model->update($where,$set);
            
        }
        redirect(base_url().'backendcomplaint/detail/'.$this->input->post("id"));
    }

    public function hapus()
    {
        $last_page = $_SERVER['HTTP_REFERER'];
        $where = array('id' => $this->input->get("id") );
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Produk telah dihapus');
        if (isset($last_page)) {
                redirect($last_page);
        }else{  
                redirect(base_url().'backendcomplaint/?status=all');
        }
    }

}
