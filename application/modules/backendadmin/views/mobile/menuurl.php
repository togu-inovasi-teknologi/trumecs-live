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

<div class="container-fluid">
	<!-- Header -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="d-flex align-items-center justify-content-between mb-3">
				<div>
					<h1 class="fw-bold h4 mb-0">Menu Admin</h1>
					<small class="text-muted">Kelola menu admin panel</small>
				</div>
			</div>
		</div>
	</div>

	<!-- List Menu -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<h5 class="fw-bold mb-3">Daftar Menu</h5>

					<div class="accordion accordion-flush" id="mobileMenuAccordion">
						<?php $idprn = 0; ?>
						<?php foreach ($menu as $key) : ?>
							<?php $scond = menu($menu, $key["id"]) ?>
							<?php if ($key["prn"] == "prn") : ?>
								<?php $idprn++; ?>
								<div class="accordion-item border-0">
									<div class="accordion-header">
										<button class="accordion-button collapsed fw-bold px-3" type="button"
											data-bs-toggle="collapse"
											data-bs-target="#mobileCollapse<?php echo $key["id"] ?>"
											aria-expanded="false">
											<div class="d-flex align-items-center w-100">
												<i class="bi bi-folder me-2"></i>
												<span class="flex-grow-1 text-start"><?php echo $key["name"] ?></span>
												<?php if (count($scond) > 0) : ?>
													<span class="badge bg-secondary rounded-pill ms-2"><?php echo count($scond) ?></span>
												<?php endif; ?>
											</div>
										</button>
									</div>

									<?php if (count($scond) > 0) : ?>
										<div id="mobileCollapse<?php echo $key["id"] ?>" class="accordion-collapse collapse"
											data-bs-parent="#mobileMenuAccordion">
											<div class="accordion-body px-3 py-2">
												<?php foreach ($scond as $ks) : ?>
													<div class="card border-0 bg-light rounded-3 mb-2">
														<div class="card-body p-3">
															<div class="d-flex justify-content-between align-items-center">
																<div>
																	<h6 class="mb-1 fw-bold"><?php echo $ks["name"] ?></h6>
																	<small class="text-muted"><?php echo $ks["url"] ?></small>
																</div>
																<div class="btn-group btn-group-sm">
																	<a class="btn btn-outline-warning btn-sm"
																		href="<?php echo base_url() ?>backendadmin/menuurl?id=<?php echo $ks["id"] ?>">
																		<i class="bi bi-pencil"></i>
																	</a>
																	<a class="btn btn-outline-danger btn-sm"
																		href="<?php echo base_url() ?>backendadmin/hapusmenu?id=<?php echo $ks["id"] ?>"
																		onclick="return confirm('Hapus submenu ini?')">
																		<i class="bi bi-trash"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												<?php endforeach ?>
											</div>
										</div>
									<?php endif ?>
								</div>

								<!-- Action Buttons for Parent Menu -->
								<div class="d-flex justify-content-end mb-3 px-3">
									<div class="btn-group btn-group-sm">
										<a class="btn btn-outline-warning"
											href="<?php echo base_url() ?>backendadmin/menuurl?id=<?php echo $key["id"] ?>">
											<i class="bi bi-pencil me-1"></i> Edit
										</a>
										<a class="btn btn-outline-danger"
											href="<?php echo base_url() ?>backendadmin/hapusmenu?id=<?php echo $key["id"] ?>"
											onclick="return confirm('Hapus menu ini beserta submenunya?')">
											<i class="bi bi-trash me-1"></i> Hapus
										</a>
									</div>
								</div>
							<?php endif ?>
						<?php endforeach ?>
					</div>

					<?php if ($idprn == 0) : ?>
						<div class="text-center py-4">
							<i class="bi bi-menu-button-wide display-6 text-muted mb-3"></i>
							<h6 class="text-muted mb-2">Belum Ada Menu</h6>
							<p class="text-muted small mb-0">Tambahkan menu pertama Anda di bawah</p>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick Actions Bottom Sheet -->
	<div class="fixed-bottom d-block d-lg-none">
		<div class="bg-white shadow-lg rounded-top-4">
			<div class="container-fluid py-2">
				<div class="row">

					<div class="col-6">
						<a href="<?php echo base_url() ?>backend" class="btn btn-outline-primary w-100 rounded-pill py-2">
							<i class="bi bi-arrow-left me-1"></i> Kembali
						</a>
					</div>
					<div class="col-6">
						<button type="button" class="btn btn-primary w-100 rounded-pill py-2" data-bs-toggle="modal" data-bs-target="#addMenuModal">
							<i class="bi bi-plus-circle me-1"></i> Menu Baru
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addMenuModalLabel">Tambah Menu Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="menuForm" action="<?php echo base_url() ?>backendadmin/addmenu" method="POST">
					<input type="hidden" id="editMenuId" name="id">

					<!-- Nama Menu -->
					<div class="mb-3">
						<label for="nameModal" class="form-label fw-bold small">Nama Menu</label>
						<input type="text" class="form-control form-control-sm" id="nameModal" name="name"
							placeholder="Contoh: Pengguna" required>
					</div>

					<!-- Icon -->
					<div class="mb-3">
						<label for="iconModal" class="form-label fw-bold small">
							Icon
						</label>
						<div class="input-group">
							<span class="input-group-text">
								<i id="iconPreview" class="bi bi-folder"></i>
							</span>
							<input type="text" class="form-control form-control-sm" id="iconModal" name="icon"
								placeholder="people, gear, house">
						</div>
						<div class="d-flex flex-column">
							<small class="text-muted">Nama icon Bootstrap Icons (contoh: people)</small>
							<small><a href="https://icons.getbootstrap.com/" target="_blank" class="text-decoration-none">Example Icon Click Here</a></small>
						</div>
					</div>

					<!-- Induk Menu -->
					<div class="mb-3">
						<label for="prnModal" class="form-label fw-bold small">Induk Menu</label>
						<select class="form-select form-select-sm" id="prnModal" name="prn">
							<option value="prn">Gunakan sebagai Menu Utama</option>
							<?php foreach ($menu as $key) : ?>
								<?php if ($key["prn"] == "prn") : ?>
									<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>

					<!-- URL -->
					<div class="mb-3">
						<label for="urlModal" class="form-label fw-bold small">URL</label>
						<input type="text" class="form-control form-control-sm" id="urlModal" name="url"
							placeholder="Contoh: backendadmin/user">
						<small class="text-muted">Kosongkan jika menu utama</small>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
				<button type="submit" form="menuForm" class="btn btn-primary">
					<i class="bi bi-check-circle me-1"></i> Simpan
				</button>
			</div>
		</div>
	</div>
