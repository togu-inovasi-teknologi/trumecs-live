<div class="container m-t-1">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-4">
                    <img src=" <?php echo base_url(); ?>public/banner/iklan/iklan-home.png" alt="banner-1" style="height: 40px;width:100%;">
                </div>
                <div class="col-xs-4">
                    <img src=" <?php echo base_url(); ?>public/banner/iklan/iklan-home-2.jpeg" alt="banner-2" style="height: 40px;width:100%;">
                </div>
                <div class="col-xs-4">
                    <img src=" <?php echo base_url(); ?>public/banner/iklan/iklan-home-3.jpeg" alt="banner-3" style="height: 40px;width:100%;">
                </div>
            </div>
        </div>
        <div class="clearfix" style="margin-bottom:8px"></div>
        <div class="col-xs-12">
            <img src=" <?php echo base_url(); ?>public/banner/banner-tentang-kami.jpeg" alt="banner-main" style="height: 200px;width:100%;">
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Promo</a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <?php echo $this->load->view("promo/_promo_home_mobile.php") ?>
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Browse by Categories</a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <?php foreach ($getcategory as $i) : ?>
                <a href="<?php echo base_url() ?>c/<?php echo $i["url"] ?>" style="text-decoration: none;">
                    <span class="btn btnnew f11 fbold" style="margin-bottom:4px;"><?php echo $i["name"]; ?></span>
                </a>
            <?php endforeach ?>
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Browse by Brand</a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <div class="row slick-brands-even-mobile">
                <?php $in = 1;
                foreach ($getbrand as $i) : ?>
                    <?php if ($in % 2 == 1) : ?>
                        <div class="col-xs-4">
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
        </div>
        <div class="col-xs-12" style="margin-top:-20px;">
            <div class="row slick-brands-odd-mobile">
                <?php $in = 1;
                foreach ($getbrand as $i) : ?>
                    <?php if ($in % 2 == 0) : ?>
                        <div class="col-xs-4">
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
        </div>
        <div class="clearfix" style="margin-bottom:10px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Top Product</a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <div class="listproduct row slick-product-home-mobile">
                <?php
                $i = 1;
                foreach ($listproduct as $key) :
                    $this->load->view('product/_item_product_home_mobile.php', array('key' => $key));
                endforeach; ?>
            </div>
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Best Seller</a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <div class="listproduct row slick-product-home-mobile">
                <?php
                $i = 1;
                foreach ($listproduct as $key) :
                    $this->load->view('product/_item_product_home_mobile.php', array('key' => $key));
                endforeach; ?>
            </div>
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Bergabung dengan Tru<span class="forange">mecs</span></a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <div class="col-xs-3 text-center">
                <img class="m-b-1" style="width: 50px; height:50px;" src="<?php echo base_url() ?>public/icon/supply-chain-management.png" />
            </div>
            <div class="col-xs-9">
                <h4 class="f11" style="color: #fa8420;">Menjadi Principal</h4>
                <p class="f8">Pasarkan produk anda bersama Trumecs untuk menjangkau pasar potensial</p>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-9 text-right">
                <h4 class="f11" style="color: #fa8420;">Rental Alat</h4>
                <p class="f8">Pasarkan produk anda bersama Trumecs untuk menjangkau pasar potensial</p>
            </div>
            <div class="col-xs-3 text-center">
                <img class="m-b-1" style="width: 50px; height:50px;" src="<?php echo base_url() ?>public/icon/car-rent.png" />
            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-3 text-center">
                <img class="m-b-1" style="width: 50px; height:50px;" src="<?php echo base_url() ?>public/icon/car.png" />
            </div>
            <div class="col-xs-9">
                <h4 class="f11" style="color: #fa8420;">Vendor Jasa</h4>
                <p class="f8">Pasarkan produk anda bersama Trumecs untuk menjangkau pasar potensial</p>
            </div>
        </div>
        <div class="col-xs-12 text-center">
            <a href="<?php echo base_url() ?>member/login" class="btn btnhome text-center f11">Bergabung Sekarang</a>
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Article</a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <div class="row slick-article-home-mobile">
                <?php echo $this->load->view('article/_article_vertical_mobile', array('article' => $newartikel, 'media' => null)); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 text-center">
            <a href="<?php echo base_url(); ?>article" class="btn btnhome text-center f11">Lihat Semua</a>
        </div>
        <div class="clearfix" style="margin-bottom:30px"></div>
        <div class="col-xs-12 title-mobile">
            <a href="" class="title-content">Ini alasan kenapa anda berbelanja di Tru<span class="forange">mecs</span></a>
        </div>
        <div class="clearfix" style="margin-bottom:15px"></div>
        <div class="col-xs-12">
            <div class="row" style=" line-height: 20px;">
                <div class="col-xs-12">
                    <div class="col-xs-3 text-center">
                        <img class="m-b-1" style="width: 50px; height:50px;" src="<?php echo base_url() ?>public/icon/usp/usp-secure.png" />
                    </div>
                    <div class="col-xs-9">
                        <h4 class="f11 fbold">Secure</h4>
                        <p class="f8">Kami menciptakan lingkungan yang aman dan terpercaya dari penawaran hingga after sales, kami jamin keamanan anda</p>
                    </div>
                </div>
                <div class="clearfix" style="margin-bottom:15px"></div>
                <div class="col-xs-12">
                    <div class="col-xs-3 text-center">
                        <img class="m-b-1" style="width: 50px; height:50px;" src="<?php echo base_url() ?>public/icon/usp/usp-valid.png" />
                    </div>
                    <div class="col-xs-9">
                        <h4 class="f11 fbold">Valid</h4>
                        <p class="f8">Kami menerapkan validasi dan verifikasi yang ketat pada jaringan pembeli dan penjual kami, untuk menjamin interaksi yang terpercaya.</p>
                    </div>
                </div>
                <div class="clearfix" style="margin-bottom:15px"></div>
                <div class="col-xs-12">
                    <div class="col-xs-3 text-center">
                        <img class="m-b-1" style="width: 50px; height:50px;" src="<?php echo base_url() ?>public/icon/usp/usp-transparant.png" />
                    </div>
                    <div class="col-xs-9">
                        <h4 class="f11 fbold">Transparant</h4>
                        <p class="f8">Trumecs mewujudkan transparansi dalam setiap transaksi, dengan menyajikan seluruh informasi terkain produk dan proses secara jelas dan terperinci</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>