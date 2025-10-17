<div class="<?= isset($class) ? $class : 'col-lg-2--4' ?>">
    <div class="card card-shadow" style="border-radius: 0;">
        <a class="<?php echo $this->uri->segment(1) == '' ? 'random-product' : "related-product" ?>" itemprop="url"
            href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>"
            style=" text-decoration:none;">
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


            $acceptExtenstion = ['jpg', 'jpeg', 'png'];

            $explode = explode('.', $key["img"]);

            $extension = end($explode);

            ?>
            <img src=" <?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/product/<?= in_array($extension, $acceptExtenstion) ? $key["img"] : "../noimage.png"; ?>"
                alt="<?php echo $key["tittle"]; ?>" style="width: 100%; max-height:170px; margin-bottom:16px;">
            <div class="p-x-1" style="height: 90px;">
                <p itemprop="name" class="f13 fblack"><?php echo ucwords($key["tittle"]) ?></p>
                <p class="f14 fbold fred"><?php echo ceil(100 - $percent) ?><small>%</small>
                    <span class="f11"
                        style="color:#999"><small><strike><?php echo "Rp " . number_format($pricepromo, 0, ',', '.'); ?></strike></small></span>
                </p>
                <p class="f13 fbold fblack">
                    <span itemprop="priceCurrency" content="IDR">Rp</span> <span
                        itemprop="price"><?php echo  number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?></span>
                </p>
            </div>
            <span id="btnbuy<?php echo $key["id"] ?>" class="btn btnnew btn-block"><i class="fa fa-shopping-cart"></i>
                Beli</span>
        </a>
    </div>
</div>