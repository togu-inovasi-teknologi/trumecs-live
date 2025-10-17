<?php foreach ($rental as $dataRental); ?>
<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12">
        <h2 class="fbold">Edit Rental</h2>
        <hr class="m-a-0">
    </div>
    <div class="col-lg-12">
        <div class="pa-form" hidden>
            <div class="d-flex gap-2 align-items-end">
                <div class="d-flex flex-column">
                    <label for="pa_name">Nama Atribut</label>
                    <input type="text" id="pa_name" class="pa_name form-control" placeholder="Nama Attribute" name="pa_name[]" autocomplete="off">
                    <input type="hidden" name="pa_id[]" id="pa_id" value="">
                </div>
                <div class="d-flex flex-column">
                    <label for="pa_value">Nilai Atribut</label>
                    <input type="text" id="pa_value" class="form-control" placeholder="Nilai Attribute" name="pa_value[]" value="">
                </div>
                <div class=""><button type="button" class="btn btn-danger radius-sm del-pa"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
        <div class="gallery-form" hidden>
            <div class="d-flex gap-2 align-items-start">
                <div class="m-t-2">
                    <button type="button" class="btn btn-danger radius-sm del-gallery"><i class="fa fa-trash">
                        </i></button>
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="gallery_file">Foto / Gambar</label>
                    <div class="d-flex flex-column">
                        <input type="file" id="gallery_file" class="form-control img-input" name="gallery_file[]" style="width: fit-content; height:fit-content;">
                        <p class="fbold m-y-1">Image Preview Upload</p>
                        <img class="img-fluid blah col-lg-3 m-l-0">
                    </div>
                </div>
            </div>
        </div>
        <form action="<?= base_url(); ?>backendrental/editRental/<?= $dataRental['id'] ?>" method="POST" enctype="multipart/form-data" id="form-add-rental">
            <div class="row d-flex flex-column gap-3">
                <div class="col-lg-12">
                    <h4 class="fbold">Informasi Rental</h4>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 d-flex flex-column gap-2">
                            <div class="d-flex flex-column">
                                <label for="img" class="fbold m-b-0">Foto Rental</label>
                                <img class="img-fluid col-lg-6 col-lg-offset-3 m-y-1" src="/public/image/product/<?= $dataRental['img']; ?>">
                                <input type="hidden" name="img-before" value="<?= $dataRental['img']; ?>">
                                <input type="file" id="img" name="img" class="form-control img-input">
                                <p class="fbold">Image Preview</p>
                                <img class="img-fluid blah col-lg-6 col-lg-offset-3 m-t-1">
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex flex-column gap-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="name">Nama Unit Rental</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autocomplete="off" required value="<?= $dataRental['tittle'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?= $dataRental['stock'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="made">Tahun Produksi</label>
                                        <input style="height: 38px;" type="month" class="form-control" name="made" id="made" value="<?= date('Y-m', $dataRental['made']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="category">Kategori</label>
                                        <select name="category" id="category" class="form-control" required>
                                            <?php foreach ($subKategori as $i => $sub) : ?>
                                                <option value="<?= $sub['url']; ?>,<?= $sub['id']; ?>" <?= $dataRental['jenisproduct'] == $sub['url'] ? 'selected' : ''; ?>><?= $sub['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="fbold m-b-0" for="brand">Brand</label>
                                    <select id="brand" class="brand form-control" name="brand" required>
                                        <option value=""></option>
                                    </select>
                                    <small class="text-muted">Sebelumnya : <?= $dataRental['nama_brand'] ?></small>
                                </div>
                                <div class="col-lg-6"><label class="fbold m-b-0" for="area">Lokasi</label>
                                    <select id="area" class="area form-control" name="area" required>
                                        <option value=""></option>
                                    </select>
                                    <small class="text-muted">Sebelumnya : <?= $dataRental['lokasi'] ?></small>
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <label class="fbold m-b-0" for="description">Informasi Tambahan</label>
                                <textarea class="form-control" id="description" name="description" required><?= $dataRental['description'] ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="hour_meter">Hour Meter</label>
                                        <input type="text" class="form-control uang" id="hour_meter" name="hour_meter" placeholder="Hour Meter" value="<?= $dataRental['hour_meter'] ?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="rent_time_unit">Kontrak Unit</label>
                                        <select class="form-control" id="rent_time_unit" name="rent_time_unit" placeholder="Nama" required>
                                            <option value="0" <?= $dataRental['rent_time_unit'] == 0 ? 'selected' : ''; ?>>Jam</option>
                                            <option value="1" <?= $dataRental['rent_time_unit'] == 1 ? 'selected' : ''; ?>>Hari</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="minimum_rent">Minimum Rental</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="minimum_rent" name="minimum_rent" placeholder="" value="<?= $dataRental['minimum_rent'] ?>" required>
                                            <span class="input-group-addon" id="val_rent_time_unit"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="rent_price">Harga Rental</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control uang" id="rent_price" name="rent_price" placeholder="Rp" value="<?= $dataRental['rent_price'] ?>" required>
                                            <span class="input-group-addon" id="val_rent_time_unit1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <label class="fbold m-b-0" for="rent_description">Informasi Rental</label>
                                <textarea class="form-control" id="rent_description" name="rent_description" required><?= $dataRental['rent_description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                    <h4 class="fbold">Produk Atribut</h4>
                    <button type="button" class="btn btn-success btn-sm add-pa radius-sm">Tambah Atribut</button>
                </div>
                <div class="col-lg-12">
                    <div class="pa-card d-flex flex-column gap-2">
                        <?php if ($rental_attribute !== null) : ?>
                            <?php foreach ($rental_attribute as $pa) : ?>
                                <div class="pa-form">
                                    <div class="d-flex gap-2 align-items-end">
                                        <div class="d-flex flex-column">
                                            <label for="pa_name">Nama Atribut</label>
                                            <input type="text" id="pa_name" class="pa_name form-control" placeholder="Nama Attribute" name="pa_name[]" value="<?= $pa['nama_attribute']; ?>" autocomplete="off">
                                            <input type="hidden" name="pa_id[]" id="pa_id" value="<?= $pa['id_attribute']; ?>">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="pa_value">Nilai Atribut</label>
                                            <input type="text" id="pa_value" class="form-control" placeholder="Nilai Attribute" name="pa_value[]" value="<?= $pa['value']; ?>">
                                        </div>
                                        <div class=""><button type="button" class="btn btn-danger radius-sm del-pa"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                    <h4 class="fbold">Galeri</h4>
                    <button type="button" class="btn btn-success btn-sm add-gallery radius-sm">Tambah Galeri</button>
                </div>
                <div class="col-lg-12">
                    <div class="gallery-card d-flex flex-column gap-2">

                        <?php foreach ($rental_gallery as $i => $gallery) : ?>
                            <div class="gallery-form">
                                <div class="d-flex gap-2 align-items-start">
                                    <button type="button" class="btn btn-danger radius-sm del-gallery"><i class="fa fa-trash"></i></button>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex gap-1">
                                            <p><?= $i + 1 ?>. </p>
                                            <img src="/public/image/galery/<?= $gallery['img']; ?>" alt="<?= $gallery['img']; ?>" width="300px">
                                        </div>
                                        <input type="hidden" name="img-before-galery[]" value="<?= $gallery['img']; ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex gap-2 justify-content-end align-items-end">
                    <button type="submit" class="btn btn-primary radius-sm">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>