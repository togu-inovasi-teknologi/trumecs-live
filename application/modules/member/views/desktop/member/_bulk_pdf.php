<header>
    <div class="container m-a-0 p-a-0">
        <div class="row text-left">
            <img src="<?php echo base_url(); ?>public/image/logotrumecs.png" alt="logo-trumecs" width="250px">
        </div>
    </div>
</header>
<table class="paging" style="width:100%">
    <thead>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="container-fluid f12">
                    <div class="row logo-trumecs d-flex flex-column">
                        <p class="f22 fbold text-center">Penawaran Harga</p>
                    </div>
                    <?php foreach ($list as $key) : ?>
                        <div class="row">
                            <div class="d-flex-sb align-items-start m-b-2">
                                <div class="d-flex flex-column gap-0">
                                    <p class="m-a-0 p-a-0">Nomor : <?php echo $key["nama_rfq"]; ?></p>
                                    <p class="m-a-0 p-a-0">Hal : Penawaran Harga</p>
                                </div>
                                <p>Jakarta, <?php
                                            $date = explode(' ', $key['updated_at']);
                                            $dateObject = new DateTime($date[0]);
                                            echo $dateObject->format("d M Y");
                                            ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0 m-b-2">
                                <p class="m-a-0 p-a-0">Kepada :</p>
                                <p class="m-a-0 p-a-0"><?php echo $key["name"]; ?></p>
                                <p class="m-a-0 p-a-0"><?php echo $key["company"]; ?></p>
                            </div>
                            <div class="d-flex flex-column gap-0 m-b-1">
                                <p class="m-a-0 p-a-0">Dengan Hormat,</p>
                                <p class="m-a-0 p-a-0">Bersama ini kami kirimkan daftar harga sesuai permintaan yang dikirimkan kepada
                                    tim Trumecs sebelumnya</p>
                            </div>
                            <div class="d-flex flex-column gap-2 m-b-1">
                                <table id="table-confirmation" class="f12 table table-bordered table-striped table-sm" style="width:100%;" cellspacing="2">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;" class="text-center">No.</th>
                                            <th style="width:50%;" class="text-center">Nama Item</th>
                                            <th style="width:15%;" class="text-center">Qty</th>
                                            <th style="width:15%;" class="text-center">Satuan</th>
                                            <th style="width:30%;" class="text-center">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($key["items"] as $keys) : ?>
                                            <tr class="table-nego f12">
                                                <td style="width:5%;" class="va-center text-center"><?php echo $i ?></td>
                                                <td style="width:50%;" class="va-center"><?php echo $keys["items"] ?></td>
                                                <td style="width:15%;" class="text-right va-right"><?php echo $keys["qty"] ?></td>
                                                <td style="width:15%;" class="text-center va-center"><?php echo $keys["uom"] ?></td>
                                                <td style="width:30%;" class="text-right va-right price-column price" data-original-price="<?php echo $keys["price"]; ?>" value="<?php echo $keys["price"]; ?>">Rp
                                                    <?php echo number_format($keys["price"], 0, ',', '.') ?></td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endforeach ?>
            
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Sub Total</p>
                                    <?php
                                    $total = 0;
                                    foreach ($key["items"] as $keys) {
                                        $total += $keys["price"] * $keys["qty"];
                                    }
                                    ?>
                                    <p class="text-right fbold total-column" data-total-price="<?php echo $total; ?>">Rp
                                        <?php echo number_format($total, 0, ",", "."); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Total</p>
                                    <?php
                                    $total = 0;
                                    foreach ($key["items"] as $keys) {
                                        $total += ($keys["price"] * $keys["qty"]);
                                    }
                                    ?>
                                    <p class="text-right fbold total-column" data-total-price="<?php echo $total; ?>">Rp
                                        <?php echo number_format($total, 0, ",", "."); ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-0 m-b-3">
                                <p class="m-a-0 p-a-0">Catatan :</p>
                                <!--<ol>
                                    <li>Harga <b><?php echo $key["inc_ppn"] == 1 ? 'SUDAH' : 'BELUM' ?></b> termasuk PPN 11%</li>
                                    <li>Harga <b><?php echo $key["inc_ongkir"] == 1 ? 'SUDAH' : 'BELUM' ?></b> termasuk ongkos kirim ke
                                        <?php echo $key['city'] ?></li>
                                    <li>Pembayaran CBD ( Cash Before Delivery )</li>
                                </ol>-->
                                <?php echo nl2br($key['admin_note']) ?>
                            </div>
                            <div class="clearfix m-b-3"></div>
                            <div class="d-flex flex-column gap-0 m-b-1">
                                <p class="m-a-0 p-a-0">Hormat Kami,</p>
                                <p class="m-a-0 p-a-0">TRUMECS</p>
                            </div>
                            <div class="clearfix m-b-3"></div>
                            <div class="d-flex flex-column gap-0 m-b-1">
                                <p class="m-a-0 p-a-0">Adrian Pratama</p>
                                <p class="m-a-0 p-a-0">Manager Operational</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </tfoot>
</table>
<footer>
    PT Tiyasa Makmur Perkasa<br/>
    Jalan Jenderal Sudirman Km31, Bekasi Selatan, Bekasi, Jawa Barat<br/>
    www.trumecs.com
</footer>
<script>
    window.print();
</script>
<style>
@page {
    margin: 20px 40px 50px ;
}
table.paging thead td {
    height: 100px;
    width:100%;
}
table.paging tfoot td {
    height: 100px;
    width:100%;
}
body {
    margin: 0px;
}
header {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    height: 100px;
    background-color: #03a9f4;
    color: white;
    text-align: center;
    line-height: 50px;
    z-index:99999;
}
footer {
    position: fixed;
    bottom: 45px;
    left: 0px;
    right: 0px;
    height: 50px;
    background-color: #000;
    text-align: center;
    line-height: 15px;
    font-size:10px;
}
</style>