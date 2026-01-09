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
        <?php $this->load->view("mobile/_form-filter-search") ?>
        <div class="row my-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-3">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view($view_product) ?>

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
    <div class="modal fade" id="modal_filter" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="filterModalLabel">
                        <i class="bi bi-funnel-fill me-2" style="color: #fa8420;"></i>
                        <?php echo $this->lang->line('judul_filter', FALSE); ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="<?php echo base_url() ?>cari">
                    <div class="modal-body pt-0">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama / Partnumber</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-search" style="color: #fa8420;"></i>
                                </span>
                                <input name="nama"
                                    placeholder="Nama / Partnumber"
                                    type="text"
                                    class="form-control"
                                    value="<?php echo (!empty($querysearch)) ? $querysearch : ""; ?>">
                            </div>
                        </div>

                        <!-- <div class="mb-3">
                        <label class="form-label fw-semibold">Lokasi</label>
                        <select name="lokasi" class="form-select">
                            <option value="">-- Pilih Lokasi --</option>
                            <option value="1">Jabodetabek</option>
                            <option value="2">Banten</option>
                            <option value="3">Jawa Barat</option>
                            <option value="4">Jawa Tengah</option>
                            <option value="5">Jawa Timur</option>
                        </select>
                    </div> -->

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="komponen" class="form-select">
                                <option value="">-- Pilih kategori --</option>
                                <?php foreach ($category->result() as $item) : ?>
                                    <option value="<?php echo $item->id ?>" <?php echo $idcomponent == $item->id ? 'selected="selected"' : "" ?>>
                                        <?php echo $item->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sub Kategori</label>
                            <select name="sub_kategori" class="form-select">
                                <option value="">-- Pilih Sub Kategori --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Merk</label>
                            <select name="merek" class="form-select">
                                <option value="">-- Pilih Merk --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Grade</label>
                            <select name="quality" class="form-select">
                                <option value="">-- Pilih Grade --</option>
                                <option value="1">Asli</option>
                                <option value="2">Replika</option>
                                <option value="3">Bekas/Copotan</option>
                            </select>
                        </div>

                        <!-- <div class="mb-4">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Min</span>
                                    <input class="form-control"
                                        type="text"
                                        id="hargamin"
                                        name="hargamin"
                                        placeholder="Rp">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Max</span>
                                    <input class="form-control"
                                        type="text"
                                        id="hargamax"
                                        name="hargamax"
                                        placeholder="Rp">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn" id="apply-filter"
                            style="background-color: #fa8420; color: white; border: none;"
                            data-bs-dismiss="modal">
                            <i class="bi bi-check-circle me-2"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>