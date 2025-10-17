<?php
function menu($menu, $parent)
{
	$array = array();
	foreach ($menu as $key) {
		if ($key["prn"] == $parent) {
			$datakey = array(
				'id' => $key["id"],
				'name' => $key["name"],
				'url' => $key["url"],
				'icon' => $key["icon"]
			);
			array_push($array, $datakey);
		}
	}
	return $array;
}
?>

<div class="container">
	<div class="col-lg-12 m-b-2">
		<div class="row">
			<h2 class="fbold">Menu Admin</h2>
			<hr class="m-a-0">
		</div>
	</div>
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-6 d-flex flex-column gap-2">
				<h5 class="fbold">List Menu</h5>
				<hr class="m-a-0">
				<div class="d-flex flex-column gap-1">
					<?php $idprn = 0; ?>
					<?php foreach ($menu as $key) : ?>
						<?php $scond = menu($menu, $key["id"]) ?>
						<?php if ($key["prn"] == "prn") : ?>
							<div class="d-flex justify-content-between align-items-center border border-md p-a-1">
								<div class="d-flex gap-1 align-items-center">
									<a class="m-b-0 fbold" data-toggle="collapse" href="#menuke<?php echo $key["id"] ?>" aria-expanded="false"><?php echo $key["name"] ?></a>
									<?php if (count($scond) > 0) : ?>
										<i class="fa fa-chevron-down"></i>
									<?php endif ?>
								</div>
								<div class="d-flex gap-1 align-items-center">
									<a class="btn btn-warning btn-sm" href="<?php echo base_url() ?>backendadmin/menuurl?id=<?php echo $key["id"] ?>"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" href="<?php echo base_url() ?>backendadmin/hapusmenu?id=<?php echo $key["id"] ?>"><i class="fa fa-trash"></i></a>
								</div>
							</div>
							<div class="d-flex flex-column gap-1">
								<?php if (count($scond) > 0) : ?>
									<div class="collapse p-x-2 border border-sm" id="menuke<?php echo $key["id"] ?>">
										<?php foreach ($scond as $ks) : ?>
											<div class="d-flex justify-content-between align-items-center m-y-1">
												<a class="m-b-0" href=" <?php echo base_url() ?><?php echo $ks["url"] ?>" aria-expanded="false"><?php echo $ks["name"] ?></a>
												<div class="d-flex gap-1">
													<a class="btn btn-warning btn-sm" href="<?php echo base_url() ?>backendadmin/menuurl?id=<?php echo $ks["id"] ?>"><i class="fa fa-edit"></i></a>
													<a class="btn btn-danger btn-sm" href="<?php echo base_url() ?>backendadmin/hapusmenu?id=<?php echo $ks["id"] ?>"><i class="fa fa-trash"></i></a>
												</div>
											</div>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-lg-6 d-flex flex-column gap-2 sticky">
				<h5 class="fbold">Form Menu</h5>
				<hr class="m-a-0">
				<form action="<?php echo base_url() ?>backendadmin/<?php echo (!empty($id)) ?  'editmenu' : "addmenu"; ?>" method="POST" class="d-flex flex-column gap-2">

					<?php if (!empty($id)) : ?>
						<input class="form-control" name="id" type="hidden" value="<?php echo $detail["id"] ?>">
					<?php endif ?>
					<div class="d-flex flex-column">
						<label for="name">Nama Menu</label>
						<input id="name" class="form-control" name="name" value="<?php echo (!empty($id)) ?  $detail["name"] : ""; ?>" placeholder="Nama Menu">
					</div>
					<div class="d-flex flex-column">
						<label for="icon">Icon</label>
						<input id="icon" class="form-control" placeholder="fa-user" name="icon" value="<?php echo (!empty($id)) ?  $detail["icon"] : ""; ?>">
					</div>
					<div class="d-flex flex-column">
						<label for="prn">Induk dari</label>
						<select id="prn" class="form-control menuurlselect" name="prn" content="<?php echo (!empty($id)) ?  $detail["prn"] : ""; ?>">
							<option value="prn">Gunakan ini sebagai induk</option>
							<?php foreach ($menu as $key) : ?>
								<?php if ($key["prn"] == "prn") : ?>
									<option value="<?php echo $key["id"] ?>"><?php echo $key["name"] ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="d-flex flex-column">
						<label for="url">URL</label>
						<input id="url" class="form-control" name="url" placeholder="backendadmin/user?filter=all" value="<?php echo (!empty($id)) ?  $detail["url"] : ""; ?>">
					</div>
					<button type="submit" class="form-control btn btnnew"><?php echo (!empty($id)) ?  "Simpan" : "Tambah"; ?></button>
				</form>
			</div>
		</div>
	</div>
</div>