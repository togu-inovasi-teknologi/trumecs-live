<div class="col-12 d-flex gap-3">
    <div class="row w-100 g-0">
        <div class="col-4">
            <img src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=200&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo $artikel["img"] ?>"
                alt="<?= htmlspecialchars($artikel['title']) ?>"
                class="img-fluid rounded border object-fit-cover w-100"
                style="height:85px">
        </div>
        <div class="col-8">
            <div class="info d-flex flex-column justify-content-between h-100 ps-2">
                <p class="f12 fbold color-primary mb-1"><?= $this->lang->line('artikel_label', FALSE) ?></p>
                <p class="value f14 fbold mb-1 text-truncate-2"><?= $artikel['title'] ?></p>
                <p class="f12 text-muted mb-0"><?= $this->dateformat->indonesia($artikel["date"]) ?></p>
            </div>
        </div>
    </div>
</div>