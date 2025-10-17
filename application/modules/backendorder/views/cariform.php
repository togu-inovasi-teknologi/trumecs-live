<div class=" <?php echo (!$this->agent->is_mobile()) ? "card" : "card" ; ?> form-filter-search ">
	<form method="GET" action="<?php echo base_url() ?>backendorder/">
		<div class="col-md-12">
			<h4 class="f14 m-y-1 fbold">Cari Pesanan</h4>
		</div>
		<div class="col-md-4">
			<input name="idorder" placeholder="Id Order" type="text" class="form-control" value="<?php echo  (!empty($querysearch)) ? $querysearch : "" ;; ?>">
		</div>
		<div class="col-md-4">
			<select name="status" class="form-control">
				<option value="all">Semua Pesanan</option>
				<option value="unpaid">Pesanan Baru</option>
				<option value="paid">Pesanan Terbayar</option>
				<option value="process">Pesanan Di Proses</option>
				<option value="delivery">Pesanan Di Kirim</option>
				<option value="complate">Pesanan Selesai</option>
				<option value="cencel">Pesanan Batal</option>
				<option value="challenge">Pesanan Bermasalah</option>
			</select>
		</div>
		<div class="col-md-4">
			<button class="btn btn-orange col-md-12"><i class="fa fa-search"></i> Cari</button>
		</div>
	</form>
	<div class="col-md-12 m-a-1"></div>
	<div class="clearfix"></div>
</div>

<style type="text/css">
.mobileformfilter{
	border-radius:0rem;
	border:1px solid gainsboro;
	background-color: gainsboro;
	padding-top:4px; 
	padding-bottom:4px;
}
.btnmobileformfilter{
	border-radius:0rem;
	border:1px solid gainsboro;
	background-color: gainsboro;
	padding-top:2px; 
	padding-bottom:2px; 
}
.areamobilefilter{
	background-color: gainsboro;
}


</style>