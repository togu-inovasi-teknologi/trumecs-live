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

<div class="container-fluid">
	<!-- Header -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="d-flex align-items-center justify-content-between mb-3">
				<div>
					<h1 class="fw-bold h4 mb-0">Rule Admin</h1>
					<small class="text-muted">Kelola hak akses admin</small>
				</div>
			</div>
		</div>
	</div>

	<!-- List Rules -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h5 class="fw-bold mb-0">Daftar Rule</h5>
					</div>

					<div class="list-group list-group-flush">
						<?php foreach ($rule as $key): ?>
							<div class="list-group-item border-0 px-0 py-3">
								<div class="d-flex justify-content-between align-items-start">
									<div class="d-flex align-items-start flex-grow-1 me-3"> <!-- Tambah flex-grow-1 dan me-3 -->
										<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 mt-1" style="width: 35px; height: 35px;">
											<i class="bi bi-shield-check text-primary"></i>
										</div>
										<div>
											<h6 class="fw-bold mb-1"><?php echo ucwords($key["name"]) ?></h6>
											<?php if (!empty($key["description"])): ?>
												<p class="text-muted small mb-0"><?php echo $key["description"] ?></p>
											<?php endif; ?>
											<small class="text-muted">ID: <?php echo $key["id"] ?></small>
										</div>
									</div>
									<div class="btn-group btn-group-sm gap-2 flex-shrink-0" role="group"> <!-- Tambah flex-shrink-0 -->
										<!-- Link untuk edit mode via URL -->
										<a class="btn btn-outline-warning btn-sm"
											href="<?php echo base_url() ?>backendadmin/rule?id=<?php echo $key["id"] ?>">
											<i class="bi bi-pencil"></i>
										</a>
										<a class="btn btn-outline-danger btn-sm"
											href="<?php echo base_url() ?>backendadmin/hapusrule?id=<?php echo $key["id"] ?>"
											onclick="return confirm('Hapus rule ini?')">
											<i class="bi bi-trash"></i>
										</a>
									</div>
								</div>
							</div>
						<?php endforeach ?>

						<?php if (empty($rule)): ?>
							<div class="text-center py-4">
								<i class="bi bi-shield-slash display-6 text-muted mb-3"></i>
								<h6 class="text-muted mb-2">Belum Ada Rule</h6>
								<p class="text-muted small mb-0">Buat rule pertama dengan tombol "Baru" di atas</p>
							</div>
						<?php endif ?>
					</div>
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
						<button type="button" class="btn btn-primary w-100 rounded-pill py-2" data-bs-toggle="modal" data-bs-target="#ruleModal">
							<?php if (isset($_GET['id'])) { ?>
								<i class="bi bi-pencil me-1"></i> Edit Rule
							<?php } else { ?>
								<i class="bi bi-plus-circle me-1"></i> Rule Baru
							<?php }; ?>
						</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Rule Modal -->
