<div class="form">
	<div class="col-md-12">
		<strong class="f22">Form Input</strong>
		<hr>
	</div>
	<form action="<?php echo base_url() ?>backendpage/<?php echo (!empty($id)) ? "update" : 'input'; ; ?>" method="POST">
		<div class="col-md-12">
			<?php if (!empty($id)): ?>
					<input class="form-control" name="id" type="hidden" value="<?php echo $detail["id"] ?>">
				<?php endif ?>
			<input type="text" name="title" class="form-control" placeholder="Judul" required
			value="<?php echo (!empty($id)) ? $detail["title"] : ''; ; ?>"
			>
			<hr>
		</div>
		<div class="col-md-12">
			<textarea id="xxxxxxxxx" name="content" ><?php echo (!empty($id)) ? $detail["content"] : ''; ; ?></textarea>
		</div>
		<div class="col-md-12">
			<hr>
			<button type="submit" class="btn btn-orange">Simpan</button>
		</div>
	</form>
</div>