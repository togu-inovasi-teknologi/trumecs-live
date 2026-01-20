<div class="product d-block d-lg-none">
	<div class="row align-items-center mb-3">
		<div class="col-8">
			<strong class="fs-5">List Artikel</strong>
		</div>
		<div class="col-4 text-end">
			<?php
			$segment2 = $this->uri->segment(2);
			$isMyArtikel = ($segment2 == "myartikel");
			$baseUrl = base_url() . 'backendartikel/';

			if ($isMyArtikel) {
				$baseUrl .= 'myartikel/';
			}
			?>
			<a href="<?php echo $baseUrl; ?>form" class="btn btn-warning btn-sm">Tambah</a>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<hr class="my-2">
		</div>
	</div>

	<div class="row">
		<div class="col-12">

			<div class="table-responsive">
				<table id="table-<?php echo $isMyArtikel ? "myartikel" : "artikel" ?>" class="table table-sm" style="width:100%">
					<thead>
						<tr>
							<th>Judul</th>
							<th>Dibuat</th>
							<th>Diupdate</th>
							<th>Dilihat</th>
							<th>Penulis</th>
							<th>Display?</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="7" class="text-center">Sedang menarik data</td>
						</tr>
					</tbody>
				</table>
			</div>

			<!-- Mobile Pagination Controls -->
			<div class="d-flex justify-content-between align-items-center mt-3">
				<div class="small text-muted" id="mobilePageInfo">Memuat...</div>
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-outline-secondary" id="mobilePrevBtn" disabled>
						<i class="bi bi-chevron-left"></i>
					</button>
					<button type="button" class="btn btn-outline-secondary" id="mobileNextBtn" disabled>
						<i class="bi bi-chevron-right"></i>
					</button>
				</div>
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