<section class="header" id="header">
    <div class="container">
        <div class="row m-t-3">
            <div class="col-lg-12 header-banner m-t-3">
                <div class="row">
                    <div class="col-xs-12 d-flex flex-column gap-3">
                        <div class="headline">
                            <p class="fbold f20"><?= $this->lang->line('tagline_service_tittle') ?></p>
                            <p class="color-dark-grey"><?= $this->lang->line('tagline_service_subtittle') ?></p>
                        </div>
                        <div class="form-email">

                            <a href="#campign-seller"
                                class="btn btnnew m-y-1"><?= $this->lang->line('tombol_bergabung_sekarang') ?></a>

                        </div>
                    </div>
                    <div class="col-xs-12 d-flex justify-content-end">
                        <img src=" <?php echo base_url(); ?>public/icon/icon-service-landing.svg" alt="landing-service"
                            style="width:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="usp-join-with-trumecs m-t-3" id="usp-join-with-trumecs">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-content p-y-3 d-flex gap-5 flex-column">
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-6">
                        <p class="fbold color-dark-grey f16 text-center">
                            <?= strtoupper($this->lang->line('service_join_tittle')) ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="card p-a-1 p-t-3" style="height: 200px">
                            <p class="fbold m-b-1"><?= $this->lang->line('service_benefit_tittle_1') ?></p>
                            <p class="f12"><?= $this->lang->line('service_benefit_subtitle_1') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="card p-a-1 p-t-3" style="height: 200px">
                            <p class="fbold m-b-1"><?= $this->lang->line('service_benefit_tittle_2') ?></p>
                            <p class="f12"><?= $this->lang->line('service_benefit_subtitle_2') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="card p-a-1 p-t-3" style="height: 200px">
                            <p class="fbold m-b-1"><?= $this->lang->line('service_benefit_tittle_3') ?></p>
                            <p class="f12"><?= $this->lang->line('service_benefit_subtitle_3') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="usp m-t-3" id="usp">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-content p-y-3 d-flex gap-5 flex-column">
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-4">
                        <p class="fbold color-dark-grey f16 text-center">BANYAK KEUNTUNGAN MENJADI PRINCIPAL TRUMECS</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-member.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Low acquisition cost</h6>
                            <span class="text-muted f12">Trumecs gratis tanpa biaya keanggotaan, tidak seperti
                                platform B2B lain yang membebankan keanggotaan berbayar.</span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-bisnis.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Business & Product Exposure</h6>
                            <span class="text-muted f12">Bergabung di Trumecs, nikmati eksposur GRATIS untuk produk
                                dan bisnis Anda.</span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-help.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Bantuan penyiapan profil
                                usaha & produk</h6>
                            <span class="text-muted f12">Account Executive kami siap membantu Anda mempersiapkan
                                profil usaha & produk hingga siap tayang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="brands m-t-3" id="brands">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-content p-y-3 d-flex gap-5 flex-column">
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-4">
                        <p class="fbold color-dark-grey f16 text-center">
                            <?= strtoupper($this->lang->line('show_brand_title')) ?></p>
                    </div>
                </div>
                <div class="row p-x-3">
                    <?php $in = 1;
                    foreach ($getbrand as $i) : ?>
                    <div class="col-lg-3">
                        <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>">
                            <div class="card card-brand text-center">
                                <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" />
                            </div>
                        </a>
                    </div>
                    <?php $in++;
                    endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="campign-seller d-flex align-items-center" id="campign-seller">
    <div class="container bg-content p-y-lg">

        <div class="row">
            <div class="col-xs-12 d-flex flex-column gap-3 ">
                <h6 class="fbold"><?= $this->lang->line('ready_join_label') ?></h6>
                <h6 class="fbold">Bergabunglah dan Raih Pelanggan Baru di Pasar Yang Luas!</h6>
                <ul>
                    <li class="f14">
                        <?= $this->lang->line('benefit_low_acq_label', FALSE) ?> </li>
                    <li class="f14"><?= $this->lang->line('benefit_exposure_label', FALSE) ?> </li>
                    <li class="f14"><?= $this->lang->line('benefit_prepare_profile', FALSE) ?> </li>
                </ul>

            </div>
            <div class="col-xs-12">
                <div class="card p-a-1">
                    <form action="<?php echo base_url('principal/principal_register') ?>" method="POST" role="form"
                        id="signup_member">
                        <?= $this->session->flashdata('message') != "" ? '<div class="alert alert-warning">'.$this->session->flashdata('message').'</div>' : '' ?>
                        <div class="form-group">
                            <label><?php echo $this->lang->line("company_name_title", FALSE); ?></label>
                            <input name="company_name" type="text" class="form-control"
                                placeholder="<?php echo $this->lang->line("company_name_placeholder", FALSE); ?>"
                                autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line("label_email", FALSE); ?></label>
                            <input name="email" type="email" class="form-control"
                                placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>"
                                autocomplete="off" required>
                        </div>

                        <?php if ($this->agent->is_mobile()) : ?>
                        <div class="form-group m-t-1">
                            <label><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
                            <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div>
                        <?php else : ?>
                        <div class="form-group m-t-1">
                            <label><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
                            <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <button class="form-control btn btnnew"
                                type="submit"><?php echo $this->lang->line("tombol_daftar", FALSE); ?></button>
                            <br>
                            <h6><?php echo sprintf($this->lang->line("signup_form_explanation", FALSE), '<a href="' . base_url("page/31/Kebijakan-Privasi") . '">', '</a>'); ?>
                            </h6>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>