<div class="product">
    <h2>Daftar Pospek <a class="btn btn-orange" href="<?php echo site_url('backendprospek/admin/add'); ?>"><span class="fa fa-plus"></span></a></h2>
    <hr/>
    <div class="">
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered table-hover" width="100%;" style="margin-bottom:0px;" id="datatables">
                <thead class="f12 btn-orange">
                    <tr>
                      <th class="text-center">Kode</th>
                      <th class="text-center">Nama Perusahaan</th>
                      <th class="text-center">Nama PIC</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Sales</th>
                      <th class="text-center">Validitas</th>
                      <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="list-prospek"  data-lastid="<?php echo $list->row()->id ?>">
                    <?php foreach($list->result() as $key=>$item): ?>
                    <tr class="f12" <?php echo $item->viewed == '0' ? 'style="background:#ccc;font-weight:bold"' : ''; ?>>
                        <td style="width:1%;" class="text-center">
                            <?php echo $item->id ?>
                        </td>
                        <td class="btn-black" style="width:25%;border-radius:0;">
                          <a href="<?php echo site_url('backendprospek/admin/detail/'.$item->id); ?>" style="color:#fff;"><?php echo $item->company ?> <?php echo $item->viewed == '0' ? '<span class="label label-success" style="font-weight:bold">new</span>' : ''; ?></a>
                        </td>
                        <td style="width:20%;">
                            <?php echo $item->name ?>
                        </td>
                        <td class="text-center" style="width:20%;">
                            <?php echo $item->phone ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->sales_name ?>
                        </td>
                        <td class="btn-<?php echo $item->valid == 0 ? 'danger' : 'success' ?> text-center">
                            <?php echo $item->valid == 0 ? 'Belum Diperiksa' : ($item->valid == 1 ? 'Valid' : 'Tidak Valid') ?>
                        </td>
                        <td class="btn-<?php echo $item->status == 0 ? 'danger' : 'success' ?> text-center">
                            <?php echo $item->status == 0 ? 'Belum Dihubungi' : 'Sudah Dihubungi' ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="f12">
                    <tr>
                      <th class="text-center">Nama Perusahaan</th>
                      <th class="text-center">Nama PIC</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Sales</th>
                      <th class="text-center">Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--<div class="card-footer text-right">
            <a class="btn btn-white btn-sm"><span class="fa fa-chevron-left"></span></a>
            <a class="btn btn-white btn-sm"><span class="fa fa-chevron-right"></span></a>
        </div>-->
    </div>
	<div class="row">
	<input type="hidden" name="status" value="<?php echo $this->input->get('status') ?>" />
		
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