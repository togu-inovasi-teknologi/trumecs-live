<div class="card-body">
    <div class="row g-3 align-items-center">
        <div class="col-md-3">
            <img src="<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=200&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo (!empty($artikel["img"]) ? $artikel["img"] : "public/template/noimage.png") ?>"
                alt="<?= $artikel['title'] ?>"
                class="img-fluid rounded border"
                style="object-fit: cover; width: 100%; height: 150px">
        </div>
        <div class="col-md-9">
            <div class="d-flex flex-column h-100">
                <h5 class="fw-bold mb-2"><?= $artikel['title'] ?></h5>
                <p class="text-muted mb-3 flex-grow-1">
                    <?= word_limiter(strip_tags($artikel['value']), 30) ?>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        <?= $this->dateformat->indonesia($artikel["date"]) ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>