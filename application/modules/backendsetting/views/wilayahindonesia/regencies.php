<div class="row">
	<div class="col-md-12">
		<strong class="f22">Pengaturan Wilayah (Regencies)</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<table class="tablelist table">
			<thead>
				<tr>
					<th>No.</th>
					<th>IDW</th>
					<th>Regencies</th>
				</tr>
			</thead>
			<tbody style="font-size: smaller;">
				<?php $i=1; ?>
				<?php foreach ($area as $key): ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $key["id"] ?></td>
					<td>
						<a href="<?php echo base_url() ?>backendsetting/districts/<?php echo $key["id"]  ?>">
						<?php echo $key["name"] ?>
						</a> <?php echo  ($key["count"]>0) ? "(".$key["count"].")" : '' ; ?>
					</td>
				</tr>
				<?php $i++ ?>
				<?php endforeach ?>
				<?php foreach ($area as $key ): ?>
					'<?php echo $key["id"] ?>',
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>