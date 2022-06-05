var default_zoom = 8,
    default_center_lat = 53.894473,
    default_center_lng = 27.561389,
    default_marker_size = 36,
    default_marker_scaled_size = 36,
    displayRoute = true,
    map = null,
    events = [],
    bounds = null,
    reports = null,
    location_map,
    directionsDisplay = null,
    polyline_fact = null,
    polyline_before = null,
    polyline_plan = null,
    infoWindows = [],
    markers = [],
    marker = null,
    points = [];
overlays = [];

function initMap() {
    console.log('Google Maps API version: ' + google.maps.version);
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: this.default_zoom,
        center: {
            lat: this.default_center_lat,
            lng: this.default_center_lng
        },
        disableDoubleClickZoom: true,
        mapTypeControl: true,
        mapTypeId: 'terrain',
        // mapTypeId: google.maps.MapTypeId.HYBRID
    });
    polyline_plan = new google.maps.Polyline({
        strokeColor: '#007cff',
        strokeOpacity: 0.8,
        strokeWeight: 4
    });
    polyline_plan.setMap(this.map);
    polyline_fact = new google.maps.Polyline({
        geodesic: true,
        strokeColor: '#2ecc71',
        strokeOpacity: 0.8,
        strokeWeight: 5
    });
    polyline_fact.setMap(this.map);
    var lineSymbol = {
        path: 'M 0,-1 0,1',
        strokeOpacity: 1,
        scale: 4
    };
    polyline_before = new google.maps.Polyline({
        geodesic: true,
        strokeColor: '#2ecc71',
        strokeOpacity: 0,
        icons: [{
            icon: lineSymbol,
            offset: '0',
            repeat: '20px'
        }]
    }); // this.polyline_before.setMap(this.map);

    infoWindows = [];
    markers = [];
    location_map = this;
    events = $('.location').data('events');

    if (this.events.length > 0
        /* && isBounds === undefined*/
    ) {
        var _bounds = new google.maps.LatLngBounds();

        for (var i = 0; i < events.length; i++) {

            var markerIcon = 'images/';
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(events[i]['lat'], events[i]['lng']),
                map: map,
                icon: markerIcon + getIcon(events[i])
            });

            marker.type = events[i]['region_id'];
            marker.date = events[i]['created_at'];
            markers.push(marker);
            
            let html                = generateInfo(events[i]);
            let infoWindow          = new google.maps.InfoWindow({content: html});
            this.infoWindows.push(infoWindow);

            $('#collectGroup').click(function (el) {
                el.preventDefault();
                var regionId = $('#region').val();
                var mapDate = $('#mapDate').val();
                var mapDateRange = $('#mapDateRange').val();
                getReportOfDate(regionId, mapDate, mapDateRange);
                displayMarkerDate(markers, regionId);
            })

            marker.addListener('click', function() {
                infoWindow.open(this.map, this);
            });
        }
    }
}

function displayMarker(type) {
    for (var i = 0; i < markers.length; i++) {
        if (type === 0) {
            markers[i].setVisible(true);
        } else if (markers[i].type === type) {
            markers[i].setVisible(true);
        } else {
            markers[i].setVisible(false);
        }
    }
}

function hideDisplayMarker() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setVisible(false);
    }
}

function displayMarkerDate(arrMark, value) {
    for (var i = 0; i < arrMark.length; i++) {
        if (arrMark[i]['region_id'] == value) {
            arrMark[i].setVisible(true);
        } else {
            arrMark[i].setVisible(false);
        }
    }
}

function onDateChange(obj) {
    var nameInp = obj.name;
    var valInp = obj.value;
    getReportOfDate(nameInp, valInp);
}

function getReportOfDate(regionId, date, dateRange) {
    $.ajax({
        type: 'GET',
        url : 'http://xn--m1aaxj.xn--90ais/reports/search/',
        cache: false,
        contentType: false,
        data: {regionId: regionId, date: date, dateRange: dateRange},
        success : function (data) {
            reports = data.data;

            if (reports.length === 0) {
                hideDisplayMarker();
            } else {

                console.log('Success init ajax ...');

                for (var i = 0; i < reports.length; i++) {
                    var markerIcon = 'images/';
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(reports[i]['lat'], reports[i]['lng']),
                        map: map,
                        icon: markerIcon + getIcon(reports[i])
                    });
                    marker.type = reports[i]['region_id'];
                    marker.date = reports[i]['created_at'];
                    markers.push(marker);
                    let html                = generateInfo(reports[i]);
                    let infoWindow          = new google.maps.InfoWindow({content: html});
                    infoWindows.push(infoWindow);
                    marker.addListener('click', function() {
                        infoWindow.open(map, this);
                    });
                }
                // $('#locations-map').toggleClass('d-block d-none');
            }
        }
    });
}

function generateInfo(el) {
    let date = generateDate(el['created_at'])

    let url = "http://xn--m1aaxj.xn--90ais/reports/" + el['id'];

    return  "<div class='map-box-content'>"+
        "<p class='bold'> Автор: " + el['user']['name'] + "</p>" +
        "<p class='bold'> Дата создания: " + date + "</p>" +
        "<p class='bold'>" + "<a class='btn btn-sm btn-warning' href=" + url + ">Просмотр" + "</a>" + "</p>" +
        "</div>";
}

function generateDate(value) {
    d = new Date(value);
    if (value === '__/__/____' || value === null || value === undefined) {
        return  '__/__/____';
    } else {
        return (d.getDate() < 10 ? '0' : '') + d.getDate() + '/' +
            ((d.getMonth() + 1) < 10 ? '0' : '') + (d.getMonth() + 1) + '/' +
            d.getFullYear() + ' ' +
            (d.getHours() < 10 ? '0' : '') + d.getHours() + ':' +
            (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
    }
}

function generateNewFormatDate(value) {
    d = new Date(value);
    if (value === '__/__/____' || value === null || value === undefined) {
        return  '__/__/____';
    } else {
        return (d.getFullYear() + '-') +
            ((d.getMonth() + 1) < 10 ? '0' : '') + (d.getMonth() + 1) + '-' +
            (d.getDate() < 10 ? '0' : '') + d.getDate();
    }
}

function getIcon(el) {

    var icon = '';

    switch(el.region_id) {
        case 2:
            icon = "marker_two.png";
            break;
        case 3:
            icon = "marker_three.png";
            break;
        case 4:
            icon = "marker_four.png";
            break;
        case 5:
            icon = "marker_five.png";
            break;
        case 6:
            icon = "marker_six.png";
            break;
        default:
            icon = "marker.png";
    }

    return icon;
}