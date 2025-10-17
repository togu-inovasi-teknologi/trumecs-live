<?php 

	$confirmation= $detailconfirm["confirmation"];
	$detail= $detailconfirm["order"];
	$detailmember= $detailconfirm["detailmember"];


 ?>
<div class="detail row">
	<div class="col-md-12">
		<strong class="f22">Detail Konfirmasi #<?php echo ($detail["iduniq"]) ?></strong>
		<hr>
	</div>
	<div class="col-md-12"><strong>Detail Order</strong></div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<table>
				<tbody>
					<tr>
						<td>Id Order </td>
						<td>: <?php echo ($detail["iduniq"]) ?></td>
					</tr>
					<tr>
						<td>Tanggal </td>
						<td>: <?php echo ($detail["time"]) ?></td>
					</tr>
					<tr>
						<td>Tanggal Jatuh Tempo</td>
						<td>: <?php echo ($detail["expired"]) ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>: <?php echo ($detail["status"]) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<table>
				<tbody>
					<tr>
						<td>Nama Pemesan</td>
						<td>: 
							<a style="color:#8a6d3b;font-weight:bolder" href="<?php echo base_url() ?>backendmember/detail/<?php echo ($detailmember["id"]) ?>">
							<?php echo ($detailmember["name"]) ?>
							</a>
						</td>
					</tr>
					<tr>
						<td>Email </td>
						<td>: <?php echo ($detailmember["email"]) ?></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>: <?php echo ($detailmember["phone"]) ?></td>
					</tr>
					<tr>
						<td>Level</td>
						<td>: <?php echo ($detailmember["level"]) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12 text-right"><span class="btn btn-orange" data-toggle="collapse" href="#collapsedetail" aria-expanded="false">Lihat Detail Pesanan</span></div>
	<div class="collapse" id="collapsedetail">
	<div class="col-md-6">
		<div class="alert alert-warning">
			<strong>Penagihan</strong>

			<table>
				<tbody>
					<tr>
						<td>Nama</td>
						<td>: <?php echo ($detail["billing_name"]) ?></td>
					</tr>
					<tr>
						<td>Perusahaan </td>
						<td>: <?php echo ($detail["billing_company"]) ?></td>
					</tr>
					<tr>
						<td>No Telepon</td>
						<td>: <?php echo ($detail["billing_phone"]) ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo ($detail["billing_address"]).",".($detail["billing_city"]).",".($detail["billing_province"])."-".($detail["billing_kodepos"]) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<strong>Pengiriman</strong>
			<table>
				<tbody>
					<tr>
						<td>Nama</td>
						<td>: <?php echo ($detail["shipping_name"]) ?></td>
					</tr>
					<tr>
						<td>Perusahaan </td>
						<td>: <?php echo ($detail["shipping_company"]) ?></td>
					</tr>
					<tr>
						<td>No Telepon</td>
						<td>: <?php echo ($detail["shipping_phone"]) ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: 
							<?php if (($detail["shipping_description"])=="pickup"): ?>
								<strong><?php echo strtoupper($detail["shipping_description"]) ?></strong>
							<?php else: ?>
							<strong><?php echo ($detail["shipping_description"]) ?></strong><br>
							<?php echo ($detail["shipping_address"]).",".($detail["shipping_city"]).",".($detail["shipping_province"])."-".($detail["shipping_kodepos"]) ?>
							<?php endif ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-12">
		<strong>List Pesanan #<?php echo ($detail["iduniq"]) ?></strong>
		<table class="table table">
			<thead>
				<tr>
					<th>Produk <br><small>Partnumber</small></th>
					<th>Jumlah</th>
					<th>Berat</th>
					<th>Harga</th>
					<th>Harga Total</th>
					<th>Warranty</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$weight=0;
				$weighttotal=0; 
				$price=0;
				$pricetotal=0; 
				$costdelivery= $detail["shipping_cost"] ?>
				<?php foreach ($detail["listdetail"] as $key): ?>
				<tr>
					<td><?php echo $key["name_product"] ?>
						<br><small><?php echo $key["partnumber_product"] ?></small>
					</td>
					<td><?php echo $key["quantity"] ?></td>
					<td>
						<?php $weight=$key["quantity"]*$key["weight"] ?>
						<?php echo  $weight ?> <small>kg</small>
					</td>
					<td>Rp. <?php echo number_format($key["price"]) ?>/<small><?php echo ($key["unit"]) ?></small></td>
						<?php $price = $key["quantity"]*$key["price"] ?>
					<td>Rp. <?php echo number_format($price) ?></small></td>
					<td>
						<?php echo $key["warranty"] ?>
					</td>
						<?php $weighttotal=$weighttotal+$weight ?>
						<?php $pricetotal=$pricetotal+$price ?>
				</tr>
				<?php endforeach ?>
				<?php if (($detail["shipping_description"])!="pickup"): ?>
				<tr>
					<td>Layanan <?php echo ($detail["shipping_description"]) ?></td>
					<td></td>
					<td><?php echo $weighttotal ?> <small>kg</small></td>
					<td></td>
					<td>Rp <?php echo number_format($costdelivery, 0, ',','.') ?></td>
					<td></td>
				</tr>
				<?php endif ?>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>Total Pembayaran</td>
						<td><strong>Rp. <?php echo number_format($pricetotal+$costdelivery) ?></strong></td>
						<td></td>
					</tr>
				</tfoot>
			</tbody>
		</table>
	</div>
	<div class="col-md-12"><hr></div>
	</div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-12">
		<div class="alert alert-danger">
			<?php if (($pricetotal+$costdelivery)>$confirmation["money"] or ($pricetotal+$costdelivery)<$confirmation["money"]): ?>
				<strong>Perhatian !!</strong><br>
				<p>Jumlah Uang yang di Konfirmasi tidak sesuai dengan Jumlah Uang yang seharusnya di bayar<br>
					Mohon untuk meneliti ulang. bila terjadi kejanggalan silahkan Hubungi member yang memesan Pesanan.
				</p>
			<?php endif ?>
		</div>
	</div>

	<div class="col-md-12"><strong>Detail Konfirmasi</strong></div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<table>
				<tbody>
					<tr>
						<td>Id Order </td>
						<td>: <?php echo ($confirmation["idorder"]) ?></td>
					</tr>
					<tr>
						<td>Tanggal </td>
						<td>: <?php echo ($confirmation["date"]) ?></td>
					</tr>
					<tr>
						<td>Tanggal Tranfer</td>
						<td>: <?php echo ($confirmation["datetranfer"]) ?></td>
					</tr>
					<tr>
						<td>Jumlah Tranfer</td>
						<td>: Rp. <?php echo number_format($confirmation["money"]) ?></td>
					</tr>
					<tr>
						<td>Bank / No.Rek</td>
						<td>: <?php echo ($confirmation["bank"]) ?> | <?php echo ($confirmation["norek"]) ?></td>
					</tr>
					<tr>
						<td>Atas Nama</td>
						<td>: <?php echo ($confirmation["name"]) ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>: <?php echo ($confirmation["status"]) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<a target="_blank" href="<?php echo base_url() ?>public/image/member/confirmation/<?php echo ($confirmation["img"]) ?>">
			<?php 
			$file=$confirmation["img"];
			$ext =substr($file, strpos($file, "."),strpos($file, ".")+4);
			
			 ?>
			<?php if ($ext==".png" or $ext==".jpg" or $ext==".PNG" or $ext==".JPG" or $ext==".jpeg"): ?>
				<img class="img-fluid" src="<?php echo base_url() ?>public/image/member/confirmation/<?php echo ($confirmation["img"]) ?>">
			<?php else: ?>
			Liat FILE Konfimasi
			<?php endif ?>
			</a>
		</div>
	</div>

	<div class="col-md-12">
		<div class="alert alert-warning">
			<strong>Catatan Pesanan</strong>
			<p><?php echo $detail["comment"] ?></p>
			<div class="row">
				<form action="<?php echo base_url() ?>backendorder/updateorder" method="POST">
				<div class="col-md-10">
					<input type="hidden" name="id" value="<?php echo $detail["id"] ?>">
					<input type="hidden" name="iduniq" value="<?php echo $detail["iduniq"] ?>">
					<textarea name="comment" class="form-control"><?php echo $detail["comment"] ?></textarea>
					
				</div>
				<div class="col-md-2">
					<button class="btn btn-orange">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="alert alert-warning">
			<strong>Catatan Konfirmasi</strong>
			<p><?php echo $confirmation["comment"] ?></p>
			<div class="row">
				<form action="<?php echo base_url() ?>backendconfirm/updateconfirm" method="POST">
				<div class="col-md-10">
					<input type="hidden" name="id" value="<?php echo $confirmation["id"] ?>">
					<input type="hidden" name="iduniq" value="<?php echo $confirmation["idorder"] ?>">
					<textarea name="comment" class="form-control"><?php echo $confirmation["comment"] ?></textarea>
					
				</div>
				<div class="col-md-2">
					<button class="btn btn-orange">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<?php 
		$nowstatus_is= $confirmation["status"];
		$statusorder = array("approved","rejected");
		 ?>
		 <div class=" card p-a-1">
		 	<div class="">
		 		<strong>Status Konfirmasi</strong><br>
		 	<?php if (!in_array($nowstatus_is, $statusorder)): ?>
		 		<?php foreach ($statusorder as $key): ?>
		 		<div class="col-md-3">
		 		<form action="<?php echo base_url() ?>backendconfirm/updateconfirm" method="POST">
		 			<input type="hidden" name="id" value="<?php echo $confirmation["id"] ?>">
					<input type="hidden" name="iduniq" value="<?php echo $confirmation["idorder"] ?>">
					<input type="hidden" name="email" value="<?php echo ($detailmember["email"]) ?>">
					<input type="hidden" name="membername" value="<?php echo ($detailmember["name"]) ?>">
					<input type="hidden" name="status" value="<?php echo $key ?>">
		 			<button class="btn btn-<?php echo ($key=="approved") ? "success" : "danger" ; ?>"><?php echo $key ?></button>
		 		</form>
		 		</div>
		 		<?php endforeach ?>
		 	<?php endif ?>
		 	<div class="clearfix"></div>
		 	</div>
		</div>
	</div>


</div>