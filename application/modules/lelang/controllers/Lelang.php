<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lelang extends MX_Controller {

	private $stringtitle = "";
	private $str_keyword = "";
	private $data = array();
	private	$name = "";
	private	$brand = "";
	private	$quality = "";
	private	$type = "";
	private	$component = "";
	private	$subcat = "";
	private	$year = "";
	private	$promo = "";
	private	$cucigudang = "";
	private	$namebrand = "";
	private	$nametype = "";
	private	$namecomponent = "";
	private	$categori;
	private	$array_url;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("c_model");
        $this->load->language("search");
    }
    function _remap($param) {
		if($this->uri->segment(2)=="all") {
			$this->init($param);
		} else if($this->uri->segment(2)=="") {
			redirect(base_url('lelang/all'));
		} else {
			$this->detail($param);
		}
        
    }

	function check_type() {
		$this->array_url= $this->uri->segment_array();
	}

	function set_copy() {
				$this->name= $this->input->get("nama");
				$this->data["tittle_content"]=$this->name;
				$this->data["querysearch"]=$this->name;
				if($this->input->get("komponen")):
				$categori = $this->c_model->getnamecategori($this->input->get("komponen"));
				$this->component = $this->input->get("komponen");
				$this->component_type = "part";
				$this->data["idcomponent"] = $this->component;
			
				$this->data["tittle_content"]=$categori[0]["name"];
				$this->data["description_content"]=$categori[0]["name"];
				endif;
		
	}

	function set_ad() {
		if (!$this->agent->is_mobile()){
			$verticalpromo= $this->c_model->getsetting('prmvkl');
			
			$this->data["promo_inseach_ver"]=$this->c_model->getpromo($verticalpromo[0]['value']);
			
		}
		$horisontalpromo= $this->c_model->getsetting('prmhtl');
		$this->data["promo_inseach_hor"]=$this->c_model->getpromo($horisontalpromo[0]['value']);
	}
    
	public function init()
	{
		
        $this->data["component"]="";
		$this->data['category'] = $this->c_model->get_category();
        
		if ($this->uri->segment(1)=="lelang") {
			
			$this->check_type(); /* Pencarian all */

			$this->set_copy();

			$this->set_ad();

			$getview= $this->input->get("view");
			$session_data = $this->session->all_userdata();
			if (array_key_exists("layout",$session_data)) {
				
			}else{
				$view['view'] = "list";
				$this->session->set_userdata("layout", $view);
			}
			if ($getview=="box") {
					$view['view'] = "box";
					$this->session->set_userdata("layout", $view);
					redirect( $_SERVER['HTTP_REFERER']);
			}else if($getview=="list"){
					$view['view'] = "list";
					$this->session->set_userdata("layout", $view);
					redirect( $_SERVER['HTTP_REFERER']);
			}
			
			$ses=$this->session->all_userdata();
	       	$idmember= !empty($ses["member"]["idmember"])?$ses["member"]["idmember"]:"";
			
			$this->data["datasearch"]=array( 
									'judul' => $this->name,
									'uraian'=>$this->name,
									'info_penjual'=>$this->name
									 );

			$this->data["datasearchor_like"]=array(
									'judul' => $this->name,
									'uraian'=>$this->name,
									'info_penjual'=>$this->name
					);
			
			$this->data["datawhere"]= array();

			
			if ($this->component!="") {
					$this->data["datawhere"] = array_merge($this->data["datawhere"], array('category' => $this->component))	;	
			}

			
			$namecomponent = $this->c_model->getnamecategori($this->component);
			$this->namecomponent = empty($namecomponent)? "" : $namecomponent[0]["name"];
			
            $slestype= !empty($this->nametype)?"/":"";
			
            $sleskomponen= !empty($this->namecomponent)?"/":"";
			
            $this->data["dataurl"]=array( 'brand' => (empty($this->namebrand)) ? '' : '<a itemprop="item" class="forange" class="forange" href="'.base_url().'c/'.str_replace(" ", "-", $this->namebrand).'"><span class="serif" itemprop="name">'.$this->namebrand.'</span></a>',
									'type' =>(empty($this->nametype)) ? '' : '<a itemprop="item" class="forange" href="'.base_url().'c/'.str_replace(" ", "-", $this->namebrand).$slestype.str_replace(" ", "-", $this->nametype).'"><span class="serif" itemprop="name">'.$this->nametype.'</span></a>',
									'component' => (empty($this->namecomponent)) ? '' : '<a itemprop="item" class="forange" href="'.base_url().'c/'.str_replace(" ", "-", $this->namebrand).$slestype.str_replace(" ", "-", $this->nametype).$sleskomponen.str_replace(" ", "-", $this->namecomponent).'"><span class="serif" itemprop="name">'.$this->namecomponent.'</span></a>',
									'tittle' => $this->name
									 );

			$this->data["breadcrumb"]=  array($this->namebrand ,$this->nametype,$this->namecomponent );

			
	        if($this->array_url[2]=='all') {
				$this->_search_all();
			} else {
				$this->_search_component();
			};
	        

	        $this->data["links"] = $this->pagination->create_links();

			
	        
			
		}elseif ($this->uri->segment(2)=="") {
			redirect(base_url());
		}

		$this->stringtitle = "";
		$this->stringtitle.= ($this->namecomponent!="") ? $this->namecomponent." " : "" ;
		
		
		$this->stringtitle.= ($this->name!="") ? $this->name." " : "" ;


		$this->str_keyword.= ($this->namecomponent!="") ? ", ".$this->namecomponent : "" ;

		
        $this->view();
	}

	private function _search_component() {
		$config = array();
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$search_perpage =strpos($actual_link, "&per_page");
		$search_perpage =strpos($actual_link, "?per_page");
		$actual_link = preg_replace("/&per_page\=[0-9]+/", "" ,$actual_link);//substr($actual_link, 0,($search_perpage!=0) ? $search_perpage : strlen($actual_link) );
		
		$config["base_url"] = $actual_link;//base_url() . "cari?nama=".$name."&merek=".$brand."&tipe=".$type."&komponen=".$component."&tahun=".$year."&promo=".$promo."";
		$config["total_rows"] = $this->c_model->record_count($this->data["datasearch"],$this->data["datasearchor_like"],$this->data["datawhere"]);
		$config["per_page"] =  24 ; 
		$config["uri_segment"] = $this->input->get("per_page");
		$config["cur_tag_open"] ='<div class="btn btn-disable">';
		$config["cur_tag_close"] = '</div>';
		$config['attributes'] = array('class' => 'btn btn-secondary link');
		$config['enable_query_strings']=true;
		$config['page_query_string']=true;
		
		$this->pagination->initialize($config); 
		$page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
		
		$this->data["listproduct"] = $this->c_model->fetch_lelang($config["per_page"], $page,$this->data["datasearch"],$this->data["datasearchor_like"],$this->data["datawhere"]);
		
		$newarray=array();
	        
		if (!empty($this->data["listproduct"])) {
			foreach ($this->data["listproduct"] as $key) {
			if ($key["status"]=="show") {
				$newarray[] = array('id' => $key["id"],
					'tittle' => $key["tittle"],
					'partnumber' => $key["partnumber"],
					'quality' => $key["quality"],
					'stock' => $key["stock"],
					'moq' => $key["moq"],                
					'promo' => $key["promo"],
					'unit' => $key["unit"],
					'price' => $key["price"],
					'price_promo'=>$key["price_promo"],
					'price_bigsale'=>$key["price_bigsale"],
					'img' => $key["img"]
					);
				}
				$this->data["listproduct"]=$newarray;
			}
		}
		$this->data['view_product'] = "_listproduct";
	}

	private function _search_all() {
		$this->data["listproduct"] = $this->c_model->fetch_lelang(4, 0,$this->data["datasearch"],$this->data["datasearchor_like"],$this->data["datawhere"]);
		$this->data['view_product'] = "_listproduct";
	}

	public function view() {
		$this->data["quality"]=$this->quality;
		$this->data["seotitle"]="Daftar lelang ".$this->stringtitle." - Trumecs.com";
		$this->data["seokeywords"] = "lelang sparepart truk, daftar sparepart ".$this->str_keyword;
		$this->data["seodescription"] = "Daftar lelang ".$this->stringtitle." terlengkap. Trumecs jual sparepart".$this->stringtitle." sangat murah";

		$this->data["css"] = array(base_url().'asset/css/cari_page.css');
		$this->data["js"] = array(base_url()."asset/js/number/jquery.number.min.js",base_url().'asset/js/cari.js');
		$this->data['content'] = 'view_c';
		
		$this->load->view('front/template_front1', $this->data);
	}

	public function detail($url) {
		$data["data_lelang"]=$this->c_model->getlelang($url);
        if (empty($data["data_lelang"])) {
            redirect(base_url());
        }

		$this->load->model("article/article_model");

        $productgalery=$data["data_lelang"][0]["id"];
        $data["galeryimg"]= $this->c_model->getgalery($productgalery);

        $namecomponent=$this->getcategory($data["data_lelang"][0]["category"]);
        $parent=$this->getparent($data["data_lelang"][0]["category"]);

        $stringtitle = $data["data_lelang"][0]["judul"];
        $stringtitle.= ($namecomponent!="") ? "".$namecomponent : "" ;


        $str_keyword = $data["data_lelang"][0]["judul"];
        $str_keyword.= ($namecomponent!="") ? ", ".$namecomponent : "" ;

        $file_exists = "public/image/lelang/".$data["data_lelang"][0]["img"];
        if (!file_exists($file_exists)) {
            $file_exists ="public/image/logonew.png";
        }
        

        $data["seotitle"]="Lelang ".$stringtitle;
        $data["seokeywords"] = "jual sparepart truk,sparepart truk,".$str_keyword;
        $data["seodescription"] = "Sparepart ".strtolower($stringtitle)." di jual dengan harga murah Rp.".number_format($data["data_lelang"][0]["nilai"]).".";
        $data["seoimage"] = $file_exists;


        $data["breadcrumb"]=  array($namecomponent );

        $data["namecategori"] = array(
            "component" => $namecomponent,
            "parent" => $parent
            );
        $arrayname= explode(" ", $data["data_lelang"][0]["judul"]);
        $data["sameproduct"]=$this->c_model->getsamelelang($arrayname,$productgalery);
        $data["relatedarticle"]=$this->article_model->getsameartikel($data["data_lelang"][0]["judul"]." ".$namecomponent);

        $data["css"]= array(base_url()."asset/css/page_detail.css",base_url()."asset/css/article_page.css", base_url()."asset/js/slick/slick.css",base_url()."asset/js/slick/slick-theme.css");
        $data["js"]= array(base_url()."asset/js/jquery.elevateZoom.js",base_url()."asset/js/detail_product.js",base_url()."asset/js/slick/slick.min.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'view_lelang';
        } else {
            $data['content'] = 'view_lelang_mobile';
        }
		$this->load->view('front/template_front1', $data);
	}

	private function getcategory($id)
    {
        $CATEGORY_ALL=unserialize(CATEGORY_ALL);
        $id_array =  array_search($id, array_column($CATEGORY_ALL, 'id'));
        return ($CATEGORY_ALL[$id_array]["name"]);
    }

	private function getparent($id) {
        $CATEGORY_ALL = unserialize(CATEGORY_ALL);
        $id_array = array_search($id, array_column($CATEGORY_ALL, 'id'));
        $id_parent = $CATEGORY_ALL[$id_array]["parent"];
        $id_array_parent = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));

        if($CATEGORY_ALL[$id_array]["parent"] != 0) {
            $id_parent = $CATEGORY_ALL[$id_array]["parent"];
            $id_array = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));

            if($CATEGORY_ALL[$id_array]["parent"] != 0) {
                $id_parent = $CATEGORY_ALL[$id_array]["parent"];
                $id_array_parent = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));
                
                if($CATEGORY_ALL[$id_array]["parent"] != 0  ) {
                    $id_parent = $CATEGORY_ALL[$id_array]["parent"];
                    $id_array_parent = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));
                    return ($CATEGORY_ALL[$id_array_parent]["name"]);
                } else {
                    return ($CATEGORY_ALL[$id_array_parent]["name"]);
                }
            } else {
                return ($CATEGORY_ALL[$id_array_parent]["name"]);
            }
        } else {
            return ($CATEGORY_ALL[$id_array_parent]["name"]);
        }

        return $idparent;
    }
}
