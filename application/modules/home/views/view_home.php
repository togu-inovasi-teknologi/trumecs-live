<?php
$img_promo = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo_specialoffer.png" width="70">';
?>
<div id="page_home">
    <div class="row" style="">
        <div class="col-md-12 p-a-0">
            <div class="col-md-3 p-a-0" style="background:#fff;border-radius:10px;border:1px solid #ddd;overflow:hidden">
                <h5 class="m-a-1 fbold f16">Temukan Kebutuhanmu</h5>
                <ul class="list-group f14">
                    <li style="border:none;padding:5px 15px;" class="list-group-item list-group-item-sm">
                        <a href="<?php echo site_url('c/Pelumas'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/61161488ed99f.jpg" width="24px" /> Pelumas Industri
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                        </a>
                    </li>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Aki'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/611614a14a2ed.jpg" width="24px" /> Aki/Baterai
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                        </a>
                    </li>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Ban'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/611614ab72be3.jpg" width="24px" /> Ban
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                    </li>
                    </a>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Sparepart'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/611614bab4e24.jpg" width="24px" /> Sparepart
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                    </li>
                    </a>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Tools/Equipment-Tools'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/6116145d5f1fa.jpg" width="24px" /> Peralatan Kerja
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                    </li>
                    </a>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Unit/Alat-Berat'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/6221c6dfc9a40.jpg" width="24px" /> Unit Alat Berat
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                    </li>
                    </a>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Unit/Bus-Truk'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/61161478c2701.jpg" width="24px" /> Unit Bus & Truk
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                    </li>
                    </a>
                    <li style="border:none;padding:5px 15px;" class="list-group-item">
                        <a href="<?php echo site_url('c/Tools/Safety-Tools'); ?>" class="list-kategori-kiri">
                            <img src="https://www.trumecs.com/public/image/page/home/611614348ca14.jpg" width="24px" /> Safety Tools
                            <i class="fa fa-chevron-right pull-right" style="font-size:10px;vertical-align:middle;margin-top:5px"></i>
                    </li>
                    </a>
                </ul>
            </div>
            <div class="col-md-6 p-l-1">
                <img alt="Sparepart Trumecs" style="width:650px;height:315px;border-radius:20px" class="img-fluid" src="<?php echo base_url() ?>public/banner/banner-main.jpeg">
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <img alt="Sparepart Trumecs" style="width:600px;height:149px; border-radius:20px" class=" img-fluid" src="<?php echo base_url() ?>public/banner/banner-atas.jpeg">
                    </div>
                    <div class="col-md-12 m-t-1">
                        <img alt="Sparepart Trumecs" style="width:600px;height:149px; border-radius:20px" class=" img-fluid" src="<?php echo base_url() ?>public/banner/banner-bawah.jpeg">
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-9 p-a-0">
                <div class="fadeslidebig m-a-0 p-a-0" style="display:none">
                    <?php foreach (array_reverse($slide) as $headslideimg) : ?>
                        <div class="item-slide">
                            <?php echo ($headslideimg["link"]) != "" ? '<a href="' . $headslideimg["link"] . '">' : ''; ?>
                            <img alt="Sparepart Trumecs" width="100%" class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $headslideimg["img"] ?>" data-src="holder.js/620x300?bg=#CECECE&fg=FFFFFF&text=Slider">
                            <?php echo ($headslideimg["link"]) != "" ? '</a>' : ''; ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div> -->
            <?php $i = 1;
            $batas = 4 ?>
            <!-- <div class="col-md-12 p-a-0 m-y-1">
            <?php foreach ($headbottomslide as $key) : ?>
                <div class="col-md-4 m-a-0 p-a-0">
                    <?php echo !empty($i <= $batas) ? '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid" width="100%"></a>' : '' ?>
                    <?php $i++; ?>
                </div>
            <?php endforeach ?>
            </div> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 p-a-0 m-t-2">
            <a href="" class="btn btnnew" style="float:right;">Lihat Semua</a>
            <h3 class="m-b-2 fbold  ">Apa yang baru?</h3>
            <div class="listproduct p-y-0 slick-line1">
                <?php
                $i = 1;
                foreach ($listproduct as $key) :
                    $this->load->view('product/_item_product_home.php', array('key' => $key));
                endforeach; ?>
            </div>
            <div class="listproduct p-y-0 slick-line1">
                <?php
                $i = 1;
                foreach ($listproduct as $key) :
                    $this->load->view('product/_item_product_home.php', array('key' => $key));
                endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card borderdesk col-md-12 p-a-0" style="height: 100px;">
            <p class="text-center">iklan</p>
        </div>
    </div>
    <hr class="row">
    <div class="row">
        <div class="col-md-6 p-a-0">
            <h3 class="fbold m-b-2" style="color:#ff9900">Pelumas</h3>
            <div class="m-b-1">
                <a class="tag-pelumas">Automotive Oils</a>
                <a class="tag-pelumas">Engine Oils</a>
                <a class="tag-pelumas">Compressor Oils</a>
                <a class="tag-pelumas">Cutting Oils</a>
            </div>
            <div class="m-b-0">
                <div class="row text-center" style="margin-top:70px">
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href="">
                                <img class="icon-tag" alt="Castrol" src="<?php echo base_url("public/icon/castrol.png"); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Petronas" src="<?php echo base_url("public/icon/petronas.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Pertamina" src="<?php echo base_url("public/icon/pertamina.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Shell" src="<?php echo base_url("public/icon/shell.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <img alt="banner-pelumas" src="<?php echo base_url("public/banner/banner-pelumas.png"); ?>">
        </div>
        <div class=" col-md-6 p-a-0">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Castrol" src="<?php echo base_url("public/icon/pelumas-castrol.png"); ?>"></a>
                        <h5 class="fbold">Castrol</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:#ff9900">Rp.1.343.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Pertamina" src="<?php echo base_url("public/icon/pelumas-pertamina.png"); ?>"></a>
                        <h5 class="fbold">Pertamina</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:#ff9900">Rp.1.224.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Addinol" src="<?php echo base_url("public/icon/pelumas-addinol.png"); ?>"></a>
                        <h5 class="fbold">Addinol</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:#ff9900">Rp.943.434</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Petronas" src="<?php echo base_url("public/icon/pelumas-petronas.png"); ?>"></a>
                        <h5 class="fbold">Petronas</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:#ff9900">Rp.1.043.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Shell" src="<?php echo base_url("public/icon/pelumas-shell.png"); ?>"></a>
                        <h5 class="fbold">Shell</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:#ff9900">Rp.1.543.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Repsol" src="<?php echo base_url("public/icon/pelumas-repsol.png"); ?>"></a>
                        <h5 class="fbold">Repsol</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:#ff9900">Rp.1.478.434</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-6 p-a-0">
            <h3 class="fbold m-b-2" style="color: red;">Ban</h3>
            <div class="m-b-2">
                <a class="tag-ban">Offroad</a>
                <a class="tag-ban">Motor</a>
                <a class="tag-ban">Mobil</a>
                <a class="tag-ban">Bus Radial</a>
                <a class="tag-ban">Truck</a>
            </div>
            <div class="m-b-1">
                <div class="row text-center" style="margin-top:50px;">
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Goodyear" src="<?php echo base_url("public/icon/goodyear.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Bridgestone" src="<?php echo base_url("public/icon/bridgestone.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Hankook" src="<?php echo base_url("public/icon/hankook.png"); ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
            <img alt="banner-ban" src="<?php echo base_url("public/banner/banner-ban.png"); ?>">
        </div>
        <div class="col-md-6 p-a-0">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Maxima" src="<?php echo base_url("public/icon/ban-maxima.png"); ?>"></a>
                        <h5 class="fbold">Maxima</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:red;">Rp.1.343.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Goodyear" src="<?php echo base_url("public/icon/ban-goodyear.png"); ?>"></a>
                        <h5 class="fbold">Goodyear</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:red;">Rp.1.224.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Kaizen" src="<?php echo base_url("public/icon/ban-kaizen.png"); ?>"></a>
                        <h5 class="fbold">Kaizen</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:red;">Rp.943.434</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Dunlop" src="<?php echo base_url("public/icon/ban-dunlop.png"); ?>"></a>
                        <h5 class="fbold">Dunlop</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:red;">Rp.1.043.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Hankook" src="<?php echo base_url("public/icon/ban-hankook.png"); ?>"></a>
                        <h5 class="fbold">Hankook</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:red;">Rp.1.543.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Bridgestone" src="<?php echo base_url("public/icon/ban-bridgestone.png"); ?>"></a>
                        <h5 class="fbold">Bridgestone</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:red;">Rp.1.478.434</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-6 p-a-0">
            <h3 class="fbold m-b-2" style="color: green;">Alat Berat</h3>
            <div class="m-b-2">
                <a class="tag-alat-berat">Excavator</a>
                <a class="tag-alat-berat">Dumptruck</a>
                <a class="tag-alat-berat">Bulldozer</a>
                <a class="tag-alat-berat">Crane</a>
                <a class="tag-alat-berat">Forklift</a>
            </div>
            <div class="m-b-2">
                <div class="row text-center" style="margin-top:50px">
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Hyundai" src="<?php echo base_url("public/icon/hyundai.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Komatsu" src="<?php echo base_url("public/icon/komatsu.png"); ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-icon-tag">
                            <a href=""><img class="icon-tag" alt="Hitachi" src="<?php echo base_url("public/icon/hitachi.png"); ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
            <img alt="banner-alatberat" src="<?php echo base_url("public/banner/banner-alatberat.png"); ?>">
        </div>
        <div class="col-md-6 p-a-0">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Excavator" src="<?php echo base_url("public/icon/alatberat-excavator.png"); ?>"></a>
                        <h5 class="fbold">Excavator</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:green;">Rp.1.343.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Bulldozer" src="<?php echo base_url("public/icon/alatberat-bulldozer.png"); ?>"></a>
                        <h5 class="fbold">Bulldozer</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:green;">Rp.1.224.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Crane" src="<?php echo base_url("public/icon/alatberat-crane.png"); ?>"></a>
                        <h5 class="fbold">Crane</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:green;">Rp.943.434</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Roller" src="<?php echo base_url("public/icon/alatberat-roller.png"); ?>"></a>
                        <h5 class="fbold">Roller</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:green;">Rp.1.043.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Grader" src="<?php echo base_url("public/icon/alatberat-grader.png"); ?>"></a>
                        <h5 class="fbold">Grader</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:green;">Rp.1.543.434</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card borderdesk card-kategori text-center">
                        <a href=""><img class="img-kategori" alt="Dumptruck" src="<?php echo base_url("public/icon/alatberat-dumptruck.png"); ?>"></a>
                        <h5 class="fbold">Dumptruck</h5>
                        <h6 class="f12">Mulai</h6>
                        <h5 class="fbold" style="color:green;">Rp.1.478.434</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12 p-a-0 m-t-2">
            <h5 class="m-b-1"><?php echo $this->lang->line('heading_kategori', FALSE); ?></h5>
            <div class="col-xs-4 p-l-0" style="">
                <div class="col-xs-12 p-a-1" style="background:#fff;;border-radius:15px;">
                    <h6 class="m-b-1"><strong><?php echo $this->lang->line('kategori_operasional_aki', FALSE); ?></strong></h6>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Aki/GS-ASTRA"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/gs-square.jpg"); ?>" class="img-fluid"></a>
                        <p class="text-center f14 ">GS Astra</p>
                    </div>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Aki/INCOE"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/incoe-square.png"); ?>" class="img-fluid"></a>
                        <p class="text-center f14 ">Incoe Battery</p>
                    </div>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Aki/FURUKAWA-BATTERY"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/furukawa-square.jpeg"); ?>" class="img-fluid"></a>
                        <p class="text-center f14 ">Furukawa</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 p-l-0">
                <div class="col-xs-12 p-a-1" style="background:#fff;;border-radius:15px;">
                    <h6 class="m-b-1"><strong><?php echo $this->lang->line('kategori_operasional_ban', FALSE); ?></strong></h6>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Ban/GITI"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/giti-square.png"); ?>" class="img-fluid"></a>
                        <p class="text-center f14 ">Giti Tyre</p>
                    </div>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Ban/KAIZEN"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/kaizen-square.jpg"); ?>" class="img-fluid m-t-2 m-b-1"></a>
                        <p class="text-center f14 ">Kaizen Tyre</p>
                    </div>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Ban/HIXIH"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/hixih-square.png"); ?>" class="img-fluid"></a>
                        <p class="text-center f14 ">Hixih Tyre</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 p-l-0">
                <div class="col-xs-12 p-a-1" style="background:#fff;;border-radius:15px;">
                    <h6 class="m-b-1"><strong><?php echo $this->lang->line('kategori_sparepart_alat', FALSE); ?></strong></h6>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Sparepart/MAN"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/man-square.png"); ?>" class="img-fluid m-t-1 m-b-1"></a>
                        <p class="text-center f14 ">MAN</p>
                    </div>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Sparepart/CAMC"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/camc-square.jpg"); ?>" class="img-fluid m-t-2 m-b-1"></a>
                        <p class="text-center f14 ">CAMC</p>
                    </div>
                    <div class="col-md-4 m-a-0 p-a-0"> <a class="brand-list" alt="Sparepart Trumecs" href="<?php echo base_url("c/Sparepart/DOOSAN"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/doosan-square.jpg"); ?>" class="img-fluid"></a>
                        <p class="text-center f14 ">Doosan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 p-a-0 m-t-2">
            <h4 class="m-b-1"><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></h4>
            <div class="col-xs-12 p-a-0" style="background:#fff">
                <div class="col-xs-3 p-a-1" style="background: rgb(255,129,3);background: linear-gradient(338deg, rgba(255,129,3,1) 0%, rgba(246,166,15,1) 48%, rgba(255,192,0,1) 100%);height:48vh">
                    <h4 class="m-x-2 m-y-2" style="color:#fff"><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></h4>
                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/drums.png"); ?>" class="img-fluid pull-right">
                    <a href="<?php echo site_url('c/Pelumas'); ?>" class="btn btn-warning m-x-2 f14" style="background:#fff;color:#000;border-radius:20px">
                        Selengkapnya &raquo;
                    </a>
                </div>
                <div class="col-xs-3 m-a-0">
                    <div class="row p-t-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><strong>Pelumas Pertamina</strong></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <ul class="list-group" style="list-style:none">
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/1729/Meditran-Sx-Ultra-15w-40-Plus'); ?>">Meditran SX Ultra 15W-40 Plus</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/2029/Pertamina-Atf-Dextron-Vi'); ?>">ATF Dextrone VI</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/2063/Grease-Pertamina-Epx-nl-2'); ?>">Grease Pertamina EPX-NL 2</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/PERTAMINA"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/pertamina-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 text-right p-x-0 m-t-1">
                            <a href="<?php echo site_url('c/Pelumas/PERTAMINA'); ?>" class="f12" style="width: 150px;text-align: center;height: 0; position: relative;border-right: 0px solid transparent;border-bottom: 30px solid #ff9900;border-left: 30px solid transparent;float:right">
                                <span class="fbold" style="position: absolute;left: 15%;color:#fff;top:5px">Selengkapnya &raquo;</span>
                            </a>
                        </div>
                    </div>
                    <div class="row p-t-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><strong>Pelumas Shell</strong></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <ul class="list-group" style="list-style:none">
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/2853/Omala-S2-Gx-320'); ?>">OMALA S2 GX 320</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3322/Shell-Helix-Hx5-Sae-15w-40--4l-'); ?>">SHELL HELIX HX5 SAE 15W-40 (4L)</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3825/Shell-Cool-Ll-Plus--4l-'); ?>">SHELL COOL LL PLUS (4L)</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/SHELL"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/shell-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 text-right p-x-0 m-t-1">
                            <a href="<?php echo site_url('c/Pelumas/SHELL'); ?>" class="f12" style="width: 150px;text-align: center;height: 0; position: relative;border-right: 0px solid transparent;border-bottom: 30px solid #ff9900;border-left: 30px solid transparent;float:right">
                                <span class="fbold" style="position: absolute;left: 15%;color:#fff;top:5px">Selengkapnya &raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 m-a-0">
                    <div class="row p-t-1" style="border:1px solid #eee;">
                        <div class="col-xs-12 m-b-1">
                            <h6 class="m-b-1"><strong>Pelumas Evalube</strong></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <ul class="list-group" style="list-style:none">
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3151/Evalube-Hydraulic-Oil-Iso-Vg-32'); ?>">HYDRAULIC OIL ISO VG 32</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3152/Evalube-Hydraulic-Oil-Iso-Vg-46'); ?>">HYDRAULIC OIL ISO VG 46</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3153/Evalube-Hydraulic-Oil-Iso-Vg-68'); ?>">HYDRAULIC OIL ISO VG 68</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/EVALUBE"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/evalube-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 text-right p-x-0 m-t-1">
                            <a href="<?php echo site_url('c/Pelumas/EVALUBE'); ?>" class="f12" style="width: 150px;text-align: center;height: 0; position: relative;border-right: 0px solid transparent;border-bottom: 30px solid #ff9900;border-left: 30px solid transparent;float:right">
                                <span class="fbold" style="position: absolute;left: 15%;color:#fff;top:5px">Selengkapnya &raquo;</span>
                            </a>
                        </div>
                    </div>
                    <div class="row p-t-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><strong>Pelumas Petronas</strong></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <ul class="list-group" style="list-style:none">
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3188/Petronas-Hydroser-46'); ?>">Petronas Hydroser 46</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/4243/Petronas-Urania-800-Cf-4-15w-40'); ?>">Urania 800 CF-4 15W-40</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/4240/Petronas-Urania-500-Api-Cf-Sae-40'); ?>">Urania 500 API CF SAE 40</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/PETRONAS"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/petronas-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 text-right p-x-0 m-t-1">
                            <a href="<?php echo site_url('c/Pelumas/PETRONAS'); ?>" class="f12" style="width: 150px;text-align: center;height: 0; position: relative;border-right: 0px solid transparent;border-bottom: 30px solid #ff9900;border-left: 30px solid transparent;float:right">
                                <span class="fbold" style="position: absolute;left: 15%;color:#fff;top:5px">Selengkapnya &raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 m-a-0">
                    <div class="row p-t-1" style="border:1px solid #eee;">
                        <div class="col-xs-12 m-b-1">
                            <h6 class="m-b-1"><strong>Pelumas Repsol</strong></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <ul class="list-group" style="list-style:none">
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3731/Repsol-Transmission-Epm-90-Gl-4'); ?>">Transmission EPM 90 GL-4</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3730/Repsol-Transmission-Ep-85w140-Gl-5'); ?>">Transmission EP 85W 140 GL-5</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3729/Repsol-Transmission-Ep-80w90-Gl-5'); ?>">Transmission EP 80W 90 GL-5</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/REPSOL"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/repsol-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 text-right p-x-0 m-t-1">
                            <a href="<?php echo site_url('c/Pelumas/REPSOL'); ?>" class="f12" style="width: 150px;text-align: center;height: 0; position: relative;border-right: 0px solid transparent;border-bottom: 30px solid #ff9900;border-left: 30px solid transparent;float:right">
                                <span class="fbold" style="position: absolute;left: 15%;color:#fff;top:5px">Selengkapnya &raquo;</span>
                            </a>
                        </div>
                    </div>
                    <div class="row p-t-1" style="border:1px solid #eee;">
                        <div class="col-xs-12 m-b-1">
                            <h6 class="m-b-1"><strong>Pelumas Mobil 1</strong></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <ul class="list-group" style="list-style:none">
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3282/Mobil-1-Super-Friction-Fighter--sae-10w40--4l'); ?>">Super Friction Fighter SAE 10W40</a></li>
                                    <li class="f12"><a style="color:#333" href="<?php echo site_url('product/3284/Mobil-1-Super-Friction-Fighter--sae-5w30--4l'); ?>">Super Friction Fighter SAE 5W30</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/MOBIL-1'"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/mobil1-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 text-right p-x-0 m-t-1">
                            <a href="<?php echo site_url('c/Pelumas/MOBIL-1'); ?>" class="f12" style="width: 150px;text-align: center;height: 0; position: relative;border-right: 0px solid transparent;border-bottom: 30px solid #ff9900;border-left: 30px solid transparent;float:right">
                                <span class="fbold" style="position: absolute;left: 15%;color:#fff;top:5px">Selengkapnya &raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 p-a-0 m-t-2">
            <h4 class="m-b-1"><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></h4>
            <div class="col-xs-12 p-a-0" style="background:#fff">
                <div class="col-xs-3 p-a-1" style="background: rgb(255,129,3);background: linear-gradient(338deg, rgba(255,129,3,1) 0%, rgba(246,166,15,1) 48%, rgba(255,192,0,1) 100%);height:41vh">
                    <h4 class="m-x-2 m-y-2" style="color:#fff"><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></h4>
                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/drums.png"); ?>" class="img-fluid pull-right">
                    <a href="<?php echo site_url('c/Pelumas'); ?>" class="btn btn-warning m-x-2 f14" style="background:#fff;color:#000;border-radius:20px;margin-top:150px;position:absolute">
                        Selengkapnya &raquo;
                    </a>
                </div>
                <div class="col-xs-3 m-a-0">
                    <div class="row p-y-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><a href="<?php echo site_url('c/Pelumas/GREASE'); ?>"><strong>Grease / Gemuk</strong></a></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <p class="f14" style="color:#666">
                                    Melindungi roda gigi mesin anda dengan sempurna
                                </p>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/GREASE"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/gemuk-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row p-y-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><a href="<?php echo site_url('c/Pelumas/DIESEL-ENGINE-OILS'); ?>"><strong>Heavy Duty Diesel Oil</strong></a></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <p class="f14" style="color:#666">
                                    Meningkatkan performa mesin diesel anda
                                </p>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/DIESEL-ENGINE-OILS"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/diesel-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 m-a-0">
                    <div class="row p-y-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><a href="<?php echo site_url('c/Pelumas/HYDRAULIC-OILS'); ?>"><strong>Industrial Hydraulic Oil</strong></a></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <p class="f14" style="color:#666">
                                    Melindungi roda gigi mesin anda dengan sempurna
                                </p>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/HYDRAULIC-OILS"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/hidrolik-square.png"); ?>" class="img-fluid m-t-3">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row p-y-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><a href="<?php echo site_url('c/Pelumas/GEAR-TRANSMISSION-OILS'); ?>"><strong>Gear &amp; Transmission Oil</strong></a></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <p class="f14" style="color:#666">
                                    Perpindahan gigi menjadi lebih halus dan simultan
                                </p>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/GEAR-TRANSMISSION-OILS"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/transmisi-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 m-a-0">
                    <div class="row p-y-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><a href="<?php echo site_url('c/Pelumas/BRAKE-FLUID'); ?>"><strong>Brake Fluid</strong></a></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <p class="f14" style="color:#666">
                                    Tingkatkan keamanan dengan kendali penuh
                                </p>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/BRAKE-FLUID"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/brake-square.png"); ?>" class="img-fluid m-t-1">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row p-y-1" style="border:1px solid #eee;">
                        <div class="col-xs-12">
                            <h6 class="m-b-1"><a href="<?php echo site_url('c/Pelumas/COOLANT'); ?>"><strong>Coolant</strong></a></h6>
                            <div class="col-md-8 m-a-0 p-a-0">
                                <p class="f14" style="color:#666">
                                    Menjaga mesin tetap dingin sepanjang hari
                                </p>
                            </div>
                            <div class="col-md-4 m-a-0 p-a-0">
                                <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas/COOLANT"); ?>">
                                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/coolant-square.png"); ?>" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 p-a-0 m-t-2">
            <h4 class="m-b-1"><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></h4>
            <div class="col-xs-12 p-a-0">
                <div class="col-xs-3 p-a-1" style="background: rgb(255,129,3);background: linear-gradient(338deg, rgba(255,129,3,1) 0%, rgba(246,166,15,1) 48%, rgba(255,192,0,1) 100%);">
                    <h4 class="m-x-2 m-y-2" style="color:#fff"><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></h4>
                    <img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/drums.png"); ?>" class="img-fluid pull-right">
                    <a href="<?php echo site_url('c/Pelumas'); ?>" class="btn btn-warning m-x-2 f14" style="background:#fff;color:#000;border-radius:20px;margin-top:150px;position:absolute">
                        Selengkapnya &raquo;
                    </a>
                </div>
                <div class="col-xs-9 m-a-0" style="">
                    <div class="listproduct row p-y-0 slick-line1">
                        <?php
                        $i = 1;
                        foreach ($listproduct as $key) :
                            $this->load->view('product/_item_product.php', array('key' => $key));
                        endforeach; ?>
                    </div>
                </div>

            </div>

        </div>
    </div> -->
    <!-- <div class="clearfix"></div>
    <div class="row text-center" style="margin-top:50px;margin-bottom:50px">
        <h2 class="m-y-3 fbold"><?php echo $this->lang->line('heading_spotlight', FALSE); ?></h2>
        <div class="col-xs-3">
            <h3 style="font-size:42px"><strong>5000+</strong></h3>
            <h4 class="col-xs-10 col-xs-offset-1"><?php echo $this->lang->line('konten_spotlight_satu', FALSE); ?></h4>
        </div>
        <div class="col-xs-3">
            <h3 style="font-size:42px"><strong>200+</strong></h3>
            <h4 class="col-xs-10 col-xs-offset-1"><?php echo $this->lang->line('konten_spotlight_dua', FALSE); ?></h4>
        </div>
        <div class="col-xs-3">
            <h3 style="font-size:42px"><strong>100+</strong></h3>
            <h4 class="col-xs-10 col-xs-offset-1"><?php echo $this->lang->line('konten_spotlight_tiga', FALSE); ?></h4>
        </div>
        <div class="col-xs-3">
            <h3 style="font-size:42px"><strong>500+</strong></h3>
            <h4 class="col-xs-10 col-xs-offset-1"><?php echo $this->lang->line('konten_spotlight_empat', FALSE); ?></h4>
        </div>
    </div> -->

    <!-- <div class="clearfix"></div>
    <?php if ($listproduct) : ?>
        <div class="listproduct row" style="margin-top:50px;">
            <h2 class="text-center m-b-2 fbold"><?php echo $this->lang->line('heading_daftar_produk', FALSE); ?></h2>
            <div class="row test-list">
                <?php $i = 1;
                foreach ($listproduct as $key) : ?>
                    <?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
                    <?php if ($i % 6 == 0) : ?>
            </div>
            <div class="row test-list">
            <?php endif;
                    $i++; ?>
        <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?> -->
