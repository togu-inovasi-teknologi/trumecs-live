var data = [];
var rfqItems = [];
$(document).ready(function () {
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
        url: base_url + "/share_compare",
        data: {
          emails: emails,
          items: data[categoryId],
        },
        dataType: "json",
        success: function (response) {
          if (response.status) {
            window.location.href = response.uri;
          }
        },
      });
    }
  });

  $(".catalog").each(function (i, val) {
    var category_id = $(this).children("input[name='category_id']").val();
    var name = $(this).children("input[name='name']").val();

    datatableInit($(this).children(".datatable"), "", category_id, name);
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

    var comparespace = $(this)
      .parents(".catalog-content")
      .children(".space-compare");
    if (this.checked) {
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
            tableCompareElement += `<div class="col-lg-12 p-a-0 m-y-md d-flex justify-content-end compare-element_${categoryId}">`;
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

      if (data.length > 0) {
        if ($(".float-request").hasClass("d-none")) {
          $(".float-request").removeClass("d-none");
        }
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

  function datatableInit(element, search, categoryId, name) {
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

    element.DataTable({
      ajax: {
        url: base_url + "/getProductByCategories",
        type: "POST",
        data: dataToRequest,
      },
      drawCallback: function (settings) {
        $(".dataTable thead").remove();
      },
      layout:{
        topStart: null,
        topEnd: null,
        bottomStart:null,
        bottomEnd:null,
        top1Start:
          {
          className:"table-search-box",
          features:[{
            search : {
              placeholder:"Cari "+name
            }
          }]
          
        }
      },
      columnDefs: [
        {
          targets: 0,
          width:"50%",
          className: "text-left  p-y-5px p-l-2",
        },
        {
          targets: 1,
          width:"40%",
          className: "text-right p-y-5px p-r-2",
        },
        {
          targets: [0,1],
          className: "",
        },
      ],
      orderClasses: true,
      searching: true,
      lengthChange: false,
      processing: true,
      serverSide: true,
      autoWidth: false,
      /* createdRow: function (row, data, dataIndex) {
        console.log(data);
        $(row).html(
          `<td style="vertical-align:middle;">` +
            data[0] +
            `</td>
            <td>` +
            data[1] +
            `</td>
            <td style="vertical-align:middle;width:30px">` +
            data[2] +
            `</td>`
        );
      }, */
    });
  }

  function datatableDestroy(element) {
    // console.log(element.DataTable());
    element.empty();
    element.DataTable().destroy();
  }
});

function addItemQuotation(data) {}
