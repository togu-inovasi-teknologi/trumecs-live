<div class="menupage row">
	<div class="col-md-12">
		<strong class="f22">Setting Menu</strong>
		<hr>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="col-md-12">
				<strong>menu atas</strong>
			</div>
			<div class="col-md-12">
				belum di setting
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="col-md-12">
				<strong>menu bawah</strong>
			</div>
			<div class="col-md-4">
				<strong>Trumecs</strong>
				<hr class="m-a-0">
				<?php foreach ($menu1 as $key): ?>
					<?php $json = json_decode($key["value"],true) ?>
					<?php echo ($json["name"]) ?> <a href="<?php echo base_url() ?>backendsetting/hapus?id=<?php echo ($key["id"]) ?>">[hapus]</a><br>
				<?php endforeach ?>
			</div>
			<div class="col-md-4">
				<strong>Pengguna/Pembeli</strong>
				<hr class="m-a-0">
				<?php foreach ($menu2 as $key): ?>
					<?php $json = json_decode($key["value"],true) ?>
					<?php echo ($json["name"]) ?> <a href="<?php echo base_url() ?>backendsetting/hapus?id=<?php echo ($key["id"]) ?>">[hapus]</a><br>
				<?php endforeach ?>
			</div>
			<div class="col-md-4">
				<strong>Sparepart</strong>
				<hr class="m-a-0">
				<?php foreach ($menu3 as $key): ?>
					<?php $json = json_decode($key["value"],true) ?>
					<?php echo ($json["name"]) ?> <a href="<?php echo base_url() ?>backendsetting/hapus?id=<?php echo ($key["id"]) ?>">[hapus]</a><br>
				<?php endforeach ?>
			</div>
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-4">
				<strong>Trumecs</strong>
				<hr class="m-a-0">
				<table class="tablelist table">
					<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($page as $key): ?>
						<tr>
							<td>
							<?php echo ($key["title"]) ?>
							</td>
							<td>
								<form action="<?php echo base_url() ?>backendsetting/addmenu" method="POST">
									<?php $link= preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-\/]/', '', str_replace(' ', '-', $key["title"]))) ; ?>
									<input type="hidden" name="name" value='menu1'>
									<input type="hidden" name="value" value='{"name":"<?php echo ($key["title"]) ?>","link":"page/<?php echo ($key["id"]) ?>/<?php echo $link ?>"}'>
									<button type="submit" class="btn btn-sm btn-secondary">+</button>
								</form>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<strong>Pengguna/Pembeli</strong>
				<hr class="m-a-0">
				<table class="tablelist table">
					<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($page as $key): ?>
						<tr>
							<td>
							<?php echo ($key["title"]) ?>
							</td>
							<td>
								<form action="<?php echo base_url() ?>backendsetting/addmenu" method="POST">
									<?php $link= preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-\/]/', '', str_replace(' ', '-', $key["title"]))) ; ?>
									<input type="hidden" name="name" value='menu2'>
									<input type="hidden" name="value" value='{"name":"<?php echo ($key["title"]) ?>","link":"page/<?php echo ($key["id"]) ?>/<?php echo $link ?>"}'>
									<button type="submit" class="btn btn-sm btn-secondary">+</button>
								</form>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<strong>Sparepart</strong>
				<hr class="m-a-0">
				<table class="tablelist table">
					<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($category as $key): ?>
						<tr>
							<td>
							<?php echo ($key["name"]) ?>
							</td>
							<td>
								<form action="<?php echo base_url() ?>backendsetting/addmenu" method="POST">
									<?php $link= preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-\/]/', '', str_replace(' ', '-', $key["name"]))) ; ?>
									<input type="hidden" name="name" value='menu3'>
									<input type="hidden" name="value" value='{"name":"<?php echo ($key["name"]) ?>","link":"page/<?php echo ($key["id"]) ?>/<?php echo $link ?>"}'>
									<button type="submit" class="btn btn-sm btn-secondary">+</button>
								</form>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>


</div>
<style type="text/css">
.dataTables_length,.dataTables_filter,.dataTables_info{display: none}
</style>