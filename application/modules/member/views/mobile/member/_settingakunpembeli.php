<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];

?>
<div class="row">
	<div class="col-xs-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="card col-xs-12 bordercard" style="background: linear-gradient(to bottom right, #FF6348, #FFA502);">
		<div class="circle">
		</div>
		<div class="circle1">
		</div>
		<div class="circle2">
		</div>
		<div class="card-body p-a-2">
			<div class="col-xs-12 text-center">
				<img src=" <?php echo base_url() ?>public/image/drum-pertamina.png" alt="Avatar" class="ava">
				<br><br>
				<p class="f14 fbold" style="color: #fff;"><u>Edit Foto Profil</u></p>
			</div>
		</div>
	</div>
	<div class="card col-xs-12 p-a-1">
		<div class="row">
			<form action="<?php echo base_url() ?>member/updatemember" method="post" class="settingmember">
				<div class="col-md-12">
					<label class="fbold">Nama</label>
					<input type="text" name="name" value="<?php echo $sessionmember["name"] ?>" class="form-control" placeholder="Nama Lengkap" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Email</label>
					<input type="email" name="email" value="<?php echo $sessionmember["email"] ?>" class="form-control" placeholder="Email" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Nomor Telepon</label>
					<input type="text" name="phone" value="<?php echo $sessionmember["phone"] ?>" class="form-control" placeholder="Telepon" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Tanggal Lahir</label>
					<div class="row">
						<div class="col-xs-4">
							<select class="form-control" name="date" isvalue="<?php echo $sessionmember["date"] ?>" required>
								<?php for ($t = 1; $t <= 31; $t++) {
									$selectdate = ($sessionmember["date"] != $t) ? "" : "";
									echo '<option value="' . $t . '" ' . $selectdate . '>' . $t . '</option>';
								} ?>
							</select>
						</div>
						<div class="col-xs-4">
							<select class="form-control" name="month" isvalue="<?php echo $sessionmember["month"] ?>" required>
								<?php for ($b = 1; $b <= 12; $b++) {
									$selectmonth = ($sessionmember["month"] != $b) ? "" : "";
									echo '<option value="' . $b . '" ' . $selectmonth . '>' . $b . '</option>';
								} ?>
							</select>
						</div>
						<div class="col-xs-4">
							<select class="form-control" name="year" isvalue="<?php echo $sessionmember["year"] ?>" required>
								<?php for ($y = 1945; $y <= date("Y"); $y++) {
									$selectyear = ($sessionmember["year"] != $y) ? "" : "";
									echo '<option value="' . $y . '" ' . $selectyear . '>' . $y . '</option>';
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Perusahaan</label>
					<input type="text" name="Company" value="<?php echo $sessionmember["Company"] ?>" class="form-control" placeholder="Perusahaan" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Jabatan</label>
					<input type="text" name="position" value="<?php echo $sessionmember["position"] ?>" class="form-control" placeholder="Position" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Email Perusahaan</label>
					<input type="text" name="company_email" value="<?php echo $sessionmember["company_email"] ?>" class="form-control" placeholder="Email Perusahaan" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Telepon Perusahaan</label>
					<input type="text" name="company_phone" value="<?php echo $sessionmember["company_phone"] ?>" class="form-control" placeholder="Telepin Perusahaan" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Provinsi</label>
					<select name="province" class="form-control" required id="<?php echo $sessionmember["provice"] ?>">
						<option value="">--Pilih Provinsi--</option>
						<?php foreach ($provinces as $key) : ?>
							<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Kabupaten</label>
					<select name="city" class="form-control" required id="<?php echo $sessionmember["city"] ?>">
						<option value="">--Pilih Kabupaten--</option>
					</select>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Kecamatan</label>
					<select name="districts" class="form-control" required id="<?php echo $sessionmember["districts"] ?>">
						<option value="">--Pilih Kecamatan--</option>
					</select>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Kelurahan</label>
					<select name="village" class="form-control" required id="<?php echo $sessionmember["village"] ?>">
						<option value="">--Pilih Kelurahan--</option>
					</select>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">RT/RW</label>
					<input type="text" name="rt_rw" value="<?php echo $sessionmember["rt_rw"] ?>" class="form-control" placeholder="RT/TW" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Alamat</label>
					<input type="text" name="address" value="<?php echo $sessionmember["address"] ?>" class="form-control" placeholder="Alamat" required>
				</div>
				<div class="col-md-12 m-t-1">
					<label class="fbold">Kode Pos</label>
					<input type="number" name="kodepos" value="<?php echo $sessionmember["kodepos"] ?>" class="form-control" placeholder="Kode Pos" required>
				</div>
				<div class="col-md-12 m-b-1 m-t-1">
					<label class="fbold">Atur Ulang Password</label>
					<br>
					<small>Kosongkan bila tidak ingin dirubah</small>
					<input type="text" name="passwordnew" class="form-control" placeholder="Password Baru">
					<input type="hidden" name="passwordold" value="<?php echo $sessionmember["password"] ?>" required>
				</div>
				<div class="col-md-12">
					<button id="one_click" href="<?php echo base_url() ?>member" class="btn form-control btnnew " modal-text="Data Anda sedang disimpan" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="jsontest"></div>
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