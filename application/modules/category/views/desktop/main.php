<section class="submenu-category pb-0 d-none d-lg-block">
    <div class="container">
        <h3 class="fbold text-center mb-4">Sub Categories of <?= htmlspecialchars($categories['name']) ?></h3>

        <div class="row g-3">
            <?php
            $totalItems = count($subCategories);
            $cols = 3; // 3 kolom di desktop

            foreach ($subCategories as $index => $i) :
                // Sederhanakan logika untuk desktop saja
                // Di desktop, kita selalu ingin 3 kolom per baris

                // Mulai baris baru setiap 3 item
                if ($index % $cols === 0 && $index > 0) {
                    echo '</div><div class="row g-3">';
                }

                // Tentukan ukuran kolom berdasarkan posisi di baris terakhir
                $itemsInLastRow = $totalItems % $cols;
                $isLastRow = ($index >= $totalItems - $itemsInLastRow);

                if ($isLastRow) {
                    if ($itemsInLastRow === 1) {
                        // Jika hanya 1 item di baris terakhir, buat full width
                        $colClass = 'col-12';
                    } elseif ($itemsInLastRow === 2) {
                        // Jika 2 item di baris terakhir, buat 6 kolom masing-masing
                        $colClass = 'col-6';
                    } else {
                        // Default 3 kolom
                        $colClass = 'col-4';
                    }
                } else {
                    // Untuk baris penuh, selalu 4 kolom (12/3=4)
                    $colClass = 'col-4';
                }
            ?>
                <div class="<?= $colClass ?> pointer click-subcategory mb-2"
                    data-google-tag="<?= htmlspecialchars($categories['name']) ?> - <?= htmlspecialchars($i['name']) ?>">
                    <div class="submenu-category-item text-left d-flex align-items-start p-3 h-100"
                        onclick="toggleSubCategorySelection(this, <?= $i['id'] ?>)"
                        data-id="<?= $i['id'] ?>">
                        <h6 class="fbold mb-0"><?= htmlspecialchars($i['name']) ?></h6>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center w-100 mt-3">
            <button class="btn btn-sm btn-outline-primary" id="toggle-subcategories">
                Lihat Lebih Banyak
            </button>
        </div>
    </div>
</section>

<input type="hidden" id="selected_submenu" name="selected_submenu">

<section class="brand-category pb-0 d-none d-lg-block">
    <div class="container">
        <h3 class="fbold text-center mb-4">Brand of <?= htmlspecialchars($categories['name']) ?></h3>

        <div class="row g-2">
            <?php
            $totalItems = count($brand);
            $cols = 6; // 6 kolom di desktop

            foreach ($brand as $index => $i) :
                // Mulai baris baru setiap 6 item
                if ($index % $cols === 0 && $index > 0) {
                    echo '</div><div class="row g-2">';
                }

                // Tentukan ukuran kolom untuk baris terakhir
                $itemsInLastRow = $totalItems % $cols;
                $isLastRow = ($index >= $totalItems - $itemsInLastRow);

                if ($isLastRow && $itemsInLastRow > 0) {
                    // Untuk baris terakhir, hitung lebar kolom
                    $colWidth = 12 / $itemsInLastRow;
                    $colClass = "col-{$colWidth}";
                } else {
                    // Default 2 kolom (12/6=2)
                    $colClass = 'col-2';
                }
            ?>
                <div class="<?= $colClass ?> pointer click-brand mb-2"
                    data-google-tag="<?= htmlspecialchars($categories['name']) ?> - <?= htmlspecialchars($i['name']) ?>">
                    <div class="brand-category-item d-flex flex-column align-items-center justify-content-center p-2 h-100"
                        onclick="toggleBrandSelection(this, <?= $i['id'] ?>)"
                        data-id="<?= $i['id'] ?>">
                        <h6 class="fbold f11 text-center mb-0"><?= htmlspecialchars($i['name']) ?></h6>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<input type="hidden" id="selected_brand" name="selected_brand">

<input type="hidden" name="current_c_k_items" value="<?= $_COOKIE['items'] ?? 0 ?>">

<section class="<?= $categories['name'] ?> m-y-lg" id="see-product-table">
    <div class="container d-flex flex-column gap-3">
        <h3 class="fbold text-center">Product of <?= $categories['name'] ?></h3>
        <div class="row catalog-content px-1" style="background:#F6F6F7">
            <!-- <div class="col-lg-12 m-t-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 d-flex align-items-end gap-3">
                            <img src="<?php echo base_url(); ?>public/image/category/card-<?php echo $categories["url"]; ?>.png" alt="<?php echo $categories["name"]; ?>" width="10%">
                            <div class="flex flex-column">
                                <h2 class="fbold"><?= $categories['name'] ?></h2>
                                <div class="line-y-sm"></div>
                            </div>
                        </div>
                        <div class="form-inline col-lg-6 text-right">
                            <div class="form-group">
                                <label for="search_<?= $categories['id'] ?>">Search</label>
                                <input type="search" name="search" data-search_id="<?= $categories['id'] ?>" class="form-control search-datatable" id="search_<?= $categories['id'] ?>" placeholder="Search <?= $categories['name'] ?>">
                            </div>

                        </div>
                    </div>
                </div> -->

            <div class="col-lg-12 space-compare m-y-sm d-flex flex-column align-items-start gap-3">

            </div>

            <div class="col-lg-12 catalog">
                <input type="hidden" name="image" value="<?php echo base_url(); ?>public/image/category/card-<?php echo $categories["url"]; ?>.png">
                <input type="hidden" name="category_id" value="<?= $categories['id'] ?>">
                <input type="hidden" name="name" value="<?= $categories['name'] ?>">
                <table class="table table-sm datatable table-hover w-100 table-striped table-horizontal" id="id_datatable_<?= $categories['id'] ?>">
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
                <div class="row text-center m-2">
                    <a href="<?php echo site_url('c/' . $categories['name']); ?>" class="btn btn-lg btnnew fbold radius-lg-new px-3" style="padding:16px 30px 16px 30px;font-size:20px;font-family:'Lato'">Jelajahi Semua <?= $categories['name'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="float float-request d-flex align-items-center text-center justify-content-between ps-1 w-1200 <?= !empty($items) ? '' : 'd-none' ?>" style="padding: 3px">

    <p class="my-float" id="float-value">Permintaan <?= count($items) ?> (item)</p>
    <form class="right-side" method="post" action="<?= base_url('bulk/toBulk') ?>" id="form-request-checkbox">
        <div class="form-list"></div>
        <button type="submit" class="btn btnnew btn-create-request">Lanjut <i class="bi bi-pencil-square"></i></button>

        <!-- <a href="submit" class="btn btnnew btn-create-request radius-circle">Buat Permintaan Sekarang</a> -->
    </form>
</div>

<button id="back-to-top" class="btn btnnew radius-lg back-to-top d-none" role="button">
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