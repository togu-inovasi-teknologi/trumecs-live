<div class="col-lg-12 d-flex gap-3">
    <div class="row">
        <div class="col-lg-3">
            <img src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=200&src=<?php echo isset($img_base_url) ? $img_base_url: base_url() ?>public/image/artikel/<?php echo $artikel["img"] ?>"
                alt="..." class="img-rounded border-sm radius-none" style="object-fit: cover;width:100%;height:150px">
        </div>
        <div class="col-lg-9">
            <div class="info d-flex flex-column justify-content-between">
                <p class="f20 fbold"><?= $artikel['title'] ?></p>
                <div class="value">
                    <?= word_limiter(strip_tags($artikel['value']), 30) ?>
                </div>
                <p class="f12 text-muted"><?= $this->dateformat->indonesia($artikel["date"]) ?></p>
            </div>
        </div>
    </div>

</div>