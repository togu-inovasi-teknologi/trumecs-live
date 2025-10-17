base_url= $("body").attr("baseurl");

/*function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -6.2312686, lng: 106.9854245},
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.radius
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.componentRestrictions);
            }
          });
          map.fitBounds(bounds);
        });
      }

  base_url= $("body").attr("baseurl");
  $('#getlocation').click(function(){
          if($('#pac-input').val() == ''){
            $('.viewinfocost').html('<div class="alert alert-danger"><strong>Maaf</strong><p>Isi terlebih dahulu alamat pengiriman di area peta</p></div>');
             alert('harap masukkan alamat pengiriman');
             $('#pac-input').focus(); 
          }else{
              loc_google = $('#pac-input').val();
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
                  {
                    origins: ['-6.2312617,106.9844475'], //''array of origins
                    destinations: [loc_google], //aray of destionations
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                  }, function(response, status){
                      if(status==google.maps.DistanceMatrixStatus.OK){
                            var origins = response.originAddresses;
                            var destinations = response.destinationAddresses;
                        
                            for (var i = 0; i < origins.length; i++) {
                              var results = response.rows[i].elements;
                              for (var j = 0; j < results.length; j++) {
                                var element = results[j];
                                var distance = element.distance.text;
                                var duration = element.duration.text;
                                var chooseojek= $("#ojeknya").val();
                                var from = origins[i];
                                var to = destinations[j];
                              }
                            }
                            url = base_url+'cart/cost_delivery_ojek';  
                            $.post(url,{chooseojek:chooseojek,jarak:distance, estimasi: duration,loc_google:loc_google},function(cost){
                                result = JSON.parse(cost);
                                if(result['status'] == '200'){
                                    $('.viewinfocost').html(result['message']);
                                }else{
                                }
                                
                            })
                           //$('.call-loc').html();
                           //$('.call-dur').html();
                      }
                  });
              }
        })*/

$( document ).ready(function() {

 var id_shipping_province=$("select[name=shipping_province]").attr("id");
  var id_shipping_city=$("select[name=shipping_city]").attr("id");
  var id_shipping_districts=$("select[name=shipping_districts]").attr("id");
  var id_shipping_village=$("select[name=shipping_village]").attr("id");
  $("select[name=shipping_province]").val(id_shipping_province);
  $(".collapse").on('shown.bs.collapse', function () {
      $(".loader").fadeIn();
      $($(this).attr("resultjne")).load(base_url+"general/getservice_jne?id="+$(this).attr("togetjne"),function() {
        $(".loader").fadeOut();
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

/*  $(document).on("change","input[type=checkbox]",function() {
    $("input[type=checkbox]").prop( "checked", false );
    $( this).prop( "checked", true );
    var jne_kode=$(this).attr("togetjne")
    var addr= $(this).attr("href");
    var result_jne= $(this).attr("jneresultto");
    
    $(".resultmustdel").html("");
    $(addr).collapse({
      parent:"addressgroup"
    });
    $(".collapse").on('shown.bs.collapse', function () {
      $(result_jne).load(base_url+"general/getservice_jne?id="+jne_kode,function() {
              });
    })
    
     
  });*/
/*   $.ajax({
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
                        $(".resultjneservice").load(base_url+"general/getservice_jne?id="+id_shipping_districts,function() {
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
/*      }
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
      $.ajax({url: base_url+ "general/getwilayahvillages_json?id="+id,dataType: "JSON",
            success: function(json){
              $("select[name=shipping_village]").html("<option>Pilih Desa</option>");
                for (i in json)
              { 
                  var str_select="";
                $("select[name=shipping_village]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
              }
              $(".resultjneservice").load(base_url+"general/getservice_jne?id="+id,function() {
              });
            }
      })
  });



});