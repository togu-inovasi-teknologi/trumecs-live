<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>

<!-- info card akun -->
<div class="row">
	<div id="member_page">
		<div class="card col-xs-12 bordercard" style="background: linear-gradient(to bottom right, #FF6348, #FFA502);">
			<div class="circle">
			</div>
			<div class="circle1">
			</div>
			<div class="circle2">
			</div>
			<div class="card-body" style="padding: 20px; color:#fff;">
				<div class="col-xs-3" style="margin-left:-10px;">
					<a href="<?php echo base_url() ?>member/settingstore"><img src=" <?php echo base_url() ?>public/image/drum-pertamina.png" alt="Avatar" class="ava"></a>
				</div>
				<div class="row">
					<div class="col-xs-9" style="margin-left:-20px;">
						<h6 class=" font-weight-bold"><?php echo $namemember ?></h6>
						<small class="label labelnew-<?php echo $levelmember ?> p-x-1" style="padding:5px;text-transform:capitalize;"><?php echo $levelmember ?></small>
						<small class="fbold f12">TruCoin : <a href="<?php echo base_url() ?>member/saldo" style="color: yellow;"><strong><u><?php echo number_format($pointmember, 0, ',', '.') ?></u></strong></a></small>
					</div>
				</div>
			</div>
			<div class="col-xs-12 text-center" style="margin-bottom: -20px;">
				<div class="text-center">
					<a href="<?php echo base_url() ?>member"><button class="btn btnnew"><i class="fa fa-user"></i> Kembali ke Akun <i class="fa fa-angle-right"></i></button></a>
				</div>
			</div>
		</div>
	</div>

	<!-- menu -->

	<div class="col-xs-12 m-t-1 text-center">
		<div class="col-xs-4">
			<a href="<?php echo base_url() ?>member/settingstore"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-user"></i></button></a>
			<p class="f12 fbold">Pengaturan Toko</p>
		</div>
		<div class="col-xs-4">
			<a href="<?php echo base_url() ?>member/saldo"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-inr"></i></button></a>
			<p class="f12 fbold">TruCoin</p>
		</div>
		<div class="col-xs-4">
			<a href="<?php echo base_url() ?>member/bulk"><button class=" btn btn-warning-outline btnmenu"><i class="fa fa-archive"></i></button></a>
			<p class="f12 fbold">Produk</p>
		</div>
	</div>
	<div class="col-xs-12 text-center">
		<div class="col-xs-4">
			<a href="<?php echo base_url() ?>member/history"><button class="btn btn-warning-outline btnmenu"><i class="fa fa-tasks"></i></button></a>
			<p class="f12 fbold">Laporan Penjualan</p>
		</div>
	</div>
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

	.ava {
		width: 50px;
		height: 50px;
		border-radius: 50%;
		text-shadow: #000;
		margin-left: -20px;
	}

	.labelnew-silver {
		background-color: grey;
		border: #000;
		border-color: #000;
		color: white;
		font-size: 6px;
	}

	.card .circle {
		position: absolute;
		width: 100%;
		height: 100%;
		background: #F7941E;
		top: 0;
		left: 0;
		clip-path: circle(21.0% at 72% 0);
	}

	.card .circle1 {
		position: absolute;
		width: 100%;
		height: 100%;
		background: #F7941E;
		top: 0;
		left: 0;
		clip-path: circle(15% at 18% 100%);
	}

	.card .circle2 {
		position: absolute;
		width: 100%;
		height: 100%;
		background: #F7941E;
		top: 0;
		left: 0;
		clip-path: circle(14% at 12% 0);
	}
</style>