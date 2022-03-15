<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php
    if(isset($_SESSION['profil'])&&$_SESSION['profil']!=null){
      echo '<title> Bienvenue M.'.$_SESSION['profil']['name'].'</title>';
    }
    else{
      echo "<title>Réseaux sociaux de carte</title>";
    }
  ?>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css">
  <link rel="stylesheet" href="vue/index.css">


  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>   
  <script src="js/index.js"></script>


</head>
<body>
 
<div id="dialog-form-inscrire" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form_inscrire" action="index.php?controle=utilisateur&action=inscrire" method="post">
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" class="text ui-widget-content ui-corner-all name">
      <label for="username">Username</label>
      <input type="text" name="username"  class="text ui-widget-content ui-corner-all username">
      <label for="password">Password</label>
      <input type="password" name="password" class="text ui-widget-content ui-corner-all password">
      <label for="con_password">Confirmation of password</label>
      <input type="password" name="con_password" class="text ui-widget-content ui-corner-all con_password">
     
      <label for="latitude">Latitude</label>
      <input type="text" name="latitude" class="text ui-widget-content ui-corner-all latitude">
      <label for="longitude">Longitude</label>
      <input type="text" name="longitude" class="text ui-widget-content ui-corner-all longitude">
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" class="sub" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
  <button id='getLoc'>Get current location</button>
</div>
 

<div id="dialog-form-connecter" title="Connecter">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form_connecter" action="index.php?controle=utilisateur&action=ident" method="post">
    <fieldset>
      <label for="username">Username</label>
      <input type="text" name="username" class="text ui-widget-content ui-corner-all username">
      <label for="password">Password</label>
      <input type="password" name="password" class="text ui-widget-content ui-corner-all password">

      <input type="submit" class="sub" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
<?php
if(isset($_SESSION['profil'])&&$_SESSION['profil']!=null){
    echo "<div class='div_buttons'>";
      echo "<div class='div_services'>";
      echo "<button id='deconnecter'>Deconnection</button>";
      echo "<button id='getLocMap'>Positionner a votre position actuelle</button>";
      echo "<button id='jouer'>Jouer jeu</button>";
      echo "</div>";
      echo "<div id='liste_amis'>";
    
    foreach($_SESSION['profil']['amis'] as $cle => $ami){
      echo "<div class='div_ami' value=".$ami['id'].">";
      echo "<button class='ami ui-button ui-widget ui-corner-all' value='".$ami['latitude'].",".$ami['longitude']."'>".$ami['name']."</button>";
      echo "<button class='efface_ami ui-button ui-widget ui-corner-all' value=".$ami['id']."> - </button>";
      echo "</div>";
    } 
      echo"</div>";
    echo "</div>";
    
    echo "<div id='liste_etranger'>";
    foreach($_SESSION['profil']['etrangers'] as $cle => $etranger){
      echo "<button class='etranger ui-button ui-widget ui-corner-all' data-value=".$etranger['id']." value='".$etranger['latitude'].",".$etranger['longitude']."'>".$etranger['name']."</button>";
    } 
    echo "</div>";


}
else{
  echo "<div class='div_buttons'>";
  echo "<div class='div_services'>";
    echo "<button id='create-user'>Create new user</button>";
    echo "<button id='connecter'>Connection</button>";
  echo"</div>";
  echo "</div>";
}

?>


<div id='map'></div> 

<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
<script src="js/map.js"></script>
</body>
</html>