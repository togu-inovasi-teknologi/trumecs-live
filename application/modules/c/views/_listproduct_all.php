<?php
$session_data = $this->session->all_userdata();
$img_promo = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo_specialoffer.png" width="70">';
$img_promo_red = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=70&src=' . base_url() . 'public/image/promo-special.png" width="70">';
?>
<div class="listproduct" itemtype="http://schema.org/ItemList">
    <link itemprop="url" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

    <?php if (!empty($listproduct)) {
        foreach ($category->result() as $item) : ?>
            <?php if (!empty($listproduct[$item->id])) { ?>
                <?php $view = $session_data["layout"]["view"]; ?>
                <div class='col-12'>
                    <div class="d-flex justify-content-between align-items-end mb-3 pb-2 border-bottom">
                        <h2 class="h4 fw-bold mb-0">
                            <?php echo $item->name ?>
                        </h2>
                        <?php if (!empty($listproduct[$item->id]) && count($listproduct[$item->id]) > 3 && !$this->agent->is_mobile()) : ?>
                            <a href="<?php echo base_url("c/" . $item->url . "/query?q=on&nama=" . $querysearch . "&quality="); ?>"
                                class="text-decoration-none"
                                style="color: #fa8420;">
                                <small><?php echo $this->lang->line('link_selengkapnya', FALSE); ?> &raquo;</small>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php foreach ($listproduct[$item->id] as $index => $key) : ?>
                    <?php if ($this->agent->is_mobile()) : ?>
                        <?php if ($view == "list") : ?>
                            <?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
                        <?php endif ?>
                        <?php if ($index == 3) : ?>
                            <div class='clearfix'></div>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if ($view != "list" or !$this->agent->is_mobile()) : ?>
                        <?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
                    <?php endif ?>
                <?php endforeach ?>

                <?php if (!empty($listproduct[$item->id]) && count($listproduct[$item->id]) > 3 && $this->agent->is_mobile()) : ?>
                    <div class="col-12 mb-3">
                        <a href="<?php echo base_url("c/" . $item->url . "/query?q=on&nama=" . $querysearch . "&quality="); ?>"
                            class="btn w-100 fw-bold"
                            style="background-color: #fa8420; color: white; border: none;">
                            <?php echo $this->lang->line('link_selengkapnya', FALSE); ?> &raquo;
                        </a>
                    </div>
                <?php endif; ?>
            <?php } else { ?>
                <!-- Optional: Show message if no products in category -->
                <!-- 
                <div class="col-12 text-center">
                    <div class="alert alert-warning">
                        Tidak ada produk dalam kategori ini
                    </div>
                </div>
                -->
            <?php } ?>
        <?php endforeach;
    } else { ?>
        <div class="col-12 text-center product">
            <div class="alert alert-warning" role="alert">
                <?php echo $this->lang->line('konten_tidak_ditemukan', FALSE); ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php if (!empty($links)) : ?>
    <div class="row">
        <div class="col-12">
            <div class="text-center linkpagination my-4">
                <?php echo !empty($listproduct) ? $links : ""; ?>
            </div>

            <?php if ($this->agent->is_mobile()) : ?>
                <div class="text-center mt-3">
                    <?php if ($session_data["layout"]["view"] == "list") : ?>
                        <a href="<?php echo base_url() ?>cari?view=box"
                            class="text-decoration-none text-dark">
                            <i class="bi bi-grid-3x3 me-1"></i>
                            ubah tampilan box
                        </a>
                    <?php else : ?>
                        <a href="<?php echo base_url() ?>cari?view=list"
                            class="text-decoration-none text-dark">
                            <i class="bi bi-list me-1"></i>
                            ubah tampilan list
                        </a>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>