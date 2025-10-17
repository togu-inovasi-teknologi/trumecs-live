<?php 
$session_data=$this->session->all_userdata();
$img_promo= '<img class="promo-small" src="'.base_url().'/public/image/promo_specialoffer.png" width="70">';
$img_promo_red= '<img class="promo-small" src="'.base_url().'/public/image/promo-special.png" width="70">';


 ?>
<div class="listproduct row" itemtype="http://schema.org/ItemList">
    <link itemprop="url" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <?php if (!empty($listproduct)) {?>
    <?php $view = $session_data["layout"]["view"]; ?>
    <?php foreach ($listproduct as $key): ?>
    <?php if ($this->agent->is_mobile()): ?>
        <?php if ($view=="list"): ?>
        <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-xs-12 text-left hv_product ">
            <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
                    <?php 
                    $lfp=strlen($key["img"]);
                    $ext=substr($key["img"], $lfp-4);
                    is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                    ?>
                <div class="row">
                    <div class="col-sm-4 col-xs-4">
                        <div class=" img-center-product" style="background: url(<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-8">
                        <?php echo $img_promo?>
                         <?php 
                            $percent = 90;
                            $pricepromo= "";
                            if ($key["price_promo"]!=0) {
                                $key["price"] = ($key["price"]!=0) ? $key["price"] : $key["price_promo"] ;
                                $got = $key["price_promo"];
                                $total=$key["price"];
                                $percent = ($got/$total)*100;
                                $pricepromo = $key["price"];
                            }else{
                                $pricepromo = ($key["price"]*100)/$percent;
                            }
                            ?> 

                            <span itemprop="name" class="f14 fblack fbold"><?php echo ucwords(strtolower($key["tittle"])) ?></span><br>
                            <span itemprop="mpn" class="f12 fblack fbold"><?php echo ($key["partnumber"]) ?></span><br>
                            <span class="f12 fbold nomt"><strike><?php echo "Rp.".number_format($pricepromo) ?></strike></span> 
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <span class="f14 fbold nomt " style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp.</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"]=="0") ? $key["price"] : $key["price_promo"] ); ?></span><small class="small-small fblack">/<?php echo ucwords($key["unit"]) ?></small></span> 
                            </div>
                    </div>
                </div>
                </a>
                <hr class="m-a-0" style="border-top:1px solid rgba(0, 0, 0, .1)">
            </div>
            <?php endif ?>
        <?php endif ?>
        <?php if ($view!="list" OR !$this->agent->is_mobile()): ?>
        <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-left hv_product m-b-1 p-b-1">
            <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
                <?php 
                $lfp=strlen($key["img"]);
                $ext=substr($key["img"], $lfp-4);
                is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                ?>
                <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                </div>
                <h4 itemprop="name" class="f14 fbold"><?php echo ucwords(strtolower((strlen($key["tittle"])<=20)? $key["tittle"] : substr($key["tittle"], 0,20)."..." )) ?></h4>  
                <?php 
                $percent = 90;
                $pricepromo= "";
                if ($key["price_promo"]!=0) {
                    $key["price"] = ($key["price"]!=0) ? $key["price"] : $key["price_promo"] ;
                    $got = $key["price_promo"];
                    $total=$key["price"];
                    $percent = ($got/$total)*100;
                    $pricepromo = $key["price"];
                }else{
                    $pricepromo = ($key["price"]*100)/$percent;
                }
                ?>  
                <div  itemprop="offers" itemscope itemtype="http://schema.org/Offer">                
                    <span class="f12 fbold nomb"><strike><?php echo "Rp.".number_format($pricepromo); ?></strike> </span> <span class="spanpercent">-<?php echo ceil(100-$percent) ?>%</span>
                    <hr class="m-a-0">
                    <span class="f14 fbold nomt fblack " style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp.</span> <span class="fbold" itemprop="price"><?php echo  number_format(($key["price_promo"]=="0") ? $key["price"] : $key["price_promo"] ); ?></span><small class="small-small fblack">/<?php echo ucwords($key["unit"]) ?></small></span> 
                </div>    
                <?php echo $img_promo;?>
                    <?php if (!$this->agent->is_mobile()): ?>
                    <span id="btnbuy<?php echo $key["id"] ?>" class="btn btn-orange col-lg-12 vhidden"><i class="fa fa-shopping-cart"></i> Beli</span>
                    <?php endif ?>
            </a>
        </div>
        <?php endif ?>                        
                                
    <?php endforeach ?> 

<?php }else{ ?>
<div class="col-lg-12 col-sm-12 col-xs-12 text-left product">
    Pencarian tidak ditemukan
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