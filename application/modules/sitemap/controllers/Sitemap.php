<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends MX_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("sitemap_model");
    }
/*    function _remap($param) {
        //$this->index($param);
        //$this->all();
    }*/
	public function filter()
	{
		$this->load->helper('xml');
		$category = $this->uri->segment(3);
		$initial="";
		$mobile="m/";
		switch ($category) {
			case 'product.xml':
				$initial="product";
				$variable = $this->sitemap_model->getproduct();
				$in_name="tittle";
				$changefreq="daily";
				break;
			case 'page.xml':
				$initial="page";
				$in_name="title";
				$changefreq="monthly";
				$variable = $this->sitemap_model->getpage();
				break;
			case 'article.xml':
				$initial="article";
				$in_name="title";
				$changefreq="monthly";
				$variable = $this->sitemap_model->getartikel();
				break;
			case 'promo.xml':
				$initial="promo";
				$in_name="name";
				$changefreq="weekly";
				$variable = $this->sitemap_model->getpromo();
				break;
			default:
				break;
		}
		$lastmod = date('Y-m-d',strtotime("-3 days"))."T18:00:15+00:00";
		header('Content-type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>
				<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0">';
		if (!empty($variable)) {
			foreach ($variable as $key) {
				//detail?id='.$key["id"].'&nama='.$key["id"].'
				if ($initial=="promo") {
					echo '<url><loc>'.base_url().$initial.'/'.$key["url"].'</loc>';
				}else{
					echo '<url><loc>'.base_url().$initial.'/'.$key["id"].'/'.str_replace(" ", "-", strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $key[$in_name]))).'</loc>';
				}
	    		echo '<lastmod>'.$lastmod.'</lastmod>';
	    		if ($key["img"]!="" AND $initial=="product") {
	    			echo '
	    			<image:image><image:loc>'.base_url().'public/image/product/'.$key["img"].'</image:loc>
					    <image:title>'.$key[$in_name].'</image:title>
					    <image:license>'.base_url().'</image:license>
					</image:image>
	    			';//<image:caption>Produk Trumecs '.$key[$in_name].' dijual dengan harga Rp.'.number_format($key["price"]).'</image:caption>
	    		}
	    		echo "<changefreq>".$changefreq."</changefreq>";
	    		echo "<priority>0.8</priority>";
	    		echo '</url>';
	    		if ($initial=="promo") {
					echo '<url><loc>http://mobile.trumecs.com/'.$initial.'/'.$key["url"].'</loc>';
				}else{
	    			echo '<url><loc>http://mobile.trumecs.com/'.$initial.'/'.$key["id"].'/'.str_replace(" ", "-", strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $key[$in_name]))).'</loc>';
	    		}
	    		echo '<lastmod>'.$lastmod.'</lastmod>';
	    		echo "<mobile:mobile/>";
	    		echo "<changefreq>".$changefreq."</changefreq>";
	    		echo "<priority>0.8</priority>";
	    		echo '</url>';
			}
		}
		echo '</urlset>';
	}

	public function index()
	{
		header('Content-type: text/xml');
		$lastmod = date('Y-m-d',strtotime("-3 days"))."T18:00:15+00:00";
		$sitemap = array('product' ,'article','page',"promo");
		echo '<?xml version="1.0" encoding="UTF-8"?>
				<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84">';
		  foreach ($sitemap as $key) {
		   	echo '<sitemap>
		   			<loc>'.base_url().'sitemap/filter/'.$key.'.xml</loc>
			      	<lastmod>'.$lastmod.'</lastmod>
			    </sitemap>';
		   }
		echo '</sitemapindex>';
	}

	public function testimg()
	{
		echo '<img src="'.base_url().'timthumb?src='.base_url().'public/image/bg2.jpg&w=500&h=500" >';
	}

}