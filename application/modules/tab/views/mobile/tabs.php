<ul class="nav nav-tabs nav-tabs-search d-flex" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link tab-search border-0 py-2 f12 active" id="home-tab" data-bs-toggle="tab"
            data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
            <img src="<?= base_url('public/icon/ic-categori.svg') ?>" alt="" class="img-fluid" style="max-height: 20px;">
            <div class="small"><?= $this->lang->line("jelajah_categori", FALSE) ?></div>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link tab-search border-0 py-2 f12" id="profile-tab" data-bs-toggle="tab"
            data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
            <img src="<?= base_url('public/icon/ic-search.svg') ?>" alt="" class="img-fluid" style="max-height: 20px;">
            <div class="small"><?= $this->lang->line("search_product", FALSE) ?></div>
        </button>
    </li>
    <li class="nav-item text-center" role="presentation">
        <a href="<?= base_url('bulk') ?>" class="nav-link bg-primary text-white border-0 py-2 f12">
            <img src="<?= base_url('public/icon/ic-request.svg') ?>" alt="" class="img-fluid" style="max-height: 20px;">
            <div class="small"><?= $this->lang->line("send_rfq", FALSE) ?></div>
        </a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <!-- Tab Kategori -->
    <div class="tab-pane fade show active border p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row g-2">
            <?php foreach (main_categories() as $i) : ?>
                <div class="col-3 col-sm-3">
                    <a href="<?php echo base_url() ?>c/<?php echo $i["url"] ?>" class="text-decoration-none">
                        <div class="text-center">
                            <div class="bg-light rounded p-2 mb-1">
                                <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $i["url"]; ?>.png"
                                    alt="<?php echo $i["name"]; ?>" class="img-fluid" style="max-height: 50px; object-fit: contain;">
                            </div>
                            <p class="text-dark small mb-0 fw-bold"><?php echo $i["name"]; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <!-- Tab Pencarian -->
    <div class="tab-pane fade border p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form method="POST" action="<?= base_url('tab/search') ?>">
            <div class="mb-3">
                <label for="kata-kunci" class="form-label small fw-bold"><?= $this->lang->line('keyword_label', FALSE) ?></label>
                <div class="input-group border rounded">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fa fa-fw fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-0" id="kata-kunci" name="keyword"
                        placeholder="<?= $this->lang->line('keyword_label', FALSE) ?>">
                </div>
            </div>

            <div class="mb-3">
                <div class="row g-2">
                    <div class="col-12 col-sm-6">
                        <div class="mb-2">
                            <label for="category-options" class="form-label small fw-bold"><?= $this->lang->line('kategori_label_select', FALSE) ?></label>
                            <select class="form-select form-select-sm" id="category-options" name="komponen">
                                <option value="">=== <?= $this->lang->line('kategori_label_select', FALSE) ?> ===</option>
                                <?php foreach (main_categories() as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-2">
                            <label for="merk-options" class="form-label small fw-bold"><?= $this->lang->line('merk_label_select', FALSE) ?></label>
                            <select class="form-select form-select-sm" id="merk-options" name="merk">
                                <option value="">-- <?= $this->lang->line('merk_label_select', FALSE) ?> --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold" disabled id="btn-submit-search">
                <?= $this->lang->line('search_product', FALSE) ?>
            </button>
        </form>
    </div>
</div>

<style>
    .nav-tabs-search .nav-link {
        flex: 1;
        min-width: 0;
        padding: 8px 4px;
    }

    .nav-tabs-search .nav-link.active {
        background-color: #f8f9fa;
        border-bottom: 2px solid #007bff !important;
    }

    .nav-tabs-search img {
        display: block;
        margin: 0 auto 4px;
    }

    .nav-tabs-search .small {
        line-height: 1.2;
        word-break: break-word;
    }

    /* Untuk tampilan yang lebih compact di mobile */
    @media (max-width: 576px) {
        .nav-tabs-search .nav-link {
            padding: 6px 2px;
            font-size: 11px;
        }

        .tab-content .border {
            border-radius: 8px;
        }

        .col-3 {
            padding: 0 4px;
        }
    }
</style>

<script>
    // JavaScript untuk handle form validation (jika diperlukan)
    document.addEventListener('DOMContentLoaded', function() {
        const keywordInput = document.getElementById('kata-kunci');
        const categorySelect = document.getElementById('category-options');
        const submitButton = document.getElementById('btn-submit-search');

        function checkFormValidity() {
            const hasKeyword = keywordInput.value.trim() !== '';
            const hasCategory = categorySelect.value !== '';

            submitButton.disabled = !(hasKeyword || hasCategory);
        }

        keywordInput.addEventListener('input', checkFormValidity);
        categorySelect.addEventListener('change', checkFormValidity);
    });
</script>