

<div id="article_page">
	<div class="row">
		<div class="col-lg-12">
		<?php if (!$this->agent->is_mobile()): ?><div class="space40"></div><?php endif ?>
	    <?php if ($this->agent->is_mobile()): ?><div class="row"><?php endif ?>
	    <?php if (!$this->agent->is_mobile()): ?>
	    	<ol class="breadcrumb ">
		    	<li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
		    	<li>Artikel</li>
		    </ol>
		<?php endif ?>
	    <?php if ($this->agent->is_mobile()): ?></div><?php endif ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9 listarticle">
			<?php $i=1;foreach ($data_page as $key ): ?>
			<?php 
			$lfp=strlen($key["img"]);
		    $ext=substr($key["img"], $lfp-4);
			is_file("public/image/artikel/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
			 ?>
				<div class="col-md-12 p-a-0 m-b-1" style="background:#fff;border-radius:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
					<div class="col-md-4 p-a-0">
						<a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>">
						<div class="text-center">
							<img class="img-center-product" style="object-fit: cover;width:100%;height:200px" src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
						</div>
						</a>
					</div>
					<div class="col-md-8 p-y-1">
						<h5 class="fbold article-title"><a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>"><?php echo $key["title"] ?></a></h5>
						<small class="text-muted"><i class="fa fa-calendar-o"></i> <span class="text-muted sans"><?php echo $this->dateformat->indonesia($key["date"]);?></span></small>
						| 
						<small class="text-muted"><i class="fa fa-user"></i> <a rel="author" href="https://plus.google.com/+TrumecsTrisindo"  itemprop="author" itemscope itemtype="https://schema.org/Person"><span class=" sans text-muted" itemprop="name">Trumecs.com</span></a></small>
						|
						<small class="text-muted"><i class="fa fa-eye"></i> <span class=" sans text-muted"><?php echo $key["view"];?> <?php echo $this->lang->line('jumlah_dilihat'); ?></span></small>
						<div class="descrip m-t-1 f16">
							<?php if ($key["discription_seo"]==""): ?>
								<?php 
								preg_match("/<p>(.*)<\/p>/",$key['value'],$matches);
								$intro = strip_tags($matches[1]);
								echo substr($intro, 0,160);
								 ?>
							<?php else: ?>
								<?php echo $key["discription_seo"] ?>
							<?php endif ?>
						</div>
					</div>
				</div>
				<?php if($i%3==0 && $i != 9):?>
				<div class="col-md-12 p-a-0 m-b-1" style="background:#fff;border-radius:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
				<?php if(!$this->agent->is_mobile()): ?>
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8875911463210576"
                     crossorigin="anonymous"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-format="fluid"
                     data-ad-layout-key="-fd-19+5z-4l+mz"
                     data-ad-client="ca-pub-8875911463210576"
                     data-ad-slot="4089239775"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
				<?php else: ?>
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8875911463210576"
                     crossorigin="anonymous"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-format="fluid"
                     data-ad-layout-key="-5m+c9-1m-7g+ue"
                     data-ad-client="ca-pub-8875911463210576"
                     data-ad-slot="9927109565"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
				<?php endif; ?>
				</div>
				<?php endif; ?>
			<?php $i++;endforeach ?>
			<div class="col-md-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-md-3">
			<?php 
				if ($this->agent->is_mobile()){

				}else{
					if($promo_inseach_ver):
					?>
				<div class="card p-b-1 promo">
	        		<?php $this->load->view("_promovertical") ?>
				</div>
					<?php endif;}?>


		</div>
	</div>
</div>