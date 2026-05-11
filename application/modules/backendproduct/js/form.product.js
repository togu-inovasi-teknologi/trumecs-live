$(document).ready(function () {
  var base_url = $("body").attr("baseurl");

  // ========== LOAD DATA AWAL ==========
  $("select[name=jenisproduct]").load(
    base_url + "general/getcomponentall/back",
    function (argument) {
      var mustvalue = $(this).attr("tar");
      $(this).val(mustvalue);
      var seletedgrade = $("select[name=quality]").attr("seletedgrade");
      $("select[name=quality]").val(seletedgrade);
      var seletedcomponent = $("select[name=component]").attr(
        "seletedcomponent"
      );
      $("select[name=component]").val(seletedcomponent);

      // 🔥 TRIGGER CHANGE SETELAH LOAD UNTUK MENGATUR TAMPILAN
      $(this).trigger("change");
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

  // ========== EVENT BRAND UNIT CHANGE ==========
  $("select[name=brand_unit]").change(function (argument) {
    var value = $(this).val();
    $("select[name=type]").load(
      base_url + "general/gettype/" + value,
      function (argument) {}
    );
  });

  // ========== FUNCTION UNTUK MENGATUR TAMPILAN ==========
  function toggleJenisProductFields(value) {
    console.log("Toggle untuk value:", value); // Debug

    if (value == "Sparepart" || value == "Aksesoris") {
      $("select[name='brand_unit']").prop("disabled", false);
      $("select[name='type']").prop("disabled", false);
      $(".attr-unit").show();
      $(".attr-unit-fisik").hide();
      console.log("Mode: Sparepart/Aksesoris - attr-unit tampil");
    } else if (value == "Unit") {
      $("select[name='brand_unit']").prop("disabled", false);
      $("select[name='type']").prop("disabled", false);
      $(".attr-unit").hide();
      $(".attr-unit-fisik").show();
      console.log("Mode: Unit - attr-unit-fisik tampil");
    } else {
      $("select[name='brand_unit']").prop("disabled", true);
      $("select[name='type']").prop("disabled", true);
      $(".attr-unit").hide();
      $(".attr-unit-fisik").hide();
      console.log("Mode: Lainnya - semua hidden");
    }
  }

  // ========== EVENT JENISPRODUCT CHANGE ==========
  $("select[name=jenisproduct]").change(function (argument) {
    var value = $(this).val();
    console.log("Jenis produk berubah menjadi:", value);

    // Load grade
    $("select[name=quality]").load(
      base_url + "general/getgradeform/" + value,
      function (argument) {
        if (
          $(this).find("option[value='" + $(this).attr("seletedgrade") + "']")
            .length > 0
        ) {
          $(this).val($(this).attr("seletedgrade"));
        } else {
          $(this).val("");
        }
      }
    );

    // Load component
    $("select[name=component]").load(
      base_url + "general/getcomponentall_form/" + value,
      function (argument) {
        if (
          $(this).find(
            "option[value='" + $(this).attr("seletedcomponent") + "']"
          ).length > 0
        ) {
          $(this).val($(this).attr("seletedcomponent"));
        } else {
          $(this).val("");
        }
      }
    );

    // Load brand
    $("select[name=brand]").load(
      base_url + "general/getbrandform/" + value,
      function (argument) {
        if (
          $(this).find("option[value='" + $(this).attr("seletedbrand") + "']")
            .length > 0
        ) {
          $(this).val($(this).attr("seletedbrand"));
        } else {
          $(this).val("");
        }
      }
    );

    // Load attribute form jika tidak ada ID
    if ($("input[name='id']").length < 1) {
      $(".attribute-card").load(base_url + "general/getattributeform/" + value);
    }

    // 🔥 PANGGIL FUNCTION TOGGLE
    toggleJenisProductFields(value);
  });

  // ========== INITIAL TOGGLE BERDASARKAN VALUE SAAT INI ==========
  var initialValue = $("select[name=jenisproduct]").val();
  console.log("Initial value jenisproduct:", initialValue);

  if (initialValue && initialValue != "") {
    toggleJenisProductFields(initialValue);
  } else {
    // Sembunyikan semua dulu
    $(".attr-unit").hide();
    $(".attr-unit-fisik").hide();
  }

  // ========== EVENT UNTUK CHOICE JENIS (MODAL) ==========
  $(document).on("click", ".choicejenis", function (e) {
    var value = $(this).attr("val");
    console.log("Choice jenis dipilih:", value);

    // Set value ke select
    $(".input_choicejenis").val(value);
    $("select[name=jenisproduct]").val(value);
    $(".pilihjenisproduk").modal("hide");

    // Load data
    $("select[name=quality]").load(
      base_url + "general/getgradeform/" + value,
      function (argument) {}
    );

    $("select[name=brand]").load(
      base_url + "general/getbrandform/" + value,
      function (argument) {}
    );

    $("select[name=component]").load(
      base_url + "general/getcomponentall_form/" + value,
      function (argument) {}
    );

    // 🔥 PANGGIL FUNCTION TOGGLE
    toggleJenisProductFields(value);

    // Load attribute form
    if ($("input[name='id']").length < 1) {
      $(".attribute-card").load(base_url + "general/getattributeform/" + value);
    }
  });

  // ========== REST OF YOUR CODE ==========
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

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(".blah").attr("src", e.target.result).removeClass("d-none");
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file").on("change", function () {
    readURL(this);
  });

  // Tampilkan modal jika perlu
  if ($(".pilihjenisproduk").length > 0) {
    $(".pilihjenisproduk").modal("show");
  }
});
