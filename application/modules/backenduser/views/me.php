<div class="container-fluid">
	<div class="row mb-4">
		<div class="col-12">
			<?php
			$ses = $this->session->all_userdata();
			?>
			<h3 class="fw-bold text-dark mb-0">
				<i class="bi bi-person-circle text-primary me-2"></i> Profile Saya
			</h3>
			<hr class="border-2 border-primary opacity-50 mt-2">
		</div>
	</div>

	<?php
	$data = $ses["admin"];
	?>

	<form action="<?php echo base_url() ?>backenduser/updateadmin" method="POST">
		<input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
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
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">Posisi / Level</label>
					<div class="col-md-9 col-lg-10">
						<div class="input-group">
							<span class="input-group-text bg-light border-end-0">
								<i class="bi bi-shield-check text-warning"></i>
							</span>
							<input class="form-control rounded-end-3 bg-light" disabled value="<?php echo htmlspecialchars($data["level"]); ?>">
						</div>
						<div class="form-text text-muted">
							<i class="bi bi-info-circle me-1"></i> Hanya Administrator yang bisa merubah level posisi
						</div>
					</div>
				</div>

				<div class="row mb-3 align-items-center">
					<label class="col-md-3 col-lg-2 fw-semibold text-dark">No Telepon / WA</label>
					<div class="col-md-9 col-lg-10">
						<div class="input-group">
							<span class="input-group-text bg-light border-end-0">
								<i class="bi bi-shield-check text-warning"></i>
							</span>
							<input class="form-control rounded-end-3 bg-light" disabled value="<?php echo htmlspecialchars($data["phone"]); ?>">
						</div>
						<div class="form-text text-muted">
							<i class="bi bi-info-circle me-1"></i> Hanya Administrator yang bisa merubah nomer telepon
						</div>
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
						<a href="<?php echo base_url() ?>dashboard" class="btn btn-outline-secondary px-4 py-2 rounded-3 ms-2">
							<i class="bi bi-arrow-left me-1"></i> Kembali
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