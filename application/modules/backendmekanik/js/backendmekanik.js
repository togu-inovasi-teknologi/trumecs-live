$(document).ready(function () {
  $(document).on("keyup", "#ee_name_organization", function () {
    $(this).autocomplete({
      source: function (request, response) {
        $.ajax({
          url: base_url + "/backendmekanik/organizationList",
          type: "GET",
          dataType: "json",
          data: { query: request.term },
          success: function (data) {
            response(
              $.map(data, function (item) {
                return {
                  id: item.id,
                  value: item.organization_name,
                  label: item.organization_name,
                };
              })
            );
          },
        });
      },
      select: function (event, ui) {
        $(this).parent().children().eq(2).val(ui.item.id);
        // $(".input_id_organization").val(ui.item.id);
        // console.log($("#ee_id_organization"));
      },
      minLength: 1,
    });
  });
});

$(document).on("change", ".img-input", function () {
  var input = this;
  console.log(input);
  var preview = $(input).siblings(".blah");

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      preview.attr("src", e.target.result).fadeIn(650);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    preview.fadeOut(650);
  }
});

$("#reset").click(function () {
  $(this)
    .closest("form")
    .find("input[type=text], textarea, input[type=file]")
    .val("");
});

$(".add-pv").on("click", function () {
  $(".pv-card").append($(".pv-form").html());
});

$(document).on("click", ".del-pv", function () {
  $(this).parent().parent().remove();
});

$(".add-ee").on("click", function () {
  $(".ee-card").append($(".ee-form").html());
});

$(document).on("click", ".del-ee", function () {
  $(this).parent().parent().remove();
});

$(".add-se").on("click", function () {
  $(".se-card").append($(".se-form").html());
});

$(document).on("click", ".del-se", function () {
  $(this).parent().parent().remove();
});

$(".add-sertificate").on("click", function () {
  $(".sertificate-card").append($(".sertificate-form").html());
});

$(document).on("click", ".del-sertificate", function () {
  $(this).parent().parent().remove();
});

$(".add-gallery").on("click", function () {
  $(".gallery-card").append($(".gallery-form").html());
});

$(document).on("click", ".del-gallery", function () {
  $(this).parent().parent().remove();
});

$(document).ready(function () {
  $(".service-coverage").select2({
    placeholder: "Pilih Provinsi atau Kabupaten",
    ajax: {
      url: base_url + "/backendmekanik/getProvincesAndRegencies",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          term: params.term,
        };
      },
      processResults: function (data) {
        return {
          results: data.results,
        };
      },
    },
  });
});

$(document).ready(function () {
  $("#table-mechanic").DataTable({
    ordering: false,
    paging: true,
    searching: true,
    info: false,
    autowidth: true,
  });
});

$(document).ready(function () {
  $(".product-tag").select2({
    placeholder: "Pilih Keahlian",
  });
});
$(document).ready(function () {
  $(".area").select2({
    placeholder: "Pilih Domisili",
    ajax: {
      url: base_url + "/backendmekanik/getRegenciesJson",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          term: params.term,
        };
      },
      processResults: function (data) {
        return {
          results: data.results,
        };
      },
    },
  });
});