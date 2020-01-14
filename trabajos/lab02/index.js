var mymap = L.map('mapid').setView([10.0144685, -84.2136920], 16);
var wps = []
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 29,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoicnZlbmVnYXMwMSIsImEiOiJjazU0YnUydTMwMjZvM3NwYm9pcG04bmJqIn0.OEY3hrXAXelzTn1ns4cPLg'
}).addTo(mymap);

for (var i = 0; i < nodes.length; ++i) {
    wps.push(L.latLng(nodes[i].lat, nodes[i].lon));
}

L.Routing.control({
    waypoints: wps
}).addTo(mymap);

for (var i = 0; i < nodes.length; ++i) {
    L.marker([nodes[i].lat, nodes[i].lon])
        .bindPopup('<p>' + nodes[i].name + '</p><p>Lat: ' + nodes[i].lat + '</p><p>Lon: ' + nodes[i].lon + '</p>')
        .addTo(mymap);
}