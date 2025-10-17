<div class="member_page">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="f22 fbold">Testimonial</h1>
					<hr>
				</div>
			</div>
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
					</div>
					<div class="col-xs-12">
						<hr>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<div class="col-md-4">
			<div class="card p-y-1">
				<div class="col-md-12">
					<h5 class="f16 fbold">Ingin memberi testimoni tentang Trumecs?</h5>
				</div>
				<?php $session = $this->session->all_userdata(); ?>
				<?php $array_search = array_key_exists("member", $session); ?>
				<?php if ($array_search == true) : ?>

					<form action="<?php echo base_url() ?>member/senttestimonial" method="POST">
						<div class="col-md-12 ">
							<textarea name="testimonial" class="form-control" rows="6" placeholder="Tulis testimonial"></textarea>
							<div class="clearfix"></div>
							<hr class="line">
						</div>
						<div class="col-md-12 hidden-xs-up">
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
							<div class="clearfix"></div>
							<hr class="line">
						</div>
						<div class="col-md-12 ">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="agre" value="yes_i_agre" checked>
									<span>
										Saya setuju dengan <a class="forange" href="<?php echo base_url() ?>page/44/Syarat-Ketentuan">syarat ketentuan trumecs.</a>
									</span>
								</label>
							</div>
							<div class="clearfix"></div>
							<hr class="line">
						</div>
						<div class="col-md-12 ">
							<button type="submit" class="btn btn-orange">Kirim Testimonial</button>
							<div class="clearfix"></div>
							<hr class="line">
						</div>

					</form>


				<?php else : ?>
					<div class="col-md-12">
						<a href="<?php echo base_url() ?>member/testimonialform" class="btn btn-orange">Beri Testimonial</a>
					</div>
				<?php endif ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>