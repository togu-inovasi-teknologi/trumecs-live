<?php
/* foreach ($data_product as $key ) {}
$lfp=strlen($key["img"]);
$ext=substr($key["img"], $lfp-4);
is_file("public/image/product/".$key["img"])!=1 ? $key["img"]="--" : $key["img"] ;
$img_promo= '<img class="labelimg hidden-sm-down" src="'.base_url().'/public/image/promo_specialoffer.png" width="120">';
 */
?>
<div id="page_detail">
    <?php if ($this->agent->is_mobile()) : ?>
        <div class="space">
            <div class="clearfix"></div>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="product col-xs-6 col-xs-offset-3">
                <div class="">
                    <?php echo $this->session->flashdata('form_error'); ?>
                    <h3>Jelaskan kepada saya produk-produk dari Trumecs</h3>
                    <!--<p class="text-muted">Silahkan isi formulir di bawah ini:</p>-->
                    <div class="clearfix"></div>
                    <!-- <form class="m-y-2" method="post" action="<?php echo base_url('product/prospek/set_kontak/' . $key['id']); ?>"> -->
                    <form class="m-y-2" method="post" action="<?php echo base_url('product/prospek/set_kontak/'); ?>">
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong>Perusahaan</strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="company" placeholder="Perusahaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong>Nama</strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="name" placeholder="Nama anda">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong>Telepon Kantor / HP</strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="company_phone" placeholder="Telepon kantor / HP">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-4"><strong>Email</strong></label>
                            <div class="col-xs-8">
                                <input class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Kapan waktu yang tepat untuk menghubungi anda?</strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="preferred_time" placeholder="Jumat 3 Desember jam 13.00">
                                <small class="form-helper">*) Kami akan menghubungi anda pada hari Senin - Jumat pukul 08.00 - 17.00 WIB</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input type="checkbox" name="agreement" value="1"> Data yang saya isikan di atas adalah benar
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12 text-center">
                                <!-- <a href="<?php echo site_url('product/' . $key['id'] . '/' . preg_replace("/[^a-zA-Z0-9]/", "-", $key["tittle"])); ?>" class="btn btn-white">Batal</a> -->
                                <button class="btn btn-orange">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>