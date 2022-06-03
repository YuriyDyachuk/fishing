var labelIndex = 0;
var marker;
var lat = 53.894473;
var lng = 27.561389;
var region = [];
var geocoder;


function initMap() {
    var bangalore = { lat: lat, lng: lng };
    var map = new google.maps.Map(document.getElementById('mapReport'), {
        zoom: 8,
        center: bangalore
    });

    changeSelectRegion(map);

    google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng, map);
        document.getElementById('lat').value = marker.position.lat().toFixed(6);
        document.getElementById('lng').value = marker.position.lng().toFixed(6);
    });

    addMarker(bangalore, map);
}

function addMarker(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
    marker && marker.setMap(null);
    var markerIcon = "/images/marker.png";
    marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: markerIcon
    });

    google.maps.event.addDomListener(window, 'load', initMap);
}

function changeSelectRegion(map) {
    $('#regionPull').change(function() {
        var regionId = $(this).val();

        $.ajax({
            type: 'GET',
            url : 'http://localhost:3030/region/' + regionId,
            cache: false,
            contentType: false,
            processData: false,
            success : function (data) {
                region =  data.data;
                var location = { lat: parseFloat(region['lat']), lng: parseFloat(region['lng']) };

                var markerIcon = '/images/marker.png';
                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    icon: markerIcon
                });
                map.setCenter(marker.getPosition());
                map.setZoom(10);
            }
        });
    });
}