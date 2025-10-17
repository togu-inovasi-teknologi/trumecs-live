<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class etx_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    public function record_count($datawhere) {
            
        $this->db->where($datawhere); 
        $query = $this->db
            ->from("member");
        return $query->get()->num_rows();
    }

    public function fetch_product($limit, $start, $datawhere=NULL) {
        if($datawhere == NULL){
            if($this->input->get('name')){
             $this->db->like('name', $this->input->get('name'));     
            }
        }else{
            if($datawhere['status'] == 'active' || $datawhere['status'] == 'unactive' ){
                $this->db->where($datawhere);     
            }   
        }
        
        $this->db->limit($limit, $start)

            ->order_by("id","DESC");
        $query = $this->db->get("member");
        return $query->result_array();
    }

    public function getdetail($where)
    {
        $this->db->where($where);
        $query1 = $this->db->get("member");
        $queryconfirm=$query1->result_array();
        $returnconfirm["member"] = $queryconfirm[0];
        $whereidmember = $queryconfirm[0]["id"];
        //$wherenamemember = $queryconfirm[0]["name"];
        $returnall = array();
        $wheremember = array('idmember' => $whereidmember);
        $this->db->where($wheremember);
        $detailmember = $this->db->get("order");
        $remove0 =$detailmember->result_array();
        $returndetailmember["order"] = $remove0;

        $listorder["order"]=array();
        $xxdetail = array();
        $i=0;
        if (!empty($remove0)) {
            # code...
        
        foreach ($remove0 as $result) {
            $Q_orderdetail=$this->db->where("id_order",$result["id"])->from('order_detail')->get();
            $tatalcostmember=0;$tatalcost=0;
                if ($Q_orderdetail->num_rows()>0) {
                    $returnQ_orderdetail=$Q_orderdetail->result_array();                            
                    $pricedetail=0;$pricetotal=0;
                    foreach ($returnQ_orderdetail as $Q_orderdetail) {
                        $pricedetail = $Q_orderdetail["price"]*$Q_orderdetail["quantity"];
                        $pricetotal=$pricetotal+$pricedetail;
                        $tatalcost =$pricetotal+$result["shipping_cost"];                        
                    }
                }  
            $tatalcostmember=$tatalcostmember+$tatalcost;
            $arraymerge= array('totalshipping' =>(string) $tatalcostmember);
            $result=$result+$arraymerge;
            $data[]= (array) $result;                  
        }
        $dataorderall["order"] =$data;
        $returnall = array_merge($returnconfirm,$dataorderall);
        }else{
            $returnall = $returnconfirm;
        }
        return $returnall;
    }
    /*private function getdetailorder($idorder)
    {
        $ttdetail = $this->db->where("id_order", $idorder)->get("order_detail");
        $alldetaillist = $ttdetail->result_array();
        return  $alldetaillist;
        //var_dump($alldetaillist["listpesanan"]);
    }*/
    public function update($where,$set)
    {
        $this->db->where($where)->set($set)->update("member");
    }

    
     public function hapus($where)
    {
        $this->db->where($where)->delete("member");
    }

    public function search($query) {
        $this->db->like('name', $query);
        $this->db->or_like('Company', $query);
        return $this->db->get('member');
    }

}