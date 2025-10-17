<form class="row" id="form-verification" method="POST" action="<?= base_url('member/store/verification_store') ?>">
    <div class="col-lg-12">
        <p>Pilih Jenis Usaha</p>
        <div class="row">
            <div class="radio col-lg-4">
                <label>
                    <input type="radio" name="jenis_usaha" id="optionsRadios1" value="1" checked>
                    Individu / Perorangan
                </label>
            </div>
            <div class="radio col-lg-4">
                <label>
                    <input type="radio" name="jenis_usaha" id="optionsRadios2" value="2">
                    Perusahaan
                </label>
            </div>
        </div>
        <div class="row m-y-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telepon</label>
                            <input type="text" class="form-control" name="telephone" id="telephone"
                                placeholder="Nomor Telepon Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="product">Product Anda</label>
                            <input type="text" class="form-control" id="product" name="products"
                                placeholder="Produk Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand Yang Anda Jual</label>
                            <input type="text" class="form-control" id="brand" name="brands"
                                placeholder="Brand yang anda jual" required>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="country">Negara asal produk anda</label>
                            <input type="text" class="form-control" id="country" name="countries"
                                placeholder="Negara asal produk anda" required>
                        </div>

                        <div class="form-group">
                            <label for="website">Website Anda</label>
                            <input type="text" class="form-control" id="website"
                                placeholder="Masukan alamat website anda" name="website">
                        </div>
                        <div class="form-group">
                            <label for="industry">Industri</label>
                            <input type="text" class="form-control" id="industry"
                                placeholder="Masukan jenis industry usaha anda" name="industry" required>
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="text" class="form-control" id="npwp" name="npwp"
                                placeholder="Masukan nomor npwp anda" required>
                        </div>
                        <div class="form-group">
                            <label for="additional_info">Jelaskan produk dan perusahaan anda</label>
                            <textarea type="text" name="additional_info" class="form-control" id="additional_info"
                                placeholder="Jelaskan produk dan perusahaan anda"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <p class="font-weight-bold">Informasi Alamat</p>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="billing_country">Negara</label>
                    <input type="text" class="form-control" name="billing_country" id="billing_country"
                        placeholder="Negara" required>
                </div>
                <div class="form-group">
                    <label for="billing_province">Provinsi</label>
                    <input type="text" class="form-control" name="billing_province" id="billing_province"
                        placeholder="Provinsi" required>
                </div>
                <div class="form-group">
                    <label for="billing_regency">Kota / Kabupaten</label>
                    <input type="text" class="form-control" name="billing_regency" id="billing_regency"
                        placeholder="Kota / Kabupaten" required>
                </div>
                <div class="form-group">
                    <label for="billing_district">Kecamatan</label>
                    <input type="text" class="form-control" name="billing_district" id="billing_district"
                        placeholder="Kecataman" required>
                </div>
                <div class="form-group">
                    <label for="billing_village">Keluarahan / Desa</label>
                    <input type="text" class="form-control" name="billing_village" id="billing_village"
                        placeholder="Kecataman" required>
                </div>
                <div class="form-group">
                    <label for="billing_code">Kode Pos</label>
                    <input type="text" class="form-control" name="billing_code" id="billing_code" placeholder="Kode Pos"
                        required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="shipping_country">Negara Pengiriman</label>
                    <input type="text" class="form-control" name="shipping_country" id="shipping_country"
                        placeholder="Negara" required>
                </div>
                <div class="form-group">
                    <label for="shipping_province">Provinsi Pengiriman</label>
                    <input type="text" class="form-control" name="shipping_province" id="shipping_province"
                        placeholder="Provinsi" required>
                </div>
                <div class="form-group">
                    <label for="shipping_regency">Kota / Kabupaten Pengiriman</label>
                    <input type="text" class="form-control" name="shipping_regency" id="shipping_regency"
                        placeholder="Kota / Kabupaten" required>
                </div>
                <div class="form-group">
                    <label for="shipping_district">Kecamatan Pengiriman</label>
                    <input type="text" class="form-control" name="shipping_district" id="shipping_district"
                        placeholder="Kecataman" required>
                </div>
                <div class="form-group">
                    <label for="shipping_village">Keluarahan / Desa Pengiriman</label>
                    <input type="text" class="form-control" name="shipping_village" id="shipping_village"
                        placeholder="Kecataman" required>
                </div>
                <div class="form-group">
                    <label for="shipping_code">Kode Pos Pengiriman</label>
                    <input type="text" class="form-control" name="shipping_code" id="shipping_code"
                        placeholder="Kode Pos" required>
                </div>
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">Kirim Data Verifikasi</button>
            </div>
        </div>
    </div>
</form>