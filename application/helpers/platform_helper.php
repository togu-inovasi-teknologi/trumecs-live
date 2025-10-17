<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('platform_contact')) {

    
    
    function platform_contact($param) {
        $CI =& get_instance();

        $contact = array(
            "email" => "info@trumecs.com",
            "phone" => "+62 851 7691 2338",
            "ida" => "",
            "name" => "",
            "whatsapp" => "6285176912338",
            "trumecs_email" => "",
             "address" => "No. B, Jl. Pintu Air Raya No.31, RT.13/RW.8, Ps. Baru, Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710",
        );

        if(get_cookie('ida', TRUE)) {
            $ida = get_cookie('ida', TRUE);
            if(array_key_exists("ida", $_GET) && $ida != $_GET["ida"] ) {
                set_cookie(
                    array(
                        "name" => "ida", 
                        "value" => $_GET["ida"], 
                        "expire" => '7200'
                    )
                );
                $ida = $_GET["ida"];
            } 
        } else {
            if(!array_key_exists("ida", $_GET)) {
                $ida = "default";
            } else {
                set_cookie(
                    array(
                        "name" => "ida", 
                        "value" => $_GET["ida"], 
                        "expire" => '7200'
                    )
                );
                $ida = $_GET["ida"];
            }
        }
        
        $data = $CI->db->where('id', $ida)->get("admin");

        if ($data->num_rows() > 0) {
            if($data->row()->email) {
                $contact['email'] = $data->row()->email;
            }
            
            if($data->row()->phone) {
                $contact['phone'] = $data->row()->phone;    
            }
            
            if($data->row()->name) {
                $contact['name'] = $data->row()->name;
            }

            if($data->row()->id) {
                $contact['id'] = $data->row()->id;
            }

            if($data->row()->whatsapp) {
                $contact['whatsapp'] = $data->row()->whatsapp;
            }

            if($data->row()->trumecs_email) {
                $contact['trumecs_email'] = $data->row()->trumecs_email;
            }

        } else {

        }
        
        return $contact[$param];
        
    }

}


if(!function_exists('get_language')) {
   
    function get_language() {
        $host = $_SERVER['HTTP_HOST'];
        $host_segment = explode('.', $host);

        $language = $host_segment[0];

        $obj_language = array(
            'language' => '',
            'code' => '',
            'domain' => ''
        );

        if($language == 'www' || $language == 'togu-dev' || $language == 'trumecs') {
            $obj_language['language'] = 'indonesia';
            $obj_language['code'] = 'id';
            $obj_language['domain'] = '';
        } else if($language == 'en') {
            $obj_language['language'] = 'english';
            $obj_language['code'] = 'en';
            $obj_language['domain'] = 'en';
        } else if($language == 'cn') {
            $obj_language['language'] = 'chinese';
            $obj_language['code'] = 'cn';
            $obj_language['domain'] = 'cn';
        }

        return $obj_language;
    }

}
