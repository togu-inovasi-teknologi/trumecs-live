<div class="col-lg-12 d-flex gap-3">
    <img src="<?= base_url('public/image/artikel/' . $artikel['img']) ?>" alt="..."
        class="img-rounded border-sm radius-none" style="object-fit: cover;width:160px;height:150px">
    <div class="info d-flex flex-column justify-content-between">
        <p class="f20 fbold"><?= $artikel['title'] ?></p>
        <div class="value">
            <?= strip_tags($artikel['value']) ?>
        </div>
        <p class="f12 text-muted"><?= $this->dateformat->indonesia($artikel["date"]) ?></p>
    </div>
</div>