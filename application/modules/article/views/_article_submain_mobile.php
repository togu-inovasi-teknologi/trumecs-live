<?php $i = 1;
foreach ($data_page_main as $key) : ?>
    <?php if ($i != 1 && $i <= 3) : ?>
        <div class="col-xs-6 p-a-0">
            <a href="<?php echo base_url() ?>article/<?php echo $key['url'] ?>">
                <div class="card p-a-0" style="width:100%; height:160px;">
                    <img src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>" style="width: 100%; height:80px;">
                    <div class="col-lg-12 fblack">
                        <small class="f10"><?php echo $this->dateformat->indonesia($key["date"]); ?></small>
                        <?php $str = str_split($key['title'], 50); ?>
                        <h6 class="fbold f12"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0]; ?></h6>
                    </div>
                </div>
            </a>
        </div>
    <?php endif ?>
<?php $i++;
endforeach ?>