var base_url = $("body").attr("baseurl");

// KODE UTAMA DALAM SATU $(document).ready()
$(document).ready(function () {
  console.log("trumecs.effect.js loaded");

  // Dropdown hover
  $(".dropdown").hover(
    function () {
      $(this).addClass("open");
    },
    function () {
      $(this).removeClass("open");
    }
  );

  // Fungsi search
  function redirectToSearch() {
    var searchInput = $("#searchInput");
    var searchValue = searchInput.val().trim();

    if (searchValue) {
      // Encode untuk URL (penting untuk spasi dan karakter khusus)
      var encodedValue = encodeURIComponent(searchValue);
      var url = base_url + "c/all/query?q=on&nama=" + encodedValue;
      window.location.href = url;
    } else {
      // Optional: Fokus ke input jika kosong
      searchInput.focus();
      // Optional: Tambahkan class untuk feedback visual
      searchInput.addClass("is-invalid");

      // Hapus class invalid setelah 2 detik
      setTimeout(function () {
        searchInput.removeClass("is-invalid");
      }, 2000);
    }
  }

  // Event listener untuk Enter key pada input search
  $("#searchInput").on("keydown", function (e) {
    // Support untuk semua browser (key, keyCode, dan which)
    if (e.key === "Enter" || e.keyCode === 13 || e.which === 13) {
      e.preventDefault(); // Mencegah perilaku default
      redirectToSearch();
    }
  });

  // Event listener untuk search button
  $("#searchbuttontemplate").click(function () {
    redirectToSearch();
  });

  // Remove unwanted scripts
  var telkomspeedy = $('[src*="u-ad.info"]');
  if (telkomspeedy) {
    telkomspeedy.remove();
  }
  $('script:contains("u-ad.info")').remove();

  // Mobile menu collapse
  $(".collapsedecategorymobile").on("shown.bs.collapse", function () {
    $(".hiddenin").css("display", "").not($(this)).fadeOut().removeClass("in");
    $(this).find("li").css("background-color", "rgba(128, 128, 128, 0.22)");
  });

  $(".collapsedecategorymobileprn").click(function (argument) {
    $(".active").toggleClass("active");
    $(this).toggleClass("active");
  });

  $(".showsearchmobile").click(function (argument) {
    $(".inputsearch")
      .toggleClass("hidden-xs-up")
      .find("input[type=text]")
      .focus();
    $(".hidesearch").toggleClass("hidden-xs-up");
  });

  $(document).on("blur", ".searchmobile", function (argument) {
    $(".hidesearch").toggleClass("hidden-xs-up");
    $(".inputsearch").toggleClass("hidden-xs-up");
  });

  $(".list_brand_category").css("display", "inline");

  // Modal processing
  $(document).on("click", ".proccessshow", function (e) {
    e.preventDefault();
    var form = $(this).parents("form");
    var modalmustshow = $(".modalproccessshow");
    modalmustshow.modal("show");
    var detectvalue = 0;
    var text = $(this).attr("modal-text");
    if (text != "") {
      $(".modal-text").html(text);
    }
    if (form.length != 0) {
      form.find("input").each(function () {
        if ($(this).prop("required")) {
          if ($(this).val() == "") {
            detectvalue = detectvalue + 1;
            return false;
          }
        }
      });
      if (detectvalue >= 1) {
        modalmustshow.modal("toggle");
      }
    } else {
      $(".modalproccessshow").modal("show");
      var text = $(this).attr("modal-text");
      if (text != "") {
        $(".modal-text").html(text);
      }
    }
  });

  // Popup
  if ($(".popup-check").data("popup") == true) {
    now = new Date();
    now = now.getTime();
    last =
      localStorage.getItem("popTime") != ""
        ? localStorage.getItem("popTime")
        : 0;
    if (now - last >= 3600000) {
      $(".popup_spadukbig").modal("show");
      localStorage.setItem("popTime", now);
    }
  }

  $(document).on("click", ".closemodalpopup_spadukbig", function (e) {
    $(".popup_spadukbig").modal("hide");
  });

  $(document).on("click", ".close_alert", function (e) {
    e.preventDefault();
  });

  $(".popup").on("close.bs.alert", function () {
    var session = $(this).attr("session");
    var sessionval = $(this).attr("sessionval");
    var url = base_url + "general/addsession/" + session + "/" + sessionval;
    $.post(url, function (data) {});
  });

  $(".fadeslidebig").fadeIn("fast");

  // Mask input uang
  $(".uang").mask("000.000.000.000.000.000", {
    reverse: true,
  });

  // Sidebar collapse
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });

  console.log("All JavaScript initialized");
}); // END OF $(document).ready()
