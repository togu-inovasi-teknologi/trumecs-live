<form id="login_member" action="<?php echo base_url() ?>member/checkmember" method="POST" role="form">
	<div class="col-lg-12">
		<div class="text-center">
			<a href="<?php echo base_url() ?>">
				<img src="<?php echo base_url() ?>public/image/logotrumecsnew.png" width="200px">
			</a>
		</div>
		<?php $last_page = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; ?>
		<input type="hidden" name="last_page" class="hidden" placeholder="last_page" value="<?php echo $last_page ?>">

		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<br>
	<div class="col-lg-12 m-t-1">
		<label><?php echo $this->lang->line("label_email", FALSE); ?></label>
		<input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" required>
	</div>
	<div class="col-lg-12 m-t-1">
		<label><?php echo $this->lang->line("label_password", FALSE); ?></label>
		<input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_password", FALSE); ?>" required>
	</div>
	<div class="col-lg-12 p-y-1 m-t-1">
		<button class="form-control btn btnnew" type="submit"><?php echo $this->lang->line("tombol_masuk", FALSE); ?></button>
	</div>

	<div class="col-lg-12 p-t-1 text-center">
		<a href="<?php echo base_url() ?>member/formreset"><?php echo $this->lang->line("link_forgot_password", FALSE); ?></a>
	</div>
	<div class="col-lg-12 p-t-2 text-center">
		<strong><?php echo $this->lang->line("cta_signup", FALSE); ?></strong><br>
		<a href="<?php echo base_url() ?>member/signup"><?php echo $this->lang->line("link_cta_signup", FALSE); ?></a>
	</div>
</form>