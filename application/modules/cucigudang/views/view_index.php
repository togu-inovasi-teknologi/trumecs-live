<div class="promo_page">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view("c/_form-filter-search") ?>
		</div>
		<div class="col-md-9">
			<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url().'timthumb?h=200&src=' : ''; ?>
			<?php foreach ($listcucigudang as $key): ?>
			<a href="<?php echo base_url() ?>cucigudang/<?php echo $key["url"] ?>">
				<img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/cucigudang/<?php echo $key["img"] ?>" class="img-fluid" alt="<?php echo $key["name"] ?>">
				<span class="namepromo"><?php echo $key["name"] ?></span>
				<hr>
			</a>
			<?php endforeach ?>
		</div>
	</div>
</div>