<nav aria-label="breadcrumb" class="mb-3">
	<ol class="breadcrumb mb-0" itemscope itemtype="http://schema.org/BreadcrumbList">
		<li class="breadcrumb-item dropdown">
			<a class="text-warning dropdown-toggle text-decoration-none" href="#" id="kategoriDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<strong>Kategori <i class="bi bi-arrow-down-circle"></i></strong>
			</a>
			<ul class="dropdown-menu shadow-sm border-0" aria-labelledby="kategoriDropdown">
				<?php $allctg = CATEGORY_ALL ?>
				<?php foreach (CATEGORY_ALL as $key): ?>
					<?php if ($key["parent"] == "prn"): ?>
						<?php
						$count = ctgprn($allctg, $key["id"]);
						?>
						<li class="dropend" role="presentation">
							<a class="dropdown-item prnctg d-flex justify-content-between align-items-center" href="<?php echo base_url() ?>c/<?php echo str_replace(" ", "-", $key["name"]) ?>">
								<?php echo $key["name"] ?> (<?php echo count($count) ?>)
								<?php echo (count($count) > 0) ? '<i class="bi bi-chevron-right"></i>' : ''; ?>
							</a>
							<?php if (count($count) > 0): ?>
								<ul class="dropdown-menu shadow-sm border-0" style="<?php echo ($key["id"] == 72) ? "min-width: 460px;" : ""; ?>">
									<?php foreach ($count as $sub): ?>
										<li><a class="dropdown-item" href="<?php echo base_url() ?>c/<?php echo str_replace(" ", "-", $key["name"]) ?>/<?php echo str_replace(" ", "-", $sub["name"]) ?>"><?php echo $sub["name"] ?></a></li>
									<?php endforeach ?>
								</ul>
							<?php endif ?>
						</li>
					<?php endif ?>
				<?php endforeach ?>
			</ul>
		</li>

		<?php $str_after = "" ?>
		<?php foreach ($breadcrumb as $keybreadcrumb): ?>
			<li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				<a itemprop="item" class="text-warning text-decoration-none" href="<?php echo base_url() . "c/" . $str_after . $keybreadcrumb ?>">
					<span itemprop="name"><?php echo $keybreadcrumb ?></span>
				</a>
			</li>
			<?php $str_after .= $keybreadcrumb . "/" ?>
		<?php endforeach ?>

		<?php if ($querysearch != ""): ?>
			<li class="breadcrumb-item active" aria-current="page">
				<span class="text-secondary"><?php echo (!empty($querysearch)) ? $querysearch : ""; ?></span>
			</li>
		<?php endif ?>
	</ol>
</nav>