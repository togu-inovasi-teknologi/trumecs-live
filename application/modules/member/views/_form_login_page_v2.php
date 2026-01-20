<form id="login_member" action="<?php echo base_url() ?>member/checkmember" method="POST" role="form">
	<div class="col-lg d-flex flex-column gap-3 p-3">
		<p class="fs-3 fw-bold m-0 text-warning text-center">
			<?php echo $this->lang->line("masuk", FALSE); ?>
		</p>
		<?php $last_page = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; ?>
		<input type="hidden" name="last_page" class="visually-hidden" placeholder="last_page" value="<?php echo $last_page ?>">

		<div class="mb-3">
			<label class="form-label mb-1">
				<?php echo $this->lang->line("label_email", FALSE); ?>
			</label>
			<input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" required>
		</div>

		<div class="mb-3 d-flex flex-column align-items-start">
			<label class="form-label mb-1">
				<?php echo $this->lang->line("label_password", FALSE); ?>
			</label>
			<div class="input-group">
				<input type="password" name="password" class="form-control password" placeholder="<?php echo $this->lang->line("placeholder_input_password", FALSE); ?>" required>
				<button class="btn btn-outline-secondary border-start-0 show-password-icon" type="button" value="1">
					<i class="fas fa-eye"></i>
				</button>
			</div>
		</div>

		<div class="d-flex flex-column gap-2">
			<div class="d-flex justify-content-between align-items-center">
				<label for="remember_me" class="m-0 fs-6 d-flex align-items-center gap-1">
					<input type="checkbox" name="remember_me" id="remember_me" class="m-0 form-check-input">
					<p class="m-0">Remember me</p>
				</label>
				<a href="<?php echo base_url() ?>member/formreset" class="fs-6 text-decoration-none">
					<?php echo $this->lang->line("link_forgot_password", FALSE); ?>
				</a>
			</div>

			<button class="btn btn-warning w-100" type="submit">
				<?php echo $this->lang->line("tombol_masuk", FALSE); ?>
			</button>

			<div class="d-flex gap-1 align-items-center fs-6">
				<p class="m-0"><?php echo $this->lang->line("cta_signup", FALSE); ?></p>
				<a href="#" class="signup-button text-decoration-none">
					<?php echo $this->lang->line("link_cta_signup", FALSE); ?>
				</a>
			</div>

			<p class="m-0 text-center fs-6">Atau</p>

			<div class="d-flex align-items-center gap-2">
				<p class="m-0 fs-6">Sign In :</p>
				<a class="btn bg-white shadow-sm border d-flex align-items-center justify-content-center gap-2"
					type="button"
					href="<?= base_url() ?>member/login_google">
					<img class="icon-a-15" src="<?= base_url() ?>public/icon/goggle.png" alt="goggle" />
				</a>
			</div>
		</div>
	</div>
</form>