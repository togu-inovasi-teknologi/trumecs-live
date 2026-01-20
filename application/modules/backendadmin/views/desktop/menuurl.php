<?php
function menu($menu, $parent)
{
	$array = array();
	foreach ($menu as $key) {
		if ($key["prn"] == $parent) {
			$datakey = array(
				'id' => $key["id"],
				'name' => $key["name"],
				'url' => $key["url"],
				'icon' => $key["icon"]
			);
			array_push($array, $datakey);
		}
	}
	return $array;
}
?>

<div class="container-fluid px-4 py-4">
	<!-- Header -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h1 class="fw-bold h3 mb-0">Menu Admin Management</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>backend">Dashboard</a></li>
						<li class="breadcrumb-item active">Menu Admin</li>
					</ol>
				</nav>
			</div>
			<hr class="my-2">
		</div>
	</div>

	<div class="row g-4">
		<!-- List Menu (Left Column) -->
		<div class="col-lg-8">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-4">
						<h5 class="fw-bold mb-0">List Menu</h5>
						<span class="badge bg-primary rounded-pill"><?php echo count($menu) ?> Items</span>
					</div>

					<div class="accordion accordion-flush" id="menuAccordion">
						<?php $idprn = 0; ?>
						<?php foreach ($menu as $key) : ?>
							<?php $scond = menu($menu, $key["id"]) ?>
							<?php if ($key["prn"] == "prn") : ?>
								<?php $idprn++; ?>
								<div class="accordion-item border rounded-3 mb-2">
									<div class="accordion-header">
										<button class="accordion-button collapsed bg-light fw-bold" type="button"
											data-bs-toggle="collapse"
											data-bs-target="#collapse<?php echo $key['id'] ?>"
											aria-expanded="false">
											<div class="d-flex align-items-center w-100">
												<div class="flex-grow-1">
													<i class="bi bi-folder me-2"></i>
													<?php echo $key["name"] ?>
													<?php if (count($scond) > 0) : ?>
														<span class="badge bg-secondary rounded-pill ms-2"><?php echo count($scond) ?></span>
													<?php endif; ?>
												</div>
												<div class="btn-group btn-group-sm ms-3">
													<a class="btn btn-outline-warning"
														href="<?php echo base_url() ?>backendadmin/menuurl?id=<?php echo $key["id"] ?>">
														<i class="bi bi-pencil"></i>
													</a>
													<a class="btn btn-outline-danger"
														href="<?php echo base_url() ?>backendadmin/hapusmenu?id=<?php echo $key["id"] ?>"
														onclick="return confirm('Hapus menu ini?')">
														<i class="bi bi-trash"></i>
													</a>
												</div>
											</div>
										</button>
									</div>

									<?php if (count($scond) > 0) : ?>
										<div id="collapse<?php echo $key["id"] ?>" class="accordion-collapse collapse"
											data-bs-parent="#menuAccordion">
											<div class="accordion-body">
												<div class="list-group list-group-flush">
													<?php foreach ($scond as $ks) : ?>
														<div class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
															<div class="d-flex align-items-center">
																<i class="bi bi-link-45deg text-muted me-3"></i>
																<div>
																	<h6 class="mb-0 fw-bold"><?php echo $ks["name"] ?></h6>
																	<small class="text-muted"><?php echo $ks["url"] ?></small>
																</div>
															</div>
															<div class="btn-group btn-group-sm">
																<a class="btn btn-outline-warning"
																	href="<?php echo base_url() ?>backendadmin/menuurl?id=<?php echo $ks["id"] ?>">
																	<i class="bi bi-pencil"></i>
																</a>
																<a class="btn btn-outline-danger"
																	href="<?php echo base_url() ?>backendadmin/hapusmenu?id=<?php echo $ks["id"] ?>"
																	onclick="return confirm('Hapus submenu ini?')">
																	<i class="bi bi-trash"></i>
																</a>
															</div>
														</div>
													<?php endforeach ?>
												</div>
											</div>
										</div>
									<?php endif ?>
								</div>
							<?php endif ?>
						<?php endforeach ?>
					</div>

					<?php if ($idprn == 0) : ?>
						<div class="text-center py-5">
							<i class="bi bi-menu-button-wide display-1 text-muted mb-3"></i>
							<h5 class="text-muted mb-2">Belum Ada Menu</h5>
							<p class="text-muted mb-0">Tambahkan menu pertama Anda menggunakan form di sebelah</p>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>

		<!-- Form Menu (Right Column) -->
		<div class="col-lg-4">
			<div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
				<div class="card-body">
					<h5 class="fw-bold mb-4"><?php echo (!empty($id)) ? 'Edit Menu' : 'Tambah Menu Baru'; ?></h5>

					<form action="<?php echo base_url() ?>backendadmin/<?php echo (!empty($id)) ?  'editmenu' : "addmenu"; ?>" method="POST">
						<?php if (!empty($id)) : ?>
							<input type="hidden" name="id" value="<?php echo $detail["id"] ?>">
						<?php endif ?>

						<!-- Nama Menu -->
						<div class="mb-3">
							<label for="name" class="form-label fw-bold">Nama Menu</label>
							<input type="text" class="form-control" id="name" name="name"
								value="<?php echo (!empty($id)) ?  $detail["name"] : ""; ?>"
								placeholder="Contoh: Pengguna" required>
						</div>

						<!-- Icon -->
						<div class="mb-3">
							<label for="icon" class="form-label fw-bold">Icon</label>
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-<?php echo (!empty($id) && $detail["icon"]) ? $detail["icon"] : 'tag' ?>"></i></span>
								<input type="text" class="form-control" id="icon" name="icon"
									value="<?php echo (!empty($id)) ?  $detail["icon"] : ""; ?>"
									placeholder="Contoh: people (tanpa 'bi bi-')">
							</div>
							<div class="d-flex flex-column">
								<small class="text-muted">Nama icon Bootstrap Icons (contoh: people)</small>
								<small><a href="https://icons.getbootstrap.com/" target="_blank" class="text-decoration-none">Example Icon Click Here</a></small>
							</div>
						</div>

						<!-- Induk Menu -->
						<div class="mb-3">
							<label for="prn" class="form-label fw-bold">Induk Menu</label>
							<select class="form-select" id="prn" name="prn">
								<option value="prn" <?php echo (!empty($id) && $detail["prn"] == "prn") ? 'selected' : ''; ?>>
									Gunakan sebagai Menu Utama (Induk)
								</option>
								<?php foreach ($menu as $key) : ?>
									<?php if ($key["prn"] == "prn") : ?>
										<option value="<?php echo $key["id"] ?>"
											<?php echo (!empty($id) && $detail["prn"] == $key["id"]) ? 'selected' : ''; ?>>
											<?php echo $key["name"] ?>
										</option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>

						<!-- URL -->
						<div class="mb-4">
							<label for="url" class="form-label fw-bold">URL</label>
							<input type="text" class="form-control" id="url" name="url"
								value="<?php echo (!empty($id)) ?  $detail["url"] : ""; ?>"
								placeholder="Contoh: backendadmin/user?filter=all">
							<small class="text-muted">Kosongkan jika menu utama (prn)</small>
						</div>

						<!-- Submit Button -->
						<button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
							<i class="bi bi-<?php echo (!empty($id)) ? 'check-circle' : 'plus-circle'; ?> me-2"></i>
							<?php echo (!empty($id)) ?  "Simpan Perubahan" : "Tambah Menu"; ?>
						</button>

						<?php if (!empty($id)) : ?>
							<a href="<?php echo base_url() ?>backendadmin/menu" class="btn btn-outline-secondary w-100 mt-2">
								<i class="bi bi-x-circle me-2"></i> Batal Edit
							</a>
						<?php endif ?>
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

	.accordion-button {
		border-radius: 0.5rem !important;
		padding: 1rem 1.25rem;
	}

	.accordion-button:not(.collapsed) {
		background-color: #f8f9fa;
		color: #212529;
		box-shadow: none;
	}

	.accordion-button:focus {
		box-shadow: none;
		border-color: rgba(0, 0, 0, 0.125);
	}

	.accordion-item {
		border: 1px solid rgba(0, 0, 0, 0.125);
	}

	.accordion-body {
		padding: 1rem 1.25rem;
		background-color: #f8f9fa;
		border-radius: 0 0 0.5rem 0.5rem;
	}

	.list-group-item {
		background-color: transparent;
	}

	.btn-group .btn {
		border-radius: 0.375rem !important;
	}

	.btn-outline-warning:hover {
		background-color: #ffc107;
		color: #000;
	}

	.btn-outline-danger:hover {
		background-color: #dc3545;
		color: #fff;
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

	.sticky-top {
		position: sticky;
		z-index: 1020;
	}
</style>

<script>
	// Auto focus pada form jika ada error
	document.addEventListener('DOMContentLoaded', function() {
		const urlParams = new URLSearchParams(window.location.search);
		if (urlParams.has('id')) {
			document.getElementById('name')?.focus();
		}

		// Auto expand accordion for edited item
		const editedId = "<?php echo !empty($id) ? $detail['prn'] : '' ?>";
		if (editedId && editedId !== 'prn') {
			const accordion = document.getElementById('collapse' + editedId);
			if (accordion) {
				const bsCollapse = new bootstrap.Collapse(accordion, {
					toggle: true
				});
			}
		}
	});
</script>