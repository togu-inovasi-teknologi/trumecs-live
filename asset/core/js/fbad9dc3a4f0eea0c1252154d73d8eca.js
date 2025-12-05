var base_url = $("body").attr("baseurl");
var idprn = "";
var idctr = "";
var txtctr = "";
var img = "";
// grade jquery

var tableCategori = $("#categoriTable").DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: base_url + "backendproduct/mainCategoriesAjaxList",
    type: "POST",
  },
  columns: [
    { data: 0, orderable: false },
    { data: 1 },
    { data: 2 },
    { data: 3, orderable: false },
  ],
  order: [[0, "asc"]],
});
var tableCategoriJasa = $("#categoriJasaTable").DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: base_url + "backendproduct/mainCategoriesJasaAjaxList",
    type: "POST",
  },
  columns: [
    { data: 0, orderable: false },
    { data: 1 },
    { data: 2 },
    { data: 3, orderable: false },
  ],
  order: [[0, "asc"]],
});
var tableBrand = $("#brandTable").DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: base_url + "backendproduct/brandsAjaxList",
    type: "POST",
  },
  columns: [
    { data: 0, orderable: false },
    { data: 1 },
    { data: 2 },
    { data: 3, orderable: false },
  ],
  order: [[0, "asc"]],
});

$(document).ready(function () {
  var tableGrade = $("#gradeTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "backendproduct/gradeAjaxList",
      type: "POST",
    },
    columns: [
      { data: 0, orderable: false },
      { data: 1 },
      { data: 2 },
      { data: 3, orderable: false },
    ],
    order: [[0, "asc"]],
  });

  // Add form submission
  $("#addFormGrade").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: base_url + "backendproduct/gradeAjaxAdd",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-grade").modal("hide");
          $("#addFormGrade")[0].reset();
          tableGrade.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Add Grade!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Add Grade Error!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        }
      },
    });
  });

  // Edit button click
  $("#gradeTable").on("click", ".edit", function () {
    var id = $(this).data("id");
    var grade = $(this).data("grade");
    var type = $(this).data("type");
    $("#edit_id").val(id);
    $("#edit_grade").val(grade);
    $("#edit_type").val(type);

    $("#edit-grade").modal("show");
  });

  // Edit form submission
  $("#editFormGrade").on("submit", function (e) {
    e.preventDefault();

    var formData = {
      id: $("#edit_id").val(),
      grade: $("#edit_grade").val(),
      type: $("#edit_type").val(),
    };

    $.ajax({
      url: base_url + "backendproduct/gradeAjaxUpdate",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          tableGrade.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Edit Grade!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
          $("#edit-grade").modal("hide");
        } else {
          Swal.fire({
            icon: "error",
            title: "Edit Grade Error!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        }
      },
    });
  });

  // Delete button click
  $("#gradeTable").on("click", ".delete", function () {
    var id = $(this).data("id");
    var name = $(this).data("name") || "this grade";
    Swal.fire({
      title: "Delete grade?",
      html: `Are you sure you want to delete <strong>${name}</strong>?<br><small class="text-danger">This action cannot be undone.</small>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        return new Promise((resolve) => {
          $.ajax({
            url: base_url + "backendproduct/gradeAjaxDelete",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
              resolve(response);
            },
            error: function () {
              resolve({ status: false, message: "Network error" });
            },
          });
        });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.value.status) {
          tableGrade.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: result.value.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.value.message,
          });
        }
      }
    });
  });
});

// attribute jquery

$(document).ready(function () {
  var tableAttribute = $("#attributeTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "backendproduct/attributeAjaxList",
      type: "POST",
    },
    columns: [
      { data: 0, orderable: false },
      { data: 1 },
      { data: 2, orderable: false },
    ],
    order: [[0, "asc"]],
  });

  // Add form submission
  $("#addFormAttribute").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: base_url + "backendproduct/attributeAjaxAdd",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-attribute").modal("hide");
          $("#addFormAttribute")[0].reset();
          tableAttribute.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Add Attribute!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Add Attribute Error!",
            text: response.message,
            timer: 2000,
          });
        }
      },
    });
  });

  // Edit button click
  $("#attributeTable").on("click", ".edit", function () {
    var id = $(this).data("id");
    var attribute = $(this).data("attribute");
    $("#edit_id").val(id);
    $("#edit_attribute").val(attribute);
    $("#edit-attribute").modal("show");
  });

  // Edit form submission
  $("#editFormAttribute").on("submit", function (e) {
    e.preventDefault();

    var formData = {
      id: $("#edit_id").val(),
      name: $("#edit_attribute").val(),
    };

    $.ajax({
      url: base_url + "backendproduct/attributeAjaxUpdate",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#edit-attribute").modal("hide");
          tableAttribute.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Edit Attribute!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Edit Attribute Error!",
            text: response.message,
            timer: 2000,
          });
        }
      },
    });
  });

  // Delete button click
  $("#attributeTable").on("click", ".delete", function () {
    var id = $(this).data("id");
    var name = $(this).data("name") || "this attribute";
    Swal.fire({
      title: "Delete Attribute?",
      html: `Are you sure you want to delete <strong>${name}</strong>?<br><small class="text-danger">This action cannot be undone.</small>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        return new Promise((resolve) => {
          $.ajax({
            url: base_url + "backendproduct/attributeAjaxDelete",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
              resolve(response);
            },
            error: function () {
              resolve({ status: false, message: "Network error" });
            },
          });
        });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.value.status) {
          tableAttribute.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: result.value.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.value.message,
          });
        }
      }
    });
  });
});

// categori table