</div>
<style type="text/css">
    .line-black {
        height: 5px;
        background-color: #000;
    }

    .tag-pelumas {
        font-size: 14px !important;
        color: #fff;
        background-color: #ff9900;
        padding: 10px;
        width: fit-content;
        border-radius: 10px;
        font-weight: bold;
    }

    .tag-ban {
        font-size: 14px !important;
        color: #fff;
        background-color: red;
        padding: 10px;
        width: fit-content;
        border-radius: 10px;
        font-weight: bold;
    }

    .tag-alat-berat {
        font-size: 14px !important;
        color: #fff;
        background-color: green;
        padding: 10px;
        width: fit-content;
        border-radius: 10px;
        font-weight: bold;
    }

    .card-icon-tag {
        text-align: center;
        object-fit: cover;
        object-position: center;
        position: relative;
        background-color: transparent;
        border: none;
        margin: 0;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        top: 50%;
    }

    .icon-tag {
        top: 50%;
        width: 100%;
    }

    .card-kategori {
        width: 180px;
        height: 250px;
        background-color: #E0E0E0;
    }

    .img-kategori {
        width: 150px;
        height: 150px;
        padding: 10px;
    }

    #clockdiv {
        font-family: sans-serif;
        color: #fff;
        display: inline-block;
        font-weight: 100;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    #clockdiv>span {
        padding: 5px;
        border-radius: 10px;
        background: red;
        display: inline-block;
    }
</style>
<script>
    function getTimeRemaining(endtime) {
        const total = Date.parse(endtime) - Date.parse(new Date());
        const seconds = Math.floor((total / 1000) % 60);
        const minutes = Math.floor((total / 1000 / 60) % 60);
        const hours = Math.floor((total / (1000 * 60 * 60)) % 24);

        return {
            total,
            hours,
            minutes,
            seconds
        };
    }

    function initializeClock(id, endtime) {
        const clock = document.getElementById(id);
        const hoursSpan = clock.querySelector('.hours');
        const minutesSpan = clock.querySelector('.minutes');
        const secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            const t = getTimeRemaining(endtime);

            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        const timeinterval = setInterval(updateClock, 1000);
    }

    const deadline = new Date(Date.parse(new Date()) + 24 * 60 * 60 * 1000);
    initializeClock('clockdiv', deadline);
</script>