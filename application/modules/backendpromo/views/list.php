<div class="product">
	<div class="row m-t-3">
		<div class="col-md-9">
			<strong class="f22">List Promo</strong>
		</div>
		<div class="col-md-3">
			<a href="<?php echo base_url() ?>backendpromo/form" class="btn btn-orange">Tambah Promo</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<input type="hidden" name="status" value="<?php echo $this->input->get('status') ?>" />
		<div class="col-xs-12 table-responsive">
			<table id="table-promo" class="table table-striped table-bordered table-hover" cellspacing="2" width="100%">
				<thead>
					<tr>
						<th>Judul</th>
						<th>Total Produk</th>
						<th>Edit</th>
						<th>Hapus</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($listfilter)): ?>

						<?php foreach ($listfilter as $key): ?>
							<tr>
								<td><a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $key["id"] ?>" class="fbold f14 forange"><?php echo $key["name"] ?></a><br>
								</td>
								<td>
									<?php
									$explode = explode(",", $key["product"]);
									echo count($explode);
									?>
								</td>
								<td>
									<a href="<?php echo base_url() ?>backendpromo/form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
								</td>
								<td>
									<a href="<?php echo base_url() ?>backendpromo/hapuspromo?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="9">Tidak ada data</td>
						</tr>
					<?php endif ?>

				</tbody>
			</table>
		</div>

	</div>
</div>
<script type="text/javascript">
	function hapus(url, name) {
		var txt = "Apakah anda yakin ingin menghapus produk " + name + "?";
		var r = confirm(txt);
		if (r == true) {
			window.location.href = "<?php echo base_url() ?>backendproduct/hapus?id=" + url;
		}
	};
</script>