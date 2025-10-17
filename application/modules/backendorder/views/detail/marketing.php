<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <p class="f20 fbold">Detail Merketing</p>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-sm m-a-0">
                                <tbody>
                                    <tr>
                                        <th>Nama Marketing</th>
                                        <td><?= $marketing['name'] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $marketing['email'] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Persentase</th>
                                        <td><?= $detail->marketing_persentase ?? 0 ?>%</td>
                                    </tr>
                                    <tr>
                                        <th>Marketing Fee</th>

                                        <td><?= number_format($detail->marketing_amount, 0, ',', '.') ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Status Fee</th>
                                        <td> <?= $detail->marketing_amount > 0 ? strtolower($detail->status) != 'complete' ? 'Menunggu Pesanan Selesai' : 'Selesai' : '-' ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-b-3">
        <div class="row">
            <div class="col-md-12">
                <p class="f20 fbold">Edit Marketing</p>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-a-1">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST"
                                action="<?= base_url('backendorder/set_marketing/' . $this->uri->segment(3)) ?>"
                                class="row">
                                <div class="col-md-6">
                                    <div class="form-group d-flex flex-column">
                                        <label for="refral">Pilih Marketing</label>
                                        <select type="text" class="form-control select-marketing" id="refral"
                                            placeholder="Masukan kode referal yang valid" name="marketing_id">
                                            <option value="">-- Pilih Marketing --</option>";
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marketing_persentase">Marketing Persentase</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                value="<?= $marketing_setting['value'] ?>" id="marketing_persentase"
                                                placeholder="0" name="marketing_persentase">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btnnew">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>