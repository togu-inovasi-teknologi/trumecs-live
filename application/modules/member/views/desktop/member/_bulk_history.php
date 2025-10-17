<div class="row">
    <div class="col-lg-12 title-desktop">
        <h3 class="title-content">Riwayat RFQ</h3>
    </div>
    <section id="listRfq">
        <div class="col-lg-12">
            <div class="card p-a-1 m-t-1 f14">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="fbold card-title forange">RFQ Saya</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-bordered table-striped" id="tableHistory" style="width:100%;" cellspacing="2">
                                        <thead>
                                            <tr class="forange f16 va-middle align-items-center">
                                                <th style="width: 3%;">No.</th>
                                                <th style="width: 30%;">Nomor RFQ</th>
                                                <th style="width: 10%;" class="text-center">Jumlah Item</th>
                                                <th style="width: 10%;" class="text-center">Jumlah Qty</th>
                                                <th style="width: 27%;" class="text-center">Harga Total</th>
                                                <th style="width: 10%;" class="text-center">Status</th>
                                                <th style="width: 10%;" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($list as $key) : ?>
                                                <tr>
                                                    <td class="text-center va-middle"><?php echo $i; ?></td>
                                                    <td class="va-middle"><a href="#" data-toggle="modal" data-target="#listRfq-<?= $key["id"]; ?>"><?php echo $key['nama_rfq']; ?></a></td>
                                                    <td class="text-center va-middle"><?php echo count($key["items"]); ?></td>
                                                    <?php $sumQty = 0;
                                                    $sumHargaTotal = 0;
                                                    foreach ($key['items'] as $index => $value) {
                                                        $sumQty += $value['qty'];
                                                        $sumHargaTotal += $value['price'] * $value['qty'];
                                                    } ?>
                                                    <td class="text-center va-middle"><?= $sumQty ?></td>
                                                    <td class="text-right va-middle">Rp <?= number_format($sumHargaTotal, 0, ",", ".") ?></td>
                                                    <td class="text-center va-middle"><span class="label label-<?php if ($key["status_member"] == null) {
                                                                                                                } else if ($key["status_member"] == "menunggu") {
                                                                                                                    echo "warning";
                                                                                                                } else if ($key["status_member"] == "nego") {
                                                                                                                    echo "info";
                                                                                                                } else {
                                                                                                                    echo "success";
                                                                                                                } ?>"><?= $key["status_member"] ?></span>
                                                    </td>
                                                    <td class="text-center va-middle">
                                                        <?php if ($key["status_member"] == "selesai") : ?>
                                                            <a class="btn btn-success f12 fbold" href="<?php echo base_url('member/bulkPdf/' . $key["id"]); ?>" target="_blank"><i class="fa fa-download"> Penawaran</i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php foreach ($listall as $key) : ?>
    <div class="modal fade" id="listAllRfq-<?php echo $key['id']; ?>" tabindex="-1" role="dialog" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog" style="margin: 10px auto;width:80vw;">
            <div class="modal-content">
                <form action="<?php echo site_url(); ?>member/saveItem" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title fbold">List Item Penawaran</h3>
                    </div>
                    <div class="modal-body" style="height:55vh; overflow-y:scroll;">
                        <table class="table table-bordered table-striped" style="width:100%;" cellspacing="2">
                            <thead>
                                <tr>
                                    <th style="width:3%;">No.</th>
                                    <th style="width:25%;">Nama</th>
                                    <th style="width:4%;" class="text-center">Status</th>
                                    <th style="width:8%;" class="text-center">Qty</th>
                                    <th style="width:15%;" class="text-center">Harga</th>
                                    <th style="width:15%;" class="text-center">Harga Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($key["items"] as $keys) : ?>
                                    <tr class="table-nego">
                                        <td class="va-middle text-center"><?php echo $i ?></td>
                                        <td class="va-middle"><?php echo $keys["items"] ?></td>
                                        <td class="text-center va-middle">
                                            <span class="label label-<?php if ($keys["status_member"] == "menunggu") {
                                                                            echo "warning";
                                                                        } else if ($keys["status_member"] == "nego") {
                                                                            echo "info";
                                                                        } else if ($keys["status_member"] == "setuju") {
                                                                            echo "success";
                                                                        } else {
                                                                            echo "danger";
                                                                        } ?>"><?= $keys["status_member"] ?>
                                            </span>
                                        </td>
                                        <td class="text-center va-middle"><?php echo $keys['qty']; ?></td>
                                        <td class="text-right va-middle price-column price" data-original-price="<?php echo $keys["price"]; ?>" value="<?php echo $keys["price"]; ?>">Rp <?php echo number_format($keys["price"], 0, ',', '.') ?><input type="hidden" jq-model="price" name="price[]" class="price-fix" value="<?php echo number_format($keys["price"], 0, ',', '.') ?>" /></td>
                                        <?php $total = $keys["price"] * $keys["qty"]; ?>
                                        <td class="text-right va-middle total-harga" value="<?php echo $total; ?>">Rp <?php echo number_format($total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 d-flex flex-column gap-1 p-y-1">
                        <div class="d-flex-sb align-items-center fbold">
                            <p>Total :</p>
                            <?php $total = 0;
                            foreach ($key["items"] as $value) {
                                $total += $value['price'] * $value['qty'];
                            } ?>
                            <p>Rp <?= number_format($total, 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btnnew" data-toggle="modal" data-target="#listRfq-<?= $key['id']; ?>" data-dismiss="modal">Kembali</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php foreach ($list as $key) : ?>
    <div class="modal fade" id="listRfq-<?php echo $key['id']; ?>" tabindex="-1" role="dialog" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog" style="margin: 10px auto;width:80vw;">
            <div class="modal-content">
                <form action="<?php echo site_url(); ?>member/saveItem" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title fbold">List Item Penawaran</h3>
                    </div>
                    <div class="modal-body" style="height:55vh; overflow-y:scroll;">
                        <table class="table table-bordered table-striped" style="width:100%;" cellspacing="2">
                            <thead>
                                <tr>
                                    <th style="width:3%;">No.</th>
                                    <th style="width:25%;">Nama</th>
                                    <th style="width:4%;" class="text-center">Status</th>
                                    <th style="width:8%;" class="text-center">Qty</th>
                                    <th style="width:15%;" class="text-center">Harga</th>
                                    <th style="width:15%;" class="text-center">Harga Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($key["items"] as $keys) : ?>
                                    <tr class="table-nego">
                                        <td class="va-middle text-center"><?php echo $i ?></td>
                                        <td class="va-middle"><?php echo $keys["items"] ?></td>
                                        <td class="text-center va-middle">
                                            <span class="label label-<?php if ($keys["status_member"] == "menunggu") {
                                                                            echo "warning";
                                                                        } else if ($keys["status_member"] == "nego") {
                                                                            echo "info";
                                                                        } else if ($keys["status_member"] == "setuju") {
                                                                            echo "success";
                                                                        } else {
                                                                            echo "danger";
                                                                        } ?>"><?= $keys["status_member"] ?>
                                            </span>
                                        </td>
                                        <td class="text-center va-middle"><?php echo $keys['qty']; ?></td>
                                        <td class="text-right va-middle price-column price" data-original-price="<?php echo $keys["price"]; ?>" value="<?php echo $keys["price"]; ?>">Rp <?php echo number_format($keys["price"], 0, ',', '.') ?><input type="hidden" jq-model="price" name="price[]" class="price-fix" value="<?php echo number_format($keys["price"], 0, ',', '.') ?>" /></td>
                                        <?php $total = $keys["price"] * $keys["qty"]; ?>
                                        <td class="text-right va-middle total-harga" value="<?php echo $total; ?>">Rp <?php echo number_format($total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 d-flex flex-column gap-1 p-y-1">
                        <div class="d-flex-sb align-items-center fbold">
                            <p>Total :</p>
                            <?php $total = 0;
                            foreach ($key["items"] as $value) {
                                $total += $value['price'] * $value['qty'];
                            } ?>
                            <p>Rp <?= number_format($total, 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btnnew" data-toggle="modal" data-target="#listAllRfq-<?= $key['id']; ?>" data-dismiss="modal">Lihat Semua Penawaran</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>