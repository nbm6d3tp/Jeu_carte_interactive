// Gestion des points
var pts = 0;

var rightCountry = "";
var latiElement = '';
var longiElement = '';

window.onload = function () {

	// MAJ des points
	$('#pts').text(pts);
	
    //Initialisation temporaire du tableau
    var tab = [["obj1", "France"], ["obj2", "Japon"], ["obj3", "Mexique"]];

	//Chargement initial de la MAP
	var map = L.map('map').setView([46.603354,1.8883335],4);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'PING'}).addTo(map);
	
	//Rendre draggable les div des objets
	$( "#obj1" ).draggable({ revert: "valid" });
	$( "#obj2" ).draggable({ revert: "valid" });
	$( "#obj3" ).draggable({ revert: "valid" });

	//Rendre la map droppable
	$( "#map" ).droppable({
		 
		//Evenement lors du drop
		drop: function( event, ui ) {
			//Recupère l'id du block div "dropped" dans la map
			var IdPays;
            tab.forEach(element => {
                if(element[0] == ui.draggable.attr("id"))
                    IdPays=element[1];
            });

			rightCountry=IdPays;

			//Requete AJAX pour récupérer les coordonnées du pays de l'objet
			/*$.ajax({
			    type: 'GET',
			    url: "http://nominatim.openstreetmap.org/search",
			    dataType: 'jsonp',
			    jsonpCallback: 'data',
			    data: { format: "json", limit: 1,country: IdPays,json_callback: 'data' },
			    error: function(xhr, status, error) {
						alert("ERROR " + error);
			    },
			    success: function(data){
					//Récupérer les coordonnées (lati, longi) du pays dans les données json provenant du serveur et les stocker en attendant la proposition du joueur		
					$.each(data, function() {
						latiElement = this['lat'];
						longiElement = this['lon'];
					});
				}

			});*/
			
		}
	});
	
	//Sur le click de la map, ajout d'un marqueur sur la carte avec le nom du pays
	map.on('mouseup', onClick);
	
	function onClick(e) {
		//Recherche le pays sur lequel on a cliqué
		//Requete AJAX pour récupérer les infos du pays sur le point où on a cliqué (lati, longi)
				$.ajax({
					type: 'GET',
					url: "http://nominatim.openstreetmap.org/reverse",
					dataType: 'jsonp',
					jsonpCallback: 'data',
					data: { format: "json", limit: 1,lat: e.latlng.lat,lon: e.latlng.lng,json_callback: 'data' },
					error: function(xhr, status, error) {
					alert("ERROR "+error);
					},
					success: function(data){
					//Récupérer les coordonnées (lati, longi) du pays dans les données json provenant du serveur
					var paysPropose="";
					$.each(data, function() {
						if(this['country']!=undefined)
							paysPropose = this['country'];
					});

					//MAJ de la map à la position (lati, longi) du pays
					if((rightCountry!="") && (paysPropose!="") && (rightCountry!=undefined) && (paysPropose!=undefined)) {
						if((rightCountry == paysPropose)) {
							alert("Bravo ! Le pays est bien " + paysPropose + " !");
							pts++;
							$('#pts').text(pts);
						} else {
							alert("Perdu... Le pays n'est pas " + paysPropose + " mais " + rightCountry + ".");
						}
		
						//affichage des infos de la réponse (pays correct) 
						//map.panTo(new L.LatLng(latiElement, longiElement));
						//L.marker(e.latlng).addTo(map).bindPopup("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng+" Pays : "+rightCountry).openPopup();
						//L.circle(e.latlng, 1).addTo(map);	
					}
							
					}
				});

	}
	
}

// Gestion du minuteur
var min = 5, sec=0, dse=0; 
var tmp = (min*60+sec)*10+dse; 
 
var chrono=setInterval(function(){
       
    min = Math.floor(tmp/600);
    sec = Math.floor( (tmp-min*600) / 10 );
        
    $('#tps').text(min+':'+sec);
	$("#map").attr("style", "position: absolute!important; margin-top: 12em;");

    tmp--;
},100);