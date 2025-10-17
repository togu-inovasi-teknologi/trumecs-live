<div class="row historypesanan">
    <div class="col-md-12">
        <strong class="f22">Kelola Penawaran</strong>
        <hr />
    </div>
    <div class="col-md-12 table-responsive">
        <table class="table table-hover tbl-claim">
            <thead>
                <tr>
                    <th>Perusahaan</th>
                    <th>PIC</th>
                    <th>Dibuat</th>
                    <th>Kontak</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $this->load->library('Date');
                foreach ($penawaran->result() as $key => $item) : ?>
                    <tr>
                        <td><a class="detail-btn" href="#" data-toggle="modal" data-id="<?php echo $item->id ?>" data-target="#rfq-modal"><?php echo $item->company ?></a></td>
                        <td><?php echo $item->name ?></td>
                        <td><?php echo $this->date->format_pendek($item->created) ?></td>
                        <td><?php echo $item->company_phone ?></td>
                        <td><?php echo $item->status == '0' ? '<span class="label label-default" style="font-weight:normal">Menunggu</span>' : ($item->file != '' ? '<a target="_blank" href="' . base_url('public/filequotation/' . $item->file) . '">Download</a>' : '<span class="label label-success" style="font-weight:normal">Diterima</span>') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Perusahaan</th>
                    <th>PIC</th>
                    <th>Dibuat</th>
                    <th>Kontak</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="rfq-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin:2% auto;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Detail Permintaan</h4>
            </div>
            <div class="modal-body" style="padding:0px">
                <table class="table table-hover table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td>Perusahaan</td>
                            <td><strong>PT KREASINDO CAHAYA SEJATI</strong></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>021 65748939</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>xxx@xxx.xxx</td>
                        </tr>
                        <tr>
                            <td>PIC</td>
                            <td>Bimantara Yoga Pradana</td>
                        </tr>
                        <tr>
                            <td>Alamat Pengiriman</td>
                            <td>Jalan Pintu Air Raya No 31 B<br />Pasar Baru, Jakarta Pusat, DKI Jakarta, 10710</td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="text-center">List Item</h5>
                <table class="table table-striped table-bordered table-hover table-sm" style="margin:0px;">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>PERTAMINA ATF DEXTRON IV</td>
                            <td class="text-right">5 DRUM</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>GREASE PERTAMINA EPX-NL 2</td>
                            <td class="text-right">3 DRUM</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>MEDITRAN SX ULTRA 15W-40 PLUS</td>
                            <td class="text-right">1 DRUM</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>PERTAMINA ATF</td>
                            <td class="text-right">20 DRUM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>