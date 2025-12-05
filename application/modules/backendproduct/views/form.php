<?php
if (!empty($this->session->flashdata('backingdata'))) {
	$backingdata = !empty($this->session->flashdata('backingdata')) ? $this->session->flashdata('backingdata') : NULL;
}
$this->load->model("general/General_model", "general");
$jenisproduct = array();
$jenis = $this->general->getcategori(array('parent' => '0', 'is_brand' => '0'));
foreach ($jenis as $key) {
	$jenisproduct[$key['id']] = $key['name'];
}
?>

<div class="form_io_product row" jq-app="">
	<div class="attr-form d-none">
		<div class="row mb-2 align-items-end">
			<div class="col-md-5">
				<label class="form-label small text-muted">Nama Atribut</label>
				<input type="text" class="form-control" jq-model="atribut" placeholder="Contoh: Warna, Ukuran, Material" name="attribute[]" value="">
			</div>
			<div class="col-md-5">
				<label class="form-label small text-muted">Nilai Atribut</label>
				<input type="text" class="form-control" jq-model="value" placeholder="Contoh: Merah, 10x20cm, Plastik" name="value[]" value="">
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-outline-danger del-att w-100">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
	</div>

	<form action="<?php echo base_url() ?>backendproduct/<?php echo $this->uri->segment(2) == "myproduct" ? "myproduct/" : ""; ?><?php echo (!empty($this->input->get("id"))) ? 'updateproduct' : 'addproduct'; ?>" method="POST" enctype="multipart/form-data"
		seletedbrand="<?php echo (!empty($backingdata)) ? $backingdata["brand"] : ''; ?>"
		seletedtype="<?php echo (!empty($backingdata)) ? $backingdata["type"] : ''; ?>"
		seletedcomponent="<?php echo (!empty($backingdata)) ? $backingdata["component"] : ''; ?>"
		seletedgrade="<?php echo (!empty($backingdata)) ? $backingdata["quality"] : ''; ?>"
		seletedpackagine="<?php echo (!empty($backingdata)) ? $backingdata["packagin"] : ''; ?>">

		<!-- Header Section -->
		<div class="col-md-12 mb-4">
			<div class="card rounded bg-light">
				<div class="card-body border-bottom py-3">
					<div class="row align-items-center">
						<div class="col-md-9">
							<h2 class="fw-bold text-primary mb-0">
								<i class="fas fa-cube me-2"></i>Form Produk
							</h2>
						</div>
						<div class="col-md-3">
							<div class="row align-items-center d-flex gap-1">
								<label class="form-label fw-semibold text-muted mb-1">Jenis Produk</label>
								<select name="jenisproduct" tar='<?php echo (!empty($backingdata)) ? $backingdata["jenisproduct"] : ''; ?>' class="input_choicejenis form-select border-primary" required>
									<option value="">-- Pilih Jenis Produk --</option>
									<?php foreach ($jenisproduct as $key): ?>
										<option value='<?php echo $key ?>'><?php echo $key ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Form Content -->
		<div class="col-md-12">
			<div class="row g-4">
				<!-- Column 1: Basic Information -->
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-info-circle me-2"></i>Informasi Dasar
							</h5>
						</div>
						<div class="card-body">
							<?php if (!empty($this->input->get("id"))): ?>
								<input type="hidden" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["id"] : ''; ?>" name="id" required>
								<input type="hidden" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["img"] : ''; ?>" name="imgold" required>
							<?php endif ?>

							<div class="mb-3">
								<label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["tittle"] : ''; ?>" jq-model="name" name="tittle" placeholder="Masukkan nama produk" required>
							</div>

							<div class="attr-unit">
								<div class="mb-3">
									<label class="form-label fw-semibold">Part Number</label>
									<input type="text" class="form-control" jq-model="partnumber" name="partnumber" value="<?php echo (!empty($backingdata)) ? $backingdata["partnumber"] : ''; ?>" placeholder="PN-001">
								</div>
								<div class="mb-3">
									<label class="form-label fw-semibold">Part Number Trumecs</label>
									<input type="text" class="form-control" jq-model="partnumber_trumecs" name="partnumber_trumecs" value="<?php echo (!empty($backingdata)) ? $backingdata["partnumber_trumecs"] : ''; ?>" placeholder="TRM-001">
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Fisik Number</label>
								<small class="text-muted float-end">Opsional</small>
								<input type="text" class="form-control" jq-model="physicnumber" name="physicnumber" value="<?php echo (!empty($backingdata)) ? $backingdata["physicnumber"] : ''; ?>" placeholder="FN-001">
							</div>
						</div>
					</div>
				</div>

				<!-- Column 2: Pricing & Attributes -->
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-tag me-2"></i>Harga & Diskon
							</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label fw-semibold">Harga Normal <span class="text-danger">*</span></label>
								<div class="input-group">
									<span class="input-group-text bg-light">Rp</span>
									<input type="number" class="form-control" jq-model="price" name="price" required value="<?php echo (!empty($backingdata)) ? $backingdata["price"] : ''; ?>" placeholder="0">
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Harga Promo</label>
								<small class="text-muted float-end">Opsional</small>
								<div class="input-group">
									<span class="input-group-text bg-light">Rp</span>
									<input type="number" class="form-control" jq-model="price_promo" name="price_promo" value="<?php echo (!empty($backingdata)) ? $backingdata["price_promo"] : ''; ?>" placeholder="0">
								</div>
							</div>

							<div class="row g-2">
								<div class="col-6">
									<label class="form-label fw-semibold small">Diskon CBD</label>
									<div class="input-group input-group-sm">
										<input type="number" class="form-control" jq-model="promo_cbd_price" name="promo_cbd_price" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_cbd_price"] : ''; ?>" step=".01" placeholder="0">
										<span class="input-group-text">%</span>
									</div>
								</div>
								<div class="col-6">
									<label class="form-label fw-semibold small">Diskon Referral</label>
									<div class="input-group input-group-sm">
										<input type="number" class="form-control" jq-model="promo_referral_price" name="promo_referral_price" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_referral_price"] : ''; ?>" step=".01" placeholder="0">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>

							<div class="mt-3">
								<label class="form-label fw-semibold small text-primary">Diskon Volume</label>
								<div class="row g-2">
									<div class="col-6">
										<div class="input-group input-group-sm">
											<span class="input-group-text bg-white">Min Qty</span>
											<input type="number" class="form-control" jq-model="promo_volume" name="promo_volume" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_volume"] : ''; ?>" placeholder="0">
										</div>
									</div>
									<div class="col-6">
										<div class="input-group input-group-sm">
											<input type="number" class="form-control" jq-model="promo_volume_price" name="promo_volume_price" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_volume_price"] : ''; ?>" step=".01" placeholder="0">
											<span class="input-group-text">%</span>
										</div>
									</div>
								</div>
							</div>

							<!-- Attributes Section -->

						</div>
					</div>
				</div>

				<!-- Column 3: Categories & Specifications -->
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-tags me-2"></i>Kategori & Spesifikasi
							</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label fw-semibold">Kategori</label>
								<select name="component" class="form-select" seletedcomponent="<?php echo (!empty($backingdata)) ? $backingdata["component"] : ''; ?>">
									<option value="">-- Pilih Kategori --</option>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Merek Produk</label>
								<select name="brand" class="form-select" seletedbrand="<?php echo (!empty($backingdata)) ? $backingdata["brand"] : ''; ?>">
									<option value="">-- Pilih Merek --</option>
								</select>
							</div>

							<div class="attr-unit">
								<div class="mb-3">
									<label class="form-label fw-semibold">Merek Unit</label>
									<select name="brand_unit" class="form-select" seletedbrandunit="<?php echo (!empty($backingdata)) ? $backingdata["brand_unit"] : ''; ?>">
										<option value="">-- Pilih Merek Unit --</option>
									</select>
								</div>
								<div class="mb-3">
									<label class="form-label fw-semibold">Tipe Unit</label>
									<small class="text-muted float-end">Opsional</small>
									<select name="type" class="form-select" seletedtype="<?php echo (!empty($backingdata)) ? $backingdata["type"] : ''; ?>">
										<option value="">-- Pilih Tipe --</option>
									</select>
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Lokasi Pengiriman</label>
								<small class="text-muted float-end">Opsional</small>
								<select name="area" class="form-select" seletedarea="<?php echo (!empty($backingdata)) ? $backingdata["area"] : ''; ?>">
									<option value="">-- Pilih Lokasi --</option>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Grade <span class="text-danger">*</span></label>
								<select name="quality" class="form-select" seletedgrade="<?php echo (!empty($backingdata)) ? $backingdata["quality"] : ''; ?>">
									<option value="">-- Pilih Grade --</option>
									<option value="1">Asli</option>
									<option value="2">Replika</option>
									<option value="3">Bekas/Copotan</option>
								</select>
							</div>
							<div class="mt-4">
								<div class="d-flex justify-content-between align-items-center mb-2">
									<label class="form-label fw-semibold">Atribut Produk</label>
									<div class="d-flex gap-1 align-items-center justify-content-center">
										<small class="text-muted">Opsional</small>
										<button type="button" class="btn btn-outline-success btn-sm add-att">
											<i class="fas fa-plus me-1"></i>Tambah Atribut
										</button>
									</div>

								</div>
								<div class="attribute-card">
									<?php if (!empty($backingdata)): ?>
										<?php if (!empty($backingdata["attribute"])): ?>
											<?php foreach ($backingdata["attribute"] as $index => $value): ?>
												<div class="row mb-2 align-items-end">
													<div class="col-md-5">
														<label class="form-label small text-muted">Nama Atribut</label>
														<input type="text" class="form-control" jq-model="atribut" placeholder="Nama atribut" name="attribute[]" value="<?php echo  $value["name"] ?>">
													</div>
													<div class="col-md-5">
														<label class="form-label small text-muted">Nilai Atribut</label>
														<input type="text" class="form-control" jq-model="value" placeholder="Nilai atribut" name="value[]" value="<?php echo $value["value"] ?>">
													</div>
													<div class="col-md-2">
														<button type="button" class="btn btn-outline-danger del-att w-100">
															<i class="fas fa-times"></i>
														</button>
													</div>
												</div>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Additional Information Row -->
		<div class="col-md-12 mt-4">
			<div class="row g-4">
				<!-- Stock & Shipping -->
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-boxes me-2"></i>Stok & Pengiriman
							</h5>
						</div>
						<div class="card-body">
							<div class="row g-3">
								<div class="col-md-6">
									<label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
									<input type="number" class="form-control" jq-model="stock" name="stock" required value="<?php echo (!empty($backingdata)) ? $backingdata["stock"] : ''; ?>" placeholder="0">
								</div>
								<div class="col-md-6">
									<label class="form-label fw-semibold">Min. Pembelian <span class="text-danger">*</span></label>
									<input type="number" class="form-control" jq-model="moq" name="moq" required value="<?php echo (!empty($backingdata)) ? $backingdata["moq"] : ''; ?>" placeholder="1">
								</div>
								<div class="col-12">
									<label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
									<input type="text" class="form-control" jq-model="unit" name="unit" required value="<?php echo (!empty($backingdata)) ? $backingdata["unit"] : ''; ?>" placeholder="pcs, unit, kg, etc">
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Physical Properties -->
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-weight-hanging me-2"></i>Properti Fisik
							</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label fw-semibold">Berat (kg) <span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="text" class="form-control" jq-model="berat" name="weight" required value="<?php echo (!empty($backingdata)) ? $backingdata["weight"] : ''; ?>" placeholder="0.00">
									<span class="input-group-text">kg</span>
								</div>
								<small class="text-muted">Gunakan titik (.) untuk desimal</small>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Dimensi (mm)</label>
								<small class="text-muted float-end">Opsional</small>
								<input type="text" class="form-control" jq-model="dimensi" name="dimention" value="<?php echo (!empty($backingdata)) ? $backingdata["sx"] . 'x' . $backingdata["sy"] . 'x' . $backingdata["sz"] : ''; ?>" placeholder="100x50x20">
								<small class="text-muted">Pisahkan dengan huruf x (panjang x lebar x tinggi)</small>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Pengemasan</label>
								<select name="packagin" class="form-select" seletedpackagine="<?php echo (!empty($backingdata)) ? $backingdata["packagin"] : ''; ?>">
									<option value="">-- Pilih Pengemasan --</option>
									<option value="Box Kertas">Box Kertas</option>
									<option value="Box Kayu">Box Kayu</option>
									<option value="Drum">Drum</option>
									<option value="Pail">Pail</option>
									<option value="Dus">Dus</option>
									<option value="Lithos">Lithos</option>
									<option value="Botol">Botol</option>
									<option value="Gallon">Gallon</option>
									<option value="Can">Can</option>
									<option value="Stemped">Stemped</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<!-- Warranty & Links -->
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-shield-alt me-2"></i>Garansi & Links
							</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label fw-semibold">Garansi Trumecs</label>
								<small class="text-muted float-end">Opsional</small>
								<input type="text" class="form-control" jq-model="warranty" name="warranty" value="<?php echo (!empty($backingdata)) ? $backingdata["warranty"] : ''; ?>" placeholder="1 tahun">
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Garansi Vendor</label>
								<small class="text-muted float-end">Opsional</small>
								<input type="text" class="form-control" jq-model="warranty_vendor" name="warrantyvendor" value="<?php echo (!empty($backingdata)) ? $backingdata["warrantyvendor"] : ''; ?>" placeholder="6 bulan">
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Masa Pakai</label>
								<small class="text-muted float-end">Opsional</small>
								<input type="text" class="form-control" jq-model="livetime" name="livetime" value="<?php echo (!empty($backingdata)) ? $backingdata["livetime"] : ''; ?>" placeholder="5 tahun">
							</div>

							<div class="mt-3">
								<label class="form-label fw-semibold small text-primary">Marketplace Links</label>
								<div class="mb-2">
									<input type="text" class="form-control form-control-sm" name="link_tokped" value="<?php echo (!empty($backingdata)) ? $backingdata["link_tokped"] : ''; ?>" placeholder="Link Tokopedia">
								</div>
								<div class="mb-2">
									<input type="text" class="form-control form-control-sm" name="link_shopee" value="<?php echo (!empty($backingdata)) ? $backingdata["link_shopee"] : ''; ?>" placeholder="Link Shopee">
								</div>
								<div class="mb-2">
									<input type="text" class="form-control form-control-sm" name="link_bukalapak" value="<?php echo (!empty($backingdata)) ? $backingdata["link_bukalapak"] : ''; ?>" placeholder="Link Bukalapak">
								</div>
								<div class="mb-2">
									<input type="text" class="form-control form-control-sm" name="link_blibli" value="<?php echo (!empty($backingdata)) ? $backingdata["link_blibli"] : ''; ?>" placeholder="Link Blibli">
								</div>
								<div>
									<input type="text" class="form-control form-control-sm" name="youtube" value="<?php echo (!empty($backingdata)) ? $backingdata["youtube"] : ''; ?>" placeholder="YouTube Video ID">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 mt-4">
			<div class="card border-0 shadow-sm">
				<div class="card-header bg-dark text-dark">
					<h5 class="card-title mb-0">
						<i class="fas fa-shipping-fast me-2"></i>Estimasi Pengiriman
					</h5>
				</div>
				<div class="card-body">
					<div class="row g-4">
						<div class="col-md-6">
							<label class="form-label fw-semibold">Estimasi Normal</label>
							<div class="input-group">
								<input type="number" class="form-control" name="estimated_delivery" value="<?php echo (!empty($backingdata)) ? $backingdata["estimated_delivery"] : ''; ?>" placeholder="3">
								<span class="input-group-text">hari</span>
							</div>
							<small class="text-muted">Estimasi pengiriman untuk Jabodetabek</small>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Estimasi Indent</label>
							<div class="input-group">
								<input type="number" class="form-control" name="estimated_deliveryindent" value="<?php echo (!empty($backingdata)) ? $backingdata["estimated_deliveryindent"] : ''; ?>" placeholder="7">
								<span class="input-group-text">hari</span>
							</div>
							<small class="text-muted">Estimasi jika stok habis (indent)</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Description & Image Section -->
		<div class="col-md-12 mt-4">
			<div class="row g-4">
				<!-- Image Upload -->
				<div class="col-md-5">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-image me-2"></i>Gambar Produk
							</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label fw-semibold">Upload Gambar <span class="text-danger">*</span></label>
								<input type="file" class="form-control" id="file" name="fileimg" jq-model="fileupload" <?php echo (empty($this->input->get("id"))) ? "required" : ""; ?>>
								<div class="form-text">
									<small>
										<i class="fas fa-info-circle me-1"></i>
										Ukuran maksimal 3000x3000 px • Format: JPG/PNG
									</small>
								</div>
							</div>

							<?php if ($this->input->get("id")): ?>
								<?php $img = (!empty($backingdata)) ? $backingdata["img"] : ''; ?>
								<?php if ($backingdata && $backingdata["img"] != NULL): ?>
									<div class="text-center">
										<img src="<?php echo base_url() ?>public/image/product/<?php echo $backingdata["img"] ?>" class="img-fluid rounded shadow-sm blah" style="max-height: 200px;">
										<div class="mt-2">
											<small class="text-muted">Gambar saat ini</small>
										</div>
									</div>
								<?php endif ?>
							<?php else: ?>
								<div class="text-center border rounded p-4 bg-light">
									<i class="fas fa-image fa-3x text-muted mb-2"></i>
									<p class="text-muted mb-0">Preview gambar akan muncul di sini</p>
									<img class="img-fluid rounded mt-3 blah d-none">
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>

				<!-- Description -->
				<div class="col-md-7">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h5 class="card-title mb-0">
								<i class="fas fa-align-left me-2"></i>Deskripsi Produk
							</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label fw-semibold">Deskripsi Lengkap</label>
								<textarea class="form-control" jq-model="deskripsi" name="description" rows="8" placeholder="Jelaskan detail produk, fitur, keunggulan, dan spesifikasi..."><?php
																																															$description_br2nl = (!empty($backingdata)) ? str_replace("\n", " ", trim($backingdata["description"])) : '';
																																															$breaks = array("<br />", "<br>", "<br/>");
																																															$text = str_ireplace($breaks, "", $description_br2nl);
																																															echo $text; ?></textarea>
								<div class="form-text">
									<small>Gunakan deskripsi yang menarik dan informatif</small>
								</div>
							</div>

							<!-- Submit Button -->
							<div class="mt-4">
								<button class="btn btn-primary btn-lg w-100 py-3" type="submit">
									<i class="fas fa-save me-2"></i>
									<?php echo (!empty($this->input->get("id"))) ? 'Update Produk' : 'Simpan Produk'; ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Shipping Estimation -->

	</form>
