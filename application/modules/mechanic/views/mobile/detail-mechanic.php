<?php $dataMechanic = $mechanic[0]; ?>

<div class="d-flex flex-column gap-3">
    <section id="detail-mechanic">
        <div class="container-fluid">
            <div class="col-sm-12 m-b-2 p-x-0">
                <img src="/public/image/product/<?= $dataMechanic['img'] ?>" alt="Foto Expert" width="100%">
            </div>
            <div class="col-sm-12 p-x-0">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex flex-column gap-0">
                        <?php
                        $length = array();
                        $names = explode(' ', $dataMechanic['tittle']);
                        foreach($names as $key => $value):
                            $replacement = str_repeat('*', strlen($value) - 2);
                            $names[$key] = substr_replace($value, $replacement, 1, -1);
                        endforeach;
                        $name = implode(' ', $names);
                        ?>
                        <h5 class="fbold"><?= $dataMechanic['nama_kategori'] ?></h5>
                        <h2 class="fbold"><?= $dataMechanic['tittle'] ?></h2>
                        <div class="d-flex flex-column gap-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    <p><i class="fa fa-address-card icon-a-15"></i></p>
                                    <p><?= getAge($dataMechanic['made']) ?> Tahun</p>
                                </div>
                                <div class="d-flex gap-0">
                                    <p><i class="fa fa-map-marker icon-a-15"></i></p>
                                    <p><?= $dataMechanic['nama_domisili'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <p><i class="fa fa-id-badge icon-a-15"></i></p>
                                <p><?= $dataMechanic['nama_grade'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-0 w-100">
                        <h5 class="fbold">Detail</h5>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex flex-column gap-0">
                                <p class="f14 fbold"><i class="fa fa-wrench icon-a-15"></i> Keahlian</p>
                                <p class="f14"><?= str_replace(',', ', ', $dataMechanic['nama_keahlian']) ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0">
                                <p class="f14 fbold"><i class="fa fa-map icon-a-15"></i> Cakupan Area</p>
                                <p class="f14"><?= str_replace(',', ', ', str_replace(["KABUPATEN ", "KOTA "], "", $dataMechanic['cakupan_area'])) ?><?php if (isset($dataMechanic['cakupan_area_province'])) : ?><?= str_replace(',', ', ', $dataMechanic['cakupan_area_province']) ?>
                            <?php endif; ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0">
                                <p class="f14 fbold"><i class="fa fa-file-excel-o icon-a-15"></i> MCU terakhir</p>
                                <p class="f14"><?= getLastDate($dataMechanic['last_medical']) ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0">
                                <p class="f14 fbold"><i class="fa fa-file icon-a-15"></i> Pendidikan terakhir</p>
                                <p class="f14"><?= $dataMechanic['last_education'] ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0">
                                <p class="f14 fbold"><i class="fa fa-user icon-a-15"></i> Tersedia</p>
                                <p class="f14 fgreen"><?= getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] === 'Tersedia' ? getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] : getAvailabledate($dataMechanic['estimated_deliveryindent'])[1] . " " . "(" . getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] . ")" ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0">
                                <p class="f14 fbold"><i class="fa fa-file-text icon-a-15"></i> Periode Kontrak</p>
                                <?php foreach ($mechanic_variant as $i => $mv) : ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="f14"><?= $mv['name'] ?></p>
                                        <?php if ($mv['price'] != 0) { ?>
                                            <p class="f14 forange">Rp. <span class="uang"><?= $mv['price'] ?></span></p>
                                        <?php } else { ?>
                                            <p class="f14 forange">Nego</p>
                                        <?php } ?>
                                    </div>
                                <?php endforeach; ?>
                                <div class="d-flex flex-column gap-0">
                                    <p class="f14 fbold">Harga Belum Termasuk</p>
                                    <ul>
                                        <?php $price_desc = explode(PHP_EOL, $dataMechanic['price_description']);
                                        foreach ($price_desc as $pd) : ?>
                                            <li>
                                                <p class="f14"><?= ucwords($pd) ?></p>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-success radius-sm btn-sm f14">Jadwalkan Interview</a>
                        <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-warning radius-sm btn-sm f14">Info Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="spec-mechanic">
        <div class="container">
            <div class="col-sm-12 d-flex flex-column gap-2 p-x-0">
                <div class="card">
                    <div class="card-header">
                        <p class="fbold card-title f18 m-a-0">Informasi Tambahan</p>
                    </div>
                    <div class="card-body p-a-1 f14">
                        <p><?= $dataMechanic['description'] ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p class="fbold card-title f18 m-a-0">Pengalaman</p>
                    </div>
                    <div class="card-body p-a-1">
                        <div class="d-flex flex-column gap-3">
                            <?php foreach ($mechanic_exp as $exp): ?>
                                <div class="d-flex flex-column gap-1">
                                    <p class="fbold m-a-0"><?= $exp['nama_organisasi'] ?></p>
                                    <p class="f14"><?= $exp['start_year'] ?> - <?= $exp['end_year'] ?> (<?= $exp['year_exp'] ?> Tahun)</p>
                                    <ul class="f14">
                                        <?php foreach ($exp['positions'] as $i => $position) : ?>
                                            <li>
                                                <div class="d-flex flex-column gap-0">
                                                    <p class="fbold m-a-0"><?= $position ?></p>
                                                    <p><?= $exp['descriptions'][$i] ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p class="fbold card-title f18 m-a-0">Sertifikat, Pelatihan & Penghargaan</p>
                    </div>
                    <div class="card-body p-a-1">
                        <div class="d-flex flex-column gap-3">
                            <?php foreach ($mechanic_file as $file): ?>
                                <div class="d-flex flex-column gap-1">
                                    <p class="fbold m-a-0"><?= $file['name'] ?></p>
                                    <p class="f14 fbold">(<?= $file['caption'] ?>)</p>
                                    <ul>
                                        <li>
                                            <p class="f14"><?= $file['description'] ?></p>
                                        </li>
                                    </ul>
                                    <a href="/public/image/product/file/<?= $file['file']; ?>" class="btn btn-primary btn-sm" style="width: fit-content;" target="_blank">View Pdf</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p class="fbold card-title f18 m-a-0">Unit</p>
                    </div>
                    <div class="card-body p-a-1">
                        <div class="d-flex flex-column gap-1">
                            <?php foreach ($mechanic_service_expertise as $mse) : ?>
                                <div class="d-flex flex-column gap-1">
                                    <p class="fbold m-a-0"><?= $mse['name'] ?></p>
                                    <ul class="f14">
                                        <li>
                                            <p><?= $mse['description'] ?></p>
                                        </li>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p class="fbold card-title f18 m-a-0">Galeri</p>
                    </div>
                    <div class="card-body p-a-1 m-b-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <?php foreach ($mechanic_gallery as $index => $gallery) : ?>
                                <?php if ($index > 0 && $index % 2 == 0) : ?>
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-t-1">
                        <?php endif; ?>
                        <a href="#" data-toggle="modal" data-target="#gallery-mechanic-<?= $gallery['id'] ?>">
                            <img id="img-gallery-mobile" src="/public/image/galery/<?= $gallery['img'] ?>" alt="<?= $gallery['img'] ?>">
                        </a>
                    <?php endforeach; ?>
                        </div>

                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-success radius-sm btn-sm f14">Jadwalkan Interview</a>
                    <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-warning radius-sm btn-sm f14">Info Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php foreach ($mechanic_gallery as $gal) : ?>
    <div class="modal fade" id="gallery-mechanic-<?= $gal['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog-new d-flex flex-column gap-2">
            <div class="col-sm-12">
                <button type="button" class="btn btnnew btn-sm fwhite f24 radius-sm" style="opacity: 1 !important;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-sm-12 text-center">
                <img src="/public/image/product/file/<?= $gal['img'] ?>" alt="<?= $gal['img'] ?>" width="100%">
                <p class="fwhite f24"><?= $gal['img'] ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>