$(document).ready(function () {
  var isMobile = false; //initiate as false
  // device detection
  if (
    /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
      navigator.userAgent
    ) ||
    /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
      navigator.userAgent.substr(0, 4)
    )
  )
    isMobile = true;
  if (isMobile == false) {
    $(".slicksameproduct12").slick({
      arrows: false,
      variableWidth: false,
      autoplay: true,
      dots: true,
      centerMode: false,
      focusOnSelect: true,
      slidesToShow: 2,
      swipeToSlide: true,
      speed: 1000,
    });
    $(".img-detail-lg").elevateZoom({
      zoomWindowFadeIn: 400,
      zoomWindowFadeOut: 400,
      lensFadeIn: 400,
      lensFadeOut: 400,
    });
  } else {
    $(".slicksameproduct12").slick({
      arrows: false,
      variableWidth: false,
      autoplay: true,
      dots: false,
      slidesToShow: 2,
      centerMode: false,
      focusOnSelect: true,
      swipeToSlide: true,
    });
  }

  $(".slicksameproduct-article").slick({
    arrows: false,
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: false,
    slidesToShow: 4,
    swipeToSlide: true,
    speed: 1000,
  });
  $(".slicksameproduct-detail").slick({
    arrows: false,
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 4,
    swipeToSlide: true,
    speed: 1000,
  });
  $(".slicksameproduct-mobile").slick({
    arrows: false,
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: false,
    slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
  });

  /* init_select();
    
    function init_select() {
        $('.js-example-basic-single').select2({
            ajax: {
                url: baseurl+'product/prospek/get_products',
                dataType: 'json',
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    return {
                        results: data
                    };
                },
                cache:true
            },
            placeholder: 'Pilih item',
            minimumInputLength: 1,
        });
    } */

  $(document).on("click", ".btn-add-item", function () {
    var html = "";
    html = '<div class="form-group row">';
    html += '<div class="col-xs-10">';
    html +=
      '<select name="id_produk[]" class="js-example-basic-single form-control" placeholder="Nama produk" >';
    html += '<option value="">-- Pilih Item --</option>';
    html += "</select>";
    html += "</div>";
    html += '<div class="col-xs-2">';
    html +=
      '<input type="number" name="qty[]" class="form-control" value="1" />';
    html += "</div>";
    html += "</div>";

    $(".group-item").append(html);
    init_select();
  });

  count_total();
});

function toggleChat() {
  Tawk_API = Tawk_API || {};
  Tawk_API.onChatMaximized = function () {
    //place your code here
  };
  Tawk_API.toggle();
}

$(".changeimagegalery").on("click", function () {
  $(".tochangebyclick").attr("src", $(this).attr("zoom-src-no-crop"));
  $(".tochangebyclick").attr(
    "data-zoom-image",
    $(this).attr("zoom-src-no-crop")
  );
  $(".zoomWindowContainer div").css(
    "background-image",
    "url(" + $(this).attr("zoom-src-no-crop") + ")"
  );
});

$(".show-more").on("click", function () {
  var height = $(".wrapper").css("height");

  if (height == "100px") {
    $(this).html('Show less detail <span class="fa fa-arrow-up"></span>');
    $(".wrapper").css({ height: "auto" });
  } else {
    $(this).html('Show more detail <span class="fa fa-arrow-down"></span>');
    $(".wrapper").css({ height: "100px" });
  }
});

$(".btn-min").on("click", function () {
  if (
    parseInt($('input[name="value"]').val()) >
    parseInt($('input[name="value"]').attr("minimum"))
  ) {
    $('input[name="value"]').val(parseInt($('input[name="value"]').val()) - 1);
    $('input[name="value"]').data("prev-val", $('input[name="value"]').val());
    if (
      $('input[name="value"]').val() >=
      $('input[name="value"]').data("min-volume")
    ) {
      $(".ticket-volume").addClass("ticket-active");
    } else {
      $(".ticket-volume").removeClass("ticket-active");
    }
    $(".qty-lbl").text($('input[name="value"]').val());
    count_total();
  }
});

$(document).on("click", ".btn-plus", function () {
  if (
    parseInt($('input[name="value"]').val()) <
    parseInt($('input[name="value"]').attr("maximum"))
  ) {
    $('input[name="value"]').val(parseInt($('input[name="value"]').val()) + 1);
    $('input[name="value"]').data("prev-val", $('input[name="value"]').val());
    if (
      $('input[name="value"]').val() >=
      $('input[name="value"]').data("min-volume")
    ) {
      $(".ticket-volume").addClass("ticket-active");
    } else {
      $(".ticket-volume").removeClass("ticket-active");
    }
    $(".qty-lbl").text($('input[name="value"]').val());
    count_total();
  }
});

