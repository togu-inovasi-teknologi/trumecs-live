<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
?>
<h4 class=" fbold">Daftar Barang</h4>
<div class="tab-content">
	<div class="tab-pane active <?php echo ($this->agent->is_mobile()) ? "p-x-0" : ''; ?>" id="all" role="tabpanel">
		<table class="table text-left">
			<?php echo ($this->session->flashdata('message') == "") ? "" :
				'<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
				$this->session->flashdata('message') .
				'</div>'; ?>
			<thead>
				<tr>

					<th><strong>Nama produk</strong></th>
					<th><strong>Metode Pembayaran</strong></th>
					<th><strong>Jumlah</strong></th>
					<th><strong>Harga</strong></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total = 0;
				$totalw = 0;
				$totalweight = 0;
				$quantity = 0;
				$totaldimensi = 0;
				$form = 1;
				$watext = "";
				$no = 1;

				?>
				<?php foreach ($this->cart->contents() as $key):
					$watext .= $no . ". " . $key["name"] . " " . $key["qty"] . " " . $key["unit"] . "\n";
					$no++;
				?>
					<tr>
						<td>
							<a class="f12 fbold" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^A-Za-z0-9\-]/", "-", str_replace(" ", "-", ucwords($key["name"]))) ?>"><?php echo ucwords($key["name"]) ?>
								<?php echo $key["warranty"] != NULL ? "<br>- Gransi : " . $key["warranty"] : ""; ?>
							</a>
						</td>
						<td>
							<?php echo $key["method"] ?>
						</td>
						<td>
							<?php echo $key["qty"] ?> <?php echo $key["unit"] ?>
						</td>
						<td>Rp. <?php $totalprice = $key["price"] * $key["qty"];
								$total = $total + $totalprice;
								echo number_format($totalprice) ?></td>
						<td><a class=" delproduct" data-rowid="<?php echo $key["rowid"] ?>" data-produk="<?php echo $key["id"] ?>" data-rowid="<?php echo $key["rowid"] ?>" data-qty="0"><i class="bi bi-trash f12"></i></a>
						</td>
					</tr>
					<?php
					$totalpxyz = $key["px"] * $key["py"] * $key["pz"];
					$totaldimensi = $totaldimensi + $totalpxyz;
					$quantity = $quantity + $key["qty"];
					$totalw = $key["qty"] * str_replace(',', '.', $key["weight"]);;
					$totalweight = $totalweight + $totalw;
					?>
				<?php endforeach ?>
				<tr>
					<td colspan="4" class="text-right"><strong>Total Harga Rp. <?php echo number_format($total) ?></strong></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="tab-pane" id="ppn" role="tabpanel">
		<?php $this->load->view("ppn/_billingtabelppn") ?>
	</div>
	<div class="tab-pane" id="nonppn" role="tabpanel">
		<?php $this->load->view("ppn/_billingtabelnonppn") ?>
	</div>
</div>
<?php if ($sessionmember['id'] == null):  ?>
	<hr />
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-info">
				Anda belum terdaftar sebagai member. Lengkapi formulir di bawah ini untuk mendaftar sebagai member baru dan melanjutkan proses order anda. <br />
			</div>
			Sudah punya akun? <a class="btn btn-orange" href="<?php echo site_url('member/login'); ?>">Login</a>
		</div>
	</div>
