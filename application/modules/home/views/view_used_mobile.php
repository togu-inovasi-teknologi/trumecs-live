<?php
function calldata($array, $need)
{
    if (count($array) > 0) {
        foreach ($array as $key) {
        }
        switch ($need) {
            case 'id':
                return $key["id"];;
                break;
            case 'name':
                return $key["name"];;
                break;
            case 'img':
                return $key["img"];;
                break;
            case 'link':
                return $key["link"];;
                break;
        }
    } else {
        switch ($need) {
            case 'id':
                return "";
                break;
            case 'name':
                return "";
                break;
            case 'img':
                return "../../noimage-small.jpg";
                break;
            case 'link':
                return "";
                break;
        }
    }
}
?>
<?php
$img_promo = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo_specialoffer.png" width="70">';
?>
<div id="page_home">
    <div class="row">
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
    <div class="row nopt nopb">
        <div class="">
            <?php foreach ($headbottomslide as $key) : ?>
                <div>
                    <div class="col-xs-6 p-a-0">
                        <?php echo '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="row nopt nopb">
        <div class="">
            <?php foreach ($headleftslide as $key) : ?>
                <div>
                    <div class="col-xs-4 p-a-0">
                        <?php echo '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' ?>
                    </div>
                </div>
            <?php endforeach ?>
            <?php foreach ($headrightslide as $key) : ?>
                <div>
                    <div class="col-xs-4 p-a-0">
                        <?php echo '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="row" style="background:#f1f1f1;color:#115975">
        <div class="text-center col-xs-12" style="margin-top:10px;color:#f7941e">
            <h1 class="fbold">TruMecs</h1>
        </div>
        <div class="col-xs-12" style="color:#58585a;font-size:20px;">
            <p style="padding:0 55px;">
                <span style="color:#f7941e" class="fa fa-check-circle"></span> Harga transparan<br />
                <span style="color:#f7941e" class="fa fa-check-circle"></span> Respon cepat<br />
                <span style="color:#f7941e" class="fa fa-check-circle"></span> Spesialis mekanikal
                <br />
            </p>
            <p class="text-center">
                Ayo jadi member sekarang.
                <br />
                <a href="<?php echo site_url('member/signup') ?>" class="btn btn-primary btn-lg f22 m-t-1">Daftar</a>
            </p>
        </div>
    </div>
    <div class="listproduct m-y-3 row">
        <h2 class="m-b-2 fbold text-center col-xs-12">Solusi kemudahan B2B</h2>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <span class="fa fa-calendar fa-4x m-y-2"></span>
            </div>
            <div class="col-xs-8">
                <h3 class="" style="font-size:20px"><strong>Setup Meeting</strong></h3>
                <p class="">Silahkan tentukan waktu &amp; tempatnya marketing siap presentasi. <strong>GRATIS!</strong></p>
                <!--<a class="btn btn-white">Selengkapnya</a>-->
            </div>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="col-xs-12">
            <div class="col-xs-4">
                <span class="fa fa-envelope fa-4x m-y-2"></span>
            </div>
            <div class="col-xs-8">
                <h3 style="font-size:20px"><strong>Kirim Penawaran</strong></h3>
                <p>Sebutkan produknya, kami berikan penawaran terbaik.</p>
                <!--<a class="btn btn-white">Selengkapnya</a>-->
            </div>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="col-xs-12">
            <div class="col-xs-4">
                <span class="fa fa-phone fa-4x m-y-2"></span>
            </div>
            <div class="col-xs-8">
                <h3 style="font-size:20px"><strong>Hubungi Kami</strong></h3>
                <p>Marketing kami siap melayani via chat, Whatsapp, email, maupun telepon.</p>
                <!--<a class="btn btn-white">Selengkapnya</a>-->
            </div>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="col-xs-12">
            <div class="col-xs-4">
                <span class="fa fa-file fa-4x m-y-2"></span>
            </div>
            <div class="col-xs-8">
                <h3 style="font-size:20px"><strong>Undang Tender</strong></h3>
                <p>Kami siap menjadi vendor dalam tender anda.</p>
                <!--<a class="btn btn-white">Selengkapnya</a>-->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if ($listproduct) : ?>
        <div class="listproduct col-xs-12 m-t-3">
            <h2 class="text-center m-b-2 fbold f22">TruMecs menyediakan</h2>
            <div class="row">
                <?php foreach ($listproduct as $index => $key) : ?>
                    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product" class="col-xs-6 text-left hv_product m-y-1 p-y-1">
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
                                <span class="f14 nomt" style="color:#ffa500;font-weight:">
                                    <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?></span>
                                </span>
                            </div>
                            <?php if (!$this->agent->is_mobile()) : ?>
                                <span id="btnbuy<?php echo $key["id"] ?>" class="btn btn-orange col-lg-12 vhidden"><i class="fa fa-shopping-cart"></i> Beli</span>
                            <?php endif ?>
                        </a>
                    </div>
                    <?php echo ($index + 1) % 2 == 0 ? '</div><div class="row">' : '' ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>