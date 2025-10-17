<section class="banner" id="banner">
    <div class="row p-a-0 m-a-0">
        <div class="col-lg-6">
            <p class="fbold f14 forange"><?= $this->lang->line('trumecs_is', FALSE) ?></p>
            <h5 class="fbold f24 fwhite"><?= $this->lang->line('trumecs_tagline', FALSE) ?></h5>
            <p class="f12 fwhite"><?= $this->lang->line('trumecs_description', FALSE) ?></p>
        </div>
    </div>
</section>

<div class="content-page d-flex flex-column gap-4 m-t-3" id="tentang">
    <section class="trumecs-why" id="trumecs-why">
        <div class="row">
            <div class="col-lg-6">
                <p class="fbold f24 p-a-0 m-a-0"><?= $this->lang->line('why_trumecs', FALSE) ?> <span
                        class="forange"><?= $this->lang->line('must_trumecs', FALSE) ?></span> TRUMECS ?</p>
                <h6 class="text-muted m-b-2" style="line-height: 20px;">
                    <?= $this->lang->line('why_must_trumecs', FALSE) ?></h6>
                <img src="<?php echo base_url() ?>public/banner/banner-tentang-kami.png" alt="" style="width: 100%;">
            </div>
            <div class="col-lg-6 m-t-3">
                <div class="row d-flex flex-column gap-4">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card d-flex-sb d-flex-ai-center p-a-1">
                                    <div class="image">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;"
                                            src="<?php echo base_url("public/icon/usp/usp-secure.png"); ?>">
                                    </div>
                                    <div class="text m-l-1">
                                        <h6 class="f16 fbold p-a-0 m-a-0">
                                            <?= $this->lang->line('trumecs_secure_title', FALSE) ?></h6>
                                        <span class="f12"
                                            style="line-height: 10px;"><?= $this->lang->line('trumecs_secure_subtitle', FALSE) ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row justify-content-end d-flex">
                            <div class="col-lg-10">
                                <div class="card d-flex-sb d-flex-ai-center p-a-1">
                                    <div class="image">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;"
                                            src="<?php echo base_url("public/icon/usp/usp-valid.png"); ?>">
                                    </div>
                                    <div class="text m-l-1">
                                        <h6 class="f16 fbold m-a-0 p-a-0">
                                            <?= $this->lang->line('trumecs_valid_title', FALSE) ?></h6>
                                        <span class="f12"
                                            style="line-height: 10px;"><?= $this->lang->line('trumecs_valid_subtitle', FALSE) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card d-flex-sb d-flex-ai-center p-a-1">
                                    <div class="image">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;"
                                            src="<?php echo base_url("public/icon/usp/usp-transparant.png"); ?>">
                                    </div>
                                    <div class="text m-l-1">
                                        <h6 class="f16 fbold m-a-0 p-a-0">
                                            <?= $this->lang->line('trumecs_transparent_title', FALSE) ?></h6>
                                        <span
                                            class="f12"><?= $this->lang->line('trumecs_transparent_subtitle', FALSE) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-t-3 service d-flex flex-column gap-4">
            <div class="col-lg-12">
                <p class="service-title fbold f22 p-a-0 m-a-0"><?= $this->lang->line('service_trumecs_title', FALSE) ?>
                </p>
                <div class="line"></div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card p-a-1 card-service d-flex flex-column justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?php echo base_url() ?>public/icon/partner.png" alt=""
                                            style="width: 15%;">
                                        <h6 class="fbold m-a-0 p-a-0">
                                            <?= $this->lang->line('service_trumecs_sale_title', FALSE) ?></h6>
                                    </div>
                                    <h6 class="color-dark-grey f14 m-y-1">
                                        <?= $this->lang->line('service_trumecs_sale_subtitle', FALSE) ?>
                                    </h6>
                                    <a href="/principal/form"
                                        class="btn btnnew f14"><?= $this->lang->line('read_detail', FALSE) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card p-a-1 card-service d-flex flex-column justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?php echo base_url() ?>public/icon/insurance.png" alt=""
                                            style="width: 15%;">
                                        <h6 class="fbold m-a-0 p-a-0">
                                            <?= $this->lang->line('service_trumecs_rent_title', FALSE) ?></h6>
                                    </div>
                                    <h6 class="color-dark-grey f14 m-y-1">
                                        <?= $this->lang->line('service_trumecs_rent_subtitle', FALSE) ?></h6>
                                    <a href="/principal/form"
                                        class="btn btnnew f14"><?= $this->lang->line('read_detail', FALSE) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card p-a-1 card-service d-flex flex-column justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?php echo base_url() ?>public/icon/robot.png" alt=""
                                            style="width: 15%;">
                                        <h6 class="fbold m-a-0 p-a-0">
                                            <?= $this->lang->line('service_trumecs_service_title', FALSE) ?></h6>
                                    </div>
                                    <h6 class="color-dark-grey f14 m-y-1">
                                        <?= $this->lang->line('service_trumecs_service_subtitle', FALSE) ?></h6>
                                    <a href="/principal/form"
                                        class="btn btnnew f14"><?= $this->lang->line('read_detail', FALSE) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="brand d-flex flex-column gap-4" id="brand ">
        <div class="row justify-content-center d-flex">
            <div class="col-xs-8">
                <p class="fbold color-dark-grey f16 text-center">BERBAGAI NAMA BESAR TELAH BERGABUNG</p>
            </div>
        </div>
        <div class="row p-a-2">
            <?php $in = 1;
                        foreach ($getbrand as $i) : ?>
            <div class="col-xs-3 p-a-0">
                <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>">
                    <div class="card card-brand text-center">
                        <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>"
                            width="100%" />
                    </div>
                </a>
            </div>
            <?php $in++;
                        endforeach ?>
        </div>
    </section>
    <section class="youdo m-t-3" id="youdo">
        <div class="row d-flex flex-column justify-content-between align-items-center">
            <div class="col-lg-5">
                <p class="fbold f24 p-a-0 m-a-0 title"><?= $this->lang->line('what_you_do_trumecs_title', FALSE) ?>
                    <span class="forange"><?= $this->lang->line('do_in_trumecs', FALSE) ?></span>?
                </p>
                <img src="<?php echo base_url() ?>public/banner/banner-tentang-kami.png" alt="" style="width: 100%;">
            </div>
            <div class="col-lg-7">
                <div class="row d-flex flex-column gap-4 align-items-end p-y-3">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card d-flex flex-column border-none gap-3">
                                    <div class="image d-flex justify-content-between">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;"
                                            src="<?php echo base_url("public/icon/as_seller.png"); ?>">
                                        <div class="d-flex flex-column align-items-end">
                                            <p class="f16 text-end">
                                                <?= ucfirst($this->lang->line('as_seller_trumecs_label', FALSE)) ?>
                                            </p>
                                            <p class="f22 fbold forange">
                                                <?= $this->lang->line('as_seller_trumecs_title', FALSE) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="subtitle">

                                        <p class="f14">
                                            <?= $this->lang->line('as_seller_trumecs_subtitle', FALSE) ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="row justify-content-end d-flex">
                            <div class="col-lg-8">
                                <div class="card d-flex flex-column border-none gap-3">
                                    <div class="image d-flex justify-content-between">
                                        <img alt="Produk Terlengkap" style="width: 50px; height:50px;"
                                            src="<?php echo base_url("public/icon/as_buyer.png"); ?>">
                                        <div class="d-flex flex-column align-items-end">
                                            <p class="f16 text-end">
                                                <?= ucfirst($this->lang->line('as_buyer_trumecs_label', FALSE)) ?>
                                            </p>
                                            <p class="f22 fbold forange">
                                                <?= $this->lang->line('as_buyer_trumecs_title', FALSE) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="subtitle">

                                        <p class="f14">
                                            <?= $this->lang->line('as_buyer_trumecs_subtitle', FALSE) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- <section class="trafic bg-content" id="trafic">
    <div class="row d-flex justify-content-center m-a-0 p-y-3">
        <div class="col-lg-3 d-flex flex-column align-items-center jusity-content-center">
            <i class="fa fa-fw fa-users fa-3x"></i>
            <p class="f22 fbold forange">20,000+</p>
            <p class="f14 fbold"><?= $this->lang->line('has_joined_user_label', FALSE) ?></p>
        </div>
        <div class="col-lg-3 d-flex flex-column align-items-center jusity-content-center">
            <i class="fa fa-fw fa-dollar fa-3x"></i>
            <p class="f22 fbold forange">200+</p>
            <p class="f14 fbold"><?= $this->lang->line('has_transaction_label', FALSE) ?></p>
        </div>
        <div class="col-lg-3 d-flex flex-column align-items-center jusity-content-center">
            <i class="fa fa-fw fa-copyright fa-3x"></i>
            <p class="f22 fbold forange">40 +</p>
            <p class="f14 fbold"><?= $this->lang->line('has_brand_joined_label', FALSE) ?></p>
        </div>
    </div>
</section> -->