<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php $session = $this->session->all_userdata();
$sessionmember = array_key_exists('member', $session) ? $session['member'] : array('id' => null);
?>
<div id="page_detail">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb p-x-0">
                <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
                <li>RFQ</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xs-7 p-a-0"
                style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                <!-- <img src="<?php echo site_url('public/image/poster-2.png'); ?>" width="100%" /> -->
                <img src="<?php echo site_url('public/image/poster-bulk-2.png'); ?>" width="100%" />
                <!-- <img src="<?php echo site_url('public/image/poster-bulk-big.png'); ?>" width="100%" /> -->
                <!-- <div class="col-xs-12 p-a-3 text-center">
                    <h1 class="fbold m-b-3" style="font-size:50px">Hemat waktu hingga dua kali lipat!</h1>
                    <p class="f22">Sejak menggunakan fitur ini saya bisa fokus ke hal-hal yang lebih esensial seperti nego harga dan pambayaran. Yang biasa saya butuh waktu 1 minggu untuk cari barang, kini saya hanya butuh 3 hari. Terimakasih Trumecs!</p>
                    <span style="color:#fa8420" class="fa fa-star fa-2x"></span>
                    <span style="color:#fa8420" class="fa fa-star fa-2x"></span>
                    <span style="color:#fa8420" class="fa fa-star fa-2x"></span>
                    <span style="color:#fa8420" class="fa fa-star fa-2x"></span>
                    <span style="color:#fa8420" class="fa fa-star-o fa-2x"></span>
                    <h5 class="fbold m-t-3">Suprhyanto - <i>Senior Purhasing Staff</i></h5>
                </div>
                 -->

            </div>

            <form action="<?php echo base_url('bulk/save'); ?>" method="POST" id="form-upload">
                <div class="col-lg-5 p-a-0 p-l-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="fbold text-center m-b-1">Cara Baru Berbelanja</h2>
                            <div class="card p-x-2 p-t-1">
                                <div class="row">
                                    <div class="col-lg-4 text-center">
                                        <img class="m-b-1" src="<?php echo site_url('public/image/list-icon.png'); ?>"
                                            width="50" />
                                        <p class="fbold f14 lsp">Unggah Daftar Belanja<br><span
                                                style="font-size:10px;">Daftar item yang diinginkan dalam format
                                                Excel.</span></p>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                        <img class="m-b-1"
                                            src=" <?php echo site_url('public/image/coffee-icon.png'); ?>" width="50" />
                                        <p class="fbold f14 lsp">Tunggu 2 - 3 hari<br><span style="font-size: 10px;">Tim
                                                Trumecs akan memproses daftar kamu.</span></p>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                        <img class="m-b-1"
                                            src=" <?php echo site_url('public/image/envelope-icon.png'); ?>"
                                            width="50" />
                                        <p class="fbold f14 lsp">Penawaran dikirimkan<br><span
                                                style="font-size: 10px;">Trumecs akan mengirimkan penawaran dari daftar
                                                barang yang sudah diunggah</span></p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-7" style="margin-top: 7px;">
                                                <p class="fbold f14 lsp">Unduh Format Excel</p>
                                            </div>
                                            <div class="col-lg-5">
                                                <a class="btn btn-success-outline f12 fbold pull-right"
                                                    href="<?php echo base_url() ?>bulk" style="border-radius: 20px;"><i
                                                        class="fa fa-download"></i> Excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="fbold text-center p-a-1">Kirim Sekarang</h2>
                    <div class="col-xs-12 p-t-1 "
                        style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px;border: 2px solid rgb(54, 138, 191)"
                        id="uploader" data-toggle="tooltip" data-placement="top" title="Klik untuk upload">
                        <div class="col-xs-12 p-a-1 text-center btn-upload"
                            style="border:3px dashed #ccc;cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" width="100" />
                            <br />
                            Unggah daftar belanjamu
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 p-y-1 p-x-0"></div>
                        <div class="table table-striped" class="files" id="previews">
                            <div id="template" class="file-row">
                                <!-- This is used as the file preview template -->
                                <div class="col-xs-8 p-a-0 m-b-1" style="display:inline-flex">
                                    <span class="name" data-dz-name
                                        style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width:100%"></span>
                                    &nbsp;-&nbsp; <span class="size pull-right" data-dz-size
                                        style="display:inline-flex"></span>
                                </div>
                                <div class="col-xs-3" style="padding-top:5px">
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                        aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                            data-dz-uploadprogress></div>
                                    </div>
                                </div>
                                <div class="col-xs-1 p-a-0">
                                    <button data-dz-remove class="pull-right btn btn-danger delete btn-sm"
                                        style="height:24px;width:24px;border-radius:50%;padding:1px 4px">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br />
                    <div class="col-xs-12 p-a-1"
                        style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                        <button type="button" data-toggle="modal" data-target=".popup_alamat"
                            class="btn fbold btn-sm pull-right btn-lingkaran"><i
                                class="bi bi-pencil forange"></i></button>
                        <h5>Alamat Pengiriman</h5>
                        <div class="text-muted">
                            <?php if ($sessionmember['id'] == null) : ?>
                                <span class="alamat-placeholder">Alamat tidak diisi</span>
                                <span class="alamat-nama"></span><span class="alamat-phone"></span><br />
                                <span class="alamat-jalan"></span><span class="alamat-kelurahan"></span><span
                                    class="alamat-kecamatan"></span><span class="alamat-kabupaten"></span><span
                                    class="alamat-provinsi"></span><br />
                                <span class="alamat-kodepos"></span>
                            <?php else : ?>
                                <span class="alamat-nama"><?php echo $user_data['nama'] ?></span> <span
                                    class="alamat-phone"><?php echo $user_data['phone'] ?></span><br />
                                <span class="alamat-jalan"><?php echo $sessionmember['address'] ?></span> <span
                                    class="alamat-kelurahan"><?php echo $sessionmember['nm_villages'] ?></span> <span
                                    class="alamat-kecamatan"><?php echo $sessionmember['nm_districts'] ?></span> <span
                                    class="alamat-kabupaten"><?php echo $sessionmember['nm_regencies'] ?><span> <span
                                            class="alamat-provinsi"><?php echo $sessionmember['nm_provinces'] ?></span><br />
                                        <span class="alamat-kodepos"><?php echo $sessionmember['shipping_kodepos'] ?></span>
                                    <?php endif; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="col-xs-12 p-a-1"
                        style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                        <!-- <button type="button" data-toggle="modal" data-target=".popup_catatan" class="btn btn-sm pull-right btn-lingkaran"><i class="bi bi-pencil forange"></i></button> -->
                        <h5>Catatan tambahan</h5>
                        <!-- <span class="text-catatan text-muted">Belum ada catatan</span> -->
                        <textarea class="form-control" name="bulk_note" style="width: 100%; height:150px;"></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 p-y-2 p-x-0 text-right">
                        <?php if ($sessionmember['id'] == null) :  ?>
                            <button type="button" data-toggle="modal" data-target=".popup_login"
                                class="btn btnhome btn-lg fbold col-xs-12">Masuk & Kirim</button>
                        <?php else : ?>
                            <div class="form-group text-center">
                                <div style="display:inline-block" class="g-recaptcha"
                                    data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                            </div>
                            <button type="submit" class="btn btnnew btn-lg fbold col-xs-12">Kirim Daftar Belanja</button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="modal fade popup_login" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin: 5% auto;">
        <div class="modal-content">
            <div class="row">
                <div class="product col-md-12"
                    style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                    <div class="login-form">
                        <form action="<?php echo base_url('bulk/login'); ?>" method="post" id="form-login">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h2 class="modal-title">Masuk</h2>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted">Silahkan masuk untuk melanjutkan</p>
                                <div class="form-group row">
                                    <label class="control-label col-xs-12"><strong>Email</strong></label>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" placeholder="Alamat email anda"
                                            name="email" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-xs-12"><strong>Password</strong></label>
                                    <div class="col-xs-12">
                                        <input type="password" class="form-control" placeholder="Password anda"
                                            name="password" required />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group text-center">
                                <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                            </div> -->
                            <div class="modal-footer">
                                <div class="form-group row">
                                    <div class="col-xs-12">
                                        <button type="submit"
                                            class="btn btnhome btn-lg fbold col-xs-12"><?php echo $this->lang->line('tombol_masuk') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row">
                            <div class="col-xs-12 text-center">
                                Belum punya akun? Silahkan <a href="#"
                                    class="btn-switch-register"><?php echo $this->lang->line('tombol_daftar') ?> </a>
                            </div>
                        </div>
                    </div>
                    <div class="register-form" style="display:none">
                        <form action="<?php echo base_url('bulk/signup'); ?>" method="post" id="form-signup">
                            <div class="modal-header">
                                <button class="close" aria-label="Close" data-dismiss="modal" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h2 class="modal-title">Daftar</h2>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted">Silahkan daftar untuk melanjutkan</p>
                                <div class="form-group row">
                                    <label class="control-label col-xs-12"><strong>Nama</strong></label>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" placeholder="Nama anda" name="name"
                                            required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-xs-12"><strong>Email</strong></label>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" placeholder="Alamat email anda"
                                            name="email" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-xs-12"><strong>No HP/WA</strong></label>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" placeholder="No HP/WA Anda" name="phone"
                                            required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-xs-12"><strong>Password</strong></label>
                                    <div class="col-xs-12">
                                        <input type="password" class="form-control" placeholder="Password anda"
                                            name="password" required />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group text-center">
                            <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div> -->
                            <div class="modal-footer">
                                <div class="form-group row">
                                    <div class="col-xs-12">
                                        <button type="submit"
                                            class="btn btnhome btn-lg fbold col-xs-12"><?php echo $this->lang->line('tombol_daftar') ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12 text-center">
                                    Sudah punya akun? Silahkan <a href="#"
                                        class="btn-switch-login"><?php echo $this->lang->line('tombol_masuk') ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade popup_catatan" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: 5% auto;">
        <div class="modal-content">
            <div class="row">
                <div class="product col-md-12"
                    style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title">Tambahkan Catatan</h2>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Silahkan tambahkan catatan untuk kami:</p>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Catatan Tambahan</strong></label>
                            <div class="col-xs-12">
                                <textarea form="uploader" class="form-control"
                                    placeholder="Catatan tambahan untuk kami pertimbangkan" name="bulk_note"
                                    rows="5"><?php //echo $sessionmember["shipping_address"]; 
                                                ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button class="btn btn-catatan btnhome btn-lg fbold col-xs-12">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade popup_alamat" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: 5% auto;">
        <div class="modal-content">
            <div class="row">
                <div class="product col-md-12"
                    style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                    <?php echo $this->session->flashdata('form_error'); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title">Form Belanja</h2>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted"><?php echo $this->lang->line('subjudul_form_principal') ?>:</p>
                        <!-- <form class="m-y-2" method="post" action="<?php echo base_url('principal/save'); ?>"> -->
                        <div class="form-group row">
                            <label
                                class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_nama') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" form="uploader" name="alamat_name"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>"
                                    value="<?php echo $user_data['nama'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_phone') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" form="uploader" name="alamat_phone"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>"
                                    value="<?php echo $user_data['phone'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_perusahaan') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" form="uploader" name="alamat_company"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_perusahaan') ?>"
                                    value="<?php echo $user_data['company'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Alamat Pengiriman</strong></label>
                            <div class="col-xs-12">
                                <textarea class="form-control" form="uploader" placeholder="Alamat pengiriman anda"
                                    name="shipping_address"><?php echo array_key_exists('shipping_address', $sessionmember) ? $sessionmember["shipping_address"] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12" form="uploader"><strong>Provinsi</strong></label>
                            <div class="col-xs-12">
                                <select class="form-control " name="shipping_province" form="uploader"
                                    id="<?php echo array_key_exists('shipping_idprovince', $sessionmember) ? $sessionmember["shipping_idprovince"] : 'shipping_province'; ?>">
                                    <option value="">--Pilih Provinsi--</option>
                                    <?php foreach ($provinsi->result() as $key) : ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12" form="uploader"><strong>Kabupaten</strong></label>
                            <div class="col-xs-12">
                                <select class="form-control " name="shipping_city" form="uploader"
                                    id="<?php echo array_key_exists('shipping_idcity', $sessionmember) ? $sessionmember["shipping_idcity"] : 'shipping_city'; ?>">
                                    <option value="">--Pilih Kabupaten--</option>
                                    <?php foreach ($regency->result() as $key) : ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12" form="uploader"><strong>Kecamatan</strong></label>
                            <div class="col-xs-12">
                                <select class="form-control " name="shipping_districts" form="uploader"
                                    id="<?php echo array_key_exists('shipping_iddistricts', $sessionmember) ? $sessionmember["shipping_iddistricts"] : 'shipping_district'; ?>">
                                    <option value="">--Pilih Kecamatan--</option>
                                    <?php foreach ($district->result() as $key) : ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12" form="uploader"><strong>Kelurahan</strong></label>
                            <div class="col-xs-12">
                                <select class="form-control" name="shipping_village" form="uploader"
                                    id="<?php echo array_key_exists('shipping_idvillages', $sessionmember) ? $sessionmember["shipping_idvillage"] : 'shipping_village'; ?>">
                                    <option value="">--Pilih Kelurahan--</option>
                                    <?php foreach ($regency->result() as $key) : ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Kodepos</strong></label>
                            <div class="col-xs-12">
                                <input type="text" form="uploader" class="form-control" placeholder="Kode pos anda"
                                    name="shipping_kodepos"
                                    value="<?php echo array_key_exists('shipping_kodepos', $sessionmember) ? $sessionmember["shipping_kodepos"] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button class="btn btn-alamat btnnew btn-lg fbold col-xs-12">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-lingkaran {
        background-color: transparent;
        color: orange;
        font-size: 20px;
    }
</style>