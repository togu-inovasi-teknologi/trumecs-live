<div class=" <?php echo (!$this->agent->is_mobile()) ? "card" : "m-b-1 row m-t-0 areamobilefilter" ; ?> form-filter-search " seletedbrand="<?php echo isset($idbrand) ? $idbrand : "" ; ?>" seletedtype="<?php echo  isset($idtype) ? $idtype : "" ; ?>" seletedcomponent="<?php echo isset($idcomponent) ? $idcomponent : "" ;  ?>">
	<form method="GET" action="<?php echo base_url() ?>backendproduct/listall?">
		<?php if (!$this->agent->is_mobile()): ?>
		<div class="col-md-12">
			<h4 class="f14 m-y-1 fbold">Cari Sparepart</h4>
		</div>
		<div class="col-md-3">
			<small><i>Nama / Partnumber</i></small>
			<input name="nama" placeholder="Nama / Partnumber" type="text" class="form-control" value="<?php echo  (!empty($querysearch)) ? $querysearch : "" ;; ?>">
		</div>
		<div class="col-md-3">
			<small><i>Merek</i></small>
			<select name="merek" class="form-control">
				<option value="">-Merek Truk-</option>
			</select>
		</div>
		<div class="col-md-3">
			<small><i>Tipe</i></small>
			<select name="tipe" class="form-control">
				<option value="">-Tipe Truk-</option>
			</select>
		</div>
		<div class="col-md-3">
			<small><i>Komponen</i></small>
			<select name="komponen" class="form-control">
				<option value="">-Komponen Truk-</option>
			</select>
		</div>
		<div class="col-md-12"></div>
		<div class="col-md-3">
			<small><i>Tampilkan data</i></small>
			<select name="status" class="form-control">
				<option value="">-Valid&Tidak Valid-</option>
				<option value="show">Valid</option>
				<option value="draf">Tidak Valid</option>
			</select>
		</div>
		<div class="col-md-12 m-b-1">
			<hr>
			<button class="btn btn-primary "><i class="fa fa-search f22"></i> Ok</button>
		</div>
		<?php else: ?>
		<div class="" style="">
			<input name="nama" placeholder="Nama / Partnumber" type="hidden" class="form-control" value="<?php echo  (!empty($querysearch)) ? $querysearch : "" ;; ?>">
			<div class="col-xs-3 m-a-0 p-a-0">
				<select name="merek" class="form-control mobileformfilter" >
					<option value="">-Merek Truk-</option>
				</select>
			</div>
			<div class="col-xs-3 m-a-0 p-a-0">
				<select name="tipe" class="form-control mobileformfilter" >
					<option value="">-Tipe Truk-</option>
				</select>
			</div>
			<div class="col-xs-3 m-a-0 p-a-0">
				<select name="komponen" class="form-control mobileformfilter" >
					<option value="">-Komponen Truk-</option>
				</select>
			</div>
			<div class="col-xs-3 m-a-0 p-a-0">
				<button class="form-control btnmobileformfilter " ><i class="fa fa-search"></i> Oke</button>
			</div>
		</div>
		<?php endif ?>
	</form>
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
