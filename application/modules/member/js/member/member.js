var base_url = $("body").attr("baseurl");
$(document).ready(function () {
  var id = $('input[name="order_id"]').val();

  $("#data-table-order-item").DataTable({
    ajax: {
      url: base_url + "member/getOrderItem",
      type: "POST",
      data: {
        where: {
          id_order: id,
        },
      },
    },
    ordering: false,
    paging: false,
    searching: false,
    info: true,
    autowidth: false,
    processing: true,
    serverSide: true,
  });
});

// $("#upload-image-produk").dropzone({
// 	url: base_url + "store/upload_produk",
// 	parallelUploads: 3,
// 	clickable: ".btn-upload-hide-produk",
// 	previewTemplate: previewTemplate,
// 	autoQueue: true,
// 	maxFiles: 5,
// 	previewsContainer: "#previews-produk",
// 	acceptedFiles: '.jpg, .jpeg, .png, .zip',
//         init: function() {
// 			this.on("complete", file => {
// 				console.log(file);

//                 $(file).each(function(index, item){
//                     response = JSON.parse(item.xhr.response)
// 					$("#upload-image-produk").append('<input type="hidden" name="files[]" value="' + response.name + '" />');
// 					$('.btn-upload-produk').eq(0).remove();

// 					setTimeout(function(){
//            				$(item.previewElement).find('.progress').fadeOut(1000);
//       				},500);
//                 });
//             })
//             this.on("removedfile", file => {
//                 response = JSON.parse(file.xhr.response)
//                 filename = response.name;
//                 $.post(base_url+'bulk/remove',{filename:filename},function(data){
// 					$('input[value="' + filename + '"]').remove();
// 					$(".form-upload-image-produk").append($("#form-upload-image-produk").html());
//                 });
//             });
//         }
// });

$(".btn-sk-toko").click(function () {
  $("#sk-toko").hide();
  // $("#form-toko").show();

  $("#form-toko").removeClass("d-none");
  $("html, body").animate(
    {
      scrollTop: $("#form-toko").offset().top - 80,
    },
    2000
  );
});
$(".btn-form-toko").click(function () {
  $("#form-toko").hide();
  $("#sk-toko").show();
  $("html, body").animate(
    {
      scrollTop: $("#sk-toko").offset().top - 80,
    },
    2000
  );
});
$(document).ready(function () {
  $(".rotate-icon").click(function () {
    $(this).find(".fa").toggleClass("rotate");
  });
});
$(document).on("click", ".btn-name", function () {
  $(".edit-name").html($('input[name="edit-name"]').val());
  $(".modal-name").modal("hide");
});
$(document).on("click", ".btn-email", function () {
  $(".edit-email").html($('input[name="edit-email"]').val());
  $(".modal-email").modal("hide");
});
$(document).on("click", ".btn-phone", function () {
  $(".edit-phone").html($('input[name="edit-phone"]').val());
  $(".modal-phone").modal("hide");
});
$(document).on("click", ".btn-ttl", function () {
  $(".edit-date").html($('select[name="edit-date"] option:selected').val());
  $(".edit-month").html($('select[name="edit-month"] option:selected').val());
  $(".edit-year").html($('select[name="edit-year"] option:selected').val());
  $(".modal-ttl").modal("hide");
});
$(document).on("click", ".btn-company", function () {
  $(".edit-company").html($('input[name="edit-company"]').val());
  $(".modal-company").modal("hide");
});
$(document).on("click", ".btn-position", function () {
  $(".edit-position").html($('input[name="edit-position"]').val());
  $(".modal-position").modal("hide");
});
$(document).on("click", ".btn-company-email", function () {
  $(".edit-company-email").html($('input[name="edit-company-email"]').val());
  $(".modal-company-email").modal("hide");
});
$(document).on("click", ".btn-company-phone", function () {
  $(".edit-company-phone").html($('input[name="edit-company-phone"]').val());
  $(".modal-company-phone").modal("hide");
});
$(document).on("click", ".btn-address", function () {
  $(".edit-address").html($('input[name="edit-address"]').val());
  $(".edit-rt-rw").html($('input[name="edit-rt-rw"]').val());
  $(".edit-province").html(
    jQuery.isNumeric($('select[name="province"]').val())
      ? $('select[name="province"] option:selected').text()
      : ""
  );
  $(".edit-city").html(
    jQuery.isNumeric($('select[name="city"]').val())
      ? $('select[name="city"] option:selected').text()
      : ""
  );
  $(".edit-districts").html(
    jQuery.isNumeric($('select[name="districts"]').val())
      ? $('select[name="districts"] option:selected').text()
      : ""
  );
  $(".edit-village").html(
    jQuery.isNumeric($('select[name="village"]').val())
      ? $('select[name="village"] option:selected').text()
      : ""
  );
  $(".edit-kodepos").html($('input[name="kodepos"]').val());
  $(".modal-address").modal("hide");
});
$(".add-hint")
  .mouseenter(function () {
    $(".hint-first").hide();
    $(".hint").show();
    $(".hint .title-hint").html($(this).data("title"));
    $(".hint .alert").html($(this).data("hint"));
  })
  .mouseleave(function () {
    $(".hint").hide();
    $(".hint-first").show();
  });
