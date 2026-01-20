<div class="product">
    <h2 class="h5">Daftar Agen</h2>
    <hr />
    <div class="d-block d-lg-none">
        <div class="card">
            <style>
                .list-mobile .list-group-item {
                    border-left: none;
                    border-right: none;
                    padding: 1rem;
                }

                .list-mobile .list-group-item:first-child {
                    border-top: none;
                }

                .list-mobile .list-group-item:last-child {
                    border-bottom: none;
                }

                .list-mobile .bg-light {
                    background-color: rgba(0, 0, 0, 0.05) !important;
                }

                .list-mobile .text-truncate {
                    max-width: 150px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                }

                .list-mobile .badge {
                    font-size: 0.75em;
                    padding: 0.35em 0.65em;
                }

                .list-mobile .text-decoration-none:hover {
                    text-decoration: underline !important;
                }

                .list-mobile .text-muted {
                    font-size: 0.8rem;
                    color: #6c757d !important;
                }

                .list-mobile .bi-inbox {
                    display: block;
                    margin: 0 auto 1rem;
                    color: #adb5bd;
                }

                .list-mobile .row.g-2>div {
                    margin-bottom: 0.5rem;
                }
            </style>
            <div class="card-body p-0 list-mobile">
                <div class="list-group">
                    <?php foreach ($list->result() as $key => $item): ?>
                        <div class="list-group-item <?php echo $item->is_read == '0' ? 'bg-light fw-bold' : ''; ?>">

                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="d-flex w-100 justify-content-between mb-2">
                                        <h6 class="mb-1">
                                            <a href="<?php echo site_url('backendagent/detail/' . $item->id); ?>" class="text-decoration-none">
                                                <span>#<?php echo htmlspecialchars($item->id) ?></span>
                                                <?php echo htmlspecialchars($item->nama) ?>
                                                <?php echo $item->is_read == '0' ? '<span class="bg-success ms-1">new</span>' : ''; ?>
                                            </a>
                                        </h6>
                                        <small>
                                            <?php if ($item->is_approved == 0): ?>
                                                <span class="text-warning text-dark">Menunggu</span>
                                            <?php elseif ($item->is_approved == 1): ?>
                                                <span class="text-success">Disetujui</span>
                                            <?php else: ?>
                                                <span class="text-danger">Ditolak</span>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Phone</small>
                                    <p class="mb-1"><?php echo htmlspecialchars($item->handphone) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Email</small>
                                    <p class="mb-1 text-truncate"><?php echo htmlspecialchars($item->email) ?></p>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">Domisili</small>
                                    <p class="mb-1"><?php echo htmlspecialchars($item->domisili) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Produk</small>
                                    <p class="mb-1"><?php echo htmlspecialchars($item->product) ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Jenis</small>
                                    <p class="mb-1"><?php echo htmlspecialchars($item->status) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if ($list->num_rows() == 0): ?>
                        <div class="list-group-item text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-inbox text-muted mb-2" viewBox="0 0 16 16">
                                <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
                            </svg>
                            <p class="text-muted mb-0">Tidak ada data agen</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <input type="hidden" name="status" value="<?php echo htmlspecialchars($this->input->get('status')) ?>" />
    </div>
</div>

<script type="text/javascript">
    function hapus(url, name) {
        const txt = "Apakah anda yakin ingin menghapus produk " + name + "?";
        if (confirm(txt)) {
            window.location.href = "<?php echo base_url() ?>backendproduct/hapus?id=" + url;
        }
    };
</script>