<div class="row slick-promo-home m-b-0">
    <?php $imgonmobile = ($this->agent->is_mobile()) ? base_url() . 'timthumb?h=200&src=' : ''; ?>
    <?php foreach ($listpromo as $i => $key) : ?>
        <div class="col-lg-6">
            <div class="card card-shadow" style="height: 134px;overflow:hidden">
                <div class="row">
                    <a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>">
                        <div class="col-lg-5">
                            <img title="<?php echo $key["name"] ?>" src="<?php echo $imgonmobile ?><?php echo base_url() ?>public/image/promo/<?php echo $key["img"] ?>" class="img-fluid m-b-1 text-center" alt="<?php echo $key["name"] ?>" style="border: 0.5px solid #ccc; max-height:134px; width:100%;">
                        </div>
                    </a>
                    <div class="col-lg-7 p-y-1 p-r-1 p-l-0">
                        <?php $str = str_split($key["description"], 100); ?>
                        <h5 class="fbold f15"><?php echo $key['name']; ?></h5>
                        <h5 class="text-muted f13"><?php echo count($str) > 1 ? $str[0] . "..." : $str[0]; ?></h5>
                        <a href="<?php echo base_url() ?>promo/<?php echo $key["url"] ?>" class="forange f13">Lihat Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php if (count($listpromo) > 2) : ?>
    <div class="prev-promo-home">
        <button class="btn btnnew"><i class="fa fa-angle-right"></i></button>
    </div>
    <div class="next-promo-home">
        <button class="btn btnnew"><i class="fa fa-angle-left"></i></button>
    </div>
<?php endif ?>