<?php 
$member =$detail["member"];

if (empty($detail["order"])) {
	$order = NULL ;
}else{
	$order = $detail["order"] ;
}

 ?>
<div class="detail row">
	<div class="col-md-12">
		<strong class="f22">Detail Member : <?php echo ($member["name"]) ?></strong>
		<hr>
	</div>



	<div class="col-md-12"><strong>Detail Member</strong></div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<table class="">
				<tbody>
					<tr>
						<td>Nama</td>
						<td>: <?php echo ($member["name"]) ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>: <?php echo ($member["email"]) ?></td>
					</tr>
					<tr>
						<td>Telphone</td>
						<td>: <?php echo ($member["phone"]) ?></td>
					</tr>
					<tr>
						<td>Perusahaan</td>
						<td>: <?php echo ($member["Company"]) ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo ($member["address"]) ?>, <?php echo ($member["districts"]) ?>, <?php echo ($member["city"]) ?>, <?php echo ($member["provice"]) ?>-<?php echo ($member["kodepos"]) ?> </td>
					</tr>

					<!--tr>
						<td>Alamat Pengiriman</td>
						<td>: <?php echo ($member["shipping_address"]) ?>, <?php echo ($member["shipping_city"]) ?>, <?php echo ($member["shipping_province"]) ?>-<?php echo ($member["shipping_kodepos"]) ?> </td>
					</tr>
					<tr>
						<td>Metode Pengiriman</td>
						<td>: <?php echo ($member["shipping_method"]) ?></td>
					</tr-->

					<tr>
						<td>Status</td>
						<td>: <?php echo ($member["status"]) ?></td>
					</tr>
					<tr>
						<td>Level</td>
						<td>: <?php echo ($member["level"]) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<?php 
	$totalpaidall=0;
	$totalpaidthismonth=0;
	if (!empty($order)) {
		foreach ($order as $xx ) {
			if ($xx["status"]!="unpaid" AND $xx["status"]!="cencel") {
				$totalpaidall = $totalpaidall +$xx["totalshipping"];
				$filterdeh = preg_replace("/[-\/]/", "", substr($xx["time"], 3,7));
				if (date("mY")==$filterdeh ) {
					$totalpaidthismonth = $totalpaidthismonth +$xx["totalshipping"];
				}
			}
		}
	}
	?>

	<div class="col-md-6">
		<div class="alert btn btn-primary col-md-12 text-right">
			<h2 class="f42">Rp.<?php
			if (!empty($order)) {
			 echo number_format($totalpaidall);
			 }else{echo "0";} ?></h2>
			<span>Total semua pembelian</span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert btn btn-primary col-md-12 text-right">
			<h2 class="f42">Rp.<?php
			if (!empty($order)) {
			echo number_format($totalpaidthismonth);}else{echo "0";} ?></h2>
			<span>Total pembelian bulan ini</span>
		</div>
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-12">
		<div class="card">
			<div class="col-md-12 m-y-1">
				<strong>Aksi Admin</strong>
				<hr>
				<a href="<?php echo base_url() ?>backendmember/updateactivation?id=<?php echo ($member["id"]) ?>&status=<?php echo ($member["status"]=="active") ? "unactive" : "active" ; ?>" class="btn btn-<?php echo ($member["status"]=="active") ? "danger" : "success" ; ?>"><?php echo ($member["status"]=="active") ? "Nonaktifkan" : "Aktifkan" ; ?> Member</a>
				<a href=".modal" class="btn btn-orange">Edit Data Member</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-12">
		<strong>List Order</strong>
		<table class="table" id="tablelist">
			<thead>
				<tr>
					<th>ID Order</th>
					<th>Tanggal</th>
					<th>Total Pembayaran</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $totalpaid=0; ?>
				<?php if (!empty($order)) { ?>
				<?php foreach ($order as $key ): ?>
				<tr>
					<td><a target="_blank" class="fbold forange" href="<?php echo base_url() ?>backendorder/detail/<?php echo $key["iduniq"] ?>"><?php echo $key["iduniq"] ?></a></td>
					<td><?php echo $key["time"] ?></td>
					<td>Rp.<?php echo number_format($key["totalshipping"]) ?> </td>
					<td><span class="label label-<?php echo ($key["status"]!="unpaid") ? "success" : "danger" ; ?>"><?php echo $key["status"] ?></span></td>
				</tr>
				<?php 
				if ($key["status"]!="unpaid" AND $key["status"]!="cencel") {
					$totalpaid = $totalpaid +$key["totalshipping"];
				}
				 ?>
				<?php endforeach ?>
				<?php }else{echo "Tidak ada pesanan";} ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-12">
		<div class="alert alert-warning">
			<strong>Member ini telah melakukan transaksi sebesar Rp.<?php echo number_format($totalpaid) ?></strong>
		</div>
	</div>


</div>