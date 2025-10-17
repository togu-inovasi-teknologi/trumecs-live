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
        <div class="row m-y-1">
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
                        <div class="col-lg-12 m-b-1">
                            <div class="text-right">
                                <!-- <select class="btn btnnewwhite">
                                    <option value="">Urutkan Harga</option>
                                    <option value="termurah">Termurah</option>
                                    <option value="termahal">Termahal</option>
                                </select> -->
                                <a href="<?php echo base_url() ?>c/all/query?q=on&nama=" class="btn btnnew">Semua</a>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="col-lg-12 m-b-1">
                        <div class="card p-a-1">
                            <span>Hasil pencarian</span>
                            <h1 class="f1rem fbold" style="display:inline;">
                                <?php $i = 0; ?>
                                <?php foreach ($breadcrumb as $keybreadcrumb) : ?>
                                    <?php if ($i == 2) {
                                        echo (!empty($keybreadcrumb)) ? strtolower($keybreadcrumb) : "";
                                    }
                                    ?>
                                    <?php $i++ ?>
                                <?php endforeach ?>
                            </h1>
                            <strong><?php echo (!empty($querysearch)) ? $querysearch : ""; ?></strong>
                            <span class="fbold"><?php $i = 0; ?>
                                <?php
                                foreach ($breadcrumb as $keybreadcrumb) :
                                    if ($i == 0) {
                                        echo (!empty($keybreadcrumb)) ? " " . strtolower($keybreadcrumb) : "";
                                    }
                                    $i++;
                                endforeach;
                                ?>
                            </span>
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