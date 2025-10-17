<div class="row historypesanan">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
		<strong class="f22">Penarikan saldo TRU Koin</strong>
		<hr>
	</div>
	<div class="col-md-12 table-responsive">
		<form class="formconfirmation" action="<?php echo base_url() ?>member/setwithdraw" method="POST" enctype="multipart/form-data">
			<div class="row ">
				<div class="col-md-3">
					Jumlah yang ingin ditarik*
					<!--   <input type="number" id="money_rp" name="money" class="form-control hidden-xl-down" placeholder="Jumlah uang yang ingin ditarik" required> -->
				</div>
				<div class="col-md-9">
					<input type="number" name="amount" class="form-control money" placeholder="Jumlah koin yang ingin ditarik" min="100000">
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Nama pemilik rekening *
				</div>
				<div class="col-md-9">
					<input type="text" name="bank_holder" class="form-control" placeholder="Nama sesuai buku tabungan" required>
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Bank Tujuan *
				</div>
				<div class="col-md-9">
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
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Biaya Penarikan*
				</div>
				<div class="col-md-9">
					<input name="transfer_fee" type="number" readonly="readonly" class="form-control" id="datepick" placeholder="0" required>
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					<button class="btn btn-orange form-control proccessshow" modal-text="Data Anda sedang disimpan" type="submit">Tarik Dana</button>
				</div>
				<div class="col-md-9">
					<small>
						Catatan:
						<ul>
							<li>Biaya penarikan akan langusng diambil sari sisa saldo anda.</li>
							<li>Harap isi dengan benar form yang tersedia.</li>
						</ul>

					</small>
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
		</form>
	</div>
</div>