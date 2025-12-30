<div id="page_detail">
    <div class="row">
        <div class="col-lg-12 ">
            <!--<ol class="breadcrumb " itemscope itemtype="http://schema.org/BreadcrumbList">
		    	<li><a class="forange" href="<?php echo base_url() ?>">Home</a></li>
		    	<li><span>Form tender</span></li>
		    </ol>-->
            <!--<div class="col-xs-4">
                <div class="row">
                    <div class="card border-success">
                        <div class="card-body">
                            <div class="card-header btn-orange text-warning fbold">Mengapa bermitra dengan Trumecs?</div>
                        </div>
                        <div class="alert alert-warning" style="margin-bottom:0px;">
                            <span class="bi bi-check-circle f22"></span> &nbsp;Terima penawaran terbaik dari ribuan supplier terpercaya kami
                            <br/>
                            <br/>
                            <span class="bi bi-check-circle f22"></span> &nbsp;Transaksi aman, dapatkan Invoice & E-Faktur yang sudah termasuk PPN 10
                            <br/>
                            <br/>
                            <span class="bi bi-check-circle f22"></span> &nbsp;Cepat, efisien, dan menghemat waktu Anda karena tidak perlu melakukan pengecekan email satu per satu
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="product row">
                <div class="col-md-offset-3 col-md-6">
                    <?php echo $this->session->flashdata('form_error'); ?>
                    <h3 class=""><?php echo $this->lang->line('judul_halaman_tender', FALSE); ?></h3>
                    <br />
                    <p>
                        <?php echo $this->lang->line('subjudul_form_tender', FALSE); ?>
                    </p>
                    <p class="text-muted"><?php echo $this->lang->line('penjelasan_form_tender', FALSE); ?>:</p>
                    <form class="m-y-2" method="post" action="<?php echo base_url('product/prospek/set_tender/'); ?>">
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_perusahaan', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="company" placeholder="<?php echo $this->lang->line('placeholder_input_perusahaan', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_bidang_usaha', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="company_field" placeholder="<?php echo $this->lang->line('placeholder_bidang_usaha', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_nama_pic', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="name" placeholder="<?php echo $this->lang->line('placeholder_nama_pic', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_phone_perusahaan', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="phone" placeholder="<?php echo $this->lang->line('placeholder_input_phone_perusahaan', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_email', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="email" placeholder="<?php echo $this->lang->line('placeholder_input_email', FALSE); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_waktu_pendaftaran', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="due_date" placeholder="Batas waktu submit" required type="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong><?php echo $this->lang->line('label_deskripsi_produk', FALSE); ?></strong></label>
                            <div class="col-xs-8">
                                <textarea class="form-control" name="product" placeholder="<?php echo $this->lang->line('placeholder_deskripsi_produk', FALSE); ?>" required></textarea>
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
                                <button class="btn btn-orange"><?php echo $this->lang->line('tombol_kirim', FALSE); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>