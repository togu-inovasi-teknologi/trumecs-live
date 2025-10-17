<div class="historypesanan">
	<div class="row">
		<div class="col-lg-12">
			<?php echo ($this->session->flashdata('message') == "") ? "" :
				'<div class="alert alert-warning">' .
				$this->session->flashdata('message') .
				'</div>'; ?>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<strong class="f22">Request From Quatation</strong>
				</div>
				<div class="col-lg-6 text-right">
					<a class="btn btnnew" href="<?php echo base_url() ?>bulk">Buat Baru</a>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<div class="card borderdesk m-t-1 p-a-1">
						<div class="row">
							<div class="col-lg-12">
								<strong class="f18">Tambah RFQ</strong>
							</div>
							<form action="<?php echo base_url('bulk/save'); ?>" method="POST" id="form-upload">
								<div class="col-lg-12 p-a-1">
									<div class="col-lg-12 p-t-1 " style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px;border: 2px solid rgb(54, 138, 191)" id="uploader">
										<div class="col-lg-12 p-a-1 text-center btn-upload" style="border:3px dashed #ccc;cursor:pointer;">
											<img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" width="100" />
											<br />
											Unggah daftar belanjamu
										</div>
										<div class="col-lg-12 p-y-1 p-x-0"></div>
										<div class="table table-striped" class="files" id="previews">
											<div id="template" class="file-row">
												<!-- This is used as the file preview template -->
												<div class="col-lg-8 p-a-0" style="display:inline-flex">
													<span class="name" data-dz-name style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width:100%"></span> &nbsp;-&nbsp; <span class="size pull-right" data-dz-size style="display:inline-flex"></span>
												</div>
												<div class="col-lg-3" style="padding-top:5px">
													<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
														<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
													</div>
												</div>
												<div class="col-lg-1 p-a-0">
													<button data-dz-remove class="pull-right btn btn-danger delete btn-sm" style="height:24px;width:24px;border-radius:50%;padding:1px 4px">
														<i class="fa fa-remove"></i>
													</button>
												</div>
												<strong class="error text-danger" data-dz-errormessage></strong>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 p-a-1" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
									<button type="button" data-toggle="modal" data-target=".popup_alamat" class="btn fbold btn-sm pull-right btnnew">Ubah</button>
									<h5>Alamat Pengiriman</h5>
									<div class="text-muted">
									</div>
								</div>
								<div class="col-lg-12 p-a-1" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
									<button type="button" data-toggle="modal" data-target=".popup_catatan" class="btn btn-sm pull-right btnnew">Ubah</button>
									<h5>Catatan tambahan</h5>
									<span class="text-catatan text-muted">Belum ada catatan</span>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="card borderdesk m-t-1 p-a-1">
						<div class="row">
							<div class="col-lg-12">
								<strong class="f18">RFQ Saya</strong>
							</div>
							<div class="col-lg-12">
								<?php foreach ($list as $key) : ?>
									<?php
									$i = 1;
									?>
									<?php
									$status = ($key["status"] != 1) ? ($key["status"] == 2) ?  "Ditolak" : "Menunggu" : "Selesai";
									$status_css = ($key["status"] != 1) ? ($key["status"] == 2) ?  "danger" : "warning" : "success";
									?>
									<div class="card p-a-1 m-t-1">
										<div class="row">
											<div class="col-lg-12 p-y-1">
												<strong>#<?php echo $key["id"] ?></strong> -
												<small><?php echo date("d M Y", $key["created_at"]) ?></small> -
												<span class="label label-<?php echo $status_css ?>"><?php echo $status ?></span><br /><br />
												<b><?php echo $key["name"] ?></b> - <b>[<?php echo $key["company"] ?>]</b><br />
												<small>Telp: <?php echo $key["phone"] ?></small><br />
												<small><?php echo $key["address"] ?> <?php echo $key["village"] ?> <?php echo $key["district"] ?> <?php echo $key["city"] ?> <?php echo $key["province"] ?></small>,
												<small><?php echo $key["zipcode"] ?></small><br /><br />
												<small>Berkas:</small><br />
												<?php foreach ($key['files'] as $keys) : ?>
													<a href="<?php echo base_url('public/sourcing/' . $keys['filename']); ?>"><small><?php echo $keys['filename']; ?></small></a><br />
												<?php endforeach; ?>
												<?php echo $key["note"] ? "<br/><small>Catatan Pengguna:<br/>" . $key["note"] . "</small>" : "" ?>
											</div>
											<div class="col-lg-12 p-y-1 btn-success" style="">
												<?php if ($key["status"] == 1) : ?><a href="<?php echo site_url('public/filequotation/' . $key["offer"]); ?>" style="float:right; color:blue;">Download</a><?php endif; ?>
												<small><?php echo $key["updated_at"] != 0 ? date("d M Y", $key["updated_at"]) : '<span class="fbold">Belum ada respon dari admin</span>' ?></small><br />
												<small><?php echo $key["admin_note"] != "" ? "Catatan Admin: <br/>" . $key["admin_note"] : '' ?></small>
											</div>
										</div>
									</div>
									<?php $i++ ?>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card borderdesk m-t-1 p-a-1">
				<div class="row">
					<div class="col-lg-12">
						<strong class="f18">Cara Baru Berbelanja</strong>
					</div>
					<div class="col-lg-12 m-t-1">
						<div class="row">
							<div class="col-lg-2">
								<img src="<?php echo site_url('public/image/list-icon.png'); ?>" width="30" />
							</div>
							<div class="col-lg-10">
								<p class="fbold f14 lsp">Unggah Daftar Belanja<br><span style="font-size:10px;">Daftar item yang diinginkan dalam format Excel.</span></p>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2">
								<img src="<?php echo site_url('public/image/coffee-icon.png'); ?>" width="30" />
							</div>
							<div class="col-lg-10">
								<p class="fbold f14 lsp">Tunggu 2 - 3 hari<br><span style="font-size: 10px;">Tim Trumecs akan memproses daftar kamu.</span></p>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2">
								<img src="<?php echo site_url('public/image/envelope-icon.png'); ?>" width="30" />
							</div>
							<div class="col-lg-10">
								<p class="fbold f14 lsp">Penawaran dikirimkan<br><span style="font-size: 10px;">Trumecs akan mengirimkan penawaran dari daftar barang yang sudah diunggah</span></p>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-7" style="margin-top: 7px;">
								<p class="fbold f12 lsp">Unduh Format Excel</p>
							</div>
							<div class="col-lg-5">
								<a class="btn btn-success-outline f12 fbold pull-right" href="<?php echo base_url() ?>bulk" style="border-radius: 20px;"><i class="fa fa-download"></i> Excel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade popup_catatan" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
	<div class="modal-dialog" style="margin: 5% auto;">
		<div class="modal-content">
			<div class="row">
				<div class="product col-lg-12" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
					<h2 class="m-y-2">Tambahkan Catatan</h2>
					<p class="text-muted">Silahkan tambahkan catatan untuk kami:</p>
					<div class="form-group row">
						<label class="control-label col-lg-12"><strong>Catatan Tambahan</strong></label>
						<div class="col-lg-12">
							<textarea form="uploader" class="form-control" placeholder="Catatan tambahan untuk kami pertimbangkan" name="bulk_note" rows="5"><?php //echo $sessionmember["shipping_address"]; 
																																								?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-12">
							<button class="btn btn-catatan btn-orange btn-lg fbold col-lg-12">Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade popup_alamat" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
	<div class="modal-dialog" style="margin: 5% auto;">
		<div class="modal-content">
			<div class="row">
				<div class="product col-lg-12" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
					<?php echo $this->session->flashdata('form_error'); ?>
					<h2 class="m-y-2">Form Belanja</h2>
					<br />
					<p class="text-muted"><?php echo $this->lang->line('subjudul_form_principal') ?>:</p>
					<!-- <form class="m-y-2" method="post" action="<?php echo base_url('principal/save'); ?>"> -->
					<div class="form-group row">
						<label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_nama') ?></strong></label>
						<div class="col-lg-12">
							<input class="form-control" form="uploader" name="alamat_name" placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>" value="<?php echo $user_data['nama'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_phone') ?></strong></label>
						<div class="col-lg-12">
							<input class="form-control" form="uploader" name="alamat_phone" placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>" value="<?php echo $user_data['phone'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_perusahaan') ?></strong></label>
						<div class="col-lg-12">
							<input class="form-control" form="uploader" name="alamat_company" placeholder="<?php echo $this->lang->line('placeholder_input_perusahaan') ?>" value="<?php echo $user_data['company'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12"><strong>Alamat Pengiriman</strong></label>
						<div class="col-lg-12">
							<textarea class="form-control" form="uploader" placeholder="Alamat pengiriman anda" name="shipping_address"><?php echo array_key_exists('shipping_address', $sessionmember) ? $sessionmember["shipping_address"] : ''; ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12" form="uploader"><strong>Provinsi</strong></label>
						<div class="col-lg-12">
							<select class="form-control " name="shipping_province" form="uploader" id="<?php echo array_key_exists('shipping_idprovince', $sessionmember) ? $sessionmember["shipping_idprovince"] : 'shipping_province'; ?>">
								<option value="">--Pilih Provinsi--</option>
								<?php foreach ($provinsi->result() as $key) : ?>
									<option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12" form="uploader"><strong>Kabupaten</strong></label>
						<div class="col-lg-12">
							<select class="form-control " name="shipping_city" form="uploader" id="<?php echo array_key_exists('shipping_idcity', $sessionmember) ? $sessionmember["shipping_idcity"] : 'shipping_city'; ?>">
								<option value="">--Pilih Kabupaten--</option>
								<?php foreach ($regency->result() as $key) : ?>
									<option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12" form="uploader"><strong>Kecamatan</strong></label>
						<div class="col-lg-12">
							<select class="form-control " name="shipping_districts" form="uploader" id="<?php echo array_key_exists('shipping_iddistricts', $sessionmember) ? $sessionmember["shipping_iddistricts"] : 'shipping_district'; ?>">
								<option value="">--Pilih Kecamatan--</option>
								<?php foreach ($district->result() as $key) : ?>
									<option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12" form="uploader"><strong>Kelurahan</strong></label>
						<div class="col-lg-12">
							<select class="form-control" name="shipping_village" form="uploader" id="<?php echo array_key_exists('shipping_idvillages', $sessionmember) ? $sessionmember["shipping_idvillage"] : 'shipping_village'; ?>">
								<option value="">--Pilih Kelurahan--</option>
								<?php foreach ($regency->result() as $key) : ?>
									<option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-12"><strong>Kodepos</strong></label>
						<div class="col-lg-12">
							<input type="text" form="uploader" class="form-control" placeholder="Kode pos anda" name="shipping_kodepos" value="<?php echo array_key_exists('shipping_kodepos', $sessionmember) ? $sessionmember["shipping_kodepos"] : ''; ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-12">
							<button class="btn btn-alamat btn-orange btn-lg fbold col-lg-12">Simpan</button>
						</div>
					</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <?php if ($sessionmember['id'] == null) :  ?>
								<button type="button" data-toggle="modal" data-target=".popup_login" class="btn btn-orange btn-lg fbold col-lg-12">Masuk & Kirim</button>
							<?php else : ?>
								<div class="form-group text-center">
									<div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
								</div>
								<button type="submit" class="btn btn-orange btn-lg fbold col-lg-12">Kirim Daftar Belanja</button>
							<?php endif; ?> -->

<!-- <?php if ($sessionmember['id'] == null) : ?>
									<span class="alamat-placeholder">Alamat tidak diisi</span>
									<span class="alamat-nama"></span><span class="alamat-phone"></span><br />
									<span class="alamat-jalan"></span><span class="alamat-kelurahan"></span><span class="alamat-kecamatan"></span><span class="alamat-kabupaten"></span><span class="alamat-provinsi"></span><br />
									<span class="alamat-kodepos"></span>
								<?php else : ?>
									<span class="alamat-nama"><?php echo $user_data['nama'] ?></span> <span class="alamat-phone"><?php echo $user_data['phone'] ?></span><br />
									<span class="alamat-jalan"><?php echo $sessionmember['address'] ?></span> <span class="alamat-kelurahan"><?php echo $sessionmember['nm_villages'] ?></span> <span class="alamat-kecamatan"><?php echo $sessionmember['nm_districts'] ?></span> <span class="alamat-kabupaten"><?php echo $sessionmember['nm_regencies'] ?><span> <span class="alamat-provinsi"><?php echo $sessionmember['nm_provinces'] ?></span><br />
											<span class="alamat-kodepos"><?php echo $sessionmember['shipping_kodepos'] ?></span>
										<?php endif; ?> -->