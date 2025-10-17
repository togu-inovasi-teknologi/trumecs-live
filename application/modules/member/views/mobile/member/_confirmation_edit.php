<div class="row historypesanan">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="card col-md-12 p-a-1 text-center">
		<strong class="f22">Konfirmasi Pembayaran</strong>
	</div>
	<hr>
	<div class="card col-md-12 p-a-1">
		<form class="formconfirmation" action="<?php echo base_url() ?>member/confirmationupdate" method="POST" enctype="multipart/form-data">
			<div class="col-md-12">
				<label class="fbold">ID Order<a style="color: red;">*</a></label>
				<input type="hidden" name="id" value="<?php echo $data["id"] ?>">
				<?php if (count($listorder) > 0) : ?>
					<select name="idorder" class="form-control" required selectid="<?php echo $data["idorder"] ?>">
						<option totalbayar="0" value="">Pilih order</option>
						<?php foreach ($listorder as $key) : ?>
							<option totalbayar="<?php echo number_format($key["totalbayar"]) ?>" value="<?php echo $key["iduniq"] ?>"><?php echo $key["iduniq"] ?></option>
						<?php endforeach ?>
					</select>
					<small class="harusbayar"></small>
				<?php else : ?>
					<small>Anda belum mememiliki pesanan</small>
				<?php endif ?>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Jumlah<a style="color: red;">*</a></label>
				<input value="<?php echo $data["money"] ?>" type="number" id="money_rp" name="money" class="form-control hidden-xl-down" placeholder="Jumlah uang yang ditranfer" required>
				<div class="input-group ">
					<span class="input-group-addon" id="sizing-addon3">Rp</span>
					<input value="<?php echo $data["money"] ?>" type="text" class="form-control money" placeholder="Jumlah uang yang ditranfer">
				</div>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Nama<a style="color: red;">*</a></label>
				<input value="<?php echo $data["name"] ?>" type="text" name="name" class="form-control" placeholder="Nama sesuai buku tabungan" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Rekening Bank Anda<a style="color:red;">*</a></label>
				<select class="form-control" name="bank" required selectid="<?php echo $data["bank"] ?>">
					<option>-Pilih Bank-</option>
					<option value="BCA">BCA</option>
					<option value="BNI">BNI</option>
					<option value="CIMB Niaga">CIMB Niaga</option>
					<option value="Mandiri">Mandiri</option>
					<option value="Bank lain">Bank lain</option>
				</select>
				<input value="<?php echo $data["norek"] ?>" type="text" name="norek" class="form-control " placeholder="Nomor Rekening" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Tanggal Transfer<a style="color:red;">*</a></label>
				<input name="date" value="<?php echo substr($data["date"], 0, 10) ?>" type="text" class="form-control" id="datepick" placeholder="dd/mm/yyyy" required>
			</div>
			<div class="col-md-12 m-t-1">
				<label class="fbold">Bukti Transfer<a style="color: red;">*</a></label> <br>
				<small>Gambar(.jpg)/File(.pdf)</small>
				<input type="file" id="uploadBtn" name="fileconfirmation" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
				<img src="<?php echo base_url() ?>public/image/member/confirmation/<?php echo $data["img"] ?>" class="blah img-fluid">
				<input type="hidden" name="img_old" value="<?php echo $data["img"] ?>">
				<input type="hidden" name="img_new">
				<br>
				<a href="#" id="filetext" name="file" class="btn btnnew" style="cursor: pointer;">Pilih file</a>
			</div>
			<div class="col-md-12 m-t-1">
				<?php if (count($listorder) > 0) : ?>
					<button class="btn btnnew form-control proccessshow" modal-text="Data Anda sedang disimpan" type="submit">Konfirmasi</button>
				<?php else : ?>
					<a class="btn btnnew form-control" href="<?php echo base_url() ?>member/history">Lihat Pesanan</a>
					<small>Anda belum mememiliki pesanan</small>
				<?php endif ?>
			</div>
		</form>
	</div>
	<div class="col-md-12">
		<div class="alert alert-warning pull-right">
			<small>
				Catatan:
				<ul>
					<li>Pesanan yang melebihi masa jatuh tempo pembayaran dan belum dibayar dan dikonfirmasi pembayarannya,Pesanan akan otomatis dihapus oleh sistem administrasi kami.</li>
					<li>Harap isi dengan benar form yang tersedia.</li>
				</ul>
			</small>
		</div>
	</div>
</div>