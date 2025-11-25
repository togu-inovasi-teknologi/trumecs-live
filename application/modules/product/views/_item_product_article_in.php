<!-- <div class="<?= isset($class) ? $class : 'col-lg-6' ?>">
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
</div> -->

<div class="<?= isset($class) ? $class : 'col-lg-12 mb-4' ?>">
    <div class="card shadow-sm h-100 d-flex flex-column" style="border-radius: 0;">
        <a class="<?php echo $this->uri->segment(1) == '' ? 'random-product' : 'related-product' ?> text-decoration-none d-flex flex-column h-100" itemprop="url"
            href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
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

            <!-- Image Section -->
            <div class="flex-shrink-0">
                <img src=" <?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/product/<?= in_array($extension, $acceptExtenstion) ? $key["img"] : "../noimage.png"; ?>"
                    alt="<?php echo $key["tittle"]; ?>" class="w-100" style="object-fit: contain;">
            </div>

            <!-- Content Section - Flex grow untuk push button ke bawah -->
            <div class="flex-grow-1 d-flex flex-column px-2 py-3">
                <!-- Title dengan line clamp -->
                <p itemprop="name" class="fs-6 text-dark mb-2 line-clamp-3" style="min-height: 4.5rem;">
                    <?php echo ucwords($key["tittle"]) ?>
                </p>

                <!-- Discount & Price -->
                <div class="mt-auto">
                    <?php if ($key["price_promo"] != 0 && $percent < 100): ?>
                        <p class="fs-6 fw-bold text-danger mb-1">
                            <?php echo ceil(100 - $percent) ?><small>%</small>
                            <span class="fs-6 text-muted ms-1">
                                <small><s><?php echo "Rp " . number_format($pricepromo, 0, ',', '.'); ?></s></small>
                            </span>
                        </p>
                    <?php endif; ?>

                    <!-- Current Price -->
                    <p class="fs-6 fw-bold text-dark mb-1">
                        <span itemprop="priceCurrency" content="IDR">Rp</span>
                        <span itemprop="price">
                            <?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?>
                        </span>
                    </p>
                </div>
            </div>

            <!-- Button selalu di bawah -->
            <div class="flex-shrink-0">
                <span id="btnbuy<?php echo $key["id"] ?>" class="btn btn-primary w-100 rounded-0">
                    <i class="fas fa-shopping-cart"></i> Beli
                </span>
            </div>
        </a>
    </div>
</div>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }
</style>