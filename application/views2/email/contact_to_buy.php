<html>
    <head>
        <title>Email konfirmasi</title>
        <style>
            h1 {
                width:100%;
                margin: 15px 0px
            }
            .text-center {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center">Terimakasih telah berpartner dengan Trumecs</h1>
        <p>Hai, <?php echo $name ?>!</p>
        <p>Memilih Trumecs sebagai partner anda adalah awal yang bagus. Permintaan anda untuk <?php echo $qty.' '.$unit.' '.$tittle ?> telah kami terima dan kami simpan. Sebentar lagi tim sales kami akan menghubungi anda.</p>
        <p>Terimakasih,<br/>Tim Sales Trumecs</p>
    </body>
</html>