<div class="galery m-t-3" >
	<div class="row">
		<div class="col-md-7">
			<strong class="f18">Galery Produk <?php echo $product["tittle"] ?></strong>
		</div>
		<div class="col-md-5 <?php echo  (!$this->agent->is_mobile()) ? "text-right" : "" ; ?>">
			<form action="<?php echo base_url() ?>backendproduct/addgalery/" method="POST" enctype="multipart/form-data">
		      	<label class="file text-left">
					  <input type="file" id="file" name="filegalery" required >
					  <input type="hidden" name="id" value="<?php echo $product["id"] ?>" required>
					  <span class="file-custom">Pilih Gambar / </span>
				</label>
				<?php if (count($product["galery"])<=4): ?>
		      		<button class="btn btn-orange" type="submit">Tambah Galery</button>
				<?php endif ?>
		    </form>
		</div>
		<div class="col-md-12"><hr></div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<strong>Main Image Product</strong>
			<?php 
			$filename = 'public/image/product/'.$product["img"];
			if (file_exists($filename)) {
			    echo '<a href="#" class="pop"><img src="'.base_url().'public/image/product/'.$product["img"].'" class="img-fluid"></a>';
			} else {
			    echo "tidak ada file $filename ";
			}

			 ?>
		</div>

		<div class="col-md-6">
			<strong>Galery Product</strong>
			<div class="row">
			<?php
			foreach ($product["galery"] as $key) {
				$filename = 'public/image/galery/'.$key["img"];
				if (file_exists($filename)) {
				    echo '<div class="col-md-6 text-center"><a href="#" class="pop"><img src="'.base_url().'public/image/galery/'.$key["img"].'" class="img-fluid"></a><a href="'.base_url().'backendproduct/hapusgalery?id='.$key["id"].'&im='.$key["img"].'">hapus</a></div>';
				} else {
				    echo "tidak ada file $filename ";
				}
			}
			 ?>
			 </div>
		</div>
	</div>
</div>
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade in" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" class="img-fluid" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>