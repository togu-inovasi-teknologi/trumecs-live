<?php foreach ($mechanic as $dataMechanic); ?>
<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-start">
            <h2 class="fbold">Detail Mekanik</h2>
            <div class="d-flex gap-1">
                <a href="<?= base_url(); ?>/backendmekanik/edit_mekanik/<?= $dataMechanic['id']; ?>" class="btn btn-warning radius-sm"><i class="fa fa-edit"></i> Edit</a>
                <a href="<?= base_url(); ?>/backendmekanik/deleteMekanik/<?= $dataMechanic['id']; ?>" class="btn btn-danger radius-sm"><i class="fa fa-trash"></i> Hapus</a>
            </div>
        </div>
        <hr class="m-a-0">
    </div>
    <div class="col-lg-12">
        <div class="row d-flex flex-column gap-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 sticky-member">
                        <div class="d-flex flex-column">
                            <img src="<?= base_url(); ?>public/image/product/<?= $dataMechanic['img']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row d-flex flex-column gap-2">
                            <div class="col-lg-12">
                                <h4 class="fbold">Informasi Expert</h4>
                            </div>
                            <div class="col-lg-12 d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Nama Mekanik</p>
                                    <p class="m-b-0"><?= $dataMechanic['tittle']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Pendidikan Terakhir</p>
                                    <p class="m-b-0"><?= $dataMechanic['last_education']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Tanggal Lahir</p>
                                    <p class="m-b-0"><?= date('d M Y', $dataMechanic['made']); ?>, <?= getAge($dataMechanic['made']); ?> Tahun</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Domisili</p>
                                    <p class="m-b-0"><?= $dataMechanic['nama_domisili']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">MCU Terakhir</p>
                                    <p class="m-b-0"><?= getLastDate($dataMechanic['last_medical']) ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Grade Mekanik</p>
                                    <p class="m-b-0"><?= $dataMechanic['nama_grade']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Kategori</p>
                                    <p class="m-b-0"><?= $dataMechanic['nama_kategori']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Keahlian</p>
                                    <p class="m-b-0"><?= str_replace(',', ', ', $dataMechanic['nama_keahlian']) ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <p class="fbold m-b-0">Cakupan Area</p>
                                    <div class="col-lg-6 p-a-0">
                                        <p class="m-b-0 text-right"><?= str_replace(',', ', ', $dataMechanic['cakupan_area']) ?>, <?= str_replace(',', ', ', $dataMechanic['cakupan_area_province']) ?> </p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Tersedia</p>
                                    <p class="fgreen"><?= getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] === 'Tersedia' ? getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] : getAvailabledate($dataMechanic['estimated_deliveryindent'])[1] . " " . "(" . getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] . ")" ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <p class="fbold m-b-0">Informasi Tambahan</p>
                                    <div class="col-lg-6 p-a-0">
                                        <p class="m-b-0 text-right"><?= $dataMechanic['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr class="m-a-0">
                            </div>
                            <div class="col-lg-12">
                                <h4 class="fbold">Informasi Kontrak</h4>
                            </div>
                            <div class="col-lg-12 d-flex flex-column gap-2">
                                <?php foreach ($mechanic_variant as $mv) : ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-b-0"><?= $mv['name'] ?></p>
                                        <?php if ($mv['price'] != 0) { ?>
                                            <p class="forange m-b-0">Rp. <span class="uang"><?= $mv['price'] ?> </span></p>
                                        <?php } else { ?>
                                            <p class="forange m-b-0">Nego</p>
                                        <?php } ?>
                                    </div>
                                <?php endforeach; ?>
                                <div class="d-flex justify-content-between align-items-start">
                                    <p class="fbold m-b-0">Harga tidak termasuk</p>
                                    <div class="col-lg-6 p-a-0 d-flex flex-column">
                                        <?php $price_desc = explode(PHP_EOL, $dataMechanic['price_description']); ?>
                                        <?php foreach ($price_desc as $pd) : ?>
                                            <p class="text-right m-b-0"><?= ucwords($pd) ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr class="m-a-0">
                            </div>
                            <div class="col-lg-12">
                                <h4 class="fbold">Pengalaman Kerja</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Perusahaan</th>
                                            <th>Lama Kerja</th>
                                            <th>Posisi</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mechanic_exp as $me) : ?>
                                            <tr>
                                                <td><?= $me['nama_organisasi']; ?></td>
                                                <td><?= $me['year_exp'] ?></td>
                                                <td>
                                                    <ul class="p-l-1">
                                                        <?php foreach ($me['positions'] as $position): ?>
                                                            <li><?= $position; ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="p-l-1">
                                                        <?php foreach ($me['descriptions'] as $desc): ?>
                                                            <li><?= $desc; ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <hr class="m-a-0">
                            </div>
                            <div class="col-lg-12">
                                <h4 class="fbold">Keahlian Unit</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Unit</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mechanic_service_expertise as $mse) : ?>

                                            <tr>
                                                <td><?= $mse['name']; ?></td>
                                                <td><?= $mse['description']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <hr class="m-a-0">
                            </div>
                            <div class="col-lg-12">
                                <h4 class="fbold">Sertifikat</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Sertifikat</th>
                                            <th>Tahun</th>
                                            <th>Deskripsi</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mechanic_file as $file): ?>
                                            <tr>
                                                <td><?= $file['name'] ?></td>
                                                <td><?= $file['caption'] ?></td>
                                                <td><?= $file['description'] ?></td>
                                                <td><a href="/public/image/product/file/<?= $file['file']; ?>" class="forange" target="_blank"><?= $file['file']; ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <hr class="m-a-0">
                            </div>
                            <div class="col-lg-12">
                                <h4 class="fbold">Galeri</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mechanic_gallery as $i => $gallery): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><img src="/public/image/galery/<?= $gallery['img']; ?>" alt="<?= $gallery['img']; ?>" width="300px"></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>