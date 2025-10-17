<div class="container d-flex flex-column gap-3">
<form class="row" method="POST" enctype="multipart/form-data">
    <div class="col-lg-12">
        <p class="f24 fbold">Buat <?php echo $this->uri->segment(3) == 'buyer' ? 'Inquiry' : 'Sourcing' ?></p>
    </div>
    <div class="col-lg-12">
        <div class="card p-a-2">
            <!--<div class="form-group form-inline">
                <p>Tujuan Permintaan</p>
                <div class="radio">
                    <label>
                        <input type="radio" name="type" id="supplier" value="supplier" checked> Keluar
                    </label>
                </div>
                <div class="radio m-l-2">
                    <label>
                        <input type="radio" name="type" id="buyer" value="buyer"> Masuk
                    </label>
                </div>
            </div>
            <hr>-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="font-weight-bold m-y-2">Data Kontak (PIC) dan Perusahaan</h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Cari kontak yang sudah ada">
                                <input type="hidden" class="form-control" value="<?= set_value('contact_id') ?>" name="contact_id">
                                <span class="text-danger"><?= form_error('contact_id') ?></span>
                                <span class="input-group-btn">
                                  <a href="<?= base_url('backendcontact/create/'.$this->uri->segment(3)) ?>" target="__blank" class="btn btn-warning"><i class="fa fa-fw fa-plus"></i> Kontak Baru</a>
                                </span>
                            </div>
                            <!--<button type="button" data-toggle="modal" data-target="#myModal"
                                class="btn btn-sm btn-info btn-show-list-contact"><i class="fa fa-fw fa-list"></i> Pilih Kontak</button>-->
                        </div>
                    </div>
                    <div class="contact-alert-space"></div>
                    <span class="text-danger"><?= form_error('contact_id') ?></span>
                    <div class="form-group">
                        <input type="hidden" class="form-control" value="<?= set_value('company_id') ?>" name="company_id">
                        <div class="company-alert-space"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h4 class="font-weight-bold m-y-2">Alamat Pengiriman</h4>
                    <div class="form-group">
                        <label for="keluarahan">Kelurahan / Desa</label>
                        <input type="hidden" name="village_id" value="<?= set_value('village_id') ?>">
                        <input type="text" class="form-control" id="kelurahan" value="<?= set_value('village') ?>" name="village" placeholder="Cari kelurahan / Desa" >
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Kode Pos</label>
                        <input type="text" class="form-control" id="zip_code" value="<?= set_value('zipcode') ?>" name="zipcode" placeholder="Masukkan kode pos" >
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail Alamat</label>
                        <textarea type="text" class="form-control" rows="5" id="detail" name="address" placeholder="Masukan detail alamat" required><?= set_value('address') ?></textarea>
                        <span class="text-danger"><?= form_error('address') ?></span>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="font-weight-bold m-y-2">Catatan Permintaan</h4>
                    <div class="form-group">
                        <label for="permintaan">Informasi Tambahan</label>
                        <textarea type="text" class="form-control" rows="5" id="permintaan" name="text_rfq"><?= set_value('text_rfq') ?></textarea>
                        <span class="text-danger"><?= form_error('text_rfq') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="permintaan">Internal Notes</label>
                        <textarea type="text" class="form-control" rows="5" id="admin_note" name="admin_note"><?= set_value('admin_note') ?></textarea>
                        <span class="text-danger"><?= form_error('admin_note') ?></span>
                    </div>
                    <div class="checkbox d-flex gap-3">
                        <label>
                            <input type="checkbox" value="1" name="inc_ppn"> Include PPN
                        </label>
                        <label>
                            <input type="checkbox" value="1" name="inc_ongkir"> Include Ongkir
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <h4 class="font-weight-bold m-y-2">Daftar Item</h4>
                    <button class="btn btn-info m-b-2 add-item-list"><i class="fa fa-fw fa-plus"></i> Tambah Daftar</button>
                    <table class="table table-striped table-item">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Keterangan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="hidden" name="id_items[]" class="form-control product-id" id="id_items">
                                    <input type="name" name="items[]" class="form-control product-name" id="name" placeholder="Masukan nama item">
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control product-quantity" id="qty" value="1" min="1">
                                </td>
                                <td>
                                    <input type="text" name="uom[]" class="form-control product-quantity" id="uom" value="">
                                </td>
                                <td>
                                    <input type="text" name="price[]" class="form-control price-quantity" id="price" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" name="notes[]" class="form-control" id="notes" value="">
                                </td>
                                <td>
                                    <button disabled class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button>
                                </td>
                            </tr>
                            <!--<tr class="select-supplier">
                                <td class="text-right">
                                    <a href="#" class="supplier-source" data-toggle="modal" data-target="#modalSupplier">Supplier</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="font-weight-bold m-y-2">File Pendukung</h4>
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
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btnnew">simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar Kontak</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped datatable ">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Perusahaan</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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
                <table class="table table-striped datatable ">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-save-item-list-source">simpan</button>
            </div>
        </div>
    </div>
</div>