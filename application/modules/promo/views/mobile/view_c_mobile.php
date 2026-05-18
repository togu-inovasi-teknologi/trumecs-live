<div class="promo_page mt-3">
	<div class="row">
		<?php foreach ($datalist["promo"] as $key) : ?>
			<div class="col-12 px-0">
				<img src="<?php echo base_url() ?>timthumb?h=400&src=<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid mb-3" style="width: 100%; max-height:200px; object-fit: cover;">
			</div>
			<div class="col-12">
				<h5 class="fw-bold mb-3" style="border-left: 2px solid #fa8420; padding-left:10px; font-size: 0.9rem;"><?php echo $key["name"]; ?></h5>
				<a data-bs-toggle="modal" data-bs-target="#deskripsi" class="text-decoration-none small text-warning click-lihat-detail-promo-mobile" data-google-tag="Detail Mobile - <?php echo $key['name']; ?>">Lihat Deskripsi</a>
				<hr>
			</div>
			<div class="col-12">
				<a style="border:1px solid #ccc"
                                                    href="https://wa.me/<?= (isset($key['admin_phone'])) ? $key['admin_phone'] : '6285176912338' ?>?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["name"] . ". Apakah Promo ini masih berlaku?") ?>"
                                                    class="btn btn-lg btnnew fw-bold text-center f14 wa-button-product"><i
                                                        class="fa fa-whatsapp fa-2x f18 me-1"></i><?php echo $this->lang->line('tombol_whatsapp', FALSE); ?></a>
			</div>
		<?php endforeach ?>
		<div class="col-12">
			<h5 class="fw-bold my-3">List Product</h5>
			<?php $this->load->view("_listproduct_all_mobile.php") ?>
		</div>
	</div>
</div>

<div class="modal fade" id="deskripsi" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title fw-bold" id="deskripsiModalLabel">Detail Deskripsi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h5 class="fw-normal" style="font-size: 0.9rem;"><?php echo nl2br($key["description"]); ?></h5>
				<div class="col-12 my-2">
					<?php if ($key['type'] == "bundle") { ?>
						<div class="d-flex flex-column gap-0">
							<p class="fs-6 mb-0 fw-bold">
								Harga Bundle :
							</p>
							<span class="fw-bold forange fs-5"> Rp <?php echo number_format($key["price"], 0, ',', '.'); ?> </span>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>