<?php $brand = unserialize(CATEGORY_ALL) ?>
<?php 
function ctgprn($parent)
{
    $array = array();
    $brand = unserialize(CATEGORY_ALL);
    if ($parent!="") {
        foreach ($brand as $key) {
            if ($key["parent"]==$parent) {
                $datakey= array(
                    'id' => $key["id"],
                    'name'=>$key["name"],
                    'parent'=>$key["parent"],
                    'img'=>$key["img"],
                 );
                array_push($array, $datakey);
            }
        }
    }
    return $array;
    
}

 ?>

<div class="category row"  style="margin-top:60px">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<strong class="f22">Category</strong>
			</div>
			<div class="col-md-8">
				<a what="merek" data-toggle="collapse" aria-expanded="false" class="btn btn-orange btnxxadd pull-right m-x-1">Tambah Merek</a>
				<a what="tipe" data-toggle="collapse" aria-expanded="false" class="btn btn-orange btnxxadd pull-right m-x-1">Tambah Type</a>
				<a what="komponen" data-toggle="collapse" aria-expanded="false" class="btn btn-orange btnxxadd pull-right m-x-1">Tambah Komponen</a>
			</div>
		</div>
	</div>
		<hr class="p-a-2">
	<div class="col-md-12 collapse collapseadd">
		<form action="<?php echo base_url() ?>backendproduct/addcategory" method="post" enctype="multipart/form-data" id="categori-form">
			<div class="col-md-12 tipeform f16 fbold"></div>
			<div class="col-xs-12 p-a-0">
				<div class="col-md-3">
					<div class="parentorno">
						<select required class="form-control getallkomponen" name="parent"></select>
					</div>
					<input class="form-control" type="text" name="name" required placeholder="Nama komponen">
					<hr>
					<label class="file">
					<input type="file" name="fileupload" >
					<span class="file-custom"></span>
					</label>
				</div>
				<div class="col-md-3">
					<h5>Grade List</h5>
					<div class="grade-list"></div>
				</div>
				<div class="col-md-3">
					<h5>Brand List</h5>
					<div class="brand-list"></div>
				</div>
				<div class="col-md-3">
					<h5>Atribute List</h5>
					<div class="attribute-list"></div>
				</div>
			</div>
			<div class="col-md-12"><button class="btn btn-orange">Simpan</button></div>
		</form>
		<div class="col-md-12"><hr></div>
	</div>
	<div class="col-md-12 collapse collapseedit">
		<form id="form" action="<?php echo base_url() ?>backendproduct/updatecategory" method="post" enctype="multipart/form-data">
			<input class="tampung" type="hidden">
			<div class="col-md-12 tipeform f16 fbold"></div>
			<div class="col-xs-12 p-a-0">
				<div class="col-md-3">
					<div class="input-form">
						<select required class="form-control getallkomponen" name="parent"></select>
					</div>
					<input class="form-control idcategory" type="hidden" name="id" required>
					<input class="form-control textcategory" type="text" name="name" placeholder="Nama komponen" required>
					<hr>
					<label class="file">
					<input type="file" name="fileupload" >
					<span class="file-custom"></span>
					</label>
				</div>
				<div class="col-md-3">
					<h5>Grade List</h5>
					<div class="grade-list"></div>
				</div>
				<div class="col-md-3">
					<h5>Brand List</h5>
					<div class="brand-list"></div>
				</div>
				<div class="col-md-3">
					<h5>Atribute List</h5>
					<div class="attribute-list"></div>
				</div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-orange">Simpan</button>
			</div>
			<div class="col-lg-12">
				<hr>
			</div>
		</form>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="col-md-12  p-a-1">
				<strong>Merek dan Type</strong>
				<hr>
			</div>
			<div class="col-md-12">
			<?php foreach ($brand as $key): ?>
				<?php if ($key["parent"]=="prn"): ?>
						<div class="col-xs-6">
						<?php echo $key["name"] ?>
						<a class="jq-edit" idparent="prn" idcategory="<?php echo $key["id"] ?>" textcategory="<?php echo $key["name"] ?>"  typecategory="merk" img="<?php echo $key["img"] ?>" data-toggle="collapse" aria-expanded="false"><i class="fa fa-edit"></i></a>
						<a href="<?php echo base_url() ?>backendproduct/hapuscategory?id=<?php echo $key["id"] ?>">
							<i class="fa fa-trash"></i>
						</a>
						</div>
						<?php $count= ctgprn($key["id"] ) ?>
						<?php if (count($count)>0): ?>
							
							<div class="col-xs-6">
							<?php foreach ($count as $subkey): ?>
								<?php echo $subkey["name"] ?>
								<a class="jq-edit" idparent="<?php echo $subkey["parent"] ?>" idcategory="<?php echo $subkey["id"] ?>" typecategory="type" textcategory="<?php echo $subkey["name"] ?>" img="<?php echo $subkey["img"] ?>" data-toggle="collapse" href=".collapseedit" aria-expanded="false"><i class="fa fa-edit"></i></a>
								<a href="<?php echo base_url() ?>backendproduct/hapuscategory?id=<?php echo $subkey["id"] ?>">
									<i class="fa fa-trash"></i>
								</a>
								<br>
							<?php endforeach ?>
							</div>
						<?php endif ?>
						<div class="col-md-12 m-a-0 p-a-0"><hr></div>
				<?php endif ?>
			<?php endforeach ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="col-md-12  p-a-1">
				<strong>Komponen</strong>
				<hr>
			</div>
			<div class="col-md-12">
			<?php foreach ($brand as $key): ?>
				<?php if ($key["parent"]=="0"): ?>
					<div class="col-xs-6">
						<?php echo $key["name"] ?>
						<a class="jq-edit" idparent="0" idcategory="<?php echo $key["id"] ?>" textcategory="<?php echo $key["name"] ?>" typecategory="komponen" img="<?php echo $key["img"] ?>" data-toggle="collapse" aria-expanded="false"><i class="fa fa-edit"></i></a>
						<a href="<?php echo base_url() ?>backendproduct/hapuscategory?id=<?php echo $key["id"] ?>">
							<i class="fa fa-trash"></i>
						</a>
						</div>
						<?php $count= ctgprn($key["id"] ) ?>
						<?php if (count($count)>0): ?>
							
							<div class="col-xs-6">
							<?php foreach ($count as $subkey): ?>
								<?php echo $subkey["name"] ?>
								<a class="jq-edit" idparent="<?php echo $subkey["parent"] ?>" idcategory="<?php echo $subkey["id"] ?>" typecategory="komponen" textcategory="<?php echo $subkey["name"] ?>" img="<?php echo $subkey["img"] ?>" data-toggle="collapse" href=".collapseedit" aria-expanded="false"><i class="fa fa-edit"></i></a>
								<a href="<?php echo base_url() ?>backendproduct/hapuscategory?id=<?php echo $subkey["id"] ?>">
									<i class="fa fa-trash"></i>
								</a>
								<br>
							<?php endforeach ?>
							</div>
						<?php endif ?>
						<div class="col-md-12 m-a-0 p-a-0"><hr></div>
				<?php endif ?>
			<?php endforeach ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>