$(document).ready(function () {
  // Inisialisasi Select2 untuk semua select multiple
  function initSelect2() {
    $(".select2-grade, .select2-brand, .select2-attribute").select2({
      width: "100%",
      placeholder: "Pilih opsi...",
      allowClear: true,
      closeOnSelect: false,
      dropdownParent: $("#add-categori"),
    });
  }

  function loadGrades() {
    $.ajax({
      url: base_url + "backendproduct/getGrades",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#select2-grade");
          select.empty(); // Kosongkan dulu
          select.append('<option value="">Pilih Grade</option>');
          $.each(response.data, function (index, grade) {
            select.append(
              '<option value="' +
                grade.id +
                '">' +
                grade.grade +
                " (" +
                grade.type +
                ")" +
                "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load grade",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error loading grade: " + error,
        });
      },
    });
  }

  function loadBrands() {
    $.ajax({
      url: base_url + "backendproduct/getBrands",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#select2-brand");
          select.empty(); // Kosongkan dulu
          select.append('<option value="">Pilih Brand</option>');
          $.each(response.data, function (index, brand) {
            select.append(
              '<option value="' + brand.id + '">' + brand.name + "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load brand",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error loading brand: " + error,
        });
      },
    });
  }

  function loadAttributes() {
    $.ajax({
      url: base_url + "backendproduct/getAttributes",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#select2-attribute");
          select.empty(); // Kosongkan dulu
          select.append('<option value="">Pilih Attribute</option>');
          $.each(response.data, function (index, attribute) {
            select.append(
              '<option value="' +
                attribute.id +
                '">' +
                attribute.name +
                "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load attribute: ",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error loading attribute: " + error,
        });
      },
    });
  }

  // Inisialisasi saat modal dibuka
  $("#add-categori").on("show.bs.modal", function () {
    initSelect2();
    loadGrades();
    loadBrands();
    loadAttributes();
  });

  // Reset select2 saat modal ditutup
  $("#add-categori").on("hidden.bs.modal", function () {
    $(".select2-grade, .select2-brand, .select2-attribute")
      .val(null)
      .trigger("change");
  });

  $("#fileupload").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format file tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreview").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">'
        );
      };
      reader.readAsDataURL(file);
    }
  });

  // Form submission
  $("#addFormCategori").on("submit", function (e) {
    e.preventDefault();
    var name = $("#name").val();
    if (!name || name.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Nama Kategori Wajib diisi",
      });
      $("#name").focus();
      return;
    }

    // Buat FormData untuk handle file upload
    var formData = new FormData(this);

    // Tampilkan loading
    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    $.ajax({
      url: base_url + "backendproduct/categoriAjaxAdd",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          // Success
          $("#add-categori").modal("hide");
          $("#addFormCategori")[0].reset();

          // Reset select2
          $(".select2-grade, .select2-brand, .select2-attribute")
            .val(null)
            .trigger("change");

          // Reset preview
          $("#imagePreview").empty();

          // Reload datatable
          if (typeof tableCategori !== "undefined") {
            tableCategori.ajax.reload();
            tableCategoriJasa.ajax.reload();
          }

          tableCategori.ajax.reload();
          tableCategoriJasa.ajax.reload();

          Swal.fire({
            icon: "success",
            title: "Add Category!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        // Restore button
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  function loadCategoryData(id) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: base_url + "backendproduct/getCategoryById/" + id,
        type: "GET",
        dataType: "json",
        success: function (response) {
          console.log("Response dari server:", response);

          if (response.status) {
            var category = response.data;

            // Set nilai form
            $("#edit_category_id").val(category.id);
            $("#edit_name").val(category.name);
            $("#edit_etc").val(category.etc || "0");

            // Tampilkan info gambar saat ini
            if (category.img) {
              var imageUrl =
                base_url + "public/upload/categori/" + category.img;
              $("#edit_image_category").html(
                '<div class="alert alert-info p-2">' +
                  'Gambar saat ini: <a href="' +
                  imageUrl +
                  '" target="_blank">' +
                  category.img +
                  "</a></div>"
              );
              $("#edit_image_category_value").val(category.img);
              $("#edit_imagePreview").html(
                '<img src="' +
                  imageUrl +
                  '" class="img-thumbnail" style="max-width: 150px;">'
              );
            } else {
              $("#edit_image_category").html(
                '<div class="alert alert-warning p-2">Tidak ada gambar</div>'
              );
            }

            // Set nilai select2 untuk grade
            if (category.grades && category.grades.length > 0) {
              console.log(
                "Setting grades:",
                category.grades.map((g) => g.id)
              );
              var gradeIds = category.grades.map(function (grade) {
                return grade.id.toString();
              });
              $("#edit_select2-grade").val(gradeIds).trigger("change");
            }

            // Set nilai select2 untuk brand
            if (category.brands && category.brands.length > 0) {
              console.log(
                "Setting brands:",
                category.brands.map((b) => b.id)
              );
              var brandIds = category.brands.map(function (brand) {
                return brand.id.toString();
              });
              $("#edit_select2-brand").val(brandIds).trigger("change");
            }

            // Set nilai select2 untuk attribute
            if (category.attributes && category.attributes.length > 0) {
              console.log(
                "Setting attributes:",
                category.attributes.map((a) => a.id)
              );
              var attributeIds = category.attributes.map(function (attr) {
                return attr.id.toString();
              });
              $("#edit_select2-attribute").val(attributeIds).trigger("change");
            }

            // PENTING: Resolve promise setelah semua selesai
            console.log("Category data loaded successfully");
            resolve(); // ✅ TAMBAHKAN INI
          } else {
            console.error("Server error:", response.message);
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", xhr.responseText);
          reject(error);
        },
      });
    });
  }

  function initSelect2Edit() {
    $(
      ".select2-grade-edit, .select2-brand-edit, .select2-attribute-edit"
    ).select2({
      width: "100%",
      placeholder: "Pilih opsi...",
      allowClear: true,
      closeOnSelect: false,
      dropdownParent: $("#edit-categori .modal-content"),
    });
  }

  // Function untuk load data select2 di modal edit
  function loadSelectDataForEdit() {
    return new Promise(function (resolve, reject) {
      var promises = [];

      // Load grades
      promises.push(
        $.ajax({
          url: base_url + "backendproduct/getGrades",
          type: "GET",
          dataType: "json",
        }).done(function (response) {
          if (response.status) {
            var select = $("#edit_select2-grade");
            select.empty();
            select.append('<option value="">Pilih Grade</option>');
            $.each(response.data, function (index, grade) {
              select.append(
                '<option value="' +
                  grade.id +
                  '">' +
                  grade.grade +
                  " (" +
                  grade.type +
                  ")" +
                  "</option>"
              );
            });
          }
        })
      );

      // Load brands
      promises.push(
        $.ajax({
          url: base_url + "backendproduct/getBrands",
          type: "GET",
          dataType: "json",
        }).done(function (response) {
          if (response.status) {
            var select = $("#edit_select2-brand");
            select.empty();
            select.append('<option value="">Pilih Brand</option>');
            $.each(response.data, function (index, brand) {
              select.append(
                '<option value="' + brand.id + '">' + brand.name + "</option>"
              );
            });
          }
        })
      );

      // Load attributes
      promises.push(
        $.ajax({
          url: base_url + "backendproduct/getAttributes",
          type: "GET",
          dataType: "json",
        }).done(function (response) {
          if (response.status) {
            var select = $("#edit_select2-attribute");
            select.empty();
            select.append('<option value="">Pilih Attribute</option>');
            $.each(response.data, function (index, attribute) {
              select.append(
                '<option value="' +
                  attribute.id +
                  '">' +
                  attribute.name +
                  "</option>"
              );
            });
          }
        })
      );

      // Tunggu semua AJAX selesai
      $.when
        .apply($, promises)
        .then(function () {
          // Inisialisasi Select2 setelah semua data dimuat
          $(
            ".select2-grade-edit, .select2-brand-edit, .select2-attribute-edit"
          ).select2({
            width: "100%",
            placeholder: "Pilih opsi...",
            allowClear: true,
            closeOnSelect: false,
            dropdownParent: $("#edit-categori .modal-content"),
          });
          resolve();
        })
        .fail(function (error) {
          reject(error);
        });
    });
  }

  // Event saat modal edit ditutup
  $("#edit-categori").on("hidden.bs.modal", function () {
    // Reset form
    $("#editFormCategori")[0].reset();
    $("#edit_image_category").empty();
    $("#edit_imagePreview").empty();

    // Reset select2
    $(".select2-grade-edit, .select2-brand-edit, .select2-attribute-edit")
      .val(null)
      .trigger("change");
  });

  $(document).on("click", ".edit-categori", function () {
    var categoryId = $(this).data("id");

    // 1. Init Select2 DULU (tanpa modal)
    initSelect2Edit();

    // 2. Load data select2 dan tunggu selesai
    loadSelectDataForEdit()
      .then(function () {
        // 3. Load category data
        return loadCategoryData(categoryId);
      })
      .then(function () {
        // 4. BARU tampilkan modal setelah semua siap
        $("#edit-categori").modal("show");
      })
      .catch(function (error) {
        console.error("Error:", error);
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Gagal memuat data. Silakan coba lagi.",
        });
      });
  });

  $("#edit_fileupload").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format file tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }

      var reader = new FileReader();
      reader.onload = function (e) {
        $("#edit_imagePreview").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">'
        );
      };
      reader.readAsDataURL(file);
    }
  });

  $("#editFormCategori").on("submit", function (e) {
    e.preventDefault();

    var name = $("#edit_name").val();
    if (!name || name.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Nama Kategori wajib diisi",
      });
      $("#edit_name").focus();
      return;
    }

    // Buat FormData
    var formData = new FormData(this);

    // Tampilkan loading
    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html(
        '<span class="spinner-border spinner-border-sm"></span> Updating...'
      );

    $.ajax({
      url: base_url + "backendproduct/categoriAjaxUpdate",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          // Success
          $("#edit-categori").modal("hide");
          $("#editFormCategori")[0].reset();

          // Reset preview
          $("#edit_imagePreview").empty();
          $("#edit_image_category").empty();

          // Reload DataTables
          if (typeof tableCategori !== "undefined") {
            tableCategori.ajax.reload();
            tableCategoriJasa.ajax.reload();
          }

          Swal.fire({
            icon: "success",
            title: "Success!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        // Restore button
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  $("#categoriTable").on("click", ".delete-categori", function () {
    var id = $(this).data("id");
    var name = $(this).data("name") || "this categori";
    var button = $(this);

    Swal.fire({
      title: "Delete Brand?",
      html: `Are you sure you want to delete <strong>${name}</strong>?<br><small class="text-danger">This action cannot be undone.</small>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        return new Promise((resolve) => {
          $.ajax({
            url: base_url + "backendproduct/categoriAjaxDelete",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
              resolve(response);
            },
            error: function () {
              resolve({ status: false, message: "Network error" });
            },
          });
        });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.value.status) {
          tableBrand.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: result.value.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.value.message,
          });
        }
      }
    });
  });

  $("#categoriJasaTable").on("click", ".delete-categori", function () {
    var id = $(this).data("id");
    var name = $(this).data("name") || "this categori";
    var button = $(this);

    Swal.fire({
      title: "Delete Brand?",
      html: `Are you sure you want to delete <strong>${name}</strong>?<br><small class="text-danger">This action cannot be undone.</small>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        return new Promise((resolve) => {
          $.ajax({
            url: base_url + "backendproduct/categoriAjaxDelete",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
              resolve(response);
            },
            error: function () {
              resolve({ status: false, message: "Network error" });
            },
          });
        });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.value.status) {
          tableCategori.ajax.reload();
          tableCategoriJasa.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: result.value.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.value.message,
          });
        }
      }
    });
  });
});

