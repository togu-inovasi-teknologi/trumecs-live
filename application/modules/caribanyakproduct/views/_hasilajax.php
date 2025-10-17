<?php $inorno = 0; ?>
<?php foreach ($hasil as $key): ?>
	<?php $random = substr( md5(rand()), 0, 20); ?>
<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default card p-a-1">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title f16 fbold fblack">
        <a class="fblack" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $random ?>" aria-expanded="false" >
          hasil pencarian dengan kata kunci <?php echo $key["katakunci"] ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $random ?>" class="panel-collapse collapse <?php echo ($inorno==0) ? "in" : "" ; ?>" role="tabpanel" aria-labelledby="headingOne">
      	<div class="">
		    <?php $hasilcari= $key["hasilcari"] ?>
		    <?php if (count($hasilcari)>0): ?>
		    <?php foreach ($hasilcari as $hk): ?>
		    <div class="row m-b-1">
			    <div class="col-md-2">
			    	<div class="crop">
			    	<img class="img-fluid" src="<?php echo base_url() ?>public/image/product/<?php echo $hk["img"] ?>">
			    	</div>
			    </div>
			    <div class="col-md-8">
	      			<div class="row">
	      				<div class="col-md-6">
	      					<?php echo ucwords(strtolower($hk["tittle"])) ?><br>
	      					<?php echo (($hk["partnumber"])) ?>
	      				</div>
	      				<div class="col-md-6">
	      					<div class="alert alert-warning">
	      						<strong>Rp.<?php echo number_format(($hk["price_promo"]!=0) ? $hk["price_promo"] : $hk["price"]) ?></strong>
	      						<small><?php echo (($hk["price_promo"]!=0) ? "promo" : "") ?></small>
	      					</div>
	      				</div>
	      			</div>
	      		</div>
	      		<div class="col-md-2 ">
	      			<a target="_blank" href="<?php echo base_url() ?>product/<?php echo $hk["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/","-", strtolower($hk["tittle"])) ?>" class="btn btn-sm btn-orange">lihat produk</a>
	      		</div>
      		</div>
      		<?php endforeach ?>
      		<div class="row">
      			<div class="col-md-12">
      				<a class="forange" target="_blank" href="<?php echo base_url() ?>c/query?q=on&nama=<?php echo $key["katakunci"] ?>">Lihat lebih banyak pencarian</a>
      			</div>
      		</div>
      		<?php else: ?>
      		pencarian "<?php echo $key["katakunci"] ?>" tidak ditemukan
      		<?php endif ?>
      		<div class="clearfix"></div>
      	</div>
    </div>
  </div>
</div>
<?php $inorno++; ?>
<?php endforeach ?>

<style type="text/css">
.crop {
    width: 100px;
    height: 80px;
    overflow: hidden;
}

.crop img {
    margin: -25px 0 0 0px;
}
</style>

