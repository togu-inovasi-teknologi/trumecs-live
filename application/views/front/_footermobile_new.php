<footer>
    <div class="container-fluid bg-black p-y-1">
        <div class="row d-flex flex-column gap-3 align-items-start">
            <?php
            $session = $this->session->all_userdata();
            $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
            if ($sessionmember["id"] != null) :
            ?>
            <?php else : ?>
                <div class="col-xs-12 text-center">
                    <p class="f14 fbold fwhite"><?php echo $this->lang->line('perluas_bisnis', FALSE) ?></p>
                    <a class="forange" href="<?php echo base_url("member/login") ?>?"><?php echo $this->lang->line('tombol_bergabung_sekarang', FALSE) ?></a>
                    <div class="hr-solid m-t-1"></div>
                </div>
            <?php endif ?>
            <div class="col-xs-12">
                <div class="logo text-center">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png" style="width:200px; heigth:150px;">
                    </a>
                </div>
            </div>
            <div class="col-xs-12 text-center d-flex flex-column gap-3">
                <p class="fbold text-center f14 fwhite"><u style="text-underline-offset: 5px;"><?php echo $this->lang->line('hubungi_kami', FALSE) ?></u>
                </p>
                <div class="row d-flex flex-column gap-2">
                    <div class="d-flex-sb align-items-center">
                        <div class="col-xs-6">
                            <a class="d-flex flex-column gap-1" href="https://wa.me/<?php echo platform_contact('whatsapp') ?>" target="_blank"  rel="noreferrer">
                                <i class="fa fa-whatsapp f30 fwhite"></i>
                                <p class="f12 fwhite"> <?php echo platform_contact('whatsapp') ?></p>
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <a class="d-flex flex-column gap-1" href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=<?php echo platform_contact('email') ?>" target="_blank"  rel="noreferrer">
                                <i class="fa fa-envelope f30 fwhite"></i>
                                <p class="f12 fwhite"><?php echo platform_contact('email') ?></p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <a class="d-flex flex-column gap-1" href="https://goo.gl/maps/a4emSqqX4qWaQikG7" target="_blank" rel="noreferrer">
                            <i class="fa fa-map-marker f30 fwhite"></i>
                            <p class="f12 fwhite"><?php echo platform_contact('address') ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-center" style="color: #fff;">
                <p class="fbold f14"><u style="text-underline-offset: 5px;"><?php echo $this->lang->line('ikuti_kami', FALSE) ?></u>
                </p>
            </div>
            <div class="col-xs-12 d-flex-sa align-items-center">
                <a href="https://www.linkedin.com/company/trumecs" target="_blank" rel="noreferrer"><i class="fa fa-linkedin-square f30 fwhite"></i></a>
                <a href="https://www.instagram.com/trumecs" target="_blank" rel="noreferrer"><i class="fa fa-instagram f30 fwhite"></i></a>
                <a href="https://www.facebook.com/trumecsid" target="_blank" rel="noreferrer"><i class="fa fa-facebook-square f30 fwhite"></i></a>
                <a href="https://twitter.com/trumecs" target="_blank" rel="noreferrer"><i class="fa fa-twitter f30 fwhite"></i></a>
                <a href="#"><i class="fa fa-youtube-play f30 fwhite"></i></a>
            </div>
            <div class="col-xs-12 d-flex flex-column gap-2 align-items-start">
                <p class="fbold fwhite"><i class="fa fa-book forange"></i>
                    <?php echo $this->lang->line('pelajari_trumecs', FALSE) ?></p>
                <p class="f12 fwhite"><?php echo $this->lang->line('pelajari_trumecs_isi', FALSE) ?></p>
                <a href="<?php echo base_url() ?>page" style="color: #fa8420;" class="btn btnnew f12 fwhite"><?php echo $this->lang->line('tombol_baca_dulu', FALSE) ?></a>
            </div>
            <div class="col-xs-12">
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
                    <p class="fbold f16 fwhite"><i class="fa fa-envelope forange"></i> <?php echo $this->lang->line('info_trumecs', FALSE) ?></p>
                    <p class="f12 fwhite"><?php echo $this->lang->line('info_trumecs_isi', FALSE) ?></p>
                    <div class="input-group input-group-sm pull-left" style="width:100%;">
                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_email_anda', FALSE) ?>" value="<?php echo $userEmail ?>" required>
                        <div name="subscribe" class="input-group-addon btn search-button f12" id="searchbuttontemplate" style="background:#fa8420; color:#fff;">
                            <?php echo $this->lang->line('tombol_kirim', FALSE) ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 text-center m-b-3">
                <p class="f10 fwhite">Trumecs.com © 2024</p>
            </div>
        </div>
    </div>
</footer>