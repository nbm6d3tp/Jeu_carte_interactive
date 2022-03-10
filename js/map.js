// default map layer
var session;
var loc;
$.get('index.php?controle=utilisateur&action=getSessionLoc', function (data) {
    session = data;
});

let map = L.map('map', {
    layers: MQ.mapLayer(),
    center: [48.761360, 2.396874],
    zoom: 12
});


function runDirection(start, end) {
    
    // recreating new map layer after removal
    map = L.map('map', {
        layers: MQ.mapLayer(),
        center: [48.761360, 2.396874],
        zoom: 12
    });
    
    var dir = MQ.routing.directions();

    dir.route({
        locations: [
            start,
            end
        ]
    });


    CustomRouteLayer = MQ.Routing.RouteLayer.extend({
        createStartMarker: (location) => {
            var custom_icon;
            var marker;

            custom_icon = L.icon({
                iconUrl: 'vue/img/red.png',
                iconSize: [20, 29],
                iconAnchor: [10, 29],
                popupAnchor: [0, -29]
            });

            marker = L.marker(location.latLng, {icon: custom_icon}).addTo(map);

            return marker;
        },

        createEndMarker: (location) => {
            var custom_icon;
            var marker;

            custom_icon = L.icon({
                iconUrl: 'vue/img/blue.png',
                iconSize: [20, 29],
                iconAnchor: [10, 29],
                popupAnchor: [0, -29]
            });

            marker = L.marker(location.latLng, {icon: custom_icon}).addTo(map);

            return marker;
        }
    });
    
    map.addLayer(new CustomRouteLayer({
        directions: dir,
        fitBounds: true
    })); 
}


$("#getLocMap").click(function(){
    $.get('index.php?controle=utilisateur&action=getSessionLoc', function (data) {
        session = data;
        var log=session.split(',');
        map.remove();

        map = L.map('map', {
            layers: MQ.mapLayer(),
            center: log,
            zoom: 14
        });
    });
})
$(".ami").click(function(){

    map.remove();

    start = session;
    end=this.value;
    runDirection(start, end);
});
