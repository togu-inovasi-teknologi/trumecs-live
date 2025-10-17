<?php $session = $this->session->all_userdata();
$sessionmember= $session["member"];
?>
<div class="shipping_jne <?php echo ($this->agent->is_mobile()) ? "row" : "" ; ?>">
	<div class="col-md-12 text-center">
		<strong class="f22">Pengiriman JNE</strong>
		<hr>
	</div>
	<div class="col-md-6">
		<img src="<?php echo base_url() ?>public/image/benner-trumecs-and-jne.png" class="img-fluid">
	</div>
	<div class="col-md-6">
		
				    			
		<h2 class="f16 fbold">Isi Penerima Barang</h2>
		<div class="row">
			<div class="col-md-12">
				Nama<sup>*</sup>
				<input type="text" class="form-control" name="name" tocopy="tocopy" value="<?php echo $sessionmember["name"]; ?>" required>
			</div>
			<div class="col-md-6">
				Nama Perusahaan
				<input type="text" class="form-control" name="company" tocopy="tocopy" value="<?php echo $sessionmember["Company"]; ?>">
			</div>
			<div class="col-md-6">
				Nomor Telepon<sup>*</sup>
				<input type="text" class="form-control" name="phone" tocopy="tocopy" value="<?php echo $sessionmember["phone"]; ?>" required> 
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<strong class="f16 fbold">Pilih Alamat</strong>
			</div>
			<div class="col-md-12 control-group " id="accordion">
				<?php foreach ($address_shipping as $key ): ?>
				<?php if ($key["tipe"]=="jne" or $key["tipe"]=="trumecs"): ?>
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="heading<?php echo $key["id"] ?>">
				      <span class="panel-title keyid<?php echo $key["id"] ?>">
				        <a  aria-controls="adddess<?php echo $key["id"] ?>" class="label label-primary " data-toggle="collapse" data-parent="#accordion" href="#adddess<?php echo $key["id"] ?>" aria-expanded="false" >
				          <?php $string = $key["address"].", ".$key["nm_wilayah"];
				          	$jumlahstring = 72;
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
				    <div id="adddess<?php echo $key["id"] ?>" resultjne="#resultjne_addr<?php echo $key["id"] ?>" togetjne="<?php echo $key["id_districts"] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $key["id"] ?>">
						  <form class="formshipping" action="<?php echo base_url() ?>cart/setshipping_jne" method="POST">
						  <div class="card card-block">
						  	Pesanan akan dikirim ke alamat : <?php echo ucwords(strtolower($string))." - ".$key["kode_pos"] ?>
						  	<input type="hidden" class="form-control" name="address_shipping" value="<?php echo $key["id"] ?>" required>
							<input type="hidden" name="method" value="jne" required>	
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
						  	<div id="resultjne_addr<?php echo $key["id"] ?>" class="resultmustdel"></div>
						  </div>
						  </form>
				    </div>
				  </div>
				<?php endif ?>
				<?php endforeach ?>
				
				<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="heading<?php echo $key["id"] ?>">
				      <span class="panel-title">
				        <a class="label label-primary" data-toggle="collapse" data-parent="#accordion" href="#addnew" aria-expanded="true" >
				          + Alamat Lain
				        </a>
				      </span>
				    </div>
					<div id="addnew" class="panel-collapse collapse" role="tabpanel" >
						<form class="formshipping" action="<?php echo base_url() ?>cart/setshipping_jne" method="POST">
						<div class="hidden">
							<input type="hidden" name="address_shipping" value="new" required>
							<input type="hidden" name="method" value="jne" required>
							<input type="hidden" class="form-control" name="name" value="<?php echo $sessionmember["name"]; ?>" required>
							<input type="hidden" class="form-control" name="company" value="<?php echo $sessionmember["Company"]; ?>">
							<input type="hidden" class="form-control" name="phone" value="<?php echo $sessionmember["phone"]; ?>" required> 
						</div>
					  	<div class="card card-block">
					  			<div class="row">
									<div class="col-md-6">
										Provinsi<sup>*</sup>
										<select class="form-control " name="shipping_province" required id="<?php echo $sessionmember["shipping_idprovince"]; ?>">
										<option value="">--Pilih Provinsi--</option>
											<?php foreach ($provinces as $key): ?>
												<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-6">
										Kabupaten<sup>*</sup>
										<select class="form-control " name="shipping_city" required id="<?php echo $sessionmember["shipping_idcity"]; ?>">
											<option value="">--Pilih Kota--</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Kecamatan<sup>*</sup>
										<select class="form-control " name="shipping_districts" required id="<?php echo $sessionmember["shipping_iddistricts"]; ?>">
											<option value="">--Pilih Kecamatan--</option>
										</select>
									</div>
									<div class="col-md-6">
										Kelurahan<sup>*</sup>
										<select class="form-control  " name="shipping_village" required id="<?php echo $sessionmember["shipping_idvillage"]; ?>">
											<option value="">--Pilih Desa--</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Kodepos<sup>*</sup>
										<input type="text" class="form-control" name="shipping_kodepos" value="<?php echo $sessionmember["shipping_kodepos"]; ?>" required>
									</div>
									<div class="col-md-6">
										Alamat<sup>*</sup>
										<input type="text" class="form-control" name="shipping_address" value="<?php echo $sessionmember["shipping_address"]; ?>" required>
									</div>
								</div>
								<br>
								<div class="resultjneservice">Isi terlebih dahulu alamat dengan lengkap, untuk mendapatkan pilihan service JNE.</div>
					  	</div>
					  	</form>	
					</div>
				</div>
				
			</div>
		</div>
		
	</div>
</div>

