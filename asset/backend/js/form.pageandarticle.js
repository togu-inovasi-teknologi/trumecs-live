//

var base__url = $("body").attr("baseurl");
tinyMCE.baseURL = base__url + "asset/backend/dist/js/tinymce";
tinymce.init({
  plugins: "link table image code lists advlist quickbars",
  selector: "#xxxxxxxxx",
  menubar: true,
  relative_urls: false,
  remove_script_host: false,
  height: "680",
  toolbar: [
    "undo redo | alignleft aligncenter alignright alignjustify bold italic underline strikethrough subscript superscript removeformat | numlist bullist | styles fontname fontsize forecolor table link image code",
  ],
  images_upload_url: base__url + "backendartikel/tinymceimg",
  quickbars_selection_toolbar:
    "fontsize forecolor | bold italic underline strikethrough subscript superscript removeformat",
  quickbars_image_toolbar: "alignleft aligncenter alignright",
  //images_upload_base_path: '/public/image/artikel',
});

$('input[name="filegambar"]').change(function (e) {
  var file = e.target.files[0];
  if (!file) return;

  $(this).attr("disabled", true);

  canvasResize(file, {
    width: 1200,
    height: 1200,
    crop: false,
    quality: 70,
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
          try {
            var response = JSON.parse(e.target.responseText);
            var string = response.filename;
            var filenametrue = string.replace("public/tmp/", "");

            // Set value ke hidden field
            $("#txtfilegambar").val(filenametrue);

            var str_input =
              '<input name="txtfilegambar" value="' +
              filenametrue +
              '" type="hidden"><input name="asknew" value="yesnew" type="hidden">';
            $(".tampung").html(
              '<img class="img-fluid" src="' +
                base__url +
                "public/tmp/" +
                filenametrue +
                '" style="max-height:150px;">' +
                str_input
            );

            $('input[name="filegambar"]').attr("disabled", false);
          } catch (error) {
            console.error("Error:", error);
            $('input[name="filegambar"]').attr("disabled", false);
          }
        },
        false
      );

      xhr.addEventListener(
        "error",
        function () {
          console.error("Upload error");
          $('input[name="filegambar"]').attr("disabled", false);
        },
        false
      );

      xhr.send(fd);
    },
  });
});
