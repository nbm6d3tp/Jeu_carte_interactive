// default map layer
$(function(){
    var session;
    var locate;
    var locate_string;
    
    if(sessionStorage.getItem('latitude')!=null){
        locate = [sessionStorage.getItem('latitude'), sessionStorage.getItem('longitude')];
        locate_string=sessionStorage.getItem('latitude')+','+sessionStorage.getItem('longitude');
    }
    else{
        locate=[48.84162270,2.26924009];
        locate_string="48.84162270,2.26924009";
    }
    // $.get('index.php?controle=utilisateur&action=getSessionLoc', function (data) {
    //     session = data;
    // });
    
    let map = L.map('map', {
        layers: MQ.mapLayer(),
        center: locate,
        zoom: 12
    });
    
    var DepartIcon = L.icon({
        iconUrl: 'vue/img/red.png',
    
        iconSize: [20, 29],
        iconAnchor: [10, 29],
        popupAnchor: [0, -29]
    });
    
    L.marker(locate, {icon: DepartIcon}).addTo(map).bindPopup("C'est ma position");
    
    
    function runDirection(start, end) {
        
        // recreating new map layer after removal
        map = L.map('map', {
            layers: MQ.mapLayer(),
            center: locate,
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
    
    
    $("#getLocMap").button().click(function(){
        map.off();
        map.remove();
        map = L.map('map', {
            layers: MQ.mapLayer(),
            center: locate,
            zoom: 12
        });
        L.marker(locate, {icon: DepartIcon}).addTo(map).bindPopup("C'est ma position");
    });
    $(document).on("click",'.ami', function(){
        map.off();
        map.remove();
        start = locate_string;
        end=this.value;
        runDirection(start, end);
    });
    
});
