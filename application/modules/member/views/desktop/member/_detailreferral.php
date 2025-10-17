<?php #var_dump($datadetail) 
?>

<style type="text/css">
	@page {
		margin: 20px;
	}

	body {
		margin: 20px;
	}

	.container {

		border: 0px solid #ECECEC;
	}

	.img-logo {
		width: 200px;
	}

	table {
		border-spacing: 0;
		border-collapse: collapse;
	}

	td,
	th {
		padding: 0;
	}

	table.infopemesan td {
		border-top: 1px solid transparent !important;

	}

	.table thead th {
		border-bottom: 1px !important;
	}

	.table-bordered th,
	.table-bordered td {
		border: 1px solid #373A3C !important;
	}

	.row {
		margin-right: -.9375rem;
		margin-left: -.9375rem;
	}

	.row::after {
		display: table;
		clear: both;
		content: "";
	}

	.col-xs-1,
	.col-xs-2,
	.col-xs-3,
	.col-xs-4,
	.col-xs-5,
	.col-xs-6,
	.col-xs-7,
	.col-xs-8,
	.col-xs-9,
	.col-xs-10,
	.col-xs-11,
	.col-xs-12,
	.col-sm-1,
	.col-sm-2,
	.col-sm-3,
	.col-sm-4,
	.col-sm-5,
	.col-sm-6,
	.col-sm-7,
	.col-sm-8,
	.col-sm-9,
	.col-sm-10,
	.col-sm-11,
	.col-sm-12,
	.col-md-1,
	.col-md-2,
	.col-md-3,
	.col-md-4,
	.col-md-5,
	.col-md-6,
	.col-md-7,
	.col-md-8,
	.col-md-9,
	.col-md-10,
	.col-md-11,
	.col-md-12,
	.col-lg-1,
	.col-lg-2,
	.col-lg-3,
	.col-lg-4,
	.col-lg-5,
	.col-lg-6,
	.col-lg-7,
	.col-lg-8,
	.col-lg-9,
	.col-lg-10,
	.col-lg-11,
	.col-lg-12,
	.col-xl-1,
	.col-xl-2,
	.col-xl-3,
	.col-xl-4,
	.col-xl-5,
	.col-xl-6,
	.col-xl-7,
	.col-xl-8,
	.col-xl-9,
	.col-xl-10,
	.col-xl-11,
	.col-xl-12 {
		position: relative;
		display: inline-block;
		min-height: 1px;
		padding-right: .9375rem;
		padding-left: .9375rem;
	}

	.col-xs-1,
	.col-xs-2,
	.col-xs-3,
	.col-xs-4,
	.col-xs-5,
	.col-xs-6,
	.col-xs-7,
	.col-xs-8,
	.col-xs-9,
	.col-xs-10,
	.col-xs-11,
	.col-xs-12 {
		float: left;
	}

	.col-xs-1 {
		width: 8.333333%;
	}

	.col-xs-2 {
		width: 16.666667%;
	}

	.col-xs-3 {
		width: 25%;
	}

	.col-xs-4 {
		width: 33.333333%;
	}

	.col-xs-5 {
		width: 41.666667%;
	}

	.col-xs-6 {
		width: 50%;
	}

	.col-xs-7 {
		width: 58.333333%;
	}

	.col-xs-8 {
		width: 66.666667%;
	}

	.col-xs-9 {
		width: 75%;
	}

	.col-xs-10 {
		width: 83.333333%;
	}

	.col-xs-11 {
		width: 91.666667%;
	}

	.col-xs-12 {
		width: 100%;
	}

	h1,
	h2,
	h3,
	h4,
	strong,
	table {
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		padding-top: 10px;
		padding-bottom: 0px;
		margin: 0px;
	}

	.fsmall {
		font-size: 0.75rem !important;
	}

	.text-right {
		text-align: right;
	}

	.text-center {
		text-align: center;
	}
