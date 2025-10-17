<div class="promo_page m-t-3">
	<div class="row">
		<!-- <div class="col-md-3">
			<?php //$this->load->view("c/_form-filter-search") ?>
		</div> -->
			<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url().'timthumb?h=200&src=' : ''; ?>
			<?php foreach ($listpromo as $i=>$key): ?>
			<div class="col-md-4">
			<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
				<img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid" alt="<?php echo $key["name"] ?>">
				<span class="namepromo"><?php echo $key["name"] ?></span>
				<hr>
			</a>
			</div>
			<?php if(($i+1)%3==0): ?>
			<div class="clearfix"></div>
			<?php endif; ?>
			<?php endforeach ?>
	</div>
</div>