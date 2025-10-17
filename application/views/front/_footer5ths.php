<div class="col-lg-3 col-foot-info">
    <img alt="Jaminan Kualitas trumecs.com" src="<?php echo base_url(); ?>timthumb?w=250&src=<?php echo base_url(); ?>public/image/icon/icon-jaminan.png" class="img-responsive">
    <strong class="">Jaminan Kualitas</strong>
    <p class="">Setiap produk yang di jual berkualitas dan telah diuji</p>
</div>
<div class="col-lg-3 col-foot-info">
    <img alt="Kemudahan Pembayaran trumecs.com" src="<?php echo base_url(); ?>timthumb?w=250&src=<?php echo base_url(); ?>public/image/icon/icon-pembayaran.png" class="img-responsive">
    <strong class="">Kemudahan Pembayaran</strong>
    <p class="">Kemudahan melakukan pembayaran melalui bank-bank terkemuka di Indonesia</p>
</div>
<div class="col-lg-3 col-foot-info">
    <img alt="Diskon trumecs.com" src="<?php echo base_url(); ?>timthumb?w=250&src=<?php echo base_url(); ?>public/image/icon/icon-diskon.png" class="img-responsive">
    <strong class="">Diskon Menguntungkan</strong>
    <p class="">Selalu memberikan diskon yang menguntungkan di setiap bulan</p>
</div>
<div class="col-lg-3 col-foot-info">
    <img alt="Pengiriman trumecs.com" src="<?php echo base_url(); ?>timthumb?w=250&src=<?php echo base_url(); ?>public/image/icon/icon-pengiriman.png" class="img-responsive">
    <strong class="">Pengiriman Cepat</strong>
    <p class="">Memberikan pilihan pengiriman tercepat setiap pembelian</p>
</div>
<?php if (1 == 2) : ?>
    Sebenar nya menggunakan 5 colom... karena versi mobile apps nya belum jadi,,,, ya sudah,, ganti saja dengan 4 komo
    <div class="col-lg-5ths col-foot-info">
        <img alt="Akses Mobile trumecs.com" src="<?php echo base_url(); ?>timthumb?w=250&src=<?php echo base_url(); ?>public/image/icon/icon-smartphone.png" class="img-responsive">
        <strong class="">Akses Mobile</strong>
        <p class="">Nikmati aplikasi Trumecs di Android dan iOS </p>
    </div>
<?php endif ?>
<div class="col-lg-12 text-center">
    Pembayaran : <img class="<?php echo (!$this->agent->is_mobile()) ? "hidden-xs hidden-sm" : "img-fluid"; ?>" src="<?php echo base_url(); ?>public/image/icon/bank+debit.png" alt="Trumecs">
</div>