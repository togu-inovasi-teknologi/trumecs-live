<?php if (isset($media) && $media == 'half') : ?>
    <div class="col-md-6 p-l-0">
    <?php endif; ?>
    <ul class="list-group list-group-flush" style="list-style:none">
        <?php $i = 1;
        foreach ($article as $sm) : ?>
            <a href="<?php echo base_url() ?>article/<?php echo $sm['url'] ?>"
                class="f14 fw-bold fblack <?php echo $this->uri->segment(1) == 'product' ? 'article-product' : '' ?>">
                <li class="p-0"
                    style="background:#fff;border-radius:5px;margin-bottom:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
                    <div class="col-xs-4 p-0">
                        <div class="">
                            <img style="object-fit: cover;width:100%;height:100px" alt="<?php echo $sm['title'] ?>" class="img-fluid"
                                src="<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>timthumb?h=100&src=<?php echo isset($img_base_url) ? $img_base_url : base_url() ?>public/image/artikel/<?php echo $sm["img"]; ?>">
                        </div>
                    </div>
                    <div class="col-xs-8" style="padding:5px 10px;line-height:20px;">
                        <span class="f10"><?php echo $this->dateformat->indonesia($sm["date"]); ?></span><br>
                        <?php $str = str_split($sm['title'], 45); ?>
                        <?php echo count($str) > 1 ? $str[0] . '...' : $str[0]; ?>

                        <br>
                        <small class="f10"><i class="fa fa-eye" style="color:#999"></i> <?php echo $sm['view'] ?>
                            dilihat</small>
                    </div>
                    <div class="clearfix"></div>
                </li>
            </a>
            <?php if (isset($media) && $media == 'half' && $i == 4) : ?>
    </ul>
    </div>
    <div class="col-md-6 p-r-0">
        <ul class="list-group list-group-flush" style="list-style:none">
        <?php endif; ?>
    <?php $i++;
        endforeach ?>
        </ul>
        <?php if (isset($media) && $media == 'half') : ?>
    </div>
<?php endif; ?>