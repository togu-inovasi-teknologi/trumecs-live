<ol class="breadcrumb " itemscope itemtype="http://schema.org/BreadcrumbList">
	<li class="dropdown"><span class="forange pointer" href="<?php echo base_url() ?>" class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><strong>Kategori <i class="fa fa-arrow-circle-down"></i></strong></span>
		<ul class="dropdown-menu" role="menu" >
			<?php $allctg = unserialize(CATEGORY_ALL) ?>
			<?php foreach ($allctg as $key): ?>
			<?php if ($key["parent"]=="prn"): ?>
			<?php

			$count = ctgprn($allctg,$key["id"]);

			?>
			<li class="sub-dropdown-menu" role="presentation"><a class="prnctg"  href="<?php echo base_url() ?>c/<?php echo str_replace(" ", "-", $key["name"]) ?>"><?php echo $key["name"] ?> (<?php echo count($count) ?>) <?php echo (count($count)>0) ? '<i class="fa ceretright fa-arrow-circle-right">' : '' ; ?></i></a>
				<?php if (count($count)>0): ?>
				<ul class="dropdown-menulist" role="menu" >
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
	<?php foreach ($breadcrumb as $keybreadcrumb): ?>
		<?php if (!empty($keybreadcrumb)): ?>
			<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				<a itemprop="item" class="forange" href="<?php echo base_url()."c/". $str_after.preg_replace("/[^0-9a-zA-Z]+/", "-",$keybreadcrumb) ?>">
					<span itemprop="name"><?php echo $keybreadcrumb ?></span>
				</a>
			</li>
			<?php $str_after.=preg_replace("/[^0-9a-zA-Z]+/", "-", $keybreadcrumb)."/" ?>
		<?php endif ?>
	<?php endforeach ?>
	<?php if ($querysearch!=""): ?>
	<li >
		<a >
			<span><?php echo  (!empty($querysearch)) ? $querysearch : "" ; ?></span>
		</a>
	</li>
	<?php endif ?>
</ol>
