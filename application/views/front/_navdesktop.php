<nav class="navbar-fixed-top p-b-0" role="navigation">
    <div class="container-fluid p-t-1" style="max-width: 1500px;">
        <div class="row p-b-0">
            <div class="col-lg-3">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>public/image/logofooternew.png" alt="Logo Trumecs">
                </a>
            </div>
            <div class="col-lg-6">
                <div class="input-group input-group-md inputsearch">
                    <div class="input-group-btn">
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
                    </div>
                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_pencarian', FALSE) ?>" value="<?php echo $this->input->get("nama"); ?>" style="border-radius:0;">
                    <div class="input-group-btn">
                        <button class="btn search-button" id="searchbuttontemplate" style="color:#fff;background-color:#fa8420;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="menu-kanan-atas" style="text-align:end;">
                    <a href="<?php echo base_url() ?>cart" style="margin-right:20px;">
                        <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:20px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <?php
                    $session = $this->session->all_userdata();
                    $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
                    if ($sessionmember["id"] != null) :
                        $member = $session["member"];
                        $namemember = $member["name"];
                        $fotomember = $member["avatar"];
                        $foto = (explode(':', $fotomember));
                    ?>
                        <a href="<?php echo base_url() ?>chat" style="margin-right:20px;">
                            <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:15px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                            <i class="fa fa-commenting-o"></i>
                        </a>
                        <a href="<?php echo base_url() ?>notification" style="margin-right:20px;">
                            <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:15px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                            <i class="fa fa-bell"></i>
                        </a>
                        <li class="d-down">
                            <a href="<?php echo base_url() ?>member" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
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
                        <a href="<?php echo site_url('member/login'); ?>" class="fbold daftar-login" style="font-size:18px;"><?php echo $this->lang->line('daftar', FALSE) ?> /
                            <?php echo $this->lang->line('masuk', FALSE) ?></a>
                    <?php endif ?>
                </div>
            </div>
            <div class="clearfix m-b-1"></div>
            <div class="col-lg-10">
                <?php echo $this->load->view("front/_categorydropdown_new"); ?>
                <div class="menu-utama">
                    <a href="<?php echo site_url('article'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "article") ? "forange" : ""; ?>"><?php echo $this->lang->line('artikel', FALSE); ?></a>
                    <a href=" <?php echo site_url('promo'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "promo") ? "forange" : ""; ?>"><?php echo $this->lang->line('promo', FALSE) ?></a>
                    <!-- <a href="" class="m-l-2"><?php echo $this->lang->line('permintaan', FALSE) ?></a> -->
                    <a href="<?php echo site_url('bulk'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "bulk") ? "forange" : ""; ?>">RFQ</a>
                    <a href="<?php echo site_url('jasa'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "jasa") ? "forange" : ""; ?>">Jasa</a>
                    <a href="<?php echo site_url('rental'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "rental") ? "forange" : ""; ?>">Rental</a>
                    <a href="<?php echo site_url('principal/form'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "principal") ? "forange" : ""; ?>">Principal</a>
                    <a href="<?php echo site_url('agent/form'); ?>" class="m-l-2 <?php echo ($this->uri->segment(1) == "agent") ? "forange" : ""; ?>">Agent</a>
                </div>
            </div>
            <div class="col-lg-2 p-r-0">
                <div class="menu-bahasa pull-right menu-utama" style="max-width:150px;">
                    <nav class="navbar" style="padding:0px; background-color:black;">
                        <ul class="navbar-nav menu-bahasa-main">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/<?php echo get_cookie('language'); ?>.png" alt="Logo Bendera">
                                    <?php echo $this->lang->line('bahasa'); ?> </a>
                                <ul class="dropdown-menu dropdown-bahasa" aria-labelledby="navbarDropdown2" style="overflow-y:scroll;max-height:500px;min-width:115px !important;border:1px solid #ccc;">
                                    <li style="background:#fff;color:black;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://www.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/id.png" alt="Bendera Indonesia">
                                            <?php echo $this->lang->line('bahasa_indonesia'); ?></a></li>
                                    <li style="background:#fff;color:black;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://en.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/en.png" alt="Bendera Inggris">
                                            <?php echo $this->lang->line('bahasa_inggris'); ?></a></li>
                                    <li style="background:#fff;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://cn.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/cn.png" alt="Bendera China">
                                            <?php echo $this->lang->line('bahasa_china'); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    nav .inputsearch span,
    nav .inputsearch input {
        border: 1px solid #ddd;
    }

    nav {
        background: black;
        color: #333 !important;
        padding: 0px;
        font-family: 'Poppins', sans-serif;
    }

    nav .container-fluid {
        background-color: black;
    }

    nav .container-fluid .row {
        padding: 6px 15px;
    }

    .menu-utama {
        padding-top: 7px;
    }

    .menu-utama a {
        margin-left: 0px;
        color: #fff;
        text-decoration: none;
    }

    .menu-utama a:hover {
        color: #fa8420;
    }

    .menu-utama a.active {
        color: #fa8420;
    }

    .menu-kanan {
        margin-top: 10px;
    }

    .menu-kanan a {
        margin-top: 20px;
        color: #fff;
    }

    .menu-kanan-atas a {
        color: #fff;
        text-decoration: none;
        font-size: 25px;
    }

    .menu-bahasa {
        background-color: none;
        padding: 0px;
    }

    .menu-bahasa nav ul {
        list-style: none;
        margin: 0px;
        padding: 5px;

    }

    .menu-bahasa>.dropdown-toggle::after {
        display: none;
    }

    .dropdown-bahasa {
        padding: 0;
        margin: 0;
        border: 0 solid transition !important;
        border: 0 solid rgba(0, 0, 0, .15);
        border-radius: 0px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        position: absolute;
        top: 100%;
        left: -15%;
    }

    .dropdown-bahasa>li {
        border-bottom: 1px solid #ccc;
    }

    .dropdown-bahasa>li:last-child {
        border-bottom: none;
    }

    .dropdown-bahasa>li:hover {
        background-color: #fa8420;
    }

    .dropdown-bahasa>li>a {
        color: #333;
        text-decoration: none;
        font-size: 12px;
        display: block;
        width: 100%;
    }

    .dropdown-bahasa>li>a:hover {
        background-color: #fa8420;
        color: #fff;
    }

    .menu-bahasa>.dropdown-bahasa {
        margin-left: 0px !important;
        border: 1px solid #ccc;
    }

    .menu-bahasa>.dropdown {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding-top: 0px !important;
    }

    .menu-bahasa>.dropdown>a {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding-top: 0px !important;
    }

    .daftar-login:hover {
        color: #fa8420;
    }

    .menu-bahasa>.menu-bahasa-main>li>a {
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        font-size: 16px;
        vertical-align: top;
        max-width: 150px;
        text-overflow: ellipsis;
        padding: 10px;
        text-decoration: none;
    }

    .menu-bahasa>.menu-bahasa-main>li>a:hover {
        color: #fa8420;
    }

    .select-search-category {
        width: 100px;
        height: 36px;
        background-color: #fa8420;
        color: #fff;
        border: none;
    }

    .dropbtn {
        color: #fff;
        font-size: 16px;
        border: none;
    }

    .d-down {
        position: relative;
        display: inline-block;
    }

    .d-down-content-akun {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 85%;
        right: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 9999;
        color: #000;
        padding: 10px;
        width: 270px;
        height: 160px;
        overflow-y: scroll;
        text-align: start;
        justify-content: space-between;
    }

    .d-down:hover .d-down-content-akun {
        display: flex;
    }

    .d-down-content-akun .list {
        color: #000;
        font-size: 14px;
    }

    .d-down-content-akun .list:hover {
        color: #fa8420;
    }

    .d-down-content-akun .card-akun {
        padding: 8px 10px;
    }
</style>