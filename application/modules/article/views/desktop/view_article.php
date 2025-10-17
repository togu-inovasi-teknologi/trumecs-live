<?php foreach ($data_page as $key) {
}



$lfp = strlen($key["img"]);
$ext = substr($key["img"], $lfp - 4);
is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
?>
<div class="section breadcrumb" id="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="space40"></div>
                <ol class="breadcrumb p-x-0">
                    <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
                    <li><a class="forange" href="<?php echo base_url() ?>article">Artikel</a></li>
                    <?php if (!empty($data_page)) : ?>
                    <li><?php echo $key["title"]; ?></li>
                    <?php endif ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="article-detail" id="article-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
                            itemid="<?php echo base_url() ?>article" />
                        <h1 class="fbold" itemprop="headline"><?php echo $key["title"]; ?></h1>
                        <div class="m-y-sm">
                            <i class="fa fa-calendar-o"></i>
                            <?php echo $this->dateformat->indonesia($key["date"]); ?>
                        </div>
                        <meta itemprop="url"
                            content="<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
                        <meta itemprop="width" content="800">
                        <meta itemprop="height" content="800">
                        <img alt="<?php echo $key["title"]; ?>" title="<?php echo $key["title"]; ?> - trumecs"
                            class="img-responsive"
                            src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=600&src=<?php echo isset($img_base_url) ? $img_base_url: base_url() ?>public/image/artikel/<?php echo $key["img"] ?>"
                            style="max-height:500px;">
                    </div>
                </div>
                <div class="row m-y-md">
                    <div class="col-lg-12">
                        <?php echo $key["value"] ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 sticky">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row d-flex flex-column gap-3 p-a-1 article-list">
                                <div class="col-lg-12">
                                    <p class="f20 fbold"><?= $this->lang->line('label_trending'); ?></p>
                                </div>
                                <?php foreach($dataTrendingNews as $article) : ?>
                                <a href="<?php echo base_url() ?>article/<?php echo $article['url'] ?>"
                                    class="color-black"><?= $this->load->view('_article_row_small', ['artikel' => $article]) ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row d-flex flex-column gap-3 p-a-1 article-list">
                                <div class="col-lg-12">
                                    <p class="f20 fbold"><?= $this->lang->line('artikel_terkait'); ?></p>
                                </div>
                                <?php foreach($sameartikel as $same) : ?>
                                <a href="<?php echo base_url() ?>article/<?php echo $same['url'] ?>"
                                    class="color-black"><?= $this->load->view('_article_row_small', ['artikel' => $same]) ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="request-form" id="request-form">
    <div class="container">
        <div class="row m-y-lg d-flex flex-column gap-3">
            <div class="col-lg-12">
                <p class="f46 fbold">Tidak menemukan barang? kirim permintaan sekarang!</p>
            </div>
            <div class="col-lg-12">
                <div class="card p-a-1">
                    <?php $this->load->view('tab/desktop/tabs') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-releated" id="product-releated">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-y-1">
                <?php $this->load->language("product"); ?>
                <h4 class="fbold"><?php echo $this->lang->line('judul_produk_terkait', FALSE); ?></h4>
            </div>
        </div>
        <div class="row slick-product-article">
            <?php foreach($sameproduct as $product) : ?>
            <?php $this->load->view('product/_item_product_home.php', array('key' => $product, 'img_base_url' => 'https://trumecs.com/')); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.hr-dashed {
    border-top: 2px dashed white;
}
</style>

<!-- <?php if ($this->agent->is_mobile()) : ?>
							<div class="col-lg-12 share">
								<?php echo $this->lang->line('label_bagikan'); ?> :
								<?php $share_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>
								<a class="sf btn btn-secondary" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.facebook.com/sharer.php?u=<?php echo $share_link ?>"><i class="fa fa-facebook-square"></i></a>
								<a class="st btn btn-secondary" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/intent/tweet?text=<?php echo ucwords($key["title"]) ?>&url=<?php echo $share_link ?>&hashtags=trumecs&original_referer=<?php echo $share_link ?>" data-size="large"><i class="fa fa-twitter-square"></i></a>
								<a class="sg btn btn-secondary" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=<?php echo $share_link ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus-square"></i></a>
								<a class="sl btn btn-secondary" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link ?>&title=<?php echo ucwords($key["title"]) ?>&summary=Sparepart truk <?php echo ucwords($key["title"]) ?>&source=trumecs.com"><i class="fa fa-linkedin-square"></i></a>
								<a class="sp btn btn-secondary" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://id.pinterest.com/pin/create/button/?url=<?php echo $share_link ?>&media=<?php echo base_url() ?>public/image/artikel/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png") ?>&description=<?php echo ucwords($key["title"]) ?>" data-pin-do="buttonBookmark" data-pin-shape="round"><i class="fa fa-pinterest-square"></i></a>
							</div>
						<?php endif ?> -->
<?php if (!$this->agent->is_mobile()) : ?>
<!-- <div class="col-lg-4 col-lg-6 col-sm-7 col-xs-7" style="float: right;">
							<div class="card panel-kotak panel-default">
							<div class="card-heading"><?php echo $this->lang->line('artikel_terkait') ?></div>
							
								<ul class="list-group">
								<?php foreach ($sameartikel as $sm) : ?>
								<li class="list-group-item"><a class="fblack" href="<?php echo base_url() ?>article/<?php echo $sm['url'] ?>"><?php echo $sm['title'] ?></a></li>
								<?php endforeach ?>
								</ul>
							
							</div>
						</div> -->
<?php endif ?>