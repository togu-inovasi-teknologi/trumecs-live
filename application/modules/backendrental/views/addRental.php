<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12">
        <h2 class="fbold">Tambah Rental</h2>
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
                <button type="button" class="btn btn-danger radius-sm del-pa"><i class="fa fa-trash"></i></button>
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
        <form action="<?= base_url(); ?>backendrental/addRental" method="POST" enctype="multipart/form-data" id="form-add-rental">
            <div class="row d-flex flex-column gap-3">
                <div class="col-lg-12">
                    <h4 class="fbold">Informasi Rental</h4>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 d-flex flex-column gap-2">
                            <div class="d-flex flex-column">
                                <label for="img" class="fbold m-b-0">Foto Rental</label>
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
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="made">Tahun Produksi</label>
                                        <input style="height: 38px;" type="month" class="form-control" name="made" id="made" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="category">Kategori</label>
                                        <select name="category" id="category" class="form-control" required>
                                            <?php foreach ($subKategori as $i => $sub) : ?>
                                                <option value="<?= $sub['url']; ?>,<?= $sub['id']; ?>"><?= $sub['name']; ?></option>
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
                                </div>
                                <div class="col-lg-6"><label class="fbold m-b-0" for="area">Lokasi</label>
                                    <select id="area" class="area form-control" name="area" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <label class="fbold m-b-0" for="description">Informasi Tambahan</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="hour_meter">Hour Meter</label>
                                        <input type="number" class="form-control" id="hour_meter" name="hour_meter" placeholder="Hour Meter" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="rent_time_unit">Kontrak Unit</label>
                                        <select class="form-control" id="rent_time_unit" name="rent_time_unit" placeholder="Nama" required>
                                            <option value="0" selected>Jam</option>
                                            <option value="1">Hari</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="minimum_rent">Minimum Rental</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control uang" id="minimum_rent" name="minimum_rent" placeholder="" required>
                                            <span class="input-group-addon" id="val_rent_time_unit"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="rent_price">Harga Rental</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control uang" id="rent_price" name="rent_price" placeholder="Rp" required>
                                            <span class="input-group-addon" id="val_rent_time_unit1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <label class="fbold m-b-0" for="rent_description">Informasi Rental</label>
                                <textarea class="form-control" id="rent_description" name="rent_description" required></textarea>
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
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex gap-2 justify-content-end align-items-end">
                    <button type="button" id="reset" class="btn btn-primary radius-sm"><i class="fa fa-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success radius-sm">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>