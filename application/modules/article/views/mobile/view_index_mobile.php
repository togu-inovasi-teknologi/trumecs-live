<div id="article_page">
	<div class="news-container m-t-2 m-b-1">
		<ul>
			<li>
				Nikel <span style="color: green;">3.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
			</li>
			<li>
				Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
			</li>
			<li>
				seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
			</li>
			<li>
				Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
			</li>
			<li>
				seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
			</li>
			<li>
				Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
			</li>
			<li>
				seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
			</li>
			<li>
				Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
			</li>
			<li>
				seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
			</li>
		</ul>
	</div>
	<div class="row">
		<?php if ($page == 0) : ?>
			<div class="col-xs-12">
				<?php $this->load->view('_article_main_mobile') ?>
			</div>
			<div class="clearfix"></div>
			<div class="col-xs-12">
				<div class="row p-x-1">
					<?php $this->load->view('_article_submain_mobile') ?>
				</div>
			</div>
			<div class="clearfix m-b-1"></div>
			<div class="col-xs-12 m-b-1">
				<h3 class="fbold">Produk Trumecs</h3>
			</div>
			<div class="col-xs-12">
				<div class="listproduct p-y-0 slick-product-article-mobile">
					<?php
					$i = 1;
					foreach ($listproduct as $key) :
						$this->load->view('product/_item_product_home.php', array('key' => $key));
					endforeach; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-xs-12 m-b-2">
				<img src="<?php echo base_url() ?>public/banner/iklan.png" style="width:100%; height:70px;" />
			</div>
			<div class="clearfix"></div>
		<?php endif; ?>
		<div class="col-xs-12">
			<h4 class="fbold">Latest News</h4>
			<!-- <div class="row">
				<div class="col-xs-12 slickareatagartikel">
					<a class="label label-article f12 border m-x-1">#Promo</a>
					<a class="label label-article f12 border m-x-1">#Baru</a>
					<a class="label label-article f12 border m-x-1">#Keren</a>
					<a class="label label-article f12 border m-x-1">#Murah</a>
					<a class="label label-article f12 border m-x-1">#Murah</a>
					<a class="label label-article f12 border m-x-1">#Murah</a>
				</div>
			</div> -->
		</div>
		<div class="clearfix m-b-1"></div>
		<div class="col-xs-12 listarticle">
			<?php
			unset($data_page[0]);
			unset($data_page[1]);
			unset($data_page[2]);
			$this->load->view("_article_horizontal_mobile", array('data_page' => $data_page)) ?>
		</div>
		<div class="col-xs-12 text-center">
			<?php echo $links ?>
		</div>
		<div class="col-md-3">
			<?php
			if ($this->agent->is_mobile()) {
			} else {
				if ($promo_inseach_ver) :
			?>
					<div class="card p-b-1 promo">
						<?php $this->load->view("_promovertical") ?>
					</div>
			<?php endif;
			} ?>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-md-6 listarticle">
			<?php foreach ($data_page as $key) : ?>
				<?php
				$lfp = strlen($key["img"]);
				$ext = substr($key["img"], $lfp - 4);
				is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
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
						<small class="text-muted"><i class="fa fa-calendar-o"></i> <span class="text-muted sans"><?php echo $this->dateformat->indonesia($key["date"]); ?></span></small>
						|
						<small class="text-muted"><i class="fa fa-user"></i> <a rel="author" href="https://plus.google.com/+TrumecsTrisindo" itemprop="author" itemscope itemtype="https://schema.org/Person"><span class=" sans text-muted" itemprop="name">Trumecs.com</span></a></small>
						|
						<small class="text-muted"><i class="fa fa-eye"></i> <span class=" sans text-muted"><?php echo $key["view"]; ?> <?php echo $this->lang->line('jumlah_dilihat'); ?></span></small>
						<div class="descrip m-t-1 f16">
							<?php if ($key["discription_seo"] == "") : ?>
								<?php
								preg_match("/<p>(.*)<\/p>/", $key['value'], $matches);
								$intro = strip_tags($matches[1]);
								echo substr($intro, 0, 160);
								?>
							<?php else : ?>
								<?php echo $key["discription_seo"] ?>
							<?php endif ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<div class="col-md-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-md-3 listarticle">
			<?php foreach ($data_page as $key) : ?>
				<?php
				$lfp = strlen($key["img"]);
				$ext = substr($key["img"], $lfp - 4);
				is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
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
						<small class="text-muted"><i class="fa fa-calendar-o"></i> <span class="text-muted sans"><?php echo $this->dateformat->indonesia($key["date"]); ?></span></small>
						|
						<small class="text-muted"><i class="fa fa-user"></i> <a rel="author" href="https://plus.google.com/+TrumecsTrisindo" itemprop="author" itemscope itemtype="https://schema.org/Person"><span class=" sans text-muted" itemprop="name">Trumecs.com</span></a></small>
						|
						<small class="text-muted"><i class="fa fa-eye"></i> <span class=" sans text-muted"><?php echo $key["view"]; ?> <?php echo $this->lang->line('jumlah_dilihat'); ?></span></small>
						<div class="descrip m-t-1 f16">
							<?php if ($key["discription_seo"] == "") : ?>
								<?php
								preg_match("/<p>(.*)<\/p>/", $key['value'], $matches);
								$intro = strip_tags($matches[1]);
								echo substr($intro, 0, 160);
								?>
							<?php else : ?>
								<?php echo $key["discription_seo"] ?>
							<?php endif ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<div class="col-md-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-md-3 listarticle">
			<?php foreach ($data_page as $key) : ?>
				<?php
				$lfp = strlen($key["img"]);
				$ext = substr($key["img"], $lfp - 4);
				is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
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
						<small class="text-muted"><i class="fa fa-calendar-o"></i> <span class="text-muted sans"><?php echo $this->dateformat->indonesia($key["date"]); ?></span></small>
						|
						<small class="text-muted"><i class="fa fa-user"></i> <a rel="author" href="https://plus.google.com/+TrumecsTrisindo" itemprop="author" itemscope itemtype="https://schema.org/Person"><span class=" sans text-muted" itemprop="name">Trumecs.com</span></a></small>
						|
						<small class="text-muted"><i class="fa fa-eye"></i> <span class=" sans text-muted"><?php echo $key["view"]; ?> <?php echo $this->lang->line('jumlah_dilihat'); ?></span></small>
						<div class="descrip m-t-1 f16">
							<?php if ($key["discription_seo"] == "") : ?>
								<?php
								preg_match("/<p>(.*)<\/p>/", $key['value'], $matches);
								$intro = strip_tags($matches[1]);
								echo substr($intro, 0, 160);
								?>
							<?php else : ?>
								<?php echo $key["discription_seo"] ?>
							<?php endif ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<div class="col-md-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-md-3">
			<?php
			if ($this->agent->is_mobile()) {
			} else {
				if ($promo_inseach_ver) :
			?>
					<div class="card p-b-1 promo">
						<?php $this->load->view("_promovertical") ?>
					</div>
			<?php endif;
			} ?>
		</div>
	</div> -->
</div>
<style>
	.hr-dashed {
		border-top: 2px dashed white;
	}

	.label-article {
		font-size: 12px !important;
		color: black;
		background-color: #fff;
		padding: 10px;
		border-width: 0.2px;
		border-style: solid;
		border-color: grey;
		border-radius: 10px;
	}

	.news-container {
		background-color: #fff;
		top: 0;
		left: 0;
		right: 0;
		font-family: "Poppins", sans-serif;
		box-shadow: 0 4px 8px -4px rgba(0, 0, 0, 0.3);
		overflow: hidden;
		border: 0.5px solid #ccc;
	}

	.news-container ul {
		display: flex;
		list-style: none;
		margin: 0;
		animation: scroll 15s infinite linear;
	}

	.news-container ul li {
		white-space: nowrap;
		padding: 10px 24px;
		color: #494949;
		position: relative;
	}

	.news-container ul li::after {
		content: "";
		width: 1px;
		height: 100%;
		background: #b8b8b8;
		position: absolute;
		top: 0;
		right: 0;
	}

	.news-container ul li:last-child::after {
		display: none;
	}

	@keyframes scroll {
		from {
			transform: translateX(100%);
		}

		to {
			transform: translateX(-150%);

		}
	}
</style>