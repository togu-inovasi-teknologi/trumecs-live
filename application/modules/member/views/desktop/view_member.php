<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$idmember = $sessionmember["id"];
$pointmember = $member[0]["point"];

$levelmember = $sessionmember["level"];
?>
<style>
    ul.list-group>li {
        padding: 5px;
    }

    ul.list-group>li>a {
        color: #000;
    }

    .sidebar_member .card .list-group {
        list-style: none;
    }

    .sidebar_member .card .list-group a {
        color: #000;
        text-decoration: none;
    }

    .sidebar_member .card .list-group a li {
        margin-bottom: 10px;
    }

    .sidebar_member .card .list-group a:hover {
        color: #fa8420;
        text-decoration: none;
    }
</style>
<div class="container m-y-1">
    <div class="row">
        <?php echo ($this->session->flashdata('message-success') == "") ? "" :
            '<div class="alert alert-success d-flex-sb align-items-center alert-dismissible" role="alert">' .
            $this->session->flashdata('message-success') .
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'; ?>
        <?php echo ($this->session->flashdata('message-failed') == "") ? "" :
            '<div class="alert alert-danger d-flex-sb align-items-center alert-dismissible" role="alert">' .
            $this->session->flashdata('message-failed') .
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'; ?>
        <div class="col-lg-3 sidebar_member sticky-member p-l-0">
            <div class="card bordercard" style="background: linear-gradient(to bottom right, #FF6348, #FFA502);margin-bottom:0;border-radius:0;">
                <div class="circle">
                </div>
                <div class="circle1">
                </div>
                <div class="circle2">
                </div>
                <div class="card-body p-a-1" style="z-index: 2;">
                    <div class="row">
                        <div class="col-lg d-flex align-items-center gap-3 p-l-1">
                            <?php if ($this->uri->segment(1) == "member" && $this->uri->segment(2) == "store") { ?>
                                <?php foreach ($store as $key) : ?>
                                    <img src="<?= $key['logo'] == null ? base_url('public/image/noimage.png') : base_url('public/image/store/logo/') . '/' . $key["logo"] ?>" alt="Avatar" class="avadesk" style="z-index: 3;position: relative;">
                                <?php endforeach ?>
                            <?php } else { ?>
                                <?php foreach ($member as $key) : ?>
                                    <?php $foto = (explode(":", $key['avatar'])); ?>
                                    <a href="<?php echo base_url() ?>member/setting">
                                        <?php if ($foto[0] == "https") { ?>
                                            <img src="<?= $key['avatar']; ?>" alt="Avatar" class="avadesk" style="z-index: 3;position: relative;">
                                        <?php } else { ?>
                                            <img src="<?= $key['avatar'] == null ? base_url('public/image/noimage.png') : base_url('public/image/member/') . '/' . $key["avatar"] ?>" alt="Avatar" class="avadesk" style="z-index: 3;position: relative;">
                                        <?php } ?>
                                    </a>
                                <?php endforeach ?>
                            <?php } ?>
                            <?php if ($this->uri->segment(1) == "member" && $this->uri->segment(2) == "store") { ?>
                                <?php foreach ($store as $keys) : ?>
                                    <h6 class="fbold fwhite m-a-0 p-a-0" style="z-index: 3;position: relative;"><?php echo $keys["name"]; ?></h6>
                                <?php endforeach ?>
                            <?php } else { ?>
                                <div class="d-flex flex-column align-items-start gap-2" style="z-index: 3;position: relative;">
                                    <h6 class="fbold fwhite p-a-0 m-a-0"><?php echo $namemember ?></h6>
                                    <strong class="label labelnew-<?php echo $levelmember ?>"><?php echo $levelmember ?></strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-x-1 p-t-1">
                <ul class="list-group">
                    <?php if ($this->uri->segment(1) == "member" && $this->uri->segment(2) == "store") { ?>
                        <a href="<?php echo base_url() ?>member">
                            <?php foreach ($member as $key) : ?>
                                <li class="d-flex-sb align-items-center">
                                    <div class="d-flex gap-1 align-items-center">
                                        <?php $foto = (explode(":", $key['avatar'])); ?>
                                        <?php if ($foto[0] == "https") { ?>
                                            <img src="<?= $key['avatar']; ?>" alt="Avatar" class="foto-desktop">
                                        <?php } else { ?>
                                            <img src="<?= $key['avatar'] == null ? base_url('public/image/noimage.png') : base_url('public/image/member/') . '/' . $key["avatar"] ?>" alt="Avatar" class="foto-desktop">
                                        <?php } ?>
                                        <h6 class="p-a-0 m-a-0"><?php echo $namemember; ?></h6>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                            <?php endforeach ?>
                        </a>
                    <?php } else if ($this->uri->segment(1) == "member") { ?>
                        <?php if (!$store) { ?>
                            <a href="<?php echo base_url(); ?>member/buat_toko">
                                <li> <i class="fa fa-building" style="margin-right:8px; color: #fa8420"></i>Buka Akun Bisnis<i class="fa fa-angle-right pull-right" style="margin-top:3px;"></i></li>
                            </a>
                        <?php } else { ?>
                            <?php foreach ($store as $key) : ?>
                                <a href="<?php echo base_url() ?>member/store/store">
                                    <?php $str = str_split($key["name"], 20); ?>
                                    <li class="d-flex-sb align-items-center">
                                        <div class="d-flex gap-1 align-items-center">
                                            <img src="<?php echo base_url(); ?>public/image/store/logo/<?php echo $key["logo"]; ?>" alt="logo" class="foto-desktop">
                                            <?php echo count($str) > 1 ? $str[0] . "..." : $str[0]; ?>
                                        </div>
                                        <i class="fa fa-angle-right"></i>
                                    </li>
                                </a>
                            <?php endforeach ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <hr class="row">
                <?php if ($this->uri->segment(1) == "member" && $this->uri->segment(2) == "store") { ?>
                    <ul class="list-group">
                        <a href="<?php echo base_url() ?>member/store">
                            <li>Akun Toko</li>
                        </a>
                        <!-- <a href="<?php echo base_url() ?>member/store/saldo">
							<li class="d-flex-sb align-items-center">
								<h6 class="m-a-0 p-a-0">Trucoins Toko</h6>
								<span class="m-a-0 p-a-0 forange"><?php echo number_format($pointmember, 0, ',', '.') ?></span>
							</li>
						</a> -->
                        <a href="#">
                            <li class="list-group-item p-a-0 border-none d-flex-sb align-items-center rotate-icon" data-toggle="collapse" data-target="#produk" aria-expanded="false" aria-controls="produk">
                                <span class="p-a-0 m-a-0">Produk</span>
                                <i class="fa fa-angle-down p-a-0 m-a-0"></i>
                            </li>
                        </a>

                        <div class="collapse" id="produk">
                            <a href="<?php echo base_url() ?>member/store/store_product">
                                <li class="m-l-1 border-none p-a-0"> Daftar Produk
                                </li>
                            </a>
                            <a href="<?php echo base_url() ?>member/store/store_addproduct">
                                <li class="m-l-1 border-none p-a-0">Tambah Produk
                                </li>
                            </a>
                        </div>
                        <a href="<?php echo base_url() ?>member/store/status">
                            <li>Status Toko</li>
                        </a>
                    </ul>
                <?php } else if ($this->uri->segment(1) == "member") { ?>
                    <ul class="list-group" style="list-style:none;">
                        <a href="<?php echo base_url() ?>member">
                            <li>Akun Profile</li>
                        </a>

                        <a href="#">
                            <li class="d-flex-sb align-items-center d-flex-sb align-items-center rotate-icon" data-target="#saldo" data-toggle="collapse" aria-expanded="false" aria-controls="saldo">
                                <h6 class="m-a-0 p-a-0">Trucoins</h6>
                                <i class="fa fa-angle-down p-a-0 m-a-0"></i>
                            </li>
                        </a>
                        <div class="collapse" id="saldo">
                            <a href="<?php echo base_url() ?>member/saldo">
                                <li class="m-l-1 border-none p-a-0 d-flex-sb align-items-center">
                                    <p>Tarik Saldo</p>
                                    <span class="m-a-0 p-a-0 forange"><?php echo number_format($pointmember, 0, ',', '.') ?></span>
                                </li>
                            </a>
                            <a href="<?php echo base_url() ?>member/saldoHistory">
                                <li class="m-l-1 border-none p-a-0"> Riwayat Trucoin
                                </li>
                            </a>
                        </div>
                        <a href="#">
                            <li class="list-group-item p-a-0 border-none d-flex-sb align-items-center rotate-icon" data-toggle="collapse" data-target="#rfq" aria-expanded="false" aria-controls="rfq">
                                <span class="p-a-0 m-a-0">RFQ</span>
                                <i class="fa fa-angle-down p-a-0 m-a-0"></i>
                            </li>
                        </a>
                        <div class="collapse" id="rfq">
                            <a href="<?php echo base_url() ?>member/bulk">
                                <li class="m-l-1 border-none p-a-0"> List RFQ
                                </li>
                            </a>
                            <a href="<?php echo base_url() ?>member/bulk_history">
                                <li class="m-l-1 border-none p-a-0"> History RFQ
                                </li>
                            </a>
                        </div>
                        <a href="<?php echo base_url() ?>member/confirmation_list">
                            <li>Konfirmasi Pesanan</li>
                        </a>
                        <a href="<?php echo base_url() ?>member/history">
                            <li>Riwayat Pesanan</li>
                        </a>
                        <!-- <a href="<?php echo base_url() ?>member/testimonialform">
                            <li>Testimonial</li>
                        </a> -->
                    </ul>
                <?php } ?>
                <hr class="row">
                <ul class="list-group" style="list-style:none;">
                    <a style="color:#ff0000" href="<?php echo site_url('member/logout'); ?>">
                        <li class="d-flex-sb align-items-center">
                            <p class="m-a-0">Keluar</p>
                            <i class="fa fa-sign-out"></i>
                        </li>
                    </a>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-lg-9 content p-r-0">
            <?php $arraynone = (array('shipping_method' => "", 'id_google' => 0, 'shipping_province' => "", "shipping_city" => "", 'company_field' => "", 'avatar' => null, 'verification_at' => '', 'expired_verification' => '')); ?>
            <?php if (in_array("", array_diff_assoc($sessionmember, $arraynone))) : ?>
                <div class="alert alert-warning">
                    <?= $this->lang->line('noteProfileNotComplete'); ?>
                </div>
            <?php endif ?>
            <?php if (isset($contentmember)) : ?>
                <?php $this->load->view($contentmember) ?>
            <?php endif ?>
        </div>
    </div>
</div>