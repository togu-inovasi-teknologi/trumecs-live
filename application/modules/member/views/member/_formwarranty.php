<div class="row historypesanan">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="col-md-12">
		<strong class="f22">Form Klaim Garansi</strong>
		<hr>
	</div>
	<div class="col-md-12 ">
		<form class="formreturn" action="<?php echo base_url() ?>member/sentclaimwarranty" method="POST">
			<div class="row ">
				<div class="col-md-3">
					Id Order*
				</div>
				<div class="col-md-9">
					<?php if (count($listorder) > 0) : ?>
						<select name="idorder" class="form-control" required>
							<option>-Pilih ID ORDER-</option>
							<?php foreach ($listorder as $key) : ?>
								<option value="<?php echo $key["iduniq"] ?>"><?php echo $key["iduniq"] ?></option>
							<?php endforeach ?>
						</select>
					<?php else : ?>
						<small>Anda belum mememiliki pesanan</small>
					<?php endif ?>
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Pilih Produk*
					<br>
					<small>
						<i>Part Number Trumecs <a tabindex="10" style="cursor:pointer" data-html="true" data-container="body" data-trigger="focus" data-toggle="popover" title="" data-content="<img src='<?php echo base_url() ?>public/image/example-partnumbertrumecs.png'>" data-original-title="Part Number Trumecs"><i class="fa fa-question-circle forange"></i></a></i>
					</small>
				</div>
				<div class="col-md-9 productall"></div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Deskripsi Kerusakan*
				</div>
				<div class="col-md-9">
					<textarea required class="form-control" rows="6" name="description" placeholder="Silahkan beri deskripsi selengkap-lengkapnya"></textarea>
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Bukti Pembelian Barang*
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4">
					<span href="" class="evidence1 dot"><i class="fa m-a-1 fa-plus"></i></span>
					<input type="file" name="filegambar" evidence="1" class="form-control " style="">
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					Bukti Kerusakan Barang*
					<small><a tabindex="999" style="cursor:pointer" data-html="true" data-container="body" data-trigger="focus" data-toggle="popover" title="Bukti Kerusakan" data-content="<img src='<?php echo base_url() ?>public/image/example-partchrass.png'>"><i class="fa fa-question-circle forange"></i></a></small>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4">
					<span href="" class="evidence2 dot"><i class="fa m-a-1 fa-plus"></i></span>
					<input type="file" name="filegambar" evidence="2" class="form-control " style=";">
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4">
					<span href="" class="evidence3 dot"><i class="fa m-a-1 fa-plus"></i></span>
					<input type="file" name="filegambar" evidence="3" class="form-control " style="">
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4">
					<span href="" class="evidence4 dot"><i class="fa m-a-1 fa-plus"></i></span>
					<input type="file" name="filegambar" evidence="4" class="form-control " style="">
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4">
					<span href="" class="evidence5 dot"><i class="fa m-a-1 fa-plus"></i></span>
					<input type="file" name="filegambar" evidence="5" class="form-control " style="">
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
			<div class="row ">
				<div class="col-md-3">
					<?php if (count($listorder) > 0) : ?>
						<button class="btn btn-orange form-control proccessshow" modal-text="Klaim Anda sedang disimpan" type="submit">Kirim Klaim</button>
					<?php else : ?>
						<a class="btn btn-orange form-control" href="<?php echo base_url() ?>member/history">Lihat Pesanan</a>
						<small>Anda belum mememiliki pesanan</small>
					<?php endif ?>
				</div>
				<div class="col-md-9">
					<div class="checkbox">
						<label><input type="checkbox" name="agre" value="telah membaca"> <small><strong>Saya Setuju dan Saya telah membeca <a target="_blank" href="<?php echo base_url() ?>page/44/syarat-ketentuan" class="forange">Syarat dan ketentuan Trumecs</a></strong></small><sup>*</sup><br></label>
					</div>
					<small>Catatan:<br>
						<ul>
							<li>Komplain akan direspon pada hari kerja.</li>
							<li>Harap isi dengan benar form yang tersedia.</li>
							<li>Harap memantau perkembangan komplain Anda.</li>
						</ul>
					</small>
				</div>
				<div class="clearfix "></div>
				<hr class="m-x-1">
			</div>
		</form>
	</div>
</div>

<style type="text/css">
	.popover {
		z-index: 99;
	}
</style>