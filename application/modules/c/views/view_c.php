<?php

function ctgprn($categori, $parent)
{
    $array = array();
    if ($parent != "") {
        foreach ($categori as $key) {
            if ($key["parent"] == $parent) {
                $datakey = array(
                    'id' => $key["id"],
                    'name' => $key["name"]
                );
                array_push($array, $datakey);
            }
        }
    }
    return $array;
}

$session_data = $this->session->all_userdata();

?>
<div id="page_c">
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-3 sticky-member">
                <?php if (!$this->agent->is_mobile()) : ?>
                    <?php $this->load->view("_form-filter-search") ?>
                <?php else : ?>
                    <?php $this->load->view("_form-filter-search") ?>
                <?php endif ?>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php if (!$this->agent->is_mobile()) : ?>
                        <!-- Desktop Version -->
                        <div class="col-lg-12 mb-3">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="d-flex gap-2">
                                    <!-- Optional: Sorting dropdown jika diperlukan -->

                                    <!-- <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-sort-down me-1"></i>
                                            Urutkan
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Termurah</a></li>
                                            <li><a class="dropdown-item" href="#">Termahal</a></li>
                                            <li><a class="dropdown-item" href="#">Terbaru</a></li>
                                        </ul>
                                    </div> -->

                                    <a href="<?php echo base_url() ?>c/all/query?q=on&nama=" class="btn" style="background-color: #fa8420; color: white; border: none;">
                                        <i class="bi bi-grid-3x3-gap me-1"></i>
                                        Semua Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="col-lg-12 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-3">
                                <!-- Breadcrumb Navigation -->


                                <!-- Search Results Header -->
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <div class="d-flex">
                                        <i class="bi bi-search me-2" style="color: #fa8420;"></i>
                                        <?php if (isset($querysearch)) { ?>
                                            <p class="fw-bold mb-0">Hasil Pencarian <?php echo htmlspecialchars($querysearch); ?>
                                            <?php } ?>
                                    </div>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0" style="--bs-breadcrumb-divider: '›';">
                                            <?php $i = 0; ?>
                                            <?php foreach ($breadcrumb as $keybreadcrumb) : ?>
                                                <?php if (!empty($keybreadcrumb)) : ?>
                                                    <li class="breadcrumb-item <?php echo ($i == count($breadcrumb) - 1) ? 'active fw-bold' : ''; ?>"
                                                        <?php echo ($i == count($breadcrumb) - 1) ? 'aria-current="page"' : ''; ?>>
                                                        <?php
                                                        if ($i == 0) {
                                                            echo '<i class="bi bi-house-door me-1"></i>';
                                                        }
                                                        echo ucwords(strtolower($keybreadcrumb));
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </ol>
                                    </nav>


                                    <!-- Mobile Filter Button (only on mobile) -->
                                    <?php if ($this->agent->is_mobile()) : ?>
                                        <div class="mt-2">
                                            <button type="button"
                                                class="btn btn-sm"
                                                style="background-color: #fa8420; color: white; border: none;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_filter">
                                                <i class="bi bi-funnel me-1"></i>
                                                Filter
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!$this->agent->is_mobile()) : ?>
                        <?php $this->load->view($view_product) ?>
                    <?php else : ?>
                        <?php $this->load->view($view_product) ?>
                    <?php endif ?>
                </div>
            </div>
            <!-- <div class="col-md-12">
			<div class=" <?php echo (!$this->agent->is_mobile()) ? "card" : ''; ?> m-y-1 promo p-b-1">
				<?php //$promo_inseach_hor ? $this->load->view("_promohorisontal") : ""; 
                ?>
			</div>
		</div> -->
        </div>
    </div>

</div>