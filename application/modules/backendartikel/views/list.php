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

	<div class="row">
		<div class="col-12">
			<div class="table-responsive">
				<table id="table-<?php echo $isMyArtikel ? "myartikel" : "artikel" ?>" class="table table-striped table-bordered table-hover display compact" width="100%">
					<thead class="table-dark">
						<tr>
							<th>Judul</th>
							<th>Dibuat</th>
							<th>Diupdate</th>
							<th>Dilihat</th>
							<th>Penulis</th>
							<!--<th>Edit</th>-->
							<th>Display?</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!--
                    <?php if (!empty($listfilter)): ?>
                        
                    <?php foreach ($listfilter as $key): ?>
                    <tr>
                      <td>
                          <a href="<?php echo base_url() ?>backendartikel/<?php echo $isMyArtikel ? "myartikel/" : "" ?>form?id=<?php echo $key["id"] ?>" class="fw-bold text-warning text-decoration-none">
                              <?php echo $key["title"] ?>
                          </a>
                      </td>
                      <td><?php echo $key["date"] ?></td>
                      <td><?php echo $key["date"] ?></td>
                      <td><?php echo $key["view"] ?></td>
                      <td><?php echo $key["view"] ?></td>
                      <td>
                          <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" checked>
                          </div>
                      </td>
                      <td>
                          <div class="btn-group" role="group">
                              <a href="<?php echo base_url() ?>backendartikel/<?php echo $isMyArtikel ? "myartikel/" : "" ?>form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-outline-warning">
                                  <i class="bi bi-pencil"></i>
                              </a>
                              <a href="<?php echo base_url() ?>backendartikel/<?php echo $isMyArtikel ? "myartikel/" : "" ?>hapus?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-outline-danger">
                                  <i class="bi bi-trash"></i>
                              </a>
                          </div>
                      </td>
                    </tr>
                    <?php endforeach ?>
                    <?php else: ?>
                    <tr><td colspan="7" class="text-center">Tidak ada data</td></tr>
                    <?php endif ?>
                    -->
						<tr>
							<td colspan="7" class="text-center">Sedang menarik data</td>
						</tr>
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