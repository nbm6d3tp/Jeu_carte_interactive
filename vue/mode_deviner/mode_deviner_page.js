window.onload = function () {
	
    //Initialisation temporaire du tableau
    var tab = [["obj1", "France"], ["obj2", "Japon"], ["obj3", "Mexique"]];

	//Chargement initial de la MAP
	var map = L.map('map').setView([14,-14.8883335],4);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'PING'}).addTo(map);
	
	//Rendre draggable les div des objets
	$( "#obj1" ).draggable({ revert: "valid" });
	$( "#obj2" ).draggable({ revert: "valid" });
	$( "#obj3" ).draggable({ revert: "valid" });

	//Rendre la map droppable
	$( "#map" ).droppable({
		 
		//Evenement lors du drop
		drop: function( event, ui ) {
			console.log(ui.offset.left - $(this).offset().left, "  ", ui.offset.top - $(this).offset().top);
			//Recupère l'id du block div "dropped" dans la map
			var IdPays;
            tab.forEach(element => {
                if(element[0] == ui.draggable.attr("id"))
                    IdPays=element[1];
            });

			var chaine="";
			chaine+="Pays : "+IdPays+"</br>";
			
			//Requete AJAX pour récupérer les coordonnées du pays de l'objet
			$.ajax({
			    type: 'GET',
			    url: "http://nominatim.openstreetmap.org/search",
			    dataType: 'jsonp',
			    jsonpCallback: 'data',
			    data: { format: "json", limit: 1,country: IdPays,json_callback: 'data' },
			    error: function(xhr, status, error) {
						alert("ERROR " + error);
			    },
			    success: function(data){
				//Récupérer les coordonnées (lati, longi) du pays dans les données json provenant du serveur
					var lati = '';
					var longi = '';
					$.each(data, function() {
						lati = this['lat'] ;
						longi = this['lon'] ;
				});
				
                // Comparaison

				//MAJ de la map à la position (lati, longi) du pays
				//map.panTo(new L.LatLng(lati, longi));		
				
			    }
			});
			
			
		}
	});
	
	//Sur le click de la map, ajout d'un marqueur sur la carte avec le nom du pays
	map.on('click', onClick);
	
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
			var paysVisite="";
			$.each(data, function() {
                if(this['country']!=undefined)
				    paysVisite = this['country'];
			});
			
			//affichage des infos
			L.marker(e.latlng).addTo(map).bindPopup("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng+" Pays : "+paysVisite).openPopup();
			L.circle(e.latlng, 1).addTo(map);			
		    }
		});
	}
	
}
