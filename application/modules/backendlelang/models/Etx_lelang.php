<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class etx_lelang extends CI_Model {

    function __construct()
    {
        parent::__construct();
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

     public function record_count($datasearch,$datasearchor_like,$datawhere) {
            

            if (!empty($datawhere["category"])) {
                $this->db->where('category',$datawhere["category"]);
            }
            if (!empty($datawhere["jenis_penawaran"])) {
                $this->db->where('jenis_penawaran',$datawhere["jenis_penawaran"]);
            }
            if (!empty($datawhere["status"]) ) {
                $this->db->where("status",$datawhere["status"]);
            }

            if (!empty($datasearch["minp"]) AND !empty($datasearch["maxp"]) AND ($datasearch["minp"]!="")) {
                $minp = ($datasearch["minp"]=="0") ? 1 : $datasearch["minp"];
                $this->db->where("price BETWEEN ".$minp." AND ".$datasearch["maxp"]);
            }

            if (!empty($datasearchor_like["judul"])) {
                $this->db->like("judul",$datasearchor_like["judul"]);
                $this->db->or_like("penyelenggara",$datasearchor_like["penyelenggara"]);
                $this->db->or_like("uraian",$datasearchor_like["uraian"]);
            }
            
            $query = $this->db
            ->from("lelang");
            return $query->get()->num_rows();
        }

        public function fetch_lelang($limit, $start,$datasearch,$datasearchor_like,$datawhere, $iduser = null) {
            
            if (!empty($datawhere["category"])) {
                $this->db->where('category',$datawhere["category"]);
            }
            if (!empty($datawhere["jenis_penawaran"])) {
                $this->db->where('jenis_penawaran',$datawhere["jenis_penawaran"]);
            }
            if (!empty($datawhere["status"]) ) {
                $this->db->where("status",$datawhere["status"]);
            }

            if (!empty($datasearch["minp"]) AND !empty($datasearch["maxp"]) AND ($datasearch["minp"]!="")) {
                $minp = ($datasearch["minp"]=="0") ? 1 : $datasearch["minp"];
                $this->db->where("price BETWEEN ".$minp." AND ".$datasearch["maxp"]);
            }

            if (!empty($datasearchor_like["judul"])) {
                $this->db->like("judul",$datasearchor_like["judul"]);
                $this->db->or_like("penyelenggara",$datasearchor_like["penyelenggara"]);
                $this->db->or_like("uraian",$datasearchor_like["uraian"]);
            }
            
            
            $this->db->limit($limit, $start)
            ->order_by("id","DESC");
            $query = $this->db->get("lelang");

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = (array) $row;
                }
                return  $data;
            }
            return false;
    }

    public function getlelang($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("lelang");
        $returnproduct = $query1->result_array();
        $whereid = $where["id"];
        $whereproduct = array('lelang' => $whereid);
        $this->db->where($whereproduct);
        $galery = $this->db->get("galery_lelang");
        $returngalery["galery"] = $galery->result_array();
        $returnall = array_merge($returnproduct[0],$returngalery);


        return $returnall;
    }

    public function addgalery($data)
    {
        $this->db->set($data)->insert("galery_lelang");
    }

    public function addlelang($data)
    {
        $this->db->set($data)->insert("lelang");
    }

    public function editlelang($data,$where)
    {
    	$this->db->where($where)->set($data)->update("lelang");
    }

    public function hapus($where)
    {
    	$this->db->where($where)->delete("lelang");
    }
    public function updatelelang($data,$where)
    {
        $this->db->where($where)->set($data)->update("lelang");
    }
    
     public function hapusgalery($where)
    {
        $this->db->where($where)->delete("galery_lelang");
    }

}