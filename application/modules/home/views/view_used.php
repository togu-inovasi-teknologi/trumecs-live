<?php
$img_promo = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo_specialoffer.png" width="70">';
?>
<div id="page_home">
    <div class="row">
        <div class="col-md-12">
            <div class="col-xs-2 p-a-0 col-md-offset-1">
                <?php foreach ($headleftslide as $key) : ?>
                    <div class="col-md-12 m-a-0 p-a-0">
                        <?php echo '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-6 p-a-0 ">
                <div class="col-md-12 m-a-0 p-a-0">
                    <div class="fadeslidebig col-md-12 m-a-0 p-a-0" style="display:none">
                        <?php foreach (array_reverse($slide) as $headslideimg) : ?>
                            <div class="item-slide">
                                <?php echo ($headslideimg["link"]) != "" ? '<a href="' . $headslideimg["link"] . '">' : ''; ?>
                                <img alt="Sparepart Trumecs" class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $headslideimg["img"] ?>" data-src="holder.js/620x300?bg=#CECECE&fg=FFFFFF&text=Slider">
                                <?php echo ($headslideimg["link"]) != "" ? '</a>' : ''; ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php $i = 1;
                $batas = 2 ?>
                <?php foreach ($headbottomslide as $key) : ?>
                    <div class="col-md-6 m-a-0 p-a-0">
                        <?php echo !empty($i <= $batas) ? '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' : '' ?>
                        <?php $i++; ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-2 p-a-0">
                <?php $i = 1;
                $batas = 3 ?>
                <?php foreach ($headrightslide as $key) : ?>
                    <?php echo !empty($i <= $batas) ? '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' : '' ?>
                    <?php $i++; ?>
                <?php endforeach ?>
            </div>

        </div>
    </div>
</div>
<div class="listproduct row m-t-3 text-center ">
    <h2 class="m-b-2 fbold">Solusi kemudahan B2B</h2>
    <div class="col-xs-4">
        <span class="fa fa-calendar fa-4x m-y-2"></span>
        <h3 style="font-size:20px"><strong>Setup Meeting</strong></h3>
        <p class="col-xs-10 col-xs-offset-1">Silahkan tentukan waktu &amp; tempatnya marketing siap presentasi. <strong>GRATIS!</strong></p>
    </div>
    <div class="col-xs-4">
        <span class="fa fa-envelope fa-4x m-y-2"></span>
        <h3 style="font-size:20px"><strong>Kirim Penawaran</strong></h3>
        <p class="col-xs-10 col-xs-offset-1">Sebutkan produknya, kami berikan penawaran terbaik.</p>
    </div>
    <div class="col-xs-4">
        <span class="fa fa-phone fa-4x m-y-2"></span>
        <h3 style="font-size:20px"><strong>Hubungi Kami</strong></h3>
        <p class="col-xs-10 col-xs-offset-1">Marketing kami siap melayani via chat, Whatsapp, email, maupun telepon.</p>
    </div>
</div>
<?php if ($listproduct) : ?>
    <div class="listproduct row m-t-3">
        <h2 class="text-center m-b-2 fbold">TruMecs menyediakan</h2>
        <?php foreach ($listproduct as $key) : ?>
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-left hv_product m-y-1 p-y-1">
                <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
                    <?php
                    $lfp = strlen($key["img"]);
                    $ext = substr($key["img"], $lfp - 4);
                    is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
                    ?>
                    <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg") ? $key["img"] : "../noimage.png"; ?>)">
                    </div>
                    <h4 itemprop="name" style="height:35px;display:inline-block" class="f14 fbold"><?php echo ucwords($key["tittle"]) ?></h4>
                    <?php
                    $percent = 90;
                    $pricepromo = "";
                    if ($key["price_promo"] != 0) {
                        $key["price"] = ($key["price"] != 0) ? $key["price"] : $key["price_promo"];
                        $got = $key["price_promo"];
                        $total = $key["price"];
                        $percent = ($got / $total) * 100;
                        $pricepromo = $key["price"];
                    } else {
                        $pricepromo = ($key["price"] * 100) / $percent;
                    }
                    ?>
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <span class="f12 nomb" style="color:#999"><strike><?php echo "Rp." . number_format($pricepromo); ?></strike> </span>
                        <span style="right:0;margin-right:5px;margin-top:5px;top:0;position:absolute;width:65px;height:30px;display:block;font-size:14px;padding:2px 5px 3px;background:#ffa500;color:#fff;text-align:center;padding:5px 0px;border-radius:0px;" class=""><?php echo ceil(100 - $percent) ?>% OFF</span>
                        <br />
                        <span class="f14 nomt" style="color:#ffa500;">
                            <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?></span>
                        </span>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div>
<style type="text/css">
    .line-black {
        height: 5px;
        background-color: #000;
    }
</style>