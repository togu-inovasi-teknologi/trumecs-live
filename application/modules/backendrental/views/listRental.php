<div class="container d-flex flex-column gap-3">
    <div class="col-lg-12 d-flex flex-column gap-2">
        <h2>List Rental</h2>
        <hr class="m-a-0">
        <a href="<?= base_url(); ?>backendrental/add_rental" class="btn btn-success d-flex align-items-center gap-1 radius-sm" style="width:fit-content;"><i class="fa fa-plus"></i> Tambah Rental</a>
    </div>
    <div class="col-lg-12">
        <table id="table-rental" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Unit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rental as $dataRental): ?>
                    <tr>
                        <td class="text-center"><img src="/public/image/product/<?= $dataRental['img']; ?>" alt="<?= $dataRental['img']; ?>" width="50px"></td>
                        <td>
                            <a href="<?= base_url(); ?>backendrental/detail_rental/<?= $dataRental['id']; ?>"><?= $dataRental['tittle']; ?></a>
                        </td>
                        <td class="d-flex gap-1 align-items-center justify-content-center">
                            <a href="<?= base_url(); ?>backendrental/edit_rental/<?= $dataRental['id']; ?>" class="btn btn-warning btn-sm radius-sm"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url(); ?>backendrental/deleteRental/<?= $dataRental['id']; ?>" class="btn btn-danger btn-sm radius-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>