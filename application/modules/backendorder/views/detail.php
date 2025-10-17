<div class="detail row bg-white">
    <div class="col-md-12 m-t-3 p-t-3">
        <div class="row">
            <div class="col-lg-6">
                <p class="f22 fbold">Detail Order</p>
            </div>
            <div class="col-lg-6 text-right">
                <a href="<?= base_url('backendorder/print/' . $this->uri->segment(3)) ?>"
                    class="btn btn-sm btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Print Memo</a>
            </div>
        </div>
    </div>
    <div class="col-md-12 ">
        <?= status_order($detail) ?>
    </div>
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link " id="memo-tab" data-toggle="tab" href="#memo" role="tab" aria-controls="memo"
                    aria-selected="true">Memo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Detail Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Penagihan & Pengiriman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Referal & Cashback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#marketing" role="tab"
                    aria-controls="contact" aria-selected="false">Detail Marketing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="source-tab" data-toggle="tab" href="#source" role="tab" aria-controls="source"
                    aria-selected="false">Supplier</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane p-t-2 fade show active in" id="memo" role="tabpanel" aria-labelledby="memo-tab">
                <?php $this->load->view('backendorder/detail/memo', ['detail' => $detail]) ?>
            </div>
            <div class="tab-pane p-t-2 fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php $this->load->view('backendorder/detail/index', ['detail' => $detail]) ?>
            </div>
            <div class="tab-pane p-t-2 fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php $this->load->view('backendorder/detail/billing_and_shipping', ['detail' => $detail]) ?>
            </div>
            <div class="tab-pane p-t-2 fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <?php $this->load->view('backendorder/detail/referal', ['detail' => $detail]) ?>
            </div>
            <div class="tab-pane p-t-2 fade" id="marketing" role="tabpanel" aria-labelledby="marketing-tab">
                <?php $this->load->view('backendorder/detail/marketing', ['detail' => $detail]) ?>
            </div>
            <div class="tab-pane p-t-2 fade" id="source" role="tabpanel" aria-labelledby="source-tab">
                <?php $this->load->view('backendorder/detail/source', ['detail' => $detail]) ?>
            </div>
        </div>
    </div>





</div>

<div class="modal fade" id="modal-upload-receive-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document" style="margin: 5% auto; ">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('/backendorder/receive') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
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

<div class="modal fade" id="set_delivery_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="form-input-delivery" enctype="multipart/form-data"
                action="<?= base_url('/backendorder/save_delivery') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pengiriman Pesanan</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id" value="<?= $detail->id ?>">
                    <input type="hidden" name="unique" value="<?= $this->uri->segment(3) ?>">
                    <div class="row d-flex flex-column justify-content-center">
                        <div class="col-lg-12 d-flex flex-column align-items-center gap-3">
                            <i class="fa fa-fw fa-folder-open fa-3x text-muted"></i>
                            <span class="f14 text-muted">Unggah File Bukti Pengiriman Pesanan</span>
                            <label for="upload-file-delivery">
                                <div class="btn btnnew btn-sm">Upload</div>
                            </label>
                            <input type="file" name="file_delivery" id="upload-file-delivery" style="display: none">
                            <span class="f13 uploaded-file-deliver"></span>
                            <div id="validation-file" class="text-danger"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="resi">Resi Pengiriman</label>
                                <input type="text" class="form-control" id="resi" name="shipping_resi"
                                    placeholder="Input Resi Pengiriman">
                                <div id="validation-resi" class="text-danger"></div>
                            </div>
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