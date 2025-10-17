<div class="me row">
	<div class="col-md-12">
		<strong class="f18">Profile Baru</strong>
		<hr>
	</div>
	<form action="<?php echo base_url() ?>backenduser/inputadminnnnnnnnxaxaxa" method="POST">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2">Nama</div>
			<div class="col-md-5"><input class="form-control" type="text" name="name" value="" required></div>
			<div class="col-lg-12"><hr></div>
		</div>
		<div class="row">
			<div class="col-md-2">Email</div>
			<div class="col-md-5"><input class="form-control" type="email" name="email" value="" required></div>
			<div class="col-lg-12"><hr></div>
		</div>

		<div class="row">
			<div class="col-md-2">Posisi</div>
			<div class="col-md-5">
				<select name="levelprevilage" class="form-control" id="leveladmin" level="<?php echo $data["level"] ?>">
					<?php foreach ($previlage as $key): ?>
						<option value="<?php echo $key["idlevel"] ?>"><?php echo  $key["namelevel"] ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-lg-12"><hr></div>
		</div>

		<div class="row">
			<div class="col-md-2">Password
			</div>
			<div class="col-md-5">
				<input class="form-control" name="password" type="password" required>
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