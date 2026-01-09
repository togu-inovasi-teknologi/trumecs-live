<section class="submenu-category pb-0 d-lg-none">
    <div class="container">
        <h3 class="fbold text-center mb-3">Sub Categories of <?= htmlspecialchars($categories['name']) ?></h3>

        <div class="row g-2">
            <?php
            $totalItems = count($subCategories);

            foreach ($subCategories as $index => $i) :
                // Mobile: 2 kolom, kecuali jika hanya 1 item
                $colClass = ($totalItems === 1) ? 'col-12' : 'col-6';
            ?>
                <div class="<?= $colClass ?> pointer click-subcategory-mobile"
                    data-google-tag="<?= htmlspecialchars($categories['name']) ?> - <?= htmlspecialchars($i['name']) ?>">
                    <div class="submenu-category-item d-flex align-items-start p-2 border rounded"
                        onclick="toggleSubCategorySelection(this, <?= $i['id'] ?>)"
                        data-id="<?= $i['id'] ?>">
                        <p class="fbold f11 mb-0"><?= htmlspecialchars($i['name']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($subCategories) > 6) : ?>
            <div class="text-center w-100 mt-3">
                <button class="btn btn-sm btn-outline-primary" id="toggle-subcategories-mobile">
                    Lihat Lebih Banyak
                </button>
            </div>
        <?php endif; ?>
    </div>
</section>

<input type="hidden" id="selected_submenu" name="selected_submenu">

<section class="brand-category pb-0 d-lg-none">
    <div class="container">
        <h3 class="fbold text-center mb-3">Brand of <?= htmlspecialchars($categories['name']) ?></h3>

        <div class="row g-2">
            <?php foreach ($brand as $i) : ?>
                <div class="col-4 pointer click-brand-mobile"
                    data-google-tag="<?= htmlspecialchars($categories['name']) ?> - <?= htmlspecialchars($i['name']) ?>">
                    <div class="brand-category-item d-flex flex-column align-items-center justify-content-center p-2 border rounded"
                        onclick="toggleBrandSelection(this, <?= $i['id'] ?>)"
                        data-id="<?= $i['id'] ?>">
                        <h6 class="fbold f11 text-center mb-0"><?= htmlspecialchars($i['name']) ?></h6>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($brand) > 9) : ?>
            <div class="text-center w-100 mt-3">
                <button class="btn btn-sm btn-outline-primary" id="toggle-brands-mobile">
                    Lihat Lebih Banyak
                </button>
            </div>
        <?php endif; ?>
    </div>
</section>

<input type="hidden" id="selected_brand" name="selected_brand">

<input type="hidden" name="current_c_k_items" value="<?= $_COOKIE['items'] ?? 0 ?>">

<section class="<?= $categories['name'] ?> my-2" id="see-product-table">
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

            <div class="col-xs-12 catalog px-0">
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
                <div class="row text-center m-2">
                    <a href="<?php echo site_url('c/' . $categories['name']); ?>" class="btn btn-md btnnew fbold radius-md-new px-3" style="padding:16px 30px 16px 30px;font-size:20px;font-family:'Lato'">Jelajahi Semua <?= $categories['name'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="float-request-mobile d-flex align-items-center justify-content-between p-2 bg-white shadow-sm fixed-bottom d-lg-none <?= !empty($items) ? '' : 'd-none' ?>">
    <p class="mb-0" id="float-value-mobile"><?= count($items) ?> item</p>
    <form method="post" action="<?= base_url('bulk/toBulk') ?>" id="form-request-checkbox-mobile">
        <div class="form-list"></div>
        <button type="submit" class="btn btn-sm btn-primary">
            Lanjut <i class="bi bi-pencil-square"></i>
        </button>
    </form>
</div>

<button id="back-to-top-mobile" class="btn btn-primary back-to-top d-none d-lg-none" role="button">
    <i class="bi bi-arrow-up"></i>
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