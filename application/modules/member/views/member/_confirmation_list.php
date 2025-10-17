<div class="row historypesanan">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="col-md-6">
		<strong class="f22">List Konfirmasi Pembayaran</strong>
	</div>
	<div class="col-md-6 text-right">
		<a class="btn btn-orange" href="<?php echo base_url() ?>member/confirmation">Konfirmasi Pembayaran</a>
	</div>
	<div class="col-md-12">
		<hr>
		<table class="table table-hover table-sm ">
			<thead>
				<tr>
					<th>No.</th>
					<th>ID Order</th>
					<th>Tanggal</th>
					<th>Jumlah</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				?>
				<?php foreach ($list as $key) : ?>
					<?php
					$status = $key["status"];
					$status_css = ($key["status"] != "approved") ? ($key["status"] == "rijected") ?  "danger" : "warning" : "success";
					?>
					<tr scope="row">
						<td><?php echo $i ?></td>
						<td><?php echo $key["idorder"] ?></td>
						<td><?php echo $key["date"] ?></td>
						<td>Rp.<?php echo number_format($key["money"]) ?></td>
						<td><span class="label label-<?php echo $status_css ?>"><?php echo $status ?></span></td>
						<td>
							<?php if ($key["status"] == "new") : ?>
								<a href="<?php echo base_url() ?>member/confirmation_edit/<?php echo $key["id"] ?>" class="label label-warning">edit</a>
							<?php endif ?>
						</td>
					</tr>
					<?php $i++ ?>
				<?php endforeach ?>

			</tbody>
		</table>
	</div>
</div>