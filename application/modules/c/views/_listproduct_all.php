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
                <div class='col-xs-12'>
                    <h2 style='border-bottom:1px solid #ccc;padding-bottom:10px;'>
                        <?php echo $item->name ?>
                        <?php if (!empty($listproduct[$item->id]) && count($listproduct[$item->id]) > 3 && !$this->agent->is_mobile()) : ?>
                            <a href="<?php echo base_url("c/" . $item->url . "/query?q=on&nama=" . $querysearch . "&quality="); ?>" style="font-size:16px" class="pull-right forange"><small><?php echo $this->lang->line('link_selengkapnya', FALSE); ?> &raquo;</small></a>
                        <?php endif; ?>
                    </h2>
                </div>
                <?php foreach ($listproduct[$item->id] as $index => $key) : ?>
                    <?php if ($this->agent->is_mobile()) : ?>
                        <?php if ($view == "list") : ?>
                            <?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
                        <?php endif ?>
                        <?php if ($index == 3) {
                            echo "<div class='clearfix'></div>";
                        } ?>
                    <?php endif ?>
                    <?php if ($view != "list" or !$this->agent->is_mobile()) : ?>
                        <?php $this->load->view('product/_item_product.php', array('key' => $key)); ?>
                    <?php endif ?>

                <?php endforeach ?>
                <?php if (!empty($listproduct[$item->id]) && count($listproduct[$item->id]) > 3 && $this->agent->is_mobile()) : ?>
                    <div class="col-xs-12 m-b-3">
                        <a href="<?php echo base_url("c/" . $item->url . "/query?q=on&nama=" . $querysearch . "&quality="); ?>" style="font-size:16px;font-weight:bold" class="btn btn-orange col-xs-12"><?php echo $this->lang->line('link_selengkapnya', FALSE); ?> &raquo;</a>
                    </div>
                <?php endif; ?>
            <?php } else { ?>
                <!-- <div class="col-lg-12 col-sm-12 col-xs-12 text-center product ">
    <div class="alert alert-warning">
        Pencarian tidak ditemukan
    </div>
</div> -->
        <?php };
        endforeach;
    } else { ?>
        <div class="col-lg-12 col-sm-12 col-xs-12 text-center product ">
            <div class="alert alert-warning">
                <?php echo $this->lang->line('konten_tidak_ditemukan', FALSE); ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php if (!empty($links)) : ?>
    <div class="row ">
        <div class="col-lg-12 ">
            <div class="text-center row  linkpagination">
                <br>
                <?php echo !empty($listproduct) ? $links : "";  ?>
            </div>
            <?php if ($this->agent->is_mobile()) : ?>
                <div class="text-center m-t-1">
                    <?php if ($session_data["layout"]["view"] == "list") : ?>
                        <a href="<?php echo base_url() ?>cari?view=box" class="fblack">ubah tampilan box</a>
                    <?php else : ?>
                        <a href="<?php echo base_url() ?>cari?view=list" class="fblack">ubah tampilan list</a>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>