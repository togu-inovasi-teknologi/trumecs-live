<div class="me row">
	<div class="col-md-12">
		<?php
		$ses=$this->session->all_userdata();
		 ?>
		<strong class="f18">Profile saya</strong>
		<hr>
	</div>
	<?php 
	$data= $ses["admin"];
	 ?>
	<form action="<?php echo base_url() ?>backenduser/updateadmin" method="POST">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2">Nama</div>
			<div class="col-md-5"><input class="form-control" type="text" required name="name" value="<?php echo $data["nameadmin"] ?>"></div>
			<div class="col-lg-12"><hr></div>
		</div>
		<div class="row">
			<div class="col-md-2">Email</div>
			<div class="col-md-5"><input class="form-control" type="email" required name="email" value="<?php echo $data["email"] ?>"></div>
			<div class="col-lg-12"><hr></div>
		</div>

		<div class="row">
			<div class="col-md-2">Posisi</div>
			<div class="col-md-5">
				<input disabled class="form-control" value="<?php echo $data["level"] ?>">
				<small>Hanya Administrator yang bisa merubah level posisi</small>
			</div>
			<div class="col-lg-12"><hr></div>
		</div>

		<div class="row">
			<div class="col-md-2">Ganti Password
			</div>
			<div class="col-md-5">
				<input class="form-control" name="id" type="hidden" value="<?php echo $data["id"] ?>">
				<input class="form-control" name="passwordold" type="hidden" value="<?php echo $data["password"] ?>">
				<input class="form-control" name="password" type="password" >
				<small>Jangan di isi bila tidak di ubah</small>
			</div>
			<div class="col-lg-12"><hr></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-5"><button class="btn btn-orange" type="submit">Simpan</button></div>
		</div>
	</div>
	</form>
</div>