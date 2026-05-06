<div class="promo_page container">
	<div class="row g-4">
		<div class="col-lg-12 pt-2">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a class="text-orange" href="<?php echo base_url() ?>">Home</a></li>
					<li class="breadcrumb-item"><a class="text-orange" href="<?php echo base_url() ?>promo">Promo</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb[0] ?></li>
				</ol>
			</nav>
		</div>

		<div class="col-lg-4">
			<div class="position-sticky top-2" style="top: 20px;">
				<div class="card shadow-sm border-0 overflow-hidden">
					<div class="mb-4">
						<?php foreach ($datalist["promo"] as $key) : ?>
							<h5 class="fw-bold text-dark mb-0">
								<span class="border-start border-4 border-warning ps-3">Produk <?php echo $key["name"]; ?></span>
							</h5>
						<?php endforeach ?>
					</div>

					<?php foreach ($datalist["promo"] as $key) : ?>
						<div class="card-body p-0">
							<img src="<?php echo base_url() ?>timthumb?h=170&src=<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>"
								class="img-fluid w-100"
								alt="<?php echo $key["name"]; ?>"
								style="height: 200px; object-fit: cover;">
						</div>

						<div class="p-3 border-top">
							<div class="mb-3">
								<label class="visually-hidden" for="cari-produk-promo">Cari Produk</label>
								<div class="input-group">
									<!-- <span class="input-group-text bg-white border-end-0">
										<i class="bi bi-search"></i>
									</span>
									<input type="text"
										name="cari-produk-promo"
										id="cari-produk-promo"
										placeholder="Cari Produk di <?php echo $key["name"]; ?>"
										class="form-control border-start-0 ps-0" /> -->
								</div>
							</div>

							<h6 class="fw-bold text-dark mb-2 pb-1 border-bottom border-2 border-warning d-inline-block">Deskripsi</h6>
							<p class="text-secondary small mt-2 mb-0 lh-base"><?php echo $key["description"]; ?></p>

							<?php if ($key['type'] == "bundle") { ?>
								<h6 class="fw-bold text-dark mb-2 mt-3 pb-1 border-bottom border-2 border-warning d-inline-block">Harga Bundle</h6>
								<p>
									<span class="fw-bold forange"> Rp <?php echo number_format($key["price"], 0, ',', '.'); ?> </span>
								</p>
							<?php } ?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>

		<div class="col-lg-8">
			<div class="card border-0 bg-transparent">
				<div class="card-body p-0">
					<div class="mb-4">

						<h5 class="fw-bold text-dark mb-0">
							<span class="border-start border-4 border-warning ps-3">List Produk</span>
						</h5>
					</div>
					<?php $this->load->view("_listproduct_all") ?>
				</div>
			</div>
		</div>
	</div>
</div>