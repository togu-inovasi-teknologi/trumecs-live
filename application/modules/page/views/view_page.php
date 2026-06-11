<!-- Banner Section -->
<section class="banner py-5" id="banner" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo base_url() ?>public/banner/banner-main.jpg'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <p class="fw-bold text-warning mb-2"><?= $this->lang->line('trumecs_is', FALSE) ?></p>
                <h1 class="fw-bold text-white display-4"><?= $this->lang->line('trumecs_tagline', FALSE) ?></h1>
                <p class="text-white lead"><?= $this->lang->line('trumecs_description', FALSE) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Content Page -->
<div class="content-page py-4" id="tentang">

    <!-- Why Trumecs Section -->
    <section class="trumecs-why py-5" id="trumecs-why">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold display-5 mb-3"><?= $this->lang->line('why_trumecs', FALSE) ?> <span class="text-warning"><?= $this->lang->line('must_trumecs', FALSE) ?></span> TRUMECS ?</h2>
                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        <?= $this->lang->line('why_must_trumecs', FALSE) ?>
                    </p>
                    <img src="<?php echo base_url() ?>public/banner/banner-tentang-kami.png" alt="" class="img-fluid w-100 rounded">
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="d-flex flex-column gap-4">
                        <!-- Card 1 -->
                        <div class="row justify-content-start">
                            <div class="col-lg-10">
                                <div class="card p-3 shadow-sm">
                                    <div class="d-flex align-items-center gap-3">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;" src="<?php echo base_url("public/icon/usp/usp-secure.png"); ?>">
                                        <div>
                                            <h6 class="fw-bold mb-1"><?= $this->lang->line('trumecs_secure_title', FALSE) ?></h6>
                                            <span class="small text-muted"><?= $this->lang->line('trumecs_secure_subtitle', FALSE) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <div class="card p-3 shadow-sm">
                                    <div class="d-flex align-items-center gap-3">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;" src="<?php echo base_url("public/icon/usp/usp-valid.png"); ?>">
                                        <div>
                                            <h6 class="fw-bold mb-1"><?= $this->lang->line('trumecs_valid_title', FALSE) ?></h6>
                                            <span class="small text-muted"><?= $this->lang->line('trumecs_valid_subtitle', FALSE) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="row justify-content-start">
                            <div class="col-lg-10">
                                <div class="card p-3 shadow-sm">
                                    <div class="d-flex align-items-center gap-3">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;" src="<?php echo base_url("public/icon/usp/usp-transparant.png"); ?>">
                                        <div>
                                            <h6 class="fw-bold mb-1"><?= $this->lang->line('trumecs_transparent_title', FALSE) ?></h6>
                                            <span class="small text-muted"><?= $this->lang->line('trumecs_transparent_subtitle', FALSE) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section -->
    <section class="service py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="fw-bold mb-2"><?= $this->lang->line('service_trumecs_title', FALSE) ?></h2>
                    <div class="bg-warning mx-auto" style="width: 80px; height: 3px;"></div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card h-100 p-3 shadow-sm text-center">
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                            <img src="<?php echo base_url() ?>public/icon/partner.png" alt="" style="width: 60px;">
                            <h5 class="fw-bold mb-0"><?= $this->lang->line('service_trumecs_sale_title', FALSE) ?></h5>
                        </div>
                        <p class="text-muted flex-grow-1"><?= $this->lang->line('service_trumecs_sale_subtitle', FALSE) ?></p>
                        <a href="/principal/form" class="btn btn-warning mt-3"><?= $this->lang->line('read_detail', FALSE) ?></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 p-3 shadow-sm text-center">
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                            <img src="<?php echo base_url() ?>public/icon/insurance.png" alt="" style="width: 60px;">
                            <h5 class="fw-bold mb-0"><?= $this->lang->line('service_trumecs_rent_title', FALSE) ?></h5>
                        </div>
                        <p class="text-muted flex-grow-1"><?= $this->lang->line('service_trumecs_rent_subtitle', FALSE) ?></p>
                        <a href="/principal/form" class="btn btn-warning mt-3"><?= $this->lang->line('read_detail', FALSE) ?></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 p-3 shadow-sm text-center">
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                            <img src="<?php echo base_url() ?>public/icon/robot.png" alt="" style="width: 60px;">
                            <h5 class="fw-bold mb-0"><?= $this->lang->line('service_trumecs_service_title', FALSE) ?></h5>
                        </div>
                        <p class="text-muted flex-grow-1"><?= $this->lang->line('service_trumecs_service_subtitle', FALSE) ?></p>
                        <a href="/principal/form" class="btn btn-warning mt-3"><?= $this->lang->line('read_detail', FALSE) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Section -->
    <section class="brand py-5 bg-dark text-white" id="brand">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h3 class="fw-bold text-white">BERBAGAI NAMA BESAR TELAH BERGABUNG</h3>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($getbrand as $i) : ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>" class="text-decoration-none">
                            <div class="card bg-white p-3 text-center h-100 shadow-sm">
                                <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" class="img-fluid mx-auto" style="max-height: 80px; width: auto;">
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <!-- What You Do Section -->
    <section class="youdo py-5" id="youdo">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h2 class="fw-bold display-5 mb-3"><?= $this->lang->line('what_you_do_trumecs_title', FALSE) ?>
                        <span class="text-warning"><?= $this->lang->line('do_in_trumecs', FALSE) ?></span>?
                    </h2>
                    <img src="<?php echo base_url() ?>public/banner/banner-tentang-kami.png" alt="" class="img-fluid w-100 rounded shadow">
                </div>
                <div class="col-lg-7 mt-4 mt-lg-0">
                    <div class="d-flex flex-column gap-4">
                        <!-- As Seller -->
                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <div class="card p-4 shadow-sm border-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;" src="<?php echo base_url("public/icon/as_seller.png"); ?>">
                                        <div class="text-end">
                                            <p class="mb-0 text-muted"><?= ucfirst($this->lang->line('as_seller_trumecs_label', FALSE)) ?></p>
                                            <p class="fw-bold text-warning display-6 mb-0"><?= $this->lang->line('as_seller_trumecs_title', FALSE) ?></p>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-muted"><?= $this->lang->line('as_seller_trumecs_subtitle', FALSE) ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- As Buyer -->
                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <div class="card p-4 shadow-sm border-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;" src="<?php echo base_url("public/icon/as_buyer.png"); ?>">
                                        <div class="text-end">
                                            <p class="mb-0 text-muted"><?= ucfirst($this->lang->line('as_buyer_trumecs_label', FALSE)) ?></p>
                                            <p class="fw-bold text-warning display-6 mb-0"><?= $this->lang->line('as_buyer_trumecs_title', FALSE) ?></p>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-muted"><?= $this->lang->line('as_buyer_trumecs_subtitle', FALSE) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Traffic Section -->
<section class="trafic bg-light py-5" id="trafic">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-people fs-1 text-warning"></i>
                    <p class="fw-bold text-warning display-6 mb-0 mt-2">20,000+</p>
                    <p class="fw-bold mb-0"><?= $this->lang->line('has_joined_user_label', FALSE) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-currency-dollar fs-1 text-warning"></i>
                    <p class="fw-bold text-warning display-6 mb-0 mt-2">200+</p>
                    <p class="fw-bold mb-0"><?= $this->lang->line('has_transaction_label', FALSE) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-building fs-1 text-warning"></i>
                    <p class="fw-bold text-warning display-6 mb-0 mt-2">40+</p>
                    <p class="fw-bold mb-0"><?= $this->lang->line('has_brand_joined_label', FALSE) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>