<div class="cart_page <?php echo ($this->agent->is_mobile()) ? "row" : ""; ?>">
	<div class="col-lg-12">
		<?php if ($this->agent->is_mobile()): ?>
		<?php else: ?>
			<ol class="breadcrumb ">
				<li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
				<li><a class="forange" href="<?php echo base_url() ?>cart">Keranjang</a></li>
				<li><a class="forange" href="<?php echo base_url() ?>cart/shipping">Shipping</a></li>
				<li>Billing Informasi</li>
			</ol>
		<?php endif ?>
		<h1 class="f22 fbold">Billing Informasi</h1>
		<div class="row">
			<div class="col-lg-12 text-center">
				<?php if (count($this->cart->contents()) != 0): ?>
					<div class="row">
						<div class="col-lg-8 <?php echo ($this->agent->is_mobile()) ? "p-x-0 table-responsive" : ''; ?>">
							<ul class="nav nav-tabs " id="tabtabel" role="tablist">
								<!-- <li class="nav-item active">
								<a class="nav-link " data-toggle="tab" href="#all" role="tab">SEMUA</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#ppn" role="tab">HARGA PPN</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#nonppn" role="tab">HARGA NON PPN</a>
							</li> -->
							</ul>

							<!-- Tab panes -->
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
											?>
											<?php foreach ($this->cart->contents() as $key): ?>
												<tr>
													<td>
														<a class="f12 fbold" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^A-Za-z0-9\-]/", "-", str_replace(" ", "-", ucwords($key["name"]))) ?>"><?php echo ucwords($key["name"]) ?>
															[ <?php echo $key["partnumber_product"] ?> ] <?php echo $key["warranty"] != NULL ? "<br>- Gransi : " . $key["warranty"] : ""; ?>
														</a>
													</td>
													<td>
														<?php echo $key["qty"] ?>
													</td>
													<td>Rp. <?php $totalprice = $key["price"] * $key["qty"];
															$total = $total + $totalprice;
															echo number_format($totalprice) ?></td>
													<td><a class="btn btn-circle  btn-sm btn-orange delproduct" data-rowid="<?php echo $key["rowid"] ?>" data-produk="<?php echo $key["id"] ?>" data-rowid="<?php echo $key["rowid"] ?>" data-qty="0"><i class="bi bi-trash f12"></i></a>
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
												<td></td>
												<td><strong>Total Harga</strong></td>
												<td>Rp. <?php echo number_format($total) ?></td>
												<td></td>
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
							<div class="m-y-1  alert alert-warning text-left <?php echo ($this->agent->is_mobile()) ? "m-x-1" : ''; ?>">
								<?php if ($datashipping["shipping_description"] == "pickup"): ?>
									<div class=" text-center">
										<strong>Barang diambil di Market Store Trumecs</strong><br>
										<p>Jl. Jendral Sudirman Km 31, Bekasi<br>Jawa Barat</p>
										<a target="_blank" href="https://www.google.co.id/maps/place/Trumecs/@-6.230972,106.9847767,17z/data=!4m2!3m1!1s0x2e698c15bda9cbef:0x76c72e744f4ccba8?hl=en">Lihat Peta</a>
										<br>
										<small>
											*Wajib membawa bukti invoice pemenasan untuk pengambilan pesanan ini.<br>
											*Waktu pengambilan akan di informasikan setelah Anda melakukan proses Konfirmasi Pembayaran.<br>
										</small>
									</div>
								<?php else: ?>
									<strong>Pengiriman Barang</strong><br>
									<table class="table text-left">
										<tbody class=" table-chart-detail ">
											<tr>
												<td>Nama</td>
												<td>:</td>
												<td><?php echo $datashipping["shipping_name"] ?></td>
											</tr>
											<tr>
												<td>Perusahaan</td>
												<td>:</td>
												<td><?php echo $datashipping["shipping_company"] ?></td>
											</tr>
											<tr>
												<td>Telepon</td>
												<td>:</td>
												<td><?php echo $datashipping["shipping_phone"] ?></td>
											</tr>
											<tr>
												<td>Alamat</td>
												<td>:</td>
												<td><?php echo $datashipping["shipping_address"] ?> - <?php echo $datashipping["shipping_kodepos"] ?></td>
											</tr>

											<tr>
												<td>Pengiriman</td>
												<td>:</td>
												<td><?php echo strtoupper($datashipping["shipping_description"]) ?></td>
											</tr>
										</tbody>
									</table>
									<small>
										*Trumecs akan menghubungi nomor telpon Anda: <?php echo $datashipping["shipping_phone"] ?> pada hari dan jam kerja untuk <strong>konfirmasi pembelian dan ongkos kirim</strong>.<br>
										*Anda juga bisa menghubungi kami via telepon atau Whatsapp di 0821 2266 8008 untuk informasi lebih lanjut.<br>
									</small>

								<?php endif ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="cardresult p-y-1">
								<div class="row">
									<div class="xs-12">
										<div class="col-lg-12 col-xs-12">
											<div class="col-xs-12">
												<strong class="f18 ">Detail Belanja</strong>

												<table class="table text-left">
													<tbody class="table-chart-detail ">
														<tr>
															<td><strong>Total Item</strong></td>
															<td><?php echo number_format($quantity); ?></td>
														</tr>
														<tr>
															<td><strong>Total Berat</strong></td>
															<td><?php echo number_format($totalweight); ?> Kg</td>
														</tr>
														<tr>
															<td><strong>Biaya Pengiriman</strong><br>
																<small><?php echo strtoupper($datashipping["shipping_description"]) ?></small>
															</td>
															<!-- <td><?php //echo  ($datashipping["shipping_description"]=="pickup") ? "FREE" : "Rp.". number_format($datashipping["shipping_cost"]); 
																		?></td> -->
															<td>Menunggu konfirmasi</td>
														</tr>
														<tr>
															<td><strong>Total Harga </strong></td>
															<td>Rp. <?php echo number_format($total) ?></td>
														</tr>
														<tr>
															<td colspan="2"><small><?php //echo strtoupper("Total harga sudah termasuk PPN dari setiap produk yang memiliki PPN") 
																					?></small></td>
														</tr>
													</tbody>
												</table>
												<hr class="m-a-0">
												<table class="table text-left">
													<tbody class=" table-chart-detail">
														<tr>
															<td><strong>Total Pembayaran</strong></td>
															<?php $totaldelivery = ($datashipping["shipping_description"] == "pickup") ? 0 : ($datashipping["shipping_cost"]) ?>
															<td>Rp. <?php echo number_format($total + $totaldelivery) ?></td>
														</tr>

													</tbody>
												</table>


											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="xs-12">
										<div class="col-lg-12 col-xs-12">
											<div class="col-xs-12">
												<a id="one_click" href="<?php echo base_url() ?>cart/chekout" class="btn btn-orange col-lg-12 col-xs-12 proccessshow">Simpan Order</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php else: ?>
					<strong class="f12 fbold forange">Belum ada barang yang masuk di keranjang belanja.</strong><br><br>
					<strong class="f12 fbold forange">beli separepart mudah</strong>
					<div class="row ">
						<div class="col-lg-3 col-md-3"></div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  vertical-center">
							<img src="<?php echo base_url() ?>public/image/icon/icon-kemudahan.png" class="img-fluid">
							<hr>
						</div>
					</div>
				<?php endif ?>
				<div class="row ">
					<div class="col-lg-3 col-md-3">
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center vertical-center">
						<strong class="f12 fbold forange">Pembayaran</strong>
						<img class="img-fluid text-center" src="<?php echo base_url() ?>public/image/icon/bank+debit.png" alt="Trumecs">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>