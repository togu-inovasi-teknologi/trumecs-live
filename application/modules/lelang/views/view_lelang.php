<?php foreach ($data_lelang as $key ) {}
$lfp=strlen($key["img"]);
$ext=substr($key["img"], $lfp-4);
is_file("public/image/lelang/".$key["img"])!=1 ? $key["img"]="--" : $key["img"] ;
$img_promo= '<img class="labelimg hidden-sm-down" src="'.base_url().'/public/image/promo_specialoffer.png" width="120">';
?>
<style>
.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: #000;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}

</style>
<div id="page_detail">
	<?php if ($this->agent->is_mobile()): ?>
		<div class="space"><div class="clearfix"></div></div>
	<?php endif ?>
	<div class="row">
		<div class="col-lg-12 ">
			<?php if ($this->agent->is_mobile()): ?>
			<?php else: ?>
		    <ol class="breadcrumb " itemscope itemtype="http://schema.org/BreadcrumbList">
		    	<li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
		    	<li><a class="forange" href="<?php echo base_url("lelang/all") ?>">Lelang</a></li>
		    	<?php $str_after="" ?>
				<?php foreach ($breadcrumb as $keybreadcrumb): ?>
					<?php if (!empty($keybreadcrumb)): ?>
						<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
							<a itemprop="item" class="forange" href="<?php echo base_url()."lelang/all?komponen=".$key['category']."&nama="; ?>">
								<span itemprop="name"><?php echo $keybreadcrumb ?></span>
							</a>
						</li>
						<?php $str_after.=preg_replace("/[^a-zA-Z0-9]/", "-", $keybreadcrumb)."/" ?>
					<?php endif ?>
				<?php endforeach ?>
		    	<li><span ><?php echo ucwords(strtolower($key["judul"])) ?></span></li>
		    </ol>
		    <?php endif ?>
            <div class="clearfix"></div>
			<div class="product  col-lg-12" style="padding:0px;">
                <div class="col-md-9">
                    <div class="row">
                    <div class="col-md-5 text-center imgproduct p-l-0" style="position: sticky;position: -webkit-sticky;top: 80px;">
                        <div class="row">
                            <div class="col-lg-12 <?php echo ($this->agent->is_mobile()) ? "p-x-0" : "" ; ?> text-center">
                                <img itemprop="image" class="img-detail-lg tochangebyclick" 
                                data-zoom-image="<?php echo base_url() ?>public/image/lelang/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" 
                                src="<?php echo base_url() ?>public/image/lelang/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" alt="Jual Sparepart Truk <?php echo ucwords(strtolower($key["judul"])) ?>">
                            </div>
                        </div>
                        <div class="nopt row m-a-1">
                            <div class="col-lg-12 <?php echo ($this->agent->is_mobile()) ? "p-x-0" : "" ; ?>">
                                <div class="text-center img-galery">
                                    <div class=" img-border">
                                        <img class="img-fluid changeimagegalery" style="margin:0 auto;height:50px;" zoom-src-no-crop="<?php echo base_url() ?>public/image/lelang/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" alt="Jual Sparepart Truk <?php echo ucwords(strtolower($key["judul"]))  ?>">
                                    </div>
                                </div>
                                <?php if (count($galeryimg)>0): ?>
                                <?php foreach ($galeryimg as $galeryimg ): ?>
                                    <?php 
                                    $glfp=strlen($galeryimg["img"]);
                                    $gext=substr($galeryimg["img"], $glfp-4);
                                    is_file("public/image/galery/".$galeryimg["img"])!=1 ? $galeryimg["img"]="../noimage.png" : $galeryimg["img"] ;
                                    ?>
                                    <div class=" text-center img-galery ">
                                        <div class=" img-border">
                                            <img itemprop="image" class="img-fluid changeimagegalery" zoom-src-no-crop="<?php echo base_url() ?>public/image/galery/<?php echo ($gext==".jpg"? $galeryimg["img"] : "../noimage.png") ?>" style="margin:0 auto;height:50px;" src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/galery/<?php echo ($gext==".jpg"? $galeryimg["img"] : "../noimage.png") ?>" alt="Jual Sparepart Truk <?php ucwords(strtolower($key["judul"]))  ?>">
                                        </div>
                                    </div>  
                                <?php endforeach ?>
                            <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 info p-t-0 p-l-2" style="border-top:none !important;border-bottom:none !important;">
                        <div >
                            <h1 itemprop="name" alt="<?php echo ucwords(strtolower($key["judul"])) ?>" class="fbold f24"><?php echo (($key["judul"])) ?></h1>
                        </div>
                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="m-y-2" style="color:#333">
                            <meta itemprop="priceCurrency" content="IDR" />
                            <span class="f24 fbold nomt" style="font-size:24px;//color:#ffa500"> 
                                <span class="" itemprop="priceCurrency" content="IDR">Rp</span> 
                                <span class="" itemprop="price"><?php echo number_format($key["nilai"], 0, ',','.') ; ?></span> 
                            </span>
                        </div>
                        <div class="row " style="font-size:16px;line-height:1.5">
                            <h5 class="col-xs-12"><span class="fa fa-cog"></span> Spesifikasi</h5>
                            <div class="col-lg-12">
                                <div class="row nopt nopb">
                                    <div class="col-xs-5" style="color:#888">Kategori</div><div class="col-xs-7 nopr"> <span class="lfid" ><?php echo strip_tags((!empty($namecategori["component"]))? $namecategori["parent"] : "-") ; ?></span></div>
                                </div>
                                <div class="row nopt nopb">
                                    <div class="col-xs-5" style="color:#888">Jaminan</div><div class="col-xs-7 nopr"> <span class="lfid" >Rp <?php echo number_format($key["jaminan"], 0, ',','.') ; ?></span></div>
                                </div>
                                <div class="row nopt nopb">
                                    <div class="col-xs-5" style="color:#888">Batas Akhir Penawaran</div><div class="col-xs-7 nopr"> <span class="lfid" itemprop="brand" ><?php echo date("d M Y", $key["batas_penawaran"]); ?></span></div>
                                </div>
                                <div class="row nopt nopb">
                                    <div class="col-xs-5" style="color:#888">Batas Akhir Jaminan</div><div class="col-xs-7 nopr"> <span class="lfid" itemprop="brand" ><?php echo date("d M Y", $key["batas_jaminan"]); ?></span></div>
                                </div>
                                <div class="row nopt nopb">
                                    <div class="col-xs-5" style="color:#888">Jenis Penawaran</div><div class="col-xs-7 nopr"> <span class="lfid" itemprop="brand" ><?php echo $key["jenis_penawaran"] == 1 ? "Penawaran Terbuka" : "Penawaran Tertutup"; ?></span></div>
                                </div>
                                
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            
                            <div class="col-xs-12">
                                <h2 class="m-t-3">Uraian</h2>
                                <p><?php echo $key["uraian"] ?></p>
                                <h2 class="m-t-3">Info Penyelenggara</h2>
                                <p><?php echo $key["penyelenggara"] ?></p>
                                <p><?php echo $key["info_penyelenggara"] ?></p>
                                <h2 class="m-t-3">Info Penjual</h2>
                                <p><?php echo $key["info_penjual"] ?></p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row list_same_product">
                        <?php $this->load->view("_sameproduct") ?>
                    </div>
                </div>
                <div class="col-xs-3 p-r-0" style="position: sticky;position: -webkit-sticky;top: 95px;">
                    
                    <div class="col-xs-12 p-x-0" style="margin-bottom:5px;">
                        <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan info lelang ".$key["judul"].". \n \t Bagaiamana saya bisa mendaftar?") ?>"  class="btn btn-black col-xs-12 fbold text-center f14 wa-button-product"><i class="fa fa-whatsapp fa-2x f18 m-r-1" style="vertical-align:middle"></i>Whatsapp</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 p-x-0" style="margin-bottom:5px;">
                        <a href="mailto:info@trumecs.com?subject=<?php echo $key["judul"] ?>&body=<?php echo "Hi Trumecs, saya tertarik dengan info lelang ".$key["judul"].". \n \t Bagaiamana saya bisa mendaftar?" ?>"  class="btn btn-black col-xs-12 fbold text-center f14 email-button-product"><i class="fa fa-envelope-o fa-2x f18 m-r-1" style="vertical-align:middle"></i>Email</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="card panel-kotak panel-default m-t-3">
                        <div class="card-header" style="background:#fff;"><strong><span class="fa fa-rss"></span> Informasi terkait</strong></div>
                            <ul class="list-group list-group-flush f14">
                            <?php foreach ($relatedarticle as $sm): ?>
                                <li class="list-group-item"><a href="<?php echo base_url() ?>article/<?php echo $sm['url'] ?>" class="fblack"><?php echo $sm['title'] ?></a><br>
                                </li>
                            <?php endforeach ?>
                            </ul>
                    </div>
                </div>
			</div>
            <div class="col-md-9 m-t-2" style="padding:0px;">
                
            </div>
			
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin:20px auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Hubungi Kami</h5>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
          <form class="form-horizontal">
              <div class="form-group">
                  <strong>Telepon</strong><br/> <?php echo platform_contact("phone"); ?>
              </div>
              <div class="form-group">
                  <strong>Email</strong><br/> <?php echo platform_contact("email"); ?>
              </div>
              <div class="form-group">
                  <strong>Whatsapp</strong><br/> <?php echo platform_contact("whatsapp"); ?>
              </div>
              <div class="form-group">
                  <strong>Kantor</strong><br/>Jl. Jend. Sudirman No.Km. 31, Kayuringin Jaya, Bekasi Sel., Kota Bks, Jawa Barat 17144
              </div>
          </form>
          <div class="clearfix"></div>
      </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <!--<button type="button" class="btn btn-orange">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
