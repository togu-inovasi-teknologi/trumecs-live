<?php $dataRental = $rental_detail[0];
$lfp = strlen($dataRental["img"]);
$ext = substr($dataRental["img"], $lfp - 4); ?>
<div class="container p-a-0 m-y-2">
    <section id="detail-rental" class="m-b-2">
        <div class="d-flex flex-column gap-2">
            <div class="col-sm-12">
                <div class="swiper mySwiper m-t-1">
                    <div class="swiper-wrapper">
                        <?php if ($dataRental["youtube"] != "") : ?>
                            <div class="swiper-slide" style="background:#000">
                                <iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo $dataRental["youtube"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                        <div class="swiper-slide">
                            <img src="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == "jpeg" ? $dataRental["img"] : "../noimage.png") ?>" alt="...">
                            <?php if (count($galeryimg) > 0) : ?>
                                <?php foreach ($galeryimg as $gallery) : ?>
                                    <?php
                                    $glfp = strlen($gallery["img"]);
                                    $gext = substr($gallery["img"], $glfp - 4);
                                    is_file("public/image/galery/" . $gallery["img"]) != 1 ? $gallery["img"] = "../noimage.png" : $gallery["img"];
                                    ?>
                                    <img src="<?php echo base_url() ?>public/image/galery/<?php echo ($gext == ".jpg" || $ext == ".png" || $ext == "jpeg" ? $gallery["img"] : "../noimage.png") ?>" alt="...">
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <h5 class="fbold"><?= $dataRental['tittle']; ?></h5>
                <p class="text-muted"><?= $dataRental['nama_brand']; ?></p>
            </div>
            <div class="col-sm-12 bg-light-grey p-a-1">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="f14">Lokasi</p>
                    <p class="fbold f14"><?= $dataRental['lokasi']; ?></p>

                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="f14">Minimun Sewa</p>
                    <p class="fbold f14"><?= $dataRental['minimum_rent']; ?> <?= $dataRental['rent_time_unit'] === 0 ? 'Jam' : 'Hari'; ?></p>

                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="f14">Jumlah Unit</p>
                    <p class="fbold f14"><?= $dataRental['stock']; ?></p>
                </div>
            </div>
        </div>
    </section>
    <section id="spec-rental" class="m-b-2">
        <div class="col-sm-12">
            <div class="d-flex flex-column gap-2">
                <h6 class="fbold">Spesifikasi</h6>
                <div class="d-flex flex-column gap-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="f14">Tahun Produksi</p>
                        <p class="f14 fbold"><?= date('Y', $dataRental['made']); ?></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="f14">Hour Meter</p>
                        <p class="f14 fbold"><?= $dataRental['hour_meter']; ?></p>
                    </div>
                    <?php foreach ($attribute as $attr) : ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="f14"><?= $attr['name']; ?></p>
                            <p class="f14 fbold"><?= $attr['value']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="d-flex justify-content-end gap-3 align-items-center">
                    <button class="btn btn-success radius-sm btn-md">Sewa Alat</button>
                    <button class="btn btn-warning radius-sm btn-md">Info Selengkapnya</button>
                </div> -->
                <div class="card m-y-1">
                    <div class="card-header">
                        <h6 class="fbold">Informasi Tambahan</h6>
                    </div>
                    <div class="card-body p-a-1 flex-column gap-2 d-flex f14">
                        <p> <?= $dataRental['description'] ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h6 class="fbold">Sistem Sewa</h6>
                        </div>
                    </div>
                    <div class="card-body p-a-1 f14">
                        <p>
                            <?= $dataRental['rent_description'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="related-rental">
        <div class="col-xs-12 m-b-1">
            <h5 class="fbold">Rental terkait <?= $dataRental['tittle']; ?></h5>
        </div>
        <div class="col-xs-12 d-flex flex-column gap-3">
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
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <p class="f12">Lokasi</p>
                                        <p class="fbold f12"><?= $rent['lokasi'] ?></p>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <p class="f12">Minimun Sewa</p>
                                        <p class="fbold f12"><?= $rent['minimum_rent'] ?> <?= $rent['rent_time_unit'] === 0 ? "Jam" : "Hari" ?></p>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <p class="f12">Jumlah Unit</p>
                                        <p class="fbold f12"><?= $rent['stock'] ?></p>
                                    </div>
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
    </section>
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        mousewheel: {
            invert: false,
        },
        autoheight: true,
        setWrapperSize: true,
    });
</script>