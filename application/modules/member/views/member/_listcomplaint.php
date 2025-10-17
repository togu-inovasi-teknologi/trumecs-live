<div class="row historypesanan">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>

	</div>
	<div class="col-md-6">
		<strong class="f22">Klaim Return</strong>
	</div>
	<div class="col-md-6 text-right">
		<a class="btn btn-orange" href="<?php echo base_url() ?>member/formreturn">Ajukan Klaim</a>
	</div>
	<div class="col-md-12 ">
		<hr>
		<table class="table table-hover tbl-claim">
			<thead>
				<tr>
					<th>Id Order</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Klaim</th>
					<th>Catatan Admin</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listcomplaint as $key) : ?>
					<tr>
						<td><a class=" forange fbold" href="<?php echo base_url() ?>member/history_order/<?php echo ($key["idorder"]) ?>"><?php echo $key["idorder"] ?></a></td>
						<td><?php echo $key["datecomplaint"] ?></td>
						<td><?php echo $key["status"] ?></td>
						<td><a tabindex="1000" data-html="true" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Klaim Return" data-content="Produk:<br><?php echo $key["product"] ?><hr>Deskripsi:<br><?php echo $key["description"] ?><hr>Pernyataan:<br><?php echo $key["statement"] ?><br>" class="label label-warning">baca</a></td>
						<td>
							<?php if ($key["commentadmin"] != NULL) : ?>
								<a tabindex="1000" data-html="true" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Komentar Admin" data-content="<?php echo ($key["commentadmin"]) ?>" class="label label-warning">baca</a>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<style type="text/css">
	.tbl-claim {
		z-index: 90;
	}

	.popover {
		z-index: 99;
	}
</style>