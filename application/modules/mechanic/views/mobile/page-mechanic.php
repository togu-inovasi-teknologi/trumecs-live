<div class="d-flex flex-column gap-3 m-t-3">
    <section id="banner" class="bg-white">
        <div class="col-sm-12 gradient-black-white d-flex justify-content-between align-items-center w-100 p-a-0" style="background-image: url('/public/banner/banner-mechanic-mobile.png');
height:600px;">
            <div class="gap-0 p-l-1" style="position:absolute;top:25px;">
                <h1 class="forange fbold">Tru Expert</h1>
                <h4 class="fwhite">Access the mining industry's top experts! Experienced pros to guide your projects to excellence.</h4>
            </div>
            <!--<img src="/public/image/background/mechanic.png" alt="mechanic.png" height="100" class="mr-0">-->
        </div>
    </section>

    <section id="tentang" class="bg-white m-b-1">
        <div class="col-sm-12 slick-usp-mechanic">
            <div class="col-sm-12 bg-grey p-a-1 radius-sm" style="height: 120px;">
                <h6 class="fbold">MECHANIC</h6>
                <p class="f12">Find the best mechanics! Trusted, experienced professionals ready to fix your toughest issues.</p>
            </div>
            <div class="col-sm-12 bg-grey p-a-1 radius-sm" style="height: 120px;">
                <h6 class="fbold">DRIVER & OPERATOR</h6>
                <p class="f12">Elevate your projects with top truck drivers & operators! Work with the industry's most experienced.</p>
            </div>
            <div class="col-sm-12 bg-grey p-a-1 radius-sm" style="height: 120px;">
                <h6 class="fbold">DRAFTER</h6>
                <p class="f12">Top drafters await! Engage the most skilled and experienced pros for precise designs.</p>
            </div>
        </div>
    </section>
    <section id="mechanic" class="bg-white m-b-2">
        <div class="col-sm-12 d-flex flex-column gap-3">
            <div class="col-sm-12 d-flex justify-content-between align-items-center p-a-0">
                <!--<button class="btn btnnew radius-sm m-r-1" data-toggle="modal" type="button" data-target="#filter-mechanic"><i class="fa fa-filter"></i> Filter</button>
                <div class="input-group d-flex gap-0 w-100">
                    <input type="text" class="form-control" placeholder="Search Mechanic" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>-->
                <h2 class="fbold">Daftar Expert</h2>
            </div>
            <div class="col-sm-12 d-flex flex-column gap-2 p-a-0">
                <?php foreach ($mechanic as $dataMechanic) : ?>
                    <div class="card bg-card-mechanic radius-sm p-a-1 d-flex flex-column gap-1">
                        <div class="d-flex gap-2">
                            <div class="image-container-mobile">
                                <img src=" /public/image/product/<?= $dataMechanic['img'] ?>" alt="mechanic.png" class="image-full">
                            </div>
                            <div class="d-flex flex-column gap-1 w-100">
                                <?php 
                                $length = array();
                                $names = explode(' ', $dataMechanic['tittle']);
                                foreach($names as $key => $value):
                                    $replacement = str_repeat('*', strlen($value) - 2);
                                    $names[$key] = substr_replace($value, $replacement, 1, -1);
                                endforeach;
                                $name = implode(' ', $names);
                                ?>
                                <h6 class="fbold"><?= $dataMechanic['tittle'] ?>, <?= getAge($dataMechanic['made']) ?> </h6>
                                <h6 class="fbold"><i class="fa fa-id-badge forange icon-a-15"></i> <?= $dataMechanic['grade'] ?></h6>
                                <h6 class="fbold"><i class="fa fa-map-marker forange icon-a-15"></i> <?= str_replace(["KABUPATEN ", "KOTA "], "", $dataMechanic['nama_domisili']) ?></h6>
                            </div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa fa-wrench icon-a-15 forange"></i>
                            <p class="fbold f12"><?= str_replace(",", ", ", $dataMechanic['nama_keahlian']) ?></p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa fa-file-text icon-a-15 forange"></i>
                            <p class="fbold f12"><?= str_replace(",", ", ", $dataMechanic['nama_kontrak']) ?></p>
                        </div>
                        <div class="d-flex gap-2 align-items-start">
                            <i class="fa fa-map icon-a-15 forange"></i>
                            <p class="fbold f12"><?= str_replace(',', ', ', str_replace(["KABUPATEN ", "KOTA "], "", $dataMechanic['cakupan_area'])) ?><?php if (isset($dataMechanic['cakupan_area_province'])) : ?><?= str_replace(',', ', ', $dataMechanic['cakupan_area_province']) ?>
                            <?php endif; ?></p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa fa-user icon-a-15 forange"></i>
                            <p class="fbold f12 fgreen"><?= getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] === 'Tersedia' ? getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] : getAvailabledate($dataMechanic['estimated_deliveryindent'])[1] . " " . "(" . getAvailabledate($dataMechanic['estimated_deliveryindent'])[0] . ")" ?></p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url() ?>mechanic/detail/<?= $dataMechanic['id'] ?>" class="btn btnnew radius-sm text-right f12" style="width:fit-content">View More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="filter-mechanic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fbold" id="exampleModalLabel"><span>Filter Mechanic</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                <div class="d-flex gap-3 flex-column">
                    <div class="d-flex flex-column gap-1">
                        <label for="domisili" class="forange fbold m-a-0"><i class="fa fa-map-marker"></i> Domisili</label>
                        <select id="domisili" name="domisili" class="form-control">
                            <option value="">Bekasi</option>
                            <option value="">Jakarta</option>
                            <option value="">Tanggerang</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <label class="forange fbold m-a-0"><i class="fa fa-address-card"></i> Umur</label>
                        <div class="d-flex flex-column gap-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    > 60 Tahun
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    40 - 59 Tahun
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    20 - 39 Tahun
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <label class="forange fbold m-a-0"><i class="fa fa-id-badge"></i> Tingkat Mekanik</label>
                        <div class="d-flex flex-column gap-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Professor Mekanik (M1)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Senior Mekanik (M2)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Junior Mekanik (M3)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <label class="forange fbold m-a-0"><i class="fa fa-map"></i> Jangkauan Daerah</label>
                        <div class="d-flex flex-column gap-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Jawa Barat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Jawa Tengah
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Jawa Timur
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <label class="forange fbold m-a-0"><i class="fa fa-file-text"></i> Periode Kontrak</label>
                        <div class="d-flex flex-column gap-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Mingguan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Bulanan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <label class="forange fbold m-a-0"><i class="fa fa-user"></i> Tersedia</label>
                        <div class="d-flex flex-column gap-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Tersedia
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label m-a-0" for="defaultCheck1">
                                    Tidak Tersedia
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btnnew radius-sm">Save changes</button>
            </div>
        </div>
    </div>
</div>