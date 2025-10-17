<?php $i = 1;
foreach ($data_page_main as $key) : ?>
    <?php if ($i == 1) : ?>
        <a href="<?php echo base_url() ?>article/<?php echo $key['url'] ?>">
            <div class="card p-a-0 card-shadow" style="width:100%; height:415px;">
                <img src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $key["img"]; ?>" style="width: 100%; height:270px;">
                <div class="col-lg-12 m-t-1 fblack">
                    <small><?php echo $this->dateformat->indonesia($key["date"]); ?></small>
                    <h4 class="fbold "><?php echo $key["title"]; ?></h4>
                </div>
            </div>
        </a>
    <?php endif ?>
<?php $i++;
endforeach ?>