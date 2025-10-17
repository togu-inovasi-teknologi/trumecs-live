<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"]; ?>

<!--Start Page-->
<div class="cart_page <?php echo ($this->agent->is_mobile()) ? "row": "" ; ?>">
	<div class="col-lg-12 text-center m-y-1">
		<h1 class="f22 fbold">Alamat Pengiriman</h1>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class=" card text-center p-y-1">
			
			<div class="p-a-1 text-left show_after_click">
				
				<?php if (date("l")=="Saturday" or date("l")=="Saturday" or (date("H")<=18) or (date("H")>=6)): ?>
				<div class="alert alert-warning alert-dismissible fade in show_truely" role="alert">
					<strong>Perhatian!!</strong>
					<p>Proses dan Delivery akan dilakukan di hari dan jam kerja.</p>
				</div>
				<?php endif ?>
				<?php $newarrayestimate = array();$totalweight=0?>
				<?php foreach ($this->cart->contents() as $key): ?>
					<?php array_push($newarrayestimate, $key["estimated_delivery"]) ?>
					<?php  $totalw=$key["qty"]*$key["weight"];
							$totalweight=$totalweight+$totalw; ?>
				<?php endforeach ?>
				<?php $this->load->view("_shipping_page_form_trumecs") ?>
						
			</div>
		</div>
	</div>
</div>

<div class="modal fade modelcekfreeongkir" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<?php
$totalw=0;$totalweight=0;$total=0;
foreach ($this->cart->contents() as $key) {
	$totalw=$key["qty"]*$key["weight"];
	$totalweight=$totalweight+$totalw;
	$totalprice=$key["price"]*$key["qty"];
	$total = $total+$totalprice;
}
$percent = (($totalweight*DELIVERY_PER_KG)/$total);
$percent_friendly = number_format($percent* 100);
$duapersen = (($total/100)* 2);
?>

<span class="hidden showmodalcost" totalhargaberat="<?php echo $totalweight*DELIVERY_PER_KG ?>" totalbataspercent="3" totalpercent="<?php echo $percent_friendly ?>" duapersen="<?php echo $duapersen ?>" totalsemau="<?php echo $total ?>"></span>
  <div class="modal-dialog ">
    <div class="modal-content ">
     	<div class="modal-body alert alert-warning m-a-0">
     		<strong>Perhatian!!</strong>
     		<p>Jumlah pembayaran Anda belum mencukupi untuk Free Ongkir ke Kota Destinasi Pengiriman di <span class="select-city-modal"></span></p>
     		<div class="alert alert-danger">
				<p> untuk mendapatkan Free Ongkir, Anda cukup menambah pesanan minimal <strong class="harga-modal">Rp.400,000</strong>.</p>
			</div>
			<p><a href="<?php echo base_url() ?>c" class="btn btn-white">Tambah Produk</a> <span href="" class="btn btn-orange true_lah">lanjutkan Pengiriman</span></p>

     	</div>
    </div>
  </div>
</div>
