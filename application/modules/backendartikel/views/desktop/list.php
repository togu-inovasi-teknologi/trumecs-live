<div class="product">
	<div class="row align-items-center mb-4">
		<div class="col-md-9">
			<strong class="fs-4">List Artikel</strong>
		</div>
		<div class="col-md-3 text-md-end">
			<?php
			$segment2 = $this->uri->segment(2);
			$isMyArtikel = ($segment2 == "myartikel");
			$baseUrl = base_url() . 'backendartikel/';

			if ($isMyArtikel) {
				$baseUrl .= 'myartikel/';
			}
			?>
			<a href="<?php echo $baseUrl; ?>form" class="btn btn-warning">Tambah Artikel</a>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<hr>
		</div>
	</div>

	<div class="row d-none d-lg-block">
		<div class="col-12">
			<div class="table-responsive">
				<table id="table-<?php echo $isMyArtikel ? "myartikel" : "artikel" ?>" class="table table-striped table-bordered table-hover display compact w-100">
					<thead class="table-dark">
						<tr>
							<th class="align-middle">Judul</th>
							<th class="align-middle text-center">Dibuat</th>
							<th class="align-middle text-center">Diupdate</th>
							<th class="align-middle text-center">Dilihat</th>
							<th class="align-middle text-center">Penulis</th>
							<th class="align-middle text-center">Display?</th>
							<th class="align-middle text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($listfilter)): ?>
							<?php foreach ($listfilter as $key): ?>
								<tr>
									<td class="align-middle">
										<a href="<?php echo base_url() ?>backendartikel/<?php echo $isMyArtikel ? "myartikel/" : "" ?>form?id=<?php echo $key["id"] ?>" class="fw-bold text-warning text-decoration-none">
											<?php echo htmlspecialchars($key["title"]) ?>
										</a>
									</td>
									<td class="align-middle text-center"><?php echo htmlspecialchars($key["date"]) ?></td>
									<td class="align-middle text-center"><?php echo htmlspecialchars($key["date"]) ?></td>
									<td class="align-middle text-center"><?php echo htmlspecialchars($key["view"]) ?></td>
									<td class="align-middle text-center"><?php echo htmlspecialchars($key["author"] ?? '') ?></td>
									<td class="align-middle text-center">
										<div class="form-check form-switch d-flex justify-content-center">
											<input class="form-check-input" type="checkbox" role="switch" checked>
										</div>
									</td>
									<td class="align-middle text-center">
										<div class="btn-group" role="group">
											<a href="<?php echo base_url() ?>backendartikel/<?php echo $isMyArtikel ? "myartikel/" : "" ?>form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-outline-warning border-end-0">
												<i class="bi bi-pencil"></i>
											</a>
											<a href="<?php echo base_url() ?>backendartikel/<?php echo $isMyArtikel ? "myartikel/" : "" ?>hapus?id=<?php echo $key["id"] ?>"
												onclick="return confirm('Apakah anda yakin ingin menghapus artikel <?php echo addslashes($key['title']) ?>?')"
												class="btn btn-sm btn-outline-danger border-start-0">
												<i class="bi bi-trash"></i>
											</a>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td colspan="7" class="text-center py-4">
									<div class="text-muted">Tidak ada data artikel</div>
								</td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function hapus(url, name) {
		var txt = "Apakah anda yakin ingin menghapus artikel " + name + "?";
		var r = confirm(txt);
		if (r == true) {
			window.location.href = "<?php echo base_url() ?>backendproduct/<?php echo $isMyArtikel ? "myartikel/" : "" ?>hapus?id=" + url;
		}
	}
</script>