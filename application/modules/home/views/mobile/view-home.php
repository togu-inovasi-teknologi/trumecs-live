<div class="container-fluid">
    <div class="row">
        <div class="search-home">
            <img src="<?php echo base_url() ?>public/banner/banner-product-main.png" />
            <div class="input-search">
                <h1>Pasar Mekanikal</h1>
                <h2>Belanja mekanikal makin mudah</h2>
                <div class="inputsearch input-group input-group-sm m-b-1">
                    <span class="input-group-addon btn search-button" id="searchbuttontemplate" style="background-color: #fff;"><i class="fa fa-search" style="color: #666;"></i></span>
                    <input type="text" class="form-control" placeholder="Cari Kebutuhan Mekanikal?" value="<?php echo $this->input->get("nama"); ?>">
                    <input type="hidden" name="quality" value="<?php echo $this->uri->segment(2) == 'used' ? "3" : $this->input->get("quality"); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container m-t-1" style="background-color:#f2f2f2;">
    <!--<div class="row m-b-0 p-a-0">
        <div class="col-xs-12">
            <div class="col-xs-6 p-a-0" style="border: 5px solid #f2f2f2;">
                <div class="card" style="width: 100%; height:70px; background-color:#ff9900;">
                    <div class="col-xs-12 p-t-1">
                        <div class="row">
                            <a href="<?php echo base_url("bulk") ?>">
                                <div class="col-xs-3" style="padding-left:5px;">
                                    <img src="<?php echo base_url() ?>public/icon/rfq-new.png" style="width: 40px; height:30px;" />
                                </div>
                                <div class="col-xs-9" style="padding-left:10px; padding-top:5px;">
                                    <h3 style="color: #fff; line-height:5px;" class="f14 fbold">RFQ</h3>
                                    <h5 style="color: #fff;" class="f8">Request From Quatation</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 p-a-0" style="border: 5px solid #f2f2f2;">
                <div class="card" style="width: 100%; height:70px; background-color:#178F47;">
                    <div class="col-xs-12 p-t-1">
                        <div class="row">
                            <div class="col-xs-3" style="padding-left:5px;">
                                <img src="<?php echo base_url() ?>public/icon/req-new.png" style="width: 40px; height:30px;" />
                            </div>
                            <div class="col-xs-9" style="padding-left:10px; padding-top:5px;">
                                <h3 style="color: #fff; line-height:5px;" class="f14 fbold">Request</h3>
                                <h5 style="color: #fff;" class="f8">Kirim Permintaan ke Publik</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 p-a-0" style="border: 5px solid #f2f2f2;">
                <div class="card" style="width: 100%; height:70px; background-color:#7B41C6;">
                    <div class="col-xs-12 p-t-1">
                        <div class="row">
                            <div class="col-xs-3" style="padding-left:5px;">
                                <img src="<?php echo base_url() ?>public/icon/car-rent-new.png" style="width: 40px; height:30px;" />
                            </div>
                            <div class="col-xs-9" style="padding-left:10px; padding-top:5px;">
                                <h3 style="color: #fff; line-height:5px;" class="f14 fbold">Rental</h3>
                                <h5 style="color: #fff;" class="f8">Sewa Alat Sementara</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 p-a-0" style="border: 5px solid #f2f2f2;">
                <div class="card" style="width: 100%; height:70px; background-color:#164A88;">
                    <div class="col-xs-12 p-t-1">
                        <div class="row">
                            <div class="col-xs-3" style="padding-left:5px;">
                                <img src="<?php echo base_url() ?>public/icon/jasa-new.png" style="width: 40px; height:30px;" />
                            </div>
                            <div class="col-xs-9" style="padding-left:10px; padding-top:5px;">
                                <h3 style="color: #fff; line-height:5px;" class="f14 fbold">Jasa</h3>
                                <h5 style="color: #fff;" class="f8">Cari Vendor-Vendor Jasa</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <div class="card row p-x-1">
        <div class="card-title m-b-1">
            <!-- <a href="<?php echo base_url("c/all/") ?>" class="text-right forange f14" style="float: right; margin-top:5px;">Semua Kategori <i class="fa fa-angle-right"></i></a> -->
            <h5 style="padding-top: 5px;">Categori</h5>
        </div>
        <div class="row p-a-0" style="overflow-x: scroll;">
            <div class="col-xs-12" style="width:136vw">
                <div class="row">
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Aki'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/car-battery-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Aki</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Unit/Alat-Berat'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/excavator-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Alat Berat</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Ban'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/tire-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Ban</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Pelumas'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/barrel-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Pelumas</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Tools/Equipment-Tools'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/tools-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Peralatan Kerja</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Tools/Safety-Tools'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/helmet-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Safety Tools</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Sparepart'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/sparepart-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Sparepart</h6>
                        </a>
                    </div>
                    <div class="col-xs-1 p-a-0 text-center" style="width:15vw;margin:0px 1vw;">
                        <a href="<?php echo site_url('c/Unit/Bus-Truck'); ?>" class="m-b-1" style="color: #000;">
                            <img src="<?php echo base_url() ?>public/icon/truck-bg.svg" width="40px" height="40px" />
                            <h6 class="m-t-1 f10">Truck & Bus</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card row">
        <div class="p-a-0 m-b-1" style="overflow-x: scroll;">
            <div class="col-xs-12" style="width:100vw">
                <div class="row">
                    <!--<div class="col-xs-6 p-a-0 text-center" style="width:100vw;margin:0px;">
                        <a href="<?php echo site_url('promo/Diskon-GIla-Gilaan-') ?>">
                        <img style="width: 100%; height:150px;" src="<?php echo base_url() ?>public/image/promo/652c644539372.jpg" />
                        </a>
                    </div>-->
                    <!--<div class="col-xs-6 p-a-0 text-center" style="width:60vw;margin:0px 1vw;">
                        <img style="width: 100%; height:150px;" src="<?php echo base_url() ?>public/banner/banner-alatberat.png" />
                    </div>
                    <div class="col-xs-6 p-a-0 text-center" style="width:60vw;margin:0px 1vw;">
                        <img style="width: 100%; height:150px;" src="<?php echo base_url() ?>public/banner/banner-pelumas.png" />
                    </div>-->
                </div>
            </div>
        </div>
        <div class="card-title p-x-1">
            <h5 class="fbold">Berbagai Brand</h5>
        </div>
        <div class="p-b-1" style="overflow-x: scroll;">
            <?php
            $pt = count($getbrand);
            $total = ceil($pt / 2);
            ?>
            <div class="col-xs-12" style="width:<?php echo $total * 32; ?>vw;">
                <div class="row">
                    <?php foreach ($getbrand as $i) : ?>
                        <div class="col-xs-6" style="width:30vw;margin:5px 1vw;">
                            <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>">
                                <img style="width: 100%; height:30px;" src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $i["img"]; ?>" />
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 p-a-0 m-t-1">
        <div class="row">
            <div class="col-xs-6">
                <h5 class="m-b-1 fbold">Flash Sale</h5>
            </div>
            <div class="col-xs-6" style="margin-left:-80px; margin-top: -5px;">
                <div id="clockdiv">
                    <span class="hours"></span>
                    <a class="fblack">:</a>
                    <span class="minutes"></span>
                    <a class="fblack">:</a>
                    <span class="seconds"></span>
                </div>
            </div>
        </div>
        <div class="listproduct p-y-0 mobile-home-list">
            <?php
            $i = 1;
            foreach ($listproduct as $key) :
                $this->load->view('product/_item_product_home.php', array('key' => $key));
            endforeach; ?>
        </div>
    </div>
    <div class="col-xs-12 p-a-0 m-t-2">
        <div class="row m-b-1">
            <div class="col-xs-6">
                <h5 class="m-b-1 fbold">Eofy Forest Deal</h5>
            </div>
            <div class="col-xs-12">
                <img style="width: 100%; height:150px;" src="<?php echo base_url() ?>public/banner/banner-main.jpeg" />
            </div>
        </div>
        <div class="listproduct p-y-0 mobile-home-list">
            <?php
            $i = 1;
            foreach ($listproduct as $key) :
                $this->load->view('product/_item_product_home.php', array('key' => $key));
            endforeach; ?>
        </div>
    </div>
    <!--<?php foreach ($getcategory as $i) : ?>
        <div class="col-xs-12 p-a-0">
            <div class="row">
                <div class="col-xs-12">
                    <a href="<?php echo base_url() ?>c/all/<?php echo $i["url"] ?>" class="text-right f14 forange" style="float: right;">Lihat Semua <i class="fa fa-angle-right"></i></a>
                    <h5 class="fbold"><img src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $i['url']; ?>.svg" style="width: 30px;"> <?php echo $i["name"] ?></h5>
                </div>
                <div class="col-xs-12">
                    <div class="p-a-0" style="overflow-x: scroll;">
                        <?php
                        $t = count($getbrand);
                        ?>
                        <div class="col-xs-12" style="width:<?php echo $t * 22; ?>vw">
                            <div class="row">
                                <?php foreach ($getbrand as $b) : ?>
                                    <div class="col-xs-2 p-a-0 text-center" style="margin:0px 1vw; width:20vw">
                                        <div class="card card-brand-2">
                                            <img src="<?php echo base_url() ?>public/image/icon/merek/<?php echo $b["img"]; ?>" />
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 m-b-1">
                    <img style="width: 100%; height:150px;" src="<?php echo base_url() ?>public/banner/category/banner-<?php echo $i["url"] ?>.png" />
                </div>
            </div>
            <div class="listproduct p-y-0 mobile-home-list">
                <?php
                $i = 1;
                foreach ($listproduct as $key) :
                    $this->load->view('product/_item_product_home.php', array('key' => $key));
                endforeach; ?>
            </div>
        </div>
    <?php endforeach ?>-->
</div>

<script type="text/javascript">
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