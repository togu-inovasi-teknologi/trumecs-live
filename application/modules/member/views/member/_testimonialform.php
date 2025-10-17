<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];

?>
<div class="row">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
		<strong class="f22">Testimonial</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<?php foreach ($testimonial as $key) : ?>
			<div class="row">
				<div class="col-md-3 text-xs-center">
					<img src="<?php echo base_url() ?>public/image/testimonial-trumecs.png" class="img-circle">
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<?php if ($key["emote"] == "senang") : ?>
								<i class="fa fa-smile-o"></i>
							<?php else : ?>
								<i class="fa fa-meh-o"></i>
							<?php endif ?>
							<span><?php echo $key["name"] ?></span>
						</div>
						<div class="col-md-6 text-right">
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
	<div class="formtestimonial">
		<form action="<?php echo base_url() ?>member/senttestimonial" method="POST" enctype="multipart/form-data">
			<div class="col-md-12 ">
				<div class="col-md-3"><strong>Testimoni</strong></div>
				<div class="col-md-9">
					<textarea name="testimonial" class="form-control" rows="6" placeholder="Tulis testimonial"></textarea>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
				<div class="col-md-3">
					Bukti Tranfer* <br>
					<small>Gambar(.jpg)/File(.pdf)</small>
				</div>
				<div class="col-md-2">
					<input type="file" id="uploadBtn" name="fileconfirmation" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
					<a href="#" id="filetext" name="file" class="btn btn-orange" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
				</div>
				<div class="col-md-2">
					<img src="" class="blah img-fluid">
				</div>

				<div class="clearfix"></div>
				<hr class="line">
				<div class="col-md-3"></div>
				<div class="col-md-9">
					<div class="btn-group radiobutton" data-toggle="buttons">
						<label class="btn og btn-secondary active">
							<input type="radio" name="options" value="senang" checked>
							<i class="fa fa-smile-o fa-2"></i><br>senang
						</label>
						<label class="btn gr btn-secondary">
							<input type="radio" name="options" value="cukup">
							<i class="fa fa-meh-o fa-2"></i><br>cukup
						</label>
						<label class="btn rd btn-secondary">
							<input type="radio" name="options" value="marah">
							<i class="fa fa-frown-o fa-2"></i><br>marah
						</label>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="col-md-12 ">
				<div class="col-md-9 col-md-offset-3">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="agre" value="yes_i_agre" checked>
							<span>
								Saya setuju dengan <a class="forange" href="<?php echo base_url() ?>page/44/Syarat-Ketentuan">syarat ketentuan trumecs.</a>
							</span>
						</label>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>
			<div class="col-md-12 ">
				<div class="col-md-9 col-md-offset-3">
					<button type="submit" class="btn btn-orange proccessshow" modal-text="Terimakasih, Testimoni Anda sedang disimpan">Kirim Testimonial</button>
				</div>
				<div class="clearfix"></div>
				<hr class="line">
			</div>

		</form>
	</div>
</div>