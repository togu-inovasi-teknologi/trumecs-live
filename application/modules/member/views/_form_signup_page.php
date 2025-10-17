<form action="<?php echo base_url() ?>member/indata" method="POST" role="form" id="signup_member">
	<div class="">
		<div class="col-lg-12">
			<div class="text-center">
				<a href="<?php echo base_url() ?>">
					<img src="<?php echo base_url() ?>public/image/logotrumecsnew.png" width="200px">
				</a>
			</div>
			<?php echo ($this->session->flashdata('message') == "") ? "" :
				'<div class="alert alert-warning">' .
				$this->session->flashdata('message') .
				'</div>'; ?>
		</div>
		<br>
		<div class="col-lg-12 m-t-1">
			<label><?php echo $this->lang->line("label_nama", FALSE); ?></label>
			<input name="name" type="text" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_nama", FALSE); ?>" autocomplete="off" required>
		</div>
		<div class="col-lg-12 m-t-1">
			<label><?php echo $this->lang->line("label_email", FALSE); ?></label>
			<input name="email" type="email" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" autocomplete="off" required>
		</div>
		<div class="col-lg-12 m-t-1">
			<label><?php echo $this->lang->line("label_phone", FALSE); ?></label>
			<input name="telpon" type="text" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_phone", FALSE); ?>" autocomplete="off" required>
		</div>
		<div class="col-lg-12 m-t-1">
			<label><?php echo $this->lang->line("label_password", FALSE); ?></label>
			<input name="password" type="password" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_password", FALSE); ?>" autocomplete="off" required>
		</div>
		<!-- <div class="col-lg-12">
			<small><i>Nama Usaha</i></small>
			<input name="company" type="text" class="form-control" placeholder="Nama Usaha" autocomplete="off" required>
		</div>
        <div class="col-lg-12">
			<small><i>Bidang Usaha</i></small>
			<input name="company_field" type="text" class="form-control" placeholder="Bidang Usaha" autocomplete="off" required>
		</div>
		<div class="col-lg-12">
			<small><i>Provinsi</i></small>
			<select class="form-control" name="province">
				<option value="">--Pilih Provinsi--</option>
				<?php foreach ($provinces as $key) : ?>
					<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="col-lg-12">
			<small><i>Alamat</i></small>
			<input name="address" type="alamat" class="form-control" placeholder="Jl.xxxx" autocomplete="off" required>
		</div> -->
		<?php if ($this->agent->is_mobile()) { ?>
			<div class="col-lg-12">
				<label><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
				<div class="g-recaptcha m-t-1" style="margin-left: 35px;" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
			</div>
		<?php } else { ?>
			<div class="col-lg-12 m-t-1">
				<label><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
				<div class="g-recaptcha" style="margin-left: 70px;" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-12">
		<button class="form-control btn btnnew col-lg-12 m-y-1" type="submit"><?php echo $this->lang->line("tombol_daftar", FALSE); ?></button>
		<br>
		<h6><?php echo sprintf($this->lang->line("signup_form_explanation", FALSE), '<a href="' . base_url("page/31/Kebijakan-Privasi") . '">', '</a>'); ?></h6>
	</div>

</form>