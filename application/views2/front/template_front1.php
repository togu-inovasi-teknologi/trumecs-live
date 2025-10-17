<?php
/* if ($this->agent->is_mobile()): 
    $host = "https://$_SERVER[HTTP_HOST]";
    if ($host=="https://www.trumecs.com") {
        redirect("http://mobile.trumecs.com$_SERVER[REQUEST_URI]");
    } 
endif ; */
$obj_language = get_language();

if (get_cookie('language', TRUE)) {
    $language = get_cookie('language', TRUE);

    if ($language != $obj_language['code']) {
        set_cookie(
            array(
                "name" => "language",
                "value" => $obj_language['code'],
                "expire" => '7200'
            )
        );
    }
} else {

    set_cookie(
        array(
            "name" => "language",
            "value" => $obj_language['code'],
            "expire" => '7200'
        )
    );
}

$this->config->set_item('language', $obj_language['language']);

if (get_cookie('ida', TRUE)) {
    $ida = get_cookie('ida', TRUE);
    if (array_key_exists("ida", $_GET) && $ida != $_GET["ida"]) {
        set_cookie(
            array(
                "name" => "ida",
                "value" => $_GET["ida"],
                "expire" => '7200'
            )
        );
        $ida = $_GET["ida"];
    }
} else {
    if (!array_key_exists("ida", $_GET)) {
        $ida = "default";
    } else {
        set_cookie(
            array(
                "name" => "ida",
                "value" => $_GET["ida"],
                "expire" => '7200'
            )
        );
        $ida = $_GET["ida"];
    }
}

$contact = $this->db->where('id', $ida)->get("admin")->result_array();
//var_dump($contact);
?>
<!DOCTYPE html>
<html lang="<?php $lang = get_language();
            echo $lang['code'] ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1">
    <?php $this->load->view("front/_seo"); ?>
    <?php $this->load->view("front/_favicon"); ?>
    <!-- Bootstrap Core CSS -->
    <!--link  rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" -->
    <?php if (1 == 2) : ?>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <?php else : ?>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap.4-alpha.css">
    <?php endif ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/template.css">
    <?php
    if (isset($css)) {
        $minicss = $this->minifile->create($css, 'css');
        echo '<link rel="stylesheet" href="' . base_url("asset/core/css/" . $minicss) . '" />';
    }
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.offcanvas.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-awesome-animation.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/js/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/js/slick/slick-theme.css">
    <?php
    if (isset($css_cdn)) {
        foreach ($css_cdn as $item) {
            echo $item;
        }
    }
    ?>
    <meta http-equiv="expires" content="Mon, 4 Jul 2016 05:00:00 GMT" />
    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,100&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <style>
        .btn-cyan {
            background: #70c4c5 !important;
            color: #fff !important;
            background-image: none !important;
        }

        .border-cyan {
            background: #fff !important;
            border: 1px solid #70c4c5 !important;
        }

        .progress {
            display: flex;
            height: 1rem;
            overflow: hidden;
            font-size: .75rem;
            background-color: #e9ecef;
            border-radius: .25rem;
        }

        .progress-bar-animated {
            -webkit-animation: 1s linear infinite progress-bar-stripes;
            animation: 1s linear infinite progress-bar-stripes;
        }

        .progress-bar-striped {
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem;
        }

        .progress-bar {
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            background-color: #0d6efd;
            transition: width .6s ease;
        }
    </style>
    <?php if ($this->uri->segment(1) == 'cart' || $this->uri->segment(2) == 'signup' || $this->uri->segment(2) == 'buy' || $this->uri->segment(2) == 'contact' || $this->uri->segment(2) == 'tender' || $this->uri->segment(1) == 'agent' || $this->uri->segment(1) == 'principal' || $this->uri->segment(1) == 'bulk') : ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php endif; ?>
    <style>
        .fab-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: right;
            text-align: right;
            user-select: none;
            position: fixed;
            bottom: 30%;
            right: 0px;
            z-index: 9999;
            border-radius: 50% 0 0 50%;
            box-shadow: 10px 20px 30px rgba(0, 0, 0, .5);
        }

        .fab-container .fab {
            position: relative;
            height: 100px;
            width: 100px;
            background: linear-gradient(179deg, rgba(149, 189, 237, 1), rgba(22, 117, 169, 1) 48%, rgba(40, 97, 175, 1));
            border-radius: 50%;
            /* border-top:5px dotted #fff;
            border-bottom:5px dotted #fff;
            border-left:5px dotted #fff; */
            z-index: 2;
        }

        .fab-container .fab::after {
            content: " ";
            /* top:-5px; */
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100px;
            width: 50px;
            background: inherit;
            border-radius: 0 0 0 0;
            /* border-top:5px dotted #fff;
            border-bottom:5px dotted #fff; */
            z-index: -1;
        }

        .fab-container .fab .fab-content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            border-radius: 50%;
        }

        .fab-container .fab .fab-content {
            color: #fff;
            font-size: 16px;
            margin-top: -4px;
            font-weight: bold;
            padding-right: 10px;
            line-height: 1.2;
            text-shadow: 0px 0px 1px rgba(0, 0, 0, 1);
        }

        .fab-container .sub-button {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            bottom: 10px;
            right: 10px;
            height: 50px;
            width: 50px;
            background-color: #4ba2ff;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .fab-container .sub-button:hover {
            cursor: pointer;
        }

        .fab-container .sub-button .material-icons {
            color: white;
            padding-top: 6px;
        }
    </style>
