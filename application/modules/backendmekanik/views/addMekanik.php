<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12">
        <h2 class="fbold">Tambah Mekanik</h2>
        <hr class="m-a-0">
    </div>
    <div class="col-lg-12">
        <div class="pv-form" hidden>
            <div class="d-flex gap-2 align-items-end">
                <div class="d-flex flex-column">
                    <label for="pv_name">Nama Kontrak</label>
                    <select name="pv_name[]" id="pv_name" class="form-control">
                        <option value="Harian">Harian</option>
                        <option value="Bulanan">Bulanan</option>
                        <option value="Jangka Waktu Tertentu">Jangka Waktu Tertentu</option>
                    </select>
                </div>
                <div class="d-flex flex-column">
                    <label for="pv_value">Harga Kontrak</label>
                    <input type="text" id="pv_value" class="form-control uang" placeholder="Harga" name="pv_value[]" value="0">
                </div>
                <div class=""><button type="button" class="btn btn-danger radius-sm del-pv"><i class="fa fa-trash">
                        </i></button></div>
            </div>
        </div>
        <div class="ee-form" hidden>
            <div class="d-flex gap-2 align-items-start">
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="ee_name_organization">Nama Perusahaan</label>
                    <input type="text" id="ee_name_organization" class="form-control" placeholder="Nama Perusahaan" name="ee_name_organization[]" autocomplete="off">
                    <input type="hidden" name="ee_id_organization[]" id="ee_id_organization" value="">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="ee_position">Posisi</label>
                    <input type="text" id="ee_position" class="form-control" placeholder="Posisi" name="ee_position[]">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="ee_year_start">Tahun Mulai</label>
                    <input type="text" id="ee_year_start" class="form-control" placeholder="Tahun Mulai" name="ee_year_start[]">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="ee_year_end">Tahun Akhir</label>
                    <input type="text" id="ee_year_end" class="form-control" placeholder="Tahun Akhir" name="ee_year_end[]">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="ee_description">Deskripsi</label>
                    <textarea type="text" id="ee_description" class="form-control" placeholder="Deskripsi" name="ee_description[]"></textarea>
                </div>
                <div class="m-t-2">
                    <button type="button" class="btn btn-danger radius-sm del-ee"><i class="fa fa-trash">
                        </i></button>
                </div>
            </div>
        </div>
        <div class="se-form" hidden>
            <div class="d-flex gap-2 align-items-start">
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="se_name">Nama Unit Keahlian</label>
                    <input type="text" id="se_name" class="form-control" placeholder="Nama Unit" name="se_name[]">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="se_description">Deskripsi Keahlian</label>
                    <textarea id="se_description" class="form-control" style="width: 700px;" name="se_description[]"></textarea>
                </div>
                <div class="m-t-2">
                    <button type="button" class="btn btn-danger radius-sm del-se"><i class="fa fa-trash">
                        </i></button>
                </div>
            </div>
        </div>
        <div class="sertificate-form" hidden>
            <div class="d-flex gap-2 align-items-start">
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="sertificate_name">Nama Sertifikat</label>
                    <input type="text" id="sertificate_name" class="form-control" placeholder="Nama Sertifikat" name="sertificate_name[]">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="sertificate_caption">Tahun Sertifikat</label>
                    <input type="number" id="sertificate_caption" class="form-control" placeholder="Tahun" name="sertificate_caption[]">
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="sertificate_file">File</label>
                    <input type="file" id="sertificate_file" class="form-control" placeholder="Nama Sertifikat" name="sertificate_file[]">
                    <p class="text-muted f12">Ext : PDF</p>
                </div>
                <div class="d-flex flex-column">
                    <label class="fbold m-b-0" for="sertificate_description">Deskripsi</label>
                    <textarea id="sertificate_description" class="form-control" style="width: 350px;" name="sertificate_description[]"></textarea>
                </div>
                <div class="m-t-2">
                    <button type="button" class="btn btn-danger radius-sm del-sertificate"><i class="fa fa-trash">
                        </i></button>
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
        <form action="<?= base_url(); ?>/backendmekanik/addMekanik" method="POST" enctype="multipart/form-data" id="form-add-mekanik">
            <div class="row d-flex flex-column gap-3">
                <div class="col-lg-12">
                    <h4 class="fbold">Informasi Expert</h4>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 d-flex flex-column gap-2">
                            <div class="d-flex flex-column">
                                <label for="img" class="fbold m-b-0">Foto Mekanik</label>
                                <input type="file" id="img" name="img" class="form-control img-input">
                                <p class="fbold">Image Preview</p>
                                <img class="img-fluid blah col-lg-6 col-lg-offset-3 m-t-1">
                            </div>

                        </div>
                        <div class="col-lg-8 d-flex flex-column gap-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="name">Nama Mekanik</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="last_education">Pendidikan Terakhir</label>
                                        <input type="text" class="form-control" id="last_education" name="last_education" placeholder="Gelar - Jurusan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="made">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="made" id="made" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="last_medical">MCU Terakhir</label>
                                        <input type="date" class="form-control" name="last_medical" id="last_medical" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="grade">Grade Mekanik</label>
                                        <select name="grade" id="grade" class="form-control" required>
                                            <?php foreach ($grade as $grd) : ?>
                                                <option value="<?= $grd['id']; ?>"><?= $grd['grade']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="tag">Keahlian</label>
                                        <select id="tag" class="product-tag form-control" name="tag[]" multiple="multiple" required>
                                            <?php foreach ($subKategori as $keahlian) : ?>
                                                <option value=" <?= $keahlian['id'] ?>"><?= $keahlian['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6"><label class="fbold m-b-0" for="area">Domisili</label>
                                    <select id="area" class="area form-control" name="area" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="service_coverage">Cakupan Area</label>
                                        <select id="service_coverage" class="service-coverage form-control" name="service_coverage[]" multiple="multiple" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column">
                                        <label class="fbold m-b-0" for="estimated_deliveryindent">Tersedia</label>
                                        <input type="date" style="height: 37.5px;" id="estimated_deliveryindent" class="form-control" name="estimated_deliveryindent" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <label class="fbold m-b-0" for="description">Informasi Tambahan</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12">
                    <h4 class="fbold">Informasi Kontrak</h4>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fbold">Kontrak Kerja</h5>
                                    <p class="add-pv fgreen pointer m-b-0"><i class="fa fa-plus"></i> Tambah Kontrak</p>
                                </div>
                                <div class="pv-card d-flex flex-column gap-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column">
                                <label class="fbold m-b-0" for="price_description">Deskripsi Keterangan Harga</label>
                                <textarea class="form-control" id="price_description" name="price_description" style="height:200px"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                    <h4 class="fbold">Pengalaman Kerja</h4>
                    <button type="button" class="btn btn-success btn-sm add-ee radius-sm">Tambah Pengalaman</button>
                </div>
                <div class="col-lg-12">
                    <div class="ee-card d-flex flex-column gap-2">
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                    <h4 class="fbold">Keahlian Unit</h4>
                    <button type="button" class="btn btn-success btn-sm add-se radius-sm">Tambah Keahlian</button>
                </div>
                <div class="col-lg-12">
                    <div class="se-card d-flex flex-column gap-2">
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="m-a-0">
                </div>
                <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                    <h4 class="fbold">Sertifikat</h4>
                    <button type="button" class="btn btn-success btn-sm add-sertificate radius-sm">Tambah Sertifikat</button>
                </div>
                <div class="col-lg-12">
                    <div class="sertificate-card d-flex flex-column gap-2">
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
                <!-- <div class="col-lg-12">
                    <label for="location">Select Location:</label>
                    <select id="location" class="select2" style="width: 100%;" multiple>
                    </select>
                </div> -->
                <div class="col-lg-12 d-flex gap-2 justify-content-end align-items-end">
                    <button type="button" id="reset" class="btn btn-primary radius-sm"><i class="fa fa-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success radius-sm">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>