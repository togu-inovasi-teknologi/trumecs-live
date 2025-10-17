<?php
/**
 * Created by PhpStorm.
 * User: ro-beti-lavea
 * Date: 1/28/2015
 * Time: 12:22 AM
 */

class emailer {


  function sent($from,$password,$to,$subject,$message){

    $CI =& get_instance();
    $CI->load->library('email');
    $config['protocol']='smtp';
    $config['smtp_host']='ssl://mail.trumecs.com';
    $config['smtp_port']='465';
    $config['smtp_timeout']='30';
    $config['smtp_user']=$from;
    $config['smtp_pass']=$password;
    $config['charset']='utf-8';
    $config['newline']="\r\n";
    $config['wordwrap'] = TRUE;
    $config['mailtype'] = 'html';
    $config['priority'] = 2;
    $config['validate']=TRUE;

    $CI->email->initialize($config);
    $CI->email->from($from, 'Trumecs');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);
/*    $CI->email->send();


    //$header=$CI->session->all_userdata();

    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'mail.lobunta.com',
      'smtp_port' => 465,
      'smtp_timeout' => "30",
      'smtp_user' => $from, // change it to yours
      'smtp_pass' => $password, // change it to yours
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
      );

    $message = $message;
    $CI->load->library('email', $config);
    $CI->email->clear("TRUE");
    $CI->email->set_newline("\r\n");
          $CI->email->from($from); // change it to yours
          $CI->email->to($to);// change it to yours
          $CI->email->subject($subject);
          $CI->email->message($message);*/
          if($CI->email->send()){
            return true;
          }else{
           return false;
          }

          echo "<pre>".$CI->email->print_debugger() ."</pre>";  
          //print_r($message); 

        }
      }