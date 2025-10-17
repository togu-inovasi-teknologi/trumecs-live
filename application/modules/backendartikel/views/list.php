<div class="product">
	<div class="">
		<div class="col-md-9">
			<strong class="f22">List Artikel</strong>
		</div>
		<div class="col-md-3">
			<a href="<?php echo base_url() ?>backendartikel/<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel/" : "" ?>form" class="btn btn-orange">Tambah Artikel</a>
		</div>
		<div class="col-lg-12">
			<hr>
		</div>
	</div>
	<div class="">
		<div class="col-xs-12 table-responsive">
			<table id="table-<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel" : "artikel" ?>" class="table table-striped table-bordered table-hover table-dark display compact" width="100%">
			  <thead>
			    <tr>
			      <th>Judul</th>
			      <th>Dibuat</th>
			      <th>Diupdate</th>
			      <th>Dilihat</th>
			      <th>Penulis</th>
			      <!--<th>Edit</th>-->
			      <th>Display?</th>
			      
			    </tr>
			  </thead>
			  <tbody>
			      <!--
			  	<?php if (!empty($listfilter)): ?>
			  		
			  	<?php foreach ($listfilter as $key): ?>
			    <tr>
			      <td><a href="<?php echo base_url() ?>backendartikel/<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel/" : "" ?>form?id=<?php echo $key["id"] ?>" class="fbold f14 forange"><?php echo $key["title"] ?></a><br>
			      </td>
			      <td><?php echo $key["date"] ?></td>
			      <td><?php echo $key["date"] ?></td>
			      <td><?php echo $key["view"] ?></td>
			      <td><?php echo $key["view"] ?></td>
			      <td>
			      	<a href="<?php echo base_url() ?>backendartikel/<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel/" : "" ?>form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
			      </td>
			      <td>
			      	<a href="<?php echo base_url() ?>backendartikel/<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel/" : "" ?>hapus?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
			      </td>
			    </tr>
			    <?php endforeach ?>
				<?php else: ?>
				<tr><td colspan="9">Tidak ada data</td></tr>
			  	<?php endif ?>
                -->
                <tr><td colspan="9">Sedang menarik data</td></tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
function hapus (url,name) {
	var txt ="Apakah anda yakin ingin menghapus artikel "+name+"?";
	var r = confirm(txt);
	if (r == true) {
		window.location.href ="<?php echo base_url() ?>backendproduct/<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel/" : "" ?>hapus?id="+url;
	}
};
</script>