$("#table_id").DataTable({
  ordering: false,
  paging: true,
  searching: true,
  info: true,
  autowidth: false,
});

$("#table-confirmation").DataTable({
  ajax: {
    url: base_url + "member/getSourcing",
    type: "POST",
  },
  ordering: false,
  paging: true,
  searching: true,
  info: true,
  autowidth: false,
  processing: true,
  serverSide: true,
});

$(document).on("click", ".upload-po-table", function (e) {
  $("input[name='order_id']").val($(this).data("id"));
});
$(document).on("click", ".upload-payment-file", function (e) {
  $("input[name='order_id']").val($(this).data("id"));
});
$(document).on("click", ".order-number-label", function (e) {
  console.log($(this).data("id"));
  $("input[name='order_id']").val($(this).data("id"));
});
$(document).on("click", ".btn-upload-file-receive", function (e) {
  $("input[name='order_id']").val($(this).data("id"));
});

$(document).ready(function () {
  $('input[name="file_po"]').change(function (e) {
    e.preventDefault();
    var file = this.files[0];
    $(".uploaded-file").html(file.name);
  });
  $('input[name="file_payment"]').change(function (e) {
    e.preventDefault();
    var file = this.files[0];
    $(".uploaded-file").html(file.name);
  });
  $('input[name="file_receive"]').change(function (e) {
    e.preventDefault();
    var file = this.files[0];
    $(".uploaded-file").html(file.name);
  });

  $(document).on("change", "select[name=province]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahrigences_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        console.log(json);
        $("select[name=city]").html("<option>Pilih Kabupaten</option>");
        $("select[name=districts]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        $("select[name=village]").html(
          "<option>-sedang mengambil data...-</option>"
        );

        for (i in json) {
          var str_select = "";
          $("select[name=city]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=city]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahdistricts_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=districts]").html("<option>Pilih Kecamatan</option>");
        $("select[name=village]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        for (i in json) {
          var str_select = "";
          $("select[name=districts]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=districts]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahvillages_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=village]").html("<option>Pilih Desa</option>");
        for (i in json) {
          var str_select = "";
          $("select[name=village]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });
});

var ttt = $("select[name=edit-date]").attr("isvalue");
var bbb = $("select[name=edit-month]").attr("isvalue");
var yyy = $("select[name=edit-year]").attr("isvalue");
$("select[name=edit-date]").val(ttt);
$("select[name=edit-month]").val(bbb);
$("select[name=edit-year]").val(yyy);

$(".show-password").click(function () {
  var checked = $(this).prop("checked");
  if (checked == true) {
    $(".password").attr("type", "text");
  } else {
    $(".password").attr("type", "password");
  }
});
