<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="row justify-content-center align-items-center py-4 py-lg-5 mx-0">
        <div class="col-12 text-center px-4">
            <h1 class="fw-bold mb-3 display-6">Jadilah Freelance Marketing <span class="text-primary">Trumecs Sekarang!</span></h1>
            <p class="text-muted mb-4">Bergabung dengan komunitas agen sukses, kerja fleksibel, hasil maksimal</p>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="row justify-content-center py-3 py-lg-4 mx-0">
        <div class="col-12 text-center mb-4 px-4">
            <h2 class="fw-bold mb-3">Solusi Penghasilan Tambahan</h2>
            <p class="text-muted">Raih pendapatan ekstra dengan cara mudah</p>
        </div>

        <!-- Side Income Card -->
        <div class="col-12 mb-4 px-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center bg-primary bg-opacity-10 rounded-circle p-4 mb-3">
                        <i class="bi bi-cash-stack fs-1 text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-2">Side Income</h3>
                    <p class="mb-3">Dapatkan penghasilan tambahan dengan mudah dan cepat sesuai waktu luang Anda</p>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="bg-primary bg-opacity-10 text-primary p-2">Fleksibel</span>
                        <span class="bg-primary bg-opacity-10 text-primary p-2">Cepat Cair</span>
                        <span class="bg-primary bg-opacity-10 text-primary p-2">Tanpa Modal</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Networking Card -->
        <div class="col-12 mb-4 px-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="d-inline-flex justify-content-center align-items-center bg-success bg-opacity-10 rounded-circle p-4 mb-3">
                        <i class="bi bi-people-fill fs-1 text-success"></i>
                    </div>
                    <h3 class="fw-bold mb-2">Jalin Relasi</h3>
                    <p class="mb-3">Bergabung bersama agen lainnya dan kembangkan jaringan profesional Anda</p>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="bg-success bg-opacity-10 text-success p-2">Networking</span>
                        <span class="bg-success bg-opacity-10 text-success p-2">Komunitas</span>
                        <span class="bg-success bg-opacity-10 text-success p-2">Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="row justify-content-center py-3 py-lg-4 mx-0">
        <div class="col-12 px-4">
            <div class="card border-0 bg-primary text-white rounded-4 shadow-lg">
                <div class="card-body p-4 text-center">
                    <h3 class="fw-bold mb-3">Mulai Sekarang!</h3>
                    <p class="mb-4 opacity-75">Gabung sekarang dan dapatkan akses ke berbagai manfaat</p>

                    <!-- Primary CTA Button -->
                    <a href="<?php echo base_url('agent/form') ?>" class="btn btn-light btn-lg w-100 py-3 fw-bold mb-4 rounded-3">
                        <i class="bi bi-person-plus-fill me-2"></i> Daftar Jadi Agen
                    </a>

                    <!-- Divider -->
                    <div class="d-flex align-items-center my-4">
                        <div class="flex-grow-1 border-top border-white border-opacity-50"></div>
                        <div class="px-3 text-white fw-bold">ATAU</div>
                        <div class="flex-grow-1 border-top border-white border-opacity-50"></div>
                    </div>

                    <!-- Contact Info -->
                    <p class="mb-3">Butuh bantuan? Hubungi kami</p>
                    <a href="tel:+6285176912338" class="btn btn-outline-light btn-lg w-100 py-2 mb-3 rounded-3">
                        <i class="bi bi-telephone-fill me-2"></i> +62 821 2266 8008
                    </a>

                    <!-- Alternative Contact -->
                    <a href="https://wa.me/+6285176912338?text=Halo,%20saya%20ingin%20bertanya%20tentang%20menjadi%20agen%20Trumecs"
                        class="btn btn-success btn-lg w-100 py-2 rounded-3">
                        <i class="bi bi-whatsapp me-2"></i> Chat via WhatsApp
                    </a>

                    <!-- Trust Badge -->
                    <div class="mt-4 pt-3 border-top border-white border-opacity-25">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-shield-check me-2"></i>
                            <span class="small">Pendaftaran Aman & Terverifikasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Contact Button (Mobile Only) -->
    <div class="floating-contact d-block d-lg-none">
        <a href="tel:+6285176912338"
            class="btn btn-primary rounded-circle shadow-lg p-3">
            <i class="bi bi-telephone-fill fs-4"></i>
        </a>
    </div>
</div>

<!-- Custom CSS untuk Mobile -->
<style>
    /* Utility Classes */
    .rounded-4 {
        border-radius: 1.5rem !important;
    }

    .rounded-3 {
        border-radius: 1rem !important;
    }

    .fs-1 {
        font-size: 2.5rem !important;
    }

    /* Floating Contact Button */
    .floating-contact {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    .floating-contact .btn {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Touch-friendly buttons */
    .btn-lg {
        padding: 1rem 1.5rem !important;
        font-size: 1.1rem !important;
    }

    /* Mobile-specific spacing */
    @media (max-width: 768px) {
        .display-6 {
            font-size: 2rem;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .fs-1 {
            font-size: 2rem !important;
        }
    }

    /* Better touch targets */
    a,
    button {
        min-height: 44px;
        min-width: 44px;
    }

    /* Improve readability on mobile */
    p {
        line-height: 1.6;
    }

    /* Card hover effects for devices with hover capability */
    @media (hover: hover) {
        .card {
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }
    }
</style>