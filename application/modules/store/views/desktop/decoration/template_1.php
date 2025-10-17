<div class="decoration">
    <div class="row">
        <div class="col-lg-12">
            <p><?= $store->description_id ?></p>
        </div>
    </div>
    <div class="row d-flex flex-column gap-3 m-y-3">
        <?php foreach($store->banners() as $value) : ?>
        <div class="col-lg-12">
            <div class="banner-decoration"
                style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?= base_url('public/image/store/cover/'. $value->source  ) ?>);background-size:cover;">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>