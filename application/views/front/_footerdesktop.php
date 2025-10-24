<footer class="m-t-1">
    <?php
    $session = $this->session->all_userdata();
    $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
    if ($sessionmember["id"] != null) :
    ?>
    <?php else : ?>
        <div class="container-fluid" style="max-width:1500px;">
            <div class="row p-a-1">
                <div class="col-lg-12 text-center">
                    <p class="f24" style="color: #fff;"><?php echo $this->lang->line('perluas_bisnis', FALSE) ?> <a href="<?php echo base_url() ?>member/login" class="btn btnnew"><?php echo $this->lang->line('tombol_bergabung_sekarang', FALSE) ?></a></p>
                </div>
            </div>
            <hr class="m-a-0" style="border-top:1px solid #666;" />
        </div>
    <?php endif ?>
    <div class="container-fluid" style="max-width:1500px;">
        <div class="row p-x-1 m-a-0 p-a-0">
            <div class="col-lg-3" style="color: #fff;">
                <div class="logo m-t-1">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png" alt="Logo Trumecs Footer">
                    </a>
                </div>
                <p class="fbold m-t-1 m-b-1 f18"><?php echo $this->lang->line('ikuti_kami', FALSE) ?></p>
                <a href="https://www.linkedin.com/company/trumecs" target="_blank" rel="noreferrer"><i class="fa fa-linkedin-square icon-footer"></i></a>
                <a href="https://www.instagram.com/trumecs" target="_blank" rel="noreferrer"><i class="fa fa-instagram icon-footer"></i></a>
                <a href="https://www.facebook.com/trumecsid" target="_blank" rel="noreferrer"><i class="fa fa-facebook-square icon-footer"></i></a>
                <a href="https://twitter.com/trumecs" target="_blank" rel="noreferrer"><i class="fa fa-twitter icon-footer"></i></a>
                <a href="https://www.youtube.com/@trumecs" target="_blank" rel="noreferrer"><i class="fa fa-youtube-play icon-footer"></i></a>
            </div>
            <div class="col-lg-3 m-t-1" style="color: #fff;">
                <p class="fw-bold f18"><?php echo $this->lang->line('hubungi_kami', FALSE) ?></p>
                <div class="contact-info m-t-1">
                    <div class="contact-item d-flex align-items-center m-b-1">
                        <div class="me-3">
                            <i class="fa fa-whatsapp icon-footer"></i>
                        </div>
                        <div>
                            <a href="https://wa.me/<?php echo "+" . platform_contact('whatsapp') ?>" target="_blank" rel="noopener noreferrer">
                                <p class="f14 mb-0" style="color:#fff;">+<?php echo platform_contact('whatsapp') ?></p>
                            </a>
                        </div>
                    </div>
                    <div class="contact-item d-flex align-items-center m-b-1">
                        <div class="me-3">
                            <i class="fa fa-envelope icon-footer"></i>
                        </div>
                        <div>
                            <a href="mailto:<?php echo platform_contact('email') ?>" target="_blank" rel="noopener noreferrer">
                                <p class="f14 mb-0" style="color:#fff;"><?php echo platform_contact('email') ?></p>
                            </a>
                        </div>
                    </div>

                    <div class="contact-item d-flex align-items-start m-b-1">
                        <div class="me-3">
                            <i class="fa fa-map-marker icon-footer"></i>
                        </div>
                        <div>
                            <a href="https://goo.gl/maps/a4emSqqX4qWaQikG7" target="_blank" rel="noopener noreferrer">
                                <p class="f14 mb-0" style="color:#fff;"><?php echo platform_contact('address') ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 m-t-1">
                <p class="f20 fbold text-right" style="color:#fff;"><?php echo $this->lang->line('ragu_trumecs', FALSE) ?></p>
                <div class="row m-t-2 m-b-2 p-a-0">
                    <div class="col-lg-6">
                        <i class="fa fa-book icon-footer m-b-2"></i>
                        <p class="fbold f18" style="color:#fff;"><?php echo $this->lang->line('pelajari_trumecs') ?></p>
                        <p class="f12" style="color:#fff;"><?php echo $this->lang->line('pelajari_trumecs_isi', FALSE) ?></p>
                        <a href="<?php echo base_url() ?>page" class="btn btnnew"><?php echo $this->lang->line('tombol_baca_dulu', FALSE) ?></a>
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
                            <p class="fbold f18" style="color:#fff;"><?php echo $this->lang->line('info_trumecs', FALSE) ?></p>
                            <p class="f12" style="color:#fff;"><?php echo $this->lang->line('info_trumecs_isi', FALSE) ?></p>
                            <div class="input-group input-group-md pull-left" style="width:100%;">
                                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_email_anda', FALSE) ?>" value="<?php echo $userEmail ?>" style="border-radius:0;" required>
                                <div name="subscribe" class="input-group-addon btn search-button fbold" id="searchbuttontemplate" style="background:#fa8420; color:#fff;">
                                    <?php echo $this->lang->line('tombol_kirim', FALSE) ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=" row m-t-2" style="padding:6px 15px; background-color:black;">
            <div class="col-lg-12 m-t-2">
                <p class="text-center" style="color: #fff;">Trumecs.com © 2022 | Tiyasa Makmur Perkasa</p>
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

    footer {
        background-color: #000;
    }

    .contact-item a {
        text-decoration: none;
    }

    .contact-item a:hover p {
        color: #fa8420 !important;
    }
</style>