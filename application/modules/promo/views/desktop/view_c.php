<div class="promo_page">
	<div class="row">
		<div class="col-lg-12 text-center">
			<?php $data["breadcrumb"] = $breadcrumb;
			$data["modebreadcrumb"] = array('promo');
			?>
			<?php $this->load->library("_viewbreadcrumb", $data) ?>
		</div>
		<div class="col-lg-4 sticky">
			<div class="card p-x-1 p-b-1">
				<div class="row">
					<div class="col-lg-12 p-a-0">
						<?php foreach ($datalist["promo"] as $key) : ?>
							<img src="<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="image-fluid" style="width: 100%; max-height:150px; border:0.5px solid #ccc;">
						<?php endforeach ?>
					</div>
					<div class="clearfix m-b-1"></div>
					<div class="col-lg-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input type="text" name="cari-produk-promo" id="cari-produk-promo" placeholder="Cari Produk di <?php echo $key["name"]; ?>" class="form-control" />
						</div>
					</div>
					<div class="clearfix m-b-1"></div>
					<div class="col-lg-12 title-mobile">
						<h6 class="title-content">Deskripsi</h6>
					</div>
					<div class="col-lg-12">
						<h5 class="text-muted f13"><?php echo $key["description"]; ?></h5>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12 title-desktop">
					<h6 class="title-content">Produk <?php echo $key["name"]; ?></h6>
				</div>
				<div class="clearfix m-b-1"></div>
				<div class="col-lg-12">
					<?php $this->load->view("_listproduct_all") ?>
				</div>
			</div>
		</div>
	</div>
</div>