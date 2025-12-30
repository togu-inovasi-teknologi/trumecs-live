<!--Start Page-->
<div class="cart_page">
    <div class="row m-t-2">
        <div class="col-xs-12">
            <h4 class="m-b-2"><span class="fa fa-shopping-cart forange m-r-1"></span>
                <?php echo $this->lang->line('judul_halaman_cart', FALSE); ?></h4>
        </div>
        <?php if (count($this->cart->contents()) != 0) : ?>
            <div class="col-xs-12">
                <?php echo ($this->session->flashdata('message') == "") ? "" :
                    '<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
                    $this->session->flashdata('message') .
                    '</div>'; ?>
                <div class="card p-a-1">
                    <div class="row">
                        <?php
                        $total = 0;
                        $totalw = 0;
                        $totalweight = 0;
                        $quantity = 0;
                        $totaldimensi = 0;
                        $form = 1;
                        ?>
                        <?php foreach ($this->cart->contents() as $key) : ?>
                            <div class="col-xs-12 m-b-1">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <a class="f16 fblack fbold"
                                            href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^A-Za-z0-9\-]/", "-", str_replace(" ", "-", ucwords($key["name"]))) ?>">
                                            <?php echo ucwords($key["name"]) ?><br />
                                            <span
                                                class="f12 text-muted"><?php echo $key["partnumber_product"] != '' ? "[" . $key["partnumber_product"] . "]" : "" ?></span>
                                            <?php echo $key["warranty"] != NULL ? "<br>- Garansi : " . $key["warranty"] : ""; ?>
                                        </a>
                                    </div>
                                    <div class="col-xs-3">
                                        <a class="btn btn-lingkaran btn-sm btn-default delproduct pull-right"
                                            data-rowid="<?php echo $key["rowid"] ?>" data-produk="<?php echo $key["id"] ?>"
                                            data-rowid="<?php echo $key["rowid"] ?>" data-qty="0"><i
                                                class="bi bi-trash f12 fred"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 m-b-1">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h6>Metode Pembayaran :</h6>
                                    </div>
                                    <div class="col-xs-4">
                                        <form id="formquantity<?php echo $form ?>">
                                            <select class="form-control method input-sm pull-right"
                                                data-rowid="<?php echo $key["rowid"] ?>" data-qty="<?php echo $key["qty"] ?>"
                                                data-produk="<?php echo $key["id"] ?>">
                                                <?php


                                                echo '<option ' . ($key['method'] == 'cod' ? 'selected="selected"' : '') . ' value="cod">COD</option>';
                                                echo '<option ' . ($key['method'] == 'cbd' ? 'selected="selected"' : '') . ' value="cbd">CBD</option>';

                                                ?>
                                                }
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 m-b-1">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h6><?php echo $this->lang->line('table_column_qty', FALSE); ?> :</h6>
                                        <span class="text-muted f12">Stock :<?php echo $key["stock"]; ?></span>
                                    </div>
                                    <div class="col-xs-4">
                                        <form id="formquantity<?php echo $form ?>">
                                            <select class="form-control quantity input-sm"
                                                data-rowid="<?php echo $key["rowid"] ?>"
                                                data-method="<?php echo $key["method"] ?>"
                                                data-produk="<?php echo $key["id"] ?>">
                                                <?php
                                                $select = "";
                                                for ($stock = $key["moq"]; $stock <= $key["stock"]; $stock += $key["moq"]) {
                                                    if ($key["qty"] == $stock) {
                                                        $select = "selected";
                                                    } else {
                                                        $select = "";
                                                    }
                                                    echo '<option ' . $select . '>' . $stock . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <h6 class="pull-right">Rp <?php $totalprice = $key["price"] * $key["qty"];
                                                            $total = $total + $totalprice;
                                                            echo number_format($totalprice, 0, ',', '.') ?></h6>
                                <h6><?php echo $this->lang->line('table_column_price', FALSE); ?> : </h6>
                            </div>
                            <div class="col-xs-12">
                                <hr class="hr-solid">
                            </div>
                            <?php
                            $totalpxyz = $key["px"] * $key["py"] * $key["pz"];
                            $totaldimensi = $totaldimensi + $totalpxyz;
                            $quantity = $quantity + $key["qty"];
                            $totalw = $key["qty"] * str_replace(',', '.', $key["weight"]);
                            $totalweight = $totalweight + $totalw;
                            ?>
                        <?php endforeach ?>
                        <div class="col-xs-12">
                            <h6 class="pull-right fbold">Rp <?php echo number_format($total, 0, ',', '.') ?></h6>
                            <h6 class="fbold"><?php echo $this->lang->line('table_column_total', FALSE); ?> : </h6>
                        </div>
                    </div>
                </div>
                <a href=" <?php echo site_url('cart/shipping'); ?>" class="btn btnnew pull-right fbold">Selanjutnya
                    &raquo;</a>
            </div>
        <?php else : ?>
            <div class="col-xs-12 vertical-center text-center">
                <img src="<?php echo base_url() ?>public/icon/icon-empty-cart.png" class="img-fluid"
                    style="margin: auto; width:70%;">
                <h6 class="fbold forange f14"><?php echo $this->lang->line('konten_empty_cart', FALSE); ?></h6><br>
                <a href="<?php echo base_url() ?>" class="btn btnnew m-b-2">Ayo Berbelanja!</a>
                <!-- <img src="<?php echo base_url() ?>public/image/icon/icon-kemudahan.png" class="img-fluid center" style="margin: auto;"> -->
                <!-- <hr> -->
            </div>
        <?php endif ?>
        <!-- <div class="row ">
					<div class="col-xs-3 col-md-3">
					</div>
					<div class="col-xs-6 col-md-6 col-sm-12 col-xs-12 text-center vertical-center">
						<strong class="f12 fbold forange">Pembayaran</strong>
						<img class="img-fluid" src="<?php echo base_url() ?>public/image/icon/bank+debit.png" alt="Trumecs" style="margin: auto;">
					</div>
				</div> -->
    </div>
</div>
<style>
    .btn-lingkaran {
        background-color: transparent;
        color: orange;
        font-size: 20px;
    }
</style>