var base_url = $("body").attr("baseurl");
$(".btnshowmodal").on("click",function() {
	$(".nameimage").val($(this).attr("input-name"));
	$(".titlemodal").html($(this).attr("input-name"));
	$(".ukuran").html($(this).attr("ukuran"));
	$(".isthis").html("");
	$("input[name=link]").val("");
})

$(".btnshoweditmodal").on("click",function() {
	$(".nameimage").val($(this).attr("input-name"));
	$(".titlemodal").html($(this).attr("input-name"));
    $(".input-title").val($(this).attr("input-title"));
    $(".isthis img").attr({"src":$(this).attr("input-url")});
    $("input[name=textimg]").val($(this).attr("input-image"));
	$(".ukuran").html($(this).attr("ukuran"));
	$("input[name=link]").val($(this).attr("input-link"));
	$("input[name=id]").val($(this).attr("input-id"));
})

$('input[name=filegambar]').change(function(e) {
    $(".isthis").html("");
    var file = e.target.files[0];
    var evidence = $(this).attr("evidence");
    $(this).attr("disabled", true);
    canvasResize(file, {
        width: 1188,
        height: 400,
        crop: false,
        quality: 100,
        //rotate: 90,
        callback: function(data, width, height) {
            // Create a new formdata
            var fd = new FormData();
            // Add file data
            var f = canvasResize('dataURLtoBlob', data);
            f.name = file.name;

            fd.append("filegambar", f);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', base_url+'general/uploadfilecanvas', true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader("pragma", "no-cache");
            xhr.addEventListener("load", function(e) {
                var response = JSON.parse(e.target.responseText);
                var string = response.filename;
                var filenametrue = string.replace("public/tmp/", "");
                var str_input = '<input name="textimg" value="' + filenametrue + '" type="hidden" class="hidden-xs-up">';
                $(".isthis").html('<img class="img-fluid"  src="'+base_url+'public/tmp/' + filenametrue + '">'+str_input);
            }, false);
            // Send data
            xhr.send(fd);

        }
    });
});