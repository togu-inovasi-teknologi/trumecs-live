<div class="container">
	<div class="row pt-3">
		<div class="col-lg-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a class="text-warning" href="<?php echo base_url() ?>">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Promo</li>
				</ol>
			</nav>
		</div>

		<?php if (count($listpromo) >= 1) { ?>
			<div class="col-lg-12">
				<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : ''; ?>
				<?php foreach ($listpromo as $i => $key) : ?>
					<div class="row mb-5">
						<div class="col-lg-12 <?= $key['type'] == "promo" ? '' : 'd-flex justify-content-between' ?>">
							<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="h3 text-dark fw-bold text-decoration-none border-start border-4 border-<?= $key['type'] == "promo" ? 'danger' : 'warning' ?> ps-3 d-inline-block mb-3">
								<?php echo $key['name']; ?>
							</a>
							<?php if ($key['type'] == "bundle") { ?>
								<p>
									Dapatkan semua dengan harga <span class="fw-bold forange"> Rp <?php echo number_format($key["price"], 0, ',', '.'); ?> </span>
								</p>
							<?php } ?>
						</div>

						<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
							<div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
								<div class="card-body p-0">
									<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
										<img title="<?php echo $key["name"] ?>"
											src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>"
											class="img-fluid w-100"
											alt="<?php echo $key["name"] ?>"
											style="height: 200px; object-fit: cover; border-bottom: 1px solid #dee2e6;">
									</a>
									<div class="p-3">
										<?php $str = str_split($key["description"], 230); ?>
										<p class="text-secondary small mb-2"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0] ?></p>
										<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="text-warning fw-semibold text-decoration-none small">
											Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-8 col-md-12">
							<div class="ps-lg-4">
								<?php $this->load->view("_listproduct", array('listproduct' => $key['products'])) ?>
							</div>
						</div>

						<div class="col-lg-12 mt-4">
							<hr class="border-1 border-top border-secondary opacity-25">
						</div>
					</div>
				<?php endforeach ?>
			</div>
		<?php } else { ?>
			<div class="col-lg-12">
				<div class="alert alert-warning text-center border-0 rounded-4 shadow-sm">
					<h4 class="mb-0">Maaf sedang tidak ada promo</h4>
				</div>
			</div>
		<?php } ?>
	</div>
</div>