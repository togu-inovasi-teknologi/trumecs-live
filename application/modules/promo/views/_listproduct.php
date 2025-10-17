<?php
$img_promo = '<img alt="promo trumecs" class="promo-small" style="right:12px;top:-2px;position:absolute" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo-special.png" width="70">';
$img_promo_red = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo-special.png" width="70">';
$productimgonmobile = base_url() . 'timthumb?h=200&src='


?>
<div class="listproduct row" itemtype="http://schema.org/ItemList">
    <?php if (!empty($listproduct)) { ?>
        <?php foreach ($listproduct as $key) : ?>
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product" class="col-lg-3">
                <div class="card card-shadow">
                    <div class="row">
                        <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
                            <?php
                            $lfp = strlen($key["img"]);
                            $ext = substr($key["img"], $lfp - 4);
                            is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
                            ?>
                            <div class="col-lg-12">
                                <img src="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg") ? $key["img"] : "../noimage.png"; ?>" alt="<?php echo $key["tittle"]; ?>" style="width: 100%;border-bottom:0.5px solid #ccc;">
                                <?php echo $img_promo; ?>
                            </div>
                            <div class="clearfix m-b-1"></div>
                            <div class="col-lg-12 p-x-2">
                                <h4 itemprop="name" class="f13 fblack"><?php echo ucwords(strtolower((strlen($key["tittle"]) <= 20) ? $key["tittle"] : substr($key["tittle"], 0, 20) . "...")) ?></h4>
                            </div>
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
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="col-lg-12 p-x-2">
                                <!-- <span class="spanpercent" style="background-color:#BF1E2D;position: inherit !important;">
                            <?php echo ucwords(strtolower((strlen($datalist["promo"][0]['name']) <= 18) ? $datalist["promo"][0]['name'] : substr($datalist["promo"][0]['name'], 0, 18) . "...")) ?>
                        </span> -->
                                <span class="f14 fblack" style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp </span> <span class="fbold" itemprop="price"><?php echo  number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ',', '.'); ?></span></span>
                            </div>
                            <div class="clearfix m-b-1"></div>
                            <div class="col-lg-12">
                                <span id="btnbuy<?php echo $key["id"] ?>" class="btn btnnew btn-block"><i class="fa fa-shopping-cart"></i> Beli</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php } else { ?>
        <div class="col-lg-12 text-left product">
            <div class="alert alert-warning">
                <h4>Tidak ada product dalam promo ini</h4>
            </div>
        </div>
    <?php } ?>
</div>