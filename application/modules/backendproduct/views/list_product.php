<?php
function namectgr($id)
{
	$namectgr = "";
	$ctgr = unserialize(CATEGORY_ALL);
	foreach ($ctgr as $key) {
		if ($key["id"] == $id) {
			$namectgr = $key["name"];
		}
	}
	return $namectgr;
}

?>

<style>
	.modal-content {
		border-radius: 12px;
		overflow: hidden;
	}

	.modal-header {
		border-bottom: none;
		padding: 1.5rem 1.5rem 1rem;
	}

	.modal-body {
		padding: 1.5rem;
	}

	.download-section {
		border: 1px solid #e9ecef;
		border-radius: 8px;
		padding: 1.25rem;
		background: #fafbfc;
	}

	.section-header {
		border-bottom: 1px solid #e9ecef;
		padding-bottom: 1rem;
	}

	.btn-group-vertical .btn {
		border-radius: 6px;
		margin-bottom: 0.5rem;
		border: 1px solid #dee2e6;
		transition: all 0.3s ease;
		position: relative;
		overflow: hidden;
	}

	.btn-group-vertical .btn:last-child {
		margin-bottom: 0;
	}

	.btn-group-vertical .btn:hover {
		transform: translateY(-1px);
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
	}

	.btn-outline-secondary:hover {
		background-color: #6c757d;
		color: white;
	}

	.btn-outline-success:hover {
		background-color: #198754;
		color: white;
	}

	.btn-outline-danger:hover {
		background-color: #dc3545;
		color: white;
	}

	.btn-outline-info:hover {
		background-color: #0dcaf0;
		color: white;
	}

	.modal-footer {
		border-top: 1px solid #e9ecef;
		padding: 1rem 1.5rem;
	}

	/* Animation for modal */
	.modal.fade .modal-dialog {
		transform: translateY(-50px);
		transition: transform 0.3s ease-out;
	}

	.modal.show .modal-dialog {
		transform: translateY(0);
	}
