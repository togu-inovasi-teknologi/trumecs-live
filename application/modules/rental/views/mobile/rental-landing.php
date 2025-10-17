<div class="col-xs-12 p-a-0 m-b-2">
    <img src="<?php echo base_url() ?>public/image/rental/banner.png" alt="banner-rental"
        style="width:100%; height:200px;">
    <div class="content-img">
        <h1>Butuh alat lebih cepat?</h1>
        <h2>Rental apa saja lebih<br>mudah dan cepat</h2>
        <a href="" class="btn btnnew f10">Kirim Permintaan</a>
    </div>
</div>
<div class="col-xs-12 title-mobile m-b-1">
    <h6 class="title-content">Kenapa Sewa Alat di Trumecs?</h6>
</div>
<!-- <div class="4-kotak">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-6 text-center">
                    <div class="card p-a-1" style="height: 135px;">
                        <h6 class="fbold m-b-1 f12">Fleksibilitas Tidak Terbatas</h6>
                        <h6 class="f10">Pilihan alat berat terlengkap yang siap bekerja kapan saja, di mana saja.</h6>
                    </div>
                </div>
                <div class="col-xs-6 text-center">
                    <div class="card p-a-1" style="height: 135px;">
                        <h6 class="fbold m-b-1 f12">Kemudahan Pemesanan</h6>
                        <h6 class="f10">Proses pemesanan yang lancar dan ramah pengguna untuk menghemat waktu dan energi Anda.</h6>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-6 text-center">
                    <div class="card p-a-1" style="height: 135px;">
                        <h6 class="fbold m-b-1 f12">Jaminan Ketersediaan</h6>
                        <h6 class="f10">Kami menjamin ketersediaan alat berat berkualitas tinggi, sehingga proyek Anda tidak pernah terhambat.</h6>
                    </div>
                </div>
                <div class="col-xs-6 text-center">
                    <div class="card p-a-1" style="height: 135px;">
                        <h6 class="fbold m-b-1 f12">Dukungan 24/7</h6>
                        <h6 class="f10">Tim kami selalu siap membantu Anda, baik itu untuk pertanyaan, perawatan, atau situasi darurat.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<div class="col-xs-12 text-center 1-kotak slick-usp-rental-mobile m-b-3">
    <div class="card p-a-2" style="height: 130px;">
        <h6 class="fbold m-b-1">Fleksibilitas Tidak Terbatas</h6>
        <h6 class="f14">Pilihan alat berat terlengkap yang siap bekerja kapan saja, di mana saja.</h6>
    </div>
    <div class="card p-a-2" style="height: 130px;">
        <h6 class="fbold m-b-1">Kemudahan Pemesanan</h6>
        <h6 class="f14">Proses pemesanan yang lancar dan ramah pengguna untuk menghemat waktu dan energi Anda.
        </h6>
    </div>
    <div class="card p-a-2" style="height: 130px;">
        <h6 class="fbold m-b-1">Jaminan Ketersediaan</h6>
        <h6 class="f14">Kami menjamin ketersediaan alat berat berkualitas tinggi, sehingga proyek Anda tidak
            pernah terhambat.</h6>
    </div>
    <div class="card p-a-2" style="height: 130px;">
        <h6 class="fbold m-b-1">Dukungan 24/7</h6>
        <h6 class="f14">Tim kami selalu siap membantu Anda, baik itu untuk pertanyaan, perawatan, atau situasi
            darurat.</h6>
    </div>
</div>
<div class="col-xs-12 title-mobile m-b-1">
    <h6 class="title-content">Cara sewa alat di Trumecs</h6>
</div>
<div class="col-xs-12 m-b-2">
    <img src="<?php echo base_url() ?>public/image/rental/image-cara.png" alt="image-rental" style="width: 100%;">
</div>
<div class="col-xs-12 m-b-1">
    <div class="row d-flex-ai-center">
        <div class="col-xs-2">
            <button class="btn btnnew f14">01</button>
        </div>
        <div class="col-xs-10">
            <span class="f14">Klik sewa alat di menu kanan atas</span>
        </div>
    </div>
</div>
<div class="col-xs-12 m-b-1">
    <div class="row d-flex-ai-center">
        <div class="col-xs-2">
            <button class="btn btnnew f14">02</button>
        </div>
        <div class="col-xs-10">
            <span class="f14">klik tombol kirim permintaan di banner atas halaman sewa</span>
        </div>
    </div>
