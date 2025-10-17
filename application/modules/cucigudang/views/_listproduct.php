<?php 
$img_cucigudang= '<img alt="cucigudang trumecs" class="promo-small" src="'.base_url().'timthumb?w=70&src='.base_url().'public/image/cucigudang-special.png" width="70">';
$img_cucigudang_red= '<img alt="cucigudang trumecs" class="cucigudang-small" src="'.base_url().'timthumb?w=70&src='.base_url().'public/image/cucigudang-special.png" width="70">';
$productimgonmobile = base_url().'timthumb?h=200&src=' 


 ?>
<div class="listproduct row" itemtype="http://schema.org/ItemList">
    <link itemprop="url" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <?php if (!empty($listproduct)) {?>
    <?php foreach ($listproduct as $key): ?>
    <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product"  class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-left hv_product m-b-1 p-b-1">
        <a itemprop="url" href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^a-zA-Z0-9]/", "-", ucwords(strtolower($key["tittle"]))) ?>">
            <?php 
            $lfp=strlen($key["img"]);
            $ext=substr($key["img"], $lfp-4);
            is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="../noimage.png" : $key["img"] ;
            ?>
            <div class="col-lg-12 img-center-product" style="background: url(<?php echo $productimgonmobile ?><?php echo base_url() ?>public/image/product/<?php echo ($ext==".jpg")? $key["img"] : "../noimage.png"; ?>)"> 
            </div>
            <h4 itemprop="name" class="f14 fbold"><?php echo ucwords(strtolower((strlen($key["tittle"])<=20)? $key["tittle"] : substr($key["tittle"], 0,20)."..." )) ?></h4>  
            <?php 
            $percent = 90;
            $pricecucigudang= "";
            if ($key["price_promo"]!=0) {
                $key["price"] = ($key["price"]!=0) ? $key["price"] : $key["price_promo"] ;
                $got = $key["price_promo"];
                $total=$key["price"];
                $percent = ($got/$total)*100;
                $pricecucigudang = $key["price"];
            }else{
                $pricepromo = ($key["price"]*100)/$percent;
            }
            ?>  
            <div  itemprop="offers" itemscope itemtype="http://schema.org/Offer">  
                <span class="spanpercent" style="background-color:#BF1E2D;position: inherit !important;">
                    <?php echo ucwords(strtolower((strlen($datalist["cucigudang"][0]['name'])<=18)? $datalist["cucigudang"][0]['name'] : substr($datalist["cucigudang"][0]['name'], 0,18)."..." )) ?>
                </span>
                <hr class="m-a-0">
                <span class="f14 fbold nomt fblack " style=""><span class="fbold" itemprop="priceCurrency" content="IDR">Rp.</span> <span class="fbold" itemprop="price"><?php echo  number_format(($key["price_promo"]=="0") ? $key["price"] : $key["price_promo"] ); ?></span><small class="small-small fblack">/<?php echo ucwords($key["unit"]) ?></small></span> 
            </div>    
            <?php echo $img_cucigudang;?>
            <span id="btnbuy<?php echo $key["id"] ?>" class="btn btn-orange col-lg-12 vhidden"><i class="fa fa-shopping-cart"></i> Beli</span>
        </a>                           
    </div>                        
<?php endforeach ?> 

<?php }else{ ?>
<div class="col-lg-12 col-sm-12 col-xs-12 text-left product">
    Pencarian tidak ditemukan
</div>
<?php } ?>
</div>

<?php if (!empty($links)): ?>
    <div class="row nopt nopb">
        <div class="col-lg-12 nopr nopl">
            <div class="text-center row nopt nopb linkpagination"> 
                <br>  
                <?php echo !empty($listproduct)?$links: "";  ?>       
            </div> 
        </div>
    </div>
<?php endif ?>

