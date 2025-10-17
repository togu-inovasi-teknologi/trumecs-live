<div id="article_page">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb p-x-0">
                <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
                <li>Artikel</li>
            </ol>
        </div>
    </div>
    <?php if ($this->uri->segment(2) == '?') { ?>
    <?php } else { ?>
    <div class="news-container">
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
    <?php } ?>
    <div class="row m-t-1">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <?php if ($page == 0) : ?>
                        <div class="col-lg-8">
                            <?php $this->load->view('_article_main', ['img_base_url' => 'http://trumecs.com/']) ?>
                        </div>
                        <div class="col-lg-4">
                            <?php $this->load->view('_article_submain', ['img_base_url' => 'http://trumecs.com/']) ?>
                        </div>
                        <div class="col-lg-12 m-b-2">
                            <img src="<?php echo base_url() ?>public/banner/iklan.png" width="100%" />
                        </div>
                        <div class="col-lg-12 m-b-1">
                            <h3 class="fbold">Produk Trumecs</h3>
                        </div>
                        <div class="col-lg-12">
                            <div class="row listproduct p-y-0 slick-product-article">
                                <?php
									$i = 1;
									foreach ($listproduct as $key) :
										$this->load->view('product/_item_product_home.php', array('key' => $key));
									endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="sticky col-lg-3">
                                    <img src="<?php echo base_url() ?>public/banner/iklan/iklan-6.jpeg" width="100%" />
                                    <img class="m-t-1" src="<?php echo base_url() ?>public/banner/iklan/iklan-4.jpeg"
                                        width="100%" />
                                </div>
                                <div class="col-lg-9 listarticle">
                                    <div class="row m-b-1">
                                        <div class="col-lg-12">
                                            <h3 class="fbold">Latest News</h3>
                                        </div>
                                        <!-- <div class="col-lg-12 p-a-1">
											<a class="label label-article f16 border">#Promo</a>
											<a class="label label-article f16 border">#Baru</a>
											<a class="label label-article f16 border">#Keren</a>
											<a class="label label-article f16 border">#Murah</a>
										</div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
											unset($data_page[0]);
											unset($data_page[1]);
											unset($data_page[2]);
											$this->load->view("_article_horizontal", array('data_page' => $data_page)) ?>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <?php echo $links ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 listarticle sticky">
                    <div class="card p-a-1" style="background-color: black; color:#fff;">
                        <h5 class="fbold"><i class="fa fa-line-chart" aria-hidden="true"></i> Trending News</h5>
                        <br>
                        <?php $i = 1;
						foreach ($dataTrendingNews as $key) : ?>
                        <a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>" class="f16 fbold"
                            style="color: #fff;"><?php echo $key["title"] ?></a>
                        <?php if ($i != 4) { ?>
                        <hr class="hr-dashed">
                        <?php } ?>
                        <?php $i++;
						endforeach ?>
                    </div>
                    <img src="<?php echo base_url() ?>public/banner/iklan/iklan-5.jpeg" width="100%" />
                    <img class="m-t-1" src="<?php echo base_url() ?>public/banner/iklan/iklan-3.jpeg" width="100%" />
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-3">
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
		</div> -->
    </div>
    <!-- <div class="row">
		<div class="col-lg-6 listarticle">
			<?php foreach ($data_page as $key) : ?>
				<?php
				$lfp = strlen($key["img"]);
				$ext = substr($key["img"], $lfp - 4);
				is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
				?>
				<div class="col-lg-12 p-a-0 m-b-1" style="background:#fff;border-radius:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
					<div class="col-lg-4 p-a-0">
						<a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>">
							<div class="text-center">
								<img class="img-center-product" style="object-fit: cover;width:100%;height:200px" src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
							</div>
						</a>
					</div>
					<div class="col-lg-8 p-y-1">
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
			<div class="col-lg-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-lg-3 listarticle">
			<?php foreach ($data_page as $key) : ?>
				<?php
				$lfp = strlen($key["img"]);
				$ext = substr($key["img"], $lfp - 4);
				is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
				?>
				<div class="col-lg-12 p-a-0 m-b-1" style="background:#fff;border-radius:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
					<div class="col-lg-4 p-a-0">
						<a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>">
							<div class="text-center">
								<img class="img-center-product" style="object-fit: cover;width:100%;height:200px" src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
							</div>
						</a>
					</div>
					<div class="col-lg-8 p-y-1">
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
			<div class="col-lg-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-lg-3 listarticle">
			<?php foreach ($data_page as $key) : ?>
				<?php
				$lfp = strlen($key["img"]);
				$ext = substr($key["img"], $lfp - 4);
				is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
				?>
				<div class="col-lg-12 p-a-0 m-b-1" style="background:#fff;border-radius:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
					<div class="col-lg-4 p-a-0">
						<a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>">
							<div class="text-center">
								<img class="img-center-product" style="object-fit: cover;width:100%;height:200px" src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
							</div>
						</a>
					</div>
					<div class="col-lg-8 p-y-1">
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
			<div class="col-lg-12">
				<?php echo $links ?>
			</div>
		</div>
		<div class="col-lg-3">
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
    font-size: 16px !important;
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
    animation: scroll 25s infinite linear;
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
        transform: translateX(-120%);

    }
}
</style>