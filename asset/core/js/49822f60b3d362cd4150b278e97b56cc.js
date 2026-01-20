var baseurl = $("body").attr("baseurl");
var items = [];
var supplierIndex;

var format = function (num) {
  var str = num.toString().replace("", ""),
    parts = false,
    output = [],
    i = 1,
    formatted = null;
  if (str.indexOf(".") > 0) {
    parts = str.split(".");
    str = parts[0];
  }
  str = str.split("").reverse();
  for (var j = 0, len = str.length; j < len; j++) {
    if (str[j] != ".") {
      output.push(str[j]);
      if (i % 3 == 0 && j < len - 1) {
        output.push(".");
      }
      i++;
    }
  }
  formatted = output.reverse().join("");
  return "" + formatted + (parts ? "." + parts[1].substr(0, 2) : "");
};
$("#datatables").DataTable({
  ordering: false,
  paging: true,
  searching: true,
  info: true,
  autowidth: false,
});
$(".readonly").keydown(function (e) {
  e.preventDefault();
});
$(".add-list-item").on("click", function () {
  $(".list-card").append($(".list-form").html());
});

$(document).on("click", ".del-list-item", function () {
  $(this).parent().parent().remove();
});
$("*[jq-model]").on("change", function (argument) {
  var name = $(this).attr("jq-model");
  $('span[js-result="' + name + '"]').text($(this).val());
});
$(document).ready(function () {
  $(".uang").mask("000.000.000.000.000.000", {
    reverse: true,
  });
});
$(document).ready(function () {
  $(".inc_ongkir").change(function () {
    if ($(this).prop("checked")) {
      $(".nama_ekspedisi").prop("readonly", false);
      $(".biaya_pengiriman").prop("readonly", false);
    } else {
      $(".nama_ekspedisi").prop("readonly", true);
      $(".biaya_pengiriman").prop("readonly", true);
    }
  });

  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);
  $("#uploader").dropzone({
    url: base_url + "bulk/upload",
    parallelUploads: 3,
    clickable: ".btn-upload",
    previewTemplate: previewTemplate,
    autoQueue: true,
    maxFiles: 3,
    previewsContainer: "#previews",
    acceptedFiles: ".xls, .xlsx, .png, .jpg, .jpeg, .docx, .pdf",
    init: function () {
      this.on("dragenter", function () {
        $("#uploader").addClass("drag-enter");
      });
      this.on("dragleave", function () {
        $("#uploader").removeClass("drag-enter");
      });
      this.on("complete", (file) => {
        $(file).each(function (index, item) {
          response = JSON.parse(item.xhr.response);
          $("#uploader").removeClass("drag-enter");
          $("#uploader").append(
            '<input type="hidden" name="files[]" value="' +
              response.name +
              '" />'
          );
          setTimeout(function () {
            $(item.previewElement).find(".progress").fadeOut(1000);
          }, 500);
        });
      });
      this.on("removedfile", (file) => {
        response = JSON.parse(file.xhr.response);
        filename = response.name;
        $.post(
          base_url + "bulk/remove",
          { filename: filename },
          function (data) {
            $('input[value="' + filename + '"]').remove();
          }
        );
      });
    },
  });
});
$(document).on("click", ".change-nego", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego");
  var action = container.find(".action-nego");
  inputNego.prop("readonly", false);
  action.html(
    "<button class='btn btnnewgreen nego-fix'><i class='bi bi-check'></i></button> <button class='btn btnnewred cancel-nego'><i class='fa fa-times'></i></button>"
  );
});
$(document).on("click", ".nego-fix", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego");
  var status = container.find(".price-status");
  status.val(0);
  var action = container.find(".action-nego");
  inputNego.prop("readonly", true);
  action.html(
    "<button class='btn btnnew redo-harga'><i class='fa fa-refresh'></i></button>"
  );
});
$(document).on("click", ".redo-harga", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego");
  var action = container.find(".action-nego");
  inputNego.prop("readonly", false);
  action.html(
    "<button class='btn btnnewgreen nego-fix'><i class='bi bi-check'></i></button>"
  );
});
$(document).on("click", ".cancel-nego", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego");
  var action = container.find(".action-nego");
  inputNego.prop("readonly", true);
  action.html(
    "<button class='btn btn-primary change-nego'><i class=\"bi bi-pencil\"></i></button>"
  );
});

