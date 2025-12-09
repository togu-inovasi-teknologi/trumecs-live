<?php if ($this->uri->segment(1) == 'article') { ?>

    <footer class="mt-3">
        <?php
        $session = $this->session->all_userdata();
        $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
        if ($sessionmember["id"] != null) :
        ?>
        <?php else : ?>
            <div class="container-fluid" style="max-width:1500px;">
                <div class="row p-3">
                    <div class="col-lg-12 text-center">
                        <p class="fs-4" style="color: #fff;"><?php echo $this->lang->line('perluas_bisnis', FALSE) ?> <a href="<?php echo base_url() ?>member/login" class="btn btn-primary"><?php echo $this->lang->line('tombol_bergabung_sekarang', FALSE) ?></a></p>
                    </div>
                </div>
                <hr class="m-0" style="border-top:1px solid #666;" />
            </div>
        <?php endif ?>
        <div class="container-fluid" style="max-width:1500px;">
            <div class="row px-2 mx-0 py-0">
                <div class="col-lg-3" style="color: #fff;">
                    <div class="logo mt-3">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo base_url() ?>public/image/logofooternew.png" alt="Logo Trumecs Footer">
                        </a>
                    </div>
                    <p class="fw-bold mt-3 mb-3 fs-5"><?php echo $this->lang->line('ikuti_kami', FALSE) ?></p>
                    <a href="https://www.linkedin.com/company/trumecs" target="_blank" rel="noreferrer"><i class="fab fa-linkedin icon-footer"></i></a>
                    <a href="https://www.instagram.com/trumecs" target="_blank" rel="noreferrer"><i class="fab fa-instagram icon-footer"></i></a>
                    <a href="https://www.facebook.com/trumecsid" target="_blank" rel="noreferrer"><i class="fab fa-facebook-square icon-footer"></i></a>
                    <a href="https://twitter.com/trumecs" target="_blank" rel="noreferrer"><i class="fab fa-twitter icon-footer"></i></a>
                    <a href="https://www.youtube.com/@trumecs" target="_blank" rel="noreferrer"><i class="fab fa-youtube icon-footer"></i></a>
                </div>
                <div class="col-lg-3 mt-3" style="color: #fff;">
                    <p class="fw-bold fs-5"><?php echo $this->lang->line('hubungi_kami', FALSE) ?></p>
                    <div class="contact-info mt-3">
                        <div class="contact-item d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fab fa-whatsapp icon-footer"></i>
                            </div>
                            <div>
                                <a href="https://wa.me/<?php echo "+" . platform_contact('whatsapp') ?>" target="_blank" rel="noopener noreferrer">
                                    <p class="fs-6 mb-0" style="color:#fff;">+<?php echo platform_contact('whatsapp') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class="contact-item d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fas fa-envelope icon-footer"></i>
                            </div>
                            <div>
                                <a href="mailto:<?php echo platform_contact('email') ?>" target="_blank" rel="noopener noreferrer">
                                    <p class="fs-6 mb-0" style="color:#fff;"><?php echo platform_contact('email') ?></p>
                                </a>
                            </div>
                        </div>

                        <div class="contact-item d-flex align-items-start mb-3">
                            <div class="me-3">
                                <i class="fas fa-map-marker-alt icon-footer"></i>
                            </div>
                            <div>
                                <a href="https://goo.gl/maps/a4emSqqX4qWaQikG7" target="_blank" rel="noopener noreferrer">
                                    <p class="fs-6 mb-0" style="color:#fff;"><?php echo platform_contact('address') ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <p class="fs-4 fw-bold text-end" style="color:#fff;"><?php echo $this->lang->line('ragu_trumecs', FALSE) ?></p>
                    <div class="row mt-4 mb-4 py-0">
                        <div class="col-lg-6">
                            <i class="fas fa-book icon-footer mb-3"></i>
                            <p class="fw-bold fs-5" style="color:#fff;"><?php echo $this->lang->line('pelajari_trumecs') ?></p>
                            <p class="fs-6" style="color:#fff;"><?php echo $this->lang->line('pelajari_trumecs_isi', FALSE) ?></p>
                            <a href="<?php echo base_url() ?>page" class="btn btn-primary"><?php echo $this->lang->line('tombol_baca_dulu', FALSE) ?></a>
                        </div>
                        <div class="col-lg-6 text-end">
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
                                            <div class="alert alert-success">
                                                <?php echo "Terimakasih telah berlangganan" ?>
                                            </div>
                                        <?php
                                            $userEmail = "";
                                        } else { ?>
                                            <div class="alert alert-success">
                                                <?php echo "Terimakasih telah berlangganan" ?>
                                            </div>
                                        <?php
                                        }
                                    } else { ?>
                                        <div class="alert alert-danger">
                                            <?php echo " $userEmail bukan email yang aktif" ?>
                                        </div>
                                <?php
                                    }
                                } ?>
                                <i class="fas fa-envelope icon-footer mb-3"></i>
                                <p class="fw-bold fs-5" style="color:#fff;"><?php echo $this->lang->line('info_trumecs', FALSE) ?></p>
                                <p class="fs-6" style="color:#fff;"><?php echo $this->lang->line('info_trumecs_isi', FALSE) ?></p>
                                <div class="input-group input-group-lg" style="width:100%;">
                                    <input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_email_anda', FALSE) ?>" value="<?php echo $userEmail ?>" style="border-radius:0;" required>
                                    <button type="submit" name="subscribe" class="btn search-button fw-bold" style="background:#fa8420; color:#fff; border-radius:0;">
                                        <?php echo $this->lang->line('tombol_kirim', FALSE) ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4" style="padding:6px 15px; background-color:black;">
                <div class="col-lg-12 mt-4">
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

        .btn-primary {
            background-color: #fa8420;
            border-color: #fa8420;
            border-radius: 0;
        }

        .btn-primary:hover {
            background-color: #e6761a;
            border-color: #e6761a;
        }
    </style>

