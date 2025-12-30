<section class="menu-big-4-mobile m-y-1">
    <div class="container">
        <div class="row">
            <a href="#" class="menu-big-4-button-mobile" data-google-tag="inquiry">
                <div class="col-md-12 m-b-1 bg-menu-big-4 menu-sourcing">
                    <img src="/public/landing/pic/sourcing-agent.png" alt="sourcing-agent"></img>
                    <div class="content">
                        <h5 class="fbold fblack underline-text">SOURCING AGENT</h5>
                        <p class="fgray f14">Find the mechanical needs that you need or browse from our online catalogue</p>
                    </div>
                </div>
            </a>
            <div class="col-md-12">
                <div class="row d-flex gap-3">
                    <div class="col-md-6" style="flex: 1;">
                        <div class="row d-flex flex-column gap-3">
                            <a href="#" class="menu-big-4-button-mobile" data-google-tag="maintenance">
                                <div class="col-md-12 bg-menu-big-4 kiri">
                                    <img class="maintenance" src="/public/landing/pic/maintenance.png" alt="maintenance"></img>
                                    <div class="content p-t-1">
                                        <h6 class="fbold fblack underline-text">MAINTENANCE</h6>
                                        <h6 class="fgray f14">Availability of your units is our priority</h6>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="menu-big-4-button-mobile" data-google-tag="construction">
                                <div class="col-md-12 bg-menu-big-4 kiri">
                                    <img class="construction" src="/public/landing/pic/construction.png" alt="construction"></img>
                                    <div class="content p-t-1">
                                        <h6 class="fbold fblack underline-text">CONSTRUCTION</h6>
                                        <h6 class="fgray f14">Engineering, Construction and procurement</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6" style="flex: 1;">
                        <div class="row d-flex flex-column">
                            <a href="<?php echo site_url('mechanic'); ?>" class="menu-big-4-button-mobile" data-google-tag="manpower">
                                <div class="col-md-12 bg-menu-big-4 kanan">
                                    <div class="content p-t-1">
                                        <h6 class="fbold fblack underline-text">MANPOWER</h6>
                                        <h6 class="fgray f14">Find Mechanic and Operator for Hire</h6>
                                    </div>
                                    <img src="/public/landing/pic/mechanic.png" alt="mekanik"></img>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="main-category">
    <div class="container">
        <div class="row m-y-1 text-center">
            <h3 class="fbold">Our Categories</h3>
        </div>
        <div class="row">
            <?php
            $categories = main_categories();
            $totalItems = count($categories);
            $cols = 2;
            foreach ($categories as $index => $i) :
                if($index<7):
                if ($index % $cols === 0) {
                    echo '<div class="d-flex gap-3 m-b-1">';
                }
            ?>
                <a href="<?php echo base_url(); ?>category/<?= $i['id'] ?>" class="col-md-6 p-a-0 pointer click-category-mobile" data-google-tag="<?= $i['name'] ?>" style="flex: 1;">
                    <div class="main-category-item text-left d-flex align-items-end">
                        <p class="fbold f13"><?= $i['name'] ?></p>
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

<section class="banner-ads m-b-1">
    <a href="https://www.trumecs.com" target="_blank" alt="link ke trumecs" >
    <div class="container">
        <div class="row">
            <!--<div class="col-md banner-front radius-md p-a-1" style="background-color: #16143e;">
                <div class="d-flex flex-column gap-1 justify-content-center align-items-center">
                    <h6 class="fbold fwhite">HARGA KHUSUS <span class="fred">PERTAMINA</span> </h6>
                    <p class="fwhite f11 text-center">Daftarkan perusahaanmu untuk mendapatkan harga khusus untuk produk lubricant pertamina selama 1 tahun. Syarat dan ketentuan berlaku selama persediaan masih ada</p>
                    <img src="/public/landing/ads/Trumecs-WI.gif" width="100%" alt="Pertamina" class="banner-ads-image">
                </div>
            </div>-->
            <img src="/public/banner/banner-nataru.png" width="100%" alt="Banner Nataru 2025 to 2026">
            
        </div>
    </div>
    </a>
</section>

<!--- Pelumas -->
<section class="category-pelumas m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[0];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-pelumas-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[16]['url'] ?>" class="col-md-4 p-a-1 item-sub h-full category-pelumas-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[16]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[16]['name'] ?></h6>
                        <p class="fwhite f11">Boost your engine with our oil! Advanced formula for top-tier performance and long-term reliability</p>
                    </div>
                </a>
                <div class="col-md-8 category-pelumas-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Unmatched quality for enhanced transmission efficiency and protection.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[8]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[8]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[8]['name'] ?></h6>
                                            <p class="fwhite f11">Maximize machine life & performance with high-grade industrial lubricants!</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                                            <p class="fwhite f11">Ensures smooth operation and long-lasting component health.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[18]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[18]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[18]['name'] ?></h6>
                                            <p class="fwhite f11">Optimize torque transfer while reducing friction and noise.</p>
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

