<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?php $session = $this->session->all_userdata();
$sessionmember = array_key_exists('member', $session) ? $session['member'] : array('id' => null);
$this->load->language("partnership");
$this->load->language("form");
$this->load->language("rfq_lang");
?>

<section class="step" id="step">
    <div class="row">
        <div class="col-12">
            <section class="form" id="form">
                <div class="row">
                    <form action="<?php echo base_url('bulk/bulk_save'); ?>" method="POST" id="bulk_member" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <h6 class="text-muted">Ketik permintaan anda atau Tarik file kedalam field</h6>
                            <div class="col-12 d-flex flex-column gap-2 align-items-end p-3 border">
                                <div class="autocomplete-selected tags-input w-100" style="box-shadow: none; border:none">
                                    <ul id="items-autocomplete-selected" class="list-unstyled mb-0">
                                    </ul>
                                </div>
                                <input type="hidden" name="item_keyword">
                                <textarea type="text" class="form-control border-0" id="uploader" name="text_rfq"
                                    style="height:150px;" placeholder="Ketik Permintaanmu disini"></textarea>
                                <div class="table table-striped mb-0 files" id="previews">
                                    <div id="template">
                                        <h6 class="error text-danger fbold mb-2" data-dz-errormessage>
                                        </h6>
                                        <div class="file-upload d-flex align-items-center">
                                            <div class="col-6 ps-0">
                                                <span class="name name-file my-0" data-dz-name></span>
                                            </div>
                                            <div class="col-4">
                                                <div class="progress progress-striped active my-0" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success my-0"
                                                        style="width:0%;" data-dz-uploadprogress>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex justify-content-between align-items-center px-0">
                                                <span class="size d-flex" data-dz-size></span>
                                                <i data-dz-remove class="fa fa-remove pointer fred my-0"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn shadow bg-white btn-upload" type="button">
                                    <i class="fa fa-upload"></i> Upload File
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 mt-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Masukan nama anda">
                            </div>
                            <div class="mb-3">
                                <label for="no_telp" class="form-label">Nomor Telepon</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp"
                                    placeholder="Masukan nomor telepon anda">
                            </div>
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Nama Perusahaan</label>
                                <input type="text" name="company_name" class="form-control" id="company_name"
                                    placeholder="Masukan nama perusahaan anda">
                            </div>
                            <div class="mb-3">
                                <label for="autocomplete-input" class="form-label">Alamat Anda</label>
                                <input type="hidden" name="village_id">
                                <div id="location"></div>
                                <button type="button" id="show-address-list" class="form-control" data-bs-toggle="modal"
                                    data-bs-target="#modal-address">Tambah Alamat</button>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btnnew w-100">Kirim Daftar Belanja</button>
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

<!-- Modal -->
<div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modal-addressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-6" id="modal-addressLabel">Cari Alamat Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-hover datatable" id="datatable-address">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-normal small">Desa/Kelurahan</th>
                                <th class="fw-normal small">Kecamatan</th>
                                <th class="fw-normal small">Kabupaten/Kota</th>
                                <th class="fw-normal small">Provinsi</th>
                                <th class="fw-normal small">Pilih</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <!-- Table rows will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>