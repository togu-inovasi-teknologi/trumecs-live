<?php  
/**
* 
*/
class Cart_model extends CI_Model
{
	
	function __construct(){
        parent::__construct();

    }

    public function get()
    {
    	# code...
    }
    public function insertorder($data)
    {
    	$this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.id_order = order.id');
        $this->db->or_where($data);
        $order = $this->db->get();
        $array_order= $order->result_array();
        //var_dump($array_order);
        if (empty($array_order)) {
            $this->db->set("time",date("d/m/Y H:i"))
                    ->set($data)
                    ->set("status","Pending")
            ->insert("order");
            return true;
        }else{
            return false;
        }
    }
    public function getorder($data)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->or_where($data);

        $order = $this->db->get();
        return $order->result_array();
    }
    public function getproduct($id)
    {
        $this->db->where("id",$id)
                ->from("product");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getsetting($name)
    {
        $this->db->select("value")->where("name",$name)
                ->from("setting");
        $query = $this->db->get();
        $array = $query->result_array();
        return $array["0"]["value"];
    }

    public function getchart($data)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.id_order = order.id');
        $this->db->join('product', 'product.id = order_detail.id_product');
        $this->db->or_where($data);

        $order = $this->db->get();
        return $order->result_array();
    }

    public function insertorderdetail($data)
    {
        $this->db->where("id_order",$data["id_order"])
                ->where("id_product",$data["id_product"])
                ->from("order_detail");
                $orderdatail = $this->db->get()->result_array();
                foreach ($orderdatail as $orderdatail) {
                    # code...
                }
            if (empty($orderdatail)) {
                $this->db->insert("order_detail",$data);
            }else{
                $this->db->where("id_product",$data["id_product"])
                        ->set("quantity",$data["quantity"])
                        ->update("order_detail");
            }
        
    }
    public function update($where,$set)
    {
    	$this->db->where($where)->set($set)->update("order_detail");
    }
    public function delete($where,$order)
    {
    	$this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.id_order = order.id');
        $this->db->where($where);
        $this->db->or_where($order);

        $order = $this->db->get();
        $array_order= $order->result_array();
            foreach ($array_order as $array_order) {}
            if (empty($array_order)) {                
                return false;
            }else{
                $this->db->where($where)
                    ->delete("order_detail");
                return true;
            }
    }
    public function updateorder($data,$where)
    {
        $this->db->where($where)
                ->set($data)
                ->update("order");
    }

    public function insertordercekout($data)
    {
        $this->db->set($data)
                ->insert("order");
        return $this->db->insert_id();
    }
    public function insertorderdetailcekout($data)
    {
        $this->db->set($data)
                ->insert("order_detail");
    }
    public function get_tarif_ojek($id)
    {
        $this->db->select('*')->where("id_ojek_online",$id);
        $this->db->from('tarif_ojek_online');
        $order = $this->db->get();
        return $order;
    }

    public function getnamewilayah($id,$table)
    {
        $this->db->select('name')->where($id);
        $this->db->from($table);
        $order = $this->db->get();
        $return = $order->result_array();
        if (!empty($return)) {
            return ucwords(strtolower($return[0]["name"]));
        } else {
            return "-";
        }
    }
    public function getprovinces()
    {
        $order=$this->db->get("provinces");
        return $order->result_array();
    }

    public function getkodejne($where)
    {
        $this->db->select('kode_jne')->where($where);
        $this->db->from("districts");
        $order = $this->db->get();
        $return = $order->result_array();
        if (!empty($return)) {
            return (($return[0]["kode_jne"]));
        } else {
            return null;
        }
    }
    public function savenewaddress($data)
    {
        $this->db->set($data)
                ->insert("address_shipping");
        return $this->db->insert_id();
    }
    public function deleteaddress($data)
    {
        $this->db->where($data)->delete("address_shipping");
        return $this->db->affected_rows();
    }

    public function check_referral_code($code) {
        $this->db->where('referral_code', $code);
        $this->db->where('user_id !=', $code);
        $result = $this->db->get('referral_code');
        return $result;
    }
}

