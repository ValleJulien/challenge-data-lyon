<body onload="initialize('')">




<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            var geocoder;
            var map;

            function initialize(address) {


                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(48.3990184, 2.687389);
                var myOptions = {
                zoom: 10,
                center: latlng,
                mapTypeControl: true,
                mapTypeControlOptions: {
                  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
                navigationControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
                };


                tab=address.split('/');
                
                for (i = 0; i < tab.length; i++) 
                { 
                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                    if (geocoder) 
                    {
                        geocoder.geocode(
                        {
                          'address': tab[i]
                        }, function(results, status) {
                          if (status == google.maps.GeocoderStatus.OK) {
                            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                              map.setCenter(results[0].geometry.location);

                              var infowindow = new google.maps.InfoWindow({
                                content: '<b>' + tab[i] + '</b>',
                                size: new google.maps.Size(150, 50)
                              });

                              var marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map,
                                title: tab[i]
                              });
                              google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map, marker);
                              });

                            } else {
                              alert("No results found");
                            }
                          } else {
                            alert("Geocode was not successful for the following reason: " + status);
                          }
                        });

                    }

                  }
                }
                google.maps.event.addDomListener(window, 'load', initialize);
        </script>