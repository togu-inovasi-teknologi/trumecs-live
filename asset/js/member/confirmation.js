/*document.getElementById("uploadBtn").onchange = function () {
	document.getElementById("filetext").innerHTML = this.value;
    readURL(this.value)
	if (this.value=="") {
		document.getElementById("filetext").innerHTML = "Pilih file";
	};
};*/

$(document).on("change","input[type=file]",function() {
    var str=$(this).val();
    readURL(this);
    $(this).attr('data-content',"..."+str.substring(str.length,str.length-9));
    $("input[name=img_new]").val("yes");
})

$(document).ready(function() {
    $("select[name=idorder]").val($("select[name=idorder]").attr("selectid"));
    $("select[name=bank]").val($("select[name=bank]").attr("selectid"));
})

$('.formconfirmation').validator();
$('.money').number( true );
$('.money').blur(function(argument) {
	var value_palsu = $(this).val().replace(/[,]/g, "");
	$("#money_rp").val(value_palsu);
});

$(document).on('change',"select[name=idorder]", function() {
    var totalbayar = $(this).find("option:selected").attr("totalbayar");
    if (totalbayar!=0) {
    	$(".harusbayar").html("Total yang harus di bayar Rp."+totalbayar);
    }else{
    	$(".harusbayar").html("");
    };
  });

 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }