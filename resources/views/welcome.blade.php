<!DOCTYPE html>
<html>
  <head>
    <style>
        html { height: 100% }
        body { height: 100%; margin: 0px; padding: 0px }
        #map { height: 100% }
    </style>
  </head>
  <body>
    <h3>WiFi Speeds around the World</h3>
    <div id="map"></div>

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script>

       var connectionRanges = [10, 100, 1000, 10000, Number.MAX_SAFE_INTEGER];
       var connectionColors = [ "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                                "https://maps.google.com/mapfiles/ms/icons/orange-dot.png",
                                "https://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
                                "https://maps.google.com/mapfiles/ms/icons/green-dot.png",
                                "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                                ];

     function getColorFromSpeed(downloadSpeed) {
        for(var i = 0; i < connectionRanges.length; i++) {
            if(downloadSpeed <= connectionRanges[i]) {
                return connectionColors[i];
            }
        }
     }

      function initMap() {
        $.ajax({
          url: "/api/wifispeed?min_latitude=-89&max_latitude=89&min_longitude=-180&max_longitude=180",
          cache: false,
           type: "GET",
           contentType: "application/json",
           dataType: "json",
          success: function(data) {
            if(data.length > 0) {
                var first_element = { lat: data[0]["latitude"], lng: data[0]["longitude"] };
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 1,
                  center: first_element
                });

                var marker;
                for (var i = 0; i < data.length; i++) {
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h1 id="firstHeading" class="firstHeading">' + data[i]["name"] +'</h1>'+
                    '<div id="bodyContent">'+
                    '<p><b>Comments:</b> ' + data[i]["comments"] +'</p>'+
                    '<p><b>Download:</b> ' + data[i]["download"]/1000 +' Kb/s</p>'+
                    '<p><b>Upload:</b> ' + data[i]["upload"]/1000 +' Kb/s</p>'+
                    '<p><b>Ping:</b> ' + data[i]["ping"] +' ms</p>'+
                    '<p><b>Packet Loss:</b> ' + data[i]["packet_loss"] +'%</p>'+
                    '</div>'+
                    '</div>';

                    var infowindow = new google.maps.InfoWindow({
                      content: contentString
                    });

                    marker = new google.maps.Marker({
                        icon: getColorFromSpeed(data[i]["download"]/1000),
                        position: {lat: data[i]["latitude"], lng: data[i]["longitude"]},
                        map: map,
                        title: data[i]["name"],
                        animation: google.maps.Animation.DROP
                    });

                    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                        return function() {
                            infowindow.setContent(content);
                            infowindow.open(map,marker);
                        };
                    })(marker,content,infowindow));
                }
            }
            
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
              });
            }

          }
        });

      }
    </script>




















    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_-_fpeb4PL3N9JMzP4NJnVF_rBBG08pU&callback=initMap">
    </script>
  </body>
</html>