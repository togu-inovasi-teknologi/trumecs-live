$(document).ready(function () {
  $(".catalog").each(function (index, element) {
    var categoryId = $(element).children("input[name='category_id']").val();

    // Initialize the DataTable with the corresponding id
    $("#datatable-product-" + categoryId).DataTable({
      responsive: true,
      columnDefs: [
        {
          targets: [1, 2, 3],
          className: "dt-head-center",
        },
      ],
      // ajax: {
      //   url: base_url + "/store/getProducts",
      //   type: "POST",
      //   data: { categoryId: categoryId },
      // },
      // processing: true,
      // serverSide: true,
      // // Add other DataTable options as needed
    });
  });
  $(".catalog").each(function (index, element) {
    var categoryId = $(element).children("input[name='category_id']").val();

    // Initialize the DataTable with the corresponding id
    $("#datatable-product-mobile-" + categoryId).DataTable({
      responsive: true,
      columnDefs: [
        {
          targets: [1],
          className: "dt-head-center",
        },
      ],
      // ajax: {
      //   url: base_url + "/store/getProducts",
      //   type: "POST",
      //   data: { categoryId: categoryId },
      // },
      // processing: true,
      // serverSide: true,
      // // Add other DataTable options as needed
    });
  });
  $("#slick-mobile").slick({
    arrows: true,
    autoplay: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 1,
    speed: 200,
    dots: true,
    infinite: true,
    cssEase: "linear",
    prevArrow: ".prev",
    nextArrow: ".next",
  });

  $(document).ready(function () {
    $(".read-more-btn").click(function () {
      const fullContext = $(this).parent().find(".full-description");
      const lessContext = $(this).parent().find(".less-description");

      if (fullContext.css("display") === "none") {
        fullContext.css("display", "block");
        lessContext.css("display", "none");
        $(this).text("Lihat lebih sedikit");
      } else {
        fullContext.css("display", "none");
        lessContext.css("display", "block");
        $(this).text("Lihat selengkapnya");
      }
    });
    $("#sph-bazaar").click(function(){
      $("#form-bazaar").trigger("reset");
      $("#modal-bazaar").modal("show");
  });
  });

  // $(".catalog").each(function (i, val) {
  //   var category_id = $(this).children("input[name='category_id']").val();

  //   datatableInit($(this).children(".datatable"), "", category_id);
  // });

  // $(".search-datatable").keyup(function (e) {
  //   e.preventDefault();

  //   var category_id = $(this).data("search_id");

  //   var id = `#id_datatable_${category_id}`;

  //   var element = $(id);

  //   datatableDestroy(element);

  //   datatableInit(element, $(this).val(), category_id);
  // });

  // function datatableInit(element, search, categoryId) {
  //   var url = $(location).attr("href");
  //   var segments = url.split("/");
  //   var nameStore = segments[3];

  //   var dataToRequest = {
  //     where: {
  //       component: categoryId,
  //     },
  //   };

  //   if (search != "") {
  //     dataToRequest.search = {
  //       value: search,
  //     };
  //   }

  //   var table = element.DataTable({
  //     ajax: {
  //       url: base_url + nameStore + "/getProducts",
  //       type: "POST",
  //       data: dataToRequest,
  //     },
  //     columnDefs: [
  //       // {
  //       //   targets: 0,
  //       //   visible: false,
  //       // },
  //       {
  //         targets: 3,
  //         className: "text-center",
  //       },
  //       // {
  //       //   targets: 4,
  //       //   className: "text-right",
  //       // },
  //       // {
  //       //   targets: 5,
  //       //   className: "text-center",
  //       // },
  //       // {
  //       //   targets: [3, 4, 5],
  //       //   className: "dt-head-center",
  //       // },
  //     ],
  //     orderClasses: false,
  //     searching: false,
  //     lengthChange: true,
  //     processing: true,
  //     serverSide: true,
  //   });
  //   console.log(table);
  //   table.on("click", "tbody tr", function () {
  //     // console.log(table.row(this));
  //     // let data = table.row(this).data();
  //     // var id = data[0];
  //     // str = data[1].replace(/\s+/g, '-').toLowerCase();
  //     // redirect = base_url + 'product/' + id + '/' + str;
  //     // window.location.href = redirect;
  //   });
  // }

  // function datatableDestroy(element) {
  //   // console.log(element.DataTable());
  //   element.empty();
  //   element.DataTable().destroy();
  // }
  // $("#slick >  *.slick-slide").hide();
});
var baseurl = $("body").attr("baseurl");

