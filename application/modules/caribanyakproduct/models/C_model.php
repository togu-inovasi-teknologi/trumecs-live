<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getsetting($value)
    {
        $this->db->where('name',$value)
                ->from('setting');        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getnamecategori($value){
        $this->db->where("id", $value)
                ->select("name")
                ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getidcategori($value)
    {
        $this->db->where("name", $value)
                ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getpromo($value)
    {
        $promo = $this->db->where("id",$value)->from("promo")->get();
        $getproduct = $promo->result_array();
        if (count($getproduct)>0) {
            $product = $getproduct[0]["product"];
            $array_product = explode(",", $product);
            $select = $this->db->select("");
            $i=0;$asb="";
            foreach ($array_product as $key => $v) {
                    /*!empty($key)?
                    $this->db->or_like_in("tittle",$key) : "";*/
                    $asb .= " OR id='".$v."'";
                }
                $getselect = $select->where("( id = '' ".$asb.")")->from("product")->get()->result_array();
                $arrayall = array_merge(array('product' => $getselect),array('promo' => $getproduct));
                return $arrayall;
            }

        }

    public function record_count($datasearch,$datasearchor_like,$datawhere) {
            if (!empty($datawhere["brand"])) {
                $this->db->where('brand',$datawhere["brand"]);
            }
            if (!empty($datawhere["type"])) {
                $this->db->where('type',$datawhere["type"]);
            }
            if (!empty($datawhere["component"]) ) {
                $this->db->where("component",$datawhere["component"]);
            }
            if (!empty($datawhere["year"]) ) {
                $this->db->where("year",$datawhere["year"]);
            }
            if (!empty($datawhere["promo"]) ) {
                $this->db->where("promo",$datawhere["promo"]);
            }

            if (!empty($datasearch["minp"]) AND !empty($datasearch["maxp"]) AND ($datasearch["minp"]!="")) {
                $minp = ($datasearch["minp"]=="0") ? 1 : $datasearch["minp"];
                $this->db->where("price BETWEEN ".$minp." AND ".$datasearch["maxp"]);
            }



            if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"])!="") {
                $this->db->like("tittle",$datasearchor_like["tittle"]);
                $this->db->or_like("partnumber",$datasearchor_like["partnumber"]);
                $this->db->or_like("physicnumber",$datasearchor_like["physicnumber"]);
            }

            
            $query = $this->db->where("status","show")
            ->from("product");
            return $query->get()->num_rows();
        }

        public function fetch_product($limit, $start,$datasearch,$datasearchor_like,$datawhere) {
            
            if (!empty($datawhere["brand"])) {
                $this->db->where('brand',$datawhere["brand"]);
            }
            if (!empty($datawhere["type"])) {
                $this->db->where('type',$datawhere["type"]);
            }
            if (!empty($datawhere["component"]) ) {
                $this->db->where("component",$datawhere["component"]);
            }
            if (!empty($datawhere["year"]) ) {
                $this->db->where("year",$datawhere["year"]);
            }
            if (!empty($datawhere["promo"]) ) {
                $this->db->where("promo",$datawhere["promo"]);
            }

            if (!empty($datasearch["minp"]) AND !empty($datasearch["maxp"]) AND ($datasearch["minp"]!="") ) {
                $minp = ($datasearch["minp"]=="0") ? 1 : $datasearch["minp"];
                $this->db->where("price BETWEEN ".$minp." AND ".$datasearch["maxp"]."");
            }

            if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"])!="") {
                $this->db->like("tittle",$datasearchor_like["tittle"]);
                $this->db->or_like("partnumber",$datasearchor_like["partnumber"]);
                $this->db->or_like("physicnumber",$datasearchor_like["physicnumber"]);
            }
            
            
            $this->db->limit($limit, $start)->where("status","show")
            ->order_by("id","DESC");
            $query = $this->db->get("product");

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = (array) $row;
                }
                return  $data;

            }
            return false;
        }

        public function getproductcaribanyak($data,$limite)
        {
            $returnall= array();
            foreach ($data as $key=>$val) {
                $this->db->stop_cache();
                $this->db->start_cache();

                $tt = array_keys($val);
                $yangdicari = ($val[$tt[0]]);
                $arraycol = array('col' => $tt[0], 'katakunci'=>$yangdicari );


                $this->db->select("id,tittle,partnumber,img,price,price_promo")->where("status","show")->limit($limite, 0)
                ->order_by("id","DESC");
                $this->db->like($tt[0],$yangdicari);
                $query = $this->db->get("product");
                
                $resultquery["hasilcari"] = $query->result_array();
                $wawa= array_merge($arraycol,$resultquery);
                array_push($returnall, $wawa);
                $this->db->flush_cache();

            }
            return $returnall;
        }
    }