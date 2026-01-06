<div class="<?php echo (!$this->agent->is_mobile()) ? "card shadow-sm border-0" : "m-0 row areamobilefilter"; ?> form-filter-search p-3"
	data-selected-brand="<?php echo isset($idbrand) ? $idbrand : ""; ?>"
	data-selected-type="<?php echo isset($idtype) ? $idtype : ""; ?>"
	data-selected-component="<?php echo isset($idcomponent) ? $idcomponent : ""; ?>"
	data-selected-sub="<?php echo isset($idsub) ? $idsub : ""; ?>"
	data-selected-quality="<?php echo isset($quality) ? $quality : ""; ?>">

	<form method="GET" action="<?php echo base_url() ?>cari">
		<?php if (!$this->agent->is_mobile()) : ?>
			<!-- Desktop Version -->
			<div class="mb-4">
				<h5 class="text-dark fw-bold mb-3 pb-2 border-bottom">
					<i class="bi bi-funnel-fill me-2" style="color: #fa8420;"></i>
					<?php echo $this->lang->line('judul_filter', FALSE); ?>
				</h5>
			</div>

			<div class="mb-3">
				<label class="form-label fw-semibold"><?php echo $this->lang->line('label_kategori', FALSE); ?></label>
				<select name="komponen" class="form-select form-select-sm">
					<option value="">-- Semua kategori --</option>
					<?php foreach ($category->result() as $item) : ?>
						<option value="<?php echo $item->id ?>" <?php echo $idcomponent == $item->id ? "selected" : "" ?>>
							<?php echo $item->name ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label fw-semibold"><?php echo $this->lang->line('label_subkategori', FALSE); ?></label>
				<select name="sub_kategori" class="form-select form-select-sm">
					<option value="">-- Semua Subkategori --</option>
					<!-- Options akan di-load via AJAX -->
				</select>
			</div>

			<!-- Tambahkan input hidden untuk menyimpan nilai sub kategori saat ini -->
			<input type="hidden" name="current_sub" id="current_sub" value="<?php echo isset($idsub) ? $idsub : ''; ?>">

			<div class="mb-3">
				<label class="form-label fw-semibold"><?php echo $this->lang->line('label_merk', FALSE); ?></label>
				<select name="merek" class="form-select form-select-sm">
					<option value="">-- Semua Merk --</option>
				</select>
			</div>

			<div class="mb-4">
				<label class="form-label fw-semibold"><?php echo $this->lang->line('label_grade', FALSE); ?></label>
				<select name="quality" class="form-select form-select-sm">
					<option value="">-- Semua Quality --</option>
					<option value="1" <?php echo (isset($quality) && $quality == '1') ? 'selected' : ''; ?>>Asli</option>
					<option value="2" <?php echo (isset($quality) && $quality == '2') ? 'selected' : ''; ?>>Replika</option>
					<option value="3" <?php echo (isset($quality) && $quality == '3') ? 'selected' : ''; ?>>Bekas/Copotan</option>
				</select>
			</div>

			<button class="btn apply-filter w-100 py-2 fw-semibold"
				style="background-color: #fa8420; color: white; border: none;">
				<i class="bi bi-check-circle me-2"></i>
				<?php echo $this->lang->line('tombol_terapkan', FALSE); ?>
			</button>

		<?php else : ?>
			<!-- Mobile Version -->
			<div class="fixed-bottom d-flex justify-content-center p-3" style="z-index: 1050;">
				<button type="button"
					class="btn btn-lg shadow-lg"
					style="background-color: #fa8420; color: white; border-radius: 50px; padding: 12px 30px;"
					data-bs-toggle="modal"
					data-bs-target="#modal_filter">
					<i class="bi bi-funnel-fill me-2"></i>
					Filter Pencarian
				</button>
			</div>

			<!-- Modal Filter Mobile -->
			<div class="modal fade" id="modal_filter" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content rounded-3">
						<div class="modal-header border-0 pb-0">
							<h5 class="modal-title fw-bold" id="filterModalLabel">
								<i class="bi bi-funnel-fill me-2" style="color: #fa8420;"></i>
								<?php echo $this->lang->line('judul_filter', FALSE); ?>
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body pt-0">
							<div class="mb-3">
								<label class="form-label fw-semibold">Nama / Partnumber</label>
								<div class="input-group">
									<span class="input-group-text bg-light">
										<i class="bi bi-search" style="color: #fa8420;"></i>
									</span>
									<input name="nama"
										placeholder="Nama / Partnumber"
										type="text"
										class="form-control"
										value="<?php echo (!empty($querysearch)) ? $querysearch : ""; ?>">
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Lokasi</label>
								<select name="lokasi" class="form-select">
									<option value="">-- Pilih Lokasi --</option>
									<option value="1">Jabodetabek</option>
									<option value="2">Banten</option>
									<option value="3">Jawa Barat</option>
									<option value="4">Jawa Tengah</option>
									<option value="5">Jawa Timur</option>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Kategori</label>
								<select name="komponen" class="form-select">
									<option value="">-- Pilih kategori --</option>
									<?php foreach ($category->result() as $item) : ?>
										<option value="<?php echo $item->id ?>" <?php echo $idcomponent == $item->id ? 'selected="selected"' : "" ?>>
											<?php echo $item->name ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Sub Kategori</label>
								<select name="sub_kategori" class="form-select">
									<option value="">-- Pilih Sub Kategori --</option>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Merk</label>
								<select name="merek" class="form-select">
									<option value="">-- Pilih Merk --</option>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Grade</label>
								<select name="quality" class="form-select">
									<option value="">-- Pilih Grade --</option>
									<option value="1">Asli</option>
									<option value="2">Replika</option>
									<option value="3">Bekas/Copotan</option>
								</select>
							</div>

							<div class="mb-4">
								<label class="form-label fw-semibold">Harga</label>
								<div class="row g-2">
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text bg-light">Min</span>
											<input class="form-control"
												type="text"
												id="hargamin"
												name="hargamin"
												placeholder="Rp">
										</div>
									</div>
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text bg-light">Max</span>
											<input class="form-control"
												type="text"
												id="hargamax"
												name="hargamax"
												placeholder="Rp">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer border-0 pt-0">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<button class="btn apply-filter"
								style="background-color: #fa8420; color: white; border: none;"
								data-bs-dismiss="modal">
								<i class="bi bi-check-circle me-2"></i>
								Terapkan Filter
							</button>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
	</form>
</div>
<style type="text/css">
	.mobileformfilter {
		border-radius: 0rem;
		border: 1px solid gainsboro;
		background-color: gainsboro;
		padding-top: 4px;
		padding-bottom: 4px;
	}

	.btnmobileformfilter {
		border-radius: 0rem;
		border: 1px solid gainsboro;
		background-color: gainsboro;
		padding-top: 2px;
		padding-bottom: 2px;
	}

	.areamobilefilter {
		background-color: gainsboro;
	}
</style>