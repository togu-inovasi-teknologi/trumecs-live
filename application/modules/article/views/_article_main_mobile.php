<?php $i = 1;
foreach ($data_page_main as $key) : ?>
    <?php if ($i == 1) : ?>
        <a href="<?php echo base_url() ?>article/<?php echo $key['url'] ?>">
            <div class="card p-a-0 ">
                <img src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>" style="width: 100%; height:130px;">
                <div class="col-lg-12 fblack">
                    <small><?php echo $this->dateformat->indonesia($key["date"]); ?></small>
                    <?php $str = str_split($key["title"], 80); ?>
                    <h6 class="fbold "><?php echo count($str) > 1 ? $str[0] . "..." : $str[0]; ?></h6>
                </div>
            </div>
        </a>
    <?php endif ?>
<?php $i++;
endforeach ?>