<div class="row">
    <div class="col-lg-12 title-desktop m-b-1">
        <h3 class="title-content">Buka Akun Bisnis</h3>
    </div>
</div>
<section id="sk-toko" class="sk-toko">
    <div class="row">
        <div class="col-lg-12 d-flex flex-column gap-3">
            <img src="<?php echo base_url() ?>public/banner/banner-home.png" alt="" style="width:100%;height:200px;">
            <div class="card">
                <div class="card-header">
                    <h4 class="fbold">Syarat & Ketentuan</h4>
                </div>
                <div class="card-body p-a-1 d-flex flex-column gap-3">
                    <p class="m-a-0">Beberapa persyaratan umum dan ketentuan yang mungkin diterapkan termasuk:</p>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Pendaftaran Akun:</p>
                        <p class="m-a-0">Biasanya, Anda perlu membuat akun atau mendaftar sebagai penjual di platform e-commerce tersebut.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Verifikasi Identitas:</p>
                        <p class="m-a-0">Beberapa platform e-commerce mungkin meminta informasi identifikasi diri dan bisnis, seperti KTP, NPWP, atau informasi lainnya untuk verifikasi.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Persyaratan Bisnis:</p>
                        <p class="m-a-0 ">Beberapa platform mungkin memiliki persyaratan khusus terkait jenis produk atau layanan yang dapat Anda jual. Pastikan bisnis Anda mematuhi persyaratan tersebut.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Syarat Penggunaan Platform:</p>
                        <p class="m-a-0">Setiap platform e-commerce biasanya memiliki syarat dan ketentuan penggunaan yang harus Anda terima sebelum membuat toko. Ini mungkin mencakup ketentuan pembayaran, biaya transaksi, dan kebijakan pengembalian barang.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Metode Pembayaran:</p>
                        <p class="m-a-0">Pastikan Anda memiliki rekening bank atau metode pembayaran yang diterima oleh platform e-commerce tersebut untuk menerima pembayaran dari pelanggan.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Informasi Produk:</p>
                        <p class="m-a-0">Anda mungkin diminta untuk menyediakan informasi lengkap dan akurat tentang produk atau layanan yang Anda jual, termasuk gambar produk, deskripsi, dan harga.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Ketentuan Pengiriman:</p>
                        <p class="m-a-0">Tentukan ketentuan pengiriman, termasuk biaya pengiriman, waktu pengiriman, dan area layanan pengiriman. Beberapa platform e-commerce memiliki integrasi dengan penyedia logistik tertentu.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Pajak dan Perpajakan:</p>
                        <p class="m-a-0">Pastikan Anda memahami kewajiban perpajakan terkait penjualan online. Beberapa platform dapat membantu dalam mengelola pajak penjualan.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Kebijakan Privasi dan Keamanan:</p>
                        <p class="m-a-0">Pastikan Anda memahami dan mematuhi kebijakan privasi dan keamanan platform. Ini melibatkan perlindungan data pelanggan dan informasi sensitif lainnya.</p>
                    </div>
                    <div class="d-flex flex-column gap-0">
                        <p class="m-a-0 fbold">Customer Support:</p>
                        <p class="m-a-0">Pastikan Anda dapat menyediakan layanan pelanggan yang baik, termasuk penanganan keluhan, pengembalian barang, dan pertanyaan pelanggan lainnya.</p>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" data-toggle="modal" data-target="#persetujuanSkToko" class="btn btnnew">Selanjutnya</button>
                    <!-- <a href="<?php echo base_url() ?>member" class="text-muted m-a-0">Kembali</a> -->
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="persetujuanSkToko" tabindex="-1" role="dialog" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title fbold">Persetujuan Membuat Toko</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning p-a-1">
                    <p class="f12">Dengan mengklik selanjutnya berarti anda telah setuju dengan syarat dan ketentuan diatas</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="<?= base_url() ?>member/formBuatToko" class="btn btnnew">Selanjutnya</a>
            </div>
        </div>
    </div>
</div>