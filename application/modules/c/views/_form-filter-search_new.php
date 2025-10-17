<div class="card col-lg-12 p-a-1 form-filter-search" seletedbrand="<?php echo isset($idbrand) ? $idbrand : ""; ?>" seletedtype="<?php echo  isset($idtype) ? $idtype : ""; ?>" seletedcomponent="<?php echo isset($idcomponent) ? $idcomponent : "";  ?>" seletedsub="<?php echo isset($idsub) ? $idsub : "";  ?>" seletedquality="<?php echo isset($quality) ? $quality : "";  ?>">
	<form method="GET" action="<?php echo base_url() ?>cari">
		<div class="card-title fbold f22">
			<i class="fa fa-filter"></i> Filter
		</div>
		<div class="card-content">
			<h6 class="m-b-1">Lokasi</h6>
			<form class="f16">
				<input type="checkbox" id="lokasi1" name="lokasi1" value="jabodetabek">
				<label for="lokasi1">Jabodetabek</label><br>
				<input type="checkbox" id="lokasi2" name="lokasi2" value="banten">
				<label for="lokasi2">Banten</label><br>
				<input type="checkbox" id="lokasi3" name="lokasi3" value="jawa-barat">
				<label for="lokasi3">Jawa Barat</label><br>
				<input type="checkbox" id="lokasi4" name="lokasi4" value="jawa-tengah">
				<label for="lokasi4">Jawa Tengah</label><br>
				<input type="checkbox" id="lokasi5" name="lokasi5" value="jawa-timur">
				<label for="lokasi5">Jawa Timur</label>
			</form>
			<div class="row">
				<div class="form-group m-t-1">
					<label class="col-lg-12">Kategori</label>
					<div class="col-lg-12">
						<select name="komponen" class="form-control" seletedcomponent="<?php $idcomponent ?>">
							<option value="">-- Pilih Kategori --</option>
							<?php foreach ($category->result() as $item) : ?>
								<option value="<?php echo $item->id ?>" <?php echo $idcomponent == $item->id ? 'selected="selected"' : "" ?>><?php echo $item->name ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-12 m-t-1">Sub Kategori</label>
					<div class="col-lg-12">
						<select name="sub_kategori" class="form-control" seletedcomponent="<?php $idcomponent ?>">
							<option value="">-- Semua Sub Kategori --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-12 m-t-1"><?php echo $this->lang->line('label_merk', FALSE); ?></label>
					<div class="col-lg-12">
						<select name="merek" class="form-control" seletedcomponent="<?php $idcomponent ?>">
							<option value="">-- Semua Merk --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-12 m-t-1"><?php echo $this->lang->line('label_grade', FALSE); ?></label>
					<div class="col-lg-12">
						<select name="quality" class="form-control" seletedcomponent="<?php $idcomponent ?>">
							<option value="">-- Semua Grade --</option>
							<option value="1">Asli</option>
							<option value="2">Replika</option>
							<option value="3">Bekas/Copotan</option>
						</select>
					</div>
				</div>
			</div>
			<h6 class="m-b-1 m-t-2">Harga</h6>
			<div class="row">
				<div class="col-lg-12">
					<label for="hargamin">Min</label>
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input class="form-control format-uang" type="text" id="hargamin" name="hargamin" style="width: 100%;" placeholder="0">
					</div>
				</div>
				<div class="col-lg-12">
					<label for="hargamax">Max</label>
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input class="form-control" type="text" id="hargamax" name="hargamax" style="width: 100%;" placeholder="40.000.000">
					</div>
				</div>
				<div class="col-lg-12 m-t-1">
					<button class="btn btnnew apply-filter"><?php echo $this->lang->line('tombol_terapkan', FALSE); ?></button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="card col-lg-12 p-a-1">
	<div class="card-title f16">
		Program Promo
	</div>
	<div class="card-content">
		<h6 class="m-b-1" style="color:grey;">Flash Sale</h6>
		<h6 class="m-b-1" style="color:grey;">Big Offer and Discount up to 70% off</h6>
		<a href="<?php echo base_url('promo') ?>" class=" forange f14">Lainnya</a>
	</div>
</div>
<style type="text/css">
	.mobileformfilter {
		border-radius: 0rem;
		border: 1px solid gainsboro;
		background-color: gainsboro;
		padding-top: 4px;
		padding-bottom: 4px;
	}

	.btnmobileformfilter {
		border-radius: 0rem;
		border: 1px solid gainsboro;
		background-color: gainsboro;
		padding-top: 2px;
		padding-bottom: 2px;
	}

	.areamobilefilter {
		background-color: gainsboro;
	}
</style>