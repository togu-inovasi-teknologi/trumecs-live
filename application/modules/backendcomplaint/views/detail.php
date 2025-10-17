<?php 

	$complaint= $detailconfirm["complaint"];
	$detailmember= $detailconfirm["detailmember"];

 ?>
<div class="detail row">
	<div class="col-md-12">
		<strong class="f22">Detail Klaim Return di Id Order #<?php echo ($complaint["idorder"]) ?></strong>
		<hr>
	</div>


	<div class="col-md-12"><hr></div>
	<div class="col-md-12">
		<div class="alert alert-danger">
			<strong>Perhatian !!!</strong>
			<p>Selalu berikan respon yang baik untuk semua member.</p>
		</div>
	</div>

	<div class="col-md-12"><strong>Detail Klaim</strong></div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<table>
				<tbody>
					<tr>
						<td>Id Order </td>
						<td>: <?php echo ($complaint["idorder"]) ?> <a href="<?php echo base_url() ?>backendorder/detail/<?php echo ($complaint["idorder"]) ?>">Lihat Order</a></td>
					</tr>
					<tr>
						<td>Tanggal Komplain</td>
						<td>: <?php echo ($complaint["datecomplaint"]) ?></td>
						
					</tr>
					<tr>
						<td>Status</td>
						<td>: <?php echo ($complaint["status"]) ?></td>
					</tr>
					<tr>
						<td>Pengirim</td>
						<td>: <a href="<?php echo base_url() ?>backendmember/detail/<?php echo ($detailmember["id"]) ?>"><?php echo ($detailmember["name"]) ?></a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<strong>Deskripsi</strong>
			<p><?php echo $complaint["description"] ?></p>
		</div>
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<strong>Product</strong>
			<p><?php echo $complaint["product"] ?></p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<strong>Statement</strong>
			<p><?php echo $complaint["statement"] ?></p>
		</div>
	</div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<a target="_blank" href="<?php echo base_url() ?>public/image/complaint/return/<?php echo ($complaint["pic_evidence"]) ?>">
			<?php 
			$file=$complaint["pic_evidence"];
			$ext =substr($file, strpos($file, "."),strpos($file, ".")+4);
			
			 ?>
			<?php if ($ext==".png" or $ext==".jpg" or $ext==".PNG" or $ext==".JPG" or $ext==".jpeg"): ?>
				<img class="img-fluid" src="<?php echo base_url() ?>public/image/complaint/return/<?php echo ($complaint["pic_evidence"]) ?>">
			<?php else: ?>
			Liat FILE Konfimasi
			<?php endif ?>
			</a>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<?php 
			$file=$complaint["pic_evidencechras"];
			$morefile=explode(",",$file);
			
			 ?>
			<?php foreach ($morefile as $key): ?>
				<?php if ($key!=""): ?>
				<div class="col-md-6">
				<a target="_blank" href="<?php echo base_url() ?>public/image/complaint/return/<?php echo $key ?>">
					<img class="img-fluid" src="<?php echo base_url() ?>public/image/complaint/return/<?php echo $key ?>">
				</a>
				</div>
				<?php endif ?>
			<?php endforeach ?>
			<div class="clearfix"></div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="alert alert-warning">
			<strong>Respon Admin</strong>
			<p><?php echo $complaint["commentadmin"] ?></p>
			<hr>
			<div class="row">
				<form action="<?php echo base_url() ?>backendcomplaint/updatecomplain" method="POST">
				<div class="col-md-10">
					<input type="hidden" name="id" value="<?php echo $complaint["id"] ?>">
					<input type="hidden" name="iduniq" value="<?php echo $complaint["idorder"] ?>">
					<input type="hidden" name="membername" value="<?php echo $detailmember["name"] ?>">
					<input type="hidden" name="email" value="<?php echo $detailmember["email"] ?>">
					<textarea name="comment" class="form-control"><?php echo $complaint["commentadmin"] ?></textarea>
					
				</div>
				<div class="col-md-2">
					<button class="btn btn-orange">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>