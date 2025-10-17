<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Language {
    function init()
    {
        $CI =& get_instance();

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

        $CI->config->set_item('language', $obj_language['language']);
    }
}