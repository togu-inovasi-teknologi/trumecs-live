<section style="background-color: #f8f9fa; height:450px;" class="mb-2">
    <div class="container px-0" style="background-color: #f8f9fa; height:450px;">
        <div id="carouselExample" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <a href="<?php base_url(); ?>promo" target="_blank" class="click-banner-utama-ab-bekas-mobile" data-google-tag="Mobile - Banner alat Berat Bekas">
                        <img src="<?php echo base_url() ?>timthumb?h=600&src=<?php base_url(); ?>/public/banner/home-mobile/1.png" class="d-block" style="width: 100%; height: 100%; max-height: 450px; object-fit: contain;" alt="banner trumecs.com">
                    </a>
                </div>
                <div class="carousel-item h-100">
                    <img src="<?php echo base_url() ?>timthumb?h=700&src=<?php base_url(); ?>/public/banner/home-mobile/2.png" class="d-block" style="width: 100%; height: 100%; max-height: 450px; object-fit: contain;" alt="banner Langkah">
                </div>
                <div class="carousel-item h-100">
                    <a href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan Scrap alat berat, Saya mempunyai alat berat untuk di scrap, apa yang harus saya lakukan untuk menscrap alat berat saya?") ?>" target="_blank" class="click-wa-scrap-ab-mobile" data-google-tag="Mobile - Banner Scrap Alat Berat Bekas">
                        <img src="<?php echo base_url() ?>timthumb?h=600&src=<?php base_url(); ?>/public/banner/promo-home/banner-scrap-utama-mobile.png" class="d-block" style="width: 100%; height: 100%; max-height: 450px; object-fit: contain;" alt="banner trumecs.com">
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
</section>

