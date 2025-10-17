<section class="memo" id="mem">
    <div class="card p-a-1">
        <div class="row">
            <div class="col-md-12">
                <strong class="m-b-2">Memo</strong>
                <table class="table m-t-2 table-bordered" id="table-memo">
                    <?php if($sourcing != null):foreach($sourcing->items as $key => $item) : ?>
                    <tr>

                        <?php if($key > 0) : ?>
                        <td colspan="8"><?= $item->items ?></td>
                        <?php  else : ?>
                        <td><?= $item->items ?></td>
                        <?php  endif; ?>
                        <?php if($key == 0) : ?>
                        <th>Qty</th>
                        <th>Harga Beli</th>
                        <th>Pajak Masukan</th>
                        <th>Harga Jual</th>
                        <th>Pajak Keluaran</th>

                        <th>Gross Profit</th>
                        <th>Persentasi</th>
                        <?php endif; ?>

                    </tr>
                    <?php foreach($item->source as $source): ?>
                    <tr>
                        <td class="text-right">
                            <a href="#">
                                <?= $source->sourcing_item->source->company->name ?>
                            </a>
                        </td>
                        <td><?= $source->qty ?></td>

                        <td>
                            <?= number_format($source->price, 0, ',', '.') ?>
                        </td>
                        <td><?= number_format($source->calculateppn(), 0, ',', '.') ?></td>
                        <td>
                            <?= number_format($item->price, 0, ',', '.') ?>
                        </td>
                        <td>
                            <?= number_format($source->sellingPPn(), 0, ',', '.') ?>
                        </td>

                        <td><?= number_format($source->calculateGrossProfit(), 0, ',', '.') ?></td>


                        <td><?= $source->getPersentation() . '%' ?></td>


                    </tr>
                    <?php endforeach; ?>

                    <?php endforeach; endif; ?>

                    <tr class="bg-grey">
                        <th name="label_total">Total</th>
                        <th name="total_qty"><?= $sourcing != null ? $sourcing->total_quantity : 0 ?></th>
                        <th name="total_qty"><?= $sourcing != null ? number_format($sourcing->total_buying_price, 0, ',', '.') : 0; ?></th>
                        <th name="total_qty"><?= $sourcing != null ? number_format($sourcing->ppn_in, 0, ',', '.') : 0; ?></th>
                        <th name="total_buying"><?= $sourcing != null ? number_format($sourcing->total_price, 0, ',', '.') : 0; ?></th>
                        <th name="total_qty"><?= $sourcing != null ? number_format($sourcing->ppn_out, 0, ',', '.') : 0; ?></th>
                        <th name="total_qty"><?= $sourcing != null ? number_format($sourcing->total_gross_profit, 0, ',', '.') : 0; ?></th>
                        <th name="total_qty"><?= $sourcing != null ? round($sourcing->total_persentation) . '%' : 0; ?></th>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <strong class="m-b-2">Memo Lain-lain</strong>
                <div class="form-inline m-t-2 m-x-1">
                    <div class="form-group m-r-1">
                        <label for="referal" class="m-r-1" style="width: 150px">Kode Referal</label>
                        <input type="text" class="form-control" id="referal" name="referral_code"
                            placeholder="Kode Referal">
                    </div>
                    <div class="form-group m-r-1">
                        <label for="referal_persentase" class="m-r-1 text-right" style="width: 150px">Persentase</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="referal_persentase" name="referal_persentase"
                                value="<?= $referal != null ? $referal->value * 10 : 0?>">
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                    <!-- <div class="form-group m-r-1">
                                <label for="referal_amount" class="m-r-1 text-right" style="width: 150px">Total</label>
                                <input type="text" class="form-control" id="referal_amount" name="referal_amount"
                                    value="0">
                            </div> -->
                </div>
                <div class="form-inline m-t-2 m-x-1">
                    <div class="form-group m-r-1">
                        <label for="cashback_to_buyer" style="width: 255px" class="m-r-1">Cashback ke
                            buyer</label>
                        <!-- <input type="text" class="form-control" id="cashback_to_buyer" name="cashback_to_buyer"
                                    value="0"> -->
                        <label class="radio-inline">
                            <input type="radio" name="cashback_to_buyer" id="inlineRadio1" value="0" checked> Ya
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="cashback_to_buyer" id="inlineRadio2" value="1"> Tidak
                        </label>
                    </div>
                    <div class="form-group m-r-1">
                        <label for="cashback_persentase" class="m-r-1 text-right" style="width: 150px">Cashback
                            Persentase</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cashback_persentase" name="cashback_persentase"
                                value="<?= $cashback != null ? $cashback->value * 10 : 0 ?>">
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                    <!-- <div class="form-group m-r-1">
                                <label for="cashback_amount" class="m-r-1 text-right" style="width: 150px">Total</label>
                                <input type="text" class="form-control" id="cashback_amount" name="cashback_amount"
                                    value="0">
                            </div> -->
                </div>
                <div class="form-inline m-t-2 m-x-1">
                    <div class="form-group m-r-1">
                        <label for="marketing_id" style="width: 150px" class="m-r-1">Marketing</label>
                        <input type="hidden" class="form-control" name="marketing_id" value="<?= $admin['id'] ?>">
                        <input type="text" class="form-control" id="marketing_id" readonly
                            value="<?= $admin['nameadmin'] ?>">
                    </div>
                    <div class="form-group m-r-1">
                        <label for="marketing_persentase" class="m-r-1 text-right"
                            style="width: 150px">Persentase</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="marketing_persentase"
                                name="marketing_persentase" value="<?= $marketing_fee != null ? $marketing_fee->value * 10 : 0?>">
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                    <!-- <div class="form-group m-r-1">
                                <label for="marketing_amount" class="m-r-1 text-right"
                                    style="width: 150px">Total</label>
                                <input type="text" class="form-control" id="marketing_amount" name="marketing_amount"
                                    value="0">
                            </div> -->
                </div>
            </div>
        </div>
    </div>
</section>