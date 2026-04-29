<?php foreach ($data_product as $key) {
}
foreach ($this->cart->contents() as $cart_key) :
    if ($cart_key['id'] == $key['id']) {
        break;
    } else {
        $cart_key = array(
            'method' => 'cbd',
            'qty' => 1,
        );
    }
endforeach;
$lfp = strlen($key["img"]);
$ext = substr($key["img"], $lfp - 4);
is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "--" : $key["img"];
$img_promo = '<img class="labelimg d-none d-sm-block" src="' . base_url() . '/public/image/promo_specialoffer.png" width="120">';

?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .swiper {
        width: auto;
        height: 100%;
        margin: 0px -15px;
        max-height: 375px;
        border-bottom: 1px solid #ccc;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        height: 375px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 375px;
        max-width: 100%;
        max-height: 100%;
        vertical-align: middle;
    }

    .blinking {
        animation: blinkingText 1.2s infinite;
    }

    @keyframes blinkingText {
        0% {
            color: #000;
        }

        49% {
            color: #000;
        }

        60% {
            color: transparent;
        }

        99% {
            color: transparent;
        }

        100% {
            color: #000;
        }
    }

    .cod-button.active,
    .cbd-button.active {
        background: #fa8420;
        color: #fff !important;
    }

    .ticket {
        position: relative;
        box-sizing: border-box;
        width: auto;
        margin: 15px auto 15px;
        padding: 10px;
        border-radius: 10px;
        background: #FBFBFB;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    }

    .ticket-active {
        background: #fa8420;
        color: #fff;
    }

    .ticket.ticket-active:before {
        top: -5px;
        background: radial-gradient(circle, transparent, transparent 50%, #fa8420 50%, #fa8420 100%) -7px -8px/16px 16px repeat-x;
    }

    .ticket.ticket-active:after {
        bottom: -5px;
        background: radial-gradient(circle, transparent, transparent 50%, #fa8420 50%, #fa8420 100%) -7px -2px/16px 16px repeat-x;
    }

    .ticket:before,
    .ticket:after {
        content: "";
        position: absolute;
        left: 5px;
        height: 6px;
        width: 95%;
    }

    .ticket:before {
        top: -5px;
        background: radial-gradient(circle, transparent, transparent 50%, #FBFBFB 50%, #FBFBFB 100%) -7px -8px/16px 16px repeat-x;
    }

    .ticket:after {
        bottom: -5px;
        background: radial-gradient(circle, transparent, transparent 50%, #FBFBFB 50%, #FBFBFB 100%) -7px -2px/16px 16px repeat-x;
    }

    .ticket__content {
        box-sizing: border-box;
        width: 100%;
    }

    .ticket-active .ticket__content .ticket__text {
        color: #fff !important;
    }

    .ticket__text {
        width: auto;
        font-family: "Helvetica", "Arial", sans-serif;
        font-weight: 900;
        color: #333;
    }

    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        padding: 12px 20px;
        font-weight: 600;
    }

    .nav-tabs .nav-link:hover {
        color: #fa8420;
        border: none;
    }

    .nav-tabs .nav-link.active {
        color: #fa8420;
        background-color: transparent;
        border-bottom: 2px solid #fa8420;
    }

    .forange {
        color: #fa8420;
    }

    .fbold {
        font-weight: bold;
    }

    .f12 {
        font-size: 12px;
    }

    .f14 {
        font-size: 14px;
    }

    .f18 {
        font-size: 18px;
    }

    .f20 {
        font-size: 20px;
    }

    .f22 {
        font-size: 22px;
    }
</style>

<div id="page_detail">
    <div itemscope itemtype="https://schema.org/Product">
        <!-- Swiper -->
        <div class="swiper mySwiper mt-1">
            <div class="swiper-wrapper">
                <?php if ($key["youtube"] != "") : ?>
                    <div class="swiper-slide" style="background:#000">
                        <iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo $key["youtube"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <div class="swiper-slide">
                    <img src="<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?&h=250&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/product/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png"); ?>" alt="" />
                </div>
                <?php if (count($galeryimg) > 0) : ?>
                    <?php foreach ($galeryimg as $galeryimg) : ?>
                        <?php
                        $glfp = strlen($galeryimg["img"]);
                        $gext = substr($galeryimg["img"], $glfp - 4);
                        is_file("public/image/galery/" . $galeryimg["img"]) != 1 ? $galeryimg["img"] = "../noimage.png" : $galeryimg["img"];
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo base_url() ?>public/image/galery/<?php echo ($gext == ".jpg" ? $galeryimg["img"] : "../noimage.png") ?>" alt="...">
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <div class="mb-2" style="background-color:#fff">
            <?php if ($key["stock"] == 0) : ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-exclamation-circle"></i>
                        <small> <strong>Produk dalam proses restock.<br /></strong> Silahkan daftar / hubungi <a href="https://wa.me/<?= (isset($key['admin_phone']) && !empty($key['admin_phone'])) ? $key['admin_phone'] : '085176912338' ?>"> <?= (isset($key['admin_phone']) && !empty($key['admin_phone'])) ? $key['admin_phone'] : '085176912338' ?></a> atau <a href="mailto:info@trumecs.com">info@trumecs.com</a> untuk mendapatkan info terbaru.</small>
                    </div>
                </div>
            <?php endif; ?>

            <div class="clearfix mb-1"></div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h1 itemprop="name" class="f18 fbold mb-0"><?php echo (($key["tittle"])) ?></h1>
                        <h4 itemprop="mpn" class="f12 text-muted"><?php echo strtoupper($key["partnumber"]) ?></h4>
                    </div>

                    <div class="clearfix mb-1"></div>

                    <div class="col-12">
                        <div itemprop="offers" itemscope itemtype="https://schema.org/Offer" style="color:#333">
                            <meta itemprop="priceCurrency" content="IDR" />
                            <link itemprop="availability" href="https://schema.org/InStock" />
                            <span class="price-list" style="text-decoration:line-through;color:#999" data-price="<?php echo $key['price'] ?>"></span>
                            <span class="price-promo" style="text-decoration:line-through;color:#999" data-price="<?php echo $key['price_promo'] ?>"></span>
                            <h6 class="fbold f22 forange mb-0">
                                <span itemprop="priceCurrency" content="IDR">Rp</span>
                                <span itemprop="price"><?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ',', '.'); ?></span>
                                <small class="f14" style="color:#999 !important">/ <?php echo strtolower($key["unit"]) ?></small>
                            </h6>
                            <?php if ($key["price_promo"] != "0") : ?>
                                <span class="f12" style="color:#ccc;"><strike>Rp <?php echo number_format($key["price"], 0, ',', '.') ?></strike></span>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="clearfix mb-1"></div>

                    <div class="col-12">
                        <h6 class="f12">
                            <span class="text-muted">Stok:</span> <?php echo $key["stock"] . ' ' . $key["unit"] ?><br />
                        </h6>
                        <hr />
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-12">
                        <?php echo $img_promo; ?>

                        <div class="text-left detail-sparepart">
                            <!-- Nav Tabs Bootstrap 5 -->
                            <ul class="nav nav-tabs mb-4" id="productTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="specifikasi-tab" data-bs-toggle="tab" data-bs-target="#keterangan" type="button" role="tab" aria-controls="keterangan" aria-selected="true">
                                        <i class="bi bi-gear me-2"></i> Spesifikasi
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">
                                        <i class="bi bi-info-circle me-2"></i> Detail & Promo
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <!-- Tab Spesifikasi -->
                                <div class="tab-pane fade show active" id="keterangan" role="tabpanel" aria-labelledby="specifikasi-tab">
                                    <div class="row f14">
                                        <div class="col-12">
                                            <h5 class="f18"><i class="bi bi-gear forange me-2"></i> Spesifikasi</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="row mb-2">
                                                <div class="col-4" style="color:#888">Kategori</div>
                                                <div class="col-8">
                                                    <?php $str_after = "";
                                                    for ($i = 0; $i < count($breadcrumb) - 1; $i++) : ?>
                                                        <?php echo $i > 0 ? "&raquo;" : "" ?>
                                                        <a itemprop="item" class="forange text-decoration-none"
                                                            href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[$i]) ?>">
                                                            <span itemprop="name"><?php echo $breadcrumb[$i] ?></span>
                                                        </a>
                                                        <?php $str_after .= preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[$i]) . "/" ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4" style="color:#888">Merek</div>
                                                <div class="col-8">
                                                    <a class="forange text-decoration-none"
                                                        href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[count($breadcrumb) - 1]) ?>">
                                                        <span itemprop="brand"><?php echo $breadcrumb[count($breadcrumb) - 1] ?></span>
                                                    </a>
                                                </div>
                                            </div>

                                            <?php if ($namecategori["parent"] == "Sparepart") : ?>
                                                <div class="row mb-2">
                                                    <div class="col-4" style="color:#888">Merek Unit</div>
                                                    <div class="col-8"> <span class="lfid" itemprop="brand"><?php echo strip_tags((!empty($namecategori["brandunit"])) ? $namecategori["brandunit"] : "-"); ?></span></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4" style="color:#888">Tipe Unit</div>
                                                    <div class="col-8"> <span class="lfid"><?php echo strip_tags((!empty($namecategori["type"])) ? $namecategori["type"] : "-"); ?></span></div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="row mb-2">
                                                <div class="col-4" style="color:#888">Berat</div>
                                                <div class="col-8"> <?php echo $key["weight"] ?> Kg</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4" style="color:#888">Grade</div>
                                                <div class="col-8"> <?php echo ($key["quality"] == 1 ? "Asli" : ($key["quality"] == 3 ? "Bekas" : "")); ?></div>
                                            </div>
                                        </div>

                                        <hr />

                                        <div class="col-12 mt-3">
                                            <h5 class="f18"><i class="bi bi-truck forange me-2"></i> Pengiriman</h5>
                                        </div>

                                        <div class="col-12">
                                            <div class="row mb-2">
                                                <div class="col-4" style="color:#888">Dikirim dari</div>
                                                <div class="col-8"> <?php echo nl2br($key["send_from"]); ?></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4" style="color:#888">Estimasi Pengiriman</div>
                                                <div class="col-8"> <?php echo $key["estimated_delivery"] ?> hari</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Detail & Promo -->
                                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="detail-tab">
                                    <?php if (!empty($attribute)) : ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="f18"><i class="bi bi-info-circle forange me-2"></i> Detail Produk</h5>
                                            </div>
                                            <?php $i = 1;
                                            foreach ($attribute as $index => $value) { ?>
                                                <div class="col-12 f14 mb-2">
                                                    <table class="table table-bordered <?php echo ($i % 2) ? "" : "table-striped"; ?>" style="width:100%;margin-bottom:0px;">
                                                        <tr>
                                                            <td class="fbold" style="width:40%;"><?php echo $value['name'] ?></td>
                                                            <td><?php echo strip_tags($value['value']); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            <?php $i++;
                                            } ?>
                                        </div>
                                        <hr />
                                    <?php endif; ?>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <h5 class="f18"><i class="bi bi-file-text forange me-2"></i> Deskripsi</h5>
                                        </div>
                                        <?php if (!empty($key["description"])) : ?>
                                            <div class="col-12">
                                                <p><?php echo $key["description"]; ?></p>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-12">
                                                <p class="f12">
                                                    <?php echo ucwords(strtolower($key["tittle"])) ?> dengan partnumber <?php echo ($key["partnumber"]);
                                                                                                                        echo (!empty($key["physicnumber"])) ? " nomor fisik " . $key["physicnumber"] : "";
                                                                                                                        echo (!empty($namecategori["brand"])) ? ", merek " . strip_tags($namecategori["brand"]) : ""; ?>
                                                    <?php echo (!empty($namecategori["type"])) ? " tipe " . strip_tags($namecategori["type"]) : "" ?>
                                                    <?php echo (!empty($namecategori["component"])) ? " komponen " . strip_tags($namecategori["component"]) : "" ?>
                                                    di jual dengan harga murah Rp <?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ',', '.'); ?> per <?php echo strtolower($key["unit"]) ?>
                                                    <?php if ($key["stock"] != 0) : ?>
                                                        , tersedia <?php echo $key["stock"] ?> stok barang.
                                                    <?php endif ?>
                                                </p>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <h5 class="f18"><i class="bi bi-tags forange me-2"></i> Promo Terkait</h5>
                                        </div>
                                        <div class="col-12">
                                            <?php if (!empty($key['promo'])): ?>
                                                <?php foreach ($key['promo'] as $promo) : ?>
                                                    <div class="card mb-3 border-0 shadow-sm">
                                                        <div class="card-body d-flex flex-column gap-2">
                                                            <a href="<?= base_url() ?>promo/<?= $promo['url']; ?>" class="fw-bold text-decoration-none d-flex flex-column gap-2 justify-content-between align-items-start">
                                                                <span class="fs-5"><?= $promo['name']; ?></span>
                                                                <span class="forange f12">lihat selengkapnya</span>
                                                            </a>
                                                            <table class="table table-hover table-striped">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th style="text-align:center;width:60%">Nama</th>
                                                                        <th style="text-align:center">Harga</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($promo['products'] as $promo_product): ?>
                                                                        <tr>
                                                                            <td><?php echo $promo_product["tittle"] ?></td>
                                                                            <td style="text-align:right">Rp <?php echo number_format($promo_product["price"], 0, ',', '.') ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada promo terkait</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="list_same_product">
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <h3 class="fbold f22"><i class="bi bi-cart forange me-2"></i>
                        <?php echo $this->lang->line('judul_produk_terkait', FALSE); ?> <?php echo ucwords(strtolower($key["tittle"])) ?>
                    </h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="sameProductDetailTable">
                    <thead class="table-light">
                        <tr>
                            <th style="text-align:center;width:60%">Nama</th>
                            <th style="text-align:center">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sameproduct as $same): ?>
                            <tr>
                                <td><?php echo $same["tittle"] ?></td>
                                <td style="text-align:right">Rp <?php echo number_format($same["price"], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="clearfix mb-1"></div>

        <div class="col-12 title-mobile">
            <p class="f20 title-content">Informasi terkait <?php echo $key["tittle"] ?></p>
        </div>

        <div class="clearfix mb-1"></div>

        <div class="col-12">
            <?php echo $this->load->view('article/_same_article', array('article' => $relatedarticle)); ?>
        </div>
    </div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        mousewheel: {
            invert: false,
        },
        autoheight: true,
        setWrapperSize: true,
    });
</script>