<?php $this->load->model("general/General_model", 'M_general'); ?>
<?php $kategori = $this->M_general->getcategori(["parent" => 0, "is_brand" => 0, "etc" => 0]); ?>

<div class="d-flex gap-1">
    <?php foreach ($kategori as $item) : ?>
        <div class="dropdown kategori">
            <a class="dropdown-toggle fw-bold" href="#" id="navbarDropdown-<?php echo $item['id'] ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $item['name'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown-<?php echo $item['id'] ?>">
                <li class="menu-item">
                    <div class="mega-menu">
                        <p class="d-flex gap-2 align-items-center fs-5 mb-1 fw-semibold">
                            <img src="<?php echo base_url() ?>public/icon/category/icon-<?php echo $item['url']; ?>.svg" alt="<?php echo $item['name'] ?>" />
                            <?php echo $item['name'] ?>
                        </p>
                        <div class="menu-content">
                            <div class="section">
                                <ul class="list-unstyled">
                                    <?php $kategoris = $this->M_general->getcategori(['parent' => $item['id']]); ?>
                                    <?php if (count($kategoris) > 0): ?>
                                        <?php foreach ($kategoris as $items) : ?>
                                            <li>
                                                <a alt="Jual Komponen <?php echo $items['name'] ?>"
                                                    href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] ?>"
                                                    class="list-kategori-atas text-decoration-none">
                                                    <?php echo $items['name'] ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li>
                                            <div class="alert alert-warning text-center mb-0">
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
                            <p>Subkategori</p>
                            <div class="menu-content">
                                <?php foreach ($kategoris as $items) : ?>
                                    <?php $subkategoris = $this->M_general->getcategori(['parent' => $items['id']]); ?>
                                    <?php if (count($subkategoris) > 0): ?>
                                        <div class="section">
                                            <p class="text-primary"><?php echo $items['name'] ?></p>
                                            <ul class="list-unstyled">
                                                <?php foreach ($subkategoris as $subitem) : ?>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>c/<?php echo $item['url'] . '/' . $items['url'] . '/' . $subitem['url'] ?>"
                                                            class="list-kategori-atas text-decoration-none">
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
        // Enable hover for dropdowns
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(this.querySelector('.dropdown-toggle'));
                    bsDropdown.show();
                }
            });

            dropdown.addEventListener('mouseleave', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu && !dropdownMenu.matches(':hover')) {
                    const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(this.querySelector('.dropdown-toggle'));
                    bsDropdown.hide();
                }
            });

            // Keep dropdown open when hovering over menu
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.addEventListener('mouseenter', function() {
                    const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(dropdown.querySelector('.dropdown-toggle'));
                    bsDropdown.show();
                });

                dropdownMenu.addEventListener('mouseleave', function() {
                    const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(dropdown.querySelector('.dropdown-toggle'));
                    bsDropdown.hide();
                });
            }
        });
    });
</script>