</div>
<div class="col-xs-12 m-b-1">
    <div class="row d-flex-ai-center">
        <div class="col-xs-2">
            <button class="btn btnnew f14">03</button>
        </div>
        <div class="col-xs-10">
            <span class="f14">Isi data terkait kebutuhan rental anda lalu kirim permintaan</span>
        </div>
    </div>
</div>
<div class="col-xs-12 m-b-2">
    <div class="row d-flex-ai-center">
        <div class="col-xs-2">
            <button class="btn btnnew f14">04</button>
        </div>
        <div class="col-xs-10">
            <span class="f14">Dalam 1x24 jam kami akan mengirimkan penawaran harga yang anda butuhkan</span>
        </div>
    </div>
</div>
<div class="col-lg-12 title-mobile m-b-1">
    <h6 class="title-content">Berbagai Alat Untuk Di Rental</h6>
</div>
<div class="d-flex flex-column gap-2 m-b-2">

    <?php foreach ($subKategori as $sub) : ?>
        <div class="col-xs-12">
            <a href="<?= base_url() ?>rental/list/<?= $sub['url'] ?>">
                <div class="card card-rental">
                    <img src="<?php echo base_url(); ?>public/image/category/card-<?= $sub['name'] ?>.png" alt="icon">
                    <h6 class="fblack f13 fbold"><?= $sub['name'] ?></h6>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    <!-- <div class="col-xs-12">
        <a href="<?= base_url() ?>rental/list">
            <div class="card card-rental">
                <img src="<?php echo base_url(); ?>public/image/category/card-Forklift.png" alt="icon">
                <h6 class="fblack f13 fbold">Forklift</h6>
            </div>
        </a>
    </div>
    <div class="col-xs-12">
        <a href="<?= base_url() ?>rental/list">
            <div class="card card-rental">
                <img src="<?php echo base_url(); ?>public/image/category/card-Unit.png" alt="icon">
                <h6 class="fblack f13 fbold">Bus & Truk</h6>
            </div>
        </a>
    </div>
    <div class="col-xs-12">
        <a href="<?= base_url() ?>rental/list">
            <div class="card card-rental">
                <img src="<?php echo base_url(); ?>public/image/category/card-Bulldozer.png" alt="icon">
                <h6 class="fblack f13 fbold">Bulldozer</h6>
            </div>
        </a>
    </div>
    <div class="col-xs-12">
        <a href="<?= base_url() ?>rental/list">
            <div class="card card-rental">
                <img src="<?php echo base_url(); ?>public/image/category/card-Car.png" alt="icon">
                <h6 class="fblack f13 fbold">Car</h6>
            </div>
        </a>
    </div> -->
</div>
<!-- <div class="col-lg-12 brands">
    <div class="row slick-brands-mobile">
        <?php $in = 1;
        foreach ($getbrand as $i) : ?>
            <div class="col-lg-4">
                <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>">
                    <div class="card card-brand-mobile text-center card-shadow">
                        <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" />
                    </div>
                </a>
            </div>
        <?php $in++;
        endforeach ?>
    </div>
</div> -->
<div class="col-lg-12 m-b-2">
    <img src="<?php echo base_url() ?>public/image/rental/banner-mobile.png" alt="banner-2" style="width: 100%;">
    <div class="content-img-penyedia">
        <h1>Punya Alat Untuk Disewakan?</h1>
        <h2>Bergabunglah ke jaringan mitra penyedia kami<br>dan sewakan alat nganggur kamu ke basis<br>pelanggan
            kami seketika.</h2>
        <a href="<?= base_url() ?>member/login" class="btn btnnew radius-sm">Bergabung dengan kami</a>
    </div>
</div>
<div class="col-lg-12 m-b-2">
    <div class="row">
        <div class="col-xs-12 d-flex flex-column gap-3 ">
            <h4 class="fbold">Perluas Jangkauan Bisnis Anda!</h4>
            <h6 class="fbold">Bergabunglah dan Raih Pelanggan Baru di Pasar Yang Luas!</h6>
            <ul>
                <li class="f16">
                    <?= $this->lang->line('benefit_low_acq_label', FALSE) ?> </li>
                <li class="f16"><?= $this->lang->line('benefit_exposure_label', FALSE) ?> </li>
                <li class="f16"><?= $this->lang->line('benefit_prepare_profile', FALSE) ?> </li>
            </ul>

        </div>
        <div class="col-xs-12">
            <div class="card p-a-1">
                <form action="<?php echo base_url('principal/principal_register') ?>" method="POST" role="form"
                    id="signup_member">
                    <?= $this->session->flashdata('message') != "" ? '<div class="alert alert-warning">' . $this->session->flashdata('message') . '</div>' : '' ?>
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