$(document).ready(function () {
  $("#fileuploadSub").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSub").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">'
        );
      };
      reader.readAsDataURL(file);
    }
  });

  $("#fileuploadSubEdit").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }

      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubEdit").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">' +
            '<div class="mt-1 text-success small">New Image Preview</div>'
        );

        // Update hidden value jika user upload gambar baru
        $("#edit_image_subcategory_value").val("");
      };
      reader.readAsDataURL(file);
    } else {
      // Jika file dihapus, load kembali gambar saat ini
      var categoryId = $("#edit_subcategori_id").val();
      if (categoryId) {
        loadSubCategoryImage(categoryId);
      }
    }
  });

  $("#fileuploadSubSub").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubSub").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">'
        );
      };
      reader.readAsDataURL(file);
    }
  });

  $("#addFormSubCategori").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    $.ajax({
      url: base_url + "backendproduct/addSubCategoriAjax",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subcategori").modal("hide");
          $("#addFormSubCategori")[0].reset();
          $("#imagePreviewSub").empty();

          // Reload datatable
          if (typeof tableCategori !== "undefined") {
            tableCategori.ajax.reload();
          }

          tableCategori.ajax.reload(); // Reload datatable
          Swal.fire({
            icon: "success",
            title: "Edit Sub Categori!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  $("#add-subcategori").on("hidden.bs.modal", function () {
    $("#addFormSubCategori")[0].reset();
    $("#imagePreviewSub").empty();
    $("#mainCategori").val("");
    $("#subCategori").prop("disabled", true).val("");
  });

  $("#edit-subcategori").on("hidden.bs.modal", function () {
    $("#editFormSubCategori")[0].reset();
    $("#imagePreviewSubEdit").empty();
    $("#mainCategoriEdit").val("");
    $("#subCategoriEdit").prop("disabled", true).val("");
    $("#edit_subcategori_id").val("");
  });

  function loadMainCategories() {
    $.ajax({
      url: base_url + "backendproduct/getMainCategories",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#mainCategori");
          var selectSub = $("#mainCategoriSub");
          select.empty(); // Kosongkan dulu
          select.append('<option value="">Pilih Kategori Utama</option>');
          $.each(response.data, function (index, category) {
            select.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });
          selectSub.empty(); // Kosongkan dulu
          selectSub.append('<option value="">Pilih Kategori Utama</option>');
          $.each(response.data, function (index, category) {
            selectSub.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load categories",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error loading categories: " + error,
        });
      },
    });
  }

  function loadSubCategories(mainCategoryId) {
    $.ajax({
      url: base_url + "backendproduct/getSubCategories/" + mainCategoryId,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#mainCategoriSubSub");
          select.empty();
          select.append('<option value="">Pilih Sub Kategori</option>');
          $.each(response.data, function (index, category) {
            select.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load categories",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Error loading sub categories: " + error,
        });
      },
    });
  }

  // Panggil function ketika modal dibuka
  $("#add-subcategori").on("show.bs.modal", function () {
    loadMainCategories();
  });

  $(document).on("click", ".edit-subcategori", function () {
    var categoryId = $(this).data("id");
    var categoryName = $(this).data("name");
    var categoryParent = $(this).data("parent");

    // Reset form terlebih dahulu
    $("#editFormSubCategori")[0].reset();
    $("#imagePreviewSubEdit").empty();
    $("#edit_image_subcategory").empty();
    $("#mainCategoriEdit").empty();
    $("#subCategoriEdit").prop("disabled", true).val("");

    // Set hidden ID
    $("#edit_subcategori_id").val(categoryId);

    // Tampilkan modal terlebih dahulu
    $("#edit-subcategori").modal("show");

    // 1. Load main categories untuk dropdown
    $.ajax({
      url: base_url + "backendproduct/getMainCategories",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#mainCategoriEdit");
          select.empty();
          select.append('<option value="">Pilih Kategori Utama</option>');
          $.each(response.data, function (index, category) {
            select.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });

          // Set parent yang sudah ada
          if (categoryParent) {
            select.val(categoryParent).trigger("change");
          }

          // Enable input nama
          $("#subCategoriEdit").prop("disabled", false).val(categoryName);

          // 2. Load gambar kategori
          loadSubCategoryImage(categoryId);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message || "Failed to load categories",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error loading categories: " + error,
        });
      },
    });
  });

  // Function untuk load gambar kategori
  function loadSubCategoryImage(categoryId) {
    $.ajax({
      url: base_url + "backendproduct/getCategoryById/" + categoryId, // Gunakan endpoint yang benar
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log("Image response:", response);
        if (response.status && response.data) {
          var data = response.data;

          // Tampilkan gambar saat ini jika ada
          if (data.img) {
            var imageUrl = base_url + "public/upload/categori/" + data.img;
            $("#edit_image_subcategory").html(
              '<div class="alert alert-info p-2">' +
                'Current image: <a href="' +
                imageUrl +
                '" target="_blank">' +
                data.img +
                "</a></div>"
            );
            $("#edit_image_subcategory_value").val(data.img);

            $("#imagePreviewSubEdit").html(
              '<img src="' +
                imageUrl +
                '" class="img-thumbnail" style="max-width: 150px;">' +
                '<div class="mt-1 text-muted small">Current Image</div>'
            );
          } else {
            $("#edit_image_subcategory").html(
              '<div class="alert alert-warning p-2">No image available</div>'
            );
            $("#imagePreviewSubEdit").html(
              '<div class="text-muted">No image available</div>'
            );
          }
        }
      },
      error: function (xhr, status, error) {
        console.log("Error loading image:", error);
        $("#imagePreviewSubEdit").html(
          '<div class="text-danger">Failed to load image</div>'
        );
      },
    });
  }

  $("#mainCategori").on("change", function () {
    var mainCategoryId = $(this).val();
    var select = $("#subCategori");
    if (mainCategoryId) {
      select.prop("disabled", false);
    } else {
      select.empty().prop("disabled", true);
    }
  });

  $("#mainCategoriEdit").on("change", function () {
    var mainCategoryId = $(this).val();
    var input = $("#subCategoriEdit");
    if (mainCategoryId) {
      input.prop("disabled", false);
    } else {
      input.prop("disabled", true);
    }
  });

  $("#addFormSubSubCategori").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    $.ajax({
      url: base_url + "backendproduct/addSubSubCategoriAjax",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subsubcategori").modal("hide");
          $("#addFormSubSubCategori")[0].reset();
          $("#imagePreviewSubSub").empty();

          if (typeof tableCategori !== "undefined") {
            tableCategori.ajax.reload();
          }
          tableCategori.ajax.reload(); // Reload datatable
          Swal.fire({
            icon: "success",
            title: "Add subsub Categori!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        // Restore button
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  // Panggil function ketika modal dibuka
  $("#add-subsubcategori").on("show.bs.modal", function () {
    loadMainCategories();
  });

  $("#mainCategoriSub").on("change", function () {
    var mainCategoryId = $(this).val();
    var selectSubSub = $("#mainCategoriSubSub");
    if (mainCategoryId) {
      selectSubSub.prop("disabled", false);
      loadSubCategories(mainCategoryId);
    } else {
      selectSubSub
        .empty()
        .append('<option value="">Pilih Kategori Utama dulu</option>')
        .prop("disabled", true);
    }
  });

  $("#mainCategoriSubSub").on("change", function () {
    var mainCategoryId = $(this).val();
    var selectSubSubSub = $("#subCategoriSub");
    if (mainCategoryId) {
      selectSubSubSub.prop("disabled", false);
    } else {
      selectSubSubSub.empty().prop("disabled", true);
    }
    0;
  });

  $("#add-subsubcategori").on("hidden.bs.modal", function () {
    $("#addFormSubSubCategori")[0].reset();
    $("#imagePreviewSubSub").empty();
    $("#mainCategoriSub").val("");
    $("#mainCategoriSubSub").val("");
    $("#subCategoriSub").prop("disabled", true).val("");
  });

  function loadMainCategoriesForEditSubSub() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: base_url + "backendproduct/getMainCategories",
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status) {
            var select = $("#mainCategoriSubEdit");
            select.empty();
            select.append('<option value="">Pilih Kategori Utama</option>');
            $.each(response.data, function (index, category) {
              select.append(
                '<option value="' +
                  category.id +
                  '">' +
                  category.name +
                  "</option>"
              );
            });
            resolve();
          } else {
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }

  // Function untuk load sub categories di modal edit sub sub
  function loadSubCategoriesForEditSubSub(mainCategoryId) {
    return new Promise(function (resolve, reject) {
      if (!mainCategoryId) {
        $("#mainCategoriSubSubEdit")
          .empty()
          .append('<option value="">Pilih Kategori Utama dulu</option>')
          .prop("disabled", true);
        $("#subCategoriSubEdit").prop("disabled", true).val("");
        resolve();
        return;
      }

      $.ajax({
        url: base_url + "backendproduct/getSubCategories/" + mainCategoryId,
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status) {
            var select = $("#mainCategoriSubSubEdit");
            select.empty();
            select.append('<option value="">Pilih Sub Kategori</option>');
            $.each(response.data, function (index, category) {
              select.append(
                '<option value="' +
                  category.id +
                  '">' +
                  category.name +
                  "</option>"
              );
            });
            select.prop("disabled", false);
            resolve();
          } else {
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }

  // Function untuk load data edit modal sub sub
  function loadEditSubSubCategoryData(categoryId) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: base_url + "backendproduct/getSubSubCategoryById/" + categoryId,
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status) {
            var category = response.data;

            // Set hidden ID
            $("#edit_subsubcategori_id").val(category.id);

            // Set nama kategori
            $("#subCategoriSubEdit").val(category.name);

            // Tampilkan gambar saat ini jika ada
            if (category.img) {
              var imageUrl =
                base_url + "public/upload/categori/" + category.img;
              $("#edit_image_subsubcategory").html(
                '<div class="alert alert-info p-2">' +
                  'Current image: <a href="' +
                  imageUrl +
                  '" target="_blank">' +
                  category.img +
                  "</a></div>"
              );
              $("#edit_image_subsubcategory_value").val(category.img);

              $("#imagePreviewSubSubEdit").html(
                '<img src="' +
                  imageUrl +
                  '" class="img-thumbnail" style="max-width: 150px;">' +
                  '<div class="mt-1 text-muted small">Current Image</div>'
              );
            } else {
              $("#edit_image_subsubcategory").html(
                '<div class="alert alert-warning p-2">No image available</div>'
              );
              $("#imagePreviewSubSubEdit").html(
                '<div class="text-muted">No image available</div>'
              );
            }

            // Load main categories dan set value
            loadMainCategoriesForEditSubSub()
              .then(function () {
                // Set main category
                if (category.grandparent_id) {
                  $("#mainCategoriSubEdit")
                    .val(category.grandparent_id)
                    .trigger("change");

                  // Load sub categories setelah main category dipilih
                  setTimeout(function () {
                    loadSubCategoriesForEditSubSub(
                      category.grandparent_id
                    ).then(function () {
                      // Set sub category
                      if (category.parent_id) {
                        $("#mainCategoriSubSubEdit")
                          .val(category.parent_id)
                          .trigger("change");
                      }
                      // Enable input nama
                      $("#subCategoriSubEdit").prop("disabled", false);
                      resolve(category);
                    });
                  }, 500);
                } else {
                  // Enable input nama
                  $("#subCategoriSubEdit").prop("disabled", false);
                  resolve(category);
                }
              })
              .catch(function (error) {
                reject(error);
              });
          } else {
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }

  // Event listener untuk tombol edit sub sub
  $(document).on("click", ".edit-subsubcategori", function () {
    var categoryId = $(this).data("id");
    var categoryName = $(this).data("name");

    // Reset form terlebih dahulu
    $("#editFormSubSubCategori")[0].reset();
    $("#imagePreviewSubSubEdit").empty();
    $("#edit_image_subsubcategory").empty();
    $("#mainCategoriSubEdit").empty();
    $("#mainCategoriSubSubEdit").empty().prop("disabled", true);
    $("#subCategoriSubEdit").prop("disabled", true).val("");

    // Tampilkan modal terlebih dahulu
    $("#edit-subsubcategori").modal("show");

    // Load data kategori
    loadEditSubSubCategoryData(categoryId)
      .then(function (category) {
        console.log("Sub Sub Category data loaded successfully");
      })
      .catch(function (error) {
        console.error("Error loading category data:", error);
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Gagal memuat data kategori. Silakan coba lagi.",
        });
      });
  });

  // Event listener untuk perubahan main category di edit modal sub sub
  $("#mainCategoriSubEdit").on("change", function () {
    var mainCategoryId = $(this).val();
    loadSubCategoriesForEditSubSub(mainCategoryId);
  });

  // Event listener untuk perubahan sub category di edit modal sub sub
  $("#mainCategoriSubSubEdit").on("change", function () {
    var subCategoryId = $(this).val();
    var inputName = $("#subCategoriSubEdit");

    if (subCategoryId) {
      inputName.prop("disabled", false);
    } else {
      inputName.prop("disabled", true).val("");
    }
  });

  // Preview image untuk edit modal sub sub
  $("#fileuploadSubSubEdit").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }

      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubSubEdit").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">' +
            '<div class="mt-1 text-success small">New Image Preview</div>'
        );

        // Clear current image info
        $("#edit_image_subsubcategory").empty();
        $("#edit_image_subsubcategory_value").val("");
      };
      reader.readAsDataURL(file);
    } else {
      // Jika file dihapus, load kembali gambar saat ini
      var categoryId = $("#edit_subsubcategori_id").val();
      if (categoryId) {
        // Load gambar dari hidden value
        var currentImage = $("#edit_image_subsubcategory_value").val();
        if (currentImage) {
          var imageUrl = base_url + "public/upload/categori/" + currentImage;
          $("#edit_image_subsubcategory").html(
            '<div class="alert alert-info p-2">' +
              'Current image: <a href="' +
              imageUrl +
              '" target="_blank">' +
              currentImage +
              "</a></div>"
          );

          $("#imagePreviewSubSubEdit").html(
            '<img src="' +
              imageUrl +
              '" class="img-thumbnail" style="max-width: 150px;">' +
              '<div class="mt-1 text-muted small">Current Image</div>'
          );
        }
      }
    }
  });

  // Form submission untuk edit sub sub
  $("#editFormSubSubCategori").on("submit", function (e) {
    e.preventDefault();

    // Validasi
    var mainCategory = $("#mainCategoriSubEdit").val();
    var subCategory = $("#mainCategoriSubSubEdit").val();
    var categoryName = $("#subCategoriSubEdit").val();

    if (!mainCategory) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Pilih Kategori Utama terlebih dahulu",
      });
      $("#mainCategoriSubEdit").focus();
      return;
    }

    if (!subCategory) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Pilih Sub Kategori terlebih dahulu",
      });
      $("#mainCategoriSubSubEdit").focus();
      return;
    }

    if (!categoryName.trim()) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Nama Sub Sub Kategori tidak boleh kosong",
      });
      $("#subCategoriSubEdit").focus();
      return;
    }

    var formData = new FormData(this);

    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html(
        '<span class="spinner-border spinner-border-sm"></span> Updating...'
      );

    $.ajax({
      url: base_url + "backendproduct/editSubSubCategoriAjax",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        console.log("response: ", response);
        if (response.status) {
          $("#edit-subsubcategori").modal("hide");
          $("#editFormSubSubCategori")[0].reset();
          $("#imagePreviewSubSubEdit").empty();
          $("#edit_image_subsubcategory").empty();

          // Reload datatable
          if (typeof tableCategori !== "undefined") {
            tableCategori.ajax.reload();
          }

          Swal.fire({
            icon: "success",
            title: "Success!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  // Reset modal saat ditutup
  $("#edit-subsubcategori").on("hidden.bs.modal", function () {
    $("#editFormSubSubCategori")[0].reset();
    $("#imagePreviewSubSubEdit").empty();
    $("#edit_image_subsubcategory").empty();
    $("#mainCategoriSubEdit").val("");
    $("#mainCategoriSubSubEdit").val("");
    $("#subCategoriSubEdit").prop("disabled", true).val("");
    $("#edit_subsubcategori_id").val("");
    $("#edit_image_subsubcategory_value").val("");
  });

  $("#fileuploadSubJasa").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubJasa").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">'
        );
      };
      reader.readAsDataURL(file);
    }
  });

  $("#fileuploadSubJasaEdit").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }

      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubJasaEdit").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">' +
            '<div class="mt-1 text-success small">New Image Preview</div>'
        );

        // Update hidden value jika user upload gambar baru
        $("#edit_image_subcategory_jasa_value").val("");
      };
      reader.readAsDataURL(file);
    } else {
      // Jika file dihapus, load kembali gambar saat ini
      var categoryId = $("#edit_subcategori_jasa_id").val();
      if (categoryId) {
        loadSubCategoryJasaImage(categoryId);
      }
    }
  });

  function loadSubCategoryJasaImage(categoryId) {
    $.ajax({
      url: base_url + "backendproduct/getCategoryById/" + categoryId, // Gunakan endpoint yang benar
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log("Image response:", response);
        if (response.status && response.data) {
          var data = response.data;

          // Tampilkan gambar saat ini jika ada
          if (data.img) {
            var imageUrl = base_url + "public/upload/categori/" + data.img;
            $("#edit_image_subcategory_jasa").html(
              '<div class="alert alert-info p-2">' +
                'Current image: <a href="' +
                imageUrl +
                '" target="_blank">' +
                data.img +
                "</a></div>"
            );
            $("#edit_image_subcategory_jasa_value").val(data.img);

            $("#imagePreviewSubJasaEdit").html(
              '<img src="' +
                imageUrl +
                '" class="img-thumbnail" style="max-width: 150px;">' +
                '<div class="mt-1 text-muted small">Current Image</div>'
            );
          } else {
            $("#edit_image_subcategory_jasa").html(
              '<div class="alert alert-warning p-2">No image available</div>'
            );
            $("#imagePreviewSubJasaEdit").html(
              '<div class="text-muted">No image available</div>'
            );
          }
        }
      },
      error: function (xhr, status, error) {
        console.log("Error loading image:", error);
        $("#imagePreviewSubJasaEdit").html(
          '<div class="text-danger">Failed to load image</div>'
        );
      },
    });
  }

  $("#fileuploadSubSubJasa").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format file tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubSubJasa").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">'
        );
      };
      reader.readAsDataURL(file);
    }
  });

  $("#addFormSubCategoriJasa").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    $.ajax({
      url: base_url + "backendproduct/subCategoriesJasaAjaxAdd",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subcategori-jasa").modal("hide");
          $("#addFormSubCategoriJasa")[0].reset();
          $("#imagePreviewSubJasa").empty();
          tableCategoriJasa.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Edit Sub Categori Jasa!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  function loadMainCategoriesJasa() {
    $.ajax({
      url: base_url + "backendproduct/getMainCategoriesJasa",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#mainCategoriJasa");
          var selectSub = $("#mainCategoriSubJasa");
          select.empty(); // Kosongkan dulu
          select.append('<option value="">Pilih Kategori Utama</option>');
          $.each(response.data, function (index, category) {
            select.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });
          selectSub.empty(); // Kosongkan dulu
          selectSub.append('<option value="">Pilih Kategori Utama</option>');
          $.each(response.data, function (index, category) {
            selectSub.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load categories jasa",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "failed load Categories" + error,
        });
      },
    });
  }

  function loadSubCategoriesJasa(mainCategoryId) {
    $.ajax({
      url: base_url + "backendproduct/getSubCategoriesJasa/" + mainCategoryId,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#mainCategoriSubSubJasa");
          select.empty();
          select.append('<option value="">Pilih Sub Kategori</option>');
          $.each(response.data, function (index, category) {
            select.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to load sub categories jasa",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error Load sub categories jasa" + error,
        });
      },
    });
  }

  // Panggil function ketika modal dibuka
  $("#add-subcategori-jasa").on("show.bs.modal", function () {
    loadMainCategoriesJasa();
  });

  $(document).on("click", ".edit-subcategori-jasa", function () {
    var categoryId = $(this).data("id");
    var categoryName = $(this).data("name");
    var categoryParent = $(this).data("parent");

    // Reset form terlebih dahulu
    $("#editFormSubCategoriJasa")[0].reset();
    $("#imagePreviewSubJasaEdit").empty();
    $("#edit_image_subcategory_jasa").empty();
    $("#mainCategoriJasaEdit").empty();
    $("#subCategoriJasaEdit").prop("disabled", true).val("");

    // Set hidden ID
    $("#edit_subcategori_jasa_id").val(categoryId);

    // Tampilkan modal terlebih dahulu
    $("#edit-subcategori-jasa").modal("show");

    // 1. Load main categories untuk dropdown
    $.ajax({
      url: base_url + "backendproduct/getMainCategoriesJasa",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status) {
          var select = $("#mainCategoriJasaEdit");
          select.empty();
          select.append('<option value="">Pilih Kategori Utama</option>');
          $.each(response.data, function (index, category) {
            select.append(
              '<option value="' +
                category.id +
                '">' +
                category.name +
                "</option>"
            );
          });

          // Set parent yang sudah ada
          if (categoryParent) {
            select.val(categoryParent).trigger("change");
          }

          // Enable input nama
          $("#subCategoriJasaEdit").prop("disabled", false).val(categoryName);

          // 2. Load gambar kategori
          loadSubCategoryJasaImage(categoryId);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message || "Failed to load categories jasa",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error loading categories jasa: " + error,
        });
      },
    });
  });

  $("#editFormSubCategoriJasa").on("submit", function (e) {
    e.preventDefault();

    // Validasi form
    var mainCategory = $("#mainCategoriJasaEdit").val();
    var subCategoryName = $("#subCategoriJasaEdit").val();

    if (!mainCategory) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Pilih Kategori Utama terlebih dahulu",
      });
      return;
    }

    if (!subCategoryName.trim()) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Nama Sub Kategori jasa tidak boleh kosong",
      });
      $("#subCategoriEditJasa").focus();
      return;
    }

    var formData = new FormData(this);

    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html(
        '<span class="spinner-border spinner-border-sm"></span> Updating...'
      );

    $.ajax({
      url: base_url + "backendproduct/updateSubCategoriJasaAjax",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#edit-subcategori-jasa").modal("hide");
          $("#editFormSubCategoriJasa")[0].reset();
          $("#imagePreviewSubJasaEdit").empty();

          // Reload datatable
          if (typeof tableCategoriJasa !== "undefined") {
            tableCategoriJasa.ajax.reload();
          }

          Swal.fire({
            icon: "success",
            title: "Success!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  $("#add-subsubcategori-jasa").on("show.bs.modal", function () {
    loadMainCategoriesJasa();
  });

  $("#mainCategoriJasa").on("change", function () {
    var mainCategoryId = $(this).val();
    var select = $("#subCategoriJasa");
    if (mainCategoryId) {
      select.prop("disabled", false);
    } else {
      select.empty().prop("disabled", true);
    }
  });

  $("#mainCategoriSubJasa").on("change", function () {
    var mainCategoryId = $(this).val();
    var selectSubSub = $("#mainCategoriSubSubJasa");
    if (mainCategoryId) {
      selectSubSub.prop("disabled", false);
      loadSubCategoriesJasa(mainCategoryId);
    } else {
      selectSubSub
        .empty()
        .append('<option value="">Pilih Kategori Utama dulu</option>')
        .prop("disabled", true);
    }
  });

  $("#mainCategoriSubSubJasa").on("change", function () {
    var mainCategoryId = $(this).val();
    var selectSubSubSub = $("#subCategoriSubJasa");
    if (mainCategoryId) {
      selectSubSubSub.prop("disabled", false);
    } else {
      selectSubSubSub.empty().prop("disabled", true);
    }
  });

  $("#addFormSubSubCategoriJasa").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    $.ajax({
      url: base_url + "backendproduct/addSubSubCategoriJasaAjax",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subsubcategori-jasa").modal("hide");
          $("#addFormSubSubCategoriJasa")[0].reset();
          $("#imagePreviewSubSubJasa").empty();
          tableCategoriJasa.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Edit Sub Sub Categori Jasa!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  function loadMainCategoriesJasaForEditSubSub() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: base_url + "backendproduct/getMainCategories",
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status) {
            var select = $("#mainCategoriSubJasaEdit");
            select.empty();
            select.append('<option value="">Pilih Kategori Utama</option>');
            $.each(response.data, function (index, category) {
              select.append(
                '<option value="' +
                  category.id +
                  '">' +
                  category.name +
                  "</option>"
              );
            });
            resolve();
          } else {
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }

  // Function untuk load sub categories di modal edit sub sub
  function loadSubCategoriesJasaForEditSubSub(mainCategoryId) {
    return new Promise(function (resolve, reject) {
      if (!mainCategoryId) {
        $("#mainCategoriSubSubJasaEdit")
          .empty()
          .append('<option value="">Pilih Kategori Utama dulu</option>')
          .prop("disabled", true);
        $("#subCategoriSubEdit").prop("disabled", true).val("");
        resolve();
        return;
      }

      $.ajax({
        url: base_url + "backendproduct/getSubCategories/" + mainCategoryId,
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status) {
            var select = $("#mainCategoriSubSubJasaEdit");
            select.empty();
            select.append('<option value="">Pilih Sub Kategori</option>');
            $.each(response.data, function (index, category) {
              select.append(
                '<option value="' +
                  category.id +
                  '">' +
                  category.name +
                  "</option>"
              );
            });
            select.prop("disabled", false);
            resolve();
          } else {
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }

  // Function untuk load data edit modal sub sub
  function loadEditSubSubCategoryJasaData(categoryId) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: base_url + "backendproduct/getSubSubCategoryById/" + categoryId,
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status) {
            var category = response.data;

            // Set hidden ID
            $("#edit_subsubcategori_jasa_id").val(category.id);

            // Set nama kategori
            $("#subCategoriSubJasaEdit").val(category.name);

            // Tampilkan gambar saat ini jika ada
            if (category.img) {
              var imageUrl =
                base_url + "public/upload/categori/" + category.img;
              $("#edit_image_subsubcategory_jasa").html(
                '<div class="alert alert-info p-2">' +
                  'Current image: <a href="' +
                  imageUrl +
                  '" target="_blank">' +
                  category.img +
                  "</a></div>"
              );
              $("#edit_image_subsubcategory_jasa_value").val(category.img);

              $("#imagePreviewSubSubJasaEdit").html(
                '<img src="' +
                  imageUrl +
                  '" class="img-thumbnail" style="max-width: 150px;">' +
                  '<div class="mt-1 text-muted small">Current Image</div>'
              );
            } else {
              $("#edit_image_subsubcategory_jasa").html(
                '<div class="alert alert-warning p-2">No image available</div>'
              );
              $("#imagePreviewSubSubJasaEdit").html(
                '<div class="text-muted">No image available</div>'
              );
            }

            // Load main categories dan set value
            loadMainCategoriesJasaForEditSubSub()
              .then(function () {
                // Set main category
                if (category.grandparent_id) {
                  $("#mainCategoriSubJasaEdit")
                    .val(category.grandparent_id)
                    .trigger("change");

                  // Load sub categories setelah main category dipilih
                  setTimeout(function () {
                    loadSubCategoriesJasaForEditSubSub(
                      category.grandparent_id
                    ).then(function () {
                      // Set sub category
                      if (category.parent_id) {
                        $("#mainCategoriJasaSubSubEdit")
                          .val(category.parent_id)
                          .trigger("change");
                      }
                      // Enable input nama
                      $("#subCategoriSubJasaEdit").prop("disabled", false);
                      resolve(category);
                    });
                  }, 500);
                } else {
                  // Enable input nama
                  $("#subCategoriSubJasaEdit").prop("disabled", false);
                  resolve(category);
                }
              })
              .catch(function (error) {
                reject(error);
              });
          } else {
            reject(response.message);
          }
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }

  // Event listener untuk tombol edit sub sub
  $(document).on("click", ".edit-subsubcategori-saja", function () {
    var categoryId = $(this).data("id");
    var categoryName = $(this).data("name");

    // Reset form terlebih dahulu
    $("#editFormSubSubCategoriJasa")[0].reset();
    $("#imagePreviewSubSubJasaEdit").empty();
    $("#edit_image_subsubcategory_jasa").empty();
    $("#mainCategoriSubJasaEdit").empty();
    $("#mainCategoriSubSubJasaEdit").empty().prop("disabled", true);
    $("#subCategoriSubJasaEdit").prop("disabled", true).val("");

    // Tampilkan modal terlebih dahulu
    $("#edit-subsubcategori-jasa").modal("show");

    // Load data kategori
    loadEditSubSubCategoryData(categoryId)
      .then(function (category) {
        console.log("Sub Sub Jasa data loaded successfully");
      })
      .catch(function (error) {
        console.error("Error loading Jasa data:", error);
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Gagal memuat data kategori. Silakan coba lagi.",
        });
      });
  });

  // Event listener untuk perubahan main category di edit modal sub sub
  $("#mainCategoriSubJasaEdit").on("change", function () {
    var mainCategoryId = $(this).val();
    loadSubCategoriesJasaForEditSubSub(mainCategoryId);
  });

  // Event listener untuk perubahan sub category di edit modal sub sub
  $("#mainCategoriSubSubJasaEdit").on("change", function () {
    var subCategoryId = $(this).val();
    var inputName = $("#subCategoriSubJasaEdit");

    if (subCategoryId) {
      inputName.prop("disabled", false);
    } else {
      inputName.prop("disabled", true).val("");
    }
  });

  // Preview image untuk edit modal sub sub
  $("#fileuploadSubSubJasaEdit").on("change", function () {
    var file = this.files[0];
    if (file) {
      if (file.size > 1024 * 1024) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "File terlalu besar. Maksimal 1MB",
        });
        $(this).val("");
        return;
      }

      var validTypes = ["image/jpeg", "image/jpg", "image/png"];
      if (!validTypes.includes(file.type)) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Format File tidak didukung. Hanya JPG, JPEG, PNG",
        });
        $(this).val("");
        return;
      }

      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreviewSubSubJasaEdit").html(
          '<img src="' +
            e.target.result +
            '" class="img-thumbnail" style="max-width: 150px;">' +
            '<div class="mt-1 text-success small">New Image Preview</div>'
        );

        // Clear current image info
        $("#edit_image_subsubcategory_jasa").empty();
        $("#edit_image_subsubcategory_jasa_value").val("");
      };
      reader.readAsDataURL(file);
    } else {
      // Jika file dihapus, load kembali gambar saat ini
      var categoryId = $("#edit_subsubcategori_jasa_id").val();
      if (categoryId) {
        // Load gambar dari hidden value
        var currentImage = $("#edit_image_subsubcategory_jasa_value").val();
        if (currentImage) {
          var imageUrl = base_url + "public/upload/categori/" + currentImage;
          $("#edit_image_subsubcategory_jasa").html(
            '<div class="alert alert-info p-2">' +
              'Current image: <a href="' +
              imageUrl +
              '" target="_blank">' +
              currentImage +
              "</a></div>"
          );

          $("#imagePreviewSubSubJasaEdit").html(
            '<img src="' +
              imageUrl +
              '" class="img-thumbnail" style="max-width: 150px;">' +
              '<div class="mt-1 text-muted small">Current Image</div>'
          );
        }
      }
    }
  });

  // Form submission untuk edit sub sub
  $("#editFormSubSubCategoriJasa").on("submit", function (e) {
    e.preventDefault();

    // Validasi
    var mainCategory = $("#mainCategoriSubJasaEdit").val();
    var subCategory = $("#mainCategoriSubSubJasaEdit").val();
    var categoryName = $("#subCategoriSubJasaEdit").val();

    if (!mainCategory) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Pilih Kategori Utama terlebih dahulu",
      });
      $("#mainCategoriSubJasaEdit").focus();
      return;
    }

    if (!subCategory) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Pilih Sub Kategori terlebih dahulu",
      });
      $("#mainCategoriSubSubJasaEdit").focus();
      return;
    }

    if (!categoryName.trim()) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Nama Sub Sub Kategori tidak boleh kosong",
      });
      $("#subCategoriSubJasaEdit").focus();
      return;
    }

    var formData = new FormData(this);

    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html(
        '<span class="spinner-border spinner-border-sm"></span> Updating...'
      );

    $.ajax({
      url: base_url + "backendproduct/editSubSubCategoriJasaAjax",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        console.log("response: ", response);
        if (response.status) {
          $("#edit-subsubcategori-jasa").modal("hide");
          $("#editFormSubSubCategoriJasa")[0].reset();
          $("#imagePreviewSubSubJasaEdit").empty();
          $("#edit_image_subsubcategory_jasa").empty();

          // Reload datatable
          if (typeof tableCategoriJasa !== "undefined") {
            tableCategoriJasa.ajax.reload();
          }

          Swal.fire({
            icon: "success",
            title: "Success!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        submitBtn.prop("disabled", false).html(originalText);
      },
    });
  });

  // Reset modal saat ditutup
  $("#edit-subsubcategori-jasa").on("hidden.bs.modal", function () {
    $("#editFormSubSubCategoriJasa")[0].reset();
    $("#imagePreviewSubSubJasaEdit").empty();
    $("#edit_image_subsubcategory_jasa").empty();
    $("#mainCategoriSubJasaEdit").val("");
    $("#mainCategoriSubSubJasaEdit").val("");
    $("#subCategoriSubJasaEdit").prop("disabled", true).val("");
    $("#edit_subsubcategori_jasa_id").val("");
    $("#edit_image_subsubcategory_jasa_value").val("");
  });

  $("#addFormBrand").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this); // Ini yang penting untuk handle file

    $.ajax({
      url: base_url + "backendproduct/brandAjaxAdd",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          // Success
          $("#add-brand").modal("hide");
          $("#addFormBrand")[0].reset();
          $(".blah").attr("src", ""); // Reset preview
          Swal.fire({
            icon: "success",
            title: "Add Brand!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
          table.ajax.reload();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
    });
  });

  $(document).on("click", ".edit-brand", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var image = $(this).data("image");

    // Set nilai ke form edit
    $("#edit_id").val(id);
    $("#edit_brand").val(name);

    // Set preview gambar jika ada
    if (image && image !== "null" && image !== "") {
      var imageUrl = base_url + "public/upload/categori/" + image;
      $("#edit-brand .blah").attr("src", imageUrl).show();
    } else {
      $("#edit-brand .blah").attr("src", "").hide();
    }

    // Buka modal edit
    $("#edit-brand").modal("show");
  });

  // Preview gambar saat memilih file baru
  $("#edit_logoBrand").on("change", function () {
    readURL(this, "#edit-brand .blah");
  });

  // Custom file upload trigger untuk edit form
  $("#edit-brand #filetext").on("click", function (e) {
    e.preventDefault();
    $("#edit_logoBrand").click();
  });

  // Form submission untuk edit
  $("#editFormBrand").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    // Tampilkan loading
    $('button[type="submit"]', this)
      .prop("disabled", true)
      .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    $.ajax({
      url: base_url + "backendproduct/brandAjaxUpdate",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          // Success
          $("#edit-brand").modal("hide");
          $("#editFormBrand")[0].reset();
          $(".blah").attr("src", "").hide();
          tableBrand.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Edit Brand!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Error: " + error,
        });
      },
      complete: function () {
        $('button[type="submit"]', "#editFormBrand")
          .prop("disabled", false)
          .html("Save");
      },
    });
  });

  // Reset form ketika modal edit ditutup
  $("#edit-brand").on("hidden.bs.modal", function () {
    $("#editFormBrand")[0].reset();
    $("#editModal .blah").attr("src", "").hide();
    $("#edit_id").val("");
  });

  // Fungsi untuk preview gambar
  function readURL(input, previewSelector) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(previewSelector).attr("src", e.target.result).show();
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#brandTable").on("click", ".delete-brand", function () {
    var id = $(this).data("id");
    var name = $(this).data("name") || "this brand";
    var button = $(this); // Simpan reference ke tombol

    Swal.fire({
      title: "Delete Brand?",
      html: `Are you sure you want to delete <strong>${name}</strong>?<br><small class="text-danger">This action cannot be undone.</small>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        return new Promise((resolve) => {
          $.ajax({
            url: base_url + "backendproduct/brandAjaxDelete",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function (response) {
              resolve(response);
            },
            error: function () {
              resolve({ status: false, message: "Network error" });
            },
          });
        });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.value.status) {
          tableBrand.ajax.reload();
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: result.value.message,
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.value.message,
          });
        }
      }
    });
  });

  var tableModel = $("#modelTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "backendproduct/modelsAjaxList",
      type: "POST",
    },
    columns: [
      { data: 0, orderable: false },
      { data: 1 },
      { data: 2 },
      { data: 3, orderable: false },
    ],
    order: [[0, "asc"]],
  });
});

$("#uploadBtn").change(function () {
  readURL(this);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(".blah").attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Trigger click pada file input ketika tombol "Pilih file" diklik
$("#filetext").click(function () {
  $("#uploadBtn").click();
  return false;
});
