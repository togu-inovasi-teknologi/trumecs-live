<section class="header" id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 header-banner">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-7 d-flex flex-column gap-3">
                        <div class="headline">
                            <h1 class="fbold f40">Cari, Temukan, dan Rasakan Layanan Terbaik di Platform Kami</h1>
                            <p class="color-dark-grey">Penuhi Kebutuhan Anda, Jelajahi Ragam Jasa di Sini</p>
                        </div>
                        <div class="form-email">

                            <a href="/bulk" class="btn btnnew m-y-1">Kirim permintaan sekarang</a>

                        </div>
                    </div>
                    <div class="col-lg-5 d-flex justify-content-end">
                        <img src=" <?php echo base_url(); ?>public/icon/jasa-landing-icon.svg" alt="landing-service"
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
                        <p class="fbold color-dark-grey f24 text-center">
                            <?= strtoupper('KENAPA MENCARI PENYEDIA JASA DI TRUMECS?') ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="card p-a-1 p-t-3" style="height: 200px">
                            <h6 class="fbold m-b-1">Harga Transparan</h6>
                            <h6>Informasi harga yang jelas dan transparan membantu pengguna untuk merencanakan anggaran
                                mereka dengan lebih baik sebelum memilih mekanik yang sesuai
                            </h6>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="card p-a-1 p-t-3" style="height: 200px">
                            <h6 class="fbold m-b-1">Pelayanan Pelanggan yang Responsif</h6>
                            <h6>Dukungan pelanggan yang responsif siap membantu pengguna dalam menjawab pertanyaan atau
                                menangani masalah yang mungkin timbul selama proses pemesanan atau layanan
                            </h6>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="card p-a-1 p-t-3" style="height: 200px">
                            <h6 class="fbold m-b-1">Keamanan Transaksi</h6>
                            <h6>Sistem pembayaran yang aman memberikan jaminan keamanan transaksi kepada pengguna,
                                membuat pengalaman bertransaksi menjadi lebih nyaman
                            </h6>
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
                        <p class="fbold color-dark-grey f24 text-center">
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



<div class="ready-to-joi m-t-3" id="ready-to-join">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-y-md">
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