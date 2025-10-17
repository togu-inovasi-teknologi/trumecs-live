<h2><a class="btn btn-black" href="<?php echo site_url('backendprospek/admin'); ?>"><small><span class="fa fa-chevron-left"></span></small></a> Detail Prospek</h2>
<hr/>
<div class="detail row">
	<div class="col-md-6">
        <div class="card">
            <div class="card-header btn-orange">Sales</div>
            <div class="card-body" style="padding: 1.25rem;">
                <form action="<?php echo site_url("backendprospek/admin/assign/".$detail->row()->id); ?>" method="post" id="form_assign">
                <div class="row">
                    <div class="col-md-12">
                        <select class="form-control" name="id_sales" required>
                            <option value="">-- Pilih Sales --</option>
                            <?php foreach($sales->result() as $item): ?>
                            <option value="<?php echo $item->id ?>" <?php echo $item->id == $detail->row()->id_sales ? "selected='selected'" : "" ?>><?php echo $item->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <button type="submit" form="form_assign" class="btn btn-white">Ubah</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header btn-orange">Informasi</div>
            <div class="card-body">
                <form class="form-horizontal" action="<?php echo site_url('backendprospek/admin/set_company_info/'.$detail->row()->id); ?>" id="detail_form" method="post">
                    <table class="table table-bordered table-striped f12" style="width:100%;margin-bottom:0px">
                        <tbody>
                            <tr>
                                <td>
                                    <label><strong>Nama Perusahaan</strong></label>
                                    <input class="form-control f12" name="company" value="<?php echo ($detail->row()->company) ?>" />
                                </td>
                                <td>
                                    <label><strong>Kategori Perusahaan</strong></label>
                                    <select name="category" class="form-control f12"><?php echo ($detail->row()->company_address) ?>
                                        <option value="">--Pilih Kategori--</option>
                                        <option value="industri" <?php echo $detail->row()->category == 'industri' ? "selected='selected'" : ""?>>Industri</option>
                                        <option value="transportasi" <?php echo $detail->row()->category == 'transportasi' ? "selected='selected'" : ""?>>Transportasi</option>
                                        <option value="kontraktor" <?php echo $detail->row()->category == 'kontraktor' ? "selected='selected'" : ""?>>Kontraktor</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <label><strong>Alamat Perusahaan</strong></label>
                                    <textarea rows="6" name="company_address" class="form-control f12"><?php echo ($detail->row()->company_address) ?></textarea>
                                </td>
                                <td>
                                    <label><strong>Telepon Perusahaan</strong></label>
                                    <input name="company_phone" class="form-control f12" value="<?php echo ($detail->row()->company_phone) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><strong>Email Perusahaan</strong></label>
                                    <input class="form-control f12" name="company_email" value="<?php echo ($detail->row()->company_email) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="btn-warning">
                                    <label><strong>Status</strong></label>
                                    <select class="form-control f12" name="status">
                                        <option value="0" <?php echo $detail->row()->status == 0 ? "selected='selected'" : ""?>>Belum Dihubungi</option>
                                        <option value="1" <?php echo $detail->row()->status == 1 ? "selected='selected'" : ""?>>Sudah Dihubungi</option>
                                    </select>
                                </td>
                                <td class="btn-warning">
                                    <label><strong>Validitas</strong></label>
                                    <select class="form-control f12" name="valid">
                                        <option value="0" <?php echo $detail->row()->valid == 0 ? "selected='selected'" : ""?>>Belum diperiksa</option>
                                        <option value="1" <?php echo $detail->row()->valid == 1 ? "selected='selected'" : ""?>>Valid</option>
                                        <option value="2" <?php echo $detail->row()->valid == 2 ? "selected='selected'" : ""?>>Tidak Valid</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label><strong>Keterangan</strong></label>
                                    <textarea name="additional_information" rows="5" class="form-control f12"><?php echo ($detail->row()->additional_information) ?></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer text-right">
                <button type="submit" form="detail_form" class="btn btn-white">Ubah</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header btn-orange">Kontak</div>
            <div class="card-body f12">
                <table class="table table-striped" style="margin-bottom:0px">
                    <tbody>
                        <?php foreach($kontak->result() as $item) { ?>
                        <tr>
                            <td>
                                <div class="row">
                                    <label class="col-xs-4"><strong>Nama</strong></label>
                                    <div class="col-xs-8"><?php echo $item->name ?></div>
                                </div>
                                <div class="row">
                                    <label class="col-xs-4"><strong>Telepon</strong></label>
                                    <div class="col-xs-8"><?php echo $item->phone != '' ? $item->phone : '-' ?></div>
                                </div>
                                <div class="row">
                                    <label class="col-xs-4"><strong>Email</strong></label>
                                    <div class="col-xs-8"><?php echo $item->email != '' ? $item->email : '-' ?></div>
                                </div>
                                <div class="row">
                                    <label class="col-xs-4"><strong>Jabatan</strong></label>
                                    <div class="col-xs-8"><?php echo $item->position != '' ? $item->position : '-' ?></div>
                                </div>
                            </td>
                            <td style="width:30%;text-align:center">
                                <a data-toggle="modal" data-target="#kontakUpdate" data-idkontak="<?php echo $item->id ?>" class="btn btn-primary btn-sm update-kontak" >Ubah</a>
                                <a class="btn btn-danger btn-sm delete-kontak" href="<?php echo site_url('backendprospek/admin/delete_kontak/'.$item->id_prospek.'/'.$item->id); ?>">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <label class="col-xs-12"><strong>Keterangan Tambahan</strong></label>
                                    <div class="col-xs-12"><?php echo $item->additional_information != '' ? nl2br($item->additional_information) : '-' ?></div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <a data-toggle="modal" data-target="#kontakModal" class="btn btn-white">Tambah</a>
            </div>
        </div>
        <!--<a data-toggle="modal" data-target="#myModal" class="btn btn-white btn-sm disabled">Assign ke Sales</a>-->
	</div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header" style="background:#4cd83c;color:#fff"><i class="fa fa-file"></i> <strong>Berkas Penawaran</strong></div>
            <div class="card-body">
                <div class="col-xs-12 p-y-1">
                    <?php if($history->row($history->num_rows()-1)->file == ''): ?>
                    <div class="alert alert-info text-center">
                        <strong>Status:</strong> Menunggu berkas penawaran
                    </div>
                    <form class="form-horizontal" action="<?php echo site_url('backendprospek/admin/send_quote/'.$detail->row()->id); ?>"  method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="file" class="form-control" name="quote" />
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="alert text-center">
                        <strong>Status:</strong> Penawaran telah dikirim
                    </div>
                    <h3 class="text-center"><a class="btn btn-success btn-lg" target="_blank" href="<?php echo base_url('public/filequotation/'.$history->row($history->num_rows()-1)->file); ?>"> <i class="fa fa-download"></i> Download</a></h3>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header btn-black">Riwayat</div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover" id="tablelist" style="margin-bottom:0px;">
                    <tbody>
                        <?php if ($history->num_rows() > 0) { ?>
                        <?php foreach ($history->result() as $key=>$item ): ?>
                        <tr <?php echo $item->name == '' ? 'style="background:#e7f5e1;border:1px solid #4cd83c"' : '' ?>>
                            <td style="width:20%">
                                <a target="_blank" class="fbold" href="<?php echo base_url() ?>backendorder/detail/<?php echo $item->id ?>"><small class="label label-primary"><?php echo $this->date->format_press_detail($item->date) ?></small></a>
                            </td>
                            <td>
                                <small class="label label-default"><strong><?php echo ucwords($item->title) ?></strong></small>
                                <small class="pull-right"><span class="fa fa-user"></span> <?php echo $item->name ?></small>
                                <hr/>
                                <small><?php echo nl2br($item->description) ?></small>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <?php 
                            }else{
                                echo "<tr><td colspan='4' class='text-center'>Belum ada visit</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url() ?>backendprospek/admin/assign" method="post">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Sales</label>
                        <input class="form-control" name="id" type="hidden" value="<?php //echo ($member["id"]) ?>" required>
                        <select class="form-control" name="id_sales" required>
                            <?php foreach($sales->result() as $item): ?>
                            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="kontakModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo site_url('backendprospek/admin/add_kontak/'.$detail->row()->id) ?>" method="post">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Tambah Kontak</h4>
	      </div>
	      <div class="modal-body" style="padding:0px;">
	      	<div>
                <table class="table table-striped table-bordered f12" style="margin-bottom:0px;">
                    <tr>
                        <td>
                            <label class="control-label"><strong>Nama</strong></label>
                            <input class="form-control f12" name="name" type="text" value="" placeholder="Nama kontak" required>
                        </td>
                        <td rowspan="4">
                            <label class="control-label"><strong>Informasi Tambahan</strong></label>
                            <textarea class="form-control f12" name="additional_information" placeholder="Informasi tambahan: Hobi, alamat, bsnis, dll" type="text" rows="15"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><strong>Posisi</strong></label>
                            <input class="form-control f12" name="position" type="text" placeholder="Posisi/jabatan" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><strong>Telepon</strong></label>
                            <input class="form-control f12" name="phone" type="text" placeholder="Nomor telepon / WA" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><strong>Email</strong></label>
                            <input class="form-control f12" name="email" type="text" placeholder="Alamat email" value="" required>
                        </td>
                    </tr>
                </table>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="kontakUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo site_url('backendprospek/admin/update_kontak/'.$detail->row()->id) ?>" method="post">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Ubah Kontak</h4>
	      </div>
	      <div class="modal-body" style="padding:0px;">
	      	<div>
                <table class="table table-striped table-bordered f12 form_update" style="margin-bottom:0px;">
                    <tr>
                        <td>
                            <label class="control-label"><strong>Nama</strong></label>
                            <input class="form-control f12" name="name" type="text" value="" placeholder="Nama kontak" required>
                            <input class="form-control f12" name="id_kontak" type="hidden" value="">
                        </td>
                        <td rowspan="4">
                            <label class="control-label"><strong>Informasi Tambahan</strong></label>
                            <textarea class="form-control f12" name="additional_information" placeholder="Informasi tambahan: Hobi, alamat, bsnis, dll" type="text" rows="15"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><strong>Posisi</strong></label>
                            <input class="form-control f12" name="position" type="text" placeholder="Posisi/jabatan" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><strong>Telepon</strong></label>
                            <input class="form-control f12" name="phone" type="text" placeholder="Nomor telepon / WA" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><strong>Email</strong></label>
                            <input class="form-control f12" name="email" type="text" placeholder="Alamat email" value="">
                        </td>
                    </tr>
                </table>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
    </form>
  </div>
</div>