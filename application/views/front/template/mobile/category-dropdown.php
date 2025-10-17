<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0]); ?>
<a class="dropdown-toggle b-t-10" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false"><span class="fa fa-bars" style="vertical-align:middle;margin-right:10px;"></span>
    <?php echo $this->lang->line('kategori', FALSE); ?> </a>
<ul class="dropdown-menu" style="z-index: 99999" aria-labelledby="navbarDropdown">
    <li>
        <div class="mega-menu">
            <ul>
                <?php foreach ($kategori as $item) : ?>
                <li class="menu-item menu-1">
                    <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] ?>"><?php echo $item['name'] ?>
                        <i class="fa fa-angle-right pull-right"></i></a>
                    <div class="mega-submenu">
                        <h2 style="position: sticky;position: -webkit-sticky;top:0;z-index: 2;background-color:#fff">
                            <img
                                src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $item['url']; ?>.svg" />
                            <?php echo $item['name'] ?>
                        </h2>
                        <div class="submenu-content">
                            <div class="section">
                                <ul>
                                    <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                    <?php foreach ($kategoris as $items) : ?>
                                    <li style="background:#fff"><a alt="Jual Komponen <?php echo $items['name'] ?>"
                                            href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>"
                                            class="list-kategori-atas"><?php echo $items['name'] ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </li>
</ul>