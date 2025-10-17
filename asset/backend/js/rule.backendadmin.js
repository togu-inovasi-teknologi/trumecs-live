var valuemenu = $(".valuemenu").attr("content");
if ($(".valuemenu").length>0) {
	var index;
	var a = valuemenu.split(",");
	for (index = 0; index < a.length; ++index) {
	    $("input[type=checkbox]#menu_"+a[index]).prop( "checked", function( i, val ) {
		  return !val;
		});
	}
};



if ($(".menuurlselect").length>0) {
	var menuurlselect = $(".menuurlselect").attr("content");
	$(".menuurlselect option[value="+menuurlselect+"]").prop( "selected", function( i, val ) {
		  return !val;
		});
};