<div class="col-lg-3 m-b-1">
    <div class="card card-shadow">
        <a class="<?php echo $this->uri->segment(1) == '' ? 'random-product' : "related-product" ?>" itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>" style=" text-decoration:none;">
            <?php
            $lfp = strlen($key["img"]);
            $ext = substr($key["img"], $lfp - 4);
            is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
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
            <img src=" <?php echo base_url() ?>timthumb?src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg") ? $key["img"] : "../noimage.png"; ?>" alt="<?php echo $key["tittle"]; ?>" style="width: 100%; max-height:170px; margin-bottom:16px;">
            <div class="p-x-1 info" style="height: 90px;">
                <div class="value">
                    <h4 itemprop="name" class="f13 fblack"><?php echo ucwords($key["tittle"]) ?></h4>
                </div>
                <h4 class="f14 fbold fred"><?php echo ceil(100 - $percent) ?><small>%</small>
                    <span class="f11" style="color:#999"><small><strike><?php echo "Rp " . number_format($pricepromo, 0, ',', '.'); ?></strike></small></span>
                </h4>
                <h4 class="f13 fbold fblack">
                    <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?></span>
                </h4>
            </div>
            <span id="btnbuy<?php echo $key["id"] ?>" class="btn btnnew btn-block"><i class="fa fa-shopping-cart"></i>
                Beli</span>
        </a>
    </div>
</div>