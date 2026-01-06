<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MX_Controller
{

    public $product;

    public $base_url;

    function __construct()
    {


        // Call the Model constructor
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("article/article_model");
        $this->load->model('product_datatable_model');
        $this->load->language("product");


        $this->base_url = 'https://trumecs.com/';
    }

    function _remap($param)
    {
        $this->index($param);
    }
    public function index($url)
    {

        $data["data_product"] = $this->product_model->getproduct($url);

        if (empty($data["data_product"])) {
            show_404(); // atau redirect ke halaman 404
            return;
        }


        if (empty($data["data_product"])) {
            redirect(base_url());
        }

        $this->load->helper("text");

        $productgalery = $data["data_product"][0]["id"];
        $data["galeryimg"] = $this->product_model->getgalery($productgalery);
        $data["attribute"] = $this->product_model->getattribute($productgalery);

        $namebrand = $data["data_product"][0]["brand"];
        $namebrandunit = $this->getcategory($data["data_product"][0]["brand_unit"]);
        $nametype = $this->getcategory($data["data_product"][0]["type"]);
        $namecomponent = $this->getcategory($data["data_product"][0]["component"]);
        $parent = $this->getparent($data["data_product"][0]["component"]);

        //$stringtitle = (($namecomponent != "") ? $namecomponent." " : "") . $data["data_product"][0]["tittle"];
        //$stringtitle .= ($namebrand != "") ? " Merek " . $namebrand : "";
        //$stringtitle .= ($nametype != "") ? " Type " . $nametype : "";


        $str_keyword = $data["data_product"][0]["tittle"];
        $str_keyword .= ($namebrand != "") ? ", " . $namebrand : "";
        //$str_keyword .= ($nametype != "") ? ", " . $nametype : "";
        $str_keyword .= ($namecomponent != "") ? ", " . $namecomponent : "";

        $seo_desunit = ($data["data_product"][0]["unit"] != "") ? " per " . strtolower($data["data_product"][0]["unit"]) : '';
        $seo_desstok = ($data["data_product"][0]["stock"] != 0) ? ", tersedia " . $data["data_product"][0]["stock"] . " stok barang" : '';

        $file_exists = "public/image/product/" . $data["data_product"][0]["img"];
        if (!file_exists($file_exists)) {
            $file_exists = "public/image/logonew.png";
        }


        $data["seotitle"] = $data["data_product"][0]["tittle"] . " - " . $namebrand . ' | Trumecs';
        $data["seokeywords"] = "jual sparepart truk,sparepart truk," . $str_keyword;
        $data["seodescription"] = sprintf($this->lang->line('seo_description', FALSE), $data["data_product"][0]["tittle"]);
        $data["seoimage"] = $file_exists;

        $data["breadcrumb"] = array_reverse($parent);
        $data["breadcrumb"][] =  $namecomponent;
        $data["breadcrumb"][] =  $namebrand;

        $data["namecategori"] = array(
            'brand' => $namebrand,
            'brandunit' => $namebrandunit,
            "type" => $nametype,
            "component" => $namecomponent,
            "parent" => $parent
        );


        $arrayname = explode(" ", trim($data["data_product"][0]["tittle"]) . " " . $namebrand . " " . $namecomponent);
        $data["sameproduct"] = $this->product_model->getsameproduct($arrayname, $productgalery, $data["data_product"][0]["brand_id"]);
        $data["relatedarticle"] = $this->article_model->getsameartikel(trim($data["data_product"][0]["tittle"]) . " " . $namebrand . " " . $namebrandunit . " " . $namecomponent . " " . $nametype);
        $data["discussion"] = $this->product_model->getdiscussion($data["data_product"][0]["id"]);

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/css/article_page.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css", base_url() . "asset/css/cari_page.css", "/modules/product/css/product.css", "/modules/product/css/view_product_2.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/slick/slick.min.js", "/modules/product/js/detail_product.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'view_product';
        } else {
            $data['content'] = 'view_product_mobile';
        }


        $this->load->view('front/template_front', $data);
    }

    private function getcategory($id)
    {
        $CATEGORY_ALL = unserialize(CATEGORY_ALL);
        $id_array =  array_search($id, array_column($CATEGORY_ALL, 'id'));
        return ($CATEGORY_ALL[$id_array]["name"]);
    }

    private function getparent($id)
    {
        $cat = array();
        $CATEGORY_ALL = unserialize(CATEGORY_ALL);
        $id_array = array_search($id, array_column($CATEGORY_ALL, 'id'));
        $id_parent = $CATEGORY_ALL[$id_array]["parent"];
        $id_array_parent = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));

        if ($id_array_parent == '') {
            return [];
        } else {
            $cat[] = $CATEGORY_ALL[$id_array_parent]["name"];
            if ($CATEGORY_ALL[$id_array_parent]["parent"] != 0) {
                $id_parent = $CATEGORY_ALL[$id_array_parent]["parent"];
                $id_array = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));
                $cat[] = $CATEGORY_ALL[$id_array]["name"];

                if ($CATEGORY_ALL[$id_array]["parent"] != 0) {
                    $id_parent = $CATEGORY_ALL[$id_array]["parent"];
                    $id_array_parent = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));
                    $cat[] = $CATEGORY_ALL[$id_array_parent]["name"];

                    if ($CATEGORY_ALL[$id_array_parent]["parent"] != 0) {
                        $id_parent = $CATEGORY_ALL[$id_array_parent]["parent"];
                        $id_array_parent = array_search($id_parent, array_column($CATEGORY_ALL, 'id'));
                        $cat[] = $CATEGORY_ALL[$id_array_parent]["name"];
                        //return ($CATEGORY_ALL[$id_array_parent]["name"]);
                        return $cat;
                    } else {
                        //return ($CATEGORY_ALL[$id_array_parent]["name"]);
                        return $cat;
                    }
                } else {
                    //return ($CATEGORY_ALL[$id_array_parent]["name"]);
                    return $cat;
                }
            } else {
                //return ($CATEGORY_ALL[$id_array_parent]["name"]);
                return $cat;
            }
        }



        //return $idparent;
    }

    public function contact($url)
    {
        $data["data_product"] = $this->product_model->getproduct($url);

        $productgalery = $data["data_product"][0]["id"];
        $data["galeryimg"] = $this->product_model->getgalery($productgalery);

        $namebrand = $this->getcategory($data["data_product"][0]["brand"]);
        $nametype = $this->getcategory($data["data_product"][0]["type"]);
        $namecomponent = $this->getcategory($data["data_product"][0]["component"]);

        $stringtitle = $data["data_product"][0]["tittle"];
        $stringtitle .= ($namebrand != "") ? " Merek " . $namebrand : "";
        $stringtitle .= ($nametype != "") ? " Type " . $nametype : "";
        $stringtitle .= ($namecomponent != "") ? " Komponen " . $namecomponent : "";


        $str_keyword = $data["data_product"][0]["tittle"];
        $str_keyword .= ($namebrand != "") ? ", " . $namebrand : "";
        $str_keyword .= ($nametype != "") ? ", " . $nametype : "";
        $str_keyword .= ($namecomponent != "") ? ", " . $namecomponent : "";

        $seo_desunit = ($data["data_product"][0]["unit"] != "") ? " per " . strtolower($data["data_product"][0]["unit"]) : '';
        $seo_desstok = ($data["data_product"][0]["stock"] != 0) ? ", tersedia " . $data["data_product"][0]["stock"] . " stok barang" : '';

        $file_exists = "public/image/product/" . $data["data_product"][0]["img"];
        if (!file_exists($file_exists)) {
            $file_exists = "public/image/logonew.png";
        }


        $data["seotitle"] = "Jual Sparepart " . $stringtitle . " - Trumecs.com";
        $data["seokeywords"] = "jual sparepart truk,sparepart truk," . $str_keyword;
        $data["seodescription"] = "Sparepart " . strtolower($stringtitle) . " di jual dengan harga murah Rp " . number_format($data["data_product"][0]["price"], 0, ',', '.') . $seo_desunit . $seo_desstok . ".";
        $data["seoimage"] = $file_exists;


        $data["breadcrumb"] =  array($namebrand, $nametype, $namecomponent);

        $data["namecategori"] = array(
            'brand' => $namebrand,
            "type" => $nametype,
            "component" => $namecomponent
        );
        $arrayname = explode(" ", $data["data_product"][0]["tittle"]);
        $data["sameproduct"] = $this->product_model->getsameproduct($arrayname, $productgalery);

        $data["css"] = array(base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css");
        $data["js"] = array(base_url() . "asset/js/jquery.elevateZoom.js", "/modules/product/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js");
        if (!$this->agent->is_mobile()) {
            $data['content'] = 'view_product';
        } else {
            $data['content'] = 'view_product_mobile';
        }

        $this->load->view('front/template_front', $data);
    }

    public function getsameproduct_ajax($product_id)
    {
        // Set header JSON
        header('Content-Type: application/json');

        // Load model
        $this->load->model("product_model");

        // Ambil produk utama
        $product = $this->product_model->getproduct_by_id($product_id);

        if (empty($product)) {
            echo json_encode([
                'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
            return;
        }

        // Ambil keyword dari produk saat ini
        $namebrand = $this->getcategory($product['brand']);
        $namecomponent = $this->getcategory($product['component']);

        $arrayname = explode(" ", trim($product["tittle"]) . " " . $namebrand . " " . $namecomponent);

        // Get same products
        $sameproducts = $this->product_model->getsameproduct($arrayname, $product_id, 50, $product['brand_id']);
        $data = [];
        $no = 0;

        foreach ($sameproducts as $prod) {
            $no++;
            $row = [
                $no,
                '<a href="' . base_url() . 'product/' . $prod["id"] . '/' . preg_replace(
                    "/[^a-zA-Z0-9]/",
                    "-",
                    ucwords(strtolower($prod["tittle"]))
                ) . '">' . $prod["tittle"] . '</a>',
                $prod["name"] ?? '-',
                $this->get_grade_text($prod["quality"]),
                'Rp ' . number_format($prod["price"], 0, ',', '.')
            ];
            $data[] = $row;
        }

        $output = [
            "draw" => $this->input->get('draw') ? intval($this->input->get('draw')) : 1,
            "recordsTotal" => count($sameproducts),
            "recordsFiltered" => count($sameproducts),
            "data" => $data
        ];

        echo json_encode($output);
    }

    private function get_grade_text($quality)
    {
        $grades = [
            1 => 'Asli',
            2 => 'Bekas',
            3 => 'Tiruan'
        ];
        return $grades[$quality] ?? '-';
    }

    // Tambahkan method helper untuk get single product

}
