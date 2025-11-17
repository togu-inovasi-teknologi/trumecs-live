<div class="container-fluid">
	<!-- Header Section -->
	<div class="row mb-4">
		<div class="col-lg-12 mb-4">
			<div class="card bg-light">
				<div class="card-body border-bottom py-3">
					<h2 class="fw-bold text-primary mb-0">
						<i class="fas fa-cube me-2"></i>Category & Brand Management
					</h2>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-2">
					<div class="card shadow-sm border-0">
						<div class="card-body p-0">
							<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<button class="nav-link active border-bottom rounded-0 p-3" id="v-pills-category-tab" data-bs-toggle="pill" data-bs-target="#v-pills-category" type="button" role="tab" aria-controls="v-pills-category" aria-selected="true">
									Category
								</button>
								<button class="nav-link border-bottom rounded-0 p-3" id="v-pills-brand-tab" data-bs-toggle="pill" data-bs-target="#v-pills-brand" type="button" role="tab" aria-controls="v-pills-brand" aria-selected="false">
									Brand
								</button>
								<button class="nav-link border-bottom rounded-0 p-3" id="v-pills-model-tab" data-bs-toggle="pill" data-bs-target="#v-pills-model" type="button" role="tab" aria-controls="v-pills-model" aria-selected="false">
									Model
								</button>
								<button class="nav-link border-bottom rounded-0 p-3" id="v-pills-attribute-tab" data-bs-toggle="pill" data-bs-target="#v-pills-attribute" type="button" role="tab" aria-controls="v-pills-attribute" aria-selected="false">
									Attribute
								</button>
								<button class="nav-link rounded-0 p-3" id="v-pills-grade-tab" data-bs-toggle="pill" data-bs-target="#v-pills-grade" type="button" role="tab" aria-controls="v-pills-grade" aria-selected="false">
									Grade
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-10">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-category" role="tabpanel" aria-labelledby="v-pills-category-tab" tabindex="0">
							<div class="col-lg-12">
								<div class="card shadow-sm border-0">
									<div class="card-body px-4 py-3">
										<div class="row d-flex flex-column gap-5">
											<div class="col-lg-12 d-flex justify-content-between align-items-center">
												<h3 class="fw-bold">Category List & Sub</h3>
												<div class="d-flex gap-2">
													<button data-bs-target="#add-category" data-bs-toggle="modal" class="btn btn-primary">
														<i class="fas fa-plus me-1"></i>Tambah Kategori
													</button>
													<button data-bs-target="#add-category-sub" data-bs-toggle="modal" class="btn btn-primary">
														<i class="fas fa-plus me-1"></i>Tambah Sub Kategori
													</button>
													<button data-bs-target="#add-category-sub-type" data-bs-toggle="modal" class="btn btn-primary">
														<i class="fas fa-plus me-1"></i>Tambah Tipe Sub
													</button>
												</div>
											</div>
											<div class="col-lg-12">
												<table id="categoriTable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>No</th>
															<th>Image</th>
															<th>Nama Categori</th>
															<th>Parent</th>
															<th>Type</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Other Tabs -->
						<div class="tab-pane fade" id="v-pills-brand" role="tabpanel" aria-labelledby="v-pills-brand-tab" tabindex="0">
							<div class="col-lg-12">
								<div class="card shadow-sm border-0">
									<div class="card-body px-4 py-3">
										<div class="row">
											<div class="col-lg-12 d-flex justify-content-between align-items-center">
												<h3 class="fw-bold">Brand List</h3>
												<div class="d-flex gap-2">
													<button data-bs-target="#add-brand" data-bs-toggle="modal" class="btn btn-primary">
														<i class="fas fa-plus me-1"></i>Tambah Merk
													</button>
												</div>
											</div>
											<div class="col-lg-12">
												<table id="brandTable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>No</th>
															<th>Image</th>
															<th>Nama Brand</th>
															<th>Parent</th>
															<th>Type</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-model" role="tabpanel" aria-labelledby="v-pills-model-tab" tabindex="0">
							<div class="col-lg-12">
								<div class="card shadow-sm border-0">
									<div class="card-body px-4 py-3">
										<div class="row">
											<div class="col-lg-12 d-flex justify-content-between align-items-center">
												<h3 class="fw-bold">Model List</h3>
												<div class="d-flex gap-2">
													<button data-bs-target="#add-model" data-bs-toggle="modal" class="btn btn-primary">
														<i class="fas fa-plus me-1"></i>Tambah Model
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<table id="modelTable" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>No</th>
													<th>Image</th>
													<th>Nama Model</th>
													<th>Parent</th>
													<th>Type</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-attribute" role="tabpanel" aria-labelledby="v-pills-attribute-tab" tabindex="0">
							<div class="col-lg-12">
								<div class="card shadow-sm border-0">
									<div class="card-body px-4 py-3">
										<div class="row d-flex flex-column gap-5">
											<div class="col-lg-12 d-flex justify-content-between align-items-center">
												<h3 class="fw-bold">Attribute List</h3>
												<div class="d-flex gap-2">
													<button data-bs-target="#add-attribute" data-bs-toggle="modal" class="btn btn-primary">
														<i class="fas fa-plus me-1"></i>Tambah Attribute
													</button>
												</div>
											</div>
											<div class="col-lg-12">
												<table id="attributeTable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>No</th>
															<th>Nama Attribute</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="add-attribute" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Add New Attribute</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form id="addFormAttribute">
											<div class="modal-body">
												<div class="mb-3">
													<label for="attribute" class="form-label">Nama Attribute</label>
													<input type="text" class="form-control" id="attribute" name="name" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Edit Modal -->
							<div class="modal fade" id="edit-attribute" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Attribute</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form id="editFormAttribute">
											<div class="modal-body">
												<input type="hidden" id="edit_id" name="id">
												<div class="mb-3">
													<label for="edit_attribute" class="form-label">Nama Attribute</label>
													<input type="text" class="form-control" id="edit_attribute" name="name" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="v-pills-grade" role="tabpanel" aria-labelledby="v-pills-grade-tab" tabindex="0">
						<div class="col-lg-12">
							<div class="card shadow-sm border-0">
								<div class="card-body px-4 py-3">
									<div class="row d-flex flex-column gap-5">
										<div class="col-lg-12 d-flex justify-content-between align-items-center">
											<h3 class="fw-bold">Grade List</h3>
											<div class="d-flex gap-2">
												<button data-bs-target="#add-grade" data-bs-toggle="modal" class="btn btn-primary">
													<i class="fas fa-plus me-1"></i>Tambah Grade
												</button>
											</div>
										</div>
										<div class="col-lg-12">
											<table id="gradeTable" class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>No</th>
														<th>Grade</th>
														<th>Type</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="add-grade" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Add New Grade</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<form id="addFormGrade">
										<div class="modal-body">
											<div class="mb-3">
												<label for="grade" class="form-label">Grade</label>
												<input type="text" class="form-control" id="grade" name="grade" required>
											</div>
											<div class="mb-3">
												<label for="type" class="form-label">Type</label>
												<select name="type" id="type" class="form-control" required>
													<option value="0" selected>Produk</option>
													<option value="1">Mekanik</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<!-- Edit Modal -->
						<div class="modal fade" id="edit-grade" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Grade</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<form id="editFormGrade">
										<div class="modal-body">
											<input type="hidden" id="edit_id" name="id">
											<div class="mb-3">
												<label for="edit_grade" class="form-label">Grade</label>
												<input type="text" class="form-control" id="edit_grade" name="grade" required>
											</div>
											<div class="mb-3">
												<label for="edit_type" class="form-label">Type</label>
												<select name="type" id="edit_type" class="form-control" required>
													<option value="0" selected>Produk</option>
													<option value="1">Mekanik</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3">
	<div id="toastMessage" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header">
			<strong class="me-auto" id="toastTitle">System Message</strong>
			<small id="toastTime">Just now</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body" id="toastBody">
			<!-- Message will appear here -->
		</div>
	</div>
</div>
</div>

<style>
	.toast.bg-success .toast-header {
		background-color: #198754;
		color: white;
	}

	.toast.bg-danger .toast-header {
		background-color: #dc3545;
		color: white;
	}

	.toast.bg-warning .toast-header {
		background-color: #ffc107;
		color: black;
	}

	/* Toast animation */
	.toast {
		transition: transform 0.3s ease-in-out;
	}
</style>