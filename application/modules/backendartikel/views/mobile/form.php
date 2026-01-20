<div class="form">
	<?php
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
				<div class="d-flex justify-content-between align-items-center mb-3">
					<strong class="fs-5">Form Artikel</strong>
					<div class="d-block d-lg-none">
						<button type="submit" name="save" value="reguler" class="btn btn-warning btn-sm">Simpan</button>
					</div>
				</div>
				<hr class="my-2">
			</div>
		</div>

		<div class="row d-block d-lg-none">
			<!-- Mobile: Tab Navigation -->
			<div class="col-12 mb-3">
				<ul class="nav nav-pills nav-fill" id="mobileTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="content-tab" data-bs-toggle="pill" data-bs-target="#content-pane" type="button" role="tab">
							<i class="bi bi-file-text me-1"></i>Konten
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="settings-tab" data-bs-toggle="pill" data-bs-target="#settings-pane" type="button" role="tab">
							<i class="bi bi-gear me-1"></i>Pengaturan
						</button>
					</li>
				</ul>
			</div>

			<!-- Mobile: Tab Content -->
			<div class="col-12">
				<div class="tab-content" id="mobileTabContent">
					<!-- Tab 1: Content -->
					<div class="tab-pane fade show active" id="content-pane" role="tabpanel" tabindex="0">
						<div class="mb-3">
							<label class="form-label fw-bold">Judul</label>
							<?php if (!empty($id)): ?>
								<input class="form-control" name="id" type="hidden" value="<?php echo htmlspecialchars($detail["id"]); ?>">
							<?php endif; ?>
							<input type="text" name="title" class="form-control" placeholder="Judul" required
								value="<?php echo (!empty($id)) ? htmlspecialchars($detail["title"]) : ''; ?>" maxlength="60">
							<div class="form-text">Maksimal 60 karakter</div>
						</div>

						<div class="mb-3">
							<label class="form-label fw-bold">Content</label>
							<textarea id="xxxxxxxxx-mobile" name="content" class="form-control" rows="10"><?php echo (!empty($id)) ? htmlspecialchars($detail["value"]) : ''; ?></textarea>
						</div>
					</div>

					<!-- Tab 2: Settings -->
					<div class="tab-pane fade" id="settings-pane" role="tabpanel" tabindex="0">
						<div class="mb-3">
							<label class="form-label fw-bold">Gambar</label>
							<input type="file" id="file-mobile" name="filegambar" class="form-control" <?php echo (empty($id)) ? 'required' : ''; ?>>

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
												style="max-height: 150px; object-fit: cover;">
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<div class="mb-3">
							<label class="form-label fw-bold">Hashtag [Optional]</label>
							<input class="form-control" name="tag" value="<?php echo (!empty($id)) ? htmlspecialchars($detail["tag"]) : ''; ?>">
							<div class="form-text small">Pisahkan dengan koma (,)</div>
						</div>

						<div class="mb-3">
							<label class="form-label fw-bold">SEO Keyword [Optional]</label>
							<input class="form-control" name="seo_key" value="<?php echo (!empty($id)) ? htmlspecialchars($detail["seo_key"]) : ''; ?>">
							<div class="form-text small">Pisahkan dengan koma (,)</div>
						</div>

						<div class="mb-3">
							<label class="form-label fw-bold">SEO Deskripsi [Optional]</label>
							<textarea class="form-control" name="discription_seo" maxlength="160" rows="3"><?php echo (!empty($id)) ? htmlspecialchars($detail["discription_seo"]) : ''; ?></textarea>
							<div class="form-text small">Maksimal 160 karakter</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Mobile Footer Buttons -->
		<div class="row d-block d-lg-none">
			<div class="col-12">
				<hr class="my-2">
				<div class="d-grid gap-2">
					<button type="submit" name="save" value="reguler" class="btn btn-warning">Simpan Artikel</button>
					<button type="submit" name="save" value="draft" class="btn btn-outline-secondary">Simpan sebagai Draft</button>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- Bootstrap 5.3.8 Tab Script -->
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Bootstrap tabs
		var tabEl = document.querySelectorAll('button[data-bs-toggle="pill"]');
		tabEl.forEach(function(tab) {
			tab.addEventListener('shown.bs.tab', function(event) {
				// Optional: Save active tab to localStorage
				localStorage.setItem('activeTab', event.target.getAttribute('data-bs-target'));
			});
		});

		// Restore active tab from localStorage
		var activeTab = localStorage.getItem('activeTab');
		if (activeTab) {
			var tabTrigger = new bootstrap.Tab(document.querySelector('[data-bs-target="' + activeTab + '"]'));
			tabTrigger.show();
		}
	});
</script>