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
		<div class="col-md-6">
			<strong class="f22">List Lelang</strong>
		</div>
		<div class="col-md-6 text-right">

			<a class="btn btn-danger" data-toggle="collapse" href="#collapseCari" aria-expanded="false" aria-controls="collapseCari">Pencarian Sparepart</a>
			<a href="<?php echo base_url() ?>backendlelang/form" class="btn btn-orange">Tambah Produk</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
		<div class="col-lg-12 collapse" id="collapseCari">
			<?php $this->load->view("cariform"); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table id="table-lelang" class="table table-striped table-bordered table-hover" cellspacing="2" width="100%">
			  <thead>
			    <tr>
			      <th>Valid?</th>
			      <th>Judul</th>
			      <th>Nilai</th>
			      <th>Kategori</th>
			      <th>Jenis Penawaran</th>
			      <th>Edit</th>
			      <th>Galeri</th>
			      <th>Hapus</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php if (!empty($listproduct)): ?>
			  		
			  	<?php foreach ($listproduct as $key): ?>
			    <tr>
			      <th><a href="<?php echo base_url() ?>backendlelang/lelangstatus?id=<?php echo $key["id"] ?>&status=<?php echo  ($key["status"]=="show") ? "draf" : "show" ; ?>" class="label label-<?php echo  ($key["status"]=="show") ? "success" : "danger" ; ?> " alt="show"><i class="fa fa-<?php echo  ($key["status"]=="show") ? "check" : "ban" ; ?>"></i></a></th>
			      <td><?php echo $key["judul"] ?></td>
			      <td>Rp.<?php echo number_format($key["nilai"]) ?></td>
			      <td><span class="label label-default"><?php echo namectgr($key["category"]) ?></span></td>
			      <td><span class="label label-default"><?php echo $key["jenis_penawaran"] ?></span></td>
			      <td>
			      	<a class="label label-warning"
			      	href="<?php echo base_url() ?>backendlelang/form?id=<?php echo $key["id"] ?>"
			      	><i class="fa fa-edit"></i></a>
			      </td>
			      <td>
			      	<a class="label label-primary"
			      	href="<?php echo base_url() ?>backendlelang/galery?id=<?php echo $key["id"] ?>"
			      	><i class="fa fa-file-image-o"></i></a>
			      </td>
			      <td>
			      	<a class="label click label-danger"
			      	onclick="hapus(<?php echo $key["id"] ?>,'<?php echo $key["tittle"] ?>')"
			      	url="<?php echo base_url() ?>backendlelang/hapus?id=<?php echo $key["id"] ?>"
			      	><i class="fa fa-trash"></i></a>
			      </td>
			    </tr>
			    <?php endforeach ?>
				<?php else: ?>
				<tr><td colspan="9">Tidak ada data</td></tr>
			  	<?php endif ?>

			  </tbody>
			</table>
		</div>
		<!--<div class="col-xs-12 text-center">
			<?php echo !empty($listproduct)?$links: "";  ?> 
		</div>-->
		<div class="col-md-12 text-center m-y-2">
			<a class="btn btn-success" data-toggle="modal" data-target=".modal_download">download list produk</a>
			<div class="modal fade modal_download" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog ">
			    <div class="modal-content p-a-1">
			    	<div class="text-center">Download list produk ke exel (.exl)</div>
			        <div class="btn-group" role="group" aria-label="Second group">
					    <a href="<?php echo base_url() ?>backendlelang/download_exel_product" class="btn btn-lg btn-secondary">Semua</a>
					    <a href="<?php echo base_url() ?>backendlelang/download_exel_product/show" class="btn btn-lg btn-success">Valid</a>
					    <a href="<?php echo base_url() ?>backendlelang/download_exel_product/draf" class="btn btn-lg btn-danger">Tidak Valid</a>
					</div>

					<div class="text-center p-t-1">Download list Kategori ke exel (.exl)</div>
			        <div class="btn-group" role="group" aria-label="Second group">
					    <a href="<?php echo base_url() ?>backendlelang/category_brand_type_component" class="btn btn-lg btn-secondary">Semua</a>
					</div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function hapus (url,name) {
	var txt ="Apakah anda yakin ingin menghapus produk "+name+"?";
	var r = confirm(txt);
	if (r == true) {
		window.location.href ="<?php echo base_url() ?>backendlelang/hapus?id="+url;
	}
};
</script>