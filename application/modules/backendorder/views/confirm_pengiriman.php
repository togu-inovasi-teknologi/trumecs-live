<div class="delivery-content m-t-3 p-t-3">
    <div class="row">
        <div class="col-lg-12">
            <?php if($this->session->flashdata('error_save_delivery_data')) : ?>
            <div class="alert alert-danger" role="alert">
                <a href="#" class="alert-link"><?= $this->session->flashdata('error_save_delivery_data') ?></a>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-12">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('backendorder/save_delivery') ?>">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                <input type="hidden" name="iduniq" value="<?= $order['iduniq'] ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="fbold">Bukti Pengiriman</h4>
                        <hr>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="shipping_resi">Resi Pengiriman</label>
                            <input type="text" class="form-control" id="shipping_resi"
                                placeholder="Masukan Resi Pengiriman" name="shipping_resi">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-a-3 d-flex flex-column align-items-center justify-content-center gap-2">
                            <i class="fa fa-fw fa-folder fa-3x text-muted"></i>
                            <i class="f12 text-muted">Upload Dokument Pengiriman</i>
                            <label for="file_delivery" class="btn btnnew btn-sm">Upload</label>
                            <input type="file" name="file_delivery" id="file_delivery" style="display: none">
                            <p class="f14 text-muted" id="file_delivery_name"></p>
                        </div>
                    </div>
                </div>

                <div class="row m-b-1">
                    <div class="col-lg-12 text-right">
                        <hr>
                        <button type="submit" class="btn btnnew">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>