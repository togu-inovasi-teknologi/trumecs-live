<div class="promo_page mt-3">
	<div class="row">
		<div class="col-12 px-0">
			<?php foreach ($datalist["promo"] as $key) : ?>
				<img src="<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid mb-3" style="width: 100%; max-height:150px;">
			<?php endforeach ?>
		</div>
		<div class="col-12">
			<h5 class="fw-bold mb-3" style="border-left: 2px solid #fa8420; padding-left:10px; font-size: 0.9rem;"><?php echo $key["name"]; ?></h5>
			<a data-bs-toggle="modal" data-bs-target="#deskripsi" class="text-decoration-none small text-warning">Lihat Deskripsi</a>
			<hr>
		</div>
		<div class="col-12">
			<?php $this->load->view("_listproduct_mobile.php") ?>
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
				<h5 class="fw-normal" style="font-size: 0.9rem;"><?php echo $key["description"]; ?></h5>
			</div>
		</div>
	</div>
</div>