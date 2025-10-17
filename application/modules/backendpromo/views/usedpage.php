<div class="halamandepan row">
	<div class="col-md-12">
		<strong>Setting Halaman Depan</strong>
		<hr>
	</div>
	<div class="col-md-12">
		bagian atas
			<div class="card">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
							slide*( 600x300 px ) 
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="slideused" ukuran="*( 600x300 px )" data-target=".showmodal">tambah</a>
							</div>
							<?php foreach ($slide as $keyslide): ?>
								<div class="col-md-4">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $keyslide["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $keyslide["id"] ?>&img=<?php echo $keyslide["img"] ?>">hapus</a>
								</div>
							<?php endforeach ?>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<hr>*( 300x200 px )
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="headbottomslideused" ukuran="*( 300x200 px )" data-target=".showmodal">tambah</a>

						</div>
						<?php foreach ($headbottomslide as $key): ?>
								<div class="col-md-6">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="col-md-3">
					*( 200x170 px )
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="headrightslideused" ukuran="*( 300x200 px )" data-target=".showmodal">tambah</a>
					<hr>
					<?php foreach ($headrightslide as $key): ?>
								<div class="col-md-12">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
					<?php endforeach ?>
				</div>
				<div class="col-md-3">
					*( 200x170 px )
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="headleftslideused" ukuran="*( 300x200 px )" data-target=".showmodal">tambah</a>
					<hr>
					<?php foreach ($headleftslide as $key): ?>
								<div class="col-md-12">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
					<?php endforeach ?>
				</div>
				<div class="clearfix"></div>
			</div>
	</div>

	<div class="col-md-12">
		Hot Deal
			<div class="card">
				<div class="col-md-6">
					big *( 520x340 px )
					<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="promobigused" ukuran="*( 520x340 px )" data-target=".showmodal">tambah</a>
					<hr>
					<?php foreach ($promobig as $key): ?>
								<div class="col-md-12">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
					<?php endforeach ?>
				</div>
				<div class="col-md-6">
					small *( 200x200 px )
					<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="promoused" ukuran="*( 200x200 px )" data-target=".showmodal">tambah</a>
					<div class="row">
					<?php foreach ($promo as $key): ?>
								<div class="col-md-4">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
					<?php endforeach ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
	</div>
	<div class="col-md-12">
		New Stock *( 200x200 px )
					<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="newused" ukuran="*( 200x200 px )" data-target=".showmodal">tambah</a>
		<div class="card">
			<?php foreach ($new as $key): ?>
				<div class="col-md-2">
					<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
					<a href="<?php echo base_url() ?>backendpromo/hapusimgusedpage?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
				</div>
			<?php endforeach ?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<div class="modal fade showmodal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-a-1">
    	<div class="row">
    		<div class="col-md-12">
    			<strong class="titlemodal"></strong>
	    	<form action="<?php echo base_url() ?>backendpromo/inputusedpage" method="post">
	    		<div >
	    			<input class="nameimage" type="hidden" name="name" value="" required>
	    		</div>
	    		<small>link</small>
	    		<input class="form-control" name="link" value="" type="text" placeholder="misal: product/123/Bearing">
	    		<hr>
	    		<small>gambar</small> <small class="ukuran"></small><br>
	    		<label class="file">
				  <input type="file" id="file" name="filegambar" required>
				  <span class="file-custom"></span>
				</label>
				<hr>
				<div class="isthis col-md-5"></div>
				<div class="col-md-12">
					<hr>
					<button class="btn btn-orange">simpan</button>
				</div>
	    	</form>
    		</div>
    	</div>
      
    </div>
  </div>
</div>