<div class="promo_page">
	<div class="row">
		<div class="col-md-12 <?php echo ($this->agent->is_mobile()) ? "p-x-0" : "" ; ?> text-center">
			<?php foreach ($datalist["promo"] as $key): ?>
				<img src="<?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="">
			<?php endforeach ?>
			<hr>
			<?php $data["breadcrumb"]=$breadcrumb ;
			$data["modebreadcrumb"]=array('promo');

			?>
			<?php if (!$this->agent->is_mobile()): ?>
			<div class="m-y-1">
				<?php $this->load->library("_viewbreadcrumb",$data)?>
			</div>
			<hr>
			<?php endif ?>
		</div>
		<div class="col-md-12">
			<?php $this->load->view("_listproduct")?>
		</div>
	</div>
</div>