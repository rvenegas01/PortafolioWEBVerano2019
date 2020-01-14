var mymap = L.map('mapid').setView([10.0144685, -84.2136920], 16);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 29,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoicnZlbmVnYXMwMSIsImEiOiJjazU0YnUydTMwMjZvM3NwYm9pcG04bmJqIn0.OEY3hrXAXelzTn1ns4cPLg'
}).addTo(mymap);

var markerClusters = L.markerClusterGroup();
for (var i = 0; i < ffood.length; ++i) {
    var m = L.marker([ffood[i].lat, ffood[i].lon])
        .bindPopup('<p>' + ffood[i].name + '</p>' +
            '<br/>' + '<p>' + ffood[i].add + '</p>');

    markerClusters.addLayer(m);
}


mymap.addLayer(markerClusters);