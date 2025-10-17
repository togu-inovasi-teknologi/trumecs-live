
var base_url = $("body").attr("baseurl");

$("select[name=merek]").load(base_url+"general/getmerekall/all/false");
$("select[name=komponen]").load(base_url+"general/getcomponentall");


$("select[name=komponen]").change(function(argument) {
	var value = $(this).val();
	$("select[name=sub_kategori]").load(base_url+"general/getsubkategori/"+value, function() {
		if($("select[name=sub_kategori] option[value='"+$(".form-filter-search").attr("seletedsub")+"']").length > 0) {
			$(this).val($(".form-filter-search").attr("seletedsub"));
		} else {
			$(this).val("0");
		}
	});
	$("select[name=merek]").load(base_url+"general/getmerekall/"+value+"/false",function(){
		$("select[name=merek]").val($(".form-filter-search").attr("seletedbrand"));
		if($("select[name=merek] option[value='"+$(".form-filter-search").attr("seletedbrand")+"']").length > 0) {
			$(this).val($(".form-filter-search").attr("seletedbrand"));
		} else {
			$(this).val("");
		}
	});
	console.log(value);
	$("select[name=quality]").load(base_url+"general/getgradeall/"+value+"/false",function(){
		$("select[name=quality]").val($(".form-filter-search").attr("seletedquality"));
		if($("select[name=quality] option[value='"+$(".form-filter-search").attr("seletedquality")+"']").length > 0) {
			$(this).val($(".form-filter-search").attr("seletedquality"));
		} else {
			$(this).val("");
		}
	});
	
});


/*$('.format-uang').mask('000.000.000.000', {
    reverse: true
    });*/

$( document ).ready(function() {

	setTimeout(function() {
		var formsearch=$(".form-filter-search");
		var seletedbrand= formsearch.attr("seletedbrand");
		var seletedtype= formsearch.attr("seletedtype");
		var seletedsub= formsearch.attr("seletedsub");
		var seletedcomponent= formsearch.attr("seletedcomponent");
		var seletedquality= formsearch.attr("seletedquality");
		if (seletedbrand!="") {
			//$("select[name=merek]").val(seletedbrand);
			//$("select[name=tipe]").load(base_url+"general/gettype/"+seletedbrand);
			$("select[name=merek]").load(base_url+"general/getmerekall/"+seletedcomponent+"/false",function(){
				$("select[name=merek]").val($(".form-filter-search").attr("seletedbrand"));
			});
		};
		if (seletedquality!="") {
			$("select[name=quality]").val(seletedquality);
		};
		if (seletedcomponent!="") {
			$("select[name=komponen]").val(seletedcomponent);
			$("select[name=sub_kategori]").load(base_url+"general/getsubkategori/"+seletedcomponent, function() {
				if($("select[name=sub_kategori] option[value='"+$(".form-filter-search").attr("seletedsub")+"']").length > 0) {
					$(this).val($(".form-filter-search").attr("seletedsub"));
				} else {
					$(this).val("0");
				}
			});
			$("select[name=merek]").load(base_url+"general/getmerekall/"+seletedcomponent+"/false",function(){
				$("select[name=merek]").val($(".form-filter-search").attr("seletedbrand"));
				if($("select[name=merek] option[value='"+$(".form-filter-search").attr("seletedbrand")+"']").length > 0) {
					$(this).val($(".form-filter-search").attr("seletedbrand"));
				} else {
					$(this).val("");
				}
			});
			$("select[name=quality]").load(base_url+"general/getgradeall/"+seletedcomponent+"/false",function(){
				$("select[name=quality]").val($(".form-filter-search").attr("seletedquality"));
				if($("select[name=quality] option[value='"+$(".form-filter-search").attr("seletedquality")+"']").length > 0) {
					$(this).val($(".form-filter-search").attr("seletedquality"));
				} else {
					$(this).val("");
				}
			});
		};
		setTimeout(function() {
			if (seletedtype!="") {
				$("select[name=tipe]").val(seletedtype);
			};
			if (seletedsub!="") {
				$("select[name=sub_kategori]").val(seletedsub);
			};
		}, 2000);
		
	}, 2000);
	



	/* $("input[name=minp]").number( true );
	$("input[name=maxp]").number( true );
	$("input[name=minp]").val($(".filterprice").attr("minp"));
	$("input[name=maxp]").val($(".filterprice").attr("maxp"));
	document.getElementById("minp").onblur = function() {fp()};
	document.getElementById("maxp").onblur = function() {fp()};
	function fp() {
		var minp = Number($("input[name=minp]").val().replace(/[,]/g, ""));
		var maxp = Number($("input[name=maxp]").val().replace(/[,]/g, ""));
		if ((maxp>minp)==true) {
			$("input[name=minp]").val(minp);
			$("input[name=maxp]").val(maxp);
			document.getElementById("submitprice").submit();
		}else{
			$("input[name=maxp]").popover("show");
		};
	}; */
});

