<?php
$session = $this->session->all_userdata();
$sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
$this->load->model("general/General_model", 'M_general');
$kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0]);
$style = [];
if ($this->storeModel->styles != null) {
    foreach ($this->storeModel->styles as $key => $value) {
        $style[] = $value;
    }
}
?>

<nav class="navbar radius-none" role="navigation" style="background-color: <?= $style[0]->color_nav == null ? '#000' : $style[0]->color_nav  ?>;">
    <div class="container-fluid fbold">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col-lg">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>public/image/logofooternew.png">
                </a>
            </div>
            <div class="col-lg-8 d-flex-sb align-items-center">
                <div class="dropdown-store">
                    <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text ?>;text-decoration:none;"
                        class="dropdown-toggle-store dropdown-toggle"
                        href="#"
                        id="navbarDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <span class="fa fa-bars" style="vertical-align:middle;margin-right:10px;"></span>
                        <?php echo $this->lang->line('kategori', FALSE); ?>
                    </a>

                    <div class="dropdown-menu-store dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="mega-menu-store">
                            <!-- Sidebar Kategori - HANYA SATU FOREACH -->
                            <div class="menu-sidebar">
                                <?php foreach ($kategori as $item) : ?>
                                    <div class="menu-item-store">
                                        <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>">
                                            <?php echo $item['name'] ?>
                                            <i class="fa fa-angle-right"></i>
                                        </a>

                                        <!-- SUBMENU DI DALAM MENU ITEM -->
                                        <div class="mega-submenu-store">
                                            <div class="submenu-header">
                                                <div class="header-left">
                                                    <img src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $item['url']; ?>.svg" />
                                                    <h3><?php echo $item['name'] ?></h3>
                                                </div>
                                                <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>" class="see-all">
                                                    Lihat Semua <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </div>
                                            <div class="submenu-content-store">
                                                <div class="section-store">
                                                    <ul>
                                                        <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                                        <?php if (!empty($kategoris)): ?>
                                                            <?php foreach ($kategoris as $items) : ?>
                                                                <li>
                                                                    <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>"
                                                                        class="list-kategori-atas-store">
                                                                        <?php echo $items['name'] ?>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <li class="no-subcategory">
                                                                <p>Tidak ada subkategori</p>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a style=" color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" href="<?php echo site_url('article'); ?>" class=" <?php echo ($this->uri->segment(1) == "article") ? "forange" : ""; ?>"><?php echo $this->lang->line('artikel', FALSE); ?></a>
                <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" href=" <?php echo site_url('promo'); ?>" class=" <?php echo ($this->uri->segment(1) == "promo") ? "forange" : ""; ?>"><?php echo $this->lang->line('promo', FALSE) ?></a>
                <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" href=" <?php echo site_url('rental'); ?>" class=" <?php echo ($this->uri->segment(1) == "rental") ? "forange" : ""; ?>"><?= $this->lang->line('rental_label') ?></a>
                <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" href=" <?php echo site_url('jasa'); ?>" class=" <?php echo ($this->uri->segment(1) == "jasa") ? "forange" : ""; ?>"><?= $this->lang->line('jasa_label') ?></a>
                <!-- <div class="dropdown">
                    <a href="<?php echo site_url('rental'); ?>"
                        class=" <?php echo ($this->uri->segment(1) == "rental") ? "forange" : ""; ?>"><?= $this->lang->line('join_trumecs_mitra') ?></a>
                    </div> -->
                <div class="dropdown dropdown-partner dropdown-partner">
                    <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" href="" class=" dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?= $this->lang->line('join_trumecs_mitra') ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-partner" aria-labelledby="dropdownMenu1">
                        <a href="<?= base_url('principal/form') ?>" class="text-dark"><?= $this->lang->line("join_principal", FALSE) ?></a>
                        <a href="<?= base_url('jasa/page') ?>" class="text-muted"><?= $this->lang->line("join_service", FALSE) ?></a>
                        <a href="<?= base_url('rental/page') ?>" class="text-muted"><?= $this->lang->line("join_rental", FALSE) ?></a>
                    </ul>
                </div>
            </div>
            <div class="col-lg">
                <div style="text-align:end;">
                    <?php
                    if ($sessionmember["id"] != null) :
                        $member = $session["member"];
                        $namemember = $member["name"];
                        $fotomember = $member["avatar"];
                        $foto = (explode(':', $fotomember));
                    ?>
                        <li class="d-down">
                            <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" class="f24" href="<?php echo base_url() ?>member" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                            <ul class="d-down-content-akun" aria-labelledby="navbarDropdown">
                                <div class="col-lg-12 p-x-0">
                                    <a href="<?php echo base_url() ?>member">
                                        <div class="card card-shadow card-akun d-flex align-items-center gap-3 m-b-0">
                                            <?php if ($foto[0] == 'https') { ?>
                                                <img src="<?= $fotomember ?>" alt="Avatar" class="avanav">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url() ?>public/image/member/<?php echo ($fotomember == null) ? "profile-default.png" : $fotomember ?>" alt="Avatar" class="avanav">
                                            <?php } ?>
                                            <div class="d-flex flex-column">
                                                <h6 class="fbold f12 fblack"><?php echo $namemember ?></h6>
                                                <h6 class="text-muted f10">Akun Saya</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-12 p-x-0" style="border-bottom: 0.5px solid #ccc;">
                                    <div class="row">
                                        <div class="col-lg-6" style="border-right: 0.5px solid #ccc;">
                                            <a href="<?php echo base_url() ?>member/store" class="list d-flex-sb align-items-center">Toko <i class="fa fa-building"></i></a>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="<?php echo base_url() ?>member/bulk" class="list d-flex-sb align-items-center">RFQ Saya <i class="fa fa-files-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <a href="<?php echo base_url() ?>member/logout" class="list d-flex-sb align-items-center">Keluar <i class="fa fa-sign-out fred"></i></a>
                                </div>
                            </ul>
                        </li>
                    <?php else : ?>
                        <a style="color:<?= $style[0]->color_nav_text == null ? '#fff' : $style[0]->color_nav_text  ?>;text-decoration:none;" href="<?php echo site_url('member/login'); ?>" class="daftar-login"><?php echo $this->lang->line('daftar', FALSE) ?> /
                            <?php echo $this->lang->line('masuk', FALSE) ?></a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownStore = document.querySelector('.dropdown-store');
        const dropdownToggle = document.querySelector('.dropdown-toggle-store');

        // Toggle main dropdown
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            dropdownStore.classList.toggle('show');
        });

        // Close dropdown ketika klik di luar
        document.addEventListener('click', function(e) {
            if (!dropdownStore.contains(e.target)) {
                dropdownStore.classList.remove('show');
            }
        });
    });
</script>