$(document).on("change", "input[name='value']", function () {
  if (
    parseInt($('input[name="value"]').attr("minimum")) <
      parseInt($('input[name="value"]').val()) &&
    parseInt($('input[name="value"]').val()) <
      parseInt($('input[name="value"]').attr("maximum"))
  ) {
    $('input[name="value"]').data("prev-val", $('input[name="value"]').val());
    if (
      $('input[name="value"]').val() >=
      $('input[name="value"]').data("min-volume")
    ) {
      $(".ticket-volume").addClass("ticket-active");
    } else {
      $(".ticket-volume").removeClass("ticket-active");
    }
    $(".qty-lbl").text($('input[name="value"]').val());
    count_total();
  } else {
    $('input[name="value"]').val($('input[name="value"]').data("prev-val"));
  }
});

$(".btn-volume").on("click", function () {
  $('input[name="value"]').val(
    parseInt($('input[name="value"]').val()) >= 4
      ? $('input[name="value"]').val()
      : 4
  );
  count_total();
});

$(".cod-button").on("click", function () {
  $(this).addClass("active");
  $(".cbd-button").removeClass("active");
  $(".ticket-cbd").removeClass("ticket-active");
  $('input[name="method"]').val("cod");
  count_total();
});

$(".cbd-button").on("click", function () {
  $(this).addClass("active");
  $(".cod-button").removeClass("active");
  $(".ticket-cbd").addClass("ticket-active");
  $('input[name="method"]').val("cbd");
  count_total();
});

$("#referral-form").on("submit", function () {
  $.post(
    $("#referral-form").attr("action"),
    {
      referral_code: $('input[name="referral-code"]').val(),
    },
    function (data) {
      if (data == "true") {
        $(".ticket-referral").addClass("ticket-active");
        count_total();
        $("#referral-form").hide();
      } else {
        alert("Kode referral tidak terdaftar");
      }
    }
  );
  return false;
});

function count_total() {
  cbd_disc =
    $(".cbd-button").length > 0
      ? $(".cbd-button").hasClass("active")
        ? parseInt($(".cbd-button").data("cbd-price"))
        : 0
      : 0;
  volume_disc =
    $('input[name="value"]').val() >=
    parseInt($('input[name="value"]').data("min-volume"))
      ? $('input[name="value"]').data("volume-price")
      : 0;
  referral_disc =
    $(".ticket-referral").length > 0
      ? $(".ticket-referral").hasClass("ticket-active")
        ? parseInt($(".ticket-referral").data("referral-price"))
        : 0
      : 0;
  price_list = parseInt($(".price-list").data("price"));
  base_price =
    parseInt($(".price-promo").data("price")) > 0
      ? parseInt($(".price-promo").data("price"))
      : price_list;

  //if($('.cbd-button').length > 0) {
  disc_price = base_price - cbd_disc - volume_disc - referral_disc;
  disc_amount = (100 - (disc_price / price_list) * 100).toLocaleString("id-ID");
  $(".promo-label").text(disc_amount);
  $(".price-label").text(disc_price.toLocaleString("id-ID"));
  $(".total-label").text(
    (disc_price * parseInt($('input[name="value"]').val())).toLocaleString(
      "id-ID"
    )
  );
  /* } else {
        $('.total-label').text((price_list*parseInt($('input[name="value"]').val())).toLocaleString('id-ID'));
    } */
}
$("#button-konsultasi").click(function () {
  $("html, body").animate(
    {
      scrollTop: $("#konsultasi").offset().top - 130,
    },
    2000
  );
});

$(document).ready(function () {
  var maxHeight = 130;
  var isExpanded = false;

  function setHeight(height) {
    $(".detail-attribute-produk").css("max-height", height + "px");
    $(".detail-attribute-produk").css("overflow-y", "hidden");
  }
  if ($(".detail-attribute-produk").height() > maxHeight) {
    setHeight(maxHeight);
    $(".lihat-selengkapnya").show();
  } else {
    $(".lihat-selengkapnya").hide();
  }

  $(".lihat-selengkapnya").click(function () {
    if (!isExpanded) {
      setHeight($(".detail-attribute-produk")[0].scrollHeight);
      $(this).text("Sembunyikan");
      isExpanded = true;
    } else {
      setHeight(maxHeight);
      $(this).text("Lihat Selengkapnya");
      isExpanded = false;
    }
  });
});

$(document).ready(function () {
  $("#sameProductDetailTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "",
      type: "POST",
    },
    columns: [
      { data: 0, orderable: false },
      { data: 1 },
      { data: 2 },
      { data: 3, orderable: false },
    ],
    order: [[0, "asc"]],
  });
});
