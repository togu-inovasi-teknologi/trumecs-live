<div class="row slick-promo-home-mobile m-b-0">
    <?php $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : ''; ?>
    <?php foreach ($listpromo as $i => $key) : ?>
        <div class="col-xs-12">
            <div class="card card-shadow" style="height: 110px;overflow:hidden;">
                <div class="row">
                    <a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
                        <div class="col-xs-5 p-r-0">
                            <img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid m-b-1 text-center" alt="<?php echo $key["name"] ?>" style="border-bottom: 0.5px solid #ccc; max-height:110px; width:100%;">
                        </div>
                    </a>
                    <?php $str = str_split($key['description'], 60); ?>
                    <div class="col-xs-7 p-a-1" style="border-left:1px solid #eee;">
                        <h5 class="fbold f11"><?php echo $key['name']; ?></h5>
                        <h5 class="text-muted f10 m-b-0"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0] ?></h5>
                        <a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="forange f10">Lihat Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>