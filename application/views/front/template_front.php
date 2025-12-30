<?php
//if ($this->agent->is_mobile()): 
$host = "https://$_SERVER[HTTP_HOST]";
if ($host == "https://trumecs.com") {
    redirect("http://www.trumecs.com$_SERVER[REQUEST_URI]", 'location', 301);
}
//endif ;
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

$this->db->reset_query();

$contact = $this->db->where('id', $ida)->get("admin")->result_array();
?>
<!DOCTYPE html>
<html lang="<?php
            $lang = get_language();
            echo isset($lang['code']) ? htmlspecialchars($lang['code']) : 'en';
            ?>">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1">
    <?php $this->load->view("front/_seo"); ?>
    <?php $this->load->view("front/_favicon"); ?>
    <!-- Bootstrap Core CSS -->
    <!--link  rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" -->


    <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/template.css">
    <?php
    if (isset($css)) {
        $minicss = $this->minifile->create($css, 'css');
        echo '<link rel="stylesheet" href="' . base_url("asset/core/css/" . $minicss) . '" />';
    }
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url("asset/fonts/Lato-Regular.ttf") ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.offcanvas.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-awesome-animation.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/js/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/js/slick/slick-theme.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.1.5/datatables.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <?php if ($this->uri->segment(1) == "article" || $this->uri->segment(1) == null) : ?>
        <!-- <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<<<<<<< HEAD
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
=======
>>>>>>> parent of 78736cb (fix: boostrap)
    <?php else : ?>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap.4-alpha.css">
    <?php endif ?>
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
    <?php if ($this->uri->segment(1) == 'cart' || $this->uri->segment(2) == 'signup' || $this->uri->segment(2) == 'buy' || $this->uri->segment(2) == 'contact' || $this->uri->segment(2) == 'tender' || $this->uri->segment(1) == 'agent' || $this->uri->segment(1) == 'principal' || $this->uri->segment(1) == 'bulk' || $this->uri->segment(2) == 'login' || empty($this->uri->segments)) : ?>
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
    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVC4G9C" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->
    <!-- Navigation -->
    <?php

    if (isset($navbar)) {
        $this->load->view($navbar);
    } else {
        if (!$this->agent->is_mobile()) {
            $this->load->view("front/template/desktop/navbar.php");
        } else {
            $this->load->view("front/template/mobile/navbar.php");
        }
    }


    ?>
    <!-- END Navigation -->
    <?php if ($this->agent->is_mobile()) : ?>
        <div class="container p-y-0 p-x-0" style="margin-top: 30px;">
            <?php if (isset($content)) {
                $this->load->view($content);
            } ?>
        </div>
    <?php else : ?>
        <?php if (isset($content)) {
            $this->load->view($content);
        } ?>
    <?php endif ?>


    <?php if (!$this->agent->is_mobile()) {
        $this->load->view("front/_footerdesktop");
    } else {
        $this->load->view("front/_footermobile");
    } ?>
    <div class="modal fade modalproccessshow" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="row">
                    <div class=" p-a-1 m-x-1 text-center">
                        <span class="modal-text">Sedang Proses</span><br><img width="70px" src="<?php echo base_url() ?>public/image/252.gif" alt="Loading Progress">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view("front/popup_ads"); ?>
    <?php if ($this->uri->segment(1) == "article" || $this->uri->segment(1) == null || $this->uri->segment(1) == "product") : ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<<<<<<< HEAD
        <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
=======
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> parent of 78736cb (fix: boostrap)
    <?php else : ?>
        <?php
        $javascript = array(base_url() . "asset/js/jquery.js", base_url() . 'asset/js/bootstrap.min.js', base_url() . 'asset/js/bootstrap-toolkit.min.js', base_url() . 'asset/js/slick/slick.min.js', base_url() . 'asset/js/bootstrap.offcanvas.min.js');
        foreach ($javascript as $dt_javascript) {
            echo '<script type="text/javascript" src="' . $dt_javascript . '"></script>';
        }
        ?>
    <?php endif; ?>
    <!-- <script src="https://kit.fontawesome.com/d64235c5d9.js" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/js/trumecs.effect.js"></script>
    <script type="text/javascript" src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js">
    </script>
    <!-- <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script src="/asset/backend/dist/js/tinymce/tinymce.min.js"></script>

    <script>
        var base_url = $("body").attr("baseurl");
    </script>
    <?php

    if (isset($js)) {
        $minijs = $this->minifile->create($js, 'js');
        echo "<script src=\"" . base_url("asset/core/js/" . $minijs) . "\"></script>";
    }
    ?>

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