$(document).on("click", ".change-nego-cust", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego-cust");
  var action = container.find(".action-nego-cust");
  inputNego.prop("readonly", false);
  action.html(
    "<button class='btn btnnewgreen nego-cust-fix'><i class='bi bi-check'></i></button> <button class='btn btnnewred cancel-nego-cust'><i class='fa fa-times'></i></button>"
  );
});
$(document).on("click", ".nego-cust-fix", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego-cust");
  var status = container.find(".price-status");
  status.val(1);
  var action = container.find(".action-nego-cust");
  inputNego.prop("readonly", true);
  action.html(
    "<button class='btn btnnew redo-harga-cust'><i class='fa fa-refresh'></i></button>"
  );
});
$(document).on("click", ".redo-harga-cust", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego-cust");
  var action = container.find(".action-nego-cust");
  inputNego.prop("readonly", false);
  action.html(
    "<button class='btn btnnewgreen nego-cust-fix'><i class='bi bi-check'></i></button>"
  );
});
$(document).on("click", ".cancel-nego-cust", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-nego-cust");
  var action = container.find(".action-nego-cust");
  inputNego.prop("readonly", true);
  action.html(
    "<button class='btn btn-primary change-nego-cust'><i class=\"bi bi-pencil\"></i></button>"
  );
});

$(document).on("click", ".harga-fix", function () {
  var container = $(this).closest(".card-nego");
  var priceNego = container.find(".price-nego");
  var inputNego = container.find(".input-nego");
  var action = container.find(".action-nego");
  var price = priceNego.val();
  var status = container.find(".price-status");
  status.val(2);
  inputNego.val(price);
  action.html(
    "<button class='btn btnnew edit-harga'><i class='fa fa-refresh'></i></button>"
  );
});
$(document).on("click", ".harga-tolak", function () {
  var container = $(this).closest(".card-nego");
  var priceAwal = container.find(".price-awal");
  var inputNego = container.find(".input-nego");
  var action = container.find(".action-nego");
  var price = priceAwal.val();
  var status = container.find(".price-status");
  status.val(3);
  inputNego.val(price);
  action.html(
    "<button class='btn btnnew f8 edit-harga'><i class='fa fa-refresh'></i></button>"
  );
});
$(document).on("click", ".edit-harga", function () {
  var container = $(this).closest(".card-nego");
  var action = container.find(".action-nego");
  action.html(
    "<button class='btn btnnewgreen f8 harga-fix'><i class='bi bi-check'></i></button> <button class='btn btn-primary f10 change-nego'>Nego</button> <button class='btn btnnewred f8 harga-tolak'><i class='fa fa-times'></i></button>"
  );
});

$(document).on("click", ".edit-qty", function () {
  var container = $(this).closest(".card-nego");
  var edit = container.find(".input-qty");
  var icon = container.find(".action-qty");
  edit.prop("readonly", false);
  icon.html(
    '<button type="button" class="btn btnnewgreen done-qty"><i class="bi bi-check"></i></button> <button class="btn btnnewred cancel-qty"><i class="fa fa-times"></i></button>'
  );
});
$(document).on("click", ".cancel-qty", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-qty");
  var action = container.find(".action-qty");
  inputNego.prop("readonly", true);
  action.html(
    "<button class='btn btn-primary edit-qty'><i class=\"bi bi-pencil\"></i></button>"
  );
});
$(document).on("click", ".done-qty", function () {
  var container = $(this).closest(".card-nego");
  var edit = container.find(".input-qty");
  var icon = container.find(".action-qty");
  edit.prop("readonly", true);
  icon.html(
    '<button type="button" class="btn btn-primary edit-qty"><i class="bi bi-pencil"></i></button>'
  );
});

