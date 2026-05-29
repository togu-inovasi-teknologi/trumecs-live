<section class="steps-process-section pt-2" style="background-color: #f8f9fa;">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div id="carouselExample" class="carousel slide px-0" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="<?php echo base_url(); ?>promo" target="_blank" class="click-banner-utama-ab-bekas" data-google-tag="Banner Alat Berat Bekas">
                            <img src="<?php echo base_url() ?>timthumb?h=600&src=<?php echo base_url(); ?>/public/banner/home-mobile/6.png" class="d-block w-100" alt="banner trumecs.com">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url() ?>timthumb?h=800&src=<?php echo base_url(); ?>/public/banner/home-mobile/7.png" class="d-block w-100" alt="banner langkah">
                    </div>
                    <div class="carousel-item">
                        <a href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan Scrap alat berat, Saya mempunyai alat berat untuk di scrap, apa yang harus saya lakukan untuk menscrap alat berat saya?") ?>" target="_blank" class="click-wa-scrap-ab" data-google-tag="Banner Scrap Alat Berat Bekas">
                            <img src="<?php echo base_url() ?>timthumb?h=600&src=<?php echo base_url(); ?>/public/banner/promo-home/banner-scrap-utama.png" class="d-block w-100" alt="banner trumecs.com">
                        </a>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="blueprint-categories">
    <div class="container px-0">
        <p class="text-center my-3 fw-bold fs-3">Kategori Produk</p>
        <div class="d-flex flex-wrap gap-3 justify-content-between">
            <?php
            $categories = main_categories();
            foreach ($categories as $index => $i) :
            ?>
                <a href="<?php echo base_url(); ?>category/<?= $i['id'] ?>" class="card" style="width: calc(16.666% - 1rem);">
                    <div class="card-body p-2 d-flex flex-column justify-content-end align-items-center" style="height: 250px; background-image: url(<?php echo base_url() ?>timthumb?h=400&src=<?php echo base_url() ?>/public/upload/categori/<?= $i['img'] ?>);background-size: cover; position: relative; overflow: hidden;">
                        <div class="overlay-categori"></div>
                        <p class="fw-bold fs-6 mb-0 text-center text-white" style="z-index: 2;"><?= $i['name'] ?></p>
                    </div>
                </a>
            <?php
            endforeach; ?>
        </div>
    </div>
</section>

