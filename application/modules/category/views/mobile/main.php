<section class="submenu-category p-b-0">
    <div class="container d-flex flex-column gap-3">
        <h3 class="fbold text-center">Sub Categories of <?= $categories['name'] ?></h3>
        <div class="row justify-content-center subcategory">
            <?php
            $totalItems = count($subCategories);
            $cols = 2;
            $remainingItems = $totalItems % $cols;
            foreach ($subCategories as $index => $i) :
                $lastItems = $totalItems - $index;
                if ($index % $cols === 0) {
                    echo '<div class="row d-flex justify-content-start m-b-8px gap-2 w-100 m-a-0">';
                }
                if ($remainingItems == 1 && $lastItems <= 1) {
                    $colClass = 'col-md-12';
                } else {
                    $colClass = 'col-md-6';
                }
            ?>
                <div class="<?= $colClass ?> pointer click-subcategory-mobile" data-google-tag="<?= $categories['name'] ?> - <?= $i['name'] ?>" style="flex: 1;">
                    <div class="submenu-category-item text-left d-flex align-items-start" onclick="toggleSubCategorySelection(this, <?= $i['id'] ?>)" data-id="<?= $i['id'] ?>">
                        <p class="fbold f11"><?= $i['name'] ?></p>
                        <!--<img src="<?= $i['img'] ?>" alt="<?= $i['name'] ?>" class="img-fluid">-->
                    </div>
                </div>
            <?php
                if (($index + 1) % $cols === 0 || ($index + 1) === $totalItems || ($remainingItems == 2 && $cols == 2)) {
                    echo '</div>';
                }
            endforeach;
            ?>

        </div>
        <div class="text-center w-100 d-none">
            <button class="btn btn-sm btn-outline-primary" id="toggle-subcategories">Lihat Lebih Banyak</button>
        </div>
    </div>
</section>

<input type="hidden" id="selected_submenu" name="selected_submenu">

<section class="brand-category p-b-0">
    <div class="container d-flex flex-column gap-3">
        <h3 class="fbold text-center">Brand of <?= $categories['name'] ?></h3>
        <div class="row justify-content-center brand">
            <?php
            $totalItems = count($brand);
            $cols = 3;
            foreach ($brand as $index => $i) :
                if ($index % $cols === 0) {
                    echo '<div class="row d-flex justify-content-start m-b-8px gap-2 w-100 m-a-0">';
                }
            ?>
                <div class="col-md-4 pointer click-brand-mobile" data-google-tag="<?= $categories['name'] ?> - <?= $i['name'] ?>" style="flex: 1;">
                    <div class="brand-category-item d-flex flex-column align-items-center gap-1" onclick="toggleBrandSelection(this, <?= $i['id'] ?>)" data-id="<?= $i['id'] ?>">
                        <!--<img src="<?= $i['img'] ?>" alt="<?= $i['name'] ?>">-->
                        <h6 class="fbold f11"><?= $i['name'] ?></h6>
                    </div>
                </div>
            <?php
                if (($index + 1) % $cols === 0 || ($index + 1) === $totalItems) {
                    echo '</div>';
                }
            endforeach;
            ?>
        </div>
        <div class="text-center w-100 d-none">
            <button class="btn btn-sm btn-outline-primary" id="toggle-brands">Lihat Lebih Banyak</button>
        </div>
    </div>
</section>

<input type="hidden" id="selected_brand" name="selected_brand">

<input type="hidden" name="current_c_k_items" value="<?= $_COOKIE['items'] ?? 0 ?>">

<section class="<?= $categories['name'] ?> m-y-md" id="see-product-table">
    <div class="container">
        <div class="row catalog-content">
            <!-- <div class="col-xs-12">
                    <div class="row d-flex flex-column justify-content-center">
                        <div class="col-xs-12 d-flex align-items-center gap-3">
                            <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $categories["url"]; ?>.png" alt="<?php echo $categories["name"]; ?>" width="10%">
                            <div class="flex flex-column">
                                <h6 class="fbold"><?= $categories['name'] ?></h6>
                                <div class="line-y-sm"></div>
                            </div>
                        </div>
                        <div class="form-inline col-xs-12 m-y-md text-right">
                            <div class="form-group">

                                <input type="search" name="search" data-search_id="<?= $categories['id'] ?>" class="form-control search-datatable" id="search_<?= $categories['id'] ?>" placeholder="Search <?= $categories['name'] ?>">
                            </div>

                        </div>
                    </div>
                </div> -->

            <div class="col-xs-12 space-compare">

            </div>

            <div class="col-xs-12 catalog p-x-0">
                <input type="hidden" name="image" value="<?php echo base_url(); ?>public/image/category/card-<?php echo $categories["url"]; ?>.png">
                <input type="hidden" name="category_id" value="<?= $categories['id'] ?>">
                <input type="hidden" name="name" value="<?= $categories['name'] ?>">
                <table class="table table-hover datatable w-100 table-striped" id="id_datatable_<?= $categories['id'] ?>">
                    <!--  <thead>
                            <tr>
                                <th class="" style="width:50%">Gambar</th>
                                <th style="width:40%">Harga</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead> -->
                </table>
                <div class="row text-center m-a-2">
                    <a href="<?php echo site_url('c/' . $categories['name']); ?>" class="btn btn-md btnnew fbold radius-md-new p-x-3" style="padding:16px 30px 16px 30px;font-size:20px;font-family:'Lato'">Jelajahi Semua <?= $categories['name'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="float float-request d-flex align-items-center text-center justify-content-between p-l-1 w-1200 <?= !empty($items) ? '' : 'd-none' ?>" style="padding: 3px">

    <p class="my-float" id="float-value">Permintaan <?= count($items) ?> (item)</p>
    <form class="right-side" method="post" action="<?= base_url('bulk/toBulk') ?>" id="form-request-checkbox">
        <div class="form-list"></div>
        <button type="submit" class="btn btnnew btn-create-request">Lanjut <i class="fa fa-fw fa-pencil-square"></i></button>

        <!-- <a href="submit" class="btn btnnew btn-create-request radius-circle">Buat Permintaan Sekarang</a> -->
    </form>
</div>

<button id="back-to-top" class="btn btnnew radius-md back-to-top d-none" role="button">
    &#8593; <!-- Panah ke atas -->
</button>

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
                        <div class="col-md-12" id="document-compare">

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