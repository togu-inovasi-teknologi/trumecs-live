<form class="row" method="POST" enctype="multipart/form-data" style="margin-top: 7%">
    <div class="col-md-12">
        <strong class="f22">New Order</strong>
        <?php echo validation_errors() ?>
        <?= set_value('status') ?>
    </div>
    <div class="col-lg-12 m-t-2">
        <div class="row">
            <table class="table">
                <tr>
                    <th>
                        Tanggal
                    </th>
                    <td>
                        <?php echo date("Y-m-d"); ?>
                    </td>
                </tr>
                <tr>

                    <th>
                        Status
                    </th>
                    <td>
                        <select class="form-control" name="status" aria-label="Default select example">
                            <?php 

                                $statuses = [
                                    [
                                        'value' => 'waiting_po',
                                        'name' => 'Menunggu PO',
                                    ],
                                    [
                                        'value' => 'waiting_invoice',
                                        'name' => 'Menunggu Invoice',
                                    ],
                                    [
                                        'value' => 'waiting_payment',
                                        'name' => 'Menunggu Pembayaran',
                                    ],
                                    [
                                        'value' => 'waiting_delivery',
                                        'name' => 'Menunggu Dikirim',
                                    ],
                                    [
                                        'value' => 'delivery',
                                        'name' => 'Sedang Dikirim',
                                    ],
                                    [
                                        'value' => 'complete',
                                        'name' => 'Telah Diterima',
                                    ]
                                ]
                            
                            ?>
                            <?php foreach($statuses as $value) : ?>
                            <?php if($value['value'] == set_value('status')) : ?>
                            <option value="<?= $value['value'] ?>" selected><?= $value['name'] ?></option>
                            <?php else : ?>
                            <option value="<?= $value['value'] ?>"><?= $value['name'] ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <div class="card p-a-1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Informasi Supplier</h5>
                            <input type="hidden" name="sourcing_supplier" value="<?= set_value('sourcing_supplier') ?>">
                        </div>
                        <div class="col-lg-6 text-right">
                            <button data-toggle="modal" type="button" data-target="#supplier"
                                class="btn btn-sm btn-info button-show-sorcing-supplier-order"><i
                                    class="fa fa-fw fa-search"></i>
                                Cari
                                Dari Sourcing Supplier</button>
                        </div>
                    </div>
                    <div class="row m-t-1 supplier-info-content">
                        <div class="col-lg-12">
                            <div class="card p-a-2">
                                <p>Belum Ada Supplier Yang Di Pilih.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> -->
        <div class="card p-a-1">
            <div class="row m-t-2">
                <div class="col-lg-12">
                    <h5>Informasi Buyer</h5>
                    <input type="hidden" name="sourcing_buyer" value="<?= $sourcing != null ? $sourcing->id : '' ?>">
                    <div class="row m-t-1">
                        <div class="col-lg-4">
                            <div class="" style="height: 200px">
                                <table>
                                    <tr>
                                        <th width="200px" class="f16 forange">Detail Kontak</th>
                                    </tr>
                                    <tr>
                                        <th width="200px" class="f16">Nama</th>
                                        <td class="f16">: <?= $sourcing != null ? $sourcing->contact->name : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" class="f16">Email</th>
                                        <td class="f16">: <?= $sourcing != null ? $sourcing->contact->email : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" class="f16">Telepon</th>
                                        <td class="f16">: <?= $sourcing != null ? $sourcing->contact->telephone : '' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="" style="height: 200px">
                                <p class="f16 fbold forange">Alamat Pengiriman</p>
                                <p class="fbold">Nama : <?= $sourcing != null ? $sourcing->name : '' ?></p>
                                <p><?=  $sourcing != null ? $sourcing->address->name . ', ' . $sourcing->address->district->name . ', ' . $sourcing->address->district->regency->name . ', ' . $sourcing->address->district->regency->province->name : ''?>
                                </p>

                            </div>
                        </div>
                        <div class="vl"></div>
                        <div class="col-lg-4">
                            <div class="" style="height: 200px">
                                <p class="f16 fbold forange">Alamat Penagihan</p>
                                <p class="fbold">Nama : <?= $sourcing != null ? $sourcing->name : '' ?></p>
                                <p><?= $sourcing != null ? $sourcing->company->address->name . ', ' . $sourcing->company->address->district->name . ', ' . $sourcing->company->address->district->regency->name . ', ' . $sourcing->company->address->district->regency->province->name : ''?>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card p-x-1">
            <div class="row">
                <?php $this->load->view('backendorder/form.sourcing_exist.php', ['sourcing' => $sourcing]) ?>
            </div>
        </div>
        <?php $this->load->view('backendorder/memo') ?>

        <div class="card p-y-1">
            <div class="row">
                <div class="col-lg-6 p-x-2">
                    <strong>Dokumen Order </strong>
                </div>
                <div class="col-lg-12">
                    <table class="table">
                        <tr>
                            <th>Dokumen</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="300px">PO</td>
                            <td width="300px">
                                <input id="file_po" type="file" name="file_po" style="display: none">
                                <label for="file_po" class="btn btn-sm btn-primary m-a-0"> <i
                                        class="fa fa-fw fa-folder-open"></i>
                                    Upload</label>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="300px">Invoice</td>
                            <td width="300px">
                                <input id="file_invoice" type="file" name="file_invoice" style="display: none">
                                <label for="file_invoice" class="btn btn-sm btn-primary m-a-0"> <i
                                        class="fa fa-fw fa-folder-open"></i>
                                    Upload</label>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="300px">Bukti Pembayaran</td>
                            <td width="300px">
                                <input id="file_payment" type="file" name="file_payment" style="display: none">
                                <label for="file_payment" class="btn btn-sm btn-primary m-a-0"> <i
                                        class="fa fa-fw fa-folder-open"></i>
                                    Upload</label>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="300px">Bukti Pengiriman</td>
                            <td width="300px">
                                <input id="file_delivery" type="file" name="file_delivery" style="display: none">
                                <label for="file_delivery" class="btn btn-sm btn-primary m-a-0"> <i
                                        class="fa fa-fw fa-folder-open"></i>
                                    Upload</label>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="300px">Bukti Penerimaan</td>
                            <td width="300px">
                                <input id="file_receive" type="file" name="file_receive" style="display: none">
                                <label for="file_receive" class="btn btn-sm btn-primary m-a-0"> <i
                                        class="fa fa-fw fa-folder-open"></i>
                                    Upload</label>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card p-y-1">
            <div class="row">
                <div class="col-lg-6 p-x-2">
                    <strong>Detail Pengiriman </strong>
                </div>
                <div class="col-lg-12">
                    <table class="table table">
                        <thead>
                            <tr>
                                <th>Pengiriman</th>
                                <th>No Resi/Surat Jalan</th>
                                <th>Biaya Pengiriman</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="pengiriman">
                            <tr>
                                <td><input class="form-control" type="text" name="shipping_description" /></td>
                                <td><input class="form-control" type="text" name="shipping_resi" /></td>

                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">Rp</span>
                                        <input class="form-control" type="text"
                                            <?= $sourcing != null ? $sourcing->inc_ongkir > 0 ? 'readonly' : '' : 0 ?> name="shipping_cost"
                                            value="0" />
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>

                                <td class="text-right">Include Ongkir</td>
                                <td class="text-right">
                                    <strong><?= $sourcing != null ? $sourcing->inc_ongkir > 0 ? 'Ya' : 'Tidak' : 'Ya' ?></strong>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>

                                <td class="text-right">Subtotal</td>
                                <td class="text-right">
                                    <strong>
                                        <?php 

                                           
                                        ?>
                                        <input type="hidden" name="subtotal" value="<?= $sourcing != null ? $sourcing->total_price : 0 ?>">
                                        <?= $sourcing != null ? 'Rp ' . number_format($sourcing->total_price, 0, ',', '.') : 0 ?>
                                    </strong>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <input type="hidden" name="total" value="0">
                                <td class="text-right">Total Pembayaran</td>
                                <td class="text-right" id="total-price-field"><strong>Rp <span
                                            class="total">0</span></strong></td>
                                <td></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>




        <div class="card p-a-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <strong>Catatan</strong>
                        <p></p>
                        <div class="row">
                            <div class="col-md-10">
                                <textarea name="comment" class="form-control"></textarea>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-orange">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>

<div class="modal fade" id="supplier" tabindex="-1" role="dialog" aria-labelledby="supplierLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="supplierLabel">Daftar Sourcing Supplier</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped table-bordered table-sm table-sourcing-list">
                    <thead>
                        <tr>
                            <th>ID Sourcing</th>
                            <th>Perusahaan</th>
                            <th>Tanggal</th>
                            <th>Alamat</th>
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