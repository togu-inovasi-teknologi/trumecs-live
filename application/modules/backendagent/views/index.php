<div class="product">
    <h2>Daftar Agen <!-- <a class="btn btn-orange" href="<?php echo site_url('backendprospek/admin/add'); ?>"><span class="fa fa-plus"></span></a> --></h2>
    <hr/>
    <div class="">
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered table-hover" width="100%;" style="margin-bottom:0px;" id="datatables">
                <thead class="f12 btn-orange">
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Domisili</th>
                      <th class="text-center">Produk</th>
                      <th class="text-center">Jenis</th>
                      <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="list-prospek"  data-lastid="<?php echo $list->num_rows() > 0 ? $list->row($list->num_rows() - 1)->id : 0 ?>">
                    <?php foreach($list->result() as $key=>$item): ?>
                    <tr class="f12" <?php echo $item->is_read == '0' ? 'style="background:#ccc;font-weight:bold"' : ''; ?>>
                        <td style="width:1%;" class="text-center">
                            <?php echo $item->id ?>
                        </td>
                        <td class="btn-black" style="width:25%;border-radius:0;">
                          <a href="<?php echo site_url('backendagent/detail/'.$item->id); ?>" style="color:#fff;"><?php echo $item->nama ?> <?php echo $item->is_read == '0' ? '<span class="label label-success" style="font-weight:bold">new</span>' : ''; ?></a>
                        </td>
                        <td style="width:20%;">
                            <?php echo $item->handphone ?>
                        </td>
                        <td class="text-center" style="width:20%;">
                            <?php echo $item->email ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->domisili ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->product ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->status ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->is_approved == 0 ? "Menunggu" : ($item->is_approved == 1 ? "Disetujui" : "Ditolak") ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="f12">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Domisili</th>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Jenis</th>
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