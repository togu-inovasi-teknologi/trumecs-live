<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/notfound404';
$route['403_override'] = 'home/notfound404';
$route['translate_uri_dashes'] = FALSE;

$route['cari/'] = 'c/is_redirect';
$route['cari'] = 'cari';
$route['partnership'] = 'principal/partnership';

$route['introduction'] = 'home/introduction';
$route['home/vcard/(:any)'] = 'home/vcard/$1';

$route['timthumb'] = 'timthumb';
$route['product'] = 'product';
$route['mechanic'] = 'mechanic';
$route['article'] = 'article';
$route['promo'] = 'promo';
$route['jasa'] = 'jasa';
$route['rental'] = 'rental';
$route['bulk'] = 'bulk';
$route['member'] = 'member';
$route['page'] = 'page';
$route['cart'] = 'cart';
$route['category/(:any)'] = 'category/index/$1';
$route['backend'] = 'backend';
$route['backendmember'] = 'backendmember';
$route['backendartikel'] = 'backendartikel';
$route['backendconfirm'] = 'backendconfirm';
$route['backendcomplaintwarranty'] = 'backendcomplaintwarranty';
$route['backendorder'] = 'backendorder';
$route['backendpage'] = 'backendpage';
$route['backendtestimonial'] = 'backendtestimonial';
$route['backendagent'] = 'backendagent';
$route['backendbulk'] = 'backendbulk';
$route['backendprincipal'] = 'backendprincipal';
$route['backendrental'] = 'backendrental';
$route['backendmekanik'] = 'backendmekanik';

$route['principal/register'] = 'principal/register';
$route['principal/register_success'] = 'principal/register_mail_send';
$route['principal/principal_register'] = 'principal/principal_register';
$route['principal/verification/(:any)'] = 'principal/verification/$1';
$route['principal/dataequipment'] = 'principal/dataequipment';

// $route['c'] = 'c/is_redirect';

$route['tab'] = 'tab';
$route['getProductByCategories'] = 'home/getProductByCategories';
$route['productCompare'] = 'home/productCompare';
$route['deleteRfqSession'] = 'home/deleteRfqSession';
$route['share_compare'] = 'home/shareComparasion';
$route['principal_register'] = 'home/principal_register';

$route['member/orders'] = 'order';
$route['member/orders/detail/(:any)'] = 'order/detail/$1';
$route['member/orders/upload_payment_file'] = 'order/upload_payment_file';
$route['member/orders/po'] = 'order/po';
$route['member/orders/receive'] = 'order/receive';

$route['sharing/(:any)'] = 'sharing';

// get json all category only
$route['getjson/getjsonallcategory'] = 'json/GetJson/getJsonAllCategoryOnly';
$route['getjson/getjsonallbrand'] = 'json/GetJson/getJsonBrand';
$route['getjson/villages'] = 'json/GetJson/getJsonAddressByVillage';
$route['getjson/contacts'] = 'json/GetJson/getContacts';
$route['getjson/companies'] = 'json/GetJson/getCompany';
$route['getjson/sourcing_detail'] = 'json/GetJson/sourcing_detail';
$route['getjson/companies_table'] = 'json/GetJson/getCompanyDatatable';
$route['getjson/member_table'] = 'json/GetJson/getDatatableMember';
$route['getjson/contact_table'] = 'json/GetJson/getContactTable';
$route['getjson/items'] = 'json/GetJson/getItems';
$route['getjson/getAddressByVillage/(:any)'] = 'json/GetJson/getAddressByVillage';
$route['getjson/getsourcinglist'] = 'json/GetJson/sourcings';
$route['getjson/getsourcing_items_supplier'] = 'json/GetJson/sourcing_items_supplier';

$route[':any'] = 'store';
$route[':any/products'] = 'store/products';
$route[':any/getProducts'] = 'store/getProducts';

$route['member/store/delete_banner/(:any)'] = 'member/store/delete_banner/$1';

$route['rental/list/(:any)'] = 'rental/list/$1';

$route['category/brands'] = 'category/get_brands';

$route['member/downloadBuktiTransfer/(:any)'] = 'member/downloadBuktiTransfer/$1';

