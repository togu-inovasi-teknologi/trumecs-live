<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>
<div class="row">
    <div class="col-lg-12">
        <strong class="f22">TruCoins</strong>
    </div>
    <div class="col-lg-8">
        <div class="card borderdesk p-a-1 m-t-1 f14">
            <div class="row">
                <div class="col-lg-12 ">
                    <strong class="f18">Riwayat Saldo</strong>
                    <?php
                    $this->load->library('Date');
                    foreach ($mutation->result() as $key => $item) : ?>
                        <div class="card f14 m-t-1" style="padding: 20px;">
                            <div class="row">
                                <div class="col-lg 1-12">
                                    <strong><?php echo $item->id ?> - <?php echo $item->mutation_type == '2' ? 'Kredit' : 'Debit' ?></strong>
                                    <a class="label status-<?php echo $item->status ?>"><?php echo $item->status ?></a>
                                    <?php if ($item->mutation_type == '2') { ?>
                                        <p style="float: right; color: red;">- <?php echo number_format($item->amount, 0, ',', '.') ?></p><br />
                                    <?php } else { ?>
                                        <p style="float: right; color: green;">+ <?php echo number_format($item->amount, 0, ',', '.') ?></p><br />
                                    <?php } ?>
                                    <small><?php echo $this->date->format_panjang_waktu(date('Y-m-d H:i:s', $item->created_at)) ?></small><br /><br />
                                </div>
                            </div>
                            <span><?php echo $item->description == "" ? "-" : $item->description ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card borderdesk p-a-1 m-t-1">
            <div class="row">
                <div class="col-lg-12">
                    <strong class="f18">Detail Saldo</strong>
                </div>
                <div class="col-lg-12 m-t-1">
                    <div class="col-lg-6">
                        <h6 style="color: black;">Total Saldo</h6>
                        <p style="color: black;" class="fbold"><?php echo number_format($pointmember, 0, ',', '.') ?></p>
                    </div>
                    <div class="col-lg-6">
                        <a href=" <?php echo site_url('member/withdrawal'); ?>" class="btn btnnew pull-right">Tarik saldo</a>
                    </div>
                </div>
                <div class="col-lg-12 m-t-1">
                    <div class="col-lg-9">
                        <h6 style="color: black;">Kode Referral</h6>
                        <p id="referralCode"><?php echo $kode ?></p>
                    </div>
                    <div class="col-lg-3 f30 text-right">
                        <button id="copyReferral" type="button" style="border: none; background-color:white;">
                            <i class="fa fa-copy" style="color: #FF9900;"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12 m-t-1">
                    <span class="alert alert-warning pull-right f12">
                        <strong>Catatan!</strong>
                        <br />
                        Bagikan kode referral ini ke jaringan anda.
                        Dapatkan koin sebesar <b>50.000</b> untuk setiap item yang terbeli menggunakan kode referral tersebut.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#copyReferral").click(function() {
            var referralCode = $("#referralCode").text();
            navigator.clipboard.writeText(referralCode).then(function() {
                alert("Kode Referral telah disalin ke clipboard: " + referralCode);
            }).catch(function(error) {
                console.error("Gagal menyalin Kode Referral:", error);
            });
        });
    });
</script>