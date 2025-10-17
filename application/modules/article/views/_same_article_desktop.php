<?php if (isset($media) && $media == 'half') : ?>
<div class="col-lg-6 p-l-0">
    <?php endif; ?>
    <?php $i = 1;
    foreach ($article as $sm) : ?>
    <a href="<?php echo base_url() ?>article/<?php echo $sm['url'] ?>"
        class="f14 fbold fblack <?php echo $this->uri->segment(1) == 'product' ? 'article-product' : '' ?>">
        <div class="card card-shadow" style="margin-bottom: 5px;">
            <div class="row">
                <div class="col-lg-12">
                    <img style="object-fit: cover;width:100%;height:100px" class="img-responsive"
                        src="<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=200&src=<?php echo isset($img_base_url) ? $img_base_url: base_url() ?>public/image/artikel/<?php echo $sm["img"]; ?>">
                </div>
                <div class="col-lg-12 info d-flex-sb flex-column justify-space-between"
                    style="padding:5px 15px;line-height:20px;">
                    <span class="f10"><?php echo $this->dateformat->indonesia($sm["date"]); ?></span>
                    <span class="value"><?= $sm['title'] ?></span>

                    <small class="f10"><i class="fa fa-eye" style="color:#999"></i> <?php echo $sm['view'] ?>
                        dilihat</small>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </a>
    <?php if (isset($media) && $media == 'half' && $i == 4) : ?>
</div>
<div class="col-lg-6 p-r-0">
    <ul class="list-group list-group-flush" style="list-style:none">
        <?php endif; ?>
        <?php $i++;
    endforeach ?>
    </ul>
    <?php if (isset($media) && $media == 'half') : ?>
</div>
<?php endif; ?>