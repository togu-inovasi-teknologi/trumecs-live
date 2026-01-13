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
    var url =
      base_url +
      "c/all/query?q=on&nama=" +
      $("#inputsearch").find("#searchInput").val();
    window.location.href = url;
  }

  $(".inputsearch")
    .find("input[type=text]")
    .on("keydown", function (e) {
      if (e.which == 13) {
        redirectToSearch();
      }
    });

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
