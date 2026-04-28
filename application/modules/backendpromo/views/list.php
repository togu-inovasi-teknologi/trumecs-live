<div class="product">
	<div class="row align-items-center mb-4">
		<div class="col-md-8">
			<h3 class="fw-bold text-dark mb-0">
				<i class="bi bi-tags-fill text-warning me-2"></i> List Promo
			</h3>
		</div>
		<div class="col-md-4 text-md-end mt-3 mt-md-0">
			<a href="<?php echo base_url() ?>backendpromo/form" class="btn btn-success px-4 py-2 rounded-3 fw-semibold">
				<i class="bi bi-plus-circle me-2"></i> Tambah Promo
			</a>
		</div>
		<div class="col-12 mt-3">
			<hr class="border-2 border-warning opacity-75">
		</div>
	</div>

	<div class="row">
		<input type="hidden" name="status" value="<?php echo $this->input->get('status') ?>" />
		<div class="col-12 table-responsive">
			<table id="table<?php echo $this->uri->segment(2) == "listpromo" ? "-promo" : "-mypromo"; ?>" class="table table-hover table-striped table-bordered align-middle" width="100%">
				<thead class="table-light">
					<tr class="text-center">
						<th class="ps-3">Judul</th>
						<th class="ps-3">Type</th>
						<th class="text-center" style="width: 120px;">Total Produk</th>
						<th class="text-center" style="width: 80px;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($listfilter)): ?>
						<?php foreach ($listfilter as $key): ?>
							<tr>
								<td class="ps-3">
									<a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $key["id"] ?>" class="fw-semibold text-warning text-decoration-none">
										<?php echo htmlspecialchars($key["name"]); ?>
									</a>
								</td>
								<td class="text-center">
									<?php
									$explode = explode(",", $key["product"]);
									$totalProduk = count($explode);
									?>
									<span class="badge bg-warning text-dark rounded-pill px-3 py-2">
										<i class="bi bi-box-seam me-1"></i> <?php echo $totalProduk; ?> Produk
									</span>
								</td>
								<td class="text-center">
									<a href=" <?php echo base_url() ?>backendpromo/form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-outline-warning rounded-3" data-bs-toggle="tooltip" title="Edit Promo">
										<i class="bi bi-pencil-square"></i>
									</a>
									<button type="button" class="btn btn-sm btn-outline-danger rounded-3" data-bs-toggle="tooltip" title="Hapus Promo" onclick="hapusPromo('<?php echo $key["id"] ?>', '<?php echo addslashes($key["name"]); ?>')">
										<i class="bi bi-trash3"></i>
									</button>
								</td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="4" class="text-center py-5">
								<i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
								<span class="text-muted">Tidak ada data promo</span>
							</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	function hapusPromo(id, name) {
		var txt = "Apakah anda yakin ingin menghapus promo \"" + name + "\"?";
		var r = confirm(txt);
		if (r == true) {
			window.location.href = "<?php echo base_url() ?>backendpromo/hapuspromo?id=" + id;
		}
	};

	// Inisialisasi tooltip jika menggunakan Bootstrap JS
	document.addEventListener('DOMContentLoaded', function() {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
		tooltipTriggerList.map(function(tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl);
		});
	});
</script>