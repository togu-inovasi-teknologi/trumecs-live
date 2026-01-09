<?php
$session_data = $this->session->all_userdata();
$img_promo = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo_specialoffer.png" width="70">';
$img_promo_red = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo-special.png" width="70">';
?>

<div class="listproduct col-lg-12" itemtype="http://schema.org/ItemList">
    <link itemprop="url" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

    <?php if (!empty($listproduct)) { ?>
        <?php $view = $session_data["layout"]["view"]; ?>
        <?php foreach ($listproduct as $index => $key) : ?>
            <?php if ($view == "list") : ?>
                <?php $this->load->view('product/mobile/_item_product_c.php', array('key' => $key)); ?>
            <?php endif ?>
            <?php if ($index == 1 || ($index % 2 == 1 && $index > 0)) : ?>
                <div class="clearfix"></div>
            <?php endif ?>
        <?php endforeach ?>

    <?php } else { ?>
        <div class="col-12 text-center product">
            <div class="alert alert-warning" role="alert">
                <?php echo $this->lang->line('konten_tidak_ditemukan', FALSE); ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php if (!empty($links)) : ?>
    <div class="col-12">
        <div class="text-center linkpagination mt-3">
            <?php echo !empty($listproduct) ? $links : ""; ?>
        </div>

        <!-- <div class="text-center mt-3">
            <?php if ($session_data["layout"]["view"] == "list") : ?>
                <a href="<?php echo base_url() ?>cari?view=box" class="text-decoration-none text-dark">
                    <i class="bi bi-grid-3x3 me-1"></i>
                    ubah tampilan box
                </a>
            <?php else : ?>
                <a href="<?php echo base_url() ?>cari?view=list" class="text-decoration-none text-dark">
                    <i class="bi bi-list me-1"></i>
                    ubah tampilan list
                </a>
            <?php endif ?>
        </div> -->
    </div>
<?php endif ?>