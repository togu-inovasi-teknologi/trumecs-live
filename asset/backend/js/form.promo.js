var base__url= $("body").attr("baseurl");
$(document).ready(function(){
    $('#table-promo').DataTable();
});


$("input[type=file]").on("change",function() {
	var str=$(this).val();
    readURL(this);
	$(".file-custom").attr('data-content',"..."+str.substring(str.length,str.length-9));
})

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
}



$('input[name=filegambar]').change(function(e) {
    var file = e.target.files[0];
    $(this).attr("disabled", true);
    canvasResize(file, {
        width: 2000,
        height: 2000,
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
            xhr.open('POST', base__url+'general/uploadfilecanvas', true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader("pragma", "no-cache");
            xhr.addEventListener("load", function(e) {
                var response = JSON.parse(e.target.responseText);
                var string = response.filename;
                var filenametrue = string.replace("public/tmp/", "");
                var str_input = '<input name="txtfilegambar" value="' + filenametrue + '" type="text" class="hidden-xs-up"><input name="asknew" value="yesnew" type="hidden" class="hidden-xs-up">';
                $(".tampung").html('<img class="img-fluid"  src="'+base__url+'public/tmp/' + filenametrue + '">'+str_input+' <div class="clearfix"></div>')
            }, false);
            // Send data
            xhr.send(fd);

        }
    });
});