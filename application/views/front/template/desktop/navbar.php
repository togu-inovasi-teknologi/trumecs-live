<?php
$session = $this->session->all_userdata();
$sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
?>

<?php if ($this->uri->segment(1) == "article" || $this->uri->segment(1) == null) { ?>
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
                        <div class="flex-grow-1" style="max-width: 400px;">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-start"
                                    placeholder="<?= isset($search_placeholder) ? $search_placeholder : $this->lang->line('placeholder_pencarian', FALSE) ?>"
                                    value="<?php echo $this->input->get("nama"); ?>">
                                <button class="btn btn-primary rounded-end" id="searchbuttontemplate">
                                    <i class="fas fa-search"></i>
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
                            <i class="fas fa-shopping-cart fs-5"></i>
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
                                <i class="fas fa-comment fs-5"></i>
                            </a>

                            <!-- Notification -->
                            <a href="<?php echo base_url() ?>notification" class="position-relative text-dark text-decoration-none">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    <?php echo count($this->cart->contents()) ?>
                                </span>
                                <i class="fas fa-bell fs-5"></i>
                            </a>

                            <!-- User Dropdown -->
                            <div class="dropdown">
                                <a class="dropdown-toggle text-dark text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user fs-5"></i>
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
                                                    <i class="fas fa-building me-2"></i>
                                                    <span>Toko</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?php echo base_url() ?>member/bulk" class="dropdown-item py-2">
                                                    <i class="fas fa-files me-2"></i>
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
                                            <i class="fas fa-sign-out-alt me-2"></i>
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
    </style>
<?php } else { ?>
    <nav class="navbar radius-none bg-white navbar-header p-b-0" role="navigation">
        <div class="container-fluid">
            <div class="row d-flex align-items-center justify-content-between navi-atas">
                <div class="col-lg">
                    <a href="<?php echo base_url() ?>">
                        <!-- <img src="<?php echo base_url() ?>public/image/logofooternew.png"> -->
                        <img src="<?php echo base_url() ?>public/image/logotrumecsnew.png" alt="Trumecs.com logo">
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-8 p-a-0">
                            <div class="input-group input-group-md inputsearch">
                                <!-- <div class="input-group-btn">
                        <button class="btn p-a-0">
                            <select class="text-center select-search-category">
                                <?php if ($this->uri->segment(1) == "jasa") { ?>
                                <option value="barang">Product</option>
                                <option value="jasa" selected>Jasa</option>
                                <option value="rental">Rental</option>
                                <?php } else if ($this->uri->segment(1) == "rental") { ?>
                                <option value="barang">Product</option>
                                <option value="jasa">Jasa</option>
                                <option value="rental" selected>Rental</option>
                                <?php } else { ?>
                                <option value="barang" selected>Product</option>
                                <option value="jasa">Jasa</option>
                                <option value="rental">Rental</option>
                                <?php }  ?>
                            </select>
                        </button>
                    </div> -->
                                <input type="text" class="form-control radius-lg-left-new" placeholder="<?= isset($search_placeholder) ? $search_placeholder : $this->lang->line('placeholder_pencarian', FALSE) ?>" value="<?php echo $this->input->get("nama"); ?>">
                                <div class="input-group-btn">
                                    <button class="btn search-button radius-lg-right-new" id="searchbuttontemplate" style="color:#fff;background-color:#fa8420;">
                                        <i class="fa fa-search"></i> <!-- <?= $this->lang->line('cari', FALSE) ?> -->
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 p-a-0 text-center">
                            <p><small><strong>atau</strong></small></p>
                        </div>
                        <div class="col-lg-3 p-a-0">
                            <a href="<?php echo site_url("bulk"); ?>" class="btn btnnew f16 radius-lg-new" style="font-family:'Lato'">Infokan Kebutuhanmu</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="menu-kanan-atas" style="text-align:end;">
                        <a href="<?php echo base_url() ?>cart" class="m-r-1 f24">
                            <small class="label label-danger f12 badge"><?php echo count($this->cart->contents()) ?></small>
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <?php
                        if ($sessionmember["id"] != null) :
                            $member = $session["member"];
                            $namemember = $member["name"];
                            $fotomember = $member["avatar"];
                            $foto = (explode(':', $fotomember));
                        ?>
                            <a href="<?php echo base_url() ?>chat" class="m-r-1 f24">
                                <small class="label label-danger f12 badge"><?php echo count($this->cart->contents()) ?></small>
                                <i class="fa fa-commenting-o"></i>
                            </a>
                            <a href="<?php echo base_url() ?>notification" class="m-r-1 f24">
                                <small class="label label-danger f12 badge"><?php echo count($this->cart->contents()) ?></small>
                                <i class="fa fa-bell"></i>
                            </a>
                            <li class="d-down">
                                <a class="f24" href="<?php echo base_url() ?>member" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                                <ul class="d-down-content-akun" aria-labelledby="navbarDropdown">
                                    <div class="col-lg-12 p-x-0">
                                        <a href="<?php echo base_url() ?>member">
                                            <div class="card card-shadow card-akun d-flex align-items-center gap-3 m-b-0">
                                                <?php if ($foto[0] == 'https') { ?>
                                                    <img src="<?= $fotomember ?>" alt="Avatar" class="avanav">
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url() ?>public/image/member/<?php echo ($fotomember == null) ? "profile-default.png" : $fotomember ?>" alt="Avatar" class="avanav">
                                                <?php } ?>
                                                <div class="d-flex flex-column">
                                                    <h6 class="fbold f12 fblack"><?php echo $namemember ?></h6>
                                                    <h6 class="text-muted f10">Akun Saya</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-12 p-x-0" style="border-bottom: 0.5px solid #ccc;">
                                        <div class="row">
                                            <div class="col-lg-6" style="border-right: 0.5px solid #ccc;">
                                                <a href="<?php echo base_url() ?>member/store" class="list d-flex-sb align-items-center">Toko <i class="fa fa-building"></i></a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a href="<?php echo base_url() ?>member/bulk" class="list d-flex-sb align-items-center">RFQ Saya <i class="fa fa-files-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="<?php echo base_url() ?>member/logout" class="list d-flex-sb align-items-center">Keluar <i class="fa fa-sign-out fred"></i></a>
                                    </div>
                                </ul>
                            </li>
                        <?php else : ?>
                            <a href="<?php echo site_url('member/login'); ?>" class="daftar-login"><?php echo $this->lang->line('daftar', FALSE) ?> /
                                <?php echo $this->lang->line('masuk', FALSE) ?></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="row p-b-2">
                <div class="col-lg">
                    <div class="menu-utama bottom_nav_menu d-flex-sb align-items-center">
                        <div class="dropdown">
                            <?php echo $this->load->view("front/template/desktop/category-dropdown"); ?>
                        </div>
                        <!-- <div class="d-flex gap-3">
                        <a href="<?php echo site_url('rental'); ?>" class=" <?php echo ($this->uri->segment(1) == "rental") ? "forange" : ""; ?>"><?= $this->lang->line('rental_label') ?></a>
                        <a href="<?php echo site_url('jasa'); ?>" class=" <?php echo ($this->uri->segment(1) == "jasa") ? "forange" : ""; ?>"><?= $this->lang->line('jasa_label') ?></a>
                        <div class="dropdown">
                            <a href="<?php echo site_url('rental'); ?>" class=" <?php echo ($this->uri->segment(1) == "rental") ? "forange" : ""; ?>"><?= $this->lang->line('join_trumecs_mitra') ?></a>
                        </div>
                        <div class="dropdown dropdown-partner dropdown-partner">
                            <a href="" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?= $this->lang->line('join_trumecs_mitra') ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-partner" aria-labelledby="dropdownMenu1">
                                <a href="<?= base_url('principal/form') ?>" class="text-dark"><?= $this->lang->line("join_principal", FALSE) ?></a>
                                <a href="<?= base_url('jasa/page') ?>" class="text-muted"><?= $this->lang->line("join_service", FALSE) ?></a>
                                <a href="<?= base_url('rental/page') ?>" class="text-muted"><?= $this->lang->line("join_rental", FALSE) ?></a>
                            </ul>
                        </div>
                    </div> -->
                        <div class="menu-bahasa pull-right menu-utama">
                            <ul class="navbar-nav menu-bahasa-main d-flex gap-3">
                                <!-- <li><a href="<?php echo site_url('article'); ?>"
                                class=" <?php echo ($this->uri->segment(1) == "article") ? "forange" : ""; ?>"><?php echo $this->lang->line('help_buyer', FALSE); ?></a>
                        </li>
                        <li><a href="<?php echo site_url('article'); ?>"
                                class=" <?php echo ($this->uri->segment(1) == "article") ? "forange" : ""; ?>"><?php echo $this->lang->line('help_mitra', FALSE); ?></a>
                        </li> -->
                                <li><a href="<?php echo site_url('article'); ?>" class=" <?php echo ($this->uri->segment(1) == "article") ? "forange" : ""; ?>"><?php echo $this->lang->line('artikel', FALSE); ?></a>
                                </li>
                                <li>
                                    <a href=" <?php echo site_url('promo'); ?>" class=" <?php echo ($this->uri->segment(1) == "promo") ? "forange" : ""; ?>"><?php echo $this->lang->line('promo', FALSE) ?></a>
                                </li>
                                <!--
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/<?php echo get_cookie('language'); ?>.png">
                                    <?php echo $this->lang->line('bahasa'); ?> </a>
                                <ul class="dropdown-menu dropdown-bahasa" aria-labelledby="navbarDropdown2" style="overflow-y:scroll;max-height:500px;min-width:115px !important;border:1px solid #ccc;">
                                    <li style="background:#fff;color:black;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://www.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/id.png">
                                            <?php echo $this->lang->line('bahasa_indonesia'); ?></a></li>
                                    <li style="background:#fff;color:black;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://en.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/en.png">
                                            <?php echo $this->lang->line('bahasa_inggris'); ?></a></li>
                                    <li style="background:#fff;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://cn.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/cn.png">
                                            <?php echo $this->lang->line('bahasa_china'); ?></a></li>
                                </ul>
                            </li>
                            -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<?php } ?>