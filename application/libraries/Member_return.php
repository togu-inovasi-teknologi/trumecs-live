<?php
/**
 * Created by PhpStorm.
 * User: ro-beti-lavea
 * Date: 1/28/2015
 * Time: 12:22 AM
 */

class member_return{
    function address_shipping(){
        $CI =& get_instance();
        $member=$CI->session->all_userdata();
        $nm_prov=  $CI->db->where(array('id' => $member["member"]["provice"] ))->get("provinces")->result_array()[0]["name"];
        $nm_reg= $CI->db->where(array('id' => $member["member"]["city"] ))->get("regencies")->result_array()[0]["name"];
        $nm_dis=$CI->db->where(array('id' => $member["member"]["districts"] ))->get("districts")->result_array()[0]["name"];
        $nm_vil= $CI->db->where(array('id' => $member["member"]["village"] ))->get("villages")->result_array()[0]["name"];
        $arrayreturn = array();
        $arraymemberaddress = array(
            'id'=>"shipping",
            'id_member'=>$member["member"]["id"] ,
            'id_province' => $member["member"]["provice"] , 
            'id_regencies' => $member["member"]["city"] , 
            'id_districts' => $member["member"]["districts"] , 
            'id_villages' => $member["member"]["village"] , 
            'nm_wilayah'=> $nm_vil.', '.$nm_dis.', '.$nm_reg.', '.$nm_prov,
            'address' => $member["member"]["shipping_address"] ,
            'kode_pos'=>  $member["member"]["shipping_kodepos"],
            'jne_kode' => $CI->db->where(array('id' => $member["member"]["shipping_iddistricts"] ))->get("districts")->result_array()[0]["kode_jne"],
            'tipe'=>'jne',
            'jarak'=>''
        );
        array_push($arrayreturn,$arraymemberaddress);

        $getaddresstable_keep = $CI->db->where(array('id_member' => $member["member"]["id"] ))->get("address_shipping")->result_array();
        $i=0;
        foreach ($getaddresstable_keep as $key ) {
           array_push($arrayreturn,$getaddresstable_keep[$i]);
           $i++;
        }
        #var_dump($arrayreturn);
        return $arrayreturn;
        
    }
}