</div>

<?php if (!empty($backingdata)): ?>
	<?php if ($backingdata["jenisproduct"] == ""): ?>
		<div class="modal fade pilihjenisproduk" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0 shadow-lg">
					<div class="modal-header bg-light border-bottom">
						<div class="w-100 text-center">
							<h4 class="modal-title fw-bold text-dark mb-1">Pilih Jenis Produk</h4>
							<p class="mb-0 text-muted small">Pilih kategori produk yang sesuai</p>
						</div>
					</div>
					<div class="modal-body p-4">
						<div class="row g-3 justify-content-center">
							<?php foreach ($jenisproduct as $key): ?>
								<div class="col-md-6">
									<button type="button" val="<?php echo $key ?>" class="btn btn-warning choicejenis w-100 p-3 rounded-3 shadow-sm text-dark hover-white">
										<span class="fw-bold"><?php echo $key ?></span>
									</button>
								</div>
							<?php endforeach ?>
						</div>
					</div>
					<div class="modal-footer bg-light border-top">
						<small class="text-muted">Pilihan akan menentukan form input produk</small>
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>
<?php else: ?>
	<div class="modal fade pilihjenisproduk" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0 shadow-lg">
				<div class="modal-header bg-primary text-white">
					<div class="w-100 text-center">
						<h4 class="modal-title fw-bold mb-2">Pilih Jenis Produk</h4>
						<p class="mb-0 opacity-90">Pilih kategori produk yang ingin ditambahkan</p>
					</div>
				</div>
				<div class="modal-body p-4">
					<div class="row g-3">
						<?php foreach ($jenisproduct as $key => $item): ?>
							<div class="col-md-6 col-lg-4">
								<button type="button" val="<?php echo $item ?>" class="btn btn-outline-primary choicejenis w-100 h-100 p-4 rounded-3 border-2 shadow-sm text-primary hover-white">
									<div class="text-center">
										<h6 class="fw-bold mb-2"><?php echo $item ?></h6>
										<small class="d-block">Klik untuk memilih</small>
									</div>
								</button>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="modal-footer bg-light">
					<small class="text-muted">Setiap kategori memiliki form input yang berbeda</small>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>