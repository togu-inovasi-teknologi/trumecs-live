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
$img_promo = '<img class="labelimg hidden-sm-down" src="' . base_url() . '/public/image/promo_specialoffer.png" width="120">';

?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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

        /* Center slide text vertically */
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
</style>
<style>
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
</style>
<div id="page_detail" >
    <!-- Swiper -->
    <div class="row">
        <!-- <div class="btn btn-black col-xs-12 text-center btn-xs"><span class="fa fa-check-circle text-success"></span> READY STOCK</div> -->
        <!--<?php if (time() % 2 == 0) : ?>
            <a href="<?php echo site_url('product/2009/Meditran-Sx-Plus-15w-40-Ci4'); ?>">
                <img width="100%" src="<?php echo base_url('public/image/promo-meditran-mobile.png'); ?>" />
            </a>
        <?php else : ?>
            <a href="<?php echo site_url('product/1770/Turalik-52'); ?>">
                <img width="100%" src="<?php echo base_url('public/image/promo-turalik-mobile.png'); ?>" />
            </a>
        <?php endif; ?>-->
    </div>
    <div  itemscope itemtype="https://schema.org/Product">
        <div class="swiper mySwiper m-t-1">
            <div class="swiper-wrapper">
                <?php if ($key["youtube"] != "") : ?>
                    <div class="swiper-slide" style="background:#000">
                        <iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo $key["youtube"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <div class="swiper-slide">
                    <!--<img src="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png") ?>" alt="...">-->
                    <img src="<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?q=80&h=105&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/product/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png"); ?>" alt="" />
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
        <div class=" m-b-2" style="background-color:#fff">
            <!-- <div style="position:absolute;display:inline-block;z-index:999;right:30px;margin-top:-25px">
                <a data-toggle="modal" data-target="#youtube" style="display:block;width:50px;height:50px;background:red;text-align:center;border-radius:50%;color:#fff;line-height:45px;border:2px solid #fff;box-shadow:0px 3px 7px rgba(0,0,0,0.3)"><i class="fa fa-play f22" style="vertical-align:middle;margin-left:3px"></i></a>
            </div> -->
            <?php if ($key["stock"] == 0) : ?>
                <div class="col-xs-12">
                    <div class="alert alert-warning text-center">
                        <span class="fa fa-exclamation-circle" style="vertical-align:middle"></span> <small> <strong>Produk dalam proses restock.<br /></strong> Silahkan daftar / hubungi <a href="telp:+6285176912338"> +62 851 7691 2338</a> atau <a href="">sales@trumecs.com</a> untuk mendapatkan info terbaru.</small>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix m-b-1"></div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 itemprop="name" alt="<?php echo ucwords(strtolower($key["tittle"])) ?>" class="f18 fbold m-b-0"><?php echo (($key["tittle"])) ?></h1>
                        <h4 itemprop="mpn" alt="<?php echo strtoupper($key["partnumber"]) ?>" class="f12 text-muted"><?php echo strtoupper($key["partnumber"]) ?></h4>
                    </div>
                    <div class="clearfix m-b-1"></div>
                    <div class="col-xs-12">
                        <div itemprop="offers" itemscope itemtype="https://schema.org/Offer" style="color:#333">
                            <meta itemprop="priceCurrency" content="IDR" />
                            <link itemprop="availability" href="https://schema.org/InStock" />
                            <span class="price-list" style="text-decoration:line-through;color:#999" data-price="<?php echo $key['price'] ?>"></span>
                            <span class="price-promo" style="text-decoration:line-through;color:#999" data-price="<?php echo $key['price_promo'] ?>"></span>
                            <h6 class="fbold f22 forange m-b-0"> <span class="" itemprop="priceCurrency" content="IDR">Rp</span> <span class="" itemprop="price"><?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ',', '.'); ?></span> <small class="f14" style="color:#999 !important">/ <?php echo strtolower($key["unit"]) ?></small></h6>
                            <?php if ($key["price_promo"] != "0") : ?>
                                <span class="f12 nomb" style="color:#ccc;"><strike>Rp <?php echo number_format($key["price"], 0, ',', '.') ?></strike></span>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="clearfix m-b-1"></div>
                    <div class="col-xs-12">
                        <h6 class="f12">
                            <span class="text-muted">Stok:</span> <?php echo $key["stock"] . ' ' . $key["unit"] ?><br />
                            <!--<span class="text-muted">Terjual:</span> 250+<br />
                            <span class="text-muted">Nilai:</span> <span class="fa fa-star forange"></span> 5 (10 orang) | <span class="text-muted">Konsultasi:</span> 5 bertanya-->
                        </h6>
                        <!--<a class="btn btnnew f12 fbold" data-toggle="modal" data-target="#add-to-cart">
                            <i class="fa fa-cart-plus" style="margin-right:5px"></i> <span> Keranjang</span>
                        </a>-->
                        <hr />
                    </div>
                    <!--<div class="clearfix"></div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3 text-center">
                                <img src="<?php echo base_url('public/image/favicon/favicon-96x96.png'); ?>" style="width:100%;border-radius:50%" />
                            </div>
                            <div class="col-xs-9">
                                <span>Trumecs.com</span><br />
                                <small><i style="color:green" class="fa fa-circle"></i> Online</small>
                                <br />
                                <a class="btn btnnew fbold f12" href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" target="_blank">
                                    <i class="fa fa-commenting"></i>
                                    Chat sekarang
                                </a>
                            </div>
                        </div>
                        <hr />
                    </div>-->
                    <div class="clearfix"></div>
                    <div class="col-xs-12">
                        <?php echo $img_promo; ?>
                        <div class="text-left detail-sparepart">
                            <div class="tab-pane fade in active" id="keterangan" role="tabpanel">
                                <div class="row f14">
                                    <div class="col-xs-12">
                                        <h3 class="f18"><span class="fa fa-cog forange"></span> Spesifikasi</h3>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-4" style="color:#888">Kategori</div>
                                            <div class="col-xs-8"> 
                                            <?php $str_after="";for($i=0;$i<count($breadcrumb)-1;$i++) : ?>
                                            <?php echo $i > 0 ? "&raquo;" : "" ?>
                                            <a itemprop="item" class="forange"
                                                href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[$i]) ?>">
                                                <span itemprop="name"><?php echo $breadcrumb[$i] ?></span>
                                            </a>
                                            <?php $str_after .= preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[$i]) . "/" ?>
                                            
                                            <?php endfor; ?>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-xs-4" style="color:#888">Merek</div>
                                            <div class="col-xs-8"> 
                                                <a class="forange"
                                                    href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[count($breadcrumb)-1]) ?>">
                                                    <span itemprop="brand"><?php echo $breadcrumb[count($breadcrumb)-1] ?></span>
                                                </a>
                                            </div>
                                            <div class="clearfix"></div>
    
                                            <?php if ($namecategori["parent"] != "Sparepart") : ?>
                                                <!--<div class="col-xs-4" style="color:#888">Tipe</div>
                                                <div class="col-xs-8"> <span class="lfid"><?php echo strip_tags((!empty($namecategori["type"])) ? $namecategori["type"] : "-"); ?></span></div>-->
                                            <?php else : ?>
                                                <div class="col-xs-4" style="color:#888">Merek Unit</div>
                                                <div class="col-xs-8"> <span class="lfid" itemprop="brand"><?php echo strip_tags((!empty($namecategori["brandunit"])) ? $namecategori["brandunit"] : "-"); ?></span></div>
                                                <div class="clearfix"></div>
    
                                                <div class="col-xs-4" style="color:#888">Tipe Unit</div>
                                                <div class="col-xs-8"> <span class="lfid"><?php echo strip_tags((!empty($namecategori["type"])) ? $namecategori["type"] : "-"); ?></span></div>
    
                                            <?php endif; ?>
                                            <div class="clearfix"></div>
    
                                            <div class="col-xs-4" style="color:#888">Berat</div>
                                            <div class="col-xs-8"> <?php echo $key["weight"] ?> Kg</div>
                                            <div class="clearfix"></div>
    
                                            <!--<div class="col-xs-4" style="color:#888">Kemasan</div>
                                            <div class="col-xs-8"> <?php echo $key["packagin"] == "" ? "-" : $key["packagin"] ?></div>
                                            <div class="clearfix"></div>-->
    
                                            <div class="col-xs-4" style="color:#888">Grade</div>
                                            <div class="col-xs-8"> <?php echo ($key["quality"] == 1 ? "Asli" : ($key["quality"] == 3 ? "Bekas" : ($key["quality"] == 3 ? "Tiruan" : ""))); ?></div>
                                            <div class="clearfix"></div>
    
                                            <!--<div class="col-xs-4" style="color:#888">Garansi</div>
                                            <div class="col-xs-8"> <?php echo (!empty($key["warranty"])) ? $key["warranty"] : "-"; ?></div>-->
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                        <h5 class="f18"><span class="fa fa-truck forange"></span> Pengiriman</h5>
                                    </div>
                                    <!--<div class="clearfix"></div>
                                    <div class="col-xs-12"><span style="color:#888">Avability:</span> Tersedia di <?php echo $key["availability_at"] ?></div>-->
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12"><span style="color:#888">Dikirim dari:</span> <?php echo nl2br($key["send_from"]); ?></div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12"><span style="color:#888">Estimasi Pengiriman:</span> <?php echo $key["estimated_delivery"] ?> hari</div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                        <hr />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in itemprop_p" id="description" role="tabpanel">
                                <?php if (!empty($attribute)) : ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h5 class="f18"><i class="fa fa-info-circle forange"></i> Detail Produk</h5>
                                        </div>
                                        <?php $i = 1;
                                        foreach ($attribute as $index => $value) { ?>
                                            <?php //if ($i < 5) : ?>
                                                <div class="col-xs-12 f14">
                                                    <table class="table table-bordered <?php echo ($i % 2) ? "" : "table-striped"; ?>" style="width:100%;margin-bottom:0px;">
                                                        <tr>
                                                            <td class="fbold" style="width:40%;"><?php echo $value['name'] ?></td>
                                                            <td><?php echo strip_tags($value['value']); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            <?php //endif ?>
                                            <?php if ($i > 5) { ?>
                                                <!--<div class="col-xs-12">
                                                    <a data-toggle="modal" data-target="#detail" class="forange f14">Baca selengkapnya</a>
                                                </div>-->
                                            <?php } else { ?>
                                            <?php } ?>
                                        <?php $i++;
                                        } ?>
                                    </div>
                                    <hr />
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="m-t-1 f18"><i class="fa fa-file-text-o forange"></i> Deskripsi</h3>
                                    </div>
                                    <?php if (!empty($key["description"])) : ?>
                                        <div class="col-xs-12">
                                            <p><?php echo $key["description"];//word_limiter($key["description"], 20); ?></p>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-xs-12">
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
                                    <div class="col-xs-12">
                                        <!--<a data-toggle="modal" data-target="#deskripsi" class="forange f14">Baca selengkapnya</a>-->
                                        <hr />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="list_same_product">
            <?php //$this->load->view("_sameproduct_mobile", array('title' => $key['tittle'])) ?>
            <div class="row m-b-1 m-t-3">
                <div class="col-lg-12">
                    <h3 class="fbold f22"><span class="fa fa-shopping-cart forange"></span>
                        <?php echo $this->lang->line('judul_produk_terkait', FALSE); ?> <?php echo ucwords(strtolower($key["tittle"])) ?>
                    </h3>
                </div>
            </div>
            <table class="table table-horizontal table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align:center;width:60%">Nama</th>
                        <th style="text-align:center">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sameproduct as $same): ?>
                    <tr>
                        <td><?php echo $same["tittle"] ?></td>
                        <!--<td style="text-align:center"><?php echo $same["brand_name"] ?></td>-->
                        <td style="text-align:right">Rp <?php echo number_format($same["price"], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="clearfix m-b-1"></div>
        <div class="col-xs-12 title-mobile">
            <p class="f20 title-content">Informasi terkait <?php echo $key["tittle"] ?></p>
        </div>
        <div class="clearfix m-b-1"></div>
        <div class="col-xs-12">
            <?php echo $this->load->view('article/_same_article', array('article' => $relatedarticle)); ?>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-mobile" role="document" style="margin:20px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <p class="f20 modal-title text-center" id="exampleModalLongTitle">Hubungi Kami</p>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <strong>Telepon</strong><br /> <?php echo platform_contact("phone"); ?>
                        </div>
                        <div class="form-group">
                            <strong>Email</strong><br /> <?php echo platform_contact("email"); ?>
                        </div>
                        <div class="form-group">
                            <strong>Whatsapp</strong><br /> <?php echo platform_contact("whatsapp"); ?>
                        </div>
                        <div class="form-group">
                            <strong>Kantor</strong><br />Jl. Jend. Sudirman No.Km. 31, Kayuringin Jaya, Bekasi Sel., Kota Bks, Jawa Barat 17144
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!--<button type="button" class="btn btn-orange">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<?php if ($key["youtube"] != "") : ?>
    <div class="modal fade" id="youtube" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin:5% auto">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="f20 modal-title" id="exampleModalLabel">Video
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>
                </div>
                <div class="modal-body text-center">
                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo $key["youtube"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mobile" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel"><i class="fa fa-info-circle forange"></i> Detail Produk
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll;max-height:40vh">
                <div class="row">
                    <div class="col-xs-12 f14">
                        <?php $i = 1;
                        foreach ($attribute as $index => $value) { ?>
                            <table class="table table-bordered  <?php echo ($i % 2) ? "" : "table-striped"; ?>" style="width:100%;margin-bottom:5px;">
                                <tr>
                                    <td class="fbold" style="width:30%;"><?php echo $value['name'] ?></td>
                                    <td><?php echo strip_tags($value['value']); ?></td>
                                </tr>
                            </table>
                        <?php $i++;
                        } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 text-center m-b-1">
                    <p style="color:#999">Masih ada yang ingin ditanyakan?</p>
                    <!-- <a onclick="window.Tawk_API.maximize();" class="fbold" style="border-radius:5px;border:1px solid #fa8420;display:inline-block;color:#fa8420;margin-top:10px;padding-right:10px">
                <div style="background:#fa8420;color:#fff;display:inline-flex;padding:10px;">
                        <i class="fa fa-commenting"></i> 
                </div>
                Chat sekarang
            </a> -->
                    <a class="btn btnnew btn-block fbold" href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" target="_blank">
                        <i class="fa fa-commenting"></i>
                        Chat sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deskripsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mobile" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel"><i class="fa fa-file-text-o forange"></i> Deskripsi
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll;max-height:40vh">
                <?php if (!empty($key["description"])) : ?>
                    <div class="col-xs-12">
                        <p><?php echo word_limiter($key["description"], 20); ?></p>
                    </div>
                <?php else : ?>
                    <div class="col-xs-12">
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
            <div class="modal-footer">
                <div class="col-xs-12 text-center m-b-1">
                    <p style="color:#999">Masih ada yang ingin ditanyakan?</p>
                    <!-- <a onclick="window.Tawk_API.maximize();" class="fbold" style="border-radius:5px;border:1px solid #fa8420;display:inline-block;color:#fa8420;margin-top:10px;padding-right:10px">
                <div style="background:#fa8420;color:#fff;display:inline-flex;padding:10px;">
                        <i class="fa fa-commenting"></i> 
                </div>
                Chat sekarang
            </a> -->
                    <a class="btn btnnew btn-block fbold" href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" target="_blank">
                        <i class="fa fa-commenting"></i>
                        Chat sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail33" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mobile" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Detail Produk
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll;max-height:90vh">
                <div class="col-xs-3 p-a-0">
                    <img src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png") ?>" style="border-radius:10px;" />
                </div>
                <div class="col-xs-9 p-a-0">
                    <p class="f18 fbold"><?php echo (($key["tittle"])) ?></p>
                    <small><?php echo (($key["partnumber"])) ?></small>
                </div>
                <div class="clearfix m-b-1"></div>
                <!-- <h5 class="fbold">Spesifikasi produk</h5> -->
                <div class="col-xs-12 p-x-0 m-b-1 f14">
                    <div class="row">
                        <div class="col-xs-4" style="color:#888">Kategori</div>
                        <div class="col-xs-8"> <span class="lfid"><?php echo strip_tags((!empty($namecategori["component"])) ? $namecategori["component"] : "-"); ?></span></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4" style="color:#888">Merek</div>
                        <div class="col-xs-8"> <span class="lfid" itemprop="brand"><?php echo strip_tags((!empty($namecategori["brand"])) ? $namecategori["brand"] : "-"); ?></span></div>
                    </div>
                    <?php if ($namecategori["parent"] != "Sparepart") : ?>
                        <!-- <div class="row">
                <div class="col-xs-4" style="color:#888">Tipe</div>
                <div class="col-xs-8"> <span class="lfid" ><?php echo strip_tags((!empty($namecategori["type"])) ? $namecategori["type"] : "-"); ?></span></div>
            </div> -->
                    <?php else : ?>
                        <div class="row">
                            <div class="col-xs-4" style="color:#888">Merek Unit</div>
                            <div class="col-xs-8"> <span class="lfid" itemprop="brand"><?php echo strip_tags((!empty($namecategori["brandunit"])) ? $namecategori["brandunit"] : "-"); ?></span></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4" style="color:#888">Tipe Unit</div>
                            <div class="col-xs-8"> <span class="lfid"><?php echo strip_tags((!empty($namecategori["type"])) ? $namecategori["type"] : "-"); ?></span></div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xs-4" style="color:#888">Berat</div>
                        <div class="col-xs-8"> <?php echo $key["weight"] ?> Kg</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4" style="color:#888">Kemasan</div>
                        <div class="col-xs-8"> <?php echo $key["packagin"] == "" ? "-" : $key["packagin"] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4" style="color:#888">Grade</div>
                        <div class="col-xs-8"> <?php echo ($key["quality"] == 1 ? "Asli" : ($key["quality"] == 3 ? "Bekas" : ($key["quality"] == 3 ? "Tiruan" : ""))); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4" style="color:#888">Garansi</div>
                        <div class="col-xs-8"> <?php echo (!empty($key["warranty"])) ? $key["warranty"] : "-"; ?></div>
                    </div>

                </div>
                <h5 class="fbold">Spesifikasi Tambahan</h5>
                <div class="row m-b-1">
                    <?php foreach ($attribute as $index => $value) { ?>
                        <div class="col-xs-6" style="margin-top:5px">
                            <div class="row">
                                <div class="col-xs-12" style="color:#666;font-weight:normal"><?php echo $value['name'] ?></div>
                                <div class="col-xs-12" style=""> <span class="lfid"><?php echo strip_tags($value['value']); ?></span></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <h5 class="fbold">Deskripsi Produk</h5>
                <?php if (!empty($key["description"])) : ?>
                    <p><?php echo $key["description"]; ?></p>
                <?php else : ?>
                    <p class="f14">
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
                <?php endif ?>
                <div class="col-xs-12 text-center m-b-2">
                    <p style="color:#999">Masih ada yang ingin ditanyakan?</p>
                    <!-- <a onclick="window.Tawk_API.maximize();" class="fbold" style="border-radius:5px;border:1px solid #fa8420;display:inline-block;color:#fa8420;margin-top:10px;padding-right:10px">
                <div style="background:#fa8420;color:#fff;display:inline-flex;padding:10px;">
                        <i class="fa fa-commenting"></i> 
                </div>
                Chat sekarang
            </a> -->
                    <a class="btn btnnew fbold" href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" target="_blank">
                        <i class="fa fa-commenting"></i>
                        Chat sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mobile" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Detail Pengiriman
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll;max-height:90vh">
                <h5 class="fbold">Pengiriman</h5>
                <div class="row">
                    <div class="col-xs-5"><span style="color:#888">Avability</span></div>
                    <div class="col-xs-7">: Tersedia di <?php echo $key["availability_at"] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5"><span style="color:#888">Dikirim dari</span> </div>
                    <div class="col-xs-7">: <?php echo nl2br($key["send_from"]); ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5"><span style="color:#888">Est. Pengiriman</span></div>
                    <div class="col-xs-7">: <?php echo $key["estimated_delivery"] ?> hari</div>
                </div>
                <div class="row m-t-1">
                    <div class="col-xs-12">
                        <p><?php echo nl2br($key["area_description"]); ?></p>
                    </div>
                </div>
                <div class="col-xs-12 m-t-1 text-center m-b-3">
                    <p style="color:#999">Masih ada yang ingin ditanyakan?</p>
                    <!-- <a onclick="window.Tawk_API.maximize();" class="fbold" style="border-radius:5px;border:1px solid #fa8420;display:inline-block;color:#fa8420;margin-top:10px;padding-right:10px">
                <div style="background:#fa8420;color:#fff;display:inline-flex;padding:10px;">
                        <i class="fa fa-commenting"></i> 
                </div>
                Chat sekarang
            </a> -->
                    <a class="wa-button-mobile fbold" href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" style="border-radius:5px;border:1px solid #fa8420;display:inline-block;color:#fa8420;margin-top:10px;padding-right:10px">
                        <div style="background:#fa8420;color:#fff;display:inline-flex;padding:10px;">
                            <i class="fa fa-commenting"></i>
                        </div>
                        Chat sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-to-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mobile" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Detail Produk
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll;max-height:70vh">
                <div class="row">
                    <div class="col-xs-3">
                        <img src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" ? $key["img"] : "../noimage.png") ?>" style="border-radius:10px;" />
                    </div>
                    <div class="col-xs-9">
                        <p class="f18 fbold"><?php echo (($key["tittle"])) ?></p>
                        <small><?php echo (($key["partnumber"])) ?></small>
                    </div>
                    <div class="clearfix m-b-2"></div>
                    <div class="col-xs-12">
                        <p class="quantity pull-right">
                            <button type="button" class="btn btnnew btn-sm btn-min">-</button>
                            <input form="form-cart" type="hidden" class="" value="<?php echo $key["id"] ?>" name="idproduct" />
                            <input form="form-cart" class="form-control form-control-sm" name="value" data-prev-val="1" minimum="<?php echo $key["moq"] ?>" maximum="<?php echo $key["stock"] ?>" data-volume-price="<?php echo number_format($key['promo_volume_price'] * $key['price'] / 100, 0, ',', '.') ?>" data-min-volume="<?php echo $key['promo_volume'] ?>" value="<?php echo isset($cart_key) ? $cart_key['qty'] : 1 ?>" style="width:50px;display:inline-block;text-align:right" />
                            <input form="form-cart" name="method" type="hidden" value="<?php echo isset($cart_key) ? $cart_key['method'] : 'cod' ?>" />
                            <button type="button" class="btn btnnew btn-sm btn-plus">+</button>
                            <br /><small class="pull-right">Tersisa <?php echo $key["stock"] ?></small>
                        </p>
                        <h6 class="fbold">Quantity</h6>
                    </div>
                    <!-- <h5 class="fbold">Spesifikasi produk</h5> -->

                    <!-- <?php $munculin_template = 1; ?>
            <?php if ($key["moq"] != 0 and $key["stock"] != 0 and $key["stock"] >= 1 and $key["stock"] >= $key["moq"]) : ?>
            
            <input type="hidden" class="" value="<?php echo $key["id"] ?>" name="idproduct">
            <?php if (($namecategori["component"] == "Unit" || $namecategori["component"] == "Alat Berat" || $namecategori["component"] == "Bus & Truk") && $key["quality"] == 3) : ?>
                <button class="btn btn-orange col-xs-12 col-md-12 col-sm-12 col-xs-12"><i class="fa fa-plus"></i> Ajukan Penawaran</button>
            <?php else : ?>
                <button class="btn btn-default col-xs-12 col-md-12 col-sm-12 col-xs-12"><i class="fa fa-shopping-cart"></i> Keranjang</button>
            <?php endif; ?>
                -->
                    <?php if ($key["promo_cbd_price"] != '0') : ?>
                        <div class="col-xs-12">
                            <a style="border:1px solid #ccc;color:#fa8420;" class="pull-right btn text-center f14 cod-button <?php echo isset($cart_key) && $cart_key['method'] == 'cod' ? 'active' : '' ?>" data-cod-price="<?php echo number_format($key["price_promo"], 0, ',', '.') ?>">COD</a>
                            <a style="border:1px solid #ccc;color:#fa8420;" data-cbd-price="<?php echo number_format(($key["promo_cbd_price"] * $key["price"] / 100), 0, ',', '.') ?>" class="pull-right m-r-1 btn text-center f14 cbd-button <?php echo isset($cart_key) && $cart_key['method'] == 'cbd' ? 'active' : '' ?>">CBD</a>
                            <p class="fbold">Metode Pembayaran</p>
                        </div>
                        <div class="clearfix m-b-1"></div>
                        <div class="col-xs-12">
                            <strong>Diskon tambahan</strong>
                            <div class="ticket ticket-cbd <?php echo isset($cart_key) && $cart_key['method'] == 'cbd' ? 'ticket-active' : '' ?>">
                                <div class="ticket__content">
                                    <div class="ticket__text f14">
                                        Pembayaran CBD
                                    </div>
                                    <small>+ Diskon Rp <?php echo number_format(($key["promo_cbd_price"] * $key["price"] / 100), 0, ',', '.'); ?>/pcs</small>
                                </div>
                            </div>
                            <div class="ticket ticket-volume <?php echo isset($cart_key) && $cart_key['qty'] >= $key['promo_volume'] ? 'ticket-active' : '' ?>">
                                <div class="ticket__content">
                                    <div class="ticket__text f14">
                                        Pembelian di atas <?php echo $key['promo_volume'] . ' ' . strtolower($key['unit']) ?>
                                    </div>
                                    <small>+ Diskon Rp <?php echo number_format(($key["promo_volume_price"] * $key["price"] / 100), 0, ',', '.'); ?>/pcs</small>
                                </div>
                            </div>
                            <div class="ticket ticket-referral <?php echo $this->session->userdata('referral_code') != '' ? 'ticket-active' : '' ?>" data-referral-price="<?php echo number_format($key['promo_referral_price'] * $key['price'] / 100, 0, ',', '.') ?>">
                                <div class="ticket__content">
                                    <div class="ticket__text f14">
                                        Kode Referal
                                    </div>
                                    <small>+ Diskon Rp <?php echo number_format(($key["promo_referral_price"] * $key["price"] / 100), 0, ',', '.'); ?>/pcs</small>
                                    <?php if ($this->session->userdata('referral_code') == '') : ?>
                                        <form id="referral-form" action="<?php echo site_url('cart/check_referral_code'); ?>" method="post">
                                            <div class="input-code input-group m-t-1">
                                                <input type="text" name="referral-code" maxlength="10" placeholder="Kode referal" class="form-control form-control-sm" style="text-transform:uppercase" />
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-sm btnnew check-referral-code">Kirim</button>
                                                </span>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-xs-12 m-b-1">
                        <small class="pull-right"><span class="qty-lbl">1</span> x Rp <span class="price-label"><?php echo number_format($key['price_promo'] != 0 ? $key['price_promo'] : $key['price'], 0, ',', '.'); ?></span></small>
                        <p class="fbold">Total:</p>
                        <strong class="f22 pull-right">Rp <span class=" total-label"><?php echo number_format($key['price_promo'] != 0 ? $key['price_promo'] : $key['price'], 0, ',', '.'); ?></span></strong>
                    </div>
                <?php else : ?>
                    <div class="col-xs-12 m-b-1">
                        <div class="alert">
                            Produk ini belum tersedia, jika Anda membutuhkan harap menghubungi customer service kami.<br>
                            <span class="btn btn-orange fbold" onclick="toggleChat()"><i class="fa fa-comment"></i> Chat</span> atau <a href="tel:+62218849319" class="btn btn-white fbold"><i class="fa fa-phone"></i> 021-8849319</a>
                            <?php $munculin_template = 0; ?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <div class="col-xs-12">
                        <form id="form-cart" action="<?php echo base_url() ?>cart/addproduct" method="post">
                            <button class="btn btnnew btn-block fbold text-center f14"><i class="fa fa-cart-plus fa-2x f18 m-r-1 cart-button-product" style="vertical-align:middle"></i> Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
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