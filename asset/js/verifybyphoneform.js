var base_url = $("body").attr("baseurl");


$(document).on("click",".nbr_xxx_pts",function(event) {
	event.preventDefault();
	var nbr_xxx = $("#nbr_xxx").val();
	$.post( "sentsms", { phone: nbr_xxx})
	  .done(function( data ) {
		$(".number-verify").fadeOut();
		$(".code-verify").fadeOut().html(data).fadeIn();
	  });
})

$(document).on('click',"#show-number-verify",function(event) {
	event.preventDefault();
	$(".code-verify").fadeOut().html('');
	$(".number-verify").fadeIn();
})

$(document).on('click',"#sent-again",function(event) {
	event.preventDefault();
	var nbr_xxx = $(this).attr("number");
	$.post( "sentsms", { phone: nbr_xxx})
	  .done(function( data ) {
		$(".number-verify").fadeOut();
		$(".code-verify").fadeOut().html(data).fadeIn();
	  });
})


$(document).on("click",".cd_xxx_pts",function(event) {
	event.preventDefault();
	$(".code-verify").fadeOut();
	var phone = $("#cd_xxx").attr("phoneto");
	var cd_xxx = $("#cd_xxx").val();
	$.post( "checkveryfibyphone", { phone: phone,code:cd_xxx})
	  .done(function( data ) {
		$(".code-verify").fadeOut();
		$(".status-verify").fadeOut().html(data).fadeIn();
	  });
})