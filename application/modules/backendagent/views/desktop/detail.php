<?php echo $this->session->flashdata('form_error'); ?>
<div class="product">
    <h2>Detail Agen</h2>
    <hr />
    <div class="card d-lg-block">
        <div class="card-header bg-warning text-dark">Informasi</div>
        <form action="<?php echo base_url('backendagent/save/' . $detail->row()->id); ?>" method="post">
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <label class="form-label fw-bold">Nama</label>
                                    <input class="form-control form-control-sm" name="nama" placeholder="Nama" required value="<?php echo htmlspecialchars($detail->row()->nama) ?>">
                                </td>
                                <td width="50%">
                                    <label class="form-label fw-bold">No Handphone</label>
                                    <input class="form-control form-control-sm" name="handphone" placeholder="Nomor handphone / WA" required value="<?php echo htmlspecialchars($detail->row()->handphone) ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-label fw-bold">Email aktif</label>
                                    <input class="form-control form-control-sm" name="email" placeholder="Alamat email aktif anda" required value="<?php echo htmlspecialchars($detail->row()->email) ?>">
                                </td>
                                <td>
                                    <label class="form-label fw-bold">Pekerjaan sekarang</label>
                                    <textarea class="form-control form-control-sm" name="jobdesc" placeholder="Deskripsikan apa pekerjaan aktif anda saat ini" required rows="2"><?php echo htmlspecialchars($detail->row()->jobdesc) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-label fw-bold">Domisili</label>
                                    <textarea class="form-control form-control-sm" name="domisili" placeholder="Domisili anda saat ini" required rows="2"><?php echo htmlspecialchars($detail->row()->domisili) ?></textarea>
                                </td>
                                <td>
                                    <label class="form-label fw-bold">Daerah cakupan</label>
                                    <textarea class="form-control form-control-sm" name="area" placeholder="Mana saja daerah yang menjadi cakupan anda" required rows="2"><?php echo htmlspecialchars($detail->row()->area) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php $scope = explode(",", $detail->row()->scope); ?>
                                    <label class="form-label fw-bold">Lingkup Industri</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="pemerintah" <?php echo in_array("pemerintah", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Instansi Pemerintah
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="industri" <?php echo in_array("industri", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Industri
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="pelabuhan" <?php echo in_array("pelabuhan", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Pelabuhan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="perkapalan" <?php echo in_array("perkapalan", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Perkapalan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="pertambangan" <?php echo in_array("pertambangan", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Pertambangan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="perkebunan" <?php echo in_array("perkebunan", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Perkebunan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="transportasi" <?php echo in_array("transportasi", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Transportasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="kontraktor" <?php echo in_array("kontraktor", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Kontraktor
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="scope[]" value="oilgas" <?php echo in_array("oilgas", $scope) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Oil & Gas
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php $produk = explode(",", $detail->row()->product); ?>
                                    <label class="form-label fw-bold">Produk yang ingin dipasarkan</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="product[]" value="ban" <?php echo in_array("ban", $produk) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Ban
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="product[]" value="aki" <?php echo in_array("aki", $produk) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Aki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="product[]" value="pelumas" <?php echo in_array("pelumas", $produk) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Pelumas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="product[]" value="sparepart" <?php echo in_array("sparepart", $produk) ? "checked='checked'" : ""  ?>>
                                                <label class="form-check-label">
                                                    Sparepart
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-label fw-bold">Siap aktif</label>
                                    <input class="form-control form-control-sm" name="active_date" required type="date" value="<?php echo date("Y-m-d", $detail->row()->active_date) ?>">
                                </td>
                                <td>
                                    <label class="form-label fw-bold">Status pekerjaan</label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="status" value="fulltime" <?php echo $detail->row()->status == "fulltime" ? "checked='checked'" : ""  ?>>
                                        <label class="form-check-label">
                                            Fulltime
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="status" value="parttime" <?php echo $detail->row()->status == "parttime" ? "checked='checked'" : ""  ?>>
                                        <label class="form-check-label">
                                            Parttime
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-label fw-bold">Tanggal Daftar</label>
                                    <input class="form-control form-control-sm" readonly name="created_at" type="date" value="<?php echo date("Y-m-d", $detail->row()->create_at) ?>">
                                </td>
                                <td>
                                    <label class="form-label fw-bold">Status agent</label>
                                    <select class="form-select form-select-sm" name="is_approved">
                                        <option value="0" <?php echo $detail->row()->is_approved == 0 ? "selected='selected'" : '' ?>>Menunggu persetujuan</option>
                                        <option value="1" <?php echo $detail->row()->is_approved == 1 ? "selected='selected'" : '' ?>>Disetujui</option>
                                        <option value="2" <?php echo $detail->row()->is_approved == 2 ? "selected='selected'" : '' ?>>Ditolak</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="form-label fw-bold">Keterangan</label>
                                    <textarea class="form-control form-control-sm" name="keterangan" placeholder="Keterangan proses pendaftaran keagenan" rows="3"><?php echo htmlspecialchars($detail->row()->keterangan) ?></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-outline-secondary">Submit</button>
            </div>
        </form>
    </div>
</div>