<section class="blueprint-categories">
    <div class="container px-0">
        <p class="text-center my-2 fw-bold fs-3">Kategori Produk</p>
        <?php
        $categories = main_categories();
        $chunks = array_chunk($categories, 2);
        foreach ($chunks as $chunk) :
        ?>
            <div class="row g-3 mb-3">
                <?php foreach ($chunk as $i) : ?>
                    <div class="col-6">
                        <a href="<?php echo base_url(); ?>category/<?= $i['id'] ?>" class="card h-100 text-decoration-none">
                            <div class="card-body p-2 d-flex flex-column justify-content-end align-items-center" style="height: 250px; background-image: url(<?php echo base_url() ?>timthumb?h=400&src=<?php echo base_url() ?>/public/upload/categori/<?= $i['img'] ?>); background-size: cover; background-position: center;position: relative; overflow: hidden;">
                                <div class="overlay-categori"></div>
                                <p class="fw-bold fs-6 mb-0 text-center text-white" style="z-index: 2;"><?= $i['name'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php if (count($listpromo) >= 1) { ?>
    <section class="promo-landing mb-3 mt-5">
        <div class="container d-flex flex-column gap-3 px-0">
            <p class="text-center my-3 fw-bold fs-3">Promo Trumecs</p>
            <div class="row">
                <div id="carouselPromo" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="https://www.trumecs.com" target="_blank" class="click-banner-grease-wrnl-mobile" data-google-tag="Mobile - Banner Grease WR NL">
                                <img src="<?php echo base_url() ?>timthumb?h=250&src=<?php base_url(); ?>/public/banner/promo-home/banner-promo-grease-wrnl.png" alt="Promo harga murah untuk Grease Pertamina WR NL" class="img-fluid w-100">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="<?php echo base_url(); ?>product/1872/Masri-Rg-460" target="_blank" class="click-banner-masri-rg-460-mobile" data-google-tag="Mobile - Banner Masri RG 46">
                                <img src="<?php echo base_url() ?>timthumb?h=250&src=<?php base_url(); ?>/public/banner/promo-home/banner-promo-masri.png" alt="Promo harga murah untuk Pertamina MASRI RG 460" class="img-fluid w-100">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan Scrap alat berat, Saya mempunyai alat berat untuk di scrap, apa yang harus saya lakukan untuk menscrap alat berat saya?") ?>" target="_blank" class="click-wa-scrap-ab-sub-mobile" data-google-tag="Mobile - Banner Sub Scrap Alat Berat Bekas">
                                <img src="<?php echo base_url() ?>timthumb?h=250&src=<?php base_url(); ?>/public/banner/promo-home/banner-scrap-sub.png" alt="Scrap alat berat di trumecs.com" class="img-fluid w-100">
                            </a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPromo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselPromo" data-bs-slide="next">
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
                        $chunkedPromo = array_chunk($listpromo, 1);

                        foreach ($chunkedPromo as $index => $promoGroup) :
                        ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="row g-3">
                                    <?php foreach ($promoGroup as $key) : ?>
                                        <div class="col-md-6">
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

                    <?php if (count($listpromo) > 1) : ?>
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

<!--- Pelumas -->
<section class="category-pelumas mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[0];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12 ps-0">
                <h3 class="fbold ps-2"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md-4 d-flex category-pelumas-base ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[16]['url'] ?>" class="col-md-4 p-1 item-sub h-full category-pelumas-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[16]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[16]['name'] ?></h6>
                        <p class="fwhite f11">Kualitas tak tertandingi untuk meningkatkan efisiensi dan perlindungan transmisi.</p>
                    </div>
                </a>
                <div class="col-md-8 category-pelumas-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Kualitas tak tertandingi untuk meningkatkan efisiensi dan perlindungan transmisi.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[8]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[8]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[8]['name'] ?></h6>
                                            <p class="fwhite f11">Maksimalkan umur dan performa mesin dengan pelumas industri berkualitas tinggi!</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                                            <p class="fwhite f11">Memastikan pengoperasian yang lancar dan menjaga kesehatan komponen agar tahan lama.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[18]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[18]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[18]['name'] ?></h6>
                                            <p class="fwhite f11">Optimalkan transfer torsi sekaligus mengurangi gesekan dan kebisingan.</p>
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

<!-- <section class="banner-ads m-t-3 mb-1">
    <a href="https://ers-id.informa-info.com/adx25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran ADC">
        <div class="container">
            <div class="row">
                <div class="col-md banner-front radius-md p-1" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
                    <h6 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h6>
                    <p class="fwhite f11 text-center">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</p>
                    <img src="/public/landing/ads/ads-Ban.png" alt="Ban" class="banner-ads-image">
                    https://ers-id.informa-info.com/adx25??cid=PREREG+TRUMECS
                </div>
            </div>
                <img src="/public/landing/ads/Trumecs-ADC.gif" width="100%" alt="Banner ADEXCO 2025">
            </div>
        </div>
    </a>
</section> -->

<!--- Ban -->

<section class="category-ban mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[1];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12 ps-0">
                <h3 class="fbold ps-2"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Maksimalkan produktivitas dengan ban OTR yang tangguh untuk pertambangan dan konstruksi.</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Cengkeram jalan dengan penuh percaya diri ban premium untuk setiap perjalanan.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Dipercaya oleh pengendara untuk performa andal di jalan perkotaan maupun jalan raya.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Pelepasan panas yang optimal untuk menjaga suhu tetap stabil dalam operasional jarak jauh.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h6>
                                            <p class="fwhite f11">Desain tapak yang dioptimalkan untuk traksi maksimal di kondisi basah maupun kering.</p>
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

<!--- Aksesoris -->

<!-- <section class="category-ban mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[6];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12">
                <h3 class="fbold p-l-2 my-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-6 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Kurangi keausan dengan aksesori alat berat berkualitas tinggi</p>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-6 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                        <p class="fwhite f11">Maksimalkan kenyamanan pengemudi dan fungsionalitas kendaraan di setiap perjalanan.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section> -->

<!--- Sparepart -->

<section class="category-ban mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[3];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12 ps-0">
                <h3 class="fbold ps-2"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base px-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-6 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                            <p class="fwhite f11">Sparepart andal untuk menjaga produktivitas alat berat di setiap proyek.</p>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-6 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                            <p class="fwhite f11">Komponen berkualitas untuk mendukung perjalanan jarak jauh yang aman dan lancar.</p>
                    </div>
                </a>
                <!-- <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Reduce maintenance intervals with high-performance spare parts</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Keep production running with reliable industrial spare parts</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Genuine replacements for tractors, harvesters, and implements</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h6>
                                            <p class="fwhite f11">Reliable replacements for engines, pumps, and navigation systems.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!--- Unit -->

<section class="category-ban mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[4];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12 ps-0">
                <h3 class="fbold ps-2"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Sparepart andal untuk menjaga produktivitas alat berat di setiap proyek.</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Dirancang untuk tenaga, stabilitas, dan performa terbaik di lokasi kerja.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Teknologi inovatif untuk mengoptimalkan proses penanaman dan panen.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Dirancang untuk lautan kapal laut andal untuk berbagai misi. Dibuat untuk keamanan dan stabilitas di perairan yang ganas.</p>
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

<!--- Tools -->


<section class="category-ban mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[5];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12 ps-0">
                <h3 class="fbold ps-2"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base ps-0" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Peralatan yang tepat membuat setiap pekerjaan lebih aman dan efisien.</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start pe-0">
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Lindungi tenaga kerja Anda dengan perlengkapan dan alat keselamatan bersertifikasi. Perlengkapan keselamatan yang tahan lama, dirancang untuk kenyamanan dan performa maksimal.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">ingkatkan produktivitas dengan teknologi inovatif yang menghemat waktu. Solusi cerdas untuk para profesional yang mengutamakan kualitas terbaik.</p>
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

<!--- Aksesoris -->

<!--
<section class="category-ban mb-2">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[7];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md-12">
                <h3 class="fbold p-l-2 my-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class=" col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class=" col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <h6 class="fwhite f11">Choose excellence with our premium engine oil</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class=" col-md-4 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Choose excellence with our premium engine oil!</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class=" col-md-8 p-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h6>
                                            <p class="fwhite f11">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</p>
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
-->

<style>
    .overlay-categori {
        height: 250px;
        width: 250px;
        background: linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(255, 255, 255, 0.13) 45%);
        position: absolute;
        overflow: hidden;
        top: 0;
        left: 0;
        z-index: 1;
    }
</style>