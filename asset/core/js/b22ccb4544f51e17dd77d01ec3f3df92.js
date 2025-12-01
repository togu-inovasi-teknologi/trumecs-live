var base_url = $("body").attr("baseurl");
var idprn = "";
var idctr = "";
var txtctr = "";
var img = "";

function showToast(title, message, type = "success", duration = 5000) {
  const toastEl = document.getElementById("toastMessage");
  const toastTitle = document.getElementById("toastTitle");
  const toastBody = document.getElementById("toastBody");
  const toastTime = document.getElementById("toastTime");

  // Set toast content
  toastTitle.textContent = title;
  toastBody.textContent = message;
  toastTime.textContent = new Date().toLocaleTimeString();

  // Remove all color classes first
  toastEl.classList.remove(
    "bg-success",
    "bg-danger",
    "bg-warning",
    "text-white"
  );

  // Set style based on type
  switch (type) {
    case "success":
      toastEl.classList.add("bg-success", "text-white");
      toastTitle.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + title;
      break;
    case "error":
      toastEl.classList.add("bg-danger", "text-white");
      toastTitle.innerHTML =
        '<i class="fas fa-exclamation-circle me-2"></i>' + title;
      break;
    case "warning":
      toastEl.classList.add("bg-warning");
      toastTitle.innerHTML =
        '<i class="fas fa-exclamation-triangle me-2"></i>' + title;
      break;
    case "info":
      toastEl.classList.add("bg-primary", "text-white");
      toastTitle.innerHTML = '<i class="fas fa-info-circle me-2"></i>' + title;
      break;
  }

  // Show toast
  const toast = new bootstrap.Toast(toastEl, {
    delay: duration,
  });
  toast.show();
}

// Quick Toast Functions for common use cases
function showSuccessToast(message) {
  showToast("Success", message, "success");
}

function showErrorToast(message) {
  showToast("Error", message, "error");
}

function showWarningToast(message) {
  showToast("Warning", message, "warning");
}

function showInfoToast(message) {
  showToast("Information", message, "info");
}

$(".jq-edit").on("click", function (argument) {
  var idparent = $(this).attr("idparent");
  var idcategory = $(this).attr("idcategory");
  var text = $(this).attr("textcategory");
  var type = $(this).attr("typecategory");
  img = $(this).attr("img");

  idprn = idparent;
  idctr = idcategory;
  txtctr = text;
  txtimg = img;
  typectr = type;

  $(".collapseedit").collapse("hide");
  $(".collapseedit").collapse("show");
});

$(".collapseedit").on("shown.bs.collapse", function () {
  $(".collapseadd").collapse("hide");
  var tampung = $("tampung");
  var idparent = idprn; //tampung.attr("idparent");
  var idcategory = idctr; //tampung.attr("idcategory");
  var text = txtctr; //tampung.attr("textcategory");
  var type = typectr; //tampung.attr("textcategory");
  $(".tipeform").html("Form tambah " + type);

  $(".idcategory").val(idcategory);
  $(".textcategory").val(text);
  if (idparent == "prn") {
    $(".input-form").html(
      '<input required type="hidden" name="parent" value="' +
        idparent +
        '"><input required type="hidden" name="imgold" value="' +
        img +
        '">'
    );
  } else {
    if (type == "komponen") {
      //$(".input-form").html('<div class="col-md-3"><h5>Kategori Induk</h5><select required class="form-control" name="parent"></select></div><div class="col-md-3"><h5>Grade List</h5><div class="brand-list"></div></div><div class="col-md-3"><h5>Brand List</h5><div class="grade-list"></div></div>');
      $("select[name=parent]").load(
        base_url + "general/getcomponentall",
        function (argument) {
          $("select[name=parent]").val(idparent);
        }
      );
      $(".grade-list").load(
        base_url + "general/getgradeall/" + idcategory,
        function (argument) {
          //$("select[name=grade]").val(idgrade);
        }
      );
      $(".brand-list").load(
        base_url + "general/getmerekall/" + idcategory,
        function (argument) {
          //$("select[name=grade]").val(idgrade);
        }
      );
      $(".attribute-list").load(
        base_url + "general/getattributeall/" + idcategory,
        function (argument) {
          //$("select[name=grade]").val(idgrade);
        }
      );
    } else {
      $(".input-form").html(
        '<div class="col-md-3"><select required class="form-control" name="parent"></select></div>'
      );
      $("select[name=parent]").load(
        base_url + "general/getmerekall",
        function (argument) {
          $("select[name=parent]").val(idparent);
        }
      );
    }
  }

  idprn = "";
  idctr = "";
  txtctr = "";
  img = "";
});

