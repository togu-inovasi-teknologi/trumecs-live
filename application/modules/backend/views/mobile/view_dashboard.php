<div class="dashboard container-fluid px-3">
	<?php
	$ses = $this->session->all_userdata();
	?>

	<!-- Header Section -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-4">
				<div class="card-body p-4">
					<div class="d-flex align-items-start">
						<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
							<i class="bi bi-person-circle text-primary fs-4"></i>
						</div>
						<div class="flex-grow-1">
							<h1 class="fw-bold h4 mb-2">Halo, <?php echo ucwords($ses["admin"]["nameadmin"]) ?>!</h1>
							<p class="text-muted small mb-0">Selamat datang di Dashboard Admin Trumecs</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Welcome Message -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="alert alert-info border-0 bg-info bg-opacity-10 rounded-4">
				<div class="d-flex align-items-start">
					<i class="bi bi-info-circle-fill text-info me-3 mt-1"></i>
					<div>
						<h5 class="fw-bold small mb-1">Informasi Statistik Tautan Anda</h5>
						<p class="small mb-0">Berikut adalah ringkasan dan statistik lengkap dari tautan yang Anda kelola</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick Stats (Mobile Carousel) -->
	<div class="row mb-4">
		<div class="col-12">
			<h5 class="fw-bold mb-3">Statistik Cepat</h5>
			<div id="statsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
				<div class="carousel-inner">
					<!-- Total Pengunjung -->
					<div class="carousel-item active">
						<div class="card border-0 shadow-sm rounded-4">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-muted small mb-2">Total Pengunjung</h6>
										<h3 class="fw-bold mb-0">1,248</h3>
										<small class="text-success fw-bold">
											<i class="bi bi-arrow-up me-1"></i> 12.5%
										</small>
									</div>
									<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-people-fill text-primary"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Total Klik -->
					<div class="carousel-item">
						<div class="card border-0 shadow-sm rounded-4">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-muted small mb-2">Total Klik</h6>
										<h3 class="fw-bold mb-0">3,567</h3>
										<small class="text-success fw-bold">
											<i class="bi bi-arrow-up me-1"></i> 8.3%
										</small>
									</div>
									<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-mouse-fill text-success"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Tautan Aktif -->
					<div class="carousel-item">
						<div class="card border-0 shadow-sm rounded-4">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-muted small mb-2">Tautan Aktif</h6>
										<h3 class="fw-bold mb-0">24</h3>
										<small class="text-success fw-bold">
											<i class="bi bi-arrow-up me-1"></i> 2.1%
										</small>
									</div>
									<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-link-45deg text-warning"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Konversi -->
					<div class="carousel-item">
						<div class="card border-0 shadow-sm rounded-4">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-muted small mb-2">Konversi</h6>
										<h3 class="fw-bold mb-0">4.8%</h3>
										<small class="text-danger fw-bold">
											<i class="bi bi-arrow-down me-1"></i> 1.2%
										</small>
									</div>
									<div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
										<i class="bi bi-graph-up-arrow text-info"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="carousel-indicators position-static mt-3">
					<button type="button" data-bs-target="#statsCarousel" data-bs-slide-to="0" class="active bg-primary" style="width: 8px; height: 8px; border-radius: 50%;"></button>
					<button type="button" data-bs-target="#statsCarousel" data-bs-slide-to="1" class="bg-primary" style="width: 8px; height: 8px; border-radius: 50%;"></button>
					<button type="button" data-bs-target="#statsCarousel" data-bs-slide-to="2" class="bg-primary" style="width: 8px; height: 8px; border-radius: 50%;"></button>
					<button type="button" data-bs-target="#statsCarousel" data-bs-slide-to="3" class="bg-primary" style="width: 8px; height: 8px; border-radius: 50%;"></button>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick Actions -->
	<div class="row mb-4">
		<div class="col-12">
			<h5 class="fw-bold mb-3">Akses Cepat</h5>
		</div>

		<div class="col-6 mb-3">
			<a href="<?php echo base_url() ?>backendproduct/listall" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4">
				<div class="card-body p-3 text-center">
					<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
						<i class="bi bi-box-seam text-primary fs-4"></i>
					</div>
					<h6 class="fw-bold mb-1 small">Produk</h6>
					<p class="text-muted x-small mb-0">Kelola produk</p>
				</div>
			</a>
		</div>

		<div class="col-6 mb-3">
			<a href="<?php echo base_url() ?>backendorder/?status=all" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4">
				<div class="card-body p-3 text-center">
					<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
						<i class="bi bi-cart-check text-success fs-4"></i>
					</div>
					<h6 class="fw-bold mb-1 small">Pesanan</h6>
					<p class="text-muted x-small mb-0">Kelola pesanan</p>
				</div>
			</a>
		</div>

		<div class="col-6 mb-3">
			<a href="<?php echo base_url() ?>backendconfirm/?status=all" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4">
				<div class="card-body p-3 text-center">
					<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
						<i class="bi bi-file-text text-warning fs-4"></i>
					</div>
					<h6 class="fw-bold mb-1 small">Konfirmasi</h6>
					<p class="text-muted x-small mb-0">Verifikasi pembayaran</p>
				</div>
			</a>
		</div>

		<div class="col-6 mb-3">
			<a href="#" class="card text-decoration-none border-0 shadow-sm h-100 rounded-4">
				<div class="card-body p-3 text-center">
					<div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
						<i class="bi bi-chat-dots text-info fs-4"></i>
					</div>
					<h6 class="fw-bold mb-1 small">Chat</h6>
					<p class="text-muted x-small mb-0">Kelola percakapan</p>
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
						<h5 class="fw-bold h6 mb-0">Aktivitas Terbaru</h5>
						<a href="#" class="btn btn-outline-primary btn-sm py-1 px-3">
							<i class="bi bi-arrow-right"></i>
						</a>
					</div>

					<div class="list-group list-group-flush">
						<div class="list-group-item border-0 px-0 py-3">
							<div class="d-flex align-items-start">
								<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 mt-1" style="width: 35px; height: 35px;">
									<i class="bi bi-cart-plus text-success"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="fw-bold small mb-1">Pesanan Baru</h6>
									<p class="text-muted x-small mb-0">Pesanan #ORD-00123 dari Budi Santoso</p>
									<small class="text-muted">2 jam lalu</small>
								</div>
							</div>
						</div>

						<div class="list-group-item border-0 px-0 py-3">
							<div class="d-flex align-items-start">
								<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 mt-1" style="width: 35px; height: 35px;">
									<i class="bi bi-person-plus text-primary"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="fw-bold small mb-1">Agen Baru</h6>
									<p class="text-muted x-small mb-0">Siti Rahayu mendaftar sebagai agen</p>
									<small class="text-muted">4 jam lalu</small>
								</div>
							</div>
						</div>

						<div class="list-group-item border-0 px-0 py-3">
							<div class="d-flex align-items-start">
								<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 mt-1" style="width: 35px; height: 35px;">
									<i class="bi bi-file-earmark-check text-warning"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="fw-bold small mb-1">Konfirmasi Pembayaran</h6>
									<p class="text-muted x-small mb-0">Pembayaran #ORD-00122 dikonfirmasi</p>
									<small class="text-muted">1 hari lalu</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Mobile Bottom Navigation -->
	<div class="row d-block d-lg-none">
		<div class="col-12">
			<nav class="navbar navbar-expand navbar-light bg-white shadow-lg fixed-bottom rounded-top-4">
				<div class="container-fluid justify-content-around px-0">
					<a href="<?php echo base_url() ?>backendproduct/listall" class="nav-link text-center py-2">
						<i class="bi bi-box-seam d-block fs-5"></i>
						<small class="d-block">Produk</small>
					</a>
					<a href="<?php echo base_url() ?>backendorder/?status=all" class="nav-link text-center py-2">
						<i class="bi bi-cart-check d-block fs-5"></i>
						<small class="d-block">Pesanan</small>
					</a>
					<a href="<?php echo base_url() ?>backendconfirm/?status=all" class="nav-link text-center py-2">
						<i class="bi bi-file-text d-block fs-5"></i>
						<small class="d-block">Konfirmasi</small>
					</a>
					<a href="#" class="nav-link text-center py-2">
						<i class="bi bi-chat-dots d-block fs-5"></i>
						<small class="d-block">Chat</small>
					</a>
				</div>
			</nav>
			<!-- Spacer untuk fixed-bottom navigation -->
			<div style="height: 70px;"></div>
		</div>
	</div>
