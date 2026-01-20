<div id="page_detail" class="my-3">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row g-5">
            <!-- Content Section -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 sticky-lg-top">
                    <div class="card-body p-5">
                        <h1 class="fw-bold text-primary display-6 mb-4"><?php echo $this->lang->line('judul_halaman_agen') ?></h1>
                        <p class="lead text-secondary fs-4 mb-5"><?php echo $this->lang->line('konten_judul_halaman_agen') ?></p>

                        <div class="border-start border-3 border-primary ps-4 mb-5">
                            <h2 class="fw-bold mb-3"><?php echo $this->lang->line('subjudul_halaman_agen') ?></h2>
                            <p class="text-muted fs-5 mb-0"><?php echo $this->lang->line('konten_subjudul_halaman_agen') ?></p>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-4">
                                    <div class="me-3">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_1') ?></h5>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start mb-4">
                                    <div class="me-3">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_2') ?></h5>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start mb-4">
                                    <div class="me-3">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_3') ?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-4">
                                    <div class="me-3">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_4') ?></h5>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start mb-4">
                                    <div class="me-3">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_5') ?></h5>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_6') ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill text-info fs-4 me-3"></i>
                                <p class="mb-0 text-muted">Semua benefit akan dijelaskan lebih detail setelah pendaftaran berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 sticky-top" style="top: 20px;">
                    <div class="card-body p-4 p-md-5">
                        <?php if ($this->session->flashdata('form_error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo $this->session->flashdata('form_error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-person-plus-fill text-primary fs-4"></i>
                            </div>
                            <h3 class="fw-bold"><?php echo $this->lang->line('judul_form_agen') ?></h3>
                            <p class="text-muted mb-0"><?php echo $this->lang->line('subjudul_form_agen') ?>:</p>
                        </div>

                        <form method="post" action="<?php echo base_url('agent/save'); ?>" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <!-- Nama -->
                                <div class="col-12">
                                    <label for="nama" class="form-label fw-bold">
                                        <i class="bi bi-person me-1"></i> <?php echo $this->lang->line('label_nama') ?>
                                    </label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>"
                                        value="<?php echo $user_data['nama'] ?>" required>
                                    <div class="invalid-feedback">Harap isi nama lengkap</div>
                                </div>

                                <!-- Telepon & Email -->
                                <div class="col-md-6">
                                    <label for="handphone" class="form-label fw-bold">
                                        <i class="bi bi-phone me-1"></i> <?php echo $this->lang->line('label_phone') ?>
                                    </label>
                                    <input type="tel" class="form-control" id="handphone" name="handphone"
                                        placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>"
                                        value="<?php echo $user_data['phone'] ?>" required>
                                    <div class="invalid-feedback">Harap isi nomor telepon</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">
                                        <i class="bi bi-envelope me-1"></i> <?php echo $this->lang->line('label_email') ?>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="<?php echo $this->lang->line('placeholder_input_email') ?>"
                                        value="<?php echo $user_data['email'] ?>" required>
                                    <div class="invalid-feedback">Harap isi email yang valid</div>
                                </div>

                                <!-- Deskripsi Pekerjaan -->
                                <div class="col-12">
                                    <label for="jobdesc" class="form-label fw-bold">
                                        <i class="bi bi-briefcase me-1"></i> <?php echo $this->lang->line('label_deskripsi_pekerjaan') ?>
                                    </label>
                                    <textarea class="form-control" id="jobdesc" name="jobdesc" rows="3"
                                        placeholder="<?php echo $this->lang->line('placeholder_input_deskripsi_pekerjaan') ?>" required></textarea>
                                    <div class="invalid-feedback">Harap isi deskripsi pekerjaan</div>
                                </div>

                                <!-- Lingkup Industri -->
                                <div class="col-12">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-building me-1"></i> <?php echo $this->lang->line('label_lingkup_industri') ?>
                                    </label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="pemerintah" id="scope_pemerintah">
                                                <label class="form-check-label" for="scope_pemerintah">
                                                    <?php echo $this->lang->line('label_scope_pemerintah') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="industri" id="scope_industri">
                                                <label class="form-check-label" for="scope_industri">
                                                    <?php echo $this->lang->line('label_scope_industri') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="pelabuhan" id="scope_pelabuhan">
                                                <label class="form-check-label" for="scope_pelabuhan">
                                                    <?php echo $this->lang->line('label_scope_pelabuhan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="kontraktor" id="scope_kontraktor">
                                                <label class="form-check-label" for="scope_kontraktor">
                                                    <?php echo $this->lang->line('label_scope_kontraktor') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="oilgas" id="scope_oilgas">
                                                <label class="form-check-label" for="scope_oilgas">
                                                    <?php echo $this->lang->line('label_scope_oilgas') ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="perkapalan" id="scope_perkapalan">
                                                <label class="form-check-label" for="scope_perkapalan">
                                                    <?php echo $this->lang->line('label_scope_perkapalan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="pertambangan" id="scope_pertambangan">
                                                <label class="form-check-label" for="scope_pertambangan">
                                                    <?php echo $this->lang->line('label_scope_pertambangan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="perkebunan" id="scope_perkebunan">
                                                <label class="form-check-label" for="scope_perkebunan">
                                                    <?php echo $this->lang->line('label_scope_perkebunan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="transportasi" id="scope_transportasi">
                                                <label class=" form-check-label" for="scope_transportasi">
                                                    <?php echo $this->lang->line('label_scope_transportasi') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_domisili') ?></strong></label>
                                    <div class="col-xs-12">
                                        <textarea class="form-control" name="domisili" placeholder="<?php echo $this->lang->line('placeholder_input_domisili') ?>" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_daerah_cakupan') ?></strong></label>
                                    <div class="col-xs-12">
                                        <textarea class="form-control" name="area" placeholder="<?php echo $this->lang->line('placeholder_input_daerah_cakupan') ?>" required></textarea>
                                    </div>
                                </div>

                                <!-- Produk Target -->
                                <div class="col-12 my-2">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-box-seam me-1"></i> <?php echo $this->lang->line('label_produk_target') ?>
                                    </label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="ban" id="product_ban">
                                                <label class="form-check-label" for="product_ban">
                                                    <?php echo $this->lang->line('label_produk_ban') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="aki" id="product_aki">
                                                <label class="form-check-label" for="product_aki">
                                                    <?php echo $this->lang->line('label_produk_aki') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="product[]" value="unit" id="product_unit">
                                                <label class="form-check-label" for="product_unit">
                                                    <?php echo $this->lang->line('label_produk_unit') ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="pelumas" id="product_pelumas">
                                                <label class="form-check-label" for="product_pelumas">
                                                    <?php echo $this->lang->line('label_produk_pelumas') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="sparepart" id="product_sparepart">
                                                <label class="form-check-label" for="product_sparepart">
                                                    <?php echo $this->lang->line('label_produk_sparepart') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_tanggal_bergabung') ?></strong></label>
                                    <div class="col-xs-12">
                                        <input class="form-control" name="active_date" required type="date">
                                    </div>
                                </div>
                                <div class="col-12 my-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="status" value="fulltime">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <?php echo $this->lang->line('label_status_fulltime') ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="status" value="parttime">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <?php echo $this->lang->line('label_status_parttime') ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" name="agreement" value="1" required> <?php echo $this->lang->line('label_confirmation') ?>
                                </div>
                                <div class="form-group text-center">
                                    <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                                        <i class="bi bi-send-check me-2"></i> <?php echo $this->lang->line('tombol_kirim') ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 {
        border-radius: 1rem !important;
    }

    .sticky-lg-top {
        position: sticky;
        z-index: 1020;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        padding: 0.6rem 0.75rem;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .alert {
        border-radius: 0.5rem;
        border: none;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .border-start {
        border-left-width: 4px !important;
    }
</style>

<script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>