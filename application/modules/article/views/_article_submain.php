<?php $i = 1;
foreach ($data_page_main as $key) : ?>
    <?php if ($i != 1 && $i <= 3) : ?>
        <a href="<?php echo base_url() ?>article/<?php echo $key['url'] ?>">
            <div class="card p-a-0 card-shadow" style="width:100%; height:200px;">
                <img src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>" style="width: 100%; height:110px;">
                <div class="col-lg-12 fblack">
                    <small class="f10"><?php echo $this->dateformat->indonesia($key["date"]); ?></small>
                    <?php $str = str_split($key["title"], 70); ?>
                    <h6 class="fbold "><?php echo count($str) > 1 ? $str[0] . "..." : $str[0] ?></h6>
                </div>
            </div>
        </a>
    <?php endif ?>
<?php $i++;
endforeach ?>