</div>

<style>
	.rounded-4 {
		border-radius: 1rem !important;
	}

	.rounded-top-4 {
		border-radius: 1rem 1rem 0 0 !important;
	}

	.card {
		border: 1px solid rgba(0, 0, 0, 0.05);
		transition: transform 0.2s ease;
	}

	.card:active {
		transform: scale(0.98);
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

	.carousel-indicators button {
		margin: 0 4px;
	}

	.btn-outline-primary {
		border-radius: 0.5rem;
		padding: 0.25rem 0.75rem;
	}

	.list-group-item {
		border-bottom: 1px solid rgba(0, 0, 0, 0.05);
	}

	.list-group-item:last-child {
		border-bottom: none;
	}

	.x-small {
		font-size: 0.75rem !important;
	}

	/* Fixed bottom navigation */
	.fixed-bottom {
		box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
		border-top: 1px solid rgba(0, 0, 0, 0.05);
	}

	.nav-link {
		color: #6c757d;
		min-height: 70px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.nav-link.active {
		color: #0d6efd;
	}

	/* Touch-friendly elements */
	button,
	a {
		min-height: 44px;
	}

	/* Better spacing for mobile */
	.mb-3 {
		margin-bottom: 1rem !important;
	}

	.mb-4 {
		margin-bottom: 1.5rem !important;
	}

	.py-3 {
		padding-top: 1rem !important;
		padding-bottom: 1rem !important;
	}
</style>

<script>
	// Auto-start carousel on mobile
	document.addEventListener('DOMContentLoaded', function() {
		const carousel = document.getElementById('statsCarousel');
		if (carousel) {
			const bsCarousel = new bootstrap.Carousel(carousel, {
				interval: 3000,
				wrap: true
			});
		}

		// Add touch feedback for mobile cards
		document.querySelectorAll('.card').forEach(card => {
			card.addEventListener('touchstart', function() {
				this.style.transform = 'scale(0.98)';
			});

			card.addEventListener('touchend', function() {
				this.style.transform = 'scale(1)';
			});
		});
	});
</script>