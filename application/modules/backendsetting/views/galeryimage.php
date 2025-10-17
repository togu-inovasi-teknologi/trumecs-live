 <div class="settingumum row">
	<div class="col-md-12">
		<strong class="f22">Galery Umum</strong><br>
		<small>File yang di upload di sini akan masuk di folder ./public/image/upload</small>
		<hr>
	</div>
	<div class="col-md-12">
		<div class="card row">
			<form class="col-md-12" method="POST" action="<?php echo base_url() ?>backendsetting/uploadgaleryumum" enctype="multipart/form-data">
				<input name="img" type="file" class="form-control" required>
				<button type="submit" class="btn btn-orange form-control">Upload</button>
			</form>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-12">
		<?php foreach ($list as $key): ?>
			<?php if ($key!="." AND $key!=".."): ?>
			<div class="card row">
				<div class="col-md-2">
					<img src="<?php echo base_url() ?>timthumb?w=30&src=<?php echo base_url() ?>public/image/upload/<?php echo $key ?>">
				</div>
				<div class="col-md-10">
					link img : <a target="_blank" href="<?php echo base_url() ?>public/image/upload/<?php echo $key ?>"><?php echo base_url() ?>public/image/upload/<?php echo $key ?></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php endif ?>
		<?php endforeach ?>
	</div>
</div>