<?php 
	if (!empty($this->session->flashdata('backingdata'))) {
		$backingdata = !empty($this->session->flashdata('backingdata')) ? $this->session->flashdata('backingdata') : NULL;
		
	}
	$this->load->model("general/General_model", "general");
	$jenisproduct = array();
	$jenis = $this->general->getcategori(array('parent' => '0', 'is_brand' => '0'));
	foreach($jenis as $key) {
		$jenisproduct[$key['id']] = $key['name'];
	}
	 

 ?>

<div class="form_io_product row" jq-app="" style="margin-top:60px">
	<div class="attr-form " hidden>
		<div class="row m-b-1">
			<div class="col-xs-5"><input type="text" class="form-control" jq-model="atribut" placeholder="Nama atribut" name="attribute[]" value=""></div>
			<div class="col-xs-5 p-a-0"><input type="text" class="form-control" jq-model="value" placeholder="Nilai atribut"  name="value[]" value=""></div>
			<div class="col-xs-2"><button type="button" class="btn btn-danger del-att">X</button></div>
		</div>
	</div>
	<form action="<?php echo base_url() ?>backendproduct/<?php echo $this->uri->segment(2) == "myproduct" ? "myproduct/" : ""; ?><?php echo (!empty($this->input->get("id"))) ? 'updateproduct':'addproduct'; ?>" method="POST" enctype="multipart/form-data"
		seletedbrand="<?php echo (!empty($backingdata)) ? $backingdata["brand"] : '' ; ?>" 
		seletedtype="<?php echo (!empty($backingdata)) ? $backingdata["type"] : '' ; ?>" 
		seletedcomponent="<?php echo (!empty($backingdata)) ? $backingdata["component"] : '' ; ?>"
		seletedgrade="<?php echo (!empty($backingdata)) ? $backingdata["quality"] : '' ; ?>"
		seletedpackagine="<?php echo (!empty($backingdata)) ? $backingdata["packagin"] : '' ; ?>"
		>
	<div class="col-md-6">
		<strong class="f22">Form Produk</strong>
	</div>
	<div class="col-md-6">
		<div class="col-md-4">
			<small>Jenis Produk</small>
		</div>
		<div class="col-md-8">
			<select name="jenisproduct" tar='<?php echo (!empty($backingdata)) ? $backingdata["jenisproduct"] : '' ; ?>' class="input_choicejenis form-control" required>
				<?php foreach ($jenisproduct as $key): ?>
					<option value='<?php echo $key ?>'><?php echo $key ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<div class="col-md-4">
		<strong>Nama </strong>
		<?php if (!empty($this->input->get("id"))): ?>
			<input type="hidden" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["id"] : '' ; ?>" name="id"  required>
			<input type="hidden" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["img"] : '' ; ?>" name="imgold"  required>
		<?php endif ?>
		<input type="text" class="form-control" value="<?php echo (!empty($backingdata)) ? $backingdata["tittle"] : '' ; ?>"  jq-model="name" name="tittle"  required>
		<div class="attr-unit">
		<strong>Part Number </strong>
		<input type="text" class="form-control" jq-model="partnumber" name="partnumber" value="<?php echo (!empty($backingdata)) ? $backingdata["partnumber"] : '' ; ?>">
		<strong>Part Number by Trumecs</strong>
		<input type="text" class="form-control" jq-model="partnumber_trumecs" name="partnumber_trumecs" value="<?php echo (!empty($backingdata)) ? $backingdata["partnumber_trumecs"] : '' ; ?>">
		</div>
		<strong>Fisik Number </strong> <small>*jangan diisi bila tidak ada</small>
		<input type="text" class="form-control" jq-model="physicnumber" name="physicnumber" value="<?php echo (!empty($backingdata)) ? $backingdata["physicnumber"] : '' ; ?>">
		<hr>
		<strong>Harga Normal  </strong> 
		<div class="input-group">
	        <span class="input-group-addon addonrp">Rp.</span>
	        <input type="number" class="form-control" jq-model="price" name="price" required value="<?php echo (!empty($backingdata)) ? $backingdata["price"] : '' ; ?>">
	    </div>
		<strong>Harga Promo  </strong> <small>*jangan diisi bila tidak ada</small>
		<div class="input-group">
	        <span class="input-group-addon addonrp">Rp.</span>
	        <input type="number" class="form-control" jq-model="price_promo" name="price_promo" value="<?php echo (!empty($backingdata)) ? $backingdata["price_promo"] : '' ; ?>">
	    </div>
		<strong>Diskon Promo CBD  </strong> <small>*jangan diisi bila tidak ada</small>
		<div class="input-group">
	        <input type="number" class="form-control" jq-model="promo_cbd_price" name="promo_cbd_price" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_cbd_price"] : '' ; ?>" step=".01">
			<span class="input-group-addon addonrp">%</span>
	    </div>
		<strong>Diskon Volume </strong> <small>*jangan diisi bila tidak ada</small>
		<div class="input-group">
	        <span class="input-group-addon addonrp">Min Qty</span>
	        <input type="number" class="form-control" jq-model="promo_volume" name="promo_volume" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_volume"] : '' ; ?>">
	    </div>
		<strong>Diskon Promo Volume </strong> <small>*jangan diisi bila tidak ada</small>
		<div class="input-group">
	        <input type="number" class="form-control" jq-model="promo_volume_price" name="promo_volume_price" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_volume_price"] : '' ; ?>" step=".01">
			<span class="input-group-addon addonrp">%</span>
	    </div>
		<strong>Diskon Promo Referral </strong> <small>*jangan diisi bila tidak ada</small>
		<div class="input-group">
	        <input type="number" class="form-control" jq-model="promo_referral_price" name="promo_referral_price" value="<?php echo (!empty($backingdata)) ? $backingdata["promo_referral_price"] : '' ; ?>" step=".01">
			<span class="input-group-addon addonrp">%</span>
	    </div>
		<hr/>
		<strong>Atribut Produk  </strong> <small>*jangan diisi bila tidak ada</small>
		<div class="attribute-card">
		<?php if (!empty($backingdata)): ?>
		<?php if (!empty($backingdata["attribute"])): ?>
		<?php foreach($backingdata["attribute"] as $index=>$value): ?>
		<div class="row m-b-1">
			<div class="col-xs-5"><input type="text" class="form-control" jq-model="atribut" placeholder="Nama atribut" name="attribute[]" value="<?php echo  $value["name"] ?>"></div>
			<div class="col-xs-5 p-a-0"><input type="text" class="form-control" jq-model="value" placeholder="Nilai atribut"  name="value[]" value="<?php echo $value["value"]?>"></div>
			<div class="col-xs-2"><button type="button" class="btn btn-danger del-att">X</button></div>
	    </div>
		<?php endforeach; ?>
		<?php endif;?>
		<?php endif; ?>
		
		</div>
		<div class="row m-b-1">
			<div class="col-xs-2"><button type="button" class="btn btn-success add-att">+</button></div>
		</div>
	</div>
	<div class="col-md-4">
		<strong>Kategori</strong>
		<select name="component"  class="form-control" seletedcomponent="<?php echo (!empty($backingdata)) ? $backingdata["component"] : '' ; ?>">
			<option value="">-- Kategori --</option>
		</select>
		<strong>Merek Produk</strong> 
		<select name="brand" class="form-control" seletedbrand="<?php echo (!empty($backingdata)) ? $backingdata["brand"] : '' ; ?>">
			<option value="">-- Merek Produk --</option>
		</select>
		<hr/>
		<small>* Peruntukkan unit</small>
		<br/>
		<br/>
		<div class="attr-unit">
		<strong>Merek Unit</strong> 
		<select name="brand_unit" class="form-control" seletedbrandunit="<?php echo (!empty($backingdata)) ? $backingdata["brand_unit"] : '' ; ?>" >
			<option value="">-- Merek Unit --</option>
		</select>
		<strong>Type Unit</strong> <small>*jangan diisi bila tidak ada</small>
		<select name="type"  class="form-control" seletedtype="<?php echo (!empty($backingdata)) ? $backingdata["type"] : '' ; ?>" >
			<option value="">-- Tipe Unit --</option>
		</select>
		</div>
		<hr>
		<strong>Dikirim dari </strong> <small>*jangan diisi bila tidak ada</small>
		<!-- <textarea type="text" class="form-control" jq-model="area" name="area" ><?php echo (!empty($backingdata)) ? $backingdata["area"] : '' ; ?></textarea> -->
		<select name="area"  class="form-control" seletedarea="<?php echo (!empty($backingdata)) ? $backingdata["area"] : '' ; ?>" >
			<option value="">-- Pilih lokasi --</option>
		</select>
		<hr>
		<strong>Grade </strong> 
		<select name="quality" class="form-control" seletedgrade="<?php echo (!empty($backingdata)) ? $backingdata["quality"] : '' ; ?>">
			<option value="">-Pilih Grade-</option>
			<option value="1">Asli</option>
			<option value="2">Replika</option>
			<option value="3">Bekas/Copotan</option>
		</select>
		<strong>Garansi Trumecs </strong> <small>*jangan diisi bila tidak ada</small>
		<input type="text" class="form-control" jq-model="warranty" name="warranty" value="<?php echo (!empty($backingdata)) ? $backingdata["warranty"] : '' ; ?>">
		<strong>Garansi Vendor </strong> <small>*jangan diisi bila tidak ada</small>
		<input type="text" class="form-control" jq-model="warranty_vendor" name="warrantyvendor" value="<?php echo (!empty($backingdata)) ? $backingdata["warrantyvendor"] : '' ; ?>">
		<strong>Live Time </strong> <small>*jangan diisi bila tidak ada</small>
		<input type="text" class="form-control" jq-model="livetime" name="livetime" value="<?php echo (!empty($backingdata)) ? $backingdata["livetime"] : '' ; ?>">
		<hr/>
		<strong>Link Tokopedia </strong>
		<input type="text" class="form-control" jq-model="livetime" name="link_tokped" value="<?php echo (!empty($backingdata)) ? $backingdata["link_tokped"] : '' ; ?>">
		<strong>Link Bukalapak </strong>
		<input type="text" class="form-control" jq-model="livetime" name="link_bukalapak" value="<?php echo (!empty($backingdata)) ? $backingdata["link_bukalapak"] : '' ; ?>">
		<strong>Link Shopee </strong> 
		<input type="text" class="form-control" jq-model="livetime" name="link_shopee" value="<?php echo (!empty($backingdata)) ? $backingdata["link_shopee"] : '' ; ?>">
		<strong>Link Blibli </strong> 
		<input type="text" class="form-control" jq-model="livetime" name="link_blibli" value="<?php echo (!empty($backingdata)) ? $backingdata["link_blibli"] : '' ; ?>">
		<strong>Youtube Video ID </strong> 
		<input type="text" class="form-control" jq-model="livetime" name="youtube" value="<?php echo (!empty($backingdata)) ? $backingdata["youtube"] : '' ; ?>">
	</div>
	<div class="col-md-4">
		<strong>Stock </strong>
		<input type="number" class="form-control" jq-model="stock" name="stock" required value="<?php echo (!empty($backingdata)) ? $backingdata["stock"] : '' ; ?>">
		<strong>Minimum Pembelian </strong>
		<input type="number" class="form-control" jq-model="moq" name="moq" required value="<?php echo (!empty($backingdata)) ? $backingdata["moq"] : '' ; ?>">
		<strong>Unit </strong>
		<input type="text" class="form-control" jq-model="unit" name="unit" required value="<?php echo (!empty($backingdata)) ? $backingdata["unit"] : '' ; ?>">
		<hr>
		<strong>Berat <small>(kg)</small> </strong><small>*gunakan (.) untuk desimal</small>
		<input type="text" class="form-control" jq-model="berat" name="weight" required value="<?php echo (!empty($backingdata)) ? $backingdata["weight"] : '' ; ?>">
		<strong>Dimensi<small>(mm)</small> </strong><small>pisahkan dengan huruf x</small>
		<input type="text" class="form-control" jq-model="dimensi" name="dimention" value="<?php echo (!empty($backingdata)) ? $backingdata["sx"].'x'. $backingdata["sy"].'x'. $backingdata["sz"] : '' ; ?>">
		<strong>Pengemasan </strong>
		<select name="packagin" class="form-control" seletedpackagine="<?php echo (!empty($backingdata)) ? $backingdata["packagin"] : '' ; ?>">
			<option value="">-Pilih Pengemasan-</option>
			<option value="Box Kertas">Box Kertas</option>
			<option value="Box Kayu">Box Kayu</option>
			<option value="Drum">Drum</option>
			<option value="Pail">Pail</option>
			<option value="Dus">Dus</option>
			<option value="Lithos">Lithos</option>
			<option value="Botol">Botol</option>
			<option value="Gallon">Gallon</option>
			<option value="Can">Can</option>
			<option value="Stemped">Stemped</option>
		</select>
		<hr>
		<strong>Estimasi Pengiriman</strong> <small>(hari)</small>
		<input type="number" class="form-control" jq-model="dimensi" name="estimated_delivery" value="<?php echo (!empty($backingdata)) ? $backingdata["estimated_delivery"] : '' ; ?>">
		<small>estimasi pengiriman jabodetabek</small>
		<hr class="m-a-0">
		<strong>Estimasi Pengiriman jika Indent</strong> 
		<input type="number" class="form-control" jq-model="dimensi" name="estimated_deliveryindent" value="<?php echo (!empty($backingdata)) ? $backingdata["estimated_deliveryindent"] : '' ; ?>">
		<small>estimasi pengiriman jika stok barang habis dan harus indent</small> <small>(hari)</small>
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
							<img  src="<?php echo base_url() ?>public/image/product/<?php echo $backingdata["img"] ?>" class="img-fluid blah">
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
		<strong>Deskripsi </strong>
		<textarea class="form-control" jq-model="deskripsi" name="description"><?php 
		$description_br2nl = (!empty($backingdata)) ? str_replace("\n", " ", trim($backingdata["description"])) : '' ;
		$breaks = array("<br />","<br>","<br/>");  
   		$text = str_ireplace($breaks, "", $description_br2nl);  
		echo $text ; ?></textarea>
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
				<div class="col-xs-3">Nama Produk</div>
				<div class="col-xs-9">: <span js-result="name"><?php echo (!empty($backingdata)) ? $backingdata["tittle"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Partnumber</div>
				<div class="col-xs-9">: <span js-result="partnumber"><?php echo (!empty($backingdata)) ? $backingdata["partnumber"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Partnumber Trumecs</div>
				<div class="col-xs-9">: <span js-result="partnumber_trumecs"><?php echo (!empty($backingdata)) ? $backingdata["partnumber_trumecs"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Fisik Number</div>
				<div class="col-xs-9">: <span js-result="physicnumber"><?php echo (!empty($backingdata)) ? $backingdata["physicnumber"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Harga </div>
				<div class="col-xs-9">: Rp.<span js-result="price"><?php echo (!empty($backingdata)) ? $backingdata["price"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Harga Promo</div>
				<div class="col-xs-9">: Rp.<span js-result="price_promo"><?php echo (!empty($backingdata)) ? $backingdata["price_promo"] : '' ; ?></span></div>
				<div class="col-md-12"><hr></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Merek</div>
				<div class="col-xs-9">: <span id="changemerek"><?php echo (!empty($backingdata)) ? $backingdata["brand"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Type</div>
				<div class="col-xs-9">: <span id="changetipe"><?php echo (!empty($backingdata)) ? $backingdata["type"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Komponen</div>
				<div class="col-xs-9">: <span id="changekomponent"><?php echo (!empty($backingdata)) ? $backingdata["component"] : '' ; ?></span></div>
				<div class="col-md-12"><hr></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Grade</div>
				<div class="col-xs-9">: <span id="changequality"><?php echo (!empty($backingdata)) ? $backingdata["quality"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Garansi </div>
				<div class="col-xs-9">: <span js-result="warranty"><?php echo (!empty($backingdata)) ? $backingdata["warranty"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Garansi Vendor</div>
				<div class="col-xs-9">: <span js-result="warranty_vendor"><?php echo (!empty($backingdata)) ? $backingdata["warrantyvendor"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Live Time</div>
				<div class="col-xs-9">: <span js-result="livetime"><?php echo (!empty($backingdata)) ? $backingdata["livetime"] : '' ; ?></span></div>
				<div class="col-md-12"><hr></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Stock</div>
				<div class="col-xs-9">: <span js-result="stock"><?php echo (!empty($backingdata)) ? $backingdata["stock"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Moq</div>
				<div class="col-xs-9">: <span js-result="moq"><?php echo (!empty($backingdata)) ? $backingdata["moq"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Unit</div>
				<div class="col-xs-9">: <span js-result="unit"><?php echo (!empty($backingdata)) ? $backingdata["unit"] : '' ; ?></span></div>
				<div class="col-md-12"><hr></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Berat</div>
				<div class="col-xs-9">: <span js-result="berat"><?php echo (!empty($backingdata)) ? $backingdata["weight"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Dimensi</div>
				<div class="col-xs-9">: <span js-result="dimensi"><?php echo (!empty($backingdata)) ? $backingdata["sx"].'x'. $backingdata["sy"].'x'. $backingdata["sz"] : '' ; ?></span></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Pengemasan</div>
				<div class="col-xs-9">: <span id="changepackagin"><?php echo (!empty($backingdata)) ? $backingdata["packagin"] : '' ; ?></span></div>
				<div class="col-md-12"><hr></div>
			</div>
			<div class="row">
				<div class="col-xs-3">Deskripsi</div>
				<div class="col-xs-9">: <span js-result="deskripsi"><?php echo (!empty($backingdata)) ? $backingdata["description"] : '' ; ?></span></div>
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
	<?php if ($backingdata["jenisproduct"]==""): ?>
	<div class="modal fade in pilihjenisproduk" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
		        <h4 class="modal-title" id="gridModalLabel">Pilih Jenis Produk</h4>
		    </div>
		    <div class="modal-body">
				<div class="btn-group" role="group" aria-label="Basic example">
					<?php foreach ($jenisproduct as $key): ?>
						<?php $btn = 'orange' ; ?>
				  		<button type="button" val="<?php echo $item ?>" class="btn btn-<?php echo $btn ?> p-a-2 choicejenis"><?php echo $item ?></button>
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
				  		<button type="button" val="<?php echo $item ?>" class="btn btn-<?php echo $btn ?> p-a-2 choicejenis"><?php echo $item ?></button>
				  	<?php endforeach ?>
				</div>
		    </div>
	    </div>
	  </div>
	</div>
<?php endif ?>

