<section class="menu-big-4 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg d-flex gap-2">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between gap-2 align-items-start">
                            <div class="col-lg menu-big-4-atas-base" style="background:#F6F6F7; border: 1px solid #eee;">
                                <img src="/public/landing/pic/sourcing-agent.png" alt="sourcing-agent"></img>
                                <div class="content">
                                    <h3 class="fbold">SOURCING AGENT</h3>
                                    <p class="fgray f14">Find the mechanical needs that you need or browse from our online catalogue</p>
                                    <a href="#" data-google-tag="inquiry" class="menu-big-4-button" style="width: fit-content;">Submit Inquiry</a>
                                </div>
                            </div>
                            <div class="col-lg menu-big-4-bawah-base">
                                <div class="d-flex gap-2 h-100">
                                    <div class="col-lg-6 p-a-1 kiri" style="background:#F6F6F7; border: 1px solid #eee;">
                                        <div class="content">
                                            <h3 class="fbold">MAINTENANCE</h3>
                                            <h6 class="fgray f14">Availability of your units is our priority</h6>
                                            <a href="#" data-google-tag="maintenance" class="menu-big-4-button" style="width: fit-content;">Apply</a>
                                        </div>
                                        <img src="/public/landing/pic/maintenance.png" alt="maintenance"></img>
                                    </div>
                                    <div class="col-lg-6 p-a-1 kanan" style="background:#F6F6F7; border: 1px solid #eee;">
                                        <div class="content">
                                            <h3 class="fbold">CONSTRUCTION</h3>
                                            <h6 class="fgray f14">Engineering, Construction and procurement</h6>
                                            <a href="#" data-google-tag="construction" class="menu-big-4-button" style="width: fit-content;">Consult Now!</a>
                                        </div>
                                        <img src="/public/landing/pic/construction.png" alt="construction"></img>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-4 menu-big-4-kanan-base" style="background:#F6F6F7; border: 1px solid #eee;">
                    <div class="content">
                        <h3 class="fbold">MANPOWER</h3>
                        <h6 class="fgray f14">Find Mechanic and Operator for Hire</h6>
                        <a href="<?php echo site_url('mechanic'); ?>" data-google-tag="manpower" class="menu-big-4-button" style="width: fit-content;">Check Availability</a>
                    </div>
                    <img src="/public/landing/pic/mechanic.png" alt="mekanik"></img>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-category">
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="fbold text-center m-b-1">Our Categories</h2>
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
                    <a href="<?php echo base_url(); ?>category/<?= $i['id'] ?>" class="col-lg-3 p-a-0 pointer click-category" data-google-tag="<?= $i['name'] ?>">
                        <div class="main-category-item text-left d-flex align-items-end">
                            <h5 class="fbold"><?= $i['name'] ?></h5>
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
<section class="banner-ads m-b-1">
    <div class="container">
        <a href="https://ers-id.informa-info.com/adx25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran ADC 2025">
            <div class="row">
                <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #16143e;">
                    <div class="d-flex flex-column gap-3 col-lg-8">
                        <h3 class="fbold fwhite">HARGA KHUSUS <span class="fred">PERTAMINA</span> </h3>
                        <h5 class="fwhite">Daftarkan perusahaanmu untuk mendapatkan harga khusus untuk produk lubricant pertamina selama 1 tahun. Syarat dan ketentuan berlaku selama persediaan masih ada</h5>
                    </div>
                    <img src="/public/landing/ads/Trumecs-ADC.gif" alt="Banner ADECXCO 2025" width="100%" class="img-fluid" style="top:0; right:0;">
                </div>
            </div>
        </a>
    </div>
</section>

<section class="category-pelumas m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[0];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-pelumas-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[16]['url'] ?>" class="col-lg-4 p-a-2 item-sub h-full category-pelumas-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[16]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[16]['name'] ?></h4>
                        <h6 class="fwhite">Boost your engine! Advanced formula for top-tier performance and long-term reliability</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-pelumas-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="fwhite">Unmatched quality for enhanced transmission efficiency and protection.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[8]['url'] ?>" class="col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[8]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[8]['name'] ?></h4>
                                            <h6 class="fwhite">Maximize machine life & performance with high-grade industrial lubricants!</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                                            <h6 class="fwhite">Ensures smooth operation and long-lasting component health.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[18]['url'] ?>" class="col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[18]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[18]['name'] ?></h4>
                                            <h6 class="fwhite">Optimize torque transfer while reducing friction and noise.</h6>
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
<section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <a href="https://ers-id.informa-info.com/wri25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran Water Indonesia 2025">
            <div class="row">
                <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                    <div class="d-flex flex-column gap-3 col-lg-8">
                        <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                        <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                    </div>
                    <img src="/public/landing/ads/Trumecs-WI.gif" alt="Banner Water Indonesia 2025" width="100%" class="img-fluid" style="top:0; right:0;">
                </div>
            </div>
        </a>
    </div>
