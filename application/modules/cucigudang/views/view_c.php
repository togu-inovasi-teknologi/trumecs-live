<div class="promo_page">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view("c/_form-filter-search") ?>
		</div>
		<div class="col-md-9 <?php echo ($this->agent->is_mobile()) ? "p-x-0" : "" ; ?>">
			<?php $imgonmobile = ($this->agent->is_mobile()) ? base_url().'timthumb?h=200&src=' : ''; ?>
			<?php foreach ($datalist["cucigudang"] as $key): ?>
				<img src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/cucigudang/<?php echo $key["img"] ?>" class="img-fluid">
			<?php endforeach ?>
			<hr>
			<?php $data["breadcrumb"]=$breadcrumb ;
			$data["modebreadcrumb"]=array('cucigudang');

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