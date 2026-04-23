<?php
$data = $detail[0];
?>

<div class="container-fluid">
	<div class="row mb-4">
		<div class="col-12">
			<h3 class="fw-bold text-dark mb-0">
				<i class="bi bi-person-gear text-primary me-2"></i> Profile <?php echo htmlspecialchars($data["nameadmin"]); ?>
			</h3>
			<hr class="border-2 border-primary opacity-50 mt-2">
		</div>
	</div>

	<form action="<?php echo base_url() ?>backenduser/updateadminddtttaaaiiill" method="POST">
		<input type="hidden" name="id" value="<?php echo $data["idadmin"]; ?>">
		<input type="hidden" name="passwordold" value="<?php echo $data["password"]; ?>">

		<div class="card border-0 shadow-sm rounded-4">
			<div class="card-body p-4">
				<div class="row mb-3 align-items-center">
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">Nama <span class="text-danger">*</span></label>
					<div class="col-md-9 col-lg-10">
						<input class="form-control rounded-3" type="text" required name="name" value="<?php echo htmlspecialchars($data["nameadmin"]); ?>" placeholder="Masukkan nama lengkap">
					</div>
				</div>

				<div class="row mb-3 align-items-center">
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">Email <span class="text-danger">*</span></label>
					<div class="col-md-9 col-lg-10">
						<input class="form-control rounded-3" type="email" required name="email" value="<?php echo htmlspecialchars($data["email"]); ?>" placeholder="contoh@email.com">
						<div class="form-text">Email digunakan untuk login</div>
					</div>
				</div>

				<div class="row mb-3 align-items-center">
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">Posisi / Level <span class="text-danger">*</span></label>
					<div class="col-md-9 col-lg-10">
						<select name="levelprevilage" class="form-select rounded-3" id="leveladmin" required>
							<option value="">-- Pilih Posisi --</option>
							<?php foreach ($previlage as $key): ?>
								<option value="<?php echo $key["idlevel"]; ?>"><?php echo htmlspecialchars($key["namelevel"]); ?></option>
							<?php endforeach; ?>
						</select>
						<div class="form-text">Pilih level akses untuk admin ini</div>
					</div>
				</div>
				<div class="row mb-3 align-items-center">
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">No Telepon / WA <span class="text-danger">*</span></label>
					<div class="col-md-9 col-lg-10">
						<input class="form-control rounded-3" type="text" name="phone" value="<?php echo htmlspecialchars($data["phone"]); ?>" placeholder="0852xxxxxxxxx" required>
					</div>
				</div>

				<div class="row mb-3 align-items-center">
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">Ganti Password</label>
					<div class="col-md-9 col-lg-10">
						<input class="form-control rounded-3" name="password" type="password" placeholder="Kosongkan jika tidak ingin mengganti password">
						<div class="form-text text-warning">
							<i class="bi bi-info-circle me-1"></i> Jangan diisi bila password tidak diubah
						</div>
					</div>
				</div>

				<hr class="my-4">

				<div class="row">
					<div class="d-flex justify-content-between">
						<a href="<?php echo base_url() ?>backenduser/listall" class="btn btn-outline-secondary px-4 py-2 rounded-3 ms-2">
							<i class="bi bi-arrow-left me-1"></i> Batal
						</a>
						<button class="btn btn-primary px-5 py-2 rounded-3 fw-semibold" type="submit">
							<i class="bi bi-save me-2"></i> Simpan Perubahan
						</button>

					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	document.getElementById("leveladmin").value = "<?php echo $data["idlevel"]; ?>";
</script>