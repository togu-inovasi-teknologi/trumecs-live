<div class="container m-b-2 d-flex flex-column gap-3">
    <div class="col-lg-12">
        <ol class="breadcrumb m-a-0">
            <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
            <li><a class="forange" href="<?php echo base_url() ?>rental">Rental</a></li>
            <li>Alat Berat</li>
        </ol>
    </div>
    <section id="list-rental">
        <div class="d-flex flex-column gap-2">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h4 class="fbold m-b-0">List Rental</h4>
                <div class="d-flex">
                    <button class="btn btnnew radius-sm m-r-1" data-toggle="modal" type="button" data-target="#filter-mechanic"><i class="fa fa-filter"></i> Filter</button>
                    <div class="input-group d-flex gap-0 w-100">
                        <input type="text" class="form-control" placeholder="Search Alat" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 d-flex flex-column gap-2">
                <div class="row">
                    <?php if (!empty($rental)) { ?>
                        <?php foreach ($rental as $i => $rent) : ?>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body d-flex flex-column gap-1">
                                        <img src="/public/image/product/<?= $rent['img'] ?>" alt="<?= $rent['img'] ?>" class="img-center">
                                        <div class="p-a-1 d-flex flex-column gap-2">
                                            <div class="d-flex flex-column gap-2">
                                                <div class="d-flex flex-column gap-0">
                                                    <h5 class="fbold m-b-0"><?= $rent['tittle'] ?></h5>
                                                    <p class="text-muted"><?= $rent['nama_brand'] ?></p>
                                                </div>
                                                <div class="d-flex flex-column gap-1">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="d-flex gap-1 align-items-center
                                    "><i class="fa fa-map-marker icon-a-15 text-center"></i>Lokasi</p>
                                                        <p class="fbold "><?= $rent['lokasi'] ?></p>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="d-flex gap-1 align-items-center
                                    "><i class="fa fa-clock-o icon-a-15 text-center"></i>Minimun Sewa</p>
                                                        <p class="fbold "><?= $rent['minimum_rent'] ?> <?= $rent['rent_time_unit'] === 0 ? "Jam" : "Hari" ?></p>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="d-flex gap-1 align-items-center
                                    "><i class="fa fa-truck icon-a-15 text-center"></i>Jumlah Unit</p>
                                                        <p class="fbold "><?= $rent['stock'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?= base_url() ?>rental/detail/<?= $rent['id'] ?>" class="btn btnnew radius-lg f14">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <div class="col-lg-12">
                            <div class="alert alert-warning">
                                <p>Tidak Ditemukan</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <section id="not-found-list-rental">
        <div class="col-lg-12 title-desktop m-b-1">
            <h6 class="title-content">Tidak menemukan alat?</h6>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <?php foreach ($subKategori as $sub) : ?>
                    <div class="col-lg-1--5" style="padding-right:1px;">
                        <a href="<?php echo base_url() ?>rental/list/<?= $sub['url'] ?>" style="text-decoration: none;">
                            <div class="card text-center card-shadow p-a-1">
                                <img src="<?php echo base_url(); ?>public/image/category/card-<?= $sub['name'] ?>.png" alt="category">
                                <h6 class="fblack f13 fbold m-t-1"><?= $sub['name'] ?></h6>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
                <!-- <div class="col-lg-1--5" style="padding-right:1px;">
                    <a href="<?php echo base_url() ?>rental/detail" style="text-decoration: none;">
                        <div class="card text-center card-shadow p-a-1">
                            <img src="<?php echo base_url(); ?>public/image/category/card-Alat-Berat.png" alt="category">
                            <h6 class="fblack f13 fbold m-t-1">Excavator</h6>
                        </div>
                    </a>
                </div>
                <div class="col-lg-1--5" style="padding-right:1px;">
                    <a href="<?php echo base_url() ?>rental/detail" style="text-decoration: none;">
                        <div class="card text-center card-shadow p-a-1">
                            <img src="<?php echo base_url(); ?>public/image/category/card-Forklift.png" alt="category">
                            <h6 class="fblack f13 fbold m-t-1">Forklift</h6>
                        </div>
                    </a>
                </div>
                <div class="col-lg-1--5" style="padding-right:1px;">
                    <a href="<?php echo base_url() ?>rental/detail" style="text-decoration: none;">
                        <div class="card text-center card-shadow p-a-1">
                            <img src="<?php echo base_url(); ?>public/image/category/card-Unit.png" alt="category">
                            <h6 class="fblack f13 fbold m-t-1">Bus & Truk</h6>
                        </div>
                    </a>
                </div>
                <div class="col-lg-1--5" style="padding-right:1px;">
                    <a href="<?php echo base_url() ?>rental/detail" style="text-decoration: none;">
                        <div class="card text-center card-shadow p-a-1">
                            <img src="<?php echo base_url(); ?>public/image/category/card-Bulldozer.png" alt="category">
                            <h6 class="fblack f13 fbold m-t-1">Bulldozer</h6>
                        </div>
                    </a>
                </div>
                <div class="col-lg-1--5" style="padding-right:1px;">
                    <a href="<?php echo base_url() ?>rental/detail" style="text-decoration: none;">
                        <div class="card text-center card-shadow p-a-1">
                            <img src="<?php echo base_url(); ?>public/image/category/card-Car.png" alt="category">
                            <h6 class="fblack f13 fbold m-t-1">Car</h6>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
    </section>
    <section id="related-article">
        <div class="col-lg-12 title-desktop m-b-1">
            <h6 class="title-content">Artikel Terkait</h6>
        </div>
        <div class="col-lg-12">
            <?php echo $this->load->view('article/_same_article', array('article' => $relatedarticle, 'media' => 'half', 'img_base_url' => base_url())); ?>
        </div>
    </section>
</div>