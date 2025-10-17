<div class="row historypesanan">
	<?php echo ($this->session->flashdata('message') == "") ? "" :
		'<div class="alert alert-warning">' .
		$this->session->flashdata('message') .
		'</div>'; ?>
	<div class="card col-md-12 text-center p-a-1">
		<strong class="f22">Penarikan saldo TRUCoin</strong>
	</div>
	<hr>
	<form class="formconfirmation" action="<?php echo base_url() ?>member/setwithdraw" method="POST" enctype="multipart/form-data">
		<div class="card col-xs-12 p-a-1">
			<div class="col-md-12">
				<label class="fbold">Jumlah yang ingin ditarik<a style="color: red;">*</a></label>
				<input type="number" name="amount" class="form-control money" placeholder="Jumlah koin yang ingin ditarik" min="100000">
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Nama pemilik rekening<a style="color: red;">*</a></label>
				<input type="text" name="bank_holder" class="form-control" placeholder="Nama sesuai buku tabungan" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Bank Tujuan<a style="color: red;">*</a></label>
				<div class="row">
					<div class="col-md-4 ">
						<select class="form-control" name="bank_name" required>
							<option>-Pilih Bank-</option>
							<option value="BCA">BCA</option>
							<option value="BNI">BNI</option>
							<option value="CIMB Niaga">CIMB Niaga</option>
							<option value="Mandiri">Mandiri</option>
							<option value="Bank lain">Bank lain</option>
						</select>
					</div>
					<div class="col-md-8 ">
						<input type="text" name="bank_account" class="form-control " placeholder="Nomor Rekening" required>
					</div>
				</div>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Biaya Penarikan<a style="color: red;">*</a></label>
				<input name="transfer_fee" type="number" readonly="readonly" class="form-control" id="datepick" placeholder="0" required>
			</div>
			<div class="col-md-12 m-t-1">
				<button class="btn btnnew form-control proccessshow" modal-text="Data Anda sedang disimpan" type="submit">Tarik Dana</button>
			</div>
		</div>
	</form>
	<div class="col-md-12" style="font-size: small;">
		<div class="alert alert-warning pull-right">
			<p class="f14">
				Catatan:
			<ul>
				<li>Biaya penarikan akan langusng diambil sari sisa saldo anda.</li>
				<li>Harap isi dengan benar form yang tersedia.</li>
			</ul>
			</p>
		</div>
	</div>
</div>