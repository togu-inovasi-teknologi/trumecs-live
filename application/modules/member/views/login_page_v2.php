<div class="container-fluid m-y-1">
    <div class="row">
        <section class="col-lg-12 p-a-0" id="form">
            <a href="<?= base_url("/") ?>">
                <img style="width:100%;height:80vh;" src="<?= base_url() ?>public/image/login-page-new.png" alt="login-page-background">
            </a>
            <div class="form-login shadow">
                <?php echo ($this->session->flashdata('message-failed') == "") ? "" :
                    '<div class="alert alert-danger f8 text-center fbold m-b-0">' .
                    $this->session->flashdata('message-failed') .
                    '</div>'; ?>
                <div class="login-page">
                    <div class="row p-a-1">
                        <?php $this->load->view("_form_login_page_v2") ?>
                    </div>
                </div>
                <div class="signup-page" style="display:none">
                    <div class="row p-a-1">
                        <?php $this->load->view("_form_signup_page_v2") ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>