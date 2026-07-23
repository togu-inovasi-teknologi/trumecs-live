$(document).ready(function () {
  var base_url = $("body").attr("baseurl");

  // ========== UTILITY FUNCTION UNTUK PARTIAL MATCH ==========
  function setSelectPartialMatch($select, searchText) {
    if (!searchText || searchText === "") {
      $select.val("");
      return false;
    }

    var matched = false;
    var searchLower = String(searchText).toLowerCase().trim();

    // Try exact match first
    try {
      $select.val(searchText);
      if ($select.val() === searchText) {
        return true;
      }
    } catch (e) {
      console.warn("Error saat set value:", e);
    }

    // Try partial match
    $select.find("option").each(function () {
      var optionText = $(this).text().toLowerCase().trim();
      var optionValue = $(this).val();

      if (optionValue) {
        optionValue = String(optionValue).toLowerCase().trim();
      } else {
        optionValue = "";
      }

      if (
        optionText.indexOf(searchLower) !== -1 ||
        optionValue.indexOf(searchLower) !== -1
      ) {
        $(this).prop("selected", true);
        matched = true;
        console.log("Matched:", $(this).val(), "dengan:", searchText);
        return false;
      }
    });

    if (!matched) {
      $select.val("");
      console.warn("Tidak ditemukan match untuk:", searchText);
    }

    return matched;
  }

  // ========== FUNCTION UNTUK ENCODE PARAMETER URL ==========
  function encodeParam(value) {
    if (!value) return "";
    return encodeURIComponent(value);
  }

  // ========== FUNCTION UNTUK LOAD SELECT DENGAN AJAX ==========
  function loadSelectData(selector, url, attrName, callback) {
    $.ajax({
      url: url,
      type: "GET",
      dataType: "html",
      success: function (response) {
        try {
          $(selector).html(response);
          var searchValue = $(selector).attr(attrName);
          if (searchValue) {
            setSelectPartialMatch($(selector), searchValue);
          }
          if (typeof callback === "function") {
            callback.call($(selector));
          }
        } catch (e) {
          console.error("Error processing response for " + selector + ":", e);
          $(selector).html(
            '<option value="0">-- Error processing data --</option>'
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error loading data from " + url + ":", error);
        console.error("Status:", status);
        console.error("Response:", xhr.responseText);
        $(selector).html('<option value="0">-- Error loading data --</option>');
      },
    });
  }

  // ========== LOAD DATA AWAL ==========
  var jenisProductTar = $("select[name=jenisproduct]").attr("tar") || "";
  var encodedTar = encodeParam(jenisProductTar);

  // Load jenisproduct
  loadSelectData(
    "select[name=jenisproduct]",
    base_url + "general/getcomponentall/back",
    "tar",
    function () {
      // Set select lainnya setelah jenisproduct loaded
      var seletedgrade = $("select[name=quality]").attr("seletedgrade");
      setSelectPartialMatch($("select[name=quality]"), seletedgrade);

      var seletedcomponent = $("select[name=component]").attr(
        "seletedcomponent"
      );
      setSelectPartialMatch($("select[name=component]"), seletedcomponent);

      $(this).trigger("change");
    }
  );

  // Load brand
  loadSelectData(
    "select[name=brand]",
    base_url + "general/getbrandform/" + encodedTar,
    "seletedbrand"
  );

  // Load quality
  loadSelectData(
    "select[name=quality]",
    base_url + "general/getgradeform/" + encodedTar,
    "seletedgrade"
  );

  // Load brand_unit
  loadSelectData(
    "select[name=brand_unit]",
    base_url + "general/getbrandform/117",
    "seletedbrandunit"
  );

  // Load component
  loadSelectData(
    "select[name=component]",
    base_url + "general/getcomponentall_form/" + encodedTar,
    "seletedcomponent"
  );

  // Load area
  loadSelectData(
    "select[name=area]",
    base_url + "general/getareaall",
    "seletedarea"
  );

  // ========== EVENT BRAND UNIT CHANGE ==========
  $("select[name=brand_unit]").change(function (argument) {
    var value = $(this).val();
    if (!value || value === "") return;

    loadSelectData(
      "select[name=type]",
      base_url + "general/gettype/" + encodeParam(value),
      "seletedtype"
    );
  });

  // ========== FUNCTION UNTUK MENGATUR TAMPILAN ==========
  function toggleJenisProductFields(value) {
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

    if (!value || value === "") {
      toggleJenisProductFields(value);
      return;
    }

    var encodedValue = encodeParam(value);

    // Load grade
    loadSelectData(
      "select[name=quality]",
      base_url + "general/getgradeform/" + encodedValue,
      "seletedgrade"
    );

    // Load component
    loadSelectData(
      "select[name=component]",
      base_url + "general/getcomponentall_form/" + encodedValue,
      "seletedcomponent"
    );

    // Load brand
    loadSelectData(
      "select[name=brand]",
      base_url + "general/getbrandform/" + encodedValue,
      "seletedbrand"
    );

    // Load attribute form jika tidak ada ID
    if ($("input[name='id']").length < 1) {
      $.ajax({
        url: base_url + "general/getattributeform/" + encodedValue,
        type: "GET",
        dataType: "html",
        success: function (response) {
          $(".attribute-card").html(response);
        },
        error: function (xhr, status, error) {
          console.error("Error loading attribute form:", error);
        },
      });
    }

    // Panggil function toggle
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

    if (!value || value === "") return;

    var encodedValue = encodeParam(value);

    // Set value ke input hidden dan select
    $(".input_choicejenis").val(value);
    setSelectPartialMatch($("select[name=jenisproduct]"), value);
    $(".pilihjenisproduk").modal("hide");

    // Load grade
    loadSelectData(
      "select[name=quality]",
      base_url + "general/getgradeform/" + encodedValue,
      "seletedgrade"
    );

    // Load brand
    loadSelectData(
      "select[name=brand]",
      base_url + "general/getbrandform/" + encodedValue,
      "seletedbrand"
    );

    // Load component
    loadSelectData(
      "select[name=component]",
      base_url + "general/getcomponentall_form/" + encodedValue,
      "seletedcomponent"
    );

    // Panggil function toggle
    toggleJenisProductFields(value);

    // Load attribute form
    if ($("input[name='id']").length < 1) {
      $.ajax({
        url: base_url + "general/getattributeform/" + encodedValue,
        type: "GET",
        dataType: "html",
        success: function (response) {
          $(".attribute-card").html(response);
        },
        error: function (xhr, status, error) {
          console.error("Error loading attribute form:", error);
        },
      });
    }
  });

  // ========== NESTED DOCUMENT READY UNTUK LOAD DATA EDIT ==========
  $(document).ready(function (argument) {
    var seletedtype = $("select[name=type]").attr("seletedtype");
    var seletedgrade = $("select[name=quality]").attr("seletedgrade");
    setSelectPartialMatch($("select[name=quality]"), seletedgrade);

    var seletedpackagine = $("select[name=packagin]").attr("seletedpackagine");
    setSelectPartialMatch($("select[name=packagin]"), seletedpackagine);

    var seletedarea = $("select[name=area]").attr("seletedarea");
    setSelectPartialMatch($("select[name=area]"), seletedarea);

    if (seletedtype && seletedtype != "") {
      var mustvalue = $("select[name=brand_unit]").attr("seletedbrandunit");
      if (mustvalue) {
        loadSelectData(
          "select[name=type]",
          base_url + "general/gettype/" + encodeParam(mustvalue),
          "seletedtype",
          function () {
            setSelectPartialMatch($(this), seletedtype);
          }
        );
      }
    }

    // Event add attribute
    $(".add-att").on("click", function () {
      $(".attribute-card").append($(".attr-form").html());
    });

    // Event delete attribute
    $(document).on("click", ".del-att", function () {
      $(this).parent().parent().remove();
    });
  });

  // ========== EVENT FILE INPUT ==========
  $("input[type=file]").on("change", function () {
    var str = $(this).val();
    readURL(this);
    $(".file-custom").attr(
      "data-content",
      "..." + str.substring(str.length, str.length - 9)
    );
  });

  // ========== EVENT CHANGE UNTUK UPDATE LABEL ==========
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

  // ========== JQ-MODEL UNTUK PREVIEW ==========
  $("*[jq-model]").on("change", function (argument) {
    var name = $(this).attr("jq-model");
    $('span[js-result="' + name + '"]').text($(this).val());
  });

  // ========== FUNCTION READ URL UNTUK FILE UPLOAD ==========
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

  // ========== TAMPILKAN MODAL JIKA PERLU ==========
  if ($(".pilihjenisproduk").length > 0) {
    $(".pilihjenisproduk").modal("show");
  }
});
