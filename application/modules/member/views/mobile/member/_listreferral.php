<?php $session = $this->session->all_userdata();
$sessionmember = $session["member"];
$namemember = $sessionmember["name"];
$pointmember = $sessionmember["point"];
$levelmember = $sessionmember["level"];
?>
<div class="row">
    <div class="card col-xs-12 f14" style="padding: 10px;">
        Saldo: <?php echo number_format($pointmember, 0, ',', '.') ?>
        <a href=" <?php echo site_url('member/withdrawal'); ?>" style="float: right; color: #FF9900;"><u>Cairkan saldo</u></a>
        <hr>
        Kode Referal:
        <input id="referral" disabled style="width: 100px; border:none; background-color:white;" value="<?php echo $kode ?>"></input>
        <button onclick=" copyToClipboard()" type="button" style="border: none; background-color:white; float:right;"><i class="fa fa-copy" style="color: #FF9900;"></i></button>
    </div>
    <div class="col-xs-12" style="font-size: smaller;">
        <span class="alert alert-warning pull-right">
            <strong>Catatan</strong> <br />
            Bagikan kode referral ini ke jaringan anda. Dapatkan koin sebesar <b>50.000</b> untuk setiap item yang terbeli menggunakan kode referral tersebut.</span>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="card col-md-12 p-a-1 text-center">
        <strong class="f22 fbold">Riwayat TRU Koin anda</strong>
    </div>
    <hr>
    <?php
    $this->load->library('Date');
    foreach ($mutation->result() as $key => $item) : ?>
        <div class="card f14" style="padding: 20px;">
            <div class="row">
                <div class="col-xs-12">
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

<script>
    function copyToClipboard() {
        const text = document.getElementById("referral").value;
        navigator.clipboard.writeText(text).then(function() {
            alert("Copied the text: " + text);
        }).catch(function(error) {
            console.error("Unable to copy text: ", error);
        });
    }
</script>