<?php if (count($listpromo) >= 1) { ?>
    <section class="promo-landing mb-3 mt-5">
        <div class="container d-flex flex-column gap-3 px-0">
            <p class="text-center my-3 fw-bold fs-3">Promo Trumecs</p>
            <div class="row">
                <div id="carousel-banner-2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="<?php echo base_url(); ?>product/1770/Turalik-52" target="_blank" class="click-banner-turalik-52" data-google-tag="Banner Promo Turalik 52">
                                <img src="<?php echo base_url() ?>timthumb?h=400&src=<?php base_url(); ?>/public/banner/promo-home/turalik-52.png" alt="Promo harga murah untuk Pertamina Turalik 52" class="img-fluid w-100" style="height: 376px;">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="<?php echo base_url(); ?>product/2009/Meditran-Sx-Plus-15w-40-Ci4" target="_blank" class="click-banner-meditran-sx-plus" data-google-tag="Banner Promo Meditran SX Plus">
                                <img src="<?php echo base_url() ?>timthumb?h=400&src=<?php base_url(); ?>/public/banner/promo-home/meditran-sx-plus.png" alt="Promo harga murah untuk Pertamina SX Plus 15w 40 CI4" class="img-fluid w-100" style="height: 376px;">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan Scrap alat berat, Saya mempunyai alat berat untuk di scrap, apa yang harus saya lakukan untuk menscrap alat berat saya?") ?>" target="_blank" class="click-wa-scrap-ab-sub" data-google-tag="Banner Sub Scrap Alat Berat Bekas">
                                <img src="<?php echo base_url() ?>timthumb?h=400&src=<?php base_url(); ?>/public/banner/promo-home/banner-scrap-sub.png" alt="Scrap alat berat di trumecs.com" class="img-fluid w-100" style="height: 376px;">
                            </a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-banner-2" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-banner-2" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="row mt-4">
                <div id="carouselPromo" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : '';
                        $chunkedPromo = array_chunk($listpromo, 3);

                        foreach ($chunkedPromo as $index => $promoGroup) :
                        ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="row g-3">
                                    <?php foreach ($promoGroup as $key) : ?>
                                        <div class="col-md-4">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body p-3 d-flex flex-column">
                                                    <a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="h6 text-dark fw-bold text-decoration-none border-start border-4 border-<?= $key['type'] == "promo" ? 'danger' : 'warning' ?> ps-3 d-inline-block mb-2 click-pilih-promo-home" data-google-tag="Home - <?php echo $key['name']; ?>">
                                                        <?php $str_name = str_split($key["name"], 60); ?>
                                                        <?php echo count($str_name) > 1 ? $str_name[0] . "..." : $str_name[0] ?>

                                                        <?php if ($key['type'] == "bundle") { ?>
                                                            <div class="text-start mt-2">
                                                                <p class="small mb-0"><span class="fw-bold"><?= count($key['products']); ?> item</span> dengan harga</p>
                                                                <span class="fw-bold text-warning fs-5">Rp <?php echo number_format($key["price"], 0, ',', '.'); ?></span>
                                                            </div>
                                                        <?php } ?>


                                                        <img title="<?php echo $key["name"] ?>"
                                                            src="<?php echo $imgonmobile ?><?php echo base_url() ?>timthumb?h=300&src=<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>"
                                                            class="img-fluid w-100 mt-2"
                                                            alt="<?php echo $key["name"] ?>"
                                                            style="height: 150px; object-fit: contain; width: 100%;">

                                                        <div class="mt-2 flex-grow-1">
                                                            <?php $str = str_split($key["description"], 100); ?>
                                                            <p class="text-secondary small mb-2"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0] ?></p>
                                                        </div>
                                                        <div class="mt-2 flex-grow-1">
                                                            <p class="text-warning small mb-2">Lihat Selengkapnya</p>
                                                        </div>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (count($listpromo) > 3) : ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPromo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPromo" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>




<section class="category-pelumas my-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[0];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg ps-0">
                <h2 class="fw-bold ps-2"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-pelumas-base position-relative ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[16]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-pelumas-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[16]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[16]['name'] ?></h4>
                        <h6 class="text-white">Tingkatkan performa mesin Anda! Formula canggih untuk performa kelas atas dan keandalan jangka panjang.</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-pelumas-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="text-white">Kualitas tak tertandingi untuk meningkatkan efisiensi dan perlindungan transmisi.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[8]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1 pe-0" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[8]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[8]['name'] ?></h4>
                                            <h6 class="text-white">Maksimalkan umur dan performa mesin dengan pelumas industri berkualitas tinggi!</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                                            <h6 class="text-white">Memastikan pengoperasian yang lancar dan menjaga kesehatan komponen agar tahan lama.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[18]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1 pe-0" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[18]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[18]['name'] ?></h4>
                                            <h6 class="text-white">Optimalkan transfer torsi sekaligus mengurangi gesekan dan kebisingan.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ban
    <section class="banner-ads mt-3 mb-3">
        <div class="container">
            <a href="https://ers-id.informa-info.com/wri25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran Water Indonesia 2025">
                <div class="row">
                    <div class="col-lg banner-front rounded-3 p-3" style="background-color: #000000;">
                        <div class="d-flex flex-column gap-3 col-lg-8">
                            <h3 class="fw-bold text-white">KETERSEDIAAN BAN TERJAMIN </h3>
                            <h5 class="text-white">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                        </div>
                        <img src="/public/landing/ads/Trumecs-WI.gif" alt="Banner Water Indonesia 2025" class="img-fluid position-absolute top-0 end-0" style="width:100%">
                    </div>
                </div>
            </a>
        </div>
    </section> -->

