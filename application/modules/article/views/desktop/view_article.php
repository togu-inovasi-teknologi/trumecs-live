<?php foreach ($data_page as $key) {
}

$lfp = strlen($key["img"]);
$ext = substr($key["img"], $lfp - 4);
is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];

?>
<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0, "etc" => 0]); ?>

<div class="section breadcrumb bg-light py-3" id="breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-orange text-decoration-none" href="<?php echo base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a class="text-orange text-decoration-none" href="<?php echo base_url() ?>article">Artikel</a></li>
                <?php if (!empty($data_page)) : ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $key["title"]; ?></li>
                <?php endif ?>
            </ol>
        </nav>
    </div>
</div>

<section class="article-detail" id="article-detail">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php echo base_url() ?>article" />

                        <h1 class="h2 fw-bold mb-3" itemprop="headline"><?php echo $key["title"]; ?></h1>

                        <div class="d-flex align-items-center text-muted mb-4">
                            <i class="fas fa-calendar me-2"></i>
                            <span><?php echo $this->dateformat->indonesia($key["date"]); ?></span>
                        </div>

                        <div class="article-image mb-4">
                            <meta itemprop="url" content="<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
                            <meta itemprop="width" content="800">
                            <meta itemprop="height" content="800">
                            <img alt="<?php echo $key["title"]; ?>" title="<?php echo $key["title"]; ?> - trumecs"
                                class="img-fluid rounded-3 w-100"
                                src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=600&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo $key["img"] ?>"
                                style="max-height: 500px; object-fit: cover;">
                        </div>

                        <div class="article-content">
                            <?php
                            $full = explode("</p>", $key["value"]);
                            $paragraph_count = 0;

                            // Filter hanya paragraf yang tidak kosong
                            $non_empty_paragraphs = array_filter($full, function ($item) {
                                $clean = trim(strip_tags($item));
                                $clean = preg_replace('/&nbsp;/', ' ', $clean);
                                $clean = preg_replace('/[\t\n\r\0\x0B]/', '', $clean);
                                $clean = preg_replace('/([\s])\1+/', '', $clean);
                                return !empty($clean);
                            });

                            $total_paragraphs = count($non_empty_paragraphs);
                            $middle_position = ceil($total_paragraphs / 2);

                            foreach ($full as $item) {
                                $clean = trim(strip_tags($item));
                                $clean = preg_replace('/&nbsp;/', ' ', $clean);
                                $clean = preg_replace('/[\t\n\r\0\x0B]/', '', $clean);
                                $clean = preg_replace('/([\s])\1+/', '', $clean);

                                if (empty($clean)) {
                                    echo $item . "</p>";
                                    continue;
                                }

                                $paragraph_count++;

                                echo $item . "</p>";
                                if ($paragraph_count == $middle_position && !empty($sameproduct)) {
                            ?>
                                    <div class="card rounded-4 shadow mt-2 mb-4">
                                        <div class="card-body p-0">
                                            <div class="row g-0">
                                                <!-- Section Kiri: Teks dan Kategori -->
                                                <div class="col-md-4 bg-light p-4">
                                                    <div class="d-flex flex-column h-100 justify-content-center">
                                                        <div>
                                                            <h4 class="card-title fw-bold mb-3">Temukan berbagai macam barang di <a href="/" class="text-orange">Trumecs.com</a></h3>
                                                                <?php
                                                                shuffle($kategori);
                                                                $random_categories = array_slice($kategori, 0, 2);
                                                                foreach ($random_categories as $category) :
                                                                ?>
                                                                    <a href="<?php echo base_url(); ?>c/<?php echo $category['url'] ?>" class="btn btn-sm btn-success">
                                                                        <?= $category['name'] ?>
                                                                    </a>
                                                                <?php endforeach ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 bg-light p-4">
                                                    <div class="position-relative">
                                                        <div class="d-flex gap-3 overflow-auto">
                                                            <?php foreach ($sameproduct as $product) : ?>
                                                                <div class="flex-shrink-0" style="width: 180px;">
                                                                    <?php $this->load->view('product/_item_product_article_in.php', array('key' => $product, 'img_base_url' => 'https://trumecs.com/')); ?>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>


                        <?php if ($this->agent->is_mobile()) : ?>
                            <div class="share-buttons mt-4 pt-4 border-top">
                                <span class="fw-semibold me-3"><?php echo $this->lang->line('label_bagikan'); ?> :</span>
                                <?php $share_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-outline-primary btn-sm" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.facebook.com/sharer.php?u=<?php echo $share_link ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a class="btn btn-outline-info btn-sm" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/intent/tweet?text=<?php echo ucwords($key["title"]) ?>&url=<?php echo $share_link ?>&hashtags=trumecs&original_referer=<?php echo $share_link ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link ?>&title=<?php echo ucwords($key["title"]) ?>&summary=Sparepart truk <?php echo ucwords($key["title"]) ?>&source=trumecs.com">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a class="btn btn-outline-dark btn-sm" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://id.pinterest.com/pin/create/button/?url=<?php echo $share_link ?>&media=<?php echo base_url() ?>public/image/artikel/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png") ?>&description=<?php echo ucwords($key["title"]) ?>">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0"><?= $this->lang->line('label_trending'); ?></h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="vstack gap-3">
                                <?php foreach ($dataTrendingNews as $article) : ?>
                                    <a href="<?php echo base_url() ?>article/<?php echo $article['url'] ?>" class="text-decoration-none text-dark">
                                        <?= $this->load->view('_article_row_small', ['artikel' => $article]) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0"><?= $this->lang->line('artikel_terkait'); ?></h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="vstack gap-3">
                                <?php foreach ($sameartikel as $same) : ?>
                                    <a href="<?php echo base_url() ?>article/<?php echo $same['url'] ?>" class="text-decoration-none text-dark">
                                        <?= $this->load->view('_article_row_small', ['artikel' => $same]) ?>
                                    </a>
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
                <h3 class="fw-bold">Tidak menemukan barang? kirim permintaan sekarang!</h3>
            </div>
            <div class="col-lg-12">
                <div class="card p-a-1">
                    <?php $this->load->view('tab/desktop/tabs') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-related py-5" id="product-related">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12">
                <?php $this->load->language("product"); ?>
                <h3 class="fw-bold"><?php echo $this->lang->line('judul_produk_terkait', FALSE); ?></h3>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($sameproductdown as $product) : ?>
                <?php $this->load->view('product/_item_product_home.php', array('key' => $product, 'img_base_url' => 'https://trumecs.com/')); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php if (!$this->agent->is_mobile()) : ?>
    <!-- Desktop specific content can go here -->
<?php endif ?>

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