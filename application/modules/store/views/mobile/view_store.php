<?php $style = [];
if ($this->storeModel->styles != null) {
    foreach ($this->storeModel->styles as $key => $value) {
        $style[] = $value;
    }
} ?>
<div itemscope itemtype="https://schema.org/Brand">
    <section class="store-header bg-white" id="store-header">
        <div class="container">
            <div class="row d-flex flex-column p-t-0">
                <div class="col-lg-12 store-information d-flex align-items-center justify-content-center" style="background-image:url(<?= $this->storeModel->cover_mobile == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/cover/' . $this->storeModel->cover_mobile) ?>);background-size: cover; height:250px; ">
                    <div class="store-info d-flex p-t-1 flex-column align-items-center gap-3">
                        <div class="t-info-store d-flex flex-column align-items-center gap-2">
                            <?php if ($this->storeModel->direction_title_image == 1) : ?>
                                <img src="<?= base_url() ?>/public/image/store/coverimage/mobile/<?= $this->storeModel->title_image_mobile ?>" alt="" style="width:80px">
                            <?php endif; ?>
                            <div class="d-flex flex-column gap-0 align-items-center">
                                <p itemprop="slogan" class="font-weight-bold f24 m-b-1 m-t-3" style="color: <?= $this->storeModel->color_title_cover ?>;"><?= $this->storeModel->title_cover ?></p>
                                <!-- <p class="text-center fbold f16 m-b-1" style="color: <?= $this->storeModel->color_title_content ?>;"><?= $this->storeModel->title_content ?></p> -->
                            </div>
                            <?php if ($this->storeModel->direction_title_image == 0) : ?>
                                <img src="<?= base_url() ?>/public/image/store/coverimage/mobile/<?= $this->storeModel->title_image_mobile ?>" alt="" style="width:70%">
                            <?php endif; ?>


                            <!-- <span class="text-white"><?= $this->storeModel->countAllProduct ?> Produk</span> -->
                        </div>

                    </div>
                </div>
                <!-- <div class="col-lg-12 p-a-0 store-menu-tab">
                <nav class="nav p-y-1 d-flex gap-3 justify-content-center">
                    <?php foreach ($tabs as $tab) : ?>
                        <?= $tab ?>
                    <?php endforeach; ?>
                </nav>
            </div> -->
            </div>
        </div>
    </section>
    <section class="content container p-t-3 m-t-1" style="background-color:<?= $style[0]->color_bg == null ? '#fff' : $style[0]->color_bg ?> ;">
        <div class="store-action text-center">
            <a href="<?= $this->uri->segment(2) == 'epcm' || $this->uri->segment(2) == 'service-vehicle' || $this->uri->segment(2) == 'chemicals' ? base_url('bulk') : 'https://wa.me/+6285176912338?text=' . $this->storeModel->domain ?>" class="btn btn-sm text-center shadow" style="background-color: <?= $style[0]->color_button == null ? '#000' : $style[0]->color_button ?>;border-radius:5px;">
                <p class="f18 fbold text-white">Minta Penawaran</p>
            </a>
        </div>
        <div class="store-content" id="store-content">
            <?php $this->load->view($tabContent) ?>
        </div>
    </section>
</div>