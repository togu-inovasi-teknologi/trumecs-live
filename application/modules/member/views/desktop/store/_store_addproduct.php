<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];
?>
<div class="row m-b-1">
    <div class="col-lg" id="tambah-produk">
        <h3 class="fbold">Tambah Produk</h3>
    </div>
</div>
<div class="infoakun">
    <div class="row">
        <div class="col-lg">
            <div id="pilih-jenis-produk">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fbold">Pilih Jenis Produk</h5>
                    </div>
                    <div class="card-body p-a-1">
                        <div class="row d-flex p-x-1">
                            <div class="col-lg-4">
                                <div class="card p-t-1 text-center card-jenis-produk pj-produk" data-title="Pilih Jenis Produk" data-hint="Objek fisik yang dapat dibeli, dijual, atau diperdagangkan." data-value="is_sell">
                                    <img src="<?php echo base_url(); ?>public/icon/icon-barang.png" alt="Barang">
                                    <h5>Barang</h5>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card p-t-1 text-center card-jenis-produk pj-produk" data-title="Pilih Jenis Produk" data-hint="Jenis layanan yang ditawarkan, proses pelaksanaan, pengalaman pelanggan, dan harga jasa tersebut." data-value="is_service">
                                    <img src="<?php echo base_url(); ?>public/icon/icon-jasa.png" alt="Jasa">
                                    <h5>Jasa</h5>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card p-t-1 text-center card-jenis-produk pj-produk" data-title="Pilih Jenis Produk" data-hint="Objek fisik yang disediakan oleh penyewa untuk digunakan oleh pihak lain dalam jangka waktu tertentu dengan pembayaran sewa." data-value="is_rent">
                                    <img src="<?php echo base_url(); ?>public/icon/icon-rental.png" alt="Rental">
                                    <h5>Rental</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form-barang">
                <div class="card">
                    <form action="<?php echo base_url(); ?>member/store/upload_barang" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="is_sell" value="0">
                        <input type="hidden" name="is_rent" value="0">
                        <input type="hidden" name="is_service" value="0">
                        <div class="nama-barang" style="display:none;">
                            <input name="tipe_barang" type="hidden" value="barang" hidden>
                            <div class="card-header">
                                <h5 class="fbold">Informasi Barang</h5>
                            </div>

                            <div class="card-body p-a-1 d-flex flex-column gap-3">
                                <div class="col-lg-12">
                                    <label for="productPic" class="fbold">Foto Produk</label>
                                    <div id="productPic" class="d-flex-sb">
                                        <div class="col-lg-2--2 d-flex flex-column justify-content-center vertical-align-center text-center btn-upload-produk" style="border:2px dashed #ccc; height:107px;">
                                            <label for="img-1" class="pointer"><img class="img-prev-1" src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" /></label>
                                            <input type="file" name="images[]" id="img-1" class="d-none input-upload" data-id="1">
                                        </div>
                                        <div class="col-lg-2--2 d-flex flex-column justify-content-center vertical-align-center text-center btn-upload-produk" style="border:2px dashed #ccc; height:107px;">
                                            <label for="img-2" class="pointer"><img class="img-prev-2" src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" /></label>
                                            <input type="file" name="images[]" id="img-2" class="d-none input-upload" data-id="2">
                                        </div>
                                        <div class="col-lg-2--2 d-flex flex-column justify-content-center vertical-align-center text-center btn-upload-produk" style="border:2px dashed #ccc; height:107px;">
                                            <label for="img-3" class="pointer"><img class="img-prev-3" src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" /></label>
                                            <input type="file" name="images[]" id="img-3" class="d-none input-upload" data-id="3">
                                        </div>
                                        <div class="col-lg-2--2 d-flex flex-column justify-content-center vertical-align-center text-center btn-upload-produk" style="border:2px dashed #ccc; height:107px;">
                                            <label for="img-4" class="pointer"><img class="img-prev-4" src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" /></label>
                                            <input type="file" name="images[]" id="img-4" class="d-none input-upload" data-id="4">
                                        </div>
                                        <div class="col-lg-2--2 d-flex flex-column justify-content-center vertical-align-center text-center btn-upload-produk" style="border:2px dashed #ccc; height:107px;">
                                            <label for="img-5" class="pointer"><img class="img-prev-5" src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" /></label>
                                            <input type="file" name="images[]" id="img-5" class="d-none input-upload" data-id="5">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="productName" class="fbold">Nama Produk</label>
                                    <input id="productName" type="text" name="nama_barang" class="form-control" placeholder="Nama Produk" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="productType" class="fbold">Jenis Produk</label>
                                    <select name="jenis_barang" id="productType" class="form-control">
                                        <option value="">Semua Tipe</option>
                                        <?php foreach ($category as $item) : ?>
                                            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label for="productBrand" class="fbold">Merek Produk</label>
                                    <select id="productBrand" name="merek_barang" class="form-control">
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label for="productDescription" class="fbold">Deskripsi Produk</label>
                                    <ul class="f12">
                                        <li class='m-b-1'>Jelaskan cara penggunaan, deskripsi produk, spesifikasi,
                                            garansi dan lainnya dengan lengkap</li>
                                        <li>Hindari mencantumkan kontak pribadi atau nama/logolink/situs aplikasi lain
                                            pada produk</li>
                                    </ul>
                                    <textarea id="productDescription" type="text" name="description_barang" class="form-control" placeholder="Deskripsi Produk" style="height: 150px;" data-hint="<ul style='margin-left:-20px;'"></textarea>
                                </div>
                            </div>
                            <div class="card-footer d-flex-sb align-items-center">
                                <button type="button" class="prev-nama-barang btn btnnew">Kembali</button>
                                <button type="button" class="next-nama-barang btn btnnew">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="spesifikasi-barang d-none">
                            <div class="card-header">
                                <h5 class="fbold">Informasi Spesifikasi Barang</h5>
                            </div>
                            <div class="card-body p-a-1 d-flex flex-column gap-3">
                                <div class="d-flex-sb">
                                    <div class="col-lg-6">
                                        <label for="productCondition" class="fbold">Kondisi</label>
                                        <select id="productCondition" name="kondisi_barang" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="productUnit" class="fbold">Satuan</label>
                                        <input id="productUnit" name="satuan_barang" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row" id="spesification-space">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h6 class="fbold">Attribute Produk</h6>
                                    <button type="button" class="f14 m-b-1 add-att btn btnnewgreen"><i class="fa fa-plus" style="padding-top:2px;"></i> <span>Tambah
                                            Attribute</span></button>
                                    <div class="attribute-card"></div>
                                </div>
                                <div class="attr-form" hidden>
                                    <div class="row m-b-1 d-flex-ai-center">
                                        <div class="col-lg-5 d-flex flex-column gap-1">
                                            <label for="attributeName" class="fbold">Nama Attribute</label>
                                            <input id="attributeName" type="text" name="nama_attribute_barang[]" jq-model="atribut" class="form-control" placeholder="Nama Atribut">
                                            <span class="text-muted f12">Contoh : Warna, Part number, dll</span>
                                        </div>
                                        <div class="col-lg-5 d-flex flex-column gap-1">
                                            <label for="attributeValue" class="fbold">Nilai Atribute</label>
                                            <input id="attributeValue" type="text" name="nama_value_barang[]" jq-model="value" class="form-control" data-title="Nilai Atribut" placeholder="Nilai Atribut">
                                            <span class="text-muted f12">Contoh : Merah, K034933, dll</span>

                                        </div>
                                        <div class="col-lg-2" style="margin-left:-15px;">
                                            <button type="button" class="f16 del-att" style="color: red; padding:5px 10px;border: 1px solid red; border-radius:50%; background-color:transparent;"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex-sb align-items-center">
                                <button type="button" class="prev-spesifikasi-barang btn btnnew">Sebelumnya</button>
                                <button type="button" class="next-spesifikasi-barang btn btnnew">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="harga-barang d-none">
                            <div class="card-header">
                                <h5 class="fbold">Informasi Harga Barang</h5>
                            </div>
                            <div class="card-body p-a-1 d-flex flex-column gap-3">
                                <div class="col-lg-12">
                                    <label class="fbold">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="harga_barang" class="form-control uang" placeholder="Harga Jual">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="fbold">Minimum Pembelian</label>
                                            <input type="text" name="minimum_pembelian_barang" class="form-control" placeholder="Minimum Pembelian">
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="fbold">Stock</label>
                                            <input type="text" name="stock_barang" class="form-control" placeholder="Stock">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex-sb align-items-center">
                                <button type="button" class="prev-harga-barang btn btnnew">Sebelumnya</button>
                                <button type="submit" class="btn btnnew">Terbitkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="form-jasa">
                <div class="nama-jasa" style="display:none;">
                    <div class="col-lg-12">
                        <h5 class="fbold">Informasi Jasa</h5>
                    </div>
                    <div class="col-lg-12 form-upload-image-jasa" id="upload-image-jasa">
                        <h6 class="fbold">Foto Jasa</h6>
                        <div id="previews-jasa" class=""></div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-jasa" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img class=" src=" <?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" data-title="Tipe" data-hint="<ul style='margin-left:-20px;'>
								<li class='m-b-1'>Gunakan foto dengan cahaya cukup dan background yang jelas</li>
								<li class='m-b-1'>Rasio 1:1 (persegi)</li>
								<li>Hindari penambahan teks pada gambar</li>
								</ul>" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-jasa" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-jasa" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-jasa" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-jasa" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                    </div>
                    <div class="btn-upload-hide-jasa"></div>
                    <div class="table table-striped files">
                        <div id="template-jasa" class="file-row">
                            <div class="col-lg-2--2 p-a-0 text-center m-r-1" style="border:2px dashed #ccc">
                                <img data-dz-thumbnail width="100%" />
                                <button data-dz-remove class="pull-right btn btn-danger delete btn-sm" style="height:24px;width:24px;border-radius:50%;padding:1px 4px;position:absolute;right: -10px;top:-10px">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <div class="col-lg-12" style="padding-top:5px; position:absolute;top:40%;">
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="form-upload-image-jasa" hidden>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-jasa" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                    </div>
                    <form action="<?php echo base_url(); ?>member/store/upload_jasa_test" method="post">
                        <div class="col-lg-12">
                            <input name="tipe_jasa" type="hidden" value="jasa" class="form-control">
                            <label class="fbold">Nama Jasa</label>
                            <input type="text" name="nama_jasa" class="form-control" data-hint="<ul style='margin-left:-20px;'>
								<li class='m-b-1'>Masukan nama sesuai dengan produk dan mudah dibaca</li>
								<li class='m-b-1'>Pastikan produk kamu telah sesuai dengan undang-undang</li>
								<li>Pastikan produk yang sama tidak di upload berulang kali</li>
								</ul>" data-title="Nama Produk" placeholder="Nama Produk" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="fbold">Deskripsi Jasa</label>
                            <textarea type="text" name="description_jasa" class="form-control" data-title="Deskripsi Produk" placeholder="Deskripsi Produk" style="height: 150px;" data-hint="<ul style='margin-left:-20px;'>
								<li class='m-b-1'>Jelaskan cara penggunaan, deskripsi produk, spesifikasi, garansi dan lainnya dengan lengkap</li>
								<li>Hindari mencantumkan kontak pribadi atau nama/logolink/situs aplikasi lain pada produk</li>
								</ul>"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <label class="fbold">Harga Jasa</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" name="harga_jasa" class="form-control" data-title="Harga Jasa" placeholder="30.000">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="fbold">Minimum Jasa</label>
                            <div class="input-group">
                                <input type="text" name="minimum_jasa" class="form-control" data-title="Minimum Jasa" placeholder="1,2,3...">
                                <span class="input-group-addon">Hari</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="button" class="prev-nama-jasa btn btnnew">Kembali</button>
                            <button type="submit" class="pull-right btn btnnew">Terbitkan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="form-rental">
                <div class="nama-rental" style="display:none;">
                    <input name="tipe" type="text" value="barang" hidden>
                    <div class="col-lg-12">
                        <h5 class="fbold">Informasi Rental</h5>
                    </div>
                    <div class="col-lg-12 form-upload-image-produk" id="upload-image-produk">
                        <h6 class="fbold">Foto Produk Rental</h6>
                        <div id="previews-rental" class=""></div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-rental" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img class=" src=" <?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" data-title="Tipe" data-hint="<ul style='margin-left:-20px;'>
								<li class='m-b-1'>Gunakan foto dengan cahaya cukup dan background yang jelas</li>
								<li class='m-b-1'>Rasio 1:1 (persegi)</li>
								<li>Hindari penambahan teks pada gambar</li>
								</ul>" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-rental" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-rental" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-rental" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-rental" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                    </div>
                    <div class="btn-upload-hide-rental"></div>
                    <div class="table table-striped files">
                        <div id="template-rental" class="file-row">
                            <div class="col-lg-2--2 p-a-0 text-center m-r-1" style="border:2px dashed #ccc">
                                <img data-dz-thumbnail width="100%" />
                                <button data-dz-remove class="pull-right btn btn-danger delete btn-sm" style="height:24px;width:24px;border-radius:50%;padding:1px 4px;position:absolute;right: -10px;top:-10px">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <div class="col-lg-12" style="padding-top:5px; position:absolute;top:40%;">
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="form-upload-image-rental" hidden>
                        <div class="col-lg-2--2 p-a-1 text-center m-r-1 btn-upload-rental" style="border:2px dashed #ccc; height:107px; cursor:pointer;">
                            <img src="<?php echo site_url('public/image/cloud-icon.png'); ?>" style="width:70px;" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Nama Produk Rental</label>
                        <input type="text" name="Nama Produk" class="form-control" data-hint="<ul style='margin-left:-20px;'>
								<li class='m-b-1'>Masukan nama sesuai dengan produk dan mudah dibaca</li>
								<li class='m-b-1'>Pastikan produk kamu telah sesuai dengan undang-undang</li>
								<li>Pastikan produk yang sama tidak di upload berulang kali</li>
								</ul>" data-title="Nama Produk" placeholder="Nama Produk" required>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Tipe Produk Rental</label>
                        <select id="tipe" class="form-control" data-title="Tipe" data-hint="Tipe Barang yang akan dijual">
                            <option value="">Semua Tipe</option>
                            <?php foreach ($category as $item) : ?>
                                <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Merek Produk Rental</label>
                        <input type="text" name="description" class="form-control" data-title="Merek Produk" placeholder="Merek Produk">
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Deskripsi Produk Rental</label>
                        <textarea type="text" name="description" class="form-control" data-title="Deskripsi Produk" placeholder="Deskripsi Produk" style="height: 200px;" data-hint="<ul style='margin-left:-20px;'>
								<li class='m-b-1'>Jelaskan cara penggunaan, deskripsi produk, spesifikasi, garansi dan lainnya dengan lengkap</li>
								<li>Hindari mencantumkan kontak pribadi atau nama/logolink/situs aplikasi lain pada produk</li>
								</ul>"></textarea>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="prev-nama-rental btn btnnew">Kembali</button>
                        <button type="button" class="next-nama-rental pull-right btn btnnew">Selanjutnya</button>
                    </div>
                </div>
                <div class="spesifikasi-rental d-none">
                    <div class="col-lg-12">
                        <h5 class="fbold">Informasi Spesifikasi Rental</h5>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Kondisi</label>
                        <input type="text" name="description" class="form-control" data-title="Kondisi" placeholder="Kondisi">
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Tahun Produksi</label>
                        <input type="text" name="description" class="form-control" data-title="Kondisi" placeholder="Kondisi">
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Hour Meter</label>
                        <input type="text" name="description" class="form-control" data-title="Kondisi" placeholder="Kondisi">
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Kapasitas Bucket</label>
                        <input type="text" name="description" class="form-control" data-title="Kondisi" placeholder="Kondisi">
                    </div>
                    <div class="col-lg-12">
                        <h6 class="fbold">Attribute Produk</h6>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="f14 m-b-1 add-att" data-title="Attribute Produk" data-hint="<ul style='margin-left:-20px;'>
									<li class='m-b-1'>Menentukan varian untuk produk</li>
									<li>Membadakan antara yang pertama dan kedua</li>
								</ul>" style="color: green; padding:1px 6px;border: 1px solid green; border-radius:20px; background-color:transparent;"><i class="fa fa-plus" style="padding-top:2px;"></i> <span>Tambah
                                Attribute</span></button>
                    </div>
                    <div class="attribute-card"></div>
                    <div class="attr-form" hidden>
                        <div class="m-b-2">
                            <div class="col-lg-5">
                                <input type="text" name="description" jq-model="atribut" class="form-control" data-title="Nama Atribut" placeholder="Nama Atribut">
                            </div>
                            <div class="col-lg-5">
                                <input type="text" name="description" jq-model="value" class="form-control" data-title="Nilai Atribut" placeholder="Nilai Atribut">
                            </div>
                            <div class="col-lg-2 m-b-2" style="margin-left:-15px;">
                                <button type="button" class="f16 del-att" style="color: red; padding:5px 10px;border: 1px solid red; border-radius:50%; background-color:transparent;"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="next-spesifikasi-rental pull-right btn btnnew">Selanjutnya</button>
                        <button type="button" class="prev-spesifikasi-rental btn btnnew">Sebelumnya</button>
                    </div>
                </div>
                <div class="harga-rental d-none">
                    <div class="col-lg-12">
                        <h5 class="fbold">Informasi Harga Rental</h5>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" name="description" class="form-control" data-title="Harga Jual" placeholder="Harga Jual">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Stock</label>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" name="description" class="form-control" data-title="Harga Jual" placeholder="Harga Jual">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Minimun Pembelian</label>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" name="description" class="form-control" data-title="Harga Jual" placeholder="Harga Jual">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="next-harga-rental pull-right btn btnnew">Selanjutnya</button>
                        <button type="button" class="prev-harga-rental btn btnnew">Sebelumnya</button>
                    </div>
                </div>
                <div class="pengiriman-rental d-none">
                    <div class="col-lg-12">
                        <h5 class="fbold">Informasi Pengiriman Rental</h5>
                    </div>
                    <div class="col-lg-12">
                        <label class="fbold">Dikirim dari</label>
                        <input type="text" name="description" class="form-control" data-title="Dikirim dari" placeholder="Dikirim dari">
                    </div>
                    <div class="clearfix m-b-1"></div>
                    <div class="col-lg-12">
                        <label class="fbold">Pengemasan</label>
                        <select class="form-control" data-title="Pengemasan">
                            <option value="">Box Kertas</option>
                            <option value="">Box Kayu</option>
                            <option value="">Drum</option>
                            <option value="">Pail</option>
                            <option value="">Dus</option>
                        </select>
                    </div>
                    <div class="clearfix m-b-1"></div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="fbold">Berat</label>
                                <div class="input-group">
                                    <input type="text" name="description" class="form-control" data-title="Berat" placeholder="Berat">
                                    <span class="input-group-addon">kg</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="fbold">Tinggi</label>
                                <div class="input-group">
                                    <input type="text" name="description" class="form-control" data-title="Berat" placeholder="Berat">
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="fbold">Lebar</label>
                                <div class="input-group">
                                    <input type="text" name="description" class="form-control" data-title="Berat" placeholder="Berat">
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix m-b-1"></div>
                    <div class="col-lg-12">
                        <label class="fbold">Metode Pengiriman</label>
                        <div class="radio">
                            <label><input class="metode-pengiriman" type="radio" name="metode_pengiriman" value="standar"> Standar</label>
                            <label><input type="radio" name="metode_pengiriman" value="custom" class="metode-pengiriman m-l-2"> Custom</label>
                        </div>
                    </div>
                    <div class="mp-custom" style="display:none;">
                        <div class="col-lg-12">
                            <button type="button" class="f14 m-b-1 add-mp" style="color: green; padding:1px 6px;border: 1px solid green; border-radius:20px; background-color:transparent;"><i class="fa fa-plus" style="padding-top:2px;"></i> <span>Tambah Metode
                                    Pengiriman</span></button>
                        </div>
                        <div class="mp-card"></div>
                        <div class="mp-form" hidden>
                            <div class="m-b-2">
                                <div class="col-lg-5">
                                    <input type="text" name="description" jq-model="atribut" class="form-control" data-title="Nama Atribut" placeholder="Nama Atribut">
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" name="description" jq-model="value" class="form-control" data-title="Nilai Atribut" placeholder="Nilai Atribut">
                                </div>
                                <div class="col-lg-2 m-b-2" style="margin-left:-15px;">
                                    <button type="button" class="f16 del-mp" style="color: red; padding:5px 10px;border: 1px solid red; border-radius:50%; background-color:transparent;"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix m-b-1"></div>
                    <div class="col-lg-12">
                        <button type="submit" class="pull-right btn btnnew">Terbitkan</button>
                        <button type="button" class="prev-pengiriman-rental btn btnnew">Sebelumnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>