	var base_url =$("body").attr("baseurl");
	$(".quantity").change(function() {
	    var qty = $(this).val();
	    var method = $(this).attr('data-method');
	    var id = $(this).attr('data-produk');
	    var rowid = $(this).attr('data-rowid');
	    var url = base_url+'cart/update';
	    // Send the data using post
	    var update = $.post(url, {
	        qty: qty,
	        method: method,
	        id: id,
	        rowid: rowid
	    });
	    // Put the results in a div
	    update.done(function(data) {
	        location.reload();
	    });
	})
	$(".method").change(function() {
	    var qty = $(this).attr('data-qty');
	    var method = $(this).val();
	    var id = $(this).attr('data-produk');
	    var rowid = $(this).attr('data-rowid');
	    var url = base_url+'cart/update';
	    // Send the data using post
	    var update = $.post(url, {
	        qty: qty,
	        method: method,
	        id: id,
	        rowid: rowid
	    });
	    // Put the results in a div
	    update.done(function(data) {
	        location.reload();
	    });
	})
	$(".delproduct").click(function() {
	    var qty = $(this).attr('data-qty');
	    var id = $(this).attr('data-produk');
	    var rowid = $(this).attr('data-rowid');
	    var url = base_url+'cart/update';
	    // Send the data using post
	    var update = $.post(url, {
	        qty: qty,
	        id: id,
	        rowid: rowid
	    });
	    // Put the results in a div
	    update.done(function(data) {
	        location.reload();
	    });
	})


$('.formshipping').validator();
/*$( document ).ready(function() {
	var base_url= $("body").attr("baseurl");
	$("select[name=shipping_city]").load(base_url+"general/getcity");
});*/

$(".triger_show_from").click(function() {
	$(".show").fadeOut().addClass("hidden-xl-down");
	$(".show_after_click").removeClass("hidden-xl-down");
})

$(".triger_show_from_truely").click(function() {
	$(".show_truely").fadeOut().addClass("hidden-xl-down");
	$(".show_after_click_truely").removeClass("hidden-xl-down");
})

var true_xx= 0;

$(".true_lah").click(function() {
	true_xx= 1;
	$( ".formshipping" ).trigger( "submit" );
	/*$(".formshipping").submit(function() {
		return true;
	});*/
});

$(".formshipping").submit(function() {
/*	var kota = $(".select-city").val();
	var showmodalcost =$(".showmodalcost");
	var totalhargaberat =showmodalcost.attr("totalhargaberat");
	var totalsemau =showmodalcost.attr("totalsemau");
	var totalpercent =showmodalcost.attr("totalpercent");
	var totalbataspercent =showmodalcost.attr("totalbataspercent");
	var duapersen =showmodalcost.attr("duapersen");
	if (totalhargaberat>=duapersen) {
		if (true_xx==0) {
			$(".modelcekfreeongkir").modal('show');
			$(".select-city-modal").html(kota);
			$("harga-modal").html("Rp.300,000");
			return false;
		};
	};
	*/
	
});

$("#one_click").click(function(){
	$(this).replaceWith('<span class="btn btnnew disabled">'+ $( this ).text() + "</span>");
})


