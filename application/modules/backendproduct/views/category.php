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
										<div class="row d-flex flex-column gap-3">
											<div class="col-lg-12 d-flex justify-content-between align-items-center">
												<h3 class="fw-bold">Category List & Sub</h3>
												<button data-bs-target="#add-categori" data-bs-toggle="modal" class="btn btn-primary">
													<i class="fas fa-plus me-1"></i>Tambah Kategori
												</button>
											</div>
											<ul class="nav nav-tabs" id="myTab" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Product</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link" id="jasa-tab" data-bs-toggle="tab" data-bs-target="#jasa-tab-pane" type="button" role="tab" aria-controls="jasa-tab-pane" aria-selected="false">Jasa</button>
												</li>
											</ul>
											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
													<div class="col-lg-12 d-flex justify-content-between align-items-center">
														<h3 class="fw-bold">Product</h3>
														<div class="d-flex gap-2">
															<button data-bs-target="#add-subcategori" data-bs-toggle="modal" class="btn btn-primary">
																<i class="fas fa-plus me-1"></i>Tambah Sub Kategori
															</button>
															<button data-bs-target="#add-subsubcategori" data-bs-toggle="modal" class="btn btn-primary">
																<i class="fas fa-plus me-1"></i>Tambah Sub Sub Categori
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
																	<th>Actions</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
													<div class="modal fade" id="add-subcategori" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Add New Sub Categori</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="addFormSubCategori" enctype="multipart/form-data">
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSub" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSub" name="fileuploadSub" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSub" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="mainCategori" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriId" id="mainCategori" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3">
																				<label for="subCategori" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategori" name="name" disabled required>
																			</div>
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
													<div class="modal fade" id="edit-subcategori" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Edit Sub Categori</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="editFormSubCategori" enctype="multipart/form-data">
																	<div class="modal-body">
																		<input type="hidden" name="edit_subcategori_id" id="edit_subcategori_id">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubEdit" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubEdit" name="fileuploadSubEdit" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																				<div class="mt-2" id="edit_image_subcategory"></div>
																				<input type="hidden" name="edit_image_subcategory_value" id="edit_image_subcategory_value">
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubEdit" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriEdit" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriEditId" id="mainCategoriEdit" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3">
																				<label for="subCategoriEdit" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategoriEdit" name="name" disabled required>
																			</div>
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
													<div class="modal fade" id="add-subsubcategori" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Add New Sub Sub Category</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="addFormSubSubCategori">
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubSub" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubSub" name="fileuploadSubSub" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubSub" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriSub" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriSubId" id="mainCategoriSub" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriSubSub" class="form-label fw-bold">Kategori Sub</label>
																				<select name="mainCategoriSubSubId" id="mainCategoriSubSub" class="form-control" disabled></select>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-md-12 mb-3">
																				<label for="subCategoriSub" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategoriSub" name="name" disabled required>
																			</div>
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
													<div class="modal fade" id="edit-subsubcategori" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Edit Sub Sub Category</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="editFormSubSubCategori">
																	<div class="modal-body">
																		<input type="hidden" name="edit_subsubcategori_id" id="edit_subsubcategori_id">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubSubEdit" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubSubEdit" name="fileuploadSubSubEdit" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																				<div class="mt-2" id="edit_image_subsubcategory"></div>
																				<input type="hidden" name="edit_image_subsubcategory_value" id="edit_image_subsubcategory_value">
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubSubEdit" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriSubEdit" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriSubEditId" id="mainCategoriSubEdit" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriSubSubEdit" class="form-label fw-bold">Kategori Sub</label>
																				<select name="mainCategoriSubSubEditId" id="mainCategoriSubSubEdit" class="form-control" disabled></select>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-md-12 mb-3">
																				<label for="subCategoriSubEdit" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategoriSubEdit" name="name" disabled required>
																			</div>
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
												</div>
												<div class="tab-pane fade" id="jasa-tab-pane" role="tabpanel" aria-labelledby="jasa-tab" tabindex="0">
													<div class="col-lg-12 d-flex justify-content-between align-items-center">
														<h3 class="fw-bold">Jasa</h3>
														<div class="d-flex gap-2">
															<button data-bs-target="#add-subcategori-jasa" data-bs-toggle="modal" class="btn btn-primary">
																<i class="fas fa-plus me-1"></i>Tambah Sub Jasa
															</button>
															<button data-bs-target="#add-subsubcategori-jasa" data-bs-toggle="modal" class="btn btn-primary">
																<i class="fas fa-plus me-1"></i>Tambah Sub Sub Jasa
															</button>
														</div>
													</div>
													<div class="col-lg-12">
														<table id="categoriJasaTable" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Image</th>
																	<th>Nama Jasa</th>
																	<th>Actions</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
													<div class="modal fade" id="add-subcategori-jasa" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Add New Sub Jasa</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="addFormSubCategoriJasa">
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubJasa" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubJasa" name="fileuploadSubJasa" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubJasa" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3"><label for="mainCategoriJasa" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriJasaId" id="mainCategoriJasa" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3"><label for="subCategoriJasa" class="form-label fw-bold">Nama Sub Kategori Jasa</label>
																				<input type="text" class="form-control" id="subCategoriJasa" name="name" disabled required>
																			</div>
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
													<div class="modal fade" id="edit-subcategori-jasa" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Edit Sub Jasa</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="editFormSubCategoriJasa" enctype="multipart/form-data">
																	<div class="modal-body">
																		<input type="hidden" name="edit_subcategori_jasa_id" id="edit_subcategori_jasa_id">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubJasaEdit" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubJasaEdit" name="fileuploadSubJasaEdit" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																				<div class="mt-2" id="edit_image_subcategory_jasa"></div>
																				<input type="hidden" name="edit_image_subcategory_jasa_value" id="edit_image_subcategory_jasa_value">
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubJasaEdit" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriJasaEdit" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriJasaEditId" id="mainCategoriJasaEdit" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3">
																				<label for="subCategoriJasaEdit" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategoriJasaEdit" name="name" disabled required>
																			</div>
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
													<div class="modal fade" id="add-subsubcategori-jasa" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Add New Sub Sub Jasa</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="addFormSubSubCategoriJasa">
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubSubJasa" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubSubJasa" name="fileuploadSubSubJasa" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubSubJasa" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3"><label for="mainCategoriSubJasa" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriSubJasaId" id="mainCategoriSubJasa" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3"><label for="mainCategoriSubSubJasa" class="form-label fw-bold">Kategori Sub</label>
																				<select name="mainCategoriSubSubJasaId" id="mainCategoriSubSubJasa" class="form-control" disabled></select>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12 mb-3"><label for="subCategoriSubJasa" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategoriSubJasa" name="name" disabled required>
																			</div>
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
													<div class="modal fade" id="edit-subsubcategori-jasa" tabindex="-1">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Edit Sub Sub Jasa</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<form id="editFormSubSubCategoriJasa">
																	<div class="modal-body">
																		<input type="hidden" name="edit_subsubcategori_jasa_id" id="edit_subsubcategori_jasa_id">
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="fileuploadSubSubJasaEdit" class="form-label fw-bold">Icon / Image</label>
																				<input type="file" class="form-control" id="fileuploadSubSubJasaEdit" name="fileuploadSubSubJasaEdit" accept=".jpg,.jpeg,.png">
																				<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
																				<div class="mt-2" id="edit_image_subsubcategory_jasa"></div>
																				<input type="hidden" name="edit_image_subsubcategory_jasa_value" id="edit_image_subsubcategory_jasa_value">
																			</div>
																			<div class="col-md-6 mb-3">
																				<div id="imagePreviewSubSubJasaEdit" class="mt-2"></div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriSubJasaEdit" class="form-label fw-bold">Kategori Utama</label>
																				<select name="mainCategoriSubJasaEditId" id="mainCategoriSubJasaEdit" class="form-control"></select>
																			</div>
																			<div class="col-md-6 mb-3">
																				<label for="mainCategoriSubSubJasaEdit" class="form-label fw-bold">Kategori Sub</label>
																				<select name="mainCategoriSubSubJasaEditId" id="mainCategoriSubSubJasaEdit" class="form-control" disabled></select>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-md-12 mb-3">
																				<label for="subCategoriSubJasaEdit" class="form-label fw-bold">Nama Sub Kategori</label>
																				<input type="text" class="form-control" id="subCategoriSubJasaEdit" name="name" disabled required>
																			</div>
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
												</div>
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
								<div class="modal fade" id="add-brand" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Add New Brand</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<form id="addFormBrand">
												<div class="modal-body">
													<div class="row d-flex flex-column">
														<div class="col-lg-12">
															<div class="row d-flex">
																<div class="col-lg-4">
																	<label class="fw-bold" for="uploadBtn">Logo Brand</label>
																	<input type="file" id="uploadBtn" name="logoBrand" class="form-control" style="opacity: 0;filter: alpha(opacity=0);cursor: pointer;">
																	<a href="#" id="filetext" name="file" class="btn btn-primary" style="margin-top:-50px;cursor: pointer;">Pilih file</a>
																</div>
																<div class="col-lg-8">
																	<p>Preview Gambar</p>
																	<img src="" class="blah img-fluid" style="max-height: 100px;">
																</div>
															</div>
														</div>
													</div>
													<div class="my-3">
														<label for="brand" class="form-label fw-bold">Nama Brand</label>
														<input type="text" class="form-control" id="brand" name="name" required>
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
								<div class="modal fade" id="edit-brand" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Edit Brand</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<form id="editFormBrand" enctype="multipart/form-data">
												<div class="modal-body">
													<input type="hidden" id="edit_id" name="id">
													<div class="row d-flex flex-column">
														<div class="col-lg-12">
															<div class="row d-flex align-items-start">
																<div class="col-lg-4">
																	<label class="fw-bold" for="edit_logoBrand">Logo Brand</label>
																	<input type="file" id="edit_logoBrand" name="logoBrand" class="form-control" style="opacity: 0; position: absolute; z-index: -1;">
																	<a href="#" id="filetext" class="btn btn-primary w-100">Choose File</a>
																	<small class="form-text text-muted d-block mt-1">Max: 1MB, JPG/PNG</small>
																</div>
																<div class="col-lg-8">
																	<div class="d-flex flex-column align-items-center">
																		<p class="mb-2">Preview Gambar</p>
																		<img src="" class="blah img-fluid rounded border" style="max-height: 100px; display: none;">
																		<small class="text-muted mt-2">Current logo will be replaced</small>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="my-3">
														<label for="edit_brand" class="form-label fw-bold">Nama Brand</label>
														<input type="text" class="form-control" id="edit_brand" name="name" required>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Update Brand</button>
												</div>
											</form>
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
											<div class="col-lg-12">
												<table id="modelTable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>No</th>
															<th>Image</th>
															<th>Nama Model</th>
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
							<div class="modal fade" id="add-model" tabindex="-1">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Add Model</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form id="addFormModel">
											<div class="modal-body">
												<div class="row">
													<div class="col-md-6 mb-3">
														<label for="fileuploadModel" class="form-label fw-bold">Icon / Image</label>
														<input type="file" class="form-control" id="fileuploadModel" name="fileuploadModel" accept=".jpg,.jpeg,.png">
														<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
														<div class="mt-2" id="edit_image_model"></div>
														<input type="hidden" name="edit_image_model_value" id="edit_image_model_value">
													</div>
													<div class="col-md-6 mb-3">
														<div id="imagePreviewModel" class="mt-2"></div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 mb-3"><label for="mainCategoriModel" class="form-label fw-bold">Kategori</label>
														<select name="mainCategoriModelId" id="mainCategoriModel" class="form-control"></select>
													</div>
													<div class="col-md-6 mb-3"><label for="subCategoriModel" class="form-label fw-bold">Sub Kategori</label>
														<select name="subCategoriModelId" id="subCategoriModel" class="form-control" disabled></select>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 mb-3">
														<label for="subSubCategoriModel" class="form-label fw-bold">Sub Sub Kategori</label>
														<select type="text" class="form-control" id="subSubCategoriModel" name="subSubCategoriModelId" disabled></select>
													</div>
													<div class="col-md-6 mb-3"><label for="mainBrandModel" class="form-label fw-bold">Brand</label>
														<select type="text" class="form-control" id="mainBrandModel" name="mainBrandModelId" disabled required></select>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 mb-3">
														<label for="model" class="form-label fw-bold">Nama Model</label>
														<input type="text" class="form-control" id="model" name="name" disabled required>
													</div>
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
							<div class="modal fade" id="edit-model" tabindex="-1">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Model</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form id="editFormModel">
											<div class="modal-body">
												<input type="hidden" name="edit_model_id" id="edit_model_id">
												<div class="row">
													<div class="col-md-6 mb-3">
														<label for="fileuploadModelEdit" class="form-label fw-bold">Icon / Image</label>
														<input type="file" class="form-control" id="fileuploadModelEdit" name="fileuploadModelEdit" accept=".jpg,.jpeg,.png">
														<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
													</div>
													<div class="col-md-6 mb-3">
														<div id="imagePreviewModelEdit" class="mt-2"></div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 mb-3"><label for="mainCategoriModelEdit" class="form-label fw-bold">Kategori</label>
														<select name="mainCategoriModelEditId" id="mainCategoriModelEdit" class="form-control"></select>
													</div>
													<div class="col-md-6 mb-3"><label for="subCategoriModelEdit" class="form-label fw-bold">Sub Kategori</label>
														<select name="subCategoriModelEditId" id="subCategoriModelEdit" class="form-control" disabled></select>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 mb-3"><label for="subSubCategoriModelEdit" class="form-label fw-bold">Sub Sub Kategori</label>
														<select type="text" class="form-control" id="subSubCategoriModelEdit" name="subSubCategoriModelEditId" disabled></select>
													</div>
													<div class="col-md-6 mb-3"><label for="mainBrandModelEdit" class="form-label fw-bold">Brand</label>
														<select type="text" class="form-control" id="mainBrandModelEdit" name="mainBrandModelEditId" disabled required></select>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 mb-3">
														<label for="model" class="form-label fw-bold">Nama Model</label>
														<input type="text" class="form-control" id="model" name="name" disabled required>
													</div>
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
												<input type="hidden" id="edit_id" name="id" value="">
												<div class="mb-3">
													<label for="edit_attribute" class="form-label">Nama Attribute</label>
													<input type="text" class="form-control" id="edit_attribute" name="name" value="" required>
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
												<input type="hidden" id="edit_id" name="id" value="">
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
</div>
<div class="modal fade" id="add-categori" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Category</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<form id="addFormCategori" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="name" name="name" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="select2-grade" class="form-label fw-bold">Grade</label>
							<select class="form-select select2-grade" id="select2-grade" name="grade[]" multiple>
								<option value="#">Pilih Grade</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="select2-brand" class="form-label fw-bold">Merk/Brand</label>
							<select class="form-select select2-brand" id="select2-brand" name="merk[]" multiple>
								<option value="#">Pilih Brand</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="etc" class="form-label fw-bold">Type Categotri</label>
							<select class="form-select" id="etc" name="etc">
								<option value="0" selected>Product</option>
								<option value="1">Jasa</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="select2-attribute" class="form-label fw-bold">Attributes</label>
							<select class="form-select select2-attribute" id="select2-attribute" name="attribute[]" multiple>
								<option value="#">Pilih Attribute</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="fileupload" class="form-label fw-bold">Icon / Image</label>
							<input type="file" class="form-control" id="fileupload" name="fileupload" accept=".jpg,.jpeg,.png">
							<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>

						</div>
						<div class="col-md-6 mb-3">
							<div id="imagePreview" class="mt-2"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save Category</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="edit-categori" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Category</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<form id="editFormCategori" enctype="multipart/form-data">
				<input type="hidden" id="edit_category_id" name="id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="edit_name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="edit_name" name="name" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="edit_select2-grade" class="form-label fw-bold">Grade</label>
							<select class="form-select select2-grade-edit" id="edit_select2-grade" name="grade[]" multiple>
								<!-- Options akan diisi via JS -->
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="edit_select2-brand" class="form-label fw-bold">Merk/Brand</label>
							<select class="form-select select2-brand-edit" id="edit_select2-brand" name="merk[]" multiple>
								<!-- Options akan diisi via JS -->
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="edit_etc" class="form-label fw-bold">Type Categori</label>
							<select class="form-select" id="edit_etc" name="etc">
								<option value="0">Product</option>
								<option value="1">Jasa</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="edit_select2-attribute" class="form-label fw-bold">Attributes</label>
							<select class="form-select select2-attribute-edit" id="edit_select2-attribute" name="attribute[]" multiple>
								<!-- Options akan diisi via JS -->
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="edit_fileupload" class="form-label fw-bold">Icon / Image</label>
							<input type="file" class="form-control" id="edit_fileupload" name="fileuploadEdit" accept=".jpg,.jpeg,.png">
							<div class="form-text">Format: JPG, PNG (Max: 1MB, 1000x1000px)</div>
							<!-- Info gambar saat ini -->
							<div class="mt-2" id="edit_image_category"></div>
							<input type="hidden" name="edit_image_category_value" id="edit_image_category_value">
						</div>
						<div class="col-md-6 mb-3">
							<div id="edit_imagePreview" class="mt-2"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update Category</button>
				</div>
			</form>
		</div>
	</div>
</div>