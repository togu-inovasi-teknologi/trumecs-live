<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];

?>
<div class="col-xs-12">
	<div class="row">
		<div class="col-xs-12">
			<?php echo ($this->session->flashdata('message') == "") ? "" :
				'<div class="alert alert-warning">' .
				$this->session->flashdata('message') .
				'</div>'; ?>
			<strong class="f22">Pengaturan Profile</strong>
		</div>
	</div>
</div>
<div class="infoakun">
	<div class="card borderdesk col-xs-12 p-a-1 m-t-1">
		<div class="col-md-12">
			<form action="<?php echo base_url() ?>member/updatemember" method="post" class="settingmember">
				<label>Nama</label>
				<input type="text" name="name" value="<?php echo $sessionmember["name"] ?>" class="form-control" placeholder="Nama Lengkap" required>
				<br>
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $sessionmember["email"] ?>" class="form-control" placeholder="Email" required>
				<br>
				<label>Nomor Telepon</label>
				<input type="text" name="phone" value="<?php echo $sessionmember["phone"] ?>" class="form-control" placeholder="Telepon" required>
				<br>
				<label>Tanggal Lahir</label>
				<div class="row">
					<div class="col-md-4 col-xs-4 col-sm-4">
						<select class="form-control" name="date" isvalue="<?php echo $sessionmember["date"] ?>" required>
							<?php for ($t = 1; $t <= 31; $t++) {
								$selectdate = ($sessionmember["date"] != $t) ? "" : "";
								echo '<option value="' . $t . '" ' . $selectdate . '>' . $t . '</option>';
							} ?>
						</select>
					</div>
					<div class="col-md-4 col-xs-4 col-sm-4">
						<select class="form-control" name="month" isvalue="<?php echo $sessionmember["month"] ?>" required>
							<?php for ($b = 1; $b <= 12; $b++) {
								$selectmonth = ($sessionmember["month"] != $b) ? "" : "";
								echo '<option value="' . $b . '" ' . $selectmonth . '>' . $b . '</option>';
							} ?>
						</select>
					</div>
					<div class="col-md-4 col-xs-4 col-sm-4">
						<select class="form-control" name="year" isvalue="<?php echo $sessionmember["year"] ?>" required>
							<?php for ($y = 1945; $y <= date("Y"); $y++) {
								$selectyear = ($sessionmember["year"] != $y) ? "" : "";
								echo '<option value="' . $y . '" ' . $selectyear . '>' . $y . '</option>';
							} ?>
						</select>
					</div>
				</div>
				<br>
				<label>Perusahaan</label>
				<input type="text" name="Company" value="<?php echo $sessionmember["Company"] ?>" class="form-control" placeholder="Perusahaan" required>
				<br>
				<label>Jabatan</label>
				<input type="text" name="position" value="<?php echo $sessionmember["position"] ?>" class="form-control" placeholder="Position" required>
				<br>
				<label>Email Perusahaan</label>
				<input type="text" name="company_email" value="<?php echo $sessionmember["company_email"] ?>" class="form-control" placeholder="Email Perusahaan" required>
				<br>
				<label>Telepon Perusahaan</label>
				<input type="text" name="company_phone" value="<?php echo $sessionmember["company_phone"] ?>" class="form-control" placeholder="Telepin Perusahaan" required>
				<br>
				<label>Provinsi</label>
				<select name="province" class="form-control" required id="<?php echo $sessionmember["provice"] ?>">
					<option value="">--Pilih Provinsi--</option>
					<?php foreach ($provinces as $key) : ?>
						<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
					<?php endforeach ?>
				</select>
				<br>
				<label>Kabupaten</label>
				<select name="city" class="form-control" required id="<?php echo $sessionmember["city"] ?>">
					<option value="">--Pilih Kabupaten--</option>
				</select>
				<br>
				<label>Kecamatan</label>
				<select name="districts" class="form-control" required id="<?php echo $sessionmember["districts"] ?>">
					<option value="">--Pilih Kecamatan--</option>
				</select>
				<br>
				<label>Kelurahan</label>
				<select name="village" class="form-control" required id="<?php echo $sessionmember["village"] ?>">
					<option value="">--Pilih Kelurahan--</option>
				</select>
				<br>
				<label>RT/RW</label>
				<input type="text" name="rt_rw" value="<?php echo $sessionmember["rt_rw"] ?>" class="form-control" placeholder="RT/TW" required>
				<br>
				<label>Alamat</label>
				<input type="text" name="address" value="<?php echo $sessionmember["address"] ?>" class="form-control" placeholder="Alamat" required>
				<br>
				<label>Kode Pos</label>
				<input type="number" name="kodepos" value="<?php echo $sessionmember["kodepos"] ?>" class="form-control" placeholder="Kode Pos" required>
				<br>
				<label>Atur Ulang Password</label>
				<br>
				<small>Kosongkan bila tidak ingin dirubah</small>
				<input type="text" name="passwordnew" class="form-control" placeholder="Password Baru">
				<br>
				<button id="one_click" href="<?php echo base_url() ?>member/setting" class="btn form-control btnnew " modal-text="Data Anda sedang disimpan" type="submit">Simpan</button>
			</form>
		</div>
	</div>
</div>

<div class="jsontest"></div>