<footer>
    <div class="container-fluid bg-black py-3">
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