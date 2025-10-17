<div class="row">

    <div class="col-md-6">
        <p class="f20 fbold">Detail Perusahaan</p>
    </div>
    <div class="col-md-6">
        <p class="f20 fbold">Detail Kontak</p>
    </div>
    <?php foreach($detail->supplier as $supplier) : ?>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-sm m-a-0">
                                <tbody>
                                    <tr>
                                        <th>Company</th>
                                        <td><?= $supplier->sourcing_item->source->company->name ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $supplier->sourcing_item->source->company->email ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Telephone</th>
                                        <td><?= $supplier->sourcing_item->source->company->telephone ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <td><?= $supplier->sourcing_item->source->company->website ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>

                                        <td><?= $supplier->sourcing_item->source->company->billing_address ?? '-' . ',' . strtolower($supplier->sourcing_item->source->company->address->name ?? '') . ', ' . strtolower($supplier->sourcing_item->source->company->address->district->name ?? '-') . ', ' . strtolower($supplier->sourcing_item->source->company->address->district->regency->name ?? '-') . ', ' . strtolower($supplier->sourcing_item->source->company->address->district->regency->province->name ?? '-') ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-sm m-a-0">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><?= $supplier->sourcing_item->source->contact->name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $supplier->sourcing_item->source->contact->email ?></td>
                                    </tr>
                                    <tr>
                                        <th>Telephone</th>
                                        <td><?= $supplier->sourcing_item->source->contact->telephone ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td><?= $supplier->sourcing_item->source->contact->position ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>

                                        <td><?= $supplier->sourcing_item->source->contact->address . ',' . strtolower($supplier->sourcing_item->source->contact->village) . ', ' . strtolower($supplier->sourcing_item->source->contact->district) . ', ' . strtolower($supplier->sourcing_item->source->contact->regency) . ', ' . strtolower($supplier->sourcing_item->source->contact->province) ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>