</style>
<?php $this->load->view("member/_invoicecss"); ?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-4">
				<img class="img-logo" src="<?php echo base_url() ?>public/image/logonew.png">
			</div>
			<div class="col-xs-2">
			</div>
			<div class="col-xs-6">
				<strong>BUKTI PEMBELIAN(RECEIPT)</strong>
				<div class="fsmall">
					Nomor : #<?php echo $datadetail["iduniq"] ?><br>
					Tanggal : <?php echo $datadetail["time"] ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<strong>DATA PEMESANAN</strong>
						<table class="fsmall table infopemesan table-sm">
							<tbody>
								<tr>
									<td>Nama</td>
									<td>: <?php echo $datadetail["billing_name"] ?></td>
								</tr>
								<tr>
									<td>No. Telpon</td>
									<td>: <?php echo $datadetail["billing_phone"] ?></td>
								</tr>
								<tr>
									<td width="70px">Alamat</td>
									<td>: <?php echo $datadetail["billing_address"] ?>,<?php echo $datadetail["billing_city"] ?>,<?php echo $datadetail["billing_province"] ?>-<?php echo $datadetail["billing_kodepos"] ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<strong>DETAIL PEMBAYARAN</strong>
				<table class="table table-bordered table-sm fsmall">
					<thead>
						<tr>
							<th>ID ORDER</th>
							<th>PEMBAYARAN MELALUI</th>
							<th>DETAIL TRANSAKSI</th>
							<th>TERMS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $datadetail["iduniq"] ?></td>
							<td>Transfer</td>
							<td>Lunas</td>
							<td>Due on receipt</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<strong>DETAIL PEMBELIAN</strong>
				<table class="table table-bordered table-sm fsmall">
					<thead>
						<tr>
							<th width="10px">No.</th>
							<th>Produk</th>
							<th>Keterangan</th>
							<th width="30px">Jml.</th>
							<th width="100px">Harga Satuan</th>
							<th>Total Rp</th>
						</tr>
					</thead>
					<tbody>
						<?php $harga = 0;
						$totalbayar = 0;
						$nomor = 1; ?>
						<?php foreach ($datadetail["listdetailorder"] as $lkey) : ?>
							<tr>
								<td><?php echo $nomor ?></td>
								<td><?php echo  $lkey["name_product"] ?> - [<?php echo  $lkey["partnumber_product"] ?>]</td>
								<td><?php echo  $lkey["unit"] ?> <?php echo  $lkey["warranty"] ?></td>
								<td class="text-right"><?php echo  $lkey["quantity"] ?></td>
								<td class="text-right"><?php echo  number_format($lkey["price"]) ?></td>
								<?php $harga = $lkey["price"] * $lkey["quantity"]; ?>
								<td class="text-right"><?php echo  number_format($harga) ?></td>
							</tr>
							<?php $nomor++ ?>
							<?php $totalbayar = $totalbayar + $harga; ?>
						<?php endforeach ?>
						<tr>
							<td><?php echo $nomor ?></td>
							<td>Pengiriman - <?php echo $datadetail["shipping_description"] ?></td>
							<td width="300px">Alamat : <?php echo $datadetail["shipping_address"] ?>,<?php echo $datadetail["shipping_city"] ?>,<?php echo $datadetail["shipping_province"] ?>-<?php echo $datadetail["shipping_kodepos"] ?></td>
							<td></td>
							<td class="text-right"></td>
							<td class="text-right"><?php echo number_format($datadetail["shipping_cost"]) ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td style="border: 1px solid transparent !important;"></td>
							<td style="border: 1px solid transparent !important;"></td>
							<td style="border: 1px solid transparent !important;"></td>
							<td style="border-bottom: 1px solid transparent !important;"></td>
							<td class="text-right"><strong>Total Pembayaran</strong></td>
							<td class="text-right"><?php echo number_format($totalbayar + $datadetail["shipping_cost"]) ?></td>
						</tr>
					</tfoot>

				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center fsmall">
				Jika Anda memiliki pertanyaan, silahkan hubungi kami via<br>
				email ke: info@trumecs.com atau telepon ke (021)-8849-319
			</div>
		</div>
	</div>
</body>