<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mode deviner</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.css" />
    <link rel="stylesheet" href="vue/jeu.css" />

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>
    <script type="text/javascript" src="js/mode_deviner_page.js"></script>

</head>
<body>
<div id="header">
    <div id="introduction">
        <div>
            <h1>Mode de deviner l'origine</h1>
            <h3>Trouvez l'origine de ces objets/cultures au-dessous!</h2>
        </div>
    
        <button id="retourner">Retourner a l'accueil</button>
        <button id="rejouer">Rejouer</button>
        
        <div>
            <p>Temps: <span id="tps"></span></p>
        </div>
    
    </div>

    <div id="descript">
    </div>
</div>
   
    <div>
        <?php
            if(isset($resultat)){
                foreach($resultat as $cle => $objet){
                    echo "<div id='id".$objet['id']."' class='ui-widget-content drag ".$objet['origine']."'>";
                    echo "<p>".$objet['name']."</p>";
                    echo "</div>";
            } 
            }
        ?>
        <div id="map"></div>

    </div>


</body>
</html>