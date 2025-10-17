<div class="me row">
		<?php 
	$data= $detail[0];
	 ?>
	<div class="col-md-12">
		<strong class="f18">Profile <?php echo $data["nameadmin"] ?></strong>
		<hr>
	</div>

	<form action="<?php echo base_url() ?>backenduser/updateadminddtttaaaiiill" method="POST">
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
				<select name="levelprevilage" class="form-control" id="leveladmin" required level="<?php echo $data["level"] ?>">
					<?php foreach ($previlage as $key): ?>
						<option value="<?php echo $key["idlevel"] ?>"><?php echo  $key["namelevel"] ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-lg-12"><hr></div>
		</div>

		<div class="row">
			<div class="col-md-2">Ganti Password
			</div>
			<div class="col-md-5">
				<input class="form-control" name="id" type="hidden" value="<?php echo $data["idadmin"] ?>">
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
<script type="text/javascript">
document.getElementById("leveladmin").value = <?php echo $data["idlevel"] ?>;
</script>