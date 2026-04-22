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
				<i class="bi bi-tags-fill text-warning me-2"></i> Form Promo <?php echo (!empty($id)) ? "Update" : 'Input'; ?>
			</h3>
			<hr class="border-2 border-warning opacity-75 mt-0">
		</div>

		<div class="col-lg">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body p-4">
					<form action="<?php echo base_url() ?>backendpromo/<?php echo (!empty($id)) ? "update" : 'input'; ?>" method="POST" enctype="multipart/form-data">
						<div class="d-flex gap-2 mb-3">
							<div class="col-lg-6 ">
								<label class="form-label fw-semibold">Judul Promo <span class="text-danger">*</span></label>
								<?php if (!empty($id)): ?>
									<input class="form-control" name="id" type="hidden" value="<?php echo $detail["id"] ?>">
								<?php endif ?>
								<input type="text" name="name" class="form-control rounded-3" placeholder="Judul" required
									value="<?php echo (!empty($id)) ? htmlspecialchars($detail["name"]) : ''; ?>">
							</div>

							<div class="col-lg-6">
								<label class="form-label fw-semibold">Tipe Promo <span class="text-danger">*</span></label>
								<select name="type" class="form-select">
									<option value="">-- Pilih Tipe Promo --</option>
									<option value="promo" <?= $detail['type'] == "promo" ? "selected" : '' ?>>Promo</option>
									<option value="bundle" <?= $detail['type'] == "bundle" ? "selected" : '' ?>>Bundle</option>
								</select>
							</div>
						</div>

						<div class="d-flex gap-2 mb-3">

							<div class="col-lg-6">
								<label class="form-label fw-semibold">Tanggal Mulai Promo <span class="text-danger">*</span></label>
								<input type="date" name="start_date" class="form-control rounded-3" placeholder="Tanggal mulai" required
									value="<?php echo (!empty($id)) ? date("Y-m-d", $detail["start_date"]) : ''; ?>">
							</div>
							<div class="col-lg-6">
								<label class="form-label fw-semibold">Tanggal Berakhir Promo <span class="text-danger">*</span></label>
								<input type="date" name="end_date" class="form-control rounded-3" placeholder="Tanggal berakhir" required
									value="<?php echo (!empty($id)) ? date("Y-m-d", $detail["end_date"]) : ''; ?>">
							</div>
						</div>
						<div class="row mb-3">

						</div>

						<div class="row mb-3">
							<div class="col-lg">
								<label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
								<textarea name="description" class="form-control rounded-3" rows="4"><?php echo (!empty($id)) ? htmlspecialchars($detail["description"]) : ''; ?></textarea>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-lg-6">
								<label class="form-label fw-semibold">Banner untuk Promo <span class="text-danger">*</span></label>
								<input type="file" id="file" name="filegambar" class="form-control rounded-3" <?php echo (empty($this->input->get("id"))) ? "required" : ""; ?>>
								<div class="tampung mt-2">
									<?php echo (!empty($id)) ? '<img src="' . base_url() . 'public/image/promo/' . $detail["img"] . '" class="img-fluid rounded-3" style="max-height: 120px;">' : ''; ?>
									<?php if (!empty($id)): ?>
										<input type="hidden" class="form-control" name="asknew" value="">
									<?php endif ?>
								</div>
								<?php if (!empty($id)): ?>
									<input type="input" class="form-control" name="txtfilegambarold" value="<?php echo (!empty($id)) ? $detail["img"] : ''; ?>" hidden>
								<?php endif ?>
							</div>
							<div class="col-lg-6" id="choiceTypePromo">
								<label class="form-label fw-semibold">Harga Bundle <span class="text-danger">*</span></label>
								<input type="text" name="price" class="form-control rounded-3" value="<?php echo (!empty($id)) ? $detail["price"] : '' ?>">
							</div>
						</div>

						<hr>
						<div class=" d-flex justify-content-end">
							<button type="submit" class="btn btnnew px-4 rounded-3 fw-semibold">
								Simpan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>