<!-- <?php foreach ($data_product as $data_product_key) {
            # code...
        } ?> -->

<?php $this->load->language("product"); ?>

<div class="col-xs-12 title-mobile">
    <h5 class="f20 title-content"><?php echo $this->lang->line('judul_produk_terkait', FALSE); ?> <span class="fbold"><?php echo ucwords(strtolower($title)) ?></span></h5>
</div>
<div class="clearfix m-b-1"></div>
<?php if (!$sameproduct == null) {
?>
    <div class="col-xs-12">
        <div class="row <?php echo ($this->uri->segment(1) == "article") ? "slick-product-article-mobile" : "slicksameproduct-mobile"; ?>">
            <?php foreach ($sameproduct as $key) : ?>
                <?php $this->load->view('product/_item_product_same.php', array('key' => $key)); ?>
            <?php endforeach ?>
        </div>
    </div>
<?php } else { ?>
    <div class="col-xs-12">
        <h6 class="alert alert-warning">Tidak ada produk yang berkaitan dengan artikel diatas</h6>
    </div>
<?php } ?>