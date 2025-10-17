<?php
$session = $this->session->all_userdata();
$sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
?>

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
                        <a href="<?php echo site_url("bulk"); ?>" class="btn btnnew f16 radius-lg-new" style="font-family:'Lato'" >Infokan Kebutuhanmu</a>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="menu-kanan-atas" style="text-align:end;">
                    <a href="<?php echo base_url() ?>cart" style="margin-right:20px;">
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
                        <a href="<?php echo base_url() ?>chat" style="margin-right:20px;">
                            <small class="label label-danger f12 badge"><?php echo count($this->cart->contents()) ?></small>
                            <i class="fa fa-commenting-o"></i>
                        </a>
                        <a href="<?php echo base_url() ?>notification" style="margin-right:20px;">
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