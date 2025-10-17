<div class="col-md-6 col-md-offset-3 text-center">
	<?php if($this->session->flashdata('message') != ""): ?>
		<div class="alert alert-warning">
			<?php echo $this->session->flashdata('message') ?>
		</div>
	<?php endif ?>
</div>