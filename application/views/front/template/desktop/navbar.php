<?php
$session = $this->session->all_userdata();
$sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
?>
<nav class="navbar navbar-expand-lg bg-white border-bottom" role="navigation">
    <div class="container-fluid d-flex flex-column gap-1 py-2 px-4">
        <div class=" d-flex align-items-center justify-content-between w-100">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>public/image/logotrumecsnew.png" alt="Trumecs.com logo" height="40">
                </a>
            </div>

            <!-- Search Section -->
            <div class="flex-grow-1 mx-4">
                <div class="d-flex align-items-center justify-content-center gap-3 w-100">
                    <div class="flex-grow-1" style="max-width: 600px;">
                        <div class="input-group" id="inputsearch">
                            <input type="text" class="form-control rounded-start" id="searchInput"
                                placeholder="<?= isset($search_placeholder) ? $search_placeholder : $this->lang->line('placeholder_pencarian', FALSE) ?>"
                                value="<?php echo $this->input->get("nama"); ?>">
                            <button class="btn btn-primary rounded-end" id="searchbuttontemplate">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="mb-0 text-muted"><small><strong>atau</strong></small></p>
                    </div>
                    <div class="flex-shrink-0" style="min-width: 160px;">
                        <a href="<?php echo site_url("bulk"); ?>" class="btn btn-primary w-100 py-2">
                            Infokan Kebutuhanmu
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Menu (tetap sama) -->
            <div class="flex-shrink-0">
                <div class="d-flex align-items-center gap-3">
                    <a href="<?php echo base_url() ?>cart" class="position-relative text-dark text-decoration-none">
                        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            <?php echo count($this->cart->contents()) ?>
                        </span>
                        <i class="bi bi-cart fs-5"></i>
                    </a>

                    <?php if ($sessionmember["id"] != null) :
                        $member = $session["member"];
                        $namemember = $member["name"];
                        $fotomember = $member["avatar"];
                        $foto = (explode(':', $fotomember));
                    ?>
                        <!-- Chat -->
                        <a href="<?php echo base_url() ?>chat" class="position-relative text-dark text-decoration-none">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                <?php echo count($this->cart->contents()) ?>
                            </span>
                            <i class="bi bi-chat-dots fs-5"></i>
                        </a>

                        <!-- Notification -->
                        <a href="<?php echo base_url() ?>notification" class="position-relative text-dark text-decoration-none">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                <?php echo count($this->cart->contents()) ?>
                            </span>
                            <i class="bi bi-bell fs-5"></i>
                        </a>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a class="dropdown-toggle text-dark text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person fs-5"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="min-width: 280px;">
                                <li>
                                    <a href="<?php echo base_url() ?>member" class="dropdown-item py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <?php if ($foto[0] == 'https') { ?>
                                                <img src="<?= $fotomember ?>" alt="Avatar" class="rounded-circle" width="45" height="45" style="object-fit: cover;">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url() ?>public/image/member/<?php echo ($fotomember == null) ? "profile-default.png" : $fotomember ?>"
                                                    alt="Avatar" class="rounded-circle" width="45" height="45" style="object-fit: cover;">
                                            <?php } ?>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold"><?php echo $namemember ?></span>
                                                <span class="text-muted small">Akun Saya</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-2">
                                </li>
                                <li>
                                    <div class="row g-0 text-center">
                                        <div class="col-6 border-end">
                                            <a href="<?php echo base_url() ?>member/store" class="dropdown-item py-2">
                                                <i class="bi bi-building me-2"></i>
                                                <span>Toko</span>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="<?php echo base_url() ?>member/bulk" class="dropdown-item py-2">
                                                <i class="bi bi-files me-2"></i>
                                                <span>RFQ Saya</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-2">
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>member/logout" class="dropdown-item text-danger py-2">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        <span>Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    <?php else : ?>
                        <!-- Login/Register -->
                        <a href="<?php echo site_url('member/login'); ?>" class="btn btn-outline-primary btn-sm px-3">
                            <?php echo $this->lang->line('daftar', FALSE) ?> / <?php echo $this->lang->line('masuk', FALSE) ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center w-100">
            <!-- Category Dropdown -->
            <div class="d-flex gap-3 menu-utama bottom_nav_menu">
                <?php echo $this->load->view("front/template/desktop/category-dropdown"); ?>
            </div>

            <!-- Main Menu -->
            <div class="d-flex align-items-center gap-4">
                <a href="<?php echo site_url('article'); ?>"
                    class="text-decoration-none <?php echo ($this->uri->segment(1) == "article") ? "text-warning fw-bold" : "text-dark"; ?>">
                    <?php echo $this->lang->line('artikel', FALSE); ?>
                </a>
                <a href="<?php echo site_url('promo'); ?>"
                    class="text-decoration-none <?php echo ($this->uri->segment(1) == "promo") ? "text-warning fw-bold" : "text-dark"; ?>">
                    <?php echo $this->lang->line('promo', FALSE) ?>
                </a>

                <!-- Language Dropdown -->
                <!-- <div class="dropdown">
                                <a class="dropdown-toggle text-dark text-decoration-none d-flex align-items-center gap-1"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url() ?>public/icon/flag/<?php echo get_cookie('language'); ?>.png" width="20">
                                    <?php echo $this->lang->line('bahasa'); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="<?php echo 'http://www.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>">
                                            <img src="<?php echo base_url() ?>public/icon/flag/id.png" width="20">
                                            <?php echo $this->lang->line('bahasa_indonesia'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="<?php echo 'http://en.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>">
                                            <img src="<?php echo base_url() ?>public/icon/flag/en.png" width="20">
                                            <?php echo $this->lang->line('bahasa_inggris'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="<?php echo 'http://cn.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>">
                                            <img src="<?php echo base_url() ?>public/icon/flag/cn.png" width="20">
                                            <?php echo $this->lang->line('bahasa_china'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
            </div>
        </div>
    </div>
</nav>
<style>
    .btn-primary {
        background-color: #fa8420;
        border-color: #fa8420;
        border-radius: 0;
    }

    .btn-primary:hover {
        background-color: #e6761a;
        border-color: #e6761a;
    }

    .badge {
        position: absolute;
        top: 10px;
        font-weight: normal;
        height: 17px;
        width: 17px;
        border-radius: 50%;
        display: inline-block;
        text-align: center;
        margin-left: 15px;
        font-size: 10px;
        margin-top: 3px;
    }
</style>