<!-- info card akun -->
<?php
$session = $this->session->all_userdata();
$sessionmember = $session["member"];

$bannerUtama = [];
$bannerUtamaMobile = [];
$banner1 = [];
$banner1Mobile = [];
$banner2 = [];
$banner2Mobile = [];
if ($stores->banners != null) {
    foreach ($stores->banners as $contentBanner) {
        if ($contentBanner->index == 0 && $contentBanner->is_mobile == 0) {
            $bannerUtama[] =  $contentBanner;
        }
        if ($contentBanner->index == 0 && $contentBanner->is_mobile == 1) {
            $bannerUtamaMobile[] =  $contentBanner;
        }
        if ($contentBanner->index == 1 && $contentBanner->is_mobile == 0) {
            $banner1[] =  $contentBanner;
        }
        if ($contentBanner->index == 1 && $contentBanner->is_mobile == 1) {
            $banner1Mobile[] =  $contentBanner;
        }
        if ($contentBanner->index == 2 && $contentBanner->is_mobile == 0) {
            $banner2[] =  $contentBanner;
        }
        if ($contentBanner->index == 2 && $contentBanner->is_mobile == 1) {
            $banner2Mobile[] =  $contentBanner;
        }
    }
};
?>
<div class="row d-flex flex-column gap-3">
    <div class="col-lg-12 title-desktop">
        <div class="d-flex-sb align-items-center">
            <div class="flex flex-column gap-1">
                <h4 class="fbold title-content">Akun Toko</h4>
                <h6 class="text-muted f13">Kelola informasi toko Anda untuk mengontrol, melindungi dan mengamankan akun.</h6>
            </div>
            <?php foreach ($store as $toko) : ?>
                <a href="<?= base_url() . $toko['domain'] ?>" target="_blank" class="btn btnnew">Preview Toko</a>
            <?php endforeach ?>
        </div>

    </div>
    <div class="col-lg-12">
        <ul class="nav nav-tabs" id="homeTab" role="tablist">
            <li class="nav-item" role="presentation"><a class="btn btnnew" id="information-tab" data-toggle="tab" data-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Informasi</a></li>
            <li class="nav-item" role="presentation"><a class="btn btnnew" id="store-tab" data-toggle="tab" data-target="#store" type="button" role="tab" aria-controls="store" aria-selected="false">Toko</a></li>
        </ul>
    </div>
    <div class="tab-content" id="homeTabContent">
        <div class="tab-pane fade show active in" id="information" role="tabpanel" aria-labelledby="information-tab">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body p-a-1">
                                <?php foreach ($store as $key) : ?>
                                    <div class="row d-flex flex-column gap-2">
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Nama Toko</p>
                                                <p class="text-dark"><?php echo $key["name"]; ?> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Domain</p>
                                                <p class="text-dark"><?php echo $key["domain"]; ?> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">NPWP</p>
                                                <p class="text-dark"><?php echo $key["npwp"]; ?> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Email</p>
                                                <p class="text-dark"><?php echo $key["email"]; ?> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Telepon</p>
                                                <p class="text-dark"><?php echo $key["phone"]; ?> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">PIC Toko</p>
                                                <p class="text-dark"><?php echo $key["mailing_pic"]; ?> ( <?php echo $key["mailing_position"]; ?> )
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Telepon PIC</p>
                                                <p class="text-dark"><?php echo $key["mailing_phone"]; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Alamat</p>
                                                <p class="text-dark"><?php echo $key["mailing_address"]; ?>, <?php echo $key["nama_city"]; ?>,
                                                    <?php echo $key["nama_province"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-column gap-1">
                                                <p class="f12">Deskripsi Toko</p>
                                                <p class="text-dark"><?php echo nl2br($key["description_id"]); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="card-footer">
                                <button data-target="#edit-toko-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="btn btnnew">Edit Toko</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-muted sticky-member">
                        <div class="card p-a-1">
                            <div class="row">
                                <?php foreach ($store as $key) : ?>
                                    <div class="col-lg text-center">
                                        <?php if ($key["logo"] !== null) { ?>
                                            <img src=" <?php echo base_url() ?>public/image/store/logo/<?php echo $key["logo"]; ?>" alt="Avatar" class="avatar-setting">
                                            <input type="text" name="logoBefore" form="formLogo" value="<?= $key["logo"]; ?>" hidden>
                                        <?php } else { ?>
                                            <img src="<?= $key["avatar"] == null ? base_url() . "public/image/noimage.png" : base_url() . "public/image/member/" . $key["avatar"] ?> " alt="Avatar" class="avatar-setting">
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg text-center m-t-1">
                                        <button data-toggle="modal" data-target="#edit-logo-<?php echo $key["member_id"]; ?>" class="btn btnnew">Edit Logo</button>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="row m-t-1">
                                <div class="col-lg">
                                    <div class="alert alert-warning f12">
                                        <h6 class="fbold"><?= $this->lang->line('note', FALSE); ?></h6>
                                        <ul class="mb-0" style="margin-left: -20px;">
                                            <li><?= $this->lang->line('notePicture1', FALSE); ?></li>
                                            <li><?= $this->lang->line('notePicture2', FALSE); ?></li>
                                            <li><?= $this->lang->line('notePicture3', FALSE); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="storeTab" role="tablist">
                            <li class="nav-item" role="presentation"><a class="btn btnnew active" id="desktop-store-tab" data-toggle="tab" data-target="#desktop-store" type="button" role="tab" aria-controls="desktop-store" aria-selected="true">Desktop</a></li>
                            <li class="nav-item" role="presentation"><a class="btn btnnew" id="mobile-store-tab" data-toggle="tab" data-target="#mobile-store" type="button" role="tab" aria-controls="mobile-store" aria-selected="false">Mobile</a></li>
                            <li class="nav-item" role="presentation"><a class="btn btnnew" id="description-store-tab" data-toggle="tab" data-target="#description-store" type="button" role="tab" aria-controls="description-store" aria-selected="false">Deskripsi</a></li>
                        </ul>
                    </div>
                    <div class="tab-content" id="storeTabContent">
                        <div class="tab-pane fade show active in" id="desktop-store" role="tabpanel" aria-labelledby="desktop-store-tab">
                            <div class="card-body p-a-1">
                                <?php foreach ($store as $key) : ?>
                                    <div class="row d-flex flex-column gap-3 p-b-0">
                                        <div class="col-lg-12">
                                            <h4 class="fbold">Desktop</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="d-flex flex-column gap-1">
                                                        <div class="d-flex-sb align-items-center">
                                                            <p class="text-dark f18">Template</p>
                                                            <a data-target="#edit-template-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Template</a>
                                                        </div>
                                                        <div class="text-left">Template <?php echo $key["template"]; ?></div>
                                                        <img src="<?= base_url() ?>public/template/template-layout-member/template-<?php echo $key["template"]; ?>.png" class="img-fluid rounded" style="max-height: max-content;border:1px solid black;">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="d-flex-sb align-items-center">
                                                        <p class="text-dark f18">Ganti Warna Text & Background</p>
                                                        <a data-target="#edit-warna-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Warna</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p class="text-dark f18">Cover</p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="d-flex flex-column gap-1">
                                                        <div class="d-flex-sb align-items-center">
                                                            <p class="f16">Desktop</p>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <a data-target="#edit-cover-desktop-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Cover</a>
                                                                <a href="<?= base_url() ?>member/store/delete_cover" class="text-danger pointer f16"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                        <img src="<?= $key['cover'] == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/cover/' . $key['cover']); ?>" alt="Default Cover" class="w-100">
                                                        <input form="formCover" type="text" name="nameCover" value="<?= $key['cover'] ?>" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4 class="fbold">Deskripsi</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="d-flex-sb align-items-center p-b-1">
                                                        <p class="f16">Deskripsi Cover Desktop</p>
                                                        <a data-target="#edit-cover-content-desktop-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ubah Deskripsi</a>
                                                    </div>
                                                    <table class="table table-striped f14">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Content</th>
                                                                <th>Image</th>
                                                                <th>Col Left</th>
                                                                <th>Col Right</th>
                                                                <th>Direction Image</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center va-middle"><?= $stores->title_cover ?></td>
                                                                <td class="text-center va-middle"><?= $stores->title_content ?></td>
                                                                <td class="text-center va-middle"><img src="<?= base_url() ?>public/image/store/coverimage/<?= $stores->title_image ?>" alt="image_cover" style="width:50px;"></td>
                                                                <td class="text-center va-middle"><?= $stores->col_left ?></td>
                                                                <td class="text-center va-middle"><?= $stores->col_right ?></td>
                                                                <form id="formToggleDirection">
                                                                    <td class="text-center va-middle">
                                                                        <input data-name="direction_image_cover_toggle" type="checkbox" name="direction_image[]" value="<?= $stores->id ?>" <?= $stores->direction_title_image == 1 ? 'checked' : '' ?> data-toggle="toggle" data-size="xs" data-on="Left" data-off="Right" data-onstyle="primary" data-offstyle="success" data-width="100">
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="text-dark f18">Banner Utama</p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="d-flex flex-column gap-1">
                                                                <div class="d-flex-sb align-items-center">
                                                                    <p class="f16">Desktop</p>
                                                                    <a data-target="#edit-banner-utama-desktop-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Banner</a>
                                                                </div>
                                                                <?php if ($bannerUtama != null) { ?>
                                                                    <div class="d-flex flex-column gap-1">
                                                                        <?php if ($bannerUtama[0]->source != null) { ?>
                                                                            <img src="<?= base_url('public/image/store/banner/' . $bannerUtama[0]->source); ?>" alt="Default Cover" class="w-100">
                                                                        <?php } else { ?>
                                                                            <div class="alert alert-warning">
                                                                                <p class="text-dark">Anda belum menambahkan banner</p>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <a href="<?= base_url('member/store/delete_banner/' . $bannerUtama[0]->id) ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                                                        <input form="formBannerUtama" type="text" name="nameBannerUtama" value="<?= $bannerUtama[0]->source ?>" hidden>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="alert alert-warning">
                                                                        <p class="text-dark">Anda belum menambahkan banner</p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <p class="f18 text-dark">Banner 1</p>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="d-flex flex-column gap-1">
                                                                        <div class="d-flex-sb align-items-center">
                                                                            <p class="f16">Desktop</p>
                                                                            <a data-target="#edit-banner-1-desktop-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Banner</a>
                                                                        </div>
                                                                        <?php if ($banner1 != null) { ?>
                                                                            <div class="d-flex flex-column gap-1">
                                                                                <img src="<?= base_url('public/image/store/banner/' . $banner1[0]->source); ?>" alt="Default Cover" class="w-100">
                                                                                <a href="<?= base_url('member/store/delete_banner/' . $banner1[0]->id) ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                                                                <input form="formBanner1" type="text" name="nameBanner1" value="<?= $banner1[0]->source ?>" hidden>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="alert alert-warning">
                                                                                <p class="text-dark">Anda belum menambahkan banner</p>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <p class="f18 text-dark">Banner 2</p>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="d-flex flex-column gap-1">
                                                                        <div class="d-flex-sb align-items-center">
                                                                            <p class="f16">Desktop</p>
                                                                            <a data-target="#edit-banner-2-desktop-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Banner</a>
                                                                        </div>
                                                                        <?php if ($banner2 != null) { ?>
                                                                            <div class="d-flex flex-column gap-1">
                                                                                <img src="<?= base_url('public/image/store/banner/' . $banner2[0]->source); ?>" alt="Default Cover" class="w-100">
                                                                                <a href="<?= base_url('member/store/delete_banner/' . $banner2[0]->id) ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                                                                <input form="formBanner2" type="text" name="nameBanner2" value="<?= $banner2[0]->source ?>" hidden>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="alert alert-warning">
                                                                                <p class="text-dark">Anda belum menambahkan banner</p>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="mobile-store" role="tabpanel" aria-labelledby="mobile-store-tab">
                            <div class="card-body p-a-1">
                                <?php foreach ($store as $key) : ?>
                                    <div class="row d-flex flex-column gap-3 p-b-0">
                                        <div class="col-lg-12">
                                            <h4 class="fbold">Mobile</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p class="text-dark f18">Cover</p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="d-flex flex-column gap-1">
                                                        <div class="d-flex-sb align-items-center">
                                                            <p class="f16">Mobile</p>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <a data-target="#edit-cover-mobile-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Cover</a>
                                                                <a href="<?= base_url() ?>member/store/delete_cover_mobile" data-toggle="modal" class="text-danger pointer f16"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                        <img src="<?= $key['cover_mobile'] == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/cover/' . $key['cover_mobile']); ?>" alt="Default Cover" class="w-100">
                                                        <input form="formCoverMobile" type="text" name="nameCover" value="<?= $key['cover_mobile'] ?>" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4 class="fbold">Deskripsi</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="d-flex-sb align-items-center p-b-1">
                                                        <p class="f18 fbold">Deskripsi Cover Mobile</p>
                                                        <a data-target="#edit-cover-content-mobile-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ubah Deskripsi</a>
                                                    </div>
                                                    <table class="table table-striped f14">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Content</th>
                                                                <th>Image</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center va-middle"><?= $stores->title_cover_mobile ?></td>
                                                                <td class="text-center va-middle"><?= $stores->title_content_mobile ?></td>
                                                                <td class="text-center va-middle"><img src="<?= base_url() ?>public/image/store/coverimage/mobile/<?= $stores->title_image_mobile ?>" alt="image_cover" style="width:50px;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="text-dark f18">Banner Utama</p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="d-flex flex-column gap-1">
                                                                <div class="d-flex-sb align-items-center">
                                                                    <p class="f16">Mobile</p>
                                                                    <a data-target="#edit-banner-utama-mobile-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Banner</a>
                                                                </div>
                                                                <?php if ($bannerUtamaMobile != null) { ?>
                                                                    <div class="d-flex flex-column gap-1">
                                                                        <img src="<?= base_url('public/image/store/banner/' . $bannerUtamaMobile[0]->source); ?>" alt="Default Cover" class="w-100">
                                                                        <a href="<?= base_url('member/store/delete_banner/' . $bannerUtamaMobile[0]->id) ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                                                        <input form="formBannerUtamaMobile" type="text" name="nameBannerUtama" value="<?= $bannerUtamaMobile[0]->source ?>" hidden>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="alert alert-warning">
                                                                        <p class="text-dark">Anda belum menambahkan banner</p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="f18 text-dark">Banner 1</p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="d-flex flex-column gap-1">
                                                                <div class="d-flex-sb align-items-center">
                                                                    <p class="f16">Mobile</p>
                                                                    <a data-target="#edit-banner-1-mobile-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Banner</a>
                                                                </div>
                                                                <?php if ($banner1Mobile != null) { ?>
                                                                    <div class="d-flex flex-column gap-1">
                                                                        <img src="<?= base_url('public/image/store/banner/' . $banner1Mobile[0]->source); ?>" alt="Default Cover" class="w-100">
                                                                        <a href="<?= base_url('member/store/delete_banner/' . $banner1Mobile[0]->id) ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                                                        <input form="formBanner1Mobile" type="text" name="nameBanner1" value="<?= $banner1Mobile[0]->source ?>" hidden>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="alert alert-warning">
                                                                        <p class="text-dark">Anda belum menambahkan banner</p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="f18 text-dark">Banner 2</p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="d-flex flex-column gap-1">
                                                                <div class="d-flex-sb align-items-center">
                                                                    <p class="f16">Mobile</p>
                                                                    <a data-target="#edit-banner-2-mobile-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Ganti Banner</a>
                                                                </div>
                                                                <?php if ($banner2Mobile != null) { ?>
                                                                    <div class="d-flex flex-column gap-1">
                                                                        <img src="<?= base_url('public/image/store/banner/' . $banner2Mobile[0]->source); ?>" alt="Default Cover" class="w-100">
                                                                        <a href="<?= base_url('member/store/delete_banner/' . $banner2Mobile[0]->id) ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                                                        <input form="formBanner2Mobile" type="text" name="nameBanner2" value="<?= $banner2Mobile[0]->source ?>" hidden>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="alert alert-warning">
                                                                        <p class="text-dark">Anda belum menambahkan banner</p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="description-store" role="tabpanel" aria-labelledby="description-store-tab">
                            <div class="card-body p-a-1">
                                <?php foreach ($store as $key) : ?>
                                    <div class="row d-flex flex-column gap-3 p-b-0">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="d-flex-sb align-items-center p-b-1">
                                                        <p class="text-dark f18 fbold">Deskripsi tambahan</p>
                                                        <a data-target="#tambah-desc-<?php echo $key["member_id"]; ?>" data-toggle="modal" class="color-primary pointer f16">Tambah Deskripsi</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <table class="table table-striped f14" style="width:100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:20%;">Title</th>
                                                                <th style="width:30%;">Content</th>
                                                                <th style="width:20%;">Image</th>
                                                                <th style="width:10%;">Icon</th>
                                                                <th style="width:8%;">Image/Icon</th>
                                                                <th style="width:7%;">Direction</th>
                                                                <th style="width:5%;">action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($stores->descriptions as $desc) : ?>
                                                                <tr>
                                                                    <td><?= $desc->title ?> (<?= $desc->index ?>)</td>
                                                                    <?php $str = str_split($desc->content, 85); ?>
                                                                    <td><?= count($str) > 1 ? $str[0] . ' <a class="color-primary pointer" data-target="#detail-desc-' . $desc->id . '" data-toggle="modal">lihat detail</a>' : $str[0] ?></td>
                                                                    <?php if ($desc->image == null) { ?>
                                                                        <td class="text-center va-middle">
                                                                            <p>Belum Menambahkan Gambar</p>
                                                                        </td>
                                                                    <?php } else { ?>
                                                                        <td class="text-center va-middle"><img src="<?= base_url() ?>public/image/store/desc/<?= $desc->image ?>" alt="image_desc" style="width:50px;"></td>
                                                                    <?php } ?>
                                                                    <td class="text-center va-middle"><i class="fa fa-<?= $desc->icon ?>"></i></td>
                                                                    <form id="formToggleSwitch">
                                                                        <td class="text-center va-middle">
                                                                            <input data-name="is_image_toggle" type="checkbox" name="is_image[]" value="<?= $desc->id ?>" <?= $desc->is_image == 1 ? 'checked' : '' ?> data-toggle="toggle" data-size="xs" data-on="Image" data-off="Icon" data-onstyle="primary" data-offstyle="success" data-width="100">
                                                                        </td>
                                                                    </form>
                                                                    <form id="formToggleDirection">
                                                                        <td class="text-center va-middle">
                                                                            <input data-name="direction_image_toggle" type="checkbox" name="direction_image[]" value="<?= $desc->id ?>" <?= $desc->direction_image == 1 ? 'checked' : '' ?> data-toggle="toggle" data-size="xs" data-on="Left" data-off="Right" data-onstyle="primary" data-offstyle="success" data-width="100">
                                                                        </td>
                                                                    </form>
                                                                    <td class="text-center va-middle">
                                                                        <div class="d-flex gap-2 align-items-center">
                                                                            <a href="" data-target="#edit-desc-<?= $desc->id ?>" data-toggle="modal" class="text-warning f18"><i class="fa fa-edit"></i></a>
                                                                            <a href="<?= base_url() ?>member/store/delete_description/<?= $desc->id ?>" class="text-danger f18"><i class="fa fa-trash"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-logo-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Logo
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_logo_store" method="POST" enctype="multipart/form-data" id="formLogo">
                <div class="modal-body">
                    <div class="row d-flex flex-column">
                        <div class="col-lg-12">
                            <div class="row d-flex">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Logo</label>
                                    <input type="file" id="uploadBtn" name="logo" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <div class="col-lg-8">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 300 x 300px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-toko-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Toko
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/update_store" method="POST" class="settingstore">
                <?php foreach ($store as $key) : ?>
                    <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                        <div class="row d-flex flex-column gap-2">
                            <div class="col-lg-12">
                                <input type="hidden" name="id_member" value="<?php echo $sessionmember["id"]; ?>" />
                                <label class="fbold" for="nameStore">Nama Toko</label>
                                <input id="nameStore" type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="<?php echo $key["name"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="domain">Domain</label>
                                <input type="text" name="domain" class="form-control" placeholder="Domain" value="<?php echo $key["domain"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="npwp">NPWP</label>
                                <input id="npwp" type="text" name="npwp" class="form-control" placeholder="NPWP" value="<?php echo $key["npwp"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="email">Email</label>
                                <input id="email" type="text" name="company_email" class="form-control" placeholder="Email Perusahaan" value="<?php echo $key["email"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="phone">Telepon</label>
                                <input id="phone" type="text" name="company_phone" class="form-control" placeholder="Telepon Perusahaan" value="<?php echo $key["phone"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="content">Deskripsi Toko</label>
                                <textarea type="text" class="form-control" name="description_store"><?= $key["description_id"]; ?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="pic">PIC</label>
                                <input id="pic" type="text" name="pic" class="form-control" placeholder="PIC Toko" value="<?php echo $key["mailing_pic"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="picPosition">Jabatan PIC</label>
                                <input id="picPosition" type="text" name="position" class="form-control" placeholder="PIC Toko" value="<?php echo $key["mailing_position"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="picPhone">Nomor Telepon PIC</label>
                                <input id="picPhone" type="text" name="phone_pic" class="form-control" placeholder="Nomor PIC Toko" value="<?php echo $key["mailing_phone"]; ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="country">Negara</label>
                                <select id="country" name="country" class="form-control" required value="<?php echo $key["mailing_country"]; ?>">
                                    <option value="">--Pilih Negara--</option>
                                    <option value="1" <?= ($key['mailing_country'] == 1) ? "selected" : ""; ?>>Indonesia</option>
                                    <option value="2" <?= ($key['mailing_country'] == 2) ? "selected" : ""; ?>>Singapura</option>
                                    <option value="3" <?= ($key['mailing_country'] == 3) ? "selected" : ""; ?>>Malaysia</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="province">Provinsi</label>
                                <select name="province" class="form-control" required id="<?php echo $key["mailing_province"] ?>">
                                    <option value="">--Pilih Provinsi--</option>
                                    <?php foreach ($provinces as $keys) : ?>
                                        <option value="<?php echo $keys["id"] ?>"><?php echo $keys["name"] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="district">Kabupaten</label>
                                <select name="city" class="form-control" required id="<?php echo $key["mailing_city"] ?>">
                                    <option value="">--Pilih Kabupaten--</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="address">Alamat</label>
                                <input id="address" type="text" name="address" value="<?php echo $key["mailing_address"] ?>" class="form-control" placeholder="Alamat" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold" for="zipCode">Kode Pos</label>
                                <input id="zipCode" type="number" name="zipcode" value="<?php echo $key["mailing_zipcode"] ?>" class="form-control" placeholder="Kode Pos" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btnnew">Simpan</button>
                    </div>
                <?php endforeach ?>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-cover-content-desktop-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Deskripsi Cover
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/update_title_cover" method="POST" class="settingstore" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label class="fbold f18" for="title_cover">Title</label>
                                    <input type="text" name="title_cover" class="form-control" placeholder="Title" value="<?= $stores->title_cover; ?>" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="colorTitleCover">Warna Text Title Cover</label>
                                    <div class="d-flex gap-1 align-items-center">
                                        <input type="color" name="colorTitleCover" id="colorTitleCover" value="<?= $stores->color_title_cover ?>">
                                        <input disabled type="text" class="form-control" id="afterColorTitleCover" value="<?= $stores->color_title_cover ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label class="fbold f18" for="title_content">Content</label>
                                    <input type="text" name="title_content" class="form-control" placeholder="Content" value="<?= $stores->title_content; ?>" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="colorContentCover">Warna Content Cover</label>
                                    <div class="d-flex gap-1 align-items-center">
                                        <input type="color" name="colorContentCover" id="colorContentCover" value="<?= $stores->color_title_content ?>">
                                        <input disabled type="text" class="form-control" id="afterColorContentCover" value="<?= $stores->color_title_content ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="uploadBtn">Image</label>
                                    <input type="file" id="uploadBtn" name="titleImage" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="titleImage" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <div class="col-lg-4">
                                    <p class="fbold">Gambar Saat Ini</p>
                                    <img src="<?= base_url() ?>public/image/store/coverimage/<?= $stores->title_image ?>" style="max-height: 100px;">
                                </div>
                                <div class="col-lg-4">
                                    <p class="fbold">Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex flex-column gap-1">
                            <label for="direction_title_image" class="fbold f18">Template Card Deskripsi</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="direction_title_image" id="direction_title_image1" value="0" <?= $stores->direction_title_image == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="direction_title_image1">
                                        <div class="text-left">Template Image Cover Right</div>
                                        <img src="<?= base_url() ?>public/template/template-layout-member/direction_title_image_right.png" class="img-fluid rounded" style="max-height: 220px;border:1px solid black;">
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="direction_title_image" id="direction_title_image2" value="1" <?= $stores->direction_title_image == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="direction_title_image2">
                                        <div class="text-left">Template Image Cover Left</div>
                                        <img src="<?= base_url() ?>public/template/template-layout-member/direction_title_image_left.png" class="img-fluid rounded" style="max-height: 220px;border:1px solid black;">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="fbold">Atur Lebar Kolom</h4>
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold" for="col_left">Lebar Kolom Kiri</label>
                                    <select name="col_left" id="col_left" class="form-control">
                                    </select>
                                    <input type="hidden" name="value_col_left" id="value_col_left" class="value_col_left" value="<?= $stores->col_left == 0 ? 6 : $stores->col_left ?>">
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold" for="col_right">Lebar Kolom Kanan</label>
                                    <select name="col_right" id="col_right" class="form-control">
                                    </select>
                                    <input type="hidden" name="value_col_right" id="value_col_right" class="value_col_right" value="<?= $stores->col_right == 0 ? 6 : $stores->col_right ?>">
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold" for="col_right">Contoh</label>
                                    <img src="<?= base_url() ?>public/template/template-layout-member/column_cover.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                </div>
                            </div>
                        </div>.

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-cover-content-mobile-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Deskripsi Cover Mobile
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/update_title_cover_mobile" method="POST" class="settingstore" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label class="fbold f18" for="title_cover_mobile">Title</label>
                                    <input type="text" name="title_cover_mobile" class="form-control" placeholder="Title" value="<?= $stores->title_cover_mobile; ?>" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="colorTitleCoverMobile">Warna Text Title Cover</label>
                                    <div class="d-flex gap-1 align-items-center">
                                        <input type="color" name="colorTitleCoverMobile" id="colorTitleCoverMobile" value="<?= $stores->color_title_cover_mobile ?>">
                                        <input disabled type="text" class="form-control" id="afterColorTitleCoverMobile" value="<?= $stores->color_title_cover_mobile ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label class="fbold f18" for="title_content_mobile">Content</label>
                                    <input type="text" name="title_content_mobile" class="form-control" placeholder="Content" value="<?= $stores->title_content_mobile; ?>" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="colorContentCoverMobile">Warna Content Cover</label>
                                    <div class="d-flex gap-1 align-items-center">
                                        <input type="color" name="colorContentCoverMobile" id="colorContentCoverMobile" value="<?= $stores->color_title_content_mobile ?>">
                                        <input disabled type="text" class="form-control" id="afterColorContentCoverMobile" value="<?= $stores->color_title_content_mobile ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="uploadBtn">Image</label>
                                    <input type="file" id="uploadBtn" name="titleImageMobile" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="titleImageMobile" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <div class="col-lg-4">
                                    <p class="fbold">Gambar Saat Ini</p>
                                    <img src="<?= base_url() ?>public/image/store/coverimage/mobile/<?= $stores->title_image_mobile ?>" style="max-height: 100px;">
                                </div>
                                <div class="col-lg-4">
                                    <p class="fbold">Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-template-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Ganti Template
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/edit_template" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                    <div class="row p-x-1 d-flex flex-column gap-2">
                        <?php foreach ($store as $value) : ?>
                            <div class="col-lg d-flex flex-column gap-1 align-items-start">
                                <label class="d-block fbold f18">Template</label>
                                <div class="col-lg d-flex gap-3 align-items-start">
                                    <div class="form-check form-check-inline m-r-1">
                                        <input class="form-check-input" type="radio" name="template" id="template1" value="1" <?= $value['template'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="template1">
                                            <div class="text-left">Template 1</div>
                                            <img src="<?= base_url() ?>public/template/template-layout-member/template-1.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline m-r-1">
                                        <input class="form-check-input" type="radio" name="template" id="template2" value="2" <?= $value['template'] == 2 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="template2">
                                            <div class="text-left">Template 2</div>
                                            <img src="<?= base_url() ?>public/template/template-layout-member/template-2.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg d-flex flex-column gap-1">
                                <label for="template_produk" class="fbold f18">Template Produk</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="template_produk" id="template_produk1" value="1" <?= $value['template_produk'] == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="template_produk1">
                                        <div class="text-left">Template Table Produk</div>
                                        <img src="<?= base_url() ?>public/template/template-layout-member/table-product.png" class="img-fluid rounded" style="max-height: 220px;border:1px solid black;">
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="template_produk" id="template_produk2" value="2" <?= $value['template_produk'] == 2 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="template_produk2">
                                        <div class="text-left">Template Card Produk</div>
                                        <img src="<?= base_url() ?>public/template/template-layout-member/card-product.png" class="img-fluid rounded" style="max-height: 220px;border:1px solid black;">
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($stores->styles as $style) : ?>
                            <div class="col-lg d-flex flex-column gap-1">
                                <label for="direction_card" class="fbold f18">Template Card Deskripsi</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="direction_card" id="direction_card1" value="1" <?= $style->direction_card == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="direction_card1">
                                            <div class="text-left">Template Row</div>
                                            <img src="<?= base_url() ?>public/template/template-layout-member/direction_card_row.png" class="img-fluid rounded" style="max-height: 220px;border:1px solid black;">
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="direction_card" id="direction_card2" value="2" <?= $style->direction_card == 2 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="direction_card2">
                                            <div class="text-left">Template Column</div>
                                            <img src="<?= base_url() ?>public/template/template-layout-member/direction_card_column.png" class="img-fluid rounded" style="max-height: 220px;border:1px solid black;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-warna-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Ganti Warna
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/edit_warna_store" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                    <div class="row d-flex flex-column gap-2 p-x-1">
                        <?php foreach ($stores->styles as $style) : ?>

                            <div class="col-lg">
                                <div class="row">
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorBg">Warna Background</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorBg" id="colorBg" value="<?= $style->color_bg ?>">
                                            <input disabled type="text" class="form-control" id="afterColorBg" value="<?= $style->color_bg ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorTextContent">Warna Text Content</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorTextContent" id="colorTextContent" value="<?= $style->color_text_content ?>">
                                            <input disabled type="text" class="form-control" id="afterColorTextContent" value="<?= $style->color_text_content ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorTextTitle">Warna Text Title</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorTextTitle" id="colorTextTitle" value="<?= $style->color_text_title ?>">
                                            <input disabled type="text" class="form-control" id="afterColorTextTitle" value="<?= $style->color_text_title ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorButton">Warna Button</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorButton" id="colorButton" value="<?= $style->color_button ?>">
                                            <input disabled type="text" class="form-control" id="afterColorButton" value="<?= $style->color_button ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="row">
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorNav">Warna NavBar</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorNav" id="colorNav" value="<?= $style->color_nav ?>">
                                            <input disabled type="text" class="form-control" id="afterColorNav" value="<?= $style->color_nav ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorNavText">Warna Text Navbar</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorNavText" id="colorNavText" value="<?= $style->color_nav_text ?>">
                                            <input disabled type="text" class="form-control" id="afterColorNavText" value="<?= $style->color_nav_text ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="row">

                                    <div class="col-lg-4 d-flex flex-column">
                                        <label class="fbold f11" for="colorCardDescription">Warna Border Card Deskripsi</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorCardDescription" id="colorCardDescription" value="<?= $style->color_card_description ?>">
                                            <input disabled type="text" class="form-control" id="afterColorCardDescription" value="<?= $style->color_card_description ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex flex-column">
                                        <label class="fbold f11" for="colorCardTitle">Warna Text Title Deskripsi</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorCardTitle" id="colorCardTitle" value="<?= $style->color_card_title ?>">
                                            <input disabled type="text" class="form-control" id="afterColorCardTitle" value="<?= $style->color_card_title ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex flex-column">
                                        <label class="fbold f11" for="colorCardContent">Warna Text Content Deskripsi</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorCardContent" id="colorCardContent" value="<?= $style->color_card_content ?>">
                                            <input disabled type="text" class="form-control" id="afterColorCardContent" value="<?= $style->color_card_content ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="row">

                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorTextNameCategory">Warna Text Name Category</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorTextNameCategory" id="colorTextNameCategory" value="<?= $style->color_text_name_category ?>">
                                            <input disabled type="text" class="form-control" id="afterColorTextNameCategory" value="<?= $style->color_text_name_category ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorTextNameProduct">Warna Text Product</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorTextNameProduct" id="colorTextNameProduct" value="<?= $style->color_text_name_product ?>">
                                            <input disabled type="text" class="form-control" id="afterColorTextNameProduct" value="<?= $style->color_text_name_product ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="row">

                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorCardProduct">Warna Card Product</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorCardProduct" id="colorCardProduct" value="<?= $style->color_card_product ?>">
                                            <input disabled type="text" class="form-control" id="afterColorCardProduct" value="<?= $style->color_card_product ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <label class="fbold f11" for="colorTextCardProduct">Warna Text Card Product</label>
                                        <div class="d-flex gap-1 align-items-center">
                                            <input type="color" name="colorTextCardProduct" id="colorTextCardProduct" value="<?= $style->color_text_card_product ?>">
                                            <input disabled type="text" class="form-control" id="afterColorTextCardProduct" value="<?= $style->color_text_card_product ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah-desc-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Tambah Deskripsi
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/tambah_description" method="POST" enctype="multipart/form-data" id="formCover">
                <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                    <div class="row d-flex flex-column gap-3">
                        <div class="col-lg-12">
                            <label class="fbold f18" for="title">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="col-lg-12">
                            <label class="fbold f18" for="title_direction">Direction Title</label>
                            <select type="text" class="form-control" name="title_direction">
                                <option value="left" selected>Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label class="fbold f18" for="content">Content</label>
                            <textarea type="text" class="form-control" id="contentDescription" name="content"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="fbold f18" for="is_image">Tipe yang ingin ditampilkan</label>
                            <div class="d-flex flex-row gap-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_image" id="is_image" value="1" checked>
                                    <label class="form-check-label" for="is_image">Image</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_image" id="is_icon" value="0">
                                    <label class="form-check-label" for="is_icon">Icon</label>
                                </div>
                            </div>
                        </div>

                        <!-- Div untuk Image -->
                        <div class="col-lg-12 image-section">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold f18" for="uploadBtn">Image Desc</label>
                                    <input type="file" id="uploadBtn" name="image_desc" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="image_desc" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <div class="col-lg-4 text-muted">
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>

                        <!-- Div untuk Icon -->
                        <div class="col-lg-12 icon-section">
                            <label for="icon">Icon <a href="https://fontawesome.com/v4/icons" target="_blank" class="f18 fbold">Cek Icon</a></label>
                            <input type="text" class="form-control" name="icon" placeholder="Contoh: star, user, heart">
                        </div>

                        <div class="col-lg-12">
                            <label class="fbold f18" for="index">Index</label>
                            <input type="text" class="form-control" name="index">
                        </div>
                        <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                            <label class="d-block d-flex flex-column fbold f18">Direction Image <small class="fred">NB : Jika ingin mengubah ini Harus memilih template card column pada template desktop</small></label>
                            <div class="col-lg d-flex gap-3 align-items-start">
                                <div class="form-check form-check-inline m-r-1">
                                    <input class="form-check-input" type="radio" name="direction_image" id="direction_image1" value="0" checked>
                                    <label class="form-check-label" for="direction_image1">
                                        <div class="text-left">Template Image Right</div>
                                        <img src="<?= base_url() ?>public/template/template-layout-member/direction_image_right.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline m-r-1">
                                    <input class="form-check-input" type="radio" name="direction_image" id="direction_image2" value="1">
                                    <label class=" form-check-label" for="direction_image2">
                                        <div class="text-left">Template Image Left</div>
                                        <img src="<?= base_url() ?>public/template/template-layout-member/direction_image_left.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($stores->descriptions as $modalStore) : ?>
    <div class="modal fade" id="edit-desc-<?= $modalStore->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fbold" id="exampleModalLabel">Edit Description
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>
                </div>
                <form action="<?php echo base_url() ?>member/store/edit_description/<?= $modalStore->id ?>" method="POST" enctype="multipart/form-data" id="formCover">
                    <div class="modal-body" style="max-height: 50vh; overflow-y:scroll;">
                        <div class="row d-flex flex-column gap-2">
                            <div class="col-lg-12">
                                <label class="fbold f18" for="title">Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $modalStore->title ?>">
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold f18" for="title_direction">Direction Title</label>
                                <select type="text" class="form-control" name="title_direction">
                                    <option value="left" <?= $modalStore->title_direction == 'left' ? 'selected' : '' ?>>Left</option>
                                    <option value="center" <?= $modalStore->title_direction == 'center' ? 'selected' : '' ?>>Center</option>
                                    <option value="right" <?= $modalStore->title_direction == 'right' ? 'selected' : '' ?>>Right</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold f18" for="content">Content</label>
                                <textarea type="text" class="form-control content-edit-description" data-id="<?= $modalStore->id ?>" id="contentEditDescription-<?= $modalStore->id ?>" name="content"><?= $modalStore->content ?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold f18" for="is_image">Tipe yang ingin ditampilkan</label>
                                <div class="d-flex flex-row gap-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_image" id="is_image" value="1" <?= $modalStore->is_image == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_image">Image</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_image" id="is_icon" value="0" <?= $modalStore->is_image == 0 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_icon">Icon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 image-section">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="fbold f18" for="uploadBtn">Image Desc</label>
                                        <input type="file" id="uploadBtn" name="image_desc" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                        <a href="#" id="filetext" name="image_desc" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                    </div>
                                    <div class="col-lg-4 text-muted">
                                        <img src="" class="blah img-fluid" style="max-height: 100px;">
                                    </div>
                                    <input type="hidden" name="nameImage" value="<?= $modalStore->image ?>">
                                </div>
                            </div>
                            <div class="col-lg-12 icon-section">
                                <label class="fbold f18" for="icon">Icon <a href="https://fontawesome.com/v4/icons" target="_blank" class="f12">Cek Icon</a></label>
                                <input type="text" class="form-control" name="icon" value="<?= $modalStore->icon ?>">
                            </div>
                            <div class="col-lg-12">
                                <label class="fbold f18" for="index">Index</label>
                                <input type="text" class="form-control" name="index" value="<?= $modalStore->index ?>">
                            </div>
                            <div class="col-lg-12 d-flex flex-column gap-1 align-items-start">
                                <label class="d-block d-flex flex-column fbold f18">Direction Image <small class="fred">NB : Jika ingin mengubah ini Harus memilih template card column pada template desktop</small></label>
                                <div class="col-lg d-flex gap-3 align-items-start">
                                    <div class="form-check form-check-inline m-r-1">
                                        <input class="form-check-input" type="radio" name="direction_image" id="direction_image1" value="0" <?= $modalStore->direction_image == 0  ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="direction_image1">
                                            <div class="text-left">Template Image Right</div>
                                            <img src="<?= base_url() ?>public/template/template-layout-member/direction_image_right.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline m-r-1">
                                        <input class="form-check-input" type="radio" name="direction_image" id="direction_image2" value="1" <?= $modalStore->direction_image == 1 ? 'checked' : '' ?>>
                                        <label class=" form-check-label" for="direction_image2">
                                            <div class="text-left">Template Image Left</div>
                                            <img src="<?= base_url() ?>public/template/template-layout-member/direction_image_left.png" class="img-fluid rounded" style="max-height: 250px;border:1px solid black;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btnnew">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($stores->descriptions as $modalDesc) : ?>
    <div class="modal fade" id="detail-desc-<?= $modalDesc->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fbold" id="exampleModalLabel">Detail Deskripsi
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <p><?= $modalDesc->content ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<div class="modal fade" id="edit-cover-desktop-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Cover
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_cover_store" method="POST" enctype="multipart/form-data" id="formCover">
                <div class="modal-body">
                    <div class="row p-x-1 d-flex flex-column gap-1">
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-4">
                                    <small>Gambar(.jpg)/File(.pdf)</small>
                                    <input type="file" id="uploadBtn" name="cover" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <div class="col-lg-4">
                                    <p>Gambar Saat Ini</p>
                                    <img src="<?= base_url() ?>public/image/store/cover/<?= $stores->cover ?>" class="img-fluid" style="max-height: 100px;">
                                </div>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 1440 x 300px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-cover-mobile-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Cover
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_cover_store_mobile" method="POST" enctype="multipart/form-data" id="formCoverMobile">
                <div class="modal-body">
                    <div class="row d-flex flex-column gap-1 p-x-1">
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-4">
                                    <small>Gambar(.jpg)/File(.pdf)</small>
                                    <input type="file" id="uploadBtn" name="cover" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <div class="col-lg-4">
                                    <p>Gambar Saat Ini</p>
                                    <img src="<?= $stores->cover_mobile == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/cover/' . $stores->cover_mobile); ?>" class="img-fluid" style="max-height: 100px;">
                                </div>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 390 x 250px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-banner-utama-desktop-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Banner Utama
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_banner_utama" method="POST" enctype="multipart/form-data" id="formBannerUtama">
                <div class="modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <input type="text" name="idBanner" value="<?= isset($bannerUtama[0]) ? $bannerUtama[0]->id : '' ?>" hidden>
                            <label class="fbold" for="link">Link</label>
                            <select name="link" id="link" class="form-control">
                                <option value="#">Tidak Ada</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?= $product['id'] ?>" <?php if (isset($bannerUtama[0])) {
                                                                                if ($bannerUtama[0]->link == $product['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }; ?>><?= $product['tittle'] ?> <?= $product['partnumber'] == '' ? '' : '- ' . $product['partnumber'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Gambar</label>
                                    <input type="file" id="uploadBtn" name="bannerUtama" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <?php if (isset($bannerUtama[0])) : ?>
                                    <div class="col-lg-4">
                                        <p>Gambar Saat Ini</p>
                                        <img src="<?= $bannerUtama[0]->source == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/banner/' . $bannerUtama[0]->source); ?>" alt="Default Cover" style="max-height:100px">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 1170 x 400px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-banner-utama-mobile-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Banner Utama
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_banner_utama_mobile" method="POST" enctype="multipart/form-data" id="formBannerUtamaMobile">
                <div class="modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <input type="text" name="idBanner" value="<?= isset($bannerUtamaMobile[0]) ? $bannerUtamaMobile[0]->id : '' ?>" hidden>
                            <label class="fbold" for="link">Link</label>
                            <select name="link" id="link" class="form-control">
                                <option value="#">Tidak Ada</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?= $product['id'] ?>" <?php if (isset($bannerUtamaMobile[0])) {
                                                                                if ($bannerUtamaMobile[0]->link == $product['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }; ?>><?= $product['tittle'] ?> <?= $product['partnumber'] == '' ? '' : '- ' . $product['partnumber'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Gambar</label>
                                    <input type="file" id="uploadBtn" name="bannerUtama" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <?php if (isset($bannerUtamaMobile[0])) : ?>
                                    <div class="col-lg-4">
                                        <p>Gambar Saat Ini</p>
                                        <img src="<?= base_url('public/image/store/banner/' . $bannerUtamaMobile[0]->source); ?>" alt="Default Cover" style="max-height:100px">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 360 x 200px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-banner-1-desktop-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Banner 1
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_banner_1" method="POST" enctype="multipart/form-data" id="formBanner1">
                <div class="modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <input type="text" name="idBanner" value="<?= isset($banner1[0]) ? $banner1[0]->id : '' ?>" hidden>
                            <label class="fbold" for="link">Link</label>
                            <select name="link" id="link" class="form-control">
                                <option value="#">Tidak Ada</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?= $product['id'] ?>" <?php if (isset($banner1[0])) {
                                                                                if ($banner1[0]->link == $product['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }; ?>><?= $product['tittle'] ?> <?= $product['partnumber'] == '' ? '' : '- ' . $product['partnumber'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Gambar</label>
                                    <input type="file" id="uploadBtn" name="banner1" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <?php if (isset($banner1[0])) : ?>
                                    <div class="col-lg-4">
                                        <p>Gambar Saat Ini</p>
                                        <img src="<?= $banner1[0]->source == null ? base_url('public/image/default-cover.png') : base_url('public/image/store/banner/' . $banner1[0]->source); ?>" alt="Default Cover" style="max-height:100px">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="f12">Jika 1 Banner</p>
                                <p class="text-dark">Size : 1170 x 200px</p>
                                <p class="f12">Jika 2 Banner</p>
                                <p class="text-dark">Size : 570 x 200px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-banner-1-mobile-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Banner 1 Mobile
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_banner_1_mobile" method="POST" enctype="multipart/form-data" id="formBanner1Mobile">
                <div class=" modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <input type="text" name="idBanner" value="<?= isset($banner1Mobile[0]) ? $banner1Mobile[0]->id : '' ?>" hidden>
                            <label class="fbold" for="link">Link</label>
                            <select name="link" id="link" class="form-control">
                                <option value="#">Tidak Ada</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?= $product['id'] ?>" <?php if (isset($banner1Mobile[0])) {
                                                                                if ($banner1Mobile[0]->link == $product['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }; ?>><?= $product['tittle'] ?> <?= $product['partnumber'] == '' ? '' : '- ' . $product['partnumber'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Gambar</label>
                                    <input type="file" id="uploadBtn" name="banner1" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <?php if (isset($banner1Mobile[0])) : ?>
                                    <div class="col-lg-4">
                                        <p>Gambar Saat Ini</p>
                                        <img src="<?= base_url('public/image/store/banner/' . $banner1Mobile[0]->source); ?>" alt="Default Cover" style="max-height:100px">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 360 x 100px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-banner-2-desktop-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Banner 2
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_banner_2" method="POST" enctype="multipart/form-data" id="formBanner2">
                <div class=" modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <input type="text" name="idBanner" value="<?= isset($banner2[0]) ? $banner2[0]->id : '' ?>" hidden>
                            <label class="fbold" for="link">Link</label>
                            <select name="link" id="link" class="form-control">
                                <option value="#">Tidak Ada</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?= $product['id'] ?>" <?php if (isset($banner2[0])) {
                                                                                if ($banner2[0]->link == $product['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }; ?>><?= $product['tittle'] ?> <?= $product['partnumber'] == '' ? '' : '- ' . $product['partnumber'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Gambar</label>
                                    <input type="file" id="uploadBtn" name="banner2" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <?php if (isset($banner2[0])) : ?>
                                    <div class="col-lg-4">
                                        <p>Gambar Saat Ini</p>
                                        <img src="<?= base_url('public/image/store/banner/' . $banner2[0]->source); ?>" alt="Default Cover" style="max-height:100px">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="f12">Jika 1 Banner</p>
                                <p class="text-dark">Size : 1170 x 200px</p>
                                <p class="f12">Jika 2 Banner</p>
                                <p class="text-dark">Size : 570 x 200px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-banner-2-mobile-<?php echo $sessionmember["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fbold" id="exampleModalLabel">Edit Banner 2 Mobile
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <form action="<?php echo base_url() ?>member/store/upload_banner_2_mobile" method="POST" enctype="multipart/form-data" id="formBanner2Mobile">
                <div class=" modal-body">
                    <div class="row d-flex flex-column gap-2">
                        <div class="col-lg-12">
                            <input type="text" name="idBanner" value="<?= isset($banner2Mobile[0]) ? $banner2Mobile[0]->id : '' ?>" hidden>
                            <label class="fbold" for="link">Link</label>
                            <select name="link" id="link" class="form-control">
                                <option value="#">Tidak Ada</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?= $product['id'] ?>" <?php if (isset($banner2Mobile[0])) {
                                                                                if ($banner2Mobile[0]->link == $product['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }; ?>><?= $product['tittle'] ?> <?= $product['partnumber'] == '' ? '' : '- ' . $product['partnumber'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="fbold" for="uploadBtn">Gambar</label>
                                    <input type="file" id="uploadBtn" name="banner2" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
                                    <a href="#" id="filetext" name="file" type="button" class="btn btnnew" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
                                </div>
                                <?php if (isset($banner2Mobile[0])) : ?>
                                    <div class="col-lg-4">
                                        <p>Gambar Saat Ini</p>
                                        <img src="<?= base_url('public/image/store/banner/' . $banner2Mobile[0]->source); ?>" alt="Default Cover" style="max-height:100px">
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <p>Preview Gambar</p>
                                    <img src="" class="blah img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-column gap-1">
                                <p class="f12">NB : </p>
                                <p class="text-dark">Size : 360 x 100px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnnew">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>