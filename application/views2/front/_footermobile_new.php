<footer>
    <?php
    $session = $this->session->all_userdata();
    $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
    if ($sessionmember["id"] != null) :
    ?>
    <?php else : ?>
        <div class="container-fluid" style="background-color: black;">
            <div class="row p-t-1">
                <div class="col-xs-12 text-center">
                    <h6 class="f14 fbold fwhite">Perluas bisnis anda sekarang! </h6>
                    <a class="forange" href="<?php echo base_url("member/login") ?>?">Bergabung Sekarang</a>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12">
                    <hr class="hrfooter">
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="container-fluid" style="background-color: black;">
        <div class="row" style="padding:6px 15px;">
            <div class="col-xs-12 m-b-1">
                <div class="logo text-center">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png" style="width:200px; heigth:150px;">
                    </a>
                </div>
            </div>
            <div class="col-xs-12 text-center" style="color: #fff;">
                <div class="row m-b-1">
                    <h5 class="fbold text-center f14 m-b-1"><u style="text-underline-offset: 5px;">Hubungi Kami</u></h5>
                    <div class="col-xs-6 m-t-1">
                        <a href="https://wa.me/+6285176912338">
                            <i class="fa fa-whatsapp icon-foot"></i><br>
                            <larger class="f12" style="color:#fff;"> +6285176912338</larger>
                        </a>
                    </div>
                    <div class="col-xs-6 m-t-1">
                        <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=info@trumecs.com">
                            <i class="fa fa-envelope icon-foot"></i><br>
                            <larger class="f12" style="color:#fff;">info@trumecs.com</larger>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 m-t-1 m-b-1">
                    <a href="https://goo.gl/maps/a4emSqqX4qWaQikG7">
                        <i class="fa fa-map-marker icon-foot"></i><br>
                        <larger class="f12" style="color:#fff;">No. B, Jl. Pintu Air Raya No.31, RT.13/RW.8, Ps. Baru, Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710</larger>
                    </a>
                </div>
            </div>
            <br>
            <div class="col-xs-12 text-center m-b-2 m-t-1" style="color: #fff;">
                <h5 class="fbold f14 m-b-1  "><u style="text-underline-offset: 5px;">Ikuti Kami</u></h5>
                <a href="https://www.linkedin.com/company/trumecs" target="_blank"><i class="fa fa-linkedin-square icon-footer"></i></a>
                <a href="https://www.instagram.com/trumecs" target="_blank"><i class="fa fa-instagram icon-footer"></i></a>
                <a href="https://www.facebook.com/trumecsid" target="_blank"><i class="fa fa-facebook-square icon-footer"></i></a>
                <a href="https://twitter.com/trumecs" target="_blank"><i class="fa fa-twitter icon-footer"></i></a>
                <a href=""><i class="fa fa-youtube-play icon-foot"></i></a>
            </div>
            <br>
            <div class="col-xs-12">
                <h5 class="fbold f16 m-b-1" style="color:#fff;"><i class="fa fa-book"></i> Pelajari lebih lanjut tentang Trumecs</h5>
                <p class="f12" style="color:#fff;">Trumecs juga menyediakan <a href="<?php echo base_url('article') ?>" style="color: #ff9900;">Artikel</a> untuk anda pelajari dan informasi seputar industri kontruksi, dan lain-lain</p>
                <a href="<?php echo base_url() ?>page" style="color: #ff9900;" class="btn btnnew f12">Baca Dulu</a>
            </div>
            <div class="col-xs-12 m-t-1">
                <form action="_footermobile_new.php" method="POST">
                    <?php $userEmail = "";
                    if (isset($_POST['subscribe'])) {
                        $userEmail = $_POST['email'];
                        if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                            $subject = "Terima kasih telah berlangganan - Trumecs.com";
                            $message = "Terimakasih telah berlangganan, kami akan mengirimkan promo terbaik yang kamu punya setiap minggunya kepada anda.";
                            $sender = "From: muhammadraxshanaditya@gmail.com";
                            if (mail($userEmail, $subject, $message, $sender)) {
                    ?>
                                <div class="alert">
                                    <?php echo "Terimakasih telah berlangganan" ?>
                                </div>
                            <?php
                                $userEmail = "";
                            } else { ?>
                                <div class="alert">
                                    <?php echo "Terimakasih telah berlangganan" ?>
                                </div>
                            <?php
                            }
                        } else { ?>
                            <div class="alert ">
                                <?php echo " $userEmail bukan email yang aktif" ?>
                            </div>
                    <?php
                        }
                    } ?>
                    <h5 class="fbold f16 m-b-1" style="color:#fff;"><i class="fa fa-envelope" style="margin-top: 10px;"></i> Dapatkan info terbaru</h5>
                    <p class="f12" style="color:#fff;">Berlangganan info terbaru(Secara Gratis) seputar proyek, konstruksi atau seputar trik dan tips perawatan alat berat</p>
                    <div class="input-group input-group-sm pull-left" style="width:100%;">
                        <input type="text" class="form-control" placeholder="Alamat Email Anda" value="<?php echo $userEmail ?>" required>
                        <div name="subscribe" class="input-group-addon btn search-button f12" id="searchbuttontemplate" style="background:#ff9900; color:#fff;">
                            Kirim
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row m-b-3" style="padding:6px 15px; background-color:black;">
            <div class="col-xs-12">
                <h6 class="text-center f10" style="color: #fff;">Trumecs.com © 2022 | Trisindo Raya Utama</h6>
            </div>
        </div>
    </div>
</footer>
<style>
    .hrfooter {
        border-top: 1px solid #333;
    }

    .card-subscribe {
        width: 100%;
        height: 300px;
        background-color: #373737;
        border: none;
        border-radius: 20px;
    }

    .logo {
        padding-top: 10px;
    }

    .icon-foot {
        color: #fff;
        font-size: 30px;
    }

    .icon-footer {
        color: #fff;
        font-size: 30px;
        margin-right: 15px;
    }

    .form-subscribe {
        color: #fff;
        margin-top: 40px;
        margin-left: 20px;
    }

    .ilustrasi-woman {
        width: 100px;
        height: 130px;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
        margin-top: 30px;
        margin-left: -20px;
    }
</style>