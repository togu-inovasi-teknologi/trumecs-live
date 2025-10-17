<?php $dataRental = $rental_detail[0];
$lfp = strlen($dataRental["img"]);
$ext = substr($dataRental["img"], $lfp - 4); ?>

<div class="container m-y-2">
    <section id="detail-rental">
        <div class="col-lg-12 m-b-3">
            <div class="row">
                <div class="col-lg-5 sticky-member">
                    <div class="row d-flex flex-column gap-3">
                        <div class="col-lg-12 text-center">
                            <img itemprop="image" class="img-center-detail tochangebyclick"
                                data-zoom-image="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $dataRental["img"] : "../noimage.png") ?>"
                                src="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $dataRental["img"] : "../noimage.png") ?>"
                                alt="Jual Sparepart Truk <?php echo ucwords(strtolower($dataRental["tittle"])) ?>"
                                width="100%">
                        </div>
                        <div class="col-lg-12">
                            <div class="img-galery">
                                <div class="border border-sm d-flex" style="overflow-x:scroll;">
                                    <img class="img-galery changeimagegalery"
                                        zoom-src-no-crop="<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $dataRental["img"] : "../noimage.png") ?>"
                                        src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg" || $ext == ".png" || $ext == 'jpeg' ? $dataRental["img"] : "../noimage.png") ?>"
                                        alt="Jual Sparepart Truk <?php echo ucwords(strtolower($dataRental["tittle"]))  ?>">
                                    <?php if (count($galeryimg) > 0) : ?>
                                        <?php foreach ($galeryimg as $gallery) : ?>
                                            <?php
                                            $glfp = strlen($gallery["img"]);
                                            $gext = substr($gallery["img"], $glfp - 4);
                                            !is_file("public/image/galery/" . $gallery["img"]) ? $gallery["img"] = "../noimage.png" : $gallery["img"];
                                            ?>
                                            <img itemprop="image" class="img-galery changeimagegalery"
                                                zoom-src-no-crop="<?php echo base_url() ?>public/image/galery/<?php echo ($gext == ".jpg" || $gext == ".png" || $gext == 'jpeg' ? $gallery["img"] : "../noimage.png") ?>"

                                                src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/galery/<?php echo ($gext == ".jpg" || $gext == ".png" || $gext == 'jpeg' ? $gallery["img"] : "../noimage.png") ?>"
                                                alt="Jual Sparepart Truk <?php ucwords(strtolower($dataRental["tittle"]))  ?>">
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    <?php if ($dataRental["youtube"] != "") : ?>
                                        <img class="img-galery"
                                            zoom-src-no-crop="<?php echo base_url() ?>public/image/product/<?php echo "../play.png" ?>"
                                            src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/product/<?php echo  "../play.png" ?>"
                                            alt="Jual Sparepart Truk <?php echo ucwords(strtolower($dataRental["tittle"]))  ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-column gap-1">
                            <h4 class="fbold m-b-0"><?= $dataRental['tittle']; ?></h4>
                            <p class="text-muted f18"><?= $dataRental['nama_brand']; ?></p>
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="d-flex gap-1 align-items-center
                                    "><i class="fa fa-map-marker icon-a-15 text-center"></i>Lokasi</p>
                                <p class="fbold "><?= $dataRental['lokasi']; ?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="d-flex gap-1 align-items-center
                                    "><i class="fa fa-clock-o icon-a-15 text-center"></i>Minimun Sewa</p>
                                <p class="fbold "><?= $dataRental['minimum_rent']; ?> <?= $dataRental['rent_time_unit'] == 0 ? 'Jam' : 'Hari'; ?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="d-flex gap-1 align-items-center
                                    "><i class="fa fa-truck icon-a-15 text-center"></i>Jumlah Unit</p>
                                <p class="fbold "><?= $dataRental['stock']; ?></p>
                            </div>
                            <p class="f18 fbold m-t-1">Spesifikasi</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="d-flex gap-1 align-items-center
                                    ">Tahun Produksi</p>
                                <p class="fbold "><?= date('Y', $dataRental['made']) ?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="d-flex gap-1 align-items-center
                                    ">Hour Meter</p>
                                <p class="fbold "><?= $dataRental['hour_meter']; ?></p>
                            </div>
                            <?php foreach ($attribute as $attr) : ?>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="d-flex gap-1 align-items-center
                                    "><?= $attr['name'] ?></p>
                                    <p class="fbold"><?= $attr['value'] ?></p>
                                </div>
                            <?php endforeach; ?>

                            <div class="d-flex gap-3 align-items-center">
                                <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-success radius-sm btn-md">Minta Penawaran</a>
                                <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-warning radius-sm btn-md">Info Selengkapnya</a>
                            </div>
                            <div class="card m-y-1">
                                <div class="card-header">
                                    <h5 class="card-title fbold">Informasi Tambahan</h5>
                                </div>
                                <div class="card-body p-a-1">
                                    <p><?= $dataRental['description']; ?></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title fbold">Sistem Sewa</h5>
                                </div>
                                <div class="card-body p-a-1">
                                    <p><?= $dataRental['rent_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="related-rental">
        <div class="col-lg-12">
            <h5 class="fbold">Rental terkait <?= $dataRental['tittle']; ?> </h5>
            <div class="row">
                <?php if (!empty($rental)) { ?>
                    <?php foreach ($rental as $i => $rent) : ?>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body d-flex flex-column gap-1">
                                    <img src="/public/image/product/<?= $rent['img'] ?>" alt="excavator" class="img-center">
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
    </section>
</div>