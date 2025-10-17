<ul class="nav nav-tabs nav-tabs-search " id="myTab" role="tablist">
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
                                <?php foreach(main_categories() as $category) : ?>
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
</div>