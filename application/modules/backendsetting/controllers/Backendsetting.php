<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backendsetting extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("etx_model");
    }
	public function index()
	{

    }


    public function form()
    {

    }

    public function settingumum()
    {
        $data["promo"] = $this->etx_model->gettable("promo");
        $data["prmhtl"] = $this->etx_model->getmenu("prmhtl");
        $data["prmvkl"] = $this->etx_model->getmenu("prmvkl");
        $data["inforekening"] = $this->etx_model->getmenu("inforekening");
        $data["delivery_free_limit"] = $this->etx_model->getmenu("delivery_free_limit");
        $data["delivery_per_kg"] = $this->etx_model->getmenu("delivery_per_kg");
        $data["countsmsverifi"] = $this->etx_model->getmenu("countsmsverifi");
        $data["infolinkhome"] = $this->etx_model->getmenu("infolinkhome");
        $data["popup_adsbig"] = $this->etx_model->getmenu("popup_adsbig");
        $data["popup_adsbig_mobile"] = $this->etx_model->getmenu("popup_adsbig_mobile");
        $data["popup_adsbig_used"] = $this->etx_model->getmenu("popup_adsbig_used");
        $data["popup_adsbig_mobile_used"] = $this->etx_model->getmenu("popup_adsbig_mobile_used");

        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css' );
        $data["js"] = array(base_url().'/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',base_url().'/asset/backend/js/detail.member.js');
        
        $data['content'] = 'settingumum';
        $this->load->view('backend/template_front1', $data);
    }

    public function menupage()
    {

        $data["menu1"] = $this->etx_model->getmenu("menu1");
        $data["menu2"] = $this->etx_model->getmenu("menu2");
        $data["menu3"] = $this->etx_model->getmenu("menu3");
        $data["category"] = $this->etx_model->getparentcategory();
        $data["page"] = $this->etx_model->gettable("page");
        $data["artikel"] = $this->etx_model->gettable("artikel");

        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css' );
        $data["js"] = array(base_url().'/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',base_url().'/asset/backend/js/detail.member.js');
        
        $data['content'] = 'menupage';
        $this->load->view('backend/template_front1', $data);
    }

    public function addmenu()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url().'backendsetting');
        }else{
            $set = array('value' => $this->input->post("value"),
                    'name' => $this->input->post("name")
            );
            $this->session->set_flashdata('message', 'Menu baru telah ditambah');
            $this->etx_model->input($set);
        }
        redirect(base_url().'backendsetting/menupage');
    }
    public function formuploadimage()
    {
        $dir    = './public/image/upload';
        $data["list"] = scandir($dir);
        $data['content'] = 'galeryimage';
        $this->load->view('backend/template_front1', $data);
    }
    public function uploadgaleryumum()
    {
        $img = $_FILES["img"];
        if ($img['name']==""){
            $this->session->set_flashdata('message', 'Tidak ada data yang di tambah, coba ulangi lagi');
            redirect(base_url()."backendsetting/formuploadimage");          
            exit();
        }
        $nameawal= $this->input->post("img");
        $path = './public/image/upload';
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = $nameawal;
        $config['encrypt_name']= TRUE;
        $config['max_size'] = '1000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload("img"))
        {
            $this->session->set_flashdata('message', 'Tidak ada data yang di tambah, coba ulangi lagi'. $this->upload->display_errors());
            redirect(base_url()."backendsetting/formuploadimage");          
            exit();
        }
        else
        {
            $this->session->set_flashdata('message', 'Sukses ');
            redirect(base_url()."backendsetting/formuploadimage");          
            exit();        
        }
    }
    public function editmenu_infolinkhome()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('strong', 'Strong', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url().'backendsetting');
        }else{
            $string= '{"strong":"'.$this->input->post("strong").'","text":"'.$this->input->post("text").'","link":"'.$this->input->post("link").'"}';
            $set = array('value' => $string,
                    'name' => $this->input->post("name")
            );
            $where = array('id' => $this->input->post("id") );
            $this->session->set_flashdata('message', 'Settingan telah update');
            $this->etx_model->update($where,$set);
        }
        redirect(base_url().'backendsetting/settingumum');
    }
    public function editmenu_popup_adsbig()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('img', 'Img', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url().'backendsetting');
        }else{
            $string= '{"img":"'.$this->input->post("img").'","link":"'.$this->input->post("link").
                '","start_date":"'.($this->input->post("start_date")?$this->input->post("start_date"):0).
                '","end_date":"'.($this->input->post("end_date")?$this->input->post("end_date"):0).'"}';
            $set = array('value' => $string,
                    'name' => $this->input->post("name")
            );
            $where = array('id' => $this->input->post("id") );
            $this->session->set_flashdata('message', 'Settingan telah update');
            $this->etx_model->update($where,$set);
        }
        redirect(base_url().'backendsetting/settingumum');
    }
    public function editmenu_popup_adsbig_mobile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('img', 'Img', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url().'backendsetting');
        }else{
            $string= '{"img":"'.$this->input->post("img").'","link":"'.$this->input->post("link").
                '","start_date":"'.($this->input->post("start_date")?$this->input->post("start_date"):0).
                '","end_date":"'.($this->input->post("end_date")?$this->input->post("end_date"):0).'"}';
            $set = array('value' => $string,
                    'name' => $this->input->post("name")
            );
            $where = array('id' => $this->input->post("id") );
            $this->session->set_flashdata('message', 'Settingan telah update');
            $this->etx_model->update($where,$set);
        }
        redirect(base_url().'backendsetting/settingumum');
    }

    public function editmenu()
    {
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_rules('urlback', 'Urlback', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', 'Tidak ada data, Ulangi input lagi!!');
            redirect(base_url().'backendsetting');
        }else{
            $set = array('value' => $this->input->post("value"),
                    'name' => $this->input->post("name")
            );
            $where = array('id' => $this->input->post("id") );
            $this->session->set_flashdata('message', 'Settingan telah update');
            $this->etx_model->update($where,$set);
        }
        redirect($this->input->post("urlback"));
    }
    public function hapus()
    {
        $where = array('id' => $this->input->get("id") );
        $this->etx_model->hapus($where);
        $this->session->set_flashdata('message', 'Menu telah dihapus');
        redirect(base_url().'backendsetting/menupage');
        
    }

    public function uploadimglooping()
    {

        $data['content'] = 'uploadimglooping';
        $this->load->view('backend/template_front1', $data);
    }

    public function uploadloopimg()
    {
        $this->form_validation->set_rules('loop', 'Loop', 'required');
        $this->form_validation->set_rules('path', 'Path', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('format', 'Format', 'required');
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', 'Tidak ada data yang di inputkan , coba ulangi lagixx'.validation_errors());
            redirect(base_url()."backendsetting/uploadimglooping");          
            exit();
        }
        $loop= $this->input->post("loop");
        $path= $this->input->post("path");
        $name= $this->input->post("name");
        $format= $this->input->post("format");
        $nameawal = $name.$format;
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['file_name'] = $nameawal;
        $config['max_size'] = '1000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload("img"))
        {
            $this->session->set_flashdata('message', 'Tidak ada data yang di tambah, coba ulangi lagi'. $this->upload->display_errors());
            redirect(base_url()."backendsetting/uploadimglooping");          
            exit();
        }
        else
        {
            for ($i=1; $i <= $loop; $i++) { 
                copy($path.$nameawal, $path.$name.$i.$format);
            }
            $this->session->set_flashdata('message', 'Sukses');
            unlink($path.$nameawal);
            redirect(base_url()."backendsetting/uploadimglooping");          
            exit();        
        }
    }


    public function wilayah()
    {
        set_time_limit ( 3600 );
        $data["css"] = array('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css' );
        $data["js"] = array(base_url().'/asset/backend/bower_components/datatables/media/js/jquery.dataTables.min.js',base_url().'/asset/backend/js/detail.member.js');
        $data["wilayah"] = $this->etx_model->getwilayah();
        #var_dump($data["wilayah"]);
        $data['content'] = 'wilayah';
        $this->load->view('backend/template_front1', $data);
    }
    public function provinces()
    {
        $query = $this->db->get('provinces');
        $return = $query->result_array();
        $arrayNew = array();
        foreach ($return as $key ) {
            $querydistricts = $this->db->
                            join("districts","districts.regency_id=regencies.id")->
                            where(array('regencies.province_id' => $key["id"], "districts.kode_jne"=>''))->get('regencies');
            $returnquerydistricts = $querydistricts->result_array();
            $xx = array('id' => $key["id"],"name"=>$key["name"],"count"=>count($returnquerydistricts) );
            array_push($arrayNew, $xx );
        }

        $data["area"] = $arrayNew ;
        //$data["area"] = $this->etx_model->gettable("provinces");
        $data['content'] = 'wilayahindonesia/provinces';
        $this->load->view('backend/template_front1', $data);
    }

    public function regencies($id)
    {
        $where = array('province_id' => $id );

        $query = $this->db->where($where)->get('regencies');
        $return = $query->result_array();
        $arrayNew = array();
        foreach ($return as $key ) {
            $querydistricts = $this->db->where(array('regency_id' => $key["id"], "kode_jne"=>''))->get('districts');
            $returnquerydistricts = $querydistricts->result_array();
            $xx = array('id' => $key["id"],"name"=>$key["name"],"count"=>count($returnquerydistricts) );
            array_push($arrayNew, $xx );
        }

        $data["area"] = $arrayNew ; //$this->etx_model->gettablewhere("regencies",$where);
        $data['content'] = 'wilayahindonesia/regencies';
        $this->load->view('backend/template_front1', $data);
    }
    public function districts($id)
    {
        $where = array('regency_id' => $id );
        $data["area"] = $this->etx_model->gettablewhere("districts",$where);
        $data["js"] = array(base_url().'/asset/backend/js/wilayah.js');
        $data['content'] = 'wilayahindonesia/districts';
        $this->load->view('backend/template_front1', $data);
    }
    public function villages($id)
    {
        $where = array('district_id' => $id );
        $data["area"] = $this->etx_model->gettablewhere("villages",$where);
        
        $data['content'] = 'wilayahindonesia/villages';
        $this->load->view('backend/template_front1', $data);
    }

    public function updatewilayah()
    {
        $where = array('id' => $this->input->post("id") );
        $set = array('kode_jne' => $this->input->post("kode_jne") );
        $this->etx_model->updatetable($where,$set,"districts");
        $kodejne=  $this->input->post("kode_jne") ;
        echo '<span kodeid="'.$this->input->post("id").'" jne="'.$kodejne.'" class="changetoforminputareajne label label-primary">'.$kodejne.'</span>';
    }

    public function table_()
    {
        $query = $this->db->query("SELECT DISTINCT (provinsi) as name,provinces.id as id_prov,jne_wilayah.kode as kode FROM jne_wilayah join provinces ON jne_wilayah.provinsi LIKE CONCAT('%', provinces.name, '%') GROUP BY name ORDER BY id_prov ASC");
        $return = $query->result_array();
        echo "<pre>";
        var_dump($return);
        echo "</pre>";

       /*foreach ($return as $key) {
            $this->db->start_cache();
            $set = array(
                        'id_province' => $key["id_prov"],
                        'name' => $key["name"],
                        'jne_code' => $key["kode"],
                         );
            $this->db->insert("jne_province",$set);
            $this->db->stop_cache();
            $this->db->flush_cache();
        }*/

    }

    public function table_kab()
    {
        set_time_limit ( 3600 );
        $query = $this->db->query("SELECT DISTINCT (kabupaten) as name,regencies.id as id_kab,jne_wilayah.kode as kode FROM jne_wilayah join regencies ON jne_wilayah.kabupaten LIKE CONCAT('%', regencies.name, '%') GROUP BY name ORDER BY id_kab ASC");
        #$query = $this->db->query("SELECT DISTINCT (kabupaten) as name FROM jne_wilayah ");
        $return = $query->result_array();
        echo "<pre>";
        var_dump($return);
        echo "</pre>";

       foreach ($return as $key) {
            $this->db->start_cache();
            $set = array(
                        'id_regencies' => $key["id_kab"],
                        'name' => $key["name"],
                        'jne_code' => $key["kode"],
                         );
            $this->db->insert("jne_regencies",$set);
            $this->db->stop_cache();
            $this->db->flush_cache();
        }
    }

    public function table_kec()
    {
        set_time_limit ( 3600 );
        $query = $this->db->query("SELECT DISTINCT (kecamatan) as name,districts.id as id_kec,jne_wilayah.kode as kode FROM jne_wilayah join districts ON jne_wilayah.kecamatan LIKE CONCAT('%', districts.name, '%') GROUP BY name ORDER BY id_kec ASC");
        #$query = $this->db->query("SELECT DISTINCT (kabupaten) as name FROM jne_wilayah ");
        $return = $query->result_array();
        echo "<pre>";
        var_dump($return);
        echo "</pre>";

       /*foreach ($return as $key) {
            $this->db->start_cache();
            $set = array(
                        'id_districts' => $key["id_kec"],
                        'name' => $key["name"],
                        'jne_code' => $key["kode"],
                         );
            $this->db->insert("jne_districts",$set);
            $this->db->stop_cache();
            $this->db->flush_cache();
        }*/
    }


    public function table_update_kec()
    {
        set_time_limit ( 3600 );
        #$query = $this->db->query("SELECT DISTINCT (kecamatan) as name,districts.id as id_kec,jne_wilayah.kode as kode FROM jne_wilayah join districts ON jne_wilayah.kecamatan LIKE CONCAT('%', districts.name, '%') GROUP BY name ORDER BY id_kec ASC");
        $query = $this->db->query("SELECT id_kec,kode FROM jne_wilayah ");
        $return = $query->result_array();
        echo "<pre>";
        var_dump($return);
        echo "</pre>";

       /*foreach ($return as $key) {
            $this->db->start_cache();
            $where = array(
                 'id' => $key["id_kec"],
                );
            $set = array(
                        'kode_jne' => $key["kode"],
                        );
            #$this->db->update("districts",$set,$where);
            $this->db->stop_cache();
            $this->db->flush_cache();
        }*/
    }

    public function update_id_kabupaten()
    {
        set_time_limit ( 3600 );
         $query = $this->db->query("SELECT * from regencies");
         $return = $query->result_array();
         echo count($return);
         /*foreach ($return as $key) {
             $this->db->start_cache();
            $where = array(
                 'kabupaten' => $key["name"],
                );
            $set = array(
                        'id_kab' => $key["id"],
                        'id_pro' => $key["province_id"]
                        );
            #$this->db->like($where)->update("jne_wilayah",$set);
            $this->db->stop_cache();
            $this->db->flush_cache();
         }*/
        
    }

    public function update_id_kecamatan()
    {
        set_time_limit ( 3600 );
         $query = $this->db->query("SELECT * from districts");
         $return = $query->result_array();
         echo count($return);
         /*foreach ($return as $key) {
            $this->db->start_cache();
            $where = array(
                 'id_kab' => $key["regency_id"],
                 'kecamatan' => $key["name"],
                );
            $set = array(
                        'id_kec' => $key["id"],
                        );
            #$this->db->like($where)->update("jne_wilayah",$set);
            $this->db->stop_cache();
            $this->db->flush_cache();
         }*/
        
    }

    public function table_update_kec_kodejnenull()
    {
        set_time_limit ( 3600 );
        #$query = $this->db->query("SELECT DISTINCT (kecamatan) as name,districts.id as id_kec,jne_wilayah.kode as kode FROM jne_wilayah join districts ON jne_wilayah.kecamatan LIKE CONCAT('%', districts.name, '%') GROUP BY name ORDER BY id_kec ASC");
        $query = $this->db->query("SELECT districts.name as name_kec,kode_jne,regencies.name as name_kab FROM districts JOIN regencies on districts.regency_id = regencies.id WHERE kode_jne=''");
        $return = $query->result_array();
        echo "<pre>";
        #var_dump($return);
        echo "</pre>";

       foreach ($return as $key) {
            $this->db->start_cache();
            $where = array(
                 'name' => $key["name_kec"],
                );

            
            $q_getkec = $this->db->query('SELECT kecamatan,kabupaten,provinsi,kode FROM jne_wilayah WHERE kecamatan LIKE "%'.$key["name_kec"].'%"');
            $returnq_getkec = $q_getkec->result_array();
            /*$set = array(
                        'district' => $key["name_kec"].'-'.$key["name_kab"],
                        'wilayah' => $returnq_getkec["kecamatan"].'-'.$returnq_getkec["kabupaten"],
                        'kode_jne' => $returnq_getkec["kode"],
                        );*/
            //$this->db->update("districts",$set,$where);

        
            $this->db->stop_cache();
            $this->db->flush_cache();
            $returngetagain = array( );
            if (count($returnq_getkec)>=1) {
                # code...
            
            foreach ($returnq_getkec as $key) {
                $this->db->start_cache();
                $getagain = $this->db->query("SELECT districts.name as name_kec,kode_jne,regencies.name as name_kab,provinces.name as name_pro FROM districts 
                    JOIN regencies on districts.regency_id = regencies.id 
                    JOIN provinces on regencies.province_id = provinces.id 
                    WHERE kode_jne='' AND regencies.name = '".$key["kabupaten"]."'");
                $returngetagain = $getagain->result_array();
                $this->db->stop_cache();
                $this->db->flush_cache();
            }

            }
            echo "<pre>";
            array_push($returnq_getkec, $returngetagain);
            var_dump($returnq_getkec);
            echo "</pre>";
        }
    }

    public function backupdatabase()
    {
        $username = "root";
        $password = "";
        $hostname = "localhost";
        $dbname   = "trumecs";

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($dbname . "_" .date("Y-m-d_H-i-s").".sql"));

        $command = "D:\/xampp\mysql\bin\mysqldump --add-drop-table --host=$hostname   --user=$username --password=$password ".$dbname;

        system($command);
    }




}