<div class="modal fade" id="ruleModal" tabindex="-1" aria-labelledby="ruleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ruleModalLabel">Tambah Rule Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="ruleForm" action="<?php echo base_url() ?>backendadmin/addrule" method="POST">
					<input type="hidden" id="editRuleId" name="id">

					<!-- Basic Information -->
					<div class="row g-3 mb-3">
						<div class="col-12">
							<label for="nameModal" class="form-label fw-bold small">Nama Rule</label>
							<input type="text" class="form-control form-control-sm" id="nameModal" name="name"
								placeholder="Contoh: Super Admin" required>
						</div>
						<div class="col-12">
							<label for="descriptionModal" class="form-label fw-bold small">Deskripsi</label>
							<input type="text" class="form-control form-control-sm" id="descriptionModal" name="description"
								placeholder="Deskripsi singkat rule">
						</div>
					</div>

					<!-- Menu Selection -->
					<div class="mb-3">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<label class="form-label fw-bold small mb-0">Pilih Menu Akses</label>
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-outline-info btn-sm" onclick="modalCheckAllMenus()">
									<i class="bi bi-check-all"></i>
								</button>
								<button type="button" class="btn btn-outline-secondary btn-sm" onclick="modalUncheckAllMenus()">
									<i class="bi bi-x-circle"></i>
								</button>
							</div>
						</div>

						<!-- Menu Accordion -->
						<div class="border rounded-3 p-2" style="max-height: 300px; overflow-y: auto;">
							<div class="accordion accordion-flush" id="modalMenuAccordion">
								<?php $accordionId = 0; ?>
								<?php foreach ($menu as $key): ?>
									<?php if ($key["prn"] == "prn"): ?>
										<?php $accordionId++; ?>
										<?php $childprn = getchild($menu, $key["id"]); ?>

										<div class="accordion-item border-0">
											<div class="accordion-header">
												<button class="accordion-button collapsed small" type="button"
													data-bs-toggle="collapse"
													data-bs-target="#modalCollapse<?php echo $accordionId ?>"
													aria-expanded="false">
													<div class="d-flex align-items-center w-100">
														<div class="form-check mb-0 me-2">
															<input class="form-check-input parent-menu" type="checkbox"
																name="menu[]" id="modal_menu_<?php echo $key["id"] ?>"
																value="<?php echo $key["id"] ?>"
																<?php echo (!empty($detail) && in_array($key["id"], explode(',', $detail["menu"]))) ? 'checked' : ''; ?>>
														</div>
														<i class="bi bi-<?php echo $key["icon"] ? $key["icon"] : 'folder' ?> me-2"></i>
														<span class="flex-grow-1 text-start"><?php echo $key["name"] ?></span>
														<?php if (!empty($childprn)): ?>
															<span class="badge bg-secondary rounded-pill"><?php echo count($childprn) ?></span>
														<?php endif; ?>
													</div>
												</button>
											</div>

											<?php if (!empty($childprn)): ?>
												<div id="modalCollapse<?php echo $accordionId ?>" class="accordion-collapse collapse"
													data-bs-parent="#modalMenuAccordion">
													<div class="accordion-body">
														<?php foreach ($childprn as $ckey): ?>
															<div class="form-check mb-2 ms-3">
																<input class="form-check-input child-menu" type="checkbox"
																	name="menu[]" id="modal_menu_<?php echo $ckey["id"] ?>"
																	value="<?php echo $ckey["id"] ?>"
																	<?php echo (!empty($detail) && in_array($ckey["id"], explode(',', $detail["menu"]))) ? 'checked' : ''; ?>>
																<label class="form-check-label small" for="modal_menu_<?php echo $ckey["id"] ?>">
																	<i class="bi bi-<?php echo $ckey["icon"] ? $ckey["icon"] : 'link' ?> me-2"></i>
																	<?php echo $ckey["name"] ?>
																</label>
															</div>
														<?php endforeach ?>
													</div>
												</div>
											<?php endif ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
				<button type="submit" form="ruleForm" class="btn btn-primary">
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

	/* Modal Styles */
	.modal-content {
		border-radius: 1rem;
		border: none;
	}

	.modal-header {
		border-bottom: 1px solid #dee2e6;
		background-color: #f8f9fa;
		border-radius: 1rem 1rem 0 0;
		padding: 1rem;
	}

	.modal-footer {
		border-top: 1px solid #dee2e6;
		padding: 1rem;
	}

	.modal-body {
		padding: 1rem;
		max-height: 70vh;
		overflow-y: auto;
	}

	.modal-fullscreen-sm-down {
		margin: 0.5rem;
	}

	@media (min-width: 576px) {
		.modal-fullscreen-sm-down {
			max-width: 500px;
			margin: 1.75rem auto;
		}
	}

	/* Accordion in Modal */
	.accordion-button {
		border-radius: 0.5rem !important;
		padding: 0.75rem 1rem;
		font-size: 0.85rem;
		min-height: 44px;
		background-color: #fff;
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
		padding: 0.75rem 1rem;
		background-color: #f8f9fa;
		border-radius: 0 0 0.5rem 0.5rem;
	}

	.form-check-input {
		border-radius: 0.25rem;
		border: 2px solid #adb5bd;
	}

	.form-check-input:checked {
		background-color: #0d6efd;
		border-color: #0d6efd;
	}

	.form-check-input:focus {
		box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
	}

	.form-control-sm {
		border-radius: 0.5rem;
		padding: 0.5rem 0.75rem;
		font-size: 0.875rem;
		border: 1px solid #dee2e6;
	}

	.form-control-sm:focus {
		border-color: #0d6efd;
		box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
	}

	.btn-primary {
		background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
		border: none;
		border-radius: 0.5rem;
		font-weight: 500;
	}

	.btn-outline-warning,
	.btn-outline-danger {
		font-size: 0.75rem;
		padding: 0.25rem 0.5rem;
	}

	.btn-outline-warning:hover {
		background-color: #ffc107;
		color: #000;
	}

	.btn-outline-danger:hover {
		background-color: #dc3545;
		color: #fff;
	}

	.fixed-bottom {
		box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.1);
		border-top: 1px solid rgba(0, 0, 0, 0.05);
	}

	.rounded-pill {
		padding: 0.5rem 1.5rem !important;
	}

	.bg-primary.bg-opacity-10 {
		background-color: rgba(13, 110, 253, 0.1) !important;
	}

	/* Touch-friendly elements */
	button,
	a.btn {
		min-height: 44px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	/* Better spacing */
	.mb-3 {
		margin-bottom: 1rem !important;
	}

	.mb-4 {
		margin-bottom: 1.5rem !important;
	}

	/* Custom scrollbar for modal */
	.modal-body::-webkit-scrollbar {
		width: 6px;
	}

	.modal-body::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 10px;
	}

	.modal-body::-webkit-scrollbar-thumb {
		background: #888;
		border-radius: 10px;
	}

	.modal-body::-webkit-scrollbar-thumb:hover {
		background: #555;
	}

	/* Menu selection scroll area */
	.border {
		scrollbar-width: thin;
		scrollbar-color: #888 #f1f1f1;
	}

	.border::-webkit-scrollbar {
		width: 4px;
	}

	.border::-webkit-scrollbar-track {
		background: #f1f1f1;
	}

	.border::-webkit-scrollbar-thumb {
		background: #888;
		border-radius: 2px;
	}
