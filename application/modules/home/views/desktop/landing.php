<section class="menu-big-4 mb-1">
    <div class="container">
        <div class="row">
            <div class="col-lg d-flex gap-2">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between gap-2 align-items-start">
                            <div class="col-lg menu-big-4-atas-base" style="background:#F6F6F7; border: 1px solid #eee;">
                                <img src="/public/landing/pic/sourcing-agent.png" class="img-fluid" alt="sourcing-agent">
                                <div class="content">
                                    <h3 class="fw-bold">SOURCING AGENT</h3>
                                    <p class="text-gray f14">Find the mechanical needs that you need or browse from our online catalogue</p>
                                    <a href="#" data-google-tag="inquiry" class="menu-big-4-button" style="width: fit-content;">Submit Inquiry</a>
                                </div>
                            </div>
                            <div class="col-lg menu-big-4-bawah-base">
                                <div class="d-flex gap-2 h-100">
                                    <div class="col-lg-6 p-1 kiri" style="background:#F6F6F7; border: 1px solid #eee;">
                                        <div class="content">
                                            <h3 class="fw-bold">MAINTENANCE</h3>
                                            <h6 class="text-gray f14">Availability of your units is our priority</h6>
                                            <a href="#" data-google-tag="maintenance" class="menu-big-4-button" style="width: fit-content;">Apply</a>
                                        </div>
                                        <img src="/public/landing/pic/maintenance.png" class="img-fluid" alt="maintenance">
                                    </div>
                                    <div class="col-lg-6 p-1 kanan" style="background:#F6F6F7; border: 1px solid #eee;">
                                        <div class="content">
                                            <h3 class="fw-bold">CONSTRUCTION</h3>
                                            <h6 class="text-gray f14">Engineering, Construction and procurement</h6>
                                            <a href="#" data-google-tag="construction" class="menu-big-4-button" style="width: fit-content;">Consult Now!</a>
                                        </div>
                                        <img src="/public/landing/pic/construction.png" class="img-fluid" alt="construction">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 menu-big-4-kanan-base" style="background:#F6F6F7; border: 1px solid #eee;">
                    <div class="content">
                        <h3 class="fw-bold">MANPOWER</h3>
                        <h6 class="text-gray f14">Find Mechanic and Operator for Hire</h6>
                        <a href="<?php echo site_url('mechanic'); ?>" data-google-tag="manpower" class="menu-big-4-button" style="width: fit-content;">Check Availability</a>
                    </div>
                    <img src="/public/landing/pic/mechanic.png" class="img-fluid" alt="mekanik">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-category">
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="fw-bold text-center mb-1">Our Categories</h2>
            <?php
            $categories = main_categories();
            $totalItems = count($categories);
            $cols = 4;
            foreach ($categories as $index => $i) :
                if ($index < 9):
                    if ($index % $cols === 0) {
                        echo '<div class="row d-flex justify-content-center m-b-8px gap-2 w-100 m-a-0">';
                    }
            ?>
                    <a href="<?php echo base_url(); ?>category/<?= $i['id'] ?>" class="col-lg-3 p-0 pointer click-category" data-google-tag="<?= $i['name'] ?>">
                        <div class="main-category-item text-left d-flex align-items-end">
                            <h5 class="fw-bold"><?= $i['name'] ?></h5>
                            <img src="/public/landing/category/<?= $i['name'] ?>.png" alt="<?= $i['name'] ?>" class="img-fluid">
                        </div>
                    </a>
            <?php
                    if (($index + 1) % $cols === 0 || ($index + 1) === $totalItems) {
                        echo '</div>';
                    }
                endif;
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- Pelumas -->
<section class="banner-ads mb-1">
    <div class="container">
        <a href="https://ers-id.informa-info.com/adx25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran ADC 2025">
            <div class="row">
                <div class="col-lg banner-front rounded-3 p-3" style="background-color: #16143e;">
                    <div class="d-flex flex-column gap-3 col-lg-8">
                        <h3 class="fw-bold text-white">HARGA KHUSUS <span class="text-danger">PERTAMINA</span> </h3>
                        <h5 class="text-white">Daftarkan perusahaanmu untuk mendapatkan harga khusus untuk produk lubricant pertamina selama 1 tahun. Syarat dan ketentuan berlaku selama persediaan masih ada</h5>
                    </div>
                    <img src="/public/landing/ads/Trumecs-ADC.gif" alt="Banner ADECXCO 2025" class="img-fluid position-absolute top-0 end-0" style="width:100%">
                </div>
            </div>
        </a>
    </div>
