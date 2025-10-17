<?php 
function namectgr($id)
{
	$namectgr="";
	$ctgr=unserialize(CATEGORY_ALL);
	foreach ($ctgr as $key) {
		if ($key["id"]==$id) {
			$namectgr=$key["name"];
		}
	}
	return $namectgr;


}


 ?>
<div class="product">
	<div class="row">
		<div class="col-md-8">
			<strong class="f22">List Halaman/Page</strong>
		</div>
		<div class="col-md-4">
			<a href="<?php echo base_url() ?>backendpage/form" class="btn btn-orange">Tambah Page</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table table-sm table-hover">
			  <thead>
			    <tr>
			      <th>Judul</th>
			      <th>Edit</th>
			      <th>Hapus</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php if (!empty($listfilter)): ?>
			  		
			  	<?php foreach ($listfilter as $key): ?>
			    <tr>
			      <td><a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="fbold f14 forange"><?php echo $key["title"] ?></a><br>
			      </td>
			      <td>
			      	<a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
			      </td>
			      <td>
			      	<a href="<?php echo base_url() ?>backendpage/hapus?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
			      </td>
			    </tr>
			    <?php endforeach ?>
				<?php else: ?>
				<tr><td colspan="9">Tidak ada data</td></tr>
			  	<?php endif ?>

			  </tbody>
			</table>
		</div>
		<div class="col-xs-12 text-center">
			<?php echo !empty($listfilter)?$links: "";  ?> 
		</div>
	</div>
</div>
<script type="text/javascript">
function hapus (url,name) {
	var txt ="Apakah anda yakin ingin menghapus produk "+name+"?";
	var r = confirm(txt);
	if (r == true) {
		window.location.href ="<?php echo base_url() ?>backendproduct/hapus?id="+url;
	}
};
</script>