<!-- <?php foreach ($data_product as $data_product_key) {
            # code...
        } ?> -->

<?php $this->load->language("product"); ?>

<div class="row m-b-1">
    <div class="col-lg-12">
        <h3 class="fbold f22"><span class="fa fa-shopping-cart forange"></span>
            <?php echo $this->lang->line('judul_produk_terkait', FALSE); ?> <?php echo ucwords(strtolower($title)) ?>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 p-x-0">
        <?php if (!$sameproduct == null) { ?>
        <div class="m-b-0 slicksameproduct-<?php echo ($this->uri->segment(1) == "article") ? "article" : "detail"; ?>">
            <?php foreach ($sameproduct as $key) : ?>
            <?php $this->load->view('product/_item_product_home.php', array('key' => $key, 'img_base_url' => $this->base_url)); ?>
            <?php endforeach ?>
        </div>
        <?php } else { ?>
        <blockquote class="alert alert-warning">Maaf. Tidak ada produk yang terkait dengan artikel tersebut</blockquote>
        <?php } ?>
    </div>
</div>