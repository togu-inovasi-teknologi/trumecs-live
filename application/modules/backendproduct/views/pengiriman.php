<div class="category row"  style="margin-top:60px">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<strong class="f22">Asal Pengiriman</strong>
			</div>
			<div class="col-md-8">
            <a href="<?php echo base_url() ?>backendproduct/pengiriman/form" class="btn btn-orange pull-right">Tambah Asal Pengiriman</a>
			</div>
		</div>
	</div>
</div>
<hr class="p-a-2">
<div class="row">
    <div class="col-xs-12 table-responsive">
        <table id="table-pengiriman" class="table table-striped table-bordered table-hover" cellspacing="2" width="100%">
            <thead>
            <tr>
                <th>Asal Pengiriman</th>
                <th>Keterangan</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($listfilter)): ?>
            <?php foreach ($listfilter as $key): ?>
            <tr>
                <td><a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="fbold f14 forange"><?php echo $key["title"] ?></a><br>
                </td>
                <td>
                <a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a href="<?php echo base_url() ?>backendpage/hapus?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
            <?php else: ?>
            <tr><td colspan="9">Tidak ada data</td></tr>
            <?php endif ?>
            </tbody>
        </table>
    </div>
    <!--<div class="col-xs-12 text-center">
        <?php //echo !empty($listfilter)?$links: "";  ?> 
    </div>-->
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