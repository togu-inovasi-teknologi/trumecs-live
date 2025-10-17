<?php $style = [];
if ($this->storeModel->styles != null) {
    foreach ($this->storeModel->styles as $key => $value) {
        $style[] = $value;
    }
}
$desc = [];
if ($this->storeModel->descriptions != null) {
    foreach ($this->storeModel->descriptions as $key => $value) {
        $desc[] = $value;
    }
} 
$this->load->helper('text');
?>

<div class="container p-t-2" id="store-content-information" style="background-color: <?= $style[0]->color_bg == null ? '#000' : $style[0]->color_bg ?>;color: <?= $style[0]->color_text_content == null ? '#000' : $style[0]->color_text_content ?>;">
    <div class="decoration">
        <?php if ($this->storeModel->template == 1) : ?>
            <div class="row mb-2 d-flex flex-column gap-1 p-a-0">
                <div class="col-lg-12 d-flex flex-column gap-1 align-items-center">
                    <p class="f20 font-weight-bold" style="color:<?= $style[0]->color_text_title == null ? '#fa8420' : $style[0]->color_text_title ?>">Tentang <span itemprop="name"><?= $this->storeModel->name ?></span></p>
                    <div class="card p-a-1" style="border:3px solid  <?= $style[0]->color_card_description == null ? '#fff' : $style[0]->color_card_description ?> ;border-radius:20px !important;">
                        <?php $full = nl2br($this->storeModel->description_id);
                        $less = substr($full, 0, 80); ?>
                        <div id="full-context" class="full-description" style="display: none;">
                            <p itemprop="description" class="text-center" id="description-text" style="color: <?= $style[0]->color_card_content == null ? '#fff' : $style[0]->color_card_content ?> !important;">
                                <?= $full ?>
                            </p>
                        </div>
                        <div id="less-context" class="less-description">
                            <p itemprop="description" class="text-center" id="description-text" style="color: <?= $style[0]->color_card_content == null ? '#fff' : $style[0]->color_card_content ?> !important;">
                                <?= $less ?>
                            </p>
                        </div>
                        <p id="readMore" class="read-more-btn color-primary pointer text-center">
                            Lihat selengkapnya
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row d-flex flex-column gap-2">
                        <?php foreach ($desc as $index => $description) : ?>
                            <div class="col-lg">
                                <div class="card p-a-1" style="border:2px solid <?= $style[0]->color_card_description == null ? '#fff' : $style[0]->color_card_description ?> ;border-radius:20px !important;">
                                    <div class="d-flex flex-column gap-2 align-items-center">
                                        <?php if ($description->is_image == 1) { ?>
                                            <img itemprop="image" src="<?= base_url() ?>/public/image/store/desc/<?= $description->image ?>" alt="description image" style="width:150px;">
                                        <?php } else { ?>
                                            <p class="f72"><i class="fa fa-<?= $description->icon ?>"></i></p>
                                        <?php } ?>
                                        <p class="f18 fbold text-<?= $style[0]->direction_text_title_description ?>" style="color:<?= $style[0]->color_card_title == null ? '#fa8420' : $style[0]->color_card_title ?>"><?= $description->title ?></p>
                                        <p itemprop="description" style="color: <?= $style[0]->color_card_content == null ? '#fff' : $style[0]->color_card_content ?> !important ;font-size:14px !important;text-align:justify !important;"><?= $description->content ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($this->storeModel->banners != null) : ?>
            <div class="row d-flex flex-column gap-3 m-<?= $this->storeModel->template == 1 ? 't' : 'b' ?>-1" id="banner">
                <?php foreach ($this->storeModel->banners as $value) : ?>
                    <?php if ($value->index == 0 && $value->is_mobile == 1) : ?>
                        <div class="col-lg-12 p-a-0">
                            <a href="<?= $value->link ?>">
                                <div class="banner-decoration" style="background-image:url(<?= base_url('public/image/store/banner/' . $value->source) ?>);background-size:cover;border-radius:20px;">
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php $bannerCount = 0; ?>
            <?php foreach ($this->storeModel->banners as $value) : ?>
                <?php if ($value->index != 0 && $value->is_mobile == 1) : ?>
                    <?php $bannerCount++; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="row m-b-0" id="<?= $bannerCount > 1 ? 'slick-mobile' : 'banner' ?>">
                <?php foreach ($this->storeModel->banners as $value) : ?>
                    <?php if ($value->index != 0 && $value->is_mobile == 1) : ?>
                        <a href="<?= $value->link ?>">
                            <div class="col-lg-12 p-a-0">
                                <div class="banner-decoration" style="background-image:url(<?= base_url('public/image/store/banner/' . $value->source) ?>);background-size:cover;border-radius:20px; max-height:100px;">
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($this->storeModel->template == 2) : ?>
            <div class="row d-flex flex-column gap-2 p-a-0">
                <div class="col-lg-12">
                    <p class="f18 font-weight-bold" style="color:<?= $style[0]->color_text_title == null ? '#fa8420' : $style[0]->color_text_title ?>">Tentang <?= $this->storeModel->name ?></p>
                    <div class="card p-a-1" style="border:2px solid  <?= $style[0]->color_card_description == null ? '#fff' : $style[0]->color_card_description ?> ;border-radius:20px !important;">
                        <?php $full = nl2br($this->storeModel->description_id);
                        $less = substr($full, 0, 80); ?>
                        <div id="full-context" class="full-description" style="display: none;">
                            <p id="description-text" style="color: <?= $style[0]->color_card_content == null ? '#fff' : $style[0]->color_card_content ?> !important;">
                                <?= $full ?>
                            </p>
                        </div>
                        <div id="less-context" class="less-description">
                            <p id="description-text" style="color: <?= $style[0]->color_card_content == null ? '#fff' : $style[0]->color_card_content ?> !important;">
                                <?= $less ?>
                            </p>
                        </div>
                        <p id="readMore" class="read-more-btn color-primary pointer text-center">
                            Lihat selengkapnya
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row d-flex flex-column gap-2">
                        <?php foreach ($desc as $index => $description) : ?>
                            <div class="col-lg">
                                <div class="card p-a-1" style="border:2px solid <?= $style[0]->color_card_description == null ? '#fff' : $style[0]->color_card_description ?> ;border-radius:20px !important;">
                                    <div class="d-flex flex-column gap-2 align-items-center">
                                        <?php if ($description->is_image == 1) { ?>
                                            <img itemprop="image" src="<?= base_url() ?>/public/image/store/desc/<?= $description->image ?>" alt="description image" style="width:150px;">
                                        <?php } else { ?>
                                            <p class="f72"><i class="fa fa-<?= $description->icon ?>"></i></p>
                                        <?php } ?>
                                        <p class="f18 fbold text-<?= $style[0]->direction_text_title_description ?>" style="color:<?= $style[0]->color_card_title == null ? '#fa8420' : $style[0]->color_card_title ?>"><?= $description->title ?></p>
                                        <p itemprop="description" style="color: <?= $style[0]->color_card_content == null ? '#fff' : $style[0]->color_card_content ?> !important ;font-size:14px !important; text-align:justify !important;"><?= $description->content ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if($this->uri->segment(1) == 'trumecs-bazaar'): ?>
    <div class="container p-y-3">
        <h3 class="text-center fbold">Download Price List Trumecs Bazaar!</h3>
        <div class="row m-t-2 text-center">
            <div class="col-md-6 col-md-offset-3">
                <div class="col-xs-12 p-a-2" style="box-shadow: 1px 1px 8px rgba(0,0,0,.3); border-radius:10px">
                    <h4 class="text-center fbold m-b-2">Daftar Harga Lengkap</h4>
                    <p>Dapatkan katalog dan daftar harga lengkap semua produk yang ada di Trumecs Bazaar</p>
                    <button id="sph-bazaar" class="btn btn-lg btn-danger m-t-2 col-xs-12 atas" style="border-radius:20px">Download Price List</button>
                    <br />
                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <small></small>
        </div>
    </div>
    <?php endif; ?>
    <div class="row m-y-1 m-x-0">
        <div class="col-lg-12 p-a-0">
            <p class="font-weight-bold f20" style="color: <?= $style[0]->color_text_title == null ? '#000' : $style[0]->color_text_title ?>;">Produk <?= $this->storeModel->name ?></p>
        </div>
        <?php foreach ($this->storeModel->categories as $category) : ?>
            <?php if (empty($category->products)) continue ?>
            <?php if ($this->storeModel->template_produk == 2) { ?>
                <div class="col-lg-12 m-y-2 d-flex flex-column gap-3">
                    <?php foreach ($category->products as $kategori) :
                    ?>
                        <div class="row card p-x-2 p-y-1 d-flex flex-column align-items-center" style="background:<?= $style[0]->color_card_product == null ? '#fff' : $style[0]->color_card_product ?>; border-radius:10px !important;">
                            <div class="col-lg-12 text-center m-b-1 p-a-0">
                                <a href="<?php echo site_url("product/".$kategori['id']."/".preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($kategori["tittle"])))); ?>">
                                    <?php
                                    $lfp = strlen($kategori["img"]);
                                    $ext = substr($kategori["img"], $lfp - 4);
                                    is_file("public/image/product/" . $kategori["img"]) != 1 ? $kategori["img"] = "../noimage.png" : $kategori["img"];
                                    ?>
                                    <img style="width: 100%;max-height: 400px;margin-bottom: 16px;" class="img-center-product" src="<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext == ".jpg") ? $kategori["img"] : "../noimage.png"; ?>" />
                                </a>
                            </div>
                            <div class="col-lg-12 d-flex-sb flex-column">
                                <div class="d-flex flex-column gap-3 m-b-2 align-items-center" style="color:<?= $style[0]->color_text_card_product == null ? '#fff' : $style[0]->color_text_card_product ?>;">
                                    <a class="f24 fbold" href="<?php echo site_url("product/".$kategori['id']."/".preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($kategori["tittle"])))); ?>"><?= $kategori['tittle'] ?></a>
                                    <p class="f14 col-xs-12 p-a-0" style="text-align:left" ><?= word_limiter($kategori['description'], 50) ?></p>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <a href="<?= $this->uri->segment(2) == 'epcm' || $this->uri->segment(2) == 'service-vehicle' || $this->uri->segment(2) == 'chemicals' ? base_url('product' . $kategori['id']) : 'https://wa.me/+6285176912338?text=' . $kategori['tittle'] ?>" class="btn btn-success text-white text-center shadow" style="border-radius:5px;">
                                        <p class="f16 fbold">Rp <?php echo number_format($kategori['price_promo'] != 0 && $kategori['price_promo'] != null ? $kategori['price_promo'] : $kategori['price'], 0, ',', '.' ) ?></p>
                                    </a>
                                    <?php if ($kategori['file'] != null) : ?>
                                        <a target="_blank" href="<?= base_url() ?>public/produk/file/<?= $kategori['file'] ?>" class="btn btn-warning text-center shadow" style="border-radius:5px;">
                                            <p class="f16 fbold">Lihat Specs</p>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php } else { ?>
                <div class="col-lg-12 m-b-2 p-a-0">
                    <div itemscope itemtype="https://schema.org/ItemList">
                        <div class="row d-flex-sb align-items-center">
                            <div class="col-lg-6">
                                <!-- <p itemprop="name" class="font-weight-bold f18" style="color: <?= $style[0]->color_text_name_category == null ? '#fa8420' : $style[0]->color_text_name_category ?>;"><?= $category->name ?></p> -->
                            </div>
                            <!-- <div class="form-inline col-lg-6 text-right">
                        <div class="form-group">
                            <label for="search_<?= $category->id ?>">Search</label>
                            <input type="search" name="search" data-search_id="<?= $category->id ?>" class="form-control search-datatable" id="search_<?= $category->id ?>" placeholder="Search <?= $category->name ?>">
                        </div>
                    </div> -->
                        </div>
                        <div class="row m-y-1">
                            <div class="col-lg-12 catalog">
                                <input type="hidden" name="category_id" value="<?= $category->id ?>">
                                <table class="table datatable w-100" id="datatable-product-mobile-<?= $category->id ?>">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%;">Nama</th>
                                            <th style="width: 50%;">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($category->products as $kategori) :
                                        ?>
                                            <tr itemprop="itemListElement" itemscope itemtype="https://schema.org/Product">
                                                <td>
                                                    <a itemprop="url" href="<?= base_url() ?>product/<?= $kategori['id'] ?>" class="fbold" style="color:<?= $style[0]->color_text_name_product == null ? '#fa8420' : $style[0]->color_text_name_product ?>"><span itemprop="name"><?= $kategori['tittle'] ?></span></a>
                                                    <p itemprop="brand" itemprop="name" hidden><?= $kategori['brand'] ?></p>
                                                    <p itemprop="mpn" hidden><?= $kategori['partnumber'] ?></p>

                                                </td>
                                                <td>
                                                    <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                                        <p class="text-right"><span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price" class="uang"><?= $kategori['price'] ?></span></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>
</div>
<?php if($this->uri->segment(1) == 'trumecs-bazaar'): ?>
<div class="container p-y-3">
    <h3 class="text-center fbold">Download Price List Trumecs Bazaar!</h3>
    <div class="row m-t-2 text-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="col-xs-12 p-a-2" style="box-shadow: 1px 1px 8px rgba(0,0,0,.3); border-radius:10px">
                <h4 class="text-center fbold m-b-2">Daftar Harga Lengkap</h4>
                <p>Dapatkan katalog dan daftar harga lengkap semua produk yang ada di Trumecs Bazaar</p>
                <button id="sph-bazaar" class="btn btn-lg btn-danger m-t-2 col-xs-12 bawah" style="border-radius:20px">Download Price List</button>
                <br />
            </div>
        </div>
        <div class="clearfix"></div>
        <br/>
        <small></small>
    </div>
</div>
<div id="modal-bazaar" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Download Bazaar Price List</h5>
      </div>
      <div class="clearfix"></div>
      <div class="modal-body">
            <form id="form-bazaar" method="POST" action="<?php echo site_url("promo/bazaar") ?>">
            <div class="row">
                <div class="col-xs-12">
                    <img src="<?php echo base_url("public/banner/iklan/trumecs-bazaar-offer.png"); ?>" width="100%" />
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="form-label">
                            Nama
                        </label>
                        <input type="text" name="name" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            Nama Usaha
                        </label>
                        <input type="text" name="company" class="form-control" />
                        <small class="form-help">Isi perorangan bila perorangan</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            Lokasi / Rencana dikirim ke
                        </label>
                        <input type="text" name="location" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            Nomor Telepon/WA
                        </label>
                        <input type="text" name="phone" class="form-control" required="required" />
                        <input type="hidden" name="type" value="bazaar" />
                    </div>
                </div>
            </div>
            </form>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="submit" form="form-bazaar" class="btn btn-danger tag-btn-dl-bazaar">Download</button>
        <button type="button" class="btn btn-secondary tag-btn-cancel-bazaar" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<script>
    function readmore() {
        const fullContext = document.getElementById("full-context");
        const lessContext = document.getElementById("less-context");
        const readMoreBtn = document.getElementById("readMore");

        if (fullContext.style.display === "none") {
            fullContext.style.display = "block";
            lessContext.style.display = "none";
            readMoreBtn.textContent = "Lihat lebih sedikit";
        } else {
            fullContext.style.display = "none";
            lessContext.style.display = "block";
            readMoreBtn.textContent = "Lihat selengkapnya";
        }
    }
</script>