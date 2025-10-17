<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0, "etc" => NULL]); ?>
<div class="d-flex gap-3">
    <?php foreach ($kategori as $item) : ?>
        <div class="kategori">
            <a class="dropdown-toggle fbold" href="#" id="navbarDropdown-<?php echo $item['id'] ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                <?php echo $item['name'] ?>
            </a>
            <ul class="dropdown-menu" style="z-index: 99999999;" aria-labelledby="navbarDropdown-<?php echo $item['id'] ?>">
                <li>
                    <div class="mega-menu">
                        <h5 class="d-flex gap-2 align-items-center">
                            <img src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $item['url']; ?>.svg" />
                            <?php echo $item['name'] ?>
                        </h5>
                        <div class="menu-content">
                            <div class="section">
                                <ul>
                                    <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                    <?php foreach ($kategoris as $items) : ?>
                                        <?php if (count($items) > 0) { ?>
                                            <li style="background:#fff"><a alt="Jual Komponen <?php echo $items['name'] ?>" href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>" class="list-kategori-atas"><?php echo $items['name'] ?></a>
                                            </li>
                                        <?php } else { ?>
                                            <li>
                                                <div class="alert alert-warning text-center">
                                                    Kategori ini belum memiliki sub kategori.
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    <?php endforeach; ?>

    <!-- <ul class="dropdown-menu" style="z-index: 99999999;" aria-labelledby="navbarDropdown-<?php echo $item['id'] ?>">
        <li>
            <div class="mega-menu">
                <ul>
                    <li class="mega-submenu">
                        <h2 style="position: sticky;position: -webkit-sticky;top:0;z-index: 2;background-color:#fff">
                            <img src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $item['url']; ?>.svg" />
                            <?php echo $item['name'] ?>
                        </h2>
                        <div class="submenu-content">
                            <div class="section">
                                <ul>
                                    <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                    <?php foreach ($kategoris as $items) : ?>
                                        <li style="background:#fff"><a alt="Jual Komponen <?php echo $items['name'] ?>" href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>" class="list-kategori-atas"><?php echo $items['name'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    </ul> -->
</div>