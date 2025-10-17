<div class="historypesanan">
	<div class="col-lg-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<strong class="f22">Konfirmasi Pembayaran</strong>
		</div>
		<div class="col-lg-8">
			<div class="card borderdesk m-t-1 p-a-1">
				<form class="formconfirmation" action="<?php echo base_url() ?>member/confirmationwait" method="POST" enctype="multipart/form-data">
					<label>Id Order*</label>
					<?php if (count($listorder) > 0) : ?>
						<select name="idorder" class="form-control" required>
							<option totalbayar="0" value="">Pilih order</option>
							<?php foreach ($listorder as $key) : ?>
								<option totalbayar="<?php echo number_format($key["totalbayar"]) ?>" value="<?php echo $key["iduniq"] ?>"><?php echo $key["iduniq"] ?></option>
							<?php endforeach ?>
						</select>
						<small class="harusbayar"></small>
					<?php else : ?>
						<small>Anda belum mememiliki pesanan</small>
					<?php endif ?>
					<br>
					<label>Jumlah*</label>
					<input type="number" id="money_rp" name="money" class="form-control hidden-xl-down" placeholder="Jumlah uang yang ditranfer" required>
					<div class="input-group ">
						<span class="input-group-addon" id="sizing-addon3">Rp</span>
						<input type="text" class="form-control money" placeholder="Jumlah uang yang ditranfer">
					</div>
					<br>
					<label>Nama*</label>
					<input type="text" name="name" class="form-control" placeholder="Nama sesuai buku tabungan" required>
					<br>
					<label>Rekening Bank Anda*</label>
					<div class="row">
						<div class="col-lg-4 ">
							<select class="form-control" name="bank" required>
								<option>-Pilih Bank-</option>
								<option value="BCA">BCA</option>
								<option value="BNI">BNI</option>
								<option value="CIMB Niaga">CIMB Niaga</option>
								<option value="Mandiri">Mandiri</option>
								<option value="Bank lain">Bank lain</option>
							</select>
						</div>
						<div class="col-lg-8 ">
							<input type="text" name="norek" class="form-control " placeholder="Nomor Rekening" required>
						</div>
					</div>
					<br>
					<label>Tanggal Transfer*</label>
					<input name="date" type="text" class="form-control" id="datepick" placeholder="dd/mm/yyyy" required>
					<br>
					<div class="row">
						<div class="col-lg-4">
							<label>Bukti Transfer*</label> <br>
							<span>Gambar(.jpg)/File(.pdf)</span>
							<input type="file" id="uploadBtn" name="fileconfirmation" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
							<a href="#" id="filetext" name="file" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
						</div>
						<div class="col-lg-4">
							<img src="" class="blah img-fluid">
						</div>
					</div>
					<br>
					<?php if (count($listorder) > 0) : ?>
						<button class="btn btnnew form-control proccessshow" modal-text="Data Anda sedang disimpan" type="submit">Konfirmasi</button>
					<?php else : ?>
						<small class="m-b-1">*Anda belum mememiliki pesanan</small>
						<a class="btn btnnew form-control" href="<?php echo base_url() ?>member/history">Lihat Pesanan</a>
					<?php endif ?>
					<br>
				</form>
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
								<li>Pesanan yang melebihi masa jatuh tempo pembayaran dan belum dibayar dan dikonfirmasi pembayarannya,Pesanan akan otomatis dihapus oleh sistem administrasi kami.</li>
								<li>Harap isi dengan benar form yang tersedia.</li>
							</ul>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>