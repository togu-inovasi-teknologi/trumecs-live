<?php function getchild($menu, $id)
{
	$tampung = array();
	foreach ($menu as $key) {
		if ($key["prn"] == $id) {
			$okeinichildnya = array(
				'id' => $key["id"],
				'name' => $key["name"],
				'icon' => $key["icon"],
				'prn' => $key["prn"],
				'url' => $key["url"]
			);
			array_push($tampung, $okeinichildnya);
		}
	}
	return $tampung;
}
?>

<div class="container-fluid px-4 py-4">
	<!-- Header -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h1 class="fw-bold h3 mb-0">Rule Admin Management</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>backend">Dashboard</a></li>
						<li class="breadcrumb-item active">Rule Admin</li>
					</ol>
				</nav>
			</div>
			<hr class="my-2">
		</div>
	</div>

	<div class="row g-4">
		<!-- List Rules (Left Column) -->
		<div class="col-lg-5">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-4">
						<h5 class="fw-bold mb-0">List Rule</h5>
						<span class="badge bg-primary rounded-pill"><?php echo count($rule) ?> Rules</span>
					</div>

					<div class="list-group list-group-flush">
						<?php foreach ($rule as $key): ?>
							<div class="list-group-item d-flex justify-content-between align-items-center border-0 py-3 px-0">
								<div class="d-flex align-items-center">
									<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
										<i class="bi bi-shield-check text-primary"></i>
									</div>
									<div>
										<h6 class="fw-bold mb-0"><?php echo ucwords($key["name"]) ?></h6>
										<small class="text-muted">ID: <?php echo $key["id"] ?></small>
									</div>
								</div>
								<div class="btn-group btn-group-sm">
									<a class="btn btn-outline-warning"
										href="<?php echo base_url() ?>backendadmin/rule?id=<?php echo $key["id"] ?>">
										<i class="bi bi-pencil"></i>
									</a>
									<a class="btn btn-outline-danger"
										href="<?php echo base_url() ?>backendadmin/hapusrule?id=<?php echo $key["id"] ?>"
										onclick="return confirm('Hapus rule ini?')">
										<i class="bi bi-trash"></i>
									</a>
								</div>
							</div>
						<?php endforeach ?>

						<?php if (empty($rule)): ?>
							<div class="text-center py-5">
								<i class="bi bi-shield-slash display-1 text-muted mb-3"></i>
								<h5 class="text-muted mb-2">Belum Ada Rule</h5>
								<p class="text-muted mb-0">Buat rule pertama Anda menggunakan form di sebelah</p>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Form Rule (Right Column) -->
		<div class="col-lg-7">
			<div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-4">
						<h5 class="fw-bold mb-0"><?php echo (!empty($id)) ? 'Edit Rule' : 'Tambah Rule Baru'; ?></h5>
						<?php if (!empty($id)): ?>
							<span class="badge bg-warning">Editing ID: <?php echo $detail["id"] ?></span>
						<?php endif ?>
					</div>

					<form action="<?php echo base_url() ?>backendadmin/<?php echo (!empty($id)) ? 'editrule' : "addrule"; ?>" method="POST">
						<?php if (!empty($id)): ?>
							<input type="hidden" name="id" value="<?php echo $detail["id"] ?>">
						<?php endif ?>

						<!-- Basic Information -->
						<div class="row g-3 mb-4">
							<div class="col-md-6">
								<label for="name" class="form-label fw-bold">Nama Rule</label>
								<input type="text" class="form-control" id="name" name="name"
									value="<?php echo (!empty($id)) ? ucwords($detail["name"]) : ""; ?>"
									placeholder="Contoh: Super Admin" required>
							</div>
							<div class="col-md-6">
								<label for="description" class="form-label fw-bold">Deskripsi</label>
								<input type="text" class="form-control" id="description" name="description"
									value="<?php echo (!empty($id)) ? ucwords($detail["description"]) : ""; ?>"
									placeholder="Deskripsi singkat rule">
							</div>
						</div>

						<!-- Menu Selection -->
						<div class="mb-4">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<label class="form-label fw-bold mb-0">Pilih Menu Akses</label>
								<div class="btn-group btn-group-sm">
									<button type="button" class="btn btn-outline-info" onclick="checkAllMenus()">
										<i class="bi bi-check-all me-1"></i> Pilih Semua
									</button>
									<button type="button" class="btn btn-outline-secondary" onclick="uncheckAllMenus()">
										<i class="bi bi-x-circle me-1"></i> Hapus Semua
									</button>
								</div>
							</div>

							<div class="border rounded-3 p-3" style="max-height: 400px; overflow-y: auto;">
								<?php foreach ($menu as $key): ?>
									<?php if ($key["prn"] == "prn"): ?>
										<div class="mb-3">
											<div class="form-check">
												<input class="form-check-input parent-menu" type="checkbox"
													name="menu[]" id="menu_<?php echo $key["id"] ?>"
													value="<?php echo $key["id"] ?>"
													<?php echo (!empty($id) && in_array($key["id"], explode(',', $detail["menu"]))) ? 'checked' : ''; ?>>
												<label class="form-check-label fw-bold" for="menu_<?php echo $key["id"] ?>">
													<i class="bi bi-<?php echo $key["icon"] ? $key["icon"] : 'folder' ?> me-2"></i>
													<?php echo $key["name"] ?>
												</label>
											</div>

											<?php $childprn = getchild($menu, $key["id"]); ?>
											<?php if (!empty($childprn)): ?>
												<div class="ms-4 mt-2">
													<?php foreach ($childprn as $ckey): ?>
														<div class="form-check mb-2">
															<input class="form-check-input child-menu" type="checkbox"
																name="menu[]" id="menu_<?php echo $ckey["id"] ?>"
																value="<?php echo $ckey["id"] ?>"
																<?php echo (!empty($id) && in_array($ckey["id"], explode(',', $detail["menu"]))) ? 'checked' : ''; ?>>
															<label class="form-check-label" for="menu_<?php echo $ckey["id"] ?>">
																<i class="bi bi-<?php echo $ckey["icon"] ? $ckey["icon"] : 'link' ?> me-2"></i>
																<?php echo $ckey["name"] ?>
															</label>
														</div>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>

						<!-- Submit Button -->
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary py-3 fw-bold">
								<i class="bi bi-<?php echo (!empty($id)) ? 'check-circle' : 'plus-circle'; ?> me-2"></i>
								<?php echo (!empty($id)) ? "Simpan Perubahan" : "Tambah Rule"; ?>
							</button>

							<?php if (!empty($id)): ?>
								<a href="<?php echo base_url() ?>backendadmin/rule" class="btn btn-outline-secondary">
									<i class="bi bi-x-circle me-2"></i> Batal Edit
								</a>
							<?php endif ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.rounded-4 {
		border-radius: 1rem !important;
	}

	.sticky-top {
		position: sticky;
		z-index: 1020;
	}

	.form-check-input {
		border-radius: 0.25rem;
	}

	.form-check-input:checked {
		background-color: #0d6efd;
		border-color: #0d6efd;
	}

	.form-control,
	.form-select {
		border-radius: 0.5rem;
		padding: 0.75rem 1rem;
		border: 1px solid #dee2e6;
	}

	.form-control:focus,
	.form-select:focus {
		border-color: #0d6efd;
		box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
	}

	.btn-primary {
		background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
		border: none;
		border-radius: 0.5rem;
		transition: all 0.3s ease;
	}

	.btn-primary:hover {
		background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
	}

	.btn-outline-warning:hover {
		background-color: #ffc107;
		color: #000;
	}

	.btn-outline-danger:hover {
		background-color: #dc3545;
		color: #fff;
	}

	.list-group-item {
		border-radius: 0.5rem;
		margin-bottom: 0.5rem;
	}

	.bg-primary.bg-opacity-10 {
		background-color: rgba(13, 110, 253, 0.1) !important;
	}

	/* Custom scrollbar */
	.border {
		scrollbar-width: thin;
		scrollbar-color: #888 #f1f1f1;
	}

	.border::-webkit-scrollbar {
		width: 6px;
	}

	.border::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 10px;
	}

	.border::-webkit-scrollbar-thumb {
		background: #888;
		border-radius: 10px;
	}

	.border::-webkit-scrollbar-thumb:hover {
		background: #555;
	}
</style>

<script>
	function checkAllMenus() {
		document.querySelectorAll('input[name="menu[]"]').forEach(checkbox => {
			checkbox.checked = true;
		});
	}

	function uncheckAllMenus() {
		document.querySelectorAll('input[name="menu[]"]').forEach(checkbox => {
			checkbox.checked = false;
		});
	}

	// Auto select menus based on existing data
	document.addEventListener('DOMContentLoaded', function() {
		<?php if (!empty($id) && !empty($detail["menu"])): ?>
			const selectedMenus = "<?php echo $detail["menu"] ?>";
			if (selectedMenus) {
				const menuIds = selectedMenus.split(',');
				menuIds.forEach(menuId => {
					const checkbox = document.getElementById('menu_' + menuId.trim());
					if (checkbox) {
						checkbox.checked = true;
					}
				});
			}
		<?php endif; ?>

		// Auto focus on name field
		document.getElementById('name')?.focus();
	});
</script>