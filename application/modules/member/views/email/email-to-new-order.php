<div style="background-color:#ECECEC;width:100%;padding:15px;">
    <img src="<?php echo base_url() ?>public/image/logonew.png" style="width:200px;">
</div>
<div style="background-color:#fff;width:100%;padding:15px;font-family:sans-serif">
    <h4>
        Terimakasih.
    </h4>
    <p>
        Pesanan Anda telah kami terima dengan Id Order : <strong><?php echo $order_id ?></strong> <br>
        Segera melakukan pembayaran sebesar <strong>Rp. <?php echo number_format($totalprice) ?></strong> <br>
        Sebelum tanggal <?php echo $expireddate ?>.<br>
        Ke Rekening :<br>
        No Rekening : 156-00-0557953-9<br>
        Atas Nama : PT. TRISINDO RAYA UTAMA<br>
        Bank : Bank Madiri KCP BEKASI GRANDMALL<br><br>

        Setelah melakukan pembayaran, Anda harus melakukan
        <a href="<?php echo base_url() ?>member/confirmation" style="
    background: #fabe0a;
    background-image: linear-gradient(to bottom, #fabe0a, #e69603);
    background-image: -moz-linear-gradient(top, #fabe0a, #e69603);
    background-image: -ms-linear-gradient(top, #fabe0a, #e69603);
    background-image: -o-linear-gradient(top, #fabe0a, #e69603);
    background-image: -webkit-linear-gradient(top, #fabe0a, #e69603);
    border-radius: 5px;
    color: #ffffff !important;
    font-family: Arial;
    moz-border-radius: 5;
    text-decoration: none;
    webkit-border-radius: 5;
    text-decoration:none;
    padding:6px 10px;
    color:white;
	">Konfirmasi Pembayaran</a><br>
    </p>
</div>
<div style="background-color:#ECECEC;width:100%;padding:15px;text-align: center;">
    <a href="<?php echo base_url() ?>" style="color:black;text-decoration:none"><i>www.trumecs.com</i></a>
</div>