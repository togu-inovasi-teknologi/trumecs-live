var base_url = $("body").attr("baseurl");

$(document).on("click",".changetoforminputareajne",function(event) {
	var kode_id = $(this).attr("kodeid");
	var kode_jne = $(this).attr("jne");
	$(".divchangetoforminputareajne"+kode_id).html('<form class="updatekodejnedistrict" kode="'+kode_id+'" action="'+base_url+'backendsetting/updatewilayah" method="POST"><div class="input-group input-group-sm"> <input type="hidden" class="form-control" name="id" value="'+kode_id+'"> <input name="kode_jne" type="text" class="form-control" value="'+kode_jne+'"> <span class="input-group-btn"> <button class="btn btn-primary" type="submit">Simpan</button> </span> </div></form>');
})

// Attach a submit handler to the form
$(document).on("submit",".updatekodejnedistrict",function( event ) {
	
//$( ".updatekodejnedistrict" ).submit(function( event ) {
  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
    id = $form.find( "input[name='id']" ).val(),
    term = $form.find( "input[name='kode_jne']" ).val(),
    kode = $form.attr( "kode" ),
    url = $form.attr( "action" );
 
  // Send the data using post
  var posting = $.post( url, { kode_jne: term ,id:id} );
 
  // Put the results in a div
  posting.done(function(data ) {
    $( ".divchangetoforminputareajne"+kode).html(data);
  });
});