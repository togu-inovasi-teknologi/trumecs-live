<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>
<div class="row member_page m-t-2">
	<div class="<?php if (!$this->agent->is_mobile()) : ?>row<?php endif ?>">
		<?php if (!$this->agent->is_mobile()) : ?>
			<div class="col-md-3 sidebar_member p-l-0">
				<div class="card p-a-1">
					<div class="row m-a-0 m-b-1"><strong class="f20 "><?php echo $namemember ?></strong></div>
					<div class="row m-a-0">
						<small class="pull-left label label-<?php echo $levelmember ?> p-x-1" style="padding:5px;text-transform:capitalize;color:#000"><?php echo $levelmember ?></small>
						<small class="pull-right">TRU Koin: <a href="<?php echo base_url() ?>member/saldo"><strong><?php echo number_format($pointmember, 0, ',', '.') ?></strong></a></small>
					</div>
					<hr class="row">
					<h6 class="fbold">Akun Pembeli</h6>
					<hr class="row">
					<style>
						ul.list-group>li {
							padding: 5px;
						}

						ul.list-group>li>a {
							color: #000;
						}
					</style>
					<ul class="list-group" style="list-style:none;">
						<li><a href="<?php echo base_url() ?>member">Profil</a></li>
						<li><a>Alamat</a></li>
						<li><a href="<?php echo base_url() ?>member/bulk">Bulk Shopping</a></li>
						<li><a href="<?php echo base_url() ?>member/history">Riwayat Pesanan</a></li>
						<li><a href="<?php echo base_url() ?>member/confirmation_list">Konfirmasi Pesanan</a></li>
						<li><a href="<?php echo base_url() ?>member/testimonialform">Testimonial</a></li>
						<li><a>Rekening Bank</a></li>
					</ul>
					<hr class="row">
					<h6 class="fbold">Akun Penjual</h6>
					<hr class="row">
					<ul class="list-group" style="list-style:none;">
						<li><a>Produk Saya</a></li>
						<li><a>Lokasi</a></li>
						<li><a>Pesanan</a></li>
						<li><a>Lelang</a></li>
						<li><a>Penilaian</a></li>
						<li><a>Catatan Penjual</a></li>
					</ul>
					<hr class="row">
					<ul class="list-group" style="list-style:none;">
						<li><a style="color:#ff0000" href="<?php echo site_url('member/logout'); ?>">Keluar </a></li>
					</ul>
					<div class="navigation">
						<!-- <a class="btn btn-default col-md-12 border-cyan" href="<?php echo base_url() ?>member/meeting">
						<strong>Meeting</strong>
					</a>
					<a class="btn btn-default col-md-12 border-cyan" href="<?php echo base_url() ?>member/penawaran">
						<strong>Penawaran</strong>
					</a>
					<a class="btn btn-default col-md-12 border-cyan" href="<?php echo base_url() ?>member/tender">
						<strong>Undangan Tender</strong>
					</a> -->
						<!-- <a class="btn btn-white col-md-12 m-t-1" href="<?php echo base_url() ?>member">
						<img src="<?php echo base_url() ?>public/image/icon/icon-account.png" class="icon-nav" alt="icon">
						<strong>Akun Pembeli</strong>
					</a>
					<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/saldo">
						<img src="<?php echo base_url() ?>public/image/icon/icon-setting.png" class="icon-nav" alt="icon">
						<strong>TRU Koin</strong>
					</a>
					<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/setting">
						<img src="<?php echo base_url() ?>public/image/icon/icon-setting.png" class="icon-nav" alt="icon">
						<strong>Pengaturan Akun</strong>
					</a>
					<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/history">
						<img src="<?php echo base_url() ?>public/image/icon/icon-history.png" class="icon-nav" alt="icon">
						<strong>Riwayat Pesanan</strong>
					</a>
					<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/confirmation_list">
						<img src="<?php echo base_url() ?>public/image/icon/icon-confirmation.png" class="icon-nav" alt="icon">
						<strong>Konfirmasi Pembayaran</strong>
					</a> -->
						<!--<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/claim">
						<img src="<?php echo base_url() ?>public/image/icon/icon-complaint.png" class="icon-nav" alt="icon">
						<strong>Klaim Return</strong>
					</a>
					<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/warranty">
						<img src="<?php echo base_url() ?>public/image/icon/icon-warranty.png" class="icon-nav" alt="icon">
						<strong>Klaim Garansi</strong>
					</a>-->
						<!-- <a class="btn btn-white col-md-12" href="<?php echo base_url() ?>member/testimonialform">
						<img src="<?php echo base_url() ?>public/image/icon/icon-testimoni.png" class="icon-nav" alt="icon">
						<strong>Beri Testimoni</strong>
					</a> -->
						<!--<a class="btn btn-white col-md-12" href="<?php echo base_url() ?>cart">
						<img src="<?php echo base_url() ?>public/image/icon/icon-chart.png" class="icon-nav" alt="icon">
						<strong>Keranjang Belanja</strong>
					</a>-->
						<!-- <a class="btn btn-danger col-md-12" href="<?php echo base_url('member/logout') ?>">
					<i class="fa fa-sign-out"></i>
						<strong>Keluar</strong>
					</a>
					<a class="btn btn-orange col-md-12 m-t-3" href="<?php echo base_url() ?>promo">
						<img src="<?php echo base_url() ?>public/image/icon/icon-diskon-white.png" class="icon-nav" alt="icon">
						<strong>Lihat Promo Saya</strong>
					</a> -->

						<!-- <li class="list-group-item"><a style="color:#ff3300" href="<?php echo base_url('member/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li> -->
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php endif ?>
		<div class="col-md-12 col-xs-12 content p-y-1" style="background:#fff;border-radius:5px;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
			<?php if ($this->agent->is_mobile()) : ?><div class="col-md-12 m-t-1 ">
					<div class="clearfix"></div>
				</div><?php endif ?>
			<?php $arraynone = (array('shipping_method' => "", 'shipping_province' => "", "shipping_city" => "")); ?>
			<?php if (in_array("", array_diff_assoc($sessionmember, $arraynone))) : ?>
				<div class="alert alert-warning borderalert">
					<strong>Perhatian!</strong> Akun anda belum lengkap, silahkan lengkapi akun Anda.
					<a href="<?php echo base_url() ?>member/setting" style="color: #ff9900;"><u>Lengkapi Sekarang</u></a>
				</div>
			<?php endif ?>
			<?php if (isset($contentmember)) : ?>
				<?php $this->load->view($contentmember) ?>
			<?php endif ?>
		</div>
	</div>
</div>

<style>
	.borderalert {
		border-radius: 40px;
		font-size: 12px;
		color: #ff9900, 29%;
	}
</style>