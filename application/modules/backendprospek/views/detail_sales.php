<div class="detail">
    <h1 class="f22">Detail Prospek : <?php echo ($data->row()->company) ?></h1>
	<div class="col-md-6">
		<div class="row">
			<table class="f14">
				<tbody>
					<tr>
						<td>Nama</td>
						<td>: <?php echo ($data->row()->name) ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>: <?php echo ($data->row()->email) ?></td>
					</tr>
					<tr>
						<td>Telphone</td>
						<td>: <?php echo ($data->row()->phone) ?></td>
					</tr>
					<tr>
						<td>Perusahaan</td>
						<td>: <?php echo ($data->row()->company) ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo ($data->row()->company_address) ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>: <?php echo ($data->row()->status) ?></td>
					</tr>
					<tr>
						<td>Keterangan</td>
						<td>: <?php echo ($data->row()->additional_information) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
    <div class="col-md-12">
		<div class="card row">
			<div class="col-md-12 m-y-1">
				<strong>Aksi Sales</strong>
				<hr>
				<a data-toggle="modal" data-target="#myModal" class="btn btn-orange">Set Visit</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
    <div class="clearfix"></div>
	<div class="">
		<strong>List Visit (<?php echo $visit->num_rows() ?>)</strong>
		<table class="table table-sm" id="tablelist">
			<thead class="btn-black">
				<tr>
					<th>Tanggal</th>
					<th>Lampiran</th>
					<th>Keterangan</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($visit)) { ?>
				<?php foreach ($visit->result() as $key=>$item ): ?>
				<tr>
					<td>
                        <a target="_blank" class="fbold forange" href="<?php echo base_url() ?>backendorder/detail/<?php echo $item->id ?>"><?php echo $item->visit_date ?></a>
                    </td>
					<td><?php echo $item->is_close ?></td>
					<td><?php echo $item->keterangan ?> </td>
					<td><?php echo $item->is_close ?></td>
				</tr>
				<?php endforeach ?>
				<?php }else{echo "<tr><td>Belum ada visit</td></tr>";} ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url() ?>backendprospek/sales/set_visit" method="post" enctype="multipart/form-data">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <input class="form-control" name="id_prospek" type="hidden" value="<?php echo ($data->row()->id) ?>" required>
                        <textarea class="form-control" name="keterangan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Lampiran</label>
                        <input class="form-control" type="file" name="lampiran">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="is_closing" value="1"> Closing
                    </div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
    </form>
  </div>
</div>