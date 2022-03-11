<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mode deviner</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.css" />
 
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>
    <script type="text/javascript" src="js/mode_deviner_page.js"></script>

    <style>
        .ui-widget-content { width: 130px; height: 100px; padding: 0.5em; float: left; margin: 10px 10px 10px 0; background-color: #ccffcc;}
        #droppable { width: 100; height: 150px; padding: 0.5em; float: left; margin: 10px; }
        #map { height: 300px; width:900px;}
    </style>
</head>
<body>
    <div>
        <h1>Mode de deviner l'origine</h1>
        <ul>
            <li>Il y a une liste d’objets/cultures sous forme des blocs DIV qu’on peux glisser et laisser tomber sur la carte</li>
            <li>Il faut que le joueur trouve sur la carte le pays qui est l’origine de l’objet/de la culture (par déplacer/zoom (à un niveau raisonnable) la carte à un pays → glisser et laisser tomber le bloc DIV de l’objet sur ce pays)</li>
            <li>Si vrai, le bloc DIV reste sur la carte, affiche le message de felicitation, augmente les points du joueur</li>
            <li>Si faux, le bloc DIV retourne à la liste d’objets, affiche le message “c’est faux”.</li>
            <li>Le jeu se termine lorsque toutes les cartes sont placées dans leurs positions correctes sur la carte. Le temps est enregistré sur BDD</li>
        </ul>
    </div>

    <?php
        if(isset($resultat)){
            foreach($resultat as $cle => $objet){
                echo "<div id='".$objet['origine']."' class='ui-widget-content drag'>";
                echo "<p>".$objet['name']."</p>";
                echo "</div>";
          } 
        }
    ?>
    <!-- à générer avec une boucle while et la bd -->

    <div id="map"></div>

    <div>
        <p>Points : <span id="pts"></span></p>
        <p>Temps restant : <span id="tps"></span></p>
    </div>

</body>
</html>