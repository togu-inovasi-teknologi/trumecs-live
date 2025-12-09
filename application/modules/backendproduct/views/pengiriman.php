<div class="category row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <strong class="fs-4">Asal Pengiriman</strong>
            </div>
            <div class="col-md-8 text-end">
                <a href="<?php echo base_url() ?>backendproduct/pengiriman/form" class="btn btn-warning">Tambah Asal Pengiriman</a>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">
<div class="row">
    <div class="col-12 table-responsive">
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
                            <td>
                                <a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="fw-bold fs-6 text-warning text-decoration-none">
                                    <?php echo $key["title"] ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $key["description"] ?? ''; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() ?>backendpage/form?id=<?php echo $key["id"] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo base_url() ?>backendpage/hapus?id=<?php echo $key["id"] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus asal pengiriman <?php echo $key["title"] ?>?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <!--<div class="col-12 text-center">
		<?php //echo !empty($listfilter)?$links: "";  
        ?> 
	</div>-->
</div>
<script type="text/javascript">
    function hapus(url, name) {
        var txt = "Apakah anda yakin ingin menghapus asal pengiriman " + name + "?";
        var r = confirm(txt);
        if (r == true) {
            window.location.href = "<?php echo base_url() ?>backendpage/hapus?id=" + url;
        }
    };
</script>