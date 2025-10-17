<?php $session = $this->session->all_userdata();
$sessionmember= $session["member"]; ?>

<!--Start Page-->
<div class="cart_page <?php echo ($this->agent->is_mobile()) ? "row": "" ; ?>">
	<div class="col-lg-12 text-center m-y-1">
		<h1 class="f22 fbold">Metode Pengiriman</h1>
	</div>
	<div class="col-md-6">
		<div class=" card text-center p-y-1">
			<div class="show">
				<img src="<?php echo base_url() ?>public/image/shipping-trumecs.png" >
				<h2 class="f22 fbold">Delivery by TruMecs</h2>
				<span class="f12 fbold">Kami akan mengantarkan pesanan Anda ke alamat Anda.<br><br>
				</span><br>
				<hr class="">
				<a href="#" class="btn btn-orange triger_show_from">Pilih</a>
			</div>
			
			<div class="p-a-1 text-left hidden-xl-down show_after_click">
				
						<?php if (date("l")=="Saturday" or date("l")=="Saturday" or (date("H")<=18) or (date("H")>=6)): ?>
						<div class="alert alert-warning alert-dismissible fade in show_truely" role="alert">
							<strong>Perhatian!!</strong>
							<p>Proses dan Delivery akan dilakukan di hari dan jam kerja.</p>
						</div>
						<?php endif ?>
						<div class="alert alert-warning alert-dismissible fade in " role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							<?php $newarrayestimate = array();$totalweight=0?>
							<?php foreach ($this->cart->contents() as $key): ?>
								<?php array_push($newarrayestimate, $key["estimated_delivery"]) ?>
								<?php  $totalw=$key["qty"]*$key["weight"];
										$totalweight=$totalweight+$totalw; ?>
							<?php endforeach ?>
							<p>Barang yang Anda pesan memiliki estimasi pengiriman 1-<?php echo max($newarrayestimate); ?> hari kerja.</p>
						</div>
						<div class="shippingcoiche show_truely text-center">
								<div class="col-md-12"><strong class="f18">Pilih Pengirim</strong></div>
								<a href="<?php echo base_url() ?>cart/shipping_jne"  dddata-toggle="collapse" dd="#collapseJNE" aria-expanded="false" class="col-md-3 col-xs-6">
									<img src="<?php echo base_url() ?>public/image/icon/icon-shipping-by-jne.jpg" class="img-fluid ">
								</a>
								<?php if ($totalweight<=20): ?>
								<a href="<?php echo base_url() ?>cart/shipping_gojek" class="col-md-3 col-xs-6">
									<img src="<?php echo base_url() ?>public/image/icon/icon-shipping-by-gojek.jpg" class="img-fluid">
								</a>
								<?php endif ?>

								<a href="<?php echo base_url() ?>cart/shipping_gobox" class="col-md-3 col-xs-6">
									<img src="<?php echo base_url() ?>public/image/icon/icon-shipping-by-gobox.jpg" class="img-fluid ">
								</a>
								<a href="#" class="col-md-3 col-xs-6">
									<img src="<?php echo base_url() ?>public/image/icon/icon-shipping-by-tru.jpg" class="img-fluid triger_show_from_truely">
								</a>
								<div class="clearfix"></div>
								<div class="collapse col-md-12" id="collapseJNE">
								  <div class="alert alert-info">
								  	untuk sementara pengiriman menggunakan JNE belum dapat di gunakan
								  </div>
								</div>
								<div class="clearfix"></div>
						</div>

						<div class="show_after_click_truely hidden-xl-down">
							<!-- <input type="text" class="hidden-xl-down" name="method" value="trumecs" required>			    			
							<h2 class="f22 fbold">Lengkapi Informasi Pengiriman</h2>
							Nama<sup>*</sup>
							<input type="text" class="form-control" name="name" value="<?php echo $sessionmember["name"]; ?>" required>
							Nama Perusahaan
							<input type="text" class="form-control" name="company" value="<?php echo $sessionmember["Company"]; ?>">
							Nomor Telepon<sup>*</sup>
							<input type="text" class="form-control" name="phone" value="<?php echo $sessionmember["phone"]; ?>" required>
							Kota<sup>*</sup>
							<select class="form-control select-city" name="shipping_city" required>
							</select>
							Alamat lengkap<sup>*</sup>
							<input type="text" class="form-control" name="shipping_address" value="<?php echo $sessionmember["shipping_address"]; ?>" required>
							Kodepos<sup>*</sup>
							<input type="text" class="form-control" name="shipping_kodepos" value="<?php echo $sessionmember["shipping_kodepos"]; ?>" required>
							<br>
							<small class="f12 fbold">
								<i>*Estimasi pengiriman 1 s/d 3 hari (paling lama), setelah pembayaran diterima.</i><br>
								<i>*Biaya sebesar Rp. 9,500,-/Kg dari total berat seluruh barang yang dipesanan.</i><br>
								<i>*Gratis Pengiriman untuk pembelian lebih dari Rp. 10,000,000,- .</i><br>
							</small>
							<button type="submit" class="btn btn-orange">Lanjut ke proses selanjutnya</button> -->
							<?php $this->load->view("_shipping_page_form_trumecs") ?>
						</div>
				
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card text-center p-y-1">
			<div class="">
				<img src="<?php echo base_url() ?>public/image/shipping-pickup.png" >
				<h2 class="f22 fbold">Pick Up</h2>
				<span class="f12 fbold">Anda bisa mengambil barang yang Anda pesan di toko Kami<br>
					Alamat toko akan ditampilkan setelah Anda memilih metode ini.<br>
					Tidak ada biaya tambahan untuk metode ini.
				</span><br>
				<hr class="">
				<form  action="<?php echo base_url() ?>cart/setshipping" method="POST">
					<div class="hidden-xl-down">
						<input type="text"  name="method" value="pickup" required>			    			
						<h2 class="f22 fbold">Lengkapi Informasi Pengiriman</h2>
						Nama<sup>*</sup>
						<input type="text" class="form-control" name="name" value="<?php echo $sessionmember["name"]; ?>" required>
						Nama Perusahaan
						<input type="text" class="form-control" name="company" value="<?php echo $sessionmember["Company"]; ?>">
						Nomor Telepon<sup>*</sup>
						<input type="text" class="form-control" name="phone" value="<?php echo $sessionmember["phone"]; ?>" required>
					</div>	
					<button type="submit" class="btn btn-orange">Pilih</button>
				</form>
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
