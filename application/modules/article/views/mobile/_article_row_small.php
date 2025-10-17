<div class="col-xs-12 d-flex gap-3">
    <div class="row">
        <div class="col-xs-4">
            <img src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=200&src=<?php echo isset($img_base_url) ? $img_base_url: base_url() ?>public/image/artikel/<?php echo $artikel["img"] ?>"
                alt="..." class="img-rounded border-sm radius-none" style="object-fit: cover;width:100%;height:85px">
        </div>
        <div class="col-xs-8">
            <div class="info d-flex flex-column justify-content-between">
                <p class="f12 fbold color-primary"><?= $this->lang->line('artikel_label', FALSE) ?></p>
                <p class="value f14 fbold"><?= $artikel['title'] ?></p>
                <p class="f12 text-muted"><?= $this->dateformat->indonesia($artikel["date"]) ?></p>
            </div>
        </div>
    </div>
</div>