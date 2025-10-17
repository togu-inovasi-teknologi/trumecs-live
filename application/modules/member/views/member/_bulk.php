<div class="row historypesanan">
	<div class="col-xs-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-xs-6">
		<strong class="f22">RFQ Saya</strong>
	</div>
	<div class="col-xs-6 text-right">
		<a class="btn btn-orange" href="<?php echo base_url() ?>bulk">Buat Baru</a>
	</div>
	<div class="clearfix"></div>
	<hr>
	<div class="col-md-12">
		<div class="row text-center hidden-xs">
			<div class="col-xs-12 col-md-8 text-center">Permintaan</div>
			<div class="col-xs-12 col-md-4 text-center">Respon</div>
		</div>
		<hr class="row m-b-0">
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
				<div class="col-xs-12 col-md-4  p-y-1 btn-success" style="">
					<?php if ($key["status"] == 1) : ?><a href="<?php echo site_url('public/filequotation/' . $key["offer"]); ?>">Download</a><br /><?php endif; ?>
					<small><?php echo $key["updated_at"] != 0 ? date("d M Y", $key["updated_at"]) : '<span class="fbold">Belum ada respon dari admin</span>' ?></small><br />
					<small><?php echo $key["admin_note"] != "" ? "Catatan Admin: <br/>" . $key["admin_note"] : '' ?></small>
				</div>
			</div>
			<hr class="row p-y-0 m-y-0">
			<?php $i++ ?>
		<?php endforeach ?>

	</div>
</div>