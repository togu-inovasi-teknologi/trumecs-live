
<div class="card form-filter-search " seletedbrand="<?php echo isset($idbrand) ? $idbrand : "" ; ?>" seletedtype="<?php echo  isset($idtype) ? $idtype : "" ; ?>" seletedcomponent="<?php echo isset($idcomponent) ? $idcomponent : "" ;  ?>">
	<form method="GET" action="<?php echo base_url() ?>cari">
		<div class="col-md-12">
			<h4 class="f14 m-y-1 fbold">Cari Sparepart</h4>
		</div>
		<div class="col-md-12">
			<small><i>Nama / Partnumber</i></small>
			<input name="nama" placeholder="Nama / Partnumber" type="text" class="form-control" value="<?php echo  (!empty($querysearch)) ? $querysearch : "" ;; ?>">
		</div>
		<div class="col-md-12">
			<small><i>Merek</i></small>
			<select name="merek" class="form-control">
				<option value="">-Merek-</option>
			</select>
		</div>
		<div class="col-md-12">
			<small><i>Tipe</i></small>
			<select name="tipe" class="form-control">
				<option value="">-Tipe-</option>
			</select>
		</div>
		<div class="col-md-12">
			<small><i>Komponen</i></small>
			<select name="komponen" class="form-control">
				<option value="">-Komponen-</option>
			</select>
		</div>
		<div class="col-md-12 m-b-1">
			<small><i>Cari</i></small>
			<button class="btn btn-orange col-md-12"><i class="fa fa-search"></i> Cari</button>
		</div>
	</form>
	<div class="clearfix"></div>
</div>