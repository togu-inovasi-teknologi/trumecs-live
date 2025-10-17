<?php 
$session_data=$this->session->all_userdata();
$img_promo= '<img alt="promo trumecs" class="promo-small" src="'.base_url().'timthumb?w=70&src='.base_url().'public/image/promo_specialoffer.png" width="70">';
$img_promo_red= '<img alt="promo trumecs" class="promo-small" src="'.base_url().'timthumb?w=70&src='.base_url().'public/image/promo-special.png" width="70">';
?>
<div class="listproduct row" itemtype="http://schema.org/ItemList">
    <link itemprop="url" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <?php if (!empty($listproduct)) { foreach($category->result() as $item): ?>
        
    <?php if (!empty($listproduct[$item->id])) {?>
    <?php $view = $session_data["layout"]["view"]; ?>
    <div class='col-xs-12'><h2 style='border-bottom:1px solid #ccc;padding-bottom:10px;'>
            <?php echo $item->name ?>
            <?php if(!empty($listproduct[$item->id]) && count($listproduct[$item->id]) > 3 && !$this->agent->is_mobile()): ?>
            <a href="<?php echo base_url("c/".$item->url."/query?q=on&nama=".$querysearch."&quality="); ?>" style="font-size:16px" class="pull-right forange"><small>Lihat selengkapnya &raquo;</small></a>
            <?php endif; ?>
        </h2></div>
    <?php foreach ($listproduct[$item->id] as $index=>$key): ?>
    <?php if ($this->agent->is_mobile()): ?>
        <?php if ($view=="list"): ?>
        <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-xs-6 text-left hv_product m-y-1">
            <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
                    <?php 
                    $lfp=strlen($key["img"]);
                    $ext=substr($key["img"], $lfp-4);
                    is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                    ?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class=" img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                        </div>
                        <?php echo $img_promo?>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        
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
                            <span itemprop="mpn" class="f12 fblack"><?php echo ($key["partnumber"]) ?></span><br>
                            <span class="f12 nomt text-muted"><strike><?php echo "Rp.".number_format($pricepromo) ?></strike></span> 
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <span class="f14 fbold nomt " style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp.</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"]=="0") ? $key["price"] : $key["price_promo"] ); ?></span><small class="small-small fblack">/<?php echo ucwords($key["unit"]) ?></small></span> 
                            </div>
                            <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>" class="btn btn-orange col-xs-12 m-y-1  f12">Lihat Detail</a>
                    </div>
                </div>
                </a>
            </div>
            <?php endif ?>
            <?php if($index == 1 || ($index%2==1 && $index > 0)) { echo "<div class='clearfix'></div>";} ?>
        <?php endif ?>
        <?php if ($view!="list" OR !$this->agent->is_mobile()): ?>
        <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-left hv_product m-y-1 p-y-1">
            <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>" style="width:100%;display:inline-block">
                <?php 
                $lfp=strlen($key["img"]);
                $ext=substr($key["img"], $lfp-4);
                is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
                ?>
                <div class="col-lg-12 img-center-product" style="background: url(<?php echo base_url() ?>timthumb?w=200&h=200&src=<?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
                </div>
                <span itemprop="name" style="height:35px;width:100%;display:flex" class="f14 fbold"><?php echo ucwords($key["tittle"]) ?></span>  
                <span itemprop="mpn" class="f12 fblack"><?php echo ($key["partnumber"]) ?></span><br>
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
                    <span class="f12 nomb" style="color:#999"><strike><?php echo "Rp.".number_format($pricepromo); ?></strike> </span> 
                    <span style="right:0;margin-right:5px;margin-top:5px;top:0;position:absolute;width:65px;height:30px;display:block;font-size:14px;padding:2px 5px 3px;background:#ffa500;color:#fff;text-align:center;padding:5px 0px;border-radius:0px;" class=""><?php echo ceil(100-$percent) ?>% OFF</span>
                    <!--<hr class="m-a-0">--><br/>
                    <span class="f14 nomt" style="color:#ffa500;font-weight:">
                        <span itemprop="priceCurrency" content="IDR">Rp</span> <span itemprop="price"><?php echo  number_format(($key["price_promo"]=="0") ? $key["price"] : $key["price_promo"],0,",","." ); ?></span>
                    </span> 
                </div>    
                <?php //echo $img_promo;?>
            </a>
            <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>" class="btn btn-orange col-xs-12 m-y-1 f12">Lihat Detail</a>
        </div>
        <?php endif ?>                        
                 
    <?php endforeach ?> 
    <?php if(!empty($listproduct[$item->id]) && count($listproduct[$item->id]) > 3 && $this->agent->is_mobile()): ?>
        <div class="col-xs-12 m-b-3">
        <a href="<?php echo base_url("c/".$item->url."/query?q=on&nama=".$querysearch."&quality="); ?>" style="font-size:16px;font-weight:bold" class="btn btn-orange col-xs-12">Lihat selengkapnya &raquo;</a>
        </div>
    <?php endif; ?> 
<?php }else{ ?>
<!-- <div class="col-lg-12 col-sm-12 col-xs-12 text-center product ">
    <div class="alert alert-warning">
        Pencarian tidak ditemukan
    </div>
</div> -->
<?php }; endforeach;} else {?>
    <div class="col-lg-12 col-sm-12 col-xs-12 text-center product ">
    <div class="alert alert-warning">
        Pencarian tidak ditemukan
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