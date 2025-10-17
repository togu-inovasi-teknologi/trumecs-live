<?php
function ctgprnnavmobile($categori, $parent)
{
    $array = array();
    if ($parent != "") {
        foreach ($categori as $key) {
            if ($key["parent"] == $parent) {
                $datakey = array(
                    'id' => $key["id"],
                    'name' => $key["name"]
                );
                array_push($array, $datakey);
            }
        }
    }
    return $array;
}
?>

<!-- Header untuk Login Page -->

<?php if ($this->uri->segment(1) == 'member' && $this->uri->segment(2) == 'login') { ?>
    <nav class="navbar navbar-fixed-top " role="navigation" style="background:#000;">
        <div class="row">
            <div class="col-xs-2 p-x-0">
                <a class="btn" href="<?php echo base_url() ?>"><i class=" fa fa-chevron-left" style="color:#fff;"></i></a>
            </div>
            <div class="col-xs-5 text-center p-x-1 marginnav f16 fbold">
                <a href="<?php echo base_url("member/login") ?>" class="colornav">
                    <u><?php echo $this->lang->line("masuk", FALSE); ?></u>
                </a>
            </div>
            <div class="col-xs-5 text-center p-x-1 marginnavtop f16 fbold">
                <a href="<?php echo base_url("member/signup") ?>" style="color:#fff">
                    <?php echo $this->lang->line("daftar", FALSE); ?>
                </a>
            </div>
        </div>
    </nav>
<?php } else if ($this->uri->segment(1) == 'member' && $this->uri->segment(2) == 'signup') { ?>
    <nav class="navbar navbar-fixed-top " role="navigation" style="background:#000;">
        <div class="row">
            <div class="col-xs-2 p-x-0">
                <a class="btn" href="<?php echo base_url() ?>"><i class=" fa fa-chevron-left" style="color:#fff;"></i></a>
            </div>
            <div class="col-xs-5 text-center p-x-1 marginnav f16 fbold">
                <a href="<?php echo base_url("member/login") ?>" style="color:#fff">
                    <?php echo $this->lang->line("masuk", FALSE); ?>
                </a>
            </div>
            <div class="col-xs-5 text-center p-x-1 marginnavtop f16 fbold">
                <a href="<?php echo base_url("member/signup") ?>" class="colornav">
                    <u><?php echo $this->lang->line("daftar", FALSE); ?></u>
                </a>
            </div>
        </div>
    </nav>
<?php } else { ?>

    <!-- Header untuk logo dan search serta notif -->

    <nav class="navbar navbar-fixed-top " role="navigation" style="background:#000;">
        <div class="row">
            <div class="col-xs-1 p-x-0">
                <span class="btn navbar-toggle offcanvas-toggle offcanvas-toggle-close" data-toggle="offcanvas" data-target="#js-mobile-offcanvas"><i class="fa fa-bars" style="color:#fff;"></i></span>
            </div>
            <div class="col-xs-8 p-x-1">
                <a href="<?php echo base_url() ?>">
                    <img id="logo" src="<?php echo base_url() ?>public/image/logofooternew.png" width="130px" style="margin-top:8px">
                </a>
                <div class="inputsearch col-xs-12 " style="padding:0px 5px">
                    <input id="searchfrom" type="text" class="form-control" placeholder="cari sparepart" style="border:1px solid #eee; display:none;">
                    <input type="hidden" name="quality" value="<?php echo $this->uri->segment(2) == 'used' ? "3" : $this->input->get("quality"); ?>">
                </div>
            </div>
            <div class="col-xs-3 text-right p-x-0">
                <a style="color:#fff; margin-right:10px;" class="f22" onclick="show()"><i class="fa fa-search "></i></a>
                <a class="f22 m-r-1" style="color:#fff;"><i class="fa fa-bell-o"></i></a>
            </div>
        </div>
    </nav>
<?php } ?>

<!-- Footer Tab -->

