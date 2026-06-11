<!-- Banner Section Mobile -->
<section class="banner" id="banner" style="background: #1a1a2e; padding: 20px 15px;">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-12">
                <p class="fw-bold text-warning mb-1" style="font-size: 12px;"><?= $this->lang->line('trumecs_is', FALSE) ?></p>
                <h5 class="fw-bold text-white mb-2" style="font-size: 18px;"><?= $this->lang->line('trumecs_tagline', FALSE) ?></h5>
                <p class="text-white mb-0" style="font-size: 11px;"><?= $this->lang->line('trumecs_description', FALSE) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Content Page Mobile -->
<div class="content-page" style="padding: 15px;">

    <!-- Why Trumecs Section Mobile -->
    <section class="trumecs-why mb-4" id="trumecs-why">
        <div class="row g-3">
            <div class="col-12">
                <p class="fw-bold mb-2" style="font-size: 18px;"><?= $this->lang->line('why_trumecs', FALSE) ?>
                    <span class="text-warning"><?= $this->lang->line('must_trumecs', FALSE) ?></span> TRUMECS ?
                </p>
                <p class="text-muted mb-3" style="font-size: 12px; line-height: 1.5;">
                    <?= $this->lang->line('why_must_trumecs', FALSE) ?>
                </p>
                <img src="<?php echo base_url() ?>public/banner/banner-tentang-kami.png" alt="" class="img-fluid w-100 mb-3">
            </div>
            <div class="col-12">
                <div class="d-flex flex-column gap-3">
                    <!-- Card 1 -->
                    <div class="card p-2 shadow-sm">
                        <div class="d-flex align-items-center gap-2">
                            <img alt="Produk Terlengkap" style="width: 40px; height:40px;" src="<?php echo base_url("public/icon/usp/usp-secure.png"); ?>">
                            <div>
                                <h6 class="fw-bold mb-0" style="font-size: 13px;"><?= $this->lang->line('trumecs_secure_title', FALSE) ?></h6>
                                <span class="text-muted" style="font-size: 10px;"><?= $this->lang->line('trumecs_secure_subtitle', FALSE) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card p-2 shadow-sm">
                        <div class="d-flex align-items-center gap-2">
                            <img alt="Produk Terlengkap" style="width: 40px; height:40px;" src="<?php echo base_url("public/icon/usp/usp-valid.png"); ?>">
                            <div>
                                <h6 class="fw-bold mb-0" style="font-size: 13px;"><?= $this->lang->line('trumecs_valid_title', FALSE) ?></h6>
                                <span class="text-muted" style="font-size: 10px;"><?= $this->lang->line('trumecs_valid_subtitle', FALSE) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card p-2 shadow-sm">
                        <div class="d-flex align-items-center gap-2">
                            <img alt="Produk Terlengkap" style="width: 40px; height:40px;" src="<?php echo base_url("public/icon/usp/usp-transparant.png"); ?>">
                            <div>
                                <h6 class="fw-bold mb-0" style="font-size: 13px;"><?= $this->lang->line('trumecs_transparent_title', FALSE) ?></h6>
                                <span class="text-muted" style="font-size: 10px;"><?= $this->lang->line('trumecs_transparent_subtitle', FALSE) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Section Mobile -->
        <div class="service mt-4 pt-2">
            <div class="row">
                <div class="col-12 mb-3">
                    <p class="fw-bold mb-1" style="font-size: 18px;"><?= $this->lang->line('service_trumecs_title', FALSE) ?></p>
                    <div class="bg-warning" style="width: 50px; height: 2px;"></div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="card p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <img src="<?php echo base_url() ?>public/icon/partner.png" alt="" style="width: 40px;">
                            <h6 class="fw-bold mb-0" style="font-size: 14px;"><?= $this->lang->line('service_trumecs_sale_title', FALSE) ?></h6>
                        </div>
                        <p class="text-muted mb-3" style="font-size: 12px;"><?= $this->lang->line('service_trumecs_sale_subtitle', FALSE) ?></p>
                        <a href="/principal/form" class="btn btn-warning btn-sm w-100" style="font-size: 12px;"><?= $this->lang->line('read_detail', FALSE) ?></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <img src="<?php echo base_url() ?>public/icon/insurance.png" alt="" style="width: 40px;">
                            <h6 class="fw-bold mb-0" style="font-size: 14px;"><?= $this->lang->line('service_trumecs_rent_title', FALSE) ?></h6>
                        </div>
                        <p class="text-muted mb-3" style="font-size: 12px;"><?= $this->lang->line('service_trumecs_rent_subtitle', FALSE) ?></p>
                        <a href="/principal/form" class="btn btn-warning btn-sm w-100" style="font-size: 12px;"><?= $this->lang->line('read_detail', FALSE) ?></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <img src="<?php echo base_url() ?>public/icon/robot.png" alt="" style="width: 40px;">
                            <h6 class="fw-bold mb-0" style="font-size: 14px;"><?= $this->lang->line('service_trumecs_service_title', FALSE) ?></h6>
                        </div>
                        <p class="text-muted mb-3" style="font-size: 12px;"><?= $this->lang->line('service_trumecs_service_subtitle', FALSE) ?></p>
                        <a href="/principal/form" class="btn btn-warning btn-sm w-100" style="font-size: 12px;"><?= $this->lang->line('read_detail', FALSE) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Section Mobile -->
    <section class="brand mt-4" id="brand">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <p class="fw-bold text-secondary mb-0" style="font-size: 14px;">BERBAGAI NAMA BESAR TELAH BERGABUNG</p>
            </div>
        </div>
        <div class="row g-2">
            <?php foreach ($getbrand as $i) : ?>
                <div class="col-4 col-6">
                    <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>" class="text-decoration-none">
                        <div class="card p-2 text-center shadow-sm">
                            <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" class="img-fluid mx-auto" style="max-height: 50px; width: auto;">
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </section>

    <!-- What You Do Section Mobile -->
    <section class="youdo mt-4" id="youdo">
        <div class="row">
            <div class="col-12 mb-3">
                <p class="fw-bold mb-2" style="font-size: 18px;"><?= $this->lang->line('what_you_do_trumecs_title', FALSE) ?>
                    <span class="text-warning"><?= $this->lang->line('do_in_trumecs', FALSE) ?></span>?
                </p>
                <img src="<?php echo base_url() ?>public/banner/banner-tentang-kami.png" alt="" class="img-fluid w-100 mb-3">
            </div>
            <div class="col-12">
                <div class="d-flex flex-column gap-3">
                    <!-- As Seller -->
                    <div class="card p-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <img alt="Produk Terlengkap" style="width: 40px; height:40px;" src="<?php echo base_url("public/icon/as_seller.png"); ?>">
                            <div class="text-end">
                                <p class="mb-0 text-muted" style="font-size: 11px;"><?= ucfirst($this->lang->line('as_seller_trumecs_label', FALSE)) ?></p>
                                <p class="fw-bold text-warning mb-0" style="font-size: 16px;"><?= $this->lang->line('as_seller_trumecs_title', FALSE) ?></p>
                            </div>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 12px;"><?= $this->lang->line('as_seller_trumecs_subtitle', FALSE) ?></p>
                    </div>

                    <!-- As Buyer -->
                    <div class="card p-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <img alt="Produk Terlengkap" style="width: 40px; height:40px;" src="<?php echo base_url("public/icon/as_buyer.png"); ?>">
                            <div class="text-end">
                                <p class="mb-0 text-muted" style="font-size: 11px;"><?= ucfirst($this->lang->line('as_buyer_trumecs_label', FALSE)) ?></p>
                                <p class="fw-bold text-warning mb-0" style="font-size: 16px;"><?= $this->lang->line('as_buyer_trumecs_title', FALSE) ?></p>
                            </div>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 12px;"><?= $this->lang->line('as_buyer_trumecs_subtitle', FALSE) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>