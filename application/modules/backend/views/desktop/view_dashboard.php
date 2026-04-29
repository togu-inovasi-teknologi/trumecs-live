<div class="dashboard container-fluid px-4">
	<?php
	$ses = $this->session->all_userdata();
	?>

	<!-- Header Section -->
	<div class="row mb-2">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body p-4">
					<div class="d-flex align-items-center justify-content-between">
						<div>
							<h1 class="fw-bold text-primary mb-2">Halo, <?php echo ucwords($ses["admin"]["nameadmin"]) ?>!</h1>
							<p class="text-muted mb-0 fs-5">Selamat datang di Dashboard Admin Trumecs</p>
						</div>
						<div class="text-end">
							<div class="d-flex align-items-center">
								<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
									<i class="bi bi-person-circle text-primary fs-4"></i>
								</div>
								<div>
									<p class="fw-bold mb-0"><?php echo ucwords($ses["admin"]["nameadmin"]) ?></p>
									<small class="text-muted"><?php echo ucwords($ses["admin"]["level"]) ?></small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Welcome Message -->
	<div class="row mb-2">
		<div class="col-12">
			<div class="alert alert-info border-0 bg-info bg-opacity-10 rounded-4">
				<div class="d-flex align-items-center">
					<i class="bi bi-info-circle-fill text-info fs-4 me-3"></i>
					<div>
						<h5 class="fw-bold mb-1">Informasi Statistik</h5>
						<p class="mb-0">Berikut adalah ringkasan dan statistik lengkap yang Anda kelola</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick Stats -->
	<div class="row mb-2">
		<div class="col-xl-4 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Total View Product</h6>
							<h3 class="fw-bold mb-0"><?= $totalProduct == 0 || $totalProduct == null ? '0' : $totalProduct; ?></h3>
						</div>
						<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-people-fill text-primary fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="col-xl-4 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Total View Promo</h6>
							<h3 class="fw-bold mb-0"><?= $totalPromo == 0 || $totalPromo == null ? '0' : $totalPromo; ?></h3>
						</div>
						<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-link-45deg text-warning fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-4 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Total View Artikel</h6>
							<h3 class="fw-bold mb-0"><?= $totalArtikel == 0 || $totalArtikel == null ? '0' : $totalArtikel; ?></h3>
						</div>
						<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-mouse-fill text-success fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-xl-4 col-lg-12 mb-4 d-flex flex-column gap-2">
			<h4>List Product</h4>
			<div class="table-responsive">
				<table id="table-dashboard-product" class="table table-striped table-bordered table-hover display compact w-100">
					<thead class="table-dark">
						<tr>
							<th class="align-middle">Nama Product</th>
							<th class="align-middle text-center">View</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-xl-4 col-lg-12 mb-4 d-flex flex-column gap-2">
			<h4>List Promo</h4>
			<div class="table-responsive">
				<table id="table-dashboard-promo" class="table table-striped table-bordered table-hover display compact w-100">
					<thead class="table-dark">
						<tr>
							<th class="align-middle">Nama Promo</th>
							<th class="align-middle text-center">View</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-xl-4 col-lg-12 mb-4 d-flex flex-column gap-2">
			<h4>List Artikel</h4>
			<div class="table-responsive">
				<table id="table-dashboard-artikel" class="table table-striped table-bordered table-hover display compact w-100">
					<thead class="table-dark">
						<tr>
							<th class="align-middle">Nama Artikel</th>
							<th class="align-middle text-center">View</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

<style>
	.rounded-4 {
		border-radius: 1rem !important;
	}

	.hover-lift {
		transition: all 0.3s ease;
	}

	.hover-lift:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
	}

	.card {
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}

	.bg-primary.bg-opacity-10 {
		background-color: rgba(13, 110, 253, 0.1) !important;
	}

	.bg-success.bg-opacity-10 {
		background-color: rgba(25, 135, 84, 0.1) !important;
	}

	.bg-warning.bg-opacity-10 {
		background-color: rgba(255, 193, 7, 0.1) !important;
	}

	.bg-info.bg-opacity-10 {
		background-color: rgba(13, 202, 240, 0.1) !important;
	}

	.btn-outline-primary {
		border-radius: 0.5rem;
	}

	.list-group-item {
		border-bottom: 1px solid rgba(0, 0, 0, 0.05);
	}

	.list-group-item:last-child {
		border-bottom: none;
	}
</style>