<nav class="navbar navbar-fixed-bottom p-a-0" role="navigation" style="border-top:1px solid #000;background:#000">
    <div class="row m-a-0">
        <?php if ($this->uri->segment(1) == 'product' && $this->uri->segment(2) != 'buy') : foreach ($data_product as $key) {
            } ?>
            <div class="col-xs-12" style="position:absolute;top:-70px;">
                <div class="card col-xs-12 p-y-1">
                    <?php 
                        if($this->session->flashdata('message_feedback')){
                            echo "<span class='fa fa-check-circle' style='color:#0cbd2b'></span> <small>Terimakasih atas partisipasi anda :)</small>";
                        } else {
                    ?>
                    <small>Hai! Belum tertarik untuk membeli produk ini?</small>
                    <a href="#" data-toggle="modal" data-target="#polling" class="survey-button"><small>Bagaimana kami dapat membantumu?</small></a>
                    <?php } ?>
                </div>
            </div>
            <!-- <form id="add-product" action="<?php echo base_url() ?>cart/addproduct" method="post" >  
            <input type="hidden" class="" value="<?php echo $key["moq"] ?>" name="value">
            <input type="hidden" class="" value="<?php echo $key["id"] ?>" name="idproduct">
            <input type="hidden" class="" value="json" name="source_type">
        </form> -->
            <!-- <a class="col-xs-2 btn" onclick="window.Tawk_API.maximize();" style="background-color:#ff9900;color:#fff;width:15%;margin:7px 3px;padding:10px">
            <i class="fa fa-commenting fbold fa-2x"></i>
        </a> -->
            <a class="col-xs-2 btn wa-button-product" href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" style="background-color:#ff9900;color:#fff;width:15%;margin:7px 3px;padding:10px">
                <i class="fa fa-commenting fbold fa-2x"></i>
            </a>
            <!-- <button type="submit" form="add-product"class="col-xs-5 btn btn-default" style="color:#ff9900;background-color:#fff;border:1px solid #ff9900;width:40%;margin:7px 3px;padding:11px">
            <i class="fa fa-cart-plus fa-2x" style="vertical-align:middle;margin-right:5px"></i> <span class="f14 fbold"> Tambahkan</span>
        </button> -->
            <a class="col-xs-5 btn btn-default cart-button-product" data-toggle="modal" data-target="#add-to-cart" style="color:#ff9900;background-color:#fff;border:1px solid #ff9900;width:40%;margin:7px 3px;padding:11px">
                <i class="fa fa-cart-plus fa-2x" style="vertical-align:middle;margin-right:5px"></i> <span class="f14 fbold"> Tambahkan</span>
            </a>
            <!-- <a href="<?php echo site_url('product/buy/' . $key['id'] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", $key["tittle"])); ?>" class="col-xs-5 btn btn-default" style="color:#666;background-color:#fff;border:1px solid #666;width:40%;margin:7px 3px;padding:11px">
                <i class="fa fa-envelope fa-2x" style="vertical-align:middle;margin-right:5px"></i> <span class="f14 fbold">Penawaran</span>
        </a> -->
            <a href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" class="col-xs-5 btn btn-default beli-button-product" style="color:#666;background-color:#fff;border:1px solid #666;width:40%;margin:7px 3px;padding:11px">
                <i class="fa fa-envelope fa-2x" style="vertical-align:middle;margin-right:5px"></i> <span class="f14 fbold">Beli Sekarang</span>
            </a>
            <!-- <button class="col-xs-4 btn btn-default" style="background-color:#fff">
            <i class="fa fa-whatsapp"></i></br>Whatsapp
        </button> -->

        <?php else : ?>
            <a href="<?php echo site_url() ?>" class="col-xs-2 btn btn-outline-success" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "" ? '#ff9900' : '#fff' ?>">
                <i class="fa fa-home f22" style=" margin-left: 12px;"></i></br><span class="f10">Beranda</span>
            </a>
            <a href="<?php echo site_url('cart'); ?>" class="col-xs-3 btn btn-default" style="padding-left: 25px;background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "cart" ? '#ff9900' : '#fff' ?>">
                <i class="fa fa-shopping-cart f22"></i></br><span class="f10">Keranjang</span>
            </a>
            <a href="https://wa.me/6285176912338?text=<?php echo urlencode("Hi Trumecs, saya ingin mengetahui tentang produk yang dijual") ?>" class="col-xs-2 btn btn-default" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "chat" ? '#ff9900' : '#fff' ?>">
                <i class="fa fa-commenting f22" style=" margin-left: 5px;"></i></br><span class="f10">Pesan</span>
            </a>
            <a href="<?php echo site_url('promo'); ?>" class="col-xs-3 btn btn-default" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "promo" ? '#ff9900' : '#fff' ?>">
                <i class="fa fa-tags f22"></i></br><span class="f10">Promo</span>
            </a>
            <a href="<?php echo site_url('member'); ?>" class="col-xs-2 btn btn-default" style="background-color:#000;line-height:1; margin-left: -10px; color:<?php echo $this->uri->segment(1) == "member" ? '#ff9900' : '#fff' ?>">
                <i class="fa fa-user f22"></i></br><span class="f10">Akun</span>
            </a>
        <?php endif; ?>
    </div>
