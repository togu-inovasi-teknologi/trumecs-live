<div class="container">
	<div class="row">
		<!-- <div class="col-md-3">
			<?php //$this->load->view("c/_form-filter-search") 
			?>
		</div> -->
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
				<li>Promo</li>
			</ol>
		</div>
		<?php if (count($listpromo) >= 1) { ?>
			<div class="col-lg-12">
				<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : ''; ?>
				<?php foreach ($listpromo as $i => $key) : ?>
					<div class="row">
						<div class="col-lg-12 title-desktop">
							<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="title-content"><?php echo $key['name']; ?>
							</a>
						</div>
						<div class="clearfix" style="margin-bottom:30px;"></div>
						<div class="col-lg-4">
							<div class="card">
								<div class="row">
									<div class="col-lg-12">
										<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
											<img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid" alt="<?php echo $key["name"] ?>" style="width: 100%; max-height:150px; border:0.5px solid #eee;">
										</a>
									</div>
									<div class="col-lg-12 p-y-1 p-x-2" style="max-height: 145px;">
										<?php $str = str_split($key["description"], 230); ?>
										<h5 class="text-muted f13"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0] ?></h5>
										<a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="forange f13">Lihat Selengkapnya
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 p-x-1" style="border-left: 0.5px solid #ccc;">
							<?php $this->load->view("_listproduct", array('listproduct' => $key['products'])) ?>
						</div>
						<div class="clearfix m-b-1"></div>
						<div class="col-lg-12">
							<hr class="hr-solid">
						</div>
						<div class="clearfix m-b-1"></div>
					</div>
				<?php endforeach ?>
			</div>
		<?php } else { ?>
			<div class="col-lg-12">
				<div class="alert alert-warning text-center">
					<h4>Maaf sedang tidak ada promo</h4>
				</div>
			</div>
		<?php } ?>
	</div>
</div>