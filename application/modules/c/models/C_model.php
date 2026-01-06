<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getsetting($value)
    {
        $this->db->where('name', $value)
            ->from('setting');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getnamecategori($value)
    {
        $this->db->where("id", $value)
            ->select("name")
            ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getnamequality($value)
    {
        $this->db->where("id", $value)
            ->select("grade")
            ->from("grade");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getidcategori($value)
    {
        $this->db->where("url", $value)
            ->from("categori");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getpromo($value)
    {
        $promo = $this->db->where("id", $value)->from("promo")->get();
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

    public function getpromo2($limit, $start, $value)
    {
        $promo = $this->db->where("id", $value)->from("promo")->get();
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

    public function getcucigudang($value)
    {
        $promo = $this->db->where("id", $value)->from("cucigudang")->get();
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
            $arrayall = array_merge(array('product' => $getselect), array('cucigudang' => $getproduct));
            return $arrayall;
        }
    }

    public function record_count($datasearch, $datasearchor_like, $datawhere)
    {
        $query = [];

        if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
            $query = $this->get_query($datasearchor_like["tittle"]);
        };

        // Handle sub kategori jika ada
        $sub_category = array();
        if (!empty($datawhere["component"])) {
            // Jika ada sub kategori spesifik
            if (!empty($datawhere["sub_category"])) {
                $sub_category = $this->get_all_child_categories($datawhere["sub_category"]);
            } else {
                // Jika hanya komponen utama, dapatkan semua child-nya
                $sub_category = $this->get_all_child_categories($datawhere["component"]);
            }
        };

        if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
            $string = explode(" ", preg_replace("/[^a-zA-Z0-9]/", "", $datasearchor_like["tittle"]));
            $string_query = "";
            $sql_query = "";
            foreach ($string as $q) {
                $string_query .= ", " . $q . "";
                $sql_query .= "+ MATCH(`tittle`, `description`) AGAINST('" . $q . "*' IN BOOLEAN MODE) ";
            }

            $this->db->select("*, SUM(MATCH(`tittle`, `description`) AGAINST('" . $datasearchor_like["tittle"] . "') " . $sql_query . ")  AS score");
        } else {
            $this->db->select("*, 0  AS score");
        }

        if (!empty($datawhere["brand"])) {
            $this->db->where('brand', $datawhere["brand"]);
        }
        if (!empty($datawhere["type"])) {
            $this->db->where('type', $datawhere["type"]);
        }
        if (!empty($datawhere["component"])) {
            // Gunakan array sub category yang sudah diproses
            $this->db->where_in("component", $sub_category);
        }
        if (!empty($datawhere["year"])) {
            $this->db->where("year", $datawhere["year"]);
        }
        if (!empty($datawhere["promo"])) {
            $this->db->where("promo", $datawhere["promo"]);
        }
        if (!empty($datawhere["cucigudang"])) {
            $this->db->where("cucigudang", $datawhere["cucigudang"]);
        }
        if (!empty($datawhere["quality"])) {
            $this->db->where("quality", $datawhere["quality"]);
        }
        if (!empty($datasearch["minp"]) and !empty($datasearch["maxp"]) and ($datasearch["minp"] != "")) {
            $minp = ($datasearch["minp"] == "0") ? 1 : $datasearch["minp"];
            $this->db->where("price BETWEEN " . $minp . " AND " . $datasearch["maxp"]);
        }
        if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
            $this->db->group_start();
            $this->db->group_start();
            $this->db->or_like("tittle", $datasearchor_like["tittle"]);
            foreach ($string as $q) {
                $this->db->or_like("tittle", $q);
                $this->db->or_where("MATCH(`tittle`, `description`) AGAINST('" . $q . "*'  IN BOOLEAN MODE)");
            }
            $this->db->or_where("MATCH(`tittle`, `description`) AGAINST('" . $datasearchor_like["tittle"] . "')");
            $this->db->or_like("partnumber", $datasearchor_like["partnumber"]);
            $this->db->or_like("physicnumber", $datasearchor_like["physicnumber"]);
            $this->db->group_end();
            if ($query) {
                $this->db->or_group_start();
                $this->db->or_where_in('brand', $query);
                $this->db->or_where_in('type', $query);
                $this->db->or_where_in('component', $query);
                $this->db->group_end();
            }
            $this->db->group_end();
        };
        $this->db->where("status", "show")->group_by('id');
        $query = $this->db->get('product');
        return $query->num_rows();
    }


    public function fetch_product($limit, $start, $datasearch, $datasearchor_like, $datawhere, $rand = false)
    {
        $query = [];

        if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
            $query = $this->get_query($datasearchor_like["tittle"]);
        };

        // Handle sub kategori jika ada
        $sub_category = array();
        if (!empty($datawhere["component"])) {
            // Jika ada sub kategori spesifik
            if (!empty($datawhere["sub_category"])) {
                $sub_category = $this->get_all_child_categories($datawhere["sub_category"]);
            } else {
                // Jika hanya komponen utama, dapatkan semua child-nya
                $sub_category = $this->get_all_child_categories($datawhere["component"]);
            }
        };

        // ... (sisa kode tetap sama, pastikan bagian WHERE_IN component menggunakan $sub_category)
        if (!empty($datawhere["component"])) {
            $this->db->where_in("component", $sub_category);
        }

        if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
            $string = explode(" ", preg_replace("/[^a-zA-Z0-9]/", "", $datasearchor_like["tittle"]));
            $string_query = "";
            $sql_query = "";
            foreach ($string as $q) {
                $string_query .= ", " . $q . "";
                $sql_query .= "+ MATCH(`tittle`, `description`) AGAINST('" . $q . "*' IN BOOLEAN MODE) ";
            }

            $this->db->select("*, SUM(MATCH(`tittle`, `description`) AGAINST('" . $datasearchor_like["tittle"] . "') " . $sql_query . ")  AS score");
        } else {
            $this->db->select("*, 0  AS score");
        }

        if (!empty($datawhere["brand"])) {
            $this->db->where('brand', $datawhere["brand"]);
        }

        // if (!empty($datawhere["tipe"])) {
        //     $this->db->where('tipe', $datawhere["tipe"]);
        // }

        if (!empty($datawhere["component"])) {
            $this->db->where_in("component", $sub_category);
        }

        if (!empty($datawhere["year"])) {
            $this->db->where("year", $datawhere["year"]);
        }

        if (!empty($datawhere["promo"])) {
            $this->db->where("promo", $datawhere["promo"]);
        }

        if (!empty($datawhere["cucigudang"])) {
            $this->db->where("cucigudang", $datawhere["cucigudang"]);
        }

        if (!empty($datawhere["quality"])) {
            $this->db->where("quality", $datawhere["quality"]);
        }

        if (!empty($datasearch["minp"]) and !empty($datasearch["maxp"]) and ($datasearch["minp"] != "")) {
            $minp = ($datasearch["minp"] == "0") ? 1 : $datasearch["minp"];
            $this->db->where("price BETWEEN " . $minp . " AND " . $datasearch["maxp"] . "");
        }


        if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
            $this->db->group_start();
            $this->db->group_start();
            $this->db->or_like("tittle", $datasearchor_like["tittle"]);
            foreach ($string as $q) {
                $this->db->or_like("tittle", $q);
                $this->db->or_where("MATCH(`tittle`, `description`) AGAINST('" . $q . "*'  IN BOOLEAN MODE)");
            }
            $this->db->or_where("MATCH(`tittle`, `description`) AGAINST('" . $datasearchor_like["tittle"] . "')");
            $this->db->or_like("partnumber", $datasearchor_like["partnumber"]);
            $this->db->or_like("physicnumber", $datasearchor_like["physicnumber"]);
            $this->db->group_end();
            if ($query) {
                $this->db->or_group_start();
                $this->db->or_where_in('brand', $query);
                $this->db->or_where_in('component', $query);
                $this->db->group_end();
            }
            $this->db->group_end();
        };



        if ($rand) {
            $this->db->limit($limit, $start)
                ->where("status", "show")
                //->where("tipe", $datawhere["tipe"])
                ->order_by("RAND()", "", false)
                ->group_by('id');
        } else {
            $this->db->limit($limit, $start)
                ->where("status", "show")
                // ->where("tipe", $datawhere["tipe"])
                ->order_by("score", "DESC")
                ->group_by('id');
        }

        $query = $this->db->get("product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = (array) $row;
            }
            return  $data;
        }

        return false;
    }

    public function get_all_child_categories($parent_id)
    {
        $this->db->select('id');
        $this->db->where('parent', $parent_id);
        $query = $this->db->get('categori');

        $children = array();
        $children[] = $parent_id; // Include parent itself

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // Get grandchildren recursively
                $grandchildren = $this->get_all_child_categories($row->id);
                $children = array_merge($children, $grandchildren);
            }
        }

        return array_unique($children);
    }

    // Fungsi untuk mengecek apakah kategori adalah sub kategori langsung
    public function is_direct_subcategory($category_id, $parent_id)
    {
        $this->db->where('id', $category_id);
        $this->db->where('parent', $parent_id);
        $query = $this->db->get('categori');
        return $query->num_rows() > 0;
    }

    private function get_sub_category($id_category)
    {
        $this->db->select('id');
        $this->db->where('parent', $id_category);
        $data = $this->db->get('categori');

        $children = [];
        $children[] = $id_category;
        foreach ($data->result() as $item) :
            $sub_children = $this->get_sub_category($item->id);
            $children = array_merge($children, $sub_children);
        endforeach;

        return $children;
    }

    public function get_category()
    {
        $this->db->where('parent', '0');
        $data = $this->db->get('categori');

        return $data;
    }

    public function get_query($string)
    {
        $string = explode(" ", $string);

        $this->db->select('id');
        foreach ($string as $item) :
            $this->db->or_like("name", $item, "both");
        endforeach;

        $data = $this->db->get('categori');

        $children = [];
        foreach ($data->result() as $item) :
            $sub_children = $this->get_sub_category($item->id);
            $children = array_merge($children, $sub_children);
        endforeach;

        return $children;
    }

    public function newArrival()
    {
        return $this->db->select('*')
            ->from('product p')
            ->order_by('id', 'DESC')
            ->limit(6)
            ->get()->result_array();
    }

    public function fetch_product_by_cat($limit, $start, $datasearch, $datasearchor_like, $datawhere, $rand = false)
    {
        $cat = $this->get_category();
        $data = array();
        foreach ($cat->result() as $key => $item) {
            $query = [];

            if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
                $query = $this->get_query($datasearchor_like["tittle"]);
            };

            //if (!empty($datawhere["component"])) {
            $sub_category = $this->get_sub_category($item->id);
            //};

            if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
                $string = explode(" ", preg_replace("/[^a-zA-Z0-9]/", "", $datasearchor_like["tittle"]));
                $string_query = "";
                $sql_query = "";
                foreach ($string as $q) {
                    $string_query .= ", " . $q . "";
                    $sql_query .= "+ MATCH(`tittle`, `description`) AGAINST('" . $q . "*' IN BOOLEAN MODE) ";
                }

                $this->db->select("*, SUM(MATCH(`tittle`, `description`) AGAINST('" . $datasearchor_like["tittle"] . "') " . $sql_query . ")  AS score");
            } else {
                $this->db->select("*, 0  AS score");
            }

            if (!empty($datawhere["brand"])) {
                $this->db->where('brand', $datawhere["brand"]);
            }

            if (!empty($datawhere["type"])) {
                $this->db->where('type', $datawhere["type"]);
            }

            //if (!empty($datawhere["component"]) ) {
            $this->db->where_in("component", $sub_category);
            //}

            if (!empty($datawhere["year"])) {
                $this->db->where("year", $datawhere["year"]);
            }

            if (!empty($datawhere["promo"])) {
                $this->db->where("promo", $datawhere["promo"]);
            }

            if (!empty($datawhere["cucigudang"])) {
                $this->db->where("cucigudang", $datawhere["cucigudang"]);
            }

            if (!empty($datawhere["quality"])) {
                $this->db->where("quality", $datawhere["quality"]);
            }

            if (!empty($datasearch["minp"]) and !empty($datasearch["maxp"]) and ($datasearch["minp"] != "")) {
                $minp = ($datasearch["minp"] == "0") ? 1 : $datasearch["minp"];
                $this->db->where("price BETWEEN " . $minp . " AND " . $datasearch["maxp"] . "");
            }


            if (!empty($datasearchor_like["tittle"]) or ($datasearchor_like["tittle"]) != "") {
                $this->db->group_start();
                $this->db->group_start();
                $this->db->or_like("tittle", $datasearchor_like["tittle"]);
                foreach ($string as $q) {
                    $this->db->or_like("tittle", $q);
                    $this->db->or_where("MATCH(`tittle`, `description`) AGAINST('" . $q . "*'  IN BOOLEAN MODE)");
                }
                $this->db->or_where("MATCH(`tittle`, `description`) AGAINST('" . $datasearchor_like["tittle"] . "')");
                $this->db->or_like("partnumber", $datasearchor_like["partnumber"]);
                $this->db->or_like("physicnumber", $datasearchor_like["physicnumber"]);
                $this->db->group_end();
                if ($query) {
                    $this->db->or_group_start();
                    $this->db->or_where_in('brand', $query);
                    $this->db->or_where_in('type', $query);
                    $this->db->or_where_in('component', $query);
                    $this->db->group_end();
                }
                $this->db->group_end();
            };


            if ($rand) {
                $this->db->limit($limit, $start)->where("status", "show")
                    ->order_by("RAND()", "", false)->group_by('id');
            } else {
                $this->db->limit($limit, $start)->where("status", "show")
                    ->order_by("score", "DESC")->group_by('id');
            }


            $query = $this->db->get("product");

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[$item->id][] = (array) $row;
                }
            }
        }

        return  $data;
    }
}
