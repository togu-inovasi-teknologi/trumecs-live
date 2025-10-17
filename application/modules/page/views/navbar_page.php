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

nav .container-fluid .row a img {
    width: 200px;
    height: auto;
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
</style>
<nav class="navbar-fixed-top p-b-0" role="navigation">
    <div class="container-fluid p-y-2" style="max-width: 1500px;">
        <div class="row p-y-2 p-x-2 d-flex align-items-center">
            <div class="col-lg-9 d-flex gap-5">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>public/image/logofooternew.png">
                </a>
                <ul class="nav navbar-nav navbar-menu gap-3">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle f14 fbold fwhite" data-toggle="dropdown" role="button"
                            aria-haspopup="true"
                            aria-expanded="false"><?= $this->lang->line('tentang_trumecs', FALSE) ?> <span
                                class="caret"></span></a>
                        <div class="dropdown-menu p-a-1 border-none radius-none">
                            <a href="#tentang">Tentang Trumecs</a>
                            <a href="/article">Artikel</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle f14 fbold fwhite" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false"><?= $this->lang->line('join_trumecs', FALSE) ?>
                            <span class="caret"></span></a>
                        <div class="dropdown-menu p-a-1 border-none radius-none w100">
                            <a href="/principal/form"><?= $this->lang->line('join_principal', FALSE) ?></a>
                            <a href="/principal/form"><?= $this->lang->line('join_agent', FALSE) ?></a>
                        </div>
                    </li>
                    <li class="active"><a href="<?php echo site_url("page/faq"); ?>" class="f14 fbold fwhite">FAQ </a></li>
                    <li class="active"><a href="<?php echo site_url("page/syarat---ketentuan"); ?>" class="f14 fbold fwhite">Syarat & Ketentuan </a></li>
                    <li class="active"><a href="<?php echo site_url("page/kebijakan-retur"); ?>" class="f14 fbold fwhite">Kebijakan Retur </a></li>


                </ul>
            </div>

            <div class="col-lg-3 d-flex">
                <div class="menu-kanan-atas" style="text-align:end;">
                    <a href="<?php echo base_url() ?>cart" style="margin-right:20px;">
                        <small class="label label-danger f12"
                            style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:20px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <?php
                    $session = $this->session->all_userdata();
                    $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
                    if ($sessionmember["id"] != null) :
                    ?>
                    <a href="<?php echo base_url() ?>chat" style="margin-right:20px;">
                        <small class="label label-danger f12"
                            style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:15px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-commenting-o"></i>
                    </a>
                    <a href="<?php echo base_url() ?>notification" style="margin-right:20px;">
                        <small class="label label-danger f12"
                            style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:15px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-bell"></i>
                    </a>
                    <a href="<?php echo base_url() ?>member">
                        <i class="fa fa-user"></i>
                    </a>
                    <?php else : ?>
                    <a href="<?php echo site_url('member/login'); ?>"
                        class="fbold f12"><?php echo $this->lang->line('daftar', FALSE) ?> /
                        <?php echo $this->lang->line('masuk', FALSE) ?></a>
                    <?php endif ?>
                </div>
                <ul class=" navbar-nav menu-bahasa-main m-b-0">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><img style="width: 20px;"
                                src="<?php echo base_url() ?>public/icon/flag/<?php echo get_cookie('language'); ?>.png">
                            <?php echo $this->lang->line('bahasa'); ?> </a>
                        <ul class="dropdown-menu dropdown-bahasa" aria-labelledby="navbarDropdown2"
                            style="overflow-y:scroll;max-height:500px;min-width:115px !important;border:1px solid #ccc;">
                            <li style="background:#fff;color:black;"><a style="padding:5px !important"
                                    alt="Jual Komponen "
                                    href="<?php echo 'http://www.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img
                                        style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/id.png">
                                    <?php echo $this->lang->line('bahasa_indonesia'); ?></a></li>
                            <li style="background:#fff;color:black;"><a style="padding:5px !important"
                                    alt="Jual Komponen "
                                    href="<?php echo 'http://en.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img
                                        style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/en.png">
                                    <?php echo $this->lang->line('bahasa_inggris'); ?></a></li>
                            <li style="background:#fff;"><a style="padding:5px !important" alt="Jual Komponen "
                                    href="<?php echo 'http://cn.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img
                                        style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/cn.png">
                                    <?php echo $this->lang->line('bahasa_china'); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
.dropbtn {
    color: #fff;
    font-size: 16px;
    border: none;
}

.d-down {
    position: relative;
    display: inline-block;
}

.d-down-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 360px;
    border: 1px solid #ccc;
    z-index: 1;
    color: #000;
}

.d-down-content .down-content {
    padding: 5px 10px;
}

.d-down-content .down-content:hover {
    background-color: #fa8420;
    color: #fff;
}

.d-down-content .down-content a h6 {
    color: #000;
    font-weight: 700;
}

.d-down-content .down-content:hover a h6 {
    color: #fff;
    font-weight: 700;
}

.d-down-content .down-content a p {
    color: #aaa;
    font-size: 12px;
    line-height: 12px;
}

.d-down-content .down-content:hover a p {
    color: #fff;
    font-size: 12px;
    line-height: 12px;
}

.d-down:hover .d-down-content {
    display: block;
}
</style>