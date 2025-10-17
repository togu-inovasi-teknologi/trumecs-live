<div class="listalladmin">
	<div class="row">
		<div class="col-md-9">
			<strong class="f22">List Admin</strong>
		</div>
		<div class="col-md-3">
			<a href="<?php echo base_url() ?>backenduser/formaddddadaaaaa" class="btn btn-orange">Tambah Admin</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 table-responsive">
		<table id="table-user" class="table table-striped table-bordered table-hover" cellspacing="2" width="100%">
			  <thead>
			    <tr>
			      <th>Nama</th>
			      <th>Previlage</th>
			      <th>Hapus</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php if (!empty($listfilter)): ?>
				  	<?php foreach ($listfilter as $key): ?>
					  	<?php if ($key["privileges"]!=""): ?>
						    <tr>
						      <td><a href="<?php echo base_url() ?>backenduser/ddtttaaaiiill?id=<?php echo $key["idadmin"] ?>" class="fbold f14 forange"><?php echo $key["nameadmin"] ?></a><br>
						      </td>
						      <td>
						      	<?php echo $key["level"] ?>
						      </td>
						      <td>
						      	<a href="<?php echo base_url() ?>backenduser/haspuuuuuussssssadminnnnn?id=<?php echo $key["idadmin"] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						      </td>
						    </tr>
					    <?php endif ?>
				    <?php endforeach ?>
				<?php else: ?>
					<tr><td colspan="9">Tidak ada data</td></tr>
			  	<?php endif ?>

			  </tbody>
			</table>
		</div>
	</div>

</div>