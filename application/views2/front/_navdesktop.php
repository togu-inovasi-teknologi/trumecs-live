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
        right: 0;
    }

    .dropdown-bahasa>li {
        border-bottom: 1px solid #ccc;
    }

    .dropdown-bahasa>li:last-child {
        border-bottom: none;
    }

    .dropdown-bahasa>li:hover {
        background-color: #ff9900;
    }

    .dropdown-bahasa>li>a {
        color: #333;
        text-decoration: none;
        font-size: 12px;
        display: block;
        width: 100%;
    }

    .dropdown-bahasa>li>a:hover {
        background-color: #ff9900;
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
</style>

<nav class="navbar-fixed-top p-b-0" role="navigation">
    <div class="container-fluid p-t-1 m-b-1">
        <div class="row">
            <?php if ($this->uri->segment(1) == '') : ?>
                <div class="col-lg-10">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png">
                    </a>
                </div>
            <?php else : ?>
                <div class="col-lg-2">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png">
                    </a>
                </div>
                <div class="col-lg-8">
                    <div class="input-group input-group-md inputsearch">
                        <input type="text" class="form-control" placeholder="Kebutuhan mekanikal apa yang anda cari?" value="<?php echo $this->input->get("nama"); ?>">
                        <span class="input-group-addon btn btnnew search-button" id="searchbuttontemplate" style="border-bottom-right-radius:5px;border-top-right-radius:5px;">
                            <i class="fa fa-search"></i> Cari
                        </span>
                        <input type="hidden" name="quality" value="<?php echo $this->uri->segment(2) == 'used' ? "3" : $this->input->get("quality"); ?>">
                    </div>
                </div>
            <?php endif ?>
            <div class="col-lg-2">
                <div class="menu-kanan-atas" style="text-align:end;">
                    <a href="<?php echo base_url() ?>cart" style="margin-right:20px;">
                        <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:20px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <?php
                    $session = $this->session->all_userdata();
                    $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
                    if ($sessionmember["id"] != null) :
                    ?>
                        <a href="<?php echo base_url() ?>chat" style="margin-right:20px;">
                            <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:15px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                            <i class="fa fa-commenting-o"></i>
                        </a>
                        <a href="<?php echo base_url() ?>notification" style="margin-right:20px;">
                            <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:15px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                            <i class="fa fa-bell"></i>
                        </a>
                        <a href="<?php echo base_url() ?>member">
                            <i class="fa fa-user"></i>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo site_url('member/login'); ?>" class="fbold" style="font-size:18px;">Daftar/Masuk</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid m-l-1 p-y-0">
        <?php $this->load->view("front/_categorydropdown_new") ?>
        <div class="menu-utama">
            <a href="<?php echo site_url('home/homeproduct'); ?>" class="m-l-2">Produk</a>
            <a href="<?php echo site_url('article'); ?>" class="m-l-2">Artikel</a>
            <a href="<?php echo site_url('promo'); ?>" class="m-l-2">Promo</a>
            <!--<a href="" class="m-l-2">Request</a>-->
            <a href="<?php echo site_url('bulk'); ?>" class="m-l-2">RFQ</a>
            <a href="<?php echo site_url('partnership'); ?>" class="m-l-2">Menjadi Mitra</a>
            <!--<div class="menu-bahasa pull-right" style="max-width:150px;margin-top:-7px;">
                <nav class="navbar" style="padding:0px; background-color:black;">
                    <ul class="navbar-nav menu-bahasa-main">
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;white-space:nowrap;overflow:hidden;font-size:16px;vertical-align:top;max-width:150px;text-overflow: ellipsis;padding:10px;text-decoration:none;"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/id.png"> Indonesia </a>
                            <ul class="dropdown-menu dropdown-bahasa" aria-labelledby="navbarDropdown2" style="overflow-y:scroll;max-height:500px;min-width:115px !important;border:1px solid #ccc;">
                                <li style="background:#fff;color:black;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://www.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/id.png"> Indonesia</a></li>
                                <li style="background:#fff;color:black;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://en.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/en.png"> English</a></li>
                                <li style="background:#fff;"><a style="padding:5px !important" alt="Jual Komponen " href="<?php echo 'http://cn.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/cn.png"> Chinese</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>-->
        </div>
    </div>
</nav>

<!-- <style>
    nav .inputsearch span,
    nav .inputsearch input {
        border: 1px solid #ddd;
    }
</style>
<nav class="navbar navbar-fixed-top" role="navigation" style="background:#fff;color:#333 !important;padding:0px;border-bottom:1px solid #eee;font-family:'Rubik', sans-serif;">
    <div class="container-fluid" style="background-color:#ffa500;">
        <div class="row" style="padding:6px 15px;">
            <div class="col-xs-12">
                <a href="tel:+6282122668008"><small style="color:#fff;" class="pull-right"><span class="fa fa-phone"></span> +62 821 2266 8008</small></a>
                <a href="tel:<?php echo platform_contact("phone"); ?>"><small style="color:#fff;font-weight:bold" class="pull-left"><span class="fa fa-phone"></span> <?php echo platform_contact("phone"); ?></small></a>
                <a href="mailto:<?php echo platform_contact("email"); ?>"><small class="pull-left" style="color:#fff;margin-left:10px;font-weight:bold"><span class="fa fa-envelope"></span> <?php echo platform_contact("email"); ?></small></a>
                <a href="<?php echo base_url('page/pembayaran'); ?>"><small class="pull-right" style="color:#fff;font-weight:bold"><?php echo $this->lang->line('cara_pembayaran', FALSE); ?></small></a>
                <a href="<?php echo base_url('page') ?>"><small class="pull-right" style="color:#fff;margin-right:30px;font-weight:bold"><?php echo $this->lang->line('tentang_kami', FALSE); ?></small></a>
                <a href="<?php echo site_url('agent'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;">Jadi agen kami</small></a>
                <a href="<?php echo site_url('promo'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('promo', FALSE); ?></small></a>
                <a href="<?php echo site_url('article'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('artikel', FALSE); ?></small></a>
                <a href="<?php echo site_url('principal'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;">Principal</small></a>
                <a href="<?php echo site_url('partnership'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('partnership', FALSE); ?></small></a>
                <a href="<?php echo site_url('lelang'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('info_lelang', FALSE); ?></small></a>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="padding:10px 30px">
        <div class="col-md-1 p-y-1">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>public/image/logonew.png" style="max-width:100%;margin-top:5px">
            </a>
        </div>
        <div class="col-md-11" style="display:inline-flex">
            <?php $this->load->view("front/_categorydropdown") ?>
            <div style="display:flex;width:100%;margin-right:10px;" class="m-y-1">
                <div class="input-group input-group-sm inputsearch pull-left" style="width:100%;">
                    <input type="text" class="form-control" style="  border-bottom-left-radius:20px; border-top-left-radius:20px;" placeholder="<?php echo $this->lang->line('placeholder_pencarian', FALSE); ?>" value="<?php echo $this->input->get("nama"); ?>">
                    <span class="input-group-addon btn search-button" id="searchbuttontemplate" style="background:#fff; border-bottom-right-radius:20px; border-top-right-radius:20px; color:#fff; background-color:orange;">
                        <span class="fa fa-search" style="border:none"></span>
                    </span>
                    <input type="hidden" name="quality" value="<?php echo $this->uri->segment(2) == 'used' ? "3" : $this->input->get("quality"); ?>">
                </div>
            </div>
            <div style="display:flex" class="m-y-1">
                <div id="menu_area" class="menu-area pull-left" style="max-width:150px;margin-right:15px;">
                    <nav class="navbar navbar-light navbar-expand-lg mainmenu" style="padding:0px;">
                        <ul class="navbar-nav mr-auto">
                            <li class="dropdown text-center">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#999;white-space:nowrap;overflow:hidden;font-size:16px;vertical-align:top;max-width:150px;text-overflow: ellipsis"><span class="fa fa-language" style="vertical-align:middle;margin-right:10px"></span> <?php echo $this->lang->line('nama_bahasa', FALSE); ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2" style="overflow-y:scroll;max-height:500px;min-width:200px !important">
                                    <li style="background:#fff;"><a style="padding:15px !important" alt="Jual Komponen " href="<?php echo 'http://www.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'id' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> Bahasa Indonesia</a></li>
                                    <li style="background:#fff;"><a style="padding:15px !important" alt="Jual Komponen " href="<?php echo 'http://en.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'en' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> English</a></li>
                                    <li style="background:#fff;"><a style="padding:15px !important" alt="Jual Komponen " href="<?php echo 'http://cn.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'cn' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> Chinese</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <a href="<?php echo site_url('product/contact/'); ?>" class="pull-right btn-black btn btn-sm"  style="margin-right:10px"><strong>Konsultasi Gratis</strong></a>
                <a class="pull-right" href="<?php echo base_url() ?>cart" style="margin-right:20px">
                    <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:20px;font-size:10px;margin-top:3px"><?php echo count($this->cart->contents()) ?></small>
                    <span><img class="icon" src="<?php echo base_url() ?>public/image/icon/icon-chart.png"></span>
                </a>
                <div style="border-right:1px solid #ccc;height:30px;margin-right:10px" class="pull-right"></div>
                <?php

                $session = $this->session->all_userdata();
                $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);

                if ($sessionmember["id"] != null) :
                ?>
                    <a href="<?php echo site_url('member'); ?>" class="pull-right btnnew btn btn-sm"><strong>Dashboard</strong></a>
                <?php else : ?>
                    <a href="<?php echo site_url('member/signup'); ?>" class="pull-right btnnew btn btn-sm"><strong><?php echo $this->lang->line('daftar', FALSE); ?></strong></a>
                    <a href="<?php echo site_url('member/login'); ?>" class="pull-right btn-default btn btn-sm" style="margin-right:10px"><strong><?php echo $this->lang->line('masuk', FALSE); ?></strong></a>
                <?php endif; ?>

                <a href="<?php echo site_url('product/tender'); ?>" class="pull-right btn-black btn" ><strong>Undang kami ke tender</strong></a>
            </div>
        </div>
    </div>
