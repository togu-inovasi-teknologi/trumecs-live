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
	</div>
	<div class="card col-md-12 p-a-1 text-center">
		<strong class="f22">List Testimonial</strong>
	</div>
	<div class="text-center">
		<a class="btn btnnew btn-block" href="<?php echo base_url() ?>member/testimonialform">Beri Testimoni</a>
	</div>
	<div class="m-t-1">
		<?php foreach ($testimonial as $key) : ?>
			<div class="card col-md-12 p-a-1">
				<div class="row">
					<div class="col-md-12">
						<img src="<?php echo base_url() ?>public/image/testimonial-trumecs.png" class="img-circle" width="50" height="50">
						<span><?php echo $key["name"] ?></span>
						<?php if ($key["emote"] == "senang") : ?>
							<i class="fa fa-smile-o"></i>
						<?php else : ?>
							<i class="fa fa-meh-o"></i>
						<?php endif ?>
						<br>
						<small><?php echo $key["date"] ?></small>
					</div>
					<div class="col-md-12">
						<p class="f16 fbold"><?php echo $key["content"] ?></p>
						<?php if ($key["type"] == '.png' || $key["type"] == '.jpg') { ?>
							<img src="<?php echo base_url('public/image/member/testimonial/' . $key["file"]); ?>" />
						<?php } else { ?>
							<video height="240" width="310" controls>
								<source src="<?php echo base_url('public/image/member/testimonial/' . $key["file"]); ?>" type="video/mp4">
							</video>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>