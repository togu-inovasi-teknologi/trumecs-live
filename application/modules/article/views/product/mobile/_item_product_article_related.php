<div class="col-6">
    <div class="card card-product-mobile shadow-sm h-100 d-flex flex-column" style="border-radius: 8px;">
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
            <div class="flex-shrink-0 p-2">
                <img src="<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/product/<?= in_array($extension, $acceptExtenstion) ? $key["img"] : "../noimage.png"; ?>"
                    alt="<?php echo $key["tittle"]; ?>"
                    class="w-100"
                    style="height: 120px; object-fit: contain;">
            </div>

            <!-- Content Section -->
            <div class="flex-grow-1 d-flex flex-column px-2 pb-2">
                <!-- Title dengan line clamp untuk mobile -->
                <p itemprop="name" class="fs-7 text-dark mb-2 line-clamp-2" style="min-height: 2.5rem;">
                    <?php echo ucwords($key["tittle"]) ?>
                </p>

                <!-- Discount & Price -->
                <div class="mt-auto">
                    <?php if ($key["price_promo"] != 0 && $percent < 100): ?>
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge bg-danger me-1 fs-8">
                                <?php echo ceil(100 - $percent) ?>%
                            </span>
                            <span class="fs-8 text-muted">
                                <s><?php echo "Rp " . number_format($pricepromo, 0, ',', '.'); ?></s>
                            </span>
                        </div>
                    <?php endif; ?>

                    <!-- Current Price -->
                    <p class="fs-6 fw-bold text-dark mb-2">
                        <span itemprop="priceCurrency" content="IDR">Rp</span>
                        <span itemprop="price">
                            <?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ",", "."); ?>
                        </span>
                    </p>
                </div>
            </div>

            <!-- Button Section -->
            <div class="flex-shrink-0">
                <span id="btnbuy<?php echo $key["id"] ?>" class="btn btn-primary w-100 rounded-bottom-2 fs-8 py-2">
                    <i class="fas fa-shopping-cart me-1"></i> Beli
                </span>
            </div>
        </a>
    </div>
</div>

<style>
    .card-product-mobile {
        transition: all 0.2s ease;
        border: 1px solid #f0f0f0;
    }

    .card-product-mobile:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1) !important;
    }

    /* Line clamp untuk mobile */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Font size utilities untuk mobile */
    .fs-7 {
        font-size: 0.875rem !important;
    }

    .fs-8 {
        font-size: 0.75rem !important;
    }

    /* Responsive border radius */
    .rounded-bottom-2 {
        border-bottom-left-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
    }

    /* Touch-friendly button */
    .btn {
        min-height: 44px;
    }
</style>