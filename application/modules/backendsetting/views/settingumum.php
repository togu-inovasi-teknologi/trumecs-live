<div class="settingumum row">
	<div class="col-md-12">
		<strong class="f22">Setting Umum</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="col-md-6">
				Setting promo Vertikal dan Horisontal<br>
				<a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $prmvkl[0]["value"] ?>" class="text-decoration-none">Lihat Promo Vertikal</a><br>
				<a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $prmhtl[0]["value"] ?>" class="text-decoration-none">Lihat Promo Horisontal</a><br>
			</div>
			<div class="col-md-6">
				<table class="tablelist table table-bordered">
					<thead>
						<tr>
							<th>Nama Promo</th>
							<th>Vertikal</th>
							<th>Horisontal</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($promo as $key): ?>
							<tr>
								<td>
									<?php echo ($key["name"]) ?>
								</td>
								<td>
									<?php if ($key["id"] != $prmvkl[0]["value"]): ?>
										<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST" class="d-inline">
											<input type="hidden" name="id" value='<?php echo $prmvkl[0]["id"] ?>'>
											<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
											<input type="hidden" name="name" value='prmvkl'>
											<input type="hidden" name="value" value='<?php echo $key["id"] ?>'>
											<button type="submit" class="btn btn-sm btn-secondary">
												<i class="bi bi-plus-lg"></i>
											</button>
										</form>
									<?php elseif ($key["id"] == $prmvkl[0]["value"]): ?>
										<i class="bi bi-check-square-fill text-success"></i>
									<?php endif ?>
								</td>
								<td>
									<?php if ($key["id"] != $prmhtl[0]["value"]): ?>
										<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST" class="d-inline">
											<input type="hidden" name="id" value='<?php echo $prmhtl[0]["id"] ?>'>
											<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
											<input type="hidden" name="name" value='prmhtl'>
											<input type="hidden" name="value" value='<?php echo $key["id"] ?>'>
											<button type="submit" class="btn btn-sm btn-secondary">
												<i class="bi bi-plus-lg"></i>
											</button>
										</form>
									<?php elseif ($key["id"] == $prmhtl[0]["value"]): ?>
										<i class="bi bi-check-square-fill text-success"></i>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="col-md-12">
				<strong>Setting Umum</strong>
				<hr>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Isi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Info Rekening</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
										<input type="hidden" name="id" value='<?php echo $inforekening[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='inforekening'>
										<textarea name="value" class="form-control" rows="4"><?php echo $inforekening[0]["value"] ?></textarea>
										<button class="btn btn-orange mt-2"><i class="bi bi-save"></i> Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Delivery_per_kg</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
										<input type="hidden" name="id" value='<?php echo $delivery_per_kg[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='delivery_per_kg'>
										<div class="input-group">
											<input name="value" class="form-control" value="<?php echo $delivery_per_kg[0]["value"] ?>">
											<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
										</div>
									</form>
								</td>
							</tr>
							<tr>
								<td>Delivery_free_limit</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
										<input type="hidden" name="id" value='<?php echo $delivery_free_limit[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='delivery_free_limit'>
										<div class="input-group">
											<input name="value" class="form-control" value="<?php echo $delivery_free_limit[0]["value"] ?>">
											<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
										</div>
									</form>
								</td>
							</tr>
							<tr>
								<td>sms konfirmasi</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
										<input type="hidden" name="id" value='<?php echo $countsmsverifi[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='countsmsverifi'>
										<div class="input-group">
											<input name="value" class="form-control" value="<?php echo $countsmsverifi[0]["value"] ?>">
											<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
										</div>
									</form>
								</td>
							</tr>
							<tr>
								<td>Info Link home</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_infolinkhome" method="POST">
										<input type="hidden" name="id" value='<?php echo $infolinkhome[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='infolinkhome'>
										<?php $jsonvalue = json_decode($infolinkhome[0]["value"], true) ?>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-type-bold"></i> Strong</span>
											<input name="strong" class="form-control" value="<?php echo $jsonvalue['strong'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-text-paragraph"></i> Text</span>
											<input name="text" class="form-control" value="<?php echo $jsonvalue['text'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-link"></i> Link</span>
											<input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
										</div>
										<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar<br>
									<small>Iklan user first visit.
										<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank" class="text-decoration-none"><i class="bi bi-upload"></i> Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig" method="POST">
										<input type="hidden" name="id" value='<?php echo $popup_adsbig[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='popup_adsbig'>
										<?php $jsonvalue = json_decode($popup_adsbig[0]["value"], true) ?>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-image"></i> Img</span>
											<input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-link"></i> Link</span>
											<input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> Start Date</span>
											<input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue) ? $jsonvalue['start_date'] : 0 ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> End Date</span>
											<input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue) ? $jsonvalue['end_date'] : 0 ?>">
										</div>
										<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar Mobile<br>
									<small>Iklan user first visit.
										<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank" class="text-decoration-none"><i class="bi bi-upload"></i> Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig_mobile" method="POST">
										<input type="hidden" name="id" value='<?php echo $popup_adsbig_mobile[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='popup_adsbig_mobile'>
										<?php $jsonvalue = json_decode($popup_adsbig_mobile[0]["value"], true) ?>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-image"></i> Img</span>
											<input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-link"></i> Link</span>
											<input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> Start Date</span>
											<input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue) ? $jsonvalue['start_date'] : 0 ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> End Date</span>
											<input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue) ? $jsonvalue['end_date'] : 0 ?>">
										</div>
										<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar (Used)<br>
									<small>Iklan user first visit.
										<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank" class="text-decoration-none"><i class="bi bi-upload"></i> Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig" method="POST">
										<input type="hidden" name="id" value='<?php echo $popup_adsbig_used[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='popup_adsbig_used'>
										<?php $jsonvalue = json_decode($popup_adsbig_used[0]["value"], true) ?>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-image"></i> Img</span>
											<input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-link"></i> Link</span>
											<input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> Start Date</span>
											<input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue) ? $jsonvalue['start_date'] : 0 ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> End Date</span>
											<input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue) ? $jsonvalue['end_date'] : 0 ?>">
										</div>
										<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar Mobile (Used)<br>
									<small>Iklan user first visit.
										<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank" class="text-decoration-none"><i class="bi bi-upload"></i> Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig_mobile" method="POST">
										<input type="hidden" name="id" value='<?php echo $popup_adsbig_mobile_used[0]["id"] ?>'>
										<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
										<input type="hidden" name="name" value='popup_adsbig_mobile_used'>
										<?php $jsonvalue = json_decode($popup_adsbig_mobile_used[0]["value"], true) ?>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-image"></i> Img</span>
											<input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-link"></i> Link</span>
											<input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> Start Date</span>
											<input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue) ? $jsonvalue['start_date'] : 0 ?>">
										</div>
										<div class="input-group mb-2">
											<span class="input-group-text"><i class="bi bi-calendar"></i> End Date</span>
											<input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue) ? $jsonvalue['end_date'] : 0 ?>">
										</div>
										<button class="btn btn-orange"><i class="bi bi-save"></i> Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Backup database</td>
								<td><a class="btn btn-orange" target="_blank" href="<?php echo base_url() ?>backendsetting/backupdatabase"><i class="bi bi-download"></i> Download database</a></td>
							</tr>
							<tr>
								<td>Sync Database Trumecs "Admin"</td>
								<td>
									<div class="d-flex gap-2">
										<a class="btn btn-orange" target="_blank" href="<?php echo base_url() ?>backendsetting/backupdatabase"><i class="bi bi-download"></i> DB To Sheet</a>
										<a class="btn btn-orange" target="_blank" href="<?php echo base_url() ?>backendsetting/backupdatabase"><i class="bi bi-download"></i> Sync Database</a>
										<a class="btn btn-orange" target="_blank" href="<?php echo base_url() ?>backendsetting/backupdatabase"><i class="bi bi-download"></i> Sheet To DB</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<style type="text/css">
	.dataTables_length,
	.dataTables_filter,
	.dataTables_info {
		display: none
	}

	/* tambahan style untuk button orange */
	.btn-orange {
		background-color: #f97316;
		border-color: #f97316;
		color: white;
	}

	.btn-orange:hover {
		background-color: #ea580c;
		border-color: #ea580c;
		color: white;
	}

	/* style card */
	.card {
		border: 1px solid #e2e8f0;
		border-radius: 0.5rem;
		padding: 1rem;
		margin-bottom: 1rem;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
	}

	.f22 {
		font-size: 1.375rem;
		font-weight: 600;
	}
</style>