<?php endif; ?>
<hr />
<form class="formshipping" action="<?php echo base_url() ?>cart/setshipping" method="POST">
	<h4 class=" fbold">Penerima Barang</h4>
	<div class="row">
		<div class="col-md-12">
			Nama<sup>*</sup>
			<input type="text" class="form-control" name="name" tocopy="tocopy" value="<?php echo $sessionmember["name"]; ?>" required>
		</div>
		<div class="col-md-12 m-t-1">
			Nama Perusahaan
			<input type="text" class="form-control" name="company" tocopy="tocopy" value="<?php echo $sessionmember["Company"]; ?>">
		</div>
		<div class="col-md-12 m-t-1">
			Nomor Telepon<sup>*</sup>
			<input type="text" class="form-control" name="phone" tocopy="tocopy" value="<?php echo $sessionmember["phone"]; ?>" required>
		</div>
		<?php if ($sessionmember['id'] == null): ?>
			<div class="col-md-12 m-t-1">
				Email<sup>*</sup>
				<input type="text" class="form-control" name="email" tocopy="tocopy" value="" required>
			</div>
			<div class="col-md-12 m-t-1">
				Password<sup>*</sup>
				<input type="text" class="form-control" name="password" tocopy="tocopy" value="" required>
			</div>
		<?php endif; ?>
	</div>
	<hr />
	<div class="row m-t-2">
		<div class="col-md-12">
			<h4 class=" fbold">Pilih Alamat</h4>
		</div>
		<div class="col-md-12 control-group " id="accordion">
			<?php foreach ($address_shipping as $key): ?>

			<?php endforeach ?>

			<div class="panel panel-default">
				<div id="addnew" role="tabpanel">
					<!-- <form class="formshipping" action="<?php echo base_url() ?>cart/setshipping_jne" method="POST"> -->
					<div class="hidden">
						<input type="hidden" name="address_shipping" value="new" required>
						<input type="hidden" name="method" value="trumecs" required>
						<input type="hidden" class="form-control" name="name" value="<?php echo $sessionmember["name"]; ?>" required>
						<input type="hidden" class="form-control" name="company" value="<?php echo $sessionmember["Company"]; ?>">
						<input type="hidden" class="form-control" name="phone" value="<?php echo $sessionmember["phone"]; ?>" required>
					</div>

					<div class="row">
						<div class="col-md-12">
							Alamat<sup>*</sup>
							<textarea class="form-control" name="shipping_address" required><?php echo $sessionmember["shipping_address"]; ?></textarea>
						</div>
						<div class="col-md-12 m-t-1">
							Provinsi<sup>*</sup>
							<select class="form-control " name="shipping_province" required id="<?php echo $sessionmember["shipping_idprovince"]; ?>">
								<option value="">--Pilih Provinsi--</option>
								<?php foreach ($provinces as $key): ?>
									<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-md-12 m-t-1">
							Kabupaten<sup>*</sup>
							<select class="form-control " name="shipping_city" required id="<?php echo $sessionmember["shipping_idcity"]; ?>">
								<option value="">--Pilih Kota--</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 m-t-1">
							Kecamatan<sup>*</sup>
							<select class="form-control " name="shipping_districts" required id="<?php echo $sessionmember["shipping_iddistricts"]; ?>">
								<option value="">--Pilih Kecamatan--</option>
							</select>
						</div>
						<div class="col-md-12 m-t-1">
							Kelurahan<sup>*</sup>
							<select class="form-control  " name="shipping_village" required id="<?php echo $sessionmember["shipping_idvillage"]; ?>">
								<option value="">--Pilih Desa--</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 m-t-1">
							Kodepos<sup>*</sup>
							<input type="text" class="form-control" name="shipping_kodepos" value="<?php echo $sessionmember["shipping_kodepos"]; ?>" required>
						</div>

					</div>
					<!-- <br>
				<div class="text-center loadernewaddress" style="display:none">
					<span class="modal-text">Sedang mengambil data..</span><br><img width="70px" src="<?php echo base_url() ?>public/image/252.gif">
				</div>
				<div class="resultjneservice">Isi terlebih dahulu alamat dengan lengkap, untuk mendapatkan pilihan service JNE.</div> -->
					<!-- </form>	 -->
				</div>

			</div>


			<div class="info">
				<hr>
				<small>
					*Pengiriman sementara hanya berlaku untuk JABODETABEK.<br>
					*Estimasi pengiriman 1 s/d 3 hari (paling lama), setelah pembayaran diterima.<br>
					<!-- *Gunakan pengiriman luar JABODETABEK dengan <a class="forange" href="<?php echo base_url() ?>cart/shipping_jne">Pengiriman JNE</a> -->
				</small>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<br />
	<?php if ($sessionmember['id'] == null): ?>
		<button class="btn btn-orange">Daftar & Order</button>
	<?php else: ?>
		<!-- <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi tokomo, saya mau order:\n" . $watext) ?>" class="btn btn-orange pull-right fbold"><i class="fa fa-whatsapp fa-2x" style="vertical-align:middle"></i> Kirim order via WA</a> -->
		<!-- <a href="" onCLick="return waorder()" class="btn btn-orange pull-right fbold"><i class="fa fa-whatsapp fa-2x" style="vertical-align:middle"></i> Kirim order via WA</a> -->
		<button class="btn btn-orange">Checkout</button>
	<?php endif; ?>
</form>
<script>
	var name = document.getElementsByName("name").value;
	var company = document.getElementsByName("company").value;
	var phone = document.getElementsByName("phone").value;

	var address = document.getElementsByName("shipping_address").value;
	var kodepos = document.getElementsByName("shipping_kodepos").value;

	var province = document.getElementById("shipping_province").options[document.getElementById("shipping_province").selectedIndex].innerHTML;
	var city = document.getElementById("shipping_city").options[document.getElementById("shipping_city").selectedIndex].innerHTML;
	var district = document.getElementById("shipping_districts").options[document.getElementById("shipping_districts").selectedIndex].innerHTML;
	var village = document.getElementById("shipping_village").options[document.getElementById("shipping_village").selectedIndex].innerHTML;

	function waorder() {
		alert("asdasd");
		window.location = "https://wa.me/6282122668008?text=" + address + '\n' + village + ', ' + district + ', ' + city + ', ' + province + ' ' + kodepos;
		return false;
	}
</script>