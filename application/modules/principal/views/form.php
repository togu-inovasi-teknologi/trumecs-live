<div id="page_detail">
    <div class="row">
        <div class="col-lg-7">
            <div class="col-xs-12 p-a-3" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                <h1 class="fbold"><?php echo $this->lang->line('judul_halaman_principal') ?></h1>
                <br />
                <h2><?php echo $this->lang->line('subjudul_halaman_principal') ?></h2>
                <p class="f18"></p>
                <br />
                <h3 class="f18 "><span class="bi bi-check-circle"></span> <?php echo $this->lang->line('point_principal_1') ?></h3>
                <br />
                <h3 class="f18 "><span class="bi bi-check-circle"></span> <?php echo $this->lang->line('point_principal_2') ?></h3>
                <br />
                <h3 class="f18"><span class="bi bi-check-circle"></span> <?php echo $this->lang->line('point_principal_3') ?></h3>
                <br />
                <h3 class="f18"><span class="bi bi-check-circle"></span> <?php echo $this->lang->line('point_principal_4') ?></h3>
                <br />
            </div>
        </div>
        <div class="col-lg-5 ">
            <div class="product row" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                <div class="col-md-12 p-a-3">
                    <?php echo $this->session->flashdata('form_error'); ?>
                    <h2><?php echo $this->lang->line('judul_form_principal') ?></h2>
                    <br />
                    <p class="text-muted"><?php echo $this->lang->line('subjudul_form_principal') ?>:</p>
                    <form class="m-y-2" method="post" action="<?php echo base_url('principal/save'); ?>">
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_nama') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="name" placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>" value="<?php echo $user_data['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_phone') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="phone" placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>" value="<?php echo $user_data['phone'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_email') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="email" placeholder="<?php echo $this->lang->line('placeholder_input_email') ?>" <?php echo $user_data['email'] ?> required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_perusahaan') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="company" placeholder="<?php echo $this->lang->line('placeholder_input_perusahaan') ?>" <?php echo $user_data['company'] ?> required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_jenis_produk') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="product" placeholder="<?php echo $this->lang->line('placeholder_input_jenis_produk') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_brand') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="brand" placeholder="<?php echo $this->lang->line('placeholder_input_brand') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_negara_asal') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="country" placeholder="<?php echo $this->lang->line('placeholder_input_negara_asal') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_penjelasan_produk') ?></strong></label>
                            <div class="col-xs-12">
                                <textarea class="form-control" name="additional_info" placeholder="<?php echo $this->lang->line('placeholder_input_penjelasan_produk') ?>" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input type="checkbox" name="agreement" value="1" required> <?php echo $this->lang->line('label_confirmation') ?>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12 text-center">
                                <button class="btn col-lg-12 btn-orange"><?php echo $this->lang->line('tombol_kirim') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>