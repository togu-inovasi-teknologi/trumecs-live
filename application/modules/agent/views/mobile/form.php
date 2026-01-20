<div id="page_detail" class="pb-4">
    <div class="container-fluid px-3">
        <!-- Header Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h1 class="fw-bold text-primary mb-3"><?php echo $this->lang->line('judul_halaman_agen') ?></h1>
                <p class="text-secondary mb-0"><?php echo $this->lang->line('konten_judul_halaman_agen') ?></p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="border-start border-3 border-primary ps-3 mb-4">
                    <h2 class="fw-bold h5 mb-2"><?php echo $this->lang->line('subjudul_halaman_agen') ?></h2>
                    <p class="text-muted small mb-0"><?php echo $this->lang->line('konten_subjudul_halaman_agen') ?></p>
                </div>

                <div class="list-unstyled">
                    <div class="d-flex align-items-start mb-3">
                        <div class="me-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_1') ?></h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="me-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_2') ?></h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="me-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_3') ?></h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="me-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_4') ?></h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="me-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_5') ?></h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="me-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?php echo $this->lang->line('point_agen_6') ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">
                <?php if ($this->session->flashdata('form_error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo $this->session->flashdata('form_error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="text-center mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-plus-fill text-primary"></i>
                    </div>
                    <h3 class="fw-bold h5 mb-2"><?php echo $this->lang->line('judul_form_agen') ?></h3>
                    <p class="text-muted small mb-0"><?php echo $this->lang->line('subjudul_form_agen') ?>:</p>
                </div>

                <form method="post" action="<?php echo base_url('agent/save'); ?>" class="needs-validation" novalidate>
                    <!-- Basic Fields (Always Visible) -->
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama_mobile" class="form-label fw-bold small">
                            <i class="bi bi-person me-1"></i> <?php echo $this->lang->line('label_nama') ?>
                        </label>
                        <input type="text" class="form-control form-control-sm" id="nama_mobile" name="nama"
                            placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>"
                            value="<?php echo $user_data['nama'] ?>" required>
                        <div class="invalid-feedback small">Harap isi nama lengkap</div>
                    </div>

                    <!-- Telepon -->
                    <div class="mb-3">
                        <label for="handphone_mobile" class="form-label fw-bold small">
                            <i class="bi bi-phone me-1"></i> <?php echo $this->lang->line('label_phone') ?>
                        </label>
                        <input type="tel" class="form-control form-control-sm" id="handphone_mobile" name="handphone"
                            placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>"
                            value="<?php echo $user_data['phone'] ?>" required>
                        <div class="invalid-feedback small">Harap isi nomor telepon</div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email_mobile" class="form-label fw-bold small">
                            <i class="bi bi-envelope me-1"></i> <?php echo $this->lang->line('label_email') ?>
                        </label>
                        <input type="email" class="form-control form-control-sm" id="email_mobile" name="email"
                            placeholder="<?php echo $this->lang->line('placeholder_input_email') ?>"
                            value="<?php echo $user_data['email'] ?>" required>
                        <div class="invalid-feedback small">Harap isi email yang valid</div>
                    </div>

                    <!-- Accordion for Additional Fields -->
                    <div class="accordion accordion-flush mb-3" id="accordionMobile">
                        <!-- Deskripsi Pekerjaan -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-0 fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="bi bi-briefcase me-1"></i> <?php echo $this->lang->line('label_deskripsi_pekerjaan') ?>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionMobile">
                                <div class="accordion-body p-0 pt-2">
                                    <textarea class="form-control form-control-sm" name="jobdesc" rows="2"
                                        placeholder="<?php echo $this->lang->line('placeholder_input_deskripsi_pekerjaan') ?>" required></textarea>
                                    <div class="invalid-feedback small">Harap isi deskripsi pekerjaan</div>
                                </div>
                            </div>
                        </div>

                        <!-- Lingkup Industri -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-0 fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="bi bi-building me-1"></i> <?php echo $this->lang->line('label_lingkup_industri') ?>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionMobile">
                                <div class="accordion-body p-0 pt-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="pemerintah" id="scope_pemerintah_mobile">
                                                <label class="form-check-label small" for="scope_pemerintah_mobile">
                                                    <?php echo $this->lang->line('label_scope_pemerintah') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="industri" id="scope_industri_mobile">
                                                <label class="form-check-label small" for="scope_industri_mobile">
                                                    <?php echo $this->lang->line('label_scope_industri') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="pelabuhan" id="scope_pelabuhan_mobile">
                                                <label class="form-check-label small" for="scope_pelabuhan_mobile">
                                                    <?php echo $this->lang->line('label_scope_pelabuhan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="kontraktor" id="scope_kontraktor_mobile">
                                                <label class="form-check-label small" for="scope_kontraktor_mobile">
                                                    <?php echo $this->lang->line('label_scope_kontraktor') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="oilgas" id="scope_oilgas_mobile">
                                                <label class="form-check-label small" for="scope_oilgas_mobile">
                                                    <?php echo $this->lang->line('label_scope_oilgas') ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="perkapalan" id="scope_perkapalan_mobile">
                                                <label class="form-check-label small" for="scope_perkapalan_mobile">
                                                    <?php echo $this->lang->line('label_scope_perkapalan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="pertambangan" id="scope_pertambangan_mobile">
                                                <label class="form-check-label small" for="scope_pertambangan_mobile">
                                                    <?php echo $this->lang->line('label_scope_pertambangan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="perkebunan" id="scope_perkebunan_mobile">
                                                <label class="form-check-label small" for="scope_perkebunan_mobile">
                                                    <?php echo $this->lang->line('label_scope_perkebunan') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="scope[]" value="transportasi" id="scope_transportasi_mobile">
                                                <label class="form-check-label small" for="scope_transportasi_mobile">
                                                    <?php echo $this->lang->line('label_scope_transportasi') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domisili & Daerah Cakupan -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-0 fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="bi bi-geo-alt me-1"></i> Informasi Wilayah
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionMobile">
                                <div class="accordion-body p-0 pt-2">
                                    <!-- Domisili -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small"><?php echo $this->lang->line('label_domisili') ?></label>
                                        <textarea class="form-control form-control-sm" name="domisili" rows="2"
                                            placeholder="<?php echo $this->lang->line('placeholder_input_domisili') ?>" required></textarea>
                                        <div class="invalid-feedback small">Harap isi domisili</div>
                                    </div>

                                    <!-- Daerah Cakupan -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small"><?php echo $this->lang->line('label_daerah_cakupan') ?></label>
                                        <textarea class="form-control form-control-sm" name="area" rows="2"
                                            placeholder="<?php echo $this->lang->line('placeholder_input_daerah_cakupan') ?>" required></textarea>
                                        <div class="invalid-feedback small">Harap isi daerah cakupan</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Target -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-0 fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <i class="bi bi-box-seam me-1"></i> <?php echo $this->lang->line('label_produk_target') ?>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionMobile">
                                <div class="accordion-body p-0 pt-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="ban" id="product_ban_mobile">
                                                <label class="form-check-label small" for="product_ban_mobile">
                                                    <?php echo $this->lang->line('label_produk_ban') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="aki" id="product_aki_mobile">
                                                <label class="form-check-label small" for="product_aki_mobile">
                                                    <?php echo $this->lang->line('label_produk_aki') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="unit" id="product_unit_mobile">
                                                <label class="form-check-label small" for="product_unit_mobile">
                                                    <?php echo $this->lang->line('label_produk_unit') ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="pelumas" id="product_pelumas_mobile">
                                                <label class="form-check-label small" for="product_pelumas_mobile">
                                                    <?php echo $this->lang->line('label_produk_pelumas') ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="product[]" value="sparepart" id="product_sparepart_mobile">
                                                <label class="form-check-label small" for="product_sparepart_mobile">
                                                    <?php echo $this->lang->line('label_produk_sparepart') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Bergabung & Status -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-0 fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                    <i class="bi bi-calendar-check me-1"></i> Informasi Bergabung
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionMobile">
                                <div class="accordion-body p-0 pt-2">
                                    <!-- Tanggal Bergabung -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small"><?php echo $this->lang->line('label_tanggal_bergabung') ?></label>
                                        <input type="date" class="form-control form-control-sm" name="active_date" required>
                                        <div class="invalid-feedback small">Harap pilih tanggal bergabung</div>
                                    </div>

                                    <!-- Status Agent -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small"><?php echo $this->lang->line('label_status_agent') ?></label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="status_fulltime_mobile" value="fulltime" required>
                                                <label class="form-check-label small" for="status_fulltime_mobile">
                                                    <?php echo $this->lang->line('label_status_fulltime') ?>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="status_parttime_mobile" value="parttime">
                                                <label class="form-check-label small" for="status_parttime_mobile">
                                                    <?php echo $this->lang->line('label_status_parttime') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Agreement & reCAPTCHA (Always Visible) -->
                    <!-- Agreement -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreement_mobile" name="agreement" value="1" required>
                            <label class="form-check-label small" for="agreement_mobile">
                                <?php echo $this->lang->line('label_confirmation') ?>
                            </label>
                            <div class="invalid-feedback small">Anda harus menyetujui persyaratan</div>
                        </div>
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="mb-4 text-center">
                        <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                        <i class="bi bi-send-check me-2"></i> <?php echo $this->lang->line('tombol_kirim') ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- Info Footer -->
        <div class="text-center mt-4">
            <p class="text-muted small mb-1">
                <i class="bi bi-shield-check me-1"></i> Data Anda aman dan terjamin kerahasiaannya
            </p>
            <p class="text-muted small">
                <i class="bi bi-clock me-1"></i> Proses pendaftaran maksimal 1x24 jam
            </p>
        </div>
    </div>
</div>

<style>
    .rounded-4 {
        border-radius: 0.75rem !important;
    }

    .card {
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-control-sm {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
    }

    .form-control-sm:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
    }

    .accordion-button {
        font-size: 0.875rem;
        color: #0d6efd;
        background: none;
        min-height: 44px;
        display: flex;
        align-items: center;
    }

    .accordion-button:not(.collapsed) {
        color: #0d6efd;
        background: none;
        box-shadow: none;
    }

    .accordion-button:focus {
        border-color: none;
        box-shadow: none;
    }

    .accordion-body {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    }

    .form-check-input {
        width: 1rem;
        height: 1rem;
    }

    .form-check-label {
        font-size: 0.875rem;
    }

    .border-start {
        border-left-width: 3px !important;
    }

    /* Touch-friendly elements */
    button,
    input,
    select,
    textarea {
        min-height: 44px;
    }

    .form-check-input {
        min-height: auto;
    }

    /* Better spacing for mobile */
    .mb-3 {
        margin-bottom: 1rem !important;
    }

    /* Date input styling */
    input[type="date"] {
        padding: 0.5rem 0.75rem;
    }

    /* reCAPTCHA responsive */
    .g-recaptcha {
        transform: scale(0.85);
        transform-origin: 0 0;
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

        // Auto-close other accordions when one opens (mobile behavior)
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target')
                document.querySelectorAll('.accordion-collapse').forEach(collapse => {
                    if (collapse.id !== target.substring(1) && collapse.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(collapse).hide()
                    }
                })
            })
        })

        // Set today as default for date input
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('input[type="date"]');
            if (dateInput && !dateInput.value) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.value = today;
                dateInput.min = today; // Prevent past dates
            }
        });
    })()
</script>