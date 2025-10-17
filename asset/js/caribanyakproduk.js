$(".btn-addform").on("click",function() {
	natural=$(".formadd .form-moresearch").length-1;
	ne_detect=$(".formadd .form-moresearch").length;

	if ($(".fms_xx").val()!="") {
		var random = Math.random().toString(36).substring(7);
		$(".formadd").append('<div class="form-moresearch formfms_'+random+'">'+
	          '<select name="col[]">'+
	            '<option value="tittle">Nama</option>'+
	            '<option value="partnumber">Part Number</option>'+
	            '<option value="physicnumber">Physic Number</option>'+
	          '</select>'+
	          '<input  name="name[]" required type="text" id="fms_'+random+'" placeholder="ketik yang di cari" class="fms_xx" >'+
	          '<i class="fa fa-times-circle delpromxx" id="'+random+'"></i>'+
	        '</div>');
	}else{
		$(".fms_xx").focus();
	};
	
});



$(document).on("click",".delpromxx",function() {
	var getindex = $(".delpromxx").index(this);
	$(".form-moresearch").eq(getindex).remove();
});

$(".progress").fadeOut();

$( ".crxformxxx" ).submit(function( event ) {

	// Stop form from submitting normally
	event.preventDefault();
	$(".retrunallsearchingajax").fadeOut();
	$(".progress").attr("value","0").fadeIn();


	  // Get some values from elements on the page:
	  var $form = $( this ),
	  data= $form.serializeArray(),
	  limit= $("input[name=limit]").val(),
	  url = $form.attr( "action" );

	  	// Send the data using post
	  	var posting = $.post( url, { data:data,limit:limit});
	  	posting.always(function() {
	  		$(".progress").animate({
			    value:80
			}, 2000);
			$(".retrunallsearchingajax").fadeOut();
		});
	  	// Put the results in a div
		posting.done(function( data ) {
	  		$(".progress").animate({
			    value:100
			}, 1000,function() {
				$(".retrunallsearchingajax").html(data).fadeIn();
			}).fadeOut();
		});

});

