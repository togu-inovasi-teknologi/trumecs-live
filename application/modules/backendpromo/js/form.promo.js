var base__url = $("body").attr("baseurl");
$(document).ready(function () {
  $("#table-promo").DataTable();

  $("#choiceTypePromo").hide();

  $("select[name='type']").on("change", function () {
    var selectedValue = $(this).val();

    if (selectedValue === "bundle") {
      $("#choiceTypePromo").show("fast");
      $("input[name='price']").prop("required", true);
    } else {
      $("#choiceTypePromo").hide("fast");
      $("input[name='price']").prop("required", false).val("");
    }
  });

  // Trigger change untuk mengecek nilai awal (jika sudah terisi saat edit)
  $("select[name='type']").trigger("change");
});

$("input[type=file]").on("change", function () {
  var str = $(this).val();
  readURL(this);
  $(".file-custom").attr(
    "data-content",
    "..." + str.substring(str.length, str.length - 9)
  );
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".blah").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$("input[name=filegambar]").change(function (e) {
  var file = e.target.files[0];
  var $this = $(this);
  $this.attr("disabled", true);

  canvasResize(file, {
    width: 2000,
    height: 2000,
    crop: false,
    quality: 100,
    callback: function (data, width, height) {
      var fd = new FormData();
      var f = canvasResize("dataURLtoBlob", data);
      f.name = file.name;

      fd.append("filegambar", f);
      var xhr = new XMLHttpRequest();
      xhr.open("POST", base__url + "general/uploadfilecanvas", true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhr.setRequestHeader("pragma", "no-cache");
      xhr.addEventListener(
        "load",
        function (e) {
          var response = JSON.parse(e.target.responseText);
          var string = response.filename;
          var filenametrue = string.replace("public/tmp/", "");

          // 🔥 PERBAIKAN: Hapus semua input terkait gambar lama
          $(".tampung").find('input[name="txtfilegambar"]').remove();
          $(".tampung").find('input[name="asknew"]').remove();

          // 🔥 PERBAIKAN: Tambahkan input baru dengan value yang benar
          var str_input =
            '<input type="hidden" name="txtfilegambar" value="' +
            filenametrue +
            '">' +
            '<input type="hidden" name="asknew" value="yesnew">';

          $(".tampung").html(
            '<img class="img-fluid rounded-3" style="max-height: 120px;" src="' +
              base__url +
              "public/tmp/" +
              filenametrue +
              '">' +
              str_input +
              '<div class="clearfix"></div>'
          );

          // Enable kembali input file
          $this.attr("disabled", false);
        },
        false
      );

      xhr.send(fd);
    },
  });
});
