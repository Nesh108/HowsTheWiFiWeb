<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script>


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
                    '<p>' + data[i]["comments"] +'</p>'+
                    '</div>'+
                    '</div>';

                    var infowindow = new google.maps.InfoWindow({
                      content: contentString
                    });

                    marker = new google.maps.Marker({
                        position: {lat: data[i]["latitude"], lng: data[i]["longitude"]},
                        map: map,
                        title: data[i]["name"]
                    });

                    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                        return function() {
                            infowindow.setContent(content);
                            infowindow.open(map,marker);
                        };
                    })(marker,content,infowindow));
                }
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