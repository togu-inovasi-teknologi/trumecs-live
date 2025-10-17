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

    <nav class="navbar navbar-fixed-top" role="navigation" style="background:#000;">
        <div class="row">
            <div id="logo" class="d-flex-ai-center">
                <div class="col-xs-1">
                    <span class="btn p-x-1 p-y-0 f20 navbar-toggle offcanvas-toggle offcanvas-toggle-close" data-toggle="offcanvas" data-target="#js-mobile-offcanvas"><i class="fa fa-bars" style="color:#fff;"></i></span>
                </div>
                <div class="col-xs-8">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>public/image/logofooternew.png" width="150px">
                    </a>
                </div>
                <div class="col-xs-3">
                    <a style="color:#fff; margin-right:10px;" class="f20" onclick="show()"><i class="fa fa-search "></i></a>
                    <a class="f20 m-r-1" style="color:#fff;"><i class="fa fa-bell-o"></i></a>
                </div>
            </div>
            <div id="searchfrom" class="d-none">
                <div class="col-xs-10" style="padding:0px 5px" id="searchfrom">
                    <div class="input-group input-group-sm inputsearch">
                        <div class="input-group-btn">
                            <button class="btn p-a-0">
                                <select class="text-center select-search-category">
                                    <?php if ($this->uri->segment(1) == "jasa") { ?>
                                        <option value="barang">Product</option>
                                        <option value="jasa" selected>Jasa</option>
                                        <option value="rental">Rental</option>
                                    <?php } else if ($this->uri->segment(1) == "rental") { ?>
                                        <option value="barang">Product</option>
                                        <option value="jasa">Jasa</option>
                                        <option value="rental" selected>Rental</option>
                                    <?php } else { ?>
                                        <option value="barang" selected>Product</option>
                                        <option value="jasa">Jasa</option>
                                        <option value="rental">Rental</option>
                                    <?php }  ?>
                                </select>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('placeholder_pencarian', FALSE) ?>" value="<?php echo $this->input->get("nama"); ?>" style="border-radius:0;">
                    </div>
                </div>
                <div class="col-xs-2 text-center p-x-0">
                    <a style="color:#fff; margin-right:10px;" class="f20" onclick="show()"><i class="fa fa-search "></i></a>
                </div>
            </div>
        </div>
    </nav>
<?php } ?>

<!-- Footer Tab -->

