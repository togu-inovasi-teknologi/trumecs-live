<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Load_general extends MX_Controller
{

    public function __construct()
    {
        $this->menu();
        $this->category_all();
        $this->delivery_per_kg();
        $this->promo();
        $this->popup_ads();
        $ses = $this->session->all_userdata();
        if (array_key_exists("admin", $ses)) {
            $this->menuadmin();
            $this->atributmenuadmin();
        }
    }
    public function menu()
    {
        $querymenu1 = $this->db->where("name", "menu1")->get('setting');
        $querymenu2 = $this->db->where("name", "menu2")->get('setting');
        $querymenu3 = $this->db->where("name", "menu3")->get('setting');
        define('MENU1', serialize(($querymenu1->result_array())));
        define('MENU2', serialize(($querymenu2->result_array())));
        define('MENU3', serialize(($querymenu3->result_array())));
    }

    public function menuadmin()
    {
        $ses = $this->session->all_userdata();
        $menunumber = explode(",", $ses["admin"]["menu"]);

        foreach ($menunumber as $key) {
            $this->db->or_where("id", $key);
        }
        $querymenu = $this->db->get('backend_menu');
        $return = $querymenu->result_array();
        define('MENUADMIN', serialize(($return)));
    }

    public function atributmenuadmin()
    {
        $allproduct = $this->db->select("count(id)")->get('product');

        $neworder = $this->db->select("count(id)")->get('order');
        $unpaidorder = $this->db->select("count(id)")->where("status", "unpaid")->get('order');
        $paidorder = $this->db->select("count(id)")->where("status", "paid")->get('order');
        $processorder = $this->db->select("count(id)")->where("status", "process")->get('order');
        $deliveryorder = $this->db->select("count(id)")->where("status", "delivery")->get('order');
        $complateorder = $this->db->select("count(id)")->where("status", "complate")->get('order');
        $cancelorder = $this->db->select("count(id)")->where("status", "cencel")->get('order');
        $challengeorder = $this->db->select("count(id)")->where("status", "challenge")->get('order');

        $confirmation = $this->db->select("count(id)")->get('confirmation');
        $newconfirmation = $this->db->select("count(id)")->where("status", "new")->get('confirmation');
        $approvedconfirmation = $this->db->select("count(id)")->where("status", "approved")->get('confirmation');
        $rejectedconfirmation = $this->db->select("count(id)")->where("status", "rejected")->get('confirmation');

        $member = $this->db->select("count(id)")->get('member');
        $activemember = $this->db->select("count(id)")->where("status", "active")->get('member');
        $unactiveamember = $this->db->select("count(id)")->where("status", "unactive")->get('member');

        $promo = $this->db->select("count(id)")->get('promo');

        $page = $this->db->select("count(id)")->get('page');

        $artikel = $this->db->select("count(id)")->get('artikel');

        $admin = $this->db->select("count(id)")->get('admin');

        $complaint = $this->db->select("count(id)")->get('complaint');
        $unresponcomplaint = $this->db->select("count(id)")->where("status", "waiting respon")->get('complaint');
        $responcomplaint = $this->db->select("count(id)")->where("status", "respon")->get('complaint');

        $warranty = $this->db->select("count(id)")->get('complaintwarranty');
        $unresponwarranty = $this->db->select("count(id)")->where("status", "waiting respon")->get('complaintwarranty');
        $responwarranty = $this->db->select("count(id)")->where("status", "respon")->get('complaintwarranty');

        define('COUNTPRODUCT', serialize(($allproduct->result_array())));

        define('COUNTNEWORDER', serialize(($neworder->result_array())));
        define('COUNTUNPAIDORDER', serialize(($unpaidorder->result_array())));
        define('COUNTPAIDORDER', serialize(($paidorder->result_array())));
        define('COUNTPROCESSORDER', serialize(($processorder->result_array())));
        define('COUNTDELIVERYORDER', serialize(($deliveryorder->result_array())));
        define('COUNTCOMPLATEORDER', serialize(($complateorder->result_array())));
        define('COUNTCANCELORDER', serialize(($cancelorder->result_array())));
        define('COUNTCHALLENGEORDER', serialize(($challengeorder->result_array())));

        define('COUNTCONFIRM', serialize(($confirmation->result_array())));
        define('COUNTNEWCONFIRM', serialize(($newconfirmation->result_array())));
        define('COUNTAPPROVEDCONFIRM', serialize(($approvedconfirmation->result_array())));
        define('COUNTREJECTEDCONFIRM', serialize(($rejectedconfirmation->result_array())));

        define('COUNTMEMBER', serialize(($member->result_array())));
        define('COUNTACTIVEMEMBER', serialize(($activemember->result_array())));
        define('COUNTUNACTIVEMEMBER', serialize(($unactiveamember->result_array())));

        define('COUNTPROMO', serialize(($promo->result_array())));

        define('COUNTPAGE', serialize(($page->result_array())));

        define('COUNTARTIKEL', serialize(($artikel->result_array())));

        define('COUNTADMIN', serialize(($admin->result_array())));

        define('COUNTCOMPLAINT', serialize(($complaint->result_array())));
        define('COUNTUNRESPONCOMPLAINT', serialize(($unresponcomplaint->result_array())));
        define('COUNTRESPONCOMPLAINT', serialize(($responcomplaint->result_array())));

        define('COUNTWARRANTY', serialize(($warranty->result_array())));
        define('COUNTUNRESPONWARRANTY', serialize(($unresponwarranty->result_array())));
        define('COUNTRESPONWARRANTY', serialize(($responwarranty->result_array())));
    }

    public function category_all()
    {
        $query = $this->db->get('categori');
        define('CATEGORY_ALL', serialize(($query->result_array())));
    }
    public function delivery_per_kg()
    {
        $querymenu1 = $this->db->where("name", "delivery_per_kg")->get('setting');
        $value = $querymenu1->result_array();
        //define('DELIVERY_PER_KG', serialize($value));
        define('DELIVERY_PER_KG', $value[0]['value']);
    }
    public function promo()
    {
        $prmvkl = $this->db->from('setting')->join("promo", "setting.value=promo.id")->where("setting.name", "prmvkl")->get();
        $prmhtl = $this->db->from('setting')->join("promo", "setting.value=promo.id")->where("setting.name", "prmhtl")->get();
        define('PROMOHORISONTAL', serialize(($prmhtl->result_array())));
        define('PROMOVERTIKAL', serialize(($prmvkl->result_array())));
    }
    public function popup_ads()
    {
        $popup_adsbig = $this->db->where('name', "popup_adsbig")->from('setting')->get()->result_array()[0]['value'];
        define('PROMOSPANDUK', serialize(($popup_adsbig)));
        $popup_adsbig = $this->db->where('name', "popup_adsbig_mobile")->from('setting')->get()->result_array()[0]['value'];
        define('PROMOSPANDUKMOBILE', serialize(($popup_adsbig)));
        $popup_adsbig = $this->db->where('name', "popup_adsbig_used")->from('setting')->get()->result_array()[0]['value'];
        define('PROMOSPANDUKUSED', serialize(($popup_adsbig)));
        $popup_adsbig = $this->db->where('name', "popup_adsbig_mobile_used")->from('setting')->get()->result_array()[0]['value'];
        define('PROMOSPANDUKMOBILEUSED', serialize(($popup_adsbig)));
    }
}
