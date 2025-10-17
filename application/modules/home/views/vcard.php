<html>
    <head>
        <title>Trumecs - Virtual ID Card</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            body{
                margin:0px;
                padding:0px;
            }
            .container {
                width:100%;
            }

            .row {
                width:100%;
                display:block;
            }

            .vcard-row {
                display:flex !important;
                border-bottom:1px dashed #ccc;
                padding:10px;
            }

            .header {
                background:#232323;
                display:block;
                width:100%;
                min-height:300px;
                margin:0px;
                padding:0px;
            }

            .vcard-head{
                max-width:100%;
                margin-top:50px;
                display:flex;
                padding:25px;
            }

            .header-logo{
                vertical-align:middle;
                width:100%;
                display:block;
            }

            .header-logo img{
                width:100%
            }

            .vcard-name{
                font-size:36px;
                font-weight:bold;
            }

            .vcard-position{
                font-size:28px;
            }

            .vcard-qr{
                display:inline-block;
                width:100px;
            }

            .vcard-qr img{
                width:100%;
            }


            .vcard-info{
                font-size:18px;
                vertical-align:middle;
            }

            .vcard-body{
                margin-top:50px;
                padding-bottom:100px;
            }

            .vcard-icon{
                margin-right:20px;
                margin-left:30px;
                width:50px;
            }

            .vcard-icon img{
                width:100%;
                vertical-align:middle;
            }

            .body {
                font-family: 'Poppins', sans-serif;
                position:relative;
            }

            .vcard-button {
                border-radius:50%;
                background:#ed7c1e;
                color:#fff;
                /* width:50px;
                height:50px; */
                text-align:center;
                position:absolute;
                bottom:0;
                right:0;
                text-decoration:none;
                vertical-align:middle;
                padding:10px 17px;
                font-weight:bold;
                margin-right:30px;
                margin-bottom:30px;
            }

            @media (min-width:768px) {
                .container {
                    width:50%;
                    margin:0px 25%;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="header-logo">
                <img src="<?php echo base_url('public/vcard/logo.png'); ?>" />
                </div>
            </div>
            <div class="body">
                <div class="vcard">
                    <div class="vcard-head">
                        <div class="row">
                            <div class="vcard-name"><?php echo $vcard->row()->name ?></div>
                            <div class="vcard-position"><?php echo $vcard->row()->position ?></div>
                        </div>
                        <div class="vcard-qr"><img src="<?php echo base_url('public/vcard/'.$vcard->row()->qr_file); ?>" /></div>
                    </div>
                    <div class="vcard-body">
                        <div class="vcard-row">
                            <div class="vcard-icon" style="padding-top:7px;"><img src="<?php echo base_url('public/vcard/phone.png'); ?>" /></div>
                            <div class="vcard-info"><p><?php echo $vcard->row()->phone ?></p></div>
                        </div>
                        <div class="vcard-row">
                            <div class="vcard-icon" style="padding-top:10px;"><img src="<?php echo base_url('public/vcard/email.png'); ?>" /></div>
                            <div class="vcard-info"><p><?php echo $vcard->row()->email ?></p></div>
                        </div>
                        <div class="vcard-row">
                            <div class="vcard-icon" style="padding-top:10px;"><img src="<?php echo base_url('public/vcard/web.png'); ?>" /></div>
                            <div class="vcard-info"><p>www.trumecs.com</p></div>
                        </div>
                    </div>
                    <a class="vcard-button" href="<?php echo site_url('public/vcard/'.$vcard->row()->vcard_file); ?>">+</a>
                </div>
            </div>
        </div>
    </body>
</html>