</nav>

<!-- Nav Drawer -->

<div class="navmobile col-xs-12 col-sm-12 p-y-0 navbar navbar-offcanvas navbar-offcanvas-touch  hidden-md-up " role="navigation" id="js-mobile-offcanvas" style="border-radius:0px;">
    <div class="row text-center">
        <div class="col-xs-12 p-y-1">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>public/image/logofooternew.png" width="180px" style="margin-top:5px">
            </a>
        </div>
    </div>
    <div class="row">
        <ul class="list-group">
            <!-- <li class="list-group-item" data-toggle="collapse" data-target="#collapslanguage" aria-expanded="false" aria-controls="collapskategori" style="color:#333"><?php echo $this->lang->line('bahasa', FALSE); ?>: <?php echo $this->lang->line('nama_bahasa', FALSE); ?> <i class="fa fa-angle-down"></i></li> -->
            <!-- <div class="collapse" id="collapslanguage">
                <li class="list-group-item list-group-item-warning"><a href="<?php echo 'http://www.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'id' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> Bahasa Indonesia</a></li>
                <li class="list-group-item list-group-item-warning"><a href="<?php echo 'http://en.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'en' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> English</a></li>
                <li class="list-group-item list-group-item-warning"><a href="<?php echo 'http://cn.togu-dev.com:8888' . $_SERVER['REQUEST_URI']; ?>"><span class="fa fa-<?php echo get_cookie('language', TRUE) == 'cn' ? 'check' : 'none' ?>" style="vertical-align:middle;margin-right:10px;min-width:16px"></span> Chinese</a></li>
            </div> -->
            <li class="list-group-item"><a href="<?php echo base_url('home/homeproduct'); ?>">Produk</a></li>
            <li class="list-group-item" data-toggle="collapse" data-target="#collapskategori" aria-expanded="false" aria-controls="collapskategori" style="color:#333"><?php echo $this->lang->line('kategori', FALSE); ?> <i class="fa fa-chevron-down icondropdown"></i></li>
            <div class="collapse" id="collapskategori" style="background-color:#fff;">
                <?php $this->load->model("general/General_model", 'M_general'); ?>
                <?php $kategori = $this->M_general->getcategori("0"); ?>
                <?php foreach ($kategori as $item) : ?>
                    <li class="list-group-item dropdownlist f14" data-toggle="collapse" data-target="#collapskategori-<?php echo $item['id'] ?>" aria-expanded="false" aria-controls="collapskategori" style="color:#333"><?php echo $item['name'] ?> <i class="fa fa-chevron-down icondropdown"></i></li>
                    <div class="collapse" id="collapskategori-<?php echo $item['id'] ?>">
                        <li class="list-group-item list-group-item-warning f12"><a alt="Jual Sparepart Truk Komponen Engine" href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>" class="list-kategori-drawer dropdownlist">Semua <?php echo $item['name'] ?></a></li>
                        <?php $this->load->model("general/General_model", 'M_general'); ?>
                        <?php $kategoris = $this->M_general->getcategori($item['id']); ?>
                        <?php foreach ($kategoris as $items) : ?>
                            <li class="list-group-item list-group-item-warning f10"><a alt="Jual Sparepart Truk Komponen Engine" href="<?php echo base_url(); ?>c/<?php echo $items['url'] ?>" class="list-kategori-drawer dropdownlist"><?php echo $items['name'] ?></a></li>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <li class="list-group-item"><a href="<?php echo base_url('promo'); ?>"><?php echo $this->lang->line('promo', FALSE); ?> </a></li>
            <li class="list-group-item"><a href="<?php echo base_url() ?>page"><?php echo $this->lang->line('tentang_kami', FALSE); ?></a></li>
            <li class="list-group-item"><a href="<?php echo base_url() ?>article"><?php echo $this->lang->line('artikel', FALSE); ?></a></li>
            <li class="list-group-item"><a href="<?php echo base_url() ?>partnership"><?php echo $this->lang->line('partnership', FALSE); ?></a></li>
            <li class="list-group-item"><a href="<?php echo base_url() ?>lelang"><?php echo $this->lang->line('info_lelang', FALSE); ?></a></li>
            <?php
            $session = $this->session->all_userdata();
            $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
            if ($sessionmember["id"] != null) :
                $member = $session["member"];
                $namemember = $member["name"];
                $emailmember = $member["email"];
            ?>
                <li class="list-group-item separator text-center"><a><small><strong>Menu Member</strong></small></a></li>
                <!--<li class="list-group-item list-group-item-info text-center"><a href="<?php echo base_url() ?>member/meeting">Meeting</a></li>
                <li class="list-group-item list-group-item-info text-center"><a href="<?php echo base_url() ?>member/penawaran">Penawaran</a></li>
                <li class="list-group-item list-group-item-info text-center"><a href="<?php echo base_url() ?>member/tender">Undangan Tender</a></li>-->
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="<?php echo base_url() ?>member/setting"><img src=" <?php echo base_url() ?>public/image/drum-pertamina.png" alt="Avatar" class="avanav"></a>
                        </div>
                        <div class="col-xs-8" style="line-height: 0px;">
                            <a style="color: black;" href="<?php echo base_url('member/logout') ?>">
                                <h6 class="font-weight-bold f12"><?php echo $namemember ?></h6><br>
                                <span class="f12" style="color: grey;"><?php echo $emailmember ?></span>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <a style="color:#ff3300;" href="<?php echo base_url('member/logout') ?>"><i class="fa fa-sign-out" style="width: 30px; height: 30px; margin-top:8px;"></i></a>
                        </div>
                    </div>
                </li>
            <?php else : ?>
                <li class="list-group-item"><a class="btn btnnew btn-block" href="<?php echo base_url('member/login') ?>"><?php echo $this->lang->line('masuk', FALSE); ?> / <?php echo $this->lang->line('daftar', FALSE); ?></a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="row p-t-1 p-b-1" style="color:#fff;">
        <div class="col-xs-12 text-center">
            <small><strong><?php echo $this->lang->line('hubungi_kami', FALSE); ?>:</strong></small><br />
            <div class="p-y-1">
                <span class="fa fa-phone" style="vertical-align:middle"></span> <small><a style="border-bottom:1px dashed #fff;color:#fff;" href="tel:<?php echo platform_contact("phone") ?>"><?php echo platform_contact("phone") ?></a></small>
            </div>
            <span class="fa fa-envelope" style="vertical-align:middle"></span> <small><a style="border-bottom:1px dashed #fff;color:#fff;" href="mailto:<?php echo platform_contact("email") ?>"><?php echo platform_contact("email") ?></a></small>

        </div>
    </div>
