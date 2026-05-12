<?php if (isset($media) && $media == 'half') : ?>
    <div class="d-flex">
        <div class="col-lg-6 ps-0">
        <?php endif; ?>
        <ul class="list-group list-group-flush" style="list-style:none; padding-left:0;">
            <?php
            $i = 1;
            foreach ($article as $sm) :
                // Generate image URL dengan aman untuk PHP 5.3
                $base_url_helper = (isset($img_base_url) && !empty($img_base_url)) ? $img_base_url : base_url();
                $img_path = $base_url_helper . 'public/image/artikel/' . $sm["img"];
                $article_url = base_url() . 'article/' . $sm['url'];
                $article_class = ($this->uri->segment(1) == 'product') ? 'article-product' : '';

                // Format tanggal
                $date_formatted = $this->dateformat->indonesia($sm["date"]);

                // Truncate title dengan aman untuk PHP 5.3 (tanpa mb_ functions)
                $title = $sm['title'];
                $max_length = 45;
                if (strlen($title) > $max_length) {
                    $short_title = substr($title, 0, $max_length) . '...';
                } else {
                    $short_title = $title;
                }
            ?>
                <a href="<?php echo $article_url; ?>"
                    class="f14 fw-bold fblack <?php echo $article_class; ?>"
                    style="text-decoration:none; display:block;">
                    <li class="p-0 d-flex"
                        style="background:#fff;border-radius:5px;margin-bottom:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05); list-style:none;">
                        <div class="col-lg-4 p-0" style="flex:0 0 30%; max-width:30%;">
                            <div style="width:100%; height:100px; overflow:hidden;">
                                <img style="width:100%; height:100px; object-fit:cover; object-position:center;"
                                    alt="<?php echo htmlspecialchars($sm['title'], ENT_QUOTES, 'UTF-8'); ?>"
                                    class="img-fluid"
                                    src="<?php echo $img_path; ?>">
                            </div>
                        </div>
                        <div class="col-lg-8" style="flex:0 0 70%; max-width:70%; padding:5px 10px; line-height:20px;">
                            <span class="f10"><?php echo $date_formatted; ?></span><br>
                            <?php echo htmlspecialchars($short_title, ENT_QUOTES, 'UTF-8'); ?>
                            <br>
                            <small class="f10"><i class="fa fa-eye" style="color:#999"></i> <?php echo (int)$sm['view']; ?> dilihat</small>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </a>

                <?php if (isset($media) && $media == 'half' && $i == 4) : ?>
        </ul>
        </div>
        <div class="col-lg-6 pe-0">
            <ul class="list-group list-group-flush" style="list-style:none; padding-left:0;">
            <?php endif; ?>

        <?php
                $i++;
            endforeach;
        ?>
            </ul>
            <?php if (isset($media) && $media == 'half') : ?>
        </div>
    </div>
<?php endif; ?>