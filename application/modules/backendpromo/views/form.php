<?php 
//$id = $this->input->get("id");
if (!empty($id)) {
	$expolde = explode(",", $detail["product"]);
}else{
	$expolde=array();
}


 ?>
<div class="form">
	<div class="col-md-12 m-t-3">
		<strong class="f22">Form Input Promo</strong>
		<hr>
	</div>
	<div class="col-md-6">
		<form action="<?php echo base_url() ?>backendpromo/<?php echo (!empty($id)) ? "update" : 'input'; ; ?>" method="POST">
			<div class="row">
				<span>Judul</span>
				<?php if (!empty($id)): ?>
					<input class="form-control" name="id" type="hidden" value="<?php echo $detail["id"] ?>">
				<?php endif ?>
				<input type="text" name="name" class="form-control" placeholder="Judul" required
				value="<?php echo (!empty($id)) ? $detail["name"] : ''; ; ?>"
				>
				<hr>
			</div>
			<div class="row">
				<span>Tanggal Mulai</span>
				<input type="date" name="start_date" class="form-control" placeholder="Tanggal mulai" required
				value="<?php echo (!empty($id)) ? date("Y-m-d", $detail["start_date"] ): ''; ; ?>"
				>
				<hr>
			</div>
			<div class="row">
				<span>Tanggal Berakhir</span>
				<input type="date" name="end_date" class="form-control" placeholder="Tanggal berakhir" required
				value="<?php echo (!empty($id)) ? date("Y-m-d", $detail["end_date"] ) : ''; ?>"
				>
				<hr>
			</div>
			<div class="row">
				<span>Deskripsi</span>
				<textarea name="description" class="form-control"><?php echo (!empty($id)) ? $detail["description"] : ''; ; ?></textarea>
			</div>
			<div class="row">
				<span>produk</span>
				<progress class="progress progress-striped progress-danger" value="<?php echo count($expolde) ?>" max="100"><?php echo count($expolde) ?>%</progress>
				<input class="form-control" name="product" type="hidden" value="<?php echo (!empty($id)) ? $detail["product"] : ''; ; ?>">
			</div>
			<div class="row">
			<span>gambar</span><br>
			<label class="file">
			  <input type="file" id="file" name="filegambar" <?php echo (empty($this->input->get("id"))) ? "required" : "" ;; ?> >
			  <span class="file-custom"></span>
			</label>
			<hr>
			<div class="tampung">
				<?php echo (!empty($id)) ?'<img src="'.base_url().'public/image/promo/'.$detail["img"].'" class="img-fluid">': '';  ?>
				<?php if (!empty($id)): ?>
					<input type="hidden" class="form-control" name="asknew" value="" >
				<?php endif ?>
			</div>
			<?php if (!empty($id)): ?>
					<input type="hidden" class="form-control" name="txtfilegambarold" value="<?php echo (!empty($id)) ? $detail["img"] : ''; ; ?>" >
			<?php endif ?>
			<hr>
		</div>
			<div class="row">
				<hr>
				<button type="submit" class="btn btn-orange">Simpan</button>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<div class="table card p-a-1">
			<?php if (!empty($id)): ?>
				<input name="id-promo" type="hidden" value="<?php echo $detail['id'] ?>" />
			<table class="table" id="table-produk-promo">
				<thead>
					<tr>
						<th>Tambah?</th>
						<th>Nama Produk<br><small>part number</small></th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach ($product as $keyprod): ?>
					<tr>
						<td>
							<form action="<?php echo base_url() ?>backendpromo/<?php echo in_array($keyprod["id"], $expolde) ? 'hapus' : 'add' ?>productpromo" method="POST">
								<?php echo (!empty($id)) ? '<input type="hidden" name="id" value="'.$id.'">' : ''; ; ?>
								<?php echo (!empty($id)) ? '<input type="hidden" name="product" value="'.$detail["product"].'">' : ''; ; ?>
								<?php echo (!empty($id)) ? '<input type="hidden" name="newproduct" value="'.$keyprod["id"].'">' : ''; ; ?>
								<?php if (in_array($keyprod["id"], $expolde)): ?>
									<button class="btn btn-danger">Promo</button>
								<?php else: ?>
									<button class="btn btn-orange">Tambah</button>
								<?php endif ?>
							</form>
						</td>
						<td><?php echo $keyprod["tittle"] ?><br>
							<small><?php echo $keyprod["partnumber"] ?></small>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<?php else: ?>
				<div class="alert alert-danger">
					Harap membuat promo terlebih dahulu, setelah itu tambah kan produk yang di promosikan
				</div>
			<?php endif ?>
		</div>

	</div>
</div>