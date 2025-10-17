<div class="form">
    <form action="<?php echo base_url() ?>backendartikel/<?php echo $this->uri->segment(2) == "myartikel" ? "myartikel/" : "" ?><?php echo (!empty($id)) ? "update" : 'input'; ; ?>" method="POST">
	<div class="col-md-12">
		<strong class="f22">Form Artikel</strong>
		<button type="submit" name="save" value="reguler" class="btn btn-orange pull-right m-l-1">Simpan</button>
		<button type="submit" name="save" value="draft" class="btn btn-secondary pull-right">Simpan Draft</button>
		<hr>
	</div>
	<div class="col-md-12">
	    <div class="col-md-8">
	        <div class="row">
	            <div class="col-md-12">
        			<span class="fbold">Judul</span>
        			<?php if (!empty($id)): ?>
        					<input class="form-control" name="id" type="hidden" value="<?php echo $detail["id"] ?>">
        				<?php endif ?>
        			<input type="text" name="title" class="form-control" placeholder="Judul" required
        			value="<?php echo (!empty($id)) ? $detail["title"] : ''; ?>"  maxlength="60"
        			>
        			<hr>
        		</div>
        		<div class="col-md-12">
        			<span class="fbold">Content</span>
        			<textarea id="xxxxxxxxx" name="content" ><?php echo (!empty($id)) ? $detail["value"] : ''; ; ?></textarea>
        		</div>
	        </div>
	    </div>
	    <div class="col-md-4">
	        <div class="row">
	            <div class="col-md-12">
        			<span class="fbold">Gambar</span><br>
        			<label class="file">
        			  <input type="file" id="file" name="filegambar" <?php echo (empty($this->input->get("id"))) ? "required" : "" ;; ?> >
        			  <span class="file-custom"></span>
        			</label>
        			<hr>
        			<div class="tampung">
        				<?php echo (!empty($id)) ?'<img src="'.base_url().'public/image/artikel/'.$detail["img"].'" class="img-fluid">': '';  ?>
        				<?php if (!empty($id)): ?>
        					<input type="hidden" class="form-control" name="asknew" value="" >
        				<?php endif ?>
        			</div>
        			<?php if (!empty($id)): ?>
        					<input type="hidden" class="form-control" name="txtfilegambarold" value="<?php echo (!empty($id)) ? $detail["img"] : ''; ; ?>" >
        			<?php endif ?>
        			<hr>
        		</div>
        		<div class="col-md-12 form-group">
        			<span class="fbold">Hashtag [Optional]</span>
        			<input class="form-control" name="tag" value="<?php echo (!empty($id)) ? $detail["tag"] : ''; ?>" >
        			<small class="form-text text-muted"> *pisahkan setiap Hashtag menggunakan koma (,)</small>
        		</div>
        		<div class="col-md-12 form-group">
        			<span class="fbold">SEO Keyword [Optional]</span>
        			<input class="form-control" name="seo_key" value="<?php echo (!empty($id)) ? $detail["seo_key"] : ''; ?>" >
        			<small class="form-text text-muted"> *pisahkan setiap keyword menggunakan koma (,)</small>
        		</div>
        		<div class="col-md-12 form-group">
        			<span class="fbold">SEO Deskripsi [Optional]</span>
        			<textarea class="form-control" name="discription_seo" maxlength="160"  rows="4" ><?php echo (!empty($id)) ? $detail["discription_seo"] : ''; ?></textarea>
        		</div>
	        </div>
	    </div>
	</div>
	</form>
</div>
</div>