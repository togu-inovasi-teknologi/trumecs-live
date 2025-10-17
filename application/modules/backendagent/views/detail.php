<?php echo $this->session->flashdata('form_error'); ?>
<div class="product">
    <h2>Detail Agen <!-- <a class="btn btn-orange" href="<?php echo site_url('backendprospek/admin/add'); ?>"><span class="fa fa-plus"></span></a> --></h2>
    <hr/>
    <div class="card">
        <div class="card-header btn-orange">Informasi</div>
        <form action="<?php echo base_url('backendagent/save/'.$detail->row()->id); ?>" method="post">
        <div class="card-body row p-x-1">
            <table class="table table-bordered table-striped f12">
                <tbody>
                    <tr>
                        <td>
                            <label><strong>Nama</strong></label>
                            <input class="form-control f12" name="nama" placeholder="nama" required value="<?php echo $detail->row()->nama ?>">
                        </td>
                        <td>
                            <label><strong>No Handphone</strong></label>
                            <input class="form-control f12" name="handphone" placeholder="Nomor handphone / WA" required value="<?php echo $detail->row()->handphone ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Email aktif</strong></label>
                            <input class="form-control f12" name="email" placeholder="Alamat email aktif anda" required value="<?php echo $detail->row()->email ?>">
                        </td>
                        <td>
                            <label><strong>Pekerjaan sekarang</strong></label>
                            <textarea class="form-control f12" name="jobdesc" placeholder="Deskripsikan apa pekerjaan aktif anda saat ini" required><?php echo $detail->row()->jobdesc ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Domisili</strong></label>
                            <textarea class="form-control f12" name="domisili" placeholder="Domisili anda saat ini" required><?php echo $detail->row()->domisili ?></textarea>
                        </td>
                        <td>
                            <label><strong>Daerah cakupan</strong></label>
                            <textarea class="form-control f12" name="area" placeholder="Mana saja daerah yang menjadi cakupan anda" required><?php echo $detail->row()->area ?></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <?php $scope = explode(",", $detail->row()->scope); ?>
                        <label><strong>Lingkup Industri</strong></label>
                        <div class="row">
                        <div class="col-xs-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="pemerintah" <?php echo in_array("pemerintah", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Instansi Pemerintah
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="industri" <?php echo in_array("industri", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Industri
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="pelabuhan" <?php echo in_array("pelabuhan", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Pelabuhan
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="perkapalan" <?php echo in_array("perkapalan", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Perkapalan
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="pertambangan" <?php echo in_array("pertambangan", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Pertambangan
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="perkebunan" <?php echo in_array("perkebunan", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Perkebunan
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="transportasi" <?php echo in_array("transportasi", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Transportasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="kontraktor" <?php echo in_array("kontraktor", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Kontraktor
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="scope[]" value="oilgas" <?php echo in_array("oilgas", $scope) ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Oil & Gas
                                </label>
                            </div>
                        </div>
                        </div>
                        </td>
                        <td>
                        <?php $produk = explode(",", $detail->row()->product); ?>
                        <label><strong>Produk yang ingin dipasarkan</strong></label>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="ban" <?php echo in_array("ban", $produk) ? "checked='checked'" : ""  ?>>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Ban
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="aki" <?php echo in_array("aki", $produk) ? "checked='checked'" : ""  ?>>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Aki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="pelumas" <?php echo in_array("pelumas", $produk) ? "checked='checked'" : ""  ?>>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Pelumas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="product[]" value="sparepart" <?php echo in_array("sparepart", $produk) ? "checked='checked'" : ""  ?>>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Sparepart
                                    </label>
                                </div>
                            </div>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Siap aktif</strong></label>
                            <input class="form-control f12" name="active_date" placeholder="Deskripsikan produk yang anda minta" required type="date" value="<?php echo date("Y-m-d", $detail->row()->active_date) ?>">
                        </td>
                        <td>
                            <label><strong>Status pekerjaan</strong></label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" value="fulltime" <?php echo $detail->row()->status == "fulltime" ? "checked='checked'" : ""  ?>">
                                <label class="form-check-label" for="defaultCheck1">
                                    Fulltime
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" value="parttime" <?php echo $detail->row()->status == "parttime" ? "checked='checked'" : ""  ?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Parttime
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Tanggal Daftar</strong></label>
                            <input class="form-control f12" readonly="" name="created_at" placeholder="Deskripsikan produk yang anda minta" type="date" value="<?php echo date("Y-m-d", $detail->row()->create_at) ?>">
                        </td>
                        <td>
                        <label><strong>Status agent</strong></label>
                            <select class="form-control f12" name="is_approved">
                                <option value="0" <?php echo $detail->row()->is_approved == 0 ? "selected='selected'" : '' ?>>Menunggu persetujuan</option>
                                <option value="1" <?php echo $detail->row()->is_approved == 1 ? "selected='selected'" : '' ?>>Disetujui</option>
                                <option value="2" <?php echo $detail->row()->is_approved == 2 ? "selected='selected'" : '' ?>>Ditolak</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label><strong>Keterangan</strong></label>
                            <textarea class="form-control f12" name="keterangan" placeholder="Keterangan proses pendaftaran keagenan" ><?php echo $detail->row()->keterangan ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-white">Submit</button>
        </div>
        </form>
    </div>
</div>