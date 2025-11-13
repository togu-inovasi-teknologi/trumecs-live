var base_url = $("body").attr("baseurl");
var idprn="";var idctr="";var txtctr="";var img="";
$(".jq-edit").on("click",function(argument) {
	var idparent = $(this).attr("idparent");
	var idcategory = $(this).attr("idcategory");
	var text = $(this).attr("textcategory");
	var type = $(this).attr("typecategory");
	img = $(this).attr("img");

	idprn = idparent;
	idctr = idcategory;
	txtctr = text;
	txtimg = img;
	typectr = type;

	$('.collapseedit').collapse('hide');
	$('.collapseedit').collapse('show');
});

$('.collapseedit').on('shown.bs.collapse', function () {
	$('.collapseadd').collapse('hide');
	var tampung = $("tampung");
	var idparent = idprn; //tampung.attr("idparent");
	var idcategory = idctr;//tampung.attr("idcategory");
	var text = txtctr;//tampung.attr("textcategory");
	var type = typectr;//tampung.attr("textcategory");
	$(".tipeform").html("Form tambah "+type);
	
	$(".idcategory").val(idcategory);
	$(".textcategory").val(text);
	if (idparent=="prn") {
		$(".input-form").html('<input required type="hidden" name="parent" value="'+idparent+'"><input required type="hidden" name="imgold" value="'+img+'">');
	}else{
		if (type=="komponen") {
			//$(".input-form").html('<div class="col-md-3"><h5>Kategori Induk</h5><select required class="form-control" name="parent"></select></div><div class="col-md-3"><h5>Grade List</h5><div class="brand-list"></div></div><div class="col-md-3"><h5>Brand List</h5><div class="grade-list"></div></div>');
			$("select[name=parent]").load(base_url+"general/getcomponentall",function(argument) {
				$("select[name=parent]").val(idparent);
			});
			$(".grade-list").load(base_url+"general/getgradeall/"+idcategory,function(argument) {
				//$("select[name=grade]").val(idgrade);
			});
			$(".brand-list").load(base_url+"general/getmerekall/"+idcategory,function(argument) {
				//$("select[name=grade]").val(idgrade);
			});
			$(".attribute-list").load(base_url+"general/getattributeall/"+idcategory,function(argument) {
				//$("select[name=grade]").val(idgrade);
			});
		}else{
			$(".input-form").html('<div class="col-md-3"><select required class="form-control" name="parent"></select></div>');
			$("select[name=parent]").load(base_url+"general/getmerekall",function(argument) {
				$("select[name=parent]").val(idparent);
			});
		};
	
	};

	
idprn="";idctr="";txtctr="";img="";
});

$('.btnxxadd').on('click', function(){
	$('.collapseedit').collapse('hide');
	var who = $(this).attr("what");
	if (who =="komponen") {
		/* $(".parentorno").html('<div class="col-md-3"><h5>Kategori Induk</h5><select required class="form-control getallkomponen" name="parent"></select></div><div class="col-md-3"><h5>Grade List</h5><div class="grade-list"></div></div><div class="col-md-3"><h5>Brand List</h5><div class="brand-list"></div></div>'); */
		$(".parentorno").html('<select required class="form-control getallkomponen" name="parent"></select>');
		setTimeout(function() {
			$(".getallkomponen").load(base_url+"general/getcomponentall");
			$(".grade-list").load(base_url+"general/getgradeall/0");
			$(".brand-list").load(base_url+"general/getmerekall/0");
			$(".attribute-list").load(base_url+"general/getattributeall/0");
		},1000);
	} else if (who =="tipe") {
		$(".parentorno").html('<div class="col-md-3"><select required class="form-control getmerekallcategorybackend" name="parent"></select></div>');
		setTimeout(function() {
			$(".getmerekallcategorybackend").load(base_url+"general/getmerekall");
		},1000);
	}else{
		var prn="";
		if (who=="merek") {
			prn="prn";
		/* }else{
			prn="0"; */
		};
		$(".parentorno").html('<input required class="hidden-xs-up" name="parent" value="'+prn+'">')
	};
	$('.collapseadd').collapse('hide');
	$('.collapseadd').collapse('show');
	$(".tipeform").html("Form tambah "+who);
});