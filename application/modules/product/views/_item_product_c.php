<div class="col-lg-3 mb-3">
    <div class="card h-100 d-flex flex-column border-0 shadow" itemscope itemtype="http://schema.org/Product">
        <a class="<?php echo $this->uri->segment(1) == '' ? 'random-product' : 'related-product' ?> text-decoration-none flex-grow-1 d-flex flex-column"
            itemprop="url"
            href="<?php echo base_url() ?>product/<?php echo $key['id'] ?>/<?php echo preg_replace('/[^a-zA-Z0-9]/', '-', ucwords(strtolower($key['tittle']))) ?>">

            <?php
            $lfp = strlen($key['img']);
            $ext = substr($key['img'], $lfp - 4);
            is_file('public/image/product/' . $key['img']) != 1 ? $key['img'] = '../noimage.png' : $key['img'];
            $percent = 90;
            $pricepromo = '';
            $hasDiscount = false;

            if ($key['price_promo'] != 0) {
                $key['price'] = ($key['price'] != 0) ? $key['price'] : $key['price_promo'];
                $got = $key['price_promo'];
                $total = $key['price'];
                $percent = ($got / $total) * 100;
                $pricepromo = $key['price'];
                $hasDiscount = true;
            } else {
                $pricepromo = ($key['price'] * 100) / $percent;
                $hasDiscount = false;
            }
            ?>

            <!-- Gambar Produk -->
            <div class="card-img-container" style="height: 170px;">
                <img src="<?php echo base_url() ?>timthumb?src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == '.jpg') ? $key['img'] : '../noimage.png'; ?>"
                    alt="<?php echo $key['tittle']; ?>"
                    class="img-fluid w-100 h-100 object-fit-cover"
                    itemprop="image"
                    style="object-fit: cover;">
            </div>

            <!-- Konten Card -->
            <div class="card-body p-2 flex-grow-1 d-flex flex-column">
                <!-- Judul Produk -->
                <div class="product-title mb-1" style="min-height: 50px;">
                    <h4 itemprop="name" class="fs-6 fw-semibold text-dark mb-0" style="line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        <?php echo ucwords($key['tittle']) ?>
                    </h4>
                </div>

                <!-- Area Harga dan Diskon -->
                <div class="price-area mt-auto">
                    <?php if ($hasDiscount) : ?>
                        <!-- Diskon -->
                        <div class="discount-info mb-1">
                            <div class="d-flex align-items-center">
                                <span class="text-danger fw-bold me-2">
                                    <?php echo ceil(100 - $percent) ?><small>%</small>
                                </span>
                                <span class="text-muted text-decoration-line-through small">
                                    Rp <?php echo number_format($pricepromo, 0, ',', '.'); ?>
                                </span>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Spacer untuk konsistensi tinggi jika tidak ada diskon -->
                        <div class="discount-placeholder mb-1" style="height: 24px;"></div>
                    <?php endif; ?>

                    <!-- Harga Sekarang -->
                    <div class="current-price">
                        <h4 class="fs-6 fw-bold mb-0" style="color: #fa8420;">
                            <span itemprop="priceCurrency" content="IDR">Rp</span>
                            <span itemprop="price">
                                <?php echo number_format(($key['price_promo'] == '0') ? $key['price'] : $key['price_promo'], 0, ',', '.'); ?>
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
        </a>

        <!-- Tombol Beli - Selalu di bawah -->
        <div class="card-footer border-0 p-0 mt-auto">
            <button id="btnbuy<?php echo $key['id'] ?>"
                class="btn btn-primary w-100 rounded-0 py-2">
                <i class="bi bi-cart3 me-1"></i>
                Beli
            </button>
        </div>
    </div>
</div>