</div>

<style>
	.rounded-4 {
		border-radius: 1rem !important;
	}

	.rounded-top-4 {
		border-radius: 1rem 1rem 0 0 !important;
	}

	.accordion-button {
		border-radius: 0.5rem !important;
		padding: 0.75rem 1rem;
		font-size: 0.9rem;
		min-height: 44px;
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

	.accordion-body {
		padding: 0.5rem 1rem;
		background-color: #f8f9fa;
		border-radius: 0 0 0.5rem 0.5rem;
	}

	.nav-pills {
		border-bottom: 1px solid #dee2e6;
		padding-bottom: 0.5rem;
	}

	.nav-pills .nav-link {
		font-size: 0.8rem;
		padding: 0.5rem 0.75rem;
		border-radius: 0.5rem;
		margin-right: 0.5rem;
	}

	.nav-pills .nav-link.active {
		background-color: #0d6efd;
	}

	.tab-pane {
		padding-top: 1rem;
	}

	.form-control-sm,
	.form-select-sm {
		border-radius: 0.5rem;
		padding: 0.5rem 0.75rem;
		font-size: 0.875rem;
	}

	.btn-primary {
		background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
		border: none;
		border-radius: 0.75rem;
	}

	.btn-outline-warning,
	.btn-outline-danger {
		font-size: 0.75rem;
		padding: 0.25rem 0.5rem;
	}

	.fixed-bottom {
		box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.1);
		border-top: 1px solid rgba(0, 0, 0, 0.05);
	}

	.rounded-pill {
		padding: 0.5rem 1.5rem !important;
	}

	/* Touch-friendly elements */
	button,
	a.btn {
		min-height: 44px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	/* Better spacing for mobile */
	.mb-3 {
		margin-bottom: 1rem !important;
	}

	.mb-4 {
		margin-bottom: 1.5rem !important;
	}

	/* Card hover effect for mobile */
	.card:active {
		transform: scale(0.98);
		transition: transform 0.2s;
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Bootstrap components
		const formTabs = document.getElementById('formTabs');
		if (formTabs) {
			const tab = new bootstrap.Tab(formTabs.querySelector('.nav-link'));
		}

		// Auto focus on name field
		document.getElementById('name_mobile')?.focus();

		// Smooth scroll to form
		document.querySelectorAll('a[href="#formSection"]').forEach(link => {
			link.addEventListener('click', function(e) {
				e.preventDefault();
				document.getElementById('formSection').scrollIntoView({
					behavior: 'smooth'
				});
			});
		});

		// Auto-expand accordion if editing child menu
		const editedId = "<?php echo !empty($id) ? $detail['prn'] : '' ?>";
		if (editedId && editedId !== 'prn') {
			const accordion = document.getElementById('mobileCollapse' + editedId);
			if (accordion) {
				const bsCollapse = new bootstrap.Collapse(accordion, {
					toggle: true
				});
			}
		}
	});
</script>