<div class="row">
    <div class="col-lg-12">

    </div>
    <div class="col-lg-12">
        <table class="table table-sm table-bordered m-a-0">

            <?php foreach ($detail->items as $index => $key) : ?>
            <tr>
                <?php if($index == 0) : ?>
                <td width="400px">
                    <?php echo $key->name_product ?>
                </td>
                <?php else: ?>
                <td colspan="8">
                    <?php echo $key->name_product ?>
                </td>
                <?php endif; ?>

                <?php if($index == 0) : ?>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Pajak Masukan</th>
                <th>Harga Jual</th>
                <th>Pajak Keluaran</th>
                <th>Gross Profit</th>
                <th>Persentase</th>



                <?php endif; ?>
            </tr>
            <?php foreach($key->item_supplier->source as $indexSource => $source): ?>

            <tr>
                <td class="text-right">
                    <a href="#">
                        <?= $source->sourcing_item->source->nama_rfq ?>
                    </a>
                </td>
                <td><?= $source->qty ?></td>

                <td><?= number_format($source->price, 0, ',', '.') ?></td>
                <td><?= number_format($source->calculateppn(), 0, ',', '.') ?></td>
                <td><?= number_format($key->price, 0, ',', '.') ?></td>
                <td><?= number_format($source->sellingPPn(), 0, ',', '.') ?></td>


                <td>
                    <?= number_format($source->calculateGrossProfit(), 0, ',', '.') ?></td>

                <td><?= $source->getPersentation() . '%'; ?></td>

            </tr>
            <?php endforeach; ?>
            <?php endforeach ?>
            <tr class="bg-grey">
                <th name="label_total">Total</th>
                <th name="total_qty" data-value="<?= $detail->buyer->total_quantity ?>">
                    <?= $detail->buyer->total_quantity ?></th>
                <th name="total_buying_price" data-value="<?= $detail->buyer->total_buying_price ?>">
                    <?= number_format($detail->buyer->total_buying_price, 0, ',', '.'); ?>
                </th>
                <th name="total_ppn_in" data-value="<?= $detail->buyer->ppn_in ?>">
                    <?= number_format($detail->buyer->ppn_in, 0, ',', '.'); ?></th>
                <th name="total_selling_price" data-value="<?= $detail->buyer->total_price ?>">
                    <?= number_format($detail->buyer->total_price, 0, ',', '.'); ?></th>
                <th name="total_ppn_out" data-value="<?= $detail->buyer->ppn_out ?>">
                    <?= number_format($detail->buyer->ppn_out, 0, ',', '.'); ?></th>
                <th name="total_gross_profit" data-value="<?= $detail->buyer->total_gross_profit ?>">
                    <?= number_format($detail->buyer->total_gross_profit, 0, ',', '.'); ?></th>
                <th name="total_persentation" data-value="<?= $detail->buyer->total_persentation ?>">
                    <?= round($detail->buyer->total_persentation) . '%'; ?></th>
            </tr>
            <tr>
                <td colspan="6">Pengiriman</td>
                <td colspan="2" class="text-left">
                    <?= number_format($detail->getShippingCost(), 2, ',', '.') ?>
                </td>
            </tr>

            <tr>
                <td colspan="6">Marketing Fee</td>
                <td colspan="2" class="text-left"><?= number_format($detail->marketing_amount, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="6">PPH Marketing</td>
                <td colspan="2" class="text-left">
                    <?= $detail->pphMarketing()//number_format($detail->pphMarketing(), 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="6">Cashback Fee</td>
                <td colspan="2" class="text-left"><?= number_format($detail->cashback_amount, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="6">PPH Cashback</td>
                <td colspan="2" class="text-left">
                    <?= $detail->pphCashback()//number_format($detail->pphCashback(), 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="6">Referral Fee</td>
                <td colspan="2" class="text-left">
                    <?= number_format($detail->referral_code == "" ? 0 :$detail->referal_amount, 0, ',', '.') ?>
                </td>
            </tr>
            <tr>
                <td colspan="6">PPH Referral</td>
                <td colspan="2" class="text-left">
                    <?= number_format($detail->pphReferral(), 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="6">Cost Pajak</td>
                <td colspan="2" class="text-left">
                    <?= number_format($detail->costPajak(), 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="5">Cost of fund</td>
                <td class="text-left">
                    <select class="form-control" name="tempo" id="dropwdown-tempo">
                        <option value="0">0 Hari</option> <!--  30 hari (1.5% * harga beli)  -->
                        <option value="30">30 Hari</option> <!--  30 hari (1.5% * harga beli)  -->
                        <option value="60">60 Hari</option> <!--  30 hari (1.5% * harga beli)  -->
                        <option value="90">90 Hari</option> <!--  30 hari (1.5% * harga beli)  -->
                    </select>
                </td>
                <td class="text-left" id="tempo-value" colspan="2">
                    0
                </td>


            </tr>
            <tr>
                <td colspan="6">Net Profit</td>
                <td colspan="2" class="text-left">
                    <?= number_format($detail->netProfit(), 2, ',', '.') ?>
                </td>
            </tr>


        </table>

    </div>
</div>