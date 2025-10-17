<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/template.css" />
    <?php if (isset($css)) {
        foreach ($css as $dt_css) {
            echo '<link rel="stylesheet" href="' . $dt_css . '" />';
        }
    } ?>

</head>

<body>
    <header id="trumecs" data-base-url="<?php echo base_url() ?>">
        <div class="container-fluid main-head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 left">AllMecs</div>
                    <div class="col-lg-6 middle">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="Text input with segmented button dropdown">
                            <div class="input-group-btn">
                                <button type="button" class="btn select-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Semua <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                                <button type="button" class="btn btn-secondary btn-search">Action</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 right">
                        <button class="btn btn-danger">Pasang Iklan</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="container main-content m-t-1">
            <?php $this->load->view($content); ?>

        </div>
    </section>
    <footer>
        <div class="container-fluid footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 footer-image">
                        <img src="<?php echo base_url() ?>images/web-assets/footer.png" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-8 m-t-1">
                        <h2>Tentang Allmecs</h2>
                        <p>allmecs.com adalah situs jual beli sparepart dari berbagai jenis kendaraan, alat berat, kapal, pesawat dan lain-lain</p>
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a><img src="<?php echo base_url() ?>public/image/web-assets/facebook.png" alt="facebook" /></a></li>
                            <li class="nav-item"><a><img src="<?php echo base_url() ?>public/image/web-assets/googleplus.png" alt="twiiter" /></a></li>
                            <li class="nav-item"><a><img src="<?php echo base_url() ?>public/image/web-assets/twitter.png" alt="google" /></a></li>
                            <li class="nav-item"><a><img src="<?php echo base_url() ?>public/image/web-assets/instagram.png" alt="instagram" /></a></li>
                        </ul>
                        <div class="clearfix"></div>
                        <p class="m-t-1"><a>allmecs.com @2016 | All Reserved</a></p>
                    </div>
                    <div class="col-lg-4 m-t-1">
                        <ul class="footer-link">
                            <li class=""><a>Pusat Bantuna</a></li>
                            <li class=""><a>Ketentuan Layanan</a></li>
                            <li class=""><a>Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script-->
    <script type="text/javascript" src="http://v4-alpha.getbootstrap.com/assets/js/vendor/tether.min.js"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>

    <?php if (isset($js)) {
        foreach ($js as $dt_js) {
            echo '<script src="' . $dt_js . '" ></script>';
        }
    } ?>
</body>

</html>