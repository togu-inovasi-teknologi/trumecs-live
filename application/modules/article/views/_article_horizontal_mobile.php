<?php foreach ($data_page as $key) : ?>
    <?php
    $lfp = strlen($key["img"]);
    $ext = substr($key["img"], $lfp - 4);
    is_file("public/image/artikel/" . $key["img"]) != 1 ? $key["img"] = "../noimage.png" : $key["img"];
    ?>
    <div class="col-xs-12 p-a-0 m-b-1" style="background:#fff;border-radius:5px;overflow:hidden;box-shadow:0px 3px 7px rgba(0,0,0,0.05);">
        <div class="col-xs-4 p-a-0">
            <a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>">
                <div class="text-center">
                    <img class="img-center-product" style="object-fit: cover;width:100%;height:120px" src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>">
                </div>
            </a>
        </div>
        <?php $str = str_split($key['title'], 60); ?>
        <div class="col-xs-8" style="line-height: 30px;">
            <small class="f10"><?php echo $this->dateformat->indonesia($key["date"]); ?></small>
            <h5 class="fbold article-title f14" style="display: flex; height:auto; line-height:1.2em;"><a href="<?php echo base_url() ?>article/<?php echo $key["url"] ?>">
                    <?php echo count($str) > 1 ? $str[0] . "..." : $str[0] ?></a></h5>
            <small class="text-muted f10"><i class="fa fa-user"></i> <a rel="author" href="https://plus.google.com/+TrumecsTrisindo" itemprop="author" itemscope itemtype="https://schema.org/Person"><span class=" sans text-muted" itemprop="name">Trumecs.com</span></a></small>
            |
            <small class="text-muted f10"><i class="fa fa-eye"></i> <span class=" sans text-muted"><?php echo $key["view"]; ?> <?php echo $this->lang->line('jumlah_dilihat'); ?></span></small>
        </div>
    </div>
<?php endforeach ?>