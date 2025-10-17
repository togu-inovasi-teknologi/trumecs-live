<form action="<?php echo base_url() ?>backendorder/store" method="POST" id="order-principal">
    <div class="detail row m-t-1">

        <div class="col-md-12">
            <div class="alert alert-warning">
                <table class="col-xs-12">
                    <tbody>
                        <input class="form-control" type="hidden" name="member_name" value="" />
                        <tr>
                            <td>Kontak</td>
                            <td>
                                <select name="idmember" class="select-member form-control" placeholder="Nama member">
                                    <option value="">-- Pilih Item --</option>";
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama </td>
                            <td><input class="form-control" type="text" name="name"
                                    value="<?= $sourcing->contact->name ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td><input class="form-control" type="text" name="email"
                                    value="<?= $sourcing->contact->email ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class="form-control" type="text" name="phone"
                                    value="<?= $sourcing->contact->telephone ?>" />
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
                            <td>: -</td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <strong>Alamat Penagihan</strong>
                <table class="col-xs-12 m-t-3">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td><input class="form-control" type="text" name="billing_name" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td>Perusahaan </td>
                            <td><input class="form-control" type="text" name="billing_company" value="" /></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class="form-control" type="text" name="billing_phone" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td class="billing"><input class="form-control m-b-1" type="text" name="billing_address"
                                    value="" />
                                <select class="form-control billing-province" data-type="billing" name="province"
                                    placeholder="Nama Provinsi" style="margin-bottom:10px" required>
                                    <option>-- Pilih Provinsi --</option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                    <option value="<?php echo $item->id ?>">
                                        <?php echo $item->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control billing-regency" name="regency" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kabupaten --</option>
                                </select>
                                <select class="form-control billing-district" name="district" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kecamatan --</option>
                                </select>
                                <select class="form-control billing-village" name="village" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>-- Pilih Desa / Kelurahan --</option>
                                </select>
                                <input class="form-control" type="hidden" name="billing_province" value="" />
                                <input class="form-control" type="hidden" name="billing_city" value="" />
                                <input class="form-control" type="hidden" name="billing_village_id" value="" />
                                <input class="form-control" placeholder="Kode pos" type="text" name="billing_kodepos"
                                    value="" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <div class="row">
                    <div class="col-lg-6">
                        <strong>Alamat Pengiriman</strong>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button" class="btn btn-sm btn-info show-list-sourcing" data-toggle="modal"
                            data-target="#myModal">
                            <i class="fa fa-fw fa-search"></i> Ambil
                            Dari Sourcing Buyer</button>
                    </div>
                </div>
                <table class="col-xs-12 m-t-3">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td><input class="form-control" type="text" name="shipping_name" />
                            </td>
                        </tr>
                        <tr>
                            <td>Perusahaan </td>
                            <td><input class="form-control" type="text" name="shipping_company" /></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class="form-control" type="text" name="shipping_phone" /></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td class="shipping"><input class="form-control m-b-1" type="text" name="shipping_address"
                                    value="" />
                                <select class="form-control shipping-province" data-type="shipping" name="province"
                                    placeholder="Nama Provinsi" style="margin-bottom:10px" required>
                                    <option>-- Pilih Provinsi --</option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                    <option value="<?php echo $item->id ?>">
                                        <?php echo $item->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control shipping-regency" name="regency" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kabupaten --</option>
                                </select>
                                <select class="form-control shipping-district" name="district" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>-- Pilih Kota / Kecamatan --</option>
                                </select>
                                <select class="form-control shipping-village" name="village" placeholder="Nama kota"
                                    style="margin-bottom:10px" required>
                                    <option>-- Pilih Desa / Kelurahan --</option>
                                </select>
                                <input class="form-control" type="hidden" name="shipping_province" value="" />
                                <input class="form-control" type="hidden" name="shipping_city" value="" />
                                <input class="form-control" type="hidden" name="shipping_village_id" value="" />
                                <input class="form-control" type="text" placeholder="Kode Pos" name="shipping_kodepos"
                                    value="" />
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
                            <?php if($sourcing != null) : ?>
                            <input type="hidden" name="id_produk[]" value="">
                            <?php else : ?>
                            <select name="id_produk[]" class="js-example-basic-single form-control"
                                placeholder="Nama produk">
                                <option value="">-- Pilih Item --</option>";
                            </select>
                            <?php endif ?>
                        </td>
                        <td width="50"><input name="qty[]" class="form-control" type="number" min="0" value="0" /></td>
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