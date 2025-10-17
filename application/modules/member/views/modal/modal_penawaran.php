<table class="table table-hover table-striped table-bordered">
    <tbody>
        <tr>
            <td>
                <small><strong>Perusahaan</strong></small><br/>
                <?php echo $penawaran->row()->company ?>
            </td>
        </tr>
        <tr>
            <td>
                <small><strong>Phone</strong></small><br/>
                <?php echo $penawaran->row()->company_phone ?>
            </td>
        </tr>
        <tr>
            <td>
                <small><strong>Email</strong></small><br/>
                <?php echo $penawaran->row()->company_email ?>
            </td>
        </tr>
        <tr>
            <td>
                <small><strong>PIC</strong></small><br/>
                <?php echo $penawaran->row()->pic_name ?>
            </td>
        </tr>
        <tr>
            <td>
                <small><strong>Alamat Pengiriman</strong></small><br/>
                <?php echo $penawaran->row()->company_address ?><br/>
                <?php echo ucwords($penawaran->row()->district_name) ?>,
                <?php echo ucwords($penawaran->row()->regency_name) ?>,
                <?php echo ucwords($penawaran->row()->province_name) ?>
            </td>
        </tr>
    </tbody>
</table>
<h5 class="text-center">List Item</h5>
<table class="table table-striped table-bordered table-hover" style="margin:0px;">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Produk</th>
            <th class="text-center">Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;foreach($item_penawaran->result() as $item): ?>
        <tr>
            <td class="text-center"><?php echo $no++ ?></td>
            <td><?php echo $item->tittle ?></td>
            <td class="text-right"><?php echo $item->qty ?> <?php echo $item->unit ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>