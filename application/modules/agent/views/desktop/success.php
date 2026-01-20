<div class="container-fluid my-3">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5 text-center">
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <div class="d-inline-flex justify-content-center align-items-center bg-success bg-opacity-10 rounded-circle" style="width: 100px; height: 100px;">
                            <i class="bi bi-check-circle-fill text-success fs-1"></i>
                        </div>
                    </div>

                    <!-- Success Alert -->
                    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success fw-bold d-inline-flex align-items-center mb-4 px-4 py-3 rounded-3">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <span class="fs-5">Pendaftaran Berhasil!</span>
                    </div>

                    <!-- Thank You Message -->
                    <h2 class="fw-bold mb-4">Terima Kasih telah Mendaftar sebagai Agen Trumecs</h2>

                    <!-- Confirmation Message -->
                    <div class="text-start text-muted mb-5">
                        <p class="fs-5 mb-3">
                            <i class="bi bi-check-lg text-success me-2"></i>
                            Data Anda sudah kami terima dan akan segera kami review
                        </p>
                        <p class="fs-5 mb-3">
                            <i class="bi bi-clock text-primary me-2"></i>
                            Tim kami akan menghubungi Anda dalam waktu maksimal 2 x 24 jam
                        </p>
                        <p class="fs-5">
                            <i class="bi bi-envelope text-primary me-2"></i>
                            Pastikan email dan nomor telepon Anda aktif untuk menerima konfirmasi
                        </p>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-light rounded-3 p-4 mb-5">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-info-circle text-info me-2"></i>
                            Apa yang terjadi selanjutnya?
                        </h5>
                        <div class="row text-start">
                            <div class="col-md-6">
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="text-white bg-primary rounded-circle p-2">1</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Review Data</h6>
                                        <p class="small text-muted mb-0">Tim kami akan memverifikasi data pendaftaran Anda</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="text-white bg-primary rounded-circle p-2">2</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Kontak Awal</h6>
                                        <p class="small text-muted mb-0">Kami akan menghubungi Anda untuk konfirmasi awal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="text-white bg-primary rounded-circle p-2">3</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Briefing Online</h6>
                                        <p class="small text-muted mb-0">Anda akan mendapatkan penjelasan program agen</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="text-white bg-primary rounded-circle p-2">4</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Akses Sistem</h6>
                                        <p class="small text-muted mb-0">Anda akan mendapatkan akses ke sistem agen Trumecs</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="d-grid gap-3 d-md-flex justify-content-center">
                        <a class="btn btn-primary btn-lg px-5 py-3 fw-bold" href="<?php echo site_url('/'); ?>">
                            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-5 pt-4 border-top">
                        <p class="text-muted mb-2">Butuh bantuan lebih cepat?</p>
                        <a href="tel:+6285176912338" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-telephone me-1"></i> +6285176912338
                        </a>
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
    }

    .btn-outline-primary {
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        transform: translateY(-2px);
    }

    .alert-success {
        border: none;
    }

    .rounded-circle {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .bg-success.bg-opacity-10 {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }
</style>