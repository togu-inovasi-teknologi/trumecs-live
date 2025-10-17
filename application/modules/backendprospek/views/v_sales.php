<div class="product">
    <h1 class="f18">Daftar Pospek Saya : .</h1>
	<div class="row">
	<input type="hidden" name="status" value="<?php echo $this->input->get('status') ?>" />
		<div class="col-xs-12 table-responsive">
			<table class="table table-sm table-striped table-bordered table-hover" cellspacing="2" width="100%">
			  <thead class="btn-black">
			    <tr>
			      <th class="text-center" style="max-width:30px"><small><strong>No</strong></small></th>
			      <th class="text-center"><small><strong>Nama Perusahaan</strong></small></th>
			      <th class="text-center"><small><strong>Phone</strong></small></th>
                  <th class="text-center"><small><strong>Email</strong></small></th>
                  <th class="text-center"><small><strong>Nama PIC</strong></small></th>
			      <th class="text-center"><small><strong>PIC Phone</strong></small></th>
			      <th class="text-center"><small><strong>PIC Email</strong></small></th>
			      <th class="text-center"><small><strong>Company Address</strong></small></th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php foreach($list->result() as $key=>$item): ?>
			    <tr>
                    <td class="text-center"><small><input type="checkbox"/></small></td>
			      <td><small><a href="<?php echo site_url('backendprospek/sales/detail/'.$item->id); ?>" class="fbold"><?php echo $item->company ?></a></small>
			      </td>
                    <td class="text-center"><small><?php echo $item->company_phone ?></small></td>
                    <td class="text-center"><small><?php echo $item->company_email ?></small></td>
			      <td class="text-center"><small><?php echo $item->name ?></small></td>
			      <td class="text-center"><small><?php echo $item->phone ?></small></td>
			      <td class="text-center"><small><?php echo $item->email ?></small></td>
			      <td><small><?php echo $item->company_address ?></small></td>
			    </tr>
                  <?php endforeach; ?>
			  </tbody>
			</table>
		</div>
		
	</div>
</div>
<script type="text/javascript">
function hapus (url,name) {
	var txt ="Apakah anda yakin ingin menghapus produk "+name+"?";
	var r = confirm(txt);
	if (r == true) {
		window.location.href ="<?php echo base_url() ?>backendproduct/hapus?id="+url;
	}
};
</script>