<nav class="navbar navbar-fixed-bottom p-a-0" role="navigation" style="border-top:1px solid #000;background:#000">
    <?php if ($this->uri->segment(1) == 'product' && $this->uri->segment(2) != 'buy') : foreach ($data_product as $key) {
        } ?>
        <div class="row" style="padding:10px 10px;">
            <div class="col-xs-2">
                <a class="btn btnnew" href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>">
                    <i class="fa fa-commenting fbold"></i>
                </a>
            </div>
            <div class="col-xs-10">
                <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan " . $key["tittle"] . ". Apakah barang ini tersedia?") ?>" class="btn btnnewgreen btn-block">
                    <span class="fbold">Beli Sekarang</span>
                </a>
            </div>
            <!-- <form id="add-product" action="<?php echo base_url() ?>cart/addproduct" method="post" >  
            <input type="hidden" class="" value="<?php echo $key["moq"] ?>" name="value">
            <input type="hidden" class="" value="<?php echo $key["id"] ?>" name="idproduct">
            <input type="hidden" class="" value="json" name="source_type">
        </form> -->
            <!-- <a class="col-xs-2 btn" onclick="window.Tawk_API.maximize();" style="background-color:#fa8420;color:#fff;width:15%;margin:7px 3px;padding:10px">
            <i class="fa fa-commenting fbold fa-2x"></i>
        </a> -->

            <!-- <button type="submit" form="add-product"class="col-xs-5 btn btn-default" style="color:#fa8420;background-color:#fff;border:1px solid #fa8420;width:40%;margin:7px 3px;padding:11px">
            <i class="fa fa-cart-plus fa-2x" style="vertical-align:middle;margin-right:5px"></i> <span class="f14 fbold"> Tambahkan</span>
        </button> -->

            <!-- <a href="<?php echo site_url('product/buy/' . $key['id'] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", $key["tittle"])); ?>" class="col-xs-5 btn btn-default" style="color:#666;background-color:#fff;border:1px solid #666;width:40%;margin:7px 3px;padding:11px">
                <i class="fa fa-envelope fa-2x" style="vertical-align:middle;margin-right:5px"></i> <span class="f14 fbold">Penawaran</span>
        </a> -->

            <!-- <button class="col-xs-4 btn btn-default" style="background-color:#fff">
            <i class="fa fa-whatsapp"></i></br>Whatsapp
        </button> -->
        </div>
    <?php else : ?>
        <!--<div class="row p-x-1 d-flex-sb align-items-center text-center" style="padding-top:4px;">
            <div class="col-lg-2--4 p-x-0">
                <a href="<?php echo site_url() ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-home f22"></i></br>
                    <h6 class="f10">Beranda</h6>
                </a>
            </div>
            <div class="col-lg-2--4 p-x-0">
                <a href="<?php echo site_url('cart'); ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "cart" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-shopping-cart f22"></i></br>
                    <h6 class="f10">Keranjang</h6>
                </a>
            </div>
            <div class="col-lg-2--4 p-x-0">
                <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya ingin mengetahui tentang produk yang dijual") ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "chat" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-commenting f22"></i></br>
                    <h6 class="f10">Pesan</h6>
                </a>
            </div>
            <div class="col-lg-2--4 p-x-0">
                <a href="<?php echo site_url('promo'); ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "promo" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-tags f22"></i></br>
                    <h6 class="f10">Promo</h6>
                </a>
            </div>
            <div class="col-lg-2--4 p-x-0">
                <a href="<?php echo site_url('member'); ?>" style="background-color:#000;line-height:1; color:<?php echo $this->uri->segment(1) == "member" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-user f22"></i></br>
                    <h6 class="f10">Akun</h6>
                </a>
            </div>
        </div>-->
        <!-- <div class="row p-x-1" style="padding-top: 5px;">
            <div class="col-lg-2--4 text-center p-x-0">
                <a href="<?php echo site_url() ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-home f22"></i></br>
                    <h6 class="f10">Beranda</h6>
                </a>
            </div>
            <div class="col-lg-2--4 text-center p-x-0">
                <a href="<?php echo site_url('cart'); ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "cart" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-shopping-cart f22"></i></br>
                    <h6 class="f10">Keranjang</h6>
                </a>
            </div>
            <div class="col-lg-2--4 text-center p-x-0">
                <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya ingin mengetahui tentang produk yang dijual") ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "chat" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-commenting f22"></i></br>
                    <h6 class="f10">Pesan</h6>
                </a>
            </div>
            <div class="col-lg-2--4 text-center p-x-0">
                <a href="<?php echo site_url('promo'); ?>" style="background-color:#000;line-height:1;color:<?php echo $this->uri->segment(1) == "promo" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-tags f22"></i></br>
                    <h6 class="f10">Promo</h6>
                </a>
            </div>
            <div class="col-lg-2--4 text-center p-x-0">
                <a href="<?php echo site_url('member'); ?>" style="background-color:#000;line-height:1; color:<?php echo $this->uri->segment(1) == "member" ? '#fa8420' : '#fff' ?>">
                    <i class="fa fa-user f22"></i></br>
                    <h6 class="f10">Akun</h6>
                </a>
            </div>
        </div> -->
    <?php endif; ?>
</nav>

<!-- Nav Drawer -->

