<div class="dashboard row">
	<div class="col-md-12">
		<?php
		$ses=$this->session->all_userdata();

		 ?>
		<h2 class="f22 fbold">Halo <?php echo ucwords($ses["admin"]["nameadmin"]) ?>
		</h2>
		<strong>Selamat datang di area Admin Trumecs</strong>
	</div>
	<div class="clearfix"></div>
	<br/>
	<div class="col-xs-12">
		<p>
			Berikut adalah informasi statistik tautan anda
		</p>
	</div>
<!-- 	<div class="col-md-3 col-xs-12 col-sm-6">
		<a href="<?php echo base_url() ?>backendproduct/listall" class="btn btn-orange p-a-2">
			<div class="col-xs-3"><i class="fa fa-cubes fa-2"></i></div>
			<div class="col-xs-9">Produk</div>
		</a>
	</div>
	<div class="col-md-3 col-xs-12 col-sm-6">
		<a href="<?php echo base_url() ?>backendorder/?status=all" class="btn btn-orange p-a-2">
			<div class="col-xs-3"><i class="fa fa-cart-arrow-down fa-2"></i></div>
			<div class="col-xs-9">Pesanan</div>
		</a>
	</div>
	<div class="col-md-3 col-xs-12 col-sm-6">
		<a href="<?php echo base_url() ?>backendconfirm/?status=all" class="btn btn-orange p-a-2">
			<div class="col-xs-3"><i class="fa fa-file-text-o fa-2"></i></div>
			<div class="col-xs-9">Konfirmasi</div>
		</a>
	</div>
	<div class="col-md-3 col-xs-12 col-sm-6">
		<a href="" class="btn btn-orange p-a-2 col-xs-12" style="padding:0px;">
			<div class="col-xs-3"><i class="fa fa-comment fa-2"></i></div>
			<div class="col-xs-9">Chat</div>
		</a>
	</div> -->
</div>