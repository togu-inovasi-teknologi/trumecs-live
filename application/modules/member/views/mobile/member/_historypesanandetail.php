<?php foreach ($datadetail as $key) {
	# code...
}
?>
<div class="row historypesanan">
	<div class="card col-md-12 p-a-1 text-center">
		<strong class="f22">Detail Pesanan</strong>
	</div>
	<hr>
	<div class="card col-md-12 f16 p-a-1 fbold">
		<p class="t-a-r"><?php echo $key["iduniq"] ?></p>
		<p>ID Order: </p>
		<p class="t-a-r"><?php echo strtoupper($key["status"]) ?></p>
		<p>Status:</p>
		<p class="t-a-r"><?php echo $key["time"] ?></p>
		<p>Tanggal Order: </p>
		<p class="t-a-r"><?php echo ($key["expired"]) ?></p>
		<p>Tanggal Expired:</p>
	</div>
	<div class="card col-md-12 f12 p-a-1">
		<div class="text-center">
			<strong class="f22">Tagihan Pembayaran</strong>
		</div>
		<hr>
		<p class="t-a-r"><?php echo $key["shipping_name"] ?></p>
		<p>Nama: </p>
		<p class="t-a-r"><?php echo $key["shipping_company"] ?></p>
		<p>Perusahaan:</p>
		<p class="t-a-r"><?php echo $key["shipping_phone"] ?></p>
		<p>Telepon: </p>
		<p>Alamat:</p>
		<p><?php echo $key["shipping_address"] ?>, <?php echo $key["shipping_city"] ?> - <?php echo $key["shipping_kodepos"] ?></p>
		<p class="t-a-r"><?php echo strtoupper($key["shipping_description"]) ?></p>
		<p>Pengiriman: </p>
		<hr>
		<?php if ($key["shipping_description"] == "pickup") : ?>
			<div class=" text-center">
				<strong>Barang diambil di Market Store Trumecs</strong><br>
				<p>Jl. Jendral Sudirman Km 31, Bekasi<br>Jawa Barat</p>
				<br>
				<small>
					*Wajib membawa bukti invoice pemenasan untuk pengambilan pesanan ini.<br>
					*Waktu pengambilan akan di informasikan setelah Anda melakukan proses Konfirmasi Pembayaran.<br>
				</small>
			</div>
		<?php else : ?>
			<div class="text-center">
				<strong class="f22">Pengiriman</strong>
			</div>
			<hr>
			<p class="t-a-r"><?php echo $key["shipping_name"] ?></p>
			<p>Nama: </p>
			<p class="t-a-r"><?php echo $key["shipping_company"] ?></p>
			<p>Perusahaan:</p>
			<p class="t-a-r"><?php echo $key["shipping_phone"] ?></p>
			<p>Telepon: </p>
			<p>Alamat:</p>
			<p><?php echo $key["shipping_address"] ?>, <?php echo $key["shipping_city"] ?> - <?php echo $key["shipping_kodepos"] ?></p>
			<p class="t-a-r"><?php echo strtoupper($key["shipping_description"]) ?></p>
			<p>Pengiriman: </p>
		<?php endif ?>
	</div>
	<div class="card col-md-12 f12 p-a-1">
		<div class="text-center">
			<strong class="f22">Daftar Pesanan</strong>
		</div>
		<hr>
		<?php
		$total = 0;
		$totalw = 0;
		$totalweight = 0;
		$quantity = 0;
		$totaldimensi = 0;
		$form = 1;
		?>
		<?php foreach ($datadetail as $key) : ?>
			<p>Nama Produk: </p>
			<p><?php echo ucwords($key["name_product"]) ?>
				[ <?php echo $key["partnumber_product"] ?> ] <?php echo $key["warranty"] != NULL ? "<br>- Gransi : " . $key["warranty"] : ""; ?></p>
			<p class="t-a-r"><?php echo $key["quantity"] ?></p>
			<p>Jumlah:</p>
			<p class="t-a-r">Rp. <?php echo number_format($key["price"]); ?></p>
			<p>Harga Satuan: </p>
			<p class="t-a-r">Rp. <?php $totalprice = $key["price"] * $key["quantity"];
									$total = $total + $totalprice;
									echo number_format($totalprice); ?></p>
			<p>Harga Total:</p>
			<hr>
			<?php
			$totalpxyz = $key["px"] * $key["py"] * $key["pz"];
			$totaldimensi = $totaldimensi + $totalpxyz;
			$quantity = $quantity + $key["quantity"];
			$totalw = $key["quantity"] * $key["weight"];
			$totalweight = $totalweight + $totalw;
			?>
		<?php endforeach ?>
		<?php if ($key["shipping_cost"] != 0) : ?>
			<p class="t-a-r">Rp.<?php echo number_format($key["shipping_cost"]) ?></p>
			<p>Pengiriman:</p>
			<p><?php echo $key["shipping_description"] ?></p>
		<?php endif ?>
		<p class="t-a-r f14 fbold">Rp. <?php echo number_format($total + $key["shipping_cost"]) ?></p>
		<p class="f14 fbold">Total Bayar: </p>
		<div class="col-md-12 m-y-1s">
			<div class="alert alert-warning " role="alert">
				<b?>Komentar admin Trumecs :</b><br>
					<?php if ($key["comment"] == "") : ?>
						Belum ada komentar dari admininistrasi Trumecs.com
					<?php else : ?>
						<?php echo $key["comment"] ?>
					<?php endif ?>
			</div>
		</div>
		<?php if ($key["status"] == "unpaid" or $key["status"] == "cencel") : ?>
			<a href="<?php echo base_url() ?>member/confirmation" class="btn btnnew btn-block">Konfirmasi Pembayaran</a>
		<?php else : ?>
			<a href="<?php echo base_url() ?>member/invoice/<?php echo $key["iduniq"] ?>" class="btn btnnew btn-block">Print Bukti Pembelian</a>
			<!-- <div class="col-md-4"><a href="" class="btn btn-orange col-md-12">Print Invoice PPN</a></div>
			<div class="col-md-4"><a href="" class="btn btn-orange col-md-12">Print Invoice NON PPN</a></div> -->
		<?php endif ?>
	</div>
	<div class="col-md-12 alert alert-warning">
		<small>
			*) Pengiriman di lakukan 1 hari(hari kerja) setelah proses pembayaran dilakukan.<br>
			*) Jika Anda tidak mendapatkan Nomor Resi Pengiriman melalui email setelah 1 hari(hari kerja) setelah proses pembayaran dilakukan, segera Hubungi Kami.
		</small>
	</div>
</div>

<style type="text/css">
	.m-y-05 {
		margin-top: 0.5rem;
		margin-bottom: 0.5rem;
	}

	.t-a-l {
		text-align: left;
		float: left;
	}

	.t-a-r {
		text-align: right;
		float: right;
	}
</style>