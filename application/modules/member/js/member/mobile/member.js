$(document).ready(function () {
  var id = $('input[name="order_id"]').val();

  $("#data-table-order-item").DataTable({
    ajax: {
      url: base_url + "member/getOrderItem",
      type: "POST",
      data: {
        where: {
          id_order: id,
        },
      },
    },
    ordering: false,
    paging: false,
    searching: false,
    info: true,
    autowidth: false,
    processing: true,
    serverSide: true,
  });
});

$(document).ready(function () {
  $(".rotate-icon").click(function () {
    $(this).find(".icon").toggleClass("rotate");
  });
});
$(document).on("click", ".btn-name", function () {
  $(".edit-name").html($('input[name="name"]').val());
  $(".modal-name").modal("hide");
});
$(document).on("click", ".btn-email", function () {
  $(".edit-email").html($('input[name="email"]').val());
  $(".modal-email").modal("hide");
});
$(document).on("click", ".btn-phone", function () {
  $(".edit-phone").html($('input[name="phone"]').val());
  $(".modal-phone").modal("hide");
});
$(document).on("click", ".btn-ttl", function () {
  $(".edit-date").html($('select[name="date"] option:selected').val());
  $(".edit-month").html($('select[name="month"] option:selected').val());
  $(".edit-year").html($('select[name="year"] option:selected').val());
  $(".modal-ttl").modal("hide");
});
$(document).on("click", ".btn-company", function () {
  $(".edit-company").html($('input[name="company"]').val());
  $(".modal-company").modal("hide");
});
$(document).on("click", ".btn-position", function () {
  $(".edit-position").html($('input[name="position"]').val());
  $(".modal-position").modal("hide");
});
$(document).on("click", ".btn-company-email", function () {
  $(".edit-company-email").html($('input[name="company_email"]').val());
  $(".modal-company-email").modal("hide");
});
$(document).on("click", ".btn-company-phone", function () {
  $(".edit-company-phone").html($('input[name="company_phone"]').val());
  $(".modal-company-phone").modal("hide");
});
$(document).on("click", ".btn-address", function () {
  $(".edit-address").html($('input[name="address"]').val());
  $(".edit-rt-rw").html($('input[name="rt_rw"]').val());
  $(".edit-province").html(
    jQuery.isNumeric($('select[name="province"]').val())
      ? $('select[name="province"] option:selected').text()
      : ""
  );
  $(".edit-city").html(
    jQuery.isNumeric($('select[name="city"]').val())
      ? $('select[name="city"] option:selected').text()
      : ""
  );
  $(".edit-districts").html(
    jQuery.isNumeric($('select[name="districts"]').val())
      ? $('select[name="districts"] option:selected').text()
      : ""
  );
  $(".edit-village").html(
    jQuery.isNumeric($('select[name="village"]').val())
      ? $('select[name="village"] option:selected').text()
      : ""
  );
  $(".edit-kodepos").html($('input[name="kodepos"]').val());
  $(".modal-address").modal("hide");
});

$("#table_id").DataTable({
  ordering: false,
  paging: true,
  searching: true,
  info: true,
  autowidth: false,
});

$("#table-confirmation").DataTable({
  ajax: {
    url: base_url + "member/getSourcing",
    type: "POST",
  },
  drawCallback: function (settings) {
    $("#table-confirmation thead").remove();
  },
  lengthChange: false,
  processing: true,
  serverSide: true,
  // searching: false,
  createdRow: function (row, data, dataIndex) {
    var html = `<div class="d-flex flex-column align-items-start" style="padding: 5px">
                        <p class="fbold f12 m-a-0">ID Order : ${data[0]}</p>
                        <span class="text-muted f12">${data[3]} item</span>
                        <div class="d-flex justify-content-between w-100">
                            <p class="f14 m-a-0">Total</p>
                            <p class="f14 fbold m-a-0">${data[4]}</p>
                        </div>
                    </div>`;
    $(row).html(html);
  },
});

$(document).on("click", ".upload-po-table", function (e) {
  $("input[name='order_id']").val($(this).data("id"));
});
$(document).on("click", ".upload-payment-file", function (e) {
  $("input[name='order_id']").val($(this).data("id"));
});
$(document).on("click", ".order-number-label", function (e) {
  $("input[name='order_id']").val($(this).data("id"));
});

$(document).ready(function () {
  var base_url = $("body").attr("baseurl");
  var id_province = $("select[name=province]").attr("id");
  var id_city = $("select[name=city]").attr("id");
  var id_districts = $("select[name=districts]").attr("id");
  var id_village = $("select[name=village]").attr("id");
  $("select[name=province]").val(id_province);
  $.ajax({
    url: base_url + "general/getwilayahrigences_json?id=" + id_province,
    dataType: "JSON",
    success: function (json) {
      $("select[name=city]").html("");
      for (i in json) {
        var str_select = "";
        if (id_city == json[i].id) {
          str_select = "selected";
        }
        $("select[name=city]").append(
          '<option gfdgd value="' +
            json[i].id +
            '" ' +
            str_select +
            ">" +
            json[i].name +
            "</option>"
        );
      }
      $.ajax({
        url: base_url + "general/getwilayahdistricts_json?id=" + id_city,
        dataType: "JSON",
        success: function (json) {
          $("select[name=districts]").html("");
          for (i in json) {
            var str_select = "";
            if (id_districts == json[i].id) {
              str_select = "selected";
            }
            $("select[name=districts]").append(
              '<option value="' +
                json[i].id +
                '" ' +
                str_select +
                ">" +
                json[i].name +
                "</option>"
            );
          }
          $.ajax({
            url:
              base_url + "general/getwilayahvillages_json?id=" + id_districts,
            dataType: "JSON",
            success: function (json) {
              $("select[name=village]").html("");
              for (i in json) {
                var str_select = "";
                if (id_village == json[i].id) {
                  str_select = "selected";
                }
                $("select[name=village]").append(
                  '<option value="' +
                    json[i].id +
                    '" ' +
                    str_select +
                    ">" +
                    json[i].name +
                    "</option>"
                );
              }
            },
          });
        },
      });
    },
  });

  $('input[name="file_po"]').change(function (e) {
    e.preventDefault();
    var file = this.files[0];
    $(".uploaded-file").html(file.name);
  });
  $('input[name="file_payment"]').change(function (e) {
    e.preventDefault();
    var file = this.files[0];
    $(".uploaded-file").html(file.name);
  });

  $(document).on("change", "select[name=province]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahrigences_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=city]").html("");
        $("select[name=districts]").html("");
        $("select[name=village]").html("");

        for (i in json) {
          var str_select = "";
          $("select[name=city]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=city]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahdistricts_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=districts]").html("");
        $("select[name=village]").html("");
        for (i in json) {
          var str_select = "";
          $("select[name=districts]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=districts]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahvillages_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=village]").html("");
        for (i in json) {
          var str_select = "";
          $("select[name=village]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });
});
var ttt = $("select[name=date]").attr("isvalue");
var bbb = $("select[name=month]").attr("isvalue");
var yyy = $("select[name=year]").attr("isvalue");
$("select[name=date]").val(ttt);
$("select[name=month]").val(bbb);
$("select[name=year]").val(yyy);

$(".show-password").click(function () {
  var checked = $(this).prop("checked");
  if (checked == true) {
    $(".password").attr("type", "text");
  } else {
    $(".password").attr("type", "password");
  }
});
