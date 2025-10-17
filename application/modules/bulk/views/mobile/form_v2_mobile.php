<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php $session = $this->session->all_userdata();
$sessionmember = array_key_exists('member', $session) ? $session['member'] : array('id' => null);
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb p-x-0">
            <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
            <li>RFQ</li>
        </ol>
    </div>
</div>
<section class="step" id="step">

    <div class="row p-a-1">
        <div class="col-lg-12 d-flex gap-3 card p-y-1 p-x-1 align-items-center">
            <img src="<?php echo site_url('public/image/list-icon.png'); ?>" width="30" height="30" />
            <div class="d-flex flex-column justify-content-start">
                <p class="fbold f12"><?= $this->lang->line('first_step_title', FALSE) ?></p>
                <p class="f10"><?= $this->lang->line('first_step_subtitle', FALSE) ?></p>
            </div>

        </div>

        <div class="col-lg-12 d-flex gap-3 card p-y-1 p-x-1 align-items-center">
            <img src=" <?php echo site_url('public/image/coffee-icon.png'); ?>" width="30" height="30" />
            <div class="d-flex flex-column justify-content-start">
                <p class="fbold f12"><?= $this->lang->line('second_step_title', FALSE) ?></p>
                <p class="f10"><?= $this->lang->line('second_step_subtitle', FALSE) ?></p>
            </div>

        </div>

        <div class="col-lg-12 d-flex gap-3 card p-y-1 p-x-1 align-items-center">
            <img src=" <?php echo site_url('public/image/envelope-icon.png'); ?>" width="30" height="30" />
            <div class="d-flex flex-column justify-content-start">
                <p class="fbold f12"><?= $this->lang->line('third_step_title', FALSE) ?></p>
                <p class="f10"><?= $this->lang->line('third_step_subtitle', FALSE) ?></p>
            </div>

        </div>
    </div>
</section>
<div class="row bg-content form-rfq d-flex flex-column gap-3 m-t-3">
    <div class="col-lg-12 m-t-1">
        <p class="f16 fbold"><?= $this->lang->line('rfq_form_label', FALSE) ?></p>
    </div>
    <div class="col-lg-12">
        <div class="row rfq-form-section d-flex flex-column gap-3">
            <div class="col-lg-12 d-flex flex-column gap-2">
                <p class="f14"><?= $this->lang->line('rfq_form_label_upload', FALSE) ?></p>
                <div class="pick">
                    <label class="col-lg rfq-file-pick p-a-1 text-center bg-white" for="file_rfq">
                        <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" width="50" />
                        <br />
                        <p class="f12 color-grey"><?= $this->lang->line('rfq_form_label_upload_provision', FALSE) ?></p>
                    </label>
                    <input type="file" name="file" id="file_rfq" class="d-none">
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <p class="f12"><?= $this->lang->line('or_label', FALSE) ?></p>
            </div>
            <div class="col-lg-12 d-flex flex-column gap-2">
                <p class="f14"><?= $this->lang->line('rfq_form_label_write', FALSE) ?></p>
                <textarea class="form-control item radius-none" name="item"
                    placeholder="<?= $this->lang->line('rfq_form_label_write', FALSE) ?>"></textarea>
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12 text-right">
                <button class="btn btn-sm btnnew f14" data-toggle="modal" data-target=".popup-send-request">Kirim
                    Permintaan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade popup-send-request" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin: 5% auto;">
        <div class="modal-content">
            <div class="row">
                <div class="product col-md-12"
                    style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                    <div class="get-contact-form">
                        <form action="<?php echo base_url('bulk/login'); ?>" method="post" id="form-login">

                            <div class="modal-body content-get-contact-receive-request d-flex flex-column gap-3">
                                <div class="title">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="modal-title f14 fbold">
                                        <?= $this->lang->line('modal_get_contact_title', FALSE) ?>
                                    </p>
                                </div>
                                <nav>
                                    <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist">
                                        <button class="nav-link nav-contact active f14" id="nav-whatsapp-tab"
                                            data-toggle="tab" data-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true"><i
                                                class="fa fa-fw fa-whatsapp"></i> Whatsapp</button>
                                        <button class="nav-link nav-contact f14" id="nav-email-tab" data-toggle="tab"
                                            data-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false"><i
                                                class="fa fa-fw fa-envelope"></i> Email</button>

                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-whatsapp-tab">
                                        <div class="d-flex flex-column gap-2 p-y-1">
                                            <div class="form-group">
                                                <label
                                                    for="name f14"><?= $this->lang->line('name_contact_label', FALSE) ?></label>
                                                <input type="text" class="form-control f14 radius-none" id="name"
                                                    name="name"
                                                    placeholder="<?= $this->lang->line('name_contact_placeholder', FALSE) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="whatsapp_number f14"><?= $this->lang->line('number_whatsapp_contact_label', FALSE) ?></label>
                                                <input type="number" name="number" class="form-control f14 radius-none"
                                                    id="whatsapp_number"
                                                    placeholder="<?= $this->lang->line('number_whatsapp_contact_placeholder', FALSE) ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-email-tab">
                                        <div class="d-flex flex-column gap-2 p-y-1">
                                            <div class="form-group">
                                                <label
                                                    for="name f14"><?= $this->lang->line('name_contact_label', FALSE) ?></label>
                                                <input type="text" name="name" class="form-control f14 radius-none"
                                                    id="name"
                                                    placeholder="<?= $this->lang->line('name_contact_placeholder', FALSE) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="email_address f14"><?= $this->lang->line('email_contact_label', FALSE) ?></label>
                                                <input type="email" name="email" class="form-control f14 radius-none"
                                                    id="email_address"
                                                    placeholder="<?= $this->lang->line('email_contact_placeholder', FALSE) ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit"
                                    class="btn btn-sm btnnew col-lg-4"><?php echo $this->lang->line('send_now_label') ?></button>
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