<div class="container d-flex flex-column gap-3">
    <div class="row">
    <div class="col-lg-12 p-y-2">
        <h5 class="fbold">Tambah Kontak Baru</h5>
    </div>
    <div class="col-lg-12">
        <form method="POST" class="card p-a-2">
            <div class="row">
                <div class="col-lg-6">

                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="m-y-2 fbold">Informasi Perusahaan</h5>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center justify-content-end">
                            <button type="button" data-toggle="modal" data-target="#myModal"
                                class="m-y-2 fbold btn-search-company btn btn-sm btn-primary"> <i
                                    class="fa fa-fw fa-search"></i> Cari
                                Perusahaan</button>
                        </div>
                    </div>
                    <hr>
                    <!-- <div class="form-group">
                        <a href="<?= base_url('backendcompany/create') ?>" target="__blank" class="m-t-2"><i
                                class="fa fa-fw fa-plus"></i> Tambah Perusahaan Baru</a>
                    </div> -->
                    <div class="form-group form-inline">
                        <p>Bentuk Usaha</p>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="perusahaan" value="0" checked>
                                Badan
                            </label>
                        </div>
                        <div class="radio m-l-2">
                            <label>
                                <input type="radio" name="type" id="personal" value="1">
                                Perorangan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_name">Nama<span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" name="company_id">
                        <input type="text" class="form-control" value="<?= set_value('company_name') ?>"
                            id="company_name" name="company_name" placeholder="Nama" required>
                        <span class="text-danger"><?= form_error('company_name') ?></span>

                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" value="<?= set_value('phone') ?>"
                            name="phone" placeholder="Nomor Telepon" required>
                        <span class="text-danger"><?= form_error('phone') ?></span>

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" value="<?= set_value('email') ?>"
                            name="email" placeholder="Alamat Email" >
                        <span class="text-danger"><?= form_error('email') ?></span>

                    </div>
                    <div class="form-group">
                        <label for="npwp">Nomor NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" value="<?= set_value('npwp') ?>"
                            placeholder="Nomor NPWP" >
                        <span class="text-danger"><?= form_error('npwp') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" placeholder="Trumecs.com">

                    </div>
                    <div class="form-group">
                        <label for="industry">Bidang Industri</label>
                        <input type="text" class="form-control" id="industry" name="industry"
                            placeholder="Jenis Industri">
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--<h5 class="m-y-2 fbold">Alamat Penagihan</h5>
                    <hr>
                    <div class="form-group">
                        <label for="billing_country">Negara<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="billing_country"
                            value="<?= set_value('billing_country') ?>" name="billing_country" placeholder="Negara"
                            required>
                        <span class="text-danger"><?= form_error('billing_country') ?></span>

                    </div>
                    <div class="form-group">
                        <label for="billing_village">Keluarahan/Desa<span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" value="<?= set_value('billing_village_id') ?>"
                            id="billing_village_id" name="billing_village_id" placeholder="Kelurahan/Desa">
                        <input type="text" class="form-control" value="<?= set_value('billing_village') ?>"
                            id="billing_village" name="billing_village" placeholder="Kelurahan/Desa" required>
                        <span class="text-danger"><?= form_error('billing_village') ?></span>
                        <span class="text-danger"><?= form_error('billing_village_id') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="billing_code">Kode Pos<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?= set_value('billing_code') ?>"
                            id="billing_code" name="billing_code" placeholder="Kode Pos" required>
                        <span class="text-danger"><?= form_error('billing_code') ?></span>
                    </div>
                    <h5 class="m-y-2 fbold">Alamat Pengiriman</h5>
                    <hr>
                    <div class="form-group">
                        <label for="shipping_country">Negara<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?= set_value('shipping_country') ?>"
                            id="shipping_country" name="shipping_country" placeholder="Negara" required>
                        <span class="text-danger"><?= form_error('shipping_country') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="shipping_village">Keluarahan/Desa<span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" value="<?= set_value('shipping_village_id') ?>"
                            id="shipping_village_id" name="shipping_village_id" placeholder="Kelurahan/Desa">
                        <input type="text" class="form-control" value="<?= set_value('shipping_village') ?>"
                            id="shipping_village" name="shipping_village" placeholder="Kelurahan/Desa" requried>
                        <span class="text-danger"><?= form_error('shipping_village') ?></span>
                        <span class="text-danger"><?= form_error('shipping_village_id') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="shipping_code">Kode Pos<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="shipping_code"
                            value="<?= set_value('shipping_code') ?>" name="shipping_code" placeholder="Kode Pos"
                            required>
                        <span class="text-danger"><?= form_error('shipping_code') ?></span>
                    </div>-->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="m-y-2 fbold">Informasi Kontak</h5>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center justify-content-end">
                            <button type="button" data-toggle="modal" data-target="#user-modal"
                                class="m-y-2 fbold btn-search-member btn btn-sm btn-primary"> <i
                                    class="fa fa-fw fa-search"></i> Cari
                                Dari Member</button>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="contact_name">Nama<span class="text-danger">*</span></label>
                        <input type="hidden" name="member_id">
                        <input type="text" class="form-control" value="<?= set_value('contact_name') ?>"
                            id="contact_name" name="contact_name" placeholder="Nama" required>
                        <span class="text-danger"><?= form_error('contact_name') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="contact_phone">Telepon<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?= set_value('contact_phone') ?>"
                            id="contact_phone" name="contact_phone" placeholder="Nomor Telepon" required>
                        <span class="text-danger"><?= form_error('contact_phone') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="contact_email">Email</label>
                        <input type="text" class="form-control" value="<?= set_value('contact_email') ?>"
                            id="contact_email" name="contact_email" placeholder="Alamat Email">
                        <span class="text-danger"><?= form_error('contact_email') ?></span>

                    </div>
                    <div class="form-group">
                        <label for="dapartment">Department</label>
                        <input type="text" class="form-control" id="dapartment" name="dapartment"
                            placeholder="Department">

                    </div>
                    <div class="form-group">
                        <label for="position">Jabatan</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Jabatan">
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--<h5 class="m-y-2 fbold">Alamat Kontak</h5>
                    <hr>
                    <div class="form-group">
                        <label for="contact_country">Negara<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?= set_value('contact_country') ?>"
                            id="contact_country" name="contact_country" placeholder="Negara" required>
                        <span class="text-danger"><?= form_error('contact_country') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="village_contact">Keluarahan/Desa<span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" value="<?= set_value('village_contact_id') ?>"
                            id="village_contact_id" name="village_contact_id" placeholder="Kelurahan/Desa">
                        <input type="text" class="form-control" value="<?= set_value('village_contact') ?>"
                            id="village_contact" name="village_contact" placeholder="Kelurahan/Desa" required>
                        <span class="text-danger"><?= form_error('village_contact') ?></span>
                        <span class="text-danger"><?= form_error('village_contact_id') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="contact_code">Kode Pos<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?= set_value('contact_code') ?>"
                            id="contact_code" name="contact_code" placeholder="Kode Pos" required>
                        <span class="text-danger"><?= form_error('contact_code') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Note</label>
                        <textarea type="text" class="form-control" id="description" name="description"
                            placeholder="Deskripsi Kontak"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Detail Alamat</label>
                        <textarea type="text" class="form-control" id="address" name="address"
                            placeholder="Nama Jalan, No"></textarea>
                    </div>-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="submit" class="btn btn-orange">simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cari Perusahaan yang sudah terdaftar</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Email Perusahaan</th>
                            <th>Industri</th>
                            <th>Kepemilikan</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Search From Member -->
<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="user-modalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="user-modalLabel">Cari Kontak Dari Daftar Member</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepone</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>