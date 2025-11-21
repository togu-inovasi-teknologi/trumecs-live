<div class="card border-0 shadow-sm h-100">
    <!-- Gambar dengan gradient overlay -->
    <div class="img-gradient position-relative"
        style="background-image:url('<?= isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=150&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo (!empty($article["img"]) ? $article["img"] : "public/template/noimage.png") ?>');height:150px; background-size: cover">
    </div>
    <!-- Teks di bawah gambar -->
    <div class="card-body p-3">
        <p class="text-muted small mb-1">
            <i class="fas fa-calendar me-1"></i>
            <?php echo $this->dateformat->indonesia($article["date"]); ?>
        </p>
        <h6 class="card-title fw-bold text-dark mb-0"><?= $article["title"] ?></h6>
    </div>
</div>