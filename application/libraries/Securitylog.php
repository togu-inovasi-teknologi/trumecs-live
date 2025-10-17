<?php

/**
 * Created by PhpStorm.
 * User: ro-beti-lavea
 * Date: 1/28/2015
 * Time: 12:22 AM
 */

class securitylog
{
    function cekadmin()
    {
        $CI = &get_instance();
        $header["session"] = $CI->session->all_userdata();
        if (array_key_exists("admin", $header["session"])) {
            if ($header["session"]["admin"]["Loginadmin"] == "TRUE") {
                return true;
            } else {
                redirect(base_url() . "backend/login");
            }
        } else {
            redirect(base_url() . "backend/login");
        }
    }

    function cekloginmember()
    {
        $CI = &get_instance();
        $header["session"] = $CI->session->all_userdata();
        if (array_key_exists("member", $header["session"])) {
            if ($header["session"]["member"]["Loginmember"] == "TRUE") {
            } else {
                $CI->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
                redirect(base_url() . "member/login/");
            }
        } else {
            redirect(base_url() . "member/login");
        }
    }
}