$( document ).ready(function() {
	var base_url= $("body").attr("baseurl");
	var id_shipping_province=$("select[name=shipping_province]").attr("id");
	var id_shipping_city=$("select[name=shipping_city]").attr("id");
	var id_shipping_districts=$("select[name=shipping_districts]").attr("id");
	var id_shipping_village=$("select[name=shipping_village]").attr("id");
	$("select[name=shipping_province]").val(id_shipping_province);

  $(".collapse").on('shown.bs.collapse', function () {
      $(".loader").fadeIn();
      $($(this).attr("resultjne")).html("");
      $($(this).attr("resultjne")).load(base_url+"general/getservice_trumecsdelivery?id="+$(this).attr("togetjne")+"&id_kab="+$(this).attr('kodejabodetabek'),function() {
        $(".loader").fadeOut();
        $(".loadernewaddress").fadeOut();
              });
  })

  $(document).on("click",".dasjne",function(e) {
    e.preventDefault();
    var keyid = $(this).attr("keyid");
    $.post( $(this).attr("ajaxurl"),{ id: keyid}, function( data ) {
    $( ".keyid"+keyid).html( data );
  });
  })

  $(document).on("input","input[tocopy=tocopy]",function(e) {
    e.preventDefault();
    $("input[name="+$(this).attr("name")+"]").val($(this).val());
  })
/*	$.ajax({
	    url: base_url+ "general/getwilayahprovince_json",
	    dataType: "JSON",
	    success: function(json){
	    	$("select[name=shipping_province]").html("");
	        for (i in json)
				{	
	    			var str_select="";
					if (id_shipping_province==json[i].id) {str_select="selected"};
					$("select[name=shipping_province]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
				}*/
				$.ajax({url: base_url+ "general/getwilayahrigences_json?id="+id_shipping_province,dataType: "JSON",
					    success: function(json){
					    	$("select[name=shipping_city]").html("");
					        for (i in json)
								{	
					    			var str_select="";
									if (id_shipping_city==json[i].id) {str_select="selected"};
									$("select[name=shipping_city]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
								}
								$.ajax({url: base_url+ "general/getwilayahdistricts_json?id="+id_shipping_city,dataType: "JSON",
									    success: function(json){
									    	$("select[name=shipping_districts]").html("");
									        for (i in json)
												{	
									    			var str_select="";
													if (id_shipping_districts==json[i].id) {str_select="selected"};
													$("select[name=shipping_districts]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
												}
											$(".resultjneservice").load(base_url+"general/getservice_trumecsdelivery?id="+id_shipping_city+"&id_kab="+$("select[name=shipping_city]").val(),function() {
												$(".loader").fadeOut();
											});
											$.ajax({url: base_url+ "general/getwilayahvillages_json?id="+id_shipping_districts,dataType: "JSON",
											    success: function(json){
											    	$("select[name=shipping_village]").html("");
											        for (i in json)
														{	
											    			var str_select="";
															if (id_shipping_village==json[i].id) {str_select="selected"};
															$("select[name=shipping_village]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
														}
											    }
											})
									    }
								})
					    }
				})
/*	    }
	});*/
	$(document).on("change","select[name=shipping_province]",function() {
			var id = $(this).val();
			$.ajax({url: base_url+ "general/getwilayahrigences_json?id="+id,dataType: "JSON",
				    success: function(json){
				    	$("select[name=shipping_city]").html("<option>Pilih Kabupaten</option>");
				    	$("select[name=shipping_districts]").html("<option>-sedang mengambil data...-</option>");
				    	$("select[name=shipping_village]").html("<option>-sedang mengambil data...-</option>");

				        for (i in json)
							{	
				    			var str_select="";
								$("select[name=shipping_city]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
							}
				    }
			})
	});

	$(document).on("change","select[name=shipping_city]",function() {
			var id = $(this).val();
			$.ajax({url: base_url+ "general/getwilayahdistricts_json?id="+id,dataType: "JSON",
				    success: function(json){
				    	$("select[name=shipping_districts]").html("<option>Pilih Kecamatan</option>");
				    	$("select[name=shipping_village]").html("<option>-sedang mengambil data...-</option>");
				        for (i in json)
							{	
				    			var str_select="";
								$("select[name=shipping_districts]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
							}
				    }
			})
	});

	$(document).on("change","select[name=shipping_districts]",function() {
			var id = $(this).val();
			var id_kab= $("select[name=shipping_city]").val();
			$(".loadernewaddress").fadeIn();
			$.ajax({url: base_url+ "general/getwilayahvillages_json?id="+id,dataType: "JSON",
				    success: function(json){
				    	$("select[name=shipping_village]").html("<option>Pilih Desa</option>");
				        for (i in json)
							{	
				    			var str_select="";
								$("select[name=shipping_village]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
							}
						$(".resultjneservice").load(base_url+"general/getservice_trumecsdelivery?id="+id+"&id_kab="+id_kab,function() {
							$(".loadernewaddress").fadeOut();
						});
				    }
			})
	});



});

$(document).on("change","input[type=file]",function() {
    var str=$(this).val();
    readURL(this);
    $(this).attr('data-content',"..."+str.substring(str.length,str.length-9));
    $("input[name=img_new]").val("yes");
})

 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }