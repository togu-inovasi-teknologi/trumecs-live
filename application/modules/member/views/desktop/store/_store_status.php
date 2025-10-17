<div class="row">
    <?php if($company == null) : ?>
    <div class="col-lg-12">
        <div class="alert alert-danger" role="alert">Belum Terverifikasi</div>
    </div>
    <div class="col-lg-12">
        <a href="<?= base_url('member/store/verification') ?>" class="btn btn-success">Verifikasi Sekarang!</a>
    </div>
    <?php else : ?>
    <?php if($company->status == 1) : ?>
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">Akun Anda Telah Di Verifikasi!</div>
    </div>
    <?php elseif($company->status == 2): ?>
    <div class="col-lg-12">
        <div class="alert alert-danger" role="alert">Akun Anda Gagal Diverifikasi!</div>
    </div>
    <div class="col-lg-12">
        <a href="<?= base_url('member/store/verification') ?>" class="btn btn-success">Verifikasi Ulang!</a>
    </div>
    <?php elseif($company->status == 0): ?>
    <div class="col-lg-12">
        <div class="alert alert-info" role="alert">Akun Anda Sedang Di Verifikasi</div>
        <p class="text-muted">Proses ini akan memerlukan waktu paling lambat 5 hari kerja dimulai dari awal pengajuan.
        </p>
    </div>
    <?php endif ?>
    <?php endif ?>
</div>