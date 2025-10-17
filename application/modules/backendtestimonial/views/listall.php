<div class="listalladmin">
	<div class="row">
		<div class="col-md-8">
			<strong class="f22">List Testimonial</strong>
		</div>
		<div class="col-md-4">
			<a data-toggle="modal" data-target=".bd-example-modal-sm-adddd" class="btn btn-orange">Tambah Testimonial</a>
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
			      <th>Nama<br><small>Email</small></th>
			      <th>Tanggal<br><small>Content</small></th>
			      <th>Emote</th>
			      <th>Status</th>
			      <th>Edit</th>
			    </tr>
			  </thead>
			  <tbody style="font-size:12px">
			  	<?php if (!empty($listfilter)): ?>
				  	<?php foreach ($listfilter as $key): ?>
						    <tr>
						      <td>
						      	<?php echo $key["name"] ?><br>
						      	<?php echo $key["email"] ?>
						      </td>
						      <td>
						      	<?php echo $key["date"] ?><br>
						      	<?php echo $key["content"] ?>
						      </td>
						      <td>
						      	<?php echo $key["emote"] ?>
						      </td>
						      <td>
						      	<a href="<?php echo base_url() ?>backendtestimonial/<?php echo 
						      	($key["moderate"]=="sudah") ? "update?id=".$key["id"]."&status=no" : "update?id=".$key["id"]."&status=sudah" ; ?>" class="label label-<?php echo ($key["moderate"]=="sudah") ? "success" : "danger" ; ?>">
						      		<?php echo $key["moderate"] ?>
						      	</a>
						      </td>
						      <td>
						      	<a data-toggle="modal" data-target=".bd-example-modal-sm"
						      	name="<?php echo $key["name"] ?>"
						      	idtbl="<?php echo $key["id"] ?>"
						      	email="<?php echo $key["email"] ?>"
						      	date="<?php echo $key["date"] ?>"
						      	content="<?php echo $key["content"] ?>"
						      	emote="<?php echo $key["emote"] ?>"
						      	 class="label label-warning fafafafa">
						      		<i class="fa fa-edit"></i>
						      	</a>
						      </td>
						    </tr>
				    <?php endforeach ?>
				<?php else: ?>
					<tr><td colspan="9">Tidak ada data</td></tr>
			  	<?php endif ?>
			  </tbody>
			</table>
		</div>
	</div>

</div>


<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-edit p-y-1">
    	<form action="<?php echo base_url() ?>backendtestimonial/updatetesti" method="post">
    	<div class="col-md-12">
    	<strong>edit</strong>
    	</div>
      	<div class="col-md-12">
	  		<small>Nama</small>
	  		<input required type="text" class="form-control" autofocus name="name">
	  		<input required type="hidden" class="form-control"  name="id">
	  		<small>Email</small>
	  		<input required type="text" class="form-control" name="email">
	  	
	  		<small>Tanggal</small>
	  		<input required type="text" class="form-control" placeholder="JJ:MM DD/MM/YYYY" name="date">
	  		<small>Emote</small>
	  		<input required type="text" class="form-control" name="emote">
	  	</div>
	  	<div class="col-md-12">
	  		<small>Content</small>
	  		<textarea required type="text" class="form-control" name="content"></textarea>
	  	</div>
	  	<div class="col-md-12">
	  		<small>Simpan</small><br>
	  		<button class="btn btn-orange">Simpan</button>
	  	</div>
	  	</form>
	  	<div class="clearfix"></div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm-adddd" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content p-y-1">
    	<form action="<?php echo base_url() ?>backendtestimonial/addtesti" method="post">
    	<div class="col-md-12">
    	<strong>tambah</strong>
    	</div>
      	<div class="col-md-12">
	  		<small>Nama</small>
	  		<input required type="text" class="form-control" autofocus name="name">
	  		<small>Email</small>
	  		<input required type="text" class="form-control" name="email">
	  	
	  		<small>Tanggal</small>
	  		<input required type="text" class="form-control" placeholder="JJ:MM DD/MM/YYYY" name="date">
	  		<small>Emote</small>
	  		<input required type="text" class="form-control" name="emote">
	  	</div>
	  	<div class="col-md-12">
	  		<small>Content</small>
	  		<textarea required type="text" class="form-control" name="content"></textarea>
	  	</div>
	  	<div class="col-md-12">
	  		<small>Simpan</small><br>
	  		<button class="btn btn-orange">Simpan</button>
	  	</div>
	  	</form>
	  	<div class="clearfix"></div>
    </div>
  </div>
</div>