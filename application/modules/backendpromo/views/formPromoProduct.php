<?php
//$id = $this->input->get("id");
if (!empty($id)) {
	$expolde = explode(",", $detail["product"]);
} else {
	$expolde = array();
}
?>

<div class="container-fluid py-4">
	<div class="row g-4">
		<div class="col-12">
			<h3 class="fw-bold text-dark mb-2">
				<i class="bi bi-tags-fill text-warning me-2"></i>Tambah Produk untuk <span class="forange"><?= $detail["name"] ?></span>
			</h3>
			<hr class="border-2 border-warning opacity-75 mt-0">
		</div>

		<div class="col-lg-6">
			<h5 class="fw-bold text-dark mb-2">
				<i class="bi bi-tags-fill text-warning me-2"></i>Produk yang telah dipilih
			</h5>
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<?php if (!empty($id)): ?>
						<input name="id-promo" type="hidden" value="<?php echo $detail['id'] ?>" />
						<div class="table-responsive">
							<table class="table table-hover mb-0" id="table-produk-promo-pilih">
								<thead class="table-light">
									<tr>
										<th class="ps-3" style="width: 100px;">Hapus?</th>
										<th class="ps-3">Nama Produk<br><small class="text-muted">part number</small></th>
										<th class="ps-3">Harga</small></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<div class="alert alert-warning m-3 rounded-3 border-0">
							<i class="bi bi-exclamation-triangle-fill me-2"></i>
							Belum ada Produk yang dipilih
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<h5 class="fw-bold text-dark mb-2">
				<i class="bi bi-tags-fill text-warning me-2"></i>Pilih Produk
			</h5>
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body">
					<?php if (!empty($id)): ?>
						<input name="id-promo" type="hidden" value="<?php echo $detail['id'] ?>" />
						<div class="table-responsive">
							<table class="table table-hover mb-0" id="table-produk-promo">
								<thead class="table-light">
									<tr>
										<th class="ps-3" style="width: 100px;">Tambah?</th>
										<th class="ps-3">Nama Produk<br><small class="text-muted">part number</small></th>
										<th class="ps-3">Harga</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<div class="alert alert-warning m-3 rounded-3 border-0">
							<i class="bi bi-exclamation-triangle-fill me-2"></i>
							Harap membuat promo terlebih dahulu, setelah itu tambahkan produk yang dipromosikan
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>