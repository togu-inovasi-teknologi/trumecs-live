<form id="login_member" action="<?php echo base_url() ?>member/checkmember" method="POST" role="form">
	<div class="col-lg d-flex flex-column gap-3 p-a-1">
		<p class="f24 fbold m-a-0 forange text-center"><?php echo $this->lang->line("masuk", FALSE); ?></p>
		<?php $last_page = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; ?>
		<input type="hidden" name="last_page" class="hidden" placeholder="last_page" value="<?php echo $last_page ?>">
		<div class="input-group">
			<label><?php echo $this->lang->line("label_email", FALSE); ?></label>
			<input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" required>
		</div>
		<div class="input-group d-flex flex-column align-items-start">
			<label><?php echo $this->lang->line("label_password", FALSE); ?></label>
			<div class="input-group">
				<input type="password" name="password" class="form-control password" placeholder="<?php echo $this->lang->line("placeholder_input_password", FALSE); ?>" required>
				<span class="input-group-addon show-password-icon pointer" value="1"><i class="fa fa-eye"></i></span>
			</div>
		</div>
		<div class="d-flex flex-column gap-2">
			<div class="d-flex-sb align-items-center">
				<label for="remember_me" class="m-a-0 f12 d-flex-ai-center gap-1">
					<input type="checkbox" name="remember_me" id="remember_me" class="m-a-0">
					<p class="m-a-0">Remember me</p>
				</label>
				<a href="<?php echo base_url() ?>member/formreset" class="f12"><?php echo $this->lang->line("link_forgot_password", FALSE); ?></a>
			</div>
			<button class="btn btnnew btn-block" type="submit"><?php echo $this->lang->line("tombol_masuk", FALSE); ?></button>
			<div class="d-flex gap-1 align-items-center f12">
				<p class="m-a-0"><?php echo $this->lang->line("cta_signup", FALSE); ?></p>
				<a href="#" class="signup-button"><?php echo $this->lang->line("link_cta_signup", FALSE); ?></a>
			</div>
			<p class="m-a-0 text-center f12">Atau</p>
			<div class="d-flex-ai-center gap-2">
				<p class="m-a-0 f12">Sign In :</p>
				<a class="btn bg-white shadow border-sm d-flex-ai-center justify-content-center gap-2" type="button" href="<?= base_url() ?>member/login_google"><img class="icon-a-15" src="<?= base_url() ?>public/icon/goggle.png" alt="goggle" />
				</a>
			</div>
		</div>

	</div>
</form>