<section id="item_share" class="item_share">
    <div class="containe">
        <div class="row catalog-content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 d-flex align-items-end gap-3">
                    <img src="<?php echo base_url(); ?>public/image/category/card-<?= $category->url;  ?>.png"
                        alt="<?php echo $category->name; ?>" width="10%">
                    <div class="flex flex-column">
                        <h2 class="fbold"><?= $category->name ?></h2>
                        <div class="line-y-sm"></div>
                    </div>
                </div>
                <div class="form-inline col-lg-6 text-right">
                    <div class="form-group">
                        <label for="search_<?= $category->id ?>">Search</label>
                        <input type="search" name="search" data-search_id="<?= $category->id ?>"
                            class="form-control search-datatable" id="search_<?= $category->id ?>"
                            placeholder="Search <?= $category->name ?>">
                    </div>

                </div>
            </div>

            <div class="col-lg-12 space-compare m-y-sm d-flex flex-column align-items-start gap-3">

            </div>

            <div class="col-lg-12 catalog">
                <input type="hidden" name="category_id" value="<?= $category->id ?>">
                <table class="display table table-hover datatable" id="id_datatable_<?= $category->id ?>">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Grade</th>
                            <th>Harga</th>
                            <th>Komparasi</th>
                            <th>Permintaan sekaligus</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>