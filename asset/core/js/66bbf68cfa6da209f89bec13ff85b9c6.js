var base_url = $("body").attr("baseurl");
$("select[name=jenisproduct]").load(
  base_url + "general/getcomponentall/back",
  function (argument) {
    var mustvalue = $(this).attr("tar");
    $(this).val(mustvalue);
    var seletedgrade = $("select[name=quality]").attr("seletedgrade");
    $("select[name=quality]").val(seletedgrade);
    var seletedcomponent = $("select[name=component]").attr("seletedcomponent");
    $("select[name=component]").val(seletedcomponent);
  }
);
$("select[name=brand]").load(
  base_url +
    "general/getbrandform/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedbrand");
    $(this).val(mustvalue);
  }
);
$("select[name=quality]").load(
  base_url +
    "general/getgradeform/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedgrade");
    $(this).val(mustvalue);
  }
);
$("select[name=brand_unit]").load(
  base_url + "general/getbrandform/117",
  function (argument) {
    var mustvalue = $(this).attr("seletedbrandunit");
    $(this).val(mustvalue);
  }
);
$("select[name=component]").load(
  base_url +
    "general/getcomponentall_form/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedcomponent");
    $(this).val(mustvalue);
  }
);
$("select[name=area]").load(
  base_url + "general/getareaall",
  function (argument) {
    var mustvalue = $(this).attr("seletedarea");
    $(this).val(mustvalue);
  }
);

$("select[name=brand_unit]").change(function (argument) {
  var value = $(this).val();
  $("select[name=type]").load(
    base_url + "general/gettype/" + value,
    function (argument) {}
  );
});

$("select[name=jenisproduct]").change(function (argument) {
  var value = $(this).val();
  $("select[name=quality]").load(
    base_url + "general/getgradeform/" + value,
    function (argument) {
      if (
        $(
          "select[name=quality] option[value='" +
            $(this).attr("seletedgrade") +
            "']"
        ).length > 0
      ) {
        $(this).val($(this).attr("seletedgrade"));
      } else {
        $(this).val("0");
      }
    }
  );
  $("select[name=component]").load(
    base_url + "general/getcomponentall_form/" + value,
    function (argument) {
      if (
        $(
          "select[name=component] option[value='" +
            $(this).attr("seletedcomponent") +
            "']"
        ).length > 0
      ) {
        $(this).val($(this).attr("seletedcomponent"));
      } else {
        $(this).val("0");
      }
    }
  );
  $("select[name=brand]").load(
    base_url + "general/getbrandform/" + value,
    function (argument) {
      if (
        $(
          "select[name=brand] option[value='" +
            $(this).attr("seletedcomponent") +
            "']"
        ).length > 0
      ) {
        $(this).val($(this).attr("seletedproduct"));
      } else {
        $(this).val("");
      }
    }
  );

  if ($("input[name='id']").size() < 1) {
    $(".attribute-card").load(base_url + "general/getattributeform/" + value);
  }

  if (value == "Sparepart" || value == "Aksesoris") {
    $("select[name='brand_unit']").attr({ disabled: false });
    $("select[name='type']").attr({ disabled: false });
    $(".attr-unit").show();
  } else {
    $("select[name='brand_unit']").attr({ disabled: true });
    $("select[name='type']").attr({ disabled: true });
    $(".attr-unit").hide();
  }
});

if (
  $("select[name=jenisproduct]").attr("tar") == "Sparepart" ||
  $("select[name=jenisproduct]").attr("tar") == "Aksesoris"
) {
  $("select[name='brand_unit']").attr({ disabled: false });
  $("select[name='type']").attr({ disabled: false });
  $(".attr-unit").show();
} else {
  $("select[name='brand_unit']").attr({ disabled: true });
  $("select[name='type']").attr({ disabled: true });
  $(".attr-unit").hide();
}

