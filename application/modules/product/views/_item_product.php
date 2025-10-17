<div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-left hv_product p-x-0 m-l-1 m-b-1" style="background:#fff;border-radius:5px;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;width:<?php echo $this->agent->is_mobile() ? 48.5 : 24 ?>%;border:none;margin-left:3px !important;">
    <a class="<?php echo $this->uri->segment(1) == '' ? 'random-product' : "related-product" ?>" itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
        <?php
        $lfp = strlen($key["img"]);
        $ext = substr($key["img"], $lfp - 4);
        is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
        ?>
        <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg") ? $key["img"] : "../noimage.png"; ?>)">
        </div>
        <h4 itemprop="name" style="height:35px;display:inline-block;float:left;padding:7px !important;overflow:hidden;" class="<?php echo $this->agent->is_mobile() ? 'f12' : 'f14' ?> col-xs-12"><?php echo ucwords($key["tittle"]) ?></h4>
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
        <div class="p-a-1" itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="padding:5px !important">
            <span class="fbold nomb label label-warning" style="font-weight:bold"><?php echo ceil(100 - $percent) ?><small>%</small></span>
            <span class="f12 nomb" style="color:#999"><small><strike><?php echo "Rp." . number_format($pricepromo); ?></strike></small></span>
            <br />
            <span class="f14 nomt fbold" style="//color:#ffa500;">
                <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?></span>
            </span>
        </div>
    </a>
</div>