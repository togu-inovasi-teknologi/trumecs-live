<div id="page_detail">
    <div class="row">
        <div class="col-lg-7 sticky">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-a-1">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="<?php echo base_url() ?>public/image/icon/icon-trumecs.png" />
                            </div>
                            <div class="col-lg-10">
                                <h2 class="fbold"><?php echo $this->lang->line('judul_halaman_principal') ?></h2>
                                <h3><?php echo $this->lang->line('subjudul_halaman_principal') ?></h3>
                            </div>
                            <div class="clearfix m-b-2"></div>
                            <hr class="hr-solid" />
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="<?php echo base_url() ?>public/icon/partnership/icon-item.png" style="width: 100%;" />
                                            </div>
                                            <div class="col-lg-9">
                                                <h3 class="f18 "><?php echo $this->lang->line('point_principal_1') ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="<?php echo base_url() ?>public/icon/partnership/icon-networking.png" style="width: 100%;" />
                                            </div>
                                            <div class="col-lg-9">
                                                <h3 class="f18 "><?php echo $this->lang->line('point_principal_2') ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix m-b-2"></div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="<?php echo base_url() ?>public/icon/partnership/icon-customer.png" style="width: 100%;" />
                                            </div>
                                            <div class="col-lg-9">
                                                <h3 class="f18 "><?php echo $this->lang->line('point_principal_3') ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="<?php echo base_url() ?>public/icon/partnership/icon-team.png" style="width: 100%;" />
                                            </div>
                                            <div class="col-lg-9">
                                                <h3 class="f18 "><?php echo $this->lang->line('point_principal_4') ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-a-1">
                        <?php echo $this->session->flashdata('form_error'); ?>
                        <h2><?php echo $this->lang->line('judul_form_principal') ?></h2>
                        <p class="text-muted"><?php echo $this->lang->line('subjudul_form_principal') ?>:</p>
                        <form class="m-y-2" method="post" action="<?php echo base_url('principal/save'); ?>">
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_nama') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="name" placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>" value="<?php echo $user_data['nama'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_phone') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="phone" placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>" value="<?php echo $user_data['phone'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_email') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="email" placeholder="<?php echo $this->lang->line('placeholder_input_email') ?>" <?php echo $user_data['email'] ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_perusahaan') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="company" placeholder="<?php echo $this->lang->line('placeholder_input_perusahaan') ?>" <?php echo $user_data['company'] ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_jenis_produk') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="product" placeholder="<?php echo $this->lang->line('placeholder_input_jenis_produk') ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_brand') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="brand" placeholder="<?php echo $this->lang->line('placeholder_input_brand') ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_negara_asal') ?></strong></label>
                                <div class="col-lg-12">
                                    <input class="form-control" name="country" placeholder="<?php echo $this->lang->line('placeholder_input_negara_asal') ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-12"><strong><?php echo $this->lang->line('label_penjelasan_produk') ?></strong></label>
                                <div class="col-lg-12">
                                    <textarea class="form-control" name="additional_info" placeholder="<?php echo $this->lang->line('placeholder_input_penjelasan_produk') ?>" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="checkbox" name="agreement" value="1" required> <?php echo $this->lang->line('label_confirmation') ?>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-block btnnew"><?php echo $this->lang->line('tombol_kirim') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>