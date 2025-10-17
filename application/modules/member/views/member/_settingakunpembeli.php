<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];

?>
<div class="row ">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12">
				<?php echo ($this->session->flashdata('message') == "") ? "" :
					'<div class="alert alert-warning">' .
					$this->session->flashdata('message') .
					'</div>'; ?>
				<strong class="f22">Atur Informasi Pembeli</strong>
			</div>
			<div class="clearfix"></div>
			<hr class="line">
		</div>

	</div>
	<div class="infoakun col-xs-12">
		<form action="<?php echo base_url() ?>member/updatemember" method="post" class="settingmember">
			<div class="row">
				<div class="col-md-3"><strong>Nama</strong></div>
				<div class="col-md-9"><input type="text" name="name" value="<?php echo $sessionmember["name"] ?>" class="form-control" placeholder="Nama Lengkap" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Email</strong></div>
				<div class="col-md-9"><input type="email" name="email" value="<?php echo $sessionmember["email"] ?>" class="form-control" placeholder="Email" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Nomor Telepon</strong></div>
				<div class="col-md-9"><input type="text" name="phone" value="<?php echo $sessionmember["phone"] ?>" class="form-control" placeholder="Telepon" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Tanggal Lahir</strong></div>
				<div class="col-md-9">
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
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Perusahaan</strong></div>
				<div class="col-md-9"><input type="text" name="Company" value="<?php echo $sessionmember["Company"] ?>" class="form-control" placeholder="Perusahaan" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Jabatan</strong></div>
				<div class="col-md-9"><input type="text" name="position" value="<?php echo $sessionmember["position"] ?>" class="form-control" placeholder="Position" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Email Perusahaan</strong></div>
				<div class="col-md-9"><input type="text" name="company_email" value="<?php echo $sessionmember["company_email"] ?>" class="form-control" placeholder="Email Perusahaan" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Telepon Perusahaan</strong></div>
				<div class="col-md-9"><input type="text" name="company_phone" value="<?php echo $sessionmember["company_phone"] ?>" class="form-control" placeholder="Telepin Perusahaan" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Provinsi</strong></div>
				<div class="col-md-9">
					<select name="province" class="form-control" required id="<?php echo $sessionmember["provice"] ?>">
						<option value="">--Pilih Provinsi--</option>
						<?php foreach ($provinces as $key) : ?>
							<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Kabupaten</strong></div>
				<div class="col-md-9">
					<select name="city" class="form-control" required id="<?php echo $sessionmember["city"] ?>">
						<option value="">--Pilih Kabupaten--</option>
					</select>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Kecamatan</strong></div>
				<div class="col-md-9">
					<select name="districts" class="form-control" required id="<?php echo $sessionmember["districts"] ?>">
						<option value="">--Pilih Kecamatan--</option>
					</select>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Kelurahan</strong></div>
				<div class="col-md-9">
					<select name="village" class="form-control" required id="<?php echo $sessionmember["village"] ?>">
						<option value="">--Pilih Kelurahan--</option>
					</select>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>RT/RW</strong></div>
				<div class="col-md-9"><input type="text" name="rt_rw" value="<?php echo $sessionmember["rt_rw"] ?>" class="form-control" placeholder="RT/TW" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Alamat</strong></div>
				<div class="col-md-9"><input type="text" name="address" value="<?php echo $sessionmember["address"] ?>" class="form-control" placeholder="Alamat" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Kode Pos</strong></div>
				<div class="col-md-9"><input type="number" name="kodepos" value="<?php echo $sessionmember["kodepos"] ?>" class="form-control" placeholder="Kode Pos" required></div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Atur Ulang Password</strong><br><small>Kosongkan bila tidak ingin dirubah</small></div>
				<div class="col-md-9"><input type="text" name="passwordnew" class="form-control" placeholder="Password Baru"></div>
				<div class="clearfix"><input type="hidden" name="passwordold" value="<?php echo $sessionmember["password"] ?>" required></div>
				<hr class="line">
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-3">
					<button id="one_click" href="<?php echo base_url() ?>member/setting" class="btn form-control btnnew " modal-text="Data Anda sedang disimpan" type="submit">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="jsontest"></div>