$(document).on("click", ".edit-uom", function () {
  var container = $(this).closest(".card-nego");
  var edit = container.find(".input-uom");
  var icon = container.find(".action-uom");
  edit.prop("readonly", false);
  icon.html(
    '<button type="button" class="btn btnnewgreen done-uom"><i class="bi bi-check"></i></button> <button class="btn btnnewred cancel-uom"><i class="fa fa-times"></i></button>'
  );
});
$(document).on("click", ".cancel-uom", function () {
  var container = $(this).closest(".card-nego");
  var inputNego = container.find(".input-uom");
  var action = container.find(".action-uom");
  inputNego.prop("readonly", true);
  action.html(
    "<button class='btn btn-primary edit-uom'><i class=\"bi bi-pencil\"></i></button>"
  );
});
$(document).on("click", ".done-uom", function () {
  var container = $(this).closest(".card-nego");
  var edit = container.find(".input-uom");
  var icon = container.find(".action-uom");
  edit.prop("readonly", true);
  icon.html(
    '<button type="button" class="btn btn-primary edit-uom"><i class="bi bi-pencil"></i></button>'
  );
});

$(document).on("click", ".remove-item", function () {
  alert("asdasdasd");
});

$(document).ready(function () {
  $(".input-qty").each(function () {
    $(this).on("input", function () {
      var container = $(this).closest(".card-nego");
      var inputQty = $(this).val();
      var harga = container.find(".price-awal").val();
      var hargaInt = harga.replace(/\./g, "");
      var hargaNego = container.find(".price-nego").val();
      var hargaNegoInt = hargaNego.replace(/\./g, "");
      var inputNego = container.find(".input-nego").val();
      var inputNegoInt = inputNego.replace(/\./g, "");
      var total = container.find(".total-harga");
      var totalHarga = hargaInt * inputQty;
      var totalHargaNego = hargaNegoInt * inputQty;
      var totalInputNego = inputNegoInt * inputQty;
      if (inputNego !== null && inputNego.length !== 0) {
        total.val(format(totalInputNego));
      } else if (hargaNego !== null || hargaNego !== 0) {
        total.val(format(totalHarga));
      } else {
        total.val(format(totalHargaNego));
      }
    });
  });
});

$(document).ready(function () {
  $(".input-nego").each(function () {
    $(this).on("input", function () {
      var container = $(this).closest(".card-nego");
      var inputNego = $(this).val();
      var inputNegoInt = inputNego.replace(/\./g, "");
      var harga = container.find(".price-awal").val();
      var hargaInt = harga.replace(/\./g, "");
      var hargaNego = container.find(".price-nego").val();
      var hargaNegoInt = hargaNego.replace(/\./g, "");
      var inputQty = container.find(".input-qty").val();
      var total = container.find(".total-harga");
      var totalHarga = hargaInt * inputQty;
      var totalHargaNego = hargaNegoInt * inputQty;
      var totalInputNego = inputNegoInt * inputQty;
      if (inputNego !== null && inputNego.length !== 0) {
        total.val(format(totalInputNego));
      } else if (hargaNego !== null || hargaNego !== 0) {
        total.val(format(totalHargaNego));
      } else {
        total.val(format(totalHarga));
      }
    });
  });
});

$(document).on("keyup", ".form-autocomplete-item", function (e) {
  setItemAutocomplete($(this));
});

