<?php foreach ($data_page as $key) {
}



$lfp = strlen($key["img"]);
$ext = substr($key["img"], $lfp - 4);
is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
?>
<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0, "etc" => 0]); ?>
<div class="section breadcrumb" id="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="space40"></div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-x-0">
                        <li class="breadcrumb-item">
                            <a class="f12 forange text-decoration-none" href="<?php echo base_url() ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="f12 forange text-decoration-none" href="<?php echo base_url() ?>article">Artikel</a>
                        </li>
                    </ol>
                </nav>
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
                        <h4 class="fbold" itemprop="headline"><?php echo $key["title"]; ?></h4>
                        <div class="m-y-sm f12">
                            <i class="fa fa-calendar-o"></i>
                            <?php echo $this->dateformat->indonesia($key["date"]); ?>
                        </div>
                        <meta itemprop="url"
                            content="<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
                        <meta itemprop="width" content="800">
                        <meta itemprop="height" content="800">
                        <img alt="<?php echo $key["title"]; ?>" title="<?php echo $key["title"]; ?> - trumecs"
                            class="img-responsive"
                            src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=600&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo $key["img"] ?>"
                            style="max-height:500px;">
                    </div>
                </div>
                <div class="row m-y-md">
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
                        $first_position = ceil($total_paragraphs * 0.25);
                        $last_position = ceil($total_paragraphs * 0.75);

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

                            // POSISI 1/4 (25%)
                            if ($paragraph_count == $first_position && !empty($sameproduct)) {
                        ?>
                                <div class="card mt-3 mb-2 border-0">
                                    <div class="card-body p-3 rounded-3" style="background-color: #f8f9fa;">
                                        <div class="row g-3">
                                            <!-- Split Layout untuk 1/4 position -->
                                            <div class="col-5">
                                                <div class="d-flex flex-column h-100 justify-content-center">
                                                    <h6 class="fw-bold mb-2 fs-6 mb-1">Temukan berbagai macam barang di <a href="/" class="text-orange text-decoration-none">Trumecs.com</a></h6>
                                                    <div class="d-flex gap-2">
                                                        <?php
                                                        shuffle($kategori);
                                                        $random_categories = array_slice($kategori, 0, 2);
                                                        foreach ($random_categories as $category) :
                                                        ?>
                                                            <a href="<?php echo base_url(); ?>c/<?php echo $category['url'] ?>"
                                                                class="p-2 f10 text-white text-decoration-none rounded-3" style="background-color: green;">
                                                                <?= $category['name'] ?>
                                                            </a>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="d-flex gap-2 overflow-auto">
                                                    <?php foreach ($sameproduct as $product) : ?>
                                                        <div class="flex-shrink-0" style="width: 120px;">
                                                            <?php $this->load->view('article/product/mobile/_item_product_article_in.php', array('key' => $product, 'img_base_url' => 'https://trumecs.com/')); ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }

                            // POSISI TENGAH (50%)
                            if ($paragraph_count == $middle_position && !empty($sameproduct)) {
                            ?>
                                <div class="col-lg">
                                    <div class="p-1" style="background:#F6F6F7; border: 1px solid #eee;">
                                        <div class="p-4">
                                            <h3 class="fbold">MAINTENANCE</h3>
                                            <h6 class="fgray f14">Availability of your units is our priority</h6>
                                            <a href="#" data-google-tag="maintenance" style="width: fit-content;">Apply</a>
                                        </div>
                                        <img src="/public/landing/pic/maintenance.png" alt="maintenance" class="img-fluid w-100"></img>
                                    </div>
                                </div>
                            <?php
                            }

                            // POSISI 3/4 (75%)
                            if ($paragraph_count == $last_position && !empty($sameproduct)) {
                            ?>
                                <div class="col-lg">
                                    <div class="p-1 " style="background:#F6F6F7; border: 1px solid #eee;">
                                        <div class="content p-4">
                                            <h3 class="fbold">CONSTRUCTION</h3>
                                            <h6 class="fgray f14">Engineering, Construction and procurement</h6>
                                            <a href="#" data-google-tag="construction" style="width: fit-content;">Consult Now!</a>
                                        </div>
                                        <img src="/public/landing/pic/construction.png" alt="construction" class="img-fluid"></img>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body d-flex flex-column gap-3 p-3 article-list">
                                <div class="col-12">
                                    <p class="f20 fbold mb-0"><?= $this->lang->line('label_trending'); ?></p>
                                </div>
                                <?php foreach ($dataTrendingNews as $article) : ?>
                                    <a href="<?php echo base_url() ?>article/<?php echo $article['url'] ?>"
                                        class="text-decoration-none text-dark">
                                        <?= $this->load->view('_article_row_small', ['artikel' => $article]) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body d-flex flex-column gap-3 p-3 article-list">
                                <div class="col-12">
                                    <p class="f20 fbold mb-0"><?= $this->lang->line('artikel_terkait'); ?></p>
                                </div>
                                <?php foreach ($sameartikel as $same) : ?>
                                    <a href="<?php echo base_url() ?>article/<?php echo $same['url'] ?>"
                                        class="text-decoration-none text-dark">
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
        <div class="row flex-column gap-3 m-y-lg">
            <div class="col-12">
                <p class="f46 fbold mb-0">Tidak menemukan barang? kirim permintaan sekarang!</p>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <?= $this->load->view('bulk/mobile/form_v2') ?>
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
        <div class="row g-2">
            <?php foreach ($sameproduct as $product) : ?>
                <?php $this->load->view('article/product/mobile/_item_product_article_related.php', array('key' => $product, 'img_base_url' => 'https://trumecs.com/')); ?>
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