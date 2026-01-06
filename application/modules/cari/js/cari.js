var base_url = $("body").attr("baseurl");

$(document).ready(function () {
  // Fungsi untuk memuat sub kategori berdasarkan komponen
  function loadSubKategori(componentId, selectedValue = "") {
    if (!componentId || componentId === "" || componentId === "0") {
      $("select[name=sub_kategori]").html(
        '<option value="">-- Semua Subkategori --</option>'
      );
      return;
    }

    $("select[name=sub_kategori]").load(
      base_url + "general/getsubkategori/" + componentId,
      function () {
        if (selectedValue) {
          var optionExists =
            $(this).find('option[value="' + selectedValue + '"]').length > 0;
          if (optionExists) {
            $(this).val(selectedValue);
          } else {
            $(this).val("");
          }
        }
      }
    );
  }

  // Fungsi untuk memuat merek berdasarkan komponen
  function loadMerek(componentId, selectedValue = "") {
    var url = base_url + "general/getmerekall/";
    if (componentId && componentId !== "" && componentId !== "0") {
      url += componentId + "/false";
    } else {
      url += "all/false";
    }

    $("select[name=merek]").load(url, function () {
      if (selectedValue) {
        var optionExists =
          $(this).find('option[value="' + selectedValue + '"]').length > 0;
        if (optionExists) {
          $(this).val(selectedValue);
        } else {
          $(this).val("");
        }
      }
    });
  }

  // Fungsi untuk memuat quality berdasarkan komponen
  function loadQuality(componentId, selectedValue = "") {
    var url = base_url + "general/getgradeall/";
    if (componentId && componentId !== "" && componentId !== "0") {
      url += componentId + "/false";
    } else {
      url += "all/false";
    }

    $("select[name=quality]").load(url, function () {
      if (selectedValue) {
        var optionExists =
          $(this).find('option[value="' + selectedValue + '"]').length > 0;
        if (optionExists) {
          $(this).val(selectedValue);
        } else {
          $(this).val("");
        }
      }
    });
  }

  // LOAD KOMPONEN DULU DENGAN CALLBACK
  $("select[name=komponen]").load(
    base_url + "general/getcomponentall",
    function () {
      console.log("Callback komponen dijalankan");
      console.log("Elemen .form-filter-search:", $(".form-filter-search"));
      console.log(
        "Jumlah elemen .form-filter-search:",
        $(".form-filter-search").length
      );

      // Coba cari di berbagai tempat
      console.log(
        "Attribute dari body:",
        $("body").attr("data-selected-component")
      );
      console.log(
        "Attribute dari form terdekat:",
        $(this).closest("form").attr("data-selected-component")
      );

      var formsearch = $(".form-filter-search");
      if (formsearch.length === 0) {
        // Coba alternatif lain
        formsearch = $(this).closest("form");
        console.log("Mencari form terdekat:", formsearch);
      }

      var seletedbrand = formsearch.attr("data-selected-brand") || "";
      var seletedtype = formsearch.attr("data-selected-type") || "";
      var seletedsub = formsearch.attr("data-selected-sub") || "";
      var seletedcomponent = formsearch.attr("data-selected-component") || "";
      var seletedquality = formsearch.attr("data-selected-quality") || "";

      console.log("component: ", seletedcomponent);
      console.log("brand: ", seletedbrand);
      console.log("sub: ", seletedsub);
      // Set nilai komponen jika ada
      if (seletedcomponent) {
        $(this).val(seletedcomponent); // "this" mengacu pada select[name=komponen]

        // Load data lainnya berdasarkan komponen yang dipilih
        loadSubKategori(seletedcomponent, seletedsub);
        loadMerek(seletedcomponent, seletedbrand);
        loadQuality(seletedcomponent, seletedquality);
      }

      // Set nilai tipe setelah semua selesai
      setTimeout(function () {
        if (seletedtype) {
          $("select[name=tipe]").val(seletedtype);
        }
      }, 300);
    }
  );

  // Load merek untuk opsi default
  $("select[name=merek]").load(base_url + "general/getmerekall/all/false");

  // Event handler untuk perubahan komponen
  $("select[name=komponen]").change(function () {
    var componentId = $(this).val();
    var selectedSub = $(".form-filter-search").attr("data-selected-sub") || "";

    // Load sub kategori, merek, dan quality berdasarkan komponen
    loadSubKategori(componentId, selectedSub);
    loadMerek(
      componentId,
      $(".form-filter-search").attr("data-selected-brand")
    );
    loadQuality(
      componentId,
      $(".form-filter-search").attr("data-selected-quality")
    );
  });

  // Event handler untuk submit form
  $(".apply-filter").click(function (e) {
    e.preventDefault();

    // Pastikan semua select memiliki nilai
    var komponen = $("select[name=komponen]").val() || "";
    var subKategori = $("select[name=sub_kategori]").val() || "";
    var merek = $("select[name=merek]").val() || "";
    var quality = $("select[name=quality]").val() || "";
    var nama = $("input[name=nama]").val() || "";

    // Buat URL dengan parameter
    var url = base_url + "cari?";
    var params = [];

    if (nama) params.push("nama=" + encodeURIComponent(nama));
    if (komponen) params.push("komponen=" + komponen);
    if (subKategori) params.push("sub_kategori=" + subKategori);
    if (merek) params.push("merek=" + merek);
    if (quality) params.push("quality=" + quality);

    // Submit form
    window.location.href = url + params.join("&");
  });
});
