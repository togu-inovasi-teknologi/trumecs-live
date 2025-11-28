<div class="<?= isset($class) ? $class : 'col-lg-12' ?>">
    <div class="card card-product-article-in border-none rounded-4 shadow-sm h-100 d-flex flex-column">
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

            <!-- Image Section - Ukuran diperkecil -->
            <div class="flex-shrink-0">
                <img src="<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/product/<?= in_array($extension, $acceptExtenstion) ? $key["img"] : "../noimage.png"; ?>"
                    alt="<?php echo $key["tittle"]; ?>"
                    class="w-100 rounded-top-4"
                    style="object-fit: contain; height: 120px;"
                    loading="lazy">
            </div>

            <!-- Content Section - Flex grow untuk push button ke bawah -->
            <div class="flex-grow-1 d-flex flex-column mt-2 px-3" style="min-height: 100px;">
                <!-- Title dengan line clamp -->
                <p itemprop="name" class="f8 text-dark mb-2 line-clamp-3" style="min-height: 3rem;">
                    <?php echo ucwords($key["tittle"]) ?>
                </p>

                <!-- Discount & Price -->
                <?php if ($key["price_promo"] != 0 && $percent < 100): ?>
                    <p class="f11 fw-bold text-danger mb-1">
                        <?php echo ceil(100 - $percent) ?><small>%</small>
                        <span class="f11 text-muted ms-1">
                            <small><s><?php echo "Rp " . number_format($pricepromo, 0, ',', '.'); ?></s></small>
                        </span>
                    </p>
                <?php endif; ?>

                <!-- Current Price -->
                <p class="f11 fw-bold text-dark mb-1">
                    <span itemprop="priceCurrency" content="IDR">Rp</span>
                    <span itemprop="price">
                        <?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?>
                    </span>
                </p>
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

    .card-product-article-in {
        transition: all 0.3s ease;
        height: 400px;
        /* Tinggi tetap untuk semua card */
    }

    .card-product-article-in:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }

    /* Pastikan semua card memiliki tinggi yang sama */
    .card-product-article-in .flex-grow-1 {
        flex: 1 0 auto;
    }
</style>