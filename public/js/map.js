/* exported initMap */
/* globals L */

function initMap(elem, latlng) {
    var center = [52.48626, -1.89042];
    if (latlng) {
        center = latlng;
    }
    /* Please note: The token is only restricted to FCDO domains and domains controlled by FCDO */
    var mapBox = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaWF0aS1mZWVkYmFjayIsImEiOiJja2d0Njl2MWkwOG92MnhwMHhmOHR3MXQyIn0.bXjLLa0rGrsIzDNS1E5H1w', {
        attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
        tileSize: 512,
         maxZoom: 18,
         zoomOffset: -1,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoiaWF0aS1mZWVkYmFjayIsImEiOiJja2d0Njl2MWkwOG92MnhwMHhmOHR3MXQyIn0.bXjLLa0rGrsIzDNS1E5H1w'
        });

    var map = new L.Map(elem, {
        center: center,
        zoom: 1,
        layers: [mapBox]
    });

    if (latlng) {
        L.marker(latlng).addTo(map);
    }
    map.scrollWheelZoom.disable();

    map.on('click', function (e) {
        clearMarker(elem);
        L.marker(e.latlng).addTo(map);
        populateValues(elem, e.latlng);
    });

    var parentName = elem.replace('[map]', '');
    var lat_id = '#' + parentName + '[latitude]';
    lat_id = lat_id.replace(/([\[\]])/g, '\\$1');

    var lng_id = '#' + parentName + '[longitude]';
    lng_id = lng_id.replace(/([\[\]])/g, '\\$1');

    $(lat_id).keyup(function () {
        changeMap(lat_id, lng_id, elem, map);
    });

    $(lng_id).keyup(function(){
       changeMap(lat_id, lng_id, elem, map);
    });

    return map;
}

function clearMarker(elem) {
    elem = document.getElementById(elem);
    $('.leaflet-marker-pane', elem).html('');
    $('.leaflet-shadow-pane', elem).html('');
}

function populateValues(elem, latLong) {
    var parentName = elem.replace('[map]', '');
    $('input[name="' + parentName + '[latitude]"]').val(latLong.lat);
    $('input[name="' + parentName + '[longitude]"]').val(latLong.lng);
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function changeMap(lat_id, lng_id, elem, map){
    var lat = $(lat_id).val();
    var latNum = isNumber(lat);

    var lng = $(lng_id).val();
    var lngNum = isNumber(lng);

    if(latNum && lngNum){
        clearMarker(elem);
        var latLng = L.latLng(lat, lng);
        map.panTo(latLng);
        L.marker([lat, lng]).addTo(map);
    }
}

function flyTo(map, latLong) {
    map.panTo(latLong);
    map.invalidateSize();
}

