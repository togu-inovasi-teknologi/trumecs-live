<div class="form">
	<?php
	// Menentukan action URL dengan cara yang kompatibel PHP 5.3.8
	$segment2 = $this->uri->segment(2);
	$isMyArtikel = ($segment2 == "myartikel");
	$actionUrl = base_url() . 'backendartikel/';

	if ($isMyArtikel) {
		$actionUrl .= 'myartikel/';
	}

	if (!empty($id)) {
		$actionUrl .= 'update';
	} else {
		$actionUrl .= 'input';
	}
	?>

	<form action="<?php echo $actionUrl; ?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-12">
				<div class="d-flex justify-content-between align-items-center mb-4">
					<strong class="fs-4">Form Artikel</strong>
					<div class=" d-lg-block">
						<button type="submit" name="save" value="draft" class="btn btn-outline-secondary me-2">Simpan Draft</button>
						<button type="submit" name="save" value="reguler" class="btn btn-warning">Simpan</button>
					</div>
				</div>
				<hr>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8  d-lg-block">
				<div class="row">
					<div class="col-12 mb-4">
						<label class="form-label fw-bold">Judul</label>
						<?php if (!empty($id)): ?>
							<input class="form-control" name="id" type="hidden" value="<?php echo htmlspecialchars($detail["id"]); ?>">
						<?php endif; ?>
						<input type="text" name="title" class="form-control" placeholder="Judul" required
							value="<?php echo (!empty($id)) ? htmlspecialchars($detail["title"]) : ''; ?>" maxlength="60">
						<div class="form-text">Maksimal 60 karakter</div>
					</div>

					<div class="col-12 mb-4">
						<label class="form-label fw-bold">Content</label>
						<textarea id="xxxxxxxxx" name="content" class="form-control" rows="15"><?php echo (!empty($id)) ? htmlspecialchars($detail["value"]) : ''; ?></textarea>
					</div>
				</div>
			</div>

			<div class="col-lg-4  d-lg-block">
				<div class="row">
					<div class="col-12 mb-4">
						<label class="form-label fw-bold">Gambar</label>
						<input type="file" id="file" name="filegambar" class="form-control" <?php echo (empty($id)) ? 'required' : ''; ?>>

						<?php if (!empty($id)): ?>
							<input type="hidden" name="asknew" value="">
							<input type="hidden" name="txtfilegambarold" value="<?php echo htmlspecialchars($detail["img"]); ?>">
						<?php endif; ?>

						<div class="mt-3">
							<?php if (!empty($id) && !empty($detail["img"])): ?>
								<div class="card">
									<div class="card-body p-2">
										<img src="<?php echo base_url(); ?>public/image/artikel/<?php echo htmlspecialchars($detail["img"]); ?>"
											class="img-fluid rounded"
											alt="Gambar Artikel"
											style="max-height: 200px; object-fit: cover;">
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-12 mb-3">
						<label class="form-label fw-bold">Hashtag [Optional]</label>
						<input class="form-control" name="tag" value="<?php echo (!empty($id)) ? htmlspecialchars($detail["tag"]) : ''; ?>">
						<div class="form-text">Pisahkan setiap hashtag menggunakan koma (,)</div>
					</div>

					<div class="col-12 mb-3">
						<label class="form-label fw-bold">SEO Keyword [Optional]</label>
						<input class="form-control" name="seo_key" value="<?php echo (!empty($id)) ? htmlspecialchars($detail["seo_key"]) : ''; ?>">
						<div class="form-text">Pisahkan setiap keyword menggunakan koma (,)</div>
					</div>

					<div class="col-12 mb-3">
						<label class="form-label fw-bold">SEO Deskripsi [Optional]</label>
						<textarea class="form-control" name="discription_seo" maxlength="160" rows="4"><?php echo (!empty($id)) ? htmlspecialchars($detail["discription_seo"]) : ''; ?></textarea>
						<div class="form-text">Maksimal 160 karakter</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Desktop Footer Buttons -->
		<div class="row  d-lg-block">
			<div class="col-12">
				<hr>
				<div class="d-flex justify-content-end">
					<button type="submit" name="save" value="draft" class="btn btn-outline-secondary me-2">Simpan Draft</button>
					<button type="submit" name="save" value="reguler" class="btn btn-warning">Simpan</button>
				</div>
			</div>
		</div>
	</form>
</div>