function setItemAutocomplete(element) {
  element
    .autocomplete({
      source: function (request, response) {
        $.ajax({
          type: "POST",
          url: baseurl + "/bulk/getAutocompleteProduct/",
          data: {
            keyword: request.term,
          },
          dataType: "json",
          success: function (data) {
            if (data.length > 0) {
              response(data);
            }
          },
        });
      },
      minLength: 3,
      select: function (event, ui) {
        element
          .parent()
          .children()
          .eq(element.index() - 1)
          .val(ui.item.id);

        element.val(ui.item.tittle);
        return false;
      },
    })
    .autocomplete("instance")._renderItem = function (ul, item) {
    label = item.tittle;
    return $("<div class='p-a-1 border-sm bg-white f12'>")
      .append("<div>" + label + "</div>")
      .appendTo(ul);
  };
}
$(document).ready(function () {
  $(".fileExtension").each(function () {
    var filename = $(this).data("filename");
    var fileExtension = filename.split(".").pop().toLowerCase();
    var iconPath = getIconPathByExtension(fileExtension);
    var path = getPathByExtension(fileExtension);
    $(this).find(".fileIcon").attr("src", iconPath);
    $(this)
      .find(".filePath")
      .attr("href", path + filename);
  });
});
function getIconPathByExtension(extension) {
  var iconMapping = {
    png: baseurl + "public/icon/fileicon/png.png",
    xls: baseurl + "public/icon/fileicon/xls.png",
    xlsx: baseurl + "public/icon/fileicon/xlsx.png",
    jpg: baseurl + "public/icon/fileicon/jpg.png",
    jpeg: baseurl + "public/icon/fileicon/jpeg.png",
  };
  return iconMapping[extension] || "public/icon/fileicon/default.png";
}
function getPathByExtension(extension) {
  var pathMapping = {
    xls: baseurl + "public/sourcing/",
    xlsx: baseurl + "public/sourcing/",
    png: baseurl + "public/sourcing/foto/",
    jpg: baseurl + "public/sourcing/foto/",
    jpeg: baseurl + "public/sourcing/foto/",
  };
  return pathMapping[extension] || "public/sourcing/";
}
$(document).on("click", ".supplier-source", function () {
  var table;
  var dt;

  supplierIndex = $(this).parent().parent().index();
  items = [];

  dt = $("#modalSupplier .datatable").DataTable({
    ajax: {
      url: base_url + "getjson/getsourcing_items_supplier",
      method: "POST",
      data: {
        where: "type = 'supplier'",
      },
    },
    scrollX: true,
    processing: true,
    serverSide: true,
    columns: [
      { data: "company", className: "f12" },
      { data: "items", className: "f12" },
      { data: "qty", className: "f12 text-right" },
      { data: "uom", className: "f12" },
      { data: "price", className: "f12 text-right" },
      { data: "created_at", className: "f12 text-muted text-right" },
      { data: "province", className: "f12" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: 2,
        render: function (data, type, row) {
          var data = parseInt(data);
          return data.toLocaleString("id-ID");
        },
      },
      {
        targets: 4,
        render: function (data, type, row) {
          var data = parseInt(data);
          return "Rp " + data.toLocaleString("id-ID");
        },
      },
      {
        targets: 5,
        render: function (data, type, row) {
          var tgl = parseInt(data);
          var dates = new Date(tgl * 1000);
          return dates.toLocaleDateString("id-ID");
        },
      },
      {
        targets: 7,
        orderable: false,
        render: function (data, type, row) {
          return `<input type="checkbox" class="checkbox-item-source-datatable" data-json='${JSON.stringify(
            row
          )}' name="item_checks[]"  value="${data.id}">`;
        },
      },
    ],
    drawCallback: function (settings) {
      var api = this.api();

      // Output the data for the visible rows to the browser's console
      console.log(api.rows({ page: "current" }).data());
    },
  });

  table = dt.$;

  dt.on("draw", function (data, row) {
    console.log(row);
    handleSelectedRows();
  });

  function handleSelectedRows() {
    const buttons = document.querySelectorAll(
      '[class="checkbox-item-source-datatable"]'
    );

    buttons.forEach((element) => {
      element.addEventListener("change", selectedSource);
    });
  }
});
function selectedSource(e) {
  const data = JSON.parse(e.target.dataset.json);

  if (e.target.checked) {
    items.push(data);
  } else {
    items.forEach((element, index) => {
      if (element.id == data.id) {
        items.splice(index, 1);
      }
    });
  }
}

