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
		<div class="col-xs-12">
			<div class="row product">
                <div class="col-xs-12  text-center imgproduct">
                    <div class="row">
                        <div class="col-lg-12 <?php echo ($this->agent->is_mobile()) ? "p-x-0" : "" ; ?> text-center">
                            <img itemprop="image" class="img-detail-lg tochangebyclick" 
                            data-zoom-image="<?php echo base_url() ?>public/image/lelang/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" 
                             src="<?php echo base_url() ?>public/image/lelang/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" alt="Jual Sparepart Truk <?php echo ucwords(strtolower($key["judul"])) ?>">
                        </div>
                    </div>
                    <div class="row m-b-2" style="border-bottom:1px solid #ccc">
                        <div class="col-lg-12 <?php echo ($this->agent->is_mobile()) ? "p-x-0" : "" ; ?>">
                            <div class="">
                                <div class=" img-border">
                                    <img class="img-fluid changeimagegalery" zoom-src-no-crop="<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg"? $key["img"] : "../noimage.png") ?>" alt="Jual Sparepart Truk <?php echo ucwords(strtolower($key["judul"]))  ?>">
                                </div>
                            </div>
                             <?php if (count($galeryimg)>0): ?>
                                <?php foreach ($galeryimg as $galeryimg ): ?>
                                    <?php 
                                    $glfp=strlen($galeryimg["img"]);
                                    $gext=substr($galeryimg["img"], $glfp-4);
                                    is_file("public/image/galery/".$galeryimg["img"])!=1 ? $galeryimg["img"]="../noimage.png" : $galeryimg["img"] ;
                                    ?>
                                    <div class="">
                                        <div class=" img-border">
                                            <img itemprop="image" class="img-fluid changeimagegalery" zoom-src-no-crop="<?php echo base_url() ?>public/image/galery/<?php echo ($gext==".jpg"? $galeryimg["img"] : "../noimage.png") ?>" style="margin:0 auto;height:50px;" src="<?php echo base_url() ?>timthumb?w=70&h=70&src=<?php echo base_url() ?>public/image/galery/<?php echo ($gext==".jpg"? $galeryimg["img"] : "../noimage.png") ?>" alt="Jual Sparepart Truk <?php ucwords(strtolower($key["judul"]))  ?>">
                                        </div>
                                    </div>  
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
				</div>
				<div class="col-xs-12 info" >
					<div >
						<h1 itemprop="name" alt="<?php echo ucwords(strtolower($key["judul"])) ?>" class="f18 fbold"><?php echo (($key["judul"])) ?></h1> 
					</div>
					<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="" style="color:#333">
						<meta itemprop="priceCurrency" content="IDR" />
						<link itemprop="availability" href="http://schema.org/InStock" />
						<span class="nomt fbold" style="font-size:32px"> <span class="" itemprop="priceCurrency" content="IDR">Rp</span> <span class="" itemprop="price"><?php echo number_format($key["nilai"], 0, ',','.') ; ?></span> <small class="f34" style="color:#999 !important"></span>
					</div>
					<?php echo $img_promo;?>
					<div class=" text-left nopt detail-sparepart m-y-1">
						<div class="p-y-0">
							<div class="tab-pane fade in active" id="keterangan" role="tabpanel">
                                <h3 class="f22"><span class="fa fa-cog"></span> Spesifikasi</h3>
								<div class="col-lg-12 p-x-0">
                                    
                                    <div class="row nopt nopb">
                                        <div class="col-xs-4" style="color:#888">Garansi</div>
                                        <div class="col-xs-8"> <?php echo (!empty($key["warranty"]))? $key["warranty"] : "-" ; ?></div>
                                    </div>
                                    <div class="row nopt nopb">
                                        <div class="col-xs-5" style="color:#888">Kategori</div>
                                        <div class="col-xs-7 nopr"> <span class="lfid" ><?php echo strip_tags((!empty($namecategori["component"]))? $namecategori["parent"] : "-") ; ?></span></div>
                                    </div>
                                    <div class="row nopt nopb">
                                        <div class="col-xs-5" style="color:#888">Jaminan</div>
                                        <div class="col-xs-7 nopr"> <span class="lfid" >Rp <?php echo number_format($key["jaminan"], 0, ',','.') ; ?></span></div>
                                    </div>
                                    <div class="row nopt nopb">
                                        <div class="col-xs-5" style="color:#888">Batas Akhir Penawaran</div>
                                        <div class="col-xs-7 nopr"> <span class="lfid" itemprop="brand" ><?php echo date("d M Y", $key["batas_penawaran"]); ?></span></div>
                                    </div>
                                    <div class="row nopt nopb">
                                        <div class="col-xs-5" style="color:#888">Batas Akhir Jaminan</div>
                                        <div class="col-xs-7 nopr"> <span class="lfid" itemprop="brand" ><?php echo date("d M Y", $key["batas_jaminan"]); ?></span></div>
                                    </div>
                                    <div class="row nopt nopb">
                                        <div class="col-xs-5" style="color:#888">Jenis Penawaran</div>
                                        <div class="col-xs-7 nopr"> <span class="lfid" itemprop="brand" ><?php echo $key["jenis_penawaran"] == 1 ? "Penawaran Terbuka" : "Penawaran Tertutup"; ?></span></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            <br/>
							</div>
							<div class="tab-pane fade in itemprop_p" id="description" role="tabpanel">
                                <h2 class="m-t-1">Uraian</h2>
                                <p><?php echo $key["uraian"] ?></p>
                                <h2 class="m-t-1">Info Penyelenggara</h2>
                                <p><?php echo $key["penyelenggara"] ?></p>
                                <p><?php echo $key["info_penyelenggara"] ?></p>
                                <h2 class="m-t-1">Info Penjual</h2>
                                <p><?php echo $key["info_penjual"] ?></p>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="row share">
				<div class="col-xs-12">
                    <div class="clearfix"></div>
                    <div class="col-xs-12 p-x-0" style="margin-bottom:5px;">
                        <a href="https://wa.me/6282122668008?text=<?php echo urlencode("Hi Trumecs, saya tertarik dengan ".$key["judul"].". Apakah barang ini tersedia?") ?>"  class="btn btn-black col-xs-12 fbold text-center f14 wa-button-product"><i class="fa fa-whatsapp fa-2x f18 m-r-1" style="vertical-align:middle"></i>Whatsapp</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 p-x-0" style="margin-bottom:5px;">
                        <a href="mailto:info@trumecs.com?subject=<?php echo $key["judul"] ?>&body=<?php echo "Hi Trumecs, saya tertarik dengan ".$key["judul"].". \n \t Apakah barang ini tersedia?" ?>"  class="btn btn-black col-xs-12 fbold text-center f14 email-button-product"><i class="fa fa-envelope-o fa-2x f18 m-r-1" style="vertical-align:middle"></i>Email</a>
                    </div>
                    <div class="clearfix"></div>
                    
				</div>
			</div>
            <div class="clearfix"></div>
            <div class="card panel-kotak panel-default m-t-2">
                <div class="card-header" style="background:#fff;"><strong><span class="fa fa-rss"></span> Informasi terkait</strong></div>
                    <ul class="list-group list-group-flush f14">
                    <?php foreach ($relatedarticle as $sm): ?>
                        <li class="list-group-item"><a href="<?php echo base_url() ?>article/<?php echo $sm['url'] ?>" class="fblack"><?php echo $sm['title'] ?></a><br>
                        </li>
                    <?php endforeach ?>
                    </ul>
            </div>
			<div class="row list_same_product">
				<?php $this->load->view("_sameproduct") ?>
			</div>
            
		</div>
	</div>
</div>
