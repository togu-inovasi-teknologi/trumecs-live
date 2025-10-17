<form method="POST" enctype="multipart/form-data" id="form-order-buyer">
    <div class="detail row m-t-1">

        <div class="col-md-12">
            <div class="alert alert-warning">
                <table class="col-xs-12">
                    <tbody>
                        <input class="form-control" type="hidden" name="member_id"
                            value="<?= $sourcing->contact->member->id ?>" />
                        <input class="form-control" type="hidden" name="sourcing_buyer" value="<?= $sourcing->id ?>" />
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>
                                <select name="idmember" class="select-member form-control" placeholder="Nama member">
                                    <option value="">-- Pilih Item --</option>";
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama </td>
                            <td><input class="form-control" type="text" name="name"
                                    value="<?= $sourcing->contact->name ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td><input class="form-control" type="text" name="email"
                                    value="<?= $sourcing->contact->email ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class="form-control" type="text" name="phone"
                                    value="<?= $sourcing->contact->telephone ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td><input class="form-control" type="text" name="level"
                                    value="<?= $sourcing->contact->member->level ?? '' ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="alert alert-warning">
                <table class="col-xs-12">
                    <tbody>
                        <tr>
                            <td>Id Order </td>
                            <td><input name="iduniq" class="form-control" value="" type="text"
                                    placeholder="Nomor Invoice" /></td>
                        </tr>
                        <tr>
                            <td>Tanggal Order</td>
                            <td>: <?php echo date("Y-m-d"); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Jatuh Tempo</td>
                            <td>: <?php echo date("Y-m-d") ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select class="form-control" name="status" aria-label="Default select example">
                                    <option value="waiting_po">Menunggu PO</option>
                                    <option value="waiting_invoice">Menunggu Invoice</option>
                                    <option value="waiting_payment">Menunggu Pembayaran</option>
                                    <option value="waiting_delivery">Menunggu Dikirim</option>
                                    <option value="delivery">Sedang Dikirim</option>
                                    <option value="complete">Telah Diterima</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <hr />
        <div class="col-md-12 m-y-2 d-none" id="upload-document-order">
            <strong>Detail Pesanan </strong>
            <div class="row m-t-2" id="row-upload-document">
                <div class="col-lg-3 d-none waiting_invoice waiting_payment waiting_delivery delivery complete">

                    <div class="form-group">
                        <label for="exampleInputFile">Upload File PO</label>
                        <input type="file" name="file_po" id="file_po">
                    </div>
                </div>
                <div class="col-lg-3 d-none waiting_payment waiting_delivery delivery complete">
                    <div class="">Upload File Invoice</div>
                    <label for="file_invoice"
                        class="card text-center d-flex flex-column align-items-center justify-content-center m-t-1"
                        style="height: 200px">
                        <i class="fa fa-folder-open-o f32" aria-hidden="true"></i>
                        <div class="btn btn-sm btn-primary radius-sm m-t-1">Browse File</div>
                    </label>
                    <input type="file" style="display: none" name="file_invoice" id="file_invoice">
                </div>
                <div class="col-lg-3 d-none waiting_delivery delivery complete">
                    <div class="">Upload File Bukti Pembayaran</div>
                    <label for="file_bukti_pembayaran"
                        class="card text-center d-flex flex-column align-items-center justify-content-center m-t-1"
                        style="height: 200px">
                        <i class="fa fa-folder-open-o f32" aria-hidden="true"></i>
                        <div class="btn btn-sm btn-primary radius-sm m-t-1">Browse File</div>
                    </label>
                    <input type="file" style="display: none" name="file_bukti_pembayaran" id="file_bukti_pembayaran">
                </div>
                <div class="col-lg-3 d-none delivery complete">
                    <div class="">Upload File Bukti Pengiriman</div>
                    <label for="file_bukti_pengiriman"
                        class="card text-center d-flex flex-column align-items-center justify-content-center m-t-1"
                        style="height: 200px">
                        <i class="fa fa-folder-open-o f32" aria-hidden="true"></i>
                        <div class="btn btn-sm btn-primary radius-sm m-t-1">Browse File</div>
                    </label>
                    <input type="file" style="display: none" name="file_bukti_pengiriman" id="file_bukti_pengiriman">
                </div>
                <div class="col-lg-3 d-none complete">
                    <div class="">Upload File Bukti Penerimaan</div>
                    <label for="file_bukti_penerimaan"
                        class="card text-center d-flex flex-column align-items-center justify-content-center m-t-1"
                        style="height: 200px">
                        <i class="fa fa-folder-open-o f32" aria-hidden="true"></i>
                        <div class="btn btn-sm btn-primary radius-sm m-t-1">Browse File</div>
                    </label>
                    <input type="file" style="display: none" name="file_bukti_penerimaan" id="file_bukti_penerimaan">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <strong>Alamat Penagihan</strong>
                <table class="col-xs-12">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td><input class="form-control" type="text" name="billing_name" value="" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Perusahaan </td>
                            <td><input class="form-control" type="text" name="billing_company"
                                    value="<?= $sourcing->company->name ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class="form-control" type="text" name="billing_phone"
                                    value="<?= $sourcing->company->telephone ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td class="billing">
                                <input class="form-control m-b-1" type="text" name="billing_address" value=""
                                    required />
                                <select class="form-control billing-province" data-type="billing" name="province"
                                    placeholder="Nama Provinsi" style="margin-bottom:10px" required>
                                    <option>-- Pilih Provinsi --</option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                    <?php if($item->id == $sourcing->company->address->district->regency->province_id) : ?>
                                    <option value="<?php echo $item->id ?>" selected><?php echo $item->name ?></option>
                                    <?php else :?>
                                    <option value="<?php echo $item->id?>"><?php echo $item->name?></option>
                                    <?php endif?>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control billing-regency" name="regency" data-type="billing"
                                    placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kabupaten --</option>
                                </select>
                                <select class="form-control billing-district" name="district" data-type="billing"
                                    placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kecamatan --</option>
                                </select>
                                <select class="form-control billing-village" name="village" data-type="billing"
                                    placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- Pilih Desa / Kelurahan --</option>
                                </select>
                                <input class="form-control" type="hidden" name="billing_province"
                                    value="<?= $sourcing->company->address->district->regency->province_id ?>" />
                                <input class="form-control" type="hidden" name="billing_district"
                                    value="<?=$sourcing->company->address->district->id ?>" />
                                <input class="form-control" type="hidden" name="billing_regency"
                                    value="<?=$sourcing->company->address->district->regency->id ?>" />
                                <input class="form-control" type="hidden" name="billing_village_id"
                                    value="<?= $sourcing->company->address->id ?>" />

                                <input class="form-control" placeholder="Kode pos" type="text" name="billing_kodepos"
                                    value="<?= $sourcing->company->billing_code ?>" required />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <strong>Alamat Pengiriman</strong>
                <table class="col-xs-12">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td><input class="form-control" type="text" name="shipping_name"
                                    value="<?= $sourcing->contact->name ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Perusahaan </td>
                            <td><input class="form-control" type="text" name="shipping_company"
                                    value="<?= $sourcing->company->name ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class="form-control" type="text" name="shipping_phone"
                                    value="<?= $sourcing->phone ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Alamat .

                            <td class="shipping"><input class="form-control m-b-1" type="text" name="shipping_address"
                                    value="<?= $sourcing->sourcing_address ?>" required />
                                <select class="form-control shipping-province" data-type="shipping" name="province"
                                    placeholder="Nama Provinsi" style="margin-bottom:10px" required>
                                    <option>-- Pilih Provinsi --</option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                    <?php if($item->id == $sourcing->address->district->regency->province->id) : ?>
                                    <option value="<?php echo $item->id ?>" selected><?php echo $item->name ?> </option>
                                    <?php else: ?>
                                    <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control shipping-regency" name="regency" data-type="shipping"
                                    data-type="shipping" placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kabupaten --</option>
                                </select>
                                <select class="form-control shipping-district" name="district" data-type="shipping"
                                    placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kecamatan --</option>
                                </select>
                                <select class="form-control shipping-village" name="village" data-type="shipping"
                                    placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- Pilih Desa / Kelurahan --</option>
                                </select>
                                <input class="form-control" type="hidden" name="shipping_province"
                                    value="<?= $sourcing->address->district->regency->province->id ?>" />
                                <input class="form-control" type="hidden" name="shipping_district"
                                    value="<?= $sourcing->address->district->id ?>" />
                                <input class="form-control" type="hidden" name="shipping_regency"
                                    value="<?= $sourcing->address->district->regency->id ?>" />
                                <input class="form-control" type="hidden" name="shipping_village_id"
                                    value="<?= $sourcing->address->id ?>" />
                                <input class="form-control" type="text" name="shipping_kodepos"
                                    value="<?= $sourcing->zipcode ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            <strong>List Pesanan </strong>
            <?php if($sourcing !== null) : ?>
            <?php $this->load->view('backendorder/form.sourcing_exist.php', ['sourcing' => $sourcing]) ?>
            <?php else : ?>
            <table class="table table">
                <thead>
                    <tr>
                        <th>Produk <br><small>Partnumber</small></th>
                        <th>Jumlah</th>
                        <th>Berat</th>
                        <th>Harga</th>
                        <th>Harga Total</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="group-item">
                    <tr>
                        <td>
                            <select name="id_produk[]" class="js-example-basic-single form-control"
                                placeholder="Nama produk">
                                <option value="">-- Pilih Item --</option>";
                            </select>
                        </td>
                        <td width="50">
                            <input name="qty[]"
                                class="form-control <?= form_error('weight['.$key.']') ? 'border-error' : '' ?>"
                                type="number" min="0" value="0" />
                            <small><?= form_error('weight['.$key.']')?></small>
                        </td>
                        <td>
                            <span class="weight">0</span> <small>kg</small>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Rp</span>
                                <input name="harga[]" class="form-control" value="0" />
                                <span class="input-group-addon" id="basic-addon1">/ <small
                                        class="unit">Unit</small></span>
                            </div>
                        </td>
                        <td>Rp <span class="harga">0</span></small></td>
                        <td>
                            <span class="warranty"></span>
                        </td>
                        <td>
                            <button type="button" class="btn-add-item">+</button>
                        </td>
                    </tr>
                </tbody>

            </table>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <hr />
        <div class="col-md-12">
            <strong>Detail Pengiriman </strong>
            <table class="table table">
                <thead>
                    <tr>
                        <th>Pengiriman</th>
                        <th>No Resi/Surat Jalan</th>
                        <th>Berat</th>
                        <th></th>
                        <th>Biaya Pengiriman</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="pengiriman">
                    <tr>
                        <td><input class="form-control" type="text" name="shipping_description" /></td>
                        <td><input class="form-control" type="text" name="shipping_resi" /></td>
                        <td><span class="total-weight">0</span> <small>kg</small></td>
                        <td></td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Rp</span>
                                <input class="form-control" type="text" name="shipping_cost" value="0" />
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Pembayaran</td>
                        <td><strong>Rp <span class="total">0</span></strong></td>
                        <td></td>
                    </tr>
            </table>
        </div>


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
</form>