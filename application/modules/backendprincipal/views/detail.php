<?php echo $this->session->flashdata('form_error'); ?>
<div class="product">
    <h2>Detail Agen <!-- <a class="btn btn-orange" href="<?php echo site_url('backendprospek/admin/add'); ?>"><span class="fa fa-plus"></span></a> --></h2>
    <hr/>
    <div class="card">
        <div class="card-header btn-orange">Informasi</div>
        <form action="<?php echo base_url('backendprincipal/save/'.$detail->row()->id); ?>" method="post">
        <div class="card-body row p-x-1">
            <table class="table table-bordered table-striped f12">
                <tbody>
                    <tr>
                        <td>
                            <label><strong>Nama</strong></label>
                            <input class="form-control f12" name="name" placeholder="nama" required value="<?php echo $detail->row()->name ?>">
                        </td>
                        <td>
                            <label><strong>No Handphone</strong></label>
                            <input class="form-control f12" name="phone" placeholder="Nomor handphone / WA" required value="<?php echo $detail->row()->phone ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Email aktif</strong></label>
                            <input class="form-control f12" name="email" placeholder="Alamat email aktif anda" required value="<?php echo $detail->row()->email ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Perusahaan</strong></label>
                            <textarea class="form-control f12" name="company" placeholder="Domisili anda saat ini" required><?php echo $detail->row()->company ?></textarea>
                        </td>
                        <td>
                            <label><strong>Asal Negara</strong></label>
                            <textarea class="form-control f12" name="country" placeholder="Mana saja daerah yang menjadi cakupan anda" required><?php echo $detail->row()->country ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Jenis Prduk</strong></label>
                            <textarea class="form-control f12" name="product" placeholder="Domisili anda saat ini" required><?php echo $detail->row()->product ?></textarea>
                        </td>
                        <td>
                            <label><strong>Brand</strong></label>
                            <textarea class="form-control f12" name="brand" placeholder="Mana saja daerah yang menjadi cakupan anda" required><?php echo $detail->row()->brand ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><strong>Tanggal Daftar</strong></label>
                            <input class="form-control f12" readonly="" name="created_at" placeholder="Deskripsikan produk yang anda minta" type="date" value="<?php echo date("Y-m-d", $detail->row()->create_at) ?>">
                        </td>
                        <td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label><strong>Informasi Tambahan</strong></label>
                            <textarea class="form-control f12" name="additional_info" placeholder="Keterangan proses pendaftaran keagenan" ><?php echo $detail->row()->additional_info ?></textarea>
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