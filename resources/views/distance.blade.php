<!DOCTYPE html>
<html>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDTZCIGTe9GKbiJBiOkyx-wi8A26dD73o&libraries=geometry">
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<head>
    <style>
        #map {
            height: 700px;
            width: 65%;
        }
        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
        #target {
            width: 345px;
        }

    </style>
</head>
<body>


<h3>My Google Maps Demo</h3>


<input id="pac-input"  type="text">
<div id="map"></div>




<script>

    function initMap() {
        
        //Start 
        var positionStart = new google.maps.LatLng(45.253385, 19.845881);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,

            center: positionStart
        });
        //Devtech center position marker
        var markerStart = new google.maps.Marker({
            position: positionStart,
            label: 'Start',
            map: map
        });
        //Destination marker
        var destination = new google.maps.Marker({
            position: positionStart,
            label: 'End',
            map: map

        });

        //Line between 2 markers
        poly = new google.maps.Polyline({
            strokeColor: '#ff3844',
            strokeOpacity: 1.0,
            strokeWeight: 3,
            map: map
        });
        destination.setVisible(false);

        var input = document.getElementById('pac-input');

        var searchBox = new google.maps.places.SearchBox(input);


        // Bias the SearchBox results towards current map's viewport.
        /*  map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
          }); */

        google.maps.event.addListener(map, "click", function (event) {

            //var latitude = event.latLng.lat();
            //var longitude = event.latLng.lng();
            var position = event.latLng;
            destination.setPosition(position);
            destination.setVisible(true);


            var path = [markerStart.getPosition(), destination.getPosition()];
            poly.setPath(path);
            poly.setVisible(true);


            var distance = google.maps.geometry.spherical.computeDistanceBetween(markerStart.getPosition(), position);
            //console.log(distance2);

            var trueDistance = (distance / 1000).toFixed(2);

            // $('#trueDistance').val(trueDistance);

            $("#GoogleMapDistance").html("The distance is " + trueDistance + " km from start position");

            console.log(trueDistance);


        });

        google.maps.event.addListener(searchBox, 'places_changed', function () {

            var places = searchBox.getPlaces();

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                markerStart.setPosition(place.geometry.location);

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }

            });
            destination.setVisible(false);
            poly.setVisible(false);
            map.fitBounds(bounds);

        });

    }
</script>

<p id="GoogleMapDistance">
    Select a point
</p>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDTZCIGTe9GKbiJBiOkyx-wi8A26dD73o&libraries=places&callback=initMap"
        async defer>
</script>
</body>
</html>