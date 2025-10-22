<!-- info card akun -->
<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];
?>
<div class="row d-flex flex-column gap-3">
	<div class="col-lg d-flex-sb align-items-center">
		<h3 class="fbold">Produk</h3>
		<a href="<?php echo base_url() ?>member/store/store_addproduct" class="btn btnnew">Tambah
			Produk</a>
	</div>
	<div class="col-lg">
		<div class="card p-a-1 f14">
			<div class="row p-x-1">
				<div class="col-lg table-responsive">
					<input type="hidden" name="store" value="<?= $store[0]['id'] ?>">
					<table class="table table-bordered table-striped f14" style="width: 100%; vertical-align:middle;" id="tablelist-product">
						<thead>
							<tr>
								<th class="text-center" style="width: 2%;">No.</th>
								<th class="text-center" style="width: 35%;">Nama Produk</th>
								<th class="text-center" style="width: 25%;">Harga</th>
								<th class="text-center" style="width: 10%;">Satuan</th>
								<th class="text-center" style="width: 7%;">Stock</th>
								<th class="text-center" style="width: 5%;">Status</th>
								<th class="text-center" style="width: 13%;">Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php foreach ($product as $value) : ?>
	<div class="modal fade" id="edit-product-<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title fbold" id="exampleModalLabel"><i class="fa fa-info-circle forange"></i> Edit Produk
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h6>
				</div>
				<form action="<?= base_url() ?>member/store/editProduct" method="post">
					<div class="modal-body" style="max-height: 40vh; overflow:scroll;">
						<div class="row d-flex flex-column gap-3">
							<!-- <div class="col-xs-12 d-flex flex-column gap-0">
								<label for="image" class="fbold">Foto Produk</label>
								<div class="d-flex-sb">
									<img src="<?= base_url() ?>public/image/product/<?= $value['img']; ?>" alt="<?= $value['img'] ?>" style="width:15%;">
								</div>
							</div> -->
							<div class="col-xs-12">
								<input type="hidden" value="<?= $value['id']; ?>" name="id_product" />
								<label for="nameProduct" class="fbold">Nama Produk</label>
								<input name="nameProduct" class="form-control" id="nameProduct" type="text" value="<?= $value['tittle']; ?>">
							</div>
							<div class="col-xs-12">
								<label for="priceProduct" class="fbold">Harga Produk</label>
								<div class="input-group">
									<span class="input-group-addon">Rp</span>
									<input name="priceProduct" class="form-control uang" id="priceProduct" type="text" value="<?= $value['price']; ?>">
								</div>
							</div>
							<div class="col-xs-12">
								<label for="stockProduct" class="fbold">Stock Produk</label>
								<input name="stockProduct" class="form-control" id="stockProduct" type="text" value="<?= $value['stock']; ?>">
							</div>
							<div class="col-xs-12">
								<label for="statusProduct" class="fbold">Status</label>
								<select name="statusProduct" id="statusProduct" class="form-control">
									<option value="draft" <?= $value['status'] == 'draft' ? "selected" : "" ?>>Draft</option>
									<option value="show" <?= $value['status'] == 'show' ? "selected" : "" ?>>Show</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button class="btn btnnew">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<?php foreach ($product as $value) : ?>
	<div class="modal fade" id="delete-product-<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title fbold" id="exampleModalLabel"><i class="fa fa-times-circle fred"></i> Delete Produk
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h6>
				</div>
				<form action="<?= base_url() ?>member/store/deleteProduct" method="post">
					<div class="modal-body d-flex flex-column gap-3 align-items-center">
						<img src="<?php echo base_url() ?>public/image/delete-product.jpg" alt="delete-product" class="w-50">
						<div class="alert alert-warning m-b-0">
							<input type="hidden" value="<?= $value['id']; ?>" name="id_product" />
							<p class="">Apakan anda yakin untuk menghapus produk <span class="fbold forange"><?= $value['tittle']; ?></span></p>
						</div>
					</div>
					<div class="modal-footer">
						<div class="d-flex-sb">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btnnewred">Delete</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>