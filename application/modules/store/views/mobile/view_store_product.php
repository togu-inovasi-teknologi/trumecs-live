<div class="container">
    <div class="row gap-3 m-y-1">
        <!-- <div class="col-lg-3 sticky p-a-0">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Daftar Kategori
                </div>

                <div class="nav nav-menu flex-column nav-pills p-a-1">
                    <a href="<?= base_url($this->storeModel->domain . '/products') ?>"
                        class="nav-link category-tab <?= $this->input->get('category') == null ? 'active' : ''  ?>"
                        data-id="0">Semua Produk
                        (<?= $this->storeModel->countAllProduct() ?>)</a>
                    <?php foreach($this->storeModel->categories as $category) : ?>
                    <?php if(empty($category->products)) continue; ?>
                    <a href="<?= base_url($this->storeModel->domain . '/products?category=' . $category->name) ?>"
                        class="nav-link category-tab <?= strtolower($this->input->get('category')) == strtolower($category->name) ? 'active' : '' ?>"
                        data-id="<?= $category->id ?>"><?= $category->name . '('. $category->total .')' ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div> -->
        <div class="col-xs-12 p-a-0">
            <div class="row product-filter d-flex gap-2 w-100">
                <div class="col-xs">
                    <!-- <form action="<?= $current_url?>" method="GET">
                        <select class="form-control radius-none form-filter btnnewwhite" name="category"
                            onchange="this.form.submit()" id="category">
                            <option value="">Category</option>
                            <?php foreach($this->storeModel->categories as $category) : ?>
                            <?php if(empty($category->products)) continue; ?>
                            <option value="<?= $category->name ?>"><?= $category->name . '('. $category->total .')' ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </form> -->
                    <button type="button" class="btn btnnewwhite btn-sm" data-toggle="modal" data-target="#myModal">
                        Category <i class="fa fa-fw fa-chevron-down"></i>
                    </button>
                </div>
                <div class="col-xs text-right">
                    <a href="<?= $current_url . $order_new ?>" class="btn col-sm-12 btn-sm btnnewwhite">Terbaru </a>
                </div>
                <div class="col-xs text-right">
                    <a href="<?= $current_url . $order_price ?>" class="btn col-sm-12 btn-sm btnnewwhite">Harga
                        <?php if(isset($_GET['price']) && $_GET['price'] == 'desc') : ?>
                        <i class="fa fa-fw fa-chevron-up"></i>
                        <?php else : ?>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <div class="row m-a-0 p-a-1" id="product-store">
                <?php foreach($this->storeModel->products as $key) : ?>
                <?php $this->load->view('product/_item_product_home.php', array('key' => $key, 'class' => 'col-xs-6 p-a-0')); ?>
                <?php endforeach; ?>
            </div>
            <div class="row m-a-0" id="paginate">
                <div class="col-sm-12">
                    <?= $this->storeModel->paginations ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Category -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content m-a-1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Kategori</h4>
            </div>
            <div class="modal-body">
                <div class="nav nav-menu flex-column nav-pills p-a-1">
                    <a href="<?= base_url($this->storeModel->domain . '/products') ?>"
                        class="nav-link category-tab <?= $this->input->get('category') == null ? 'active' : ''  ?>"
                        data-id="0">Semua Produk
                        (<?= $this->storeModel->countAllProduct() ?>)</a>
                    <?php foreach($this->storeModel->categories as $category) : ?>
                    <?php if(empty($category->products)) continue; ?>
                    <a href="<?= base_url($this->storeModel->domain . '/products?category=' . $category->name) ?>"
                        class="nav-link category-tab <?= strtolower($this->input->get('category')) == strtolower($category->name) ? 'active' : '' ?>"
                        data-id="<?= $category->id ?>"><?= $category->name . '('. $category->total .')' ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>