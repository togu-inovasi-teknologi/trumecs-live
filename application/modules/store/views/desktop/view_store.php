<?php $style = [];
if ($this->storeModel->styles != null) {
    foreach ($this->storeModel->styles as $key => $value) {
        $style[] = $value;
    }
} ?>
<div itemscope itemtype="https://schema.org/Brand">
    <section class="store-header bg-white" id="store-header">
        <div class="container-fluid">
            <div class="row d-flex flex-column gap-0">
                <div class="col-lg-12 p-a-0">
                    <div class="p-x-3 store-information" style="background-image: url(<?= $this->storeModel->cover == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/cover/' . $this->storeModel->cover) ?>);background-size: cover; height:400px; ">
                        <div class="store-info-left p-t-3 p-l-2 gap-4">
                            <div class="row d-flex-sb flex-row align-items-center">
                                <?php if ($this->storeModel->direction_title_image == 1) : ?>
                                    <div class="col-lg-<?= $this->storeModel->col_left ?> text-left">
                                        <img src="<?= base_url() ?>public/image/store/coverimage/<?= $this->storeModel->title_image ?>" alt="" style="height: 300px;">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-<?= $this->storeModel->direction_title_image == 1 ? $this->storeModel->col_right : $this->storeModel->col_left ?> text-<?= $this->storeModel->direction_title_image == 1 ? 'right' : 'left' ?> ">
                                    <div class="store-info d-flex flex-column gap-2">
                                        <h1 itemprop="slogan" class="font-weight-bold text-white" style="color:<?= $this->storeModel->color_title_cover ?>;"><?= $this->storeModel->title_cover ?></h1>
                                        <h4 class="fbold" style="color:<?= $this->storeModel->color_title_content ?>;line-height:1.5"><?= $this->storeModel->title_content ?></h4>
                                        <div class="store-info-right">
                                            <a href="<?= $this->uri->segment(2) == 'epcm' || $this->uri->segment(2) == 'service-vehicle' || $this->uri->segment(2) == 'chemicals' ? base_url('bulk') : 'https://wa.me/+6285176912338?text=' . $this->storeModel->domain ?>" class="btn text-white text-center shadow" style="background:<?= $style[0]->color_button == null ? '#000000' : $style[0]->color_button ?>;border-radius:5px;">
                                                <p class="f22 fbold">Minta Penawaran</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($this->storeModel->direction_title_image == 0) : ?>
                                    <div class="col-lg-<?= $this->storeModel->col_right ?> text-right">
                                        <img src="<?= base_url() ?>public/image/store/coverimage/<?= $this->storeModel->title_image ?>" alt="" style="height: 300px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-12 store-menu-tab">
                <nav class="nav p-y-1 d-flex gap-3">
                    <?php foreach ($tabs as $tab) : ?>
                        <?= $tab ?>
                    <?php endforeach; ?>
                </nav>
            </div> -->
            </div>
        </div>
    </section>
    <section class="content p-t-3" style="background-color: <?= $style[0]->color_bg == null ? '#ffffff' : $style[0]->color_bg ?>;">
        <div class="store-content" id="store-content">
            <?php $this->load->view($tabContent) ?>
        </div>
    </section>
</div>