<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function record_count()
    {
        $query = $this->db
            ->from("artikel");
        return $query->get()->num_rows();
    }
    public function fetch($limit, $start)
    {
        $this->db->limit($limit, $start)
            ->order_by("id", "DESC");
        $this->db->where('display', 1);
        $query = $this->db->get("artikel");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = (array) $row;
            }
            return $data;
        }
        return false;
    }

    public function trendingNews($limit, $start)
    {
        $this->db->limit($limit, $start)
            ->order_by("view", "DESC");
        $this->db->where('display', 1);
        $query = $this->db->get("artikel");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = (array) $row;
            }
            return  $data;
        }
        return false;
    }

    public function getpage($url)
    {
        if (is_numeric($url)) {
            $query = $this->db->where("id", $url)->get('artikel');
        } else {
            $query = $this->db->where("url", $url)->get('artikel');
        }
        $return = $query->result_array();
        foreach ($return as $key) {
            # code...
        }
        $this->db->where("url", $url)->set("view", $key["view"] + 1)->update('artikel');


        return $return;
    }

    public function getnewartikel()
    {
        $this->db->from('artikel')->limit(8)->order_by("id", "desc");
        $this->db->where('display', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getnewartikelmain($limit)
    {
        $this->db->from('artikel')->limit($limit)->order_by("id", "desc");
        $this->db->where('display', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getsameartikel($title, $url = null)
    {
        $explodetitle = explode(" ", $title);
        //$this->db->group_start();

        $string_query = "";
        $sql_query = "";
        foreach ($explodetitle as $q) {
            $q = $this->db->escape_str(preg_replace("/[^A-Za-z0-9 ]/", '', $q));
            if ($q != '') {
                $string_query .= ", " . $q . "";
                $sql_query .= "+ MATCH(`title`, `value`) AGAINST('" . $q . "*' IN BOOLEAN MODE) ";
            }
        }

        $this->db->select("*, SUM(MATCH(`title`, `value`) AGAINST('" . $this->db->escape_str(preg_replace("/[^A-Za-z0-9 ]/", ' ', $title)) . "') " . $sql_query . ")  AS score");
        //$this->db->group_end();
        if ($url != null) {
            $this->db->where('url !=', $url);
        }

        $this->db->group_by('artikel.id');
        $this->db->order_by("score", "DESC");
        $this->db->where('display', 1);
        $this->db->from('artikel');
        if ($this->uri->segment(1) == "article") {
            $this->db->limit(4);
        } else {
            $this->db->limit(8);
        }
        $query = $this->db->get();
        return $query->result_array();
        // return [];
    }

    public function getpromo($value)
    {
        $qseting = $this->db->where("name", $value)->get('setting');
        $variableqseting = $qseting->result_array();
        foreach ($variableqseting as $variableqsetingkey) {
        }
        $newkey = $variableqsetingkey["value"];

        $promo = $this->db->where("id", $newkey)
            ->where('start_date <', strtotime(date("Y-m-d")))
            ->where('end_date >', strtotime(date("Y-m-d")))
            ->from("promo")->get();
        $getproduct = $promo->result_array();

        if (count($getproduct) > 0) {
            $product = $getproduct[0]["product"];
            $array_product = explode(",", $product);
            $select = $this->db->select("");
            $i = 0;
            $asb = "";
            foreach ($array_product as $key => $v) {
                /*!empty($key)?
                    $this->db->or_like_in("tittle",$key) : "";*/
                $asb .= " OR id='" . $v . "'";
            }
            $getselect = $select->where("( id = '' " . $asb . ")")->from("product")->get()->result_array();
            $arrayall = array_merge(array('product' => $getselect), array('promo' => $getproduct));
            return $arrayall;
        }
    }
}