<div class="navmobile col-xs-12 col-sm-12 p-y-0 navbar navbar-offcanvas navbar-offcanvas-touch  hidden-md-up " role="navigation" id="js-mobile-offcanvas" style="border-radius:0px;">
    <div class="row text-center">
        <div class="col-xs-12" style="margin-top:6px;margin-bottom:7px;">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>public/image/logofooternew.png" width="150px" style="margin-top:5px">
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
            <li class="list-group-item" data-toggle="collapse" data-target="#bahasa" aria-expanded="false" aria-controls="bahasa"><?php echo $this->lang->line('bahasa', FALSE); ?>: <img style="width:20px;" src="<?php echo base_url() ?>public/icon/flag/<?php echo get_cookie('language'); ?>.png" />
                <?php echo $this->lang->line('nama_bahasa', FALSE); ?>
            </li>
            <div class="collapse" id="bahasa" style="background-color:#fff;">
                <a href="<?php echo 'http://192.168.1.30:8080' . $_SERVER['REQUEST_URI']; ?>">
                    <li class="list-group-item list-group-item-warning f14" data-toggle="collapse"> <img style="width:20px;" src="<?php echo base_url() ?>public/icon/flag/id.png" /> Indonesia
                    </li>
                </a>
                <a href="<?php echo 'http://en.trumecs-dev.com:8080' . $_SERVER['REQUEST_URI']; ?>">
                    <li class="list-group-item list-group-item-warning f14" data-toggle="collapse"><img style="width:20px;" src="<?php echo base_url() ?>public/icon/flag/en.png" /> English
                    </li>
                </a>
                <a href="<?php echo 'http://cn.trumecs-dev.com:8080' . $_SERVER['REQUEST_URI']; ?>">
                    <li class="list-group-item list-group-item-warning f14" data-toggle="collapse"><img style="width:20px;" src="<?php echo base_url() ?>public/icon/flag/cn.png" /> Chinnese</li>
                </a>
            </div>
            <li class="list-group-item" data-toggle="collapse" data-target="#collapskategori" aria-expanded="false" aria-controls="collapskategori">
                <?php echo $this->lang->line('kategori', FALSE); ?> <i class="fa fa-angle-down icondropdown"></i>
            </li>
            <div class="collapse" id="collapskategori" style="background-color:#fff;">
                <?php $this->load->model("general/General_model", 'M_general'); ?>

                <?php foreach (main_categories() as $item) : ?>
                    <?php var_dump(main_categories());
                    die; ?>
                    <li class="list-group-item dropdownlist f14" data-toggle="collapse" data-target="#collapskategori-<?php echo $item['id'] ?>" aria-expanded="false" aria-controls="collapskategori"><?php echo $item['name'] ?> <i class="fa fa-angle-down icondropdown"></i></li>
                    <div class="collapse" id="collapskategori-<?php echo $item['id'] ?>">
                        <a alt="Jual Sparepart Truk Komponen Engine" href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>">
                            <li class="list-group-item list-group-item-warning f12 fblack">Semua <?php echo $item['name'] ?>
                            </li>
                        </a>
                        <?php $this->load->model("general/General_model", 'M_general'); ?>
                        <?php $kategoris = $this->M_general->getcategori($item['id']); ?>
                        <?php foreach ($kategoris as $items) : ?>
                            <a alt="Jual Sparepart Truk Komponen Engine" href="<?php echo base_url(); ?>c/<?php echo $items['url'] ?>">
                                <li class="list-group-item list-group-item-warning f10 fblack"><?php echo $items['name'] ?>
                                </li>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="<?php echo base_url() ?>jasa">
                <li class="list-group-item">Jasa
                </li>
            </a>
            <a href="<?php echo base_url() ?>rental">
                <li class="list-group-item">Rental
                </li>
            </a>
            <a href="<?php echo base_url() ?>article">
                <li class="list-group-item"><?php echo $this->lang->line('artikel', FALSE); ?>
                </li>
            </a>
            <a href="<?php echo base_url('promo'); ?>">
                <li class="list-group-item"><?php echo $this->lang->line('promo', FALSE); ?>
                </li>
            </a>
            <!-- <a href="<?php echo base_url() ?>request">
                <li class="list-group-item"><?php echo $this->lang->line('permintaan', FALSE); ?>
                </li>
            </a> -->
            <a href="<?php echo base_url() ?>bulk">
                <li class="list-group-item">RFQ
                </li>
            </a>
            <a href="<?php echo base_url("principal/form") ?>">
                <li class="list-group-item">Principal
                </li>
            </a>
            <a href="<?php echo base_url("agent/form") ?>">
                <li class=" list-group-item">Agent
                </li>
            </a>
            <?php
            $session = $this->session->all_userdata();
            $sessionmember = isset($session["member"]) ? $session["member"] : array('id' => null);
            if ($sessionmember["id"] != null) :
                $member = $session["member"];
                $namemember = $member["name"];
                $fotomember = $member["avatar"];
            ?>
                <li class="list-group-item separator text-center"><strong>Menu Member</strong></li>
                <li class="list-group-item"><a href="<?php echo base_url() ?>member/store">Toko</a></li>
                <li class="list-group-item"><a href="<?php echo base_url() ?>member/saldo">TruCoins</a></li>
                <li class="list-group-item"><a href="<?php echo base_url() ?>member/bulk">RFQ</a></li>
                <li class="list-group-item"><a href="<?php echo base_url() ?>member/history">Riwayat Pesanan</a></li>
                <li class="list-group-item"><a href="<?php echo base_url() ?>member/confirmation_list">Konfirmasi
                        Pesanan</a></li>
                <li class="list-group-item"><a href="<?php echo base_url() ?>member/testimonialform">Testimonial</a></li>
                <li class="list-group-item">
                    <div class="row">
                        <a href="<?php echo base_url() ?>member/logout" class="d-flex-ai-center">
                            <div class="col-xs-10 d-flex-ai-center gap-2">
                                <img src="<?php echo base_url() ?>public/image/member/<?php echo ($fotomember == null) ? "profile-default.png" : $fotomember ?>" alt="Avatar" class="avanav">
                                <p class="fbold f12 text-left p-a-0 m-a-0"><?php echo $namemember ?></p>
                            </div>
                            <div class="col-xs-2">
                                <i class="fa fa-sign-out fred"></i>
                            </div>
                        </a>
                    </div>
                </li>
            <?php else : ?>
                <li class="list-group-item"><a class="btn btnnew btn-block" href="<?php echo base_url('member/login') ?>"><?php echo $this->lang->line('daftar', FALSE); ?> /
                        <?php echo $this->lang->line('masuk', FALSE); ?></a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="row p-t-1 p-b-1" style="color:#fff;">
        <div class="col-xs-12 text-center">
            <small><strong><?php echo $this->lang->line('hubungi_kami', FALSE); ?>:</strong></small><br />
            <div class="p-y-1">
                <span class="fa fa-phone" style="vertical-align:middle"></span> <small><a class="fwhite" href="tel:<?php echo platform_contact("phone") ?>" target="_blank"><?php echo platform_contact("phone") ?></a></small>
            </div>
            <span class="fa fa-envelope" style="vertical-align:middle"></span> <small><a class="fwhite" href="mailto:<?php echo platform_contact("email") ?>" target="_blank"><?php echo platform_contact("email") ?></a></small>
        </div>
    </div>
</div>

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
    nav .inputsearch span,
    nav .inputsearch input {
        border: 1px solid #ddd;
    }

    .select-search-category {
        width: 80px;
        height: 30px;
        background-color: #fa8420;
        color: #fff;
        border: none;
    }

    .icondropdown {
        float: right;
        margin-right: 5px;
        color: #666;
    }

    .dropdownlist {
        margin-left: 10px;
    }
</style>