<div class="promo_page m-t-1">
	<div class="row">
		<div class="col-xs-12 p-x-0">
			<?php foreach ($datalist["promo"] as $key) : ?>
				<img src="<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="image-fluid m-b-1" style="width: 100%; max-height:150px;">
			<?php endforeach ?>
		</div>
		<div class="col-xs-12">
			<h5 class="f15 fbold m-b-1" style="border-left: 2px solid #fa8420; padding-left:10px;"><?php echo $key["name"]; ?></h5>
			<a data-toggle="modal" data-target="#deskripsi" class="f11 forange">Lihat Deskripsi</a>
			<hr>
		</div>
		<div class="col-xs-12">
			<?php $this->load->view("_listproduct_mobile.php") ?>
		</div>
	</div>
</div>
<div class="modal fade" id="deskripsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-mobile" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title fbold" id="exampleModalLabel">Detail Deskripsi
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<div class="modal-body" style="overflow-y:scroll;max-height:90vh">
				<h5 class="f15"><?php echo $key["description"]; ?> </h5>
			</div>
		</div>
	</div>
</div>