$(".btnxxadd").on("click", function () {
  $(".collapseedit").collapse("hide");
  var who = $(this).attr("what");
  if (who == "komponen") {
    /* $(".parentorno").html('<div class="col-md-3"><h5>Kategori Induk</h5><select required class="form-control getallkomponen" name="parent"></select></div><div class="col-md-3"><h5>Grade List</h5><div class="grade-list"></div></div><div class="col-md-3"><h5>Brand List</h5><div class="brand-list"></div></div>'); */
    $(".parentorno").html(
      '<select required class="form-control getallkomponen" name="parent"></select>'
    );
    setTimeout(function () {
      $(".getallkomponen").load(base_url + "general/getcomponentall");
      $(".grade-list").load(base_url + "general/getgradeall/0");
      $(".brand-list").load(base_url + "general/getmerekall/0");
      $(".attribute-list").load(base_url + "general/getattributeall/0");
    }, 1000);
  } else if (who == "tipe") {
    $(".parentorno").html(
      '<div class="col-md-3"><select required class="form-control getmerekallcategorybackend" name="parent"></select></div>'
    );
    setTimeout(function () {
      $(".getmerekallcategorybackend").load(base_url + "general/getmerekall");
    }, 1000);
  } else {
    var prn = "";
    if (who == "merek") {
      prn = "prn";
      /* }else{
			prn="0"; */
    }
    $(".parentorno").html(
      '<input required class="hidden-xs-up" name="parent" value="' + prn + '">'
    );
  }
  $(".collapseadd").collapse("hide");
  $(".collapseadd").collapse("show");
  $(".tipeform").html("Form tambah " + who);
});

// grade jquery

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
          showSuccessToast(response.message);
        } else {
          showErrorToast(response.message);
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

    $.ajax({
      url: base_url + "backendproduct/gradeAjaxUpdate",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#edit-grade").modal("hide");
          tableGrade.ajax.reload();
          showSuccessToast(response.message);
        } else {
          showErrorToast(response.message);
        }
      },
    });
  });

  // Delete button click
  $("#gradeTable").on("click", ".delete", function () {
    if (confirm("Are you sure you want to delete this grade?")) {
      var id = $(this).data("id");

      $.ajax({
        url: base_url + "backendproduct/gradeAjaxDelete",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (response) {
          if (response.status) {
            tableGrade.ajax.reload();
            showSuccessToast(response.message);
          } else {
            showErrorToast(response.message);
          }
        },
      });
    }
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
          showSuccessToast(response.message);
        } else {
          showErrorToast(response.message);
        }
      },
    });
  });

  // Edit button click
  $("#attributeTable").on("click", ".edit", function () {
    var id = $(this).data("id");
    var attribute = $(this).data("attribute");
    var type = $(this).data("type");

    $("#edit_id").val(id);
    $("#edit_attribute").val(attribute);

    $("#edit-attribute").modal("show");
  });

  // Edit form submission
  $("#editFormAttribute").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: base_url + "backendproduct/attributeAjaxUpdate",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#edit-attribute").modal("hide");
          tableAttribute.ajax.reload();
          showSuccessToast(response.message);
        } else {
          showErrorToast(response.message);
        }
      },
    });
  });

  // Delete button click
  $("#attributeTable").on("click", ".delete", function () {
    if (confirm("Are you sure you want to delete this attribute?")) {
      var id = $(this).data("id");

      $.ajax({
        url: base_url + "backendproduct/attributeAjaxDelete",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (response) {
          if (response.status) {
            tableAttribute.ajax.reload();
            showSuccessToast(response.message);
          } else {
            showErrorToast(response.message);
          }
        },
      });
    }
  });
});

// categori table

