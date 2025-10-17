<?php foreach ($data_page as $key ) {}
$lfp=strlen($key["img"]);
    $ext=substr($key["img"], $lfp-4);
is_file("public/image/artikel/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
 ?>
<div id="article_page">
	<div class="row">
		<div class="col-lg-12">
		
		<div class="row nopt" >
			<div class="col-xs-12 p-x-0 p-b-2 content-artikel" itemscope itemtype="http://schema.org/Article" style="background:#fff">
				<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo base_url() ?>article"/>
				<div class="<?php echo (!$this->agent->is_mobile()) ? "" : "" ; ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				    <meta itemprop="url" content="<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
				    <meta itemprop="width" content="800">
				    <meta itemprop="height" content="800">
					<img alt="<?php echo $key["title"]; ?>" title="<?php echo $key["title"]; ?> - trumecs" class="m-a-0 img-responsive" src="<?php echo base_url() ?>timthumb?h=600&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
				</div>
				<h1 class="f18 nopt nomt fbold p-x-1 m-t-1"  itemprop="headline"><?php echo $key["title"]; ?></h1>
				<div>
					<div class="col-xs-12 info-artikel">
						<?php  $DateTime = new DateTime($key["date"]); ?>
						<meta itemprop="datePublished" content="<?php echo date_format($DateTime, 'Y-m-d') ?>T08:00:00+08:00"/>
						<meta itemprop="dateModified" content="<?php echo date_format($DateTime, 'Y-m-d') ?>T08:00:00+08:00"/>
						<small><i class="fa fa-calendar-o"></i> <i class=" sans fblack"><?php echo $this->dateformat->indonesia($key["date"]);?></i></small>
						| 
						<small><i class="fa fa-user"></i> <a rel="author" href="https://plus.google.com/+TrumecsTrisindo"  itemprop="author" itemscope itemtype="https://schema.org/Person"><i class=" sans fblack" itemprop="name">Trumecs.com</i></a></small>
						  <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
						    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						      <meta itemprop="url" content="https://lh3.googleusercontent.com/-52TG6IUy8h4/AAAAAAAAAAI/AAAAAAAAADc/zlczy9PeMZU/s60-p-rw-no/photo.jpg">
						      <meta itemprop="width" content="60">
						      <meta itemprop="height" content="60">
						    </div>
						    <meta itemprop="name" content="Trumecs.com">
						  </div>
					</div>
					<div class="clearfix"></div>
					<hr class="nomt ">
				</div>
				<div class="content-artikel-text p-x-1">
					<?php 
						$paragraph = explode("</p>", $key["value"]);
						$i = 0;
						foreach($paragraph as $value):
						    $length = strlen(trim(preg_replace('/\s{2,}/u', '', strip_tags(html_entity_decode($value)))));
						    echo $length > 0 ? $value."</p>" : "";
						    if($length >= 200){
						       $i++; 
						    }
						    if($i%2 == 0 && $length >= 200){
						        echo '<div class="clearfix"></div><div class="col-xs-12 m-x-1 m-t-2 m-b-2"><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8875911463210576"
                                             crossorigin="anonymous"></script>
                                        <ins class="adsbygoogle"
                                             style="display:block; text-align:center;"
                                             data-ad-layout="in-article"
                                             data-ad-format="fluid"
                                             data-ad-client="ca-pub-8875911463210576"
                                             data-ad-slot="7819820972"></ins>
                                        <script>
                                             (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script></div><div class="clearfix"></div>';
                                        $i = 0;
						    }
						    
						    
						endforeach;
						?>
					<div class="clearfix"></div>
				</div>
				<?php if ($this->agent->is_mobile()): ?>
					<div class="col-lg-12 share">
						<?php echo $this->lang->line('label_bagikan'); ?> :
						<?php $share_link= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>
						<a class="sf btn btn-secondary" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.facebook.com/sharer.php?u=<?php echo $share_link ?>"><i class="fa fa-facebook-square"></i></a>
						<a class="st btn btn-secondary"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/intent/tweet?text=<?php echo ucwords($key["title"]) ?>&url=<?php echo $share_link ?>&hashtags=trumecs&original_referer=<?php echo $share_link ?>" data-size="large"><i class="fa fa-twitter-square"></i></a>
						<a class="sg btn btn-secondary"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=<?php echo $share_link ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus-square"></i></a>
						<a class="sl btn btn-secondary"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link ?>&title=<?php echo ucwords($key["title"]) ?>&summary=Sparepart truk <?php echo ucwords($key["title"]) ?>&source=trumecs.com"><i class="fa fa-linkedin-square"></i></a>
						<a class="sp btn btn-secondary"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://id.pinterest.com/pin/create/button/?url=<?php echo $share_link ?>&media=<?php echo base_url() ?>public/image/artikel/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>&description=<?php echo ucwords($key["title"]) ?>" data-pin-do="buttonBookmark"  data-pin-shape="round"><i class="fa fa-pinterest-square"></i></a>
					</div>
				<?php endif ?>
			</div>
			<?php if ($this->agent->is_mobile()): ?>
			<hr>
			<div class="clearfix"></div>
			<div class="col-xs-12 p-a-0 m-t-3">
				<h5 class="p-x-1 m-b-2">Artikel terkait</h5>
				<?php echo $this->load->view('article/_same_article', array('article'=>$sameartikel)); ?>
			</div>
			<?php endif ?>
			<div class="clearfix"></div>
			<div class="col-xs-12  p-a-0 m-t-3">
				<h5 class="p-x-1 m-b-2"><?php echo $this->lang->line('artikel_terbaru'); ?></h5>
				<?php echo $this->load->view('article/_same_article', array('article'=>$newartikel)); ?>
			</div>
		</div>
	</div>
	</div>
</div>

