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

			<button class="btn w-100 py-2 fw-semibold" id="apply-filter"
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