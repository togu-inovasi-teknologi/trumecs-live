<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>
<div class=" historypesanan">
    <div class="col-md-12">
        <strong class="f22">TRU Koin</strong>
        <hr />
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        Saldo: <?php echo number_format($pointmember, 0, ',', '.') ?><br />
        <a href="<?php echo site_url('member/withdrawal'); ?>">Cairkan saldo</a><br />
        <hr />
        <strong>Tambahkan TRU Koin</strong> <br />
        <div class="col-xs-8 p-a-0">Bagikan kode referral ini ke jaringan anda. Dapatkan koin sebesar 50.000 untuk setiap item yang terbeli menggunakan kode referral tersebut.</div>
        <div class="col-xs-4 p-a-0"><span class="alert alert-warning pull-right">Kode Referal: <?php echo $kode ?></span></div>
        <div class="clearfix"></div>
        <hr />
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 table-responsive">
        <strong class="f18 m-b-1 col-xs-12 p-x-1">Riwayat TRU Koin anda</strong>
        <div class="clearfix"></div>
        <table class="table table-hover tbl-claim table-responsive">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Aktifitas</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $this->load->library('Date');
                foreach ($mutation->result() as $key => $item) : ?>
                    <tr>
                        <td>
                            <!-- <a class="detail-btn" href="#" data-toggle="modal" data-id="<?php echo $item->id ?>" data-target="#rfq-modal"> --><?php echo $this->date->format_panjang_waktu(date('Y-m-d H:i:s', $item->created_at)) ?>
                            <!-- </a> -->
                        </td>
                        <td><?php echo number_format($item->amount, 0, ',', '.') ?></td>
                        <td><?php echo $item->mutation_type == '2' ? 'Kredit' : 'Debit' ?></td>
                        <td><?php echo $item->description == "" ? "-" : $item->description ?></td>
                        <td><?php echo $item->status ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Aktifitas</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>