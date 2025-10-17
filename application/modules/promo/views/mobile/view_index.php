<div class="promo_page m-t-1">
	<!-- <div class="col-md-3">
			<?php //$this->load->view("c/_form-filter-search") 
			?>
		</div> -->
	<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : ''; ?>
	<?php foreach ($listpromo as $i => $key) : ?>
		<div class="card p-b-1 p-x-1">
			<div class="row">
				<div class="col-xs-12 p-a-0">
					<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
						<img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid" alt="<?php echo $key["name"] ?>" style="width: 100%; max-height:150px; border-bottom:0.5px solid #eee;">
					</a>
				</div>
				<div class="clearfix m-b-1"></div>
				<div class="col-xs-12">
					<?php $str = str_split($key["description"], 150); ?>
					<h5 class="fbold f15"><?php echo $key["name"] ?></h5>
					<h6 class="text-muted f11"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0]; ?></h6>
					<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="forange f11">Lihat Selengkapnya</a>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>