var base_url = $("body").attr("baseurl");
$("select[name=jenisproduct]").load(base_url+"general/getcomponentall",function(argument) {
	var mustvalue = $(this).attr("tar");
	$(this).val(mustvalue);
});
$("select[name=category]").load(base_url+"general/getcomponentall",function(argument) {
	var mustvalue = $(this).attr("seletedcategory");
	$(this).val(mustvalue);
});


$(document).ready(function(argument) {
	var seletedpenawaran = $("select[name=jenis_penawaran]").attr("seletedpenawaran");
	$("select[name=jenis_penawaran]").val(seletedpenawaran);
	var seletedcategory = $("select[name=category]").attr("seletedcategory");
	$("select[name=category]").val(seletedcategory);
})

$("input[type=file]").on("change",function() {
	var str=$(this).val();
    readURL(this);
	$(".file-custom").attr('data-content',"..."+str.substring(str.length,str.length-9));
})

$("select[name=brand]").on("change",function() {
	$("#changemerek").html($(this).find("option:selected").text());
})
$("select[name=type]").on("change",function() {
	$("#changetipe").html($(this).find("option:selected").text());
})
$("select[name=component]").on("change",function() {
	$("#changekomponent").html($(this).find("option:selected").text());
})
$("select[name=quality]").on("change",function() {
	$("#changequality").html($(this).find("option:selected").text());
})
$("select[name=packagin]").on("change",function() {
	$("#changepackagin").html($(this).find("option:selected").text());
})


$("*[jq-model]").on("change",function(argument) {
	var name= $(this).attr("jq-model");
	$('span[js-result="'+name+'"]').text($(this).val());
});



$( document ).ready(function() {

	setTimeout(function() {
		var formsearch=$(".form-filter-search");
		var seletedpenawaran= formsearch.attr("seletedpenawaran");
		var seletedtype= formsearch.attr("seletedtype");
		var seletedcomponent= formsearch.attr("seletedcomponent");
		//console.log($("select[name=brand]").val();
		if ($("select[name=brand]").val()!="") {
			$("#changemerek").html($("select[name=brand]").find("option:selected").text());
			$("#changetipe").html($("select[name=type]").find("option:selected").text());
			$("#changekomponent").html($("select[name=component]").find("option:selected").text());
			
		}
		else{
			$("#changemerek").html('');
			$("#changetipe").html($(this).find("option:selected").text());
			$("#changekomponent").html($(this).find("option:selected").text());
			
			
		};
		setTimeout(function() {
			if (seletedpenawaran!="") {
				$("select[name=jenis_penawaran]").val(seletedpenawaran);
			};
		}, 2000);
		if (seletedcomponent!="") {
			$("select[name=komponen]").val(seletedcomponent);
		};
	}, 2000);
	
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

$(document).ready(function() {
	$('.pilihjenisproduk').modal('show');
	$('select[name=jenisproduct]').val($('select[name=jenisproduct]').attr("tar"));
});
$(document).on('click','.choicejenis',function(e) {
	$('.input_choicejenis').val($(this).attr('val'));
	$('.pilihjenisproduk').modal('hide');
	$("select[name=quality]").load(base_url+"general/getgradeform/"+$(this).attr('val'),function(argument) {
	});
	$("select[name=brand]").load(base_url+"general/getbrandform/"+$(this).attr('val'),function(argument) {
	});
	//$("select[name=quality]").val(seletedgrade);
	$("select[name=component]").load(base_url+"general/getcomponentall_form/"+$(this).attr('val'),function(argument) {
		
	});
});
