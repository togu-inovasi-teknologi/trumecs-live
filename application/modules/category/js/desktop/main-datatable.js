var data = [];
var rfqItems = [];
let selectedBrandId = null;
let selectedSubCategoryId = null;
let subCategoryContainer = $(".row.justify-content-center.subcategory");
let subBrandContainer = $(".row.justify-content-center.brand");
let originalHTMLSub = subCategoryContainer.html();
let originalHTMLBrand = subBrandContainer.html();
let isCollapsedSub = false;
let isCollapsedBrand = false;
$(document).ready(function () {
  var ids = $("input[name='current_c_k_items']").val();

  if (ids !== "0") {
    rfqItems = ids.split(",");
  }

  // $(window).scroll(function () {
  //     var scrollPostition = $(window).scrollTop();
  //     if(scrollPostition > 5296 && scrollPostition < 6332){
  //         $('.float-request').addClass('d-none');
  //     }else{
  //         if(rfqItems.length > 0){
  //             $('.float-request').removeClass('d-none');
  //         }
  //     }

  // });

  $(document).on("click", "#btn-share-submit", function (e) {
    e.preventDefault();

    var emails = [];

    $.each($("#tags").children(), function (i, value) {
      emails.push($("#tags").children().eq(i).children(".value").html());
    });

    var categoryId = $("#share_input_category_id").val();

    if (emails.length > 0) {
      $.ajax({
        type: "POST",
        url: base_url + "share_compare",
        data: {
          emails: emails,
          items: data[categoryId],
        },
        dataType: "json",
        success: function (response) {
          console.log(response);
          if (response.status) {
            window.location.href = response.uri;
          }
        },
      });
    }
  });

  $(".catalog").each(function (i, val) {
    var category_id = $(this).children("input[name='category_id']").val();
    var image = $(this).children("input[name='image']").val();
    var name = $(this).children("input[name='name']").val();

    datatableInit($(this).children(".datatable"), "", category_id, image, name);
  });

  $(".search-datatable").keyup(function (e) {
    e.preventDefault();

    var category_id = $(this).data("search_id");

    var id = `#id_datatable_${category_id}`;

    var element = $(id);

    datatableDestroy(element);

    datatableInit(element, $(this).val(), category_id);
  });

  $(document).on("click", ".compare_share", function (e) {
    e.preventDefault();

    var categoryId = $(this).data("id");

    $("#share_input_category_id").val(categoryId);
  });

  $(document).on("change", ".checkbox-quotation", function () {
    var data = {
      tittle: $(this).data("name"),
      id: $(this).val(),
    };

    if (this.checked) {
      rfqItems.push(data);
    } else {
      $.each(rfqItems, function (i, value) {
        rfqItems.splice(i, 1);
      });
    }

    if (rfqItems.length > 0) {
      $(".float-request").removeClass("d-none");
      $("#float-value").html(`Permintaan ${rfqItems.length} (item)`);

      var tags = $("#items-autocomplete-selected");

      tags.append(
        `<li class="item-selected-rfq" data-id="${data.id}"><span>${data.tittle}</span><button data-id="${data.id}" class="delete-button"><i class="fa fw fa-close"></i></button></li>`
      );
    } else {
      $(".float-request").addClass("d-none");
    }
  });

  $(document).on("click", ".delete-button", function (e) {
    e.preventDefault();

    var id = $(this).data("id");

    var classElement = `.checkbox-quotation-item-${id}`;

    $(classElement).prop("checked", false);

    $.each(rfqItems, function (i, value) {
      if (value.id == id) {
        rfqItems.splice(i, 1);
      }
    });

    if (rfqItems.length < 1) {
      $(".float-request").addClass("d-none");
    }
  });

  $(document).on("change", ".checkbox-compare", function () {
    const id = $(this).val();
    const categoryId = $(this)
      .parents(".catalog")
      .children("input[name='category_id']")
      .val();

    // console.log(data.categoryId);

    console.log(rfqItems);

    var comparespace = $(this)
      .parents(".catalog-content")
      .children(".space-compare");
    if (this.checked) {
      console.log("check");
      rfqItems.push(id);
      $.ajax({
        type: "POST",
        url: base_url + "/productCompare",
        data: {
          product_id: id,
        },
        dataType: "json",
        success: function (response) {
          if (comparespace.children().length == 0) {
            // data[categoryId].push(response);
            data[categoryId] = [response];

            var tableCompareElement = `<div class="table-scroll" id="compare-element_${categoryId}">`;
            tableCompareElement += `<div class="table-wrap">`;
            tableCompareElement += `<table  class="table main-table table-sm table-hover table-bordered table-compare table-striped">`;

            $.each(response, function (i, value) {
              tableCompareElement += `<tr>`;
              if (i.toLowerCase() == "price") {
                tableCompareElement += `<th class="f14 color-primary clone fixed-side">${i}</th>`;
                tableCompareElement += `<td class="color-primary compare-element_${response.id} fbold">${value}</td>`;
              } else {
                tableCompareElement += `<th class="f14 clone fixed-side">${i}</th>`;
                tableCompareElement += `<td class="compare-element_${response.id}">${value}</td>`;
              }
              tableCompareElement += `</tr>`;
            });

            tableCompareElement += `</table>`;

            tableCompareElement += "</div>";
            tableCompareElement += "</div>";
            tableCompareElement += `<div class="col-lg-12 p-a-0 d-flex justify-content-end compare-element_${categoryId}">`;
            tableCompareElement += `<button data-toggle="modal" data-target="#shareModal" data-id="${categoryId}" data-whatever="@mdo" class="btn btn-sm btnnew compare_share compare-element_${categoryId}">Share <i class="fa fa-fw fa-share"></i></button>`;
            tableCompareElement += "</div>";

            $(comparespace).append(tableCompareElement);
          } else {
            data[categoryId].push(response);
            var index = 0;
            $.each(response, function (i, value) {
              if (i.toLowerCase() == "price") {
                comparespace
                  .children(".table-scroll")
                  .children(".table-wrap")
                  .children(".table-compare")
                  .children("tbody")
                  .children()
                  .eq(index)
                  .append(
                    `<td class="fbold compare-element_${response.id} color-primary">${value}</td>`
                  );
              } else {
                comparespace
                  .children(".table-scroll")
                  .children(".table-wrap")
                  .children(".table-compare")
                  .children("tbody")
                  .children()
                  .eq(index)
                  .append(
                    `<td class="compare-element_${response.id}">${value}</td>`
                  );
              }
              index++;
            });

            // .append(tableCompareElement);
          }
        },
      });

      if ($(".float-request").hasClass("d-none")) {
        $(".float-request").removeClass("d-none");
      }
    } else {
      console.log("uncheck");
      $.each(rfqItems, function (i, value) {
        if (value == id) {
          rfqItems.splice(i, 1);
        }
      });

      var classData = `.compare-element_${$(this).val()}`;
      $(classData).remove();

      var compare = comparespace
        .children(".table-scroll")
        .children(".table-wrap")
        .children(".table-compare")
        .children("tbody")
        .children("tr")
        .eq(0)
        .children().length;

      if (compare == 1) {
        comparespace.html("");
      }

      if (rfqItems.length > 0) {
        if ($(".float-request").hasClass("d-none")) {
          $(".float-request").removeClass("d-none");
        }
      } else {
        $(".float-request").addClass("d-none");
        window.location.href = base_url + "/deleteRfqSession";
      }
    }

    $(".form-list").html("");

    var form = "";

    $.each(rfqItems, function (i, value) {
      form += `<input type="hidden" name="items[]" value="${value}">`;
    });

    $(".form-list").append(form);

    // console.log(data.length);

    $("#float-value").html(`Permintaan ${rfqItems.length} (item)`);
  });
});

