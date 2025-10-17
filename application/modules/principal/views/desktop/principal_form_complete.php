<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('failed_updating_member') ?>
        </div>
        <div class="col-lg-12">
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $member->id ?>">
                <div class="card m-y-3 p-a-3">
                    <div class="row m-b-3">
                        <div class="col-lg-12">
                            <h4 class="fbold">1 Tahap Lagi Untuk Menjadi Principal Trumecs!</h4>
                            <span class="text-muted">Lengkapi Formulir di bawah ini!. </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Masukan nama lengkap anda" name="name"
                                    value="<?= set_value('name') == '' ? $member->name : set_value('name') ?>" required>
                                <span class="text-danger"><?= form_error('name') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?= set_value('email') == '' ? $member->email : set_value('email') ?>"
                                    id="email" placeholder="Masukan email anda" required>
                                <span class="text-danger"><?= form_error('email') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">No HP/WA</label>
                                <input type="text" class="form-control"
                                    value="<?= set_value('phone') == '' ? $member->phone : set_value('phone') ?>"
                                    id="phone" placeholder="Masukan no Telephone/WA anda" name="phone" required>
                                <span class="text-danger"><?= form_error('phone') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" value="<?= set_value('password') ?>"
                                    name="password" id="password" placeholder="**************">
                                <span class="text-danger"><?= form_error('password') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    id="confirm_password" value="<?= set_value('confirm_password') ?>"
                                    placeholder="**************">
                                <span class="text-danger"><?= form_error('confirm_password') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" value="<?= set_value('country') ?>"
                                    name="country" id="country" placeholder="Negara asal">
                                <span class="text-danger"><?= form_error('country') ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="company">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="company"
                                    placeholder="Masukan nama perusahaan anda" name="company"
                                    value="<?= set_value('company') == '' ? $member->Company : set_value('company')?>"
                                    required>
                                <span class="text-danger"><?= form_error('company') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="company_email">Company Email</label>
                                <input type="email" class="form-control" name="company_email"
                                    value="<?= set_value('company_email') == '' ? $member->company_email : set_value('company_email') ?>"
                                    id="company_email" placeholder="Masukan email perusahaan anda" required>
                                <span class="text-danger"><?= form_error('company_email') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="company_phone">No Telepon Perusahaan</label>
                                <input type="text" class="form-control"
                                    value="<?= set_value('company_phone') == '' ? $member->company_phone : set_value('company_phone') ?>"
                                    id="company_phone" placeholder="Masukan no telepone perusahaan"
                                    value="<?= set_value("company_phone") ?>" name="company_phone" required>
                                <span class="text-danger"><?= form_error('company_phone') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" class="form-control" value="<?= set_value("brand") ?>" name="brand"
                                    id="brand" placeholder="Masukan brand yang perusahaan anda pasarkan">
                                <span class="text-danger"><?= form_error('brand') ?></span>
                            </div>
                            <div class="form-group">
                                <label for="product">Product yang akan di pasarkan</label>
                                <input type="product" value="<?= set_value("product") ?>" class="form-control"
                                    name="product" id="product"
                                    placeholder="Product yang akan perusahaan anda pasarkan">
                                <span class="text-danger"><?= form_error('product') ?></span>
                            </div>

                            <?php if ($this->agent->is_mobile()) : ?>
                            <div class="form-group m-t-1">
                                <label><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
                                <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                                <span class="text-danger"><?= form_error('g-recaptcha-response') ?></span>
                            </div>
                            <?php else : ?>
                            <div class="form-group m-t-1">
                                <label><?php echo $this->lang->line("label_captcha", FALSE); ?></label>
                                <div class="g-recaptcha" data-sitekey="6LcuyIoUAAAAAP1jwHjM_tSsmhn_KYMifBEPJfD0"></div>
                                <span class="text-danger"><?= form_error('g-recaptcha-response') ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">

                        <button type="submit" class="btn btnnew col-lg-12">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>