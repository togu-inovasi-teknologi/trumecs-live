<?php
defined('BASEPATH') or exit('No direct script access allowed');

class article extends MX_Controller
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model("article_model");
		$this->load->language("article");
		$this->load->model("c/c_model");
		$this->load->helper("text");
	}

	function _remap($param, $url)
	{
		$this->index($param);
	}
	public function index($url)
	{
		$content = ($url == NULL or $url == "index") ?
			($this->agent->is_mobile() ? "mobile/index" : "desktop/index")
			: ($this->agent->is_mobile() ? "mobile/view_article_mobile" : "desktop/view_article");

		if ($this->agent->is_mobile()) {
		} else {
			$data["promo_inseach_ver"] = $this->article_model->getpromo("prmvkl");
		}
		$data['items'] = array();
		if ($url == NULL or $url == "index") {
			$data["datasearch"] = array(
				'tittle' => '',
				'partnumber' => '',
				'physicnumber' => ''
			);
			$data["datasearchor_like"] = array(
				'tittle' => '',
				'partnumber' => '',
				'physicnumber' => ''
			);
			$data["datawhere"] = array(
				'year' => '',
				'promo' => '',
				'cucigudang' => ''
			);
			$data["listproduct"] = $this->c_model->fetch_product(10, 0, $data['datasearch'], $data['datasearchor_like'], $data['datawhere'], true);
			//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$actual_link = base_url('article');
			// $actual_link = strpos($actual_link, "&per_page");
			// $actual_link = strpos($actual_link, "?per_page");
			// $actual_link = preg_replace("/&per_page\=[0-999]+/", "", $actual_link); //substr($actual_link, 0,($search_perpage!=0) ? $search_perpage : strlen($actual_link) );
			$config["base_url"] = $actual_link;
			$config["total_rows"] = $this->article_model->record_count();
			$config["per_page"] = 10;
			$config["uri_segment"] = 2;
			$config["page_query_string"] = true;
			$config["query_string_segment"] = 'per_page';
			$config["reuse_query_string"] = true;

			// Bootstrap 5 Pagination Configuration
			$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
			$config['full_tag_close'] = '</ul></nav>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '</span></li>';
			$config['attributes'] = array('class' => 'page-link');

			// Custom labels
			$config['first_link'] = '&laquo; First';
			$config['last_link'] = 'Last &raquo;';
			$config['next_link'] = 'Next &rsaquo;';
			$config['prev_link'] = '&lsaquo; Prev';

			$this->pagination->initialize($config);
			$data["page"] = $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
			$data["data_page"] = $this->article_model->fetch($config["per_page"], $page);
			$data["data_page_main"] = $this->article_model->getnewartikelmain(5);
			$data["dataTrendingNews"] = $this->article_model->trendingNews(4, $page);
			$data["links"] = $this->pagination->create_links();
			$data["seotitle"] = $this->lang->line('seo_title_article') . ($page > 0 ? $this->lang->line('seo_title_article_page') . " " . ($page / 10 + 1) : '');
			$data["seodescription"] = $this->lang->line('seo_description_article');
		} else {
			//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$data["data_page"] = $this->article_model->getpage($url);
			if (empty($data["data_page"])) {
				redirect(base_url() . "article");
			}
			$this->load->model("product/product_model");
			foreach ($data["data_page"] as $key) {
			}

			$data['img_base_url'] = 'http://trumecs.com/';

			$page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
			$data["dataTrendingNews"] = $this->article_model->trendingNews(4, $page);
			$data["newartikel"] = $this->article_model->getnewartikel();

			$data["sameartikel"] = $this->article_model->getsameartikel($key["title"], $url);

			$data["seotitle"] = $key["title"];
			$data["seoimage"] = "timthumb?h=600&src=" . base_url() . "public/image/artikel/" . $key["img"];
			$data["seokeywords"] = $key["seo_key"];
			$data["seodescription"] = $key["discription_seo"];
			$data["sameproduct"] = $this->product_model->getsameproduct(explode(' ', $key["title"]), 1, 2);
			$data["sameproductdown"] = $this->product_model->getsameproduct(explode(' ', $key["title"]), 1);
		}
		$data['search_placeholder'] = $this->lang->line("placeholder_article", FALSE);
		if ($this->agent->is_mobile()) {
			$data["css"] = array(base_url() . 'asset/css/input_tag.css', "/modules/tab/css/tabs.css", "/modules/article/css/article.css", base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css", base_url() . 'asset/css/article_page.css', base_url() . 'asset/css/cari_page.css', "/modules/member/css/member.css");
			$data["js"] =  array("/modules/tab/js/tabs.js", '/modules/article/js/mobile/article_page.js', base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js", "/modules/bulk/js/bulk.js");
		} else {
			$data["css"] = array(base_url() . 'asset/css/input_tag.css', "/modules/tab/css/tabs.css", "/modules/article/css/article.css", base_url() . "asset/css/page_detail.css", base_url() . "asset/js/slick/slick.css", base_url() . "asset/js/slick/slick-theme.css", base_url() . 'asset/css/article_page.css', base_url() . 'asset/css/cari_page.css', "/modules/member/css/member.css");
			$data["js"] =  array("/modules/tab/js/tabs.js", '/modules/article/js/desktop/article_page.js', base_url() . "asset/js/jquery.elevateZoom.js", base_url() . "asset/js/detail_product.js", base_url() . "asset/js/slick/slick.min.js", "/modules/bulk/js/bulk.js");
		}
		$data['content'] = $content;
		$this->load->view('front/template_front', $data);
	}
}
