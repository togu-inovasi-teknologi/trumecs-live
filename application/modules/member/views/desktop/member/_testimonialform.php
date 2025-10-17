<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];

?>
<div class="col-lg-12">
	<?php echo ($this->session->flashdata('message') == "") ? "" :
		'<div class="alert alert-warning">' .
		$this->session->flashdata('message') .
		'</div>'; ?>
</div>
<div class="row">
	<div class="col-lg-12">
		<strong class="f22">Testimonial</strong>
	</div>
	<div class="col-lg-12">
		<div class="card borderdesk m-t-1 p-a-1">
			<strong class="f18">Beri Testimoni</strong><br>
			<form action="<?php echo base_url() ?>member/senttestimonial" method="POST" enctype="multipart/form-data">
				<label>Komentar</label>
				<textarea name="testimonial" class="form-control" rows="6" placeholder="Tulis testimonial"></textarea>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label>Foto/Video</label> <br>
						<small>Gambar(.jpg)/File(.pdf)</small>
						<input type="file" id="uploadBtn" name="fileconfirmation" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
						<a href="#" id="filetext" name="file" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
					</div>
					<div class="col-lg-4">
						<img src="" class="blah img-fluid">
					</div>
				</div>
				<br>
				<label>Perasaan Anda</label>
				<br>
				<div class="btn-group radiobutton" data-toggle="buttons">
					<label class="btn rd btn-secondary">
						<input type="radio" name="options" value="cukup">
						<i class="fa fa-frown-o fa-2"></i><br>cukup
					</label>
					<label class="btn og btn-secondary active">
						<input type="radio" name="options" value="senang" checked>
						<i class="fa fa-meh-o fa-2"></i><br>senang
					</label>
					<label class="btn gr btn-secondary">
						<input type="radio" name="options" value="marah">
						<i class="fa fa-smile-o fa-2"></i><br>bahagia
					</label>
				</div>
				<br>
				<br>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="agre" value="yes_i_agre" checked>
						<span>
							Saya setuju dengan <a class="forange" href="<?php echo base_url() ?>page/44/Syarat-Ketentuan">syarat ketentuan trumecs.</a>
						</span>
					</label>
				</div>
				<br>
				<button type="submit" class="btn btnnew proccessshow" modal-text="Terimakasih, Testimoni Anda sedang disimpan">Kirim Testimonial</button>
				<br>
			</form>
		</div>
	</div>
	<div class="col-lg-12 m-t-1">
		<div class="card borderdesk p-a-1">
			<strong class="f18">Testimoni Saya</strong>
			<?php foreach ($testimonial as $key) : ?>
				<div class="row m-t-1">
					<div class="col-lg-3 text-xs-center">
						<img src="<?php echo base_url() ?>public/image/testimonial-trumecs.png" class="img-circle">
					</div>
					<div class="col-lg-9">
						<div class="row">
							<div class="col-lg-6">
								<span><?php echo $key["name"] ?></span>
								<?php if ($key["emote"] == "senang") : ?>
									<i class="fa fa-smile-o"></i>
								<?php else : ?>
									<i class="fa fa-meh-o"></i>
								<?php endif ?><br>
								<small><?php echo $key["date"] ?></small>
							</div>
						</div>
						<p class="f18 fbold"><?php echo $key["content"] ?></p>
						<?php if ($key["type"] == '.png' || $key["type"] == '.jpg') { ?>
							<img src="<?php echo base_url('public/image/member/testimonial/' . $key["file"]); ?>" />
						<?php } else { ?>
							<video height="240" controls>
								<source src="<?php echo base_url('public/image/member/testimonial/' . $key["file"]); ?>" type="video/mp4">
							</video>
						<?php } ?>
					</div>
					<div class="col-xs-12">
						<hr>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>