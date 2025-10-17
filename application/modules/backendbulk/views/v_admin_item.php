<div class="product container d-flex flex-column gap-3">
    <div class="row">
        <div class="col-lg-6">
            <h2>Daftar Kebutuhan Barang/Jasa</h2>
        </div>
        <div class="col-lg-6 text-right">
            <a href="<?= base_url('backendbulk/create/buyer') ?>" class="btn btn-orange">Buat Inquiry</a>
        </div>
    </div>
    <hr />
    <div class="">
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered table-hover display compact" width="100%;"
                style="margin-bottom:0px;" id="table-sourcing-item">
                <thead class="f12">
                    <tr>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Buyer</th>
                        <th class="text-center">Nama RFQ</th>
                        <th class="text-center">Nama Item</th>
                        <th class="text-center">Tujuan</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center" style="width:40px;">Harga</th>
                    </tr>
                </thead>
                <tbody class="f12">
                    <?php foreach ($list->result() as $item) : ?>
                    <tr class="f12"
                        <?php echo ($item->viewed != '1') ? ($item->viewed == '2') ? '' : 'style="background:#ccc;font-weight:bold"' : ''; ?>>
                        <td style="width:1%;" class="text-center">
                            <?php echo $item->id ?>
                        </td>
                        <td class="text-center" style="width:20%;">
                            <?php echo $item->company ?>
                        </td>
                        <td style="width:15%;border-radius:0;" class="text-center">
                            <a href=" <?php echo site_url('member/bulkPdf/' . $item->id); ?>"
                                target="_blank"><?php echo $item->nama_rfq ?></a>
                        </td>
                        <td class="text-center">
                            <?php echo $item->items ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->province ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->qty ?>
                        </td>
                        <td class="text-center">
                            <?php echo $item->uom ?>
                        </td>
                        <td class=" text-center">
                            <?php echo $item->status ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
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
function hapus(url, name) {
    var txt = "Apakah anda yakin ingin menghapus produk " + name + "?";
    var r = confirm(txt);
    if (r == true) {
        window.location.href = "<?php echo base_url() ?>backendproduct/hapus?id=" + url;
    }
};
</script>