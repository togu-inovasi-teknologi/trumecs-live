<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '185107509960-r8fg7ks52kava20ara0pj8qua2g6pnqk.apps.googleusercontent.com';
$config['google']['client_secret']    = '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';
$config['google']['redirect_uri']     = 'http://localhost:8000/member/login_google';
$config['google']['application_name'] = 'Trumecs.com';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array(['profile', 'email']);
