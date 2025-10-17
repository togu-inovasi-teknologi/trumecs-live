<div class="row">
	<div class="col-md-12">
		<strong class="f22">Pengaturan Wilayah JNE</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<table class="tablelist table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kecamatan</th>
					<th>Kabupaten</th>
					<th>Provinsi</th>
					<th>Kode JNE</th>
				</tr>
			</thead>
			<tbody style="font-size: smaller;">
				<?php $i=1; ?>
				<?php foreach ($wilayah as $key): ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $key["kecamatan"] ?></td>
					<td><?php echo $key["kabupaten"] ?></td>
					<td><?php echo $key["provinsi"] ?></td>
					<td><?php echo $key["kode"] ?></td>
				</tr>
				<?php $i++ ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>