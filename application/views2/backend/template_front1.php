<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1">
    <?php $this->load->view("front/_favicon"); ?>
    <title>Admin Trumecs</title>
    <!-- Bootstrap Core CSS -->
    <?php if (1 == 2) : ?>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <?php else : ?>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap.4-alpha.css">
    <?php endif ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/template.backend.css">
    <?php
    /* if(isset($css)){
        foreach($css as $dt_css){
            echo '<link rel="stylesheet" href="'.$dt_css.'" />' ;
        }
    } */
    if (isset($css)) {
        $minicss = $this->minifile->create($css, 'css');
        echo '<link rel="stylesheet" href="' . base_url("asset/core/css/" . $minicss) . '" />';
    }
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.offcanvas.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/font-awesome-animation.css">
    <meta http-equiv="expires" content="Mon, 4 Jul 2016 05:00:00 GMT" />
    <!-- page specific plugin styles-->
    <link href="<?php echo base_url(); ?>asset/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style type="text/css">
        table.dataTable thead>tr>th {
            padding-right: 10px;
        }
    </style>
</head>

<body url="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" baseurl="<?php echo base_url() ?>">
    <!-- Navigation -->
    <?php if (!$this->agent->is_mobile()) {
        $this->load->view("backend/_navdesktop");
    } else {
        $this->load->view("backend/_navmobile");
    } ?>
    <!-- END Navigation -->
    <section style="margin-top:60px;">
        <div class="container-fluid">
            <?php if ($this->agent->is_mobile()) : ?><div class="col-md-12 m-y-2 ">
                    <div class="clearfix"></div>
                </div><?php endif ?>
            <div class="space">
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <!--<div class="col-md-3">
                    <?php if (!$this->agent->is_mobile()) {
                        //$this->load->view("backend/_menuadmin");
                    } ?>
                </div>-->
                <div class="col-md-12">
                    <?php echo ($this->session->flashdata('message') == "") ? "" :
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
                        $this->session->flashdata('message') .
                        '</div>'; ?>
                    <?php if (isset($content)) {
                        $this->load->view($content);
                    } ?>
                </div>
            </div>
        </div>
    </section>
    <!--<footer>
        <div class="container">
            <small class="vsmall">PT.Trisindo Raya Utama ©2016</small>
        </div>
    </footer>-->
    <?php
    $javascript = array(base_url() . "asset/js/jquery.js", base_url() . 'asset/js/bootstrap.min.js', base_url() . 'asset/js/bootstrap-toolkit.min.js', base_url() . 'asset/js/bootstrap.offcanvas.min.js');
    foreach ($javascript as $dt_javascript) {
        echo '<script src="' . $dt_javascript . '"></script>';
    }
    ?>
    <?php
    if (isset($distjs)) {
        foreach ($distjs as $dt_js) {
            echo '<script src="' . $dt_js . '"></script>';
        }
    }
    if (isset($js)) {
        $minijs = $this->minifile->create($js, 'js');
        echo "<script src=\"" . base_url("asset/core/js/" . $minijs) . "\"></script>";
    }
    ?>
    <script src="<?php echo base_url(); ?>asset/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable();
        });

        $.fn.dataTable.ext.errMode = 'none';

        $("#table1").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendproduct/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-myproduct").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendproduct/myproduct/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-lelang").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendlelang/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-artikel").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendartikel/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-myartikel").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendartikel/myartikel/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-page").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendpage/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-pengiriman").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendproduct/pengiriman/ambil_data') ?>",
                type: 'POST',
            }
        });

        $("#table-order").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendorder/ambil_data') ?>",
                type: 'POST',
                cache: false,
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });

        $("#table-confirm").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendconfirm/ambil_data') ?>",
                type: 'POST',
                cache: false,
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });

        $("#table-withdraw").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendconfirm/ambil_data_withdraw') ?>",
                type: 'POST',
                cache: false,
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });

        $("#table-member").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendmember/ambil_data') ?>",
                type: 'POST',
                cache: false,
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });

        $("#table-promo").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendpromo/ambil_data') ?>",
                type: 'POST',
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });

        $("#table-user").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backenduser/ambil_data') ?>",
                type: 'POST',
            }
        });


        $("#table-complaint").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendcomplaint/ambil_data') ?>",
                type: 'POST',
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });

        $("#table-produk-promo").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendpromo/ambil_data_product') ?>",
                type: 'POST',
                data: {
                    "id-promo": $("input[name='id-promo']").val()
                }
            }
        });

        $("#table-warranty").DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('backendcomplaintwarranty/ambil_data') ?>",
                type: 'POST',
                data: {
                    "status": $("input[name='status']").val()
                }
            }
        });
    </script>
    <style type="text/css">
        #pushstat {
            width: 0;
            height: 0;
            overflow: hidden;
            display: none !important;
        }
    </style>
</body>

</html>