<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backendpromo extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
    }
    public function index()
    {}
    
	public function listpromo()
	{

        $data["datawhere"]= array();
        $config["per_page"] = 10;
        $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $data["listfilter"] = $this->etx_model->fetch_product($config["per_page"], $page,$data["datawhere"]);
        $data["js"] = array(base_url().'asset/backend/js/list.order.js' );
        $data['content'] = 'list';
        $this->load->view('backend/template_front1', $data);
    }

    function ambil_data(){

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $total=$this->db->count_all_results("promo");
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        if($search!=""){
        $this->db->like("name",$search);
        }
        $this->db->limit($length,$start);
         if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('name',$_REQUEST['order'][0]['dir']);
		endif;
        $query=$this->db->get('promo');
        if($search!=""){
        $this->db->like("name",$search);
        $jum=$this->db->get('promo');
        $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }

        foreach ($query->result_array() as $promo) {
             $explode = explode(",", $promo["product"]);

            $output['data'][]=array(

            '<a class="fbold f14 forange" href="'.base_url().'backendpromo/form?id='.$promo["id"].'">'.$promo["name"].'</a><br>',
           
            '<span>'.count($explode).'</span>',
            '<a class="btn btn-sm btn-warning" href="'.base_url().'backendpromo/form?id='.$promo["id"].'"><i class="fa fa-edit"></i></a>',
            '<a class="btn btn-sm btn-danger" href="'.base_url().'backendpromo/hapuspromo?id='.$promo["id"].'"><i class="fa fa-trash"></i></a>'
          );
        
        } 
        echo json_encode($output);


    }

    function ambil_data_product(){
        $id = $_REQUEST['id-promo'];
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $this->db->where("status",'show');
        $total=$this->db->count_all_results('product');
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        if($search!=""){
        $this->db->like("tittle",$search);
        }
        $this->db->limit($length,$start);
        if($_REQUEST['order'][0]['column'] == '0'):
			$this->db->order_by('tittle',$_REQUEST['order'][0]['dir']);
		endif;
        $this->db->where("status",'show');
        $query=$this->db->get('product');
        if($search!=""){
        $this->db->like("tittle",$search);
        $this->db->where("status",'show');

        $jum=$this->db->get('product');
        $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }

        if (!empty($id)) {
            $detail= $this->etx_model->getdetail($id);
            $expolde = explode(",", $detail["product"]);
        }else{
            $expolde=array();
        }

        foreach ($query->result_array() as $promo) {
            //$explode = explode(",", $promo["product"]);

            $output['data'][]=array(
            '<td>
                <form action="'.base_url('backendpromo/'.(in_array($promo["id"], $expolde) ? 'hapus' : 'add')).'productpromo" method="POST">
                    '.((!empty($id)) ? '<input type="hidden" name="id" value="'.$id.'">' : '')
                    .((!empty($id)) ? '<input type="hidden" name="product" value="'.$detail["product"].'">' : '')
                    .((!empty($id)) ? '<input type="hidden" name="newproduct" value="'.$promo["id"].'">' : '')
                    .(in_array($promo["id"], $expolde)?'<button class="btn btn-danger">Promo</button>':'<button class="btn btn-orange">Tambah</button>').'</form></td>',
            '<td>'.$promo["tittle"].'<br><small>'.$promo["partnumber"].'</small></td>'
          );
        
        } 
        echo json_encode($output);


    }


    public function form()
    {
        $id = $this->input->get("id");
        if ($id) {
            $data["detail"]= $this->etx_model->getdetail($id);
            if (empty($data["detail"])) {
                $this->session->set_flashdata('message', 'Promo tidak ada di database');
                redirect(base_url().'backendpromo/listpromo');
            }

        }
       
        $data["product"]= $this->etx_model->getallproduct();
        $data['content'] = 'form';
        $data['id'] = $id;
        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css' );
        $data["js"] = array(base_url().'/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',
             base_url()."asset/js/number/jquery.number.min.js",
            base_url()."asset/backend/dist/js/canvas/zepto.min.js",
            base_url()."asset/backend/dist/js/canvas/binaryajax.js",
            base_url()."asset/backend/dist/js/canvas/exif.js",
            base_url()."asset/backend/dist/js/canvas/canvasResize.js",
            base_url()."asset/backend/js/form.promo.js");
        $this->load->view('backend/template_front1', $data);
    }

    public function input()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal berakhir', 'required');
        $this->form_validation->set_rules('txtfilegambar', 'Txtfilegambar', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!'.validation_errors());
            redirect(base_url().'backendpromo/form');
        }else{
            $file= "public/tmp/".($this->input->post("txtfilegambar"));
            $newfile= "public/image/promo/".($this->input->post("txtfilegambar"));
            if (copy($file, $newfile)) {
                unlink($file);          
                $set = array('name' => $this->input->post("name"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-",$this->input->post("name")),
                        'product' =>$this->input->post("product"),
                        'start_date' =>$this->input->post("start_date"),
                        'end_date' =>$this->input->post("end_date"),
                        'img' => ($this->input->post("txtfilegambar")),
                        'description' => htmlentities($this->input->post("description"))
                );
                $this->session->set_flashdata('message', 'Promo baru telah ditambah');
                $this->etx_model->input($set);
                redirect(base_url()."backendpromo/listpromo");
                exit();
            }else{
                $this->session->set_flashdata('message', 'Sistem mengalami gangguan saat memproses data yang Anda inputkan.');
                redirect(base_url()."backendpromo/form");
                exit();
            }
        }
        redirect(base_url().'backendpromo/listpromo');
    }

    public function update()
    {
        $id= $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal berakhir', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!' .validation_errors());
            redirect(base_url().'backendpromo/form?id='.$id);
        }else{
            if (!empty($this->input->post("asknew"))) {
                $file= "public/tmp/".($this->input->post("txtfilegambar"));
                $newfile= "public/image/promo/".($this->input->post("txtfilegambar"));
                if (copy($file, $newfile)) {
                    unlink($file);

                $set = array('name' => $this->input->post("name"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-", $this->input->post("name")),
                        'product' =>$this->input->post("product"),
                        'start_date' => strtotime($this->input->post("start_date")),
                        'end_date' => strtotime($this->input->post("end_date")),
                        'img' => ($this->input->post("txtfilegambar")),
                        'description' => htmlentities($this->input->post("description"))
                );
                
                $this->session->set_flashdata('message', 'Promo baru telah diupdate');
                
                $this->etx_model->update(array('id' =>$id), $set);
                //redirect(base_url().'backendpromo/form?id='.$id);
                }else{
                    $set = array('name' => $this->input->post("name"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-",$this->input->post("name")),
                        'start_date' => strtotime($this->input->post("start_date")),
                        'end_date' => strtotime($this->input->post("end_date")),
                        'product' =>$this->input->post("product"),'img' => ($this->input->post("txtfilegambarold")),
                        'description' => htmlentities($this->input->post("description"))
                );
                
                $this->session->set_flashdata('message', 'Promo baru telah diupdate');
                $this->etx_model->update(array('id' =>$id), $set);
                //redirect(base_url().'backendpromo/form?id='.$id);
                    
                }
            }else {
                $set = array('name' => $this->input->post("name"),
                        'url' => preg_replace("/[^a-zA-Z0-9]/", "-",$this->input->post("name")),
                        'start_date' => strtotime($this->input->post("start_date")),
                        'end_date' => strtotime($this->input->post("end_date")),
                        'product' =>$this->input->post("product"),'img' => ($this->input->post("txtfilegambarold")),
                        'description' => htmlentities($this->input->post("description"))
                );
                
                $this->session->set_flashdata('message', 'Promo baru telah diupdate');
                $this->etx_model->update(array('id' =>$id), $set);
            }
            redirect(base_url().'backendpromo/listpromo');
        }
        
    }
    
    public function addproductpromo()
    {
        $id= $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('newproduct', 'Newroduct', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!'.validation_errors());
            redirect(base_url().'backendpromo/form?id='.$id);
        }else{
            $set = array('product' => (!empty($this->input->post("product"))) ? $this->input->post("product").",".$this->input->post("newproduct") : $this->input->post("newproduct"));
            $this->session->set_flashdata('message', 'Promo baru telah diupdate');
            $this->etx_model->update(array('id' =>$id), $set);
            redirect(base_url().'backendpromo/form?id='.$id);
        }
        
    }

    public function hapusproductpromo()
    {
        $id= $this->input->post("id");
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('newproduct', 'Newroduct', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!'.validation_errors());
            redirect(base_url().'backendpromo/form?id='.$id);
        }else{
            $product = explode(',', $this->input->post("product"));
            $key = array_search($this->input->post("newproduct"), $product);
            unset($product[$key]);
            $set = array('product' => implode(',', $product) );
            $this->session->set_flashdata('message', 'Promo baru telah diupdate');
            $this->etx_model->update(array('id' =>$id), $set);
            redirect(base_url().'backendpromo/form?id='.$id);
        }
        
    }
    
    public function hapuspromo()
    {
        $where = array('id' => $this->input->get("id") );
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Promo telah dihapus');
        redirect(base_url().'backendpromo/listpromo');
        
    }

    public function halamandepan()
    {
        $data["slide"]=$this->etx_model->gethome("slide");
        $data["headbottomslide"]=$this->etx_model->gethome("headbottomslide");
        $data["headrightslide"]=$this->etx_model->gethome("headrightslide");
        $data["headleftslide"]=$this->etx_model->gethome("headleftslide");
        $data["promobig"]=$this->etx_model->gethome("promobig");
        $data["promo"]=$this->etx_model->gethome("promo");
        $data["new"]=$this->etx_model->gethome("new");
        $data['content'] = 'halamandepan';
        $data["js"]= array(
            base_url()."asset/backend/dist/js/canvas/zepto.min.js",
            base_url()."asset/backend/dist/js/canvas/binaryajax.js",
            base_url()."asset/backend/dist/js/canvas/exif.js",
            base_url()."asset/backend/dist/js/canvas/canvasResize.js",
            base_url().'asset/backend/js/setting.halamandepan.js');
        $this->load->view('backend/template_front1', $data);
        
    }

    public function usedpage()
    {
        $data["slide"]=$this->etx_model->gethome("slideused");
        $data["headbottomslide"]=$this->etx_model->gethome("headbottomslideused");
        $data["headrightslide"]=$this->etx_model->gethome("headrightslideused");
        $data["headleftslide"]=$this->etx_model->gethome("headleftslideused");
        $data["promobig"]=$this->etx_model->gethome("promobigused");
        $data["promo"]=$this->etx_model->gethome("promoused");
        $data["new"]=$this->etx_model->gethome("newused");
        $data['content'] = 'usedpage';
        $data["js"]= array(
            base_url()."asset/backend/dist/js/canvas/zepto.min.js",
            base_url()."asset/backend/dist/js/canvas/binaryajax.js",
            base_url()."asset/backend/dist/js/canvas/exif.js",
            base_url()."asset/backend/dist/js/canvas/canvasResize.js",
            base_url().'asset/backend/js/setting.halamandepan.js');
        $this->load->view('backend/template_front1', $data);
        
    }

    public function hapusimghalamadepan()
    {
        $where= array('id' => $this->input->get("id"));
        unlink('./public/image/page/home/'.$this->input->get("img"));
        $this->etx_model->hapushalamadepan($where);
        $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        redirect(base_url().'backendpromo/halamandepan');
    }

    public function hapusimgusedpage()
    {
        $where= array('id' => $this->input->get("id"));
        unlink('./public/image/page/home/'.$this->input->get("img"));
        $this->etx_model->hapushalamadepan($where);
        $this->session->set_flashdata('message', 'halaman used di perbarui.');
        redirect(base_url().'backendpromo/usedpage');
    }

    public function inputhalamadepan()
    {
        $textimg=$this->input->post("textimg");
        $file= "public/tmp/".$textimg;
        $newfile= "public/image/page/home/".$textimg;
        if (copy($file, $newfile)) {
                unlink($file);
            $set = array('name' => $this->input->post("name"),'img' => $textimg,'link' => $this->input->post("link") );
            $this->etx_model->inputhalamadepan($set);
            $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        }
        redirect(base_url().'backendpromo/halamandepan');
    }

    public function edithalamadepan()
    {
        $textimg=$this->input->post("textimg");
        $file= "public/tmp/".$textimg;
        $newfile= "public/image/page/home/".$textimg;
        if(file_exists($newfile)){
            $set = array('name' => $this->input->post("name"),'img' => $textimg,'link' => $this->input->post("link"),'title' => $this->input->post("title") );
            $this->etx_model->updatehalamadepan($set, $this->input->post('id'));
            $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        } else {
            if (copy($file, $newfile)) {
                unlink($file);
                $set = array('name' => $this->input->post("name"),'img' => $textimg,'link' => $this->input->post("link"),'title' => $this->input->post("title") );
                $this->etx_model->updatehalamadepan($set, $this->input->post('id'));
                $this->session->set_flashdata('message', 'halaman depan di perbarui.');
            }
        }
        
        redirect(base_url().'backendpromo/halamandepan');
    }

    public function inputusedpage()
    {
        $textimg=$this->input->post("textimg");
        $file= "public/tmp/".$textimg;
        $newfile= "public/image/page/home/".$textimg;
        if (copy($file, $newfile)) {
                unlink($file);
            $set = array('name' => $this->input->post("name"),'img' => $textimg,'link' => $this->input->post("link") );
            $this->etx_model->inputhalamadepan($set);
            $this->session->set_flashdata('message', 'halaman depan di perbarui.');
        }
        redirect(base_url().'backendpromo/usedpage');

    }
}
