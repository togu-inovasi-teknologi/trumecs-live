<div class="container m-y-1 p-a-0">
    <section id="list-rental">
        <div class="d-flex flex-column gap-4">
            <div class="col-sm-12 d-flex justify-content-between align-items-center">
                <button class="btn btnnew radius-sm m-r-1" data-toggle="modal" type="button" data-target="#filter-mechanic"><i class="fa fa-filter"></i> Filter</button>
                <div class="input-group d-flex gap-0 w-100">
                    <input type="text" class="form-control" placeholder="Search Alat" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 d-flex flex-column gap-3">
                <?php if (!empty($rental)) { ?>
                    <?php foreach ($rental as $i => $rent) : ?>
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <img src="/public/image/product/<?= $rent['img'] ?>" alt="<?= $rent['img'] ?>" class="img-center">
                                <div class="d-flex flex-column gap-2 p-a-1">
                                    <div class="d-flex flex-column">
                                        <p class="fbold"><?= $rent['tittle'] ?></p>
                                        <p class="text-muted f14"><?= $rent['nama_brand'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="f12">Lokasi</p>
                                        <p class="fbold f12"><?= $rent['lokasi'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="f12">Minimun Sewa</p>
                                        <p class="fbold f12"><?= $rent['minimum_rent'] ?> <?= $rent['rent_time_unit'] === 0 ? "Jam" : "Hari" ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="f12">Jumlah Unit</p>
                                        <p class="fbold f12"><?= $rent['stock'] ?></p>
                                    </div>
                                    <a href="<?= base_url() ?>rental/detail/<?= $rent['id'] ?>" class="btn btnnew radius-sm f14">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <div class="alert alert-warning">
                        <p>Tidak Ditemukan</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section id="not-found-list-rental" class="m-t-2">
        <div class="col-lg-12 title-mobile m-b-1">
            <h6 class="title-content">Tidak menemukan alat?</h6>
        </div>
        <div class="d-flex flex-column gap-2 m-b-2">
            <?php foreach ($subKategori as $sub) : ?>
                <div class="col-xs-12">
                    <a href="<?= base_url() ?>rental/list/<?= $sub['url'] ?>">
                        <div class="card card-rental">
                            <img src="<?php echo base_url(); ?>public/image/category/card-<?= $sub['name'] ?>.png" alt="icon">
                            <h6 class="fblack f13 fbold"><?= $sub['name'] ?></h6>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="related-article">
        <div class="col-lg-12 title-mobile m-b-1">
            <h6 class="title-content">Artikel terkait</h6>
        </div>
        <div class="col-xs-12">
            <?php echo $this->load->view('article/_same_article', array('article' => $relatedarticle)); ?>
        </div>
    </section>
</div>