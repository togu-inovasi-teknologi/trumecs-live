var base_url = $("body").attr("baseurl");
var attributes = [];
$(".input-upload").change(function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var classPrev = `.img-prev-${id}`;
  file = this.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = function (event) {
      $(classPrev).attr("src", event.target.result);
    };
    reader.readAsDataURL(file);
  }
});

$('select[name="jenis_barang"').change(function (e) {
  e.preventDefault();
  // console.log($(this).val());
  $.ajax({
    type: "POST",
    url: base_url + "/member/store/getBrands",
    data: {
      category_id: $(this).val(),
    },
    dataType: "json",
    success: function (response) {
      $('select[name="merek_barang"]').html(``);
      $.each(response, function (i, value) {
        $('select[name="merek_barang"]').append(
          `<option value="${value.brand_id}">${value.name}</option>`
        );
      });
    },
  });
  $.ajax({
    type: "POST",
    url: base_url + "/member/store/get_product_grade",
    data: {
      category_id: $(this).val(),
    },
    dataType: "json",
    success: function (response) {
      $('select[name="kondisi_barang"]').html(``);
      $.each(response, function (i, value) {
        $('select[name="kondisi_barang"]').append(
          `<option value="${value.id}">${value.grade}</option>`
        );
      });
    },
  });
});

$(".pj-produk").click(function () {
  var val = $(this).data("value");
  if (val == "is_sell") {
    $('input[name="is_sell"').val(1);
    $(".nama-barang").show();
    $("#pilih-jenis-produk").hide();
    $(".nama-jasa").hide();
    $(".nama-rental").hide();
  } else if (val == "is_service") {
    $('input[name="is_service"').val(1);
    $(".nama-barang").hide();
    $("#pilih-jenis-produk").hide();
    $(".nama-jasa").show();
    $(".nama-rental").hide();
  } else if (val == "is_rent") {
    $('input[name="is_rent"').val(1);
    $(".nama-barang").hide();
    $("#pilih-jenis-produk").hide();
    $(".nama-jasa").hide();
    $(".nama-rental").show();
  }
});
$(".metode-pengiriman").click(function () {
  var val = $(this).val();
  if (val == "custom") {
    $(".mp-custom").show();
  } else {
    $(".mp-custom").hide();
  }
});

$(".add-mp").on("click", function () {
  $(".mp-card").append($(".mp-form").html());
});

$(document).on("click", ".del-mp", function () {
  $(this).parent().parent().remove();
});

$(".prev-nama-barang").click(function () {
  $("#pilih-jenis-produk").show();
  $(".nama-barang").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-nama-barang").click(function () {
  var jenis_barang = $('select[name="jenis_barang"]').val();
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").hide();
  $(".spesifikasi-barang").show();
  $(".spesifikasi-barang").removeClass("d-none");
  $("html, body").scrollTop($("#spesifikasi-barang").offset().top - 130);
  // $.ajax({
  //   type: "POST",
  //   url: base_url + "member/store/get_product_grade",
  //   data: {
  //     category_id: jenis_barang,
  //   },
  //   dataType: "json",
  //   success: function (response) {
  //     setConditionForm(response);
  //   },
  // });
  $.ajax({
    type: "POST",
    url: base_url + "member/store/get_product_attribute",
    data: {
      category_id: jenis_barang,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      setSpesificationForm(response);
    },
  });
});

$(".prev-spesifikasi-barang").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").show();
  $(".spesifikasi-barang").hide();
  $("html, body").scrollTop($("#nama-barang").offset().top - 130);
  $("#spesification-space").html("");
});
$(".next-spesifikasi-barang").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").hide();
  $(".spesifikasi-barang").hide();
  $(".harga-barang").show();
  $(".harga-barang").removeClass("d-none");
  $("html, body").scrollTop($("#harga-barang").offset().top - 130);
});
$(".prev-harga-barang").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").hide();
  $(".spesifikasi-barang").show();
  $(".harga-barang").hide();
  $("html, body").scrollTop($("#spesifikasi-barang").offset().top - 130);
});
// $(".next-harga-barang").click(function () {
//   $("#pilih-jenis-produk").hide();
//   $(".nama-barang").hide();
//   $(".spesifikasi-barang").hide();
//   $(".harga-barang").hide();
//   $(".pengiriman-barang").show();
//   $(".pengiriman-barang").removeClass("d-none");
//   $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
// });
// $(".prev-pengiriman-barang").click(function () {
//   $("#pilih-jenis-produk").hide();
//   $(".nama-barang").hide();
//   $(".spesifikasi-barang").hide();
//   $(".harga-barang").show();
//   $(".pengiriman-barang").hide();
//   $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
// });

$(".prev-nama-jasa").click(function () {
  $("#pilih-jenis-produk").show();
  $(".nama-jasa").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});

$(".prev-nama-rental").click(function () {
  $("#pilih-jenis-produk").show();
  $(".nama-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-nama-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").show();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".prev-spesifikasi-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").show();
  $(".spesifikasi-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-spesifikasi-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").hide();
  $(".harga-rental").show();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".prev-harga-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").show();
  $(".harga-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-harga-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").hide();
  $(".harga-rental").hide();
  $(".pengiriman-rental").show();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".prev-pengiriman-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").hide();
  $(".harga-rental").show();
  $(".pengiriman-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});

$("select[name=brand]").load(
  base_url +
    "general/getbrandform/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedbrand");
    $(this).val(mustvalue);
  }
);

