<div class="container-fluid px-3">
    <div class="row justify-content-center align-items-center min-vh-75 py-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 text-center">
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <div class="d-inline-flex justify-content-center align-items-center bg-success bg-opacity-10 rounded-circle" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-circle-fill text-success fs-2"></i>
                        </div>
                    </div>

                    <!-- Success Alert -->
                    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success fw-bold d-inline-flex align-items-center mb-4 px-3 py-2 rounded-3">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <span>Pendaftaran Berhasil!</span>
                    </div>

                    <!-- Thank You Message -->
                    <h3 class="fw-bold mb-3">Terima Kasih telah Mendaftar sebagai Agen Trumecs</h3>

                    <!-- Confirmation Message -->
                    <div class="text-center text-muted mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-lg text-success me-2 mt-1"></i>
                            <div class="text-start">
                                <p class="mb-0">Data Anda sudah kami terima dan akan segera kami review</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-clock text-primary me-2 mt-1"></i>
                            <div class="text-start">
                                <p class="mb-0">Tim kami akan menghubungi Anda dalam waktu maksimal 2 x 24 jam</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="bi bi-envelope text-primary me-2 mt-1"></i>
                            <div class="text-start">
                                <p class="mb-0">Pastikan email dan nomor telepon Anda aktif</p>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps (Accordion for Mobile) -->
                    <div class="accordion mb-4" id="nextStepsAccordion">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNextSteps">
                                    <i class="bi bi-info-circle text-info me-2"></i>
                                    Proses Selanjutnya
                                </button>
                            </h2>
                            <div id="collapseNextSteps" class="accordion-collapse collapse" data-bs-parent="#nextStepsAccordion">
                                <div class="accordion-body p-3 bg-light">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">1</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 small">Review Data</h6>
                                            <p class="small text-muted mb-0">Tim kami memverifikasi data pendaftaran Anda</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">2</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 small">Kontak Awal</h6>
                                            <p class="small text-muted mb-0">Kami menghubungi untuk konfirmasi awal</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">3</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 small">Briefing Online</h6>
                                            <p class="small text-muted mb-0">Penjelasan program agen Trumecs</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">4</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 small">Akses Sistem</h6>
                                            <p class="small text-muted mb-0">Anda mendapatkan akses sistem agen</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-3">
                        <!-- Primary Button -->
                        <a class="btn btn-primary btn-lg py-3 fw-bold" href="<?php echo site_url('/'); ?>">
                            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Quick Contact -->
                    <div class="mt-4 pt-4 border-top">
                        <p class="text-muted small mb-2">Butuh bantuan lebih cepat?</p>
                        <div class="d-grid">
                            <a href="tel:+6285176912338" class="btn btn-outline-secondary btn-sm py-2">
                                <i class="bi bi-telephone me-1"></i> Hubungi: +6285176912338
                            </a>
                        </div>
                        <div class="mt-2 d-grid">
                            <a href="https://wa.me/6285176912338?text=Halo,%20saya%20baru%20mendaftar%20sebagai%20agen%20Trumecs"
                                class="btn btn-success btn-sm py-2">
                                <i class="bi bi-whatsapp me-1"></i> Chat via WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-4 pt-3 border-top">
                        <p class="text-muted small mb-0">
                            <i class="bi bi-shield-check me-1"></i> Data Anda aman dan terjamin kerahasiaannya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .min-vh-75 {
        min-height: 75vh;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .card {
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
    }

    .btn-outline-primary {
        border-radius: 0.75rem;
    }

    .alert-success {
        border: none;
    }

    .accordion-button {
        border-radius: 0.5rem !important;
        font-size: 0.9rem;
        min-height: 44px;
    }

    .accordion-button:not(.collapsed) {
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.125);
    }

    .accordion-body {
        background-color: #f8f9fa;
        border-radius: 0 0 0.5rem 0.5rem;
    }

    /* Touch-friendly elements */
    button,
    a.btn {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-sm {
        min-height: 40px;
    }

    /* Better spacing for mobile */
    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    /* WhatsApp button styling */
    .btn-success {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        border: none;
    }
</style>

<script>
    // Auto-open accordion on mobile for better UX
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth < 768) {
            const accordion = document.getElementById('collapseNextSteps');
            if (accordion) {
                // Open accordion after a short delay for better user experience
                setTimeout(() => {
                    const bsCollapse = new bootstrap.Collapse(accordion, {
                        toggle: true
                    });
                }, 500);
            }
        }
    });
</script>