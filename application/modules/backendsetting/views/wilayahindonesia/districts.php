<div class="row">
	<div class="col-md-12">
		<strong class="f22">Pengaturan Wilayah (Districts)</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<table class="tablelist table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Districts</th>
					<th style="    width: 400px;">Kode JNE</th>
				</tr>
			</thead>
			<tbody style="font-size: smaller;">
				<?php $i=1; ?>
				<?php foreach ($area as $key): ?>
				<tr>
					<td><?php echo $i ?></td>
					<td>
						<a href="<?php echo base_url() ?>backendsetting/villages/<?php echo $key["id"]  ?>">
						<?php echo $key["name"] ?>
						</a>
					</td>
					<td>
						<div class="divchangetoforminputareajne<?php echo $key["id"]  ?> col-md-12">
							<?php if ($key["kode_jne"]!=""): ?>
							<span kodeid="<?php echo $key["id"]  ?>" jne="<?php echo $key["kode_jne"] ?>" class="changetoforminputareajne label label-primary"><?php echo $key["kode_jne"] ?></span>
							<?php else: ?>

								<form class="updatekodejnedistrict" kode="<?php echo $key["id"]  ?>" action="<?php echo base_url() ?>backendsetting/updatewilayah" method="POST">
									<div class="input-group input-group-sm">
								      <input type="hidden" class="form-control" name="id" value="<?php echo $key["id"]  ?>">
								      <input type="text" class="form-control" name="kode_jne" >
								      <span class="input-group-btn">
								        <button class="btn btn-primary" type="submit">Simpan</button>
								      </span>
								    </div>
								</form>
							<?php endif ?>
						</div>
						<div class="clearfix"></div>
					</td>
				</tr>
				<?php $i++ ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

