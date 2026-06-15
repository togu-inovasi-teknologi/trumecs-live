<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php $session = $this->session->all_userdata();
$sessionmember = array_key_exists('member', $session) ? $session['member'] : array('id' => null);
$this->load->language("partnership");
$this->load->language("form");
$this->load->language("rfq_lang");
?>

<section class="step my-3" id="step">
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h2>Beritahu kami apa yang anda butuhkan?</h2>
                <p>Isi Formulir dibawah ini</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('form_error') != null) : ?>
            <div class="row">
                <div class="col-12">
                    <?= $this->session->flashdata('form_error') ?>
                </div>
            </div>
        <?php endif; ?>

        <form class="form" id="form" action="<?php echo base_url('bulk/bulk_save'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-10">
                            <p class="fw-bold mb-2">Items</p>
                            <?php if (count($items) == 0) : ?>
                                <input type="hidden" class="form-control mb-2" name="items[]">
                                <input type="text" class="form-control form-autocomplete-item mb-2" name="item_names[]"
                                    placeholder="cari daftar item">
                            <?php else : ?>
                                <?php foreach ($items as $value) : ?>
                                    <input type="hidden" class="form-control mb-2" name="items[]" value="<?= $value['id'] ?>">
                                    <input type="text" class="form-control form-autocomplete-item mb-2"
                                        value="<?= $value['tittle'] ?>" name="item_names[]" placeholder="cari daftar item">
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-item-new"></div>
                        </div>
                        <div class="col-lg-2">
                            <p class="fw-bold mb-2">Quantity</p>
                            <?php if (count($items) == 0) : ?>
                                <input type="number" class="form-control mb-2" value="1" name="qty[]" placeholder="Quantity">
                            <?php else : ?>
                                <?php foreach ($items as $value) : ?>
                                    <input type="number" class="form-control mb-2" value="1" name="qty[]" placeholder="Quantity">
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-qty-new"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button class="btn btn-warning" id="new-items" type="button"><i class="bi bi-plus-circle"></i> Tambah Item</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="fw-bold mb-2">Item Tambahan</p>
                            <h6 class="text-muted">Ketik permintaan anda atau Tarik file kedalam field jika tidak menemukan item yang ada di trumecs</h6>
                            <div class="col-12 d-flex flex-column gap-1 align-items-end border p-2">
                                <input type="hidden" name="item_keyword">
                                <div class="input-element-container w-100" id="input-element-container">
                                    <textarea type="text" class="form-control border-0" id="uploader" name="text_rfq"
                                        style="height:100px;"
                                        placeholder="ingin menambahkan item lain? ketik permintaanmu disini"></textarea>
                                </div>
                                <div class="table table-striped mb-0" class="files" id="previews">
                                    <div id="template">
                                        <h6 class="error text-danger fw-bold" data-dz-errormessage></h6>
                                        <div class="file-upload">
                                            <div class="col-lg-6 px-0">
                                                <span class="name name-file ma-0" data-dz-name></span>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="progress progress-striped active ma-0" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success ma-0"
                                                        style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 d-flex justify-content-between align-items-center px-0">
                                                <span class="size d-flex" data-dz-size></span>
                                                <i data-dz-remove class="bi bi-trash text-danger pointer ma-0"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn shadow bg-white btn-upload" type="button"><i class="bi bi-upload"></i> Upload File</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="row mt-3">
                        <div class="col-12">
                            <h4 class="fw-bold">Info Perusahaan</h4>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="company" class="fw-bold"><?php echo $this->lang->line('label_perusahaan', FALSE); ?></label>
                                <input type="text" class="form-control" name="company" id="company"
                                    placeholder="<?= $this->lang->line('placeholder_input_perusahaan', FALSE) ?>"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_alamat_perusahaan', FALSE); ?></label>
                                <textarea class="form-control" name="company_address"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_alamat_perusahaan', FALSE); ?>"
                                    rows="6" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <select class="form-select mb-2" name="province" required>
                                    <option value="">-- <?php echo $this->lang->line('placeholder_select_provinsi', FALSE); ?> --</option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-select mb-2" name="regency" required>
                                    <option value="">-- <?php echo $this->lang->line('placeholder_select_kabupaten', FALSE); ?> --</option>
                                    <?php foreach ($regency->result() as $item) : ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-select mb-2" name="district" required>
                                    <option value="">-- <?php echo $this->lang->line('placeholder_select_kecamatan', FALSE); ?> --</option>
                                    <?php foreach ($district->result() as $item) : ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_phone_perusahaan', FALSE); ?></label>
                                <input class="form-control" name="company_phone"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_phone_perusahaan', FALSE); ?>"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_email_perusahaan', FALSE); ?></label>
                                <input class="form-control" name="company_email" type="email"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_email_perusahaan', FALSE); ?>"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row mt-3">
                        <div class="col-12">
                            <h4 class="fw-bold">PIC</h4>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_nama', FALSE); ?></label>
                                <input class="form-control" name="name"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_nama', FALSE); ?>"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_posisi', FALSE); ?></label>
                                <input type="text" class="form-control" name="position"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_posisi', FALSE); ?>"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_phone', FALSE); ?></label>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_phone', FALSE); ?>"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_email', FALSE); ?></label>
                                <input type="text" class="form-control" type="email" name="email"
                                    placeholder="<?php echo $this->lang->line('placeholder_input_email', FALSE); ?>"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label fw-bold"><?php echo $this->lang->line('label_kontak_via', FALSE); ?>:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="method" value="1" id="methodEmail" required>
                                    <label class="form-check-label" for="methodEmail">
                                        <?php echo $this->lang->line('placeholder_radio_email', FALSE); ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="method" value="4" id="methodWhatsapp" required>
                                    <label class="form-check-label" for="methodWhatsapp">
                                        <?php echo $this->lang->line('placeholder_radio_whatsapp', FALSE); ?>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agreement" value="1" id="agreement" required>
                                    <label class="form-check-label" for="agreement">
                                        <?php echo $this->lang->line('label_confirmation', FALSE); ?>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning w-100">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Modal Address -->
<div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modal-address-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-address-label">Cari Alamat Anda</h6>
                <button type="button" class="btn-close" id="modal-address-close" data-bs-dismiss="modal" aria-label="Close"></button>
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