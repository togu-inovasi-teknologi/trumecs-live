<div class="container-fluid m-t-2">
    <div class="row">
        <section class="col-xs-12 p-a-0">
            <div class="shadow">
                <?php echo ($this->session->flashdata('message-failed') == "") ? "" :
                    '<div class="alert alert-danger f8 text-center fbold m-b-0">' .
                    $this->session->flashdata('message-failed') .
                    '</div>'; ?>
                <div class="login-page">
                    <div class="row p-a-1">
                        <?php $this->load->view("_form_login_page_v2_mobile") ?>
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