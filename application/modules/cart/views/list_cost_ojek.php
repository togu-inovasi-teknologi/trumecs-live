<?php foreach ($delivery_cost as $key) {
	# code...
} 
$ses=$this->session->all_userdata();
#var_dump($ses["costshipping_by_deliveryonline"]);
$shippingname= !empty($ses["member"]["name"])?$ses["member"]["name"]:"";
$shippingphone= !empty($ses["member"]["phone"])?$ses["member"]["phone"]:"";
$shippingcompany= !empty($ses["member"]["Company"])?$ses["member"]["Company"]:"";
?>

<?php if ($key["distance"]>=$key["max_kilometer"]): ?>
<div class="alert alert-danger">
<strong>Maaf</strong>
	<p>Jarak pengiriman lebih <?php echo $key["max_kilometer"] ?>KM dari alamat market store trumecs.com di <a class="forange" target="_blank" href="https://www.google.co.id/maps/place/Trumecs/@-6.230972,106.9847767,17z/data=!4m2!3m1!1s0x2e698c15bda9cbef:0x76c72e744f4ccba8?hl=en">Jl. Jendral Sudirman, Bekasi.</a> </p>
	<p>Jarak ke <?php echo $key["alamat"] ?> adalah <?php echo $key["distance"] ?>KM.</p>
</div>
<?php elseif ($key["total_berat"]>=$key["max_berat"]): ?>
<div class="alert alert-danger">
<strong>Maaf</strong>
	<p>Berat Pesanan Anda (<?php echo $key["total_berat"] ?>kg) melebihi kapasitas , Berat kapasitas maksimal pengiriman harus kurang dari <?php echo $key["max_berat"] ?>kg.</p>
</div>
<?php else: ?>
<div class="alert alert-success">
	<strong>Informasi Biaya Pengiriman menggunakan <?php echo ($key["kurir"]) ?></strong>
	<hr>
	<div class="row">
		<div class="col-xs-4"><strong>Alamat Tujuan</strong></div>
		<div class="col-xs-8"><?php echo ($key["alamat"]) ?></div>
	</div>
	<div class="row">
		<div class="col-xs-4"><strong>Estimasi Jarak</strong></div>
		<div class="col-xs-8"><?php echo ($key["distance"]) ?> Km</div>
	</div>
	<div class="row">
		<div class="col-xs-4"><strong>Tarif</strong></div>
		<div class="col-xs-8">Rp.<?php echo number_format($key["tarif"]) ?></div>
	</div>
</div>
<hr>
<div class="submitearea">
<form action="<?php echo base_url() ?>cart/setsippingbygojek" method="POST">
	<input type="hidden" name="address_shipping" value="new" required>
	<input type="hidden" name="method" value="<?php echo strtolower(str_replace("-",'',$key["kurir"])) ?>" required>
	<div class="row m-b-1">
		<div class="col-xs-4"><strong>Nama Penerima</strong></div>
		<div class="col-xs-8"><input class="form-control" name="name" value="<?php echo $shippingname ?>" required></div>
	</div>
	<div class="row m-b-1">
		<div class="col-xs-4"><strong>Nomor Telpon</strong></div>
		<div class="col-xs-8"><input class="form-control" name="phone" value="<?php echo $shippingphone ?>" required></div>
	</div>
	<div class="row m-b-1">
		<div class="col-xs-4"><strong>Perusahaan</strong></div>
		<div class="col-xs-8"><input class="form-control" name="company" value="<?php echo $shippingcompany ?>"></div>
	</div>
	<div class="row m-b-1">
		<div class="col-xs-4"><strong>Alamat Tujuan</strong></div>
		<div class="col-xs-8"><input class="form-control" name="address" value="<?php echo ($key["alamat"])?>" disabled></div>
	</div>
	<div class="row">
		<div class="col-xs-4"><strong>Detail Lokasi</strong></div>
		<div class="col-xs-8"><textarea class="form-control" name="detailaddress" placeholder="isi detail lokasi, misal: Samping Pasar"><?php echo ($key["detail_address"])?></textarea></div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<button class="btn btn-orange proccessshow">Gunakan Pengiriman <?php echo ($key["kurir"]) ?></button>
		</div>
	</div>
</form>
</div>
<?php endif ?>