<form action="<?php echo base_url() ?>member/indata" method="POST" role="form" id="signup_member">
    <div class="col-lg d-flex flex-column gap-2 p-3">
        <p class="fs-3 fw-bold m-0 text-warning text-center">
            <?php echo $this->lang->line("daftar", FALSE); ?>
        </p>

        <div class="mb-2">
            <label for="name" class="form-label mb-1">
                <?php echo $this->lang->line("label_nama", FALSE); ?>
            </label>
            <input name="name" id="name" type="text" class="form-control"
                placeholder="<?php echo $this->lang->line("placeholder_input_nama", FALSE); ?>"
                autocomplete="off" required minlength="4">
        </div>

        <div class="mb-2">
            <label for="email" class="form-label mb-1">
                <?php echo $this->lang->line("label_email", FALSE); ?>
            </label>
            <input name="email" id="email" type="email" class="form-control"
                placeholder="<?php echo $this->lang->line("placeholder_input_email", FALSE); ?>"
                autocomplete="off" required
                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
        </div>

        <div class="mb-2 d-flex flex-column align-items-start">
            <label for="password" class="form-label mb-1">
                <?php echo $this->lang->line("label_password", FALSE); ?>
            </label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control password"
                    placeholder="<?php echo $this->lang->line("placeholder_input_password", FALSE); ?>"
                    required>
                <button class="btn btn-outline-secondary border-start-0 show-password-icon" type="button" value="1">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-2">
            <label class="fs-6 fw-bold form-label mb-1">
                <?php echo $this->lang->line("label_captcha", FALSE); ?>
            </label>
            <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
        </div>

        <div class="d-flex gap-1 fs-6 mb-2">
            <p class="m-0">Sudah Punya Akun?</p>
            <a href="#" class="login-button m-0 text-decoration-none">
                <?php echo $this->lang->line("tombol_masuk", FALSE); ?>
            </a>
        </div>

        <button class="form-control btn btn-warning w-100" type="submit">
            <?php echo $this->lang->line("tombol_daftar", FALSE); ?>
        </button>

        <!-- Optional: Privacy Policy Link (commented out) -->
        <!-- <div class="d-flex flex-column gap-1 align-items-center mt-2">
            <h6 class="fs-6 text-center">
                <?php echo sprintf(
                    $this->lang->line("signup_form_explanation", FALSE),
                    '<a href="' . base_url("page/31/Kebijakan-Privasi") . '" class="text-decoration-none">',
                    '</a>'
                ); ?>
            </h6>
        </div> -->
    </div>
</form>