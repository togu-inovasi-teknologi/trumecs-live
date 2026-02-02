    <?php if ($this->uri->segment(1) == 'member' && $this->uri->segment(2) == 'login') { ?>
        <nav class="navbar fixed-top bg-dark" role="navigation">
            <div class="container-fluid">
                <div class="d-flex gap-2 align-items-center">
                    <a class="btn btn-warning" href="<?php echo base_url() ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <a href="<?php echo base_url("member/login") ?>" class="text-white fw-bold fs-5 text-decoration-none">
                        <?php echo $this->lang->line("masuk", FALSE); ?>
                    </a>
                </div>
            </div>
        </nav>
    <?php } else { ?>

        <!-- Header untuk logo dan search serta notif -->
        <nav class="navbar fixed-top bg-white shadow-sm" role="navigation">
            <div class="container-fluid">
                <div class="row w-100 align-items-center m-0 p-0">
                    <!-- Logo Section -->
                    <div id="logo" class="d-flex align-items-center">
                        <div class="col-1 p-0">
                            <button class="btn p-1 f20" data-bs-toggle="offcanvas" data-bs-target="#js-mobile-offcanvas">
                                <i class="bi bi-list text-dark"></i>
                            </button>
                        </div>
                        <div class="col-8 p-1">
                            <a href="<?php echo base_url() ?>">
                                <img src="<?php echo base_url() ?>public/image/logotrumecsnew.png" width="150" alt="Trumecs.com logo" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-3 text-end p-0">
                            <button style="color:#000; margin-right:10px;" class="btn p-0 f20 text-decoration-none" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="bi bi-search"></i>
                            </button>
                            <a class="f20 me-2 text-decoration-none" style="color:#000;">
                                <i class="bi bi-bell"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Search Form Section -->
                    <!-- <div id="searchfrom" class="d-none d-flex align-items-center w-100">
                        <div class="col-10 p-1">
                            <div class="input-group input-group-sm">
                                <div class="input-group-text p-0 border-0">
                                    <select class="form-select select-search-category border-end rounded-0">
                                        <?php if ($this->uri->segment(1) == "jasa") { ?>
                                            <option value="barang">Product</option>
                                            <option value="jasa" selected>Jasa</option>
                                            <option value="rental">Rental</option>
                                        <?php } else if ($this->uri->segment(1) == "rental") { ?>
                                            <option value="barang">Product</option>
                                            <option value="jasa">Jasa</option>
                                            <option value="rental" selected>Rental</option>
                                        <?php } else { ?>
                                            <option value="barang" selected>Product</option>
                                            <option value="jasa">Jasa</option>
                                            <option value="rental">Rental</option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <input type="text" class="form-control rounded-0"
                                    placeholder="<?php echo $this->lang->line('placeholder_pencarian', FALSE) ?>"
                                    value="<?php echo $this->input->get("nama"); ?>">
                            </div>
                        </div>
                        <div class="col-2 text-center p-0">
                            <a style="color:#6c757d;" class="f20 text-decoration-none" onclick="show()">
                                <i class="bi bi-search"></i>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>

        </nav>
    <?php } ?>

    <!-- Offcanvas Mobile Menu -->
    <div class="offcanvas offcanvas-start bg-black d-md-none" tabindex="-1" id="js-mobile-offcanvas" style="z-index: 99999;">
        <div class="offcanvas-header border-bottom">
            <div class="text-center w-100">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>public/image/logofooternew.png" alt="Trumecs.com logo" width="150" class="img-fluid">
                </a>
            </div>
            <button type="button text-white" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapskategori" aria-expanded="false" aria-controls="collapskategori">
                    <?php echo $this->lang->line('kategori', FALSE); ?>
                    <i class="bi bi-chevron-down icondropdown"></i>
                </li>
                <div class="collapse" id="collapskategori" style="background-color:#fff;">
                    <?php $this->load->model("general/General_model", 'M_general'); ?>
                    <?php foreach (main_categories() as $item) : if ($item['etc'] == 0): ?>
                            <li class="list-group-item f14 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapskategori-<?php echo $item['id'] ?>" aria-expanded="false" aria-controls="collapskategori">
                                <?php echo $item['name'] ?>
                                <i class="bi bi-chevron-down icondropdown"></i>
                            </li>
                            <div class="collapse" id="collapskategori-<?php echo $item['id'] ?>">
                                <a alt="Jual Sparepart Truk Komponen Engine" href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>" class="list-group-item list-group-item-warning f12 fblack text-decoration-none">
                                    Semua <?php echo $item['name'] ?>
                                </a>
                                <?php $this->load->model("general/General_model", 'M_general'); ?>
                                <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                <?php foreach ($kategoris as $items) : ?>
                                    <a alt="Jual Sparepart Truk Komponen Engine" href="<?php echo base_url(); ?>c/<?php echo $items['url'] ?>" class="list-group-item list-group-item-warning f10 fblack text-decoration-none">
                                        <?php echo $items['name'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>

                <a href="<?php echo base_url() ?>jasa" class="list-group-item list-group-item-action text-decoration-none">
                    Jasa
                </a>
                <a href="<?php echo base_url() ?>rental" class="list-group-item list-group-item-action text-decoration-none">
                    Rental
                </a>
                <a href="<?php echo base_url() ?>article" class="list-group-item list-group-item-action text-decoration-none">
                    <?php echo $this->lang->line('artikel', FALSE); ?>
                </a>
                <a href="<?php echo base_url('promo'); ?>" class="list-group-item list-group-item-action text-decoration-none">
                    <?php echo $this->lang->line('promo', FALSE); ?>
                </a>
                <a href="<?php echo base_url() ?>bulk" class="list-group-item list-group-item-action text-decoration-none">
                    RFQ
                </a>
                <a href="<?php echo site_url("page/syarat---ketentuan") ?>" class="list-group-item list-group-item-action text-decoration-none">
                    Syarat & Ketentuan
                </a>
                <a href="<?php echo site_url("page/kebijakan-retur") ?>" class="list-group-item list-group-item-action text-decoration-none">
                    Kebijakan Retur
                </a>
                <a href="<?php echo site_url("page/faq") ?>" class="list-group-item list-group-item-action text-decoration-none">
                    FAQ
                </a>

                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#join_partner" aria-expanded="false" aria-controls="join_partner">
                    <?php echo $this->lang->line('join_trumecs_mitra', FALSE); ?>
                    <i class="bi bi-chevron-down icondropdown"></i>
                </li>
                <div class="collapse" id="join_partner" style="background-color:#fff;">
                    <a href="<?= base_url('principal/form') ?>" class="list-group-item dropdownlist f14 text-decoration-none">
                        <?= $this->lang->line("join_principal", FALSE) ?>
                    </a>
                    <a href="<?= base_url('jasa/page') ?>" class="list-group-item dropdownlist f14 text-decoration-none">
                        <?= $this->lang->line("join_service", FALSE) ?>
                    </a>
                    <a href="<?= base_url('rental/page') ?>" class="list-group-item dropdownlist f14 text-decoration-none">
                        <?= $this->lang->line("join_rental", FALSE) ?>
                    </a>
                    <a href="<?= base_url('agent/form') ?>" class="list-group-item dropdownlist f14 text-decoration-none">
                        <?= $this->lang->line("join_agent", FALSE) ?>
                    </a>
                </div>

                <?php
                $session = $this->session->all_userdata();
                $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
                if ($sessionmember["id"] != null) :
                    $member = $session["member"];
                    $namemember = $member["name"];
                    $fotomember = $member["avatar"];
                ?>
                    <li class="list-group-item separator text-center"><small><strong>Menu Member</strong></small></li>
                    <a href="<?php echo base_url() ?>member/meeting" class="list-group-item list-group-item-info text-center text-decoration-none">Meeting</a>
                    <a href="<?php echo base_url() ?>member/penawaran" class="list-group-item list-group-item-info text-center text-decoration-none">Penawaran</a>
                    <a href="<?php echo base_url() ?>member/tender" class="list-group-item list-group-item-info text-center text-decoration-none">Undangan Tender</a>
                    <li class="list-group-item">
                        <a href="<?php echo base_url() ?>member/logout" class="text-decoration-none">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="<?php echo base_url() ?>public/image/member/<?php echo ($fotomember == null) ? "profile-default.png" : $fotomember ?>" alt="Avatar" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                    <p class="fw-bold f14 mb-0"><?php echo $namemember ?></p>
                                </div>
                                <i class="bi bi-box-arrow-right text-danger"></i>
                            </div>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="list-group-item">
                        <a class="btn btn-primary w-100" href="<?php echo base_url('member/login') ?>">
                            <?php echo $this->lang->line('daftar', FALSE); ?> / <?php echo $this->lang->line('masuk', FALSE); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="offcanvas-footer py-2 text-white bg-dark text-center">
            <small><strong><?php echo $this->lang->line('hubungi_kami', FALSE); ?>:</strong></small><br />
            <div class="my-1">
                <span class="bi bi-phone"></span>
                <small>
                    <a class="text-white text-decoration-none" href="tel:<?php echo platform_contact("phone") ?>" target="_blank" rel="noreferrer">
                        <?php echo platform_contact("phone") ?>
                    </a>
                </small>
            </div>
            <span class="bi bi-envelope"></span>
            <small>
                <a class="text-white text-decoration-none" href="mailto:<?php echo platform_contact("email") ?>" target="_blank" rel="noreferrer">
                    <?php echo platform_contact("email") ?>
                </a>
            </small>
        </div>
    </div>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form id="searchForm" class="input-group" id="inputsearch">
                        <input type="text"
                            class="form-control border-0 py-3 px-3"
                            placeholder="<?php echo $this->lang->line('placeholder_pencarian', FALSE) ?>"
                            value="<?php echo $this->input->get("nama"); ?>"
                            id="searchInput"
                            autofocus>
                        <button class="btn btn-primary text-white border-0 px-4" type="button" id="searchbuttontemplate">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .search-container .form-control,
        .search-container .input-group-text {
            border: 1px solid #dee2e6;
        }

        .select-search-category {
            width: 80px;
            background-color: #fa8420;
            color: #fff;
            border: none;
        }

        .select-search-category:hover {
            background-color: #e97610;
        }

        .icondropdown {
            float: right;
            margin-right: 5px;
            color: #666;
        }

        .dropdownlist {
            margin-left: 10px;
        }

        .avanav {
            width: 30px;
            height: 30px;
            object-fit: cover;
        }

        /* Custom offcanvas footer */
        .offcanvas-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Tambahkan padding top ke body untuk mengkompensasi fixed navbar */
        body {
            padding-top: 56px;
            /* Sesuaikan dengan tinggi navbar */
        }
    </style>