</div>
<?php if ($this->uri->segment(1) == 'product' && $this->uri->segment(2) != 'buy') : ?>
<div class="modal" id="polling" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin:5% auto">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visitor Feedback
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('product/prospek/feedback'); ?>" method="POST">
                <div class="form-options">
                    <p>Bolehkah kami tahu mengapa anda belum tertarik untuk membeli produk ini?</p>
                    <?php foreach($options->result() as $key=>$item): ?>
                    <div class="form-group">
                    <label class="form-label">
                        <input type="checkbox" value="<?php echo $item->id ?>" name="answer[]" /> <?php echo $item->options ?>
                    </label>
                    </div>
                    <?php endforeach; ?>
                    <div class="form-group text-right">
                        <button class="btn btn-orange" onClick="document.getElementsByClassName('form-options')[0].setAttribute('style','display:none');document.getElementsByClassName('form-send')[0].setAttribute('style','display:block');" type="button">Selanjutnya</button>
                    </div>
                </div>
                <div class="form-send" style="display:none">
                    <div class="form-group">
                        <label class="form-label">Produk/diskon apa yang anda inginkan untuk kedepannya?</label>
                        <textarea class="form-control" name="feedback" placeholder="Ban crane Tadano 18PR" ></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat email anda</label>
                        <input class="form-control" type="email" name="email" value="" placeholder="agus@gmail.com" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apakah anda bersedia untuk kami hubungi?</label>
                        <input class="form-control" type="text" name="phone" value="" placeholder="081288889999" />
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-white pull-left" onClick="document.getElementsByClassName('form-options')[0].setAttribute('style','display:block');document.getElementsByClassName('form-send')[0].setAttribute('style','display:none');" type="button">Kembali</button>
                        <button class="btn btn-orange" type="submit">Kirim</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<script>
    function show() {
        var logo = document.getElementById("logo");
        var input = document.getElementById("searchfrom");
        if (input.style.display === "none") {
            input.style.display = "block";
            logo.style.display = "none";
        } else {
            logo.style.display = "block";
            input.style.display = "none";
        }
    }
</script>
<style>
    .icondropdown {
        float: right;
        margin-right: 5px;
        color: #666;
    }

    .dropdownlist {
        margin-left: 10px;
    }


    .avanav {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        text-shadow: #000;
    }
</style>