$(document).on("click", "#btn-save-item-list-source", function (e) {
  console.log(supplierIndex);

  var trItem = $("table.table-item > tbody").children().eq(supplierIndex);

  var tdItemProduct = trItem
    .children()
    .eq(7)
    .find("input[name='list_id[]']")
    .val();
  var tdItemQuantity = trItem.children().eq(2);
  var tdItemPrice = trItem
    .children()
    .eq(4)
    .find(".uang")
    .val()
    .replace(/\./g, "");

  console.log("Harga " + tdItemPrice);

  /*tdItemProduct.after(`

        <input type="hidden" name="id_items[]" value="${items[0].product_id}" class="form-control product-id" id="id_items">
        <input type="name" name="items[]" value="${items[0].items}" class="form-control product-name" id="name" placeholder="Masukan nama item">
    
    `);*/

  items.forEach((element) => {
    trItem.after(
      '<tr style="background-color:#f9f9f9"><td class="f12 p-l-1"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>'
    );

    var trPrice = $("table.table-item > tbody")
      .children()
      .eq(supplierIndex + 1);
    trPrice
      .children()
      .eq(0)
      .html(
        '<span class="text-muted">' +
          element.company +
          "</span><br/>" +
          element.items
      );
    trPrice
      .children()
      .eq(2)
      .html(
        '<div class="input-group input-group-sm">' +
          '<input type="text" class="form-control uang input-qty text-right" name="qty_supplier[]" value="' +
          element.qty +
          '" >' +
          '<input type="hidden" name="source_id[]" value="' +
          element.id +
          '" readonly>' +
          '<input type="hidden" name="source_item_id[]" value="' +
          tdItemProduct +
          '" readonly>' +
          '<span class="input-group-btn action-qty">' +
          '<button type="button" class="btn btn-primary edit-qty"><i class="bi bi-pencil"></i></button>' +
          "</span>" +
          "</div>"
      );
    trPrice
      .children()
      .eq(3)
      .html(
        '<div class="input-group input-group-sm">' +
          '<input type="text" class="form-control input-uom text-right" name="uom[]" value="' +
          element.uom +
          '" readonly>' +
          '<span class="input-group-btn action-uom">' +
          '<button type="button" class="btn btn-primary edit-uom"><i class="bi bi-pencil"></i></button>' +
          "</span>" +
          "</div>"
      );
    trPrice
      .children()
      .eq(4)
      .html(
        '<div class="input-group input-group-sm">' +
          '<span class="text-success input-group-addon fbold">' +
          Math.round(((tdItemPrice - element.price) / element.price) * 100) +
          "%" +
          "</span>" +
          '<span class="input-group-addon">Rp</span>' +
          '<input type="text" class="form-control uang text-right" name="price_supplier[]" value="' +
          element.price +
          '" >' +
          "</div>"
      );
  });

  /*
    var currentQuantity = tdItemQuantity.children().eq(0);
    currentQuantity = parseInt(currentQuantity.val());

    var qtySelected = 0;

    items.forEach(element => {
        qtySelected = qtySelected +parseInt(element.qty);
    });

    if(qtySelected > currentQuantity){
        currentQuantity = qtySelected;
    }
    
    tdItemQuantity.html(`<input type="number" name="qty[]" class="form-control product-quantity" id="qty" value="${currentQuantity}" min="1">`);

    var tr = $('table.table-item > tbody').children().eq(supplierIndex);

    var tdQuantity = tr.children().eq(1);
    var tdPrice = tr.children().eq(2);
    var tdSupplierName = tr.children().eq(3);

    var elementQuantity = '';
    var elementPrice = '';
    var elementSupplier = '';

    items.forEach(element => {
        elementQuantity += `<input type="number" name="qty_supplier[]" class="form-control m-b-1" id="qty" value="${element.qty}" min="1" readonly>`;
    });

    items.forEach(element => {
        elementPrice += `
            <input type="text" value="${element.price}" class="form-control m-b-1 price-display" placeholder="0" readonly>
            <input type="hidden" name="price_supplier[]" value="${element.price}" class="form-control m-b-1" id="price" placeholder="0" readonly>
        `;
    });

    items.forEach(element => {
        elementSupplier += `
            <div class="input-group m-b-1">

                <input type="text" class="form-control" readonly value="${element.company}">
                <input type="hidden" class="form-control" name="source_id[]" value="${element.id}">
                <input type="hidden" class="form-control" name="source_item_id[]" value="${element.product_id}">
                <span class="input-group-btn">
                    <button class="btn btn-danger btn-delete-source" type="button"><i
                            class="fa fa-fw fa-trash"></i></button>
                </span>
            </div>
        `;
    });

    tdQuantity.html(elementQuantity);
    tdPrice.html(elementPrice);
    tdSupplierName.html(elementSupplier);

*/
});

$(document).on("click", ".remove-source", function (e) {
  $(this).parent().parent().remove();
});
