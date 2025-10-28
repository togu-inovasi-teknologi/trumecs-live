<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Admin Trumecs</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>asset/backend/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>asset/backend/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>asset/backend/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="<?php echo base_url() ?>public/image/logonew.png" width="200px">
                        <h3 class="panel-title">Please Sign In</h3>
                        <?php echo ($this->session->flashdata('message') == "") ? "" :
                            '<div class="alert alert-warning">' .
                            $this->session->flashdata('message') .
                            '</div>'; ?>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo base_url() ?>backend/cek" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                Change this to a button or input when using this as a form
                                <button href="index.html" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="<?php echo base_url() ?>public/image/logonew.png" width="160" class="m-b-1">
                        <h4 class="font-weight-light mb-0">Welcome Back</h4>
                    </div>
                    <div class="panel-body">
                        <?php echo ($this->session->flashdata('message') == "") ? "" :
                            '<div class="alert alert-warning alert-dismissible fade show small" role="alert">' .
                            $this->session->flashdata('message') .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></div>'; ?>

                        <form role="form" action="<?php echo base_url() ?>backend/cek" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fa fa-envelope text-muted"></i>
                                    </span>
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fa fa-lock text-muted"></i>
                                    </span>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button href="index.html" class="btn btn-lg btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>asset/backend/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>asset/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>asset/backend/dist/js/sb-admin-2.js"></script>

</body>

</html>