function datatableInit(
  element,
  search,
  categoryId,
  image,
  name,
  subcategoryId = "",
  brandId = ""
) {
  var dataToRequest = {
    where: {
      component: categoryId,
    },
  };

  if (search != "") {
    dataToRequest.search = {
      value: search,
    };
  }

  if (brandId !== null && brandId !== "") {
    dataToRequest.where.brand = brandId;
  }

  if (subcategoryId !== null && subcategoryId !== "") {
    dataToRequest.where.subcategory = subcategoryId;
  }
  var table = element.DataTable({
    ajax: {
      url: base_url + "/getProductByCategories",
      type: "POST",
      data: dataToRequest,
    },
    layout: {
      topStart: null,
      topEnd: null,
      bottomStart: null,
      bottomEnd: null,
      top1Start: [
        function () {
          let toolbar = document.createElement("div");
          toolbar.innerHTML =
            '<img src="' + image + '" alt="' + name + '" width="100%">';
          toolbar.setAttribute(
            "class",
            "col-lg-3 d-flex align-items-end gap-3 p-l-0"
          );
          return toolbar;
        },
        {
          className: "flex flex-column col-md-4",
          features: [
            function () {
              let toolbar = document.createElement("div");
              toolbar.innerHTML =
                '<h2 class="fbold" style="font-size:30px">' + name + "</h2>";
              //toolbar.setAttribute('class', '');
              return toolbar;
            },
            "pageLength",
          ],
        },
      ],
      top1End: ["search"],
    },
    columnDefs: [
      {
        targets: 0,
        visible: false,
        className: " p-a-0",
      },
      {
        targets: 3,
        className: "text-left p-a-5px ",
      },
      {
        targets: 4,
        className: "text-right p-a-5px",
      },
      {
        targets: 5,
        className: "text-center p-a-5px",
      },
      {
        targets: [1, 2, 3, 4, 5],
        className: "dt-head-center p-a-5px ",
      },
    ],
    orderClasses: true,
    searching: true,
    lengthChange: true,
    processing: true,
    serverSide: true,
  });
  table.on("click", "tbody tr", function () {
    console.log(table.row(this));
    // let data = table.row(this).data();
    // var id = data[0];
    // str = data[1].replace(/\s+/g, '-').toLowerCase();
    // redirect = base_url + 'product/' + id + '/' + str;
    // window.location.href = redirect;
  });
}

