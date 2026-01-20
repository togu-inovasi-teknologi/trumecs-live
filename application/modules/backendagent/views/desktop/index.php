<div class="product">
    <h2>Daftar Agen</h2>
    <hr />
    <div class="d-none d-lg-block">
        <div class="card">
            <style>
                .table-desktop .table-hover tbody tr:hover {
                    background-color: rgba(255, 193, 7, 0.1);
                }

                .table-desktop .table-striped>tbody>tr:nth-of-type(odd)>* {
                    --bs-table-accent-bg: rgba(0, 0, 0, 0.02);
                }

                .table-desktop .table-active {
                    background-color: rgba(0, 0, 0, 0.05) !important;
                }

                .table-desktop .badge {
                    font-size: 0.75em;
                    padding: 0.35em 0.65em;
                }

                .table-desktop .text-decoration-none:hover {
                    text-decoration: underline !important;
                }

                .table-desktop th {
                    font-weight: 600;
                    white-space: nowrap;
                }

                .table-desktop td {
                    vertical-align: middle;
                }

                .table-desktop .bg-warning {
                    background-color: #ffc107 !important;
                }
            </style>
            <div class="card-body table-desktop">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="datatables">
                        <thead class="bg-warning text-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Domisili</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="list-prospek" data-lastid="<?php echo $list->num_rows() > 0 ? $list->row($list->num_rows() - 1)->id : 0 ?>">
                            <?php foreach ($list->result() as $key => $item): ?>
                                <tr class="<?php echo $item->is_read == '0' ? 'table-active fw-bold' : ''; ?>">
                                    <td class="text-center"><?php echo htmlspecialchars($item->id) ?></td>
                                    <td>
                                        <a href="<?php echo site_url('backendagent/detail/' . $item->id); ?>" class="text-decoration-none">
                                            <span class="badge bg-dark text-white"><?php echo htmlspecialchars($item->nama) ?></span>
                                            <?php echo $item->is_read == '0' ? '<span class="badge bg-success ms-1">new</span>' : ''; ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($item->handphone) ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($item->email) ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($item->domisili) ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($item->product) ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($item->status) ?></td>
                                    <td class="text-center">
                                        <?php if ($item->is_approved == 0): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php elseif ($item->is_approved == 1): ?>
                                            <span class="badge bg-success">Disetujui</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Domisili</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </tfoot>
                    </table>
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