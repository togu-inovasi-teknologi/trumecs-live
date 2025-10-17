<?php foreach ($data_product as $key) {
}
$lfp = strlen($key["img"]);
$ext = substr($key["img"], $lfp - 4);
is_file("public/image/product/" . $key["img"]) != 1 ? $key["img"] = "--" : $key["img"];
$img_promo = '<img class="labelimg hidden-sm-down" src="' . base_url() . '/public/image/promo_specialoffer.png" width="120">';

?>
<div id="page_detail">
    <?php if ($this->agent->is_mobile()) : ?>
        <div class="space">
            <div class="clearfix"></div>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="">
            <div class="product col-xs-12">
                <div class="">
                    <?php echo $this->session->flashdata('form_error'); ?>
                    <h3><?php echo $this->lang->line('judul_halaman_buy', FALSE); ?></h3>
                    <p class="text-muted"><?php echo $this->lang->line('subjudul_halaman_buy', FALSE); ?>:</p>
                    <div class="clearfix"></div>
                    <form class="buy-form" method="post" action="<?php echo base_url('product/prospek/set_buy/' . $key['id']); ?>">
                        <div class="form-group row">
                            <h4 class="col-xs-10"><?php echo $this->lang->line('label_item', FALSE); ?></h4>
                            <h4 class="col-xs-2"><?php echo $this->lang->line('label_qty', FALSE); ?></h4>
                        </div>
                        <div class="group-item">
                            <div class="form-group row">
                                <div class="col-xs-10">
                                    <select name="id_produk[]" class="js-example-basic-single form-control" placeholder="Nama produk">
                                        <option value="">-- <?php echo $this->lang->line('placeholder_select_item', FALSE); ?> --</option>
                                        <option value="<?php echo $key["id"] ?>" selected><?php echo $key["tittle"] ?></option>
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <input type="number" name="qty[]" class="form-control" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button type="button" class="pull-right btn btn-primary btn-add-item"><span class="fa fa-plus-circle"></span> <?php echo $this->lang->line('tombol_tambah_item', FALSE); ?></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 class="col-xs-12"><?php echo $this->lang->line('label_item_tambahan', FALSE); ?></h4>
                            <p class="form-help col-xs-12 text-muted"><?php echo $this->lang->line('helper_item_tambahan', FALSE); ?></p>
                            <div class="col-xs-12">
                                <textarea name="item_tambahan" class="form-control"></textarea>
                            </div>
                        </div>
                        <br />
                        <h4>Perusahaan</h4>
                        <hr />
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_perusahaan', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="company" placeholder="<?php echo $this->lang->line('placeholder_input_perusahaan', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_alamat_perusahaan', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <textarea class="form-control" name="company_address" placeholder="<?php echo $this->lang->line('placeholder_input_alamat_perusahaan', FALSE); ?>" rows="6" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-8  col-xs-offset-4">
                                <select class="form-control" name="province" placeholder="Nama Provinsi" style="margin-bottom:10px" required>
                                    <option>-- <?php echo $this->lang->line('placeholder_select_provinsi', FALSE); ?> --</option>
                                    <?php foreach ($provinsi->result() as $item) : ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control" name="regency" placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- <?php echo $this->lang->line('placeholder_select_kabupaten', FALSE); ?> --</option>
                                    <?php foreach ($regency->result() as $item) : ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="form-control" name="district" placeholder="Nama kota" style="margin-bottom:10px" required>
                                    <option>-- <?php echo $this->lang->line('placeholder_select_kecamatan', FALSE); ?> --</option>
                                    <?php foreach ($district->result() as $item) : ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_phone_perusahaan', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="company_phone" placeholder="<?php echo $this->lang->line('placeholder_input_phone_perusahaan', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_email_perusahaan', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="email" placeholder="<?php echo $this->lang->line('placeholder_input_email_perusahaan', FALSE); ?>" required>
                            </div>
                        </div>
                        <br />
                        <h3>PIC</h3>
                        <hr />
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_nama', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="name" placeholder="<?php echo $this->lang->line('placeholder_input_nama', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_posisi', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="position" placeholder="<?php echo $this->lang->line('placeholder_input_posisi', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_phone', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="phone" placeholder="<?php echo $this->lang->line('placeholder_input_phone', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_email', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="email" placeholder="<?php echo $this->lang->line('placeholder_input_email', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_kontak_via', FALSE); ?>:</strong></label>
                            <div class="col-xs-12">
                                <label>
                                    <input type="radio" name="method" value="1" required> <?php echo $this->lang->line('placeholder_radio_email', FALSE); ?>
                                </label>
                                <!-- <br/>
                                <label>
                                    <input type="radio" name="method" value="2" required> Marketing
                                </label> -->
                                <!-- <br/>
                                <label>
                                    <input type="radio" name="method" value="3" required> Trumecs
                                </label> -->
                                <br />
                                <label>
                                    <input type="radio" name="method" value="4" required> <?php echo $this->lang->line('placeholder_radio_whatsapp', FALSE); ?>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input type="checkbox" name="agreement" value="1" required> <?php echo $this->lang->line('label_confirmation', FALSE); ?>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12 text-center">
                                <a href="<?php echo site_url('product/' . $key['id'] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", $key["tittle"])); ?>" class="btn btn-white"><?php echo $this->lang->line('tombol_batal', FALSE); ?></a>
                                <button class="btn btn-orange"><?php echo $this->lang->line('tombol_kirim', FALSE); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>