<div class="row">
    <div class="col-md-6">
        <table class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <th colspan="2">Penagihan</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>: <?php echo ($detail->billing_name) ?></td>
                </tr>
                <tr>
                    <th>Perusahaan </th>
                    <td>: <?php echo ($detail->billing_company) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: <?php echo ($detail->billing_phone) ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:
                        <?php echo ($detail->billing_address) . "," . ($detail->billing_city) . "," . ($detail->billing_province) . "-" . ($detail->billing_kodepos) ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <th colspan="2">Pengiriman</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>: <?php echo ($detail->shipping_name) ?></td>
                </tr>
                <tr>
                    <th>Perusahaan </th>
                    <td>: <?php echo ($detail->shipping_company) ?></td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>: <?php echo ($detail->shipping_phone) ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:

                        <?php echo ($detail->shipping_address) . "," . ($detail->shipping_city) . "," . ($detail->shipping_province) . "-" . ($detail->shipping_kodepos) ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>