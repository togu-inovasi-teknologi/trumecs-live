<?php foreach ($rental as $dataRental); ?>
<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-start">
            <h2 class="fbold">Detail Rental</h2>
            <div class="d-flex gap-1">
                <a href="<?= base_url(); ?>/backendrental/edit_rental/<?= $dataRental['id']; ?>" class="btn btn-warning radius-sm"><i class="bi bi-pencil"></i> Edit</a>
                <a href="<?= base_url(); ?>/backendrental/deleteRental/<?= $dataRental['id']; ?>" class="btn btn-danger radius-sm"><i class="bi bi-trash"></i> Hapus</a>
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
                            <img src="<?= base_url(); ?>public/image/product/<?= $dataRental['img']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row d-flex flex-column gap-2">
                            <div class="col-lg-12">
                                <h4 class="fbold">Informasi Rental</h4>
                            </div>
                            <div class="col-lg-12 d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Nama Unit</p>
                                    <p class="m-b-0"><?= $dataRental['tittle']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Lokasi</p>
                                    <p class="m-b-0"><?= $dataRental['lokasi']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Kategori</p>
                                    <p class="m-b-0"><?= $dataRental['nama_category']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <p class="fbold m-b-0">Informasi Tambahan</p>
                                    <div class="col-lg-6 p-a-0">
                                        <p class="m-b-0 text-right"><?= $dataRental['description']; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Minimum Rental</p>
                                    <p class="m-b-0"><?= $dataRental['minimum_rent']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Kontrak Rental</p>
                                    <p class="m-b-0"><?= $dataRental['rent_time_unit']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Hour Meter</p>
                                    <p class="m-b-0 uang"><?= $dataRental['hour_meter']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fbold m-b-0">Harga Rental</p>
                                    <p class="m-b-0">Rp <span class="uang"><?= $dataRental['rent_price']; ?></span></p>
                                </div>

                                <div class="d-flex justify-content-between align-items-start">
                                    <p class="fbold m-b-0">Informasi Rental</p>
                                    <div class="col-lg-6 p-a-0">
                                        <p class="m-b-0 text-right"><?= $dataRental['rent_description']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr class="m-a-0">
                            </div>
                            <div class="col-lg-12">
                                <h4 class="fbold">Produk Attribute</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Attribute</th>
                                            <th>Nilai Attribute</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rental_attribute as $pa) : ?>
                                            <tr>
                                                <td><?= $pa['nama_attribute'] ?></td>
                                                <td><?= $pa['value'] ?></td>
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
                                        <?php foreach ($rental_gallery as $i => $gallery): ?>
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