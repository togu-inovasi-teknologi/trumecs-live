<table class="table">
    <thead>
        <tr>
            <th>Produk <br><small>Partnumber</small></th>
            <th>Jumlah</th>
            <th>Berat</th>
            <th>Harga</th>
            <th>Harga Total</th>
            <th>Garansi</th>
        </tr>
    </thead>
    <tbody>
        <?php if($sourcing != null): foreach ($sourcing->items as $key => $value) : ?>

        <tr>
            <td>

                <input name="id_produk[<?= $key ?>]" type="hidden" class="form-control"
                    value="<?= $value->product_id ?>" readonly />
                <input name="product_names[<?= $key ?>]" class="form-control" value="<?= $value->items ?>" readonly />
            </td>
            <td width="200"><input name="qty[<?= $key ?>]" class="form-control" type="number" min="0"
                    value="<?= $value->qty ?>" readonly /></td>
            <td width="150">
                <div class="input-group">
                    <input name="weight[<?= $key ?>]" class="form-control" value="<?= set_value('weight['.$key.']') ?>"
                        placeholder="Berat.." required />
                    <span class="input-group-addon" id="basic-addon1"><small class="unit">Kg</small></span>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                    <input type="text" class="form-control" value="<?= number_format($value->price, 0, ',', '.') ?>"
                        readonly />
                    <input name="harga[<?= $key ?>]" type="hidden" class="form-control" value="<?= $value->price ?>" />
                    <span class="input-group-addon" id="basic-addon1">/ <small class="unit">Unit</small></span>
                </div>
            </td>
            <td>Rp <span class="harga"><?= number_format($value->total_price, 0, ',', '.') ?></span></small>
            </td>
            <td>
                <input type="text" name="warranty[<?= $key ?>]" class="form-control" />
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>