</section>

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[1];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">Maximize productivity with durable OTR tyres for mining and construction</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="fwhite">Grip the road with confidence—premium motorcycle tyres for every ride</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="fwhite">Trusted by drivers for reliable performance in city and highway driving</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="fwhite">Optimal heat dissipation for cooler running in long-haul operations</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h4>
                                            <h6 class="fwhite">Optimized tread design for wet and dry traction in all conditions.</h6>
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

<!-- Spare Part -->
<!-- <section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 col-lg-8">
                    <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                    <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                </div>
                <img src="/public/landing/ads/ads-ban.png" alt="Ban" class="img-fluid" style="bottom:0; right:0;">
            </div>
        </div>
    </div>
</section>

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[2];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <div class="col-lg-4 p-a-2 item-sub h-full category-ban-base-kiri" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</h6>
                    </div>
                </div>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <div class="col-lg-8 p-a-2 item-sub" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-a-2 item-sub" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <div class="col-lg-4 p-a-2 item-sub" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil!</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 p-a-2 item-sub" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- Aksesoris -->
<!-- <section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 col-lg-8">
                    <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                    <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                </div>
                <img src="/public/landing/ads/ads-ban.png" alt="Ban" class="img-fluid" style="bottom:0; right:0;">
            </div>
        </div>
    </div>
</section> -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[6];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-6 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">Reduce wear and tear with quality heavy equipment add-ons.</h6>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-6 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                        <h6 class="fwhite">Maximize driver comfort and vehicle functionality on every trip</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Unit -->
<!-- <section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 col-lg-8">
                    <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                    <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                </div>
                <img src="/public/landing/ads/ads-ban.png" alt="Ban" class="img-fluid" style="bottom:0; right:0;">
            </div>
        </div>
    </div>
</section> -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[3];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-6 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">Reduce wear and tear with quality heavy equipment add-ons.</h6>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-6 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                        <h6 class="fwhite">Maximize driver comfort and vehicle functionality on every trip</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Unit -->
<!-- <section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 col-lg-8">
                    <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                    <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                </div>
                <img src="/public/landing/ads/ads-ban.png" alt="Ban" class="img-fluid" style="bottom:0; right:0;">
            </div>
        </div>
    </div>
</section> -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[4];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">The backbone of logistics and public transportation systems</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="fwhite">Designed for power, stability, and unmatched job site performance.</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="fwhite">Innovative technology to optimize planting and harvesting</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-lg p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="fwhite">Built for the sea—reliable marine vessels for any mission. Designed for safety and stability in rough waters</h6>
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
<!-- <section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 col-lg-8">
                    <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                    <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                </div>
                <img src="/public/landing/ads/ads-ban.png" alt="Ban" class="img-fluid" style="bottom:0; right:0;">
            </div>
        </div>
    </div>
</section> -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[5];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">The right tools make every job safer and more efficient</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-lg p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="fwhite">Protect your workforce with certified safety tools and gear. Durable safety gear designed for comfort and performance.</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-lg p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="fwhite">Boost productivity with innovative, time-saving technology. Smart solutions for professionals who demand the best</h6>
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
<!-- <section class="banner-ads m-t-3 m-b-1">
    <div class="container">
        <div class="row">
            <div class="col-lg banner-front radius-lg p-a-3" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 col-lg-8">
                    <h3 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h3>
                    <h5 class="fwhite">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</h5>
                </div>
                <img src="/public/landing/ads/ads-ban.png" alt="Ban" class="img-fluid" style="bottom:0; right:0;">
            </div>
        </div>
    </div>
</section> -->
<!--
<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[7];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-lg">
                <h2 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h2>
            </div>
            <div class="col-lg d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-lg-4 p-a-2 item-sub h-full category-ban-base-kiri click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-3 z-index-1">
                        <h4 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                        <h6 class="fwhite">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</h6>
                    </div>
                </a>
                <div class="col-lg-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class=" col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class=" col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class=" col-lg-4 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil!</h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class=" col-lg-8 p-a-2 item-sub click-subcategory-home" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-3 z-index-1">
                                            <h4 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h4>
                                            <h6 class="fwhite">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</h6>
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
-->

<!-- <section class="browse-category bg-white m-y-sm" id="browse-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-offset-4 text-center m-t-3 m-b-2">
                <h3 class="fbold"><?= $this->lang->line("trumecs_tagline") ?></h3>
            </div>
            <div class="col-lg-12 m-y-sm">
                <div class="row text-center">
                    <?php foreach (main_categories() as $i) : ?>
                        <a href="#<?= $i['name'] ?>">
                            <div class="btn text-center" style="padding-top: 10px; padding-bottom: 10px">
                                <span class="fbold color-black">
                                    <?= $i['name'] ?>
                                </span>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            </div>

        </div>
    </div>
