<div class="settingumum row">
	<div class="col-md-12">
		<strong class="f22">Setting Umum</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="col-md-6">
				Setting promo Vertikal dan Horisontal<br>
				<a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $prmvkl[0]["value"] ?>">Lihat Promo Vertikal</a><br>
				<a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $prmhtl[0]["value"] ?>">Lihat Promo Horisontal</a><br>
			</div>
			<div class="col-md-6">
				<table class="tablelist table">
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
								<?php if ($key["id"]!= $prmvkl[0]["value"]): ?>
								<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
									<input type="hidden" name="id" value='<?php echo $prmvkl[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='prmvkl'>
									<input type="hidden" name="value" value='<?php echo $key["id"] ?>'>
									<button type="submit" class="btn btn-sm btn-secondary">+</button>
								</form>
							<?php elseif($key["id"]== $prmvkl[0]["value"]): ?>
								<i class="fa fa-check-square"></i>
								<?php endif ?>
							</td>
							<td>
								<?php if ($key["id"]!= $prmhtl[0]["value"]): ?>
								<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
									<input type="hidden" name="id" value='<?php echo $prmhtl[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='prmhtl'>
									<input type="hidden" name="value" value='<?php echo $key["id"] ?>'>
									<button type="submit" class="btn btn-sm btn-secondary">+</button>
								</form>
							<?php elseif($key["id"]== $prmhtl[0]["value"]): ?>
								<i class="fa fa-check-square"></i>
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
	<div class="col-md-12">
		<div class="card">
			<div class="col-md-12">
				<strong>Setting Umum</strong>
				<hr>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<th>Nama</th>
							<th>Isi</th>
						</thead>
						<tbody>
							<tr>
								<td>Info Rekening</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
									<input type="hidden" name="id" value='<?php echo $inforekening[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='inforekening'>
									<textarea name="value" class="form-control" rows="4"><?php echo $inforekening[0]["value"] ?></textarea>
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Delivery_per_kg</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
									<input type="hidden" name="id" value='<?php echo $delivery_per_kg[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='delivery_per_kg'>
									<input name="value" class="form-control" value="<?php echo $delivery_per_kg[0]["value"] ?>">
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Delivery_free_limit</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
									<input type="hidden" name="id" value='<?php echo $delivery_free_limit[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='delivery_free_limit'>
									<input name="value" class="form-control" value="<?php echo $delivery_free_limit[0]["value"] ?>">
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>sms konfirmasi</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu" method="POST">
									<input type="hidden" name="id" value='<?php echo $countsmsverifi[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='countsmsverifi'>
									<input name="value" class="form-control" value="<?php echo $countsmsverifi[0]["value"] ?>">
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Info Link home</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_infolinkhome" method="POST">
									<input type="hidden" name="id" value='<?php echo $infolinkhome[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='infolinkhome'>
									<?php $jsonvalue = json_decode($infolinkhome[0]["value"],true) ?>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Strong</span>
									  <input name="strong" class="form-control" value="<?php echo $jsonvalue['strong'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Text</span>
									  <input name="text" class="form-control" value="<?php echo $jsonvalue['text'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Link</span>
									  <input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
									</div>
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar<br>
									<small>Iklan user firts visit.
									<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank">Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig" method="POST">
									<input type="hidden" name="id" value='<?php echo $popup_adsbig[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='popup_adsbig'>
									<?php $jsonvalue = json_decode($popup_adsbig[0]["value"],true) ?>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Img</span>
									  <input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Link</span>
									  <input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue)?$jsonvalue['start_date']:0 ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue)? $jsonvalue['end_date']:0 ?>">
									</div>
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar Mobile<br>
									<small>Iklan user firts visit.
									<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank">Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig_mobile" method="POST">
									<input type="hidden" name="id" value='<?php echo $popup_adsbig_mobile[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='popup_adsbig_mobile'>
									<?php $jsonvalue = json_decode($popup_adsbig_mobile[0]["value"],true) ?>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Img</span>
									  <input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Link</span>
									  <input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue)?$jsonvalue['start_date']:0 ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue)? $jsonvalue['end_date']:0 ?>">
									</div>
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar (Used)<br>
									<small>Iklan user firts visit.
									<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank">Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig" method="POST">
									<input type="hidden" name="id" value='<?php echo $popup_adsbig_used[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='popup_adsbig_used'>
									<?php $jsonvalue = json_decode($popup_adsbig_used[0]["value"],true) ?>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Img</span>
									  <input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Link</span>
									  <input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue)?$jsonvalue['start_date']:0 ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue)? $jsonvalue['end_date']:0 ?>">
									</div>
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Spanduk Besar Mobile (Used)<br>
									<small>Iklan user firts visit.
									<br><a href="<?php echo base_url() ?>backendsetting/formuploadimage" target="_blank">Upload Gambar</a> untuk mendapatkan Link Img
									</small>
								</td>
								<td>
									<form action="<?php echo base_url() ?>backendsetting/editmenu_popup_adsbig_mobile" method="POST">
									<input type="hidden" name="id" value='<?php echo $popup_adsbig_mobile_used[0]["id"] ?>'>
									<input type="hidden" name="urlback" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" >
									<input type="hidden" name="name" value='popup_adsbig_mobile_used'>
									<?php $jsonvalue = json_decode($popup_adsbig_mobile_used[0]["value"],true) ?>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Img</span>
									  <input name="img" class="form-control" value="<?php echo $jsonvalue['img'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Link</span>
									  <input name="link" class="form-control" value="<?php echo $jsonvalue['link'] ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="start_date" type="date" class="form-control" value="<?php echo array_key_exists('start_date', $jsonvalue)?$jsonvalue['start_date']:0 ?>">
									</div>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Start Date</span>
									  <input name="end_date" type="date" class="form-control" value="<?php echo array_key_exists('end_date', $jsonvalue)? $jsonvalue['end_date']:0 ?>">
									</div>
									<button class="btn btn-orange">Simpan</button>
									</form>
								</td>
							</tr>
							<tr>
								<td>Backup database</td>
								<td><a class="btn btn-orange" target="_blank" href="<?php echo base_url() ?>backendsetting/backupdatabase">Download database</a></td>
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
.dataTables_length,.dataTables_filter,.dataTables_info{display: none}
</style>