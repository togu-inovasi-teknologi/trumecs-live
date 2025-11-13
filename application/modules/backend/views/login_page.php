<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Admin Trumecs</title>

    <!-- Bootstrap 5.3.8 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d64235c5d9.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-panel {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .panel-heading {
            background: white;
            padding: 2rem 2rem 1rem 2rem;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }

        .panel-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-group {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #ced4da;
        }

        .input-group-text {
            background: #f8f9fa;
            border: none;
            padding: 0.75rem 1rem;
            min-width: 50px;
        }

        .form-control {
            border: none;
            padding: 0.75rem;
            background: white;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: none;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            border-radius: 6px;
            padding: 0.75rem 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-panel">
                    <div class="panel-heading">
                        <img src="<?php echo base_url() ?>public/image/logonew.png" width="200" class="mb-3">
                        <h4 class="fw-light mb-0">Please Sign In</h4>
                    </div>
                    <div class="panel-body">
                        <?php echo ($this->session->flashdata('message') == "") ? "" :
                            '<div class="alert alert-warning alert-dismissible fade show small" role="alert">' .
                            $this->session->flashdata('message') .
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'; ?>

                        <form role="form" action="<?php echo base_url() ?>backend/cek" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fa-solid fa-envelope text-muted"></i>
                                    </span>
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fa-solid fa-lock text-muted"></i>
                                    </span>
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.8 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>