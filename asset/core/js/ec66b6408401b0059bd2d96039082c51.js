var base_url = $("body").attr("baseurl");

$("select[name=merek]").load(base_url+"general/getmerekall");
$("select[name=komponen]").load(base_url+"general/getcomponentall");

$("select[name=merek]").change(function(argument) {
	var value = $(this).val();
	$("select[name=tipe]").load(base_url+"general/gettype/"+value);
});


$( document ).ready(function() {

	setTimeout(function() {
		var formsearch=$(".form-filter-search");
		var seletedbrand= formsearch.attr("seletedbrand");
		var seletedtype= formsearch.attr("seletedtype");
		var seletedcomponent= formsearch.attr("seletedcomponent");
		if (seletedbrand!="") {
			$("select[name=merek]").val(seletedbrand);
			$("select[name=tipe]").load(base_url+"general/gettype/"+seletedbrand);
		};
		setTimeout(function() {
			if (seletedtype!="") {
				$("select[name=tipe]").val(seletedtype);
			};
		}, 2000);
		if (seletedcomponent!="") {
			$("select[name=komponen]").val(seletedcomponent);
		};
	}, 2000);

});

