<div class="historypesanan">
	<div class="col-lg-12">
		<?php echo ($this->session->flashdata('message') == "") ? "" :
			'<div class="alert alert-warning">' .
			$this->session->flashdata('message') .
			'</div>'; ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<strong class="f22">List Konfirmasi Pembayaran</strong>
		</div>
		<div class="col-lg-12">
			<div class="card borderdesk p-a-1 m-t-1 f14">
				<div class="row">
					<div class="col-lg-12 ">
						<div class="row">
							<div class="col-lg-6">
								<strong class="f18">List Pembayaran</strong>
							</div>
							<div class="col-lg-6">
								<a class="btn btnnew pull-right" href="<?php echo base_url() ?>member/confirmation">Konfirmasi Pembayaran</a>
							</div>
							<div class="col-lg-12">
								<table class="table table-hover m-t-1">
									<thead>
										<tr>
											<th>No.</th>
											<th>ID Order</th>
											<th>Tanggal</th>
											<th>Jumlah</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										?>
										<?php foreach ($list as $key) : ?>
											<?php
											$status = $key["status"];
											$status_css = ($key["status"] != "approved") ? ($key["status"] == "rejected") ?  "danger" : "warning" : "success";
											?>
											<tr scope="row">
												<td><?php echo $i ?></td>
												<td><?php echo $key["idorder"] ?></td>
												<td><?php echo $key["date"] ?></td>
												<td>Rp.<?php echo number_format($key["money"]) ?></td>
												<td><span class="label label-<?php echo $status_css ?>"><?php echo $status ?></span></td>
												<td class="f16">
													<?php if ($key["status"] == "new") : ?>
														<a href="<?php echo base_url() ?>member/confirmation_edit/<?php echo $key["id"] ?>" class="m-l-1 text-center f12" style="color: #ff9900; padding:3px 7px;border: 1px solid #ff9900; border-radius:50%;"><i class="fa fa-pencil"></i></a>
													<?php endif ?>
												</td>
											</tr>
											<?php $i++ ?>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>