function datatableDestroy(element) {
  element.empty();
  element.DataTable().destroy();
}

function showFloatingQuotationWidget() {}

$(document).ready(function () {
  $(".brand-category-item").click(function () {
    $(".brand-category-item").removeClass("active");
    $(this).addClass("active");
  });

  $(".submenu-category-item").click(function () {
    $(".submenu-category-item").removeClass("active");
    $(this).addClass("active");
  });
});

function toggleBrandSelection(el, brandId) {
  $(".brand-category-item").removeClass("active");
  $(el).addClass("active");
  selectedBrandId = brandId;
  sessionStorage.setItem("selectedBrand", brandId);

  let selected = $(el).closest(".col-lg-2").clone();

  if (!isCollapsedBrand) {
    originalHTMLBrand = subBrandContainer.html();
  }

  subBrandContainer
    .html("")
    .append(
      $(
        '<div class="row d-flex justify-content-start m-b-8px gap-2 w-100 m-a-0 active">'
      ).append(selected)
    );

  isCollapsedBrand = true;
  $("#toggle-brands").parent().removeClass("d-none");
  $("html, body").animate(
    {
      scrollTop: $("#see-product-table").offset().top - 100,
    },
    500
  );
  applyFilters();
}

// Fungsi untuk subcategory
function toggleSubCategorySelection(el, subCategoryId) {
  selectedSubCategoryId = subCategoryId;
  $(".submenu-category-item").removeClass("active");
  $(el).addClass("active");
  sessionStorage.setItem("selectedSubCategory", subCategoryId);

  let selected = $(el).closest(".col-lg-4, .col-lg-6, .col-lg-12").clone();

  if (!isCollapsedSub) {
    originalHTMLSub = subCategoryContainer.html();
  }

  subCategoryContainer
    .html("")
    .append(
      $(
        '<div class="row d-flex justify-content-start m-b-8px gap-2 w-100 m-a-0 active">'
      ).append(selected)
    );

  isCollapsedSub = true;
  $("#toggle-subcategories").parent().removeClass("d-none");

  $("html, body").animate(
    {
      scrollTop: $("#see-product-table").offset().top - 100,
    },
    500
  );

  applyFilters();
}

// Fungsi baru untuk menerapkan kedua filter
function applyFilters() {
  const category_id = $("input[name='category_id']").val();
  const image = $("input[name='image']").val();
  const name = $("input[name='name']").val();
  const tableElement = $(`#id_datatable_${category_id}`);

  const subcategoryId = selectedSubCategoryId || "";
  const brandId = selectedBrandId || "";

  datatableDestroy(tableElement);
  datatableInit(
    tableElement,
    "",
    category_id,
    image,
    name,
    selectedSubCategoryId,
    selectedBrandId
  );
}

$("#toggle-subcategories").on("click", function () {
  if (isCollapsedSub) {
    subCategoryContainer.html(originalHTMLSub);
    $(".submenu-category-item").removeClass("active");
    isCollapsedSub = false;
    $(this).text("Lihat Semua");
    $(this).parent().addClass("d-none");
    selectedSubCategoryId = null;
    applyFilters();
  }
});

$("#toggle-brands").on("click", function () {
  if (isCollapsedBrand) {
    subBrandContainer.html(originalHTMLBrand);
    $(".brand-category-item").removeClass("active");

    isCollapsedBrand = false;
    $(this).text("Lihat Semua");
    $(this).parent().addClass("d-none");
    selectedBrandId = null;
    applyFilters();
  }
});

$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
      $("#back-to-top").removeClass("d-none");
    } else {
      $("#back-to-top").addClass("d-none");
    }
  });
  $("#back-to-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      500
    );
    return false;
  });
});