<div class="product">
	<div class="row">
		<div class="col-md-8">
			<strong class="f22">List Order</strong>

		</div>
		<div class="col-md-4 text-right">
			<a class="btn btn-white" data-toggle="collapse" href="#collapseCari" aria-expanded="false" aria-controls="collapseCari">Cari</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
		<div class="col-lg-12 collapse" id="collapseCari">
			<?php $this->load->view("cariform"); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<input type="hidden" name="status" value="<?php echo $this->input->get('status') ?>" />
			<div class="col-xs-12 table-responsive">
				<table id="table-confirm" class="table table-striped table-bordered table-hover" cellspacing="2" width="100%">
					<thead>
						<tr>
							<th>IDORDER<br><small>Pemesan</small></th>
							<th>Tanggal<br><small>Tanggal Tranfer</small></th>
							<th>Bank<br><small>No Rekening</small></th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($listfilter)) : ?>
							<?php foreach ($listfilter as $key) : ?>
								<tr>
									<td><a href="<?php echo base_url() ?>backendconfirm/detail/<?php echo $key["idorder"] ?>" class="fbold f14 forange"><?php echo $key["idorder"] ?></a><br>
										<small><a href="<?php echo base_url() ?>backendmember/detail/<?php echo $key["idmember"] ?>" class="fblack">lihat pemesan</a></small>
									</td>
									<td>
										<span class="fbold f14 black"><?php echo $key["date"] ?></span><br>
										<small class="fbold f12 black"><?php echo $key["datetranfer"] ?></small>
									</td>
									<td>
										<span class="fbold f14 black"><?php echo $key["bank"] ?></span><br>
										<small class="fbold f12 black"><?php echo $key["norek"] ?></small>
									</td>
									<td>
										<span class="fbold f14 black label label-<?php echo ($key["status"] != "rejected") ? ($key["status"] != "new") ? "success" : "warning" : "danger"; ?>"><?php echo $key["status"] ?></span><br>
									</td>
								</tr>
							<?php endforeach ?>
						<?php else : ?>
							<tr>
								<td colspan="9">Tidak ada data</td>
							</tr>
						<?php endif ?>

					</tbody>
				</table>
			</div>
			<!--<div class="col-xs-12 text-center">
			<?php echo !empty($listfilter) ? $links : "";  ?> 
		</div>-->
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