</section>

<section class="category-pelumas mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[0];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-pelumas-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[16]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-pelumas-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[16]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[16]['name'] ?></h4>
                        <h6 class="text-white">Boost your engine! Advanced formula for top-tier performance and long-term reliability</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-pelumas-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="text-white">Unmatched quality for enhanced transmission efficiency and protection.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[8]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[8]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[8]['name'] ?></h4>
                                            <h6 class="text-white">Maximize machine life & performance with high-grade industrial lubricants!</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                                            <h6 class="text-white">Ensures smooth operation and long-lasting component health.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[18]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[18]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[18]['name'] ?></h4>
                                            <h6 class="text-white">Optimize torque transfer while reducing friction and noise.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ban -->
<section class="banner-ads mt-3 mb-1">
    <div class="container">
        <a href="https://ers-id.informa-info.com/wri25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran Water Indonesia 2025">
            <div class="row">
                <div class="col-lg banner-front rounded-3 p-3" style="background-color: #000000;">
                    <div class="d-flex flex-column gap-3 col-lg-8">
                        <h3 class="fw-bold text-white">KETERSEDIAAN BAN TERJAMIN </h3>
                        <h5 class="text-white">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                    </div>
                    <img src="/public/landing/ads/Trumecs-WI.gif" alt="Banner Water Indonesia 2025" class="img-fluid position-absolute top-0 end-0" style="width:100%">
                </div>
            </div>
        </a>
    </div>
</section>

<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[1];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Maximize productivity with durable OTR tyres for mining and construction</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="text-white">Grip the road with confidence—premium motorcycle tyres for every ride</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="text-white">Trusted by drivers for reliable performance in city and highway driving</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="text-white">Optimal heat dissipation for cooler running in long-haul operations</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[4]['name'] ?></h4>
                                            <h6 class="text-white">Optimized tread design for wet and dry traction in all conditions.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Aksesoris -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[6];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Reduce wear and tear with quality heavy equipment add-ons.</h6>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                        <h6 class="text-white">Maximize driver comfort and vehicle functionality on every trip</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Unit -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[3];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">Reduce wear and tear with quality heavy equipment add-ons.</h6>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-6 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                        <h6 class="text-white">Maximize driver comfort and vehicle functionality on every trip</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Unit -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[4];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">The backbone of logistics and public transportation systems</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-8 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="text-white">Designed for power, stability, and unmatched job site performance.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg-4 p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="text-white">Innovative technology to optimize planting and harvesting</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="text-white">Built for the sea—reliable marine vessels for any mission. Designed for safety and stability in rough waters</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tools -->
<section class="category-ban mb-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[5];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fw-bold ps-2 my-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base position-relative" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-2 item-sub h-full category-ban-base-kiri click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3">
                        <h4 class="fw-bold text-white"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="text-white">The right tools make every job safer and more efficient</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="text-white">Protect your workforce with certified safety tools and gear. Durable safety gear designed for comfort and performance.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg p-2 item-sub click-subcategory-home position-relative z-1" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3">
                                            <h4 class="fw-bold text-white"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="text-white">Boost productivity with innovative, time-saving technology. Smart solutions for professionals who demand the best</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin: 5% auto;">
        <form action="<?= base_url('/share_compare') ?>" method="POST" id="form-share">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="shareModalLabel"><i class="fa fa-fw fa-share"></i> Share Komparasi</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="share_input_category_id">
                    <div class="form-group tags-input">
                        <label for="input-tag" class="form-label">Tambah Penerima:</label>
                        <ul id="tags"></ul>
                        <input type="text" class="form-control" id="input-tag">
                    </div>

                    <div class="row">
                        <div class="col-lg-12" id="document-compare">

                        </div>
                    </div>
                    <div id="input-email-validator">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-share-submit">Bagikan</button>
                </div>
            </div>
        </form>
    </div>
</div>