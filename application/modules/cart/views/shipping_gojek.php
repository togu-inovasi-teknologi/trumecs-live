<?php $session = $this->session->all_userdata();
$sessionmember= $session["member"];
?>

<div class="shipping_gojek <?php echo ($this->agent->is_mobile()) ? "row" : "" ; ?>">
	<div class="col-md-12 text-center">
		<strong class="f22">Pengiriman Go-Jek</strong>
		<hr>
	</div>
	<div class="col-md-6">
		<img src="<?php echo base_url() ?>public/image/benner-trumecs-and-gojek.png" class="img-fluid">
	</div>
	<div class="col-md-6">
		<strong class="f16 fbold">Pilih Alamat</strong>
	<div class="col-md-12 control-group " id="accordion">
		<?php foreach ($address_shipping as $key ): ?>
			<?php if ($key["tipe"]=="gojek"): ?>
			<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading<?php echo $key["id"] ?>">
						<span class="panel-title keyid<?php echo $key["id"] ?>">
							<a  aria-controls="adddess<?php echo $key["id"] ?>" class="label label-success " data-toggle="collapse" data-parent="#accordion" href="#adddess<?php echo $key["id"] ?>" aria-expanded="false" >
								<?php $string = $key["address"];
								$jumlahstring = 67;
								if ($this->agent->is_mobile()) {
									$jumlahstring = 40;
								}
								?>
								- <?php echo substr(ucwords(strtolower($string)), 0,$jumlahstring) ;echo (strlen($string)>$jumlahstring)?"...":""; ?>
							</a> 
							<?php if (is_numeric($key["id"])): ?>
							<a href="#" ajaxurl="<?php echo base_url() ?>cart/deladdress_shipping" keyid="<?php echo $key["id"] ?>" class="label label-default dasjne">hapus</a>
						<?php endif ?>
					</span>
				</div>
				<div id="adddess<?php echo $key["id"] ?>" alamat="<?php echo  $key["address"] ?>" detail='<?php echo $key['detail_address'] ?>'  showin="#result_service<?php echo $key["id"] ?>" jarak="<?php echo $key["jarak"] ?>" kurir="1"  class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $key["id"] ?>">
						<div class="card card-block">
							Pesanan akan dikirim ke alamat : <?php echo ucwords(strtolower($string))?>
							<input type="hidden" class="form-control" name="address_shipping" value="<?php echo $key["id"] ?>" required>
							<input type="hidden" name="method" value="trumecs" required>	
							<input type="hidden" class="form-control" name="name" value="<?php echo $sessionmember["name"]; ?>" required>
							<input type="hidden" class="form-control" name="company" value="<?php echo $sessionmember["Company"]; ?>">
							<input type="hidden" class="form-control" name="phone" value="<?php echo $sessionmember["phone"]; ?>" required> 
							<input type="hidden" name="shipping_province" required value="<?php echo $key["id_province"] ?>">
							<input type="hidden" name="shipping_city" required value="<?php echo $key["id_regencies"] ?>">
							<input type="hidden" name="shipping_districts" required value="<?php echo $key["id_districts"] ?>">
							<input type="hidden" name="shipping_village" required value="<?php echo $key["id_villages"] ?>">
							<input type="hidden" name="shipping_kodepos" required value="<?php echo $key["kode_pos"] ?>">
							<input type="hidden" name="shipping_address" required value="<?php echo $key["address"] ?>">
							<div class="loader text-center">
								<span class="modal-text">Sedang Proses</span><br><img width="70px" src="<?php echo base_url() ?>public/image/252.gif">
							</div>
							<div id="result_service<?php echo $key["id"] ?>" class="resultmustdel"></div>
						</div>
				</div>
			</div>
			<?php endif ?>
		<?php endforeach ?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading<?php echo $key["id"] ?>">
				<span class="panel-title">
					<a class="label label-success" data-toggle="collapse" data-parent="#accordion" href="#addnew" aria-expanded="true" >
						+ Alamat Lain
					</a>
				</span>
			</div>
			<div id="addnew" class="panel-collapse collapse" role="tabpanel" >
				<input id="pac-input" class="col-md-6" placeholder="Masukkan Alamat Anda">
				<input class="" type="hidden" value="1" id="ojeknya">
				<div id="map"></div>
				<div class="areainfo alert alert-success">
					Isi terlebih dahulu Alamat Tujuan Pengiriman di area peta.
				</div>
			
				<div class="areabtn">
					<span id="getlocation" class="btn btn-orange">Dapatkan Biaya Kirim</span>
				</div>
				<div class="viewinfocost m-y-1">
				</div>
			</div>
		</div>

		</div>
	
	</div>
</div>

