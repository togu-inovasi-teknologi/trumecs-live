<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <p class="f20 fbold">Detail Pesanan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-a-1">
                    <div class="row">
                        <div class="col-md-12 ">
                            <table class="table table-sm table-striped table-bordered m-a-0">
                                <tbody>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <td>: #<?php echo ($detail->iduniq) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal </th>
                                        <td>: <?php echo ($detail->time) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Jatuh Tempo</th>
                                        <td>: <?php echo ($detail->expired) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>: <?= $this->lang->line($detail->status, FALSE) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('backendorder/detail/billing_and_shipping', ['detail' => $detail]) ?>

        <div class="row">
            <div class="col-md-12">
                <p class="f20 fbold">Catatan</p>
            </div>

            <div class="col-md-12">
                <div class="card p-a-1">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="order-form" action="<?php echo base_url() ?>backendorder/updateorder"
                                method="POST">
                                <div class="col-md-10">
                                    <input type="hidden" name="id" value="<?php echo $detail->id ?>">
                                    <input type="hidden" name="iduniq" value="<?php echo $detail->iduniq ?>">
                                    <textarea name="comment"
                                        class="form-control"><?php echo $detail->comment ?></textarea>

                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-orange">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>