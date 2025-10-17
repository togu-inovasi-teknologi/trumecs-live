<h2><a class="btn btn-black" href="<?php echo site_url('backendprospek/admin'); ?>"><small><span class="fa fa-chevron-left"></span></small></a> Tambah Prospek</h2>
<hr/>
<div class="detail row">
	<div class="col-md-4 col-md-offset-4">
        <div class="card">
            <div class="card-header btn-orange text-center">Informasi Prospek</div>
            <div class="card-body">
                <form class="form-horizontal" action="<?php echo site_url('backendprospek/admin/add_prospek'); ?>" id="detail_form" method="post">
                    <table class="table table-bordered table-striped f12" style="width:100%;margin-bottom:0px">
                        <tbody>
                            <tr>
                                <td>
                                    <label><strong>Nama Perusahaan</strong></label>
                                    <input class="form-control f12" name="company" value="" placeholder="Nama perusahaan" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Nama PIC</strong></label>
                                    <input class="form-control f12" name="name" value=""  placeholder="Nama PIC / kontak" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Posisi PIC</strong></label>
                                    <input class="form-control f12" name="position" value="" placeholder="Posisi / jabatan PIC" required />
                                </td>
                            </tr>
                            <tr>    
                                <td>
                                    <label><strong>Kategori Perusahaan</strong></label>
                                    <select name="category" class="form-control f12">
                                        <option value="">--Pilih Kategori--</option>
                                        <option value="industri">Industri</option>
                                        <option value="transportasi">Transportasi</option>
                                        <option value="kontraktor">Kontraktor</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Telepon Perusahaan</strong></label>
                                    <input class="form-control f12" name="company_phone" value="" placeholder="Nomor telepon perusahaan" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Telepon PIC</strong></label>
                                    <input class="form-control f12" name="phone" value="" placeholder="Nomor telepon PIC" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Email Perusahaan</strong></label>
                                    <input class="form-control f12" name="company_email" value="" placeholder="Email perusahaan" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Email PIC</strong></label>
                                    <input class="form-control f12" name="email" value=""  placeholder="Email PIC" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Alamat Perusahaan</strong></label>
                                    <textarea rows="6" class="form-control f12" name="company_address" value="" placeholder="Alamat perusahaan" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Keterangan / Informasi Tambahan</strong></label>
                                    <textarea rows="6" class="form-control f12" name="additional_information" value="" placeholder="Keterangan tambahan"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer text-right">
                <button type="submit" form="detail_form" class="btn btn-orange">Simpan</button>
            </div>
        </div>
	</div>
</div>