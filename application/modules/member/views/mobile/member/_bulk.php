<div class="row historypesanan">
	<div class="col-xs-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="clearfix"></div>
	<div class="card col-xs-12" style="padding: 10px;">
		<div class="row">
			<div class="col-xs-8">
				<strong class="f16">Cara Baru Berbelanja</strong>
			</div>
			<div class="col-xs-4 text-right">
				<a class="btn btn-success-outline f12 fbold" href="<?php echo base_url() ?>bulk" style="border-radius: 20px;"><i class="fa fa-download"></i> Excel</a>
			</div>
		</div>
		<div class="col-xs-12 m-t-2">
			<div class="row">
				<div class="col-xs-4 text-center">
					<img src="<?php echo site_url('public/image/list-icon.png'); ?>" width="30" /><br /><br />
					<p class="fbold f12 lsp">Unggah daftar barang</p>
					<p class="text-muted lsp" style="font-size: 8px;">Buat daftar item yang diinginkan dalam format Excel dan unggah melalui form yang tersedia di atas ini</p>
				</div>
				<div class="col-xs-4 text-center">
					<img src="<?php echo site_url('public/image/coffee-icon.png'); ?>" width="30" /><br /><br />
					<p class="fbold f12 lsp">Tunggu 2 - 3 hari</p>
					<p class="text-muted lsp" style="font-size: 8px;">Tim Trumecs akan memproses daftar kamu. Selama menunggu kamu bisa mengerjakan hal yang lebih penting</p>
				</div>
				<div class="col-xs-4 text-center">
					<img src="<?php echo site_url('public/image/envelope-icon.png'); ?>" width="30" /><br /><br />
					<p class="fbold f12 lsp">Penawaran dikirimkan</p>
					<p class="text-muted lsp" style="font-size: 8px;">Trumecs akan mengirimkan penawaran dari daftar barang yang sudah diunggah untuk bisa kamu review</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 m-b-1">
		<a class="btn btnnew btn-block" href="<?php echo base_url() ?>bulk">Tambah RFQ</a>
	</div>
	<div class="card col-xs-12 p-a-1 text-center">
		<strong class="f22">Daftar RFQ</strong>
	</div>
	<div class="card col-xs-12">
		<?php
		$i = 1;
		?>
		<?php foreach ($list as $key) : ?>
			<?php
			$status = ($key["status"] != 1) ? ($key["status"] == 2) ?  "Ditolak" : "Menunggu" : "Selesai";
			$status_css = ($key["status"] != 1) ? ($key["status"] == 2) ?  "danger" : "warning" : "success";
			?>
			<div class="row">
				<div class="col-xs-12  col-md-8  p-y-1">
					<strong>#<?php echo $key["id"] ?></strong>
					<span class="label status-<?php echo $status ?>"><?php echo $status ?></span><br />
					<small><?php echo date("d M Y", $key["created_at"]) ?></small><br /><br />
					<b><?php echo $key["name"] ?></b> - <b>[<?php echo $key["company"] ?>]</b><br />
					<small>Telp: <?php echo $key["phone"] ?></small><br />
					<small><?php echo $key["address"] ?> <?php echo $key["village"] ?> <?php echo $key["district"] ?> <?php echo $key["city"] ?> <?php echo $key["province"] ?></small>,
					<small><?php echo $key["zipcode"] ?></small><br /><br />
					<small><b>Berkas:</b></small><br />
					<?php foreach ($key['files'] as $keys) : ?>
						<a href="<?php echo base_url('public/sourcing/' . $keys['filename']); ?>"><small><?php echo $keys['filename']; ?></small></a><br />
					<?php endforeach; ?>
					<?php echo $key["note"] ? "<br/><small><b>Catatan Pengguna:</b><br/>" . $key["note"] . "</small>" : "" ?>
				</div>
				<div class="col-xs-12 col-md-4  p-y-1 btn-success text-center">
					<small><?php echo $key["updated_at"] != 0 ? date("d M Y", $key["updated_at"]) : '<span class="fbold">Belum ada respon dari admin</span>' ?></small><br />
					<small><?php echo $key["admin_note"] != "" ? "Catatan Admin: <br/>" . $key["admin_note"] : '' ?></small><br>
					<?php if ($key["status"] == 1) : ?><a href="<?php echo site_url('public/filequotation/' . $key["offer"]); ?>" class="btn btnnew"><i class="fa fa-download"></i> Download</a><br /><?php endif; ?>
				</div>
			</div>
			<hr class="row p-y-0 m-y-0">
			<?php $i++ ?>
		<?php endforeach ?>

	</div>
</div>
<style>
	.lsp {
		line-height: 15px;
	}

	.status-Menunggu {
		background-color: transparent;
		border: solid;
		border-color: orange;
		color: orange;
		font-size: 8px;
	}

	.status-Ditolak {
		background-color: transparent;
		border: solid;
		border-color: red;
		color: red;
		font-size: 8px;
	}

	.status-Selesai {
		background-color: transparent;
		border: solid;
		border-color: green;
		color: green;
		font-size: 8px;
	}
</style>