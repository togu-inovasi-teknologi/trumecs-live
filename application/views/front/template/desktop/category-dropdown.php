<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0]); ?>

<div class="d-flex gap-1">
    <?php foreach ($kategori as $item) : ?>
        <div class="kategori">
            <a class="dropdown-toggle fbold" href="#" id="navbarDropdown-<?php echo $item['id'] ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $item['name'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown-<?php echo $item['id'] ?>">
                <li class="menu-item">
                    <div class="mega-menu">
                        <h5 class="d-flex gap-2 align-items-center">
                            <img src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $item['url']; ?>.svg" alt="<?php echo $item['name'] ?>" />
                            <?php echo $item['name'] ?>
                        </h5>
                        <div class="menu-content">
                            <div class="section">
                                <ul>
                                    <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                    <?php if (count($kategoris) > 0): ?>
                                        <?php foreach ($kategoris as $items) : ?>
                                            <li>
                                                <a alt="Jual Komponen <?php echo $items['name'] ?>"
                                                    href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>"
                                                    class="list-kategori-atas">
                                                    <?php echo $items['name'] ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li>
                                            <div class="alert alert-warning text-center">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Kategori ini belum memiliki sub kategori.
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submenu level 2 -->
                    <?php if (count($kategoris) > 0): ?>
                        <div class="mega-submenu">
                            <h6>Subkategori</h6>
                            <div class="menu-content">
                                <?php foreach ($kategoris as $items) : ?>
                                    <?php $subkategoris = $this->M_general->getcategori(['parent' => $items['id']]); ?>
                                    <?php if (count($subkategoris) > 0): ?>
                                        <div class="section">
                                            <h6 class="text-primary"><?php echo $items['name'] ?></h6>
                                            <ul>
                                                <?php foreach ($subkategoris as $subitem) : ?>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] . '/' . $subitem['url'] ?>"
                                                            class="list-kategori-atas">
                                                            <?php echo $subitem['name'] ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects for better UX
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('mouseenter', function() {
                const dropdownMenu = this.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                    dropdownMenu.classList.add('show');
                }
            });

            toggle.addEventListener('mouseleave', function() {
                const dropdownMenu = this.nextElementSibling;
                // Use setTimeout to allow moving cursor to dropdown
                setTimeout(() => {
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu') &&
                        !dropdownMenu.matches(':hover')) {
                        dropdownMenu.classList.remove('show');
                    }
                }, 100);
            });
        });

        // Keep dropdown open when hovering over it
        const dropdownMenus = document.querySelectorAll('.dropdown-menu');
        dropdownMenus.forEach(menu => {
            menu.addEventListener('mouseenter', function() {
                this.classList.add('show');
            });

            menu.addEventListener('mouseleave', function() {
                this.classList.remove('show');
            });
        });
    });
</script>