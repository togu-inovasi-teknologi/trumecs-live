<div class="dashboard container-fluid px-4">
	<?php
	$ses = $this->session->all_userdata();
	?>

	<!-- Header Section -->
	<div class="row mb-5">
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
									<small class="text-muted">Administrator</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Welcome Message -->
	<div class="row mb-5">
		<div class="col-12">
			<div class="alert alert-info border-0 bg-info bg-opacity-10 rounded-4">
				<div class="d-flex align-items-center">
					<i class="bi bi-info-circle-fill text-info fs-4 me-3"></i>
					<div>
						<h5 class="fw-bold mb-1">Informasi Statistik Tautan Anda</h5>
						<p class="mb-0">Berikut adalah ringkasan dan statistik lengkap dari tautan yang Anda kelola</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick Stats -->
	<div class="row mb-5">
		<div class="col-xl-3 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Total Pengunjung</h6>
							<h3 class="fw-bold mb-0">1,248</h3>
							<small class="text-success fw-bold">
								<i class="bi bi-arrow-up me-1"></i> 12.5%
							</small>
						</div>
						<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-people-fill text-primary fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Total Klik</h6>
							<h3 class="fw-bold mb-0">3,567</h3>
							<small class="text-success fw-bold">
								<i class="bi bi-arrow-up me-1"></i> 8.3%
							</small>
						</div>
						<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-mouse-fill text-success fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Tautan Aktif</h6>
							<h3 class="fw-bold mb-0">24</h3>
							<small class="text-success fw-bold">
								<i class="bi bi-arrow-up me-1"></i> 2.1%
							</small>
						</div>
						<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-link-45deg text-warning fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<div class="card border-0 shadow-sm h-100 rounded-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h6 class="text-muted mb-2">Konversi</h6>
							<h3 class="fw-bold mb-0">4.8%</h3>
							<small class="text-danger fw-bold">
								<i class="bi bi-arrow-down me-1"></i> 1.2%
							</small>
						</div>
						<div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
							<i class="bi bi-graph-up-arrow text-info fs-3"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick Actions -->
	<div class="row mb-4">
		<div class="col-12">
			<h4 class="fw-bold mb-4">Akses Cepat</h4>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<a href="<?php echo base_url() ?>backendproduct/listall" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 hover-lift">
				<div class="card-body p-4">
					<div class="d-flex align-items-center">
						<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
							<i class="bi bi-box-seam text-primary fs-4"></i>
						</div>
						<div>
							<h5 class="fw-bold mb-1">Produk</h6>
								<p class="text-muted small mb-0">Kelola produk dan inventori</p>
						</div>
					</div>
				</div>
			</a>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<a href="<?php echo base_url() ?>backendorder/?status=all" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 hover-lift">
				<div class="card-body p-4">
					<div class="d-flex align-items-center">
						<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
							<i class="bi bi-cart-check text-success fs-4"></i>
						</div>
						<div>
							<h5 class="fw-bold mb-1">Pesanan</h6>
								<p class="text-muted small mb-0">Kelola pesanan pelanggan</p>
						</div>
					</div>
				</div>
			</a>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<a href="<?php echo base_url() ?>backendconfirm/?status=all" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 hover-lift">
				<div class="card-body p-4">
					<div class="d-flex align-items-center">
						<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
							<i class="bi bi-file-text text-warning fs-4"></i>
						</div>
						<div>
							<h5 class="fw-bold mb-1">Konfirmasi</h6>
								<p class="text-muted small mb-0">Verifikasi pembayaran</p>
						</div>
					</div>
				</div>
			</a>
		</div>

		<div class="col-xl-3 col-lg-6 mb-4">
			<a href="#" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4 hover-lift">
				<div class="card-body p-4">
					<div class="d-flex align-items-center">
						<div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
							<i class="bi bi-chat-dots text-info fs-4"></i>
						</div>
						<div>
							<h5 class="fw-bold mb-1">Chat</h6>
								<p class="text-muted small mb-0">Kelola percakapan</p>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>

	<!-- Recent Activity -->
	<div class="row">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body p-4">
					<div class="d-flex justify-content-between align-items-center mb-4">
						<h5 class="fw-bold mb-0">Aktivitas Terbaru</h5>
						<a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
					</div>

					<div class="list-group list-group-flush">
						<div class="list-group-item border-0 px-0 py-3">
							<div class="d-flex align-items-center">
								<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
									<i class="bi bi-cart-plus text-success"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="fw-bold mb-1">Pesanan Baru</h6>
									<p class="text-muted small mb-0">Pesanan #ORD-00123 diterima dari Budi Santoso</p>
								</div>
								<div class="text-muted small">2 jam lalu</div>
							</div>
						</div>

						<div class="list-group-item border-0 px-0 py-3">
							<div class="d-flex align-items-center">
								<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
									<i class="bi bi-person-plus text-primary"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="fw-bold mb-1">Agen Baru</h6>
									<p class="text-muted small mb-0">Siti Rahayu mendaftar sebagai agen baru</p>
								</div>
								<div class="text-muted small">4 jam lalu</div>
							</div>
						</div>

						<div class="list-group-item border-0 px-0 py-3">
							<div class="d-flex align-items-center">
								<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
									<i class="bi bi-file-earmark-check text-warning"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="fw-bold mb-1">Konfirmasi Pembayaran</h6>
									<p class="text-muted small mb-0">Pembayaran untuk pesanan #ORD-00122 dikonfirmasi</p>
								</div>
								<div class="text-muted small">1 hari lalu</div>
							</div>
						</div>
					</div>
				</div>
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