<?php
$img_promo = '<img alt="promo trumecs" class="promo-small position-absolute" style="right:0px;top:-2px;z-index:2" src="' . base_url() . 'timthumb?w=50&src=' . base_url() . 'public/image/promo-special.png" width="50">';
$img_bundle = '<img alt="promo trumecs" class="promo-small position-absolute" style="right:0px;top:-2px;z-index:2" src="' . base_url() . 'timthumb?w=50&src=' . base_url() . 'public/image/promo_specialoffer.png" width="50">';
$img_promo_red = '<img alt="promo trumecs" class="promo-small" src="' . base_url() . 'timthumb?w=50&src=' . base_url() . 'public/image/promo-special.png" width="50">';
$productimgonmobile = base_url() . 'timthumb?h=160&src='

?>
<div class="listproduct row g-2" itemtype="http://schema.org/ItemList">
    <?php if (!empty($listproduct)) { ?>
        <?php foreach ($listproduct as $key) : ?>
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product" class="col-6 col-sm-6 col-md-4 d-flex px-1">
                <div class="card h-100 w-100 border-0 shadow-sm rounded-3 overflow-hidden position-relative">
                    <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>" class="text-decoration-none">
                        <?php
                        $lfp = strlen($key["img"]);
                        $ext = substr($key["img"], $lfp - 4);
                        is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
                        ?>
                        <div class="position-relative bg-light" style="height: 160px; overflow: hidden;">
                            <img src="<?php echo base_url() ?>timthumb?h=170&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg") ? $key["img"] : "../noimage.png"; ?>"
                                alt="<?php echo $key["tittle"]; ?>"
                                class="w-100 h-100"
                                style="object-fit: cover; border-bottom: 0.5px solid #eee;">
                            <?php
                            $product_type = isset($key["type"]) ? $key["type"] : (isset($key["promo_product_type"]) ? $key["promo_product_type"] : 'promo');
                            ?>

                            <?php if ($product_type == "bundle"): ?>
                                <?= $img_bundle; ?>
                            <?php else: ?>
                                <?= $img_promo; ?>
                            <?php endif; ?>
                        </div>

                        <div class="card-body px-2 pt-2 pb-1">
                            <h4 itemprop="name" class="fw-semibold text-dark mb-1" style="font-size: 0.75rem; line-height: 1.3; min-height: 2.6rem; display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo ucwords(strtolower((strlen($key["tittle"]) <= 20) ? $key["tittle"] : substr($key["tittle"], 0, 20) . "...")) ?>
                            </h4>

                            <?php if ($product_type == "promo"): ?>
                                <?php
                                $percent = 90;
                                $pricepromo = "";
                                if ($key["price_promo"] != 0) {
                                    $key["price"] = ($key["price"] != 0) ? $key["price"] : $key["price_promo"];
                                    $got = $key["price_promo"];
                                    $total = $key["price"];
                                    $percent = ($got / $total) * 100;
                                    $pricepromo = $key["price"];
                                } else {
                                    $pricepromo = ($key["price"] * 100) / $percent;
                                }
                                ?>

                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="mb-1">
                                    <span class="d-flex flex-column gap-1">
                                        <?php if ($key["price_promo"] != 0 && $key["price"] != $key["price_promo"]): ?>
                                            <span class="small text-secondary text-decoration-line-through d-block" style="font-size: 0.65rem;">
                                                Rp <?php echo number_format($key["price"], 0, ',', '.'); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="fw-bold text-orange" style="font-size: 0.85rem;">
                                            <span itemprop="priceCurrency" content="IDR">Rp </span>
                                            <span itemprop="price"><?php echo number_format(($key["price_promo"] == "0") ? $key["price"] : $key["price_promo"], 0, ',', '.'); ?></span>
                                        </span>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    <?php } else { ?>
        <div class="col-12">
            <div class="alert alert-warning text-center border-0 rounded-3 py-3">
                <i class="bi bi-exclamation-triangle-fill fs-3 d-block mb-1"></i>
                <p class="mb-0 small">Tidak ada produk dalam promo ini</p>
            </div>
        </div>
    <?php } ?>
</div>