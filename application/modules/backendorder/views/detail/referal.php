<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <p class="f20 fbold">Detail Referal</p>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-sm m-a-0">
                                <tbody>
                                    <tr>
                                        <th>Nama Agent</th>
                                        <td><?= $agent['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $agent['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Referral Code</th>
                                        <td><?= $detail->referral_code ?></td>
                                    </tr>
                                    <tr>
                                        <th>Persentase</th>
                                        <td><?= $detail->referal_persentase ?>%</td>
                                    </tr>
                                    <tr>
                                        <th>Referral Fee</th>
                                        <?php if($detail->status != 'complete') : ?>
                                        <td><?= number_format(($detail->payment_total * $agent['referal_persentase'] / 100), 0, ',', '.') ?>
                                        </td>
                                        <?php else : ?>
                                        <td><?= number_format($detail->referal_amount, 0, ',', '.') ?>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th>Status Fee</th>
                                        <td> <?php 

                                            if($detail->referral_code == '' || $detail->referral_code == null){
                                                echo '';
                                            }else if(strtolower($detail->status) != 'complete'){
                                                echo 'Menunggu Pesanan Selesai';
                                            }else{
                                                echo 'Selesai';
                                            }
   
                                        
                                        ?>
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
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <p class="f20 fbold">Detail Cashback</p>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-sm m-a-0">
                                <tbody>
                                    <tr>
                                        <th>Presentase Cashback</th>
                                        <td><?= $detail->cashback_persentase ?? 0 ?> %</td>
                                    </tr>
                                    <tr>
                                        <th>Cashback</th>
                                        <?php if($detail->status != 'complete') : ?>
                                        <td><?= number_format($detail->cashback_amount, 0, ',', '.') ?>
                                        </td>
                                        <?php else : ?>
                                        <td><?= number_format($detail->cashback_amount, 0, ',', '.') ?>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th>Status Penerimaan Cashback</th>
                                        <td><?= $detail->cashback_amount > 0 ? strtolower($detail->status) != 'complete' ? 'Menunggu Pesanan Selesai' : 'Selesai' : '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cashback Dikirim ke Buyer</th>
                                        <td><?= $agent['cashback_to_buyer'] == 0 ? 'Tidak' : 'Ya'?></td>
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
                <p class="f20 fbold">Edit Referral</p>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-a-1">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST"
                                action="<?= base_url('backendorder/set_referal/' . $this->uri->segment(3)) ?>"
                                class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refral">Kode Referal</label>
                                        <input type="text" class="form-control" id="refral"
                                            placeholder="Masukan kode referal yang valid" name="referal_code">
                                    </div>
                                    <div class="form-group">
                                        <label for="referal_persentase">Referal Persentase</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="<?= $referal['value'] ?>"
                                                id="referal_persentase" placeholder="0" name="referal_persentase">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cashback">Cashback Persentase</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="<?= $cashback['value'] ?>"
                                                id="cashback" placeholder="0" name="cashback_presentase">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="cashback_to_buyer"> Berikan ke
                                            pembeli
                                            atau
                                            tidak.
                                        </label>
                                    </div>
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