<!-- info card akun -->
<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];
?>
<div class="col-md-12">
	<strong class="f22">Daftar Toko</strong>
</div>
<div class="infoakun">
	<div class="card borderdesk col-md-8 p-a-1 m-t-1 f18">
		<form action="<?php echo base_url() ?>member/store_register" method="post" class="storeregister">
			<input type="hidden" name="member_id" class="form-control" value="<?php echo $sessionmember["id"] ?>" required>
			<div class="col-md-12">
				<label class="fbold">Nama Toko</label>
				<input type="text" name="name" class="form-control" placeholder="Nama Toko" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Domain</label>
				<input type="text" name="domain" class="form-control" placeholder="Domain" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">NPWP</label>
				<input type="text" name="npwp" class="form-control" placeholder="Npwp" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Email</label>
				<input type="email" name="email" class="form-control" placeholder="Email" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Telepon</label>
				<input type="number" name="phone" class="form-control" placeholder="Telepon" required>
			</div>
			<div class="col-md-12 m-b-1 m-t-1">
				<label class="fbold">Deskripsi Toko</label>
				<input type="text" name="description" class="form-control" placeholder="Description">
			</div>
			<div class="col-md-12">
				<button id="one_click" class="btn form-control btnnew " modal-text="Data Anda sedang disimpan" type="submit">Simpan</button>
			</div>
		</form>
	</div>
</div>

<div class="card borderdesk col-md-4 p-a-1 m-t-1">
	<div class="col-md-12 text-center">
		<img src=" <?php echo base_url() ?>public/image/drum-pertamina.png" alt="Avatar" class="foto">
	</div>
	<div class="col-md-12 text-center m-t-1">
		<a href="<?php echo base_url() ?>member/setting" class="btn btnnew" style="width: 150px;">Edit Logo</a>
	</div>
	<div class="col-md-12 m-t-1">
		<div class="row">
			<span class="alert alert-warning pull-right f12">
				<strong>Catatan!</strong>
				<br />
				<ul style="margin-left: -20px;">
					<li>Extension yang bisa dipakai .JPG .JPEG .PNG</li>
					<li>Maksimal 5Mb</li>
				</ul>
			</span>
		</div>
	</div>
</div>
<style>
	.foto {
		width: 100px;
		height: 100px;
		border: grey solid 1px;
		border-radius: 50%;
	}
</style>