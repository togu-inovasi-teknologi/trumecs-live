<div class="historypesanan">
	<div class="col-lg-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<strong class="f22">Tarik Saldo TruCoins</strong>
		</div>
		<div class="col-lg-8">
			<div class="card borderdesk p-a-1 m-t-1 f14">
				<div class="row">
					<div class="col-lg-12 ">
						<form class="formconfirmation" action="<?php echo base_url() ?>member/setwithdraw" method="POST" enctype="multipart/form-data">
							<label>Jumlah yang ingin ditarik*</label>
							<input type="number" name="amount" class="form-control money" placeholder="Jumlah koin yang ingin ditarik" min="100000">
							<br>
							<label>Nama pemilik rekening*</label>
							<input type="text" name="bank_holder" class="form-control" placeholder="Nama sesuai buku tabungan" required>
							<br>
							<label>Bank Tujuan *</label>
							<div class="row">
								<div class="col-lg-4 ">
									<select class="form-control" name="bank_name" required>
										<option>-Pilih Bank-</option>
										<option value="BCA">BCA</option>
										<option value="BNI">BNI</option>
										<option value="CIMB Niaga">CIMB Niaga</option>
										<option value="Mandiri">Mandiri</option>
										<option value="Bank lain">Bank lain</option>
									</select>
								</div>
								<div class="col-lg-8 ">
									<input type="text" name="bank_account" class="form-control " placeholder="Nomor Rekening" required>
								</div>
							</div>
							<br>
							<label>Biaya Penarikan*</label>
							<input name="transfer_fee" type="number" readonly="readonly" class="form-control" id="datepick" placeholder="0" required>
							<br>
							<button class="btn btnnew form-control proccessshow" modal-text="Data Anda sedang disimpan" type="submit">Tarik Dana</button>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card borderdesk m-t-1 p-x-1">
				<div class="row">
					<div class="col-lg-12 m-t-1">
						<span class="alert alert-warning pull-right f12">
							<strong class="f18">Catatan!</strong>
							<br />
							<ul style="margin-left: -20px;">
								<li>Biaya penarikan akan langusng diambil sari sisa saldo anda.</li>
								<li>Harap isi dengan benar form yang tersedia.</li>
							</ul>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>