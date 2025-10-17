<html>
    <head>
        <!--<meta name="viewport" content="initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">-->
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" >
        <?php
        if (isset($css_cdn)) {
            foreach ($css_cdn as $item) {
                echo $item;
            }
        }
        ?>
        <?php
        if (isset($css)) {
            $minicss = $this->minifile->create($css, 'css');
            echo '<link rel="stylesheet" href="' . base_url("asset/core/css/" . $minicss) . '" />';
        }
        ?>
        <style>
                body {
                    font-family:'Arial';
                }
                .link{
                    display:inline-block;
                    float:left;
                    width:100px;
                    height:100px;
                }
                .stand {
                  fill: #fff;
                  stroke: #eee;
                  stroke-width: 1px;
                  //rx:1;
                  //ry:1;
                  box-shadow:1px 1px 5px rgba(0,0,0,.1);
                }
                .clicked{
                    fill:#08c900 !Important;
                }
                .toilet{
                    width: 30px;
                    height: 45px;
                    fill: url(#toiletGradient);
                }
                .eo{
                    width: 45px;
                    height: 45px;
                    fill: url(#eoGradient);
                }
                .royalindo{
                    width: 75px;
                    height: 45px;
                    fill: url(#royalindoGradient);
                }
                .empty{
                    width: 30px;
                    height: 45px;
                    fill: #eee;
                }
                .big {
                    width: 30px;
                    height: 45px;
                    fill:url(#MyGradient); 
                }
                .umkm {
                    width: 10px;
                    height: 10px;
                    fill: url(#MyGradient);
                }
                .umkm-landscape {
                    width: 20px;
                    height: 10px;
                    fill: url(#MyGradient);
                }
                .umkm-portrait {
                    width: 10px;
                    height: 20px;
                    fill: url(#MyGradient);
                }
                .sarnafil{
                    width: 25px;
                    height: 25px;
                    fill:url(#MyGradient); 
                }
                .medium-square{
                    width: 30px;
                    height: 30px;
                    fill: url(#MyGradient);
                }
                .small{
                    width: 15px;
                    height: 15px;
                    fill: url(#MyGradient);
                }
                .small-rect{
                    width: 30px;
                    height: 15px;
                    fill: url(#MyGradient);
                }
                .small-rect-portrait{
                    width: 15px;
                    height: 30px;
                    fill: url(#MyGradient);
                }
                .small-rect-portrait-long{
                    width: 15px;
                    height: 60px;
                    fill: url(#MyGradient);
                }
                .medium-rect{
                    width: 30px;
                    height: 45px;
                    fill: url(#MyGradient);
                }
                .big-rect{
                    width: 30px;
                    height: 60px;
                    fill: url(#MyGradient);
                }
                .big-rect-landscape{
                    width: 90px;
                    height: 45px;
                    fill: url(#MyGradient);
                }
                .gallery {
                    width: 45px;
                    height: 15px;
                }
                .workshop-landscape{
                    width: 110px;
                    height: 60px;
                    fill: url(#workshopGradient);
                }
                .workshop-portrait{
                    width: 60px;
                    height: 110px;
                    fill:url(#workshopGradient);
                }
                .workshop-portrait-right{
                    width: 75px;
                    height: 115px;
                    fill:url(#workshopGradient);
                }
                .workshop-portrait-small{
                    width: 75px;
                    height: 85px;
                    fill:url(#workshopGradient);
                }
                .lunch-landscape{
                    width: 68px;
                    height: 50px;
                    fill:#fff;
                }
                .lunch-portrait{
                    width: 35px;
                    height: 60px;
                    fill:#fff;
                }
                .lunch-big{
                    width: 100px;
                    height: 200px;
                    fill:url(#lunchGradient);
                }
                .luncheon{
                    width: 60;
                    height: 125px;
                    fill:url(#lunchGradient);
                }
                .public-area{
                    width: 75px;
                    height: 150px;
                }
                .tkk{
                    width: 575px;
                    height: 175px;
                    fill:url(#tkkGradient)
                }
                .technical-stage{
                    width: 100px;
                    height: 100px;
                    fill:url(#technicalGradient)
                }
                .lomba-rumah{
                    width: 35px;
                    height: 35px;
                    fill:url(#lombaGradient)
                }
                .tkk-booth{
                    width: 25px;
                    height: 25px;
                    fill:url(#MyGradient);
                }
                .media-corner{
                    width: 30px;
                    height: 45px;
                    fill:#fff;
                }
                .matching-lounge{
                    width: 30px;
                    height: 60px;
                    fill:url(#loungeGradient)
                }
                .sponsor-lounge{
                    width: 37.5px;
                    height: 60px;
                    fill:url(#loungeGradient)
                }
                .booth-name {
                    font-size:4px;
                    width:100%;
                    text-align:center;
                    font-family:"Arial";
                    fill:#fff;
                }
                .foyer-big-landscape{
                    width: 60px;
                    height: 40px;
                    fill:url(#foyerGradient)
                }
                .foyer-big-portrait{
                    width: 40px;
                    height: 60px;
                    fill:url(#foyerGradient)
                }
                .foyer-small-landscape{
                    width: 75px;
                    height: 35px;
                    fill:url(#foyerGradient)
                }
                .foyer-small-landscape-bottom{
                    width: 75px;
                    height: 37.5px;
                    fill:url(#foyerGradient)
                }
                .food-truck{
                    width: 50;
                    height: 175px;
                    fill:url(#foodGradient)
                }
                .acpe{
                    width: 207.5px;
                    height: 60px;
                    fill:url(#acpeGradient)
                }
                .jiexpo-cafe{
                    width: 150px;
                    height: 50px;
                    fill:url(#cafeGradient)
                }
                .info-container {
                    padding:15px 10px;
                    display:block;
                    position:fixed;
                    bottom:0;
                }
                .search-card{
                    background-color:#15163d;
                    color:#fff;
                    padding:10px;
                    box-shadow:0px 1px 3px rgba(0,0,0,.3);
                    position:relative;
                }
                .info-card {
                    background-color:#fff;
                    box-shadow:0px 1px 3px rgba(0,0,0,.3);
                    display:block;
                    float:left;
                    position:relative;
                }
                .form-input{
                    width:100%;
                    padding:10px 5px;
                    border:1px solid #fff;
                    font-size:16px;
                    color:#fff;
                    background-color:#15163d;
                    border-radius:10px;
                }
                .header{
                    padding:13px 10px;
                    border:1px solid #eee;
                }
                .back-button{
                    background:#fff;
                    border-radius:0px;
                    border:none;
                    font-size:14px;
                    font-weight:normal;
                    margin:-13px -10px;
                    padding:13px 10px;
                }
                .back-button:active{
                    color:#000;
                }
                .back-button:hover{
                    cursor:pointer;
                }
                .info-body{
                    padding:10px;
                    color:#333;
                }
                .search-result, .event-detail, .booth-detail{
                    display:none;
                    position:fixed;
                    bottom:0;
                    background:#fff;
                    width:95%;
                    margin-bottom:10px;
                    z-index:99999;
                }
                .list-item{
                    display:block;
                    width:100%;
                    padding:10px 0px;
                    background:#fff;
                    border:1px solid #eee;
                    text-decoration:none;
                    color:#666;
                    z-index:99999;
                }
                .item{
                    margin:0px 10px;
                }
                #search-close{
                    position:absolute;
                    color:#fff;
                    right:30;
                    top:25px;
                    display:none;
                    text-decoration:none;
                }
                #booth-number{
                    padding:5px;
                    background:#ff9900;
                    color:#fff;
                    border-radius:5px;
                    display:inline-block;
                    width:auto;
                    margin:10px 0px;
                    font-weight:bold;
                }
                .main-header{
                    position:fixed;
                    width:100%;
                    padding:10px 0px 0px;
                    background:#fff;
                }
                .logo-ki{
                    width:30%;
                    display:inline-block;
                }
                .logo-trumecs, .logo-royalindo, .logo-kupu{
                    width:20%;
                    display:inline-block;
                    float:right;
                }
                #marker{
                    position:absolute;
                    display:none;
                    top:0;
                    border:1px solid #999;
                    z-index:9999;
                }
                .pin {
                  width: 30px;
                  height: 30px;
                  border-radius: 50% 50% 50% 0;
                  background: #89849b;
                  position: absolute;
                  -webkit-transform: rotate(-45deg);
                  -moz-transform: rotate(-45deg);
                  -o-transform: rotate(-45deg);
                  -ms-transform: rotate(-45deg);
                  transform: rotate(-45deg);
                  left: 50%;
                  top: 50%;
                  margin: -20px 0 0 -20px;
                  -webkit-animation-name: bounce;
                  -moz-animation-name: bounce;
                  -o-animation-name: bounce;
                  -ms-animation-name: bounce;
                  animation-name: bounce;
                  -webkit-animation-fill-mode: both;
                  -moz-animation-fill-mode: both;
                  -o-animation-fill-mode: both;
                  -ms-animation-fill-mode: both;
                  animation-fill-mode: both;
                  -webkit-animation-duration: 1s;
                  -moz-animation-duration: 1s;
                  -o-animation-duration: 1s;
                  -ms-animation-duration: 1s;
                  animation-duration: 1s;
                }
                .pin:after {
                  content: '';
                  width: 14px;
                  height: 14px;
                  margin: 8px 0 0 8px;
                  background: #2f2f2f;
                  position: absolute;
                  border-radius: 50%;
                }
                .pulse {
                  background: rgba(0,0,0,0.2);
                  border-radius: 50%;
                  height: 14px;
                  width: 14px;
                  position: absolute;
                  left: 50%;
                  top: 50%;
                  margin: 11px 0px 0px -12px;
                  -webkit-transform: rotateX(55deg);
                  -moz-transform: rotateX(55deg);
                  -o-transform: rotateX(55deg);
                  -ms-transform: rotateX(55deg);
                  transform: rotateX(55deg);
                  z-index: -2;
                }
                .pulse:after {
                  content: "";
                  border-radius: 50%;
                  height: 40px;
                  width: 40px;
                  position: absolute;
                  margin: -13px 0 0 -13px;
                  -webkit-animation: pulsate 1s ease-out;
                  -moz-animation: pulsate 1s ease-out;
                  -o-animation: pulsate 1s ease-out;
                  -ms-animation: pulsate 1s ease-out;
                  animation: pulsate 1s ease-out;
                  -webkit-animation-iteration-count: infinite;
                  -moz-animation-iteration-count: infinite;
                  -o-animation-iteration-count: infinite;
                  -ms-animation-iteration-count: infinite;
                  animation-iteration-count: infinite;
                  opacity: 0;
                  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                  filter: alpha(opacity=0);
                  -webkit-box-shadow: 0 0 1px 2px #89849b;
                  box-shadow: 0 0 1px 2px #89849b;
                  -webkit-animation-delay: 1.1s;
                  -moz-animation-delay: 1.1s;
                  -o-animation-delay: 1.1s;
                  -ms-animation-delay: 1.1s;
                  animation-delay: 1.1s;
                }
                @-moz-keyframes pulsate {
                  0% {
                    -webkit-transform: scale(0.1, 0.1);
                    -moz-transform: scale(0.1, 0.1);
                    -o-transform: scale(0.1, 0.1);
                    -ms-transform: scale(0.1, 0.1);
                    transform: scale(0.1, 0.1);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                  50% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                  }
                  100% {
                    -webkit-transform: scale(1.2, 1.2);
                    -moz-transform: scale(1.2, 1.2);
                    -o-transform: scale(1.2, 1.2);
                    -ms-transform: scale(1.2, 1.2);
                    transform: scale(1.2, 1.2);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                }
                @-webkit-keyframes pulsate {
                  0% {
                    -webkit-transform: scale(0.1, 0.1);
                    -moz-transform: scale(0.1, 0.1);
                    -o-transform: scale(0.1, 0.1);
                    -ms-transform: scale(0.1, 0.1);
                    transform: scale(0.1, 0.1);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                  50% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                  }
                  100% {
                    -webkit-transform: scale(1.2, 1.2);
                    -moz-transform: scale(1.2, 1.2);
                    -o-transform: scale(1.2, 1.2);
                    -ms-transform: scale(1.2, 1.2);
                    transform: scale(1.2, 1.2);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                }
                @-o-keyframes pulsate {
                  0% {
                    -webkit-transform: scale(0.1, 0.1);
                    -moz-transform: scale(0.1, 0.1);
                    -o-transform: scale(0.1, 0.1);
                    -ms-transform: scale(0.1, 0.1);
                    transform: scale(0.1, 0.1);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                  50% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                  }
                  100% {
                    -webkit-transform: scale(1.2, 1.2);
                    -moz-transform: scale(1.2, 1.2);
                    -o-transform: scale(1.2, 1.2);
                    -ms-transform: scale(1.2, 1.2);
                    transform: scale(1.2, 1.2);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                }
                @keyframes pulsate {
                  0% {
                    -webkit-transform: scale(0.1, 0.1);
                    -moz-transform: scale(0.1, 0.1);
                    -o-transform: scale(0.1, 0.1);
                    -ms-transform: scale(0.1, 0.1);
                    transform: scale(0.1, 0.1);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                  50% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                  }
                  100% {
                    -webkit-transform: scale(1.2, 1.2);
                    -moz-transform: scale(1.2, 1.2);
                    -o-transform: scale(1.2, 1.2);
                    -ms-transform: scale(1.2, 1.2);
                    transform: scale(1.2, 1.2);
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                  }
                }
                @-moz-keyframes bounce {
                  0% {
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                    -webkit-transform: translateY(-2000px) rotate(-45deg);
                    -moz-transform: translateY(-2000px) rotate(-45deg);
                    -o-transform: translateY(-2000px) rotate(-45deg);
                    -ms-transform: translateY(-2000px) rotate(-45deg);
                    transform: translateY(-2000px) rotate(-45deg);
                  }
                  60% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                    -webkit-transform: translateY(30px) rotate(-45deg);
                    -moz-transform: translateY(30px) rotate(-45deg);
                    -o-transform: translateY(30px) rotate(-45deg);
                    -ms-transform: translateY(30px) rotate(-45deg);
                    transform: translateY(30px) rotate(-45deg);
                  }
                  80% {
                    -webkit-transform: translateY(-10px) rotate(-45deg);
                    -moz-transform: translateY(-10px) rotate(-45deg);
                    -o-transform: translateY(-10px) rotate(-45deg);
                    -ms-transform: translateY(-10px) rotate(-45deg);
                    transform: translateY(-10px) rotate(-45deg);
                  }
                  100% {
                    -webkit-transform: translateY(0) rotate(-45deg);
                    -moz-transform: translateY(0) rotate(-45deg);
                    -o-transform: translateY(0) rotate(-45deg);
                    -ms-transform: translateY(0) rotate(-45deg);
                    transform: translateY(0) rotate(-45deg);
                  }
                }
                @-webkit-keyframes bounce {
                  0% {
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                    -webkit-transform: translateY(-2000px) rotate(-45deg);
                    -moz-transform: translateY(-2000px) rotate(-45deg);
                    -o-transform: translateY(-2000px) rotate(-45deg);
                    -ms-transform: translateY(-2000px) rotate(-45deg);
                    transform: translateY(-2000px) rotate(-45deg);
                  }
                  60% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                    -webkit-transform: translateY(30px) rotate(-45deg);
                    -moz-transform: translateY(30px) rotate(-45deg);
                    -o-transform: translateY(30px) rotate(-45deg);
                    -ms-transform: translateY(30px) rotate(-45deg);
                    transform: translateY(30px) rotate(-45deg);
                  }
                  80% {
                    -webkit-transform: translateY(-10px) rotate(-45deg);
                    -moz-transform: translateY(-10px) rotate(-45deg);
                    -o-transform: translateY(-10px) rotate(-45deg);
                    -ms-transform: translateY(-10px) rotate(-45deg);
                    transform: translateY(-10px) rotate(-45deg);
                  }
                  100% {
                    -webkit-transform: translateY(0) rotate(-45deg);
                    -moz-transform: translateY(0) rotate(-45deg);
                    -o-transform: translateY(0) rotate(-45deg);
                    -ms-transform: translateY(0) rotate(-45deg);
                    transform: translateY(0) rotate(-45deg);
                  }
                }
                @-o-keyframes bounce {
                  0% {
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                    -webkit-transform: translateY(-2000px) rotate(-45deg);
                    -moz-transform: translateY(-2000px) rotate(-45deg);
                    -o-transform: translateY(-2000px) rotate(-45deg);
                    -ms-transform: translateY(-2000px) rotate(-45deg);
                    transform: translateY(-2000px) rotate(-45deg);
                  }
                  60% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                    -webkit-transform: translateY(30px) rotate(-45deg);
                    -moz-transform: translateY(30px) rotate(-45deg);
                    -o-transform: translateY(30px) rotate(-45deg);
                    -ms-transform: translateY(30px) rotate(-45deg);
                    transform: translateY(30px) rotate(-45deg);
                  }
                  80% {
                    -webkit-transform: translateY(-10px) rotate(-45deg);
                    -moz-transform: translateY(-10px) rotate(-45deg);
                    -o-transform: translateY(-10px) rotate(-45deg);
                    -ms-transform: translateY(-10px) rotate(-45deg);
                    transform: translateY(-10px) rotate(-45deg);
                  }
                  100% {
                    -webkit-transform: translateY(0) rotate(-45deg);
                    -moz-transform: translateY(0) rotate(-45deg);
                    -o-transform: translateY(0) rotate(-45deg);
                    -ms-transform: translateY(0) rotate(-45deg);
                    transform: translateY(0) rotate(-45deg);
                  }
                }
                @keyframes bounce {
                  0% {
                    opacity: 0;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                    filter: alpha(opacity=0);
                    -webkit-transform: translateY(-2000px) rotate(-45deg);
                    -moz-transform: translateY(-2000px) rotate(-45deg);
                    -o-transform: translateY(-2000px) rotate(-45deg);
                    -ms-transform: translateY(-2000px) rotate(-45deg);
                    transform: translateY(-2000px) rotate(-45deg);
                  }
                  60% {
                    opacity: 1;
                    -ms-filter: none;
                    filter: none;
                    -webkit-transform: translateY(30px) rotate(-45deg);
                    -moz-transform: translateY(30px) rotate(-45deg);
                    -o-transform: translateY(30px) rotate(-45deg);
                    -ms-transform: translateY(30px) rotate(-45deg);
                    transform: translateY(30px) rotate(-45deg);
                  }
                  80% {
                    -webkit-transform: translateY(-10px) rotate(-45deg);
                    -moz-transform: translateY(-10px) rotate(-45deg);
                    -o-transform: translateY(-10px) rotate(-45deg);
                    -ms-transform: translateY(-10px) rotate(-45deg);
                    transform: translateY(-10px) rotate(-45deg);
                  }
                  100% {
                    -webkit-transform: translateY(0) rotate(-45deg);
                    -moz-transform: translateY(0) rotate(-45deg);
                    -o-transform: translateY(0) rotate(-45deg);
                    -ms-transform: translateY(0) rotate(-45deg);
                    transform: translateY(0) rotate(-45deg);
                  }
                }
              </style>
    </head>
    <body style="padding:0px;margin:0px;background-color:#ccc">
        <div id="marker">
            <div class='pin'></div>
            <div class='pulse'></div>
        </div>
        <div style="position:relative;float:left">
            <div class="main-header">
                <div class="logo-ki" style="margin-left:5px;">
                    <svg class="w-[136px] text-white transition-[width] duration-300" viewBox="0 0 138 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.67832 4.27832H0V36.5665H8.67832V4.27832Z" fill="#F26C11"></path><path d="M25.7276 28.689C20.8549 28.689 16.1952 24.9879 16.1952 20.4224C16.1952 15.8569 20.8549 12.1578 25.7276 12.1558V4.30495C25.4286 4.28856 25.1255 4.27832 24.8223 4.27832C20.5406 4.27832 16.4343 5.97921 13.4067 9.00682C10.3791 12.0344 8.67822 16.1407 8.67822 20.4224C8.67822 24.7041 10.3791 28.8104 13.4067 31.838C16.4343 34.8656 20.5406 36.5665 24.8223 36.5665C25.1255 36.5665 25.4368 36.5665 25.7276 36.5399V28.689Z" fill="#FFEB2E"></path><path d="M50.5459 4.94043H53.5814V11.9044H53.6285L56.1519 4.94043H58.8596L56.5943 10.5239L59.3266 21.572H56.4079L54.7263 14.1206H54.6792L53.5814 16.7361V21.572H50.5459V4.94043Z" fill="currentColor"></path><path d="M64.4882 4.61426C67.1755 4.61426 68.9185 6.6932 68.9185 13.266C68.9185 19.8387 67.1673 21.9095 64.48 21.9095C61.7927 21.9095 60.0518 19.8203 60.0518 13.266C60.0518 6.71164 61.803 4.61426 64.4882 4.61426ZM63.3678 15.009C63.3678 18.6057 63.7877 19.3287 64.4882 19.3287C65.1887 19.3287 65.6106 18.6057 65.6106 15.009V11.5045C65.6106 7.9078 65.1908 7.18273 64.4882 7.18273C63.7857 7.18273 63.3678 7.9078 63.3678 11.5045V15.009Z" fill="currentColor"></path><path d="M70.3276 4.94043H73.2935L76.0729 13.7232H76.12V4.94043H78.5451V21.572H76.1897L72.9432 11.505H72.8982V21.572H70.3276V4.94043Z" fill="currentColor"></path><path d="M82.4736 16.7602C82.4736 17.6942 82.4736 19.3287 83.7804 19.3287C84.786 19.3287 85.1363 18.3947 85.1363 17.7167C85.1363 14.7509 79.6245 14.073 79.6245 9.14493C79.6245 6.64609 80.9784 4.61426 83.5469 4.61426C86.2812 4.61426 87.332 6.6932 87.4016 9.68156H84.6898C84.6898 8.74757 84.6898 7.18273 83.4752 7.18273C82.7522 7.18273 82.3323 7.7972 82.3323 8.70046C82.3323 11.527 87.844 12.4856 87.844 17.3214C87.844 19.8674 86.3959 21.8992 83.6616 21.8992C80.4151 21.8992 79.7699 19.0481 79.7699 16.7602H82.4736Z" fill="currentColor"></path><path d="M90.4374 7.51095H87.8218V4.94043H96.0905V7.51095H93.4749V21.572H90.4374V7.51095Z" fill="currentColor"></path><path d="M96.8379 4.94043H100.256C103.153 4.94043 105.068 6.15503 105.068 9.65134C105.068 11.0523 104.646 12.9285 103.292 13.715L105.09 21.5638H102.022L100.588 14.4155H99.8631V21.5638H96.8379V4.94043ZM99.8734 11.9945H100.488C101.608 11.9945 102.028 10.8741 102.028 9.68207C102.028 7.88373 101.375 7.36962 100.346 7.36962H99.8795L99.8734 11.9945Z" fill="currentColor"></path><path d="M106.227 4.94043H109.269V17.8115C109.269 18.5591 109.433 19.3292 110.319 19.3292C111.161 19.3292 111.442 18.6062 111.442 17.8115V4.94043H114.01V17.4141C114.01 20.6913 112.562 21.8997 110.133 21.8997C107.798 21.8997 106.241 20.6851 106.241 17.4141L106.227 4.94043Z" fill="currentColor"></path><path d="M115.85 4.94043H118.895V11.9044H118.94L121.464 4.94043H124.174L121.906 10.5239L124.63 21.572H121.712L120.03 14.1206H119.983L118.895 16.7361V21.572H115.85V4.94043Z" fill="currentColor"></path><path d="M127.879 16.7602C127.879 17.6942 127.879 19.3287 129.186 19.3287C130.191 19.3287 130.542 18.3947 130.542 17.7167C130.542 14.7509 125.03 14.073 125.03 9.14493C125.03 6.64609 126.384 4.61426 128.952 4.61426C131.684 4.61426 132.737 6.6932 132.807 9.68156H130.097C130.097 8.74757 130.097 7.18273 128.882 7.18273C128.157 7.18273 127.738 7.7972 127.738 8.70046C127.738 11.527 133.249 12.4856 133.249 17.3214C133.249 19.8674 131.801 21.8992 129.069 21.8992C125.822 21.8992 125.177 19.0481 125.177 16.7602H127.879Z" fill="currentColor"></path><path d="M134.325 4.94043H137.36V21.572H134.325V4.94043Z" fill="currentColor"></path><path d="M50.417 24.6523H51.6787V35.7291H50.417V24.6523Z" fill="currentColor"></path><path d="M53.8047 24.6523H55.3163L58.8208 33.3204L58.7552 24.6523H59.8838V35.7291H58.6549L54.8677 26.2459L54.9353 35.7291H53.8047V24.6523Z" fill="currentColor"></path><path d="M62.0078 24.6523H63.8348C65.0986 24.6523 65.9281 24.8346 66.6593 25.4716C67.622 26.2909 68.1873 28.2122 68.1873 30.0883C68.1873 32.1488 67.5052 33.98 66.7085 34.789C65.8277 35.7189 64.5005 35.7189 64.0171 35.7189H62.0078V24.6523ZM63.2716 34.6497H64.1339C65.414 34.6497 65.9117 33.9349 66.0285 33.769C66.477 33.1054 66.858 31.9256 66.858 30.1662C66.858 28.5542 66.5917 27.7247 66.3603 27.1758C65.8277 25.9632 64.8815 25.742 64.0519 25.742H63.2716V34.6497Z" fill="currentColor"></path><path d="M76.1078 30.1154C76.1078 31.9424 75.8252 33.5052 75.1288 34.6665C74.8998 35.0673 74.5646 35.3972 74.1603 35.6198C73.7559 35.8424 73.2979 35.9491 72.8368 35.9283C70.6268 35.9283 69.5474 34.1361 69.5474 30.267C69.5474 27.5756 70.1291 24.4541 72.8245 24.4541C75.3438 24.4541 76.1078 26.9775 76.1078 30.1154ZM70.8603 30.0171C70.8603 33.7694 71.6243 34.8488 72.8184 34.8488C74.2972 34.8488 74.7785 33.1222 74.7785 30.1994C74.7785 27.1106 74.248 25.5335 72.8184 25.5335C71.4911 25.5335 70.8603 26.9611 70.8603 30.0171Z" fill="currentColor"></path><path d="M77.8511 24.6523H79.3647L82.8692 33.3204L82.8016 24.6523H83.9323V35.7291H82.7033L78.9162 26.2459L78.9817 35.7291H77.8531L77.8511 24.6523Z" fill="currentColor"></path><path d="M87.3159 29.4349H90.2572V30.5144H87.3159V34.6497H91.2198V35.7291H86.0542V24.6523H91.1195V25.7318H87.3159V29.4349Z" fill="currentColor"></path><path d="M96.365 27.4261C96.2666 26.9775 95.9676 25.5335 94.5728 25.5335C93.3438 25.5335 93.0448 26.6949 93.0448 27.3585C93.0448 28.5055 93.608 28.7922 95.3695 29.6525C96.7152 30.3161 97.6779 30.947 97.6779 32.7904C97.6779 35.0434 96.0168 35.9282 94.6711 35.9282C94.1897 35.9282 93.1103 35.8135 92.3791 35.0332C91.6827 34.2692 91.5598 33.454 91.4492 32.9399L92.629 32.6409C92.6855 33.1901 92.8924 33.7132 93.2271 34.1524C93.3952 34.3788 93.6162 34.5606 93.8708 34.682C94.1253 34.8034 94.4057 34.8607 94.6875 34.8488C95.9 34.8488 96.3998 33.9189 96.3998 32.8743C96.3998 31.6106 95.7669 31.2132 94.837 30.7647C92.8277 29.7836 91.8322 29.3022 91.8322 27.4425C91.8322 25.6318 93.01 24.4541 94.6055 24.4541C96.8586 24.4541 97.346 26.4634 97.512 27.1434L96.365 27.4261Z" fill="currentColor"></path><path d="M99.0747 24.6523H100.336V35.7291H99.0747V24.6523Z" fill="currentColor"></path><path d="M105.184 24.6525L107.677 35.7293H106.38L105.684 32.5198H103.21L102.528 35.7252H101.332L103.873 24.6484L105.184 24.6525ZM105.483 31.4956L104.471 25.9654L103.425 31.4956H105.483Z" fill="currentColor"></path><path d="M26.1598 0H25.9283C24.0226 0.041039 22.1535 0.532337 20.4739 1.43376C19.7929 1.79878 19.1374 2.20935 18.5117 2.66269C19.5333 2.48815 20.5682 2.40384 21.6045 2.41076C26.211 2.41076 30.0862 5.24345 32.3925 9.68195H24.4188L32.8493 10.6037C34.0915 13.4706 34.7147 16.5674 34.6783 19.6916L21.6967 19.7633L34.6456 20.9922C34.5042 24.2469 33.8447 27.2967 32.6875 29.8774H24.9329L32.159 30.9609C29.9859 35.0451 25.8853 38.3345 20.7381 38.1297H19.6505C21.2614 39.3 23.1902 39.9523 25.1807 39.9998C25.3589 39.9998 25.5433 39.9998 25.7399 39.9998C36.7491 40.053 46.0173 31.4177 46.2057 20.4105C46.2528 17.7479 45.7691 15.1026 44.7829 12.6289C43.7967 10.1552 42.3278 7.90264 40.4618 6.0027C38.5958 4.10275 36.3701 2.59344 33.9145 1.56283C31.459 0.53222 28.8228 0.000944148 26.1598 0ZM34.6333 9.67581C32.9947 6.66287 30.3115 3.69704 25.8853 1.7922C25.8853 1.7922 35.4792 2.61148 40.4523 9.67581H34.6333ZM25.8853 39.1293C30.2747 37.2408 32.9517 34.3077 34.5882 31.3235L39.801 32.11C34.6886 38.3714 25.8853 39.1293 25.8853 39.1293ZM41.3084 29.8774H35.3051C36.4888 27.1465 37.1075 24.2042 37.1239 21.2278L43.3587 21.8156C43.287 25.0744 42.4964 27.7248 41.3084 29.8774ZM37.1239 19.6875C37.1069 16.6529 36.4633 13.6545 35.2334 10.8802L41.5952 11.5868C42.6705 13.721 43.3485 16.3141 43.3669 19.4663V19.6548L37.1239 19.6875Z" fill="#8DBAD4"></path></svg>    
                </div>
                <div class="logo-kupu" style="margin-top:3px;margin-right:2px;">
                    <img src="https://konstruksiindo.id/img/kupu.png" width="100%"  />
                </div>
                <div class="logo-royalindo" style="margin-top:3px;margin-right:2px;">
                    <img src="https://konstruksiindo.id/img/royalindo.png" width="100%" />
                </div>
                <div class="logo-trumecs" style="background:#000;margin-top:8px;margin-right:2px;padding:2px;">
                    <img src="https://www.trumecs.com/public/image/logofooternew.png" width="100%" />
                </div>
                <div class="search-card" style="margin-top:10px;">
                    <input type="text" id="search-input" class="form-input" placeholder="Nama exhibitor, nomor booth" onkeyup="searchAuto(this)" />
                    <a href="#" id="search-close">X</a>
                </div>
                <div id="search-result"></div>
            </div>
            <div id="map-container" style="overflow:scroll;">
            <svg id="map" style="background:#e7ecee;height:1200px;width:1200px;">
                <defs>
                    <linearGradient id="MyGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#F60" />
                    </linearGradient>
                    <linearGradient id="toiletGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#0053c9" />
                    </linearGradient>
                    <linearGradient id="eoGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#0095c9" />
                    </linearGradient>
                    <linearGradient id="royalindoGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#008269" />
                    </linearGradient>
                    <linearGradient id="workshopGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#2a2c66" />
                    </linearGradient>
                    <linearGradient id="lunchGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#00c9ab" />
                    </linearGradient>
                    <linearGradient id="cafeGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#00c9ab" />
                    </linearGradient>
                    <linearGradient id="acpeGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#71c900" />
                    </linearGradient>
                    <linearGradient id="foyerGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#787c78" />
                    </linearGradient>
                    <linearGradient id="foodGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#00c9ab" />
                    </linearGradient>
                    <linearGradient id="technicalGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#144484" />
                    </linearGradient>
                    <linearGradient id="loungeGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#c90089" />
                    </linearGradient>
                    <linearGradient id="tkkGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#96b1b1" />
                    </linearGradient>
                    <linearGradient id="lombaGradient" gradientTransform="rotate(45)">
                      <stop offset="100%" stop-color="#b08005" />
                    </linearGradient>
                </defs>
            </svg>
            </div>
            <div class="info-container">
                
            	
                
                
                <div class="info-card">
                    <!--<div class="home">
                        <div class="info-body">
                        Selamat datang di Konstruksi Indonesia 2023. Silahkan masukkan nama exhibitor atau nomor booth
                        </div>
                    </div>
                    <div class="search-result">
                        <div class="header">
                            <button type="button" onCLick="removeParent(this)" class="back-button">&laquo; Kembali</button>
                        </div>
                        <div class="info-body">
                            Ini search result
                        </div>
                    </div>
                    <div class="event-detail">
                        <div class="header">
                            <button type="button" onCLick="removeParent(this)" class="back-button">&laquo; Kembali</button>
                        </div>
                        <div class="info-body">
                            Ini event detail
                        </div>
                    </div>-->
                    <div id="booth-detail" class="booth-detail">
                        <div class="header">
                            <button type="button" onCLick="removeParent(this)" class="back-button">&laquo; Kembali</button>
                        </div>
                        <div class="info-body">
                            <h2 style="margin:0px;font-size:24px;" id="booth-name">Exhibitor Name</h2>
                            <div id="booth-number">0</div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div id="demo" hidden></div>
    </body>
    <?php
    if (isset($js_cdn)) {
        foreach ($js_cdn as $item) {
            echo $item;
        }
    }
    ?>
    <?php

    if (isset($js)) {
        $minijs = $this->minifile->create($js, 'js');
        echo "<script src=\"" . base_url("asset/core/js/" . $minijs) . "\"></script>";
    }
    ?>
</html>