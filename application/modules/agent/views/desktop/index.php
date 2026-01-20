<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row justify-content-center align-items-center min-vh-50">
        <div class="col-xxl-8 col-xl-10 col-lg-12 text-center">
            <h1 class="display-4 fw-bold mb-4">Jadilah Freelance Marketing <span class="text-gradient-primary">Trumecs Sekarang!</span></h1>
            <p class="fs-5 text-muted">Bergabunglah dengan ribuan agen sukses dan raih penghasilan tambahan tanpa batas</p>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-10 col-lg-12 text-center mb-5">
            <h2 class="fw-bold mb-4">Solusi Penghasilan Tambahan Anda</h2>
            <p class="fs-5 text-muted">Dua cara mudah untuk meningkatkan pendapatan Anda</p>
        </div>

        <div class="col-xxl-6 col-xl-5 col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-hover">
                <div class="card-body p-5 text-center">
                    <div class="icon-wrapper bg-primary-light rounded-circle d-inline-flex justify-content-center align-items-center mb-4" style="width: 100px; height: 100px;">
                        <i class="bi bi-cash-stack display-4 text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Side Income</h3>
                    <p class="fs-5">Dapatkan penghasilan tambahan dengan mudah dan cepat. Bekerja fleksibel sesuai waktu luang Anda.</p>
                    <div class="mt-4">
                        <span class="bg-primary-subtle text-primary p-2">Fleksibel</span>
                        <span class="bg-primary-subtle text-primary p-2 mx-2">Cepat Cair</span>
                        <span class="bg-primary-subtle text-primary p-2">Tanpa Modal</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-6 col-xl-5 col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-hover">
                <div class="card-body p-5 text-center">
                    <div class="icon-wrapper bg-success-light rounded-circle d-inline-flex justify-content-center align-items-center mb-4" style="width: 100px; height: 100px;">
                        <i class="bi bi-people-fill display-4 text-success"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Jalin Relasi</h3>
                    <p class="fs-5">Bergabung bersama ribuan agen lainnya dan kembangkan jaringan profesional Anda ke level berikutnya.</p>
                    <div class="mt-4">
                        <span class="bg-success-subtle text-success p-2">Networking</span>
                        <span class="bg-success-subtle text-success p-2 mx-2">Komunitas</span>
                        <span class="bg-success-subtle text-success p-2">Support System</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="row justify-content-center py-5">
        <div class="col-xxl-6 col-xl-8 col-lg-10 text-center">
            <div class="card border-0 bg-gradient-primary text-white shadow-lg">
                <div class="card-body p-5">
                    <h3 class="fw-bold mb-4">Mulai Perjalanan Marketing Anda</h3>
                    <p class="fs-5 mb-4 opacity-75">Bergabung sekarang dan dapatkan akses ke pelatihan, tools marketing, dan bonus bergabung!</p>

                    <a href="<?php echo base_url('agent/form') ?>" class="btn btn-light btn-lg px-5 py-3 fw-bold mb-4">
                        <i class="bi bi-person-plus-fill me-2"></i> Daftar Jadi Agen Sekarang!
                    </a>

                    <div class="separator my-4">
                        <span class="bg-white px-3 py-1 rounded-circle">ATAU</span>
                    </div>

                    <p class="mb-3 fs-5">Hubungi tim kami untuk konsultasi gratis</p>
                    <a href="tel:+6285176912338" class="btn btn-outline-light btn-lg px-4 py-2">
                        <i class="bi bi-telephone-fill me-2"></i> +62851 7691 2338
                    </a>

                    <div class="mt-4 pt-3 border-top border-white border-opacity-25">
                        <p class="small opacity-75 mb-0">
                            <i class="bi bi-shield-check me-1"></i> Proses pendaftaran aman & terverifikasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS untuk Desktop -->
<style>
    .min-vh-50 {
        min-height: 50vh;
    }

    .text-gradient-primary {
        background: linear-gradient(90deg, #fa8420, #fa9999);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .bg-success-light {
        background-color: rgba(32, 201, 151, 0.1);
    }

    .shadow-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #fa8420 0%, #fa9999 100%);
    }

    .separator {
        position: relative;
        text-align: center;
    }

    .separator::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        height: 1px;
        background: rgba(255, 255, 255, 0.3);
        z-index: 1;
    }

    .separator span {
        position: relative;
        z-index: 2;
        background: white;
        color: #0d6efd;
        font-weight: bold;
        padding: 5px 15px;
        border-radius: 50px;
    }
</style>