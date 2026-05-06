<div class="galery mt-4">
	<div class="row">
		<div class="col-md-7">
			<strong class="fw-bold" style="font-size: 1.1rem;">Galery Produk <?php echo $product["tittle"] ?></strong>
		</div>
		<div class="col-md-5 <?php echo (!$this->agent->is_mobile()) ? "text-end" : ""; ?>">
			<form action="<?php echo base_url() ?>backendproduct/addgalery/" method="POST" enctype="multipart/form-data" class="d-flex flex-wrap gap-2 align-items-center justify-content-md-end">
				<div class="mb-2 mb-md-0">
					<input type="file" class="form-control form-control-sm" id="file" name="filegalery" required>
					<input type="hidden" name="id" value="<?php echo $product["id"] ?>" required>
				</div>
				<?php if (count($product["galery"]) <= 4): ?>
					<button class="btn btn-sm btn-warning" type="submit">Tambah Galery</button>
				<?php endif ?>
			</form>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 mb-3 mb-md-0">
			<strong class="d-block mb-2">Main Image Product</strong>
			<?php
			$filename = 'public/image/product/' . $product["img"];
			if (file_exists($filename)) {
				echo '<a href="' . base_url() . 'public/image/product/' . $product["img"] . '" target="_blank">
			    		<img src="' . base_url() . 'public/image/product/' . $product["img"] . '" class="img-fluid rounded" style="max-height: 300px; width: auto;">
			    	</a>';
			} else {
				echo "<div class='alert alert-warning small'>tidak ada file $filename</div>";
			}
			?>
		</div>

		<div class="col-md-6">
			<strong class="d-block mb-2">Galery Product</strong>
			<div class="row g-2">
				<?php
				foreach ($product["galery"] as $key) {
					$filename = 'public/image/galery/' . $key["img"];
					if (file_exists($filename)) {
						echo '<div class="col-6 col-md-6 text-center mb-2">
				    		<a href="' . base_url() . 'public/image/galery/' . $key["img"] . '" target="_blank" class="d-block">
				    			<img src="' . base_url() . 'public/image/galery/' . $key["img"] . '" class="img-fluid rounded" style="max-height: 150px; width: auto;">
				    		</a>
				    		<a href="' . base_url() . 'backendproduct/hapusgalery?id=' . $key["id"] . '&im=' . $key["img"] . '" class="btn btn-link btn-sm text-danger text-decoration-none mt-1" onclick="return confirm(\'Yakin ingin menghapus gambar ini?\')">Hapus</a>
				    	</div>';
					} else {
						echo "<div class='col-12'><div class='alert alert-warning small'>tidak ada file $filename</div></div>";
					}
				}
				?>
			</div>
		</div>
	</div>
</div>