<?php } else { ?>
    <footer>
        <?php
        $session = $this->session->all_userdata();
        $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
        if ($sessionmember["id"] != null) :
        ?>
        <?php else : ?>
            <div class="container-fluid" style="max-width:1500px;">
                <div class="row p-a-1 m-a-0 p-a-0">
                    <div class="col-lg-12 text-center">
                        <h4 style="color: #fff;"><?php echo $this->lang->line('perluas_bisnis', FALSE) ?> <a
                                href="<?php echo base_url() ?>member/login"
                                class="btn btnnew"><?php echo $this->lang->line('tombol_bergabung_sekarang', FALSE) ?></a></h4>
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
                            <img src="<?php echo base_url() ?>public/image/logofooternew.png">
                        </a>
                    </div>
                    <h5 class="fbold m-t-2 f18"><?php echo $this->lang->line('ikuti_kami', FALSE) ?></h5>
                    <br>
                    <a href="https://www.linkedin.com/company/trumecs" target="_blank"><i
                            class="fa fa-linkedin-square icon-footer"></i></a>
                    <a href="https://www.instagram.com/trumecs" target="_blank"><i
                            class="fa fa-instagram icon-footer"></i></a>
                    <a href="https://www.facebook.com/trumecsid" target="_blank"><i
                            class="fa fa-facebook-square icon-footer"></i></a>
                    <a href="https://twitter.com/trumecs" target="_blank"><i class="fa fa-twitter icon-footer"></i></a>
                    <a href="https://www.youtube.com/@trumecs" target="_blank"><i
                            class="fa fa-youtube-play icon-footer"></i></a>
                </div>
                <div class="col-lg-3 m-t-2" style="color: #fff;">
                    <h5 class="fbold f18"><?php echo $this->lang->line('hubungi_kami', FALSE) ?></h5>
                    <br>
                    <div class="row m-a-0 p-a-0">
                        <div class="col-xs-2">
                            <i class="fa fa-whatsapp icon-footer"></i>
                        </div>
                        <div class="col-xs-10" style="margin-top: 5px;">
                            <a href="https://wa.me/<?php echo platform_contact('whatsapp') ?>" target="_blank">
                                <h6 class="f14" style="color:#fff;"> <?php echo platform_contact('whatsapp') ?></h6>
                            </a>
                        </div>
                    </div>
                    <div class="row m-t-2 m-a-0 p-a-0">
                        <div class="col-xs-2">
                            <i class="fa fa-envelope icon-footer"></i>
                        </div>
                        <div class="col-xs-10" style="margin-top: 5px;">
                            <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=<?php echo platform_contact('email') ?>"
                                target="_blank">
                                <h6 class="f14" style="color:#fff;"><?php echo platform_contact('email') ?></h6>
                            </a>
                        </div>
                    </div>
                    <div class="row m-t-2 m-a-0 p-a-0">
                        <div class="col-xs-2">
                            <i class="fa fa-map-marker icon-footer"></i>
                        </div>
                        <div class="col-xs-10" style="margin-top: 5px;">
                            <a href="https://goo.gl/maps/a4emSqqX4qWaQikG7" target="_blank">
                                <h6 class="f14" style="color:#fff;"><?php echo platform_contact('address') ?></h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 m-t-1">
                    <h5 class="fbold text-right" style="color:#fff;"><?php echo $this->lang->line('ragu_trumecs', FALSE) ?>
                    </h5>
                    <div class="row m-t-2 m-a-0 p-a-0">
                        <div class="col-lg-6">
                            <i class="fa fa-book icon-footer m-b-2"></i>
                            <h5 class="fbold f18" style="color:#fff;"><?php echo $this->lang->line('pelajari_trumecs') ?>
                            </h5>
                            <p class="f12" style="color:#fff;">
                                <?php echo $this->lang->line('pelajari_trumecs_isi', FALSE) ?></p>
                            <a href="<?php echo base_url() ?>page"
                                class="btn btnnew"><?php echo $this->lang->line('tombol_baca_dulu', FALSE) ?></a>
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
                                <h5 class="fbold f18 m-b-2" style="color:#fff;">
                                    <?php echo $this->lang->line('info_trumecs', FALSE) ?></h5>
                                <p class="f12" style="color:#fff;">
                                    <?php echo $this->lang->line('info_trumecs_isi', FALSE) ?></p>
                                <div class="input-group input-group-md pull-left" style="width:100%;">
                                    <input type="text" class="form-control"
                                        placeholder="<?php echo $this->lang->line('placeholder_email_anda', FALSE) ?>"
                                        value="<?php echo $userEmail ?>" style="border-radius:0;" required>
                                    <div name="subscribe" class="input-group-addon btn search-button fbold"
                                        id="searchbuttontemplate" style="background:#fa8420; color:#fff;">
                                        <?php echo $this->lang->line('tombol_kirim', FALSE) ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row m-t-2 m-a-0 p-a-0" style="padding:6px 15px; background-color:black;">
                <div class="col-lg-12">
                    <h6 class="text-center" style="color: #fff;">Trumecs.com © 2022 | Tiyasa Makmur Perkasa</h6>
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
    </style>
<?php } ?>