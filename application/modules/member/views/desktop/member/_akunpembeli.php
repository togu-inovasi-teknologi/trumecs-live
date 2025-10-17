<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];
$this->load->library('Date');
$format = new Date();
?>
<div class="row d-flex flex-column gap-3">
	<div class="col-lg-12 title-desktop">
		<h4 class="title-content"><?= $this->lang->line('memberTitle', FALSE); ?></h4>
		<h6 class="text-muted f13"><?= $this->lang->line('memberSubTitle', FALSE); ?></h6>
	</div>
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-body p-a-1">
						<div class="row d-flex flex-column gap-2">
							<?php foreach ($member as $key) : ?>
								<div class="col-lg-12">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelName', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["name"] ?></p>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelEmail', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["email"] ?></p>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelPhone', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["phone"] ?></p>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelBirth', FALSE); ?></p>
										<?php if ($key["date"] || $key["month"] || $key["year"] == null) { ?>
											<p class="text-dark fred"> Belum Atur Tanggal Lahir</p>
										<?php } else { ?>
											<p class="text-dark"> <?php echo $key["date"] ?> <?php echo $format->format_month($key["month"]); ?> <?php echo $key["year"] ?></p>
										<?php } ?>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelCompany', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["Company"] ?></p>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelPosition', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["position"] ?></p>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelCompanyEmail', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["company_email"] ?></p>
									</div>
								</div>
								<div class="col-lg-12 ">
									<div class="d-flex flex-column gap-1">
										<p class="f12"><?= $this->lang->line('memberLabelCompanyPhone', FALSE); ?></p>
										<p class="text-dark"><?php echo $key["company_phone"] ?></p>
									</div>
								</div>
								<div class="col-lg-12">
									<p class="f12"><?= $this->lang->line('memberLabelAddress', FALSE); ?></p>
									<div class="d-flex gap-1">
										<span class="text-dark"><?php echo $key["address"] ?>,</span>
										<span class="text-dark"><?php echo $key["nm_villages"] ?></span>
									</div>
									<div class="d-flex gap-1">
										<span class="text-dark"><?php echo $key["nm_districts"] ?>,</span>
										<span class="text-dark"><?php echo $key["nm_regencies"] ?></span>
									</div>
									<div class="d-flex gap-1">
										<span class="text-dark"><?php echo $key["nm_provinces"] ?>,</span>
										<span class="text-dark"><?php echo $key["kodepos"] ?></span>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
					<div class="card-footer">
						<button data-target="#editAccount-<?php echo $sessionmember["id"]; ?>" data-toggle="modal" class="btn btnnew fbold"><?= $this->lang->line('buttonChangeAccount'); ?></button>
						<button data-target="#editPassword-<?php echo $sessionmember["id"]; ?>" data-toggle="modal" class="btn btnnew fbold"><?= $this->lang->line('buttonChangePassword'); ?></button>
					</div>
				</div>
			</div>
			<div class="col-lg-4 text-muted sticky-member">
				<div class="card p-a-1">
					<div class="row">
						<?php foreach ($member as $key) : ?>
							<?php $foto = (explode(':', $key['avatar'])); ?>
							<div class="col-lg text-center">
								<?php if ($foto[0] == 'https') { ?>
									<img src="<?= $key['avatar']; ?>" alt="Avatar" class="avatar-setting">
								<?php } else { ?>
									<img src="<?= $key["avatar"] == null ? base_url() . "public/image/noimage.png" : base_url() . "public/image/member/" . $key["avatar"] ?> " alt="Avatar" class="avatar-setting">
								<?php } ?>
							</div>
							<div class="col-lg text-center m-t-1">
								<button data-toggle="modal" data-target="#editPicture-<?php echo $key["id"]; ?>" class="btn btnnew fbold">
									<?= $this->lang->line('buttonChangePicture'); ?>
								</button>
							</div>
						<?php endforeach ?>
					</div>
					<div class="row m-t-1">
						<div class="col-lg">
							<div class="alert alert-warning f12">
								<h6 class="fbold"><?= $this->lang->line('note', FALSE); ?></h6>
								<ul class="mb-0" style="margin-left: -20px;">
									<li><?= $this->lang->line('notePicture1', FALSE); ?></li>
									<li><?= $this->lang->line('notePicture2', FALSE); ?></li>
									<li><?= $this->lang->line('notePicture3', FALSE); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editPicture-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title fbold" id="exampleModalLabel"><?= $this->lang->line('modalMemberChangePicture'); ?>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form action="<?php echo base_url() ?>member/upload_foto_member" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-4">
							<input type="file" id="uploadBtn" name="images" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
							<a href="#" id="filetext" name="file" class="btn btnnew" style="margin-top:-50px;cursor: pointer;"><?= $this->lang->line('buttonChoiceFile'); ?></a>
						</div>
						<div class="col-lg-4">
							<img src="" class="blah img-fluid" style="max-height: 100px;">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('buttonCancel'); ?></button>
					<button type="submit" class="btn btnnew"><?= $this->lang->line('buttonSave'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editAccount-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title fbold" id="exampleModalLabel"><?= $this->lang->line('modalMemberChangeAccount'); ?>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form action="<?php echo base_url() ?>member/updatemember" method="POST">
				<div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
					<div class="row d-flex flex-column gap-3">
						<div class="col-lg-12">
							<label for="name"><?= $this->lang->line('memberLabelName'); ?></label>
							<input id="name" type="text" name="name" value="<?php echo $sessionmember["name"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderName'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="email"><?= $this->lang->line('memberLabelEmail'); ?></label>
							<input id="email" type="email" name="email" value="<?php echo $sessionmember["email"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderEmail'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="phone"><?= $this->lang->line('memberLabelPhone'); ?></label>
							<input id="phone" type="text" name="phone" value="<?php echo $sessionmember["phone"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderPhone'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="dateBirth"><?= $this->lang->line('memberLabelBirth'); ?></label>
							<div class="row" id="dateBirth">
								<div class="col-lg-4 text-muted">
									<label class="text-muted"><?= $this->lang->line('memberLabelBirthDate'); ?></label>
									<select class="form-control" name="date" isvalue="<?php echo $sessionmember["date"] ?>" required>
										<?php for ($t = 1; $t <= 31; $t++) {
											$selectdate = ($sessionmember["date"] != $t) ? "" : "";
											echo '<option value="' . $t . '" ' . $selectdate . '>' . $t . '</option>';
										} ?>
									</select>
								</div>
								<div class="col-lg-4 text-muted">
									<label class="text-muted"><?= $this->lang->line('memberLabelBirthMonth'); ?></label>
									<select class="form-control" name="month" isvalue="<?php echo $sessionmember["month"] ?>" required>
										<?php for ($b = 1; $b <= 12; $b++) {
											$selectmonth = ($sessionmember["month"] != $b) ? "" : "";
											echo '<option value="' . $b . '" ' . $selectmonth . '>' . $b . '</option>';
										} ?>
									</select>
								</div>
								<div class="col-lg-4 text-muted">
									<label class="text-muted"><?= $this->lang->line('memberLabelBirthYear'); ?></label>
									<select class="form-control" name="year" isvalue="<?php echo $sessionmember["year"] ?>" required>
										<?php for ($y = 1945; $y <= date("Y"); $y++) {
											$selectyear = ($sessionmember["year"] != $y) ? "" : "";
											echo '<option value="' . $y . '" ' . $selectyear . '>' . $y . '</option>';
										} ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<label for="company"><?= $this->lang->line('memberLabelCompany'); ?></label>
							<input id="company" type="text" name="company" value="<?php echo $sessionmember["Company"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderCompany'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="position"><?= $this->lang->line('memberLabelPosition'); ?></label>
							<input id="position" type="text" name="position" value="<?php echo $sessionmember["position"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderPosition'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="emailCompany"><?= $this->lang->line('memberLabelCompanyEmail'); ?></label>
							<input id="emailCompany" type="text" name="company_email" value="<?php echo $sessionmember["company_email"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderCompanyEmail'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="phoneCompany"><?= $this->lang->line('memberLabelCompanyPhone'); ?></label>
							<input id="phoneCompany" type="text" name="company_phone" value="<?php echo $sessionmember["company_phone"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderCompanyPhone'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="province"><?= $this->lang->line('memberLabelAddressProvince'); ?></label>
							<select name="province" class="form-control" required id="<?php echo $sessionmember["provice"] ?>">
								<?php foreach ($provinces as $key) : ?>
									<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-lg-12">
							<label for="regencies"><?= $this->lang->line('memberLabelAddressCity'); ?></label>
							<select name="city" class="form-control" required id="<?php echo $sessionmember["city"] ?>">
							</select>
						</div>
						<div class="col-lg-12">
							<label for="district"><?= $this->lang->line('memberLabelAddressDistrict'); ?></label>
							<select name="districts" class="form-control" required id="<?php echo $sessionmember["districts"] ?>">
							</select>
						</div>
						<div class="col-lg-12">
							<label for="village"><?= $this->lang->line('memberLabelAddressVillage'); ?></label>
							<select name="village" class="form-control" required id="<?php echo $sessionmember["village"] ?>">
							</select>
						</div>
						<div class="col-lg-12">
							<label for="rtRw"><?= $this->lang->line('memberLabelAddressNA'); ?></label>
							<input id="rtRw" type="text" name="rt_rw" value="<?php echo $sessionmember["rt_rw"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderAddressNA'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="address"><?= $this->lang->line('memberLabelAddress'); ?></label>
							<input id="address" type="text" name="address" value="<?php echo $sessionmember["address"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderAddress'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="zipCode"><?= $this->lang->line('memberLabelAddressZipcode'); ?></label>
							<input id="zipCode" type="number" name="kodepos" value="<?php echo $sessionmember["kodepos"] ?>" class="form-control" placeholder="<?= $this->lang->line('memberPlaceholderAddressZipcode'); ?>" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('buttonCancel'); ?></button>
					<button type="submit" class="btn btnnew"><?= $this->lang->line('buttonSave'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editPassword-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title fbold" id="exampleModalLabel"><?= $this->lang->line('modalMemberChangePassword'); ?>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form action="<?php echo base_url() ?>member/updatepassword" method="POST">
				<div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
					<div class="row d-flex flex-column gap-2">
						<div class="col-lg-12">
							<label for="oldPassword"><?= $this->lang->line('memberLabelOldPassword'); ?></label>
							<input id="oldPassword" type="password" name="passwordold" class="form-control password" placeholder="<?= $this->lang->line('memberPlaceholderOldPassword'); ?>" required>
						</div>
						<div class="col-lg-12">
							<label for="newPassword"><?= $this->lang->line('memberLabelNewPassword'); ?></label>
							<input id="newPassword" type="password" name="passwordnew" class="form-control password" placeholder="<?= $this->lang->line('memberPlaceholderNewPassword'); ?>">
							<input type="hidden" name="passwordold" value="<?php echo $sessionmember["password"] ?>" required>
						</div>
						<div class="col-lg-12">
							<input type="checkbox" class="show-password"> <?= $this->lang->line('memberLabelShowPassword'); ?></input>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('buttonCancel'); ?></button>
					<button type="submit" class="btn btnnew"><?= $this->lang->line('buttonSave'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>