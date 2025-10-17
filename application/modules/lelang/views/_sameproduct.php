<?php foreach ($data_lelang as $data_product_key ) {
	# code...
} ?>

<?php function randommakelar()
{
	$randommakelar = array(
		'terkait dengan sparepart',
		'adalah sparepart yang sama dengan',
		'adalah sparepart sejenis dengan',
		'sparepart yang berhubungan dengan',
		'mungkin segolongan dengan sparepart',
		);
	return $randommakelar[rand(0,4)];
} ?>
<div class="col-lg-12 m-t-1">
	<h4 class="introsame">Lelang terkait dengan <?php echo ucwords(strtolower($data_product_key["judul"])) ?></h4>
<hr class="hidden-sm-down">
</div>
<div class="slicksameproduct col-lg-12 <?php echo (!$this->agent->is_mobile()) ? "" : "p-x-0" ; ?>">

	<?php foreach ($sameproduct as $key): ?>
	<div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-left hv_product m-y-1 p-y-1">
            <a itemprop="url" href="<?php echo base_url() ?>lelang/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["judul"]))) ?>">
                <?php 
                $lfp=strlen($key["img"]);
                $ext=substr($key["img"], $lfp-4);
                is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                ?>
                <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                </div>
                <h4 itemprop="name" style="height:35px;display:inline-block" class="f14"><?php echo ucwords($key["judul"]) ?></h4>  
                 
                <div  itemprop="offers" itemscope itemtype="http://schema.org/Offer">                
                    <span class="f14 nomt" style="color:#ffa500;font-weight:">
                        <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format($key["nilai"],0,",","." ); ?></span>
                    </span> 
                </div>    
                <?php //echo $img_promo;?>
            </a>
            <a itemprop="url" href="<?php echo base_url() ?>lelang/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["judul"]))) ?>" class="btn btn-white col-xs-12 m-y-1  f12">Lihat Detail</a>
        </div>
	<?php endforeach ?>
</div>