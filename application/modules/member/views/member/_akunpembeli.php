<?php 
$session = $this->session->all_userdata();
$sessionmember= $session["member"];
?>
<div class="row" >
	<div class="col-md-12">
		<strong class="f22">Akun Pembeli</strong>
		<hr>
	</div>
	<div class="infoakun" >
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Nama</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["name"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Email</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["email"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Nomor Telepon</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["phone"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Tanggal Lahir</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["date"] ?>/<?php echo $sessionmember["month"] ?>/<?php echo $sessionmember["year"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Perusahaan</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["Company"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Jabatan</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["position"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Email Perusahaan</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["company_email"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Telepon Perusahaan</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["company_phone"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Provinsi</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["nm_provinces"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Kota</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["nm_regencies"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Kecamatan</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["nm_districts"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Kelurahan</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["nm_villages"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Alamat</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["address"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 ">
			<div class="col-md-3 col-xs-4"><strong>Kode Pos</strong></div>
			<div class="col-md-9 col-xs-8"><strong>: <?php echo $sessionmember["kodepos"] ?></strong></div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>
		<div class="col-md-12 text-right">
			<a href="<?php echo base_url() ?>member/setting" class="btn  btn-orange">Edit</a>
		</div>
	</div>
</div>