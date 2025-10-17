<div id="page_detail">
	<div class="row">
		<div class="col-lg-12 ">
			<div class="product m-t-2">
                <div class="col-xs-12 p-a-3" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                    <h1 class="fbold" style="font-size:28px"><?php echo $this->lang->line('judul_halaman_agen') ?></h1>
                    <p class="m-t-2 f18" ><?php echo $this->lang->line('konten_judul_halaman_agen') ?></p>
                    <br />
                    <h2 style="font-size:24px"><?php echo $this->lang->line('subjudul_halaman_agen') ?></h2>
                    <p class="f18"><?php echo $this->lang->line('konten_subjudul_halaman_agen') ?></p> 
                    <br/>
                    <h3 class="f18 fbold"><span class="fa fa-check-circle"></span> <?php echo $this->lang->line('point_agen_1') ?></h3>
                    <br/>
                    <h3 class="f18 fbold"><span class="fa fa-check-circle"></span> <?php echo $this->lang->line('point_agen_2') ?></h3>
                    <br/>
                    <h3 class="f18 fbold"><span class="fa fa-check-circle"></span> <?php echo $this->lang->line('point_agen_3') ?></h3>
                    <br/>
                    <h3 class="f18 fbold"><span class="fa fa-check-circle"></span> <?php echo $this->lang->line('point_agen_4') ?></h3>
                    <br/>
                    <h3 class="f18 fbold"><span class="fa fa-check-circle"></span> <?php echo $this->lang->line('point_agen_5') ?></h3>
                    <br/>
                    <h3 class="f18 fbold"><span class="fa fa-check-circle"></span> <?php echo $this->lang->line('point_agen_6') ?></h3>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 m-t-2 p-a-2" style="background:#fff;box-shadow:0px 3px 7px rgba(0,0,0,0.05);overflow:hidden;border-radius:5px">
                    <?php echo $this->session->flashdata('form_error'); ?>
                    <h3 class=""><?php echo $this->lang->line('judul_form_agen') ?></h3>
                    <br/>
                    <p class="text-muted"><?php echo $this->lang->line('subjudul_form_agen') ?>:</p>
                    <form class="m-y-2" method="post" action="<?php echo base_url('agent/save'); ?>">
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_nama') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="nama" placeholder="<?php echo $this->lang->line('placeholder_input_nama') ?>" value="<?php echo $user_data['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_phone') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="handphone" placeholder="<?php echo $this->lang->line('placeholder_input_phone') ?>" value="<?php echo $user_data['phone'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_email') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="email" placeholder="<?php echo $this->lang->line('placeholder_input_email') ?>" value="<?php echo $user_data['email'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_deskripsi_pekerjaan') ?></strong></label>
                            <div class="col-xs-12">
                                <textarea class="form-control" name="jobdesc" placeholder="<?php echo $this->lang->line('placeholder_input_deskripsi_pekerjaan') ?>" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_lingkup_industri') ?></strong></label>
                            <div class="col-xs-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="pemerintah">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_pemerintah') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="industri">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_industri') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="pelabuhan">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_pelabuhan') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="perkapalan">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_perkapalan') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="pertambangan">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_pertambangan') ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="perkebunan">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_perkebunan') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="transportasi">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_transportasi') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="kontraktor">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_kontraktor') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scope[]" value="oilgas">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_scope_oilgas') ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_domisili') ?></strong></label>
                            <div class="col-xs-12">
                                <textarea class="form-control" name="domisili" placeholder="<?php echo $this->lang->line('placeholder_input_domisili') ?>" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_daerah_cakupan') ?></strong></label>
                            <div class="col-xs-12">
                                <textarea class="form-control" name="area" placeholder="<?php echo $this->lang->line('placeholder_input_daerah_cakupan') ?>" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_produk_target') ?></strong></label>
                            <div class="col-xs-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="ban">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_produk_ban') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="aki">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_produk_aki') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="pelumas">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_produk_pelumas') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="sparepart">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_produk_sparepart') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="unit">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_produk_unit') ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_tanggal_bergabung') ?></strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="active_date"  required type="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong><?php echo $this->lang->line('label_status_agent') ?></strong></label>
                            <div class="col-xs-12">
                            <div class="form-check">
                                    <input type="radio" class="form-check-input" name="status" value="fulltime">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_status_fulltime') ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="status" value="parttime">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $this->lang->line('label_status_parttime') ?>
                                    </label>
                                </div>
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
                                <button class="btn btn-orange"><?php echo $this->lang->line('tombol_kirim') ?></button>
                            </div>
                        </div>
                    </form>
				</div>	
			</div>
		</div>
	</div>
</div>