$(document).ready(function () {
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

  $("#addFormCategori").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: base_url + "backendproduct/categoriAjaxAdd",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-categori").modal("hide");
          $("#addFormCategori")[0].reset();
          tableCategori.ajax.reload();
          showSuccessToast(response.message);
        } else {
          showErrorToast(response.message);
        }
      },
    });
  });

  $("#addFormSubCategori").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      url: base_url + "backendproduct/addSubCategori",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subcategori").modal("hide");
          $("#addFormSubCategori")[0].reset();

          showSuccessToast(response.message);
          table.ajax.reload(); // Reload datatable
        } else {
          showErrorToast(response.message);
        }
      },
      error: function (xhr, status, error) {
        showErrorToast("Error: " + error);
      },
    });
  });

  $("#add-subcategori").on("hidden.bs.modal", function () {
    $("#addFormSubCategori")[0].reset();
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
          showErrorToast("Failed to load categories");
        }
      },
      error: function (xhr, status, error) {
        showErrorToast("Error loading categories: " + error);
      },
    });
  }

  function loadSubCategories(mainCategoryId) {
    $.ajax({
      url: base_url + "backendproduct/getSubCategories/" + mainCategoryId,
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log("Sub Categories Response:", response);
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
          showErrorToast("Failed to load sub categories");
        }
      },
      error: function (xhr, status, error) {
        console.error("Sub Categories Error:", xhr.responseText);
        showErrorToast("Error loading sub categories: " + error);
      },
    });
  }

  // Panggil function ketika modal dibuka
  $("#add-subcategori").on("show.bs.modal", function () {
    loadMainCategories();
  });

  $("#mainCategori").on("change", function () {
    var mainCategoryId = $(this).val();
    var select = $("#subCategori");
    if (mainCategoryId) {
      select.prop("disabled", false);
    } else {
      select.empty().prop("disabled", true);
    }
  });

  $("#addFormSubSubCategori").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      url: base_url + "backendproduct/addSubSubCategori",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subsubcategori").modal("hide");
          $("#addFormSubSubCategori")[0].reset();

          showSuccessToast(response.message);
          table.ajax.reload(); // Reload datatable
        } else {
          showErrorToast(response.message);
        }
      },
      error: function (xhr, status, error) {
        showErrorToast("Error: " + error);
      },
    });
  });

  $("#add-subsubcategori").on("hidden.bs.modal", function () {
    $("#addFormSubSubCategori")[0].reset();
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

  $("#addFormSubCategoriJasa").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: base_url + "backendproduct/subCategoriesJasaAjaxAdd",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-subcategori-jasa").modal("hide");
          $("#addFormSubCategoriJasa")[0].reset();
          tableCategoriJasa.ajax.reload();
          showSuccessToast(response.message);
        } else {
          showErrorToast(response.message);
        }
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
        } else {
          showErrorToast("Failed to load categories");
        }
      },
      error: function (xhr, status, error) {
        showErrorToast("Error loading categories: " + error);
      },
    });
  }

  function loadSubCategoriesJasa(mainCategoryId) {
    $.ajax({
      url: base_url + "backendproduct/getSubCategoriesJasa/" + mainCategoryId,
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log("Sub Categories Response:", response);
        if (response.status) {
          var select = $("#mainCategoriJasaSubSub");
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
          showErrorToast("Failed to load sub categories");
        }
      },
      error: function (xhr, status, error) {
        console.error("Sub Categories Error:", xhr.responseText);
        showErrorToast("Error loading sub categories: " + error);
      },
    });
  }

  // Panggil function ketika modal dibuka
  $("#add-subcategori-jasa").on("show.bs.modal", function () {
    loadMainCategoriesJasa();
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

  $("#addFormBrand").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this); // Ini yang penting untuk handle file

    $.ajax({
      url: base_url + "backendproduct/brandAjaxAdd",
      type: "POST",
      data: formData,
      processData: false, // Penting untuk FormData
      contentType: false, // Penting untuk FormData
      dataType: "json",
      success: function (response) {
        if (response.status) {
          // Success
          $("#add-brand").modal("hide");
          $("#addFormBrand")[0].reset();
          $(".blah").attr("src", ""); // Reset preview
          showSuccessToast(response.message);
          // Reload datatable jika perlu
          // table.ajax.reload();
        } else {
          showErrorToast(response.message);
        }
      },
      error: function (xhr, status, error) {
        showErrorToast(response.message);
      },
    });
  });

  $("#brandTable").on("click", ".delete", function () {
    if (confirm("Are you sure you want to delete this brand?")) {
      var id = $(this).data("id");

      $.ajax({
        url: base_url + "backendproduct/brandAjaxDelete",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (response) {
          if (response.status) {
            tableBrand.ajax.reload();
            showSuccessToast(response.message);
          } else {
            showErrorToast(response.message);
          }
        },
      });
    }
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

  // Edit button click
  // $("#attributeTable").on("click", ".edit", function () {
  //   var id = $(this).data("id");
  //   var attribute = $(this).data("attribute");
  //   var type = $(this).data("type");

  //   $("#edit_id").val(id);
  //   $("#edit_attribute").val(attribute);

  //   $("#edit-attribute").modal("show");
  // });

  // Edit form submission
  // $("#editFormAttribute").on("submit", function (e) {
  //   e.preventDefault();

  //   $.ajax({
  //     url: base_url + "backendproduct/attributeAjaxUpdate",
  //     type: "POST",
  //     data: $(this).serialize(),
  //     dataType: "json",
  //     success: function (response) {
  //       if (response.status) {
  //         $("#edit-attribute").modal("hide");
  //         table.ajax.reload();
  //         showSuccessToast(response.message);
  //       } else {
  //         showErrorToast(response.message);
  //       }
  //     },
  //   });
  // });

  // Delete button click
  // $("#attributeTable").on("click", ".delete", function () {
  //   if (confirm("Are you sure you want to delete this attribute?")) {
  //     var id = $(this).data("id");

  //     $.ajax({
  //       url: base_url + "backendproduct/attributeAjaxDelete",
  //       type: "POST",
  //       data: { id: id },
  //       dataType: "json",
  //       success: function (response) {
  //         if (response.status) {
  //           table.ajax.reload();
  //           showSuccessToast(response.message);
  //         } else {
  //           showErrorToast(response.message);
  //         }
  //       },
  //     });
  //   }
  // });
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
