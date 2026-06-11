<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top p-0">
    <div class="container-fluid" style="max-width: 1500px;">
        <div class="d-flex justify-content-between align-items-center w-100 p-2">
            <!-- Logo -->
            <a href="<?php echo base_url() ?>" class="navbar-brand p-0">
                <img src="<?php echo base_url() ?>public/image/logofooternew.png" style="width: 200px; height: auto;">
            </a>

            <!-- Menu Utama -->
            <ul class="nav">
                <li class="nav-item dropdown dropdown-hover">
                    <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown">
                        <?= $this->lang->line('tentang_trumecs', FALSE) ?>
                    </a>
                    <div class="dropdown-menu p-3" style="min-width: 300px;">
                        <a class="dropdown-item" href="#tentang">Tentang Trumecs</a>
                        <a class="dropdown-item" href="/article">Artikel</a>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown">
                        <?= $this->lang->line('join_trumecs', FALSE) ?>
                    </a>
                    <div class="dropdown-menu p-3" style="min-width: 300px;">
                        <a class="dropdown-item" href="/principal/form"><?= $this->lang->line('join_principal', FALSE) ?></a>
                        <a class="dropdown-item" href="/principal/form"><?= $this->lang->line('join_agent', FALSE) ?></a>
                    </div>
                </li>
                <li class="nav-item"><a href="<?php echo site_url("page/faq"); ?>" class="nav-link text-white">FAQ</a></li>
                <li class="nav-item"><a href="<?php echo site_url("page/syarat---ketentuan"); ?>" class="nav-link text-white">Syarat & Ketentuan</a></li>
                <li class="nav-item"><a href="<?php echo site_url("page/kebijakan-retur"); ?>" class="nav-link text-white">Kebijakan Retur</a></li>
            </ul>

            <!-- Ikon Kanan -->
            <div class="d-flex align-items-center gap-3">
                <a href="<?php echo base_url() ?>cart" class="text-white position-relative">
                    <i class="bi bi-cart fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                        <?php echo count($this->cart->contents()) ?>
                    </span>
                </a>

                <?php $session = $this->session->all_userdata();
                $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
                if ($sessionmember["id"] != null) : ?>
                    <a href="<?php echo base_url() ?>chat" class="text-white"><i class="bi bi-chat-dots fs-5"></i></a>
                    <a href="<?php echo base_url() ?>notification" class="text-white"><i class="bi bi-bell fs-5"></i></a>
                    <a href="<?php echo base_url() ?>member" class="text-white"><i class="bi bi-person fs-5"></i></a>
                <?php else : ?>
                    <a href="<?php echo site_url('member/login'); ?>" class="btn btn-outline-light btn-sm">
                        <?php echo $this->lang->line('daftar', FALSE) ?> / <?php echo $this->lang->line('masuk', FALSE) ?>
                    </a>
                <?php endif ?>

                <!-- Dropdown Bahasa -->
                <div class="dropdown">
                    <button class="btn btn-link text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/<?php echo get_cookie('language'); ?>.png">
                        <?php echo $this->lang->line('bahasa'); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo 'http://www.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/id.png"> <?php echo $this->lang->line('bahasa_indonesia'); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo 'http://en.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/en.png"> <?php echo $this->lang->line('bahasa_inggris'); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo 'http://cn.192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>"><img style="width: 20px;" src="<?php echo base_url() ?>public/icon/flag/cn.png"> <?php echo $this->lang->line('bahasa_china'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>