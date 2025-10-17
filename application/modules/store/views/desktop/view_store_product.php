<div class="container">
    <div class="row gap-3 m-y-3">
        <div class="col-lg-3 sticky p-a-0">
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
        </div>
        <div class="col-lg-9 p-r-0 ">
            <div class="row d-flex justify-content-end">
                <div class="col-lg-3 text-right">
                    <a href="<?= $current_url . $order_new ?>" class="btn col-sm-12 btn-sm btnnewwhite">Terbaru </a>
                </div>
                <div class="col-lg-3 text-right">
                    <a href="<?= $current_url . $order_price ?>" class="btn col-sm-12 btn-sm btnnewwhite">Harga
                        <?php if(isset($_GET['price']) && $_GET['price'] == 'desc') : ?>
                        <i class="fa fa-fw fa-chevron-up"></i>
                        <?php else : ?>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <div class="row m-t-1" id="product-store">
                <?php foreach($this->storeModel->products as $key) : ?>
                <?php $this->load->view('product/_item_product_home.php', array('key' => $key, 'class' => 'col-lg-3')); ?>
                <?php endforeach; ?>
            </div>
            <div class="row" id="paginate">
                <div class="col-sm-12">
                    <?= $this->storeModel->paginations ?>
                </div>
            </div>
        </div>
    </div>
</div>