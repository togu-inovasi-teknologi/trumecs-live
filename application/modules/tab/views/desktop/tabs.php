<!-- <ul class="nav nav-tabs nav-tabs-search " id="myTab" role="tablist">
    <li class="nav-item active" role="presentation">
        <button class="nav-link tab-search radius-none active  p-y-sm" id="home-tab" data-toggle="tab"
            data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
            <img src="<?= base_url('public/icon/ic-categori.svg') ?>" alt="">
            <?= $this->lang->line("jelajah_categori", FALSE) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link tab-search radius-none p-y-sm" id="profile-tab" data-toggle="tab" data-target="#profile"
            type="button" role="tab" aria-controls="profile" aria-selected="false">
            <img src="<?= base_url('public/icon/ic-search.svg') ?>" alt="">
            <?= $this->lang->line("search_product", FALSE) ?></button>
    </li>
    <li class="nav-item" role="presentation">
        <a href="<?= base_url('/bulk') ?>" class="nav-link bg-tru-primary radius-none p-y-sm fwhite">
            <img src="<?= base_url('public/icon/ic-request.svg') ?>" alt="">
            <?= $this->lang->line("send_rfq", FALSE) ?></a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane border-sm fade show active p-x-sm p-y-sm in" id="home" role="tabpanel"
        aria-labelledby="home-tab">
        <div class="row">
            <?php foreach (main_categories() as $i) : ?>
            <div class="col-lg-1--5">
                <a href="<?php echo base_url() ?>c/<?php echo $i["url"] ?>" style="text-decoration: none;">
                    <div class="card text-center card-shadow p-a-1">
                        <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $i["url"]; ?>.png"
                            alt="<?php echo $i["name"]; ?>">
                        <h6 class="fblack f13 m-t-1"><?php echo $i["name"]; ?></h6>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="tab-pane fade border-sm p-x-sm p-y-sm" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form method="POST" action="<?= base_url('tab/search') ?>">
            <div class="form-group">
                <label for="kata-kunci"><?= $this->lang->line('keyword_label', FALSE) ?></label>
                <div class="input-group border-sm">
                    <div class="input-group-addon bg-transparent border-none"><i class="fa fa-fw fa-search"></i></div>
                    <input type="text" class="form-control border-none" id="kata-kunci" name="keyword"
                        placeholder="<?= $this->lang->line('keyword_label', FALSE) ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category"><?= $this->lang->line('kategori_label_select', FALSE) ?></label>
                            <select class="form-control" id="category-options" name="komponen">
                                <option value="">=== <?= $this->lang->line('kategori_label_select', FALSE) ?> ====
                                </option>
                                <?php foreach (main_categories() as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="merk"><?= $this->lang->line('merk_label_select', FALSE) ?></label>
                            <select class="form-control" id="merk-options" name="merk">
                                <option>-- <?= $this->lang->line('merk_label_select', FALSE) ?> --
                                </option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn bg-tru-primary fwhite" disabled=""
                id="btn-submit-search"><?= $this->lang->line('search_product', FALSE) ?></button>
        </form>
    </div>
    <div class="tab-pane fade border-sm p-x-sm p-y-sm" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <?php $this->load->view('bulk/desktop/form_v2') ?>
    </div>
</div> -->

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active d-flex align-items-center gap-2 py-3" id="home-tab" data-bs-toggle="tab"
            data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
            <img src="<?= base_url('public/icon/ic-categori.svg') ?>" alt="" width="20" height="20">
            <?= $this->lang->line("jelajah_categori", FALSE) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link d-flex align-items-center gap-2 py-3" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
            type="button" role="tab" aria-controls="profile" aria-selected="false">
            <img src="<?= base_url('public/icon/ic-search.svg') ?>" alt="" width="20" height="20">
            <?= $this->lang->line("search_product", FALSE) ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <a href="<?= base_url('/bulk') ?>" class="nav-link bg-primary text-white d-flex align-items-center gap-2 py-3">
            <img src="<?= base_url('public/icon/ic-request.svg') ?>" alt="" width="20" height="20">
            <?= $this->lang->line("send_rfq", FALSE) ?>
        </a>
    </li>
</ul>

<div class="tab-content border border-top-0 rounded-bottom p-4" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row g-3">
            <?php foreach (main_categories() as $i) : ?>
                <div class="col-lg-3">
                    <a href="<?php echo base_url() ?>c/<?php echo $i["url"] ?>" class="text-decoration-none">
                        <div class="card h-100 text-center shadow-sm border-0 p-3 hover-shadow">
                            <div class="card-body p-0">
                                <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $i["url"]; ?>.png"
                                    alt="<?php echo $i["name"]; ?>" class="img-fluid mb-2" style="height: 60px; object-fit: contain;">
                                <h6 class="text-dark fw-semibold mb-0 small"><?php echo $i["name"]; ?></h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form method="POST" action="<?= base_url('tab/search') ?>">
            <div class="mb-3">
                <label for="kata-kunci" class="form-label fw-semibold"><?= $this->lang->line('keyword_label', FALSE) ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="kata-kunci" name="keyword"
                        placeholder="<?= $this->lang->line('keyword_label', FALSE) ?>">
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category-options" class="form-label fw-semibold"><?= $this->lang->line('kategori_label_select', FALSE) ?></label>
                        <select class="form-select" id="category-options" name="komponen">
                            <option value="">=== <?= $this->lang->line('kategori_label_select', FALSE) ?> ===</option>
                            <?php foreach (main_categories() as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="merk-options" class="form-label fw-semibold"><?= $this->lang->line('merk_label_select', FALSE) ?></label>
                        <select class="form-select" id="merk-options" name="merk">
                            <option value="">-- <?= $this->lang->line('merk_label_select', FALSE) ?> --</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-4" disabled id="btn-submit-search">
                <?= $this->lang->line('search_product', FALSE) ?>
            </button>
        </form>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .nav-link {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
</style>