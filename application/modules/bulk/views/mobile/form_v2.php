<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php $session = $this->session->all_userdata();
$sessionmember = array_key_exists('member', $session) ? $session['member'] : array('id' => null);
$this->load->language("partnership");
$this->load->language("form");
$this->load->language("rfq_lang");
?>

<section class="step" id="step">

    <div class="row">
        <div class="col-lg-12">
            <section class="form" id="form">
                <div class="row">
                    <form action="<?php echo base_url('bulk/bulk_save'); ?>" method="POST" id="bulk_member"
                        enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <h6 class="text-muted">Ketik permintaan anda atau Tarik file kedalam
                                field</h6>
                            <div class="col-lg-12 d-flex flex-column gap-1 align-items-end p-a-1 border-sm">
                                <div class="autocomplete-selected tags-input" style="box-shadow: none; border:none">
                                    <ul id="items-autocomplete-selected">

                                    </ul>
                                </div>
                                <input type="hidden" name="item_keyword">
                                <textarea type="text" class="form-control border-none" id="uploader" name="text_rfq"
                                    style="height:150px;" placeholder="Ketik Permintaanmu disini"></textarea>
                                <div class="table table-striped m-b-0" class="files" id="previews">
                                    <div id="template">
                                        <h6 class="error text-danger fbold" data-dz-errormessage>
                                        </h6>
                                        <div class="file-upload">
                                            <div class="col-lg-6 p-x-0">
                                                <span class="name name-file m-a-0" data-dz-name></span>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="progress progress-striped active m-a-0" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success m-a-0"
                                                        style="width:0%;" data-dz-uploadprogress>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 d-flex-sb align-items-center p-x-0">
                                                <span class="size d-flex" data-dz-size></span>
                                                <i data-dz-remove class="fa fa-remove pointer fred m-a-0"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn shadow bg-white btn-upload" type="button"><i
                                        class="fa fa-upload"></i>
                                    Upload File</button>
                            </div>


                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-t-1">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Masukan nama anda">
                            </div>
                            <div class="form-group m-t-1">
                                <label for="no_telp">Nomor Telepon</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp"
                                    placeholder="Masukan nomor telepon anda">
                            </div>
                            <div class="form-group m-t-1">
                                <label for="company_name">Nama Perusahaan</label>
                                <input type="text" name="company_name" class="form-control" id="company_name"
                                    placeholder="Masukan nomor telepon anda">
                            </div>
                            <div class="form-group m-t-1">
                                <label for="autocomplete-input">Alamat Anda</label>
                                <input type="hidden" name="village_id">
                                <div id="location">


                                </div>
                                <button type="button" id="show-address-list" class="form-control" data-toggle="modal"
                                    data-target="#modal-address">Tambah
                                    Alamat</button>
                            </div>

                        </div>
                        <div class="col-lg-12 m-t-1">
                            <button type="submit" class="btn btnnew btn-block ">Kirim Daftar
                                Belanja</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>

<style>
.btn-lingkaran {
    background-color: transparent;
    color: orange;
    font-size: 20px;
}
</style>

<div class="modal fade" id="modal-address" tabindex="-1" role="dialog" aria-labelledby="modal-address">
    <div class="modal-dialog modal-lg" style="margin: 5% auto; " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="gridSystemModalLabel">Cari Alamat Anda</h6>
            </div>
            <div class="modal-body">
                <table class="display table table-hover datatable" id="datatable-address">
                    <thead>
                        <tr>
                            <th>Desa/Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten/Kota</th>
                            <th>Provinsi</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>