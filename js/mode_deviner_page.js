// Gestion des points
var pts = 0;

var rightCountry = "";
var latiElement = '';
var longiElement = '';
var glisser=Boolean(0);
var idDiv,idObj;
window.onload = function () {

	$("#retourner").button().on( "click", function() {
		window.location = "index.php?controle=utilisateur&action=accueil";
	});

	$('#rejouer').button().on( "click", function() {
		location.reload(true);
	  }).hide();

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

	console.log(tabObject);

	var map = L.map('map', {
		// maxBounds: bounds,   // Then add it here..
		maxZoom: 5,
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
			var props=ui.draggable.attr("class");
			var rightCountry1=props.split(" ")[2];
			rightCountry=rightCountry1.replace('-',' ');
			idDiv=ui.draggable.attr("id");
			idObj=idDiv.slice(2);
			console.log(idObj);
            }
			
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
						$("#"+idDiv).hide();
						var img=getImg(idObj,tabObject);
						console.log(img);
						var obj=getName(idObj,tabObject);
						var text=getDescript(idObj,tabObject);
						update_descript(img,obj,text);
						glisser=Boolean(0);
						pts++;
						$('#pts').text(pts);
						if(pts==tabObject.length){
							alert("Felicitation! Vous avez terminé l'epreuve!");
							clearInterval(chrono);
							$('#rejouer').show();
							$.get('index.php?controle=jeu&action=save_result&res='+tmp);
						}
					} else {
						glisser=Boolean(0);
						alert("C'est faux!");
					}

				}
			}
			);
		}
	

	}
	
}

function getImg(id,tabObj){
	for (var value of tabObj){
		if(value['id']==id){
			return value['image'];
		}
	}
	return null;
}

function getName(id,tabObj){
	for (var value of tabObj){
		if(value['id']==id){
			return value['name'];
		}
	}
	return null;
}

function getDescript(id,tabObj){
	var descript;
	for (var value of tabObj){
		if(value['id']==id){
			$.ajax({
				url: 'index.php?controle=jeu&action=get_description&id='+id,
				async: false,
				dataType: 'text',
				success: function(data) {
					descript = data;
				}
			});		
			return descript;
		}
	}
	return null;
}

function update_descript(img,obj,text){
	var code="<img style='min-width: 40%;height: 100%;margin-right: 20px;' src='vue/img/"+img+"'><div style='max-width: 60%;max-height: 100%;'><h3>"+obj+"</h3><p>"+text+"</p></div>";
	$('#descript').html(code);
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