</section> -->


<!-- <input type="hidden" name="current_c_k_items" value="<?= $_COOKIE['items'] ?? 0 ?>"> -->

<!-- <?php foreach (main_categories() as $i) : ?>

    <section class="<?= $i['name'] ?> m-y-lg" id="<?= $i['name'] ?>">
        <div class="container">
            <div class="row catalog-content p-x-1" style="background:#F6F6F7">
                <div class="col-lg-12 m-t-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 d-flex align-items-end gap-3">
                            <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $i["url"]; ?>.png" alt="<?php echo $i["name"]; ?>" width="10%">
                            <div class="flex flex-column">
                                <h2 class="fbold"><?= $i['name'] ?></h2>
                                <div class="line-y-sm"></div>
                            </div>
                        </div>
                        <div class="form-inline col-lg-6 text-right">
                            <div class="form-group">
                                <label for="search_<?= $i['id'] ?>">Search</label>
                                <input type="search" name="search" data-search_id="<?= $i['id'] ?>" class="form-control search-datatable" id="search_<?= $i['id'] ?>" placeholder="Search <?= $i['name'] ?>">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12 space-compare m-y-sm d-flex flex-column align-items-start gap-3">

                </div>

                <div class="col-lg-12 catalog">
                    <input type="hidden" name="image" value="<?php echo base_url(); ?>public/image/category/card-<?php echo $i["url"]; ?>.png">
                    <input type="hidden" name="category_id" value="<?= $i['id'] ?>">
                    <input type="hidden" name="name" value="<?= $i['name'] ?>">
                    <table class="table table-sm datatable table-hover w-100 table-striped table-horizontal" id="id_datatable_<?= $i['id'] ?>">
                        <thead>
                            <tr>
                                <th style="width: 1%;">id</th>
                                <th style="width: 40%;font-family:'Lato';font-size:12px">Nama</th>
                                <th style="width: 15%;font-family:'Lato';font-size:12px">Merek</th>
                                <th style="width: 25%;font-family:'Lato';font-size:12px">Kategori</th>
                                <th style="width: 12%;font-family:'Lato';font-size:12px">Harga</th>
                                <th style="width: 7%;font-family:'Lato';font-size:12px">Bandingkan</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row text-center m-a-2">
                        <a href="<?php echo site_url('c/' . $i['name']); ?>" class="btn btn-lg btnnew fbold radius-lg-new p-x-3" style="padding:16px 30px 16px 30px;font-size:20px;font-family:'Lato'">Jelajahi Semua <?= $i['name'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
<?php endforeach ?> -->

<!-- <section class="rfq-form m-y-lg p-t-lg" id="rfq-form">
    <div class="container d-flex flex-column gap-3">
        <div class="row">
            <div class="col-lg-12">
                <p class="f46 fbold">Tidak menemukan barang? kirim permintaan sekarang!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-a-2">
                    <?php // $this->load->view('bulk/desktop/form_v2') 
                    ?>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="join m-y-lg" id="join">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ready-to-join d-flex align-items-center justify-content-center">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-lg-12 text-center">
                        <h2 class="fbold fwhite"><?= $this->lang->line("ready_join_label", FALSE) ?></h2>
                        <p class="fwhite"><?= $this->lang->line("ready_join_subtitle", FALSE) ?></p>
                        <a href="<?= base_url('member/login') ?>" class="btn btnnew m-t-2"><?= $this->lang->line('cta_to_join_seller', FALSE) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <div class="float float-request d-flex align-items-center text-center justify-content-between p-l-1 w-1200 <?= !empty($items) ? '' : 'd-none' ?>" style="padding: 3px">

    <p class="my-float" id="float-value">Permintaan <?= count($items) ?> (item)</p>
    <form class="right-side" method="post" action="<?= base_url('bulk/toBulk') ?>" id="form-request-checkbox">
        <div class="form-list"></div>
        <button type="submit" class="btn btnnew btn-create-request">Lanjut <i class="fa fa-fw fa-pencil-square"></i></button>

        <a href="submit" class="btn btnnew btn-create-request radius-circle">Buat Permintaan Sekarang</a>
    </form>
</div> -->

<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel">
    <div class="modal-dialog" style="margin: 5% auto; " role="document">
        <form action="<?= base_url('/share_compare') ?>" method="POST" id="form-share">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h6 class="modal-title" id="shareModalLabel"><i class="fa fa-fw fa-share"></i> Share Komparasi</h6>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="share_input_category_id">
                    <div class="form-group tags-input">
                        <label for="input-tag" class="control-label">Tambah Penerima:</label>
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
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-share-submit">Bagikan</button>
                </div>
            </div>
        </form>
    </div>
</div>