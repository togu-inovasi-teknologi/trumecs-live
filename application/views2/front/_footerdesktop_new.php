<footer>
    <?php
    $session = $this->session->all_userdata();
    $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
    if ($sessionmember["id"] != null) :
    ?>
    <?php else : ?>
        <div class="container-fluid" style="background-color:black;">
            <div class="row p-a-1">
                <div class="col-lg-12 text-center">
                    <h4 style="color: #fff;">Perluas bisnis anda sekarang! <a href="<?php echo base_url() ?>member/login" class="btn btnnew">Bergabung Sekarang</a></h4>
                </div>
            </div>
            <hr class="m-a-0" style="border-top:1px solid #666;" />
        </div>
    <?php endif ?>
    <div class="container-fluid" style="background-color:black;">
        <div class="row p-x-1">
            <div class="col-lg-3" style="color: #fff;">
                <div class="logo m-t-1">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png">
                    </a>
                </div>
                <h5 class="fbold m-t-2 f18">Ikuti Kami</h5>
                <br>
                <a href="https://www.linkedin.com/company/trumecs" target="_blank"><i class="fa fa-linkedin-square icon-footer"></i></a>
                <a href="https://www.instagram.com/trumecs" target="_blank"><i class="fa fa-instagram icon-footer"></i></a>
                <a href="https://www.facebook.com/trumecsid" target="_blank"><i class="fa fa-facebook-square icon-footer"></i></a>
                <a href="https://twitter.com/trumecs" target="_blank"><i class="fa fa-twitter icon-footer"></i></a>
                <a href="https://www.youtube.com/@trumecs" target="_blank"><i class="fa fa-youtube-play icon-footer"></i></a>
            </div>
            <div class="col-lg-3 m-t-2" style="color: #fff;">
                <h5 class="fbold f18">Hubungi Kami</h5>
                <br>
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-whatsapp icon-footer"></i>
                    </div>
                    <div class="col-xs-10" style="margin-top: 5px;">
                        <a href="https://wa.me/+6285176912338" target="_blank">
                            <h6 class="f14" style="color:#fff;"> +6285176912338</h6>
                        </a>
                    </div>
                </div>
                <div class="row m-t-2">
                    <div class="col-xs-2">
                        <i class="fa fa-envelope icon-footer"></i>
                    </div>
                    <div class="col-xs-10" style="margin-top: 5px;">
                        <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=info@trumecs.com" target="_blank">
                            <h6 class="f14" style="color:#fff;">info@trumecs.com</h6>
                        </a>
                    </div>
                </div>
                <div class="row m-t-2">
                    <div class="col-xs-2">
                        <i class="fa fa-map-marker icon-footer"></i>
                    </div>
                    <div class="col-xs-10" style="margin-top: 5px;">
                        <a href="https://goo.gl/maps/a4emSqqX4qWaQikG7" target="_blank">
                            <h6 class="f14" style="color:#fff;">No. B, Jl. Pintu Air Raya No.31, RT.13/RW.8, Ps. Baru, Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710</h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 m-t-1">
                <h5 class="fbold text-right" style="color:#fff;">Masih ragu untuk bergabung di Trumecs?</h5>
                <div class="row m-t-2">
                    <div class="col-lg-6">
                        <i class="fa fa-book icon-footer m-b-2"></i>
                        <h5 class="fbold f18" style="color:#fff;">Pelajari lebih lanjut tentang Trumecs</h5>
                        <p class="f12" style="color:#fff;">Trumecs juga menyediakan <a href="<?php echo base_url() ?>article" style="color: #ff9900;">Artikel</a> untuk anda pelajari dan informasi seputar industri kontruksi, dan lain-lain</p>
                        <a href="<?php echo base_url() ?>page" class="btn btnnew">Baca Dulu</a>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form action="_footerdesktop_new.php" method="POST">
                            <?php $userEmail = "";
                            if (isset($_POST['subscribe'])) {
                                $userEmail = $_POST['email'];
                                if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                                    $subject = "Terima kasih telah berlangganan - Trumecs.com";
                                    $message = "Terimakasih telah berlangganan, kami akan mengirimkan promo terbaik yang kamu punya setiap minggunya kepada anda.";
                                    $sender = "From: muhammadramdhanaditya@gmail.com";
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
                            <i class="fa fa-envelope icon-footer m-b-2"></i>
                            <h5 class="fbold f18 m-b-2" style="color:#fff;">Dapatkan info terbaru</h5>
                            <p class="f12" style="color:#fff;">Berlangganan info terbaru(Secara Gratis) seputar proyek, konstruksi atau seputar trik dan tips perawatan alat berat</p>
                            <div class="input-group input-group-md pull-left" style="width:100%;">
                                <input type="text" class="form-control" placeholder="Alamat Email Anda" value="<?php echo $userEmail ?>" required>
                                <div name="subscribe" class="input-group-addon btn search-button fbold" id="searchbuttontemplate" style="background:#ff9900; color:#fff;">
                                    Kirim
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=" row m-t-2" style="padding:6px 15px; background-color:black;">
            <div class="col-lg-12">
                <h6 class="text-center" style="color: #fff;">Trumecs.com © 2022 | Trisindo Raya Utama</h6>
            </div>
        </div>
    </div>
</footer>
<style>
    .logo a img {
        width: 200px;
    }

    .icon-footer {
        color: #fff;
        font-size: 30px;
        margin-right: 15px;
    }
</style>