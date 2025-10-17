<?php
$img_promo = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo_specialoffer.png" width="70">';
?>
<!-- <div class="row">
    <a href="<?php echo site_url('member/signup') ?>"><img src="<?php echo base_url('public/image/pop-up.jpg'); ?>" style="width:100%" /></a>
</div> -->
<div id="page_home">
    <div class="row" style="background:#fff">
        <div class="fadeslidebig col-md-12 m-a-0 p-a-1" style="display:none">
            <?php foreach (array_reverse($slide) as $headslideimg) : ?>
                <div class="item-slide" style="border-radius:10px;overflow:hidden">
                    <?php echo ($headslideimg["link"]) != "" ? '<a href="' . $headslideimg["link"] . '">' : ''; ?>
                    <img alt="Sparepart Trumecs" style="height:200px" class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $headslideimg["img"] ?>" data-src="holder.js/620x300?bg=#CECECE&fg=FFFFFF&text=Slider">
                    <?php echo ($headslideimg["link"]) != "" ? '</a>' : ''; ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="row p-a-0 m-t-1 m-b-1" style="background:#fff">
        <div class="col-xs-12 p-a-0" style="overflow-x:scroll">
            <div class="col-xs-12 " style="width:180vw">
                <div class="row">
                    <div class="col-xs-6 p-a-1" style="width:45vw;">
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="<?php echo base_url() ?>member/bulk"><img class="icon-tab" alt="Icon RFQ" src="<?php echo base_url("public/icon/rfq.png"); ?>"></a>
                            </div>
                            <div class="col-xs-9 judul">
                                <a class="fblack fbold f14" href="<?php echo base_url() ?>member/bulk">RFQ</a><br>
                                <span style="font-size:7px;">Memesan Barang Sekaligus</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 p-a-1" style="width:45vw;">
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="<?php echo base_url() ?>member/lelang"><img class="icon-tab" alt=" Icon lelang" src="<?php echo base_url("public/icon/lelang.png"); ?>"></a>
                            </div>
                            <div class="col-xs-9 judul">
                                <a class="fblack fbold f14" href="<?php echo base_url() ?>member/lelang">Lelang</a><br>
                                <span style="font-size:8px;">Info Lelang Tender</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 p-a-1" style="width:45vw;">
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="<?php echo base_url() ?>member/rental"><img class="icon-tab" alt=" Icon rental" src="<?php echo base_url("public/icon/rental.png"); ?>"></a>
                            </div>
                            <div class="col-xs-9 judul">
                                <a class="fblack fbold f14" href="<?php echo base_url() ?>member/rental">Rental</a><br>
                                <span style="font-size:8px;">Jasa Penyewaan Alat</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 p-a-1" style="width:45vw;">
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="<?php echo base_url() ?>member/request"><img class="icon-tab" alt=" Icon request" src="<?php echo base_url("public/icon/request.png"); ?>"></a>
                            </div>
                            <div class="col-xs-9" style="line-height:15px">
                                <a class="fblack fbold f14" href="<?php echo base_url() ?>member/request">Request</a><br>
                                <span style="font-size:8px;">Publikasi Permintaan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="fbold m-t-2">Temukan Kebutuhanmu</h5>
    <div class="row p-a-0 m-b-1 m-t-1" style="background:#fff">
        <div class="col-xs-12 p-a-0" style="overflow-x: scroll;">
            <div class="col-xs-12" style="width:185vw">
                <div class="row">
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Aki'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/611614a14a2ed.jpg" width="30px" />
                            <h6 class="m-t-1">Aki</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Unit/Alat-Berat'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/6221c6dfc9a40.jpg" width="30px" />
                            <h6 class="m-t-1">Alat Berat</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Ban'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/611614ab72be3.jpg" width="30px" />
                            <h6 class="m-t-1">Ban</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Pelumas'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/61161488ed99f.jpg" width="30px" />
                            <h6 class="m-t-1">Pelumas</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Tools/Equipment-Tools'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/6116145d5f1fa.jpg" width="30px" />
                            <h6 class="m-t-1">Peralatan Kerja</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Tools/Safety-Tools'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/611614348ca14.jpg" width="30px" />
                            <h6 class="m-t-1">Safety Tools</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Sparepart'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/611614bab4e24.jpg" width="30px" />
                            <h6 class="m-t-1">Sparepart</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-t-1 p-a-0 text-center" style="width:20vw;margin:0px 5px;">
                        <a href="<?php echo site_url('c/Unit/Bus-Truck'); ?>" class="m-b-1" style="color: #000;">
                            <img src="https://www.trumecs.com/public/image/page/home/61161478c2701.jpg" width="30px" />
                            <h6 class="m-t-1">Truck & Bus</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 p-a-0 m-t-2">
        <div class="row">
            <div class="col-xs-5">
                <h5 class="m-b-1 fbold">Flash Sale</h5>
            </div>
            <div class="col-xs-6" style="margin-left:-50px; margin-top:-5px;">
                <div id="clockdiv">
                    <span class="hours"></span>
                    <span class="minutes"></span>
                    <span class="seconds"></span>
                </div>
            </div>
        </div>
        <div class="row p-a-0 m-b-2 text-center" style="background:#fff;">
            <div class="col-xs-12" style="overflow-x: scroll;">
                <?php if ($listproduct) : ?>
                    <div class="listproduct col-xs-12 m-t-0 p-a-0" style="width:500vw">
                        <div class=" row m-b-0">
                            <?php foreach ($listproduct as $index => $key) : ?>
                                <?php $this->load->view('product/_item_product_home.php', array('key' => $key)); ?>
                                <?php echo ($index + 1) % 10 == 0 ? '</div><div class="row  m-b-0">' : '' ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="m-t-1">
        <a href="" class="btn btnnew f12" style="float: right; margin-top:-10px;">View all</a>
        <h5 class="m-b-1 fbold">Apa yang Baru?</h5>
    </div>
    <div class="row p-a-0 m-b-1 text-center" style="background:#fff;">
        <div class="col-xs-12" style="overflow-x: scroll;">
            <?php if ($listproduct) : ?>
                <div class="listproduct col-xs-12 m-t-0 p-a-0" style="width:500vw">
                    <div class=" row m-b-0">
                        <?php foreach ($listproduct as $index => $key) : ?>
                            <?php $this->load->view('product/_item_product_home.php', array('key' => $key)); ?>
                            <?php echo ($index + 1) % 10 == 0 ? '</div><div class="row  m-b-0">' : '' ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row p-a-0 m-b-1 text-center" style="background:#fff;">
        <div class="col-xs-12" style="overflow-x: scroll;">
            <?php if ($listproduct) : ?>
                <div class="listproduct col-xs-12 m-t-0 p-a-0" style="width:500vw">
                    <div class=" row m-b-0">
                        <?php foreach ($listproduct as $index => $key) : ?>
                            <?php $this->load->view('product/_item_product_home.php', array('key' => $key)); ?>
                            <?php echo ($index + 1) % 10 == 0 ? '</div><div class="row  m-b-0">' : '' ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row p-a-0 m-b-1 text-center" style="background:#fff;">
        <div class="col-xs-12" style="height:100px;">
            <h1 class="text-center" style="margin: auto;">Iklan</h1>
        </div>
    </div>
    <hr class="row">
    <div>
        <h5 class="fbold" style="color: #ff9900;">Pelumas</h5>
    </div>
    <div class="row p-a-0 m-b-0" style="background:transparent; margin-top:-10px;">
        <div class="col-xs-12 p-t-1 p-b-1" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-xs-12" style="width:130vw">
                    <a class="tag-pelumas">Automotive Oils</a>
                    <a class="tag-pelumas">Engine Oils</a>
                    <a class="tag-pelumas">Compressor Oils</a>
                    <a class="tag-pelumas">Cutting Oils</a>
                    <a class="tag-pelumas">Brake Fluids</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-a-0 m-b-0" style="background:transparent; margin-top:-10px;">
        <div class="col-xs-12">
            <div class="row text-center">
                <div class="col-xs-4">
                    <a href="">
                        <img class="icon-tag" alt="Castrol" src="<?php echo base_url("public/icon/castrol.png"); ?>">
                    </a>
                </div>
                <div class="col-xs-2">
                    <a href=""><img class="icon-tag" alt="Petronas" src="<?php echo base_url("public/icon/petronas.png"); ?>"></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Pertamina" src="<?php echo base_url("public/icon/pertamina.png"); ?>"></a>
                </div>
                <div class="col-xs-2">
                    <a href=""><img class="icon-tag" alt="Shell" src="<?php echo base_url("public/icon/shell.png"); ?>"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-a-0 m-t-1" style="background:transparent;">
        <div class="col-xs-12" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-xs-12" style="width:275vw">
                    <div class="row">
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Castrol" src="<?php echo base_url("public/icon/pelumas-castrol.png"); ?>"></a>
                                <h6 class="fbold">Castrol</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:#ff9900">Rp.1.343.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Pertamina" src="<?php echo base_url("public/icon/pelumas-pertamina.png"); ?>"></a>
                                <h6 class="fbold">Pertamina</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:#ff9900">Rp.1.224.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Petronas" src="<?php echo base_url("public/icon/pelumas-petronas.png"); ?>"></a>
                                <h6 class="fbold">Petronas</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:#ff9900">Rp.1.043.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Shell" src="<?php echo base_url("public/icon/pelumas-shell.png"); ?>"></a>
                                <h6 class="fbold">Shell</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:#ff9900">Rp.1.543.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Repsol" src="<?php echo base_url("public/icon/pelumas-repsol.png"); ?>"></a>
                                <h6 class="fbold">Repsol</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:#ff9900">Rp.1.478.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Addinol" src="<?php echo base_url("public/icon/pelumas-addinol.png"); ?>"></a>
                                <h6 class="fbold">Addinol</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:#ff9900">Rp.943.434</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-t-1">
        <h5 class="fbold" style="color: red;">Ban</h5>
    </div>
    <div class="row p-a-0 m-b-0" style="background:transparent; margin-top:-10px;">
        <div class="col-xs-12 p-t-1 p-b-1">
            <div class="row">
                <div class="col-xs-12">
                    <a class="tag-ban">Offroad</a>
                    <a class="tag-ban">Motor</a>
                    <a class="tag-ban">Mobil</a>
                    <a class="tag-ban">Bus Radial</a>
                    <a class="tag-ban">Truck</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-a-0 m-b-0" style="background:transparent; margin-top:-10px;">
        <div class="col-xs-12">
            <div class="row text-center">
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Goodyear" src="<?php echo base_url("public/icon/goodyear.png"); ?>"></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Bridgestone" src="<?php echo base_url("public/icon/bridgestone.png"); ?>"></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Hankook" src="<?php echo base_url("public/icon/hankook.png"); ?>"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-a-0 m-t-1" style="background:transparent;">
        <div class="col-xs-12" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-xs-12" style="width:275vw">
                    <div class="row">
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Maxima" src="<?php echo base_url("public/icon/ban-maxima.png"); ?>"></a>
                                <h6 class="fbold">Maxima</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:red;">Rp.1.343.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Goodyear" src="<?php echo base_url("public/icon/ban-goodyear.png"); ?>"></a>
                                <h6 class="fbold">Goodyear</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:red;">Rp.1.224.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Kaizen" src="<?php echo base_url("public/icon/ban-kaizen.png"); ?>"></a>
                                <h6 class="fbold">Kaizen</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:red;">Rp.943.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Dunlop" src="<?php echo base_url("public/icon/ban-dunlop.png"); ?>"></a>
                                <h6 class="fbold">Dunlop</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:red;">Rp.1.043.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Hankook" src="<?php echo base_url("public/icon/ban-hankook.png"); ?>"></a>
                                <h6 class="fbold">Hankook</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:red;">Rp.1.543.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Bridgestone" src="<?php echo base_url("public/icon/ban-bridgestone.png"); ?>"></a>
                                <h6 class="fbold">Bridgestone</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:red;">Rp.1.478.434</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-t-1">
        <h5 class="fbold" style="color: green;">Alat Berat</h5>
    </div>
    <div class="row p-a-0 m-b-0" style="background:transparent; margin-top:-10px;">
        <div class="col-xs-12 p-t-1 p-b-1">
            <div class="row">
                <div class="col-xs-12">
                    <a class="tag-alat-berat">Excavator</a>
                    <a class="tag-alat-berat">Dumptruck</a>
                    <a class="tag-alat-berat">Bulldozer</a>
                    <a class="tag-alat-berat">Crane</a>
                    <a class="tag-alat-berat">Forklift</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-a-0 m-b-0" style="background:transparent; margin-top:-10px;">
        <div class="col-xs-12">
            <div class="row text-center">
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Hyundai" src="<?php echo base_url("public/icon/hyundai.png"); ?>"></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Komatsu" src="<?php echo base_url("public/icon/komatsu.png"); ?>"></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><img class="icon-tag" alt="Hitachi" src="<?php echo base_url("public/icon/hitachi.png"); ?>"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-a-0 m-t-1" style="background:transparent;">
        <div class="col-xs-12" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-xs-12" style="width:275vw">
                    <div class="row">
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Excavator" src="<?php echo base_url("public/icon/alatberat-excavator.png"); ?>"></a>
                                <h6 class="fbold">Excavator</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:green;">Rp.1.343.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Bulldozer" src="<?php echo base_url("public/icon/alatberat-bulldozer.png"); ?>"></a>
                                <h6 class="fbold">Bulldozer</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:green;">Rp.1.224.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Crane" src="<?php echo base_url("public/icon/alatberat-crane.png"); ?>"></a>
                                <h6 class="fbold">Crane</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:green;">Rp.943.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Roller" src="<?php echo base_url("public/icon/alatberat-roller.png"); ?>"></a>
                                <h6 class="fbold">Roller</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:green;">Rp.1.043.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Grader" src="<?php echo base_url("public/icon/alatberat-grader.png"); ?>"></a>
                                <h6 class="fbold">Grader</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:green;">Rp.1.543.434</h6>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 45vw;">
                            <div class="card borderdesk card-kategori text-center">
                                <a href=""><img class="img-kategori" alt="Dumptruck" src="<?php echo base_url("public/icon/alatberat-dumptruck.png"); ?>"></a>
                                <h6 class="fbold">Dumptruck</h6>
                                <h6 class="f10">Mulai</h6>
                                <h6 class="fbold" style="color:green;">Rp.1.478.434</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="row nopt nopb p-y-1">
        <div class="">
            <?php foreach ($headbottomslide as $key) : ?>
                <div>
                    <div class="col-xs-4 p-a-0">
                    <?php echo '<a alt="Sparepart Trumecs" href="' . $key["link"] . '"><img alt="Sparepart Trumecs" src="' . base_url() . 'public/image/page/home/' . $key["img"] . '" class="img-fluid"></a>' ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div> -->
    <!-- <div class="col-md-12 p-a-0 m-t-2" >
        <h5 class="m-b-1"><?php echo $this->lang->line('heading_kategori', FALSE); ?></h5>
        <div class="col-xs-12 p-a-0" >
            <div class="col-xs-12 p-a-1 text-center" style="border:1px solid #ccc;border-radius:15px;">
                <h6><strong><?php echo $this->lang->line('kategori_operasional', FALSE); ?></strong></h6>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Pelumas"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/61161488ed99f.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_operasional_pelumas', FALSE); ?></p> </div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Aki"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/611614a14a2ed.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_operasional_aki', FALSE); ?></p> </div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Ban"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/611614ab72be3.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_operasional_ban', FALSE); ?></p> </div>
            </div>
        </div>
        <div class="col-xs-12 p-a-0 m-t-1">
            <div class="col-xs-12 p-a-1 text-center" style="border:1px solid #ccc;border-radius:15px;">
                <h6><strong><?php echo $this->lang->line('kategori_sparepart', FALSE); ?></strong></h6>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Sparepart/Alat-Berat"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/611614bab4e24.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_sparepart_alat', FALSE); ?></p> </div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Sparepart/Truk-Bus"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/611614d0e0c99.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_sparepart_bus', FALSE); ?></p> </div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Sparepart/Industri"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/611614f23d9e6.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_sparepart_industri', FALSE); ?></p> </div>
            </div>
        </div>
        <div class="col-xs-12 p-a-0 text-center m-t-1">
            <div class="col-xs-12 p-a-1" style="border:1px solid #ccc;border-radius:15px;">
                <h6><strong><?php echo $this->lang->line('kategori_peralatan', FALSE); ?></strong></h6>
                <div class="col-xs-2"></div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Tools/Equipment-Tools"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/611614348ca14.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_peralatan_safety', FALSE); ?></p> </div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Tools/Safety-Tools"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/6116145d5f1fa.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_peralatan_kerja', FALSE); ?></p> </div>
            </div>
        </div>
        <div class="col-xs-12 p-a-0 text-center m-t-1">
            <div class="col-xs-12 p-a-1" style="border:1px solid #ccc;border-radius:15px;">
                <h6><strong><?php echo $this->lang->line('kategori_unit', FALSE); ?></strong></h6>
                <div class="col-xs-2"></div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Unit/Bus-Truk"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/61161478c2701.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_unit_bus', FALSE); ?></p> </div>
                <div class="col-xs-4 m-a-0 p-a-0"> <a alt="Sparepart Trumecs" href="<?php echo base_url("c/Unit/Alat-Berat"); ?>"><img alt="Sparepart Trumecs" src="<?php echo base_url("public/image/page/home/6221c6dfc9a40.jpg"); ?>" class="img-fluid"></a> <p class="text-center f12 "><?php echo $this->lang->line('kategori_unit_alat', FALSE); ?></p> </div>
            </div>
        </div>
    </div> -->
    <div class="clearfix"></div>
    <!-- <div class="row text-center" style="margin-top:50px;margin-bottom:50px">
        <h2 class="m-y-3 fbold">Komitmen kami </h2>
        <div class="col-xs-6">
            <h3 style="font-size:22px"><strong>5000+</strong></h3>
            <h6 class="col-xs-10 col-xs-offset-1">Produk tersedia</h6>
        </div>
        <div class="col-xs-6">
            <h3 style="font-size:22px"><strong>200+</strong></h3>
            <h6 class="col-xs-10 col-xs-offset-1">Produk baru setiap bulan</h6>
        </div>
        <div class="col-xs-6 m-t-2">
            <h3 style="font-size:22px"><strong>100+</strong></h3>
            <h6 class="col-xs-10 col-xs-offset-1">Perusahaan terlayani</h6>
        </div>
        <div class="col-xs-6 m-t-2">
            <h3 style="font-size:22px"><strong>500+</strong></h3>
            <h6 class="col-xs-10 col-xs-offset-1">Transaksi setiap bulan</h6>
        </div>
    </div> -->
    <!-- <?php if ($listproduct) : ?>
        <div class="listproduct col-xs-12 m-t-3 p-a-0">
            <h5 class="m-b-2 fbold">Direkomendasikan untuk anda</h5>
            <div class="row m-b-0">
                <?php foreach ($listproduct as $index => $key) : ?>
                    <?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
                    <?php echo ($index + 1) % 2 == 0 ? '</div><div class="row  m-b-0">' : '' ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?> -->
</div>

<style>
    .img-kategori {
        width: 120px;
        height: 120px;
        padding: 10px;
    }

    .card-kategori {
        width: 150px;
        height: 200px;
        background-color: #E0E0E0;
    }

    .tag-pelumas {
        font-size: 10px !important;
        color: #fff;
        background-color: #ff9900;
        padding: 10px;
        width: fit-content;
        border-radius: 10px;
        font-weight: bold;
    }

    .tag-ban {
        font-size: 10px !important;
        color: #fff;
        background-color: red;
        padding: 10px;
        width: fit-content;
        border-radius: 10px;
        font-weight: bold;
    }

    .tag-alat-berat {
        font-size: 10px !important;
        color: #fff;
        background-color: green;
        padding: 10px;
        width: fit-content;
        border-radius: 10px;
        font-weight: bold;
    }

    .icon-tag {
        width: 100%;
    }

    .icon-tab {
        width: 30px;
        height: 30px;
    }

    .judul {
        border-right: #666 solid 0.5px;
        line-height: 15px;
    }

    #clockdiv {
        font-family: sans-serif;
        color: #fff;
        display: inline-block;
        font-weight: 100;
        text-align: center;
        font-size: 10px;
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