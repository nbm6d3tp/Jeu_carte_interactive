// Gestion des points
var pts = 0;

var rightCountry = "";
var latiElement = '';
var longiElement = '';
var glisser=Boolean(0);
window.onload = function () {

	// MAJ des points
	$('#pts').text(pts);
	var tabObject ={};
    $.ajax({
        url: 'index.php?controle=jeu&action=get_objs',
        async: false,
        dataType: 'json',
        success: function(data) {
            tabObject = data;
        }
    });

	var southWest = L.latLng(-47.58047736255391, -163.125),
    northEast = L.latLng(77.59759015208245, 175.078125),
    bounds = L.latLngBounds(southWest, northEast);
	//Chargement initial de la MAP
	var map = L.map('map', {
		// maxBounds: bounds,   // Then add it here..
		maxZoom: 10,
		minZoom: 2
	}).setView([46.603354,1.8883335],4);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'PING'}).addTo(map);
	
	//Rendre draggable les div des objets

	$(".drag").draggable({ revert: "valid" });
	$(".drag").draggable({
		start: function() {
			glisser=Boolean(1);
		},
		drag: function() {
			glisser=Boolean(1);
		},
		stop: function() {
			glisser=Boolean(0);
		}
	  });

	//Rendre la map droppable
	$( "#map" ).droppable({
		 
		//Evenement lors du drop
		drop: function( event, ui ) {
			//Recupère l'id du block div "dropped" dans la map
			glisser=Boolean(1);
			rightCountry=ui.draggable.attr("id");
            }
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
			
	});
	
	//Sur le click de la map, ajout d'un marqueur sur la carte avec le nom du pays
	map.on('mouseup', onClick);
	function onClick(e) {

		if(glisser){
			$.ajax({
				type: 'GET',
				async: false,
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
				// if((rightCountry!="") && (paysPropose!="") && (rightCountry!=undefined) && (paysPropose!=undefined)) {
					if((rightCountry == paysPropose)) {
						alert("Bravo ! Le pays est bien " + paysPropose + " !");
						$("#"+paysPropose).hide();
						glisser=Boolean(0);
						pts++;
						$('#pts').text(pts);
						if(pts==tabObject.length){
							alert("Felicitation! Vous avez terminé l'epreuve!");
							clearInterval(chrono);	
						console.log(min);					}
					} else {
						glisser=Boolean(0);
						alert(paysPropose+","+ rightCountry);
					}
	
				}
						
				}
			);
		}
	

	}
	
}

// Gestion du minuteur
var min = 0, sec=0, dse=0; 
var tmp = (min*60+sec)*10+dse; 
 
var chrono=setInterval(function(){
       
    min = Math.floor(tmp/600);
    sec = Math.floor( (tmp-min*600) / 10 );
        
    $('#tps').text(min+':'+sec);
	$("#map").attr("style", "position: absolute!important; margin-top: 12em;");

    tmp++;
},100);