</style>

<script>
	// Modal menu selection functions
	function modalCheckAllMenus() {
		document.querySelectorAll('#ruleForm input[name="menu[]"]').forEach(checkbox => {
			checkbox.checked = true;
		});
	}

	function modalUncheckAllMenus() {
		document.querySelectorAll('#ruleForm input[name="menu[]"]').forEach(checkbox => {
			checkbox.checked = false;
		});
	}

	// Auto select menus from existing rule data
	function selectMenusFromData(menuIds) {
		if (menuIds) {
			const ids = menuIds.split(',');
			ids.forEach(menuId => {
				const checkbox = document.getElementById('modal_menu_' + menuId.trim());
				if (checkbox) {
					checkbox.checked = true;

					// Auto expand parent accordion if child is selected
					const parentAccordion = checkbox.closest('.accordion-collapse');
					if (parentAccordion) {
						const bsCollapse = new bootstrap.Collapse(parentAccordion, {
							toggle: true
						});
					}
				}
			});
		}
	}

	document.addEventListener('DOMContentLoaded', function() {
		// Get modal elements
		const ruleModal = document.getElementById('ruleModal');
		const modalTitle = document.getElementById('ruleModalLabel');
		const ruleForm = document.getElementById('ruleForm');
		const editRuleId = document.getElementById('editRuleId');
		const nameInput = document.getElementById('nameModal');
		const descriptionInput = document.getElementById('descriptionModal');

		// Check if we're in edit mode via URL parameter
		const urlParams = new URLSearchParams(window.location.search);
		const editId = urlParams.get('id');

		<?php if (!empty($id)): ?>
			// We're in edit mode from PHP (page loaded with ?id=...)
			// Show modal automatically and populate data
			const editModal = new bootstrap.Modal(ruleModal);
			editModal.show();

			// Set modal to edit mode
			modalTitle.textContent = 'Edit Rule';
			editRuleId.value = "<?php echo $detail["id"] ?>";
			nameInput.value = "<?php echo htmlspecialchars($detail["name"]) ?>";
			descriptionInput.value = "<?php echo htmlspecialchars($detail["description"] ?? '') ?>";

			// Change form action
			ruleForm.action = "<?php echo base_url() ?>backendadmin/editrule";

			// Select menus from existing data
			<?php if (!empty($detail["menu"])): ?>
				selectMenusFromData("<?php echo $detail["menu"] ?>");
			<?php endif; ?>

			// Auto expand accordions with selected items
			setTimeout(() => {
				document.querySelectorAll('#ruleForm input[name="menu[]"]:checked').forEach(checkbox => {
					const parentAccordion = checkbox.closest('.accordion-collapse');
					if (parentAccordion && !parentAccordion.classList.contains('show')) {
						const bsCollapse = new bootstrap.Collapse(parentAccordion, {
							toggle: true
						});
					}
				});
			}, 300);
		<?php endif; ?>

		// Handle add new rule button
		document.querySelectorAll('[data-bs-target="#ruleModal"]').forEach(button => {
			button.addEventListener('click', function() {
				// Set modal to add mode
				modalTitle.textContent = 'Tambah Rule Baru';
				ruleForm.reset();
				editRuleId.value = '';
				modalUncheckAllMenus();

				// Change form action
				ruleForm.action = "<?php echo base_url() ?>backendadmin/addrule";
			});
		});

		// Handle modal show event
		ruleModal.addEventListener('show.bs.modal', function() {
			setTimeout(() => {
				nameInput.focus();
			}, 500);
		});

		// Handle modal hidden event
		ruleModal.addEventListener('hidden.bs.modal', function() {
			// If we're in edit mode and modal is closed, redirect back to list
			if (editRuleId.value && !window.location.search.includes('id=')) {
				window.location.href = "<?php echo base_url() ?>backendadmin/rules";
			}

			// Reset form for next use (only if not in edit mode)
			if (!editRuleId.value) {
				ruleForm.reset();
				modalUncheckAllMenus();
			}
		});

		// Handle form submission
		ruleForm.addEventListener('submit', function(e) {
			// Validate form
			if (!nameInput.value.trim()) {
				e.preventDefault();
				nameInput.focus();
				nameInput.classList.add('is-invalid');
				return;
			}

			// Check if at least one menu is selected
			const menuCheckboxes = document.querySelectorAll('#ruleForm input[name="menu[]"]:checked');
			if (menuCheckboxes.length === 0) {
				e.preventDefault();
				alert('Pilih minimal satu menu akses');
				return;
			}

			// If editing, redirect back to list after save
			if (editRuleId.value) {
				setTimeout(() => {
					window.location.href = "<?php echo base_url() ?>backendadmin/rules";
				}, 100);
			}
		});

		// Auto focus on name field when modal opens
		ruleModal.addEventListener('shown.bs.modal', function() {
			nameInput.focus();
		});

		// Close modal when clicking cancel button in edit mode
		document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
			button.addEventListener('click', function() {
				// If we're in edit mode via URL, redirect back to list
				if (editId || editRuleId.value) {
					setTimeout(() => {
						window.location.href = "<?php echo base_url() ?>backendadmin/rules";
					}, 300);
				}
			});
		});
	});
</script>