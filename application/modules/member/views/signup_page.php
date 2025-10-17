<div id="member_page">
	<div class="row">
		<div class="col-lg-12">
			<div class="row ">
				<?php if ($this->agent->is_mobile()) : ?><div class="col-md-12 m-t-1 ">
						<div class="clearfix"></div>
					</div>
				<?php endif ?>
				<?php if (!$this->agent->is_mobile()) : ?>
					<div class="col-md-7 ">
						<img src="<?php echo base_url() ?>public/image/signup-benner.png" class="img-fluid" style="height:450px;">
						<div>
							<hr>
							<h2 class="f16 fbold"><?php echo $this->lang->line("signup_point_title", FALSE); ?></h2>
							<ul>
								<li><?php echo $this->lang->line("signup_point_1", FALSE); ?></li>
								<li><?php echo $this->lang->line("signup_point_2", FALSE); ?></li>
								<li><?php echo $this->lang->line("signup_point_3", FALSE); ?></li>
							</ul>
						</div>
					</div>
				<?php endif ?>
				<div class="col-md-5 ">
					<?php if (!$this->agent->is_mobile()) : ?>
						<div class="card" style="width: 100%; height:50px">
							<div class="col-md-6 text-center" style="margin-top:10px; text-underline-offset: 10px;">
								<a href="<?php echo base_url("member/login") ?>" style="color: black;">
									<?php echo $this->lang->line("masuk", FALSE); ?>
								</a>
							</div>
							<div class="col-md-6 text-center" style="margin-top:10px; text-underline-offset: 10px;">
								<a href="<?php echo base_url("member/signup") ?>" class="colornav">
									<u><?php echo $this->lang->line("daftar", FALSE); ?></u>
								</a>
							</div>
						</div>
					<?php endif ?>
					<div class="card p-a-1">
						<div class="row">
							<?php $this->load->view("_form_signup_page") ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>