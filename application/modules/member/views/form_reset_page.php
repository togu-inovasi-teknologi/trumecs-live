<div class="col-md-6 col-md-offset-3 text-center">
	<?php if($this->session->flashdata('message') == ""): ?>
		<?php echo $this->lang->line("form_reset_explanation", FALSE); ?>
	<div class="col-md-8 col-md-offset-2 ">
		<form action="<?php echo base_url() ?>member/resetpassword" method="POST" role="form" data-toggle="validator" >
			<div class="input-group input-group-sm">
		      <input type="email" class="form-control" name="email" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" required>
		      <span class="input-group-btn">
		        <button class="btn btn-orange " type="submit"><?php echo $this->lang->line("tombol_kirim", FALSE); ?></button>
		      </span>
		    </div>
	    </form>
	</div>
	<?php else: ?>
		<div class="alert alert-warning">
			<?php echo $this->session->flashdata('message') ?>
		</div>
	<?php endif ?>
</div>