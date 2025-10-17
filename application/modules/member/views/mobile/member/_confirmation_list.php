<div class="row historypesanan">
	<?php echo ($this->session->flashdata('message') == "") ? "" :
		'<div class="alert alert-warning f14 text-center">' .
		$this->session->flashdata('message') .
		'</div>'; ?>
	<div class="col-md-12 card p-a-1 text-center">
		<strong class="f22">List Konfirmasi Pembayaran</strong>
	</div>
	<div class="text-center">
		<a class="btn btnnew btn-block" href="<?php echo base_url() ?>member/confirmation">Konfirmasi Pembayaran</a>
	</div>
	<br>
	<?php
	$i = 1;
	?>
	<?php foreach ($list as $key) : ?>
		<?php
		$status = $key["status"];
		$status_css = ($key["status"] != "approved") ? ($key["status"] == "rijected") ?  "danger" : "warning" : "success";
		?>
		<div class="card p-a-1 fbold">
			<p class="f12 t-a-r"><?php echo $i ?></p>
			<p class="f12">No: </p>
			<p class="f12 t-a-r"><?php echo $key["idorder"] ?></p>
			<p class="f12">ID Order: </p>
			<p class="f12 t-a-r"><?php echo $key["date"] ?></p>
			<p class="f12">Tanggal :</p>
			<p class="f12 t-a-r">Rp. <?php echo number_format($key["money"]) ?></p>
			<p class="f12">Jumlah:</p>
			<p class="f12">Status: <span class="label label-<?php echo $status_css ?>" style="float: right;"><?php echo $status ?></span></p>
			<?php if ($key["status"] == "new") : ?>
				<a href="<?php echo base_url() ?>member/confirmation_edit/<?php echo $key["id"] ?>" class="label label-warning">edit</a>
			<?php endif ?>
		</div>
		<hr>
		<?php $i++ ?>
	<?php endforeach ?>
</div>

<style type="text/css">
	.t-a-l {
		text-align: left;
		float: left;
	}

	.t-a-r {
		text-align: right;
		float: right;
	}
</style>