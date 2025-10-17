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
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="slide" ukuran="*( 600x300 px )" data-target=".showmodal">tambah</a>
							</div>
							<?php foreach ($slide as $keyslide): ?>
								<div class="col-md-4">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $keyslide["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $keyslide["id"] ?>&img=<?php echo $keyslide["img"] ?>">hapus</a>
									<a  class="btn btn-orange btn-sm btnshoweditmodal" data-toggle="modal" input-id="<?php echo $keyslide['id']; ?>" input-link="<?php echo $keyslide['link']; ?>" input-url="<?php echo base_url("public/image/page/home/".$keyslide['img']); ?>" input-image="<?php echo $keyslide['img']; ?>" input-name="slide" input-title="<?php echo $keyslide["title"] ?>" ukuran="*( 600x300 px )" data-target=".showeditmodal">Ubah</a>
								</div>
							<?php endforeach ?>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<hr>*( 300x200 px )
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="headbottomslide" ukuran="*( 300x200 px )" data-target=".showmodal">tambah</a>

						</div>
						<?php foreach ($headbottomslide as $key): ?>
								<div class="col-md-6">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
									<a  class="btn btn-orange btn-sm btnshoweditmodal" data-toggle="modal" input-id="<?php echo $key['id']; ?>" input-link="<?php echo $key['link']; ?>" input-url="<?php echo base_url("public/image/page/home/".$key['img']); ?>" input-image="<?php echo $key['img']; ?>" input-name="headbottomslide" input-title="<?php echo $key["title"] ?>" ukuran="*( 300x200 px )" data-target=".showeditmodal">Ubah</a>
								</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="col-md-3">
					*( 200x170 px )
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="headrightslide" ukuran="*( 300x200 px )" data-target=".showmodal">tambah</a>
					<hr>
					<?php foreach ($headrightslide as $key): ?>
								<div class="col-md-12">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">Hapus</a>
									<a  class="btn btn-orange btn-sm btnshoweditmodal" data-toggle="modal" input-id="<?php echo $key['id']; ?>" input-link="<?php echo $key['link']; ?>" input-url="<?php echo base_url("public/image/page/home/".$key['img']); ?>" input-image="<?php echo $key['img']; ?>" input-name="headrightslide" input-title="<?php echo $key["title"] ?>" ukuran="*( 300x200 px )" data-target=".showeditmodal">Ubah</a>
								</div>
					<?php endforeach ?>
				</div>
				<div class="col-md-3">
					*( 200x170 px )
<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="headleftslide" ukuran="*( 300x200 px )" data-target=".showmodal">tambah</a>
					<hr>
					<?php foreach ($headleftslide as $key): ?>
								<div class="col-md-12">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
									<a  class="btn btn-orange btn-sm btnshoweditmodal" data-toggle="modal" input-id="<?php echo $key['id']; ?>" input-link="<?php echo $key['link']; ?>" input-url="<?php echo base_url("public/image/page/home/".$key['img']); ?>" input-image="<?php echo $key['img']; ?>" input-name="headleftslide" input-title="<?php echo $key["title"] ?>" ukuran="*( 300x200 px )" data-target=".showeditmodal">Ubah</a>
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
					<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="promobig" ukuran="*( 520x340 px )" data-target=".showmodal">tambah</a>
					<hr>
					<?php foreach ($promobig as $key): ?>
								<div class="col-md-12">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
					<?php endforeach ?>
				</div>
				<div class="col-md-6">
					small *( 200x200 px )
					<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="promo" ukuran="*( 200x200 px )" data-target=".showmodal">tambah</a>
					<div class="row">
					<?php foreach ($promo as $key): ?>
								<div class="col-md-4">
									<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
									<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
								</div>
					<?php endforeach ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
	</div>
	<div class="col-md-12">
		New Stock *( 200x200 px )
					<a  class="btn btn-orange btn-sm btnshowmodal" data-toggle="modal" input-name="new" ukuran="*( 200x200 px )" data-target=".showmodal">tambah</a>
		<div class="card">
			<?php foreach ($new as $key): ?>
				<div class="col-md-2">
					<img class="img-fluid" src="<?php echo base_url() ?>public/image/page/home/<?php echo $key["img"] ?>">
					<a href="<?php echo base_url() ?>backendpromo/hapusimghalamadepan?id=<?php echo $key["id"] ?>&img=<?php echo $key["img"] ?>">hapus</a>
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
	    	<form action="<?php echo base_url() ?>backendpromo/inputhalamadepan" method="post">
	    		<div >
	    			<input class="nameimage" type="hidden" name="name" value="" required>
	    		</div>
	    		<small>link</small>
	    		<input class="form-control" name="link" value="" type="text" placeholder="misal: product/123/Bearing">
	    		<hr>
				<input class="form-control" name="title" value="" type="text" placeholder="misal: Oli">
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
<div class="modal fade showeditmodal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-a-1">
    	<div class="row">
    		<div class="col-md-12">
    			<strong class="titlemodal"></strong>
	    	<form action="<?php echo base_url() ?>backendpromo/edithalamadepan" method="post">
	    		<div >
	    			<input class="nameimage" type="hidden" name="name" value="" required>
	    			<input class="" type="hidden" name="id" value="" required>
	    		</div>
	    		<small>link</small>
	    		<input class="form-control" name="link" value="" type="text" placeholder="misal: product/123/Bearing">
	    		<hr>
				<small>link</small>
				<input class="form-control input-title" name="title" value="" type="text" placeholder="misal: Oli">
	    		<hr>
	    		<small>gambar</small> <small class="ukuran"></small><br>
	    		<label class="file">
				  <input type="file" id="file" name="filegambar">
				  <span class="file-custom"></span>
				</label>
				<hr>
				<div class="isthis col-md-5">
					<img class="img-fluid" src="">
					<input name="textimg" value="">
				</div>
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