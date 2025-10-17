<?php $dataMechanic = $mechanic[0]; ?>
<div>
<div class="d-flex flex-column gap-3 m-b-1">
    <div class="container">
        <div class="col-lg-12 m-a-0 p-a-0">
            <ol class="breadcrumb m-a-0">
                <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
                <li><a class="forange" href="<?php echo base_url() ?>mechanic">Mechanic</a></li>
                <li><?= $dataMechanic['tittle'] ?></li>
            </ol>
        </div>
    </div>
    <section id="detail-mechanic">
        <div class="container">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5 sticky-member">
                        <img src="/public/image/product/<?= $dataMechanic['img'] ?>" alt="Muka Mekanik" width="100%">
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex flex-column gap-3">
                            <?php
                            $length = array();
                            $names = explode(' ', $dataMechanic['tittle']);
                            foreach($names as $key => $value):
                                $replacement = str_repeat('*', strlen($value) - 2);
                                $names[$key] = substr_replace($value, $replacement, 1, -1);
                            endforeach;
                            $name = implode(' ', $names);
                            ?>
                            <div class="d-flex flex-column gap-1">
                                <h5 class="fbold"><?= $dataMechanic['nama_kategori'] ?></h5>
                                <h4 class="fbold"><?= $name ?></h4>
                            </div>
                            <div class="d-flex flex-column gap-2 w-100">
                                <p class="fbold">Detail</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-id-badge icon-a-15"></i> Grade</p>
                                    <p><?= $dataMechanic['nama_grade'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-map-marker icon-a-15"></i> Domisili</p>
                                    <p><?= $dataMechanic['nama_domisili'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <p><i class="fa fa-map icon-a-15"></i> Cakupan Area</p>
                                    <div class="col-lg-6 p-a-0">
                                        <p class="text-right">
                                            <?= str_replace(',', ', ', str_replace(["KABUPATEN ", "KOTA "], "", $dataMechanic['cakupan_area'])) ?>
                                            <?php if (isset($dataMechanic['cakupan_area_province'])) : ?><?= str_replace(',', ', ', $dataMechanic['cakupan_area_province']) ?>
                                        <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-wrench icon-a-15"></i> Keahlian</p>
                                    <p><?= str_replace(',', ', ', $dataMechanic['nama_keahlian']) ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-address-card icon-a-15"></i> Usia</p>
                                    <p><?= getAge($dataMechanic['made']) ?> Tahun</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-file-excel-o icon-a-15"></i> MCU terakhir</p>
                                    <p><?= getLastDate($dataMechanic['last_medical']) ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-file icon-a-15"></i> Pendidikan terakhir</p>
                                    <p><?= $dataMechanic['last_education'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa fa-user icon-a-15"></i> Tersedia</p>
                                    <p class="fgreen"><?= getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] === 'Tersedia' ? getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] : getAvailabledate($dataMechanic['estimated_deliveryindent'])[1] . " " . "(" . getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] . ")" ?></p>
                                </div>
                                <!--
                                <div class="d-flex flex-column gap-1">
                                    <p><i class="fa fa-file-text icon-a-15"></i> Periode Kontrak</p>
                                    <?php foreach ($mechanic_variant as $mv) : ?>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p><?= $mv['name'] ?></p>
                                            <?php if ($mv['price'] != 0) { ?>
                                                <p class="forange">Rp. <span class="uang"><?= $mv['price'] ?> </span></p>
                                            <?php } else { ?>
                                                <p class="forange">Nego</p>
                                            <?php } ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="d-flex justify-content-between align-items-start">
                                        <p class="fbold">Harga tidak termasuk</p>
                                        <div class="col-lg-6 p-a-0 d-flex flex-column">
                                            <?php $price_desc = explode(PHP_EOL, $dataMechanic['price_description']); ?>
                                            <?php foreach ($price_desc as $pd) : ?>
                                                <p class="text-right"><?= ucwords($pd) ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-success radius-sm btn-md">Jadwalkan Interview</a>
                                <a href="https://wa.me/<?= platform_contact('whatsapp') ?>" target="_blank" class="btn btn-warning radius-sm btn-md">Info Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="spec-mechanic">
        <div class="container d-flex flex-column gap-2">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column gap-2 sticky-member">
                        <div class="card">
                            <div class="card-header">
                                <p class="fbold card-title f18 m-a-0">Pengalaman</p>
                            </div>
                            <div class="card-body p-a-1">
                                <div class="d-flex flex-column gap-3">
                                    <?php foreach ($mechanic_exp as $exp): ?>
                                        <div class="d-flex flex-column gap-1">
                                            <p class="fbold f18 m-a-0"><?= $exp['nama_organisasi'] ?></p>
                                            <p><?= $exp['start_year'] ?> - <?= $exp['end_year'] ?> (<?= $exp['year_exp'] ?> Tahun)</p>
                                            <ul>
                                                <?php foreach ($exp['positions'] as $index => $position): ?>
                                                    <li>
                                                        <div class="d-flex flex-column gap-0">
                                                            <p class="fbold m-a-0"><?= $position ?></p>
                                                            <p><?= $exp['descriptions'][$index] ?></p>
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
                                            <p class="fbold f18 m-a-0"><?= $file['name'] ?></p>
                                            <p><?= $file['caption'] ?></p>
                                            <ul class="m-b-0">
                                                <li>
                                                    <p><?= $file['description'] ?></p>
                                                </li>
                                            </ul>
                                            <a href="/public/image/product/file/<?= $file['file']; ?>" class="btn btn-primary btn-sm" style="width:fit-content;" target="_blank">View PDF</a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex flex-column gap-2 sticky-member">
                        <div class="card">
                            <div class="card-header">
                                <p class="fbold card-title f18 m-a-0">Informasi Tambahan</p>
                            </div>
                            <div class="card-body p-a-1">
                                <p><?= $dataMechanic['description'] ?></p>
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
                                            <p class="fbold f18 m-a-0"><?= $mse['name'] ?></p>
                                            <ul>
                                                <li>
                                                    <p><?= $mse['description'] ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <p class="fbold card-title f18 m-a-0">Galeri</p>
                    </div>
                    <div class="card-body p-a-1 m-b-0 ">
                        <div class="d-flex gap-4-5 align-items-center">
                            <?php foreach ($mechanic_gallery as $index => $gallery) : ?>
                                <?php if ($index > 0 && $index % 4 == 0) : ?>
                        </div>
                        <div class="d-flex gap-4-5 align-items-center m-t-2">
                        <?php endif; ?>
                        <a href="#" data-toggle="modal" data-target="#gallery-mechanic-<?= $gallery['id'] ?>">
                            <img id="img-gallery" src="/public/image/galery/<?= $gallery['img'] ?>" alt="<?= $gallery['img'] ?>">
                        </a>
                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php foreach ($mechanic_gallery as $gal) : ?>
    <div class="modal fade" id="gallery-mechanic-<?= $gal['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog-new">
            <div class="col-lg-12 d-flex flex-column gap-2 align-items-end m-r-2">
                <button type="button" class="btn btnnew radius-sm btn-sm" data-dismiss="modal" aria-label="Close">
                    <span class="f24">&times;</span>
                </button>
            </div>
            <div class="col-lg-12 d-flex flex-column gap-2 align-items-center m-t-2">
                <img src="/public/image/product/file/<?= $gal['img'] ?>" alt="<?= $gal['img'] ?>">
                <p class="fwhite f24"><?= $gal['img'] ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>