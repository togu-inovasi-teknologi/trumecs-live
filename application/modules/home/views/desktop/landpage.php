<div class="row">
    <section id="banner">
        <div class="col-lg-12 p-r-0">
            <div class="row">
                <div class="col-lg-4 p-r-0" style="background-color:#e6e6e6;padding-top:68px;padding-bottom:85px;">
                    <div class="row p-l-1">
                        <div class="col-lg-12">
                            <h6 class="forange f14">Punya alat atau menyediakan jasa?</h6>
                            <h3>Raih <span class="forange">Pasar Global</span><br>Bersama<span class="forange">Trumecs</span></h3>
                        </div>
                        <div class="clearfix m-b-2"></div>
                        <div class="col-lg-12">
                            <a href="<?php echo base_url() ?>page" class="btn btnnew f12">Pelajari Trumecs</a>
                            <a href="<?php echo base_url() ?>member/signup" class="btn btnnewwhite f12">Bergabung Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 p-l-0 slick-banner-home">
                    <img src=" <?php echo base_url(); ?>public/banner/pamerindo-manufacturing.jpeg" alt="banner-4" style="height: 300px;width:100%;">
                    <img src=" <?php echo base_url(); ?>public/banner/banner-tentang-kami.jpeg" alt="banner-1" style="height: 300px;width:100%;">
                </div>
            </div>
        </div>
        <div class="col-lg-12 banner-home p-x-0">
            <div class="row slick-banner-home-2">
                <div class="col-lg-12">
                    <img src=" <?php echo base_url(); ?>public/banner/pamerindo-manufacturing.jpeg" alt="banner-4" style="height: 300px;width:100%;">
                </div>
                <div class="col-lg-12">
                    <img src=" <?php echo base_url(); ?>public/banner/banner-tentang-kami.jpeg" alt="banner-1" style="height: 300px;width:100%;">
                </div>
            </div>
            <div class="prev-banner-home">
                <button class="btn btnnew"><i class="fa fa-angle-right"></i></button>
            </div>
            <div class="next-banner-home">
                <button class="btn btnnew"><i class="fa fa-angle-left"></i></button>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <!-- <div class="col-lg-12 title-desktop">
            <a href="" class="title-content">Flash Sale</a>
        </div>
        <div class="clearfix" style="margin-bottom: 30px;"></div>
        <div class="col-lg-12">
        </div>
        <div class="clearfix" style="margin-bottom: 50px;"></div> -->
    <?php if (count($listpromo) < 1) : ?>
    <?php else : ?>
        <section id="promo">
            <div class="col-lg-12 p-x-0">
                <div class="row">
                    <div class="col-lg-12 title-desktop">
                        <a href="<?php echo base_url(); ?>promo" class="title-content">Promo</a>
                    </div>
                    <div class="clearfix" style="margin-bottom: 30px;"></div>
                    <div class="col-lg-12 promo-home">
                        <?php echo $this->load->view("promo/_promo_home.php") ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="kategori">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop">
                    <a href="" class="title-content">Browse by Categories</a>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php foreach ($getcategory as $i) : ?>
                            <div class="col-lg-1--5">
                                <a href="<?php echo base_url() ?>c/<?php echo $i["url"] ?>" style="text-decoration: none;">
                                    <div class="card text-center card-shadow p-a-1">
                                        <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $i["url"]; ?>.png" alt="<?php echo $i["name"]; ?>">
                                        <h6 class="fblack f13 fbold m-t-1"><?php echo $i["name"]; ?></h6>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="brand">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop">
                    <a href="" class="title-content">Browse by Brands</a>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12 brands">
                    <div class="row slick-brands-even">
                        <?php $in = 1;
                        foreach ($getbrand as $i) : ?>
                            <?php if ($in % 2 == 1) : ?>
                                <div class="col-lg-2">
                                    <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>">
                                        <div class="card card-brand text-center card-shadow">
                                            <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" />
                                        </div>
                                    </a>
                                </div>
                            <?php endif ?>
                        <?php $in++;
                        endforeach ?>
                    </div>
                    <div class="row slick-brands-odd">
                        <?php $in = 1;
                        foreach ($getbrand as $i) : ?>
                            <?php if ($in % 2 == 0) : ?>
                                <div class="col-lg-2">
                                    <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>">
                                        <div class="card card-brand text-center card-shadow">
                                            <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" />
                                        </div>
                                    </a>
                                </div>
                            <?php endif ?>
                        <?php $in++;
                        endforeach ?>
                    </div>
                    <div class="prev-brands">
                        <button class="btn btnnew"><i class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="next-brands">
                        <button class="btn btnnew"><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="top-product">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop">
                    <a href="" class="title-content">Top Product</a>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12 product-home">
                    <div class="listproduct row slick-product-home">
                        <?php
                        $i = 1;
                        foreach ($listproduct as $key) :
                            $this->load->view('product/_item_product_home.php', array('key' => $key));
                        endforeach; ?>
                    </div>
                    <div class="prev-product-home">
                        <button class="btn btnnew"><i class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="next-product-home">
                        <button class="btn btnnew"><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="best-seller">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop d-flex-sb">
                    <a href="" class="title-content m-r-2">Best Seller</a>
                    <?php foreach ($getcategory as $i) : ?>
                        <a href="<?php echo base_url() ?>/c/<?php echo $i["url"]; ?>" class="title-home-category m-r-2"><?php echo $i['name']; ?></a>
                    <?php endforeach ?>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12 best-seller-home">
                    <div class="listproduct row slick-best-seller-home" style="overflow: visible;">
                        <?php
                        $i = 1;
                        foreach ($listproduct as $key) :
                            $this->load->view('product/_item_product_home.php', array('key' => $key));
                        endforeach; ?>
                    </div>
                    <div class="prev-best-seller-home">
                        <button class="btn btnnew"><i class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="next-best-seller-home">
                        <button class="btn btnnew"><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="principal">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop">
                    <a href="" class="title-content">Bergabung dengan Tru<span class="forange">mecs</span></a>
                    <a href="<?php echo site_url('partnership'); ?>" class="btn btnhome pull-right">Bergabung Sekarang</a>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12">
                    <div class="row text-center">
                        <div class="col-lg-4">
                            <div class="card p-a-2" style="width: 100%; height:200px; background-color: white;">
                                <div class="col-lg-12">
                                    <img class="m-b-1" style="width: 70px; height:70px;" src="<?php echo base_url() ?>public/icon/supply-chain-management.png" />
                                    <h4 style="color: #fa8420;">Menjadi Principal</h4>
                                    <p style="color: #000; font-size:small;">Pasarkan produk anda bersama Trumecs untuk menjangkau pasar potensial</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class=" card p-a-2" style="width: 100%; height:200px; background-color: white;">
                                <div class="col-lg-12">
                                    <img class="m-b-1" style="width: 70px; height:70px;" src="<?php echo base_url() ?>public/icon/car-rent.png" />
                                    <h4 style="color: #fa8420;">Rental Alat</h4>
                                    <p style="color: #000; font-size:small;">Pasarkan produk anda bersama Trumecs untuk menjangkau pasar potensial</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class=" card p-a-2" style="width: 100%; height:200px; background-color: white;">
                                <div class="col-lg-12">
                                    <img class="m-b-1" style="width: 70px; height:70px;" src="<?php echo base_url() ?>public/icon/car.png" />
                                    <h4 style="color: #fa8420;">Vendor Jasa</h4>
                                    <p style="color: #000; font-size:small;">Pasarkan produk anda bersama Trumecs untuk menjangkau pasar potensial</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="article">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop">
                    <a href="<?php echo base_url(); ?>article" class="title-content">Article</a>
                    <a href="<?php echo site_url('article'); ?>" class="btn btnhome pull-right">Lihat Semua</a>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12 m-b-1 article-home">
                    <div class="row slick-article-home">
                        <?php echo $this->load->view('article/_article_vertical_home', array('article' => $newartikel, 'media' => null)); ?>
                    </div>
                    <div class="prev-article-home">
                        <button class="btn btnnew"><i class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="next-article-home">
                        <button class="btn btnnew"><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix" style="margin-bottom: 50px;"></div>
    <section id="usp">
        <div class="col-lg-12 p-x-0">
            <div class="row">
                <div class="col-lg-12 title-desktop">
                    <a href="<?php echo base_url(); ?>article" class="title-content">Ini alasan kenapa anda berbelanja di Tru<span class="forange">mecs</span></a>
                </div>
                <div class="clearfix" style="margin-bottom: 30px;"></div>
                <div class="col-lg-12 m-b-2">
                    <div class="row text-center">
                        <div class="col-lg-4">
                            <img alt="Produk Terlengkap" src="<?php echo base_url("public/icon/usp/usp-secure.png"); ?>"><br><br>
                            <p class="f30 fbold">Secure</p>
                            <span class="f14" style="line-height: 10px;">Kami menciptakan lingkungan yang aman dan terpercaya dari penawaran hingga after sales, kami jamin keamanan anda</span>
                        </div>
                        <div class="col-lg-4">
                            <img alt="Pengiriman Cepat" src="<?php echo base_url("public/icon/usp/usp-valid.png"); ?>"><br><br>
                            <p class="f30 fbold">Valid
                            </p>
                            <span class="f14">Kami menerapkan validasi dan verifikasi yang ketat pada jaringan pembeli dan penjual kami, untuk menjamin interaksi yang terpercaya.</span>
                        </div>
                        <div class="col-lg-4">
                            <img alt="Potensi Keuntungan" src="<?php echo base_url("public/icon/usp/usp-transparant.png"); ?>"><br><br>
                            <p class="f30 fbold">Transparant
                            </p>
                            <span class="f14">Trumecs mewujudkan transparansi dalam setiap transaksi, dengan menyajikan seluruh informasi terkain produk dan proses secara jelas dan terperinci</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- <script type="text/javascript">
    function getTimeRemaining(endtime) {
        const total = Date.parse(endtime) - Date.parse(new Date());
        const seconds = Math.floor((total / 1000) % 60);
        const minutes = Math.floor((total / 1000 / 60) % 60);
        const hours = Math.floor((total / (1000 * 60 * 60)) % 24);

        return {
            total,
            hours,
            minutes,
            seconds
        };
    }

    function initializeClock(id, endtime) {
        const clock = document.getElementById(id);
        const hoursSpan = clock.querySelector('.hours');
        const minutesSpan = clock.querySelector('.minutes');
        const secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            const t = getTimeRemaining(endtime);

            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        const timeinterval = setInterval(updateClock, 1000);
    }

    const deadline = new Date(Date.parse(new Date()) + 24 * 60 * 60 * 1000);
    initializeClock('clockdiv', deadline);
</script> -->