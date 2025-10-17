<?php $img_promo_red= '<img alt="promo trumecs" class="promo-small" src="'.base_url().'/public/image/promo-special.png" width="70">'; ?>
<div class="heading_promo col-md-12 p-y-1">
<strong><?php echo $promo_inseach_hor["promo"][0]["name"] ?></strong>
<a class="btn btn-secondary" data-toggle="popover" data-delay='{"show":"100", "hide":"10000"}' data-content="<div><?php echo $promo_inseach_hor["promo"][0]["description"] ?> <hr><a href='<?php echo base_url().'promo/'. $promo_inseach_hor["promo"][0]["url"] ?>' class='btn col-lg-12 btn-orange'>Lihat Promo</a><br><br></div>" data-html="true" data-original-title="<?php echo $promo_inseach_hor["promo"][0]["name"] ?>" data-trigger="hover click" ><i class="fa fa-tags"></i></a>
</div>
<div class="list_promo col-md-12">
	<?php if (count($listproduct)>0): ?>
	<?php $labelpromo= $promo_inseach_hor["promo"][0]["name"] ?>
		<?php foreach (array_slice($promo_inseach_hor["product"], 0,5) as $key): ?>
			<div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-md-15 text-left hv_product ">
		        <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
		            <?php 
		            $lfp=strlen($key["img"]);
		            $ext=substr($key["img"], $lfp-4);
		            is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
		            ?>
		            <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
		            </div>
		            <h4 itemprop="name" class="f14 fbold"><?php echo ucwords(strtolower((strlen($key["tittle"])<=20)? $key["tittle"] : substr($key["tittle"], 0,20)."..." )) ?></h4>  
		            <span class="infolablepromo"><?php echo $labelpromo ?></span><br>
		            <div  itemprop="offers" itemscope itemtype="http://schema.org/Offer">                
		                <hr class="m-a-0">
		                <span class="f14 fbold nomt fblack " style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp.</span> <span class="fbold" itemprop="price"><?php echo  number_format(($key["price_promo"]=="0") ? $key["price"] : $key["price_promo"] ); ?></span><small class="small-small fblack">/<?php echo ucwords($key["unit"]) ?></small></span> 
		            </div>

		            <?php echo $img_promo_red;?>
		            <span id="btnbuy<?php echo $key["id"] ?>" class="btn btn-orange col-lg-12 vhidden"><i class="fa fa-shopping-cart"></i> Beli</span>
		        </a>                           
		    </div> 
		<?php endforeach ?>
	<?php endif ?>
</div>
<div class="clearfix"></div>