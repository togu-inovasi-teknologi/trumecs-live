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
	<div class="formtestimonial">
		<form action="<?php echo base_url() ?>member/senttestimonial" method="POST" enctype="multipart/form-data">
			<div class="col-md-12 ">
				<div class="card p-a-1">
					<div class="col-md-12">
						<label class="fbold">Testimoni</label>
						<textarea name="testimonial" class="form-control" rows="6" placeholder="Berikan Pendapat kalian tentang kami..."></textarea>
					</div>
					<div class="col-md-12 text-center m-t-1">
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
					<hr>
					<div class="col-md-12">
						Bukti Transfer<a style="color: red;">*</a><br>
						<small>Gambar(.jpg)/File(.pdf)</small>
					</div>
					<div class="col-md-12">
						<img src="" class="blah img-fluid">
					</div>
					<br>
					<div class="col-md-12 m-t-1">
						<input type="file" id="uploadBtn" name="fileconfirmation" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
						<a href="#" id="filetext" name="file" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
					</div>
					<hr>
					<div class="col-md-12 m-t-1">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="agre" value="yes_i_agre" checked>
								<span class="f14">
									Saya setuju dengan <a class="forange" href="<?php echo base_url() ?>page/44/Syarat-Ketentuan">syarat ketentuan trumecs.</a>
								</span>
							</label>
						</div>
					</div>
					<br>
					<div class="col-md-12 ">
						<button type="submit" class="btn btnnew btn-block proccessshow" modal-text="Terimakasih, Testimoni Anda sedang disimpan">Kirim Testimonial</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>