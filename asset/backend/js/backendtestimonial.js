$(".fafafafa").on("click",function(event) {
	event.preventDefault();
	var $area = $(".modal-edit");
	var id = $area.find("input[name=id]").val($(this).attr("idtbl"));
	var name = $area.find("input[name=name]").val($(this).attr("name"));
	var email = $area.find("input[name=email]").val($(this).attr("email"));
	var date = $area.find("input[name=date]").val($(this).attr("date"));
	var emote = $area.find("input[name=emote]").val($(this).attr("emote"));
	var content = $area.find("textarea[name=content]").val($(this).attr("content"));
})