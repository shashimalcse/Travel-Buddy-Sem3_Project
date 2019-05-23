function getLocationConstant() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
    } else {
        alert("Your browser or device doesn't support Geolocation");
    }
}
// If we have a successful location update
function onGeoSuccess(event) {
    document.getElementById("Latitude").value = event.coords.latitude;
    document.getElementById("Longitude").value = event.coords.longitude;
}
// If something has gone wrong with the geolocation request
function onGeoError(event) {
    alert("Error code " + event.code + ". " + event.message);
}
function initMap() {
    var mapOptions = {
        center: new google.maps.LatLng(7.927818456366202, 80.67881188707315),
        zoom: 8,
    };
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
    var marker = new google.maps.Marker({
        position: {
            lat: 7.927818456366202,
            lng: 80.67881188707315
        },
        map: map
    });
    google.maps.event.addListener(map, 'click', function(e) {
        marker.setMap(null);
        var geo = {
            lat: e.latLng.lat(),
            lng: e.latLng.lng()
        };
        marker = new google.maps.Marker({
            position: geo,
            map: map
        });
        document.getElementById("Latitude").value = e.latLng.lat();
        document.getElementById("Longitude").value = e.latLng.lng();
    });
}
function unhideFunction() {
    var divelement = document.getElementById("hideLocation");
    if (divelement.style.display == 'none')
        divelement.style.display = 'block';
}
$(document).ready(function() {
    function disableBack() {
        window.history.forward()
    }
    window.onload = disableBack();
    window.onpageshow = function(evt) {
        if (evt.persisted) disableBack()
    }
});