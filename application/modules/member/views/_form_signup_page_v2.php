<form action="<?php echo base_url() ?>member/indata" method="POST" role="form" id="signup_member">
    <div class="col-lg d-flex flex-column gap-2 p-a-1">
        <p class="f24 fbold m-a-0 forange text-center"><?php echo $this->lang->line("daftar", FALSE); ?></p>
        <div class="input-group">
            <label for="name"><?php echo $this->lang->line("label_nama", FALSE); ?></label>
            <input name="name" id="name" type="text" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_nama", FALSE); ?>" autocomplete="off" required minlength="4">
        </div>
        <div class="input-group">
            <label for="email"><?php echo $this->lang->line("label_email", FALSE); ?></label>
            <input name="email" id="email" type="email" class="form-control" placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>" autocomplete="off" required pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g">
        </div>
        <div class="input-group d-flex flex-column align-items-start">
            <label for="password"><?php echo $this->lang->line("label_password", FALSE); ?></label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control password" placeholder="<?php echo $this->lang->line("placeholder_input_password", FALSE); ?>" required>
                <span class="input-group-addon show-password-icon pointer" value="1"><i class="fa fa-eye"></i></span>
            </div>
        </div>
        <div class="input-group">
            <label class="f12 fbold"><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
            <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
        </div>
        <div class="d-flex gap-1 f14">
            <p class=" m-a-0">Sudah Punya Akun?</p>
            <a href="#" class="login-button m-a-0 "><?php echo $this->lang->line("tombol_masuk", FALSE); ?></a>
        </div>
        <button class="form-control btn btnnew btn-block" type="submit"><?php echo $this->lang->line("tombol_daftar", FALSE); ?></button>
        <!-- <div class="d-flex flex-column gap-1 align-items-center">

            <h6><?php echo sprintf($this->lang->line("signup_form_explanation", FALSE), '<a href="' . base_url("page/31/Kebijakan-Privasi") . '">', '</a>'); ?></h6>
        </div> -->
    </div>
</form>