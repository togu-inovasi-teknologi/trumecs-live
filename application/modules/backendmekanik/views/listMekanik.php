<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12 d-flex flex-column gap-2">
        <h2>List Mekanik</h2>
        <hr class="m-a-0">
        <a href="<?= base_url(); ?>backendmekanik/add_mekanik" class="btn btn-success d-flex align-items-center gap-1 radius-sm" style="width:fit-content;"><i class="fa fa-plus"></i> Tambah Mekanik</a>
    </div>
    <div class="col-lg-12">
        <table id="table-mechanic" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Mekanik</th>
                    <th>Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mechanic as $dataMechanic): ?>
                    <tr>
                        <td class="text-center"><img src="/public/image/product/<?= $dataMechanic['img']; ?>" alt="<?= $dataMechanic['img']; ?>" width="50px"></td>
                        <td>
                            <a href="<?= base_url(); ?>backendmekanik/detail_mekanik/<?= $dataMechanic['id']; ?>" class="forange"><?= $dataMechanic['tittle']; ?></a>
                        </td>
                        <td>
                            <a href="#" class="fgreen" data-target="#data-mechanic-<?= $dataMechanic['id'] ?>" data-toggle="modal"><?= getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] === 'Tersedia' ? getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] : getAvailabledate($dataMechanic['estimated_deliveryindent'])[1] . " " . "(" . getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] . ")" ?></a>
                        </td>
                        <td class="d-flex gap-1 align-items-center justify-content-center">
                            <a href="<?= base_url(); ?>backendmekanik/edit_mekanik/<?= $dataMechanic['id']; ?>" class="btn btn-warning btn-sm radius-sm"><i class="bi bi-pencil"></i></a>
                            <a href="<?= base_url(); ?>backendmekanik/deleteMekanik/<?= $dataMechanic['id']; ?>" class="btn btn-danger btn-sm radius-sm"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php foreach ($mechanic as $mec) : ?>
    <div class="modal fade" id="data-mechanic-<?= $mec['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel">Ganti tanggal tersedia</h5>
                </div>
                <form action="<?= base_url(); ?>/backendmekanik/updateDateAvailable/<?= $mec['id']; ?>" method="POST">
                    <div class="modal-body">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex flex-column">
                                <p class="fbold m-b-0">Tanggal Sebelumnya</p>
                                <p><?= date('d M Y', $mec['estimated_deliveryindent']); ?></p>
                            </div>
                            <div class="d-flex flex-column">
                                <label for="tanggal_tersedia" class="fbold m-b-0">Tanggal Tersedia</label>
                                <input type="date" id="tanggal_tersedia" name="tanggal_tersedia" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>