</nav> -->

<!-- <nav class="navbar navbar-fixed-top" role="navigation" style="background: black;color:#333 !important;padding:0px;border-bottom:1px solid #eee;font-family:'Rubik', sans-serif;">
    <div class="container-fluid" style="background-color:black;">
        <div class="row" style="padding:6px 15px;">
            <div class="col-xs-12">
                <a href="tel:+6282122668008"><small style="color:#fff;" class="pull-right"><span class="fa fa-phone"></span> +62 821 2266 8008</small></a>
                <a href="tel:<?php echo platform_contact("phone"); ?>"><small style="color:#fff;font-weight:bold" class="pull-left"><span class="fa fa-phone"></span> <?php echo platform_contact("phone"); ?></small></a>
                <a href="mailto:<?php echo platform_contact("email"); ?>"><small class="pull-left" style="color:#fff;margin-left:10px;font-weight:bold"><span class="fa fa-envelope"></span> <?php echo platform_contact("email"); ?></small></a>
                <a href="<?php echo base_url('page/pembayaran'); ?>"><small class="pull-right" style="color:#fff;font-weight:bold"><?php echo $this->lang->line('cara_pembayaran', FALSE); ?></small></a>
                <a href="<?php echo base_url('page') ?>"><small class="pull-right" style="color:#fff;margin-right:30px;font-weight:bold"><?php echo $this->lang->line('tentang_kami', FALSE); ?></small></a>
                <a href="<?php echo site_url('agent'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;">Jadi agen kami</small></a>
                <a href="<?php echo site_url('promo'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('promo', FALSE); ?></small></a>
                <a href="<?php echo site_url('article'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('artikel', FALSE); ?></small></a>
                <a href="<?php echo site_url('principal'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;">Principal</small></a>
                <a href="<?php echo site_url('partnership'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('partnership', FALSE); ?></small></a>
                <a href="<?php echo site_url('lelang'); ?>"><small class="pull-right" style="margin-right:30px;color:#fff;font-weight:bold"><?php echo $this->lang->line('info_lelang', FALSE); ?></small></a>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="padding:0px 15px; height:70px;">
        <div class="col-md-1">
        </div>
        <div class="col-md-2">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>public/image/logofooternew.png" style="width:100%; heigth:100px; margin-top:8px">
            </a>
        </div>
        <div class="col-md-1" style="margin-top: 6px; margin-left:-10px; margin-right:10px;">
            <?php $this->load->view("front/_categorydropdown") ?>
        </div>
        <div class="col-md-4" style="display:inline-flex">
            <div style="display:flex;width:100%;margin-right:10px;" class="m-y-1">
                <div class="input-group input-group-sm inputsearch pull-left" style="width:100%; height:40px; color:#fff; ">
                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_pencarian', FALSE); ?>" value="<?php echo $this->input->get("nama"); ?>" style="border-top-left-radius:20px; border-bottom-left-radius:20px; height:40px; background-color:#fff;">
                    <span class="input-group-addon btn search-button" id="searchbuttontemplate" style="background: orange; border-top-right-radius:20px; border-bottom-right-radius:20px;">
                        <i class="fa fa-search" style="border:none; color: #fff;"></i>
                    </span>
                    <input type="hidden" name="quality" value="<?php echo $this->uri->segment(2) == 'used' ? "3" : $this->input->get("quality"); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div style="display:flex" class="m-y-1">
                <div id="menu_area" class="menu-area pull-left" style="max-width:150px;margin-right:15px;">
                    <nav class="navbar navbar-light navbar-expand-lg mainmenu" style="padding:0px;">
                        <ul class="navbar-nav mr-auto">
                            <li class="dropdown text-center">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#999;white-space:nowrap;overflow:hidden;font-size:16px;vertical-align:top;max-width:150px;text-overflow: ellipsis"><span class="fa fa-language" style="vertical-align:middle;margin-right:10px"></span> <?php echo $this->lang->line('nama_bahasa', FALSE); ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2" style="overflow-y:scroll;max-height:500px;min-width:200px !important">
                                    <li style="background:#fff;"><a style="padding:15px !important" alt="Jual Komponen " href="<?php echo 'http://www.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'id' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> Bahasa Indonesia</a></li>
                                    <li style="background:#fff;"><a style="padding:15px !important" alt="Jual Komponen " href="<?php echo 'http://en.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'en' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> English</a></li>
                                    <li style="background:#fff;"><a style="padding:15px !important" alt="Jual Komponen " href="<?php echo 'http://cn.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'cn' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> Chinese</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <a href="<?php echo site_url('product/contact/'); ?>" class="pull-right btn-black btn btn-sm"  style="margin-right:10px"><strong>Konsultasi Gratis</strong></a>

                <div style="border-right:1px solid #ccc;height:30px;margin-right:10px" class="pull-right"></div>
                <?php

                $session = $this->session->all_userdata();
                $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);

                if ($sessionmember["id"] != null) :
                ?>
                    <a class="f30" href="<?php echo base_url() ?>cart" style="margin-right:50px">
                        <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:20px;font-size:10px;margin-top:10px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-shopping-cart" style="color: grey;"></i>
                    </a>
                    <a href="<?php echo site_url('message'); ?>" class="f30" style="margin-right:50px">
                        <small class="label label-danger f12" style="position:absolute;top:0;font-weight:normal;height:17px;width:17px;border-radius:50%;display:inline-block;text-align:center;margin-left:20px;font-size:10px;margin-top:10px"><?php echo count($this->cart->contents()) ?></small>
                        <i class="fa fa-commenting" style="color: grey;"></i>
                    </a>
                    <a href="<?php echo site_url('member'); ?>" class="f30"><i class="fa fa-user" style="color: grey;"></i></a>
                <?php else : ?>
                    <a href="<?php echo site_url('member/login'); ?>" class="btnnew btn btn-block" style="margin-left:-17px; margin-right:13px;">Masuk / Daftar</a>
                <?php endif; ?>

                <a href="<?php echo site_url('product/tender'); ?>" class="btn-black btn" ><strong>Undang kami ke tender</strong></a>
            </div>
        </div>
        <div class="col-md-1" style="padding-top: 15px; color: grey; margin-left:-20px; margin-right:10px;">
            |
        </div>
        <div class="col-md-1" style="margin-left:-80px;">
            <a href="#" id="language-bar-invoker">
                <div class="row">
                    <i class="eu"></i>
                    <i class="id"></i>
                    <a href=" <?php echo site_url('help'); ?>" style="color: #fff; position:absolute; margin-top:15px;">Help</a>
                </div>
            </a>
        </div>

    </div>
</nav> -->