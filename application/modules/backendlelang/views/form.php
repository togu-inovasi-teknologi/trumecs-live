<?php 
	if (!empty($this->session->flashdata('backingdata'))) {
		$backingdata = !empty($this->session->flashdata('backingdata')) ? $this->session->flashdata('backingdata') : NULL;
		
	}
	$this->load->model("general/General_model", "general");
	$jenisproduct = array();
	$jenis = $this->general->getcategori("0");
	foreach($jenis as $key) {
		$jenisproduct[$key['id']] = $key['name'];
	}
	 
 ?>

<div class="form_io_product row" jq-app="" style="margin-top:60px">
	<form action="<?php echo base_url() ?>backendlelang/<?php echo (!empty($this->input->get("id"))) ? 'updatelelang':'addlelang'; ?>" method="POST" enctype="multipart/form-data"
		seletedpenawaran="<?php echo (!empty($backingdata)) ? $backingdata["jenis_penawaran"] : '' ; ?>" 
		seletedcategory="<?php echo (!empty($backingdata)) ? $backingdata["category"] : '' ; ?>" 
		>
	<div class="col-md-6">
		<strong class="f22">Form Lelang</strong>
	</div>
	<div class="col-md-6">
		<div class="col-md-4">
			<small>Jenis Lelang</small>
		</div>
		<div class="col-md-8">
			<select name="jenisproduct" tar='<?php echo (!empty($backingdata)) ? $backingdata["category"] : '' ; ?>' class="input_choicejenis form-control" required>
				<?php foreach ($jenisproduct as $key=>$item): ?>
					<option value='<?php echo $key ?>'><?php echo $item ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<div class="col-md-4">
		<strong>Judul</strong>
		<?php if (!empty($this->input->get("id"))): ?>
			<input type="hidden" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["id"] : '' ; ?>" name="id"  required>
			<input type="hidden" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["img"] : '' ; ?>" name="imgold"  required>
		<?php endif ?>
		<input type="text" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["judul"] : '' ; ?>"  jq-model="name" name="judul"  required>
		<strong>Kategori</strong>
		<select name="category"  class="form-control" seletedcategory="<?php echo (!empty($backingdata)) ? $backingdata["category"] : '' ; ?>">
			<option value="">-- Kategori --</option>
			<?php foreach ($jenisproduct as $key=>$item): ?>
				<option value='<?php echo $key ?>'><?php echo $item ?></option>
			<?php endforeach ?>
		</select>
		<strong>Jenis Penawaran </strong>
		<select name="jenis_penawaran"  class="form-control" seletedpenawaran="<?php echo (!empty($backingdata)) ? $backingdata["jenis_penawaran"] : '' ; ?>">
			<option value="">-- Jenis Penawaran --</option>
			<option value="1">Penawaran Terbuka</option>
			<option value="2">Penawaran Tertutup</option>
		</select>
		<strong>Batas Jaminan</strong>
		<input type="date" class="form-control" jq-model="partnumber" name="batas_jaminan" value="<?php echo (!empty($backingdata)) ? $backingdata["batas_jaminan"] : '' ; ?>">
		<strong>Batas Penawaran </strong>
		<input type="date" class="form-control" jq-model="partnumber" name="batas_penawaran" value="<?php echo (!empty($backingdata)) ? $backingdata["batas_penawaran"] : '' ; ?>">
		<strong>Penyelenggara</strong>
		<input type="text" class="form-control" jq-model="partnumber_trumecs" name="penyelenggara" value="<?php echo (!empty($backingdata)) ? $backingdata["penyelenggara"] : '' ; ?>">
		<hr>
		<strong>Nilai</strong> 
		<div class="input-group">
	        <span class="input-group-addon addonrp">Rp.</span>
	        <input type="number" class="form-control" jq-model="nilai" name="nilai" required value="<?php echo (!empty($backingdata)) ? $backingdata["nilai"] : '' ; ?>">
	    </div>
		<strong>Jaminan</strong> 
		<div class="input-group">
	        <span class="input-group-addon addonrp">Rp.</span>
	        <input type="number" class="form-control" jq-model="jaminan" name="jaminan" required value="<?php echo (!empty($backingdata)) ? $backingdata["jaminan"] : '' ; ?>">
	    </div>
	</div>
	<div class="col-md-8">
		<strong>Uraian </strong>
		<textarea class="form-control" jq-model="uraian" name="uraian"><?php 
		$description_br2nl = (!empty($backingdata)) ? str_replace("\n", " ", trim($backingdata["uraian"])) : '' ;
		$breaks = array("<br />","<br>","<br/>");  
   		$text = str_ireplace($breaks, "", $description_br2nl);  
		echo $text ; ?></textarea>
		<strong>Info Penyelenggara </strong>
		<textarea class="form-control" jq-model="info_penyelenggara" name="info_penyelenggara"><?php 
		$description_br2nl = (!empty($backingdata)) ? str_replace("\n", " ", trim($backingdata["info_penyelenggara"])) : '' ;
		$breaks = array("<br />","<br>","<br/>");  
   		$text = str_ireplace($breaks, "", $description_br2nl);  
		echo $text ; ?></textarea>
		<strong>Info Penjual </strong>
		<textarea class="form-control" jq-model="info_penjual" name="info_penjual"><?php 
		$description_br2nl = (!empty($backingdata)) ? str_replace("\n", " ", trim($backingdata["info_penjual"])) : '' ;
		$breaks = array("<br />","<br>","<br/>");  
   		$text = str_ireplace($breaks, "", $description_br2nl);  
		echo $text ; ?></textarea>
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-5">
		<strong>Gambar </strong>
		<label class="file">
		  <input type="file" id="file" name="fileimg" jq-model="fileupload" <?php echo (empty($this->input->get("id"))) ? "required" : "" ;; ?> >
		  <span class="file-custom"></span>
		</label>
		<small>Ukuran gambar harus di bawah 3000x3000 px<br>
				Type file harus (.jpg/.png)
		</small>
			<?php if ($this->input->get("id")): ?>
				<?php $img= (!empty($backingdata)) ? $backingdata["img"] : '' ; ?>
				<?php if ($backingdata): ?>
					<?php if ($backingdata["img"]!=NULL): ?>
					<div class="row">
						<div class="col-md-6">
							<img  src="<?php echo base_url() ?>public/image/lelang/<?php echo $backingdata["img"] ?>" class="img-fluid blah">
						</div>
					</div>
					<?php endif ?>
				<?php endif ?>
			<?php else: ?>
				<div class="row">
					<div class="col-md-6">
						<img class="img-fluid blah">
					</div>
				</div>
			<?php endif ?>

	</div>
	<div class="col-md-7">
	<div class="row">
			<div class="col-md-12">
				<button class="btn btn-danger col-md-12 p-y-3 m-y-3" type="submit">Simpan</button>
			</div>
		</div>
	</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-10">
		<strong>Review</strong>
		<div class="alert alert-warning">
			<div class="row">
				<div class="col-xs-3">Judul</div>
				<div class="col-xs-9">: <span js-result="judul"><?php echo (!empty($backingdata)) ? $backingdata["judul"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Kategori</div>
				<div class="col-xs-9">: <span js-result="category"><?php echo (!empty($backingdata)) ? $backingdata["category"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Jenis Penawaran</div>
				<div class="col-xs-9">: <span js-result="jenis_penawaran"><?php echo (!empty($backingdata)) ? $backingdata["jenis_penawaran"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Nilai</div>
				<div class="col-xs-9">: <span js-result="nilai"><?php echo (!empty($backingdata)) ? $backingdata["nilai"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Jaminan </div>
				<div class="col-xs-9">: Rp.<span js-result="jaminan"><?php echo (!empty($backingdata)) ? $backingdata["jaminan"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Batas Akhir Jaminan</div>
				<div class="col-xs-9">: <span id="batas_jaminan"><?php echo (!empty($backingdata)) ? $backingdata["batas_jaminan"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Batas Akhir Penawaran</div>
				<div class="col-xs-9">: <span id="batas_penawaran"><?php echo (!empty($backingdata)) ? $backingdata["batas_penawaran"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Uraian</div>
				<div class="col-xs-9">: <span id="uraian"><?php echo (!empty($backingdata)) ? $backingdata["uraian"] : '' ; ?></span></div>
				<div class="col-md-12"><hr></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Penyelenggara</div>
				<div class="col-xs-9">: <span id="penyelenggara"><?php echo (!empty($backingdata)) ? $backingdata["penyelenggara"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Info Penyelenggara </div>
				<div class="col-xs-9">: <span js-result="info_penyelenggara"><?php echo (!empty($backingdata)) ? $backingdata["info_penyelenggara"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Info Penjual</div>
				<div class="col-xs-9">: <span js-result="info_penjual"><?php echo (!empty($backingdata)) ? $backingdata["info_penjual"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Gambar</div>
				<div class="col-xs-9">: 
					<span js-result="fileupload"></span>
					<div class="row">
						<div class="col-md-2">
							<?php if ($this->input->get("id")): ?>
							<img  src="<?php echo base_url() ?>public/image/product/<?php echo $backingdata["img"] ?>" class="img-fluid blah">
							<?php else: ?>
								<img class="img-fluid blah">
							<?php endif ?>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
	
	</form>
</div>
<style type="text/css">
span.file-custom:after {
    content: attr(data-content) '';
}
</style>

<?php if (!empty($backingdata)): ?>
	<?php if ($backingdata["category"]==""): ?>
	<div class="modal fade in pilihjenisproduk" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
		        <h4 class="modal-title" id="gridModalLabel">Pilih Jenis Produk</h4>
		    </div>
		    <div class="modal-body">
				<div class="btn-group" role="group" aria-label="Basic example">
					<?php foreach ($jenisproduct as $key=>$item): ?>
						<?php $btn = 'orange' ; ?>
				  		<button type="button" val="<?php echo $key ?>" class="btn btn-<?php echo $btn ?> p-a-2 choicejenis"><?php echo $item ?></button>
				  	<?php endforeach ?>
				</div>
		    </div>
	    </div>
	  </div>
	</div>
	<?php endif ?>
<?php else: ?>
	<div class="modal fade in pilihjenisproduk" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
		        <h4 class="modal-title" id="gridModalLabel">Pilih Jenis Produk</h4>
		    </div>
		    <div class="modal-body">
				<div class="btn-group" role="group" aria-label="Basic example">
					<?php foreach ($jenisproduct as $key=>$item): ?>
						<?php $btn =  'orange' ; ?>
				  		<button type="button" val="<?php echo $key ?>" class="btn btn-<?php echo $btn ?> p-a-2 choicejenis"><?php echo $item ?></button>
				  	<?php endforeach ?>
				</div>
		    </div>
	    </div>
	  </div>
	</div>
<?php endif ?>

