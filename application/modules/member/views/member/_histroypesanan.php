 <div class="row historypesanan">
 	<div class="col-md-12">
 		<strong class="f22">Riwayat Pesanan</strong>
 		<hr>
 	</div>
 	<div class="col-md-12 table-responsive">
 		<!-- 
			<?php if (count($listhistory) > 0) : ?>
		    	<?php foreach ($listhistory as $key) : ?>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="card p-t-1">
		    				<div class="col-md-2">
		    					<div class="alert alert-warning">
		    					<small>ID ORDER</small><br>
		    					<strong><?php echo $key["iduniq"] ?></strong>
		    					</div>
		    				</div>
		    				<div class="col-md-7">
		    					<div class="alert alert-warning">
		    						<div class="row">
			    						<div class="col-md-6">
			    							<small>
				    						Tanggal pesanan : <?php echo $key["time"] ?><br>
				    						Tanggal expired : <?php echo $key["expired"] ?>
				    						</small>
			    						</div>
			    						<div class="col-md-6">
			    							<small>status:</small><strong><?php echo $key["status"] ?></strong>
			    						</div>
		    						</div>
		    					</div>
		    				</div>
		    				<div class="col-md-3">
		    					<a href="<?php echo base_url() ?>member/history_order/<?php echo $key["iduniq"] ?>" class="btn btn-sm btn-secondary"><i class="fa fa-list-alt"></i> Lihat Pesanan</a>
		    					<hr class="m-y-05">
		    					<?php if ($key["status"] == "unpaid") {
									echo '
		    							<a href="' . base_url() . 'member/confirmation" class="btn btn-sm btn-orange"><i class="fa fa-credit-card"></i> Konfirmasi Bayar</a>
		    						';
								} else if ($key["status"] == "delivery") {
									echo '
				    					<a href="" class="btn btn-sm btn-orange"><i class="fa fa-check"></i> Sudah Terima</a>
				    					';
								} ?>
		    				</div>
		    				<div class="clearfix"></div>
		    			</div>
		    		</div>
		    		
		    	</div>
		    	<?php endforeach ?>
		    <?php else : ?>
		    	Anda belum memiliki pesanan
		    <?php endif ?> -->
 		<table class="table table-hover">
 			<thead>
 				<tr>
 					<th>Id Order</th>
 					<th>Tanggal Order</th>
 					<th>Jatuh Tempo</th>
 					<th>Status</th>
 					<th></th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php if (count($listhistory) > 0) : ?>
 					<?php foreach ($listhistory as $key) : ?>
 						<tr>
 							<td><a class="forange fbold" href="<?php echo base_url() ?>member/history_order/<?php echo $key["iduniq"] ?>"><?php echo $key["iduniq"] ?></a></td>
 							<td><?php echo $key["time"] ?></td>
 							<td><?php echo $key["expired"] ?></td>
 							<td><a class="label label-<?php echo ($key["status"] == "unpaid") ? "default" : "success"; ?>"><?php echo $key["status"] ?></a></td>
 							<td><?php echo (!empty($key["comment"])) ? '<a class="label label-warning">ada komentar</a >' : ""; ?></td>
 						</tr>
 					<?php endforeach ?>
 				<?php else : ?>
 					<tr>
 						<td colspan="5">Anda belum memiliki pesanan</td>
 					</tr>
 				<?php endif ?>
 			</tbody>

 		</table>
 	</div>

 </div>
 <style type="text/css">
 	.m-y-05 {
 		margin-top: 0.5rem;
 		margin-bottom: 0.5rem;
 	}
 </style>