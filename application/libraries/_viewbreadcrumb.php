<?php 
/**
* 
*/
class _viewbreadcrumb{
	var $params;
	public function __construct($params)
	{

	    $this->params = $params;
	    $data= $this->params;
	    $this->index($data["breadcrumb"],$data["modebreadcrumb"]);
	    
	}

	function ctgprn($categori,$parent)
	{
	    $array = array();
	    if ($parent!="") {
	        foreach ($categori as $key) {
	            if ($key["parent"]==$parent) {
	                $datakey= array(
	                    'id' => $key["id"],
	                    'name'=>$key["name"]
	                 );
	                array_push($array, $datakey);
	            }
	        }
	    }
	    return $array;
	    
	}
	
	function index($breadcrumb,$mode)
	{	
		?>
		<ol class="breadcrumb " itemscope itemtype="http://schema.org/BreadcrumbList">
			<li class="dropdown"><span class="forange pointer" href="<?php echo base_url() ?>" class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><strong>Kategori <i class="fa fa-arrow-circle-down"></i></strong></span>
				<ul class="dropdown-menu" role="menu" >
					<?php $allctg = unserialize(CATEGORY_ALL) ?>
					<?php foreach ($allctg as $key): ?>
					<?php if ($key["parent"]=="prn"): ?>
					<?php

					$count = $this->ctgprn($allctg,$key["id"]);

					?>
						<li class="sub-dropdown-menu" role="presentation"><a class="prnctg"  href="<?php echo base_url() ?>c/<?php echo str_replace(" ", "-", $key["name"]) ?>"><?php echo $key["name"] ?> (<?php echo count($count) ?>) <?php echo (count($count)>0) ? '<i class="fa ceretright fa-arrow-circle-right">' : '' ; ?></i></a>
							<?php if (count($count)>0): ?>
							<ul class="dropdown-menulist" role="menu" style="<?php echo ($key["id"]==72) ? "min-width: 460px;" : "" ; ?>">
								<?php foreach ($count as $sub): ?>
									<li><a href="<?php echo base_url() ?>c/<?php echo str_replace(" ", "-", $key["name"]) ?>/<?php echo str_replace(" ", "-", $sub["name"]) ?>"><?php echo $sub["name"] ?></a></li>
								<?php endforeach ?>
							</ul>
							<?php endif ?>
						</li>
					<?php endif ?>
					<?php endforeach ?>
				</ul>
			</li>
			<?php $str_after="" ?>
			
			<?php if ($mode[0]=="promo"): ?>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item" class="forange" href="<?php echo base_url()."promo" ?>">
						<span itemprop="name">Promo</span>
					</a>
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<span itemprop="item" class="fblack" >
						<span itemprop="name"><?php echo $breadcrumb[0] ?></span>
					</span>
				</li>
			<?php else: ?>
			<?php foreach ($breadcrumb as $keybreadcrumb): ?>
				<?php if (!empty($keybreadcrumb)): ?>
					<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
						<a itemprop="item" class="forange" href="<?php echo base_url()."c/". $str_after.$keybreadcrumb ?>">
							<span itemprop="name"><?php echo $keybreadcrumb ?></span>
						</a>
					</li>
					<?php $str_after.=$keybreadcrumb."/" ?>
				<?php endif ?>
			<?php endforeach ?>
			<?php endif ?>
		</ol>


		<?php
	}
}


 ?>