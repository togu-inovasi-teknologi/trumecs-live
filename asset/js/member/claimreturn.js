var base_url = $("body").attr("baseurl");
$(".formreturn").validator();
$("select[name=idorder]").change(function() {
    var val = $(this).val();
    $(".productall").load(base_url + "member/formgetproduct?order=" + val);
});

$('input[name=filegambar]').change(function(e) {
    var file = e.target.files[0];
    var evidence = $(this).attr("evidence");
    $(this).attr("disabled", true);
    canvasResize(file, {
        width: 500,
        height: 400,
        crop: false,
        quality: 80,
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
                var str_input = '<input name="pic_evidence" value="' + filenametrue + '" type="text" class="hidden-xs-up">';
                if (evidence>=2) {
                	var str_input = '<input name="pic_evidencechras[]" value="' + filenametrue + '" type="text" class="hidden-xs-up">';
                };
                $(".evidence"+evidence).html('<img class="img-responsive"  src="'+base_url+'public/tmp/' + filenametrue + '">'+str_input+' <div class="clearfix"></div>')
                //$('input[evidence='+evidence+']').attr("disabled", false);

            }, false);
            // Send data
            xhr.send(fd);

        }
    });
});