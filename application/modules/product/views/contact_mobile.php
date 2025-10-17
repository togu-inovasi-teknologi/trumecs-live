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
        <div class="">
            <div class="product col-xs-12">
                <?php echo $this->session->flashdata('form_error'); ?>
                <h3>Jelaskan kepada saya produk-produk dari Trumecs</h3>
                <br />
                <div>
                    <form class="" method="post" action="<?php echo base_url('product/prospek/set_kontak/'); //.$key['id']); 
                                                            ?>">
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Perusahaan</strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="company" placeholder="Perusahaan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Nama</strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="name" placeholder="Nama anda" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Telepon Kantor / HP</strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="company_phone" placeholder="Telepon kantor / HP" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Email</strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-xs-12"><strong>Kapan waktu yang tepat untuk menghubungi anda?</strong></label>
                            <div class="col-xs-12">
                                <input class="form-control" name="preferred_time" placeholder="Jumat 3 Desember jam 13.00" required type="date">
                            </div>
                            <small class="form-helper">*) Kami akan menghubungi anda pada hari Senin - Jumat pukul 08.00 - 17.00 WIB</small>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input type="checkbox" name="agreement" value="1" required> <span>Data yang saya isikan di atas adalah benar</span>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div style="display:inline-block" class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button class="btn btn-orange col-xs-12 btn-lg">Kirim</button>
                                <br />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>