<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[1];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg ps-0">
                <h2 class="fw-bold ps-2"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Maksimalkan produktivitas dengan ban OTR yang tangguh untuk pertambangan dan konstruksi.</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="text-white">Cengkeram jalan dengan penuh percaya diri ban premium untuk setiap perjalanan.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="text-white">Dipercaya oleh pengendara untuk performa andal di jalan perkotaan maupun jalan raya.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="text-white">Pelepasan panas yang optimal untuk menjaga suhu tetap stabil dalam operasional jarak jauh.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[4]['name'] ?></h4>
                                            <h6 class="text-white">Desain tapak yang dioptimalkan untuk traksi maksimal di kondisi basah maupun kering.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Aksesoris -->
<!-- <section class="category-ban mb-3">
        <div class="container">
            <div class="row d-flex flex-column gap-2">
                <?php
                $mainCategory = main_categories()[6];
                $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
                ?>
                <div class="col-lg">
                    <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
                </div>
                <div class="col-lg d-flex category-ban-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                        <div class="d-flex flex-column gap-3">
                            <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                            <h6 class="text-white">Kurangi keausan dengan aksesori alat berat berkualitas tinggi.</h6>
                        </div>
                    </a>
                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));">
                        <div class="d-flex flex-column gap-3">
                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                            <h6 class="text-white">Maksimalkan kenyamanan pengemudi dan fungsionalitas kendaraan di setiap perjalanan.</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> -->

<!-- Sparepart -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[3];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg ps-0">
                <h2 class="fw-bold ps-2"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative px-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Sparepart andal untuk menjaga produktivitas alat berat di setiap proyek.</h6>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                        <h6 class="text-white">Komponen berkualitas untuk mendukung perjalanan jarak jauh yang aman dan lancar.</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Unit -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[4];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg ps-0">
                <h2 class="fw-bold ps-2"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Tulang punggung sistem logistik dan transportasi publik.</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="text-white">Dirancang untuk tenaga, stabilitas, dan performa terbaik di lokasi kerja.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="text-white">Teknologi inovatif untuk mengoptimalkan proses penanaman dan panen.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="text-white">Dirancang untuk lautan kapal laut andal untuk berbagai misi. Dibuat untuk keamanan dan stabilitas di perairan yang ganas.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tools -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[5];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg ps-0">
                <h2 class="fw-bold ps-2"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Peralatan yang tepat membuat setiap pekerjaan lebih aman dan efisien.</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="text-white">Lindungi tenaga kerja Anda dengan perlengkapan dan alat keselamatan bersertifikasi. Perlengkapan keselamatan yang tahan lama, dirancang untuk kenyamanan dan performa maksimal.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="text-white">Tingkatkan produktivitas dengan teknologi inovatif yang menghemat waktu. Solusi cerdas untuk para profesional yang mengutamakan kualitas terbaik.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin: 5% auto;">
        <form action="<?= base_url('/share_compare') ?>" method="POST" id="form-share">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="shareModalLabel"><i class="fa fa-fw fa-share"></i> Share Komparasi</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="share_input_category_id">
                    <div class="form-group tags-input">
                        <label for="input-tag" class="form-label">Tambah Penerima:</label>
                        <ul id="tags"></ul>
                        <input type="text" class="form-control" id="input-tag">
                    </div>

                    <div class="row">
                        <div class="col-lg-12" id="document-compare">

                        </div>
                    </div>
                    <div id="input-email-validator">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-share-submit">Bagikan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<style>
    .overlay-categori {
        height: 250px;
        width: 182px;
        background: linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(255, 255, 255, 0.13) 45%);
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }
</style>