</style>
<div class="product">
	<div class="row">
		<div class="col-md-6">
			<strong class="fs-4">List Produk</strong>

		</div>
		<div class="col-md-6 text-end">
			<a class="btn btn-success" data-bs-toggle="modal" data-bs-target=".modal_download">Download list produk</a>
			<div class="modal fade modal_download" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0 shadow-lg">
						<!-- Modal Header -->
						<div class="modal-header bg-primary text-white">
							<h5 class="modal-title fw-bold" id="downloadModalLabel">
								<i class="fas fa-download me-2"></i>Download Data
							</h5>
							<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<!-- Modal Body -->
						<div class="modal-body p-4">
							<!-- Produk Section -->
							<div class="download-section mb-4">
								<div class="section-header mb-3">
									<h6 class="fw-semibold text-primary mb-2">
										<i class="fas fa-box me-2"></i>Download Data Produk
									</h6>
									<p class="text-muted small mb-0">Pilih jenis data produk yang ingin diunduh</p>
								</div>

								<div class="btn-group-vertical w-100" role="group">
									<a href="<?php echo base_url() ?>backendproduct/download_exel_product"
										class="btn btn-outline-secondary text-start py-3">
										<div class="d-flex justify-content-between align-items-center">
											<div>
												<i class="fas fa-layer-group me-2"></i>
												<strong>Semua Produk</strong>
											</div>
											<small class="text-muted">.xlsx</small>
										</div>
									</a>

									<a href="<?php echo base_url() ?>backendproduct/download_exel_product/show"
										class="btn btn-outline-success text-start py-3">
										<div class="d-flex justify-content-between align-items-center">
											<div>
												<i class="fas fa-check-circle me-2"></i>
												<strong>Produk Valid</strong>
											</div>
											<small class="text-muted">.xlsx</small>
										</div>
									</a>

									<a href="<?php echo base_url() ?>backendproduct/download_exel_product/draf"
										class="btn btn-outline-danger text-start py-3">
										<div class="d-flex justify-content-between align-items-center">
											<div>
												<i class="fas fa-times-circle me-2"></i>
												<strong>Produk Tidak Valid</strong>
											</div>
											<small class="text-muted">.xlsx</small>
										</div>
									</a>
								</div>
							</div>

							<!-- Kategori Section -->
							<div class="download-section">
								<div class="section-header mb-3">
									<h6 class="fw-semibold text-success mb-2">
										<i class="fas fa-tags me-2"></i>Download Data Kategori
									</h6>
									<p class="text-muted small mb-0">Unduh data kategori, merek, dan tipe</p>
								</div>

								<div class="btn-group-vertical w-100" role="group">
									<a href="<?php echo base_url() ?>backendproduct/category_brand_type_component"
										class="btn btn-outline-info text-start py-3">
										<div class="d-flex justify-content-between align-items-center">
											<div>
												<i class="fas fa-database me-2"></i>
												<strong>Semua Kategori & Merek</strong>
											</div>
											<small class="text-muted">.xlsx</small>
										</div>
									</a>
								</div>
							</div>
						</div>

						<!-- Modal Footer -->
						<div class="modal-footer bg-light">
							<small class="text-muted">
								<i class="fas fa-info-circle me-1"></i>
								File akan diunduh dalam format Excel (.xlsx)
							</small>
						</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>backendproduct/<?php echo $this->uri->segment(2) == "myproduct" ? "myproduct/" : ""; ?>form" class="btn btn-warning">Tambah Produk</a>
			<a href="<?= base_url() ?>backendproduct/syncProductFromSheetToDB"
				class="btn btn-primary">
				Sync From Sheet
			</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-12 table-responsive">
			<table id="table<?php echo $this->uri->segment(2) == "listall" ? "1" : "-myproduct"; ?>" class="table table-striped table-bordered table-hover" cellspacing="2" width="100%">
				<thead>
					<tr>
						<th>Valid?</th>
						<th>Nama<br><small>Part Number</small></th>
						<th>Harga<br><small>Harga Promo</small></th>
						<th>Merek<br><small>Tipe</small></th>
						<th>Stok</th>
						<th>Garansi</th>
						<th>Edit</th>
						<th>Galeri</th>
						<th>Hapus</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($listproduct)): ?>

						<?php foreach ($listproduct as $key): ?>
							<tr>
								<td>
									<a href="<?php echo base_url() ?>backendproduct/productstatus?id=<?php echo $key["id"] ?>&status=<?php echo ($key["status"] == "show") ? "draf" : "show"; ?>" class="badge bg-<?php echo ($key["status"] == "show") ? "success" : "danger"; ?> text-decoration-none" alt="show">
										<i class="bi bi-<?php echo ($key["status"] == "show") ? "check" : "ban"; ?>"></i>
									</a>
								</td>
								<td><?php echo $key["tittle"] ?><br>
									<small class="text-muted"><?php echo str_replace(" ", "", $key["partnumber"]) ?></small>
								</td>
								<td>Rp.<?php echo number_format($key["price"]) ?>/<?php echo strtolower(($key["unit"])) ?>
									<br><small class="text-muted">Rp.<?php echo number_format($key["price_promo"]) ?>/<?php echo strtolower(($key["unit"])) ?></small>
								</td>
								<td>
									<span class="badge bg-secondary"><?php echo namectgr($key["brand"]) ?></span>
									<br><small class="text-muted"><?php echo namectgr($key["type"]) ?></small>
								</td>
								<td>
									<span class="badge bg-<?php echo (($key["stock"]) <= 3) ? "danger" : "success"; ?>"><?php echo ($key["stock"]) ?></span>
								</td>
								<td>
									<span class="badge bg-<?php echo (($key["warranty"]) != 0 or $key["warranty"] != "") ? "danger" : "success"; ?>"><?php echo ($key["warranty"]) ?></span>
								</td>
								<td>
									<a class="badge bg-warning text-decoration-none"
										href="<?php echo base_url() ?>backendproduct/form?id=<?php echo $key["id"] ?>"><i class="bi bi-pencil"></i></a>
								</td>
								<td>
									<a class="badge bg-primary text-decoration-none"
										href="<?php echo base_url() ?>backendproduct/galery?id=<?php echo $key["id"] ?>"><i class="fas fa-images"></i></a>
								</td>
								<td>
									<a class="badge bg-danger text-decoration-none click"
										onclick="hapus(<?php echo $key["id"] ?>,'<?php echo $key["tittle"] ?>')"
										url="<?php echo base_url() ?>backendproduct/hapus?id=<?php echo $key["id"] ?>"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="text-center">Tidak ada data</td>
						</tr>
					<?php endif ?>

				</tbody>
			</table>
		</div>
		<!--<div class="col-12 text-center">
			<?php echo !empty($listproduct) ? $links : "";  ?> 
		</div>-->

	</div>
</div>
<script type="text/javascript">
	function hapus(url, name) {
		var txt = "Apakah anda yakin ingin menghapus produk " + name + "?";
		var r = confirm(txt);
		if (r == true) {
			window.location.href = "<?php echo base_url() ?>backendproduct/hapus?id=" + url;
		}
	};
</script>