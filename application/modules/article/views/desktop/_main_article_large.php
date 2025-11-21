<div class="card border-0 shadow-sm h-100">
    <!-- Gambar dengan gradient overlay -->
    <div class="img-gradient position-relative"
        style="background-image:url('<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=300&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo (!empty($article["img"]) ? $article["img"] : "public/template/noimage.png") ?>');height:300px; background-size: cover">
    </div>
    <!-- Teks di bawah gambar -->
    <div class="card-body">
        <p class="text-muted small mb-2">
            <i class="fas fa-calendar me-1"></i>
            <?php echo $this->dateformat->indonesia($article["date"]); ?>
        </p>
        <h5 class="card-title fw-bold text-dark"><?= $article["title"] ?></h5>
        <p class="card-text text-muted small">Baca selengkapnya →</p>
    </div>
</div>