<!-- <section class="banner-ads m-t-3 m-b-1">
    <a href="https://ers-id.informa-info.com/adx25??cid=PREREG+TRUMECS" target="_blank" alt="Tautan pendaftaran ADC" >
    <div class="container">
        <div class="row">
            <div class="col-md banner-front radius-md p-a-1" style="background-color: #000000;">
                <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
                    <h6 class="fbold fwhite">KETERSEDIAAN BAN TERJAMIN </h6>
                    <p class="fwhite f11 text-center">Diskusikan dengan kami untuk qualitas dan quantity yang terjamin untuk perusahaanmu.</p>
                    <img src="/public/landing/ads/ads-Ban.png" alt="Ban" class="banner-ads-image">
                    https://ers-id.informa-info.com/adx25??cid=PREREG+TRUMECS
                </div>
            </div>
            <img src="/public/landing/ads/Trumecs-ADC.gif" width="100%" alt="Banner ADEXCO 2025">
        </div>
    </div>
    </a>
</section> -->

<!--- Ban -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[1];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Maximize productivity with durable OTR tyres for mining and construction</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Grip the road with confidence—premium motorcycle tyres for every ride</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Trusted by drivers for reliable performance in city and highway driving</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Optimal heat dissipation for cooler running in long-haul operations</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h6>
                                            <p class="fwhite f11">Optimized tread design for wet and dry traction in all conditions.</p>
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

<!--- Aki -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[6];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-6 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Reduce wear and tear with quality heavy equipment add-ons.</p>
                    </div>
                </a>
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-6 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                        <p class="fwhite f11">Maximize driver comfort and vehicle functionality on every trip</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!--- Sparepart -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[3];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h4>
                            <p class="fwhite f11">The right parts make all the difference in heavy-duty operations</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Reduce maintenance intervals with high-performance spare parts</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Keep production running with reliable industrial spare parts</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Genuine replacements for tractors, harvesters, and implements</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h6>
                                            <p class="fwhite f11">Reliable replacements for engines, pumps, and navigation systems.</p>
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

<!--- Unit -->

<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[4];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">The backbone of logistics and public transportation systems</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Designed for power, stability, and unmatched job site performance.</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Innovative technology to optimize planting and harvesting</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class="col-md p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Built for the sea—reliable marine vessels for any mission. Designed for safety and stability in rough waters</p>
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

<!--- Tools -->


<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[5];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">The right tools make every job safer and more efficient</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class="col-md p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Protect your workforce with certified safety tools and gear. Durable safety gear designed for comfort and performance.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class="col-md p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <p class="fwhite f11">Boost productivity with innovative, time-saving technology. Smart solutions for professionals who demand the best</p>
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

<!--- Aksesoris -->

<!--
<section class="category-ban m-b-3">
    <div class="container">
        <div class="row d-flex flex-column gap-2">
            <?php
            $mainCategory = main_categories()[7];
            $subCategories = $this->M_general->getcategori(['parent' => $mainCategory['id']]);
            ?>
            <div class="col-md">
                <h3 class="fbold p-l-2 m-y-1"><?= $mainCategory['name'] ?></h3>
            </div>
            <div class="col-md d-flex category-ban-base" style="background: url('/public/landing/category/background/<?= $mainCategory['name'] ?>.png') no-repeat 0% 0% / cover;
                position: relative;">
                <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[0]['url'] ?>" class="col-md-4 p-a-1 item-sub h-full category-ban-base-kiri click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[0]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1)); border-right: solid #fff 2px;">
                    <div class="d-flex flex-column gap-1 z-index-1">
                        <h6 class="fbold fwhite"><?= $subCategories[0]['name'] ?></h6>
                        <p class="fwhite f11">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</p>
                    </div>
                </a>
                <div class="col-md-8 category-ban-base-kanan">
                    <div class="row">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[1]['url'] ?>" class=" col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[1]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class=" d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[1]['name'] ?></h6>
                                            <p class="fwhite f11">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[2]['url'] ?>" class=" col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[2]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-bottom: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[2]['name'] ?></h6>
                                            <h6 class="fwhite f11">Choose excellence with our premium engine oil</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="d-flex h-100">
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[3]['url'] ?>" class=" col-md-4 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[3]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-right: solid #fff 2px;border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[3]['name'] ?></h6>
                                            <p class="fwhite f11">Choose excellence with our premium engine oil!</p>
                                        </div>
                                    </a>
                                    <a href="<?php echo base_url(); ?>c/<?= $mainCategory['url'] . "/" . $subCategories[4]['url'] ?>" class=" col-md-8 p-a-1 item-sub click-subcategory-home-mobile" data-google-tag="<?= $mainCategory['name'] ?> - <?= $subCategories[4]['name'] ?>" style="background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.1));border-top: solid #fff 2px;border-left: solid #fff 2px;">
                                        <div class="d-flex flex-column gap-1 z-index-1">
                                            <h6 class="fbold fwhite"><?= $subCategories[4]['name'] ?></h6>
                                            <p class="fwhite f11">Choose excellence with our premium engine oil—rev up your engine and keep moving forward smoothly!</p>
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