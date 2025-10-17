$(document).on("click", ".btn-name-bussiness", function () {
  $(".edit-name-bussiness").html($('input[name="name"]').val());
  $(".modal-name-bussiness").modal("hide");
});
$(document).on("click", ".btn-domain-bussiness", function () {
  $(".edit-domain-bussiness").html($('input[name="domain"]').val());
  $(".modal-domain-bussiness").modal("hide");
});
$(document).on("click", ".btn-npwp-bussiness", function () {
  $(".edit-npwp-bussiness").html($('input[name="npwp"]').val());
  $(".modal-npwp-bussiness").modal("hide");
});
$(document).on("click", ".btn-email-bussiness", function () {
  $(".edit-email-bussiness").html($('input[name="company_email"]').val());
  $(".modal-email-bussiness").modal("hide");
});
$(document).on("click", ".btn-phone-bussiness", function () {
  $(".edit-phone-bussiness").html($('input[name="company_phone"]').val());
  $(".modal-phone-bussiness").modal("hide");
});
$(document).on("click", ".btn-description-bussiness", function () {
  $(".edit-description-bussiness").html(
    $('textarea[name="description_store"]').val()
  );
  $(".modal-description-bussiness").modal("hide");
});
$(document).on("click", ".btn-pic-bussiness", function () {
  $(".edit-pic-bussiness").html($('input[name="pic"]').val());
  $(".edit-position-bussiness").html($('input[name="position"]').val());
  $(".modal-pic-bussiness").modal("hide");
});
$(document).on("click", ".btn-pic-phone", function () {
  $(".edit-pic-phone").html($('input[name="phone_pic"]').val());
  $(".modal-pic-phone").modal("hide");
});
$(document).on("click", ".btn-address-bussiness", function () {
  $(".edit-address-bussiness").html($('input[name="address"]').val());
  $(".edit-country-bussiness").html(
    jQuery.isNumeric($('select[name="country"]').val())
      ? $('select[name="country"] option:selected').text()
      : ""
  );
  $(".edit-province-bussiness").html(
    jQuery.isNumeric($('select[name="province"]').val())
      ? $('select[name="province"] option:selected').text()
      : ""
  );
  $(".edit-city-bussiness").html(
    jQuery.isNumeric($('select[name="city"]').val())
      ? $('select[name="city"] option:selected').text()
      : ""
  );
  $(".edit-kodepos-bussiness").html($('input[name="zipcode"]').val());
  $(".modal-address-bussiness").modal("hide");
});
$(document).ready(function () {
  var base_url = $("body").attr("baseurl");
  var id_province = $("select[name=province]").attr("id");
  var id_city = $("select[name=city]").attr("id");
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
        },
      });
    },
  });

  $(document).on("change", "select[name=province]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahrigences_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=city]").html("");

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
});
