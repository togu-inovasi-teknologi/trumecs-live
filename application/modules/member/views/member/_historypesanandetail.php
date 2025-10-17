<?php foreach ($datadetail as $key) {
	# code...
}
?>
<div class="row historypesanan">
	<div class="col-md-12">
		<strong class="f22">Detail Pesanan</strong>
		<hr>
	</div>
	<div class="col-md-5 f18">
		<table>
			<tbody>
				<tr>
					<td><strong class="f18">ID ORDER</strong></td>
					<td> : </td>
					<td><strong class="f18"><?php echo $key["iduniq"] ?></strong></td>
				</tr>
				<tr>
					<td><strong class="f18">STATUS</strong></td>
					<td> : </td>
					<td><strong class="f18"><?php echo strtoupper($key["status"]) ?></strong></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5 f14">
		<table>
			<tbody>
				<tr>
					<td><strong class="f14">Tanggal Order</strong></td>
					<td> : </td>
					<td><strong class="f14"><?php echo $key["time"] ?></strong></td>
				</tr>
				<tr>
					<td><strong class="f14">Tanggal Expired</strong></td>
					<td> : </td>
					<td><strong class="f14"><?php echo ($key["expired"]) ?></strong></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="col-md-5 alert alert-warning text-center m-y-1">
			<strong>Tagihan Pembayaran</strong><br>
			<table class="table text-left info_billingshipping">
				<tbody class=" table-chart-detail ">
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><?php echo $key["shipping_name"] ?></td>
					</tr>
					<tr>
						<td>Perusahaan</td>
						<td>:</td>
						<td><?php echo $key["shipping_company"] ?></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td><?php echo $key["shipping_phone"] ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo $key["shipping_address"] ?>, <?php echo $key["shipping_city"] ?> - <?php echo $key["shipping_kodepos"] ?></td>
					</tr>
					<tr>
						<td>Pengiriman</td>
						<td>:</td>
						<td><?php echo strtoupper($key["shipping_description"]) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-2 "></div>
		<div class="m-y-1 col-md-5 alert alert-warning text-center">
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
				<strong>Pengiriman</strong><br>
				<table class="table text-left info_billingshipping">
					<tbody class=" table-chart-detail ">
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td><?php echo $key["shipping_name"] ?></td>
						</tr>
						<tr>
							<td>Perusahaan</td>
							<td>:</td>
							<td><?php echo $key["shipping_company"] ?></td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td>:</td>
							<td><?php echo $key["shipping_phone"] ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><?php echo $key["shipping_address"] ?>, <?php echo $key["shipping_city"] ?> - <?php echo $key["shipping_kodepos"] ?></td>
						</tr>
						<tr>
							<td>Pengiriman</td>
							<td>:</td>
							<td><?php echo strtoupper($key["shipping_description"]) ?></td>
						</tr>
					</tbody>
				</table>
			<?php endif ?>
		</div>
	</div>

	<div class="col-md-12 table-responsive">
		<strong>Daftar Pesanan</strong>
		<!-- 	   <ul class="nav nav-tabs " id="tabtabel" role="tablist">
	      <li class="nav-item active">
	         <a class="nav-link " data-toggle="tab" href="#all" role="tab">SEMUA</a>
	      </li>
	      <li class="nav-item">
	         <a class="nav-link" data-toggle="tab" href="#ppn" role="tab">HARGA PPN</a>
	      </li>
	      <li class="nav-item">
	         <a class="nav-link" data-toggle="tab" href="#nonppn" role="tab">HARGA NON PPN</a>
	      </li>
	   </ul> -->
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="all" role="tabpanel">

				<table class="table text-left ">
					<?php echo ($this->session->flashdata('message') == "") ? "" :
						'<div class="alert alert-warning alert-dismissible" role="alert">
	               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
						$this->session->flashdata('message') .
						'</div>'; ?>
					<thead>
						<tr>
							<th><strong>Nama produk</strong></th>
							<th><strong>Jumlah</strong></th>
							<th><strong>Harga Satuan</strong></th>
							<th><strong>Harga Total</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = 0;
						$totalw = 0;
						$totalweight = 0;
						$quantity = 0;
						$totaldimensi = 0;
						$form = 1;
						?>
						<?php foreach ($datadetail as $key) : ?>
							<tr>
								<td>
									<?php echo ucwords($key["name_product"]) ?>
									[ <?php echo $key["partnumber_product"] ?> ] <?php echo $key["warranty"] != NULL ? "<br>- Gransi : " . $key["warranty"] : ""; ?>
								</td>
								<td>
									<?php echo $key["quantity"] ?>
								</td>
								<td>Rp. <?php echo number_format($key["price"]); ?></td>
								<td>Rp. <?php $totalprice = $key["price"] * $key["quantity"];
										$total = $total + $totalprice;
										echo number_format($totalprice); ?>
								</td>
							</tr>
							<?php
							$totalpxyz = $key["px"] * $key["py"] * $key["pz"];
							$totaldimensi = $totaldimensi + $totalpxyz;
							$quantity = $quantity + $key["quantity"];
							$totalw = $key["quantity"] * $key["weight"];
							$totalweight = $totalweight + $totalw;
							?>
						<?php endforeach ?>
						<?php if ($key["shipping_cost"] != 0) : ?>
							<tr>
								<td>Pengiriman - <?php echo $key["shipping_description"] ?></td>
								<td></td>
								<td></td>
								<td>Rp.<?php echo number_format($key["shipping_cost"]) ?></td>
							</tr>
						<?php endif ?>
						<tr>
							<td></td>
							<td></td>
							<td><strong>Total Bayar</strong></td>
							<td>Rp. <?php echo number_format($total + $key["shipping_cost"]) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="ppn" role="tabpanel">
				<?php $this->load->view("member/ppn/_billingtabelppn") ?>
			</div>
			<div class="tab-pane" id="nonppn" role="tabpanel">
				<?php $this->load->view("member/ppn/_billingtabelnonppn") ?>
			</div>
		</div>
		<small>
			*) Pengiriman di lakukan 1 hari(hari kerja) setelah proses pembayaran dilakukan.<br>
			*) Jika Anda tidak mendapatkan Nomor Resi Pengiriman melalui email setelah 1 hari(hari kerja) setelah proses pembayaran dilakukan, segera Hubungi Kami.
		</small>
	</div>
	<div class="col-md-12">
		<?php if ($key["status"] == "unpaid" or $key["status"] == "cencel") : ?>
			<div class="col-md-4"><a href="<?php echo base_url() ?>member/confirmation" class="btn btn-orange">Konfirmasi Pembayaran</a></div>
		<?php else : ?>
			<div class="col-md-2"><a href="<?php echo base_url() ?>member/invoice/<?php echo $key["iduniq"] ?>" class="btn btn-orange">Print Bukti Pembelian</a></div>
			<!-- <div class="col-md-4"><a href="" class="btn btn-orange col-md-12">Print Invoice PPN</a></div>
			<div class="col-md-4"><a href="" class="btn btn-orange col-md-12">Print Invoice NON PPN</a></div> -->
		<?php endif ?>
	</div>
	<div class="col-md-12 m-y-1">
		<div class="alert alert-warning " role="alert">
			<?php if ($key["comment"] == "") : ?>
				Belum ada komentar dari admininistrasi Trumecs.com
			<?php else : ?>
				<?php echo $key["comment"] ?>
			<?php endif ?>

		</div>
	</div>
</div>