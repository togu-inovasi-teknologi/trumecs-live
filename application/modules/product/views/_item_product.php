<div itemprop="itemListElement" itemscope itemtype="http://schema.org/Product"
    class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-start hv_product p-0 m-1"
    style="background:#fff; border-radius:5px; box-shadow:0px 3px 7px rgba(0,0,0,0.05); overflow:hidden; width:<?php echo $this->agent->is_mobile() ? 48.5 : 24 ?>%; border:none; margin-left:3px !important;">

    <a class="<?php echo $this->uri->segment(1) == '' ? 'random-product' : 'related-product' ?> text-decoration-none"
        itemprop="url"
        href="<?php echo base_url() ?>product/<?php echo $key['id'] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key['tittle']))) ?>">

        <?php
        $lfp = strlen($key['img']);
        $ext = substr($key['img'], $lfp - 4);
        is_file('public/image/product/' . $key['img']) != 1 ? $key['img'] = '../noimage.png' : $key['img'];
        ?>

        <div class="col-12 img-center-product"
            style="background: url('<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == '.jpg') ? $key['img'] : '../noimage.png'; ?>'); 
                    background-size: cover; 
                    background-position: center; 
                    height: 200px;">
        </div>

        <h4 itemprop="name"
            style="height:35px; display:inline-block; float:left; padding:7px !important; overflow:hidden;"
            class="<?php echo $this->agent->is_mobile() ? 'fs-6' : 'fs-5' ?> col-12 fw-bold">
            <?php echo ucwords($key['tittle']) ?>
        </h4>

        <?php
        $percent = 90;
        $pricepromo = '';
        if ($key['price_promo'] != 0) {
            $key['price'] = ($key['price'] != 0) ? $key['price'] : $key['price_promo'];
            $got = $key['price_promo'];
            $total = $key['price'];
            $percent = ($got / $total) * 100;
            $pricepromo = $key['price'];
        } else {
            $pricepromo = ($key['price'] * 100) / $percent;
        }
        ?>

        <div class="p-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="padding:5px !important">
            <?php if ($key['price_promo'] != 0) : ?>
                <span class="badge bg-warning text-dark fw-bold mb-1" style="font-weight:bold">
                    <?php echo ceil(100 - $percent) ?><small>%</small>
                </span>
                <br />
                <span class="text-muted fs-6">
                    <small><s><?php echo 'Rp.' . number_format($pricepromo); ?></s></small>
                </span>
            <?php endif; ?>

            <div class="mt-1">
                <span class="<?php echo $key['price_promo'] != 0 ? 'text-danger fw-bold' : 'text-dark fw-bold' ?> fs-5">
                    <span itemprop="priceCurrency" content="IDR">Rp</span>
                    <span itemprop="price">
                        <?php echo number_format(($key['price_promo'] == '0') ? $key['price'] : $key['price_promo'], 0, ',', '.'); ?>
                    </span>
                </span>
            </div>
        </div>
    </a>
</div>