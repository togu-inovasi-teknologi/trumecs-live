<!--Start Page-->
<div class="cart_page <?php echo ($this->agent->is_mobile()) ? "row" : ""; ?>">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) : ?>
        <?php else : ?>
            <ol class="breadcrumb p-x-0">
                <li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
                <li><?php echo $this->lang->line('judul_halaman_cart', FALSE); ?></li>
            </ol>
        <?php endif ?>
        <div class="row">
            <div class="col-lg-12 title-desktop">
                <h3 class="title-content"><?php echo $this->lang->line('judul_halaman_cart', FALSE); ?></h3>
            </div>
            <div class="col-lg-12">
                <?php if (count($this->cart->contents()) != 0) : ?>
                    <div class="row">
                        <div class="col-lg-12 <?php echo ($this->agent->is_mobile()) ? "p-x-0 table-responsive" : ''; ?>">
                            <?php echo ($this->session->flashdata('message') == "") ? "" :
                                '<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
                                $this->session->flashdata('message') .
                                '</div>'; ?>
                            <div class="card" style="border-color:#fa8420">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <table class="table text-left table-bordered table-striped m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th><strong><?php echo $this->lang->line('table_column_product', FALSE); ?></strong>
                                                        </th>
                                                        <th width="120px"><strong><?php //echo $this->lang->line('table_column_qty', FALSE); 
                                                                                    ?>Metode Pembayaran</strong></th>
                                                        <th width="120px">
                                                            <strong><?php echo $this->lang->line('table_column_qty', FALSE); ?></strong>
                                                        </th>
                                                        <th class="text-center" width="200px">
                                                            <strong><?php echo $this->lang->line('table_column_price', FALSE); ?></strong>
                                                        </th>
                                                        <th width="30px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    $totalw = 0;
                                                    $totalweight = 0;
                                                    $quantity = 0;
                                                    $totaldimensi = 0;
                                                    $form = 1;
                                                    ?>
                                                    <?php foreach ($this->cart->contents() as $key) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-lg-2">
                                                                        <img src="<?php echo $key['image']; ?>"
                                                                            alt="<?php echo $key["name"]; ?>">
                                                                    </div>
                                                                    <div class="col-lg-10">
                                                                        <a class="f14"
                                                                            href="<?php echo base_url() ?>product/<?php echo $key["id"] ?>/<?php echo preg_replace("/[^A-Za-z0-9\-]/", "-", str_replace(" ", "-", ucwords($key["name"]))) ?>">
                                                                            <?php echo ucwords($key["name"]) ?><br />
                                                                            <span
                                                                                class="f12 text-muted"><?php echo $key["partnumber_product"] != '' ? "[" . $key["partnumber_product"] . "]" : "" ?></span>
                                                                            <?php echo $key["warranty"] != NULL ? "<br>- Garansi : " . $key["warranty"] : ""; ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <form id="formquantity<?php echo $form ?>">
                                                                    <select class="form-control method input-sm"
                                                                        data-rowid="<?php echo $key["rowid"] ?>"
                                                                        data-qty="<?php echo $key["qty"] ?>"
                                                                        data-produk="<?php echo $key["id"] ?>">
                                                                        <?php


                                                                        echo '<option ' . ($key['method'] == 'cod' ? 'selected="selected"' : '') . ' value="cod">COD</option>';
                                                                        echo '<option ' . ($key['method'] == 'cbd' ? 'selected="selected"' : '') . ' value="cbd">CBD</option>';

                                                                        ?>
                                                                        }
                                                                    </select>
                                                                </form>
                                                            </td>
                                                            <td>
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
                                                                        }
                                                                    </select>
                                                                </form>
                                                            </td>
                                                            <td class="text-right f16">Rp <?php $totalprice = $key["price"] * $key["qty"];
                                                                                            $total = $total + $totalprice;
                                                                                            echo number_format($totalprice, 0, ',', '.') ?></td>
                                                            <td class="text-center"><a
                                                                    class="btn btn-lingkaran  btn-sm btn-default delproduct"
                                                                    data-rowid="<?php echo $key["rowid"] ?>"
                                                                    data-produk="<?php echo $key["id"] ?>"
                                                                    data-rowid="<?php echo $key["rowid"] ?>" data-qty="0"><i
                                                                        class="bi bi-trash f12 fred"></i></a>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $totalpxyz = $key["px"] * $key["py"] * $key["pz"];
                                                        $totaldimensi = $totaldimensi + $totalpxyz;
                                                        $quantity = $quantity + $key["qty"];
                                                        $totalw = $key["qty"] * str_replace(',', '.', $key["weight"]);
                                                        $totalweight = $totalweight + $totalw;
                                                        ?>
                                                    <?php endforeach ?>
                                                    <tr>
                                                        <td colspan="3"><strong
                                                                class="f18"><?php echo $this->lang->line('table_column_total', FALSE); ?></strong>:
                                                        </td>
                                                        <td class="f18 text-right"><strong>Rp
                                                                <?php echo number_format($total, 0, ',', '.') ?></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href=" <?php echo site_url('cart/shipping'); ?>"
                                class="btn btnnew pull-right fbold">Selanjutnya &raquo;</a>
                        </div>

                    </div>
                <?php else : ?>
                    <div class="row ">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12  vertical-center text-center">
                            <img src="<?php echo base_url() ?>public/icon/icon-empty-cart.png" class="img-fluid"
                                style="margin: auto; width:20%;">
                            <h5 class="fbold forange"><?php echo $this->lang->line('konten_empty_cart', FALSE); ?></h5><br>
                            <a href="<?php echo base_url() ?>" class="btn btnnew m-b-2">Ayo Berbelanja!</a>
                            <!-- <img src="<?php echo base_url() ?>public/image/icon/icon-kemudahan.png" class="img-fluid center" style="margin: auto;">
							<hr> -->
                        </div>
                    </div>
                <?php endif ?>
                <!-- <div class="row ">
					<div class="col-lg-3 col-md-3">
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center vertical-center">
						<strong class="f12 fbold forange">Pembayaran</strong>
						<img class="img-fluid" src="<?php echo base_url() ?>public/image/icon/bank+debit.png" alt="Trumecs" style="margin: auto;">
					</div>
				</div> -->
            </div>
        </div>
    </div>
</div>
<style>
    .btn-lingkaran {
        background-color: transparent;
        color: orange;
        font-size: 20px;
    }
</style>