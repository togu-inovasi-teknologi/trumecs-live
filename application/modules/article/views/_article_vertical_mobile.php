<?php $i = 1;
foreach ($article as $sm) : ?>
    <div class="col-xs-6 p-x-1" style="border-radius: 10px;">
        <a href="<?php echo base_url() ?>article/<?php echo $sm['url'] ?>" class="f14 fbold fblack <?php echo $this->uri->segment(1) == 'product' ? 'article-product' : '' ?>" style="text-decoration: none;">
            <div class="card p-a-1" style="border-radius: 5px;height: 150px;">
                <img style="object-fit: cover;width:100%;height:60px" class="img-fluid" src="<?php echo base_url() ?>timthumb?h=200&src=<?php echo base_url() ?>public/image/artikel/<?php echo $sm["img"]; ?>">
                <small style="font-size: 6px;"><?php echo $this->dateformat->indonesia($sm["date"]); ?></small>
                <?php $str = str_split($sm['title'], 50); ?>
                <h5 class="f10" style="line-height: 15px;"><strong><?php echo count($str) > 1 ? $str[0] . '...' : $str[0]; ?></strong></h5>
            </div>
        </a>
    </div>
<?php $i++;
endforeach ?>