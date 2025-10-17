    <?php 
    $session_data=$this->session->all_userdata();
    $img_promo= '<img alt="promo trumecs" class="promo-small" src="'.base_url().'timthumb?w=70&src='.base_url().'public/image/promo_specialoffer.png" width="70">';
    $img_promo_red= '<img alt="promo trumecs" class="promo-small" src="'.base_url().'timthumb?w=70&src='.base_url().'public/image/promo-special.png" width="70">';


    ?>
    <div class="listproduct row" itemtype="http://schema.org/ItemList">
        <link itemprop="url" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
        <div class='col-xs-12'><h1 style='border-bottom:1px solid #ccc;padding-bottom:10px;'><?php echo $this->lang->line('judul_lelang', FALSE); ?></h1>
        <?php if (!empty($listproduct)) {?>
        <?php $view = $session_data["layout"]["view"]; ?>
        <?php foreach ($listproduct as $index=>$key): ?>
        <?php if ($this->agent->is_mobile()): ?>
            <?php if ($view=="list"): ?>
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-xs-6 text-left hv_product ">
                <a itemprop="url" href="<?php echo base_url() ?>lelang/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["judul"]))) ?>">
                        <?php 
                        $lfp=strlen($key["img"]);
                        $ext=substr($key["img"], $lfp-4);
                        is_file("public/image/lelang/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                        ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class=" img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/lelang/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                            </div>
                            <?php echo $img_promo?>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                                <span itemprop="name" class="f14 fblack fbold"><?php echo ucwords(strtolower($key["judul"])) ?></span><br>
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <span class="f14 fbold nomt " style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp.</span> <span itemprop="price"><?php echo  number_format($key["nilai"]); ?></span></span> 
                                </div>
                        </div>
                    </div>
                    </a>
                    <a itemprop="url" href="<?php echo base_url() ?>lelang/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["judul"]))) ?>" class="btn btn-white col-xs-12 m-y-1 f12"><?php echo $this->lang->line('tombol_lihat_detail', FALSE); ?></a>
                </div>
                <?php endif ?>
                <?php if($index == 1 || ($index%2==1 && $index > 0)) { echo "<div class='clearfix'></div>";} ?>
            <?php endif ?>
            <?php if ($view!="list" OR !$this->agent->is_mobile()): ?>
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-left hv_product m-y-1 p-y-1">
                <a itemprop="url" href="<?php echo base_url() ?>lelang/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["judul"]))) ?>" style="width:100%;display:inline-block">
                    <?php 
                    $lfp=strlen($key["img"]);
                    $ext=substr($key["img"], $lfp-4);
                    is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                    ?>
                    <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                    </div>
                    <span itemprop="name" style="height:35px;width:100%;display:flex" class="f14 fbold"><?php echo ucwords($key["judul"]) ?></span>  
                    <div  itemprop="offers" itemscope itemtype="http://schema.org/Offer">                
                        <!--<hr class="m-a-0">--><br/>
                        <span class="f14 nomt" style="color:#ffa500;font-weight:">
                            <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format($key["nilai"],0,",","." ); ?></span>
                        </span> 
                    </div>    
                    <?php //echo $img_promo;?>
                </a>
                <a itemprop="url" href="<?php echo base_url() ?>lelang/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["judul"]))) ?>" class="btn btn-white col-xs-12 m-y-1 f12"><?php echo $this->lang->line('tombol_lihat_detail', FALSE); ?></a>
            </div>
            <?php endif ?>                        
                                    
        <?php endforeach ?> 

    <?php }else{ ?>
    <div class="col-lg-12 col-sm-12 col-xs-12 text-center product ">
        <div class="alert alert-warning">
            Belum ada lelang yang sesuai dengan pencarian anda saat ini
        </div>
    </div>
    <?php } ?>
    </div>

    <?php if (!empty($links)): ?>
        <div class="row ">
            <div class="col-lg-12 ">
                <div class="text-center row  linkpagination"> 
                    <br>  
                    <?php echo !empty($listproduct)?$links: "";  ?>       
                </div>
                <?php if ($this->agent->is_mobile()): ?>
                    <div class="text-center m-t-1">
                    <?php if ($session_data["layout"]["view"]=="list"): ?>
                        <a href="<?php echo base_url() ?>cari?view=box" class="fblack" >ubah tampilan box</a>
                    <?php else: ?>
                        <a href="<?php echo base_url() ?>cari?view=list" class="fblack" >ubah tampilan list</a>
                    <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>