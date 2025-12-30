<?php

$key = $data_product[0];


$categoryOnTap = '';

foreach ($breadcrumb as $keybread => $keybreadcrumb) {
    $categoryOnTap .= preg_replace("/[^a-zA-Z0-9]/", "-", $keybreadcrumb) . "/";
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
// is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "--" : $key["img"];
$img_promo = '<img class="labelimg hidden-sm-down" src="' . base_url() . '/public/image/promo_specialoffer.png" width="120">';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 pt-1">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li><a class="forange"
                        href="<?php echo base_url() ?>"><?php echo $this->lang->line('breadcrumb_home', FALSE); ?></a>
                </li>
                <?php $str_after = "" ?>
                <?php foreach ($breadcrumb as $keybread => $keybreadcrumb) : ?>
                    <?php if (!empty($keybreadcrumb)) : ?>
                        <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                            <a itemprop="item" class="forange"
                                href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $keybreadcrumb) ?>">
                                <span itemprop="name"><?php echo $keybreadcrumb ?></span>
                            </a>
                        </li>
                        <?php $str_after .= preg_replace("/[^a-zA-Z0-9]/", "-", $keybreadcrumb) . "/" ?>
                    <?php endif ?>
                <?php endforeach ?>
                <li><span><?php echo ucwords(strtolower($key["tittle"])) ?></span></li>
            </ol>
        </div>
        <div class="clearfix"></div>
        <?php if ($key["stock"] == 0) : ?>
            <div class="col-lg-12">
                <div class="alert alert-warning">
                    <span class="fa fa-exclamation-circle" style="vertical-align:middle"></span> <small> <strong>Produk
                            dalam proses restock.</strong> Silahkan daftar / hubungi <a href="telp:021 3423234"> +62 821
                            2266 8008</a> atau <a href="">info@trumecs.com</a> untuk mendapatkan info terbaru.</small>
                </div>
            </div>
        <?php endif; ?>
        <div class="product col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div itemscope itemtype="https://schema.org/Product" class="row">
                        <meta itemprop="image"
                            content="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $key["img"] : "../noimage.png") ?>" />
                        <div class="col-lg-5 text-center imgproduct sticky">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <img itemprop="image" class="img-detail-lg tochangebyclick"
                                        data-zoom-image="<?php echo $this->base_url ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $key["img"] : "../noimage.png") ?>"
                                        src="<?php echo $this->base_url ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $key["img"] : "../noimage.png") ?>"
                                        alt="Jual <?php echo ucwords(strtolower($key["tittle"])) ?> | Trumecs"
                                        width="100%">
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-center img-galery">
                                        <div class=" img-border">
                                            <img class="img-fluid changeimagegalery" style="margin:0 auto;height:50px;"
                                                zoom-src-no-crop="<?php echo $this->base_url ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $key["img"] : "../noimage.png") ?>"
                                                src="<?php echo $this->base_url ?>timthumb?w=70&h=70&src=<?php echo $this->base_url ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $key["img"] : "../noimage.png") ?>"
                                                alt="Jual <?php echo ucwords(strtolower($key["tittle"]))  ?> | Trumecs">
                                        </div>
                                    </div>
                                    <?php if (count($galeryimg) > 0) : ?>
                                        <?php foreach ($galeryimg as $galeryimg) : ?>
                                            <?php
                                            $glfp = strlen($galeryimg["img"]);
                                            $gext = substr($galeryimg["img"], $glfp - 4);
                                            is_file("public/image/galery/" . $galeryimg["img"]) != 1 ? $galeryimg["img"] = "../noimage.png" : $galeryimg["img"];
                                            ?>
                                            <div class=" text-center img-galery ">
                                                <div class=" img-border">
                                                    <img itemprop="image" class="img-fluid changeimagegalery"
                                                        zoom-src-no-crop="<?php echo $this->base_url ?>public/image/galery/<?php echo ($gext == ".jpg" || $gext == ".png" || $gext == 'jpeg' ? $galeryimg["img"] : "../noimage.png") ?>"
                                                        style="margin:0 auto;height:50px;"
                                                        src="<?php echo $this->base_url ?>timthumb?w=70&h=70&src=<?php echo $this->base_url ?>public/image/galery/<?php echo ($gext == ".jpg" || $gext == ".png" || $gext == 'jpeg' ? $galeryimg["img"] : "../noimage.png") ?>"
                                                        alt="Jual <?php ucwords(strtolower($key["tittle"]))  ?> | Trumecs">
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    <?php if ($key["youtube"] != "") : ?>
                                        <div class="text-center img-galery">
                                            <div class=" img-border" data-toggle="modal" data-target="#youtube">
                                                <img class="img-fluid" style="margin:0 auto;height:50px;"
                                                    zoom-src-no-crop="<?php echo $this->base_url ?>public/image/product/<?php echo "../play.png" ?>"
                                                    src="<?php echo $this->base_url ?>timthumb?w=70&h=70&src=<?php echo $this->base_url ?>public/image/product/<?php echo  "../play.png" ?>"
                                                    alt="Jual <?php echo ucwords(strtolower($key["tittle"]))  ?> | Trumecs">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 info">
                            <div class="row">
                                <?php if ($this->session->flashdata('message') != '') { ?>
                                    <div class="col-lg-12">
                                        <div class="alert alert-success">
                                            <?php echo $this->session->flashdata('message'); ?>
                                            <a href="<?php echo base_url('cart') ?>">Lihat keranjang</a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-lg-12">
                                    <div class="card px-0 pt-0 border-none">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h1 itemprop="name"
                                                    alt="<?php echo ucwords(strtolower($key["tittle"])) ?>"
                                                    class="fw-bold mb-0"><?php echo (($key["tittle"])) ?></h1>

                                                <?php if ($key['is_sell'] == 1) : ?>
                                                    <span itemprop="mpn"
                                                        class="f12 fblack"><?php echo $this->lang->line('attr_partnumber', FALSE); ?>:
                                                        <?php echo ($key["partnumber"]) ?></span><br>
                                                <?php endif; ?>
                                                <?php if ($key['is_rent'] == 0) : ?>
                                                    <!--<h6 class="f14">
                                                    <span class="text-muted">Terjual </span> 250+ | <span
                                                        class="text-muted">Nilai </span> <span
                                                        class="fa fa-star forange"></span> 5 (10 orang)
                                                </h6>-->
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-12 my-1">
                                                <div class="bg-highlight __highlight_price">
                                                    <div itemprop="offers" itemscope itemtype="https://schema.org/Offer"
                                                        style="color:#333">
                                                        <meta itemprop="priceCurrency" content="IDR" />
                                                        <link itemprop="availability"
                                                            href="https://schema.org/InStock" />
                                                        <?php
                                                        $percent = 90;
                                                        $pricepromo = 0;
                                                        if ($key["price_promo"] != 0 && $key["price_promo"] != null) {
                                                            $key["price"] = ($key["price"] != 0) ? ($key['is_rent'] == 1 ? $key["rent_price"] : ($key['is_sell'] == 1 ? $key["price"] : $key["price_promo"])) : $key["price_promo"];
                                                            $got = $key["price_promo"];
                                                            $total = $key['is_sell'] == 1 ? $key["price"] : ($key['is_rent'] == 1 ? $key["rent_price"] : $key["price"]);
                                                            $percent = ($got / $total) * 100;
                                                            $pricepromo = $key["price"];
                                                        } else {
                                                            if ($key['is_sell'] == 1) {
                                                                $pricepromo = ($key["price"] * 100) / $percent;
                                                            } else if ($key['is_rent'] == 1) {
                                                                $pricepromo = ($key["rent_price"] * 100) / $percent;
                                                            }
                                                        }
                                                        ?>
                                                        <span class="f22 nomt forange"
                                                            style="font-size:24px;display:block;width:100%">
                                                            <span class="fw-bold" itemprop="priceCurrency"
                                                                content="IDR">Rp</span>
                                                            <span class="price-label fw-bold" itemprop="price">
                                                                <?php
                                                                $display_price = ($key["price_promo"] == 0 || $key['price_promo'] == null)
                                                                    ? ($key['is_sell'] == 1 ? $key["price"] : $key['rent_price'])
                                                                    : $key["price_promo"];

                                                                echo number_format($display_price, 0, ',', '.');
                                                                ?>
                                                            </span>
                                                            <small class="f34" style="color:#999 !important">/
                                                                <?php echo strtolower($key["unit"]) ?></small>
                                                        </span>
                                                        <?php if ($key['price_promo'] != 0 && $key['price_promo'] != null) : ?>
                                                            <span class="fw-bold nomb label label-danger"
                                                                data-promo-disc="<?php echo ceil(100 - $percent) ?>"
                                                                style="font-weight:bold">- <span
                                                                    class="promo-label"><?= ceil(100 - $percent) ?></span>
                                                                %</span>
                                                            <span class="price-list"
                                                                style="text-decoration:line-through;color:#999"
                                                                data-price="<?= $key['is_rent'] == 1 ? $key['rent_price'] : $key['price'] ?>">Rp
                                                                <?= number_format($key['is_rent'] == 1 ? $key['rent_price'] : $key['price'], 0, ',', '.') ?></span>
                                                            <span class="price-promo"
                                                                style="text-decoration:line-through;color:#999"
                                                                data-price="<?php echo $key['price_promo'] ?>"></span>
                                                        <?php else : ?>
                                                            <span class="price-list"
                                                                style="text-decoration:line-through;color:#999"
                                                                data-price="<?= $key['is_sell'] == 1 ? $key['price'] : $key['rent_price'] ?>"></span>
                                                            <span class="price-promo"
                                                                style="text-decoration:line-through;color:#999"
                                                                data-price="<?php echo $key['price_promo'] ?>"></span>
                                                        <?php endif; ?>
                                                        <div class="" style="display:block;width:100%">
                                                            <span style="color:#888"
                                                                class="f14"><?= $key['is_rent'] == 1 ? $this->lang->line('attr_minimum_rental', FALSE) : $this->lang->line('attr_minimum_pembelian', FALSE) ?>:</span>
                                                            <?= $key['is_rent'] == 1 ?  $key["minimum_rent"] . ' ' . $key["unit"]  : $key["moq"] . ' ' . $key["unit"] ?>
                                                        </div>
                                                        <div class="" style="display:block;width:100%">
                                                            <span style="color:#888"
                                                                class="f14">Tersedia:</span>
                                                            <?php echo $key["stock"] . ' ' . $key["unit"] ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-1">
                                                Info, pemesanan, diskon khusus:<br />
                                                <a style="border:1px solid #ccc"
                                                    href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>"
                                                    class="btn btn-lg btnnew fw-bold text-center f14 wa-button-product"><i
                                                        class="fa fa-whatsapp fa-2x f18 me-1"></i><?php echo $this->lang->line('tombol_whatsapp', FALSE); ?></a>
                                                <a style="border:1px solid #ccc"
                                                    href="mailto:info@trumecs.com?subject=<?php echo $key["tittle"] ?>&body=<?php echo "Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". \n \t Apakah barang ini tersedia?" ?>"
                                                    class=" btnnew  fw-bold text-center f14 email-button-product"><i
                                                        class="fa fa-envelope-o fa-2x f18 me-1"></i><?php echo $this->lang->line('tombol_email', FALSE); ?></a>
                                            </div>
                                            <div class="col-lg-12 mt-1">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="fw-bold">Detail</p>
                                                    </div>
                                                    <!--<div class="d-flex justify-content-between">
                                                        <p><?= $this->lang->line('product_location', FALSE) ?></p>
                                                        <p class="text-muted"><?= $key['availability_at'] ?></p>
                                                    </div>-->
                                                    <div class="d-flex justify-content-between">
                                                        <p><?= $this->lang->line('category', FALSE) ?></p>
                                                        <div>
                                                            <?php $str_after = "";
                                                            for ($i = 0; $i < count($breadcrumb) - 1; $i++) : ?>
                                                                <?php echo $i > 0 ? "&raquo;" : "" ?>
                                                                <a class="forange"
                                                                    href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[$i]) ?>">
                                                                    <span itemprop="name"><?php echo $breadcrumb[$i] ?></span>
                                                                </a>
                                                                <?php $str_after .= preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[$i]) . "/" ?>

                                                            <?php endfor; ?>
                                                        </div>
                                                        <!--<?php if (!empty($namecategori["component"])) : ?>
                                                        <p class="text-muted">
                                                            <a class="color-primary"
                                                                href="<?= $categoryOnTap ?>"><?= strip_tags((!empty($namecategori["component"])) ? $namecategori["component"] : "-") ?></a>

                                                        </p>
                                                        <?php else : ?>
                                                        <p class="text-muted">
                                                            -
                                                        </p>
                                                        <?php endif; ?>
                                                        -->
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p><?= $this->lang->line('brand', FALSE) ?></p>
                                                        <p class="text-muted">
                                                            <a class="forange"
                                                                href="<?php echo base_url() . "c/" . $str_after . preg_replace("/[^a-zA-Z0-9]/", "-", $breadcrumb[count($breadcrumb) - 1]) ?>">
                                                                <span itemprop="brand"><?php echo $breadcrumb[count($breadcrumb) - 1] ?></span>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <th colspan="2" class="bg-highlight">Spesifikasi</th>
                                                    </tr>
                                                    <?php foreach ($key['attribute'] as $attribute) : ?>
                                                        <tr>
                                                            <td><?= $attribute['name'] ?></td>
                                                            <td class="text-right text-muted"><?= $attribute['value'] ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <th class="bg-highlight">
                                                            <?= $this->lang->line('label_deskripsi', FALSE) ?></th>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $key['description'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!--<div class="col-lg-12">
                            <div class="card p-a-1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4>Konsultasi</h4>
                                        <hr />
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="m-0"><span class="fa fa-question-circle fa-2x"
                                                style="vertical-align:middle"></span> Anda punya pertanyaan?
                                            Konsultasikan dengan agen kami</p>
                                    </div>
                                    <div class="col-lg-4 text-right"><button class="btn btn-ask btnnew"
                                            id="button-konsultasi">Ajukan Pertanyaan</button></div>
                                </div>
                            </div>
                            <?php foreach ($discussion as $key => $item) : ?>
                            <div class="row pb-2 mt-1" data-message_id=""
                                style="background:#f9f9f9;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px;">
                                <div class="col-lg-12 p-a-2" style="background:#fff;border-bottom:1px solid #ddd">
                                    <div class="media">
                                        <div class="media-left">
                                            <img style="border-radius:50%"
                                                src="<?php echo base_url('public/image/user-girl-3.png'); ?>" />
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <small><strong><?php echo $item['name'] ?></strong></small>&nbsp;&nbsp;&nbsp;&nbsp;<small
                                                    class="text-muted"><?php echo date('d M Y', $item['created_at']) ?></small>
                                            </h6>
                                            <p class="mb-0" style="color:#666"><?php echo $item['message'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-reply">
                                    <?php
                                    if (array_key_exists('reply', $item)) :
                                        foreach ($item['reply'] as $keys => $items) :
                                    ?>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-11 col-lg-offset-1 px-0 mt-2">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object" style="border-radius:50%"
                                                    src="<?php echo base_url('public/image/agent-trumecs.png'); ?>" />
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">
                                                    <small><strong><?php echo $items['name'] ?></strong></small>&nbsp;&nbsp;&nbsp;&nbsp;<small
                                                        class="text-muted">
                                                        <?php echo date('d M Y', $items['created_at']) ?></small>
                                                </h6>
                                                <p class="mb-0" style="color:#666"><?php echo $items['message'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($items['reply_count'] > 1) : ?>
                                    <div class="col-lg-11 col-lg-offset-1 px-0 mt-2">
                                        <button data-parent="0"
                                            class="btn btn-more-comment btn-link p-a-0 m-0"><strong>Lihat komentar
                                                lainnya</strong></button>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach;
                                    endif; ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-11 col-lg-offset-1 px-0 mt-2">
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object" style="border-radius:50%"
                                                src="<?php echo base_url('public/image/user-girl-3.png'); ?>" />
                                        </div>
                                        <div class="media-body">
                                            <div class="col-lg-12 ps-0">
                                                <textarea data-parent="0" style="resize:none" rows="1"
                                                    class="form-control" name="message"
                                                    placeholder="Tulis komentar di sini..."></textarea>
                                                <button data-parent="0" hidden
                                                    data-product_id="<?php echo $key['id'] ?>"
                                                    class="btn-comment btn btnnew pull-right mt-1">Kirim</button>
                                                <button data-parent="0" hidden
                                                    class="btn-batal-comment btn btnnewwhite pull-right mt-1 me-1">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <div class="card p-a-1 mt-1" id="konsultasi">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <textarea class="form-control form-message" data-parent="0" name="message"
                                            placeholder="Apa yang ingin anda tanyakan?"></textarea>
                                        <button data-product_id="<?php echo $key['id'] ?>" data-parent="0"
                                            class="btn-message btn btnnew pull-right mt-1">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="clearfix mb-1"></div>
                        <div class="col-lg-12">
                            <div class="list_same_product">
                                <?php //$this->load->view("_sameproduct", array('title' => $key['tittle'])) 
                                ?>
                                <div class="row mb-1 mt-3">
                                    <div class="col-lg-12">
                                        <p class="fw-bold f22"><span class="fa fa-shopping-cart forange"></span>
                                            <?php echo $this->lang->line('judul_produk_terkait', FALSE); ?> <?php echo ucwords(strtolower($key["tittle"])) ?>
                                        </p>
                                    </div>
                                </div>
                                <table class="table table-horizontal table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">Nama</th>
                                            <th style="text-align:center">Merk</th>
                                            <th style="text-align:center">Grade</th>
                                            <th style="text-align:center">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sameproduct as $same): ?>
                                            <tr>
                                                <td><a itemprop="url"
                                                        href="<?php echo base_url() ?>product/<?php echo $same["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($same["tittle"]))) ?>"
                                                        style=" text-decoration:none;"><?php echo $same["tittle"] ?></a></td>
                                                <td style="text-align:center"><?php echo $same["name"] ?></td>
                                                <td style="text-align:center"><?php echo ($same["quality"] == 1 ? "Asli" : ($same["quality"] == 3 ? "Bekas" : ($same["quality"] == 3 ? "Tiruan" : ""))); ?></td>
                                                <td style="text-align:right">Rp <?php echo number_format($same["price"], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix mb-1"></div>
                        <div class="col-lg-12 my-3">
                            <div class="panel-kotak panel-default">
                                <p class="f22 mb-1"><strong><span class="fa fa-rss forange"></span>
                                        <?php echo $this->lang->line('judul_informasi_terkait', FALSE) . ' ' . $key['tittle']; ?></strong>
                                </p>
                                <?php echo $this->load->view('article/_same_article', array('article' => $relatedarticle, 'media' => 'half', 'img_base_url' => $this->base_url)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-3 sticky">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="btn btn-black col-lg-12 text-center btn-lg"><span class="fa fa-check-circle text-success"></span> READY STOCK</div> 
                            <?php if (time() % 2 == 0) : ?>
                            <a href="<?php echo site_url('product/2009/Meditran-Sx-Plus-15w-40-Ci4'); ?>">
                                <img width="100%" src="<?php echo base_url('public/image/promo-meditran.png'); ?>" />
                            </a>
                            <?php else : ?>
                            <a href="<?php echo site_url('product/1770/Turalik-52'); ?>">
                                <img width="100%" src="<?php echo base_url('public/image/promo-turalik.png'); ?>" />
                            </a>
                            <?php endif; ?>
                            
                        </div>
                        <div class="clearfix mb-1"></div>
                        <div class="col-lg-12">
                            <div class="card p-a-1">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <span
                                            class="blinking fw-bold"><?php echo $this->lang->line('judul_cta', FALSE); ?>
                                            <?php echo $key["tittle"] ?>?</span>
                                    </div>
                                    <div class="clearfix mb-1"></div>
                                    <div class="col-lg-12">
                                        <p class="quantity pull-right">
                                            <button type="button" class="btn btnnew btn-sm btn-min">-</button>
                                            <input form="form-cart" type="hidden" class=""
                                                value="<?php echo $key["id"] ?>" name="idproduct">
                                            <input form="form-cart" class="form-control form-control-sm" name="value"
                                                data-prev-val="1" minimum="<?php echo $key["moq"] ?>"
                                                maximum="<?php echo $key["stock"] ?>"
                                                data-volume-price="<?php echo number_format($key['promo_volume_price'] * $key['price'] / 100, 0, ',', '.') ?>"
                                                data-min-volume="<?php echo $key['promo_volume'] ?>"
                                                value="<?php echo isset($cart_key) ? $cart_key['qty'] : $key["moq"] ?>"
                                                style="width:50px;display:inline-block;text-align:right" />
                                            <input form="form-cart" name="method" type="hidden"
                                                value="<?php echo isset($cart_key) ? $cart_key['method'] : 'cod' ?>" />
                                            <button type="button" class="btn btnnew btn-sm btn-plus">+</button>
                                            <br /><span class="pull-right f12">Tersisa
                                                <?php echo $key["stock"] ?></span>
                                        </p>
                                        <strong>Quantity</strong>
                                    </div>
                                    <?php if ($key["moq"] != 0 and $key["stock"] != 0 and $key["stock"] >= 1 and $key["stock"] >= $key["moq"]) : ?>
                                    <?php if ($key["promo_cbd_price"] != '0') : ?>
                                    <div class="col-lg-12">
                                        <h6 class="fw-bold">Metode Pembayaran</h6>
                                        <a style="border:1px solid #ccc;color:#fa8420;"
                                            data-cbd-price="<?php echo number_format(($key["promo_cbd_price"] * $key["price"] / 100), 0, ',', '.') ?>"
                                            class="btn text-center f14 cbd-button <?php echo isset($cart_key) && $cart_key['method'] == 'cbd' ? 'active' : '' ?>">CBD</a>
                                        <a style="border:1px solid #ccc;color:#fa8420;"
                                            class="btn text-center f14 cod-button <?php echo isset($cart_key) && $cart_key['method'] == 'cod' ? 'active' : '' ?>"
                                            data-cod-price="<?php echo number_format($key["price_promo"], 0, ',', '.') ?>">COD</a>
                                    </div>
                                    <div class="clearfix mb-1"></div>
                                    <div class="col-lg-12">
                                        <h6 class="fw-bold">Diskon tambahan</h6>
                                        <div
                                            class="ticket ticket-cbd <?php echo isset($cart_key) && $cart_key['method'] == 'cbd' ? 'ticket-active' : '' ?>">
                                            <div class="ticket__content">
                                                <div class="ticket__text f14">
                                                    Pembayaran CBD
                                                </div>
                                                <small>+ Diskon Rp
                                                    <?php echo number_format(($key["promo_cbd_price"] * $key["price"] / 100), 0, ',', '.'); ?>/pcs</small>
                                            </div>
                                        </div>
                                        <div
                                            class="ticket ticket-volume <?php echo isset($cart_key) && $cart_key['qty'] >= $key['promo_volume'] ? 'ticket-active' : '' ?>">
                                            <div class="ticket__content">
                                                <div class="ticket__text f14">
                                                    Pembelian di atas
                                                    <?php echo $key['promo_volume'] . ' ' . strtolower($key['unit']) ?>
                                                </div>
                                                <small>+ Diskon Rp
                                                    <?php echo number_format(($key["promo_volume_price"] * $key["price"] / 100), 0, ',', '.'); ?>/pcs</small>
                                            </div>
                                        </div>
                                        <div class="ticket ticket-referral <?php echo $this->session->userdata('referral_code') != '' ? 'ticket-active' : '' ?>"
                                            data-referral-price="<?php echo number_format($key['promo_referral_price'] * $key['price'] / 100, 0, ',', '.') ?>">
                                            <div class="ticket__content">
                                                <div class="ticket__text f14">
                                                    Kode Referal
                                                </div>
                                                <small>+ Diskon Rp
                                                    <?php echo number_format(($key["promo_referral_price"] * $key["price"] / 100), 0, ',', '.'); ?>/pcs</small>
                                                <?php if ($this->session->userdata('referral_code') == '') : ?>
                                                <form id="referral-form"
                                                    action="<?php echo site_url('cart/check_referral_code'); ?>"
                                                    method="post">
                                                    <div class="input-code input-group mt-1">
                                                        <input type="text" name="referral-code" maxlength="10"
                                                            placeholder="Kode referal"
                                                            class="form-control form-control-sm"
                                                            style="text-transform:uppercase" />
                                                        <span class="input-groupbtn">
                                                            <button type="submit"
                                                                class="btn btn-sm btnnew check-referral-code">Kirim</button>
                                                        </span>
                                                    </div>
                                                </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-lg-12">
                                        <h6 class="pull-right"><span class="qty-lbl">1</span> x Rp <span
                                                class="price-label"><?php echo number_format($key['price_promo'] != 0 ? $key['price_promo'] : $key['price'], 0, ',', '.'); ?></span>
                                        </h6>
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <strong class="f22 pull-right">Rp <span
                                                class="total-label"><?php echo number_format($key['price_promo'] != 0 ? $key['price_promo'] : $key['price'], 0, ',', '.'); ?></span></strong>
                                    </div>
                                    <?php endif ?>
                                    <div class="clearfix mb-1"></div>
                                    <div class="col-lg-12">
                                        <form id="form-cart" action="<?php echo base_url() ?>cart/addproduct"
                                            method="post">
                                            <button
                                                class="btn btnnew btn-block fw-bold text-center f14 cart-button-product"><i
                                                    class="fa fa-cart-plus fa-2x f18 me-1"
                                                    style="vertical-align:middle"></i> Tambah ke Keranjang</button>
                                        </form>
                                    </div>
                                    <div class="clearfix mb-1"></div>
                                    <div class="col-lg-12">
                                        <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>"
                                            class="btn btnnew btn-block fw-bold text-center f14 beli-button-product"><i
                                                class="fa fa-shopping-cart fa-2x f18 me-1"
                                                style="vertical-align:middle"></i>
                                            <?= $this->lang->line($key['is_rent'] == 1 ? 'attr_rent_now' : 'attr_buy_now', FALSE); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12">
                            <div class="card p-a-1">
                                <div class="row">
                                    <div class="col-lg-12 mb-1">
                                        <a style="border:1px solid #ccc" onClick="window.Tawk_API.maximize();"
                                            class="chat-button-product btn btn-block f14 chat-button-product"><i
                                                class="fa fa-comment-o fa-2x f18 me-1"></i><?php echo $this->lang->line('tombol_chat', FALSE); ?></a>
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <a style="border:1px solid #ccc"
                                            href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>"
                                            class="btn btn-block f14 wa-button-product"><i
                                                class="fa fa-whatsapp fa-2x f18 me-1"></i><?php echo $this->lang->line('tombol_whatsapp', FALSE); ?></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <a style="border:1px solid #ccc"
                                            href="mailto:info@trumecs.com?subject=<?php echo $key["tittle"] ?>&body=<?php echo "Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". \n \t Apakah barang ini tersedia?" ?>"
                                            class="btn btn-block f14 email-button-product"><i
                                                class="fa fa-envelope-o fa-2x f18 me-1"></i><?php echo $this->lang->line('tombol_email', FALSE); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin:20px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <p class="f18 modal-title text-center" id="exampleModalLongTitle">Hubungi Kami</p>
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
                            <strong>Kantor</strong><br />Jl. Jend. Sudirman No.Km. 31, Kayuringin Jaya, Bekasi Sel.,
                            Kota Bks, Jawa Barat 17144
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
        <div class="modal-dialog modal-lg" role="document" style="margin:5% auto">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="f22 modal-title" id="exampleModalLabel"><?php echo $this->lang->line('judul_video', FALSE); ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>
                </div>
                <div class="modal-body text-center">
                    <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $key["youtube"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    <iframe width="870" height="502" src="https://www.youtube.com/embed/<?php echo $key["youtube"] ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>