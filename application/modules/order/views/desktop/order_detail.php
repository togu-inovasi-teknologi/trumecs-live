<div class="row">
    <input type="hidden" name="order_id" value="<?= $order->id ?>">
    <div class="col-lg-12">
        <?php if ($this->session->flashdata('error_uploaded_po')) : ?>
            <div class="alert alert-danger">'
                <?= $this->session->flashdata('error_uploaded_po') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-12">
        <?= alert_status_buyer((array) $order) ?>
    </div>

    <div class="col-lg-12">
        <div class="card p-a-1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-12">
                            <h4 class="m-a-0">ID - <?= $order->iduniq ?></h4>


                        </div>
                        <div class="col-lg-6 text-right">
                            <?php if ($order->status == 'waiting_po') : ?>
                                <span style="padding: 5px;" class="f12 bg-tru-primary"><?= $this->lang->line($order->status, FALSE) ?></span>
                            <?php elseif ($order->status == 'waiting_invoice') : ?>
                                <span style="padding: 5px;" class="f12 bg-primary"><?= $this->lang->line($order->status, FALSE) ?></span>
                            <?php elseif ($order->status == 'waiting_payment') : ?>
                                <span style="padding: 5px;" class="f12 bg-warning"><?= $this->lang->line($order->status, FALSE) ?></span>
                            <?php elseif ($order->status == 'waiting_delivery') : ?>
                                <span style="padding: 5px;" class="f12 bg-success"><?= $this->lang->line($order->status, FALSE) ?></span>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="col-lg text-right">
                            <?php if ($order->status == 'waiting_po') : ?>
                            <button class="btn btn-sm btnnew">Upload PO</button>
                            <?php elseif ($order->status == 'waiting_invoice') : ?>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i
                                    class="fa fa-fw fa-download"></i> Download PO</button>
                            <?php elseif ($order->status == 'waiting_payment') : ?>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"><i
                                    class="fa fa-fw fa-download"></i> Download
                                PO</button>
                            <button class="btn btn-sm btnnew upload-payment-file" data-toggle="modal"
                                data-target="#modal-upload-payment-file" data-id="<?= $order->id ?>"><i
                                    class="fa fa-fw fa-upload"></i> Upload Bukti
                                Pembayaran</button>
                            <?php elseif ($order->status == 'paid') : ?>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i
                                    class="fa fa-fw fa-download"></i> Download PO</button>
                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                data-target="#file_pembayaran_view"> <i class="fa fa-fw fa-download"></i> Download Bukti
                                Pembayaran</button>
                            <?php elseif ($order->status == 'delivery') : ?>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i
                                    class="fa fa-fw fa-download"></i> Download PO</button>
                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                data-target="#file_pembayaran_view"> <i class="fa fa-fw fa-download"></i> Download Bukti
                                Pembayaran</button>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#file_delivery_view">
                                <i class="fa fa-fw fa-download"></i> Download Bukti
                                Pengiriman</button>
                            <?php endif; ?>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="col-lg-12">
                    <p class="fbold color-primary">Detail Pesanan</p>
                    <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th width="300px">Order ID</th>
                            <td><?= $order->iduniq ?></td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('date_order', FALSE) ?></th>
                            <td><?php
                                $date = date_create($order->time);
                                echo date_format($date, 'd-M-Y');
                                ?></td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('total_price', FALSE) ?></th>
                            <td><?= 'Rp ' . number_format($order->payment_total, 0, ",", ".");  ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12">
                    <p class="fbold color-primary">Alamat Pengiriman</p>
                    <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th width="300px"><?= $this->lang->line('shipping_company', FALSE) ?></th>
                            <td><?= $order->shipping_company ?></td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('shipping_name') ?></th>
                            <td><?= $order->shipping_name ?></td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('shipping_phone') ?></th>
                            <td><?= $order->shipping_phone ?>
                            </td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('shipping_address') ?></th>
                            <td><?= $order->shipping_province . ', ' . $order->shipping_city . ', ' . $order->shipping_address . ', ' . $order->shipping_kodepos ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12">
                    <p class="fbold color-primary">Detail Pengiriman</p>
                    <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th width="300px">Detail Pengiriman</th>
                            <td><?= $order->shipping_description ?></td>
                        </tr>
                        <tr>
                            <th width="300px">Biaya Pengiriman</th>
                            <td><?= 'Rp ' . number_format($order->shipping_cost, 0, ",", "."); ?></td>
                        </tr>

                    </table>
                </div>
                <div class="col-lg-12">
                    <p class="fbold color-primary">Detail Penagihan</p>
                    <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th width="300px"><?= $this->lang->line('biling_company', FALSE) ?></th>
                            <td><?= $order->billing_company ?></td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('biling_phone') ?></th>
                            <td><?= $order->billing_phone ?></td>
                        </tr>
                        <tr>
                            <th width="300px"><?= $this->lang->line('biling_address') ?></th>
                            <td><?= $order->billing_province . ', ' . $order->billing_city . ', ' . $order->billing_address ?>
                            </td>
                        </tr>
                        <tr>
                            <th width="300px">Detail</th>
                            <td><?= $order->billing_address . ', ' . $order->billing_kodepos ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="col-lg-12">
                    <p class="fbold color-primary">Daftar Items</p>
                    <table id="data-table-order-item" class="table table-bordered table-striped" style="width:100%;" cellspacing="2">
                        <thead>
                            <tr>
                                <th style="width:40%;">Nama</th>
                                <th style="width:4%;" class="text-center">Qty</th>
                                <th style="width:15%;" class="text-center">Harga</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 m-y-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="fbold">Rincian Pembelian</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between">
                                <p class="m-a-0">Total Pembelian</p>
                                <p class="fbold m-a-0"><?= 'Rp ' . number_format($order->payment_total, 0, ",", "."); ?>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="m-a-0">Biaya Pengiriman</p>
                                <p class="fbold m-a-0"><?= 'Rp ' . number_format($order->shipping_cost, 0, ",", "."); ?>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="m-a-0">PPN</p>
                                <p class="fbold m-a-0"><?= $order->ppn ?> %
                                </p>
                            </div>
                            <div class="d-flex justify-content-between m-t-3">
                                <p class="m-a-0">Total</p>
                                <p class="fbold m-a-0">
                                    <?= 'Rp ' . number_format($order->payment_total + $order->shipping_cost, 0, ",", "."); ?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="file_po_view" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: auto auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php

                $explode = explode('.', $order->file_po);
                $extenstion = end($explode);

                ?>
                <?php if ($extenstion == 'pdf') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-pdf-o fa-3x"></i>
                        <?= $order->file_po ?>
                    </div>

                <?php elseif ($extenstion == 'jpg' || $extenstion == 'jpeg' || $extenstion == 'png') : ?>
                    <img src="<?= base_url('public/order/' . $order->file_po) ?>" alt="..." class="img-rounded" width="100%">
                <?php elseif ($extenstion == 'xls' || $extenstion == 'xlsx') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-excel-o fa-3x"></i>
                        <?= $order->file_po ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="modal-footer">
                <a href="<?= base_url('public/order/' . $order->file_po) ?>" class="btn btnnew" download><i class="fa fa-fw fa-download"></i> Download</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="file_invoice_view" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: auto auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php

                $explode = explode('.', $order->file_invoice);
                $extenstion = end($explode);

                ?>
                <?php if ($extenstion == 'pdf') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-pdf-o fa-3x"></i>
                        <?= $order->file_invoice ?>
                    </div>

                <?php elseif ($extenstion == 'jpg' || $extenstion == 'jpeg' || $extenstion == 'png') : ?>
                    <img src="<?= base_url('public/order/' . $order->file_invoice) ?>" alt="..." class="img-rounded" width="100%">
                <?php elseif ($extenstion == 'xls' || $extenstion == 'xlsx') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-excel-o fa-3x"></i>
                        <?= $order->file_invoice ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('public/order/' . $order->file_invoice) ?>" class="btn btnnew" download><i class="fa fa-fw fa-download"></i> Download</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="file_pembayaran_view" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: auto auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php

                $explode = explode('.', $order->file_payment);
                $extenstion = end($explode);

                ?>
                <?php if ($extenstion == 'pdf') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-pdf-o fa-3x"></i>
                        <?= $order->file_payment ?>
                    </div>

                <?php elseif ($extenstion == 'jpg' || $extenstion == 'jpeg' || $extenstion == 'png') : ?>
                    <img src="<?= base_url('public/order/' . $order->file_payment) ?>" alt="..." class="img-rounded" width="100%">
                <?php elseif ($extenstion == 'xls' || $extenstion == 'xlsx') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-excel-o fa-3x"></i>
                        <?= $order->file_payment ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('public/order/' . $order->file_payment) ?>" class="btn btnnew" download><i class="fa fa-fw fa-download"></i> Download</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="file_delivery_view" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: auto auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php

                $explode = explode('.', $order->file_delivery);
                $extenstion = end($explode);

                ?>
                <?php if ($extenstion == 'pdf') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-pdf-o fa-3x"></i>
                        <?= $order->file_delivery ?>
                    </div>

                <?php elseif ($extenstion == 'jpg' || $extenstion == 'jpeg' || $extenstion == 'png') : ?>
                    <img src="<?= base_url('public/order/' . $order->file_delivery) ?>" alt="..." class="img-rounded" width="100%">
                <?php elseif ($extenstion == 'xls' || $extenstion == 'xlsx') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-excel-o fa-3x"></i>
                        <?= $order->file_delivery ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('public/order/' . $order->file_delivery) ?>" class="btn btnnew" download><i class="fa fa-fw fa-download"></i> Download</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-download-receive-file" tabindex="-1" role="dialog" data-keyboard="flase" aria-hidden="true">
    <div class="modal-dialog" style="margin: auto auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php

                $explode = explode('.', $order->file_receive);
                $extenstion = end($explode);

                ?>
                <?php if ($extenstion == 'pdf') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-pdf-o fa-3x"></i>
                        <?= $order->file_receive ?>
                    </div>

                <?php elseif ($extenstion == 'jpg' || $extenstion == 'jpeg' || $extenstion == 'png') : ?>
                    <img src="<?= base_url('public/order/' . $order->file_receive) ?>" alt="..." class="img-rounded" width="100%">
                <?php elseif ($extenstion == 'xls' || $extenstion == 'xlsx') : ?>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-fw fa-file-excel-o fa-3x"></i>
                        <?= $order->file_receive ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('public/order/' . $order->file_receive) ?>" class="btn btnnew" download><i class="fa fa-fw fa-download"></i> Download</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-upload-payment-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document" style="margin: 5% auto; ">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('member/orders/upload_payment_file') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 d-flex flex-column align-items-center gap-3">
                            <i class="fa fa-fw fa-folder-open fa-3x text-muted"></i>
                            <span class="f14 text-muted">Unggah Bukti Pembayaran</span>
                            <label for="btn-upload-payment">
                                <div class="btn btnnew btn-sm">Upload</div>
                            </label>
                            <input type="file" name="file_payment" id="btn-upload-payment" style="display: none">
                            <span class="f13 uploaded-file"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm  btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload-po" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document" style="margin: 5% auto; ">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('member/orders/po') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pemesanan</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 d-flex flex-column align-items-center gap-3">
                            <i class="fa fa-fw fa-folder-open fa-3x text-muted"></i>
                            <span class="f14 text-muted">Unggah File PO</span>
                            <label for="btn-upload-po">
                                <div class="btn btnnew btn-sm">Upload</div>
                            </label>
                            <input type="file" name="file_po" id="btn-upload-po" style="display: none">
                            <span class="f13 uploaded-file"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm  btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-upload-receive-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document" style="margin: 5% auto; ">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('member/orders/receive') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Penerimaan Pesanan</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 d-flex flex-column align-items-center gap-3">
                            <i class="fa fa-fw fa-folder-open fa-3x text-muted"></i>
                            <span class="f14 text-muted">Unggah File Bukti Penerimaan Pesanan</span>
                            <label for="btn-upload-receive-file">
                                <div class="btn btnnew btn-sm">Upload</div>
                            </label>
                            <input type="file" name="file_receive" id="btn-upload-receive-file" style="display: none">
                            <span class="f13 uploaded-file"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm  btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>