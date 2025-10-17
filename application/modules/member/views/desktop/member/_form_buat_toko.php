<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];
?>
<section id="form-toko" class="form-toko">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="fbold">Form Buka Akun Bisnis</h4>
                </div>
                <form action="<?php echo base_url() ?>member/store/store_register" method="post" class="storeregister" enctype="multipart/form-data">
                    <div class="card-body p-a-1">
                        <div class="row d-flex flex-column gap-3">
                            <input type="hidden" name="id_member" value="<?php echo $sessionmember["id"]; ?>" />
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="nameToko">Nama Toko</label>
                                    <input id="nameToko" type="text" name="name" class="form-control" placeholder="Nama Toko" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="domain">Domain</label>
                                    <input id="domain" type="text" name="domain" class="form-control" placeholder="Domain" required>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="npwp">NPWP</label>
                                    <input id="npwp" type="text" name="npwp" class="form-control" placeholder="NPWP" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" name="company_email" class="form-control" placeholder="Email Perusahaan" required>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="phone">Telepon</label>
                                    <input id="phone" type="text" name="company_phone" class="form-control" placeholder="Telepon Perusahaan" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="pic">PIC</label>
                                    <input id="pic" type="text" name="pic" class="form-control" placeholder="PIC Toko" required>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="picPosition">Jabatan PIC</label>
                                    <input id="picPosition" type="text" name="position" class="form-control" placeholder="PIC Toko" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="picPhone">Nomor Telepon PIC</label>
                                    <input id="picPhone" type="text" name="phone_pic" class="form-control" placeholder="nomor PIC Toko" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Deskripsi Toko</label>
                                <textarea data-title="Deskripsi Toko" data-hint="Jelaskan tentang toko anda" type="text" name="description_store" class="form-control" placeholder="Deskripsi Toko" style="height: 100px;" required></textarea>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="country">Negara</label>
                                    <select id="country" name="country" class="form-control" required id="<?php echo $sessionmember["provice"] ?>">
                                        <option value="">--Pilih Negara--</option>
                                        <option value="1">Indonesia</option>
                                        <option value="2">Singapura</option>
                                        <option value="3">Malaysia</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="province">Provinsi</label>
                                    <select name="province" class="form-control" required id="<?php echo $sessionmember["provice"] ?>">
                                        <option value="">--Pilih Provinsi--</option>
                                        <?php foreach ($provinces as $key) : ?>
                                            <option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="district">Kabupaten</label>
                                    <select name="city" class="form-control" required id="<?php echo $sessionmember["city"] ?>">
                                        <option value="">--Pilih Kabupaten--</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="address">Alamat</label>
                                    <input id="address" type="text" name="address" value="<?php echo $sessionmember["address"] ?>" class="form-control" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6">
                                    <label for="zipCode">Kode Pos</label>
                                    <input id="zipCode" type="number" name="zipcode" value="<?php echo $sessionmember["kodepos"] ?>" class="form-control" placeholder="Kode Pos" required>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="logo" class="m-b-0">Logo</label>
                                            <input id="logo" type="file" id="uploadBtn" name="logo" class="form-control pointer" style="opacity: 0;filter: alpha(opacity=0);">
                                            <a href="#" id="filetext" name="file" class="btn btnnew pointer" style="margin-top:-50px;">Pilih file</a>
                                        </div>
                                        <div class="col-lg-8 p-l-0" style="margin-left: -10px;">
                                            <img src="" class="blah img-fluid" style="max-height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="<?= base_url() ?>member/buat_toko" class="btn btn-default">Kembali</a>
                        <button class="btn btnnew" modal-text="Data Anda sedang disimpan" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>