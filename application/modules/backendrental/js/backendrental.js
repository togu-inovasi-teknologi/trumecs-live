var base_url = $("body").attr("baseurl");
$(document).ready(function () {
  $("#table-rental").DataTable({
    ordering: false,
    paging: true,
    searching: true,
    info: false,
    autowidth: true,
  });
});

$(document).on("change", ".img-input", function () {
  var input = this;
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

$(".add-pa").on("click", function () {
  $(".pa-card").append($(".pa-form").html());
});

$(document).on("click", ".del-pa", function () {
  $(this).parent().parent().remove();
});

$(".add-gallery").on("click", function () {
  $(".gallery-card").append($(".gallery-form").html());
});

$(document).on("click", ".del-gallery", function () {
  $(this).parent().parent().remove();
});

$(document).ready(function () {
  $(document).on("keyup", "#pa_name", function () {
    $(this).autocomplete({
      source: function (request, response) {
        $.ajax({
          url: base_url + "/backendrental/attributeList",
          type: "GET",
          dataType: "json",
          data: { query: request.term },
          success: function (data) {
            response(
              $.map(data, function (item) {
                return {
                  label: item.name,
                  value: item.name,
                  id: item.id,
                };
              })
            );
          },
        });
      },
      select: function (event, ui) {
        $(this).parent().children().eq(2).val(ui.item.id);
      },
      minLength: 1,
    });
  });
});

$(document).ready(function () {
  $(".area").select2({
    placeholder: "Pilih Domisili Unit",
    ajax: {
      url: base_url + "/backendrental/getRegenciesJson",
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
  $(".brand").select2({
    placeholder: "Pilih Brand",
    ajax: {
      url: base_url + "/backendrental/getBrandJson",
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
  var value = parseInt($("#rent_time_unit").find(":selected").val(), 10);
  var timeUnit = value === 0 ? "Jam" : "Hari";
  $("#val_rent_time_unit").text(timeUnit);
  $("#val_rent_time_unit1").text(timeUnit);

  $("#rent_time_unit").on("change", function () {
    var rent_time_unit = parseInt($(this).val(), 10);
    var timeUnit = rent_time_unit === 0 ? "Jam" : "Hari";
    $("#val_rent_time_unit").text(timeUnit);
    $("#val_rent_time_unit1").text(timeUnit);
  });
});