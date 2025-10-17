<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php $session = $this->session->all_userdata();
$sessionmember = array_key_exists('member', $session) ? $session['member'] : array('id' => null);
$this->load->language("partnership");
$this->load->language("form");
$this->load->language("rfq_lang");
?>

<section class="step m-y-3" id="step">

    <div class="container">
        <div class="row m-y-3">
            <div class="col-lg-12">
                <h4>Beritahu kami apa yang anda butuhkan?</h4>
                <p>Isi Formulir dibawah ini</p>
            </div>
        </div>


        <?php if($this->session->flashdata('form_error') != null) : ?>

        <div class="row">
            <div class="col-lg-12">
                <?= $this->session->flashdata('form_error') ?>
            </div>
        </div>

        <?php endif; ?>

        <form class="form" id="form" action="<?php echo base_url('bulk/bulk_save'); ?>" method="POST" id="bulk_member"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xs-8">
                            <p class="fbold m-b-1">Items</p>
                            <?php if(count($items) == 0) : ?>
                            <input type="hidden" class="form-control m-b-1" name="items[]">
                            <input type="text" class="form-control form-autocomplete-item m-b-1" name="item_names[]"
                                placeholder="cari daftar item">
                            <?php else : ?>
                            <?php foreach($items as $value) : ?>
                            <input type="hidden" class="form-control m-b-1" name="items[]" value="<?= $value['id'] ?>">
                            <input type="text" class="form-control form-autocomplete-item m-b-1"
                                value="<?= $value['tittle'] ?>" name="item_names[]" placeholder="cari daftar item">
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="form-item-new">

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <p class="fbold m-b-1">Quantity</p>
                            <?php if(count($items) == 0) : ?>
                            <input type="number" class="form-control m-b-1" value="1" name="qty[]"
                                placeholder="Quantity">
                            <?php else : ?>
                            <?php foreach($items as $value) : ?>
                            <input type="number" class="form-control m-b-1" value="1" name="qty[]"
                                placeholder="Quantity">
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-qty-new">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btnnew" id="new-items"><i class="fa fa-fw fa-plus-circle"></i> Tambah
                                Item</button>
                        </div>
                    </div>
                    <div class="row m-y-3">
                        <div class="col-lg-12">
                            <p class="fbold m-b-1">Item Tambahan</p>
                            <h6 class="text-muted">Ketik permintaan anda atau Tarik file kedalam
                                field jika tidak menemukan item yang ada di trumecs</h6>
                            <div class="col-lg-12 d-flex flex-column gap-1 align-items-end p-a-1 border-sm">

                                <input type="hidden" name="item_keyword">
                                <div class="input-element-container w-100" id="input-element-container">
                                    <textarea type="text" class="form-control border-none" id="uploader" name="text_rfq"
                                        style="height:100px;"
                                        placeholder="ingin menambahkan item lain? ketik permintaanmu disini"></textarea>
                                </div>
                                <div class="table table-striped m-b-0" class="files" id="previews">
                                    <div id="template">
                                        <h6 class="error text-danger fbold" data-dz-errormessage>
                                        </h6>
                                        <div class="file-upload">
                                            <div class="col-lg-6 p-x-0">
                                                <span class="name name-file m-a-0" data-dz-name></span>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="progress progress-striped active m-a-0" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success m-a-0"
                                                        style="width:0%;" data-dz-uploadprogress>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 d-flex-sb align-items-center p-x-0">
                                                <span class="size d-flex" data-dz-size></span>
                                                <i data-dz-remove class="fa fa-remove pointer fred m-a-0"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn shadow bg-white btn-upload" type="button"><i
                                        class="fa fa-upload"></i>
                                    Upload File</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row m-t-3">
                        <div class="col-lg-12">
                            <h4 class="fbold">Info Perusahaan</h4>
                            <hr>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="company"
                                    class="fbold"><?php echo $this->lang->line('label_perusahaan', FALSE); ?></label>
                                <input type="text" class="form-control" name="company" id="company"
                                    placeholder="<?= $this->lang->line('placeholder_input_perusahaan', FALSE) ?>"
                                    required>
                            </div>

                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_alamat_perusahaan', FALSE); ?></strong></label>
                                <textarea class="form-control" name="company_address"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_alamat_perusahaan', FALSE); ?>"
                                    rows="6" required></textarea>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="province" placeholder="Nama Provinsi"
                                    style="margin-bottom:10px" required>
                                    <option>--
                                        <?php echo $this->lang->line('placeholder_select_provinsi', FALSE); ?> --
                                    </option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                    <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control" name="regency" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>--
                                        <?php echo $this->lang->line('placeholder_select_kabupaten', FALSE); ?> --
                                    </option>
                                    <?php foreach ($regency->result() as $item) : ?>
                                    <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control" name="district" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>--
                                        <?php echo $this->lang->line('placeholder_select_kecamatan', FALSE); ?> --
                                    </option>
                                    <?php foreach ($district->result() as $item) : ?>
                                    <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_phone_perusahaan', FALSE); ?></strong></label>
                                <input class="form-control" name="company_phone"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_phone_perusahaan', FALSE); ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_email_perusahaan', FALSE); ?></strong></label>
                                <input class="form-control" name="company_email" type="email"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_email_perusahaan', FALSE); ?>"
                                    required>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="row m-t-3">
                        <div class="col-lg-12">
                            <h4 class="fbold">PIC</h4>
                            <hr>
                        </div>
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_nama', FALSE); ?></strong></label>
                                <input class="form-control" name="name"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_nama', FALSE); ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_posisi', FALSE); ?></strong></label>
                                <input type="text" class="form-control" name="position"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_posisi', FALSE); ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_phone', FALSE); ?></strong></label>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_phone', FALSE); ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_email', FALSE); ?></strong></label>
                                <input type="text" class="form-control" type="email" name="email"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_email', FALSE); ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label"><strong><?php echo $this->lang->line('label_kontak_via', FALSE); ?>:</strong></label>
                                <br />
                                <label>
                                    <input type="radio" name="method" value="1" required>
                                    <?php echo $this->lang->line('placeholder_radio_email', FALSE); ?>
                                </label>
                                <br />
                                <label>
                                    <input type="radio" name="method" value="4" required>
                                    <?php echo $this->lang->line('placeholder_radio_whatsapp', FALSE); ?>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agreement" value="1" required>
                                <?php echo $this->lang->line('label_confirmation', FALSE); ?>
                            </div>
                            <div class="form-group">
                                <div style="display:inline-block" class="g-recaptcha"
                                    data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btnnew col-lg-12">Kirim</button>
                </div>
            </div>
        </form>

        <!-- <div class="row">
            <div class="col-lg-6">
                <section class="form" id="form">
                    <div class="row">
                        <form action="<?php echo base_url('bulk/bulk_save'); ?>" method="POST" id="bulk_member"
                            enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <h4>Items</h4>
                                <div class="autocomplete-selected tags-input" style="box-shadow: none; border:none">
                                    <ul id="items-autocomplete-selected">
                                        <?php foreach ($items as $key => $value) : ?>

                                        <li class="item-selected-rfq" data-id="<?= $value['id'] ?>">
                                            <input type="hidden" name="items[]" value="<?= $value['tittle'] ?>">
                                            <span><?= $value['tittle'] ?></span><button data-id="<?=$value['id'] ?>"
                                                class="delete-button"><i class="fa fw fa-close"></i>
                                            </button>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">

                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-t-1">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukan nama anda">
                                </div>
                                <div class="form-group m-t-1">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" id="no_telp"
                                        placeholder="Masukan nomor telepon anda">
                                </div>
                                <div class="form-group m-t-1">
                                    <label for="company_name">Nama Perusahaan</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name"
                                        placeholder="Masukan nomor telepon anda">
                                </div>
                                <div class="form-group m-t-1">
                                    <label for="autocomplete-input">Alamat Anda</label>
                                    <input type="hidden" name="village_id">
                                    <div id="location">


                                    </div>
                                    <button type="button" id="show-address-list" class="form-control"
                                        data-toggle="modal" data-target="#modal-address">Tambah
                                        Alamat</button>
                                </div>

                            </div>
                            <div class="col-lg-12 m-t-1">
                                <button type="submit" class="btn btnnew btn-block ">Kirim Daftar
                                    Belanja</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div> -->
    </div>
</section>

<style>
.btn-lingkaran {
    background-color: transparent;
    color: orange;
    font-size: 20px;
}
</style>

<div class="modal fade" id="modal-address" tabindex="-1" role="dialog" aria-labelledby="modal-address">
    <div class="modal-dialog modal-lg" style="margin: 5% auto; " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="modal-address-close" data-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="gridSystemModalLabel">Cari Alamat Anda</h6>
            </div>
            <div class="modal-body">
                <table class="display table table-hover datatable" id="datatable-address">
                    <thead>
                        <tr>
                            <th>Desa/Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten/Kota</th>
                            <th>Provinsi</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>