<div class="container d-flex flex-column gap-3">
<div class="row">
<div class="col-lg-12">
<h2><a class="btn btn-black" href="<?php echo site_url('backendbulk'); ?>"><small><span class="fa fa-chevron-left"></span></small></a> Detail Permintaan</h2>
<div class="detail row">
    <div class="col-lg-12">
        <?php echo ($this->session->flashdata('message-success') == "") ? "" :
            '<div class="alert alert-success">' .
            $this->session->flashdata('message-success') .
            '</div>'; ?>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex-sb align-items-center">
                    <h4 class="card-title fbold m-a-0">
                        <?php echo $detail->id ?> - <?php echo $detail->nama_rfq ?>
                    </h4>
                    <div class="d-flex gap-3 align-items-center">
                        <p class="fred fbold m-a-0"><?php echo ceil(($detail->created_at + 259200 - time()) / 86400) ?> hari lagi</p>
                        <?php if($detail->status < 3) : ?>
                        <form action="<?php echo site_url('backendbulk/rfqDone/' . $detail->id); ?>" method="post">
                            <button type="submit" class="btn btnnewgreen">Selesai</button>
                        </form>
                        <?php else : ?>
                        <a href="<?= base_url('backendorder/create/' . $detail->id) ?>" class="btn btnnewgreen">Buat Pesanan</a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="card-body p-a-1">
                    <div class="row d-flex-sb">
                        <div class="col-lg-6 d-flex flex-column gap-3">
                            <div class="d-flex flex-column align-items-start gap-0">
                                <p class="m-a-0 f20 fbold">Data Kontak :</p>
                                <div class="d-flex align-items-center gap-2">
                                    <p class="m-a-0"><?php echo $detail->name ?></p>
                                    <p class="m-a-0 text-muted f12">
                                        ( <?php echo $detail->phone ?> )
                                    </p>
                                </div>
                                <div class=" d-flex align-items-center gap-2">
                                    <p class="f14"><?php echo $detail->company ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <p class="m-a-0 f20 fbold">Dikirim ke :</p>
                                <p class="m-a-0 f14"><?php echo $detail->address ?></p>
                                <p class="m-a-0 f14"><?php echo $detail->village ?>, <?php echo $detail->city ?>,
                                    <?php echo $detail->district ?>, <?php echo $detail->province ?>
                                    <?php echo $detail->zipcode ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex flex-column gap-3">
                            <?php if ($detail->text_rfq != null || '') : ?>
                            <div class="d-flex flex-column">
                                <p class="m-a-0 f20 fbold">Permintaan :</p>
                                <p class="m-a-0 f14"><?php echo nl2br($detail->text_rfq); ?></p>
                            </div>
                            <?php endif; ?>
                            <?php if ($detail->note != null || '') : ?>
                            <div class="d-flex flex-column">
                                <p class="m-a-0 f20">Catatan:</p>
                                <div class="alert alert-warning">
                                    <p class="m-a-0 f14"><?php echo nl2br($detail->note); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card-footer text-right">
                <button type="submit" form="form_assign" class="btn btn-white">Ubah</button>
            </div> -->
        </div>
        <!--<a data-toggle="modal" data-target="#myModal" class="btn btn-white btn-sm disabled">Assign ke Sales</a>-->
    </div>
    
    <div class="col-lg-12">
        <form action="<?php echo site_url('backendbulk/send_nego/' . $detail->id); ?>" method="post" class="card">
            <div class="card-header">
                <i class="fa fa-file"></i>
                <strong>Daftar Item</strong>
            </div>
            
            <?php if ($items != null) : ?>
            <div class="card-body p-a-1 table-responsive">
                <table class="table table-sm table-bordered table-condensed table-item" style="max-width:none !important;width:1900px !important;">
                    <tr>
                        <th class="text-center f12" width="300px">Item</th>
                        <th class="text-center f12" width="50px"></th>
                        <th class="text-center f12" width="150px">Qty</th>
                        <th class="text-center f12" width="150px">Satuan</th>
                        <th class="text-center f12" width="300px">Harga Terkini</th>
                        <th class="text-center f12" width="300px">Harga Nego Member</th>
                        <th class="text-center f12" width="300px">Harga Nego Admin</th>
                        <th class="text-center f12" width="300px">Harga Deal</th>
                        <th class="text-center f12" width="100px">Selesaikan</th>
                        <th class="text-center f12" width="100px">Hapus</th>
                    </tr>
                    <?php foreach ($items as $listItems) : ?>
                    <tr class="card-nego">
                        <td class="f12">
                            <strong><?php echo $listItems["items"]; ?></strong><br />
                            <span class="label label-<?php if ($listItems["status"] == 0) {
                                    echo "warning";
                                } else if ($listItems["status"] == 1) {
                                    echo "info";
                                } else if ($listItems["status"] == 2) {
                                    echo "success";
                                } else if ($listItems["status"] == 3){
                                    echo "danger";
                                } ?>">
                                <?php if ($listItems["status"] == 0) {
                                    echo "Menunggu Respon Customer";
                                } else if ($listItems["status"] == 1) {
                                    echo "Customer Nego";
                                } else if ($listItems["status"] == 2) {
                                    echo "Harga Disepakati";
                                } else if ($listItems["status"] == 3){
                                    echo "Customer Nego Ditolak";
                                } ?>
                            </span>
                            <textarea name="notes[]" class="form-control form-control-sm" placeholder="Catatan produk"><?php echo $listItems["notes"] ?></textarea>
                        </td>
                        <td>
                            <!--<a href="#" class="supplier-source" data-toggle="modal" data-target="#modalSupplier">Supplier</a>-->
                            <button type="button" class="supplier-source btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSupplier"><i class="fa fa-plus-circle"></i></button>
                        </td>
                        <td class="text-right f12">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control uang input-qty text-right" name="qty[]" value="<?php echo number_format($listItems["qty"], 0, ",", "."); ?>" readonly>
                                <span class="input-group-btn action-qty">
                                    <button type="button" class="btn btn-primary edit-qty"><i class="fa fa-edit"></i></button>
                                </span>
                            </div>
                        </td>
                        <td class="text-center f12">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control input-uom text-right" name="uom[]" value="<?php echo $listItems["uom"]; ?>" readonly>
                                <span class="input-group-btn action-uom">
                                    <button type="button" class="btn btn-primary edit-uom"><i class="fa fa-edit"></i></button>
                                </span>
                            </div>
                        </td>
                        <td class="text-right f12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control uang text-right" value="<?php echo number_format($listItems["price"], 0, ",", "."); ?>" readonly>
                            </div>
                        </td>
                        <td class="text-right f12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control uang input-nego-cust text-right" name="price-nego[]" value="<?php echo number_format($listItems["price_nego"], 0, ",", ".") ?>" readonly>
                                <?php if($listItems["price_nego"] != 0 && $listItems["price_nego"] != NULL && $listItems["status"] == 1):?>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success harga-fix"><i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-danger harga-tolak"><i class="fa fa-times"></i></button>
                                </span>
                                <?php else: ?>
                                <span class="input-group-btn action-nego-cust">
                                    <button type="button" class="btn btn-primary change-nego-cust"><i class="fa fa-edit"></i></button>
                                </span>
                                <?php endif;?>
                            </div>
                        </td>
                        <td class="text-right f12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control input-nego uang text-right" name="price-nego-admin[]" readonly>
                                <span class="input-group-btn action-nego">
                                    <button type="button" class="btn btn-primary change-nego"><i class="fa fa-edit"></i></button>
                                </span>
                            </div>
                        </td>
                        <td class="text-right f12">
                            Rp <?php echo $listItems["status"] == 2 ? number_format($listItems["price"], 0, ",", ".") : 0; ?>
                            <input type="hidden" name="list_id[]" value="<?php echo $listItems["id"]; ?>">
                            <input type="hidden" class="price-status" name="price-status[]" value="<?php echo $listItems["status"]; ?>">
                            <input type="hidden" class="form-control uang price-awal" name="price-awal[]" value="<?php echo number_format($listItems["price"], 0, ",", "."); ?>" readonly>
                            <!--<input type="hidden" class="form-control uang price-nego" name="price-nego[]" value="<?php echo number_format($listItems["price_nego"], 0, ",", "."); ?>" readonly>
                            <input type="hidden" class="form-control input-nego uang" name="price-nego-admin[]" readonly>
                            <input type="hidden" class="form-control input-nego uang" value="<?php echo number_format($listItems["price"], 0, ",", "."); ?>" readonly>-->
                        </td>
                        <td>
                            <div class="input-group input-group-sm text-center">
                                <span class="input-group-btn">
                            <?php if(($listItems["price_nego"] == 0 || $listItems["price_nego"] == NULL) && $listItems["status"] != 2):?>
                            <button type="button" class="btn btnnewgreen harga-fix"><i class="fa fa-check"></i></button>
                            <!--<button type="button" class="btn btnnewred f10 harga-tolak"><i class="fa fa-times"></i></button>-->
                            <?php else: ?>
                            <button type="button" disabled="disabled" class="btn btn-default disabled "><i class="fa fa-check"></i></button>
                            <?php endif;?>
                            </span>
                            </div>
                        </td>
                        <td clas="text-center">
                            <button type="button" class="btn btn-danger btn-sm remove-item"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                    <?php 
                    foreach($item_source as $canvassing): 
                    if($canvassing["sourcing_item"] == $listItems["id"]):
                    ?>
                    <tr style="background-color:#f9f9f9">
                        <td class="f12 p-l-1">
                            <span class="text-muted"><?php echo $canvassing["company"]; ?></span><br/>
                            <?php echo $canvassing["items"]; ?>
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control uang input-qty text-right" name="qty_supplier[]" value="<?php echo number_format($canvassing["qty"], 0, ",", "."); ?>" >
                                <input type="hidden" name="source_id[]" value="<?php echo $canvassing["sourcing_item_supplier"]; ?>" readonly>
                                <input type="hidden" name="source_item_id[]" value="<?php echo $canvassing["sourcing_item"]?>" readonly>
                                <span class="input-group-btn action-qty">
                                    <button type="button" class="btn btn-primary edit-qty"><i class="fa fa-edit"></i></button>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control input-uom text-right" name="uom[]" value="<?php echo $canvassing["uom"]; ?>" readonly>
                                <span class="input-group-btn action-uom">
                                    <button type="button" class="btn btn-primary edit-uom"><i class="fa fa-edit"></i></button>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <span class="text-success input-group-addon fbold">
                                    <?php echo ceil(($listItems["price"] - $canvassing["price"]) / $canvassing["price"] *100) ?>%
                                </span>
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control uang text-right" name="price_supplier[]" value="<?php echo number_format($canvassing["price"], 0, ",", "."); ?>" >
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-source"><i class="fa fa-remove"></i></button></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endif;endforeach; ?>
                    <?php endforeach; ?>
                </table>
                <?php foreach ($items as $listItems) : ?>
                <!--<div class="card p-a-1 d-flex flex-column gap-3 card-nego">
                    <div class="d-flex-sb align-items-start">
                        <div class="d-flex flex-column">
                            <p class="m-a-0 p-a-0 f20 fbold"><?php echo $listItems["items"]; ?>
                                <span class="label label-<?php if ($listItems["status"] == 0) {
                                                                        echo "warning";
                                                                    } else if ($listItems["status"] == 1) {
                                                                        echo "info";
                                                                    } else if ($listItems["status"] == 2) {
                                                                        echo "success";
                                                                    } else if ($listItems["status"] == 3){
                                                                        echo "danger";
                                                                    } ?>">
                                                                    <?php if ($listItems["status"] == 0) {
                                                                        echo "Tidak ada action";
                                                                    } else if ($listItems["status"] == 1) {
                                                                        echo "Nego";
                                                                    } else if ($listItems["status"] == 2) {
                                                                        echo "Setuju";
                                                                    } else if ($listItems["status"] == 3){
                                                                        echo "Ditolak";
                                                                    } ?>
                                </span>
                            </p>
                            <p class="m-a-0 p-a-0"> Qty : <?php echo $listItems["qty"]; ?></p>
                            <input type="hidden" name="list_id[]" value="<?php echo $listItems["id"]; ?>">
                        </div>
                        <?php if ($detail->status != 3) : ?>
                        <div class="d-flex gap-1 m-a-0 action-nego">
                            <button class="btn btnnewgreen f8 harga-fix"><i class="fa fa-check"></i></button>
                            <button class="btn btn-primary f10 change-nego">Nego</button>
                            <button class="btn btnnewred f8 harga-tolak"><i class="fa fa-times"></i></button>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if($detail->status < 3) : ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Harga Awal</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control uang price-awal" name="price-awal[]"
                                    value="<?php echo number_format($listItems["price"], 0, ",", "."); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Harga Nego Member</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control uang price-nego" name="price-nego[]"
                                    value="<?php echo number_format($listItems["price_nego"], 0, ",", "."); ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Harga Nego Admin</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control input-nego uang" name="price-nego-admin[]" readonly>
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="d-flex flex-column">
                        <label for="">Harga Deal</label>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control input-nego uang"
                                value="<?php echo number_format($listItems["price"], 0, ",", "."); ?>" readonly>
                        </div>
                    </div>
                    <?php endif ?>
                </div>-->
                <?php endforeach; ?>
                
            </div>
            <div class="card-body p-a-1">
                <?php if ($detail->status != 3) : ?>
                    <button type="submit" class="btn btn-secondary btn-sm pull-right"><i class="fa fa-check-circle"></i> Simpan</button>
                    <a class="btn btn-sm btn-secondary pull-right m-r-2" href="<?php echo site_url('member/bulkRfq/' . $detail->id) ?>" target="_blank"><i class="fa fa-copy"></i> Buat RFQ</a>
                    <a href="<?php echo site_url('member/bulkPdf/' . $detail->id) ?>" target="_blank" class="btn btn-sm btn-secondary pull-right m-r-1"><i class="fa fa-file"></i> Cetak SPH</a>
                    <div class="clearfix"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </form>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-file"></i> <strong>Tambah Barang</strong>
                <button type="button" class="btn btn-sm btn-secondary add-list-item pull-right"><i class="fa fa-plus"></i></button>    
            </div>
            <div class="card-body p-a-1">
                <form class="form-horizontal" action="<?php echo site_url('backendbulk/send_item/' . $detail->id); ?>" method="post" enctype="multipart/form-data">
                <table class="table table-sm table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center f12">Nama</th>
                            <th class="text-center f12">Quantity</th>
                            <th class="text-center f12">Satuan</th>
                            <th class="text-center f12">Keterangan</th>
                            <th class="text-center f12">Harga</th>
                            <th class="text-center f12">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="list-card m-b-1">
                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm form-autocomplete-item" jq-model="name" placeholder="Nama" name="name-item[]" value="">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" jq-model="qty" placeholder="Quantity" name="qty-item[]" value="">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" jq-model="uom" placeholder="Satuan" name="uom-item[]" value="">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" jq-model="notes" placeholder="Keterangan/catatan" name="notes[]" value="">
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Rp</span>
                                    <input type="text" class="form-control uang" jq-model="price" placeholder="Harga"
                                        name="price-item[]" value="">
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm del-list-item"><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-secondary btn-sm pull-right" type="submit"><i class="fa fa-check-circle"></i> Simpan</button>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-file"></i> <strong>Berkas Pendukung</strong></div>
            <div class="card-body p-a-1">
                <?php $files = $file->result();?>
                <?php if ($files != null || '') : ?>
                <div class="d-flex flex-column">
                    <?php foreach ($files as $listFiles) : ?>
                    <a href="<?php echo base_url('public/sourcing/' . $listFiles->filename); ?>" class="text-primary" target="_blank">
                        <i class="fa fa-file-outline"></i><?php echo $listFiles->filename ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <hr/>
                <form class="row" method="POST" action="<?php echo site_url('backendbulk/add_files/'.$detail->id); ?>" enctype="multipart/form-data">
                <div class="col-lg-12">
                    <h6 class="text-muted">Tarik file kedalam field atau tekan tombol Upload</h6>
                    <div class="col-lg-12 d-flex flex-column gap-1 align-items-end p-a-1 border-sm">
                        <!--<input type="hidden" name="item_keyword">-->
                        <div class="input-element-container w-100" id="input-element-container">
                            <div id="uploader" style="border:dashed 5px #ccc;border-radius:10px" class="w-100 text-center">
                                <button class="btn shadow bg-white btn-upload" style="margin:50px auto" type="button"><i
                                class="fa fa-upload"></i>
                            Upload File</button>
                            </div>
                        </div>
                        <div class="table table-striped m-b-0" class="files" id="previews">
                            <div id="template">
                                <h6 class="error text-danger fbold" data-dz-errormessage>
                                </h6>
                                <div class="file-upload">
                                    <div class="col-lg-6 p-x-0">
                                        <span class="name name-file m-a-0" data-dz-name></span>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="progress active m-a-0" >
                                            <div class="progress-bar bg-success m-a-0" role="progressbar"
                                                style="width:0%;height:20px;" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex-sb align-items-center p-x-0">
                                        <span class="size d-flex" data-dz-size></span>
                                        <i data-dz-remove class="fa fa-remove pointer fred m-a-0"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-lg-12 text-right">
                    <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-check-circle"></i> Simpan</button>
                </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-file"></i> <strong>Catatan untuk customer</strong></div>
            <div class="card-body p-a-1">
                <form class="form-horizontal" action="<?php echo site_url('backendbulk/send_item/' . $detail->id); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="comment_id" value="<?= $detail->comment_log_id ?>">
                    <input type="hidden" name="isi_note_admin" value="<?= $detail->admin_note ?>">
                    <label class="fbold" for="admin_note">Catatan untuk Customer (SPH):</label>
                    <textarea class="form-control" name="admin_note" placeholder="Berikan catatan untuk customer (SPH)"></textarea>
                    <hr />
                    <label class="fbold" for="internal_note">Catatan Internal:</label>
                    <textarea class="form-control" name="internal_notes" placeholder="Berikan catatan untuk internal"><?php echo $detail->internal_notes ?></textarea>
                    <hr />
                    <label class="fbold" for="sourcing_note">Catatan untuk sourcing (Supplier):</label>
                    <textarea class="form-control" name="sourcing_notes" placeholder="Berikan catatan untuk supplier"><?php echo $detail->sourcing_notes ?></textarea>
                    <hr />
                    <div class="d-flex flex-column gap-1 m-t-1">
                        <div class="checkbox">
                            <label><input type="checkbox" name="inc_ppn" <?php echo $detail->inc_ppn == 1 ? "checked" : ""; ?>> Include PPN</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="inc_ongkir" <?php echo $detail->inc_ongkir == 1 ? "checked" : ""; ?>> Include Ongkir</label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
            <table hidden>
                <tbody class="list-form" >
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm form-autocomplete-item" jq-model="name" placeholder="Nama" name="name-item[]" value="">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" jq-model="qty" placeholder="Quantity" name="qty-item[]" value="">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" jq-model="uom" placeholder="Satuan" name="uom-item[]" value="">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" jq-model="notes" placeholder="Keterangan/catatan" name="notes[]" value="">
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control uang" jq-model="price" placeholder="Harga"
                                    name="price-item[]" value="">
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm del-list-item"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                </tbody>
                
                <!--<div class="row d-flex align-items-end gap-1 m-b-1">
                    <div class="col-lg-10 d-flex flex-column gap-2">
                        <div class="input-group">
                            <label for="">Nama Item</label>
                            <input type="text" class="form-control form-autocomplete-item" jq-model="name" placeholder="Nama"
                                name="name-item[]" value="">
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="">Qty</label>
                                <input type="text" class="form-control" jq-model="qty" placeholder="Quantity"
                                    name="qty-item[]" value="">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Satuan</label>
                                <input type="text" class="form-control" jq-model="uom" placeholder="UoM"
                                    name="uom-item[]" value="">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Harga Awal</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp</span>
                                    <input type="text" class="form-control uang" jq-model="price" placeholder="Harga"
                                        name="price-item[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-danger del-list-item">X</button>
                    </div>
                </div>-->
            </table>
        </div>
    </div>
</div>
</div>
<div class="col-lg-3" hidden>
    <div class="row">
    <label class="fbold" for="sourcing_note">Catatan untuk sourcing (Supplier):</label>
    <textarea class="form-control" name="sourcing_note" placeholder="Berikan catatan untuk supplier"></textarea>
    </div>
</div>
</div>
<div class="modal fade" id="modalSupplier" tabindex="-1" role="dialog" aria-labelledby="modalSupplierLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalSupplierLabel">Supplier</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped datatable display compact" style="max-width:none !important;width:1200px !important;">
                    <thead>
                        <tr>
                            <th class="text-center f12">Supplier</th>
                            <th class="text-center f12">Item</th>
                            <th class="text-center f12">Qty</th>
                            <th class="text-center f12">Satuan</th>
                            <th class="text-center f12">Harga Satuan</th>
                            <th class="text-center f12">Tanggal Penawaran</th>
                            <th class="text-center f12">Franco</th>
                            <th class="text-center f12">Pilih</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-save-item-list-source">Simpan</button>
            </div>
        </div>
    </div>
</div>
</div>