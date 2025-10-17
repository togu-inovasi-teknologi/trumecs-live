<?php function getchild($menu,$id)
{
	$tampung = array();
	foreach ($menu as $key) {
		if ($key["prn"]==$id) {
			$okeinichildnya = array(
				'id' =>$key["id"] ,
				'name' =>$key["name"] ,
				'icon' =>$key["icon"] ,
				'prn' =>$key["prn"] ,
				'url' =>$key["url"] 
				);
			array_push($tampung, $okeinichildnya);
		}
	}
	return $tampung;
} 
?>
<div class=" row rule">
	<div class="col-md-12">
		<strong class="f22">Rule Admin</strong>
		<hr>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="col-md-12">
				<strong>List Rule</strong>
				<hr class="m-a-0">
				<?php foreach ($rule as $key): ?>
				<!--<a href="<?php echo base_url() ?>backendadmin/rule?id=<?php echo $key["id"] ?>"><?php echo $key["name"] ?></a> -->
				<a class="label label-primary href="<?php echo ucwords($key["name"]) ?>"> <?php echo ucwords($key["name"]) ?></a> 
				<a class="label label-warning" href="<?php echo base_url() ?>backendadmin/rule?id=<?php echo $key["id"] ?>">[Edit]</a> 
				<a class="label label-danger" href="<?php echo base_url() ?>backendadmin/hapusrule?id=<?php echo $key["id"] ?>">[Hapus]</a>
				<br>
				<?php endforeach ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="col-md-12">
				<form action="<?php echo base_url() ?>backendadmin/<?php echo (!empty($id)) ?  'editrule': "addrule" ; ?>" method="POST">
				<strong>Form Rule</strong>
				<hr class="m-a-0">
				<?php if (!empty($id)): ?>
					<input class="form-control" name="id" type="hidden" value="<?php echo $detail["id"] ?>">
				<?php endif ?>
				<small>Nama Rule</small>
				<input class="form-control" name="name" value="<?php echo (!empty($id)) ?  ucwords($detail["name"]): "" ; ?>">
				
				<small>Deskripsi Rule</small>
				<input class="form-control" name="description" value="<?php echo (!empty($id)) ? ucwords($detail["description"]): "" ; ?>">
				<hr>
				<small>Pilih Menu</small>
				<small class="valuemenu" content="<?php echo (!empty($id)) ?  $detail["menu"]: "" ; ?>"></small>
				<?php foreach ($menu as $key): ?>
				<?php if ($key["prn"]=="prn"): ?>
					<div class="checkbox">
					    <label>
					      <input name="menu[]" id="menu_<?php echo $key["id"] ?>" type="checkbox" value="<?php echo $key["id"] ?>">
					      <a data-toggle="collapse" aria-expanded="false" class="label label-primary"><i class="fa <?php echo $key["icon"] ?>"></i> <?php echo $key["name"] ?></a>
					    </label>

					    
				  	</div>
				  	<!--<div class="childprn p-l-1 collapse" id="collapse<?php echo $key["id"] ?>">
				  		<?php $childprn = getchild($menu, $key["id"]); ?>
				  		<?php foreach ($childprn as $ckey): ?>
				  			<div class="checkbox">
							    <label>
							      <input name="menu[]" id="menu_<?php echo $ckey["id"] ?>" type="checkbox" value="<?php echo $ckey["id"] ?>"> <a class="label label-primary"><i class="fa <?php echo $ckey["icon"] ?>"></i> <?php echo $ckey["name"] ?></a>
							    </label>
						  	</div>
				  		<?php endforeach ?>
				  	</div> -->
				<?php endif ?>
				<?php endforeach ?>
				<input name="Check_All" class="btn btn-info l-m-1" value="Select All" onclick="check_all()" type="button">
    		            <input name="Un_CheckAll" class="btn btn-default" value="Clear All" onclick="uncheck_all()" type="button">
				<hr>
				<button type="submit" class="btn btn-orange m-y-1"><?php echo (!empty($id)) ?  "Simpan": "Tambah" ; ?></button>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<script language="javascript">
function check_all()
{
    var chk = document.getElementsByName('menu[]');
    for (i = 0; i < chk.length; i++)
    chk[i].checked = true ;
}
 
function uncheck_all()
{
    var chk = document.getElementsByName('menu[]');
    for (i = 0; i < chk.length; i++)
    chk[i].checked = false ;
}
</script>