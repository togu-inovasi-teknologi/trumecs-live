<div class="listalladmin">
	<div class="row align-items-center mb-4">
		<div class="col-md-8">
			<h3 class="fw-bold text-dark mb-0">
				<i class="bi bi-people-fill text-primary me-2"></i> List Admin
			</h3>
			<p class="text-muted small mt-1 mb-0">Kelola data administrator sistem</p>
		</div>
		<div class="col-md-4 text-md-end mt-3 mt-md-0">
			<a href="<?php echo base_url() ?>backenduser/formaddddadaaaaa" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">
				<i class="bi bi-person-plus-fill me-2"></i> Tambah Admin
			</a>
		</div>
		<div class="col-12 mt-3">
			<hr class="border-2 border-primary opacity-50">
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<div class="table-responsive">
						<table id="table-user" class="table table-hover align-middle mb-0" width="100%">
							<thead class="table-light">
								<tr>
									<th class="ps-4 py-3 fw-semibold" style="width: 40%;">Nama Admin</th>
									<th class="py-3 fw-semibold" style="width: 40%;">Privilege / Level</th>
									<th class="pe-4 py-3 fw-semibold" style="width: 20%;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($listfilter)): ?>
									<?php foreach ($listfilter as $key): ?>
										<?php if ($key["privileges"] != ""): ?>
											<tr>
												<td class="ps-4 py-3">
													<div class="d-flex align-items-center gap-2">
														<i class="bi bi-person-circle text-primary fs-4"></i>
														<a href="<?php echo base_url() ?>backenduser/ddtttaaaiiill?id=<?php echo $key["idadmin"] ?>" class="fw-semibold text-primary text-decoration-none">
															<?php echo htmlspecialchars($key["nameadmin"]); ?>
														</a>
													</div>
												</td>
												<td class="py-3">
													<?php
													if ($key["level"] == 'Super Admin') {
														echo '<span class="badge bg-danger rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-stars me-1"></i> ' . htmlspecialchars($key["level"]) . '</span>';
													} elseif ($key["level"] == 'Admin') {
														echo '<span class="badge bg-warning rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-shield-check me-1"></i> ' . htmlspecialchars($key["level"]) . '</span>';
													} else {
														echo '<span class="badge bg-secondary rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-person-badge me-1"></i> ' . htmlspecialchars($key["level"]) . '</span>';
													}
													?>
												</td>
												<td class="pe-4 py-3">
													<a href="<?php echo base_url() ?>backenduser/haspuuuuuussssssadminnnnn?id=<?php echo $key["idadmin"] ?>" class="btn btn-sm btn-outline-danger rounded-3 px-3">
														<i class="bi bi-trash3 me-1"></i> Hapus
													</a>
												</td>
											</tr>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="3" class="text-center py-5">
											<i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
											<h5 class="text-muted mb-0">Tidak ada data admin</h5>
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>