
function initAutocomplete() {
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
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
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
        });

  $(".collapse").on('shown.bs.collapse', function () {
      $(".loader").fadeIn();
      var resultshowin = $(this).attr("showin");
      $(resultshowin).html("");
      url = base_url+'cart/cost_delivery_ojek';
      chooseojek = $(this).attr("kurir"); 
      distance = $(this).attr("jarak"); 
      detail_address = $(this).attr("detail"); 
      duration= $(this).attr("jarak");
      loc_google = $(this).attr("alamat"); 
      if (resultshowin) {
      $.post(url,{chooseojek:chooseojek,jarak:distance, estimasi: duration,loc_google:loc_google,detail_address:detail_address},function(cost){
                                result = JSON.parse(cost);
                                if(result['status'] == '200'){
                                  $(".loader").fadeOut();
                                  $(resultshowin).html(result['message']);
                                }else{
                                  $(".loader").fadeIn();
                                }
                                
                            });
      };
  });
  $(document).on("click",".dasjne",function(e) {
    e.preventDefault();
    var keyid = $(this).attr("keyid");
    $.post( $(this).attr("ajaxurl"),{ id: keyid}, function( data ) {
    $( ".keyid"+keyid).html( data );
  });
  });