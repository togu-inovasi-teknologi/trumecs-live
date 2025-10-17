<div class="row m-t-3">
    <div class="col-lg-12 m-t-3">
        <h5>Memo Pesanan #<?= $detail->iduniq ?></h5>
        <table class="table table-sm table-bordered m-a-0 m-t-1">

            <tr>
                <td width="400px">
                    Item
                </td>


                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Pajak Masukan</th>
                <th>Harga Jual</th>
                <th>Pajak Keluaran</th>
                <th>Gross Profit</th>
                <th>Persentase</th>


            </tr>
            <?php foreach ($detail->items as $index => $key) : ?>
            <tr>
                <td class="text-right">
                    <?= $key->tittle ?>
                </td>
                <td><?= $key->quantity ?></td>
                <?php

                    $buyingPrice = 0;
                    $ppnIn = 0;
                    $ppnOut = 0;
                    $sellingPrice = 0;
                    $grossProfit = 0;
                   
                    $sellingPrice = $key->price * $key->quantity;

                    foreach ($key->item_supplier->source as $indexSource => $source ) {
                        $buyingPrice += $source->price;
                        $ppnIn += $source->calculateppn();
                        $ppnOut += $source->sellingPPn();
                        $grossProfit += $source->calculateGrossProfit();
                    }

                    $persentation = (($grossProfit - $ppnIn + $ppnOut) / $sellingPrice ) * 100;
                    
                ?>
                <td><?= number_format($buyingPrice, 2, ',', '.') ?></td>
                <td><?= number_format($ppnIn, 2, ',', '.') ?></td>
                <td><?= number_format($sellingPrice, 2, ',', '.') ?></td>
                <td><?= number_format($ppnOut, 2, ',', '.') ?></td>
                <td>
                    <?= number_format($grossProfit, 2, ',', '.') ?></td>

                <td><?= round($persentation) . '%'; ?></td>

            </tr>
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
                <th colspan="6">Net Profit</th>
                <th colspan="2" class="text-left">
                    <?= number_format($detail->netProfit(), 2, ',', '.') ?>
                </th>
            </tr>


        </table>

    </div>
</div>

<script>
window.print();
</script>