/*
var one_detect=1;
/*do{
    var ifi = $(".sv_menu_center a.m"+one_detect).hasClass( "m"+one_detect);
    one_detect++;                    
}while(ifi);*/
/*one_detect=$(".sv_menu_center a").length;


var show_menu=4,
_front=1,
_end=one_detect+4;
btn_menu_front = 1,
btn_menu_back=show_menu;


for (i = 1; i<= show_menu; i++) {
    $(".sv_menu_center a.m"+i).clone().appendTo(".menu_center");                        
    $(".sv_menu_center a.m"+i).remove();
};
$("._after").click(function() {
    if (_end!=btn_menu_back) {
        $("li.menu_center a.m"+btn_menu_front).clone().prependTo( ".sv_menu_center" );                        
        $("li.menu_center a.m"+btn_menu_front).toggleClass("m"+btn_menu_front).fadeIn().remove();
        btn_menu_front=btn_menu_front+1;
        btn_menu_back=btn_menu_back+1;
        $(".sv_menu_center a.m"+btn_menu_back).clone().appendTo(".menu_center"); 
        $(".sv_menu_center a.m"+btn_menu_back).remove();
    };
});
$("._before").click(function() {
    if (_front!=btn_menu_front) {
        $("li.menu_center a.m"+btn_menu_back).clone().prependTo( ".sv_menu_center" );                        
        $("li.menu_center a.m"+btn_menu_back).toggleClass("m"+btn_menu_back).fadeIn().remove();
        btn_menu_front=btn_menu_front-1;
        $(".sv_menu_center a.m"+btn_menu_front).clone().prependTo(".menu_center"); 
        $(".sv_menu_center a.m"+btn_menu_front).remove();
        btn_menu_back=btn_menu_back-1;
    };
});*/

$(".dropdown").hover(
  function () {
    $(this).addClass("open");
  },
  function () {
    $(this).removeClass("open");
  }
);

function redirectToSearch() {
  var url =
    baseurl +
    "c/all/query?q=on&nama=" +
    $(".inputsearch").find("input[type=text]").val();
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

$('[data-toggle="popover"]').popover();
$('[role="tablist"]').tab();
//$('.carousel').carousel();

jQuery(document).ready(function ($) {
  var telkomspeedy = $('[src*="u-ad.info"]');
  if (telkomspeedy) {
    telkomspeedy.remove();
  }
  $('script:contains("u-ad.info")').remove();
});
//$("#js-mobile-offcanvas").trigger("offcanvas.toggle");

$(".collapsedecategorymobile").on("shown.bs.collapse", function () {
  $(".hiddenin").css("display", "").not($(this)).fadeOut().removeClass("in");
  $(this).find("li").css("background-color", "rgba(128, 128, 128, 0.22)");
});
$(".collapsedecategorymobile").on("hidden.bs.collapse", function () {});
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

$(".carousel").carousel();

// $(".list_brand_category").slick({
//   arrows: true,
//   variableWidth: true,
//   autoplay: true,
//   dots: false,
//   speed: 700,
//   centerMode: false,
//   focusOnSelect: true,
// });

/*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56495e0a06a71074263bdb3a/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();*/

/*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bd17d8519b86b5920c0d775/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();*/

/* var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c176e7d82491369ba9e678d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
 */

$(".list_brand_category").css("display", "inline");

$(document)
  .on("click", ".proccessshow", function (e) {
    e.isDefaultPrevented();
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
  })
  .delay(5000);

$(document).ready(function (e) {
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
});
$(document).on("click", ".closemodalpopup_spadukbig", function (e) {
  $(".popup_spadukbig").modal("hide");
});
$(document).on("click", ".close_alert", function (e) {
  e.preventDefault();
});

$(".popup").on("close.bs.alert", function () {
  var session = $(this).attr("session");
  var sessionval = $(this).attr("sessionval");
  var url = baseurl + "general/addsession/" + session + "/" + sessionval;
  $.post(url, function (data) {});
});
$(".fadeslidebig").fadeIn("fast");
// $(".fadeslidebig").slick({
//   arrows: false,
//   autoplay: true,
//   autoplaySpeed: 5000,
//   slidesToShow: 1,
// });

/*$(".btn-copytext").on("click",function(event) {
    var copytext= $(this);
    copytext.find("textarea").val().select();
    try {
        var successful = copytext.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy');
    }
});*/

$(document).ready(function () {
  $(".uang").mask("000.000.000.000.000.000", {
    reverse: true,
  });
});

$(document).ready(function () {
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });
});