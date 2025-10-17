<div class=" <?php echo (!$this->agent->is_mobile()) ? "card" : "m-b-1 row m-t-0 areamobilefilter"; ?> form-filter-search " seletedbrand="<?php echo isset($idbrand) ? $idbrand : ""; ?>" seletedtype="<?php echo isset($idtype) ? $idtype : ""; ?>" seletedcomponent="<?php echo isset($idcomponent) ? $idcomponent : "";  ?>" seletedsub="<?php echo isset($idsub) ? $idsub : "";  ?>" seletedquality="<?php echo isset($quality) ? $quality : "";  ?>">
	<form method="GET" action="<?php echo base_url() ?>cari">
		<?php

		// Untuk selain mobile

		if (!$this->agent->is_mobile()) : ?>
			<div class="col-md-12">
				<h4 class="m-y-1"><?php echo $this->lang->line('judul_filter', FALSE); ?></h4>
			</div>
			<!--<div class="col-md-12 ">
			<h4 class="f14  fbold"><a class="forange fbold"  href="<?php echo base_url() ?>caribanyakproduct">Cari banyak produk <i class="fa fa-check-circle forange"></i></a> </h4>
		</div>-->
			<div class="form-group">
				<label class="col-xs-12"><?php echo $this->lang->line('label_kategori', FALSE); ?></label>
				<div class="col-xs-12">
					<select name="komponen" class="form-control" seletedcomponent="<?php $idcomponent ?>">
						<option value="">-- Semua kategori --</option>
						<?php foreach ($category->result() as $item) : ?>
							<option value="<?php echo $item->id ?>" <?php echo $idcomponent == $item->id ? 'selected="selected"' : "" ?>><?php echo $item->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="clearfix"></div>
			</div>
			<!-- <div class="form-group">
				<label class="col-xs-12"><?php echo $this->lang->line('label_kata_kunci', FALSE); ?></label>
				<div class="col-xs-12">
					<input name="nama" placeholder="Nama / Partnumber" type="text" class="form-control" value="<?php echo (!empty($querysearch)) ? $querysearch : ""; ?>">
				</div>
				<div class="clearfix"></div>
			</div> -->
			<div class="form-group">
				<label class="col-xs-12"><?php echo $this->lang->line('label_subkategori', FALSE); ?></label>
				<div class="col-xs-12">
					<select name="sub_kategori" class="form-control" seletedcomponent="<?php $idcomponent ?>">
						<option value="">-- Semua Subkategori --</option>
					</select>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<label class="col-xs-12"><?php echo $this->lang->line('label_merk', FALSE); ?></label>
				<div class="col-xs-12">
					<select name="merek" class="form-control" seletedcomponent="<?php $idcomponent ?>">
						<option value="">-- Semua Merk --</option>
					</select>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<label class="col-xs-12"><?php echo $this->lang->line('label_grade', FALSE); ?></label>
				<div class="col-xs-12">
					<select name="quality" class="form-control" seletedcomponent="<?php $idcomponent ?>">
						<option value="">-- Semua Quality --</option>
						<option value="1">Asli</option>
						<option value="2">Replika</option>
						<option value="3">Bekas/Copotan</option>
					</select>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 m-t-1 m-b-1">
				<button class="btn btnnew btn-block apply-filter"><?php echo $this->lang->line('tombol_terapkan', FALSE); ?></button>
			</div>
		<?php

		// Untuk mobile

		else : ?>
			<div class="" style="position:fixed;bottom:0;z-index:999;text-align:center;width:100%;padding:10px; margin-bottom:50px;">
				<button type="button" data-toggle="modal" data-target="#modal_filter" style="box-shadow:0 0px 15px rgba(0,0,0,.2);" class="btn btnnew"><span class="fa fa-filter"></span> Filter Pencarian</button>
			</div>
			<div class="modal filter" id="modal_filter" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
				<div class="modal-dialog " style="margin: 0 auto;">
					<div class="modal-content">
						<div class="modal-header">
							<div class="col-xs-10">
								<h4 class="modal-title"><?php echo $this->lang->line('judul_filter', FALSE); ?></h4>
							</div>
							<div class="col-xs-2">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<div class="" style="">
							<!--<div class="col-md-12 ">
							<h4 class="f14  fbold"><a class="forange fbold"  href="<?php echo base_url() ?>caribanyakproduct">Cari banyak produk <i class="fa fa-check-circle forange"></i></a> </h4>
						</div>-->
							<div class="form-group m-t-2">
								<div class="col-xs-12">
									<input name="nama" placeholder="Nama / Partnumber" type="text" class="form-control" value="<?php echo (!empty($querysearch)) ? $querysearch : ""; ?>">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<select name="lokasi" class="form-control">
										<option value="">-- Pilih Lokasi--</option>
										<option value="1">Jabodetabek</option>
										<option value="2">Banten</option>
										<option value="3">Jawa Barat</option>
										<option value="4">Jawa Tengah</option>
										<option value="5">Jawa Timur</option>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<select name="komponen" class="form-control" seletedcomponent="<?php $idcomponent ?>">
										<option value="">-- Pilih kategori --</option>
										<?php foreach ($category->result() as $item) : ?>
											<option value="<?php echo $item->id ?>" <?php echo $idcomponent == $item->id ? 'selected="selected"' : "" ?>><?php echo $item->name ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<select name="sub_kategori" class="form-control" seletedcomponent="<?php $idcomponent ?>">
										<option value="">-- Pilih Sub Kategori --</option>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<select name="merek" class="form-control" seletedcomponent="<?php $idcomponent ?>">
										<option value="">-- Pilih Merk --</option>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<select name="quality" class="form-control" seletedcomponent="<?php $idcomponent ?>">
										<option value="">-- Pilih Grade --</option>
										<option value="1">Asli</option>
										<option value="2">Replika</option>
										<option value="3">Bekas/Copotan</option>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<label>Harga</label>
									<div class="row">
										<div class="col-xs-6">
											<div class="input-group">
												<span class="input-group-addon">Rp</span>
												<input class="form-control" type="text" id="hargamin" name="hargamin" style="width: 100%;" placeholder="Min">
											</div>
										</div>
										<div class="col-xs-6">
											<div class="input-group">
												<span class="input-group-addon">Rp</span>
												<input class="form-control" type="text" id="hargamax" name="hargamax" style="width: 100%;" placeholder="Max">
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="modal-footer m-t-1">
							<button class="btn btnnew col-xs-12 apply-filter">Terapkan Filter</button>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
	</form>
	<div class="clearfix"></div>
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