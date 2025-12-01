<?php if ($this->uri->segment(2) == 'article') { ?>
    <footer>
        <div class="container-fluid bg-black py-3 mt-2">
            <div class="row flex-column gy-3 align-items-start">
                <?php
                $session = $this->session->all_userdata();
                $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
                if ($sessionmember["id"] != null) :
                ?>
                <?php else : ?>
                    <div class="col-12 text-center">
                        <p class="f14 fbold text-white mb-2"><?php echo $this->lang->line('perluas_bisnis', FALSE) ?></p>
                        <a class="text-warning text-decoration-none" href="<?php echo base_url("member/login") ?>?">
                            <?php echo $this->lang->line('tombol_bergabung_sekarang', FALSE) ?>
                        </a>
                        <div class="border-top border-secondary mt-3"></div>
                    </div>
                <?php endif ?>

                <div class="col-12">
                    <div class="logo text-center">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo base_url() ?>public/image/logofooternew.png"
                                alt="Trumecs Logo"
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-12">
                    <div class="text-center mb-4">
                        <p class="fbold f16 text-white mb-3">
                            <u class="text-decoration-underline" style="text-underline-offset: 5px;">
                                <?php echo $this->lang->line('hubungi_kami', FALSE) ?>
                            </u>
                        </p>
                    </div>

                    <div class="row g-2">
                        <div class="col-12">
                            <a class="contact-card d-flex align-items-center text-decoration-none p-3 bg-dark bg-opacity-50 rounded-3 mb-2"
                                href="https://wa.me/<?php echo platform_contact('whatsapp') ?>"
                                target="_blank" rel="noreferrer">
                                <i class="fa fa-whatsapp text-success me-3 fs-5"></i>
                                <div class="flex-grow-1">
                                    <p class="f14 fbold text-white mb-0">WhatsApp</p>
                                </div>
                                <small class="text-white-50"><?php echo platform_contact('whatsapp') ?></small>
                            </a>
                        </div>

                        <div class="col-12">
                            <a class="contact-card d-flex align-items-center text-decoration-none p-3 bg-dark bg-opacity-50 rounded-3 mb-2"
                                href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=<?php echo platform_contact('email') ?>"
                                target="_blank" rel="noreferrer">
                                <i class="fa fa-envelope text-danger me-3 fs-5"></i>
                                <div class="flex-grow-1">
                                    <p class="f14 fbold text-white mb-0">Email</p>
                                </div>
                                <small class="text-white-50"><?php echo platform_contact('email') ?></small>
                            </a>
                        </div>

                        <div class="col-12">
                            <a class="contact-card d-flex align-items-center text-decoration-none p-3 bg-dark bg-opacity-50 rounded-3"
                                href="https://goo.gl/maps/a4emSqqX4qWaQikG7"
                                target="_blank" rel="noreferrer">
                                <i class="fa fa-map-marker text-primary me-3 fs-5"></i>
                                <div class="flex-grow-1">
                                    <p class="f14 fbold text-white mb-0">Alamat Kami</p>
                                    <small class="text-white-50"><?php echo platform_contact('address') ?></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="col-12 text-center">
                    <p class="fbold f14 text-white">
                        <u class="text-decoration-underline" style="text-underline-offset: 5px;">
                            <?php echo $this->lang->line('ikuti_kami', FALSE) ?>
                        </u>
                    </p>
                </div>

                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                        <a href="https://www.linkedin.com/company/trumecs" target="_blank" rel="noreferrer"
                            class="social-card d-flex align-items-center justify-content-center rounded-2 text-decoration-none"
                            style="width: 44px; height: 44px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa fa-linkedin text-white fs-6"></i>
                        </a>
                        <a href="https://www.instagram.com/trumecs" target="_blank" rel="noreferrer"
                            class="social-card d-flex align-items-center justify-content-center rounded-2 text-decoration-none"
                            style="width: 44px; height: 44px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa fa-instagram text-white fs-6"></i>
                        </a>
                        <a href="https://www.facebook.com/trumecsid" target="_blank" rel="noreferrer"
                            class="social-card d-flex align-items-center justify-content-center rounded-2 text-decoration-none"
                            style="width: 44px; height: 44px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa fa-facebook text-white fs-6"></i>
                        </a>
                        <a href="https://twitter.com/trumecs" target="_blank" rel="noreferrer"
                            class="social-card d-flex align-items-center justify-content-center rounded-2 text-decoration-none"
                            style="width: 44px; height: 44px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa fa-twitter text-white fs-6"></i>
                        </a>
                        <a href="#"
                            class="social-card d-flex align-items-center justify-content-center rounded-2 text-decoration-none"
                            style="width: 44px; height: 44px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa fa-youtube-play text-white fs-6"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 d-flex flex-column gap-2 align-items-start">
                    <p class="fbold text-white mb-1">
                        <i class="fa fa-book text-warning"></i>
                        <?php echo $this->lang->line('pelajari_trumecs', FALSE) ?>
                    </p>
                    <p class="f12 text-white mb-2"><?php echo $this->lang->line('pelajari_trumecs_isi', FALSE) ?></p>
                    <a href="<?php echo base_url() ?>page" class="btn btn-warning text-white f12">
                        <?php echo $this->lang->line('tombol_baca_dulu', FALSE) ?>
                    </a>
                </div>

                <div class="col-12">
                    <form action="_footermobile_new.php" method="POST" class="d-flex flex-column gap-2 align-items-start">
                        <?php $userEmail = "";
                        if (isset($_POST['subscribe'])) {
                            $userEmail = $_POST['email'];
                            if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                                $subject = "Terima kasih telah berlangganan - Trumecs.com";
                                $message = "Terimakasih telah berlangganan, kami akan mengirimkan promo terbaik yang kamu punya setiap minggunya kepada anda.";
                                $sender = "From: muhammadraxshanaditya@gmail.com";
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
                        <p class="fbold f16 text-white mb-1">
                            <i class="fa fa-envelope text-warning"></i>
                            <?php echo $this->lang->line('info_trumecs', FALSE) ?>
                        </p>
                        <p class="f12 text-white mb-2"><?php echo $this->lang->line('info_trumecs_isi', FALSE) ?></p>
                        <div class="input-group input-group-sm w-100">
                            <input type="email"
                                class="form-control"
                                name="email"
                                placeholder="<?php echo $this->lang->line('placeholder_email_anda', FALSE) ?>"
                                value="<?php echo $userEmail ?>"
                                required>
                            <button type="submit"
                                name="subscribe"
                                class="btn btn-warning text-white f12"
                                style="background:#fa8420; color:#fff;">
                                <?php echo $this->lang->line('tombol_kirim', FALSE) ?>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-12 text-center mb-3">
                    <p class="f10 text-white mb-0">Trumecs.com © 2024</p>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .contact-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-card:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .social-card {
            transition: all 0.3s ease;
        }

        .social-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
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
            <div class="container-fluid" style="background-color: black;">
                <div class="row p-t-1 m-a-0">
                    <div class="col-xs-12 text-center">
                        <h6 class="f14 fbold fwhite"><?php echo $this->lang->line('perluas_bisnis', FALSE) ?></h6>
                        <a class="forange" href="<?php echo base_url("member/login") ?>?"><?php echo $this->lang->line('tombol_bergabung_sekarang', FALSE) ?></a>
                        <hr class="hr-solid">
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="container" style="background-color: black;">
            <div class="row m-a-0" style="padding:6px 15px;">
                <div class="col-xs-12 m-b-1">
                    <div class="logo text-center">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo base_url() ?>public/image/logofooternew.png" style="width:200px; heigth:150px;">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 text-center" style="color: #fff;">
                    <div class="row m-b-1">
                        <h5 class="fbold text-center f14 m-b-1"><u style="text-underline-offset: 5px;"><?php echo $this->lang->line('hubungi_kami', FALSE) ?></u>
                        </h5>
                        <div class="col-xs-6 m-t-1">
                            <a href="https://wa.me/<?php echo platform_contact('whatsapp') ?>" target="_blank">
                                <i class="fa fa-whatsapp icon-foot"></i><br>
                                <h6 class="f12" style="color:#fff;"> <?php echo platform_contact('whatsapp') ?></h6>
                            </a>
                        </div>
                        <div class="col-xs-6 m-t-1">
                            <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=<?php echo platform_contact('email') ?>" target="_blank">
                                <i class="fa fa-envelope icon-foot"></i><br>
                                <h6 class="f12" style="color:#fff;"><?php echo platform_contact('email') ?></h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 m-t-1 m-b-1">
                        <a href="https://goo.gl/maps/a4emSqqX4qWaQikG7" target="_blank">
                            <i class="fa fa-map-marker icon-foot"></i><br>
                            <h6 class="f12" style="color:#fff;"><?php echo platform_contact('address') ?></h6>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 text-center m-t-1" style="color: #fff;">
                    <h5 class="fbold f14 m-b-1  "><u style="text-underline-offset: 5px;"><?php echo $this->lang->line('ikuti_kami', FALSE) ?></u>
                    </h5>
                </div>
                <div class="col-xs-12 d-flex-sb">
                    <a href="https://www.linkedin.com/company/trumecs" target="_blank"><i class="fa fa-linkedin-square icon-footer"></i></a>
                    <a href="https://www.instagram.com/trumecs" target="_blank"><i class="fa fa-instagram icon-footer"></i></a>
                    <a href="https://www.facebook.com/trumecsid" target="_blank"><i class="fa fa-facebook-square icon-footer"></i></a>
                    <a href="https://twitter.com/trumecs" target="_blank"><i class="fa fa-twitter icon-footer"></i></a>
                    <a href="#"><i class="fa fa-youtube-play icon-foot"></i></a>
                </div>
                <div class="clearfix m-b-2"></div>
                <div class="col-xs-12">
                    <h5 class="fbold f16 m-b-1" style="color:#fff;"><i class="fa fa-book"></i>
                        <?php echo $this->lang->line('pelajari_trumecs', FALSE) ?></h5>
                    <p class="f12" style="color:#fff;"><?php echo $this->lang->line('pelajari_trumecs_isi', FALSE) ?></p>
                    <a href="<?php echo base_url() ?>page" style="color: #fa8420;" class="btn btnnew f12"><?php echo $this->lang->line('tombol_baca_dulu', FALSE) ?></a>
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
                        <h5 class="fbold f16 m-b-1" style="color:#fff;"><i class="fa fa-envelope" style="margin-top: 10px;"></i> <?php echo $this->lang->line('info_trumecs', FALSE) ?></h5>
                        <p class="f12" style="color:#fff;"><?php echo $this->lang->line('info_trumecs_isi', FALSE) ?></p>
                        <div class="input-group input-group-sm pull-left" style="width:100%;">
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_email_anda', FALSE) ?>" value="<?php echo $userEmail ?>" required>
                            <div name="subscribe" class="input-group-addon btn search-button f12" id="searchbuttontemplate" style="background:#fa8420; color:#fff;">
                                <?php echo $this->lang->line('tombol_kirim', FALSE) ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row m-b-3 m-a-0" style="padding:6px 15px; background-color:black;">
                <div class="col-xs-12">
                    <h6 class="text-center f10" style="color: #fff;">Trumecs.com © 2022 | Tiyasa Makmur Perkasa</h6>
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

<?php  } ?>