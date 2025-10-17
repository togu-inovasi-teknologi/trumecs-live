<div style="background-color:#ECECEC;width:100%;padding:15px;">
	<img src="<?php echo base_url() ?>public/image/logonew.png"  style="width:200px;">
</div>
<div style="background-color:#fff;width:100%;padding:15px;font-family:sans-serif">
	<h4>
		<?php 
        date_default_timezone_set('Asia/Jakarta'); 
        
        // 24-hour format of an hour without leading zeros (0 through 23)
        $Hour = date('G');
        if ( $Hour >= 1 && $Hour <= 11 ) {
            echo "Selamat Pagi";
        } else if ( $Hour >= 12 && $Hour <= 15 ) {
            echo "Selamat Siang";
        } else if ( $Hour >= 16 || $Hour <= 18 ) {
            echo "Selamat Sore";
        }else if ( $Hour >= 19 || $Hour <= 1 ) {
            echo "Selamat Malam";
        }
        ?>, <?php echo $name ?>
	</h4>
	<p>
    Klaim Garansi Produk untuk Id Order : <strong><?php echo $order_id ?></strong> telah kami respon.<br>
    Dengan catatan :<br>
    <?php echo $comment ?>
    </p>
    <br>
    <br>
    atau silahkan buka klaim return Anda di <a href="<?php echo base_url() ?>member" target="_blank" style="color:orange;text-decoration:none">Sini</a>
</div>
<div style="background-color:#ECECEC;width:100%;padding:15px;text-align: center;">
	<a href="<?php echo base_url() ?>" style="color:black;text-decoration:none"><i>www.trumecs.com</i></a>
</div>

