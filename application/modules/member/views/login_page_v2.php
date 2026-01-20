<div class="container-fluid my-3">
    <div class="row">
        <section class="col-12 p-0" id="form">
            <a href="<?= base_url("/") ?>">
                <img src="<?= base_url() ?>public/image/login-page-new.png"
                    alt="login-page-background"
                    class="img-fluid w-100"
                    style="height: 80vh; object-fit: center;">
            </a>

            <div class="position-absolute top-50 end-0 translate-middle-y me-5" style="width: 400px;">
                <div class="bg-white rounded shadow-lg p-4">
                    <?php echo ($this->session->flashdata('message-failed') == "") ? "" :
                        '<div class="alert alert-danger text-center mb-3 fw-bold">' .
                        htmlspecialchars($this->session->flashdata('message-failed')) .
                        '</div>'; ?>

                    <!-- Login/Signup Tabs -->
                    <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab"
                                data-bs-target="#login" type="button" role="tab">
                                Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="signup-tab" data-bs-toggle="tab"
                                data-bs-target="#signup" type="button" role="tab">
                                Sign Up
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="authTabContent">
                        <!-- Login Form -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <?php $this->load->view("_form_login_page_v2") ?>
                        </div>

                        <!-- Signup Form -->
                        <div class="tab-pane fade" id="signup" role="tabpanel">
                            <?php $this->load->view("_form_signup_page_v2") ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Optional JavaScript for auto-hiding flash message -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide flash message after 5 seconds
        const alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(function() {
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove();
                }, 150);
            }, 5000);
        }
    });
</script>