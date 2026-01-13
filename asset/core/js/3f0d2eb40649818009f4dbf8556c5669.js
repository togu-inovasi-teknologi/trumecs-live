!function(e){"use strict";function t(e,t){if(this.createTextRange){var a=this.createTextRange();a.collapse(!0),a.moveStart("character",e),a.moveEnd("character",t-e),a.select()}else this.setSelectionRange&&(this.focus(),this.setSelectionRange(e,t))}function a(e){var t=this.value.length;if(e="start"==e.toLowerCase()?"Start":"End",document.selection){var a,i,n,l=document.selection.createRange();return a=l.duplicate(),a.expand("textedit"),a.setEndPoint("EndToEnd",l),i=a.text.length-l.text.length,n=i+l.text.length,"Start"==e?i:n}return"undefined"!=typeof this["selection"+e]&&(t=this["selection"+e]),t}var i={codes:{46:127,188:44,109:45,190:46,191:47,192:96,220:92,222:39,221:93,219:91,173:45,187:61,186:59,189:45,110:46},shifts:{96:"~",49:"!",50:"@",51:"#",52:"$",53:"%",54:"^",55:"&",56:"*",57:"(",48:")",45:"_",61:"+",91:"{",93:"}",92:"|",59:":",39:'"',44:"<",46:">",47:"?"}};e.fn.number=function(n,l,s,r){r="undefined"==typeof r?",":r,s="undefined"==typeof s?".":s,l="undefined"==typeof l?0:l;var u="\\u"+("0000"+s.charCodeAt(0).toString(16)).slice(-4),h=new RegExp("[^"+u+"0-9]","g"),o=new RegExp(u,"g");return n===!0?this.is("input:text")?this.on({"keydown.format":function(n){var u=e(this),h=u.data("numFormat"),o=n.keyCode?n.keyCode:n.which,c="",v=a.apply(this,["start"]),d=a.apply(this,["end"]),p="",f=!1;if(i.codes.hasOwnProperty(o)&&(o=i.codes[o]),!n.shiftKey&&o>=65&&90>=o?o+=32:!n.shiftKey&&o>=69&&105>=o?o-=48:n.shiftKey&&i.shifts.hasOwnProperty(o)&&(c=i.shifts[o]),""==c&&(c=String.fromCharCode(o)),8!=o&&45!=o&&127!=o&&c!=s&&!c.match(/[0-9]/)){var g=n.keyCode?n.keyCode:n.which;if(46==g||8==g||127==g||9==g||27==g||13==g||(65==g||82==g||80==g||83==g||70==g||72==g||66==g||74==g||84==g||90==g||61==g||173==g||48==g)&&(n.ctrlKey||n.metaKey)===!0||(86==g||67==g||88==g)&&(n.ctrlKey||n.metaKey)===!0||g>=35&&39>=g||g>=112&&123>=g)return;return n.preventDefault(),!1}if(0==v&&d==this.value.length?8==o?(v=d=1,this.value="",h.init=l>0?-1:0,h.c=l>0?-(l+1):0,t.apply(this,[0,0])):c==s?(v=d=1,this.value="0"+s+new Array(l+1).join("0"),h.init=l>0?1:0,h.c=l>0?-(l+1):0):45==o?(v=d=2,this.value="-0"+s+new Array(l+1).join("0"),h.init=l>0?1:0,h.c=l>0?-(l+1):0,t.apply(this,[2,2])):(h.init=l>0?-1:0,h.c=l>0?-l:0):h.c=d-this.value.length,h.isPartialSelection=v==d?!1:!0,l>0&&c==s&&v==this.value.length-l-1)h.c++,h.init=Math.max(0,h.init),n.preventDefault(),f=this.value.length+h.c;else if(45!=o||0==v&&0!=this.value.indexOf("-"))if(c==s)h.init=Math.max(0,h.init),n.preventDefault();else if(l>0&&127==o&&v==this.value.length-l-1)n.preventDefault();else if(l>0&&8==o&&v==this.value.length-l)n.preventDefault(),h.c--,f=this.value.length+h.c;else if(l>0&&127==o&&v>this.value.length-l-1){if(""===this.value)return;"0"!=this.value.slice(v,v+1)&&(p=this.value.slice(0,v)+"0"+this.value.slice(v+1),u.val(p)),n.preventDefault(),f=this.value.length+h.c}else if(l>0&&8==o&&v>this.value.length-l){if(""===this.value)return;"0"!=this.value.slice(v-1,v)&&(p=this.value.slice(0,v-1)+"0"+this.value.slice(v),u.val(p)),n.preventDefault(),h.c--,f=this.value.length+h.c}else 127==o&&this.value.slice(v,v+1)==r?n.preventDefault():8==o&&this.value.slice(v-1,v)==r?(n.preventDefault(),h.c--,f=this.value.length+h.c):l>0&&v==d&&this.value.length>l+1&&v>this.value.length-l-1&&isFinite(+c)&&!n.metaKey&&!n.ctrlKey&&!n.altKey&&1===c.length&&(p=d===this.value.length?this.value.slice(0,v-1):this.value.slice(0,v)+this.value.slice(v+1),this.value=p,f=v);else n.preventDefault();f!==!1&&t.apply(this,[f,f]),u.data("numFormat",h)},"keyup.format":function(i){var n,s=e(this),r=s.data("numFormat"),u=i.keyCode?i.keyCode:i.which,h=a.apply(this,["start"]),o=a.apply(this,["end"]);0!==h||0!==o||189!==u&&109!==u||(s.val("-"+s.val()),h=1,r.c=1-this.value.length,r.init=1,s.data("numFormat",r),n=this.value.length+r.c,t.apply(this,[n,n])),""===this.value||(48>u||u>57)&&(96>u||u>105)&&8!==u&&46!==u&&110!==u||(s.val(s.val()),l>0&&(r.init<1?(h=this.value.length-l-(r.init<0?1:0),r.c=h-this.value.length,r.init=1,s.data("numFormat",r)):h>this.value.length-l&&8!=u&&(r.c++,s.data("numFormat",r))),46!=u||r.isPartialSelection||(r.c++,s.data("numFormat",r)),n=this.value.length+r.c,t.apply(this,[n,n]))},"paste.format":function(t){var a=e(this),i=t.originalEvent,n=null;return window.clipboardData&&window.clipboardData.getData?n=window.clipboardData.getData("Text"):i.clipboardData&&i.clipboardData.getData&&(n=i.clipboardData.getData("text/plain")),a.val(n),t.preventDefault(),!1}}).each(function(){var t=e(this).data("numFormat",{c:-(l+1),decimals:l,thousands_sep:r,dec_point:s,regex_dec_num:h,regex_dec:o,init:this.value.indexOf(".")?!0:!1});""!==this.value&&t.val(t.val())}):this.each(function(){var t=e(this),a=+t.text().replace(h,"").replace(o,".");t.number(isFinite(a)?+a:0,l,s,r)}):this.text(e.number.apply(window,arguments))};var n=null,l=null;e.isPlainObject(e.valHooks.text)?(e.isFunction(e.valHooks.text.get)&&(n=e.valHooks.text.get),e.isFunction(e.valHooks.text.set)&&(l=e.valHooks.text.set)):e.valHooks.text={},e.valHooks.text.get=function(t){var a,i=e(t),l=i.data("numFormat");return l?""===t.value?"":(a=+t.value.replace(l.regex_dec_num,"").replace(l.regex_dec,"."),(0===t.value.indexOf("-")?"-":"")+(isFinite(a)?a:0)):e.isFunction(n)?n(t):void 0},e.valHooks.text.set=function(t,a){var i=e(t),n=i.data("numFormat");if(n){var s=e.number(a,n.decimals,n.dec_point,n.thousands_sep);return e.isFunction(l)?l(t,s):t.value=s}return e.isFunction(l)?l(t,a):void 0},e.number=function(e,t,a,i){i="undefined"==typeof i?"1000"!==new Number(1e3).toLocaleString()?new Number(1e3).toLocaleString().charAt(1):"":i,a="undefined"==typeof a?new Number(.1).toLocaleString().charAt(1):a,t=isFinite(+t)?Math.abs(t):0;var n="\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4),l="\\u"+("0000"+i.charCodeAt(0).toString(16)).slice(-4);e=(e+"").replace(".",a).replace(new RegExp(l,"g"),"").replace(new RegExp(n,"g"),".").replace(new RegExp("[^0-9+-Ee.]","g"),"");var s=isFinite(+e)?+e:0,r="",u=function(e,t){return""+ +(Math.round((""+e).indexOf("e")>0?e:e+"e+"+t)+"e-"+t)};return r=(t?u(s,t):""+Math.round(s)).split("."),r[0].length>3&&(r[0]=r[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,i)),(r[1]||"").length<t&&(r[1]=r[1]||"",r[1]+=new Array(t-r[1].length+1).join("0")),r.join(a)}}(jQuery);
//# sourceMappingURL=jquery.number.min.js.mapvar base_url = $("body").attr("baseurl");

$("select[name=merek]").load(base_url + "general/getmerekall/all/false");
$("select[name=komponen]").load(base_url + "general/getcomponentall");

$("select[name=komponen]").change(function (argument) {
  var value = $(this).val();
  $("select[name=sub_kategori]").load(
    base_url + "general/getsubkategori/" + value,
    function () {
      if (
        $(
          "select[name=sub_kategori] option[value='" +
            $(".form-filter-search").attr("seletedsub") +
            "']"
        ).length > 0
      ) {
        $(this).val($(".form-filter-search").attr("seletedsub"));
      } else {
        $(this).val("0");
      }
    }
  );
  $("select[name=merek]").load(
    base_url + "general/getmerekall/" + value + "/false",
    function () {
      $("select[name=merek]").val(
        $(".form-filter-search").attr("seletedbrand")
      );
      if (
        $(
          "select[name=merek] option[value='" +
            $(".form-filter-search").attr("seletedbrand") +
            "']"
        ).length > 0
      ) {
        $(this).val($(".form-filter-search").attr("seletedbrand"));
      } else {
        $(this).val("");
      }
    }
  );
  console.log(value);
  $("select[name=quality]").load(
    base_url + "general/getgradeall/" + value + "/false",
    function () {
      $("select[name=quality]").val(
        $(".form-filter-search").attr("seletedquality")
      );
      if (
        $(
          "select[name=quality] option[value='" +
            $(".form-filter-search").attr("seletedquality") +
            "']"
        ).length > 0
      ) {
        $(this).val($(".form-filter-search").attr("seletedquality"));
      } else {
        $(this).val("");
      }
    }
  );
});

/*$('.format-uang').mask('000.000.000.000', {
    reverse: true
    });*/

$(document).ready(function () {
  setTimeout(function () {
    var formsearch = $(".form-filter-search");
    var seletedbrand = formsearch.attr("seletedbrand");
    var seletedtype = formsearch.attr("seletedtype");
    var seletedsub = formsearch.attr("seletedsub");
    var seletedcomponent = formsearch.attr("seletedcomponent");
    var seletedquality = formsearch.attr("seletedquality");
    if (seletedbrand != "") {
      //$("select[name=merek]").val(seletedbrand);
      //$("select[name=tipe]").load(base_url+"general/gettype/"+seletedbrand);
      $("select[name=merek]").load(
        base_url + "general/getmerekall/" + seletedcomponent + "/false",
        function () {
          $("select[name=merek]").val(
            $(".form-filter-search").attr("seletedbrand")
          );
        }
      );
    }
    if (seletedquality != "") {
      $("select[name=quality]").val(seletedquality);
    }
    if (seletedcomponent != "") {
      $("select[name=komponen]").val(seletedcomponent);
      $("select[name=sub_kategori]").load(
        base_url + "general/getsubkategori/" + seletedcomponent,
        function () {
          if (
            $(
              "select[name=sub_kategori] option[value='" +
                $(".form-filter-search").attr("seletedsub") +
                "']"
            ).length > 0
          ) {
            $(this).val($(".form-filter-search").attr("seletedsub"));
          } else {
            $(this).val("0");
          }
        }
      );
      $("select[name=merek]").load(
        base_url + "general/getmerekall/" + seletedcomponent + "/false",
        function () {
          $("select[name=merek]").val(
            $(".form-filter-search").attr("seletedbrand")
          );
          if (
            $(
              "select[name=merek] option[value='" +
                $(".form-filter-search").attr("seletedbrand") +
                "']"
            ).length > 0
          ) {
            $(this).val($(".form-filter-search").attr("seletedbrand"));
          } else {
            $(this).val("");
          }
        }
      );
      $("select[name=quality]").load(
        base_url + "general/getgradeall/" + seletedcomponent + "/false",
        function () {
          $("select[name=quality]").val(
            $(".form-filter-search").attr("seletedquality")
          );
          if (
            $(
              "select[name=quality] option[value='" +
                $(".form-filter-search").attr("seletedquality") +
                "']"
            ).length > 0
          ) {
            $(this).val($(".form-filter-search").attr("seletedquality"));
          } else {
            $(this).val("");
          }
        }
      );
    }
    setTimeout(function () {
      if (seletedtype != "") {
        $("select[name=tipe]").val(seletedtype);
      }
      if (seletedsub != "") {
        $("select[name=sub_kategori]").val(seletedsub);
      }
    }, 2000);
  }, 2000);

  /* $("input[name=minp]").number( true );
	$("input[name=maxp]").number( true );
	$("input[name=minp]").val($(".filterprice").attr("minp"));
	$("input[name=maxp]").val($(".filterprice").attr("maxp"));
	document.getElementById("minp").onblur = function() {fp()};
	document.getElementById("maxp").onblur = function() {fp()};
	function fp() {
		var minp = Number($("input[name=minp]").val().replace(/[,]/g, ""));
		var maxp = Number($("input[name=maxp]").val().replace(/[,]/g, ""));
		if ((maxp>minp)==true) {
			$("input[name=minp]").val(minp);
			$("input[name=maxp]").val(maxp);
			document.getElementById("submitprice").submit();
		}else{
			$("input[name=maxp]").popover("show");
		};
	}; */
});
var base_url = $("body").attr("baseurl");

/*
var one_detect=1;
do{
    var ifi = $(".sv_menu_center a.m"+one_detect).hasClass( "m"+one_detect);
    one_detect++;                    
}while(ifi);
one_detect=$(".sv_menu_center a").length;

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
});
*/

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

// $('[data-toggle="popover"]').popover();
// $('[role="tablist"]').tab();
// $('.carousel').carousel();

jQuery(document).ready(function ($) {
  var telkomspeedy = $('[src*="u-ad.info"]');
  if (telkomspeedy) {
    telkomspeedy.remove();
  }
  $('script:contains("u-ad.info")').remove();
});

// $("#js-mobile-offcanvas").trigger("offcanvas.toggle");

$(".collapsedecategorymobile").on("shown.bs.collapse", function () {
  $(".hiddenin").css("display", "").not($(this)).fadeOut().removeClass("in");
  $(this).find("li").css("background-color", "rgba(128, 128, 128, 0.22)");
});

$(".collapsedecategorymobile").on("hidden.bs.collapse", function () {
  // Kosong atau tambahkan kode jika perlu
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

// $(".carousel").carousel();

// $(".list_brand_category").slick({
//   arrows: true,
//   variableWidth: true,
//   autoplay: true,
//   dots: false,
//   speed: 700,
//   centerMode: false,
//   focusOnSelect: true,
// });

/* 
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/56495e0a06a71074263bdb3a/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
})(); 
*/

$(".list_brand_category").css("display", "inline");

$(document)
  .on("click", ".proccessshow", function (e) {
    e.preventDefault(); // <-- Perbaikan: gunakan preventDefault()
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
  var url = base_url + "general/addsession/" + session + "/" + sessionval; // <-- base_url bukan baseurl
  $.post(url, function (data) {});
});

$(".fadeslidebig").fadeIn("fast");

// $(".fadeslidebig").slick({
//   arrows: false,
//   autoplay: true,
//   autoplaySpeed: 5000,
//   slidesToShow: 1,
// });

/* 
$(".btn-copytext").on("click",function(event) {
  var copytext= $(this);
  copytext.find("textarea").val().select();
  try {
    var successful = copytext.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
}); 
*/

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

// TAMBAHKAN INI JIKA PERLU
$(document).ready(function () {
  // Kode inisialisasi tambahan
});

// END OF FILE - Tidak perlu tambahan
