<div class="promo_page mt-3">
	<!-- <div class="col-md-3">
			<?php //$this->load->view("c/_form-filter-search") 
			?>
		</div> -->
	<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : ''; ?>
	<?php foreach ($listpromo as $i => $key) : ?>
		<div class="card pb-2 px-2 mb-3">
			<div class="row g-0">
				<div class="col-12 p-0">
					<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
						<img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>timthumb?h=170&src=<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid" alt="<?php echo $key["name"] ?>" style="width: 100%; max-height:200px; border-bottom:0.5px solid #eee;">
					</a>
				</div>
				<div class="clearfix mb-3"></div>
				<div class="col-12">
					<?php $str = str_split($key["description"], 150); ?>
					<h5 class="fw-bold mb-2" style="font-size: 0.9rem;"><?php echo $key["name"] ?></h5>
					<p class="text-secondary small mb-2"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0]; ?></p>
					<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="text-decoration-none small text-warning">Lihat Selengkapnya</a>
				</div>
				<div class="col-12 my-2">
					<?php $this->load->view("_listproduct_mobile", array('listproduct' => $key['products'])) ?>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>