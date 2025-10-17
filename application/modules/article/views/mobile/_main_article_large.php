<div class="card">
    <div class="img-gradient d-flex" style="background-image:linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgb(0, 0, 0)),
    url('<?= base_url('public/image/artikel/' . $article['img']) ?>');height:300px; background-size: cover">
        <!-- <img src="" alt=""> -->
        <div class="info">
            <p class="info-a-date fwhite">
                <?php echo $this->dateformat->indonesia($article["date"]); ?></p>
            <p class="info-a-title fbold f20 fwhite"><?= $article["title"] ?></p>
        </div>
    </div>
</div>