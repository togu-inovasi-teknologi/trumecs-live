<div class="container-fluid mt-4">
    <div class="row">
        <section class="col-12 p-0">
            <div class="shadow">
                <?php echo ($this->session->flashdata('message-failed') == "") ? "" :
                    '<div class="alert alert-danger text-center fw-bold mb-0">' .
                    htmlspecialchars($this->session->flashdata('message-failed')) .
                    '</div>'; ?>

                <!-- Login Form -->
                <div class="login-page">
                    <div class="row p-3">
                        <?php $this->load->view("_form_login_page_v2_mobile") ?>
                    </div>
                </div>

                <!-- Signup Form (Initially Hidden) -->
                <div class="signup-page" style="display:none">
                    <div class="row p-3">
                        <?php $this->load->view("_form_signup_page_v2") ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>