</head>

<body onunload="testUnload()" url="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" baseurl="<?php echo base_url() ?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVC4G9C" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Navigation -->
    <?php if (!$this->agent->is_mobile()) {
        $this->load->view("front/_navdesktop");
    } else {
        $this->load->view("front/_navmobile");
    } ?>
    <!-- <div class="fab-container">
        <a href="<?php echo site_url('bulk'); ?>" class="fab shadow">
            <div class="fab-content">
                <span class="">Punya Daftar Belanja?</span>
            </div>
        </a>
        <div class="sub-button shadow">
            <a href="google.com" target="_blank">
            <span class="material-icons">phone</span>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="google.com" target="_blank">
            <span class="material-icons">mail_outline</span>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="google.com" target="_blank">
            <span class="material-icons">language</span>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="google.com" target="_blank">
            <span class="material-icons">help_outline</span>
            </a>
        </div>
    </div> -->
    <!-- END Navigation -->
    <?php if ($this->agent->is_mobile()) : ?>
        <section style="margin-top:0px;">
            <?php if ($this->uri->segment(1) == '') { ?>
                <div class=" p-y-1" style="background:none;">
                <?php } else if ($this->uri->segment(2) == 'homeproduct') { ?>
                    <div class=" p-y-1" style="background:none;">
                    <?php } else { ?>
                        <div class="container p-y-1" style="background:none;">
                        <?php } ?>
                        <div class="col-xs-12 m-b-2 m-t-0 ">
                            <div class="clearfix"></div>
                        </div>
                        <div class="space">
                            <div class="clearfix"></div>
                        </div>
                        <?php if (isset($content)) {
                            $this->load->view($content);
                        } ?>
                        </div>
        </section>
    <?php else : ?>
        <section style="margin-top:0px;">
            <?php if ($this->uri->segment(1) == '') { ?>
                <div class=" p-y-1" style="background:none;">
                <?php } else if ($this->uri->segment(2) == 'homeproduct') { ?>
                    <div class=" p-y-1" style="background:none;">
                    <?php } else { ?>
                        <div class="container-fluid p-y-1 m-t-1" style="background:none;">
                        <?php } ?>
                        <div class="col-lg-12 m-b-3 m-t-3 ">
                            <div class="clearfix"></div>
                        </div>
                        <div class="space">
                            <div class="clearfix"></div>
                        </div>
                        <?php if (isset($content)) {
                            $this->load->view($content);
                        } ?>
                        </div>
        </section>
    <?php endif ?>


    <footer>
        <?php if (!$this->agent->is_mobile()) {
            $this->load->view("front/_footerdesktop_new");
        } else {
            $this->load->view("front/_footermobile_new");
        } ?>

    </footer>
    <div class="modal fade modalproccessshow" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="row">
                    <div class=" p-a-1 m-x-1 text-center">
                        <span class="modal-text">Sedang Proses</span><br><img width="70px" src="<?php echo base_url() ?>public/image/252.gif">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php $this->load->view("front/popup_ads"); ?>
    <?php
    $javascript = array(base_url() . "asset/js/jquery.js", base_url() . 'asset/js/bootstrap.min.js', base_url() . 'asset/js/bootstrap-toolkit.min.js', base_url() . 'asset/js/slick/slick.min.js', base_url() . 'asset/js/bootstrap.offcanvas.min.js');
    foreach ($javascript as $dt_javascript) {
        echo '<script type="text/javascript" src="' . $dt_javascript . '"></script>';
    }
    ?>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/js/trumecs.effect.js"></script>
    <script type="text/javascript" src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <?php

    if (isset($js)) {
        $minijs = $this->minifile->create($js, 'js');
        echo "<script src=\"" . base_url("asset/core/js/" . $minijs) . "\"></script>";
    }
    ?>

    <!-- <div class="container">
        <?php if (!$this->agent->is_mobile()) : ?>
            <div class="row p-x-1 orange p-y-1">
                <div class="col-lg-9 text-justify">
                    <span class="">Trumecs menyediakan semua Jenis Sparepart truk dari berbagai Merek dan Tipe Truk yang digunakan di seluruh Indonesia.</span>
                </div>
                <div class="col-lg-3">
                    <a title="Tentang Trumecs"alt="Trumecs" href="<?php echo base_url(); ?>page" class="btn btn-foot btn-white col-lg-12 col-md-12 col-sm-12 col-xs-12 fbold"><strong class="museosans-700">Tentang Trumecs</strong></a>
                </div>
            </div>
            <div class="row p-y-2 m-y-1">
                <div class="col-lg-2 col-sm-6 col-xs-6">
                        <strong class="menu">Trumecs</strong>
                        <ul>
                            <?php
                            $unsrlmenu1 = unserialize(MENU1);
                            $unsrlmenu2 = unserialize(MENU2);
                            $unsrlmenu3 = unserialize(MENU3);

                            ?>
                            <?php foreach ($unsrlmenu1 as $menu1) : ?>
                                <?php $value = (json_decode($menu1["value"], true)) ?>
                                <li><a alt="<?php echo $value["name"] ?>" href="<?php echo base_url(); ?><?php echo preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-\/]/', '', str_replace(' ', '-', $value["link"]))) ?>"><?php echo $value["name"] ?></a></li>
                            <?php endforeach ?>
                                <li><a alt="Artikel" href="<?php echo base_url(); ?>article">Baca Article</a></li>
                        </ul>
                    </div>
                <div class="col-lg-2 col-sm-6 col-xs-6 ">
                    <strong class="menu">Pengguna/Pembeli</strong>
                    <ul>
                        <?php foreach ($unsrlmenu2 as $menu2) : ?>
                            <?php $value = (json_decode($menu2["value"], true)) ?>
                            <li><a alt="<?php echo $value["name"] ?>" href="<?php echo base_url(); ?><?php echo preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-\/]/', '', str_replace(' ', '-', $value["link"]))) ?>"><?php echo $value["name"] ?></a></li>
                        <?php endforeach ?>
                            <li><a alt="Keranjang Balanja di Trumecs" href="<?php echo base_url(); ?>member/testimonial">Lihat Testimonial</a></li>
                            <li><a alt="Keranjang Balanja di Trumecs" href="<?php echo base_url(); ?>cart">Keranjang Belanja</a></li>
                    </ul>
                </div>
                <?php if (!$this->agent->is_mobile()) : ?>
                    <div class="col-lg-4">
                    <strong class="menu">Sparepart</strong>
                    <ul>
                        <?php foreach ($unsrlmenu3 as $menu3) : ?>
                            <?php $value = (json_decode($menu3["value"], true)) ?>
                            <li><a alt="<?php echo $value["name"] ?>" href="<?php echo base_url(); ?><?php echo preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-\/\?\=]/', '', str_replace(' ', '-', $value["link"]))) ?>"><?php echo $value["name"] ?></a></li>
                        <?php endforeach ?>
                            <li><a alt="Promo Trumecs" href="<?php echo base_url(); ?>promo">Promo</a></li>
                    </ul>
                </div>
                <?php endif ?>

                <div class="col-lg-4 col-lg-offset-4">
                    <div class="row bg col-xs-12" style="
                    background:url(<?php echo base_url(); ?>public/image/icon/love-sparepart.png);
                    width: 100%;
                    height: 0;
                    padding-bottom: 80%;
                    background-repeat: no-repeat;
                    background-position: center center;
                    background-size: 77%;
                    margin-top:-20px;
                                    "></div>
                </div>
                <div class="clearfix hidden-lg hidden-md"></div>
            </div>
            <div class="infodev text-center" style="margin-bottom:30px;">
                Trumecs.com © 2022 | Trisindo Raya Utama

            </div>
        <?php else : ?>
            <div class="infodev text-center">
                <br />
                <br />
                <br />
                <small class="vsmall">Trumecs.com © 2022 <br/> Trisindo Raya Utama<br/><br/></small>
            </div>
        <?php endif ?>
    </div> -->
    <style type="text/css">
        #pushstat {
            width: 0;
            height: 0;
            overflow: hidden;
            display: none !important;
        }
    </style>
    <?php
    if (isset($js_cdn)) {
        foreach ($js_cdn as $item) {
            echo $item;
        }
    }
    ?>
    <script type="text/javascript">
        window.addEventListener("pagehide", (e) => {
            return false;
        });

        function testUnload() {
            return "asdasda";
        }
        (function($) {
            $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                var $subMenu = $(this).next(".dropdown-menu");
                $subMenu.toggleClass('show');

                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                });

                return false;
            });
            $('.btn-pop-up').click();
        })(jQuery)
    </script>
</body>

</html>