function setConditionForm(attrs) {
  $.each(attrs, function (i, value) {
    var content = "";
    content += `<label class="m-r-1">`;
    content += `<input type="radio" name="kondisi_barang" value="${value.id}" />
      ${value.grade}`;
    content += `</label>`;
    $("#productCondition").append(content);
  });
}
function setSpesificationForm(attrs) {
  $.each(attrs, function (i, value) {
    var content = "";
    content += `<div class="col-lg-6">`;
    content += `<label class="fbold m-t-1">${value.name}</label>`;
    content += `<input type="hidden" name="id_attributes[]" class="form-control" value="${value.attribute_id}" placeholder="${value.name}">`;
    content += `<input type="text" name="attributes[]" class="form-control" value="" placeholder="${value.name}">`;
    content += `</div>`;
    $("#spesification-space").append(content);
  });
}
// var previewNode = document.querySelector("#template-produk");
// previewNode.id = "";
// var previewTemplate = previewNode.parentNode.innerHTML;
// previewNode.parentNode.removeChild(previewNode);

// $(document).on("click", ".btn-upload", function () {
//   $(".btn-upload-hide").click();
// });

// $("#upload-image-produk").dropzone({
//   url: base_url + "member/store/upload_produk",
//   parallelUploads: 3,
//   clickable: ".btn-upload-hide-produk",
//   previewTemplate: previewTemplate,
//   autoQueue: true,
//   maxFiles: 5,
//   previewsContainer: "#previews-produk",
//   acceptedFiles: ".jpg, .jpeg, .png, .zip",
//   init: function () {
//     this.on("complete", (file) => {
//       console.log(file);

//       $(file).each(function (index, item) {
//         response = JSON.parse(item.xhr.response);
//         $("#upload-image-produk").append(
//           '<input type="hidden" name="files[]" value="' + response.name + '" />'
//         );
//         $(".btn-upload-produk").eq(0).remove();

//         setTimeout(function () {
//           $(item.previewElement).find(".progress").fadeOut(1000);
//         }, 500);
//       });
//     });
//     this.on("removedfile", (file) => {
//       response = JSON.parse(file.xhr.response);
//       filename = response.name;
//       $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
//         $('input[value="' + filename + '"]').remove();
//         $(".form-upload-image-produk").append(
//           $("#form-upload-image-produk").html()
//         );
//       });
//     });
//   },
// });

// var previewNodes = document.querySelector("#template-jasa");
// previewNodes.id = "";
// var previewTemplates = previewNodes.parentNode.innerHTML;
// previewNodes.parentNode.removeChild(previewNodes);

// $("#upload-image-jasa").dropzone({
//   url: base_url + "member/store/upload_jasa",
//   parallelUploads: 3,
//   clickable: ".btn-upload-hide-jasa",
//   previewTemplate: previewTemplates,
//   autoQueue: true,
//   maxFiles: 5,
//   previewsContainer: "#previews-jasa",
//   acceptedFiles: ".jpg, .jpeg, .png, .zip",
//   init: function () {
//     this.on("complete", (file) => {
//       console.log(file);

//       $(file).each(function (index, item) {
//         response = JSON.parse(item.xhr.response);
//         $("#upload-image-jasa").append(
//           '<input type="hidden" name="files[]" value="' + response.name + '" />'
//         );
//         $(".btn-upload-jasa").eq(0).remove();

//         setTimeout(function () {
//           $(item.previewElement).find(".progress").fadeOut(1000);
//         }, 500);
//       });
//     });
//     this.on("removedfile", (file) => {
//       response = JSON.parse(file.xhr.response);
//       filename = response.name;
//       $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
//         $('input[value="' + filename + '"]').remove();
//         $(".form-upload-image-jasa").append(
//           $("#form-upload-image-jasa").html()
//         );
//       });
//     });
//   },
// });

// var previewNodes = document.querySelector("#template-rental");
// previewNodes.id = "";
// var previewTemplates = previewNodes.parentNode.innerHTML;
// previewNodes.parentNode.removeChild(previewNodes);

// $("#upload-image-rental").dropzone({
//   url: base_url + "store/upload_rental",
//   parallelUploads: 3,
//   clickable: ".btn-upload-hide-rental",
//   previewTemplate: previewTemplates,
//   autoQueue: true,
//   maxFiles: 5,
//   previewsContainer: "#previews-rental",
//   acceptedFiles: ".jpg, .jpeg, .png, .zip",
//   init: function () {
//     this.on("complete", (file) => {
//       console.log(file);

//       $(file).each(function (index, item) {
//         response = JSON.parse(item.xhr.response);
//         $("#upload-image-rental").append(
//           '<input type="hidden" name="files[]" value="' + response.name + '" />'
//         );
//         $(".btn-upload-rental").eq(0).remove();

//         setTimeout(function () {
//           $(item.previewElement).find(".progress").fadeOut(1000);
//         }, 500);
//       });
//     });
//     this.on("removedfile", (file) => {
//       response = JSON.parse(file.xhr.response);
//       filename = response.name;
//       $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
//         $('input[value="' + filename + '"]').remove();
//         $(".form-upload-image-rental").append(
//           $("#form-upload-image-rental").html()
//         );
//       });
//     });
//   },
// });
