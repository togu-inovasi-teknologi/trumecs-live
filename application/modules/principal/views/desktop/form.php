<section class="header" id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 header-banner">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5 d-flex flex-column gap-3">
                        <div class="headline">
                            <h1 class="fbold f40">Perluas bisnis anda dengan menjadi partner
                                trumecs.</h1>
                            <p class="color-dark-grey">Buka pintu menuju kesuksesan bisnis yang lebih luas dengan
                                menjadi
                                prinsipal di Trumecs.com!</p>
                        </div>
                        <div class="form-email">

                            <a href="#campign-seller" class="btn btnnew m-y-1">Daftar Sekarang</a>

                        </div>
                    </div>
                    <div class="col-lg-7">
                        <img src=" <?php echo base_url(); ?>public/banner/banner-tentang-kami-2.png" alt="tentang kami"
                            style="width:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="usp" id="usp">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-content p-y-3 d-flex gap-5 flex-column">
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-4">
                        <p class="fbold color-dark-grey f24 text-center">BANYAK KEUNTUNGAN MENJADI PRINCIPAL TRUMECS</p>
                    </div>
                </div>
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-3">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-member.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Low acquisition cost</h6>
                            <span class="text-muted f12">Trumecs gratis tanpa biaya keanggotaan, tidak seperti
                                platform B2B lain yang membebankan keanggotaan berbayar.</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-bisnis.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Business & Product Exposure</h6>
                            <span class="text-muted f12">Bergabung di Trumecs, nikmati eksposur GRATIS untuk produk
                                dan bisnis Anda.</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-help.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Bantuan penyiapan profil
                                usaha & produk</h6>
                            <span class="text-muted f12">Account Executive kami siap membantu Anda mempersiapkan
                                profil usaha & produk hingga siap tayang</span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-4">
                        <p class="fbold color-dark-grey f24 text-center">BERBAGAI NAMA BESAR TELAH BERGABUNG</p>
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
<section class="service" id="service">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 p-y-3 d-flex gap-5 flex-column">
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-4">
                        <p class="fbold color-dark-grey f24 text-center">APA YANG BISA ANDA LAKUKAN DI TRUMECS</p>
                    </div>
                </div>
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-4">
                        <div class="card text-center card-service d-flex flex-column justify-content-start p-a-1 gap-3">
                            <div class="card-service-header d-flex gap-3 align-items-center">
                                <img src="<?php echo base_url() ?>public/icon/partnership/partner1.png" alt="icon">
                                <p class="fbold f16 fblack text-left p-a-0 m-a-0">Jual Alat Mechanical dan pasarkan
                                    produk anda
                                </p>
                            </div>
                            <p class="color-dark-grey p-a-0 m-a-0 f14 text-left">Mempromosikan produk Anda dengan
                                strategi pemasaran digital yang terarah, meningkatkan visibilitas dan minat pelanggan
                                terhadap alat Anda.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card text-center card-service d-flex flex-column justify-content-start p-a-1 gap-3">
                            <div class="card-service-header d-flex gap-3 align-items-center">
                                <img src="<?php echo base_url() ?>public/icon/partnership/insurance1.png" alt="icon">
                                <p class="fbold f16 fblack text-left p-a-0 m-a-0">Menjadi Penyedia Alat Untuk Rental</p>
                            </div>
                            <p class="color-dark-grey p-a-0 m-a-0 f14 text-left">Jadilah mitra kami dalam memberikan
                                solusi terbaik
                                bagi pelanggan kami dan tumbuhlah bersama kami di dunia rental alat yang terus
                                berkembang!.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card text-center card-service d-flex flex-column justify-content-start p-a-1 gap-3">
                            <div class="card-service-header d-flex gap-3 align-items-center">
                                <img src="<?php echo base_url() ?>public/icon/partnership/robot1.png" alt="icon">
                                <p class="fbold f16 fblack text-left p-a-0 m-a-0">Menjadi Penyedia Jasa Mekanikal di
                                    Trumecs</p>
                            </div>
                            <p class="color-dark-grey p-a-0 m-a-0 f14 text-left">Ingin meningkatkan visibilitas bisnis
                                Anda? Bergabunglah dengan platform kami yang sedang berkembang dan jadilah bagian dari
                                jaringan penyedia jasa terkemuka.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="ready-to-joi" id="ready-to-join">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-y-md">
                <?php $this->load->language('home') ?>
                <h2 class="fbold"><?= $this->lang->line('ready_join_label') ?></h2>
            </div>
        </div>
    </div>
</div>

<section class="campign-seller d-flex align-items-center" id="campign-seller">
    <div class="container bg-content p-y-lg">

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 d-flex flex-column gap-3 ">
                <h1 class="fbold">Perluas Jangkauan Bisnis Anda!</h1>
                <h4 class="fbold">Bergabunglah dan Raih Pelanggan Baru di Pasar Yang Luas!</h4>
                <ul>
                    <li class="f16">
                        <?= $this->lang->line('benefit_low_acq_label', FALSE) ?> </li>
                    <li class="f16"><?= $this->lang->line('benefit_exposure_label', FALSE) ?> </li>
                    <li class="f16"><?= $this->lang->line('benefit_prepare_profile', FALSE) ?> </li>
                </ul>

            </div>
            <div class="col-lg-4">
                <div class="card p-a-1">
                    <form action="<?php echo base_url('principal/principal_register') ?>" method="POST" role="form" id="signup_member">
                        <?= $this->session->flashdata('message') != "" ? '<div class="alert alert-warning">' . $this->session->flashdata('message') . '</div>' : '' ?>
                        <div class="form-group">
                            <label><?php echo $this->lang->line("company_name_title", FALSE); ?></label>
                            <input name="company_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line("company_name_placeholder", FALSE); ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line("label_email", FALSE); ?></label>
                            <input name="email" type="email" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" autocomplete="off" required>
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
                            <button class="form-control btn btnnew" type="submit"><?php echo $this->lang->line("tombol_daftar", FALSE); ?></button>
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