$(document).ready(function (argument) {
  var seletedtype = $("select[name=type]").attr("seletedtype");

  var seletedgrade = $("select[name=quality]").attr("seletedgrade");
  $("select[name=quality]").val(seletedgrade);

  var seletedpackagine = $("select[name=packagin]").attr("seletedpackagine");
  $("select[name=packagin]").val(seletedpackagine);

  var seletedarea = $("select[name=area]").attr("seletedarea");
  $("select[name=area]").val(seletedarea);

  if (seletedtype != "") {
    var mustvalue = $("select[name=brand_unit]").attr("seletedbrandunit");
    $("select[name=type]").load(
      base_url + "general/gettype/" + mustvalue,
      function (argument) {
        $(this).val(seletedtype);
      }
    );
  }

  $(".add-att").on("click", function () {
    $(".attribute-card").append($(".attr-form").html());
  });

  $(document).on("click", ".del-att", function () {
    $(this).parent().parent().remove();
  });
});

$("input[type=file]").on("change", function () {
  var str = $(this).val();
  readURL(this);
  $(".file-custom").attr(
    "data-content",
    "..." + str.substring(str.length, str.length - 9)
  );
});

$("select[name=brand]").on("change", function () {
  $("#changemerek").html($(this).find("option:selected").text());
});
$("select[name=type]").on("change", function () {
  $("#changetipe").html($(this).find("option:selected").text());
});
$("select[name=component]").on("change", function () {
  $("#changekomponent").html($(this).find("option:selected").text());
});
$("select[name=quality]").on("change", function () {
  $("#changequality").html($(this).find("option:selected").text());
});
$("select[name=packagin]").on("change", function () {
  $("#changepackagin").html($(this).find("option:selected").text());
});

$("*[jq-model]").on("change", function (argument) {
  var name = $(this).attr("jq-model");
  $('span[js-result="' + name + '"]').text($(this).val());
});

$(document).ready(function () {
  setTimeout(function () {
    var formsearch = $(".form-filter-search");
    var seletedbrand = formsearch.attr("seletedbrand");
    var seletedtype = formsearch.attr("seletedtype");
    var seletedcomponent = formsearch.attr("seletedcomponent");
    // console.log($("select[name=brand]").val();
    if ($("select[name=brand]").val() != "") {
      $("#changemerek").html(
        $("select[name=brand]").find("option:selected").text()
      );
      $("#changetipe").html(
        $("select[name=type]").find("option:selected").text()
      );
      $("#changekomponent").html(
        $("select[name=component]").find("option:selected").text()
      );
    } else {
      $("#changemerek").html("");
      $("#changetipe").html($(this).find("option:selected").text());
      $("#changekomponent").html($(this).find("option:selected").text());
    }
    setTimeout(function () {
      if (seletedtype != "") {
        $("select[name=tipe]").val(seletedtype);
      }
    }, 2000);
    if (seletedcomponent != "") {
      $("select[name=komponen]").val(seletedcomponent);
    }
  }, 2000);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(".blah").attr("src", e.target.result).removeClass("d-none");
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Event handler di dalam document ready
$(document).ready(function () {
  $("#file").on("change", function () {
    readURL(this); // Sekarang bisa diakses
  });
});

$(document).ready(function () {
  $(".pilihjenisproduk").modal("show");
  $("select[name=jenisproduct]").val(
    $("select[name=jenisproduct]").attr("tar")
  );
});
$(document).on("click", ".choicejenis", function (e) {
  $(".input_choicejenis").val($(this).attr("val"));
  $(".pilihjenisproduk").modal("hide");
  $("select[name=quality]").load(
    base_url + "general/getgradeform/" + $(this).attr("val"),
    function (argument) {}
  );
  $("select[name=brand]").load(
    base_url + "general/getbrandform/" + $(this).attr("val"),
    function (argument) {}
  );
  //$("select[name=quality]").val(seletedgrade);
  $("select[name=component]").load(
    base_url + "general/getcomponentall_form/" + $(this).attr("val"),
    function (argument) {}
  );
  if (
    $(this).attr("val") == "Sparepart" ||
    $(this).attr("val") == "Aksesoris"
  ) {
    $("select[name='brand_unit']").attr({ disabled: false });
    $("select[name='type']").attr({ disabled: false });
    $(".attr-unit").show();
  } else {
    $("select[name='brand_unit']").attr({ disabled: true });
    $("select[name='type']").attr({ disabled: true });
    $(".attr-unit").hide();
  }

  if ($("input[name='id']").length < 1) {
    $(".attribute-card").load(
      base_url + "general/getattributeform/" + $(this).attr("val")
    );
  }
});
