<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>

<!-- info card akun -->
<div class="row">
	<?php echo ($this->session->flashdata('message') == "") ? "" :
		'<div class="alert alert-warning">' .
		$this->session->flashdata('message') .
		'</div>'; ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="card bordercard" style="background: linear-gradient(to bottom right, #FF6348, #FFA502); position:relative;">
				<div class="circle">
				</div>
				<div class="circle1">
				</div>
				<div class="circle2">
				</div>
				<div class="card-body" style="padding: 20px; color:#fff;">
					<div class="col-xs-3" style="margin-left:-10px;">
						<a href="<?php echo base_url() ?>member/setting"><img src=" <?php echo base_url() ?>public/image/drum-pertamina.png" alt="Avatar" class="ava"></a>
					</div>
					<div class="row">
						<div class="col-xs-9" style="margin-left:-20px;">
							<h6 class=" font-weight-bold"><?php echo $namemember ?></h6>
							<strong class="label labelnew-<?php echo $levelmember ?>" style="padding:3px 10px;text-transform:capitalize;"><?php echo $levelmember ?></strong>
							<small class="fbold f12">TruCoin : <a href="<?php echo base_url() ?>member/saldo" style="color: yellow;"><strong><u><?php echo number_format($pointmember, 0, ',', '.') ?></u></strong></a></small>
						</div>
					</div>
					<a href="<?php echo base_url() ?>member/store" class="btn btnnewwhite" style="position: absolute;top:80%; right:33%;"><i class="fa fa-building"></i> Cek Toko <i class="fa fa-angle-right"></i><a>
				</div>
			</div>
		</div>
	</div>

	<!-- menu -->
	<div class="row">
		<div class="col-xs-12 m-t-2 text-center">
			<div class="row">
				<div class="col-xs-4">
					<a href="<?php echo base_url() ?>member/setting" class="btn btn-warning-outline btnmenu"><i class="fa fa-user"></i></a>
					<p class="f12 fbold">Pengaturan Akun</p>
				</div>
				<div class="col-xs-4">
					<a href="<?php echo base_url() ?>member/saldo"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-inr"></i></button></a>
					<p class="f12 fbold">TruCoin</p>
				</div>
				<div class="col-xs-4">
					<a href="<?php echo base_url() ?>member/bulk"><button class=" btn btn-warning-outline btnmenu"><i class="fa fa-files-o"></i></button></a>
					<p class="f12 fbold">RFQ</p>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-4">
					<a href="<?php echo base_url() ?>member/history"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-history"></i></button></a>
					<p class="f12 fbold">Riwayat Pesanan</p>
				</div>
				<div class="col-xs-4">
					<a href="<?php echo base_url() ?>member/testimoniallist"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-gratipay"></i></button></a>
					<p class="f12 fbold">Beri Testimoni</p>
				</div>
				<div class="col-xs-4">
					<a href="<?php echo base_url() ?>member/confirmation_list"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-credit-card"></i></button></a>
					<p class="f12 fbold">Konfirmasi Pembayaran</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Rekomendasi Produk -->
	<h5 class="fbold">Rekomendasi Produk
	</h5>
	<?php if ($listproduct) : ?>
		<div class="listproduct col-xs-12 m-t-1 p-a-0">
			<div class="row m-b-0">
				<?php foreach ($listproduct as $index => $key) : ?>
					<?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
					<?php echo ($index + 1) % 2 == 0 ? '</div><div class="row  m-b-0">' : '' ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>


<style>
	.borderalert {
		border-radius: 40px;
		font-size: 12px;
		color: #ff9900, 29%;
	}

	.bordercard {
		border-bottom-left-radius: 30px;
		border-bottom-right-radius: 30px;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
	}

	.btnmenu {
		width: 50px;
		height: 50px;
		border-radius: 20px;
		background-color: #fff;
		font-size: 25px;
		padding: 5px;
	}
</style>