<div id="page_detail">
    <div class="row">
        <div class="col-lg-12">
            <?php echo ($this->session->flashdata('message') == "") ? "" :
                        '<div class="alert alert-success">' .
                        $this->session->flashdata('message') .
                        '</div>'; ?>
            <?php echo ($this->session->flashdata('message-error') == "") ? "" :
                        '<div class="alert alert-danger">' .
                        $this->session->flashdata('message-error') .
                        '</div>'; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 header-banner">
            <div class="row align-items-center">
                <div class="col-xs-12 p-t-3">
                    <div class="headline">
                        <h1 class="fbold f24">Perluas bisnis anda dengan menjadi partner
                            trumecs.</h1>
                        <p class="color-dark-grey f14">Buka pintu menuju kesuksesan bisnis yang lebih luas dengan
                            menjadi
                            prinsipal di Trumecs.com!</p>
                    </div>
                    <div class="form-email d-flex flex-column gap-2">
                        <span class="color-grey f14">Kirim
                            email
                            untuk
                            mendapatkan informasi ekslusif.</span>
                        <form action="<?php echo base_url(); ?>principal/save_email" method="post">
                            <label for="email" hidden>Email</label>
                            <div class="input-group">

                                <input id="email" name="email" class="form-control radius-none" type="text"
                                    placeholder="Masukan email anda" />
                                <span class="input-group-addon p-a-0"><button class="btn btnnew">Kirim</button></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class=" col-xs-12">
                    <img src=" <?php echo base_url(); ?>public/banner/banner-tentang-kami-2.png" alt="tentang kami"
                        style="width:100%;">
                </div>
            </div>
        </div>
    </div>
    <section class="usp" id="usp">
        <div class="row">
            <div class="col-sm-12 bg-content d-flex flex-column gap-3">
                <div class="row justify-content-center d-flex p-a-2">
                    <div class="col-sm-12">
                        <p class="fbold color-dark-grey f16 text-center p-a-0 m-a-0">BANYAK KEUNTUNGAN MENJADI PRINCIPAL
                            TRUMECS</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-member.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Low acquisition cost</h6>
                            <span class="text-muted f12">Trumecs gratis tanpa biaya keanggotaan, tidak seperti
                                platform B2B lain yang membebankan keanggotaan berbayar.</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card p-a-1 text-center" style="height: 260px;">
                            <img src="<?php echo base_url() ?>public/icon/usp/usp-bisnis.png" alt="icon">
                            <h6 class="fbold m-t-2 m-b-1">Business & Product Exposure</h6>
                            <span class="text-muted f12">Bergabung di Trumecs, nikmati eksposur GRATIS untuk produk
                                dan bisnis Anda.</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
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
                                <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" />
                            </div>
                        </a>
                    </div>
                    <?php $in++;
                        endforeach ?>
                </div>
            </div>
        </div>
    </section>
    <section class="service" id="service">
        <div class="row">
            <div class="col-sm-12 d-flex flex-column gap-3">
                <div class="row justify-content-center d-flex p-a-2">
                    <div class="col-sm-12">
                        <p class="fbold color-dark-grey f16 text-center p-a-0 m-a-0">APA YANG BISA ANDA LAKUKAN DI
                            TRUMECS</p>
                    </div>
                </div>
                <div class="row justify-content-center">

                    <div class="col-sm-12">
                        <div class="card text-center card-service d-flex flex-column justify-content-start p-a-1 gap-3">
                            <div class="card-service-header d-flex gap-3 align-items-center">
                                <img src="<?php echo base_url() ?>public/icon/partner1.png" alt="icon">
                                <p class="fbold f12 fblack text-left p-a-0 m-a-0">Jual Alat Mechanical dan pasarkan
                                    produk anda
                                </p>
                            </div>
                            <p class="color-dark-grey p-a-0 m-a-0 f14 text-left">Mempromosikan produk Anda dengan
                                strategi pemasaran digital yang terarah, meningkatkan visibilitas dan minat pelanggan
                                terhadap alat Anda.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card text-center card-service d-flex flex-column justify-content-start p-a-1 gap-3">
                            <div class="card-service-header d-flex gap-3 align-items-center">
                                <img src="<?php echo base_url() ?>public/icon/insurance1.png" alt="icon">
                                <p class="fbold f12 fblack text-left p-a-0 m-a-0">Menjadi Penyedia Alat Untuk Rental</p>
                            </div>
                            <p class="color-dark-grey p-a-0 m-a-0 f14 text-left">Jadilah mitra kami dalam memberikan
                                solusi terbaik
                                bagi pelanggan kami dan tumbuhlah bersama kami di dunia rental alat yang terus
                                berkembang!.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card text-center card-service d-flex flex-column justify-content-start p-a-1 gap-3">
                            <div class="card-service-header d-flex gap-3 align-items-center">
                                <img src="<?php echo base_url() ?>public/icon/robot1.png" alt="icon">
                                <p class="fbold f12 fblack text-left p-a-0 m-a-0">Menjadi Penyedia Jasa Mekanikal di
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
    </section>

</div>